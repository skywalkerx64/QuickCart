<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ProductList from './Components/ProductList.vue';

const props = defineProps<{ products: any }>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Products
            </h2>
        </template>

        <div class="py-10">
            <ProductList :products="props.products"/>
        </div>
    </AuthenticatedLayout>
</template>
