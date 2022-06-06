<template>
    <Head title="Dashboard" />
    <div class="p-4">
        <!-- Breadcrumb -->
        <nav class="block md:flex mt-2 md:mt-0 justify-between py-3 px-5 text-slate-700 bg-slate-50 rounded-lg border border-slate-200 dark:bg-slate-800 dark:border-slate-700" aria-label="Breadcrumb">
            <p class="font-bold text-slate-800 dark:text-slate-200">Welcome back! {{ $page.props.auth.user.name }}</p>
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                <Link :href="route('home')" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">
                    <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    Dashboard
                </Link>
                </li>
            </ol>
        </nav>
    </div>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import App from "../App.vue";
export default {
    layout: App,
    components: {
        Head,
        Link
    },
};
</script>
