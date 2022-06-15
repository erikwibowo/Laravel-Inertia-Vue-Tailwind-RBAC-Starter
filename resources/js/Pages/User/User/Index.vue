<template>
    <Head title="User" />
    <div class="p-4">
        <!-- Breadcrumb -->
        <nav
            class="block md:flex mt-2 md:mt-0 justify-between py-3 px-5 text-slate-700 bg-slate-50 rounded-lg border border-slate-200 dark:bg-slate-800 dark:border-slate-700"
            aria-label="Breadcrumb"
        >
            <p class="font-bold text-slate-800 dark:text-slate-200">User</p>
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <Link
                        :href="route('home')"
                        class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white"
                    >
                        <HomeIcon class="mr-2 mb-1 w-4 h-4" />
                        Dashboard
                    </Link>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <ChevronRightIcon class="w-6 h-4 text-slate-400" />
                        <span
                            class="ml-1 text-sm font-medium text-slate-500 md:ml-2 dark:text-slate-400"
                            >User</span
                        >
                    </div>
                </li>
            </ol>
        </nav>
        <div class="relative overflow-x-auto shadow-md rounded-lg mt-2 mb-4">
            <div
                class="flex justify-between p-2 bg-white border-b dark:bg-slate-800 dark:border-slate-700 mt-1"
            >
                <div class="flex">
                    <Link
                        :href="route('user.create')"
                        type="button"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                    >
                        <PlusIcon class="w-4 h-4 mr-1" />
                        Add
                    </Link>
                </div>
                <div class="">
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                        >
                            <SearchIcon
                                class="w-5 h-5 text-slate-500 dark:text-slate-400"
                            />
                        </div>
                        <input
                            type="text"
                            id="email-address-icon"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search..."
                            v-model="params.search"
                        />
                    </div>
                </div>
            </div>
            <table
                class="w-full text-sm text-left text-slate-500 dark:text-slate-400"
            >
                <thead
                    class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3 cursor-pointer" v-on:click="order('name')">
                            <span class="flex justify-between w-full">Name
                                <SortAscendingIcon v-if="params.field === 'name' && params.order === 'asc'" class="w-4 h-4" />
                                <SortDescendingIcon v-if="params.field === 'name' && params.order === 'desc'" class="w-4 h-4" />
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" v-on:click="order('email')">
                            <span class="flex justify-between w-full">Email
                                <SortAscendingIcon v-if="params.field === 'email' && params.order === 'asc'" class="w-4 h-4" />
                                <SortDescendingIcon v-if="params.field === 'email' && params.order === 'desc'" class="w-4 h-4" />
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" v-on:click="order('created_at')">
                            <span class="flex justify-between w-full">Created
                                <SortAscendingIcon v-if="params.field === 'created_at' && params.order === 'asc'" class="w-4 h-4" />
                                <SortDescendingIcon v-if="params.field === 'created_at' && params.order === 'desc'" class="w-4 h-4" />
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(user, index) in users.data"
                        :key="user.id"
                        class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600"
                    >
                        <td class="px-4 py-2">
                            {{ user.name }}
                        </td>
                        <td class="px-4 py-2">
                            {{ user.email }}
                        </td>
                        <td class="px-4 py-2">
                            {{ user.created_at }}
                        </td>
                        <td class="px-4 py-2 text-center">
                            <div class="inline-flex rounded-md shadow-sm">
                                <Link
                                    :href="route('user.edit', user.id)"
                                    type="button"
                                    class="inline-flex items-center py-1 px-2 text-sm font-medium text-white bg-blue-600 rounded-l-lg border border-gray-200 hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-blue-700 dark:border-blue-600 dark:text-white dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:focus:text-white"
                                >
                                    <PencilIcon class="mr-2 w-4 h-4" />
                                    Edit
                                </Link>
                                <Link
                                    :href="route('user.destroy', user.id)"
                                    method="delete"
                                    type="button"
                                    class="inline-flex items-center py-1 px-2 text-sm font-medium text-white bg-red-600 rounded-r-md border border-red-200 hover:bg-red-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-red-700 focus:text-red-700 dark:bg-red-700 dark:border-red-600 dark:text-white dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-500 dark:focus:text-white"
                                >
                                    <TrashIcon class="mr-2 w-4 h-4" />
                                    Delete
                                </Link>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination class="mt-2 flex" :links="users.links" />
    </div>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import {
    HomeIcon,
    SearchIcon,
    ChevronRightIcon,
    PlusIcon,
    PencilIcon,
    TrashIcon,
    SortAscendingIcon,
    SortDescendingIcon,
} from "@heroicons/vue/outline";
import App from "../App.vue";
import Pagination from "../Components/Pagination.vue";
import { pickBy, throttle } from "lodash";
export default {
    layout: App,
    components: {
        Head,
        Link,
        Pagination,
        HomeIcon,
        SearchIcon,
        ChevronRightIcon,
        PlusIcon,
        PencilIcon,
        TrashIcon,
        SortAscendingIcon,
        SortDescendingIcon,
    },
    data() {
        return {
            params: {
                search: this.filters.search,
                field: this.filters.field,
                order: this.filters.order,
            },
        };
    },
    props: {
        users: Object,
        flash: Object,
        filters: Object,
    },
    methods: {
        order(field) {
            this.params.field = field;
            this.params.order = this.params.order === "asc" ? "desc" : "asc";
        },
    },
    watch: {
        params: {
            handler: throttle(function() {
                let params = pickBy(this.params);
                this.$inertia.get(route("user.index"), params, {
                    replace: true,
                    preserveState: true,
                });
            }, 150),
            deep: true,
        },
    },
};
</script>
