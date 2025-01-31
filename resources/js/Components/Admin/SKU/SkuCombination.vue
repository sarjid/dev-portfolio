<template>
    <div class="sku_combination py-4 table-responsive" id="sku_combination">
        <table class="table table-bordered" style="">
            <thead>
                <tr class="footable-header">
                    <td class="text-center footable-first-visible" style="display: table-cell;">
                        Variant
                    </td>
                    <td class="text-center footable-last-visible" style="display: table-cell;">
                        Variant Price
                    </td>
                    <td class="text-center" data-breakpoints="lg" style="display: none;">
                        SKU
                    </td>
                    <td class="text-center" data-breakpoints="lg" style="display: none;">
                        Quantity
                    </td>
                    <td class="text-center" data-breakpoints="lg" style="display: none;">
                        Photo
                    </td>
                </tr>
            </thead>
            <tbody>
                <slot />
            </tbody>
        </table>
    </div>
</template>
