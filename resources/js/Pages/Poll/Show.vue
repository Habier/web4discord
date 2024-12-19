<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {usePage, router, useForm} from '@inertiajs/vue3';
import RadioButton from 'primevue/radiobutton';
import {Button} from "primevue";

let form = useForm({
    option: null
});

const props = defineProps({
    poll: Object,
    alreadyVoted: Boolean
});

let loading = false;

function onPageChange(event) {
    const page = event.page + 1;
    router.get(usePage().url, {page});
}

function submit() {
    form.post(route("polls.vote", props.poll.id));
}
</script>

<template>
    <AppLayout :title="poll.title">
        <h1>{{ poll.title }}</h1>
        <p v-if="poll.description">
            {{ poll.description }}
        </p>

        <div id="poll_options">
            <form @submit.prevent="submit">

                <div class="option flex" v-for="option in poll.options">
                    <div class="w-full">
                        <RadioButton v-model="form.option" :inputId='"option-"+option.id' name="option"
                                     :disabled="alreadyVoted"
                                     :value="option.id"/>
                        <label for="ingredient1">{{ option.title }}</label>
                    </div>
                </div>

                <Button type="submit" label="Submit" :disabled="alreadyVoted" :loading="loading"/>
            </form>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
