<script setup lang="ts">
import LandingLayout from '@/Layouts/PublicLayout.vue';
import HeroSection from '@/Pages/Public/components/HeroSection.vue';
import FaqSection from '@/Pages/Public/components/FaqSection.vue';
import FeaturesSection from '@/Pages/Public/components/FeaturesSection.vue';
import { Head } from '@inertiajs/vue3'


</script>

<template>
    <Head title="QuickCart - Your Ultimate Shopping Companion" />
    <LandingLayout>
        <HeroSection/>
        <FeaturesSection/>
        <FaqSection/>
    </LandingLayout>
</template>
