<template>
  <Head title="Dashboard - Inventory System">
    <meta name="description" content="Dashboard with real-time inventory and request statistics." />
    <meta name="keywords" content="dashboard, inventory, statistics, requests" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
          <p class="text-gray-600 mt-2">Welcome to your Inventory Request System</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <StatCard
            title="Total Items"
            :value="stats.total_items"
            icon="📦"
            color="blue"
            description="Items in inventory"
          />
          <StatCard
            title="Pending Requests"
            :value="stats.pending_requests"
            icon="⏳"
            color="yellow"
            description="Awaiting approval"
          />
          <StatCard
            title="Approved Today"
            :value="stats.approved_today"
            icon="✅"
            color="green"
            description="Approved this week"
          />
        </div>

        <!-- Quick Actions -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <h2 class="text-2xl font-bold text-gray-900 mb-6">Quick Actions</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <Link
              href="/requests"
              class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold"
            >
              View My Requests
            </Link>
            <Link
              href="/inventory"
              class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-semibold"
            >
              Browse Inventory
            </Link>
            <Link
              href="/requests/create"
              class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-semibold"
            >
              New Request
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Components/AppLayout.vue'
import StatCard from '@/Components/StatCard.vue'

defineProps({
  stats: Object,
})
</script>
