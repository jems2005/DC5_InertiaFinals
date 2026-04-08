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
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors"
          >
            + Add Item
          </Link>
        </div>

        <!-- Table -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Item Name
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Category
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Quantity
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Unit
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="item in items.data" :key="item.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  <Link :href="`/inventory/${item.id}`" class="text-blue-600 hover:text-blue-800">
                    {{ item.name }}
                  </Link>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {{ item.category }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  <span v-if="item.quantity > 20" class="text-green-600 font-semibold">
                    {{ item.quantity }}
                  </span>
                  <span v-else-if="item.quantity > 5" class="text-yellow-600 font-semibold">
                    {{ item.quantity }}
                  </span>
                  <span v-else class="text-red-600 font-semibold">
                    {{ item.quantity }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {{ item.unit }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                  <Link
                    v-if="canManage"
                    :href="`/inventory/${item.id}/edit`"
                    class="text-blue-600 hover:text-blue-800 font-medium"
                  >
                    Edit
                  </Link>
                  <button
                    v-if="canManage"
                    @click="deleteItem(item.id)"
                    class="text-red-600 hover:text-red-800 font-medium"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Empty State -->
          <div v-if="items.data.length === 0" class="p-12 text-center">
            <p class="text-gray-600 text-lg">No inventory items found.</p>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="items.last_page > 1" class="mt-6 flex justify-center">
          <nav class="inline-flex space-x-2">
            <Link
              v-for="link in items.links"
              :key="link.label"
              :href="link.url"
              :class="[
                'px-3 py-2 rounded-md text-sm font-medium',
                link.active
                  ? 'bg-blue-600 text-white'
                  : 'bg-gray-200 text-gray-700 hover:bg-gray-300',
              ]"
              v-html="link.label"
            />
          </nav>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import AppLayout from '@/Components/AppLayout.vue'

defineProps({
  items: Object,
  canManage: Boolean,
})

const deleteItem = (id) => {
  if (confirm('Are you sure you want to delete this item?')) {
    Link({ method: 'delete', href: `/inventory/${id}` })
  }
}
</script>
