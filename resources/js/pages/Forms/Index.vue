<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Forms',
        href: '/admin/forms',
    },
];


const props = defineProps({
    forms: Array,
});

const form = useForm();

function deleteItem(id) {
    if (confirm('Are you sure to delete this Form?')) {
        form.delete(route('forms.destroy', id), {
            preserveScroll: true,
        });
    }
}
</script>

<template>
    <Head title="Forms" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">


            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="dark bg-gray-50 text-xs text-gray-700 uppercase dark:bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">Id</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Phone</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Province</th>
                            <th scope="col" class="px-6 py-3">District</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="form in forms" :key="form.id" class="even:dark:bg-gray odd:bg-white even:bg-gray-50 odd:dark:bg-gray-900">
                            <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">{{ form.id }}</td>
                            <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ form.name }}</td>
                            <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ form.phone }}</td>
                            <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">{{ form.email }}</td>
                            <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ form.province }}</td>
                            <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ form.district }}</td>



                            <td class="px-6 py-2">

                                <button @click="deleteItem(form.id)" class="ml-1 rounded bg-red-800 px-3 py-2 text-xs font-medium text-white">
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
