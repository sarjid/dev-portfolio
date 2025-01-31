<template>
    <div class="table-responsive">
        <table class="table datanew">
            <thead>
                <tr>
                    <slot name="tableHead"></slot>
                </tr>
            </thead>
            <tbody>
                <slot />
            </tbody>
        </table>
    </div>
</template>
