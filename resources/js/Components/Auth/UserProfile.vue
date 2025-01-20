<script setup lang="ts">
import { DropdownMenu, DropdownMenuContent, DropdownMenuGroup, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu';
import { Avatar, AvatarFallback } from '@/Components/ui/avatar';
import { BadgeCheck, Bell, CircleUser, LogOut, LayoutDashboard, Package } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { User } from '@/types';
import { computed } from 'vue';
import { ADMIN_ROLE_ALIAS, hasRoles } from '@/lib/utils';

const props = defineProps<{
  user: User;
}>();

const isAdmin = computed(() => hasRoles(props.user, [ADMIN_ROLE_ALIAS]));

const user = props.user;
</script>
<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="secondary" size="icon" class="rounded-full">
        <CircleUser class="h-5 w-5" />
        <span class="sr-only">Toggle user menu</span>
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent class="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg" side="bottom" align="end" :side-offset="4">
      <DropdownMenuLabel class="p-0 font-normal">
        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
          <Avatar class="h-8 w-8 rounded-lg">
            <AvatarFallback class="rounded-lg capitalize">
              {{
                user.name
                  .split(' ')
                  .map((n) => n[0])
                  .join('')
              }}
            </AvatarFallback>
          </Avatar>
          <div class="grid flex-1 text-left text-sm leading-tight">
            <span class="truncate font-semibold">{{ user.name }}</span>
            <span class="truncate text-xs">{{ user.email }}</span>
          </div>
        </div>
      </DropdownMenuLabel>
      <DropdownMenuSeparator />
      <DropdownMenuItem v-if="isAdmin">
        <LayoutDashboard />
        <Link :href="route('dashboard')"> Dashboard </Link>
      </DropdownMenuItem>
      <DropdownMenuItem v-else>
        <Package />
        <Link :href="route('orders.my-orders')"> My Orders </Link>
      </DropdownMenuItem>
      <DropdownMenuItem>
        <BadgeCheck />
        Account
      </DropdownMenuItem>
      <DropdownMenuItem>
        <Bell />
        Notifications
      </DropdownMenuItem>
      <DropdownMenuSeparator />
      <Link :href="route('logout')" method="post" as="button" class="w-full">
        <DropdownMenuItem>
          <LogOut />
          Log Out
        </DropdownMenuItem>
      </Link>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
