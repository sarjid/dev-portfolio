<template>
    <li class="submenu">
        <a href="javascript:void(0);" class="active" :class="{ subdrop: sidebar }" @click="toggleBtn('sidebar')">
            <!-- <img :src="iconImg" alt="icon-img" /> -->
            <span> {{ title }}</span>
            <span class="menu-arrow"></span></a>

        <Transition name="committee" mode="out-in" appear>
            <ul class="block" v-if="sidebar">
                <slot></slot>
            </ul>
        </Transition>
    </li>

    <!-- your can use like this, where you need to create it  -->
    <!-- <SidebarDropdown
        title="Product List"
        iconImg="/assets/img/icons/product.svg"
    >
        <DropdownLink
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            Products Lists
        </DropdownLink>

        <li>
            <a href="productlist.html">Product List</a>
        </li>
        <li>
            <a href="addproduct.html" class="active">Add Product</a>
        </li>
    </SidebarDropdown> -->
</template>

<script setup>
import { computed } from "vue";
import useStatus from "@/Composables/status";
const props = defineProps({
    title: {
        type: String,
        default: "Sidebar Name",
    },

    iconImg: {
        type: String,
        default: "/assets/img/icons/dashboard.svg",
    },
});

const { sidebar, toggleBtn } = useStatus();

const classes = computed(() => ({
    block: sidebar.value,
    hidden: !sidebar.value,
}));
</script>

<style>
.fade-in-enter-active {
    transition: all 0.5s ease;
}

.fade-in-leave-active {
    transition: all 0.5s ease;
}

.fade-in-enter,
.fade-in-leave-to {
    position: absolute;
    /* add for smooth transition between elements */
    opacity: 0;
}

.committee-enter-from {
    opacity: 0;
    transform: translateX(-3rem);
}

.committee-enter-active {
    transition: all 0.5s ease-in;
}

.committee-enter-to {
    opacity: 1;
    transform: translateX(0);
}

.committee-leave-active {
    transition: all 0.5s ease-in;
}

.committee-leave-to {
    opacity: 1;
    transform: translateX(0);
}
</style>
