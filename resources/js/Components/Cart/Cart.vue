<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import { useCartStore } from '@/stores/cart';
import { NumberField, NumberFieldContent, NumberFieldDecrement, NumberFieldIncrement, NumberFieldInput } from '@/Components/ui/number-field';

import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu';
import { ShoppingBag } from 'lucide-vue-next';
import { Badge } from '@/Components/ui/badge'
const cart = useCartStore();
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" class="relative">
        <ShoppingBag class="size-8 hover:text-primary" />
        <Badge class="absolute top-0 right-0" v-if="cart.cartCount > 0">{{ cart.cartCount }}</Badge>
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent class="w-96 p-4">
      <div class="grid grid-cols-[30%,1fr] gap-3 mb-4 hover:bg-muted transition-all rounded-md p-4" v-for="item in cart.items">
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
            <span class="font-semibold text-xl">${{ item.price * item.quantity }}</span>
          </div>
        </div>
      </div>
      <Button class="w-full" v-if="cart.cartCount > 0"> Checkout </Button>
      <div v-if="cart.cartCount === 0" class="text-center py-4">
        <p class="text-neutral-400">Your cart is empty.</p>
      </div>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
