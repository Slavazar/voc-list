<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
<div class="container">
    <div class="row mb-3 mt-3 justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="mb-3">
                <Link href="/">Return to main</Link>
            </div>
            <div class="">
                <slot />
            </div>
        </div>
    </div>
</div>
</template>
