<script lang="ts" setup>
import { computed, ref } from "vue";
import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger,
} from "@/Components/ui/navigation-menu";
import {
    Sheet,
    SheetContent,
    SheetFooter,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from "@/Components/ui/sheet";

import Cart from "@/Components/Cart/Cart.vue";

import { Button } from "@/Components/ui/button";
import { Separator } from "@/Components/ui/separator";

import { Menu } from "lucide-vue-next";
import ToggleTheme from "@/Components/Utils/ToggleTheme.vue";
import ApplicationLogo from "../ApplicationLogo.vue";
import { usePage } from "@inertiajs/vue3";
import UserProfile from "../Auth/UserProfile.vue";

interface RouteProps {
    href: string;
    label: string;
}

const routeList: RouteProps[] = [
{
        href: "/",
        label: "Home",
    },
    {
        href: "shop",
        label: "Shop",
    },
    {
        href: "#faq",
        label: "FAQ",
    },
    {
        href: "contact",
        label: "Contact",
    },
];

const page = usePage();
const user = computed(() => page.props.auth.user);

const isConnected = computed(() => user.value !== null);

const isOpen = ref<boolean>(false);
</script>

<template>
    <header
        :class="{
            'w-[90%] md:w-[70%] lg:w-[75%] lg:max-w-screen-xl top-5 mx-auto sticky z-40 flex justify-between items-center p-2': true,
        }"
    >


        <a href="/" class="font-bold text-lg flex items-center gap-2"><ApplicationLogo class="size-8" /> QuickCart</a>
        <!-- Mobile -->
        <div class="flex items-center lg:hidden">
            <Sheet v-model:open="isOpen">
                <SheetTrigger as-child>
                    <Menu @click="isOpen = true" class="cursor-pointer" />
                </SheetTrigger>

                <SheetContent
                    side="left"
                    class="flex flex-col justify-between rounded-tr-2xl rounded-br-2xl bg-card"
                >
                    <div>
                        <SheetHeader class="mb-4 ml-4">
                            <SheetTitle class="flex items-center">
                                <a href="/" class="flex items-center gap-2">
                                    <ApplicationLogo class="size-8"/>
                                    QuickCart
                                </a>
                            </SheetTitle>
                        </SheetHeader>

                        <div class="flex flex-col gap-2">
                            <Button
                                v-for="{ href, label } in routeList"
                                :key="label"
                                as-child
                                variant="ghost"
                                class="justify-start text-base"
                            >
                                <a @click="isOpen = false" :href="href">
                                    {{ label }}
                                </a>
                            </Button>
                        </div>
                    </div>

                    <SheetFooter
                        class="flex-col sm:flex-col justify-start items-start"
                    >
                        <Separator class="mb-2" />

                        <ToggleTheme />
                    </SheetFooter>
                </SheetContent>
            </Sheet>
        </div>

        <!-- Desktop -->
        <NavigationMenu class="hidden lg:block sticky">
            <NavigationMenuList>
                <NavigationMenuItem>
                    <NavigationMenuLink asChild>
                        <Button
                            v-for="{ href, label } in routeList"
                            :key="label"
                            as-child
                            variant="ghost"
                            class="justify-start text-base"
                        >
                            <a :href="href">
                                {{ label }}
                            </a>
                        </Button>
                    </NavigationMenuLink>
                </NavigationMenuItem>
            </NavigationMenuList>
        </NavigationMenu>

        <div class="hidden lg:flex justify-center items-center gap-2 text-base" >
            <Cart/>
            <span v-if="!isConnected" class="flex items-center gap-2">
                <Button as-child aria-label="Login" variant="ghost">
                    <a aria-label="Login" href="login"> Login </a>
                </Button>

                <Button as-child aria-label="Login">
                    <a aria-label="Register" href="register"> Sign up Free </a>
                </Button>
            </span>
            <UserProfile v-else :user="user" />

            <ToggleTheme />
        </div>

    </header>
</template>
