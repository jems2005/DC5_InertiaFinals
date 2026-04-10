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
            class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-2 px-6 rounded-lg transition-all hover:shadow-lg hover:scale-105"
          >
            <Icon name="plus" size="sm" />
            New Request
          </Link>
        </div>

        <!-- Status Filters (Admin Only) -->
        <div v-if="canManage" class="mb-6 flex flex-wrap gap-3">
          <Link
            href="/requests"
            :class="[
              'inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all',
              !filters.status
                ? 'bg-blue-600 text-white shadow-lg'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200',
            ]"
          >
            <Icon name="list" size="sm" />
            All Requests
          </Link>
          <Link
            href="/requests?status=pending"
            :class="[
              'inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all',
              filters.status === 'pending'
                ? 'bg-yellow-600 text-white shadow-lg'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200',
            ]"
          >
            <Icon name="clock" size="sm" />
            Pending
          </Link>
          <Link
            href="/requests?status=approved"
            :class="[
              'inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all',
              filters.status === 'approved'
                ? 'bg-green-600 text-white shadow-lg'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200',
            ]"
          >
            <Icon name="check" size="sm" />
            Approved
          </Link>
          <Link
            href="/requests?status=rejected"
            :class="[
              'inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold transition-all',
              filters.status === 'rejected'
                ? 'bg-red-600 text-white shadow-lg'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200',
            ]"
          >
            <Icon name="x" size="sm" />
            Rejected
          </Link>
        </div>

        <!-- Requests Table -->
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                <tr>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    <span class="inline-flex items-center gap-2">
                      <Icon name="package" size="sm" class="text-blue-600" />
                      Item
                    </span>
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    <span class="inline-flex items-center gap-2">
                      <Icon name="chart" size="sm" class="text-orange-600" />
                      {{ canManage ? 'Requester' : 'Quantity' }}
                    </span>
                  </th>
                  <th v-if="canManage" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    <span class="inline-flex items-center gap-2">
                      <Icon name="chart" size="sm" class="text-orange-600" />
                      Quantity
                    </span>
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    Date
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                    Action
                  </th>
                </tr>
              </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="req in requests.data" :key="req.id" class="hover:bg-blue-50 transition-colors duration-150 border-b hover:shadow-sm">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                  {{ req.item.name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {{ canManage ? req.requester.name : req.quantity_requested }}
                </td>
                <td v-if="canManage" class="px-6 py-4 whitespace-nowrap text-sm">
                  <span class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-3 py-1.5 rounded-lg font-semibold">
                    {{ req.quantity_requested }} {{ req.item.unit }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <StatusBadge :status="req.status" />
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                  {{ formatDate(req.created_at) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                  <Link
                    :href="`/requests/${req.id}`"
                    class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 hover:bg-blue-100 px-3 py-1.5 rounded-lg font-semibold transition-all"
                  >
                    <Icon name="eye" size="sm" />
                    View
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
          </div>

          <!-- Empty State -->
          <div v-if="requests.data.length === 0" class="p-12 text-center">
            <p class="text-gray-600 text-lg">No requests found.</p>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="requests.last_page > 1" class="mt-6 flex justify-center">
          <nav class="inline-flex space-x-2">
              <Link
              v-for="link in requests.links.filter(link => link.url)"
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
import Icon from '@/Components/Icon.vue'

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
