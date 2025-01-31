<script setup>
import { Checkbox } from "@/Components/Admin/Form";
// import { useFileManager } from "@/admin/stores";
// const fileManger = useFileManager();

const emit = defineEmits(['toggleSelection']);
const props = defineProps({
    data: {
        type: Object
    },
    selectAll:
    {
        type: Boolean,
        default: false
    }

})

function bytesToKB(bytes) {
    return (bytes / 1024).toFixed(1);
}

const toggleSelection = () => {
    emit('toggleSelection', props.data)
}
</script>


<template>
    <div class="dropzone__item dropzone--has-thumbnail dropzone--has-error dropzone__item--style">
        <div class="dropzone__item-thumbnail">
            <!-- <slot /> -->
            <img :src="'/' + data.file_name">
        </div>

        <!-- <div class="dropzone__item-controls" @click="fileRemove">
            <div class="dropzone__item-control">
                <i class="fa fa-trash-alt"></i>

            </div>
        </div> -->

        <div class="dropzone__item-controls">
            <div class="dropzone__item-control">
                <!-- <i class="fa fa-trash-alt"></i>  -->
                <Checkbox>
                    <input type="checkbox" :checked="selectAll" @change="toggleSelection()" />
                </Checkbox>
            </div>
        </div>

        <div class="dropzone__details dropzone__details--style">
            <div class="dropzone__file-size">
                <span>
                    <strong>{{ bytesToKB(data?.file_size) }} </strong> KB</span>
            </div>
            <div class="dropzone__filename">
                <span>{{ data?.file_original_name }}</span>

            </div>
        </div>
    </div>
</template>


<style scoped>
.dropzone__item-controls {
    top: -7px !important;
    right: -14px !important;
}
</style>
