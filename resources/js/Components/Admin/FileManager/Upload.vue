<script setup>
import { ref } from "vue";
import { useFileManagerStore } from "@/stores";
const fileManger = useFileManagerStore();
const token = document.head.querySelector('meta[name="csrf-token"]').content
const uploadUrl = ref(`${import.meta.env.VITE_SENTRY_DSN_PUBLIC}/filemanager/upload`);
</script>

<template>
    <DropZone ref="dropzone" :maxFiles="Number(10000000000)" :url="uploadUrl" :uploadOnDrop="true" :multipleUpload="true"
        :parallelUpload="1" :headers="{ 'X-CSRF-TOKEN': token }"
        :acceptedFiles="['png', 'image', 'jpg', 'jpeg', 'gif', 'ttif', 'webp']" @removedFile="fileManger.onFileRemove" />
</template>

