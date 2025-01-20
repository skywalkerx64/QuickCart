<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import { useCartStore } from '@/stores/cart';
import { NumberField, NumberFieldContent, NumberFieldDecrement, NumberFieldIncrement, NumberFieldInput } from '@/Components/ui/number-field';
import { ScrollArea } from '@/Components/ui/scroll-area';
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu';
import { ShoppingBag, X } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import { Badge } from '@/Components/ui/badge';
const cart = useCartStore();
</script>

<template>
  <DropdownMenu :modal="false">
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" class="relative">
        <ShoppingBag class="size-8 hover:text-primary" />
        <Badge class="absolute top-0 right-0" v-if="cart.cartCount > 0">{{ cart.cartCount }}</Badge>
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent class="w-96 p-4">
      <ScrollArea class="w-full h-full">
        <div class="grid grid-cols-[30%,1fr] gap-3 mb-4 hover:bg-muted transition-all relative rounded-md p-4" v-for="item in cart.items" :key="item.id">
          <img alt="Product image" v-if="item.cover" class="aspect-square rounded-md object-cover size-full" :src="item.cover" />
          <img alt="Product image" v-else class="aspect-square rounded-md object-cover size-full" src="@/Assets/Images/default-product.jpeg" />
          <div class="flex flex-col">
            {{ item.name }}
            <div class="mt-4 flex justify-between items-center w-full">
              <NumberField id="age" class="w-24" :default-value="item.quantity" :min="0" @update:modelValue="cart.updateQuantity(item.id, $event)">
                <NumberFieldContent class="mt-4">
                  <NumberFieldDecrement />
                  <NumberFieldInput />
                  <NumberFieldIncrement />
                </NumberFieldContent>
              </NumberField>
              <span class="font-semibold text-xl">${{ Math.round(item.price * item.quantity) }}</span>
            </div>
          </div>
        </div>
        <div class="border-t border-b border-muted py-4" v-if="cart.cartCount > 0">
          <div class="flex justify-between">
            <span class="text-lg font-semibold">Subtotal</span>
            <span class="text-lg font-semibold">${{ Math.round(cart.cartTotal * 100) / 100 }}</span>
          </div>
          <div class="flex justify-between mt-2">
            <span class="text-lg font-semibold">Tax (18%)</span>
            <span class="text-lg font-semibold">${{ Math.round((18 * cart.cartTotal) / 100) }}</span>
          </div>
          <div class="flex justify-between mt-2">
            <span class="text-lg font-semibold">Total</span>
            <span class="text-lg font-semibold">${{ Math.round(cart.cartTotal + (18 * cart.cartTotal) / 100) }}</span>
          </div>
        </div>
        <Link :href="route('checkout')"><Button class="w-full" v-if="cart.cartCount > 0"> Checkout </Button></Link>
        <div v-if="cart.cartCount === 0" class="text-center py-4">
          <p class="text-neutral-400">Your cart is empty.</p>
        </div>
      </ScrollArea>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
