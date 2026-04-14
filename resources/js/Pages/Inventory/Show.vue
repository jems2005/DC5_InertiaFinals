<template>
  <Head :title="`${item.name} - Inventory Details`">
    <meta name="description" content="View inventory item details and history." />
    <meta name="keywords" content="inventory, item, details, stock" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
          <div class="flex items-center gap-2 mb-4 text-sm">
            <Link href="/inventory" class="text-blue-600 hover:text-blue-800 font-medium">Inventory</Link>
            <span class="text-gray-400">/</span>
            <span class="text-gray-600">{{ item.name }}</span>
          </div>
          <div class="flex justify-between items-start">
            <div>
              <h1 class="text-4xl font-bold text-gray-900">{{ item.name }}</h1>
              <p class="text-gray-600 mt-2">Complete inventory details and management</p>
            </div>
            <div v-if="canManage" class="flex gap-3">
              <Link
                :href="`/inventory/${item.id}/edit`"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors shadow-md hover:shadow-lg"
              >
                Edit
              </Link>
              <button
                @click="deleteItem"
                :disabled="deleting"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors shadow-md hover:shadow-lg disabled:opacity-50"
              >
                {{ deleting ? 'Deleting...' : 'Delete' }}
              </button>
            </div>
          </div>
        </div>

        <!-- Item Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
          <!-- Main Details Card -->
          <div class="lg:col-span-2 bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-8">
              <h2 class="text-2xl font-bold text-gray-900 mb-6">Item Details</h2>

              <div class="space-y-6">
                <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                  <span class="text-gray-600 font-medium">Item Name</span>
                  <span class="text-xl font-bold text-gray-900">{{ item.name }}</span>
                </div>

                <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                  <span class="text-gray-600 font-medium">Category</span>
                  <span class="inline-block px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold">
                    {{ item.category }}
                  </span>
                </div>

                <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                  <span class="text-gray-600 font-medium">Unit</span>
                  <span class="text-gray-900 font-semibold">{{ item.unit }}</span>
                </div>

                <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                  <span class="text-gray-600 font-medium">Created</span>
                  <span class="text-gray-900 font-semibold">{{ formatDate(item.created_at) }}</span>
                </div>

                <div class="flex justify-between items-center">
                  <span class="text-gray-600 font-medium">Last Updated</span>
                  <span class="text-gray-900 font-semibold">{{ formatDate(item.updated_at) }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Stock Status Card -->
          <div class="bg-linear-to-br from-blue-50 to-indigo-50 rounded-xl shadow-lg overflow-hidden border border-blue-200">
            <div class="p-8">
              <h3 class="text-lg font-bold text-gray-900 mb-6">Stock Status</h3>

              <div class="text-center mb-6">
                <div
                  :class="[
                    'text-5xl font-bold mb-2',
                    item.quantity > 20 ? 'text-green-600' : item.quantity > 5 ? 'text-yellow-600' : 'text-red-600'
                  ]"
                >
                  {{ item.quantity }}
                </div>
                <div class="text-gray-600 font-medium">{{ item.unit }}</div>
              </div>

              <div
                :class="[
                  'text-center py-3 px-4 rounded-lg font-semibold text-white',
                  item.quantity > 20 ? 'bg-green-500' : item.quantity > 5 ? 'bg-yellow-500' : 'bg-red-500'
                ]"
              >
                <span v-if="item.quantity > 20">Good Stock</span>
                <span v-else-if="item.quantity > 5">Low Stock</span>
                <span v-else>Critical Stock</span>
              </div>

              <div class="mt-6 bg-white bg-opacity-50 rounded-lg p-4 text-sm text-gray-600">
                <p class="font-semibold mb-2">Quick Actions:</p>
                <Link
                  href="/requests/create"
                  class="text-blue-600 hover:text-blue-800 font-medium block mb-2"
                >
                  → Request this item
                </Link>
              </div>
            </div>
          </div>
        </div>

        <!-- Requests Related to This Item -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
          <div class="p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Request Summary</h2>

            <p v-if="item.requests_count === 0" class="text-gray-600 py-8 text-center">
              No requests for this item yet.
            </p>

            <div v-else class="text-center text-gray-600">
              <p class="font-semibold text-lg text-gray-900">{{ item.requests_count }} requests</p>
              <p class="text-sm mt-1">Total requests submitted for this item</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import AppLayout from '@/Components/AppLayout.vue'

const props = defineProps({
  item: Object,
  canManage: Boolean,
})

const deleting = ref(false)

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

const deleteItem = () => {
  if (confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
    deleting.value = true
    router.delete(route('inventory.destroy', props.item.id), {
      onFinish: () => {
        deleting.value = false
      }
    })
  }
}
</script>
