<script setup>
import { ref } from 'vue';
import { VPrimaryButton } from "@/Components/Admin/Button";
const variantToggleStatus = ref(false);
const toggleVariant = () => {
    variantToggleStatus.value = !variantToggleStatus.value;
}
</script>


<template>

    <tr class="variant">
        <td class=" footable-first-visible" style="display: table-cell;">
            <div class="flex justify-center gap-x-4">
                <VPrimaryButton class="btn-sm" id="spand" @click="toggleVariant()">
                    <i class=" fa fa-minus" v-if="variantToggleStatus"></i>
                    <i class=" fa fa-plus" v-else></i>
                </VPrimaryButton>
                <label for="spand" class="control-label">

                    <!-- M  -->
                    <slot name="variant_name" />
                </label>
            </div>
        </td>
        <td class="footable-last-visible" style="display: table-cell;">
            <slot name="variant_price" />

            <!-- <input type="number" lang="en" name="price_M" value="0" min="0" step="0.01" class="form-control"
                required=""> -->
        </td>
        <td style="display: none;"></td>
        <td style="display: none;"></td>
        <td style="display: none;"></td>
    </tr>
    <transition enter-active-class="transition ease-out duration-200" enter-from-class="transform opacity-0 scale-95"
        enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75"
        leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
        <tr class="footable-detail-row " v-show="variantToggleStatus">
            <td colspan="2">
                <table class="footable-details table table-bordered">
                    <tbody>
                        <slot name="variant_data" />
                        <!--
                    <tr class="variant">
                        <th>
                            SKU
                        </th>
                        <td style="display: table-cell;">
                            <input type="text" name="sku_M" value="" class="form-control">
                        </td>
                    </tr>
                    <tr class="variant">
                        <th>
                            Quantity
                        </th>
                        <td style="display: table-cell;">
                            <input type="number" lang="en" name="qty_M" value="10" min="0" step="1"
                                class="form-control">
                        </td>
                    </tr>
                    <tr class="variant">
                        <th>
                            Photo
                        </th>
                        <td style="display: table-cell;">
                            <div class=" input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        Browse</div>
                                </div>
                                <div class="form-control file-amount text-truncate">
                                    Choose File</div>
                                <input type="hidden" name="img_M" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>
                        </td>
                    </tr> -->
                    </tbody>
                </table>
            </td>
        </tr>
    </transition>
</template>
