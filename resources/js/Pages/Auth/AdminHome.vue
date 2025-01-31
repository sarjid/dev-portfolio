<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

</script>


<template>
    <div>
        <div class="container text-center vh-100">
            <h3>Hello , Iamn Here</h3>
            <div class="ms-3">
                <DropdownLink class="btn btn-danger" :href="route('admin.logout')" method="post" as="button">
                    Log Out
                </DropdownLink>
            </div>
        </div>
    </div>
</template>
