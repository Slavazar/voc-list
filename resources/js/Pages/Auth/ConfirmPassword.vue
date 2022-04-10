<script setup>
import AppButton from '@/Components/Button.vue';
import AppGuestLayout from '@/Layouts/Guest.vue';
import AppInput from '@/Components/Input.vue';
import AppLabel from '@/Components/Label.vue';
import AppValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    })
};
</script>

<template>
    <AppGuestLayout>
        <Head title="Confirm Password" />

        <div class="mb-3">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <AppValidationErrors class="mb-3" />
        
        <div class="card">
            <div class="card-header">Confirm Password</div>
            <div class="card-body">
                <form @submit.prevent="submit">
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" v-model="form.password" class="form-control" required autocomplete="current-password" autofocus>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <AppButton :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                                Confirm
                            </AppButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppGuestLayout>
</template>
