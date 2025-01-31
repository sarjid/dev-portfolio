<script setup>
import { Field } from "vee-validate";
defineEmits(["update:modelValue"]);
const props = defineProps({
    modelValue: {
        type: String,
        default: "",
    },

    name: {
        type: String,
        default: "",
    },
});
</script>
<template>
    <Field :name="name" v-slot="{ field, meta, errors }">
        <textarea @input="$emit('update:modelValue', $event.target.value)" v-bind="{ ...$attrs, ...field }"
            :value="modelValue"
            :class="{ 'is-valid': meta.valid && meta.touched, 'is-invalid': !meta.valid && meta.touched }"></textarea>
        <p class="text-danger text-sm" v-show="errors">{{ errors[0] }}</p>

    </Field>
</template>
