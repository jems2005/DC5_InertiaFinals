<template>
  <Head title="Dashboard - StockFlow">
    <meta name="description" content="StockFlow Dashboard - Real-time inventory and request statistics with intelligent insights." />
    <meta name="keywords" content="dashboard, inventory, statistics, requests, stockflow" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8 flex items-center justify-between">
          <div>
            <h1 class="text-4xl font-black text-gray-900 flex items-center gap-2">
              <svg class="h-8 w-8 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7v3h20V7L12 2zm0 2.5l7 3.5H5l7-3.5zM2 10v9a2 2 0 002 2h16a2 2 0 002-2v-9H2zm3 2h3v5H5v-5zm5 0h3v5h-3v-5zm5 0h3v5h-3v-5z"/>
              </svg>
              Dashboard
            </h1>
            <p class="text-gray-600 mt-2 font-medium">Welcome back! Here's your inventory overview</p>
          </div>
          <div class="text-right">
            <p class="text-sm text-gray-600">Last updated: <span class="font-semibold text-gray-900">just now</span></p>
          </div>
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
            title="Approved This Week"
            :value="stats.approved_today"
            icon="check"
            color="green"
            description="Requests approved"
          />
        </div>

        <!-- Quick Actions -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 border-l-4 border-indigo-600 mb-8">
          <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3\">
            <svg class="h-7 w-7 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
              <path d="M5 2a1 1 0 0 0-1 1v6H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h2v6a1 1 0 0 0 1 1h3V9h6v12h3a1 1 0 0 0 1-1v-6h2a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2V3a1 1 0 0 0-1-1H5zm1 2h3v12H6V4zm8 0h3v12h-3V4z"/>
            </svg>
            Quick Actions
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <Link
              href="/requests"
              class="group relative flex items-center justify-center px-8 py-4 bg-linear-to-br from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 hover:shadow-xl font-bold text-base"
            >
              <Icon name="list" size="lg" class="mr-3" />
              View My Requests
            </Link>
            <Link
              href="/inventory"
              class="group relative flex items-center justify-center px-8 py-4 bg-linear-to-br from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 hover:shadow-xl font-bold text-base"
            >
              <Icon name="package" size="lg" class="mr-3" />
              Browse Inventory
            </Link>
            <Link
              href="/requests/create"
              class="group relative flex items-center justify-center px-8 py-4 bg-linear-to-br from-indigo-600 to-indigo-700 text-white rounded-xl hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300 transform hover:scale-105 hover:shadow-xl font-bold text-base"
            >
              <Icon name="plus" size="lg" class="mr-3" />
              New Request
            </Link>
          </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="bg-linear-to-br from-gray-50 to-gray-100 rounded-2xl p-6 shadow-sm border border-gray-200">
          <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="h-6 w-6 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
            </svg>
            Tips & Insights
          </h3>
          <div class="space-y-2 text-sm text-gray-700">
            <p class="flex items-start gap-2">
              <span class="text-indigo-600 font-bold mt-1">→</span>
              <span>Keep your inventory up to date for accurate stock levels and faster requests</span>
            </p>
            <p class="flex items-start gap-2">
              <span class="text-indigo-600 font-bold mt-1">→</span>
              <span>Use descriptive request notes to help admins process your requests faster</span>
            </p>
            <p class="flex items-start gap-2">
              <span class="text-indigo-600 font-bold mt-1">→</span>
              <span>Check your request history to track past orders and approvals</span>
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
import StatCard from '@/Components/StatCard.vue'
import Icon from '@/Components/Icon.vue'

defineProps({
  stats: Object,
})
</script>
