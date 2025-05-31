<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit Product',
        href: '/admin/products/edit',
    },
];

const props = defineProps({
    product: Object,
});

const form = useForm({
    text: props.product.text,
    order: props.product.order,
    image: '',
});


function submit() {
    form.post(route('products.update', props.product.id), {
        preserveScroll: true,
        forceFormData: true,
        method: 'put',
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <Head title="Edit Product" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <Link href="/admin/products" class="rounded bg-blue-800 px-3 py-2 text-xs font-medium text-white">Go Back</Link>
            </div>

            <form @submit.prevent="submit">
                <div class="grid gap-2">
                    <Label for="order">Order:</Label>
                    <Input id="order" type="number" class="mt-1 block w-full" v-model="form.order" placeholder="Order" />
                    <InputError class="mt-2" :message="form.errors.order" />
                </div>

                <div class="mt-2 grid gap-2">
                    <Label for="text">Text:</Label>
                    <Input id="text" type="text" class="mt-1 block w-full" v-model="form.text" placeholder="Text" />
                    <InputError class="mt-2" :message="form.errors.text" />
                </div>

                <div class="mt-2 grid gap-2">
                    <Label for="image">Image:</Label>
                    <Input
                        id="image"
                        type="file"
                        class="mt-1 block w-full"
                        placeholder="Image"
                        accept="image/*"
                        @input="form.image = $event.target.files[0]"
                    />
                    <InputError class="mt-2" :message="form.errors.image" />
                </div>

                <div class="mt-2 flex items-center gap-4">
                    <Button>Update</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
