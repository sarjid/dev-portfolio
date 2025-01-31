<script setup>
import VTextInput from "./VTextInput.vue";
import VTextarea from "./VTextarea.vue";
import { computed } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import { Form } from "vee-validate";
import * as yup from "yup";
const page = usePage()
//address
const siteAddress = computed(() => {
    const addressSetting = page.props?.settings.find(setting => setting.key === 'address');
    return addressSetting ? addressSetting.value : null;
})

//email
const siteEmail = computed(() => {
    const emailAddress = page.props?.settings.find(setting => setting.key === 'email');
    return emailAddress ? emailAddress.value : null;
})


//phone
const sitePhone = computed(() => {
    const phoneNo = page.props?.settings.find(setting => setting.key === 'phone');
    return phoneNo ? phoneNo.value : null;
})

const schema = yup.object({
    name: yup.string().min(3).required(),
    email: yup.string().required().email(),
    phone: yup.string().required().max(40),
    subject: yup.string().required().max(100),
    message: yup.string().required().max(255)
});

const form = useForm({
    name: "",
    email: "",
    phone: "",
    subject: "",
    message: "",
});

const onSubmit = async (values, actions) => {
    form.post(route("contact.store"), {
        onFinish: () => form.reset("password"),
        onError: () => {
            actions.setErrors(form.errors);
        },
    });
}

</script>

<template>


    <div class="row gy-5">
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            <h2 class="contact-heading">
                Have questions?&nbsp;<br class="d-none d-md-block" />
                Get in touch!
            </h2>
            <p class="contact-text">
                Adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim.
            </p>
            <div class="contact-info d-flex flex-column justify-content-start">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-geo-alt"></i>
                    <p>{{ siteAddress }}</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-phone"></i>
                    <a :href="`tel:${{ sitePhone }}`">{{ sitePhone }}</a>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-envelope"></i>
                    <a :href="`mailto:${siteEmail}`">{{ siteEmail }}</a>
                </div>
            </div>
        </div>
        <!-- contact form -->
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
            <Form @submit="onSubmit" :validation-schema="schema" v-slot="{ errors, isSubmitting, meta }"
                class="contact-form w-100">
                <!-- name & email -->
                <div class="input-field-wrapper w-100 d-flex flex-column flex-sm-row">
                    <div class="input-field w-50">
                        <VTextInput v-model="form.name" type="text" name="name" placeholder="your name" />
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="input-field w-50">
                        <VTextInput v-model="form.email" type="text" name="email" placeholder="Email Address" />
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <!-- phone & subject -->
                <div class="input-field-wrapper w-100 d-flex flex-column flex-sm-row">
                    <div class="input-field w-50">
                        <VTextInput v-model="form.phone" type="text" name="phone" placeholder="Phone" />
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div class="input-field w-50">
                        <VTextInput v-model="form.subject" type="text" name="subject" placeholder="Subject" />
                        <i class="bi bi-info-circle"></i>
                    </div>
                </div>
                <!-- textarea -->
                <div class="input-field-wrapper w-100 d-flex">
                    <div class="input-field w-100">
                        <VTextarea v-model="form.message" name="message" placeholder="How can we help you?" />
                        <i class="bi bi-pencil textarea-icon"></i>
                    </div>
                </div>
                <button type="submit" class="btn-basic mt-3">
                    <i class="bi bi-send"></i> Get in Touch
                </button>
                <br />
                <div class="d-flex align-items-start mt-3 ms-1">
                    <input type="checkbox" id="checkbox" />
                    <label for="checkbox">I agree that my collected data is
                        <a href="#">collected and stored</a>.</label>
                </div>
            </Form>
        </div>
    </div>
</template>
