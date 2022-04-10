<template>
    <Head title="Words - Account" />

    <AppAuthenticatedLayout>
        <template #header>
            <h2 class="">Words</h2>
        </template>

        <div class="mb-3">
            <Link class="btn btn-primary" :href="route('account.words.create')">Add Word</Link>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="">
                    <td class="px-4 py-2">
                        <SortLink field="id">ID</Sortlink>
                    </td>
                    <td class="px-4 py-2">
                        <SortLink field="word">Word</Sortlink>
                    </td>
                    <td class="px-4 py-2">
                        <SortLink field="category_name">Category</Sortlink>
                    </td>
                    <td class="px-4 py-2">Action</td>
                </thead>
                <tbody>
                    <tr v-for="word in words.data" :key="word.id">
                        <td class="px-4 py-2">{{ word.id }}</td>
                        <td class="px-4 py-2">{{ word.word }}</td>
                        <td class="px-4 py-2">{{ word.category_name }}</td>
                        <td class="px-4 py-2 font-extrabold">
                            <Link class="btn btn-success btn-sm me-1 mb-1 mb-md-0" :href="route('account.words.edit', word.id)">Edit</Link>
                            <Link @click="destroy(word.id)" class="btn btn-danger btn-sm mb-1 mb-md-0">Delete</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <SortPagination :links="words.links" :sort_data="$page.props.sort_data" />
    </AppAuthenticatedLayout>
</template>

<script>
import AppAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";
import SortPagination from '@/Shared/SortPagination';
import SortLink from '@/Shared/SortLink';

export default {
    components: {
        AppAuthenticatedLayout,
        Head,
        Link,
        SortPagination,
        SortLink
    },
    props: {
        words: Object,
    },
    methods: {
        destroy(id) {
            var confirmation = confirm('Are you sure to delete the word?');
            if (confirmation) {
                this.$inertia.delete(route("account.words.destroy", id));
            }
        },
    },
};
</script>