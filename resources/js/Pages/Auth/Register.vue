<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import RegisterForm from '@/Components/Auth/RegisterForm.vue';
</script>

<template>
    <Head title="Register"/>
    <AuthLayout>
        <RegisterForm/>
    </AuthLayout>
</template>
