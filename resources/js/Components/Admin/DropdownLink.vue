<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["href", "icon", "active"]);
const classes = computed(() => (props.active ? "active" : ""));
</script>
<template>
    <li class="bg-slate-100">
        <Link :href="href" :class="classes">
        <!-- <img :src="iconImg" v-show="iconImg" alt="icon-img" /> -->
        <!-- <FIcon icon="fa solid fa-times"  /> */ -->
        <!-- <FIcon :icon="icon" /> -->
        <i :class="icon"></i>
        <span>
            <slot />
        </span>
        </Link>
    </li>
</template>
