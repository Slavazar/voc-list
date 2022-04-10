<script setup>
import AppNavLink from '@/Components/NavLink.vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

function logout(event) {
    var href = event.target.href;
    Inertia.post(href);
}
</script>
<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <Link class="navbar-brand" :href="route('dashboard')">
                Vocabulary List
            </Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <AppNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </AppNavLink>
                    <AppNavLink :href="route('account.words.index')" :active="route().current('account.words.*')">
                        Words
                    </AppNavLink>
                    <AppNavLink :href="route('account.categories.index')" :active="route().current('account.categories.*')">
                        Categories
                    </AppNavLink>
                    <AppNavLink :href="route('account.exercises.index')" :active="route().current('account.exercises.*')">
                        Exercises
                    </AppNavLink>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $page.props.auth.user.name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" :href="route('logout')" @click.prevent="logout">
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header v-if="$slots.header">
        <div class="container">
            <div class="row mt-3 mb-3">
                <div class="col-12">
                    <slot name="header" />
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div v-if="$page.props.flash.success" class="success-message mb-3">
                        <div class="alert alert-success" role="alert">{{ $page.props.flash.success }}</div>
                    </div>
                    <div v-if="$page.props.flash.status" class="status-message mb-3">
                        <div class="alert alert-primary" role="alert">{{ $page.props.flash.status }}</div>
                    </div>
                    <div v-if="$page.props.flash.danger" class="status-message mb-3">
                        <div class="alert alert-danger" role="alert">{{ $page.props.flash.danger }}</div>
                    </div>
                    <slot />
                </div>
            </div>
        </div>
    </main>
</template>
