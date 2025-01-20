<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { User } from '@/types';
import Button from '@/Components/ui/button/Button.vue';

const page = usePage();
const user: User = page.props.auth.user;

const UpdateKeyForm = useForm({
    kkiapay_key: user.kkiapay_key,
});


</script>

<template>
  <Head title="Settings" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Settings</h2>
    </template>
    <div class="py-10">
      <Card class="w-full md:w-1/2">
        <CardHeader>
          <CardTitle>API Kkiapay</CardTitle>
          <CardDescription>
            Please enter your Kkiapay API key here to configure your payment settings.
          </CardDescription>
        </CardHeader>
        <CardContent>
            <form @submit.prevent="UpdateKeyForm.post(route('settings.update-key'))">

                <div class="grid gap-6">
                  <div class="grid gap-3">
                    <Label for="status">Key API Kkiapay</Label>
                    <Input id="status" type="text" class="w-full" v-model="UpdateKeyForm.kkiapay_key"/>
                  </div>
                  <Button class="w-fit">Update</Button>
                </div>
            </form>
        </CardContent>
      </Card>
    </div>
  </AuthenticatedLayout>
</template>
