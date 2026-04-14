<template>
  <Head title="StockFlow - Intelligent Inventory Management System">
    <meta name="description" content="StockFlow: Professional inventory management system for warehouses and enterprises. Real-time stock tracking, request management, and approval workflows." />
    <meta name="keywords" content="inventory management, stock control, warehouse management, request tracking, stockflow" />
  </Head>

  <div class="min-h-screen bg-linear-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Navigation Header -->
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <Link href="/" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
          <div class="bg-linear-to-br from-blue-600 to-indigo-700 p-2 rounded-lg">
            <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2L2 7v3h20V7L12 2zm0 2.5l7 3.5H5l7-3.5zM2 10v9a2 2 0 002 2h16a2 2 0 002-2v-9H2zm3 2h3v5H5v-5zm5 0h3v5h-3v-5zm5 0h3v5h-3v-5z"/>
            </svg>
          </div>
          <span class="text-xl font-black bg-linear-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">StockFlow</span>
        </Link>
        <div class="flex gap-3">
          <Link
            href="/login"
            class="text-gray-700 hover:text-indigo-600 font-semibold px-4 py-2 rounded-lg transition-colors"
          >
            Sign In
          </Link>
          <Link
            href="/register"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg transition-colors"
          >
            Get Started
          </Link>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28">
      <div class="text-center mb-16">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-100 rounded-full mb-6">
          <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 3.062v6.218c0 1.254.592 2.443 1.602 3.238l.96.84a1 1 0 001.038-1.595l-.96-.84C15.889 10.002 15 8.495 15 6.735v-6.218a1.066 1.066 0 00-.938-1.043 5.066 5.066 0 01-1.735-.723 5.066 5.066 0 00-6.654 0 5.066 5.066 0 01-1.735.723 1.066 1.066 0 00-.938 1.043v6.218c0 1.76-.889 3.267-2.238 4.186l-.96.84a1 1 0 001.038 1.595l.96-.84c1.01-.795 1.602-1.984 1.602-3.238V6.517a3.066 3.066 0 012.812-3.062z" clip-rule="evenodd"></path>
          </svg>
          <span class="text-indigo-700 font-semibold text-sm">Professional Inventory Solution</span>
        </div>
        <h1 class="text-5xl md:text-7xl font-black text-gray-900 mb-6 leading-tight">
          Smart Inventory<br />
          <span class="bg-linear-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">Management System</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
          Streamline your warehouse operations with real-time stock tracking, intelligent request management, and automated approval workflows. Built for teams that demand efficiency.
        </p>
      </div>

      <!-- Live Stats Section -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
        <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-blue-600 hover:shadow-xl transition-shadow">
          <div class="flex items-center justify-between mb-4">
            <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2L2 7v3h20V7L12 2zm0 2.5l7 3.5H5l7-3.5zM2 10v9a2 2 0 002 2h16a2 2 0 002-2v-9H2zm3 2h3v5H5v-5zm5 0h3v5h-3v-5zm5 0h3v5h-3v-5z"/>
            </svg>
            <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold">Live</span>
          </div>
          <div class="text-5xl font-black text-gray-900 mb-2">
            {{ stats.total_items }}
          </div>
          <p class="text-gray-600 font-medium">Items in Stock</p>
          <p class="text-sm text-gray-500 mt-2">Tracked and organized</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-yellow-600 hover:shadow-xl transition-shadow">
          <div class="flex items-center justify-between mb-4">
            <svg class="w-10 h-10 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
            </svg>
            <span class="text-xs bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full font-semibold">Pending</span>
          </div>
          <div class="text-5xl font-black text-gray-900 mb-2">
            {{ stats.pending_requests }}
          </div>
          <p class="text-gray-600 font-medium">Requests Awaiting</p>
          <p class="text-sm text-gray-500 mt-2">Approval needed</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-green-600 hover:shadow-xl transition-shadow">
          <div class="flex items-center justify-between mb-4">
            <svg class="w-10 h-10 text-green-600" fill="currentColor" viewBox="0 0 24 24">
              <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">Processed</span>
          </div>
          <div class="text-5xl font-black text-gray-900 mb-2">
            {{ stats.total_requests }}
          </div>
          <p class="text-gray-600 font-medium">Total Processed</p>
          <p class="text-sm text-gray-500 mt-2">All-time transactions</p>
        </div>
      </div>

      <!-- Features Section -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <div class="bg-white rounded-2xl shadow-lg p-8">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Complete CRUD Operations</h3>
          </div>
          <p class="text-gray-600">Create, read, update, and delete inventory items with a user-friendly interface. Full control over your stock management.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Approval Workflow</h3>
          </div>
          <p class="text-gray-600">Streamlined approval process with admin dashboard. Approve or reject requests with detailed notes and automatic inventory updates.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Role-Based Access</h3>
          </div>
          <p class="text-gray-600">Admin and employee roles with granular permissions. Secure access control ensures data integrity and compliance.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Real-Time Analytics</h3>
          </div>
          <p class="text-gray-600">Live dashboard with key metrics. Track inventory levels, pending requests, and processed transactions at a glance.</p>
        </div>
      </div>

      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center mb-20">
        <Link
          href="/login"
          class="bg-linear-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all text-center text-lg block"
        >
          Sign In Now
        </Link>
        <Link
          href="/register"
          class="border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white font-bold py-4 px-8 rounded-xl transition-all shadow-lg text-center text-lg"
        >
          Create Account
        </Link>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
          <div>
            <div class="flex items-center gap-2 mb-4">
              <div class="bg-linear-to-br from-blue-600 to-indigo-700 p-2 rounded-lg">
                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2L2 7v3h20V7L12 2zm0 2.5l7 3.5H5l7-3.5zM2 10v9a2 2 0 002 2h16a2 2 0 002-2v-9H2zm3 2h3v5H5v-5zm5 0h3v5h-3v-5zm5 0h3v5h-3v-5z"/>
                </svg>
              </div>
              <span class="text-xl font-black text-white">StockFlow</span>
            </div>
            <p class="text-sm">Professional inventory management for modern enterprises.</p>
          </div>
          <div>
            <h4 class="text-white font-bold mb-4">Product</h4>
            <ul class="space-y-2 text-sm">
              <li><Link href="/" class="hover:text-white transition-colors">Features</Link></li>
              <li><Link href="/login" class="hover:text-white transition-colors">Sign In</Link></li>
              <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
            </ul>
          </div>
          <div>
            <h4 class="text-white font-bold mb-4">Company</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="#" class="hover:text-white transition-colors">About</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Support</a></li>
            </ul>
          </div>
        </div>
        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
          <p>&copy; 2026 StockFlow. All rights reserved.</p>
          <div class="flex gap-4 mt-4 md:mt-0">
            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full font-semibold">v1.0.0</span>
            <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full font-semibold">Production Ready</span>
          </div>
        </div>
      </div>
    </footer>
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
