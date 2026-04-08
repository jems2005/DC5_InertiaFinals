<template>
  <Head title="Item Details">
    <meta name="description" content="View inventory item details." />
    <meta name="keywords" content="item, details, inventory, quantity" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
          <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ item.name }}</h1>
            <p class="text-gray-600 mt-2">Item details and information</p>
          </div>
          <Link
            href="/inventory"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition-colors"
          >
            ← Back
          </Link>
        </div>

        <!-- Details Card -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div>
              <div class="mb-6">
                <p class="text-sm text-gray-600 uppercase tracking-wide">Category</p>
                <p class="text-2xl font-bold text-gray-900">{{ item.category }}</p>
              </div>

              <div class="mb-6">
                <p class="text-sm text-gray-600 uppercase tracking-wide">Unit</p>
                <p class="text-2xl font-bold text-gray-900">{{ item.unit }}</p>
              </div>

              <div class="mb-6">
                <p class="text-sm text-gray-600 uppercase tracking-wide">Created</p>
                <p class="text-lg text-gray-900">{{ formatDate(item.created_at) }}</p>
              </div>
            </div>

            <!-- Right Column -->
            <div>
              <div class="mb-6">
                <p class="text-sm text-gray-600 uppercase tracking-wide">Current Quantity</p>
                <div class="mt-2">
                  <span v-if="item.quantity > 20" class="text-4xl font-bold text-green-600">
                    {{ item.quantity }}
                  </span>
                  <span v-else-if="item.quantity > 5" class="text-4xl font-bold text-yellow-600">
                    {{ item.quantity }}
                  </span>
                  <span v-else class="text-4xl font-bold text-red-600">
                    {{ item.quantity }}
                  </span>
                </div>
              </div>

              <div class="mb-6">
                <p class="text-sm text-gray-600 uppercase tracking-wide">Related Requests</p>
                <p class="text-2xl font-bold text-gray-900">{{ item.requests_count || 0 }}</p>
              </div>
            </div>
          </div>

          <!-- Last Updated -->
          <div class="border-t border-gray-200 mt-8 pt-6">
            <p class="text-sm text-gray-600">
              Last updated: {{ formatDate(item.updated_at) }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Components/AppLayout.vue'

defineProps({
  item: Object,
})

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  })
}
</script>
