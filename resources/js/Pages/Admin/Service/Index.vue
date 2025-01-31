<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, reactive, watch } from "vue";
import noty from "@/alert";
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { Table, TableData, TableHead, TableRow } from "@/Components/Admin/Table";
import { Checkbox, PlainTextInput } from "@/Components/Admin/Form";
import { Modal } from "@/Components/Admin/Modal";
import Pagination from "@/Components/Admin/Pagination.vue";
import { VPrimaryButton, VDangerButton } from "@/Components/Admin/Button";
import InputError from "@/Components/InputError.vue";
import { useFormStore } from "@/admin/stores";
const form = useFormStore();
import { throttle, pickBy } from "lodash";
const props = defineProps({
    services: Object,
    filters: Object,
});
const serviceFilters = reactive({
    search: props.filters.search,
    perPage: props.filters.perPage ? props.filters.perPage : 8,

});

watch(
    serviceFilters,
    throttle(() => {
        let query = pickBy(serviceFilters);
        let queryRoute = route(
            "admin.service.index",
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
    serviceFilters.column = column;
    serviceFilters.direction = serviceFilters.direction === "asc" ? "desc" : "asc";
}


const destroy = (id) => {
    // if (confirm("Are you sure you want to Delete")) {
    router.delete(route("admin.service.destroy", id), {
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
        selectedData.value = props.services?.data.map(data => data.id);
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
    router.delete(route("admin.service.multiple.destroy", { ids: selectedData.value }), {
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
        submitF.put(route('admin.service.update', form.data?.id), {
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

        submitF.post(route('admin.service.store'), {
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

    // const servicestore = router.post(route('admin.service.store', serviceForm), {
    // router.post(route('admin.service.store', form.data), {
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



</script>

<template>

    <Head title="Services" />

    <AdminLayout>
        <div class="content">
            <Modal :visible="modalVisible" @close="closeFormModal()">
                <template #content>
                    <form class="space-y-4" @submit.prevent="submitForm()">
                        <div class="form-group">
                            <PlainTextInput v-model="form.data.name" id="type" type="text" name="name"
                                placeholder="name" />
                            <InputError :message="form.errors?.name" />
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" v-model="form.data.description" id="type" type="text"
                                name="description" placeholder="description" />
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
                                <PlainTextInput v-model="serviceFilters.search" />

                            </div>
                        </div>
                        <div class="flex">
                            <select v-model="serviceFilters.perPage" @change="
                serviceFilters.perPage ===
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
                            <TableHead>Description</TableHead>
                            <TableHead>Manage</TableHead>
                        </template>
                        <TableRow v-for="service in services.data" :key="service.id">
                            <TableData>
                                <Checkbox>
                                    <input type="checkbox" :checked="selectAll" @change="toggleSelection(service)" />
                                </Checkbox>
                            </TableData>
                            <TableData>{{ service.name }}</TableData>
                            <TableData>
                                <textarea readonly class="form-control">{{ service.description }}</textarea>
                            </TableData>

                            <TableData>
                                <div class=" flex space-x-2">
                                    <VPrimaryButton @click.prevent="editModal(service)">
                                        <i class="fas fa-edit"></i>
                                    </VPrimaryButton>

                                    <VDangerButton @click.prevent="destroy(service)">
                                        <i class="fas fa-trash-alt"></i>
                                    </VDangerButton>
                                </div>
                            </TableData>
                        </TableRow>
                    </Table>

                    <div class="m-2 p-2">
                        <Pagination :data="services" />
                    </div>

                </div>

            </div>
            <!-- /product list -->
        </div>
    </AdminLayout>
</template>

<style scoped>
.demo-service-block {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.demo-service-block .demonstration {
    margin-right: 16px;
}
</style>
