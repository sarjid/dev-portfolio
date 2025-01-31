<template>
    <input class="px-8 py-2 w-full md:w-2/6 rounded-md bg-gray-50 border-transparent focus:border-gray-500
        focus:bg-gray-100 focus:ring-0 text-sm" :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)" v-bind="$attrs" />
</template>





<script setup>
defineEmits(["update:modelValue"]);
const props = defineProps({
    modelValue: {
        type: String,
        default: "",
    }
});
</script>
