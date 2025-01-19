<script setup lang="ts">
import LandingLayout from '@/Layouts/PublicLayout.vue';
import { Head } from '@inertiajs/vue3';
import HeroCarrousel from './components/HeroCarrousel.vue';
import { Product, ProductCategory } from '@/types';
import ProductCard from '../Product/Components/ProductCard.vue';
import ProductFilter from '../Product/Components/ProductFilter.vue';
import Button from '@/Components/ui/button/Button.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
  categories: ProductCategory[];
  products: {
    current_page: number;
    data: Product[];
    links: {
      url: string;
      label: string;
      active: boolean;
    }[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    next_page_url: string;
    path: string;
    per_page: number;
    prev_page_url: string;
    to: number;
    total: number;
  };
}>();
</script>

<template>
  <Head title="QuickCart - Shop" />
  <LandingLayout class="h-full">
    <HeroCarrousel />
    <div class="text-center pt-10 px-4">
        <div class="font-bold text-4xl">Shop</div>
        <p class="max-w-screen-md mx-auto mt-4 text-muted-foreground">
          Browse through our collection of products, and discover new brands and products that you will love.
        </p>
    </div>
    <div class="container pt-10">
      <div class="">
        <ProductFilter :categories="props.categories"></ProductFilter>
      </div>
      <div class="pt-4 pb-20 sm:py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 justify-center items-start gap-y-8">
          <ProductCard v-for="product in props.products.data" :key="product.id" :product="product" class="h-full" />
        </div>
        <div class="flex justify-between items-center py-8 container">
          <div class="text-xs text-muted-foreground">
            Showing
            <strong>{{ props.products.from + '-' + props.products.to }}</strong>
            of <strong>{{ props.products.total }}</strong>
            products
          </div>
          <div class="flex gap-2 mt-4">
            <Link v-for="link in props.products.links" :href="link.url">
              <Button v-html="link.label" :variant="link.active ? 'default' : 'outline'" :key="link.url"> </Button>
            </Link>
          </div>
          <div></div>
        </div>
      </div>
    </div>
  </LandingLayout>
</template>
