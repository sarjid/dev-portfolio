<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import VInputLabel from "@/Components/Admin/Form/VInputLabel.vue";
import PlainTextInput from "@/Components/Admin/Form/PlainTextInput.vue";
import VPrimaryButton from "@/Components/Admin/Button/VPrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { computed } from 'vue';
import noty from "@/alert";
import { useFormStore } from "@/admin/stores";
const form = useFormStore();

// Define props
const props = defineProps(['settings']);
props.settings.forEach(setting => {
    form.data[setting.key] = setting.value;
});


const filteredSettings = computed(() => {
    return props.settings.filter(setting => setting.key !== 'logo' && setting.key !== 'favicon' && setting.key !== 'logo_white' && setting.key !== 'logo_black');
});


const filteredImgs = computed(() => {
    return props.settings.filter(setting =>
        setting.key === 'logo' ||
        setting.key === 'favicon' ||
        setting.key === 'logo_white' ||
        setting.key === 'logo_black'
    );
});



const fileUpload = (model, file) => {
    const submitF = useForm({ 'key': model, 'value': file });
    submitF.post(route('admin.system.file.update'), {
        onSuccess: () => {
            noty().fire({
                icon: "success",
                title: "Update Success",
            });
        },
        onError: errors => { form.errors = errors },
        onStart: () => { form.processing = true; },
        onFinish: () => { form.processing = false; },
    });
}



// Handle form submission
const onSubmit = () => {
    const submitF = useForm(form.data);
    submitF.post(route('admin.system.update'), {
        onSuccess: () => {
            noty().fire({
                icon: "success",
                title: "Update Success",
            });
        },
        // onError: errors => { form.errors = errors },
        // onStart: () => { form.processing = true; },
        // onFinish: () => { form.processing = false; },
    });
}
</script>

<template>

    <Head title="System Settings" />
    <AdminLayout>
        <div class="content">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="onSubmit">
                        <div class="md:grid md:grid-cols-2 gap-x-6">

                           <div class="form-group" v-for="(setting, index) in filteredImgs" :key="index">
                                <VInputLabel :for="setting.key" :value="setting.key" />
                                <img :src="setting.value" class=" h-12 bg-red-600" />
                                <input type="file" class="form-control"
                                    @input="fileUpload(setting.key, $event.target.files[0])" />
                            </div>

                            <div class="form-group" v-for="(setting, index) in filteredSettings" :key="index">
                                <VInputLabel :for="setting.key" :value="setting.key" />
                                <PlainTextInput type="text" v-model="form.data[setting.key]" :name="setting.key"
                                    :placeholder="setting.key" />
                            </div>
                            <div class="form-group">
                            </div>


                        </div>
                        <div class="mt-2">
                            <VPrimaryButton type="submit" :disabled="form.processing">
                                <i class="fa fa-spinner" v-show="form.processing"></i>
                                Update
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
