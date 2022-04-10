<script setup>
import AppButton from '@/Components/Button.vue';
import AppGuestLayout from '@/Layouts/Guest.vue';
import AppValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <AppGuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-3">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <div v-if="status" class="mb-3 text-success">
            {{ status }}
        </div>
        
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
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <AppButton :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                                Email Password Reset Link
                            </AppButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppGuestLayout>
</template>
