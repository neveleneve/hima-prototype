<template>
    <transition enter-active-class="transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]"
        enter-from-class="-translate-x-full opacity-0" enter-to-class="translate-x-0 opacity-100"
        leave-active-class="transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]"
        leave-from-class="translate-x-0 opacity-100" leave-to-class="-translate-x-full opacity-0">
        <aside v-show="isOpen"
            class="fixed inset-y-0 left-0 z-2000 w-full md:w-1/3 lg:w-1/5 xl:w-1/6 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 shadow-2xl md:rounded-r-2xl overflow-hidden">
            <div class="flex flex-col h-full">
                <div class="flex items-center border-b border-gray-200 dark:border-gray-800">
                    <button
                        class="px-6 py-5 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 grow cursor-pointer flex justify-center"
                        @click="$emit('toggle')">
                        <ChevronLeft class="w-5 h-5" />
                    </button>
                </div>
                <nav class="flex-1 overflow-y-auto px-3 py-4">
                    <ul class="space-y-1">
                        <li v-for="item in menuItems" :key="item.name">
                            <div v-if="item.children">
                                <button @click="toggleSubmenu(item.name)"
                                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200"
                                    :class="[isParentActive(item)
                                        ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-400 font-bold border-l-4 border-indigo-600'
                                        : 'hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-200 border-l-4 border-transparent']">
                                    <div class="flex items-center gap-3">
                                        <component :is="item.icon" class="w-5 h-5" />
                                        <span v-if="!isCollapsed">{{ item.name }}</span>
                                    </div>
                                    <component :is="openSubmenus.includes(item.name) ? ChevronUp : ChevronDown"
                                        class="w-4 h-4 opacity-50" />
                                </button>
                                <transition enter-active-class="transition-all duration-300 ease-in-out"
                                    enter-from-class="max-h-0 opacity-0" enter-to-class="max-h-screen opacity-100"
                                    leave-active-class="transition-all duration-300 ease-in-out"
                                    leave-from-class="max-h-screen opacity-100" leave-to-class="max-h-0 opacity-0">
                                    <ul v-if="openSubmenus.includes(item.name)"
                                        class="mt-1 ml-9 space-y-1 overflow-hidden">
                                        <li v-for="child in item.children" :key="child.name">
                                            <Link :href="child.to"
                                                class="block py-2 px-3 text-sm rounded-lg transition-colors" :class="[isLinkActive(child.to)
                                                    ? 'text-indigo-600 font-bold dark:text-indigo-400'
                                                    : 'text-gray-500 hover:text-gray-900 dark:hover:text-white']">
                                                {{ child.name }}
                                            </Link>
                                        </li>
                                    </ul>
                                </transition>
                            </div>
                            <Link v-else :href="item.to"
                                class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200"
                                :class="[isLinkActive(item.to)
                                    ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-400 font-bold border-l-4 border-indigo-600'
                                    : 'hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-200 border-l-4 border-transparent']">
                                <component :is="item.icon" class="w-5 h-5" />
                                <span v-if="!isCollapsed">{{ item.name }}</span>
                            </Link>
                        </li>
                    </ul>
                </nav>
                <div @click="handleLogout"
                    class="px-3 py-3 border-t border-gray-200 dark:border-gray-800 hover:bg-red-50 dark:hover:bg-red-900/30 cursor-pointer">
                    <button
                        class="flex items-center w-full px-3 py-2 text-left rounded-md text-red-600 dark:text-red-400 cursor-pointer">
                        <LogOutIcon class="w-5 h-5 mr-2" />
                        Logout
                    </button>
                </div>
            </div>
        </aside>
    </transition>
    <transition name="fade">
        <div v-if="isOpen" class="fixed inset-0 bg-black/40 z-1999" @click="$emit('toggle')"></div>
    </transition>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3' // Gunakan 'router' untuk memantau event
import { ChevronLeft, ChevronUp, ChevronDown, LogOutIcon, LayoutDashboard, Users, LogOut } from 'lucide-vue-next'

const props = defineProps({
    isOpen: { type: Boolean, default: true }
})
const emits = defineEmits(['toggle'])

const page = usePage()
const currentUrl = computed(() => page.url)
const isCollapsed = ref(false)
const openSubmenus = ref([])

const menuItems = [
    { name: 'Dashboard', to: '/admin', icon: LayoutDashboard },
    {
        name: 'Pengguna',
        icon: Users,
        children: [
            { name: 'Data Pengguna', to: '/admin/pengguna' },
        ],
    },
]

const normalize = (path) => path.split('?')[0].replace(/\/$/, "") || "/"
const isLinkActive = (to) => normalize(currentUrl.value) === normalize(to)
const isParentActive = (item) => item.children?.some(child => isLinkActive(child.to))

router.on('finish', () => {
    if (props.isOpen) {
        emits('toggle')
    }
})

watch(currentUrl, () => {
    menuItems.forEach(item => {
        if (item.children && isParentActive(item)) {
            if (!openSubmenus.value.includes(item.name)) openSubmenus.value.push(item.name)
        }
    })
    // emits('toggle')
}, { immediate: true })

const toggleSubmenu = (name) => {
    if (openSubmenus.value.includes(name)) {
        openSubmenus.value = openSubmenus.value.filter((n) => n !== name)
    } else {
        openSubmenus.value.push(name)
    }
}
</script>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: opacity 0.3s ease;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
}
</style>
