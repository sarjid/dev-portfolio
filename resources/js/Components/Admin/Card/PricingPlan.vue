<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    href: String,
    type: String,
    price: String, Number
})
</script>

<template>
    <div class="col-sm-6 col-md-4 col-xl-3 d-flex justify-content-center" data-aos="fade-up">
        <div class="pricing-item text-center">
            <h4 class="pricing-item-title">{{ type }}</h4>
            <span class="pricing-item-price">{{ price }}</span><br />
            <!-- <span class="pricing-item-time">Per month</span> -->
            <div class="hr mt-4"></div>
            <ul class="text-start ps-2 mb-3 d-flex flex-column gap-2">
                <slot />
            </ul>
            <Link :href="href" class="pricing-item-btn">Get Now</Link>
        </div>
    </div>
</template>
