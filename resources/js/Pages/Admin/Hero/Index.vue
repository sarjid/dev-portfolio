<script setup>
import {onMounted,ref} from "vue";
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import VInputLabel from "@/Components/Admin/Form/VInputLabel.vue";
import PlainTextInput from "@/Components/Admin/Form/PlainTextInput.vue";
import FileInput from "@/Components/Admin/Form/FileInput.vue";
import VSelect from "@/Components/Admin/Form/VSelect.vue";
import VPrimaryButton from "@/Components/Admin/Button/VPrimaryButton.vue";
import social_list from "./social.json";
import { Head, useForm } from "@inertiajs/vue3";
// import noty from "@/alert";
import { useFormStore } from "@/admin/stores";
const form = useFormStore();

//

// Define props
const props = defineProps(['hero']);
form.data.title = props.hero?.title
form.data.name = props.hero?.name
form.data.code_snippet = props.hero?.code_snippet
form.data.description = props.hero?.description
form.data.social_links = props.hero?.social_links
form.data.my_description = props.hero?.my_description

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

const selectedSocial = ref([]);
const addSocialPlatForm = (data) => {

    data.forEach(platform => {
    const link = social_list.social_links.find(item => item.platform === platform);
        if (link && !form.data.social_links.includes(link)) { // Prevent duplicates
            form.data.social_links.push(link);
        }
    });

};




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
                                <VInputLabel for="name" value="Name" />
                                <PlainTextInput type="text" v-model="form.data.name" name="name"
                                placeholder="john doe" />
                            </div>

                            <div class="form-group">
                                <VInputLabel for="title" value="Title" />
                                <PlainTextInput type="text" v-model="form.data.title" name="title"
                                placeholder="For Professional Software Developer" />
                            </div>

                            <div class="form-group">
                                <VInputLabel for="description" value="description" />
                                <textarea class="form-control" v-model="form.data.description" placeholder="lead paragraph"></textarea>
                            </div>

                            <div class="form-group">
                                <VInputLabel for="code_snippet" value="code_snippet" />
                                <textarea class="form-control" v-model="form.data.code_snippet"
                                    placeholder="Code for CodeBlock"></textarea>
                            </div>

                            <div class="form-group" v-for="(dat,index) in form.data.social_links" :key="index">
                                <VInputLabel :for="`${dat.platform}-Link`" :value="`${dat.platform}-Link`"/>
                                <PlainTextInput type="text" v-model="dat.url" name="title" :placeholder="`${dat.platform}-Link`" />
                            </div>

                            <div class="form-group">
                                <VInputLabel for="cv_link" value="CV Pdf" />
                                <input @input="(form.data.cv_link = $event.target.files[0])" type="file"
                                    class="form-control">
                                <!-- <img :src="hero?.cv_link" class="h-20 w-20" /> -->
                            </div>


                            <div class="form-group">
                                <VInputLabel for="description" value="My Description (Who Iam Section)" />
                                <textarea class="form-control" v-model="form.data.my_description" placeholder="describe about you"></textarea>
                            </div>

                            <div class="form-group">
                                <VInputLabel for="cv_link" value="My Image (Who Iam Section)" />
                                <input @input="(form.data.my_image = $event.target.files[0])" type="file"
                                    class="form-control">
                                    <img :src="$filters.makeImagePath(hero?.my_image)" class="h-20 w-20" />
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
