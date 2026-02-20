<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';

const loading = ref(false)

const form = useForm({
    email: '',
    password: ''
})

const submit = () => {
    loading.value = true
    form.post('/login', {
        onFinish: () => {
            form.reset()
            loading.value = false
        },
    });
};
</script>

<template>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 dark:bg-gray-900 px-4 py-8">
        <div
            class="w-full max-w-md bg-white dark:bg-gray-900 sm:bg-gray-100 sm:dark:bg-gray-800 sm:p-10 sm:rounded-2xl sm:shadow-xl transition-all duration-300">
            <div class="mb-10 text-center">
                <div class="relative inline-block">
                    <img src="/logo.png" alt="SIBA Cargo" class="w-20 h-20 mx-auto mb-4 drop-shadow-md" />
                </div>
                <h1 class="text-2xl font-extrabold uppercase tracking-tight text-gray-900 dark:text-white sm:text-3xl">
                    himatekapp
                </h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 font-medium px-4">
                    by Himpunan Mahasiswa Teknik Kimia
                </p>
            </div>
            <div class="space-y-6">
                <h2 class="text-lg font-semibold text-center text-gray-700 dark:text-gray-300">
                    Sign In to your account
                </h2>
                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1 ml-1">
                            Email / Username
                        </label>
                        <input type="text" placeholder="Email / Username" v-model="form.email" autofocus
                            class="w-full h-12 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-black dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" />
                        <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1 ml-1">Password</label>
                        <input type="password" placeholder="Password" v-model="form.password"
                            class="w-full h-12 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-black dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" />
                    </div>
                    <button type="submit" :disabled="loading"
                        class="w-full h-12 mt-6 rounded-xl bg-blue-600 hover:bg-blue-700 active:scale-[0.98] dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-bold text-lg shadow-lg shadow-blue-500/30 flex justify-center items-center gap-3 transition-all disabled:opacity-70 disabled:pointer-events-none">
                        <LoaderCircle v-if="loading" class="h-5 w-5 animate-spin" />
                        <span>{{ loading ? 'Memproses...' : 'Masuk' }}</span>
                    </button>
                </form>
            </div>
            <p class="mt-8 text-center text-xs text-gray-400">
                &copy; 2026 Himateki UNRI. All rights reserved.
            </p>
        </div>
    </div>

    <Head title="Login | HIMATEKAPP" />
</template>
