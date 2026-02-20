<template>
    <div
        class="component-bg rounded-xl shadow-md dark:shadow-gray-800/50 p-4 md:px-8 md:py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3 lg:border lg:border-gray-200 lg:dark:border-gray-700 transition-colors">
        <div>
            <h1 class="text-lg md:text-2xl font-bold text-gray-800 dark:text-gray-100 mb-1">
                {{ title }}
            </h1>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li v-for="(item, index) in breadcrumbItems" :key="index" class="
                        inline-flex items-center
                        font-bold
                        text-gray-400 dark:text-gray-300
                        hover:text-gray-500 dark:hover:text-gray-400
                        last:text-blue-500 last:dark:text-blue-400
                        last:hover:text-blue-600 last:hover:dark:text-blue-500
                         last:font-extrabold">
                        <ChevronRight v-if="index > 0" class="
                            w-4 h-4 mx-1 text-gray-400 dark:text-gray-300" />
                        <Link :href="item.to" class="inline-flex items-center text-sm transition-colors">
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
