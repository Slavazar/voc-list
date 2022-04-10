<script setup>
import AppAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AppAuthenticatedLayout>
        <template #header>
            <h2 class="">Dashboard</h2>
        </template>

        <div class="mb-3">
            You're logged in!
        </div>
    </AppAuthenticatedLayout>
</template>
