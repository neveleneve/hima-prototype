<template>
    <AuthLayout>
        <PageHeader title="Pengguna" :breadcrumb-items="breadcrumbItems" class="mb-3">
            <template #actions>
                <Link href="/admin/pengguna" :class="{ 'opacity-50 pointer-events-none': processing }"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold transition-all active:scale-95 border-l-4 border-emerald-800 shadow-sm shadow-emerald-200 dark:shadow-none">
                <Loader2 v-if="processing" class="w-4 h-4 animate-spin" />
                <ChevronLeft v-else class="w-4 h-4" />

                <span>Kembali</span>
                </Link>
            </template>
        </PageHeader>
    </AuthLayout>

    <Head title="Detail Pengguna | Dashboard SIMATEKAPP" />
</template>

<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue"
import PageHeader from '@/Components/PageHeader.vue'
import { Home, User, ChevronLeft, Loader2, SquarePen } from 'lucide-vue-next'
import { onMounted, ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

const processing = computed(() => router.processing)

const props = defineProps({
    user: Object
})

const breadcrumbItems = [
    { label: 'Dashboard', to: '/admin', icon: Home },
    { label: 'Pengguna', to: '/admin/pengguna', icon: User },
    { label: 'Detail', to: '/admin/pengguna/' + props.user.id, icon: SquarePen },
]
</script>
