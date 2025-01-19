<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { HeartIcon, PlusIcon } from 'lucide-vue-next';
import { Product } from '@/types';

const props = defineProps<{
  product: Product;
}>();
const product = props.product;
</script>

<template>
  <div class="w-full h-full flex justify-center items-start">
    <div class="max-w-80 px-2 h-full flex flex-col justify-between">
      <!-- Image -->
      <div class="relative w-full h-64">
        <img v-if="product.cover" :src="product.cover" :alt="product.name" class="w-full h-full object-cover rounded-lg transition-all hover:scale-105" />
        <img v-else src="@/Assets/Images/default-product.jpeg" alt="Product Image" class="w-full h-full object-cover rounded-lg" />
      </div>

      <!-- Product Details -->
      <div class="mt-4">
        <Link :href="route('products.show', product.id)" class="text-lg font-bold hover:text-primary">{{ product.name }}</Link>
        <p class="text-gray-400 text-sm mt-1" v-if="product.description">{{ product.description?.length > 80 ? product.description?.slice(0, 80) + '...' : product.description }}</p>
      </div>

      <!-- Price and Availability -->
      <div class="mt-4 flex justify-between items-center">
        <p class="text-xl font-bold">$28.99</p>
      </div>
      <div class="flex gap-4 mt-4">
        <Button variant="outline" size="icon" class="flex-shrink-0">
          <HeartIcon class="size-4" />
        </Button>
        <Button class="w-full"> <PlusIcon class="size-4 me-1" /> Add to Card </Button>
      </div>
    </div>
  </div>
</template>
