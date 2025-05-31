<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
];

defineProps<{
    slidesCount: number;
    formsCount: number;
    productsCount: number;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl bg-gray-50 p-6 dark:bg-gray-900">
            <div class="grid gap-6 md:grid-cols-3">

                <div
                    class="relative flex flex-col justify-between rounded-xl border border-transparent bg-gradient-to-tr from-indigo-500 via-purple-600 to-pink-500 p-6 shadow-lg transition-transform hover:scale-[1.03] hover:shadow-2xl dark:from-indigo-600 dark:via-purple-700 dark:to-pink-600"
                >
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold tracking-wide text-white">Total Slides</h2>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7 text-white opacity-70"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M3 6h11M3 14h7m4 4h7m-7 0v-8" />
                        </svg>
                    </div>
                    <p class="mt-6 text-5xl font-extrabold text-white drop-shadow-md">{{ slidesCount }}</p>
                    <span class="mt-2 block text-sm font-medium text-indigo-100 opacity-80"> Slides active on homepage </span>
                </div>

                <div
                    class="relative flex flex-col justify-between rounded-xl border border-transparent bg-gradient-to-tr from-green-400 via-emerald-500 to-teal-500 p-6 shadow-lg transition-transform hover:scale-[1.03] hover:shadow-2xl dark:from-green-500 dark:via-emerald-600 dark:to-teal-600"
                >
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold tracking-wide text-white">Total Products</h2>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7 text-white opacity-70"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V5a1 1 0 00-1-1h-4a1 1 0 00-1 1v6" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 11h14l-7 7-7-7z" />
                        </svg>
                    </div>
                    <p class="mt-6 text-5xl font-extrabold text-white drop-shadow-md">{{ productsCount }}</p>
                    <span class="mt-2 block text-sm font-medium text-green-100 opacity-80"> Products active on homepage </span>
                </div>

                <div
                    class="relative flex flex-col justify-between rounded-xl border border-transparent bg-gradient-to-tr from-yellow-400 via-amber-500 to-orange-500 p-6 shadow-lg transition-transform hover:scale-[1.03] hover:shadow-2xl dark:from-yellow-500 dark:via-amber-600 dark:to-orange-600"
                >
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold tracking-wide text-white">Total Forms</h2>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-7 w-7 text-white opacity-70"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M6 12a6 6 0 1112 0 6 6 0 01-12 0z" />
                        </svg>
                    </div>
                    <p class="mt-6 text-5xl font-extrabold text-white drop-shadow-md">{{ formsCount }}</p>
                    <span class="mt-2 block text-sm font-medium text-yellow-100 opacity-80"> Total forms submitted </span>
                </div>
            </div>

            <div
                class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 rounded-xl border bg-white p-6 shadow-inner md:min-h-min dark:bg-gray-800"
            >

            </div>
        </div>
    </AppLayout>
</template>
