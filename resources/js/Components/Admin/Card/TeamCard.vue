<script setup>

const props = defineProps({
    name: String,
    image: String,
    title: String,
})
</script>

<template>
    <div class="col-lg-3 col-6 d-flex justify-content-center">
        <div class="card" data-aos="fade-up">
            <img :src="image" alt="Team Image" class="img-fluid" />
            <div class="card-body text-center">
                <h5 class="card-name">{{ name }}</h5>
                <p class="card-title">{{ title }}</p>
            </div>
            <div class="card-icon">
                <slot />
            </div>
        </div>
    </div>
</template>
