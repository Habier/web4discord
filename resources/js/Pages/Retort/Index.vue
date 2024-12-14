<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {TrashIcon} from '@heroicons/vue/24/solid'
import {router, useForm} from "@inertiajs/vue3";
import {Button} from "primevue";
import {ref} from "vue";

const props = defineProps({
    retorts: Array
});

const form = useForm({
    question: null
});

const trashLoading = ref(-1);

function handleDelete(id) {
    this.trashLoading = id;
    router.delete(route('retorts.destroy', id));
}

function submit() {
    form.post(route('retorts.store'), form);
    form.reset();
}

function handleDownload() {
    router.get(route('retorts.download'));
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
                <Button label="Submit" class="mr-4" type="submit" :loading="form.processing"/>
                <Button as="a" label="Download" :href="route('retorts.download')" target="_blank" rel="noopener"/>
            </form>

            <div class="mt-2">

                <div v-for="retort in retorts" class="flex">
                    <div class="w-1/12 flex items-center">
                        <Button class=" m-auto" @click="handleDelete(retort.id)" ref="trash-{{retort.id}}"
                                :loading="trashLoading===retort.id">
                            <TrashIcon class="size-6 text-danger"/>
                        </Button>
                    </div>
                    <div class="w-11/12">{{ retort.question }}</div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
