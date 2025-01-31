<script setup>

import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, computed, reactive, watch, nextTick, onMounted } from "vue";
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
    teams: Object,
    filters: Object,
});
const teamFilters = reactive({
    search: props.filters.search,
    perPage: props.filters.perPage ? props.filters.perPage : 8,

});

// intialize form
onMounted(() => {
    form.data.name = "";
    form.data.title = "";
    form.data.image = "";
    form.data.description = "";
    form.data.social_links = [];
})

watch(
    teamFilters,
    throttle(() => {
        let query = pickBy(teamFilters);
        let queryRoute = route(
            "admin.team.index",
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
    router.delete(route("admin.team.destroy", id), {
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
        selectedData.value = props.teams?.data.map(data => data.id);
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
    router.delete(route("admin.team.multiple.destroy", { ids: selectedData.value }), {
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
    // selectedSocialLinks.value
    data.social_links.find(social => {
        // return form.data.selectedSocialLinks.push([social.name]);
    });

}

const submitForm = () => {
    const submitF = useForm(form.data);
    if (editMode.value) {
        submitF.put(route('admin.team.update', form.data?.id), {
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

        submitF.post(route('admin.team.store'), {
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

    // const teamstore = router.post(route('admin.team.store', teamForm), {
    // router.post(route('admin.team.store', form.data), {
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

const inputValue = ref('')
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




const socialLinks = ref([
    {
        name: "Facebook",
        icon: "bx bxl-facebook"
    },
    {
        name: "Twitter",

        icon: "bx bxl-twitter"
    },
    {
        name: "Instagram",
        icon: "bx bxl-instagram"
    },
    {
        name: "LinkedIn",
        icon: "bx bxl-linkedin"
    },

    {
        name: "Behance",
        icon: "bx bxl-behance"
    },
    {
        name: "YouTube",
        icon: "bx bxl-youtube"
    },
    {
        name: "Pinterest",
        icon: "bx bxl-pinterest"
    }
]);


const selectedSocialLinks = ref([]);
const handleSocialLinkChange = () => {
    // Ensure that form.data.social_links is initialized
    if (!form.data.social_links) {
        form.data.social_links = [];
    }

    // Filter out the selected social links from the available list
    // Filter out the selected social links from the available list

    form.data.social_links = form.data?.selectedSocialLinks?.map(name => {
        const existingLink = form.data.social_links.find(link => link.name === name);
        if (existingLink) {
            return existingLink;
        } else {
            const socialLink = socialLinks.value.find(link => link.name === name);
            return { name: socialLink.name, url: '', icon: socialLink.icon };
        }
    });
};

watch(form.data?.selectedSocialLinks, handleSocialLinkChange, { immediate: true });
const showPreview = computed(() => {
    // return form.data?.image ? URL.createObjectURL(form.data?.image) : null;
});
</script>

<template>

    <Head title="Team" />

    <AdminLayout>
        <div class="content">
            <Modal :visible="modalVisible" @close="closeFormModal()">
                <template #content>
                    <!-- {{ form.data }} -->
                    <form class="space-y-2" @submit.prevent="submitForm()">
                        <div class="form-group">
                            <PlainTextInput v-model="form.data.name" id="type" type="text" name="name"
                                placeholder="team member name" />
                            <InputError :message="form.errors?.name" />
                        </div>

                        <div class="form-group">
                            <PlainTextInput v-model="form.data.title" id="type" type="text" name="title"
                                placeholder="example: CEO and Founder" />
                            <InputError :message="form.errors?.title" />
                        </div>

                        <div class="form-group">
                            <input @input="(form.data.image = $event.target.files[0])" type="file" class="form-control">
                            <img :src="$filters.makeImagePath(form.data.image)" class="w-20" alt="img"> <br />
                            <small>w-570px * h-696px</small>
                            <InputError :message="form.errors?.image" />
                        </div>

                        <div class="form-group">
                            <textarea v-model="form.data.description" class="form-control"
                                placeholder="description"></textarea>
                            <InputError :message="form.errors?.description" />
                        </div>

                        <div class="form-group">
                            <el-select v-model="form.data.selectedSocialLinks" multiple placeholder="Select Social"
                                class="form-control" @change="handleSocialLinkChange">
                                <el-option v-for="(item, index) in socialLinks" :key="index" :label="item.name"
                                    :value="item.name" />
                            </el-select>
                        </div>
                        <template v-if="form.data?.social_links">
                            <div class="form-group" v-for="(selsocial, index) in form.data?.social_links" :key="index">
                                <PlainTextInput v-model="form.data.social_links[index].url" id="type" type="text"
                                    name="price" :placeholder="`${selsocial.name} links`" />
                                <InputError :message="form.errors?.price" />
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
                                <PlainTextInput v-model="teamFilters.search" />

                            </div>
                        </div>
                        <div class="flex">
                            <select v-model="teamFilters.perPage" @change="
                teamFilters.perPage ===
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
                            <TableHead>Title</TableHead>
                            <TableHead>Image</TableHead>
                            <TableHead>Description</TableHead>
                            <TableHead>Manage</TableHead>
                        </template>
                        <TableRow v-for="team in teams.data" :key="team.id">
                            <TableData>
                                <Checkbox>
                                    <input type="checkbox" :checked="selectAll" @change="toggleSelection(team)" />
                                </Checkbox>
                            </TableData>
                            <TableData>{{ team.name }}</TableData>
                            <TableData>{{ team.title }}</TableData>
                            <TableData>
                                <img :src="$filters.makeImagePath(team.image)" class="w-12 h-12" alt="img">
                            </TableData>
                            <TableData>
                                <textarea class="form-control" readonly>{{ team.description }}</textarea>
                            </TableData>

                            <TableData>
                                <div class=" flex space-x-2">
                                    <VPrimaryButton @click.prevent="editModal(team)">
                                        <i class="fas fa-edit"></i>
                                    </VPrimaryButton>

                                    <VDangerButton @click.prevent="destroy(team)">
                                        <i class="fas fa-trash-alt"></i>
                                    </VDangerButton>
                                </div>
                            </TableData>
                        </TableRow>
                    </Table>

                    <div class="m-2 p-2">
                        <Pagination :data="teams" />
                    </div>

                </div>

            </div>
            <!-- /product list -->
        </div>
    </AdminLayout>
</template>

<style scoped>
.demo-team-block {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.demo-team-block .demonstration {
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
