<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import TeamCard from "@/Components/Admin/Card/TeamCard.vue";
import { Head, Link } from '@inertiajs/vue3';
import { ref } from "vue";
import { Pagination, Autoplay } from 'swiper/modules';
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";
const modules = ref([Pagination, Autoplay]);
defineProps({
    teams: Object
})
</script>

<template>

    <Head title="Team" />
    <WebsiteLayout>
        <!-- page -->
        <template #page>
            <!-- ====== Team Part ====== -->
            <section class="team" data-aos="fade-in">
                <div class="container">
                    <!-- page heading -->
                    <div class="page-header w-100 d-flex flex-column justify-content-center align-items-center">
                        <h2 class="page-title">Our Team</h2>
                        <div aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <Link href="/">Home</Link>

                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Team</li>
                            </ol>
                        </div>
                    </div>
                    <!-- Team Slide -->

                    <div class="team-slider-wrapper text-center" data-aos="fade-up">
                        <swiper :spaceBetween="30" :pagination="{
                            clickable: true,
                        }" :loop="true" :autoplay="{
                            delay: 2000,
                        }" :modules="modules" class="mySwiper">

                            <swiper-slide v-for="(team, index) in teams" :key="index">
                                <div class="swiper-slide team-slide">
                                    <p class="team-slide-text mx-auto">
                                        {{ team.description }}
                                    </p>
                                    <img :src="team.image" alt="Team-Image" />
                                    <h5 class="team-slide-name">{{ team.name }}</h5>
                                    <p class="team-slide-title">{{ team.title }}</p>
                                </div>
                            </swiper-slide>

                        </swiper>
                    </div>

                    <!-- Team Member -->
                    <div class="row justify-content-center gy-4 gx-3 gx-sm-4">

                        <TeamCard v-for="(team, index) in teams" :key="index" :name="team.name" :title="team.title"
                            :description="team.description" :image="team.image">
                            <a v-for="(social, index) in team.social_links" :key="index" :href="social.url"
                                :title="social.name" target="_blank">
                                <i :class="social.icon"></i>
                            </a>
                        </TeamCard>
                    </div>
                </div>
            </section>
            <!-- ====== Team Part End ====== -->
        </template>
    </WebsiteLayout>
</template>
