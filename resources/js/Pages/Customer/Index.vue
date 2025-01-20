<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import CustomerList from './Components/CustomerList.vue';

const props = defineProps<{ customers: any }>();
</script>

<template>
    <Head title="Customers" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Customers
            </h2>
        </template>

        <div class="py-10">
            <CustomerList :customers="props.customers"/>
        </div>
    </AuthenticatedLayout>
</template>
