<script setup>
import { onMounted, onBeforeUnmount, nextTick } from 'vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    href: String,
    type: String,
    price: String, Number
})



// const setCardHeights = () => {
//     nextTick(() => {
//         const cards = document.querySelectorAll('.service-item');
//         let maxHeight = 0;

//         // Find the maximum height of all cards
//         cards.forEach((card) => {
//             card.style.height = 'auto'; // Reset height to auto to get natural height
//             const cardHeight = card.offsetHeight;
//             if (cardHeight > maxHeight) {
//                 maxHeight = cardHeight;
//             }
//         });

//         // Set all cards to the maximum height
//         cards.forEach((card) => {
//             card.style.height = `${maxHeight}px`;
//         });
//     });
// };

// onMounted(() => {
//     setCardHeights();
//     window.addEventListener('resize', setCardHeights); // Adjust heights on window resize
// });

// onBeforeUnmount(() => {
//     window.removeEventListener('resize', setCardHeights);
// });
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
