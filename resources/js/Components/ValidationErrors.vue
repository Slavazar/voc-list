<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const errors = computed(() => usePage().props.value.errors);

const hasErrors = computed(() => Object.keys(errors.value).length > 0);
</script>

<template>
    <div v-if="hasErrors">
        <div class="text-danger">Whoops! Something went wrong.</div>

        <div v-for="(error, key) in errors" :key="key" class="text-danger">{{ error }}</div>
    </div>
</template>
