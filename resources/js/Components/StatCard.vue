<template>
  <div
    :class="[
      'bg-white overflow-hidden shadow rounded-lg p-6',
      colorClasses
    ]"
  >
    <div class="flex items-center">
      <div class="flex-shrink-0 text-4xl">
        {{ icon }}
      </div>
      <div class="ml-5 w-0 flex-1">
        <dl>
          <dt class="text-sm font-medium text-gray-500 truncate">{{ title }}</dt>
          <dd>
            <div class="text-3xl font-bold" :class="textColor">
              {{ formatNumber(value) }}
            </div>
          </dd>
          <dd v-if="description" class="text-xs text-gray-500 mt-1">
            {{ description }}
          </dd>
        </dl>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  title: String,
  value: Number,
  icon: String,
  color: {
    type: String,
    default: 'blue',
    validator: (value) => ['blue', 'green', 'yellow', 'red'].includes(value)
  },
  description: String
})

const formatNumber = (num) => {
  return new Intl.NumberFormat().format(num)
}

const colorClasses = computed(() => {
  const colors = {
    blue: 'border-l-4 border-blue-500',
    green: 'border-l-4 border-green-500',
    yellow: 'border-l-4 border-yellow-500',
    red: 'border-l-4 border-red-500'
  }
  return colors[props.color]
})

const textColor = computed(() => {
  const colors = {
    blue: 'text-blue-600',
    green: 'text-green-600',
    yellow: 'text-yellow-600',
    red: 'text-red-600'
  }
  return colors[props.color]
})
</script>
