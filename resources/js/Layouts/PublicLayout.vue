<script setup lang="ts">
import AppHeader from '@/Pages/Public/components/AppHeader.vue';
import AppFooter from '@/Pages/Public/components/AppFooter.vue';
import { Toaster } from '@/Components/ui/sonner';
</script>

<template>
    <body class="min-h-screen">
        <AppHeader />
        <slot />
        <Toaster />
        <AppFooter />
    </body>
</template>
