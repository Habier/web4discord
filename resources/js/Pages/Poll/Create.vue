<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {useForm} from '@inertiajs/vue3';
import {Button, InputText, Textarea} from "primevue";
import {TrashIcon, PlusIcon} from "@heroicons/vue/24/solid/index.js";

let form = useForm({
    title: "",
    description: "",
    options: ["", ""]
});

let loading = false;

function submit() {
    form.post(route("polls.store", props.poll.id));
}

function handleDelete(i) {
    if (i > 1)
        form.options.splice(i, 1);
}

function handleAddOption()
{
    form.options.push("")
}
</script>

<template>
    <AppLayout title="Create poll">
        <h1>Create a new Poll</h1>

        <div id="poll_options">
            <form @submit.prevent="submit">
                <InputText class="w-full mb-2" type="text" v-model="form.title" placeholder="Title of the poll"
                           required/>

                <Textarea id="poll-description" class="w-full"
                          v-model="form.description"
                          placeholder="Write your description"
                          rows="5" cols="30"/>
                <div class="w-full">
                    <ul class="w-full">
                        <li v-for="(option,i) in form.options" class="mb-2 flex">
                            <InputText class="w-7/12" type="text" v-model="form.options[i]" placeholder="Option text"/>
                            <div class="w-1/12">
                                <Button v-if="i>1" class="ml-2 m-auto" @click="handleDelete(i)">
                                    <TrashIcon class="size-6 text-danger"/>
                                </Button>
                            </div>
                        </li>

                        <li class="mb-2 flex">
                            <InputText class="w-7/12" type="text" placeholder="Add more options" disabled/>
                            <div class="w-1/12">
                                <Button class="ml-2 m-auto" @click="handleAddOption()">
                                    <PlusIcon class="size-6 text-info"/>
                                </Button>
                            </div>
                        </li>
                    </ul>
                </div>
                <Button type="submit" label="Submit" :loading="loading"/>
            </form>
        </div>
    </AppLayout>
</template>
