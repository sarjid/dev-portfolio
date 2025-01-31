<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
    pricing: Object
});
</script>

<template>

    <Head title="Billing" />
    <WebsiteLayout>
        <!-- page -->
        <template #page>
            <!-- ====== Billing Part ====== -->
            <section class="billing">
                <div class="container">
                    <div class="row gy-5">
                        <div class="col-lg-8 order-2 order-lg-1" data-aos="fade-in">
                            <div class="billing-info w-100">
                                <h3>Billing Information</h3>
                                <!-- billing form -->
                                <form class="billing-form w-100" action="">
                                    <!-- name -->
                                    <div class="input-field-wrapper w-100">
                                        <div class="input-field w-100">
                                            <input type="text" name="name" placeholder="Full Name" />
                                        </div>
                                    </div>
                                    <!-- email -->
                                    <div class="input-field-wrapper w-100">
                                        <div class="input-field w-100">
                                            <input type="email" name="email" placeholder="Email Address" />
                                        </div>
                                    </div>
                                    <!-- phone -->
                                    <div class="input-field-wrapper w-100">
                                        <div class="input-field w-100">
                                            <input type="phone" name="phone" placeholder="Phone" />
                                        </div>
                                    </div>
                                    <!-- button -->
                                    <!-- <div class="input-field w-100">
                                        <button class="btn-basic" type="submit">
                                            Save Details
                                        </button>
                                    </div> -->

                                    <div class="payment-info">
                                        <button class="btn-basic">Pay Now</button>
                                    </div>
                                </form>
                                <!-- <h3>Payment Information</h3>
                                <div class="payment-info">
                                    <button class="btn-basic">Pay Now</button>
                                </div> -->
                            </div>
                        </div>

                        <div class="col-lg-4 order-1 order-lg-2" data-aos="fade-in">
                            <div class="billing-invoice text-center">
                                <h3>Billing Invoice</h3>
                                <table>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                    </tr>
                                    <tr>
                                        <td>{{ pricing.slug }}</td>
                                        <td>{{ $filters.currencySymbol(pricing.price) }}</td>
                                    </tr>
                                    <tr style="font-weight: 700">
                                        <td>Total Price</td>
                                        <td>{{ $filters.currencySymbol(pricing.price) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ====== Billing Part End ====== -->
        </template>
    </WebsiteLayout>
</template>
