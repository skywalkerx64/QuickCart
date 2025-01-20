<script setup lang="ts">
import { Badge } from '@/Components/ui/badge';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/Components/ui/table';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs';
import { File, ListFilter, MoreHorizontal, Truck, Undo2 } from 'lucide-vue-next';

import { Link } from '@inertiajs/vue3';
import { Order } from '@/types';
import OrderOverview from './OrderOverview.vue';

const props = defineProps<{
  orders: {
    current_page: number;
    data: Order[];
    links: {
      url: string;
      label: string;
      active: boolean;
    }[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    next_page_url: string;
    path: string;
    per_page: number;
    prev_page_url: string;
    to: number;
    total: number;
  };
}>();
</script>

<template>
  <main class="grid flex-1 items-start gap-4 p-4 sm:px-6 sm:py-0 md:gap-8">
    <Tabs default-value="all">
      <div class="flex items-center">
        <TabsList>
          <TabsTrigger value="all"> All </TabsTrigger>
          <TabsTrigger value="placed"> Placed </TabsTrigger>
          <TabsTrigger value="processed"> Processed </TabsTrigger>
        </TabsList>
        <div class="ml-auto flex items-center gap-2">
          <DropdownMenu>
            <DropdownMenuTrigger as-child>
              <Button variant="outline"  class="h-7 gap-1">
                <ListFilter class="h-3.5 w-3.5" />
                <span class="sr-only sm:not-sr-only sm:whitespace-nowrap"> Filter </span>
              </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end">
              <DropdownMenuLabel>Filter by</DropdownMenuLabel>
              <DropdownMenuSeparator />
              <DropdownMenuItem checked> Placed </DropdownMenuItem>
              <DropdownMenuItem>Processed</DropdownMenuItem>
            </DropdownMenuContent>
          </DropdownMenu>
          <Button  variant="outline" class="h-7 gap-1">
            <File class="h-3.5 w-3.5" />
            <span class="sr-only sm:not-sr-only sm:whitespace-nowrap"> Export </span>
          </Button>
        </div>
      </div>
      <TabsContent value="all">
        <Card>
          <CardHeader>
            <CardTitle>Order</CardTitle>
            <CardDescription> Manage your orders. </CardDescription>
          </CardHeader>
          <CardContent>
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead class="hidden w-[100px] sm:table-cell">
                    <span class="sr-only">id</span>
                  </TableHead>
                  <TableHead>Customer</TableHead>
                  <TableHead>Total</TableHead>
                  <TableHead>Status</TableHead>
                  <TableHead class="hidden md:table-cell"> Created at </TableHead>
                  <TableHead>
                    <span class="sr-only">Actions</span>
                  </TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                <TableRow v-for="order in orders.data" :key="order.id">
                  <TableCell class="hidden sm:table-cell">
                    <span class="text-xl"> #{{ order.id }}</span>
                  </TableCell>
                  <TableCell class="font-medium">
                    {{ order.customer?.name }}
                  </TableCell>
                  <TableCell class="font-medium">
                    ${{ order.total }}
                  </TableCell>
                  <TableCell>
                    <Badge variant="outline">
                      {{ order.status }}
                    </Badge>
                  </TableCell>
                  <TableCell class="hidden md:table-cell">
                    {{ order.created_at }}
                  </TableCell>
                  <TableCell class="flex">
                    <DropdownMenu>
                      <DropdownMenuTrigger as-child>
                        <Button aria-haspopup="true" size="icon" variant="ghost">
                          <MoreHorizontal class="h-4 w-4" />
                          <span class="sr-only">Toggle menu</span>
                        </Button>
                      </DropdownMenuTrigger>
                      <DropdownMenuContent align="end">
                        <DropdownMenuLabel>Actions</DropdownMenuLabel>
                        <Link :href="route('products.edit', order.id)" class="w-full cursor-pointer"><DropdownMenuItem class="flex items-center gap-4"> <Truck class="size-4"/> Process</DropdownMenuItem></Link>
                        <Link :href="route('products.destroy', order.id)" method="delete" class="w-full cursor-pointer"><DropdownMenuItem class="flex items-center gap-4"> <Undo2 class="size-4"/> Refund</DropdownMenuItem></Link>
                      </DropdownMenuContent>
                    </DropdownMenu>
                    <div class="flex items-center justify-center gap-3">
                         <OrderOverview :order="order"/>
                    </div>
                  </TableCell>
                </TableRow>
              </TableBody>
            </Table>
          </CardContent>
          <CardFooter class="flex flex-col items-center md:flex-row md:justify-between">
            <div class="text-xs text-muted-foreground">
              Showing
              <strong>{{ props.orders.from + '-' + props.orders.to }}</strong>
              of <strong>{{ props.orders.total }}</strong>
              orders
            </div>
            <div class="flex gap-2 mt-4">
              <Link v-for="link in props.orders.links" :href="link.url">
                <Button v-html="link.label" :variant="link.active ? 'default' : 'outline'" :key="link.url"> </Button>
              </Link>
            </div>
          </CardFooter>
        </Card>
      </TabsContent>
    </Tabs>
  </main>
</template>
