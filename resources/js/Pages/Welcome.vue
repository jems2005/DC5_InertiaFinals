<template>
  <Head title="Inventory Request System - Manage Your Inventory">
    <meta name="description" content="An efficient inventory request management system for employees and administrators." />
    <meta name="keywords" content="inventory, requests, management, tracking, warehouse" />
  </Head>

  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-200 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
      <!-- Hero Section -->
      <div class="text-center mb-16">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
          Inventory Request System
        </h1>
        <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto">
          Manage inventory requests efficiently. Submit, track, and approve with ease.
        </p>
      </div>

      <!-- Live Stats Section -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
          <div class="text-4xl font-bold text-blue-600 mb-2">
            {{ stats.total_items }}
          </div>
          <div class="text-gray-600 font-medium">Total Items in Stock</div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
          <div class="text-4xl font-bold text-yellow-600 mb-2">
            {{ stats.pending_requests }}
          </div>
          <div class="text-gray-600 font-medium">Pending Requests</div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
          <div class="text-4xl font-bold text-green-600 mb-2">
            {{ stats.total_requests }}
          </div>
          <div class="text-gray-600 font-medium">Total Requests Processed</div>
        </div>
      </div>

      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <Link
          href="/login"
          class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-xl shadow-lg transition-all hover:shadow-xl text-center"
        >
          Sign In
        </Link>
        <Link
          href="/register"
          class="border-2 border-indigo-600 text-indigo-600 font-semibold py-3 px-8 rounded-xl hover:bg-indigo-600 hover:text-white transition-all shadow-lg text-center"
        >
          Get Started
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
import { Head, Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'

const stats = ref({
  total_items: 0,
  pending_requests: 0,
  total_requests: 0,
})

onMounted(async () => {
  try {
    const response = await axios.get('/api/stats')
    stats.value = response.data
  } catch (error) {
    console.error('Failed to fetch stats:', error)
  }
})
</script>
