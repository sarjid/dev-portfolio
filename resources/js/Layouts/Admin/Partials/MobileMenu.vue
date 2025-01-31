<template>
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link" @click="toggleBtn">
            <i class="fa fa-user-circle mn_icon" />
        </a>
        <div class="dropdown-menu dropdown-menu-right menu-style" :class="{ block: status, hidden: !status }">
            <!-- <Link class="dropdown-item" :href="route('profile.edit')">My Profile
            </Link>
            <Link class="dropdown-item" :href="route('profile.settings')">Settings</Link> -->
            <Link :href="route('admin.logout')" method="post" class="dropdown-item">
            Logout</Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import useStatus from "@/Composables/status";
const { status, toggleBtn } = useStatus();
</script>

<style scoped>
.menu-style {
    position: absolute;
    inset: 0px auto auto 0px;
    margin: 0px;
    transform: translate3d(-100px, 70px, 0px);
}
</style>
