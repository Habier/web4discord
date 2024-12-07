<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {TrashIcon} from '@heroicons/vue/24/solid'
import {router, useForm} from "@inertiajs/vue3";

const props = defineProps({
    retorts: Array
});

const form = useForm({
    question: null
});

function handleDelete(id) {
    router.delete(route('retorts.delete', id));
}

function submit() {
    form.post(route('retorts.add'), form);
    form.reset();
}


</script>

<template>
    <AppLayout title="Retorts">
        <div class="row mx-auto p-6">
            <form @submit.prevent="submit">
                <label for="message" class="block text-gray-700 dark:text-gray-300 mb-2">Question</label>
                <textarea id="message" rows="4" v-model="form.question"
                          class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-secondary"
                          placeholder="Type your message here..." aria-label="Message text area"></textarea>
                <div class="text-danger" v-if="form.errors.question">{{ form.errors.question }}</div>
                <button type="submit"
                        class="mt-4 px-4 py-2 bg-primary text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-primary">
                    Submit
                </button>
            </form>


            <div>

                <div v-for="retort in retorts" class="flex">
                    <div class="w-1/12 flex items-center">
                        <button class=" m-auto" @click="handleDelete(retort.id)">
                            <TrashIcon class="size-6 text-danger"/>
                        </button>
                    </div>
                    <div class="w-11/12">{{ retort.question }}</div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
