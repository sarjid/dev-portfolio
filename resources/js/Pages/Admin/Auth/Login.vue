<script setup>
import { ref } from "vue";
import VInputLabel from "@/Components/Admin/Form/VInputLabel.vue";
import VTextInput from "@/Components/Admin/Form/VTextInput.vue";
import VPrimaryButton from "@/Components/Admin/Button/VPrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { Form } from "vee-validate";
import * as yup from "yup";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

//toggle password
const showPassword = ref(false);
const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const schema = yup.object({
    email: yup.string().email().required("The email field is required"),
    password: yup.string().required("The password field is required"),
});

/**
 *use for veevalidate
 *submit form
 */
const onSubmit = (values, actions) => {
    form.post(route("admin.login"), {
        onFinish: () => form.reset("password"),
        onError: () => {
            actions.setErrors(form.errors);
        },
    });
};
</script>

<template>
    <div>

        <Head title="Log in" />
        <!-- Main Wrapper -->
        <div class="min-h-screen flex items-center">
            <div class="w-full">
                <div class="bg-white p-8 rounded-lg shadow-xl md:w-3/4 mx-auto lg:w-1/3 border">
                    <div class="login-userheading">
                        <h3 class="text-center">Admin Login</h3>
                        <hr />
                        <!-- <h3 class="text-center">Admin Login</h3> -->
                    </div>

                    <Form @submit="onSubmit" :validation-schema="schema" v-slot="{ meta, isSubmitting }">
                        <div class="mb-2">
                            <VInputLabel for="email" value="Email" />
                            <VTextInput type="email" id="email" v-model="form.email" name="email"
                                placeholder="Enter your email address " />
                        </div>
                        <div class="mb-2">
                            <VInputLabel for="password" value="Password" />
                            <VTextInput type="password" id="password" v-model="form.password" name="password"
                                placeholder="Enter your password" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <VPrimaryButton type="submit" class="btn-login w-full py-2"
                                :disabled="form.processing || isSubmitting">
                                <i v-show="isSubmitting || form.processing" class="fa-solid fa-spinner " />
                                Log In
                            </VPrimaryButton>
                        </div>
                    </Form>
                    <!-- <div class="mt-3 text-center">
                        <b class="text-center text-green-700"> Help Line: +8801722-260010 </b>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- /Main Wrapper -->
    </div>
</template>
<style>
:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
</style>
