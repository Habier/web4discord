<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import {Button} from "primevue";
import {usePage, router, Link} from '@inertiajs/vue3';

const props = defineProps({
    polls: Object
});

function onPageChange(event) {
    const page = event.page + 1;
    router.get(usePage().url, {page});
}
</script>

<template>
    <AppLayout :title='$t("Polls")'>
        <div class="w-full flex justify-center">
            <Button as="a" :label='$t("Create")' :href="route('polls.create')" />
        </div>
        <DataTable :value="polls.data"
                   :lazy="true"
                   :paginator="true"
                   :rows="polls.per_page"
                   :totalRecords="polls.total"
                   :first="(polls.current_page - 1) * polls.per_page"
                   @page="onPageChange"
                   tableStyle="min-width: 50rem">
            <Column field="user.name" :header='$t("User")' style="width: 25%"></Column>
            <Column field="title" :header='$t("Title")' style="width: 50%">
                <template #body="item">
                    <Link :href="route('polls.show',item.data.id)">
                        {{ item.data.title }}
                    </Link>
                </template>

            </Column>
            <Column field="created_at" :header='$t("Date")' style="width: 25%"></Column>
        </DataTable>
    </AppLayout>
</template>

<style scoped>

</style>
