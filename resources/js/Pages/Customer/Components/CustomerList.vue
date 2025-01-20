<script setup lang="ts">
import { Badge } from '@/Components/ui/badge';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/Components/ui/table';
import { Tabs, TabsContent } from '@/Components/ui/tabs';
import { File, ListFilter } from 'lucide-vue-next';

import { Link } from '@inertiajs/vue3';
import { Customer } from '@/types';

const props = defineProps<{
  customers: {
    current_page: number;
    data: Customer[];
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
        <div class="ml-auto flex items-center gap-2">
          <Button  variant="outline" class="h-7 gap-1">
            <File class="h-3.5 w-3.5" />
            <span class="sr-only sm:not-sr-only sm:whitespace-nowrap"> Export </span>
          </Button>
        </div>
      </div>
      <TabsContent value="all">
        <Card>
          <CardHeader>
            <CardTitle>Customer</CardTitle>
            <CardDescription> Consult your customers. </CardDescription>
          </CardHeader>
          <CardContent>
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead class="hidden w-[100px] sm:table-cell">
                    <span class="sr-only">id</span>
                  </TableHead>
                  <TableHead>Name</TableHead>
                  <TableHead>Email</TableHead>
                  <TableHead>Contact</TableHead>
                  <TableHead class="hidden md:table-cell"> Created at </TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                <TableRow v-for="customer in customers.data" :key="customer.id">
                  <TableCell class="hidden sm:table-cell">
                    <span class="text-xl"> #{{ customer.id }}</span>
                  </TableCell>
                  <TableCell class="font-medium">
                    {{ customer.name }}
                  </TableCell>
                  <TableCell class="font-medium">
                    {{ customer.email }}
                  </TableCell>
                  <TableCell>
                    {{ customer.contact }}
                  </TableCell>
                  <TableCell class="hidden md:table-cell">
                    {{ customer.created_at }}
                  </TableCell>
                </TableRow>
              </TableBody>
            </Table>
          </CardContent>
          <CardFooter class="flex flex-col items-center md:flex-row md:justify-between">
            <div class="text-xs text-muted-foreground">
              Showing
              <strong>{{ props.customers.from + '-' + props.customers.to }}</strong>
              of <strong>{{ props.customers.total }}</strong>
              customers
            </div>
            <div class="flex gap-2 mt-4">
              <Link v-for="link in props.customers.links" :href="link.url">
                <Button v-html="link.label" :variant="link.active ? 'default' : 'outline'" :key="link.url"> </Button>
              </Link>
            </div>
          </CardFooter>
        </Card>
      </TabsContent>
    </Tabs>
  </main>
</template>
