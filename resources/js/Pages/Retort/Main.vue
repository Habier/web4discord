<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {TrashIcon} from '@heroicons/vue/24/solid'

const props = defineProps({
    retorts: Array
});

const deleteRetort = (id) => {
    console.log("deleting:" + id);
}


</script>

<template>
    <AppLayout title="Retorts">
        <div class="row mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <form class="">
                <label for="message" class="block text-gray-700 dark:text-gray-300 mb-2">Question</label>
                <textarea id="message" rows="4"
                          class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-secondary"
                          placeholder="Type your message here..." aria-label="Message text area"></textarea>
                <button type="submit"
                        class="mt-4 px-4 py-2 bg-primary text-white rounded hover:bg-blue-600 dark:bg-secondary dark:hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-secondary">
                    Submit
                </button>
            </form>


            <div>

                <div v-for="retort in retorts" class="flex">
                    <div class="w-1/12 flex items-center">
                        <button class=" m-auto" v-on:click="deleteRetort(retort.id)">
                            <TrashIcon class="size-6"/>
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
