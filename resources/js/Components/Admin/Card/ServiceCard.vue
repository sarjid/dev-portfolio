<script setup>
import { onMounted, onBeforeUnmount, nextTick } from 'vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    href: String,
    title: String,
    description: String,
})

const setCardHeights = () => {
    nextTick(() => {
        const cards = document.querySelectorAll('.service-item');
        let maxHeight = 0;

        // Find the maximum height of all cards
        cards.forEach((card) => {
            card.style.height = 'auto'; // Reset height to auto to get natural height
            const cardHeight = card.offsetHeight;
            if (cardHeight > maxHeight) {
                maxHeight = cardHeight;
            }
        });

        // Set all cards to the maximum height
        cards.forEach((card) => {
            card.style.height = `${maxHeight}px`;
        });
    });
};

onMounted(() => {
    setCardHeights();
    window.addEventListener('resize', setCardHeights); // Adjust heights on window resize
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', setCardHeights);
});
</script>

<template>
    <div class="col-6 h-100" data-aos="fade-up">
        <div class="service-item text-center ">
            <Link :href="href">
            <!-- slot for icon  -->
            <slot />
            <h3>{{ title }}</h3>
            <p>
                {{ description }}
            </p>
            </Link>
        </div>
    </div>
</template>


<style scoped>
.service-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}
</style>
