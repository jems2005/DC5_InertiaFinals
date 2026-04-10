<template>
  <div
    :class="[
      'bg-white overflow-hidden shadow-lg rounded-xl p-6 border-t-4 transition-all duration-300 hover:shadow-xl hover:scale-105 hover:translate-y-[-4px] cursor-pointer',
      colorClasses
    ]"
  >
    <div class="flex items-center justify-between">
      <div class="flex items-center flex-1">
        <div class="flex-shrink-0">
          <Icon :name="iconName" size="xl" :class="iconColor" />
        </div>
        <div class="ml-6 w-0 flex-1">
          <dl>
            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wide truncate">{{ title }}</dt>
            <dd>
              <div class="text-4xl font-black mt-1" :class="textColor">
                {{ formatNumber(value) }}
              </div>
            </dd>
            <dd v-if="description" class="text-xs text-gray-400 mt-2 leading-relaxed">
              {{ description }}
            </dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import Icon from './Icon.vue'

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
    blue: 'border-t-blue-500',
    green: 'border-t-green-500',
    yellow: 'border-t-yellow-500',
    red: 'border-t-red-500'
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

const iconName = computed(() => {
  const icons = {
    package: 'package',
    clock: 'clock',
    check: 'check'
  }
  return icons[props.icon] || props.icon
})

const iconColor = computed(() => {
  const colors = {
    blue: 'text-blue-600',
    green: 'text-green-600',
    yellow: 'text-yellow-600',
    red: 'text-red-600'
  }
  return colors[props.color]
})
</script>
