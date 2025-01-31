<script setup>
import { Field } from "vee-validate";
const props = defineProps({
    modelValue: {
        default: null,
        required: false,
        type: String,
    },

    name: {
        type: String,
        default: "",
    },
});

defineEmits(["update:modelValue"]);
</script>

<template>
    <!-- <select
        :value="modelValue"
        class="select form-control border rounded-lg flex border-x-4 border-themePrimary"
        @input="$emit('update:modelValue', $event.target.value)"
        v-bind="$attrs"
    >
        <option value="" selected disabled>Select Option</option>
        <slot />
    </select> -->
    <Field :name="name" v-slot="{ field, meta, errors }">
        <div class="border rounded-lg flex border-x-4" :class="{
        'border-themePrimary': !meta.touched,
        'border-green-600': meta.valid && meta.touched,
        'border-red-600': !meta.valid && meta.touched,
    }">
            <select class="form-control border-none rounded-r-none p-2"
                @input="$emit('update:modelValue', $event.target.value)" v-bind="{ ...$attrs, ...field }"
                :value="modelValue">
                <option value="" selected disabled>Select Option</option>
                <slot />
            </select>

            <div class="flex items-center pr-2">
                <FIcon v-show="(meta.valid && meta.touched) ||
        (!meta.valid && meta.touched)
        " :icon="meta.valid && meta.touched
        ? 'fa solid fa-circle-check'
        : 'fa solid  fa-times-circle'
        " class="stroke-current text-green-600 inline-block h-6 w-6" :class="{
        'text-green-600': meta.valid && meta.touched,
        'text-red-600': !meta.valid && meta.touched,
    }" />
            </div>
        </div>
        <p class="text-red-600 text-sm" v-show="errors">{{ errors[0] }}</p>
    </Field>
</template>
