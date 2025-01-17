<script setup lang="ts">
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/Components/ui/dropdown-menu";
import { Avatar, AvatarFallback } from "@/Components/ui/avatar";
import {
    BadgeCheck,
    Bell,
    CircleUser,
    CreditCard,
    LogOut,
    Sparkles,
} from "lucide-vue-next";
import { Link } from '@inertiajs/vue3';
import { Button } from "@/Components/ui/button";
import { User } from "@/types";

const props = defineProps<{
    user: User;
}>();

const user = props.user

</script>
<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="secondary" size="icon" class="rounded-full">
                <CircleUser class="h-5 w-5" />
                <span class="sr-only">Toggle user menu</span>
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent
            class="w-[--radix-dropdown-menu-trigger-width] min-w-56 rounded-lg"
            side="bottom"
            align="end"
            :side-offset="4"
        >
            <DropdownMenuLabel class="p-0 font-normal">
                <div
                    class="flex items-center gap-2 px-1 py-1.5 text-left text-sm"
                >
                    <Avatar class="h-8 w-8 rounded-lg">
                        <!-- <AvatarImage
                            :src="user.avatar"
                            :alt="user.name"
                        /> -->
                        <AvatarFallback class="rounded-lg capitalize">
                            {{
                                user.name
                                    .split(" ")
                                    .map((n) => n[0])
                                    .join("")
                            }}
                        </AvatarFallback>
                    </Avatar>
                    <div class="grid flex-1 text-left text-sm leading-tight">
                        <span class="truncate font-semibold">{{
                            user.name
                        }}</span>
                        <span class="truncate text-xs">{{
                            user.email
                        }}</span>
                    </div>
                </div>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuGroup>
                <DropdownMenuItem>
                    <Sparkles />
                    Upgrade to Pro
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuSeparator />
            <DropdownMenuGroup>
                <DropdownMenuItem>
                    <BadgeCheck />
                    Account
                </DropdownMenuItem>
                <DropdownMenuItem>
                    <CreditCard />
                    Billing
                </DropdownMenuItem>
                <DropdownMenuItem>
                    <Bell />
                    Notifications
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuSeparator />
            <DropdownMenuItem>
                <LogOut />
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                >
                    Log Out
                </Link>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
