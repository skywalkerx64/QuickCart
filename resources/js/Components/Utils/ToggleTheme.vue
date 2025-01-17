<script setup lang="ts">
import { useColorMode } from "@vueuse/core";
import { Button } from "@/Components/ui/button";
import { Moon, Sun } from "lucide-vue-next";

const mode = useColorMode();
let theme = localStorage.getItem('theme') as "light" | "dark" | "auto";
if (!theme) {
  theme = "dark";
  localStorage.setItem('theme', theme);
}
mode.value = localStorage.getItem('theme') as "light" | "dark" | "auto";

function toggleTheme() {
    mode.value = mode.value === "dark" ? "light" : "dark";
    localStorage.setItem('theme', mode.value);
}
</script>

<template>
  <Button
    @click="toggleTheme"
    size="sm"
    variant="ghost"
    class="w-fit justify-start"
  >
    <div
      v-if="mode == 'light'"
      class="flex gap-2"
    >
      <Moon class="size-5" />
      <span class="block lg:hidden"> Dark </span>
    </div>

    <div
      v-else="mode == 'dark'"
      class="flex gap-2"
    >
      <Sun class="size-5" />
      <span class="block lg:hidden">Light</span>
    </div>

    <span class="sr-only">Toggle theme</span>
  </Button>
</template>
