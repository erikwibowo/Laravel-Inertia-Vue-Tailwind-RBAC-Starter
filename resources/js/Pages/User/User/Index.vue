<template>
    <Head title="User" />
    <div class="p-4">
        <!-- Breadcrumb -->
        <nav class="block md:flex mt-2 md:mt-0 justify-between py-3 px-5 text-slate-700 bg-slate-50 rounded-lg border border-slate-200 dark:bg-slate-800 dark:border-slate-700" aria-label="Breadcrumb">
            <p class="font-bold text-slate-800 dark:text-slate-200">User</p>
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <Link :href="route('home')" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">
                        <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Dashboard
                    </Link>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2 dark:text-slate-400">User</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="relative overflow-x-auto shadow-md rounded-lg mt-2 mb-4">
            <div class="flex justify-between p-2 bg-white border-b dark:bg-slate-800 dark:border-slate-700 mt-1">
                <div class="flex py-1">
                    <Link :href="route('user.create')" class="py-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</Link>
                </div>
                <div class="mt-1">
                    <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-500 dark:text-slate-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" id="email-address-icon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." v-model="q" @keyup="search">
                    </div>
                </div>
            </div>
            <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50 dark:bg-slate-700 dark:text-slate-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users.data" :key="user.id" class="bg-white border-b dark:bg-slate-800 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600">
                        <th scope="row" class="px-6 py-4 font-medium text-slate-600 dark:text-slate-400 whitespace-nowrap">
                            {{ index+1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ user.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.created_at }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <Link :href="route('user.edit', user.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link> | 
                            <Link :href="route('user.destroy', user.id)" method="delete" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination class="mt-2" :links="users.links" />
    </div>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import App from "../App.vue";
import _ from "lodash";
import Pagination from '../Components/Pagination.vue'

export default {
    layout: App,
    components: {
        Head,
        Link,
        Pagination
    },
    data() {
        return {
            q: this.q,
        }
    },
    props: {
        users: Object,
        flash: Object,
        q: String,
    },
    methods: {
        search: _.debounce(function() {
            this.$inertia.replace(
                route("user.index", {
                    q: this.q,
                })
            );
        }, 500),
    },
};
</script>
