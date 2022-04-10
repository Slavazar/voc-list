<script setup>
import AppGuestLayout from '@/Layouts/Guest.vue';
import AppValidationErrors from '@/Components/ValidationErrors.vue';
import AppButton from '@/Components/Button.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AppGuestLayout>
        <Head title="Log in" />

        <AppValidationErrors class="mb-3" />

        <div v-if="status" class="mb-3 text-success">
            {{ status }}
        </div>
        <div class="card">
            <div class="card-header">Login</div>

            <div class="card-body">
                <form @submit.prevent="submit">
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
                        <div class="col-md-6">
                            <input id="email" type="email" v-model="form.email" class="form-control" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" v-model="form.password" class="form-control" required autocomplete="current-password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="form.remember" id="remember">

                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <AppButton :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                                Login
                            </AppButton>
                            <Link v-if="canResetPassword" :href="route('password.request')" class="btn btn-link">
                                Forgot your password?
                            </Link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppGuestLayout>
</template>
