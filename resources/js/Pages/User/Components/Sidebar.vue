<template>
    <aside class="hidden md:flex min-h-screen" aria-label="Sidebar">
        <div class="overflow-y-auto py-4 px-6 bg-slate-50 dark:bg-slate-800">
            <div class="flex flex-col items-center pb-5">
                <img
                    class="mb-3 w-24 h-24 rounded-full shadow-lg"
                    src="https://flowbite.com/docs/images/people/profile-picture-3.jpg"
                    alt="Bonnie image"
                />
                <h5
                    class="mb-1 text-xl font-medium text-slate-900 dark:text-white"
                >
                    {{ $page.props.auth.user.name }}
                </h5>
                <span class="text-sm text-slate-500 dark:text-slate-400">{{
                    $page.props.auth.user.email
                }}</span>
            </div>
            <ul class="space-y-2 text-slate-900 dark:text-white">
                <li
                    class="hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg"
                >
                    <Link
                        :href="route('home')"
                        class="flex items-center py-2 px-8 text-base font-normal"
                        :class="{ active: $page.url.startsWith('/user/home') }"
                    >
                        <HomeIcon class="h-6 w-6" />
                        <span class="ml-3">Dashboard</span>
                    </Link>
                </li>
                <li
                    v-if="hasAnyPermission(['read user', 'create user', 'update user', 'delete user'])"
                    class="hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg"
                >
                    <Link
                        :href="route('user.index')"
                        class="flex items-center py-2 px-8 text-base font-normal rounded-lg"
                        :class="{ active: $page.url.startsWith('/user/user') }"
                    >
                        <UserIcon class="h-6 w-6" />
                        <span class="ml-3">User</span>
                    </Link>
                </li>
                <li
                    v-if="hasAnyPermission(['read role', 'create role', 'update role', 'delete role'])"
                    class="hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg"
                >
                    <Link
                        :href="route('role.index')"
                        class="flex items-center py-2 px-8 text-base font-normal rounded-lg"
                        :class="{ active: $page.url.startsWith('/user/role') }"
                    >
                        <AdjustmentsIcon class="h-6 w-6" />
                        <span class="ml-3">Role</span>
                    </Link>
                </li>
                <li
                    v-if="hasAnyPermission(['read permission', 'create permission', 'update permission', 'delete permission'])"
                    class="hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg"
                >
                    <Link
                        :href="route('permission.index')"
                        class="flex items-center py-2 px-8 text-base font-normal rounded-lg"
                        :class="{ active: $page.url.startsWith('/user/permission') }"
                    >
                        <CogIcon class="h-6 w-6" />
                        <span class="ml-3">Permission</span>
                    </Link>
                </li>
                <!-- <li>
                    <button @click="toggleSidebar" type="button" class="flex items-center py-2 px-8 w-full text-base font-normal text-slate-900 rounded-lg transition duration-75 group hover:bg-slate-100 dark:text-white dark:hover:bg-slate-700 content-between">
                        <svg class="flex-shrink-0 w-6 h-6 text-slate-500 transition duration-75 group-hover:text-slate-900 dark:text-slate-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>E-commerce</span>
                        <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul class="py-2 space-y-2" v-if="isOpen">
                        <li>
                            <a href="#" class="flex items-center py-2 px-8 pl-11 w-full text-base font-normal text-slate-900 rounded-lg transition duration-75 group hover:bg-slate-100 dark:text-white dark:hover:bg-slate-700">Products</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center py-2 px-8 pl-11 w-full text-base font-normal text-slate-900 rounded-lg transition duration-75 group hover:bg-slate-100 dark:text-white dark:hover:bg-slate-700">Billing</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center py-2 px-8 pl-11 w-full text-base font-normal text-slate-900 rounded-lg transition duration-75 group hover:bg-slate-100 dark:text-white dark:hover:bg-slate-700">Invoice</a>
                        </li>
                    </ul>
                </li> -->
                <ul
                    class="pt-2 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700"
                >
                    <li>
                        <Link
                            :href="route('logout')"
                            method="post"
                            class="flex items-center py-2 px-8 text-base font-normal text-white rounded-lg transition duration-75 hover:bg-opacity-90 dark:text-white group bg-red-600"
                        >
                            <LogoutIcon class="h-6 w-6" />
                            <span class="ml-3">Sign Out</span>
                        </Link>
                    </li>
                </ul>
            </ul>
        </div>
    </aside>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import { UserIcon, HomeIcon, LogoutIcon, AdjustmentsIcon, CogIcon } from "@heroicons/vue/outline";
export default {
    name: "Sidebar",
    components: {
        Link,
        UserIcon,
        HomeIcon,
        LogoutIcon,
        AdjustmentsIcon,
        CogIcon
    },
    data() {
        return {
            isOpen: false,
        };
    },
    methods: {
        toggleSidebar() {
            this.isOpen = !this.isOpen;
        },
    },
};
</script>
