<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps(["href"]);
</script>

<template>
    <Link :href="href" class="btn btn-added btn-primary" v-bind="$attrs">
    <slot />
    </Link>
</template>

<style>
/* .page-header .btn-added {
    border-radius: 50px;
} */

.btn {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}
</style>
