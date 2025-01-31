<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, reactive, watch, nextTick, onMounted } from "vue";
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
    pricings: Object,
    services: Object,
    filters: Object,
});
const pricingFilters = reactive({
    search: props.filters.search,
    perPage: props.filters.perPage ? props.filters.perPage : 8,

});

// intialize form
onMounted(() => {
    form.data.service_id = "";
    form.data.type = "";
    form.data.price = "";
    form.data.items = [];
})

watch(
    pricingFilters,
    throttle(() => {
        let query = pickBy(pricingFilters);
        let queryRoute = route(
            "admin.pricing.index",
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

function sort(column) {
    pricingFilters.column = column;
    pricingFilters.direction = pricingFilters.direction === "asc" ? "desc" : "asc";
}


const destroy = (id) => {
    // if (confirm("Are you sure you want to Delete")) {
    router.delete(route("admin.pricing.destroy", id), {
        onBefore: () => confirm('Are you sure you want to delete?'),
        onSuccess: () => {
            // notify("Delete Success", "Success");
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
        selectedData.value = props.pricings?.data.map(data => data.id);
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
    router.delete(route("admin.pricing.multiple.destroy", { ids: selectedData.value }), {
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
        submitF.put(route('admin.pricing.update', form.data?.id), {
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

        submitF.post(route('admin.pricing.store'), {
            onSuccess: (page) => {
                closeFormModal();
                noty().fire({
                    icon: "success",
                    title: "Store Success",
                });
            },
            onError: errors => { form.errors = errors },
            onStart: visit => { form.processing = true; },
            // onBefore: visit => { console.log('before', visit); },
            onFinish: visit => { form.processing = false; },
        })

    }

    // const pricingstore = router.post(route('admin.pricing.store', pricingForm), {
    // router.post(route('admin.pricing.store', form.data), {
    //     onSuccess: (page) => { console.log('my_page', page) },
    // });



    // onSuccess: () => {
    //     toggleModal();
    //     noty().fire({
    //         icon: "success",
    //         title: "Store Success",
    //     });
    // },
    // onError: errors => { console.log('err', errors) },



}




//useable for tags


import { ElInput } from 'element-plus'

const inputValue = ref('')
const dynamicTags = ref(['Tag 1', 'Tag 2', 'Tag 3'])
const inputVisible = ref(false)
const InputRef = ref(null)

const handleClose = (tag) => {
    form.data.items.splice(form.data.items.indexOf(tag), 1);
}

const showInput = () => {
    inputVisible.value = true
    nextTick(() => {
        if (InputRef.value) {
            InputRef.value.input.focus()
        }
    })
}

const handleInputConfirm = () => {
    if (inputValue.value) {
        //check form.data.items is array or not..
        if (!Array.isArray(form.data.items)) {
            form.data.items = [];
        }
        form.data.items.push(inputValue.value);
    }
    inputVisible.value = false
    inputValue.value = ''
}

</script>

<template>

    <Head title="Pricing" />

    <AdminLayout>
        <div class="content">
            <Modal :visible="modalVisible" @close="closeFormModal()">
                <template #content>
                    <form class="space-y-4" @submit.prevent="submitForm()">
                        <div class="form-group">
                            <select class="form-control" v-model="form.data.service_id">
                                <option value="" selected disabled>Select Service</option>
                                <option v-for="(service, index) in services" :key="index" :value="service.id">
                                    {{ service.name }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control" v-model="form.data.type">
                                <option value="" selected disabled>Select Plan Type</option>
                                <option value="Basic">Basic</option>
                                <option value="Standard">Standard</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>


                        <template v-if="form.data?.type">

                            <div class="form-group">
                                <PlainTextInput v-model="form.data.price" id="type" type="text" name="price"
                                    placeholder="price" />
                                <InputError :message="form.errors?.price" />
                            </div>

                            <div class="form-group">
                                <label>Plan Feature List</label>
                                <div class="flex flex-col gap-2">
                                    <el-tag v-for="tag in form.data?.items" :key="tag" closable
                                        :disable-transitions="false" @close="handleClose(tag)">
                                        {{ tag }}
                                    </el-tag>

                                    <el-input v-if="inputVisible" ref="InputRef" v-model="inputValue" class="w-20"
                                        size="small" @keyup.down="handleInputConfirm" @blur="handleInputConfirm" />
                                    <el-button v-else class="button-new-tag" size="small" @click="showInput">
                                        + Add Items
                                    </el-button>

                                    <small class="italic">press keyboard <i class="fas fa-arrow-circle-down"></i>
                                        key
                                        or click outside to enter add item
                                    </small>
                                </div>


                                <InputError :message="form.errors?.description" />
                            </div>

                        </template>

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
                                <PlainTextInput v-model="pricingFilters.search" />

                            </div>
                        </div>
                        <div class="flex">
                            <select v-model="pricingFilters.perPage" @change="
                pricingFilters.perPage ===
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
                            <TableHead>Pricing Type</TableHead>
                            <TableHead>Price</TableHead>
                            <TableHead>Features</TableHead>
                            <TableHead>Manage</TableHead>
                        </template>
                        <TableRow v-for="pricing in pricings.data" :key="pricing.id">
                            <TableData>
                                <Checkbox>
                                    <input type="checkbox" :checked="selectAll" @change="toggleSelection(pricing)" />
                                </Checkbox>
                            </TableData>
                            <TableData>{{ pricing?.service?.name }}</TableData>
                            <TableData>{{ pricing.type }}</TableData>
                            <TableData>{{ $filters.currencySymbol(pricing.price) }}</TableData>
                            <TableData>
                                <div class="flex  gap-x-1">
                                    <el-tag v-for="item in pricing.items" :key="item" :disable-transitions="false">
                                        {{ item }}
                                    </el-tag>
                                </div>
                            </TableData>
                            <TableData>
                                <div class=" flex space-x-2">
                                    <VPrimaryButton @click.prevent="editModal(pricing)">
                                        <i class="fas fa-edit"></i>
                                    </VPrimaryButton>

                                    <VDangerButton @click.prevent="destroy(pricing)">
                                        <i class="fas fa-trash-alt"></i>
                                    </VDangerButton>
                                </div>
                            </TableData>
                        </TableRow>
                    </Table>

                    <div class="m-2 p-2">
                        <Pagination :data="pricings" />
                    </div>

                </div>

            </div>
            <!-- /product list -->
        </div>
    </AdminLayout>
</template>

<style scoped>
.demo-pricing-block {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.demo-pricing-block .demonstration {
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
