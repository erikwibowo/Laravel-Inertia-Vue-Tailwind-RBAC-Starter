<template>
    <transition name="slide-fade">
        <div v-if="flash.success && isVisible" class="absolute top-4 right-4 w-8/12 md:w-6/12 lg:w-3/12">
            <div class="flex p-4 justify-between items-center bg-green-100 rounded-lg dark:bg-green-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="mx-3 text-sm font-medium text-green-700 dark:text-green-800">
                    {{ flash.success }}
                </div>
                <button @click="toggle" type="button" class="ml-auto bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300">
                    <span class="sr-only">Close</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </div>
    </transition>
    <transition name="slide-fade">
        <div v-if="flash.error && isVisible" class="absolute top-4 right-4 w-8/12 md:w-6/12 lg:w-3/12">
            <div class="flex p-4 justify-between items-center bg-red-100 rounded-lg dark:bg-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="mx-3 text-sm font-medium text-red-700 dark:text-red-800">
                    {{ flash.error }}
                </div>
                <button @click="toggle" type="button" class="ml-auto bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300">
                    <span class="sr-only">Close</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        flash: Object,
    },
    data() {
        return {
            isVisible: false,
            timeout: null,
        }
    },
    methods: {
        toggle() {
            this.isVisible = false;
        },
    },
    watch: {
        flash: {
            deep: true,
            handler(newVal) {
                this.isVisible = true;

                if (this.timeout) {
                    clearTimeout(this.timeout);
                }

                this.timeout = setTimeout(() => {
                    this.isVisible = false;
                }, 3000);
            },
        },
    },
}
</script>

<style>
    /*
    Enter and leave animations can use different
    durations and timing functions.
    */
    .slide-fade-enter-active {
    transition: all 0.3s ease-out;
    }

    .slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
    }
</style>