<template>
  <span
    :class="badgeClasses"
    class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wide transition-all duration-200 hover:shadow-md"
  >
    <Icon :name="statusIcon" size="sm" />
    {{ status }}
  </span>
</template>

<script setup>
import { computed } from 'vue'
import Icon from './Icon.vue'

const props = defineProps({
  status: {
    type: String,
    required: true,
    validator: (value) => ['pending', 'approved', 'rejected'].includes(value)
  }
})

const statusIcon = computed(() => {
  return {
    pending: 'clock',
    approved: 'check',
    rejected: 'x'
  }[props.status]
})

const badgeClasses = computed(() => {
  const base = 'inline-flex items-center'

  return {
    pending: `${base} bg-yellow-100 text-yellow-800 border border-yellow-300`,
    approved: `${base} bg-green-100 text-green-800 border border-green-300`,
    rejected: `${base} bg-red-100 text-red-800 border border-red-300`
  }[props.status]
})
</script>
