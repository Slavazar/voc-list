<template>
    <Head title="Add Exercise - Account" />

    <AppAuthenticatedLayout>
        <template #header>
            <h2 class="">Add Exercise</h2>
        </template>
        <div v-if="errors" class="form-errors mb-3">
            <div v-for="error in errors" class="alert alert-danger">{{ error }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label for="input-category" class="form-label">Category</label>
                        <select class="form-select" v-model="form.word_category_id">
                            <option disabled value="">Select a category</option>
                            <option v-for="(category, index) in categories" :key="`category-${index}`" :value="category.id">{{ category.name }}</option>
                        </select>                        
                    </div>
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
    props: {
        categories: Object,
        errors: Object,
    },
    setup() {
        const form = useForm({
            word_category_id: "",
            name: null,
        });

        return { form };
    },
    methods: {
        submit() {
            this.form.post(route("account.exercises.store"));
        },
    },
};
</script>