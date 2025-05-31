<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Head, Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { initFlowbite } from 'flowbite';
import { onMounted, ref, watch } from 'vue';

onMounted(() => {
    initFlowbite();
    fetchProvinces();
});

const provinces = ref([]);
const districts = ref([]);

const form = useForm({
    name: '',
    phone: '',
    email: '',
    province: '',
    district: '',
});

const showSuccessAlert = ref(false);

const fetchProvinces = async () => {
    try {
        const response = await axios.get('https://turkiyeapi.dev/api/v1/provinces');
        provinces.value = response.data.data;
    } catch (error) {
        console.error('Error fetching provinces:', error);
    }
};

watch(
    () => form.province,
    async (newProvinceName) => {
        const selectedProvince = provinces.value.find((p) => p.name === newProvinceName);

        if (selectedProvince) {
            try {
                const response = await axios.get(`https://turkiyeapi.dev/api/v1/provinces/${selectedProvince.id}`);
                districts.value = response.data.data.districts;
            } catch (error) {
                console.error('Error fetching districts:', error);
            }
        } else {
            districts.value = [];
        }
    },
);

function submit() {
    form.post(route('forms.store'), {
        preserveScroll: true,
        onSuccess: () => {
            showSuccessAlert.value = true;
            setTimeout(() => {
                showSuccessAlert.value = false;
            }, 5000);
            form.reset();
        },
    });
}
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
        <header class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">
            <nav class="flex items-center justify-end gap-4">
                <Link
                    :href="route('home')"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Home
                </Link>
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">
            <main class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row">
                <div class="container my-5">
                    <div
                        v-if="showSuccessAlert"
                        class="mb-4 flex items-center justify-between rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
                        role="alert"
                        aria-live="polite"
                    >
                        <span>{{ $page.props.flash?.success || 'Your form has been submitted successfully.' }}</span>
                        <button
                            @click="showSuccessAlert = false"
                            class="text-green-800 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                            aria-label="Close alert"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form @submit.prevent="submit">
                        <div class="grid gap-2">
                            <Label for="name">Name Surname:</Label>
                            <Input id="name" type="text" class="mt-1 block w-full" v-model="form.name" placeholder="Name Surname" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-2 grid gap-2">
                            <Label for="phone">Phone:</Label>
                            <Input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" placeholder="Phone" />
                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>

                        <div class="mt-2 grid gap-2">
                            <Label for="email">Email:</Label>
                            <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" placeholder="Email" />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-2 grid gap-2">
                            <Label for="province">Province:</Label>
                            <select
                                id="province"
                                class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                                v-model="form.province"
                            >
                                <option value="" disabled>Select a province</option>
                                <option v-for="province in provinces" :key="province.id" :value="province.name">
                                    {{ province.name }}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.province" />
                        </div>

                        <div class="mt-2 grid gap-2">
                            <Label for="district">Disctrict:</Label>
                            <select
                                id="district"
                                class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                                v-model="form.district"
                            >
                                <option value="" disabled>Select a district</option>
                                <option v-for="district in districts" :key="district.id" :value="district.name">
                                    {{ district.name }}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.district" />
                        </div>

                        <div class="mt-2 flex items-center gap-4">
                            <Button>Create</Button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
