<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create
            </h2>
        </template>
        <div v-if="errors">
            <div v-for="error in errors">
                {{ error }}
            </div>

        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="form-control">
                                <label class="label" for="word">Word</label>
                                <input type="text" v-model="form.word" class="input input-bordered w-full max-w-xs" />
                            </div>
                            <div class="form-control">
                                <label class="label" for="title">Transcription</label>
                                <input type="text" v-model="form.transcription" class="input input-bordered w-full max-w-xs" />
                            </div>
                            <div>
                                <label for="title">Translation</label>
                                <input type="text" v-model="form.translation" class="input input-bordered w-full max-w-xs" />
                            </div>

                            <!-- submit -->
                            <div class="flex items-center mt-4">
                                <button class="btn btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeLabel from "@/Components/Label";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        errors: Object,
    },
    setup() {
        const form = useForm({
            word: null,
            transcription: null,
            translation: null,
        });

        return { form };
    },
    methods: {
        submit() {
            this.form.post(route("words.store"));
        },
    },
};
</script>