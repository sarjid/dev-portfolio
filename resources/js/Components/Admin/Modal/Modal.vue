<script setup>
const props = defineProps({
    visible: {
        type: Boolean,
        required: true,
        default: false,
    },
});

const emit = defineEmits(["close"]);

const closeModal = () => {
    emit("close");
};
</script>

<template>
    <Transition name="fade">
        <div class="fixed z-10 overflow-y-auto top-0 w-full left-0" v-show="visible">
            <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- <div
                    class="fixed inset-0 transition-opacity"
                    @click="closeModal"
                > -->

                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-200 opacity-75" />
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="bg-white text-right">
                        <button type="button" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-themePrimary"
                            @click="closeModal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <slot name="content"></slot>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal toggle -->

        <!-- Main modal -->
    </Transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
