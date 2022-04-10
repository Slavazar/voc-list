<template>
    <Head title="Category - Account" />

    <AppAuthenticatedLayout>
        <template #header>
            <h2 class="">Category</h2>
        </template>
        <div v-if="errors" class="form-errors mb-3">
            <div v-for="error in errors" class="alert alert-danger">{{ error }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label for="input-name" class="form-label">Name</label>
                        <input type="text" v-model="form.name" class="form-control" id="input-name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>        
            </div>
        </div>
    </AppAuthenticatedLayout>
</template>

<script>
import AppAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        AppAuthenticatedLayout,
        Head,
    },
    setup(props) {
        const form = useForm({
            name: props.category.name,
        });

        return { form };
    },
    props: {
        category: Object,
        errors: Object,
    },
    methods: {
        submit() {
            this.form.put(route("account.categories.update", this.category.id));
        },
    },
};
</script>
