<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import {  Link  } from '@inertiajs/vue3';

</script>

<template>
  <div class="bg-sidebar-primary text-sidebar-primary-foreground flex aspect-square w-8 h-8 items-center justify-center rounded-md">
    <AppLogoIcon class="w-5 h-5 fill-current text-white dark:text-black" />
  </div>

    <div class="ml-1 grid flex-1 text-left text-sm">
      <span class="mb-0.5 truncate leading-none font-semibold">Home</span>
    </div>

</template>
