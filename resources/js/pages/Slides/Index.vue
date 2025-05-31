<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Slides',
        href: '/admin/slides',
    },
];

const props = defineProps({
    slides: Array,
});

const form = useForm();

function deleteItem(id) {
    if (confirm('Are you sure to delete this Slide?')) {
        form.delete(route('slides.destroy', id), {
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <Head title="Slides" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <div>
                <Link href="/admin/slides/create" class="rounded bg-green-800 px-3 py-2 text-xs font-medium text-white">Create Slide</Link>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="dark bg-gray-50 text-xs text-gray-700 uppercase dark:bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">Id</th>
                            <th scope="col" class="px-6 py-3">Order</th>
                            <th scope="col" class="px-6 py-3">Text</th>
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="slide in slides" :key="slide.id" class="even:dark:bg-gray odd:bg-white even:bg-gray-50 odd:dark:bg-gray-900">
                            <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">{{ slide.id }}</td>
                            <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ slide.order }}</td>
                            <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ slide.text }}</td>
                            <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                                <img :src="`/storage/${slide.image}`" alt="Slide Image" class="h-16 w-auto rounded" />
                            </td>

                            <td class="px-6 py-2">
                                <Link :href="`slides/${slide.id}/edit`" class="rounded bg-blue-800 px-3 py-2 text-xs font-medium text-white"
                                    >Edit</Link
                                >
                                <button @click="deleteItem(slide.id)" class="ml-1 rounded bg-red-800 px-3 py-2 text-xs font-medium text-white">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </AppLayout>
</template>
