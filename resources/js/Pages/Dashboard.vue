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
            icon="package"
            color="blue"
            description="Items in inventory"
          />
          <StatCard
            title="Pending Requests"
            :value="stats.pending_requests"
            icon="clock"
            color="yellow"
            description="Awaiting approval"
          />
          <StatCard
            title="Approved Today"
            :value="stats.approved_today"
            icon="check"
            color="green"
            description="Approved this week"
          />
        </div>

        <!-- Quick Actions -->
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl p-8 border-t-4 border-indigo-500">
          <h2 class="text-2xl font-black text-gray-900 mb-8 flex items-center gap-3">
            <Icon name="rocket" size="lg" class="text-indigo-600" />
            Quick Actions
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <Link
              href="/requests"
              class="group relative flex items-center justify-center px-8 py-5 bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 hover:shadow-xl font-bold text-lg"
            >
              <Icon name="list" size="lg" class="mr-3" />
              View My Requests
            </Link>
            <Link
              href="/inventory"
              class="group relative flex items-center justify-center px-8 py-5 bg-gradient-to-br from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 hover:shadow-xl font-bold text-lg"
            >
              <Icon name="package" size="lg" class="mr-3" />
              Browse Inventory
            </Link>
            <Link
              href="/requests/create"
              class="group relative flex items-center justify-center px-8 py-5 bg-gradient-to-br from-indigo-600 to-indigo-700 text-white rounded-xl hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105 hover:shadow-xl font-bold text-lg"
            >
              <Icon name="plus" size="lg" class="mr-3" />
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
import Icon from '@/Components/Icon.vue'

defineProps({
  stats: Object,
})
</script>
