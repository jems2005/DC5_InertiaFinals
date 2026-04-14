<template>
  <svg
    :class="sizeClasses"
    :viewBox="`0 0 24 24`"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
  >
    <!-- Package Icon -->
    <g v-if="name === 'package'">
      <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
      <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
      <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
      <line x1="12" y1="22.08" x2="12" y2="12"></line>
    </g>

    <!-- Tag Icon -->
    <g v-if="name === 'tag'">
      <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
      <circle cx="8" cy="8" r="1.5"></circle>
    </g>

    <!-- Chart Icon -->
    <g v-if="name === 'chart'">
      <line x1="12" y1="20" x2="12" y2="10"></line>
      <line x1="18" y1="20" x2="18" y2="4"></line>
      <line x1="6" y1="20" x2="6" y2="16"></line>
    </g>

    <!-- Ruler Icon -->
    <g v-if="name === 'ruler'">
      <path d="M21.21 15.89A10 10 0 1 1 8.11 2.79M22 4s-4.5 8-10 13M2 2s4.5 8 10 13"></path>
    </g>

    <!-- Checkmark Icon (for approved) -->
    <g v-if="name === 'check'">
      <polyline points="20 6 9 17 4 12"></polyline>
    </g>

    <!-- Clock Icon (for pending) -->
    <g v-if="name === 'clock'">
      <circle cx="12" cy="12" r="10"></circle>
      <polyline points="12 6 12 12 16 14"></polyline>
    </g>

    <!-- X Icon (for rejected) -->
    <g v-if="name === 'x'">
      <line x1="18" y1="6" x2="6" y2="18"></line>
      <line x1="6" y1="6" x2="18" y2="18"></line>
    </g>

    <!-- Edit Icon -->
    <g v-if="name === 'edit'">
      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
    </g>

    <!-- Trash Icon -->
    <g v-if="name === 'trash'">
      <polyline points="3 6 5 6 21 6"></polyline>
      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
      <line x1="10" y1="11" x2="10" y2="17"></line>
      <line x1="14" y1="11" x2="14" y2="17"></line>
    </g>

    <!-- List Icon -->
    <g v-if="name === 'list'">
      <line x1="8" y1="6" x2="21" y2="6"></line>
      <line x1="8" y1="12" x2="21" y2="12"></line>
      <line x1="8" y1="18" x2="21" y2="18"></line>
      <line x1="3" y1="6" x2="3.01" y2="6"></line>
      <line x1="3" y1="12" x2="3.01" y2="12"></line>
      <line x1="3" y1="18" x2="3.01" y2="18"></line>
    </g>

    <!-- Plus Icon -->
    <g v-if="name === 'plus'">
      <line x1="12" y1="5" x2="12" y2="19"></line>
      <line x1="5" y1="12" x2="19" y2="12"></line>
    </g>

    <!-- Eye Icon -->
    <g v-if="name === 'eye'">
      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
      <circle cx="12" cy="12" r="3"></circle>
    </g>

    <!-- Arrow Right Icon -->
    <g v-if="name === 'arrow-right'">
      <line x1="5" y1="12" x2="19" y2="12"></line>
      <polyline points="12 5 19 12 12 19"></polyline>
    </g>

    <!-- Rocket Icon -->
    <g v-if="name === 'rocket'">
      <path d="M4.5 16.5c-1.5-1.5-2-5-2-5l5-1.5m3-4c0-1.6-1.3-3-3-3s-3 1.4-3 3m0 4l-2.5 5c-.7 1.8 1 3.5 2.8 2.8l5-2.5m-6-6l6-6m6 6l-6-6"></path>
      <circle cx="11.5" cy="11.5" r="1.5"></circle>
    </g>

    <!-- Dashboard Icon -->
    <g v-if="name === 'dashboard'">
      <rect x="3" y="3" width="7" height="7"></rect>
      <rect x="14" y="3" width="7" height="7"></rect>
      <rect x="14" y="14" width="7" height="7"></rect>
      <rect x="3" y="14" width="7" height="7"></rect>
    </g>

    <!-- Alert Icon (Triangle with Exclamation) -->
    <g v-if="name === 'alert'">
      <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3.05h16.94a2 2 0 0 0 1.71-3.05l-8.47-14.14a2 2 0 0 0-3.42 0z"></path>
      <line x1="12" y1="9" x2="12" y2="13"></line>
      <line x1="12" y1="17" x2="12.01" y2="17"></line>
    </g>
  </svg>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  name: {
    type: String,
    required: true
  },
  size: {
    type: String,
    default: 'md',
    validator: (value) => ['xs', 'sm', 'md', 'lg', 'xl'].includes(value)
  }
})

const sizeClasses = computed(() => {
  const sizes = {
    xs: 'w-4 h-4',
    sm: 'w-5 h-5',
    md: 'w-6 h-6',
    lg: 'w-8 h-8',
    xl: 'w-10 h-10'
  }
  return sizes[props.size]
})
</script>
