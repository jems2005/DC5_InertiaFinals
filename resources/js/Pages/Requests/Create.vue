<template>
  <Head title="Submit Request">
    <meta name="description" content="Submit a new inventory request." />
    <meta name="keywords" content="submit, request, inventory, item" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">Submit Inventory Request</h1>
          <p class="text-gray-600 mt-2">Request items from inventory for your use</p>
        </div>

        <!-- Form -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <form @submit.prevent="submitForm">
            <!-- Item Selection -->
            <div class="mb-6">
              <label for="item_id" class="block text-sm font-medium text-gray-700 mb-2">
                Select Item *
              </label>
              <select
                v-model="form.item_id"
                id="item_id"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': form.errors.item_id }"
              >
                <option value="">Choose an item...</option>
                <option v-for="item in items" :key="item.id" :value="item.id">
                  {{ item.name }} (Available: {{ item.quantity }} {{ item.unit }})
                </option>
              </select>
              <p v-if="form.errors.item_id" class="text-red-600 text-sm mt-1">
                {{ form.errors.item_id }}
              </p>
            </div>

            <!-- Quantity -->
            <div class="mb-6">
              <label for="quantity_requested" class="block text-sm font-medium text-gray-700 mb-2">
                Quantity Requested *
              </label>
              <div class="flex items-center gap-4">
                <input
                  v-model="form.quantity_requested"
                  type="number"
                  id="quantity_requested"
                  placeholder="0"
                  min="1"
                  class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  :class="{ 'border-red-500': form.errors.quantity_requested }"
                />
                <span v-if="selectedItem" class="text-gray-600">
                  {{ selectedItem.unit }}
                </span>
              </div>
              <p v-if="form.errors.quantity_requested" class="text-red-600 text-sm mt-1">
                {{ form.errors.quantity_requested }}
              </p>
              <p v-if="selectedItem" class="text-gray-600 text-sm mt-2">
                Available: {{ selectedItem.quantity }} {{ selectedItem.unit }}
              </p>
            </div>

            <!-- Reason -->
            <div class="mb-6">
              <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                Reason for Request *
              </label>
              <textarea
                v-model="form.reason"
                id="reason"
                rows="4"
                placeholder="Explain why you need this item..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': form.errors.reason }"
              />
              <p v-if="form.errors.reason" class="text-red-600 text-sm mt-1">
                {{ form.errors.reason }}
              </p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4">
              <button
                type="submit"
                :disabled="form.processing"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors disabled:opacity-50"
              >
                {{ form.processing ? 'Submitting...' : 'Submit Request' }}
              </button>
              <Link
                href="/requests"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition-colors"
              >
                Cancel
              </Link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { computed } from 'vue'
import AppLayout from '@/Components/AppLayout.vue'

const props = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
})

const form = useForm({
  item_id: '',
  quantity_requested: '',
  reason: '',
})

const selectedItem = computed(() => {
  return props.items.find((item) => item.id == form.item_id)
})

const submitForm = () => {
  form.post(route('requests.store'))
}
</script>
