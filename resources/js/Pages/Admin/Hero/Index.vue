<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import VInputLabel from "@/Components/Admin/Form/VInputLabel.vue";
import PlainTextInput from "@/Components/Admin/Form/PlainTextInput.vue";
import FileInput from "@/Components/Admin/Form/FileInput.vue";
import VPrimaryButton from "@/Components/Admin/Button/VPrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";
// import noty from "@/alert";
import { useFormStore } from "@/admin/stores";
const form = useFormStore();

// Define props
const props = defineProps(['hero']);
form.data.title = props.hero?.title
form.data.short_descp = props.hero?.short_descp
form.data.video_url = props.hero?.video_url

// Handle form submission
const onSubmit = () => {
    const submitF = useForm(form.data);
    submitF.post(route('admin.hero.update'), {
        onSuccess: () => {
            // noty().fire({
            //     icon: "success",
            //     title: "Update Success",
            // });
        },
        onError: errors => { form.errors = errors },
        onStart: () => { form.processing = true; },
        onFinish: () => { form.processing = false; },
    });
}
</script>

<template>

    <Head title="Hero Section" />
    <AdminLayout>
        <div class="content">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="onSubmit">
                        <div class="md:grid md:grid-cols-2 gap-x-6">
                            <div class="form-group">
                                <VInputLabel for="title" value="Title" />
                                <textarea class="form-control" v-model="form.data.title" placeholder="title"></textarea>
                            </div>


                            <div class="form-group">
                                <VInputLabel for="short_descp" value="short_descp" />
                                <textarea class="form-control" v-model="form.data.short_descp"
                                    placeholder="short description"></textarea>
                            </div>

                            <div class="form-group">
                                <VInputLabel for="video_url" value="video_url" />
                                <PlainTextInput type="text" v-model="form.data.video_url" name="video_url"
                                    placeholder="video url" />
                            </div>




                            <div class="form-group">
                                <VInputLabel for="image_one" value="First Image (w-350*h-390px)" />
                                <input @input="(form.data.image_one = $event.target.files[0])" type="file"
                                    class="form-control">
                                <img :src="hero?.img_url_one" class="h-20 w-20" />
                            </div>

                            <div class="form-group">
                                <VInputLabel for="image_two" value="Second Image (w-350*h-390px)" />
                                <input @input="(form.data.image_two = $event.target.files[0])" type="file"
                                    class="form-control">
                                <img :src="hero?.img_url_two" class="h-20 w-20" />
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
