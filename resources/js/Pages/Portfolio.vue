<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Portfolio" />
    <WebsiteLayout>
        <!-- page -->
        <template #page>
            <!-- ====== Portfolio Part ====== -->
            <section class="portfolio" data-aos="fade-in">
                <div class="container">
                    <!-- page heading -->
                    <div class="page-header w-100 d-flex flex-column justify-content-center align-items-center">
                        <h2 class="page-title">Our Portfolio</h2>
                        <div aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <Link href="/">Home</Link>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Portfolio
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- portfolio filter button -->
                    <div
                        class="portfolio-filter d-flex flex-wrap gap-2 gap-md-3 justify-content-center align-items-center mb-5">
                        <button class="portfolio-filter-btn" data-filter="all">All</button>
                        <button class="portfolio-filter-btn" data-filter=".logo-design">
                            Logo Design
                        </button>
                        <button class="portfolio-filter-btn" data-filter=".logo-with-branding">
                            Complete Branding
                        </button>
                        <button class="portfolio-filter-btn" data-filter=".social">
                            Social Media Design
                        </button>
                        <button class="portfolio-filter-btn" data-filter=".ui-ux">
                            UI/UX Design
                        </button>
                    </div>
                    <!-- portfolio main -->
                    <div class="row g-3 g-sm-4 filtered-portfolio">
                        <div class="col-6 col-md-4 mix logo-design ui-ux">
                            <div class="portfolio-image-wrapper" data-aos="fade-up" data-aos-delay="100">
                                <img class="portfolio-image img-fluid" src="images/portfolio1.jpg"
                                    alt="Portfolio Image" />
                                <div class="portfolio-image-overlay d-flex justify-content-center align-items-center">
                                    <a href="images/portfolio1.jpg" class="glightbox">View <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mix logo-design">
                            <div class="portfolio-image-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <img class="portfolio-image img-fluid" src="images/portfolio2.jpg"
                                    alt="Portfolio Image" />
                                <div class="portfolio-image-overlay d-flex justify-content-center align-items-center">
                                    <a href="images/portfolio1.jpg" class="glightbox">View <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mix logo-with-branding">
                            <div class="portfolio-image-wrapper" data-aos="fade-up" data-aos-delay="300">
                                <img class="portfolio-image img-fluid" src="images/portfolio3.jpg"
                                    alt="Portfolio Image" />
                                <div class="portfolio-image-overlay d-flex justify-content-center align-items-center">
                                    <a href="images/portfolio1.jpg" class="glightbox">View <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mix social ui-ux">
                            <div class="portfolio-image-wrapper" data-aos="fade-up" data-aos-delay="100">
                                <img class="portfolio-image img-fluid" src="images/portfolio4.jpg"
                                    alt="Portfolio Image" />
                                <div class="portfolio-image-overlay d-flex justify-content-center align-items-center">
                                    <a href="images/portfolio1.jpg" class="glightbox">View <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mix logo-with-branding">
                            <div class="portfolio-image-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <img class="portfolio-image img-fluid" src="images/portfolio5.jpg"
                                    alt="Portfolio Image" />
                                <div class="portfolio-image-overlay d-flex justify-content-center align-items-center">
                                    <a href="images/portfolio1.jpg" class="glightbox">View <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 mix social">
                            <div class="portfolio-image-wrapper" data-aos="fade-up" data-aos-delay="300">
                                <img class="portfolio-image img-fluid" src="images/portfolio6.jpg"
                                    alt="Portfolio Image" />
                                <div class="portfolio-image-overlay d-flex justify-content-center align-items-center">
                                    <a href="images/portfolio1.jpg" class="glightbox">View <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- load more data -->
                    <div class="text-center">
                        <button class="btn btn-primary mt-3">Load More</button>
                    </div>
                    <!-- load more data -->
                </div>
            </section>
            <!-- ====== Portfolio Part End ====== -->
        </template>
    </WebsiteLayout>
</template>
