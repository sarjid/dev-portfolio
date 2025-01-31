<template>
    <button :type="type" class="btn btn-danger" v-bind="$attrs">
        <slot />
    </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>

