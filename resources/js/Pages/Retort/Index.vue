<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {TrashIcon} from '@heroicons/vue/24/solid'
import {router, useForm} from "@inertiajs/vue3";
import {Button} from "primevue";
import Textarea from 'primevue/textarea';
import {useConfirm} from "primevue/useconfirm";
import {ref} from "vue";
import i18n from "@/i18n";

const confirm = useConfirm();

const props = defineProps({
    retorts: Array
});

const form = useForm({
    question: null
});

const trashLoading = ref(-1);

function handleDelete(id) {
    confirm.require({
        message: i18n.global.t("Are you sure you want to proceed?"),
        header: i18n.global.t("Confirmation"),
        icon: 'pi pi-exclamation-triangle',
        rejectProps: {
            label: i18n.global.t("Cancel"),
            severity: 'secondary',
            outlined: true
        },
        acceptProps: {
            label: i18n.global.t("Accept")
        },
        accept: () => {
            this.trashLoading = id;
            router.delete(route('retorts.destroy', id));
            //toast.add({ severity: 'info', summary: 'Confirmed', detail: 'You have accepted', life: 3000 });
        },
        reject: () => {
            //toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
        }
    });
}

function submit() {
    form.post(route('retorts.store'));
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
                <label for="message" class="block text-gray-700 dark:text-gray-300 mb-2">{{$t("Question")}}</label>
                <Textarea class="w-full" v-model="form.question" rows="5" cols="30"/>
                <div class="text-danger" v-if="form.errors.question">{{ form.errors.question }}</div>

                <div class="flex justify-center items-center space-x-4">
                    <Button :label='$t("Submit")' class="mr-4" type="submit" :loading="form.processing"/>
                    <Button as="a" :label='$t("Download")' :href="route('retorts.download')" target="_blank" rel="noopener"/>
                </div>
            </form>

            <div class="mt-2">

                <div v-for="retort in retorts" class="flex mb-2">
                    <div class="w-1/12 flex items-center">
                        <Button class=" m-auto" @click="handleDelete(retort.id)" ref="trash-{{retort.id}}"
                                :loading="trashLoading===retort.id">
                            <TrashIcon class="size-6 text-danger"/>
                        </Button>
                    </div>
                    <div class="w-11/12 flex items-center">
                        {{ retort.question }}
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
