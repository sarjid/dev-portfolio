<script setup>
const emit = defineEmits(['remove']);
const props = defineProps({
    data: {
        type: Object,
        default: ''
    },

})

const fileRemove = async () => {
    emit('remove', props.data?.id)
}


function bytesToKB(bytes) {
    return (bytes / 1024).toFixed(1);
}
</script>


<template>
    <div class="dropzone__item dropzone--has-thumbnail dropzone--has-error dropzone__item--style" v-if="data">
        <div class="dropzone__item-thumbnail">
            <!-- <slot /> -->
            <!-- <img :src="'/' + data.file_name"> -->
            <img :src="$filters.makeImagePath(data?.id ? data?.file_name : data)">
        </div>

        <div class="dropzone__item-controls" @click="fileRemove">
            <div class="dropzone__item-control">
                <i class="fa fa-trash-alt"></i>
            </div>
        </div>

        <div class="dropzone__details dropzone__details--style" v-if="data?.id">
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
