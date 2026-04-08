<template>
  <Head title="Request Details">
    <meta name="description" content="View and manage a specific inventory request." />
    <meta name="keywords" content="request, details, approval, inventory" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
          <div>
            <h1 class="text-3xl font-bold text-gray-900">Request #{{ request.id }}</h1>
            <p class="text-gray-600 mt-2">Details for inventory request</p>
          </div>
          <Link
            href="/requests"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition-colors"
          >
            ← Back
          </Link>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <!-- Left Column - Request Details -->
          <div class="lg:col-span-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
              <h2 class="text-2xl font-bold text-gray-900 mb-4">Item Requested</h2>
              <div class="border-b border-gray-200 pb-4 mb-4">
                <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Item Name</p>
                <p class="text-2xl font-bold text-gray-900">{{ request.item.name }}</p>
              </div>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Category</p>
                  <p class="text-lg font-semibold text-gray-900">{{ request.item.category }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Unit</p>
                  <p class="text-lg font-semibold text-gray-900">{{ request.item.unit }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Quantity Requested</p>
                  <p class="text-2xl font-bold text-blue-600">{{ request.quantity_requested }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Current Stock</p>
                  <p
                    :class="[
                      'text-2xl font-bold',
                      request.item.quantity > 20
                        ? 'text-green-600'
                        : request.item.quantity > 5
                          ? 'text-yellow-600'
                          : 'text-red-600',
                    ]"
                  >
                    {{ request.item.quantity }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Requester Info -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
              <h2 class="text-2xl font-bold text-gray-900 mb-4">Requester Information</h2>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Name</p>
                  <p class="text-lg font-semibold text-gray-900">{{ request.requester.name }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Email</p>
                  <p class="text-lg font-semibold text-gray-900">{{ request.requester.email }}</p>
                </div>
                <div class="col-span-2">
                  <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Reason</p>
                  <p class="text-gray-900 whitespace-pre-wrap">{{ request.reason }}</p>
                </div>
              </div>
            </div>

            <!-- Status & Timeline -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
              <h2 class="text-2xl font-bold text-gray-900 mb-4">Status & Timeline</h2>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Current Status</p>
                  <StatusBadge :status="request.status" />
                </div>
                <div>
                  <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Submitted</p>
                  <p class="text-lg font-semibold text-gray-900">
                    {{ formatDate(request.created_at) }}
                  </p>
                </div>
                <div v-if="request.reviewed_by" class="col-span-2">
                  <p class="text-sm text-gray-600 uppercase tracking-wide mb-1">Reviewed By</p>
                  <p class="text-lg font-semibold text-gray-900">
                    {{ request.reviewer.name }} - {{ formatDate(request.updated_at) }}
                  </p>
                </div>
              </div>

              <!-- Admin Note -->
              <div v-if="request.admin_note" class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600 uppercase tracking-wide mb-2">Admin Note</p>
                <p class="text-gray-900 bg-gray-50 p-3 rounded whitespace-pre-wrap">
                  {{ request.admin_note }}
                </p>
              </div>
            </div>
          </div>

          <!-- Right Column - Admin Actions -->
          <div>
            <div
              v-if="canManage && request.status === 'pending'"
              class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
            >
              <h2 class="text-2xl font-bold text-gray-900 mb-4">Admin Actions</h2>

              <!-- Admin Note Input -->
              <div class="mb-6">
                <label for="admin_note" class="block text-sm font-medium text-gray-700 mb-2">
                  Admin Note (Optional)
                </label>
                <textarea
                  v-model="adminForm.admin_note"
                  id="admin_note"
                  rows="4"
                  placeholder="Add a note for the requester..."
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                />
                <p v-if="adminForm.errors.admin_note" class="text-red-600 text-sm mt-1">
                  {{ adminForm.errors.admin_note }}
                </p>
              </div>

              <!-- Approve Button -->
              <button
                @click="approveRequest"
                :disabled="adminForm.processing"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors disabled:opacity-50 mb-3"
              >
                {{ adminForm.processing ? 'Processing...' : '✓ Approve Request' }}
              </button>

              <!-- Reject Button -->
              <button
                @click="rejectRequest"
                :disabled="adminForm.processing"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors disabled:opacity-50"
              >
                {{ adminForm.processing ? 'Processing...' : '✗ Reject Request' }}
              </button>
            </div>

            <!-- Status Display for Non-Pending -->
            <div v-else class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
              <h2 class="text-2xl font-bold text-gray-900 mb-4">Request Status</h2>
              <div class="mb-4">
                <StatusBadge :status="request.status" />
              </div>
              <p class="text-gray-600 text-sm">
                This request has already been reviewed and cannot be modified.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Components/AppLayout.vue'
import StatusBadge from '@/Components/StatusBadge.vue'

defineProps({
  request: Object,
  canManage: Boolean,
})

const adminForm = useForm({
  admin_note: '',
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

const approveRequest = () => {
  adminForm.patch(route('requests.approve', request.id))
}

const rejectRequest = () => {
  adminForm.patch(route('requests.reject', request.id))
}
</script>
