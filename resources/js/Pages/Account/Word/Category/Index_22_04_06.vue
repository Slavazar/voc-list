<template>
    <Head title="Categories - Account" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="">Categories</h2>
        </template>

        <div class="mb-3">
            <Link class="btn btn-primary" :href="route('account.categories.create')">Add Category</Link>
        </div>
        <table class="table">
            <thead class="">
                <td class="px-4 py-2">ID</td>
                <td class="px-4 py-2">Name</td>
                <td class="px-4 py-2">#Words</td>
                <td class="px-4 py-2">Action</td>
            </thead>
            <tbody>
                <tr v-for="category in categories.data" :key="category.id">
                    <td class="px-4 py-2">{{ category.id }}</td>
                    <td class="px-4 py-2">{{ category.name }}</td>
                    <td class="px-4 py-2"></td>
                    <td class="px-4 py-2 font-extrabold">
                        <Link class="btn btn-success btn-sm me-1" :href="route('account.categories.edit', category.id)">Edit</Link>
                        <Link @click="destroy(category.id)" class="btn btn-danger btn-sm">Delete</Link>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination :links="categories.links" />
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