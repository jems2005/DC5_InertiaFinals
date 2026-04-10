<template>
  <Link
    :href="href"
    :class="[
      'px-4 py-2 rounded-md text-sm font-medium transition-all duration-200',
      active
        ? 'bg-blue-100 text-blue-700'
        : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900'
    ]"
  >
    {{ label }}
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  href: String,
  active: Boolean,
  label: String,
})
</script>

