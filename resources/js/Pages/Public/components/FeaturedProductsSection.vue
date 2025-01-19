<script setup lang="ts">
import ProductCard from '@/Pages/Product/Components/ProductCard.vue';
import Button from '@/Components/ui/button/Button.vue';
import { Product } from '@/types';
import { Link } from '@inertiajs/vue3';
const props = defineProps<{
  products: Product[];
}>();
</script>

<template>
  <section id="featured" class="container py-20 sm:py-24">
    <div class="text-center mb-8">
      <h2 class="text-3xl md:text-4xl text-center font-bold">Our Featured Products</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 justify-center items-start gap-4">
      <ProductCard v-for="product in products" :key="product.id" :product="product" class="h-full" />
    </div>
    <div class="mt-8 flex justify-center">
      <Link :href="route('shop')">
        <Button variant="outline">Explore More</Button>
      </Link>
    </div>
  </section>
</template>
