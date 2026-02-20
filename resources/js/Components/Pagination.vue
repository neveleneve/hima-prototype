<template>
    <div v-if="links.length > 3" class="flex flex-wrap items-center gap-2">
        <template v-for="(link, key) in links" :key="key">
            <div v-if="link.url === null"
                class="px-4 py-2 text-sm text-gray-400 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg cursor-not-allowed"
                v-html="link.label" />

            <Link v-else :href="link.url"
                class="px-4 py-2 text-sm font-bold transition-all duration-200 rounded-lg border active:scale-95 shadow-sm"
                :class="{
                    'bg-green-600 text-white border-green-700 border-l-4 shadow-green-200 dark:shadow-none': link.active,
                    'bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800': !link.active
                }" v-html="link.label" preserve-scroll />
        </template>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    links: Array
})
</script>
