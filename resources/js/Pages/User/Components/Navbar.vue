<template>
    <nav class="bg-white border-slate-200 px-2 sm:px-4 py-2.5 dark:bg-slate-800">
        <div class="flex flex-wrap justify-between items-center mx-auto">
            <div class="flex">
                <button data-collapse-toggle="mobile-menu" type="button" class="inline-flex items-center p-2 mr-3 text-sm text-slate-500 rounded-lg hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:text-slate-400 dark:hover:bg-slate-700 dark:focus:ring-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                </button>
                <Link :href="route('home')" class="flex items-center">
                    <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" /> -->
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Inertia App</span>
                </Link>
            </div>
            <div class="flex">
                <button @click="toggleDropDown" type="button" class="flex mr-3 text-sm bg-slate-800 rounded-full md:mr-0 focus:ring-4 focus:ring-slate-300 dark:focus:ring-slate-600" >
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="user photo">
                </button>
                <div v-if="isDropDownOpen" class="absolute right-2 top-10 z-50 my-4 text-base list-none bg-white rounded divide-y divide-slate-100 shadow dark:bg-slate-700 dark:divide-slate-600">
                    <div class="py-3 px-4">
                        <span class="block text-sm text-slate-900 dark:text-white">{{ $page.props.auth.user.name }}</span>
                        <span class="block text-sm font-medium text-slate-500 truncate dark:text-slate-400">{{ $page.props.auth.user.email }}</span>
                    </div>
                    <ul class="py-1" aria-labelledby="dropdown">
                        <li>
                            <a href="#" class="block py-2 px-4 text-sm text-slate-700 hover:bg-slate-100 dark:hover:bg-slate-600 dark:text-slate-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 text-sm text-slate-700 hover:bg-slate-100 dark:hover:bg-slate-600 dark:text-slate-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 text-sm text-slate-700 hover:bg-slate-100 dark:hover:bg-slate-600 dark:text-slate-200 dark:hover:text-white">Earnings</a>
                        </li>
                        <li>
                            <Link :href="route('logout')" method="post" class="block py-2 px-4 text-sm text-slate-700 hover:bg-slate-100 dark:hover:bg-slate-600 dark:text-slate-200 dark:hover:text-white">Sign out</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    name: 'Navbar',
    components: {
        Link
    },
    data() {
        return {
            isCollapsed: false,
            isDropDownOpen: false,
        }
    },
    methods: {
        toggleCollapse() {
            this.isCollapsed = !this.isCollapsed
        },
        toggleDropDown() {
            this.isDropDownOpen = !this.isDropDownOpen
        },
    }
}
</script>