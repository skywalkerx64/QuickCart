<script setup lang="ts">
    import ToggleTheme from '@/Components/Utils/ToggleTheme.vue';
</script>
<template>
    <!-- ========== FOOTER ========== -->
    <footer class="w-[90%] md:w-[70%] lg:w-[75%] lg:max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-6 border-t border-gray-200 dark:border-neutral-700">
            <div class="flex flex-wrap justify-between items-center gap-2">
                <div>
                    <p class="text-xs text-gray-600 dark:text-neutral-400">
                        © 2024 QuickCart.
                    </p>
                </div>
                <!-- End Col -->

                <!-- List -->
                <ul class="flex flex-wrap items-center">
                    <li
                        class="inline-block relative pe-4 text-xs last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-1.5 before:-translate-y-1/2 before:size-[3px] before:rounded-full before:bg-gray-400 dark:text-neutral-500 dark:before:bg-neutral-600"
                    >
                        <a
                            class="text-xs text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400"
                            href="#"
                        >
                            X (Twitter)
                        </a>
                    </li>
                    <li
                        class="inline-block relative pe-4 text-xs last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-1.5 before:-translate-y-1/2 before:size-[3px] before:rounded-full before:bg-gray-400 dark:text-neutral-500 dark:before:bg-neutral-600"
                    >
                        <a
                            class="text-xs text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400"
                            href="#"
                        >
                            Dribbble
                        </a>
                    </li>
                    <li class="inline-block pe-4 text-xs">
                        <a
                            class="text-xs text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400"
                            href="https://github.com/skywalkerx64/QuickCart"
                        >
                            Github
                        </a>
                    </li>
                    <li class="inline-block">
                        <ToggleTheme />
                    </li>
                </ul>
                <!-- End List -->
            </div>
        </div>
    </footer>
    <!-- ========== END FOOTER ========== -->
</template>
