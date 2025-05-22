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

const form = useForm({
    role_code: '',
    role_name: '',
    access_control_list: []

});

const submit = () => {
    form.post(route('role.store'), {
        preserveScroll: true,
    });
};

</script>

<template>

    <Head title="Role" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex flex-col gap-4 rounded-xl p-4">
            <h1 class="text-2xl font-semibold">New Role</h1>
            <form @submit.prevent="submit" class="space-y-6">
                <div class="grid gap-2">
                    <Label for="role_name">Role Name</Label>
                    <Input id="role_name" class="mt-1 block w-full" required autocomplete="role_name" placeholder="Role Name" v-model="form.role_name"/>
                    <InputError :message="form.errors.role_name" />
                </div>

                <div class="grid gap-2">
                    <Label for="role_code">Role Code</Label>
                    <Input id="role_code" type="role_code" class="mt-1 block w-full" autocomplete="role_code" placeholder="Role Code" v-model="form.role_code" required/>
                    <InputError :message="form.errors.role_code" />
                </div>
                <div class="grid gap-2">
                    <Label for="role_code">Access Control</Label>
                    <InputError :message="form.errors.access_control_list" />
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
                                :id="`${group}-${index}`"
                                :value="permission.key"
                                v-model="form.access_control_list"
                            />
                            <label :for="`${group}-${index}`">{{ permission.label }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <Button :disabled="form.processing">Save</Button>
                    <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                        <p v-show="form.recentlySuccessful" class="text-sm text-neutral-600">Saved.</p>
                    </Transition>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
