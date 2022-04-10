<template>
    <Head title="Exercises - Account" />

    <AppAuthenticatedLayout>
        <template #header>
            <h2 class="">Exercises</h2>
        </template>

        <div class="mb-3">
            <Link class="btn btn-primary" :href="route('account.exercises.create')">Add Exercise</Link>
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
                    <td class="px-4 py-2">
                        <SortLink field="category_name">Category</Sortlink>
                    </td>
                    <td class="px-4 py-2">
                        <SortLink field="created_at">Created</Sortlink>
                    </td>
                    <td class="px-4 py-2">Action</td>
                </thead>
                <tbody>
                    <tr v-for="exercise in exercises.data" :key="exercise.id">
                        <td class="px-4 py-2">{{ exercise.id }}</td>
                        <td class="px-4 py-2">{{ exercise.name }}</td>
                        <td class="px-4 py-2">{{ exercise.category_name }}</td>
                        <td class="px-4 py-2">{{ formatDate(exercise.created_at) }}</td>
                        <td class="px-4 py-2 font-extrabold">
                            <Link class="btn btn-success btn-sm me-1 mb-1 mb-md-0" :href="route('account.exercises.edit', exercise.id)">Edit</Link>
                            <Link @click="destroy(exercise.id)" class="btn btn-danger btn-sm mb-1 mb-md-0">Delete</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <SortPagination :links="exercises.links" :sort_data="$page.props.sort_data" />
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
        exercises: Object,
    },
    methods: {
        destroy(id) {
            var confirmation = confirm('Are you sure to delete the exercise?');
            if (confirmation) {
                this.$inertia.delete(route("account.exercises.destroy", id));
            }
        },
        
        formatDate(date) {
            return moment(date).format("YYYY-MM-DD HH:mm:ss");
        }
    },
};
</script>