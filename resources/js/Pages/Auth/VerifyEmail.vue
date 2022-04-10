<script setup>
import { computed } from 'vue';
import AppButton from '@/Components/Button.vue';
import AppGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <AppGuestLayout>
        <Head title="Email Verification" />

        <div class="mb-3">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <div v-if="verificationLinkSent" class="mb-3 text-success">
            A new verification link has been sent to the email address you provided during registration.
        </div>
        
        <div class="card">
            <div class="card-header">Email Verification</div>

            <div class="card-body">
                <form @submit.prevent="submit">
                    <div class="m3-4 text-center">
                        <AppButton :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                            Resend Verification Email
                        </AppButton>

                        <Link :href="route('logout')" method="post" as="button" class="btn btn-link">Log Out</Link>
                    </div>
                </form>
            </div>
        </div>
    </AppGuestLayout>
</template>
