<script setup lang="ts">
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Link, useForm } from "@inertiajs/vue3";
import ToggleTheme from "../Utils/ToggleTheme.vue";

// defineProps<{
//     canResetPassword?: boolean;
//     status?: string;
// }>();

const canResetPassword = true;

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => {
            form.reset("password");
        },
    });
};
</script>

<template>
    <div class="my-6">
        <p class="text-3xl font-bold my-4">Connect and Shop</p>
        <div>
            Don't have an account?
            <Link
                :href="route('register')"
                class="rounded-md text-sm text-gray-600 underline hover:text-primary focus:outline-none focus:primary focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
            >
                Create an account
            </Link>
        </div>
    </div>
    <form @submit.prevent="submit">
        <div>
            <Label for="email">Email</Label>

            <Input
                id="email"
                type="email"
                class="mt-2 block w-full"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
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

        <div class="mt-4 flex justify-between">
            <label class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember" />
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400"
                    >Remember me</span
                >
            </label>

            <Link
                v-if="canResetPassword"
                :href="route('password.request')"
                class="rounded-md text-sm text-gray-600 underline hover:text-primary focus:outline-none  focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
            >
                Forgot your password?
            </Link>
        </div>

        <div class="mt-4 flex items-center w-full justify-end">
            <Button
                class="w-full"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Log in
            </Button>
        </div>
    </form>
</template>
