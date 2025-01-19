<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import { ArrowRight } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <section class="container">
    <div class="grid place-items-center lg:max-w-screen-xl gap-8 mx-auto pt-16 md:pt-28">
      <div class="text-center space-y-8">
        <div class="max-w-screen-md mx-auto text-center text-5xl md:text-6xl font-bold">
          <h1>
            Shop ,
            <span class="text-transparent bg-gradient-to-r from-[#D247BF] to-primary bg-clip-text">Smarter </span>
            Live
            <span class="text-transparent bg-gradient-to-r from-[#D247BF] to-primary bg-clip-text">Better! </span>
          </h1>
        </div>

        <p class="max-w-screen-sm mx-auto text-xl text-muted-foreground">Discover millions of products at unbeatable prices, delivered to your door in no time. 🚀</p>

        <div class="space-y-4 md:space-y-0 md:space-x-4">
          <Link :href="route('shop')">
            <Button class="w-5/6 md:w-1/4 font-bold group/arrow">
              Start Shopping Now
              <ArrowRight class="size-5 ml-2 group-hover/arrow:translate-x-1 transition-transform" />
            </Button>
          </Link>
        </div>
      </div>

      <div class="relative group mt-14"></div>
    </div>
  </section>
</template>
