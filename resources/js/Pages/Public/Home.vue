<script setup lang="ts">
import PublicLayout from '@/Layouts/PublicLayout.vue';
import HeroSection from '@/Pages/Public/components/HeroSection.vue';
import FaqSection from '@/Pages/Public/components/FaqSection.vue';
import FeaturesSection from '@/Pages/Public/components/FeaturesSection.vue';
import FeaturedProductsSection from './components/FeaturedProductsSection.vue';
import { Head } from '@inertiajs/vue3';
import { Product } from '@/types';

const props = defineProps<{
    featuredProducts: Product[];
}>();
</script>

<template>
  <Head title="QuickCart - Your Ultimate Shopping Companion" />
  <PublicLayout>
    <HeroSection />
    <FeaturedProductsSection :products="props.featuredProducts"/>
    <FeaturesSection />
    <FaqSection />
  </PublicLayout>
</template>
