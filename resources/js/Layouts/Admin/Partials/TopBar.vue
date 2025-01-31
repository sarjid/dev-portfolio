<template>
    <ul class="nav user-menu">

        <li class="nav-item">
            <a class="nav-link" @click="reloadPage()" title="refresh site">
                <i class="fa fa-refresh text-black"></i>
            </a>
        </li>

        <!-- <li class="nav-item">
            <Link class="btn btn-sm btn-primary nav-link" :href="route('pos.index')" title="pos">
            <i class="fa fa-cart "></i>
            <span class="text-white">POS</span>
            </Link>
        </li> -->

        <li class="nav-item">
            <a class=" nav-link" href="/" title="visit site" target="_blank">
                <i class="fa fa-globe "></i>
            </a>
        </li>

        <li class="nav-item">
            <Link :href="route('admin.system.settings')" class="nav-link nav-item-box" title="settings">
            <i class="fa fa-cog "></i>
            </Link>

        </li>

        <li class="nav-item dropdown has-arrow main-drop mt-1">
            <a href="javascript::void(0);" class="focus:bg-[#eeeeee] nav-link userset" @click="toggleBtn('profile')">
                <span class="user-img">
                    <!-- <img src="assets/img/profiles/avator1.jpg" alt="" /> -->
                    <i class="fa fa-user-circle mn_icon" />
                    <span class="status online"></span>
                </span>
            </a>

            <div class="dropdown-menu menu-drop-user !inset-auto !translate-y-0 !right-0 !top-[60px] bg-white"
                :class="{ block: profile, hidden: !profile }">
                <div class="profilename">
                    <div class="profileset">
                        <!--  -->
                        <div class="profilesets">
                            <h6>{{ user?.name }}</h6>
                            <h5>{{ user?.email }}</h5>
                        </div>
                    </div>
                    <hr class="!m-0" />
                    <Link class="dropdown-item" href="#">
                    <i class="fa fa-user-circle mr-2"></i> My
                    Profile</Link>

                    <Link class="dropdown-item" href="#"><i class="fa fa-cog mr-2"></i>Settings</Link>
                    <hr class="!m-0" />
                    <Link :href="route('admin.logout')" method="post" class="dropdown-item logout !pb-0">
                    <i class="fa fa-sign-out-alt mr-2" />
                    Logout</Link>
                </div>
            </div>
        </li>
    </ul>
</template>

<script setup>
import useStatus from "@/Composables/status";
import { Link, usePage } from "@inertiajs/vue3";
const { profile, toggleBtn } = useStatus();

const user = usePage().props.auth.user;
const reloadPage = () => (window.location.reload());


</script>

<style>
.mn_icon {
    font-size: 30px !important;
}
</style>
