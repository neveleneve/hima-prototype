<template>
    <div class="flex flex-col min-h-screen bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-50">
        <div class="flex flex-1 overflow-hidden">
            <sidebar :is-open="isSidebarOpen" @toggle="isSidebarOpen = !isSidebarOpen" />
            <div class="flex flex-col flex-1 overflow-hidden">
                <navigation-bar :is-sidebar-open="isSidebarOpen" @toggle-sidebar="isSidebarOpen = !isSidebarOpen" />
                <main class="flex-1 overflow-y-auto p-2 sm:p-6">
                    <div class="transition-all duration-300">
                        <slot />
                    </div>
                </main>
            </div>
        </div>
        <Footer class="border-t border-gray-200 dark:border-gray-800 py-3" />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Sidebar from '@/Components/Sidebar.vue';
import NavigationBar from '@/Components/NavigationBar.vue';
import Footer from '@/Components/Footer.vue';


const isSidebarOpen = ref(false)
</script>
