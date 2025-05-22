<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import DataTable from 'primevue/datatable';
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import Column from 'primevue/column';
import { Head, Link, usePage, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const flashMessage = computed(() => page.props.flash?.success);
const products = ref<{ name: string; code: string, action: string }[]>([]);
const showDialog = ref(false)
const selectedId = ref(null)

onMounted(async () => {
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-delete')
        if (btn) {
            id.value = btn.getAttribute('data-id');
            visible.value = true
        }
    })
    
    fetchData();
});

const fetchData = async () => {
    try {
        const response = await axios.get('/role/search');
        products.value = response.data;
    } catch (e) {
        console.error(e);
    }
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Role',
        href: '/role',
    },
];

const visible = ref(false);
const id = ref(null);
const form = useForm({});

function confirmDelete() {
    form.delete(route('role.delete', Number(id.value)), {
        preserveScroll: true,

    });
    visible.value = false;
    fetchData();
}

</script>

<template>

    <Head title="Role" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <Dialog v-model:visible="visible" modal header="Edit Profile" :style="{ width: '25rem' }">
                <p>Are you sure you want to delete this role?</p>
                <div class="flex justify-end gap-2 mt-4">
                    <Button label="Cancel" severity="secondary" @click="visible = false" />
                    <Button label="Delete" severity="danger" @click="confirmDelete" />
                </div>
            </Dialog>
            <div>
                <Link :href="route('role.create')"
                    class="bg-green-200 float-right border-2 border-transparent cursor-pointer font-bold mt-4 p-2 rounded-md ">
                Create
                </Link>
            </div>
            <DataTable :value="products" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" sortMode="multiple"
                tableStyle="min-width: 50rem">
                <Column class="text-center" field="name" header="Name" sortable style="width: 25%"
                    headerStyle="text-align: center;"></Column>
                <Column class="text-center" field="code" header="Code" sortable style="width: 25%"
                    headerStyle="text-align: center;"></Column>
                <Column class="text-center" header="Action" style="width: 25%" headerStyle="text-align: center;">
                    <template #body="slotProps">
                        <div v-html="slotProps.data.action"></div>
                    </template>
                </Column>
                <!-- <Column field="action" header="Action" sortable style="width: 25%"></Column> -->
            </DataTable>
        </div>
    </AppLayout>
</template>
