<script setup>
import { VDangerButton, VPrimaryButton } from "@/Components/Admin/Button";
const props = defineProps({
    modalStatus: {
        type: Boolean,
        required: true,
        default: false,
    },
});

const emit = defineEmits(["close"]);

const closeModal = () => {
    emit("close");
};

const submitModal = () => {
    emit("submit");
};
</script>

<template>
    <Transition name="fade">
        <div
            class="fixed z-10 overflow-y-auto top-0 w-full left-0"
            v-show="modalStatus"
        >
            <div
                class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <div
                    class="fixed inset-0 transition-opacity"
                    @click="closeModal"
                >
                    <div class="absolute inset-0 bg-gray-200 opacity-75" />
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    >&#8203;</span
                >
                <div
                    class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="modal-headline"
                >
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-center text">
                            Are You Shure To Delete ?
                        </h3>
                        <p class="text-center">
                            Once delete, You can't restore it
                        </p>
                    </div>
                    <div
                        class="px-4 py-4 text-right space-x-6 flex justify-center"
                    >
                        <VPrimaryButton @click="closeModal">
                            <FIcon icon="fa solid fa-times-circle" /> Cancel
                        </VPrimaryButton>

                        <VDangerButton class="btn-danger" @click="submitModal">
                            <FIcon icon="fa solid fa-trash" /> Delete
                        </VDangerButton>
                    </div>
                </div>
            </div>
        </div>
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
