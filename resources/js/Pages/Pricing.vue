<script setup>
import { Head } from '@inertiajs/vue3';
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import PageHeader from "@/Components/Admin/Card/PageHeader.vue";
import PricingPlan from "@/Components/Admin/Card/PricingPlan.vue";
const props = defineProps({
    service: Object
});

</script>

<template>

    <Head :title="service?.name" />
    <WebsiteLayout>
        <!-- page -->
        <template #page>
            <!-- ====== Pricing Part ====== -->
            <section class="pricing" data-aos="fade-in">
                <div class="container">
                    <!-- page heading -->
                    <PageHeader :title="service?.name" />
                    <!-- pricing main -->
                    <div class="row justify-content-center gy-4 gx-5">
                        <PricingPlan v-for="(pricing, index) in service?.pricings" :key="index" :type="pricing?.type"
                            :price="$filters.currencySymbol(pricing?.price)"
                            :href="route('billing.page', pricing.slug)">
                            <li class="pricing-item-list" v-for="(item, index) in pricing?.items" :key="index">
                                {{ item }}
                            </li>
                        </PricingPlan>
                    </div>
                    <!-- recent works -->
                    <div class="recent-works text-center">
                        <h3 class="recent-works-title">Our Recent Works</h3>
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="row g-2">
                                    <div class="col-6 col-sm-3" data-aos="fade-up">
                                        <div class="recent-works-item w-100">
                                            <a class="glightbox w-100" href="images/portfolio1.jpg"><img
                                                    src="images/portfolio1.jpg" alt="" /></a>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3" data-aos="fade-up" data-aos-delay="100">
                                        <div class="recent-works-item">
                                            <a class="glightbox w-100" href="images/portfolio4.jpg"><img
                                                    src="images/portfolio4.jpg" alt="" /></a>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3" data-aos="fade-up" data-aos-delay="200">
                                        <div class="recent-works-item">
                                            <a class="glightbox w-100" href="images/portfolio2.jpg"><img
                                                    src="images/portfolio2.jpg" alt="" /></a>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-3" data-aos="fade-up" data-aos-delay="300">
                                        <div class="recent-works-item">
                                            <a class="glightbox w-100" href="images/portfolio3.jpg"><img
                                                    src="images/portfolio3.jpg" alt="" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ====== Pricing Part End ====== -->
        </template>
    </WebsiteLayout>
</template>
