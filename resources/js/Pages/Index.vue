<script setup>
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";
import ServiceCard from "@/Components/Admin/Card/ServiceCard.vue";
import ContactPageProtion from "@/Components/Website/ContactPageProtion.vue";
import TeamCard from "@/Components/Admin/Card/TeamCard.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import { Pagination, Autoplay } from "swiper/modules";
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";
const modules = ref([Pagination, Autoplay]);

const props = defineProps({
  hero: Object,
  services: Object,
  teams: Object,
  reviews: Object,
});
</script>

<template>
  <Head title="Home" />
  <WebsiteLayout> </WebsiteLayout>
</template>
