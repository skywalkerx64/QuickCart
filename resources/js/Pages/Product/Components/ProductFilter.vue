use App\Models\ProductCategory;
<script setup lang="ts">
import { Sheet, SheetContent, SheetDescription, SheetHeader, SheetTitle, SheetTrigger } from '@/Components/ui/sheet';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/Components/ui/select';
import { NumberField, NumberFieldContent, NumberFieldDecrement, NumberFieldIncrement, NumberFieldInput } from '@/Components/ui/number-field';
import Label from '@/Components/ui/label/Label.vue';
import { Button } from '@/Components/ui/button';
import { SlidersHorizontal, Save } from 'lucide-vue-next';
import { useForm, router, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { Ref, ref } from 'vue';
import { ProductCategory } from '@/types';

const searchProductForm = useForm({
  name: null,
  description: null,
  price: {
    min: null,
    max: null,
  },
  status: null,
  category: '',
});

const submitProductSearchForm = () => {
  searchProductForm.get(route('shop'), {
    onSuccess: () => {
      console.log('serch submitted');
    },
  });
};

const props = defineProps<{
  categories: ProductCategory[];
}>();
</script>

<template>
  <Sheet>
    <SheetTrigger
      ><Button variant="outline">
        <SlidersHorizontal class="h-3.5 w-3.5" />
        <span class="sr-only sm:not-sr-only sm:whitespace-nowrap"> Filter </span>
      </Button>
    </SheetTrigger>
    <SheetContent side="left">
      <SheetHeader>
        <SheetTitle>Filter products</SheetTitle>
        <SheetDescription> Filter products by categories, prices and more. </SheetDescription>
      </SheetHeader>

      <form @submit.prevent="submitProductSearchForm()">
          <div class="flex flex-col gap-6 mt-10">
            <div class="flex justify-end">
                <Button> <Save/> Apply Filter </Button>
            </div>
            <div class="flex flex-col">
              <Label for="category" class="mb-4">Category</Label>
              <Select v-model="searchProductForm.category">
                <SelectTrigger id="category" aria-label="Select category">
                  <SelectValue placeholder="Select category" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem v-for="category in props.categories" :value="category.name">
                    {{ category.name }}
                  </SelectItem>
                </SelectContent>
              </Select>
              <InputError class="mt-2" :message="searchProductForm.errors.category" />
            </div>

            <div>
              <Label for="price" class="mb-4">Price Range</Label>
              <div class="grid grid-cols-2 gap-8 mt-4">
                <NumberField id="age" :default-value="0" :min="0">
                  <Label for="age">Min</Label>
                  <NumberFieldContent class="mt-4">
                    <NumberFieldDecrement />
                    <NumberFieldInput />
                    <NumberFieldIncrement />
                  </NumberFieldContent>
                </NumberField>
                <NumberField id="age" :default-value="0" :min="0">
                  <Label for="age">Max</Label>
                  <NumberFieldContent class="mt-4">
                    <NumberFieldDecrement />
                    <NumberFieldInput />
                    <NumberFieldIncrement />
                  </NumberFieldContent>
                </NumberField>
                <InputError class="mt-2" :message="searchProductForm.errors.price" />
              </div>
            </div>
          </div>
      </form>
    </SheetContent>
  </Sheet>
</template>
