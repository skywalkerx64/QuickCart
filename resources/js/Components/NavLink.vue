<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    href: string;
    active?: boolean;
}>();

const classes = computed(() =>
    props.active
        ? 'flex h-9 w-9 items-center justify-center rounded-lg bg-muted text-primary transition-colors hover:text-foreground hover:bg-muted md:h-8 md:w-8'
        : 'flex h-9 w-9 items-center justify-center rounded-lg text-muted-foreground transition-colors hover:text-foreground hover:bg-muted md:h-8 md:w-8',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
