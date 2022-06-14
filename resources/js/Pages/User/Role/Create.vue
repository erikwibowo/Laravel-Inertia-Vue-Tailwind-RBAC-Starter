<template>
    <div
        class="bg-slate-800 bg-opacity-50 backdrop-blur-md overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 md:h-full"
    >
        <div class="relative m-auto p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600"
                >
                    <h3
                        class="text-xl font-semibold text-gray-900 dark:text-white"
                    >
                        Add Role
                    </h3>
                    <button
                        @click="$emit('close-modal')"
                        type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    >
                        <XIcon class="w-5 h-5" />
                    </button>
                </div>
                <form @submit.prevent="store">
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <div class="mb-6">
                            <label
                                for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Name</label
                            >
                            <input
                                v-model="form.name"
                                v-on:keydown.enter.prevent="store"
                                type="text"
                                id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Type Name"
                            />
                            <p
                                class="text-red-500 text-xs italic"
                                v-if="errors.name"
                            >
                                {{ errors.name }}
                            </p>
                        </div>
                        <div class="mb-6">
                            <label
                                for="guard_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Guard</label
                            >
                            <input
                                v-model="form.guard_name"
                                v-on:keydown.enter.prevent="store"
                                type="text"
                                id="guard_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Type Guard"
                            />
                            <p
                                class="text-red-500 text-xs italic"
                                v-if="errors.guard_name"
                            >
                                {{ errors.guard_name }}
                            </p>
                        </div>
                        <p
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            Permission
                        </p>

                        <p
                            class="text-red-500 text-xs italic"
                            v-if="errors.permissions"
                        >
                            {{ errors.permissions }}
                        </p>
                        <div
                            v-for="(permission, index) in permissions"
                            :key="permission.id"
                            class="flex items-start mb-1 w-4/12"
                        >
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input
                                        type="checkbox"
                                        :value="permission.id"
                                        :id="'permission_' + permission.id"
                                        class="w-4 h-4 bg-slate-50 rounded border border-slate-300 focus:ring-3 focus:ring-blue-300 dark:bg-slate-700 dark:border-slate-600 dark:focus:ring-blue-600 dark:ring-offset-slate-800"
                                        v-model="form.permissions"
                                    />
                                </div>
                                <label
                                    :for="'permission_' + permission.id"
                                    class="ml-2 items-center text-sm font-medium text-slate-900 dark:text-slate-300"
                                    >{{ permission.name }}</label
                                >
                            </div>
                            <!-- <a href="#" class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a> -->
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex justify-between items-center mx-auto p-4 rounded-b border-t border-gray-200 dark:border-gray-600"
                    >
                        <button
                            @click="$emit('close-modal')"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                        >
                            <XIcon class="w-5 h-5 mr-2 -ml-1" />
                            Close
                        </button>
                        <button
                            v-if="!isLoading"
                            type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            <SaveIcon class="w-5 h-5 mr-2 -ml-1" />
                            Save
                        </button>
                        <button
                            v-if="isLoading"
                            disabled
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            <RefreshIcon class="w-5 h-5 mr-2 -ml-1" />
                            Saving...
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { SaveIcon, XIcon, RefreshIcon } from "@heroicons/vue/outline";
export default {
    components: {
        SaveIcon,
        XIcon,
        RefreshIcon,
    },
    props: {
        errors: Object,
        permissions: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                guard_name: "web",
                permissions: [],
            }),
            isLoading: false,
        };
    },
    methods: {
        store() {
            this.isLoading = true;
            this.form.post(this.route("role.store"), {
                onSuccess: (data) => {
                    this.isLoading = false;
                    this.$emit("close-modal");
                },
                onError: (data) => {
                    this.isLoading = false;
                },
            });
        },
    },
};
</script>
