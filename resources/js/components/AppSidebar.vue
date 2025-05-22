<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, UserCog, Users, Users2 } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

import { computed } from 'vue';

const page = usePage();
const auth = computed(() => page.props.auth);
const role = auth?.value.role;
const access_control_list = JSON.parse(role['access_control']);
console.log("Check user role: ", access_control_list.includes("ACCESS_USER_LIST"));


const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
        hasAccess: access_control_list.includes("ACCESS_DASHBOARD")
    },
    {
        title: 'Role',
        href: '/role',
        icon: UserCog,
        hasAccess: access_control_list.includes("ACCESS_ROLE_LIST")
    },
    {
        title: 'User',
        href: '/user',
        icon: Users2,
        hasAccess: access_control_list.includes("ACCESS_USER_LIST")
    },
];

</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

    </Sidebar>
    <slot />
</template>
