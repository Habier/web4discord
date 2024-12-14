<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { usePage, router } from '@inertiajs/vue3';

const props = defineProps({
    polls: Object
});

function onPageChange(event) {
    const page = event.page + 1;
    router.get(usePage().url, { page });
}
</script>

<template>
    <AppLayout title="Polls">
        <DataTable :value="polls.data"
                   :lazy="true"
                   :paginator="true"
                   :rows="polls.per_page"
                   :totalRecords="polls.total"
                   :first="(polls.current_page - 1) * polls.per_page"
                   @page="onPageChange"
                   tableStyle="min-width: 50rem">
            <Column field="user.name" header="User" style="width: 25%"></Column>
            <Column field="title" header="Title" style="width: 50%"></Column>
            <Column field="created_at" header="Date" style="width: 25%"></Column>
        </DataTable>
    </AppLayout>
</template>

<style scoped>

</style>
