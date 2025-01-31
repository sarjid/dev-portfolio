<template>
    <div class="input-group pointer">
        <div class="input-group-prepend">
            <div class="input-group-text bg-soft-secondary font-weight-medium">
                Browse
            </div>
        </div>
        <div class="form-control">
            <slot />
        </div>
    </div>

    <!-- <input type="file" @input="form.photo = $event.target.files[0]" /> -->
</template>
