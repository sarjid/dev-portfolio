<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    title: String,
})
</script>


<template>

    <div class="page-header w-100 d-flex flex-column justify-content-center align-items-center">
        <h2 class="page-title">{{ title }}</h2>
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <Link href="/">Home</Link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Pricing
                </li>
            </ol>
        </div>
    </div>
</template>
