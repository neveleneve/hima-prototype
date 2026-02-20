<template>
    <PageHeader title="Pengguna" :breadcrumb-items="breadcrumbItems" class="mb-3">
        <template #actions>
            <BaseButton variant="success" :icon="Plus" href="/admin/pengguna/create" :loading="processing">
                Tambah
            </BaseButton>
        </template>
    </PageHeader>
    <div
        class="component-bg rounded-xl shadow-md dark:shadow-gray-800/50 p-3 lg:border border-gray-200 dark:border-gray-700 transition-colors mb-3">
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
                    <tr class="bg-auto hover:bg-gray-100 dark:hover:bg-gray-800"
                        v-for="(item, index) in props.user.data" :key="index">
                        <th class="px-6 py-4">{{ index + 1 }}</th>
                        <th class="px-6 py-4">{{ item.name }}</th>
                        <th class="px-6 py-4">{{ item.username }}</th>
                        <th class="px-6 py-4">{{ item.email }}</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <Head title="Pengguna" />
</template>

<script setup>
import PageHeader from '@/Components/PageHeader.vue';
import BaseButton from '@/Components/BaseButton.vue';
import { Home, Map, Plus } from 'lucide-vue-next';
import { onMounted, ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
})

const processing = computed(() => router.processing)

const breadcrumbItems = [
    { label: 'Dashboard', to: '/admin', icon: Home },
    { label: 'Pengguna', to: '/admin/pengguna', icon: Map }
]
</script>
