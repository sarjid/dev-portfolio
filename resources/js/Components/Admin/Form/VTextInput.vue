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
        <div class="border rounded-lg flex border-x-4" :class="{
        'border-themePrimary': !meta.touched,
        'border-green-600': meta.valid && meta.touched,
        'border-red-600': !meta.valid && meta.touched,
    }">
            <input class="form-control border-none rounded-r-none p-2"
                @input="$emit('update:modelValue', $event.target.value)" v-bind="{ ...$attrs, ...field }"
                :value="modelValue" />

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
                <!-- <svg
                    v-show="
                        (meta.valid && meta.touched) ||
                        (!meta.valid && meta.touched)
                    "
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    class="stroke-current text-green-600 inline-block h-6 w-6"
                    :class="{
                        'text-green-600': meta.valid && meta.touched,
                        'text-red-600': !meta.valid && meta.touched,
                    }"
                >
                    <path
                        v-if="meta.valid && meta.touched"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />

                    <path
                        v-else
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg> -->
            </div>
        </div>

        <p class="text-red-600 text-sm" v-show="errors">{{ errors[0] }}</p>
    </Field>
</template>
