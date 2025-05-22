<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { computed, ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const page = usePage();
const flashMessage = computed(() => page.props.flash?.success);

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div v-if="flashMessage"
                class="mb-4 flex items-start justify-between rounded-lg bg-green-100 p-4 text-green-800 shadow">
                <span>{{ flashMessage }}</span>
                <button class="ml-4 text-green-800 hover:text-green-600" @click="flashMessage = null"
                    aria-label="Close">
                </button>
            </div>
            <slot />
        </div>
    </AppLayout>
</template>
