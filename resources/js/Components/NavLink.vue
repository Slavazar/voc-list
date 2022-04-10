<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'px-1 py-1'
    : 'px-1 py-1'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
