<script setup lang="ts">
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Head } from '@inertiajs/vue3';
import OrderList from './Components/OrderList.vue';

const props = defineProps<{ orders: any }>();
</script>

<template>
  <Head title="QuickCart - My Orders" />
  <PublicLayout>
    <div class="container mt-10">
        <OrderList :orders="props.orders"/>
    </div>
  </PublicLayout>
</template>
