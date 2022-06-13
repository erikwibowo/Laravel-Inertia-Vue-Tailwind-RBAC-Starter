<template>
    <Head title="Dashboard" />
    <div class="p-4">
        <!-- Breadcrumb -->
        <nav class="block md:flex mt-2 md:mt-0 justify-between py-3 px-5 text-slate-700 bg-slate-50 rounded-lg border border-slate-200 dark:bg-slate-800 dark:border-slate-700" aria-label="Breadcrumb">
            <p class="font-bold text-slate-800 dark:text-slate-200">Welcome back! {{ $page.props.auth.user.name }}</p>
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                <Link :href="route('home')" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">
                    <HomeIcon class="mr-2 mb-1 w-4 h-4" />
                    Dashboard
                </Link>
                </li>
            </ol>
        </nav>
    </div>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { HomeIcon } from "@heroicons/vue/outline";
import App from "../App.vue";
export default {
    layout: App,
    components: {
        Head,
        Link,
        HomeIcon
    },
};
</script>
