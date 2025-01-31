<template>
    <div>
        <!-- Main Wrapper -->
        <div class="main-wrapper" :class="{ 'slide-nav': status }">
            <!-- Header -->
            <div class="header">
                <!-- Logo -->
                <div class="header-left active">
                    <Link :href="route('admin.dashboard')" class="logo logo-normal">
                    <!-- <AdminLogo /> -->
                    <h3 class="text-themePrimary">Admin Panel</h3>
                    </Link>

                    <button @click.prevent="toggleBtn('collapse')" class="logo-small">
                        <i class="fa fa-angle-double-right mn_icon text-themePrimary" />
                    </button>

                    <!-- <a id="toggle_btn" href="javascript:void(0);" @click="toggleBtn('collapse')"></a> -->
                </div>
                <!-- /Logo -->
                <a class="mobile_btn menu-opened" @click="toggleBtn">
                    <i :class="iconChange" class="mn_icon" />
                </a>
                <TopBar />
                <MobileMenu />
            </div>

            <div class="sidebar">
                <SideBar />
            </div>

            <div class="page-wrapper">
                <slot />
            </div>
        </div>
        <!-- /Main Wrapper -->
    </div>
</template>

<script setup>
import { computed, onMounted } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";
import useStatus from "@/Composables/status";
import AdminLogo from "@/Components/Admin/AdminLogo.vue";
import SideBar from "@/Layouts/Admin/Partials/SideBar.vue";
import TopBar from "@/Layouts/Admin/Partials/TopBar.vue";
import MobileMenu from "@/Layouts/Admin/Partials/MobileMenu.vue";
const { status, toggleBtn, iconChange } = useStatus();
const toggleClick = () => { };

const page = usePage()
const faviconUrl = computed(() => {
    const favIconSetting = page.props?.settings.find(setting => setting.key === 'favicon');
    return favIconSetting ? favIconSetting.value : null;
})


const updateFavicon = () => {
    const link = document.getElementById('dynamic-favicon');
    if (link) {
        link.href = faviconUrl.value;
    }
}

onMounted(() => {
    updateFavicon();
})

</script>

<style>
.mn_icon {
    font-size: 32px;
}

@keyframes spinner {
    to {
        transform: rotate(360deg);
    }
}

.fa-spinner {
    animation: spinner 1s linear infinite;
}

:disabled {
    opacity: 0.8;
    cursor: not-allowed;
}
</style>
