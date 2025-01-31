<script setup>
import { Upload, FileItem } from "@/Components/Admin/FileManager";
import { useFileManagerStore } from "@/stores";
const fileManger = useFileManagerStore();
import { ref, onMounted } from 'vue';

const emit = defineEmits(["close"]);
const closeModal = () => {
    emit("close");
};
const props = defineProps({
    visible: {
        type: Boolean,
        default: false,
    },

    imgs: {
        type: Function
    }
});
const uplodMode = ref(false);
const toggleMode = () => {
    uplodMode.value = !uplodMode.value;
    if (!uplodMode.value) {
        fetchFiles();
    }
}
onMounted(() => {
    fetchFiles();
})


const fetchFiles = async (page = 1) => {
    await fileManger.index(page);
}

// const fetchFiles = (page) => {
//     console.log('page count', page);
// }

const selectedImg = ref([]);
const selectAll = ref(false);
const toggleSelection = (data) => {
    const index = selectedImg.value.findIndex((i) => i.id === data.id);
    if (index === -1) {
        selectedImg.value.push(data);
    } else {
        selectedImg.value.splice(index, 1);
    }

};

const clearSelection = () => {
    selectedImg.value = [];
    selectAll.value = false;
}

const addFiles = () => {
    props.imgs(selectedImg.value);
    closeModal();
}
</script>


<template>
    <Transition name="fade">
        <div class="fixed z-10 inset-0 overflow-y-auto" v-show="visible">
            <div
                class="mt-20 flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <!-- Overlay Background -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal Content -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">

                    <!-- Modal Header -->
                    <div class="bg-themePrimary px-4 py-2">
                        <div class="uppy-modal-nav">
                            <ul class="flex ">
                                <li class="mr-6">
                                    <a @click.prevent="toggleMode" href="javascript::void(0)"
                                        class="font-medium text-slate-100 py-2 px-4 inline-block border-b-2 border-transparent hover:border-gray-300 hover:text-gray-200">
                                        Select File
                                    </a>
                                </li>
                                <li>
                                    <a @click.prevent="toggleMode" href="javascript::void(0)"
                                        class="font-medium text-slate-100 py-2 px-4 inline-block border-b-2 border-transparent hover:border-gray-300 hover:text-gray-200">
                                        Upload New
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="absolute top-0 right-0 pt-2 pr-4">
                            <button type="button" class="text-gray-100 hover:text-gray-200 focus:outline-none"
                                @click.prevent="closeModal">
                                <i class="fas fa-times" style="font-size: 30px;"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="relative px-4 py-4 overflow-y-auto h-80 sm:px-6 sm:py-6 ">
                        <template v-if="uplodMode">
                            <Upload />
                        </template>

                        <template v-else>
                            <div v-if="fileManger?.getItems?.data?.length">
                                <!-- /image list -->
                                <FileItem v-for="(file, index) in fileManger?.getItems?.data" :key="index" :data="file"
                                    @toggleSelection="toggleSelection" :selectAll="selectAll" />
                                <!-- /image list -->
                                <div class="m-2 p-2">
                                    <!-- <Pagination :links="fileManger?.getItems?.links" /> -->
                                </div>
                            </div>

                            <div v-else>
                                <h5 class="text-center">
                                    There are no files found.. !
                                </h5>
                            </div>
                            <!-- <div class="sm:grid sm:grid-cols-2 lg:grid-cols-5 gap-x-6">
                                <div class="flex  " v-for="(file, index) in fileManger?.getItems?.data" :key="index"
                                    :data="file">
                                    <div class="productset flex-auto border border-x-emerald-300">
                                        <div class="productsetimg">
                                            <img :src="'/' + file.file_name" alt="img">
                                            <div class="check-product">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="productsetcontent">
                                            <h5>{{ file?.file_original_name }}</h5>
                                            <h4>Apple</h4>
                                        </div>
                                    </div>
                                </div>

                            </div> -->
                        </template>
                    </div>

                    <!-- Modal Footer -->
                    <div class="bg-gray-100 px-4 py-3 sm:px-6 flex justify-between" v-if="!uplodMode">
                        <div class=" overflow-hidden flex">
                            <div>
                                <div class="aiz-uploader-selected">
                                    {{ selectedImg?.length }} File selected
                                </div>
                                <!-- <button type="button" class="btn-link btn btn-sm p-0" @click="clearSelection">
                                    Clear
                                </button> -->
                            </div>
                            <div class="mb-0 ml-3">
                                <button :disabled="fileManger?.getItems?.prev_page_url == null ? true : false"
                                    @click="fetchFiles(fileManger?.getItems?.current_page - 1)" type="button"
                                    class="btn btn-sm btn-primary mr-2">
                                    Prev
                                </button>
                                <button :disabled="fileManger?.getItems?.next_page_url == null ? true : false"
                                    @click="fetchFiles(fileManger?.getItems?.current_page + 1)" type="button"
                                    class="btn btn-sm btn-primary">
                                    Next
                                </button>
                            </div>
                        </div>
                        <span>
                            <button type="button" class="btn btn-primary"
                                :disabled="selectedImg.length == 0 ? true : false" @click.prevent="addFiles">
                                Add Files
                            </button>
                        </span>

                    </div>
                </div>
            </div>
        </div>

    </Transition>
</template>

<style scoped>
.dropzone__item--style {
    padding: 0 !important;
}
</style>
