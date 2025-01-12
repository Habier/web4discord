<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout :title='$t("Dashboard")'>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                {{$t("Dashboard")}}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                </div>
            </div>
        </div>
    </AppLayout>
</template>
