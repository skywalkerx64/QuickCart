<script setup lang="ts">
import { Badge } from '@/Components/ui/badge';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/Components/ui/table';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs';
import { File, ListFilter, MoreHorizontal, PlusCircle, Pen, Trash } from 'lucide-vue-next';

import { Link } from '@inertiajs/vue3';
import { Product } from '@/types';

const props = defineProps<{
  products: {
    current_page: number;
    data: Product[];
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
console.log(props.products.links);
</script>

<template>
  <main class="grid flex-1 items-start gap-4 p-4 sm:px-6 sm:py-0 md:gap-8">
    <Tabs default-value="all">
      <div class="flex items-center">
        <TabsList>
          <TabsTrigger value="all"> All </TabsTrigger>
          <TabsTrigger value="active"> Published </TabsTrigger>
          <TabsTrigger value="draft"> Draft </TabsTrigger>
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
              <DropdownMenuItem checked> Active </DropdownMenuItem>
              <DropdownMenuItem>Draft</DropdownMenuItem>
            </DropdownMenuContent>
          </DropdownMenu>
          <Button  variant="outline" class="h-7 gap-1">
            <File class="h-3.5 w-3.5" />
            <span class="sr-only sm:not-sr-only sm:whitespace-nowrap"> Export </span>
          </Button>
          <Link :href="route('products.create')">
            <Button  class="h-7 gap-1">
              <PlusCircle class="h-3.5 w-3.5" />
              <span class="sr-only sm:not-sr-only sm:whitespace-nowrap"> Add Product </span>
            </Button>
          </Link>
        </div>
      </div>
      <TabsContent value="all">
        <Card>
          <CardHeader>
            <CardTitle>Products</CardTitle>
            <CardDescription> Manage your products. </CardDescription>
          </CardHeader>
          <CardContent>
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead class="hidden w-[100px] sm:table-cell">
                    <span class="sr-only">img</span>
                  </TableHead>
                  <TableHead>Name</TableHead>
                  <TableHead>Category</TableHead>
                  <TableHead>Status</TableHead>
                  <TableHead class="hidden md:table-cell"> Price </TableHead>
                  <TableHead class="hidden md:table-cell"> Created at </TableHead>
                  <TableHead>
                    <span class="sr-only">Actions</span>
                  </TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                <TableRow v-for="product in products.data" :key="product.id">
                  <TableCell class="hidden sm:table-cell">
                    <img v-if="product.cover" alt="Product image" class="aspect-square rounded-md object-cover size-12" :src="product.cover" />
                    <img v-else alt="Product image" class="aspect-square rounded-md object-cover size-12" src="@/Assets/Images/default-product.jpeg" />
                  </TableCell>
                  <TableCell class="font-medium">
                    {{ product.name }}
                  </TableCell>
                  <TableCell class="hidden md:table-cell">
                    {{ product.category }}
                  </TableCell>
                  <TableCell>
                    <Badge variant="outline">
                      {{ product.status }}
                    </Badge>
                  </TableCell>
                  <TableCell class="hidden md:table-cell"> ${{ product.price }} </TableCell>
                  <TableCell class="hidden md:table-cell">
                    {{ product.created_at }}
                  </TableCell>
                  <TableCell>
                    <DropdownMenu>
                      <DropdownMenuTrigger as-child>
                        <Button aria-haspopup="true" size="icon" variant="ghost">
                          <MoreHorizontal class="h-4 w-4" />
                          <span class="sr-only">Toggle menu</span>
                        </Button>
                      </DropdownMenuTrigger>
                      <DropdownMenuContent align="end">
                        <DropdownMenuLabel>Actions</DropdownMenuLabel>
                        <Link :href="route('products.edit', product.id)" class="w-full cursor-pointer"><DropdownMenuItem class="flex items-center gap-4"> <Pen class="size-4"/> Edit</DropdownMenuItem></Link>
                        <Link :href="route('products.destroy', product.id)" method="delete" class="w-full cursor-pointer"><DropdownMenuItem class="flex items-center gap-4"> <Trash class="size-4"/> Delete</DropdownMenuItem></Link>
                      </DropdownMenuContent>
                    </DropdownMenu>
                  </TableCell>
                </TableRow>
              </TableBody>
            </Table>
          </CardContent>
          <CardFooter class="flex flex-col items-center md:flex-row md:justify-between">
            <div class="text-xs text-muted-foreground">
              Showing
              <strong>{{ props.products.from + '-' + props.products.to }}</strong>
              of <strong>{{ props.products.total }}</strong>
              products
            </div>
            <div class="flex gap-2 mt-4">
              <Link v-for="link in props.products.links" :href="link.url">
                <Button v-html="link.label" :variant="link.active ? 'default' : 'outline'" :key="link.url"> </Button>
              </Link>
            </div>
          </CardFooter>
        </Card>
      </TabsContent>
    </Tabs>
  </main>
</template>
