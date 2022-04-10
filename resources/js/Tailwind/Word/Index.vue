<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Words</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <Link class="btn btn-success btn-sm" :href="route('words.create')">Add Word</Link>
                        </div>
                        <table class="table w-full">
                            <thead class="font-bold bg-gray-300 border-b-2">
                                <td class="px-4 py-2">ID</td>
                                <td class="px-4 py-2">Word</td>
                                <td class="px-4 py-2">Action</td>
                            </thead>
                            <tbody>
                                <tr v-for="word in words.data" :key="word.id">
                                    <td class="px-4 py-2">{{ word.id }}</td>
                                    <td class="px-4 py-2">{{ word.word }}</td>
                                    <td class="px-4 py-2 font-extrabold">
                                        <Link class="text-green-700" :href="route('words.edit', word.id)">Edit</Link>
                                        <Link @click="destroy(word.id)" class="text-red-700">Delete</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination :links="words.links" />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from '@/Shared/Pagination';
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeNavLink,
        Link,
        Pagination
    },
    props: {
        words: Object,
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route("words.destroy", id));
        },
    },
};
</script>