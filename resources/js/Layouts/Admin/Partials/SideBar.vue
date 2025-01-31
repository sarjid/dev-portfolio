<template>
    <!-- Sidebar scrollbar using Vue3 Perfect Scroll package  -->
    <PerfectScrollbar class="scroll-area" :settings="settings" @ps-scroll-y="scrollHanle" ref="scrollbar">
        <div class="sidebar-inner">
            <div id="sidebar-menu" class="sidebar-menu mb-6">
                <ul>
                    <DropdownLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')"
                        icon="fa solid fa-home">
                        Dashboard
                    </DropdownLink>

                    <DropdownLink :href="route('admin.hero.index')" :active="route().current('admin.hero*')"
                        icon="fa solid fa-home">
                        Hero Section
                    </DropdownLink>

                    <DropdownLink :href="route('admin.service.index')" :active="route().current('admin.service*')"
                        icon="fa solid fa-home">
                        Our Services
                    </DropdownLink>

                    <DropdownLink :href="route('admin.pricing.index')" :active="route().current('admin.pricing*')"
                        icon="fa solid fa-home">
                        Pricing Plan
                    </DropdownLink>

                    <DropdownLink :href="route('admin.portfolio.index')" :active="route().current('admin.portfolio*')"
                        icon="fa solid fa-home">
                        Portfolio Section
                    </DropdownLink>

                    <DropdownLink :href="route('admin.team.index')" :active="route().current('admin.team*')"
                        icon="fa solid fa-home">
                        Our Team
                    </DropdownLink>

                    <DropdownLink :href="route('admin.review.index')" :active="route().current('admin.review*')"
                        icon="fa solid fa-home">
                        Client Review
                    </DropdownLink>

                    <DropdownLink :href="route('admin.system.settings')"
                        :active="route().current('admin.system.settings')" icon="fa solid fa-cog">
                        App & Web Settings
                    </DropdownLink>
                </ul>
            </div>
        </div>
    </PerfectScrollbar>
</template>

<script setup>
import { ref } from "vue";

import DropdownLink from "@/Components/Admin/DropdownLink.vue";
import SidebarDropdown from "@/Components/Admin/SidebarDropdown.vue";
import { PerfectScrollbar } from "vue3-perfect-scrollbar";

const settings = ref({
    suppressScrollX: true,
});

const scrollHanle = (event) => {
    //   console.log(event);
};
</script>

<style src="vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css" />
<style>
.scroll-area {
    position: right;
    margin: auto;
    height: calc(100vh - 30px);
    width: 100%;
    size: 7px;
    color: #ccc;
}

.ps__rail-y:hover>.ps__thumb-y,
.ps__rail-y:focus>.ps__thumb-y,
.ps__rail-y.ps--clicking .ps__thumb-y {
    background-color: #7b00b6;
    width: 11px;
}
</style>
