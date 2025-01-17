<script setup lang="ts">
import { Box, Undo2, MessagesSquare, CreditCard } from 'lucide-vue-next';
</script>

<template>
    <section class="container">
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 items-center gap-12">
                <div class="text-center">
                    <div
                        class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto dark:bg-neutral-800 dark:border-neutral-700"
                    >
                        <Box class="size-6"/>
                    </div>
                    <div class="mt-3">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-white"
                        >
                            Free Shiping
                        </h3>
                        <p class="mt-1 text-gray-600 dark:text-neutral-400">
                            Free shipping on all orders over 10.000 XOF
                        </p>
                    </div>
                </div>
                <!-- End Icon Block -->

                <!-- Icon Block -->
                <div class="text-center">
                    <div
                        class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto dark:bg-neutral-800 dark:border-neutral-700"
                    >
                    <Undo2 class="size-6"/>

                    </div>
                    <div class="mt-3">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-white"
                        >
                            Returns
                        </h3>
                        <p class="mt-1 text-gray-600 dark:text-neutral-400">
                            Within 30 days for a refund or exchange
                        </p>
                    </div>
                </div>
                <!-- End Icon Block -->

                <!-- Icon Block -->
                <div class="text-center">
                    <div
                        class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto dark:bg-neutral-800 dark:border-neutral-700"
                    >
                    <MessagesSquare class="size-6"/>

                    </div>
                    <div class="mt-3">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-white"
                        >
                            Support
                        </h3>
                        <p class="mt-1 text-gray-600 dark:text-neutral-400">
                            Friendly customer support 24/7
                        </p>
                    </div>
                </div>
                <div class="text-center">
                    <div
                        class="flex justify-center items-center size-12 bg-gray-50 border border-gray-200 rounded-full mx-auto dark:bg-neutral-800 dark:border-neutral-700"
                    >
                    <CreditCard class="size-6"/>

                    </div>
                    <div class="mt-3">
                        <h3
                            class="text-lg font-semibold text-gray-800 dark:text-white"
                        >
                            Flexible Payments
                        </h3>
                        <p class="mt-1 text-gray-600 dark:text-neutral-400">
                            We accept the most popular payment methods
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
