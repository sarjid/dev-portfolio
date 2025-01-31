<script setup>
import AdminLayout from '@/Layouts/Admin/AdminLayout.vue';
import { Head } from "@inertiajs/vue3";
import Vue3AutoCounter from "vue3-autocounter";

const props = defineProps({
    orders_count: Object,
    confirm_orders_count: Object,
    delivered_orders_count: Object,
    pending_orders_count: Object,
    cancel_orders_count: Object,
});



</script>

<template>

    <Head title="Admin Dashboard" />
    <AdminLayout>
        <div class="content">
            <div class="grid media-min-w-md:grid-cols-4 grid-cols-1 sm:grid-cols-2 gap-x-6">
                <div>
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>
                                <Vue3AutoCounter ref="counter" :startAmount="0" :endAmount="orders_count" :duration="2"
                                    prefix="" :autoinit="true" />
                            </h4>
                            <h5>Total Orders</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="dash-count das2">
                        <div class="dash-counts">
                            <h4>
                                <Vue3AutoCounter ref="counter" :startAmount="0" :endAmount="pending_orders_count"
                                    :duration="2" prefix="" :autoinit="true" />
                            </h4>
                            <h5>Pending Orders</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file-text"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>
                                <Vue3AutoCounter ref="counter" :startAmount="0" :endAmount="confirm_orders_count"
                                    :duration="2" prefix="" :autoinit="true" />
                            </h4>
                            <h5>Confirm Order</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user-check"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="dash-count das3">
                        <div class="dash-counts">
                            <h4>
                                <Vue3AutoCounter ref="counter" :startAmount="0" :endAmount="delivered_orders_count"
                                    :duration="2" prefix="" :autoinit="true" />
                            </h4>
                            <h5>Delivered Orders</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="file"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->

            <!-- <div class="card !mb-0">
                <div class="card-body">
                    <h4 class="card-title">Expired Products</h4>
                    <div class="table-responsive dataview">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>SNo</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Brand Name</th>
                                    <th>Category Name</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <a href="javascript:void(0);">IT0001</a>
                                    </td>
                                    <td class="productimgname">
                                        <a
                                            class="product-img"
                                            href="productlist.html"
                                        >
                                            <img
                                                src="assets/img/product/product2.jpg"
                                                alt="product"
                                            />
                                        </a>
                                        <a href="productlist.html">Orange</a>
                                    </td>
                                    <td>N/D</td>
                                    <td>Fruits</td>
                                    <td>12-12-2022</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <a href="javascript:void(0);">IT0002</a>
                                    </td>
                                    <td class="productimgname">
                                        <a
                                            class="product-img"
                                            href="productlist.html"
                                        >
                                            <img
                                                src="assets/img/product/product3.jpg"
                                                alt="product"
                                            />
                                        </a>
                                        <a href="productlist.html">Pineapple</a>
                                    </td>
                                    <td>N/D</td>
                                    <td>Fruits</td>
                                    <td>25-11-2022</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <a href="javascript:void(0);">IT0003</a>
                                    </td>
                                    <td class="productimgname">
                                        <a
                                            class="product-img"
                                            href="productlist.html"
                                        >
                                            <img
                                                src="assets/img/product/product4.jpg"
                                                alt="product"
                                            />
                                        </a>
                                        <a href="productlist.html">Stawberry</a>
                                    </td>
                                    <td>N/D</td>
                                    <td>Fruits</td>
                                    <td>19-11-2022</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <a href="javascript:void(0);">IT0004</a>
                                    </td>
                                    <td class="productimgname">
                                        <a
                                            class="product-img"
                                            href="productlist.html"
                                        >
                                            <img
                                                src="assets/img/product/product5.jpg"
                                                alt="product"
                                            />
                                        </a>
                                        <a href="productlist.html">Avocat</a>
                                    </td>
                                    <td>N/D</td>
                                    <td>Fruits</td>
                                    <td>20-11-2022</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
        </div>
    </AdminLayout>
</template>
