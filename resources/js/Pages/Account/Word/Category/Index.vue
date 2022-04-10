<template>
    <Head title="Categories - Account" />

    <AppAuthenticatedLayout>
        <template #header>
            <h2 class="">Categories</h2>
        </template>

        <div class="mb-3">
            <Link class="btn btn-primary" :href="route('account.categories.create')">Add Category</Link>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="">
                    <td class="px-4 py-2">
                        <SortLink field="id">ID</Sortlink>
                    </td>
                    <td class="px-4 py-2">
                        <SortLink field="name">Name</Sortlink>
                    </td>
                    <td class="px-4 py-2">#Words</td>
                    <td class="px-4 py-2">Action</td>
                </thead>
                <tbody>
                    <tr v-for="category in categories.data" :key="category.id">
                        <td class="px-4 py-2">{{ category.id }}</td>
                        <td class="px-4 py-2">{{ category.name }}</td>
                        <td class="px-4 py-2">{{ category.words_count }}</td>
                        <td class="px-4 py-2 font-extrabold">
                            <Link class="btn btn-success btn-sm me-1 mb-1 mb-md-0" :href="route('account.categories.edit', category.id)">Edit</Link>
                            <Link @click="destroy(category.id)" class="btn btn-danger btn-sm mb-1 mb-md-0">Delete</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <SortPagination :links="categories.links" :sort_data="$page.props.sort_data" />
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
        categories: Object,
    },
    methods: {
        destroy(id) {
            var confirmation = confirm('Are you sure to delete the category?');
            if (confirmation) {
                this.$inertia.delete(route("account.categories.destroy", id));
            }
        },
    },
};
</script>