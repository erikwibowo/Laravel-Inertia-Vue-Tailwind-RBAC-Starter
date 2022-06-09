<template>
    <div v-if="links.length > 3" class="text-slate-600 dark:text-slate-400">
        <div class="flex flex-wrap -mb-1 mx-auto">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-3 py-2 text-sm leading-4 text-gray-400 rounded border border-slate-200 dark:border-slate-600"
                    v-html="link.label" />
                <Link v-else
                    class="mr-1 mb-1 px-3 py-2 text-sm leading-4 border border-slate-200 dark:border-slate-700 rounded focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
    export default {
        components: {
            Link,
        },
        props: {
            links: Array
        },
    }
</script>