<template>
    <div
        class="component-bg rounded-xl shadow-md dark:shadow-gray-800/50 p-4 lg:px-8 lg:py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 lg:border lg:border-gray-200 lg:dark:border-gray-700 transition-colors">
        <div>
            <h1 class="text-lg lg:text-2xl font-bold text-gray-800 dark:text-gray-100 mb-1">
                {{ title }}
            </h1>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 lg:space-x-2 uppercase">
                    <li v-for="(item, index) in breadcrumbItems" :key="index" class="
                        inline-flex items-center
                        text-gray-400 dark:text-gray-300
                        hover:text-gray-500 dark:hover:text-gray-400
                        last:text-green-500 last:dark:text-green-400
                        last:hover:text-green-600 last:hover:dark:text-green-500
                        font-bold last:font-extrabold">
                        <ChevronRight v-if="index > 0" class="
                            w-4 h-4 mx-1 text-gray-400 dark:text-gray-300" />
                        <Link :href="item.to" class="inline-flex items-center text-xs lg:text-sm transition-colors">
                            <component v-if="item.icon" :is="item.icon" class="w-4 h-4 mr-1.5" />
                            {{ item.label }}
                        </Link>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex items-center gap-2">
            <slot name="actions" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { ChevronRight } from 'lucide-vue-next'

interface BreadcrumbItem {
    label: string
    to?: string
    icon?: any
}

defineProps<{
    title: string
    breadcrumbItems: BreadcrumbItem[] // Kita buat mandatory agar tidak kosong
}>()
</script>
