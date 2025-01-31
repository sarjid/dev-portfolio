<script setup>
const handleError = (event) => {
    event.target.onerror = null;
    event.target.src = $filters.makeImagePath('frontend/brands/placeholder.jpg');
}
const props = defineProps({
    src: {
        type: String,
    }
})


</script>

<template>
    <img :src="$filters.makeImagePath(src)" v-bind="$attrs" />
</template>
