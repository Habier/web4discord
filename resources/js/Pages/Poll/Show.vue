<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {usePage, router} from '@inertiajs/vue3';

const props = defineProps({
    poll: Object
});

function onPageChange(event) {
    const page = event.page + 1;
    router.get(usePage().url, {page});
}
</script>

<template>
    <AppLayout :title="poll.title">
    </AppLayout>
</template>

<style scoped>

</style>
