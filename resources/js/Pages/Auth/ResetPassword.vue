<script setup>
import AppButton from '@/Components/Button.vue';
import AppGuestLayout from '@/Layouts/Guest.vue';
import AppValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AppGuestLayout>
        <Head title="Reset Password" />

        <AppValidationErrors class="mb-3" />
        
        <div class="card">
            <div class="card-header">Reset Password</div>

            <div class="card-body">

                <form @submit.prevent="submit">
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" v-model="form.email" class="form-control" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" v-model="form.password" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" v-model="form.password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <AppButton :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                                Reset Password
                            </AppButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppGuestLayout>
</template>
