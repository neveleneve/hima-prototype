<template>
    <AuthLayout>
        <PageHeader title="Pengguna" :breadcrumb-items="breadcrumbItems" class="mb-3">
            <template #actions>
                <Link href="/admin/pengguna/create" :class="{ 'opacity-50 pointer-events-none': processing }" class="
                    inline-flex items-center gap-0.5 lg:gap-2
                    text-xs lg:text-sm
                    px-1.5 py-1 lg:px-4 lg:py-2.5
                    bg-emerald-600 hover:bg-emerald-700 text-white
                    rounded-md lg:rounded-xl font-bold transition-all
                    active:scale-95 border-l-4 border-emerald-800
                    shadow-sm shadow-emerald-200 dark:shadow-none">
                    <Loader2 v-if="processing" class="w-4 h-4 animate-spin" />
                    <Plus v-else class="w-4 h-4" />
                    <span>Tambah</span>
                </Link>
            </template>
        </PageHeader>

        <div
            class="component-bg rounded-xl shadow-md dark:shadow-gray-800/50 p-3 lg:border border-gray-200 dark:border-gray-700 transition-colors mb-3">
            <div class="grid grid-cols gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mb-3">
                <div class="col-span-1">
                    <div class="relative">
                        <input type="text" placeholder="Cari nama, username, atau email..."
                            class="bg-white dark:bg-gray-900 w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all text-sm shadow-sm"
                            v-model="searchKeyword">
                        <Search class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />

                        <div v-if="processing" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <Loader2 class="w-3 h-3 animate-spin text-gray-400" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative hidden lg:block overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">#</th>
                            <th scope="col" class="px-6 py-3 font-medium">Nama</th>
                            <th scope="col" class="px-6 py-3 font-medium">Nama Pengguna</th>
                            <th scope="col" class="px-6 py-3 font-medium">Alamat Email</th>
                            <th scope="col" class="px-6 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-auto hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group"
                            v-for="(item, index) in props.user.data" :key="index">
                            <td
                                class="px-6 py-4 font-medium border-l-2 border-transparent group-hover:border-green-600 transition-all">
                                {{ (index + 1) + (props.user.current_page - 1) * props.user.per_page }}</td>
                            <td class="px-6 py-4">{{ item.name }}</td>
                            <td class="px-6 py-4">{{ item.username }}</td>
                            <td class="px-6 py-4">{{ item.email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <Link :href="`/admin/pengguna/${item.id}`"
                                        class="flex items-center gap-1.5 text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 transition-colors font-medium text-xs uppercase tracking-wider">
                                        <Eye class="w-4 h-4" />
                                        Lihat
                                    </Link>
                                    <span class="w-px h-4 bg-gray-200 dark:bg-gray-700"></span>
                                    <button @click="openDeleteModal(item.id)"
                                        class="flex items-center gap-1.5 text-slate-600 hover:text-red-600 dark:text-slate-400 dark:hover:text-red-400 transition-colors font-medium text-xs uppercase tracking-wider cursor-pointer">
                                        <Trash2 class="w-4 h-4" />
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                class="mt-6 flex flex-col md:flex-row justify-between items-center gap-4 bg-white dark:bg-gray-900 p-4 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm">

                <div class="flex flex-wrap items-center gap-4">
                    <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                        Menampilkan <span class="text-gray-900 dark:text-white">{{ props.user.from }}</span>
                        - <span class="text-gray-900 dark:text-white">{{ props.user.to }}</span>
                        dari <span class="text-gray-900 dark:text-white">{{ props.user.total }}</span>
                    </div>

                    <span class="hidden md:block w-px h-4 bg-gray-300 dark:bg-gray-700"></span>

                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-gray-500 uppercase">Baris:</span>
                        <div class="relative">
                            <select v-model="perPage"
                                class="bg-gray-50 dark:bg-gray-800 pl-3 pr-8 py-1.5 rounded-lg border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs font-bold shadow-sm border-l-4 border-l-green-600 appearance-none cursor-pointer">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <ChevronDown
                                class="w-3.5 h-3.5 absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none" />
                        </div>
                    </div>
                </div>

                <Pagination :links="props.user.links" />
            </div>
        </div>

        <transition enter-active-class="duration-300 ease-out" enter-from-class="opacity-0" enter-to-class="opacity-100"
            leave-active-class="duration-200 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-if="isModalOpen"
                class="fixed inset-0 z-9999 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                <div
                    class="bg-white dark:bg-gray-900 w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-gray-200 dark:border-gray-800">
                    <div class="p-6 text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start gap-4 mb-4">
                            <div
                                class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600">
                                <AlertTriangle class="w-6 h-6" />
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Hapus Pengguna?</h3>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed">
                            Apakah Anda yakin? Tindakan ini akan menghapus data permanen dan tidak bisa dibatalkan.
                        </p>
                    </div>

                    <div
                        class="flex flex-col md:flex-row gap-3 p-6 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-800">
                        <button @click="isModalOpen = false"
                            class="flex-1 px-4 py-2.5 rounded-xl font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors order-2 md:order-1">
                            Batal
                        </button>
                        <button @click="confirmDelete" :disabled="isDeleting"
                            class="flex-1 px-4 py-2.5 rounded-xl font-bold bg-red-600 text-white hover:bg-red-700 transition-all border-l-4 border-red-900 flex items-center justify-center gap-2 order-1 md:order-2 disabled:opacity-50 cursor-pointer disabled:pointer-events-none">
                            <Loader2 v-if="isDeleting" class="w-4 h-4 animate-spin" />
                            {{ isDeleting ? 'Menghapus...' : 'Ya, Hapus' }}
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </AuthLayout>

    <Head title="Pengguna | Dashboard SIMATEKAPP" />
</template>

<script setup>
import PageHeader from '@/Components/PageHeader.vue'
import AuthLayout from "@/Layouts/AuthLayout.vue"
import Pagination from '@/Components/Pagination.vue'
import { Home, User, Plus, Eye, Trash2, AlertTriangle, Loader2, Search, ChevronDown } from 'lucide-vue-next'
import { ref, computed, watch } from 'vue'
import { router, Head, Link } from '@inertiajs/vue3'

const props = defineProps({
    user: Object,
    filters: Object
})

const searchKeyword = ref(props.filters?.search || '')

const perPage = ref(props.filters?.per_page || 10)

const processing = computed(() => router.processing)

const isModalOpen = ref(false)
const userToDelete = ref(null)
const isDeleting = ref(false)

const breadcrumbItems = [
    { label: 'Dashboard', to: '/admin', icon: Home },
    { label: 'Pengguna', to: '/admin/pengguna', icon: User }
]

const openDeleteModal = (id) => {
    userToDelete.value = id
    isModalOpen.value = true
}

const confirmDelete = () => {
    if (!userToDelete.value) return

    router.delete(`/admin/pengguna/${userToDelete.value}`, {
        preserveScroll: true,
        onBefore: () => { isDeleting.value = true },
        onSuccess: () => {
            isModalOpen.value = false
            userToDelete.value = null
        },
        onFinish: () => { isDeleting.value = false }
    })
}

watch([searchKeyword, perPage], ([newSearch, newPerPage]) => {
    router.get('/admin/pengguna',
        {
            search: newSearch,
            per_page: newPerPage
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true
        }
    )
})
</script>
