<script setup lang="ts">
import { Order } from '@/types';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card';
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet';
import { Eye, Copy } from 'lucide-vue-next';
import Button from '@/Components/ui/button/Button.vue';
import Separator from '@/Components/ui/separator/Separator.vue';
const props = defineProps<{ order: Order }>();
</script>

<template>
  <Sheet>
    <SheetTrigger
      ><Button variant="outline">
        <Eye class="size-4" />
        <span class="sr-only sm:not-sr-only gap-3 sm:whitespace-nowrap"> Overview </span>
      </Button>
    </SheetTrigger>
    <SheetContent side="right">
      <Card class="overflow-hidden">
        <CardHeader class="flex flex-row items-start bg-muted/50">
          <div class="grid gap-0.5">
            <CardTitle class="group flex items-center gap-2 text-lg">
              Order ID: {{ order.reference }}
              <Button size="icon" variant="outline" class="h-6 w-6 opacity-0 transition-opacity group-hover:opacity-100">
                <Copy class="h-3 w-3" />
                <span class="sr-only">Copy Order ID</span>
              </Button>
            </CardTitle>
            <CardDescription>Date: {{ order.created_at }}</CardDescription>
          </div>
        </CardHeader>
        <CardContent class="p-6 text-sm">
          <div class="grid gap-3">
            <div class="font-semibold">Order Details</div>
            <ul class="grid gap-3">
              <li class="flex items-center justify-between" v-for="detail in order.details">
                <span class="text-muted-foreground">
                  {{ detail.product.name }} x <span>{{ detail.quantity }}</span>
                </span>
                <span>{{ detail.total }}</span>
              </li>
            </ul>
            <Separator class="my-2" />
            <ul class="grid gap-3">
              <li class="flex items-center justify-between">
                <span class="text-muted-foreground">Subtotal</span>
                <span>{{ order.total }}</span>
              </li>
              <li class="flex items-center justify-between">
                <span class="text-muted-foreground">Tax</span>
                <span>{{ order.tax }}</span>
              </li>
              <li class="flex items-center justify-between font-semibold">
                <span class="text-muted-foreground">Total</span>
                <span>{{ Math.round(order.total ?? 0) }}</span>
              </li>
            </ul>
          </div>
          <Separator class="my-4" />
          <div class="grid grid-cols-2 gap-4">
            <div class="grid gap-3">
              <div class="font-semibold">Shipping Information</div>
              <address class="grid gap-0.5 not-italic text-muted-foreground">
                <span>{{ order.customer.name }}</span>
                <span>{{ order.customer.address }}</span>
              </address>
            </div>
            <div class="grid auto-rows-max gap-3">
              <div class="font-semibold">Billing Information</div>
              <div class="text-muted-foreground">Same as shipping address</div>
            </div>
          </div>
          <Separator class="my-4" />
          <div class="grid gap-3">
            <div class="font-semibold">Customer Information</div>
            <dl class="grid gap-3">
              <div class="flex items-center justify-between">
                <dt class="text-muted-foreground">Customer</dt>
                <dd>{{ order.customer.name }}</dd>
              </div>
              <div class="flex items-center justify-between">
                <dt class="text-muted-foreground">Email</dt>
                <dd>
                  <a href="mailto:">{{ order.customer.email }}</a>
                </dd>
              </div>
              <div class="flex items-center justify-between">
                <dt class="text-muted-foreground">Phone</dt>
                <dd>
                  <a href="tel:">{{ order.customer.contact }}</a>
                </dd>
              </div>
            </dl>
          </div>
        </CardContent>
        <CardFooter class="flex flex-row items-center border-t bg-muted/50 px-6 py-3">
          <div class="text-xs text-muted-foreground">
            Updated <time dateTime="2023-11-23">{{ order.created_at }}</time>
          </div>
          <Pagination class="ml-auto mr-0 w-auto">
            <PaginationList class="gap-1">
              <PaginationPrev variant="outline" class="h-6 w-6" />
              <PaginationNext variant="outline" class="h-6 w-6" />
            </PaginationList>
          </Pagination>
        </CardFooter>
      </Card>
    </SheetContent>
  </Sheet>
</template>
