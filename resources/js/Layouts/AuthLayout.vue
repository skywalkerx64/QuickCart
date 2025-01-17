<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ToggleTheme from "@/Components/Utils/ToggleTheme.vue";
</script>

<template>
    <div class="min-h-screen dark:bg-black lg:grid lg:grid-cols-2">
        <div class="md:h-screen p-10 hidden lg:block bg-zinc-900">
            <a href="/" class="flex items-center gap-2 text-white font-bold text-2xl">
                <ApplicationLogo class="size-8" />
                QuickCart
            </a>
        </div>
        <div
            class="md:h-screen h-screen flex items-center justify-center w-full"
        >
            <div class="w-full">
                <div class="w-full max-w-md mx-auto p-6">
                    <ToggleTheme class="absolute top-4 right-4" />
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
