<script setup lang="ts">
import { type BreadcrumbItem } from '@/types';
import { Lock } from 'lucide-vue-next';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

</script>

<template>
    <div class="w-full h-screen justify-center items-center flex">
        <div class="font-bold text-3xl flex flex-col justify-center items-center">
            <div class="mb-20">
                No permission to access this page
            </div>
            <Lock class="w-32 h-32 text-gray-600"/>
        </div>
    </div>
</template>
