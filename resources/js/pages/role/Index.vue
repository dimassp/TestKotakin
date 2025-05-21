<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Role',
        href: '/role',
    },
];

const products = [
  { name: 'Alice', role: 'Admin' },
  { name: 'Bob', role: 'User' },
  { name: 'Charlie', role: 'Editor' },
  { name: 'Alice', role: 'Admin' },
  { name: 'Bob', role: 'User' },
  { name: 'Charlie', role: 'Editor' },
  { name: 'Alice', role: 'Admin' },
  { name: 'Bob', role: 'User' },
  { name: 'Charlie', role: 'Editor' },
  { name: 'Alice', role: 'Admin' },
  { name: 'Bob', role: 'User' },
  { name: 'Charlie', role: 'Editor' },
]

</script>

<template>

    <Head title="Role" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <DataTable :value="products" stripedRows tableStyle="min-width: 50rem">
                <Column field="name" header="Name"></Column>
                <Column field="role" header="Role"></Column>
            </DataTable>
        </div>
    </AppLayout>
</template>
