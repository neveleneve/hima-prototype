<template>
    <component :is="tag" :href="href" :type="!href ? type : undefined" :disabled="loading || disabled"
        class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg font-bold transition-all duration-200 active:scale-95 disabled:opacity-50 disabled:pointer-events-none"
        :class="variantClasses">
        <Loader2 v-if="loading" class="animate-spin h-4 w-4 text-current" />

        <component v-if="icon && !loading" :is="icon" class="w-4 h-4" />

        <slot />

        <component v-if="trailingIcon && !loading" :is="trailingIcon" class="w-4 h-4" />
    </component>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { Loader2 } from 'lucide-vue-next'

interface Props {
    type?: 'button' | 'submit' | 'reset'
    variant?: 'primary' | 'success' | 'danger' | 'ghost'
    icon?: any
    trailingIcon?: any
    loading?: boolean
    disabled?: boolean
    href?: string | null
}

const props = withDefaults(defineProps<Props>(), {
    type: 'button',
    variant: 'primary',
    loading: false,
    disabled: false,
    href: null,
})

const tag = computed(() => (props.href ? Link : 'button'))

const variantClasses = computed(() => {
    const styles = {
        primary: 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm shadow-indigo-200 dark:shadow-none',
        success: 'bg-emerald-500 text-white hover:bg-emerald-600 shadow-sm shadow-emerald-200 dark:shadow-none',
        danger: 'bg-red-500 text-white hover:bg-red-600 shadow-sm shadow-red-200 dark:shadow-none',
        ghost: 'bg-transparent hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-200'
    }
    return styles[props.variant] || styles.primary
})
</script>
