<template>
<Head title="Login" />
    <div class="flex w-full min-h-screen p-4 bg-white dark:bg-slate-700">
        <div class="m-auto p-4 w-96 bg-white rounded-lg border border-slate-200 shadow-md sm:p-6 lg:p-8 dark:bg-slate-800 dark:border-slate-700">
            <form class="space-y-6" @submit.prevent="login">
                <h5 class="text-xl font-medium text-slate-900 dark:text-white">Sign in to our platform</h5>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-slate-900 dark:text-slate-300">Your email</label>
                    <input type="email" name="email" id="email" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-600 dark:border-slate-500 dark:placeholder-slate-400 dark:text-white" placeholder="email@email.com" v-model="form.email">
                    <p class="text-red-500 text-xs italic" v-if="errors.email">{{ errors.email }}</p>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-slate-900 dark:text-slate-300">Your password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-600 dark:border-slate-500 dark:placeholder-slate-400 dark:text-white" v-model="form.password">
                    <p class="text-red-500 text-xs italic" v-if="errors.password">{{ errors.password }}</p>
                </div>
                <div class="flex items-start">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" type="checkbox" value="" class="w-4 h-4 bg-slate-50 rounded border border-slate-300 focus:ring-3 focus:ring-blue-300 dark:bg-slate-700 dark:border-slate-600 dark:focus:ring-blue-600 dark:ring-offset-slate-800" v-model="form.remember">
                        </div>
                        <label for="remember" class="ml-2 text-sm font-medium text-slate-900 dark:text-slate-300">Remember me</label>
                    </div>
                    <!-- <a href="#" class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a> -->
                </div>
                <button v-if="!isLoading" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Login to your account
                </button>
                <button v-if="isLoading" disabled type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Loading...
                </button>
            </form>
        </div>
    </div>
</template>

<script>

import { Head } from '@inertiajs/inertia-vue3';

export default {
    name: 'Login',
    components: {
        Head
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                email: "",
                password: "",
                remember: false,
            }),
            isLoading: false,
        };
    },
    methods: {
        login() {
            this.isLoading = true;
            this.form.post(this.route('login'), {
                onSuccess: (data) => {
                    this.isLoading = false;
                },
                onError: (data) => {
                    this.isLoading = false;
                    this.form.reset('password');
                },
            });
        }
    },
}
</script>