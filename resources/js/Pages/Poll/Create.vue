<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {useForm} from '@inertiajs/vue3';
import {Button} from "primevue";

let form = useForm({
    title: String,
    description: String,
    options: Array
});

let loading = false;

function submit() {
    form.post(route("polls.store", props.poll.id));
}
</script>

<template>
    <AppLayout title="Create poll">
        <h1>Create a new Poll</h1>

        <div id="poll_options">
            <form @submit.prevent="submit">


                <Button type="submit" label="Submit" :loading="loading"/>
            </form>
        </div>
    </AppLayout>
</template>
