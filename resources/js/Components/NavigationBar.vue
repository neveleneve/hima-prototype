<template>
    <header
        class="flex items-center justify-between px-4 h-16 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
        <div class="flex items-center gap-3 sm:gap-4 min-w-0">
            <button
                class="shrink-0 flex items-center justify-center p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"
                @click="$emit('toggle-sidebar')">
                <Menu class="w-6 h-6" />
            </button>
            <Link to="/admin"
                class="group flex items-center gap-2 min-w-0 shrink transition-all duration-200 active:scale-95">
            <span class="flex flex-col leading-none overflow-hidden text-left">
                <span
                    class="text-base sm:text-lg font-black tracking-tighter text-gray-900 dark:text-white whitespace-nowrap">
                    SIMATEK<span class="text-blue-600 dark:text-blue-400 hidden md:inline">APP</span>
                </span>
                <span
                    class="text-[9px] font-extrabold uppercase tracking-widest text-blue-600 dark:text-blue-400 block md:hidden text-left">
                    Dashboard
                </span>
            </span>
            </Link>
        </div>
    </header>
</template>

<script setup>
import { Menu } from 'lucide-vue-next';
</script>
