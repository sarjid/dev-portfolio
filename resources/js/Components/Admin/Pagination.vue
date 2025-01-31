<template>
    <div class="flex flex-row flex-nowrap justify-between md:justify-center items-center">
        <strong>{{ data?.to }} of {{ data?.total }}</strong>
        <template v-for="(link, key) in data?.links" :key="key">
            <div v-if="link.url === null" v-html="link.label">
            </div>
            <Link :key="key" v-else :href="link.url" v-html="link.label"
                :class="{ 'flex w-8 h-8 mx-1 justify-center items-center rounded-full border border-themePrimary bg-themePrimary text-white pointer-events-none': link.active, 'flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-gray-200 bg-white text-black hover:border-gray-300': !link.active }" />
        </template>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    data: Array,
});

</script>
