<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import ContactPageProtion from "@/Components/Website/ContactPageProtion.vue";
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Contact Us" />
    <WebsiteLayout>
        <!-- page -->
        <template #page>
            <!-- ====== Contact Part ====== -->
            <section class="contact" data-aos="fade-in">
                <div class="container">
                    <!-- page heading -->
                    <div class="page-header w-100 d-flex flex-column justify-content-center align-items-center">
                        <h2 class="page-title">Contact Us</h2>
                        <div aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <Link href="/">Home</Link>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Contact
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- contact main -->
                    <ContactPageProtion />
                </div>
            </section>
            <!-- ====== Contact Part End ====== -->
        </template>
    </WebsiteLayout>
</template>
