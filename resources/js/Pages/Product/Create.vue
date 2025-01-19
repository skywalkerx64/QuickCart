<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ProductCategory } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/Components/ui/select';
import { Textarea } from '@/Components/ui/textarea';
import { ChevronLeft, Upload, X } from 'lucide-vue-next';
import { useForm, router, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { Ref, ref } from 'vue';
const createProductForm = useForm({
  name: '',
  description: '',
  price: '',
  status: '',
  category: '',
  cover: null as File | null,
  images: [] as File[],
});

const submitProductCreateForm = () => {
  createProductForm.post(route('products.store'), {
    onSuccess: () => {
      console.log('product created');

      createProductForm.reset();
    },
  });
};
const props = defineProps<{
  categories: ProductCategory[];
  statuses: string[];
}>();

let cover: Ref<string | null> = ref(null);
let images: Ref<string[] | null> = ref(null);

const setCover = (event: Event) => {
  const target = event.target as HTMLInputElement;
  createProductForm.cover = target.files?.item(0) ?? null;
  cover.value = createProductForm.cover ? URL.createObjectURL(createProductForm.cover) : null;
};
const unsetCover = () => {
  createProductForm.cover = null;
  cover.value = null;
};

const setImages = (event: Event) => {
  const target = event.target as HTMLInputElement;
  createProductForm.images.push(...Array.from(target.files ?? []));
  const files = Array.from(target.files ?? []).map((file) => URL.createObjectURL(file));
  images.value ? images.value.push(...files) : (images.value = files);
};
const unsetImages = (index: number) => {
  createProductForm.images.splice(index, 1);
  images.value?.splice(index, 1);
};
</script>

<template>
  <Head title="Add Product" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Add Product</h2>
    </template>

    <div class="py-10">
      <div class="mx-auto grid max-w-max flex-1 auto-rows-max gap-4">
        <div class="flex items-center gap-4">
          <Button variant="outline" size="icon" class="h-7 w-7">
            <ChevronLeft class="size-4" />
            <span class="sr-only">Back</span>
          </Button>
          <h1 class="flex-1 shrink-0 whitespace-nowrap text-xl font-semibold tracking-tight sm:grow-0">Add a new product to your store</h1>
          <div class="hidden items-center gap-2 md:ml-auto md:flex">
            <Link :href="route('products.index')">
              <Button variant="outline"> Discard </Button>
            </Link>

            <Button @click="submitProductCreateForm()"> Save Product </Button>
          </div>
        </div>
        <form @submit.prevent="submitProductCreateForm()">
          <div class="grid gap-4 md:grid-cols-[1fr_250px] lg:grid-cols-3 lg:gap-8">
            <div class="grid auto-rows-max items-start gap-4 lg:col-span-2 lg:gap-8">
              <Card>
                <CardHeader>
                  <CardTitle>Product Details</CardTitle>
                  <CardDescription> Provide all the necessary information about your product so customers can find it easily. </CardDescription>
                </CardHeader>
                <CardContent>
                  <div class="grid gap-6">
                    <div class="grid gap-3">
                      <Label for="name">Name</Label>
                      <Input id="name" type="text" class="w-full" v-model="createProductForm.name" />
                      <InputError :message="createProductForm.errors.name" />
                    </div>
                    <div class="grid gap-3">
                      <Label for="price">Price</Label>
                      <Input type="number" id="price" class="w-full" v-model="createProductForm.price" />
                      <InputError :message="createProductForm.errors.price" />
                    </div>
                    <div class="grid gap-3">
                      <Label for="description">Description</Label>
                      <Textarea id="description" class="min-h-32" v-model="createProductForm.description" />
                      <InputError class="mt-2" :message="createProductForm.errors.description" />
                    </div>
                  </div>
                </CardContent>
              </Card>
              <Card>
                <CardHeader>
                  <CardTitle>Product Category</CardTitle>
                </CardHeader>
                <CardContent>
                  <div class="grid gap-6 sm:grid-cols-3">
                    <div class="grid gap-3">
                      <Label for="category">Category</Label>
                      <Select v-model="createProductForm.category">
                        <SelectTrigger id="category" aria-label="Select category">
                          <SelectValue placeholder="Select category" />
                        </SelectTrigger>
                        <SelectContent>
                          <SelectItem v-for="category in props.categories" :value="category.name">
                            {{ category.name }}
                          </SelectItem>
                        </SelectContent>
                      </Select>
                      <InputError class="mt-2" :message="createProductForm.errors.category" />
                    </div>
                  </div>
                </CardContent>
              </Card>
            </div>
            <div class="grid auto-rows-max items-start gap-4 lg:gap-8">
              <Card>
                <CardHeader>
                  <CardTitle>Product Status</CardTitle>
                </CardHeader>
                <CardContent>
                  <div class="grid gap-6">
                    <div class="grid gap-3">
                      <Label for="status">Status</Label>
                      <Select v-model="createProductForm.status">
                        <SelectTrigger id="status" aria-label="Select status">
                          <SelectValue placeholder="Select status" />
                        </SelectTrigger>
                        <SelectContent>
                          <SelectItem v-for="status in props.statuses" :value="status">
                            {{ status }}
                          </SelectItem>
                        </SelectContent>
                      </Select>
                      <InputError class="mt-2" :message="createProductForm.errors.status" />
                    </div>
                  </div>
                </CardContent>
              </Card>
              <Card class="overflow-hidden">
                <CardHeader>
                  <CardTitle>Product imgages</CardTitle>
                  <CardDescription> You can use this feature to add multiple images to your product, such as different angles, or to show the product in different settings. </CardDescription>
                </CardHeader>
                <CardContent>
                  <h1 class="mb-1 text-lg font-semibold">Cover</h1>
                  <p class="text-sm text-muted-foreground mb-4">This image will be used as the main product image.</p>
                  <div class="grid gap-2">
                    <label class="flex aspect-square w-full items-center justify-center rounded-md border border-dashed mb-4" v-if="!cover">
                      <Upload class="size-4 text-muted-foreground" />
                      <span class="sr-only">Upload</span>
                      <input type="file" accept=".png, .jpg, .jpeg" class="hidden" @input="setCover($event)" />
                    </label>
                    <div class="relative" v-else>
                      <img :src="cover" class="object-cover w-full aspect-square rounded-md" />
                      <div class="absolute inset-0 rounded-md bg-black bg-opacity-20 hover:bg-opacity-50 transition duration-150 ease-in-out"></div>
                      <Button variant="destructive" size="sm" type="button" class="absolute -top-2 -right-2 p-2" @click="unsetCover">
                        <X class="size-4" />
                      </Button>
                    </div>
                    <h1 class="mb-1 text-lg font-semibold">Other Images</h1>
                    <p class="text-sm text-muted-foreground mb-4">Other images you can add to your product.</p>
                    <div class="grid grid-cols-3 gap-2">
                      <div class="relative rounded-md max-h-fit" v-for="(image, key) in images" :key="key" v-if="images && images.length && images.length > 0">
                        <img :src="image" class="object-cover w-full aspect-square rounded-md" />
                        <div class="absolute inset-0 rounded-md bg-black bg-opacity-20 hover:bg-opacity-50 transition duration-150 ease-in-out"></div>
                        <Button variant="destructive" size="sm" type="button" class="absolute -top-2 -right-2 p-2" @click="unsetImages(key)">
                          <X class="size-4" />
                        </Button>
                      </div>
                      <label class="flex aspect-square w-full items-center justify-center rounded-md border border-dashed mb-4">
                        <Upload class="size-4 text-muted-foreground" />
                        <span class="sr-only">Upload</span>
                        <input type="file" accept=".png, .jpg, .jpeg" class="hidden" multiple @input="setImages" />
                      </label>
                    </div>
                  </div>
                </CardContent>
              </Card>
            </div>
          </div>
          <div class="flex items-center justify-center gap-2 md:hidden">
            <Button variant="outline"> Discard </Button>
            <Button> Save Product </Button>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
