<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet';
import NavLink from '@/Components/NavLink.vue';
import ToggleTheme from '@/Components/Utils/ToggleTheme.vue';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/Components/ui/tooltip';
import { Home, LineChart, Package, PanelLeft, Search, Settings, ShoppingCart, Users2 } from 'lucide-vue-next';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import UserProfile from '@/Components/Auth/UserProfile.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
  <div class="flex min-h-screen w-full flex-col bg-muted/40">
    <aside class="fixed inset-y-0 left-0 z-10 hidden w-14 flex-col border-r bg-background sm:flex">
      <nav class="flex flex-col items-center gap-4 px-2 py-4">
        <Link :href="route('home')" class="group flex h-9 w-9 shrink-0 items-center justify-center gap-2 rounded-full hover:bg-muted text-lg font-semibold text-primary-foreground md:h-8 md:w-8 md:text-base">
          <ApplicationLogo class="h-5 w-5 transition-all group-hover:scale-110" />
        </Link>
        <TooltipProvider>
          <Tooltip>
            <TooltipTrigger as-child>
              <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                <Home class="h-5 w-5" />
                <span class="sr-only">Dashboard</span>
              </NavLink>
            </TooltipTrigger>
            <TooltipContent side="right"> Dashboard </TooltipContent>
          </Tooltip>
        </TooltipProvider>
        <TooltipProvider>
          <Tooltip>
            <TooltipTrigger as-child>
              <NavLink :href="route('orders.index')" :active="route().current('orders.index')">
                <ShoppingCart class="h-5 w-5" />

                <span class="sr-only">Orders</span>
              </NavLink>
            </TooltipTrigger>
            <TooltipContent side="right"> Orders </TooltipContent>
          </Tooltip>
        </TooltipProvider>
        <TooltipProvider>
          <Tooltip>
            <TooltipTrigger as-child>
              <NavLink :href="route('products.index')" :active="route().current('products.index')">
                <Package class="h-5 w-5" />
                <span class="sr-only">Products</span>
              </NavLink>
            </TooltipTrigger>
            <TooltipContent side="right"> Products </TooltipContent>
          </Tooltip>
        </TooltipProvider>
        <TooltipProvider>
          <Tooltip>
            <TooltipTrigger as-child>
              <NavLink :href="route('customers.index')" :active="route().current('customers.index')">
                <Users2 class="h-5 w-5" />
                <span class="sr-only">Customers</span>
              </NavLink>
            </TooltipTrigger>
            <TooltipContent side="right"> Customers </TooltipContent>
          </Tooltip>
        </TooltipProvider>
      </nav>
      <nav class="mt-auto flex flex-col items-center gap-4 px-2 py-4">
        <TooltipProvider>
          <Tooltip>
            <TooltipTrigger as-child>
                <NavLink :href="route('settings')" :active="route().current('settings')">
                <Settings class="h-5 w-5" />
                <span class="sr-only">Settings</span>
              </NavLink>
            </TooltipTrigger>
            <TooltipContent side="right"> Settings </TooltipContent>
          </Tooltip>
        </TooltipProvider>
      </nav>
    </aside>
    <div class="flex flex-col sm:gap-4 sm:py-4 sm:pl-14">
      <header class="sticky top-0 z-30 flex h-14 items-center gap-4 border-b bg-background px-4 sm:static sm:h-auto sm:border-0 sm:bg-transparent sm:px-6">
        <Sheet>
          <SheetTrigger as-child>
            <Button size="icon" variant="outline" class="sm:hidden">
              <PanelLeft class="h-5 w-5" />
              <span class="sr-only">Toggle Menu</span>
            </Button>
          </SheetTrigger>
          <SheetContent side="left" class="sm:max-w-xs">
            <nav class="grid gap-6 text-lg font-medium">
              <Link :href="route('home')" class="group flex h-9 w-9 shrink-0 items-center justify-center gap-2 rounded-full hover:bg-muted text-lg font-semibold text-primary-foreground md:h-8 md:w-8 md:text-base">
                <ApplicationLogo class="h-5 w-5 transition-all group-hover:scale-110" />
              </Link>
              <Link :href="route('dashboard')" :class="route().current('dashboard') ? 'flex items-center gap-4 px-2.5 text-foreground hover:text-foreground' : 'flex items-center gap-4 px-2.5 text-muted-foreground hover:text-foreground'">
                <Home class="h-5 w-5" />
                Dashboard
              </Link>
              <Link :href="route('orders.index')" class="flex items-center gap-4 px-2.5 text-muted-foreground hover:text-foreground">
                <ShoppingCart class="h-5 w-5" />
                Orders
              </Link>
              <Link :href="route('products.index')" class="flex items-center gap-4 px-2.5 text-muted-foreground">
                <Package class="h-5 w-5" />
                Products
              </Link>
              <Link :href="route('customers.index')" class="flex items-center gap-4 px-2.5 text-muted-foreground hover:text-foreground">
                <Users2 class="h-5 w-5" />
                Customers
              </Link>
              <Link :href="route('settings')" class="flex items-center gap-4 px-2.5 text-muted-foreground hover:text-foreground">
                <LineChart class="h-5 w-5" />
                Settings
              </Link>
            </nav>
          </SheetContent>
        </Sheet>

        <slot name="header" />

        <div class="relative ml-auto flex items-center md:grow-0">
          <Search class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground" />
          <Input type="search" placeholder="Search..." class="w-full rounded-lg bg-background pl-8 md:w-[200px] lg:w-[320px]" />
        </div>
        <ToggleTheme />
        <UserProfile :user="user" />
      </header>
      <main class="grid flex-1 items-start gap-4 p-4 sm:px-6 sm:py-0 md:gap-8">
        <slot />
      </main>
    </div>
  </div>
</template>
