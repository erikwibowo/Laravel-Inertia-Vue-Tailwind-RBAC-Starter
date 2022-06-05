<template>
    <div class="flex w-full">
        <Sidebar />
        <div class="w-full">
            <Navbar />
        </div>
        <slot />
    </div>
    <!-- ./wrapper -->
</template>

<script>
//import Link dari inertia
import { Link } from "@inertiajs/inertia-vue3";
import Navbar from "./Components/Navbar.vue";
import Sidebar from "./Components/Sidebar.vue";

export default {
    //register Link di component
    components: {
        Link,
        Navbar,
        Sidebar
    },

    props: {
        auth: Object,
    },
};
</script>
