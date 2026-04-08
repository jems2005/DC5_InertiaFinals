<template>
  <Head title="Inventory Requests">
    <meta name="description" content="View and manage inventory requests." />
    <meta name="keywords" content="requests, inventory, approval, pending" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
          <div>
            <h1 class="text-3xl font-bold text-gray-900">
              {{ canManage ? 'All Requests' : 'My Requests' }}
            </h1>
            <p class="text-gray-600 mt-2">
              {{ canManage ? 'Manage and approve/reject requests' : 'Track your submitted requests' }}
            </p>
          </div>
          <Link
            href="/requests/create"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors"
          >
            + New Request
          </Link>
        </div>

        <!-- Status Filters (Admin Only) -->
        <div v-if="canManage" class="mb-6 flex gap-2">
          <Link
            href="/requests"
            :class="[
              'px-4 py-2 rounded-lg font-medium transition-colors',
              !filters.status
                ? 'bg-blue-600 text-white'
                : 'bg-gray-200 text-gray-700 hover:bg-gray-300',
            ]"
          >
            All Requests
          </Link>
          <Link
            href="/requests?status=pending"
            :class="[
              'px-4 py-2 rounded-lg font-medium transition-colors',
              filters.status === 'pending'
                ? 'bg-yellow-600 text-white'
                : 'bg-gray-200 text-gray-700 hover:bg-gray-300',
            ]"
          >
            Pending
          </Link>
          <Link
            href="/requests?status=approved"
            :class="[
              'px-4 py-2 rounded-lg font-medium transition-colors',
              filters.status === 'approved'
                ? 'bg-green-600 text-white'
                : 'bg-gray-200 text-gray-700 hover:bg-gray-300',
            ]"
          >
            Approved
          </Link>
          <Link
            href="/requests?status=rejected"
            :class="[
              'px-4 py-2 rounded-lg font-medium transition-colors',
              filters.status === 'rejected'
                ? 'bg-red-600 text-white'
                : 'bg-gray-200 text-gray-700 hover:bg-gray-300',
            ]"
          >
            Rejected
          </Link>
        </div>

        <!-- Requests Table -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Item
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ canManage ? 'Requester' : 'Quantity' }}
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Quantity
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Date
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Action
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="req in requests.data" :key="req.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ req.item.name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {{ canManage ? req.requester.name : req.quantity_requested }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {{ req.quantity_requested }} {{ req.item.unit }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <StatusBadge :status="req.status" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {{ formatDate(req.created_at) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                  <Link
                    :href="`/requests/${req.id}`"
                    class="text-blue-600 hover:text-blue-800 font-medium"
                  >
                    View
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Empty State -->
          <div v-if="requests.data.length === 0" class="p-12 text-center">
            <p class="text-gray-600 text-lg">No requests found.</p>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="requests.last_page > 1" class="mt-6 flex justify-center">
          <nav class="inline-flex space-x-2">
            <Link
              v-for="link in requests.links"
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
import AppLayout from '@/Components/AppLayout.vue'
import StatusBadge from '@/Components/StatusBadge.vue'

defineProps({
  requests: Object,
  canManage: Boolean,
  filters: Object,
})

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric',
  })
}
</script>
