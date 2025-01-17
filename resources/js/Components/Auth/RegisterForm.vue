<script setup lang="ts">
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => {
            form.reset("password", "password_confirmation");
        },
    });
};
</script>

<template>
    <div class="my-6">
        <p class="text-3xl font-bold my-4">Create your account</p>
        <div>
            Already have an account?
            <Link
                :href="route('login')"
                class="rounded-md text-sm text-gray-600 underline hover:text-primary focus:outline-none dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
            >
                Log in
            </Link>
        </div>
    </div>
    <form @submit.prevent="submit">
        <div>
            <Label for="name">Name</Label>

            <Input
                id="name"
                type="name"
                class="mt-2 block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div class="mt-4">
            <Label for="email">Email</Label>

            <Input
                id="email"
                type="email"
                class="mt-2 block w-full"
                v-model="form.email"
                required
                autofocus
                autocomplete="email"
            />

            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <Label for="password">Password</Label>

            <Input
                id="password"
                type="password"
                class="mt-2 block w-full"
                v-model="form.password"
                required
                autocomplete="current-password"
            />

            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <Label for="password_confirmation">Password Confirmation</Label>

            <Input
                id="password_confirmation"
                type="password"
                class="mt-2 block w-full"
                v-model="form.password_confirmation"
                required
                autocomplete="password_confirmation"
            />

            <InputError
                class="mt-2"
                :message="form.errors.password_confirmation"
            />
        </div>

        <div class="mt-4 flex justify-between"></div>

        <div class="mt-4 flex items-center w-full justify-end">
            <Button
                class="w-full"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Create an account
            </Button>
        </div>
    </form>
</template>
