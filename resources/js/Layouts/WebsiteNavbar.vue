<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3';
const page = usePage()
const mainLogo = computed(() => {
    // return page.props?.settings.filter(setting => setting.key === 'logo');
    const logoSetting = page.props?.settings.find(setting => setting.key === 'logo');
    return logoSetting ? logoSetting.value : null;
})

const blackLogo = computed(() => {
    const logoSetting = page.props?.settings.find(setting => setting.key === 'logo_black');
    return logoSetting ? logoSetting.value : null;
})
</script>

<template>


    <nav class="navbar navbar-expand-xl">
        <div class="container gx-lg-0">
            <!-- Navbar Logo -->
            <Link class="navbar-brand pe-sm-2 order-1" href="/">
            <img :src="mainLogo" alt="main-logo" />
            </Link>

            <button class="navbar-toggler order-3" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>

            <!-- Offcanvas -->
            <div class="offcanvas offcanvas-nav offcanvas-start order-2" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header offcanvas-nav-header">
                    <img :src="blackLogo" alt="Black-Logo" />
                    <i data-bs-dismiss="offcanvas" aria-label="Close" class="bi bi-x"></i>
                </div>
                <div class="offcanvas-body offcanvas-nav-body">
                    <!-- Nav Links -->
                    <ul class="navbar-nav gap-1 justify-content-start flex-grow-1">
                        <li class="nav-item">
                            <Link class="nav-link " :class="{ 'active': $page.url === '/' }" href="/">
                            Home</Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('service.page')" class="nav-link"
                                :class="{ 'active': $page.url === '/services' }">Service</Link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"
                                :class="{ 'active': $page.url.startsWith('/pricing') }">Pricing</a>
                            <ul class="drop-menu">
                                <li v-for="(service, index) in $page.props?.services" :key="index">
                                    <Link class="drop-link" :href="route('pricing.page', service.slug)">{{ service?.name
                                    }}</Link>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('portfolio.page')" class="nav-link"
                                :class="{ 'active': $page.url === '/portfolio' }">Portfolio
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('team.page')" class="nav-link"
                                :class="{ 'active': $page.url === '/team' }">
                            Our Team</Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('contact.page')" class="nav-link"
                                :class="{ 'active': $page.url === '/contact' }">Contact</Link>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Nav Buttons -->
            <div
                class="d-flex justify-content-end ms-auto align-items-center gap-3 gap-lg-4 pe-3 pe-xl-0 order-2 order-xl-3">
                <button class="cart-btn">
                    <i class="bi bi-bag-dash"></i><span>0</span>
                </button>
                <button class="search-btn ms-1">
                    <i class="bi bi-search"></i>
                </button>
                <Link :href="route('contact.page')" class="quote-btn d-none d-xl-block">Get a Quote</Link>
            </div>
        </div>
    </nav>
</template>
