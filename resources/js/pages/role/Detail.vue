<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Role',
        href: '/role',
    },
];

const access_control_list = computed(() => usePage().props.access_control_list).value;

type Role = {
    name: string;
    code: string;
    access_control: string;
};

const item = computed(() => usePage().props.item as Role).value;
console.log("Check type of access control: ", typeof(item['access_control']));
const code = item['code'];
const name = item['name'];
const access_control = Object.values(JSON.parse(item['access_control']));
</script>

<template>

    <Head title="Role" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex flex-col gap-4 rounded-xl p-4">
            <h1 class="text-2xl font-semibold">Detail Role</h1>
            <form class="space-y-6">
                <div class="grid gap-2">
                    <Label for="role_name">Role Name</Label>
                    <Input id="role_name" class="mt-1 block w-full" autocomplete="role_name" disabled v-model="name"/>
                </div>

                <div class="grid gap-2">
                    <Label for="role_code">Role Code</Label>
                    <Input id="role_code" type="role_code" class="mt-1 block w-full" autocomplete="role_code" disabled v-model="code"/>
                </div>
                <div class="grid gap-2">
                    <Label for="role_code">Access Control</Label>
                    <div v-for="(permissions, group) in access_control_list" :key="group" class="mb-4">
                        <span class="mb-2 text-sm font-semibold">{{ group }}</span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                            <div
                            v-for="(permission, index) in permissions"
                            :key="permission.key"
                            class="flex items-center gap-2"
                            >
                            <input
                                type="checkbox"
                                disabled
                                :checked="access_control.includes(permission.key)"
                                :id="`${group}-${index}`"
                                :value="permission.key"
                            />
                            <label :for="`${group}-${index}`">{{ permission.label }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
