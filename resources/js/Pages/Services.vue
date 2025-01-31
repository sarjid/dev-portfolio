<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import ServiceCard from "@/Components/Admin/Card/ServiceCard.vue";
const props = defineProps({
    services: Object
})
</script>

<template>

    <Head title="Services" />
    <WebsiteLayout>
        <!-- page -->
        <template #page>
            <!-- ====== Service Part ====== -->
            <section class="service" data-aos="fade-in">
                <div class="container">
                    <!-- page heading -->
                    <div class="page-header w-100 d-flex flex-column justify-content-center align-items-center">
                        <h2 class="page-title">Our Service</h2>
                        <div aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <Link href="/">Home</Link>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Service
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- service main -->
                    <div class="row justify-content-center gy-4 gx-4">
                        <ServiceCard v-for="(service, index) in services" :key="index" :title="service.name"
                            :description="service.description" :href="route('pricing.page', service.slug)">
                            <i class="bi bi-droplet-fill"></i>
                        </ServiceCard>
                    </div>
                </div>
            </section>
            <!-- ====== Service Part End ====== -->
        </template>
    </WebsiteLayout>
</template>
