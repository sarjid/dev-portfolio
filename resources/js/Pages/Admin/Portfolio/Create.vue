<script setup>
import { onMounted, computed } from 'vue';
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import VInputLabel from "@/Components/Admin/Form/VInputLabel.vue";
import PlainTextInput from "@/Components/Admin/Form/PlainTextInput.vue";
import FileInput from "@/Components/Admin/Form/FileInput.vue";
import { VPrimaryButton, LinkButton, VDangerButton } from "@/Components/Admin/Button";
import { Head, useForm } from "@inertiajs/vue3";
import noty from "@/alert";
import { useFormStore } from "@/admin/stores";
const form = useFormStore();
// Define props
const props = defineProps({
    services: Object
});

// intialize form
onMounted(() => {
    form.data = {
        service_id: '',
        images: [],

    }

});


// onMounted(() => {
//     form.data = {
//         service_id: '',
//         images: [],
//         photos: [
//             {
//                 image: ''
//             }
//         ]
//     }

// });

// const addMoreField = () => {
//     form.data.photos.push({ image: '' });
// }

// const removeField = (index) => {
//     if (form.data?.photos.length > 1) {
//         form.data?.photos.splice(index, 1);
//     }
// }

const onFileSelected = (files) => {
    form.data.images = files;
    console.log('files', form.data.images);
    // files.FileList.forEach(file => { console.log('links', URL.createObjectURL(file)) });
}


// const filteredFiles = computed(() => {
//     return form.data?.images.map((item) => {
//         URL.createObjectURL(item)
//     });

// })

// Handle form submission
const onSubmit = () => {
    const submitF = useForm(form.data);
    submitF.post(route('admin.portfolio.store'), {
        onSuccess: () => {
            noty().fire({
                icon: "success",
                title: "Added Success",
            });
        },
        onError: errors => { form.errors = errors },
        onStart: () => { form.processing = true; },
        onFinish: () => { form.processing = false; },
    });
}
</script>

<template>

    <Head title="Portfolio Section" />
    <AdminLayout>
        <div class="content">
            <div class="p-2 flex gap-x-4">
                <LinkButton :href="route('admin.portfolio.index')">
                    <i class="fa solid fa-arrow-left"></i>
                    Back
                </LinkButton>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="onSubmit">
                        <div class="form-group">
                            <select class="form-control" v-model="form.data.service_id">
                                <option value="" selected disabled>Select Service</option>
                                <option v-for="(service, index) in services" :key="index" :value="service.id">
                                    {{ service.name }}
                                </option>
                            </select>
                        </div>
                        <div class="flex justify-between gap-x-4 mt-3 border">

                            <div class="form-group">
                                <input multiple @change="onFileSelected($event.target.files)" type="file">
                                <small>1440*1440px</small>
                                <!-- <img v-for="(imgg, index) in filteredFiles" :key="index" :src="imgg"
                                    class="h-20 w-20" /> -->
                            </div>
                        </div>

                        <div class="mt-2 ">
                            <VPrimaryButton type="submit" :disabled="form.processing">
                                <i class="fa fa-spinner" v-show="form.processing"></i>
                                Submit
                            </VPrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>

<style scoped>
.form-group {
    margin-bottom: 4px !important;
}
</style>
