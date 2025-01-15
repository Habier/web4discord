<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { onBeforeMount } from 'vue';
import {usePage, router, useForm} from '@inertiajs/vue3';
import RadioButton from 'primevue/radiobutton';
import {Button} from "primevue";

let form = useForm({
    option: null
});

let totalVotes = 0;
let loading = false;

const props = defineProps({
    poll: Object,
    alreadyVoted: Boolean
});

onBeforeMount(() => {
    totalVotes = props.poll.options.reduce((total, option) => {
        return total + option.count;
    }, 0);
});

function calculatePercentage(option) {
    console.log("totalVotes:", totalVotes); // Verifica el valor aquí

    if(option.count === 0)
        return 0;

    return (100 / totalVotes) * option.count;
}

function onPageChange(event) {
    const page = event.page + 1;
    router.get(usePage().url, {page});
}

function getTitle(option) {
    if (this.props.alreadyVoted) {
        return `[${option.count}] ${option.title}`
    }

    return option.title
}

function submit() {
    form.post(route("polls.vote", props.poll.id));
}
</script>

<template>
    <AppLayout :title="poll.title">
        <h1 class="text-center font-bold text-xl">{{ poll.title }}</h1>
        <div class="mt-2" v-if="poll.description">
            {{ poll.description }}
        </div>

        <div id="poll_options" class="mt-2">
            <form @submit.prevent="submit">
                <div class="ml-2 mb-6">
                    <div class="option flex mb-2" v-for="option in poll.options">
                        <div class="w-full" v-if="alreadyVoted">
                            <div>{{ option.title }}</div>
                            <div class="text-bold w-full">{{ option.count }} ({{ calculatePercentage(option) }}%)</div>
                        </div>

                        <div class="w-full" v-else>
                            <RadioButton v-model="form.option" :inputId='"option-"+option.id' name="option"
                                         class="mr-2"
                                         :disabled="alreadyVoted"
                                         :value="option.id"/>
                            <label for="ingredient1">{{ option.title }}</label>
                        </div>
                    </div>
                </div>
                <Button type="submit" :label='$t("Submit")' :disabled="alreadyVoted" :loading="loading"/>
            </form>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
