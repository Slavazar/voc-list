<script setup>
import AppButton from '@/Components/Button.vue';
import AppGuestLayout from '@/Layouts/Guest.vue';
import AppValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AppGuestLayout>
        <Head title="Register" />

        <AppValidationErrors class="mb-3" />
        
        <div class="card">
            <div class="card-header">Register</div>

            <div class="card-body">
                <form @submit.prevent="submit">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" v-model="form.name" required autocomplete="name" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" v-model="form.email" required autocomplete="email">
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
                        <div class="col-md-6 offset-md-4">
                            <AppButton :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                                Register
                            </AppButton>
                            <Link :href="route('login')" class="btn btn-link">
                                Already registered?
                            </Link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </AppGuestLayout>
</template>
