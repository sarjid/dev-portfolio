<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, reactive, watch, onMounted } from "vue";
import noty from "@/alert";
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { Table, TableData, TableHead, TableRow } from "@/Components/Admin/Table";
import { Checkbox, PlainTextInput, VSelect } from "@/Components/Admin/Form";
import { Modal } from "@/Components/Admin/Modal";
import Pagination from "@/Components/Admin/Pagination.vue";
import { VPrimaryButton, VDangerButton } from "@/Components/Admin/Button";
import InputError from "@/Components/InputError.vue";
import { useFormStore } from "@/admin/stores";
const form = useFormStore();
import { throttle, pickBy } from "lodash";
const props = defineProps({
    reviews: Object,
    filters: Object,
});
const reviewFilters = reactive({
    search: props.filters.search,
    perPage: props.filters.perPage ? props.filters.perPage : 8,

});

// intialize form
onMounted(() => {
    form.data.name = "";
    form.data.image = "";
    form.data.description = "";
})

watch(
    reviewFilters,
    throttle(() => {
        let query = pickBy(reviewFilters);
        let queryRoute = route(
            "admin.review.index",
            Object.keys(query).length
                ? query
                : {
                    remember: "forget",
                }
        );
        router.get(
            queryRoute,
            {},
            {
                preserveState: true,
                replace: true,
            }
        );
    }, 400),
    {
        deep: true,
    }
);


const destroy = (id) => {
    // if (confirm("Are you sure you want to Delete")) {
    router.delete(route("admin.review.destroy", id), {
        onBefore: () => confirm('Are you sure you want to delete?'),
        onSuccess: () => {
            noty().fire({
                icon: "success",
                title: `Delete Success`,
            });
        },
    });
    // }

}

// bulk delete start
const selectedData = ref([]);
const selectAll = ref(false);
const selectAllData = () => {
    if (selectAll.value) {
        selectedData.value = props.reviews?.data.map(data => data.id);
    } else {
        selectedData.value = [];
    }

}

const toggleSelection = (data) => {
    const index = selectedData.value.indexOf(data?.id);
    if (index === -1) {
        selectedData.value.push(data?.id);
    } else {

        selectedData.value.splice(index, 1);
    }

};



const bulkDeleteAction = () => {
    router.delete(route("admin.review.multiple.destroy", { ids: selectedData.value }), {
        onBefore: () => confirm('Are you sure you want to delete?'),
        onSuccess: () => {
            // notify("Delete Success", "Success");
            selectedData.value = [];
            selectAll.value = false;

            noty().fire({
                icon: "success",
                title: `Delete Success`,
            });
        },
    });
}

// bulk delete end

const editMode = ref(false);
const modalVisible = ref(false);
const closeFormModal = () => {
    modalVisible.value = false;
    form.$reset();
    editMode.value = false;
}
const toggleModal = () => {
    // editMode.value = false;
    modalVisible.value = !modalVisible.value;
};

const editModal = (data) => {
    modalVisible.value = true;
    editMode.value = true;
    form.data = data;

}

const submitForm = () => {
    const submitF = useForm(form.data);
    if (editMode.value) {
        submitF.post(route('admin.review.update', form.data?.id), {
            onSuccess: (page) => {
                closeFormModal();
                editMode.value = false;
                noty().fire({
                    icon: "success",
                    title: "Update Success",
                });

            },
            onError: errors => { form.errors = errors },
            onStart: visit => { form.processing = true; },
            // onBefore: visit => { console.log('before', visit); },
            onFinish: visit => { form.processing = false; },
        })

    } else {

        submitF.post(route('admin.review.store'), {
            onSuccess: (page) => {
                closeFormModal();
                noty().fire({
                    icon: "success",
                    title: "Added Success",
                });
            },
            onError: errors => { form.errors = errors },
            onStart: visit => { form.processing = true; },
            // onBefore: visit => { console.log('before', visit); },
            onFinish: visit => { form.processing = false; },
        })

    }


}




</script>

<template>

    <Head title="Review" />

    <AdminLayout>
        <div class="content">
            <Modal :visible="modalVisible" @close="closeFormModal()">
                <template #content>
                    <form class="space-y-2" @submit.prevent="submitForm()">
                        <div class="form-group">
                            <PlainTextInput v-model="form.data.name" id="type" type="text" name="name"
                                placeholder="client name" />
                            <InputError :message="form.errors?.name" />
                        </div>

                        <div class="form-group">
                            <input @input="(form.data.image = $event.target.files[0])" type="file" class="form-control">
                            <img v-if="editMode" :src="$filters.makeImagePath(form.data.image)" class="w-12 h-12"
                                alt="img"> <br />

                            <small>w-570px * h-696px</small>
                            <InputError :message="form.errors?.image" />
                        </div>

                        <div class="form-group">
                            <textarea v-model="form.data.description" class="form-control"
                                placeholder="client review"></textarea>
                            <InputError :message="form.errors?.description" />
                        </div>


                        <div class="flex items-center gap-4">
                            <VPrimaryButton type="submit" :disabled="form.processing">
                                <FIcon icon="fa-solid fa-spinner " v-show="form.processing" />
                                {{ editMode ? "Update" : "Create" }}
                            </VPrimaryButton>
                        </div>
                    </form>
                </template>
            </Modal>

            <!-- /product list -->
            <div class="card">
                <div class="p-2 flex gap-x-4">
                    <VPrimaryButton type="submit" @click.prevent="toggleModal()">
                        <FIcon icon="fa solid fa-plus-circle" class="mr-2" />
                        Add New
                    </VPrimaryButton>

                    <VDangerButton v-if="selectedData?.length > 0" type="button" class="btn-sm"
                        @click.prevent="bulkDeleteAction">
                        Delete
                        <span>{{ selectedData.length }} items</span>
                    </VDangerButton>
                </div>
                <div class="card-body">
                    <div class="flex justify-between py-2">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute flex items-center ml-2 h-full">
                                    <i class="fas fa-search"></i>
                                </div>
                                <PlainTextInput v-model="reviewFilters.search" />

                            </div>
                        </div>
                        <div class="flex">
                            <select v-model="reviewFilters.perPage" @change="
                reviewFilters.perPage ===
                $event.target.value
                " class="px-4 py-2 w-full rounded-md bg-gray-50 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm">
                                <option value="8">8 Per Page</option>
                                <option value="20">20 Per Page</option>
                                <option value="50">50 Per Page</option>
                                <option value="100">100 Per Page</option>
                                <option value="200">200 Per Page</option>
                            </select>
                        </div>
                    </div>
                    <!-- /Filter end -->

                    <!-- table sart  -->
                    <Table>

                        <template #tableHead>
                            <TableHead>
                                <Checkbox>
                                    <input type="checkbox" v-model="selectAll" @change="selectAllData" />
                                </Checkbox>
                            </TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead>Image</TableHead>
                            <TableHead>Description</TableHead>
                            <TableHead>Manage</TableHead>
                        </template>
                        <TableRow v-for="review in reviews.data" :key="review.id">
                            <TableData>
                                <Checkbox>
                                    <input type="checkbox" :checked="selectAll" @change="toggleSelection(review)" />
                                </Checkbox>
                            </TableData>
                            <TableData>{{ review.name }}</TableData>
                            <TableData>
                                <img :src="$filters.makeImagePath(review.image)" class="w-12 h-12" alt="img">
                            </TableData>
                            <TableData>
                                <textarea class="form-control" readonly>{{ review.description }}</textarea>
                            </TableData>

                            <TableData>
                                <div class=" flex space-x-2">
                                    <VPrimaryButton @click.prevent="editModal(review)">
                                        <i class="fas fa-edit"></i>
                                    </VPrimaryButton>

                                    <VDangerButton @click.prevent="destroy(review)">
                                        <i class="fas fa-trash-alt"></i>
                                    </VDangerButton>
                                </div>
                            </TableData>
                        </TableRow>
                    </Table>

                    <div class="m-2 p-2">
                        <Pagination :data="reviews" />
                    </div>

                </div>

            </div>
            <!-- /product list -->
        </div>
    </AdminLayout>
</template>

<style scoped>
.demo-review-block {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.demo-review-block .demonstration {
    margin-right: 16px;
}



.el-tag.el-tag--primary {
    display: flex;
    justify-content: space-between;
    --el-tag-bg-color: #4fa801;
    --el-tag-border-color: #4fa801;
    --el-tag-hover-color: #4fa801;
}

.el-tag.el-tag--primary {
    --el-tag-text-color: #f0f1f3;
}

.el-tag .el-tag__close {
    color: #f0f1f3;
    flex-shrink: 0;
}
</style>
