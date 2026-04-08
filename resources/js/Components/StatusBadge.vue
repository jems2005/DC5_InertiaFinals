<template>
  <span
    :class="badgeClasses"
    class="px-3 py-1 rounded-full text-xs font-medium uppercase tracking-wide"
  >
    {{ status }}
  </span>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  status: {
    type: String,
    required: true,
    validator: (value) => ['pending', 'approved', 'rejected'].includes(value)
  }
})

const badgeClasses = computed(() => {
  const base = 'inline-flex items-center'

  return {
    pending: `${base} bg-yellow-100 text-yellow-800 border border-yellow-200`,
    approved: `${base} bg-green-100 text-green-800 border border-green-200`,
    rejected: `${base} bg-red-100 text-red-800 border border-red-200`
  }[props.status]
})
</script>
