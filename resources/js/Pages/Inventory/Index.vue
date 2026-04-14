<template>
  <Head title="Inventory - Browse Items">
    <meta name="description" content="Browse all inventory items, view quantity and details." />
    <meta name="keywords" content="inventory, items, stock, quantity" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
          <div>
            <h1 class="text-3xl font-bold text-gray-900">Inventory Items</h1>
            <p class="text-gray-600 mt-2">Manage and view all inventory items</p>
          </div>
          <Link
            v-if="canManage"
            href="/inventory/create"
            class="inline-flex items-center gap-2 bg-linear-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-2 px-6 rounded-lg transition-all hover:shadow-lg hover:scale-105"
          >
            <Icon name="plus" size="sm" />
            Add Item
          </Link>
        </div>

        <!-- Table -->
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-linear-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                <tr>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    <span class="inline-flex items-center gap-2">
                      <Icon name="package" size="sm" class="text-blue-600" />
                      Item Name
                    </span>
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    <span class="inline-flex items-center gap-2">
                      <Icon name="tag" size="sm" class="text-purple-600" />
                      Category
                    </span>
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    <span class="inline-flex items-center gap-2">
                      <Icon name="chart" size="sm" class="text-orange-600" />
                      Quantity
                    </span>
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    <span class="inline-flex items-center gap-2">
                      <Icon name="ruler" size="sm" class="text-pink-600" />
                      Unit
                    </span>
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="item in items.data" :key="item.id" class="hover:bg-blue-50 transition-colors duration-150 border-b hover:shadow-sm">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                    <Link :href="`/inventory/${item.id}`" class="text-blue-600 hover:text-blue-800 hover:underline transition-colors">
                      {{ item.name }}
                    </Link>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    <span class="inline-block bg-purple-100 text-purple-800 px-3 py-1.5 rounded-full text-xs font-semibold">
                      {{ item.category }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span v-if="item.quantity > 20" class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-3 py-1.5 rounded-lg font-bold" title="Good Stock">
                      <Icon name="check" size="sm" />
                      {{ item.quantity }}
                    </span>
                    <span v-else-if="item.quantity > 5" class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-800 px-3 py-1.5 rounded-lg font-bold" title="Low Stock - Reorder Soon">
                      <Icon name="alert" size="sm" />
                      {{ item.quantity }}
                    </span>
                    <span v-else class="inline-flex items-center gap-2 bg-red-100 text-red-800 px-3 py-1.5 rounded-lg font-bold" title="Critical Stock">
                      <Icon name="x" size="sm" />
                      {{ item.quantity }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                    {{ item.unit }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2 flex">
                    <Link
                      v-if="canManage"
                      :href="`/inventory/${item.id}/edit`"
                      class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 hover:bg-blue-100 px-3 py-1.5 rounded-lg font-semibold transition-all"
                    >
                      <Icon name="edit" size="sm" />
                      Edit
                    </Link>
                    <button
                      v-if="canManage"
                      @click="deleteItem(item.id)"
                      class="inline-flex items-center gap-2 text-red-600 hover:text-red-800 hover:bg-red-100 px-3 py-1.5 rounded-lg font-semibold transition-all"
                    >
                      <Icon name="trash" size="sm" />
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Empty State -->
          <div v-if="items.data.length === 0" class="p-12 text-center">
            <p class="text-gray-600 text-lg">No inventory items found.</p>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="items.last_page > 1" class="mt-6 flex justify-center">
          <nav class="inline-flex space-x-2">
              <Link
              v-for="link in items.links.filter(link => link.url)"
              :key="link.label"
              :href="link.url"
              :class="[
                'px-3 py-2 rounded-md text-sm font-medium',
                link.active
                  ? 'bg-blue-600 text-white'
                  : 'bg-gray-200 text-gray-700 hover:bg-gray-300',
              ]"
              v-text="link.label"
            />
          </nav>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import AppLayout from '@/Components/AppLayout.vue'
import Icon from '@/Components/Icon.vue'

defineProps({
  items: Object,
  canManage: Boolean,
})

const deleteItem = (id) => {
  if (confirm('Are you sure you want to delete this item?')) {
    router.delete(`/inventory/${id}`)
  }
}
</script>
