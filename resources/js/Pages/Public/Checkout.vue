<script setup lang="ts">
import LandingLayout from '@/Layouts/PublicLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage, useForm } from '@inertiajs/vue3';
import { User } from '@/types';
import { Button } from '@/Components/ui/button';
import { NumberField, NumberFieldContent, NumberFieldDecrement, NumberFieldIncrement, NumberFieldInput } from '@/Components/ui/number-field';
import { addKkiapayListener, openKkiapayWidget, removeKkiapayListener } from 'kkiapay';
import { Card, CardHeader, CardContent, CardFooter } from '@/Components/ui/card';
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import { Textarea } from '@/Components/ui/textarea';
import { onMounted } from 'vue';
import { useCartStore } from '@/stores/cart';
const cart = useCartStore();

const page = usePage();
const user: User = page.props.auth.user;
function checkout() {
  openKkiapayWidget({
    amount: cart.cartTotal + (18 * cart.cartTotal) / 100,
    position: 'left',
    callback: '',
    key: cart.getKkiapayKey,
    sandbox: true,
    phone: createOrderForm.customer.contact,
    fullname: createOrderForm.customer.name,
    email: createOrderForm.customer.email,
  });
}

const createOrderForm = useForm({
  products: [],
  customer: {
    name: '',
    email: '',
    contact: '61000000',
    address: '',
  },
});

const handleSubmit = () => {};

onMounted(() => {
  addKkiapayListener('success', () => {
    createOrderForm.products = cart.items.map((item : any) => ({
      id: item.id,
      quantity: item.quantity,
    }));
    cart.clearCart();
    removeKkiapayListener('success');
    createOrderForm.post(route('orders.store'))
  });
});
</script>

<template>
  <Head title="QuickCart - Checkout" />
  <LandingLayout class="h-full">
    <HeroCarrousel />
    <div class="text-center pt-10 px-4">
      <div class="font-bold text-4xl">Checkout</div>
      <p class="max-w-screen-md mx-auto mt-4 text-muted-foreground">Please provide your contact information and shipping address so we can process your order. We will send you an email with your order summary and shipping details.</p>
    </div>
    <div class="container pt-10 max-w-screen-lg grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8">
      <Card class="bg-muted/20 border dark:bg-card">
        <CardHeader class="text-primary text-2xl"> </CardHeader>
        <CardContent>
          <form @submit.prevent="checkout" class="grid gap-4">
            <div class="flex flex-col md:flex-row gap-8">
              <div class="flex flex-col w-full gap-1.5">
                <Label for="name">Name <span class="text-red-500">*</span></Label>
                <Input id="name" required type="text" placeholder="John" v-model="createOrderForm.customer.name" />
              </div>

              <div class="flex flex-col w-full gap-1.5">
                <Label for="contact">Contact <span class="text-red-500">*</span></Label>
                <Input id="contact" required type="text" placeholder="Doe" v-model="createOrderForm.customer.contact" />
              </div>
            </div>

            <div class="flex flex-col gap-1.5">
              <Label for="email">Email <span class="text-red-500">*</span></Label>
              <Input id="email" required type="email" placeholder="johndoe@mail.com" v-model="createOrderForm.customer.email" />
            </div>

            <div class="flex flex-col gap-1.5">
              <Label for="adress">Adress</Label>
              <Textarea id="adress" placeholder="Your adress..." rows="5" v-model="createOrderForm.customer.address" />
            </div>
          </form>
        </CardContent>

        <CardFooter></CardFooter>
      </Card>
      <div>
        <div class="grid md:grid-cols-[18%,1fr] grid-cols-[30%,1fr] gap-3 mb-4 hover:bg-muted transition-all relative rounded-md p-4" v-for="item in cart.items" :key="item.id">
          <!-- <Button variant="destructive" size="sm" type="button" class="absolute -top-2 -right-2 p-2 size-6" @click="cart.removeItem(item.id)">
          <X class="size-2" />
        </Button> -->
          <img alt="Product image" v-if="item.cover" class="aspect-square rounded-md object-cover size-full" :src="item.cover" />
          <img alt="Product image" v-else class="aspect-square rounded-md object-cover size-full" src="@/Assets/Images/default-product.jpeg" />
          <div class="flex flex-col h-full">
            {{ item.name }}
            <div class="mt-4 flex justify-between items-center h-full w-full">
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
        <Button class="w-full" v-if="cart.cartCount > 0" @click="checkout"> Checkout </Button>
        <div v-if="cart.cartCount === 0" class="text-center py-4">
          <p class="text-neutral-400">Your cart is empty.</p>
        </div>
      </div>
    </div>
  </LandingLayout>
</template>
