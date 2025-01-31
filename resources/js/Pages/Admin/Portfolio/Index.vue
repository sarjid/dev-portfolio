<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, reactive, watch, onMounted } from "vue";
import noty from "@/alert";
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { Table, TableData, TableHead, TableRow } from "@/Components/Admin/Table";
import { Checkbox, PlainTextInput, VSelect } from "@/Components/Admin/Form";
import { Modal } from "@/Components/Admin/Modal";
import Pagination from "@/Components/Admin/Pagination.vue";
import { VPrimaryButton, VDangerButton, LinkButton } from "@/Components/Admin/Button";
import InputError from "@/Components/InputError.vue";
import { useFormStore } from "@/admin/stores";
const form = useFormStore();
import { throttle, pickBy } from "lodash";
const props = defineProps({
    portfolios: Object,
    filters: Object,
});
const portfolioFilters = reactive({
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
    portfolioFilters,
    throttle(() => {
        let query = pickBy(portfolioFilters);
        let queryRoute = route(
            "admin.portfolio.index",
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
    router.delete(route("admin.portfolio.destroy", id), {
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
        selectedData.value = props.portfolios?.data.map(data => data.id);
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
    router.delete(route("admin.portfolio.multiple.destroy", { ids: selectedData.value }), {
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

const submitForm = () => {
    const submitF = useForm(form.data);
    submitF.post(route('admin.portfolio.store'), {
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

</script>

<template>

    <Head title="Portfolio" />

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
                                placeholder="client portfolio"></textarea>
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
                    <LinkButton :href="route('admin.portfolio.create')">
                        <i class="fa solid fa-plus-circle"></i>
                        Add New
                    </LinkButton>

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
                                <PlainTextInput v-model="portfolioFilters.search" />

                            </div>
                        </div>
                        <div class="flex">
                            <select v-model="portfolioFilters.perPage" @change="
                portfolioFilters.perPage ===
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
                            <TableHead>Service Name</TableHead>
                            <TableHead>Image</TableHead>
                            <TableHead>Manage</TableHead>
                        </template>
                        <TableRow v-for="portfolio in portfolios.data" :key="portfolio.id">
                            <TableData>
                                <Checkbox>
                                    <input type="checkbox" :checked="selectAll" @change="toggleSelection(portfolio)" />
                                </Checkbox>
                            </TableData>
                            <TableData>{{ portfolio.service?.name }}</TableData>
                            <TableData>
                                <img :src="$filters.makeImagePath(portfolio.image)" class="w-12 h-12" alt="img">
                            </TableData>

                            <TableData>
                                <div class=" flex space-x-2">
                                    <VDangerButton @click.prevent="destroy(portfolio)">
                                        <i class="fas fa-trash-alt"></i>
                                    </VDangerButton>
                                </div>
                            </TableData>
                        </TableRow>
                    </Table>

                    <div class="m-2 p-2">
                        <Pagination :data="portfolios" />
                    </div>

                </div>

            </div>
            <!-- /product list -->
        </div>
    </AdminLayout>
</template>

<style scoped>
.demo-portfolio-block {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.demo-portfolio-block .demonstration {
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
