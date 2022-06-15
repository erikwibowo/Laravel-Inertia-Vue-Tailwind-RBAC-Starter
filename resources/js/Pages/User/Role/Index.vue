<template>
    <Head title="Role" />
    <div class="p-4">
        <!-- Breadcrumb -->
        <nav
            class="block md:flex mt-2 md:mt-0 justify-between py-3 px-5 text-slate-700 bg-slate-50 rounded-lg border border-slate-200 dark:bg-slate-800 dark:border-slate-700"
            aria-label="Breadcrumb"
        >
            <p class="font-bold text-slate-800 dark:text-slate-200">Role</p>
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
                            >Role</span
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
                    <button
                        @click="showModal = true"
                        type="button"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                    >
                        <PlusIcon class="w-4 h-4 mr-1" />
                        Add
                    </button>
                    <Create v-show="showModal" @close-modal="showModal = false" :errors="errors" :permissions="permissions" />
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
                            v-model="q"
                            @keyup="search"
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
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Guard</th>
                        <th scope="col" class="px-6 py-3">Permissions</th>
                        <th scope="col" class="px-6 py-3">Created</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(role, index) in roles.data"
                        :key="role.id"
                        class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-slate-600 dark:text-slate-400 whitespace-nowrap"
                        >
                            {{ index + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ role.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ role.guard_name }}
                        </td>
                        <td class="flex px-6 py-4">
                            <p
                                v-for="(permission, index) in roles.data[index]
                                    .permissions"
                                :key="index"
                            >
                                | {{ permission.name }} &nbsp;
                            </p>|
                        </td>
                        <td class="px-6 py-4">
                            {{ moment(role.created_at) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex rounded-md shadow-sm">
                                <Link
                                    :href="route('role.edit', role.id)"
                                    type="button"
                                    class="inline-flex items-center py-1 px-2 text-sm font-medium text-white bg-blue-600 rounded-l-lg border border-gray-200 hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-blue-700 dark:border-blue-600 dark:text-white dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-500 dark:focus:text-white"
                                >
                                    <PencilIcon class="mr-2 w-4 h-4" />
                                    Edit
                                </Link>
                                <Link
                                    :href="route('role.destroy', role.id)"
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
        <Pagination class="mt-2 flex" :links="roles.links" />
    </div>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import moment from "moment";
import {
    HomeIcon,
    SearchIcon,
    ChevronRightIcon,
    PlusIcon,
    PencilIcon,
    TrashIcon,
} from "@heroicons/vue/outline";
import App from "../App.vue";
import _ from "lodash";
import Pagination from "../Components/Pagination.vue";
import Create from "./Create.vue";

export default {
    layout: App,
    components: {
        Head,
        Link,
        Pagination,
        Create,
        HomeIcon,
        SearchIcon,
        ChevronRightIcon,
        PlusIcon,
        PencilIcon,
        TrashIcon,
    },
    data() {
        return {
            q: this.q,
            showModal: false,
        };
    },
    props: {
        errors: Object,
        roles: Object,
        permissions: Object,
        flash: Object,
        q: String,
    },
    methods: {
        search: _.debounce(function () {
            this.$inertia.replace(
                route("role.index", {
                    q: this.q,
                })
            );
        }, 500),
        moment(date) {
            return moment(date).format("D-MM-YYYY HH:mm");
        }
    },
};
</script>
