<template>
  <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white shadow-lg border-b-4 border-indigo-600 transition-all" style="box-shadow: inset 0 -4px 0 0 rgb(79, 70, 229), 0 4px 12px rgba(0,0,0,0.1);">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <Link href="/" class="shrink-0 flex items-center gap-3 hover:opacity-80 transition-opacity group">
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-2 rounded-lg group-hover:shadow-lg group-hover:scale-110 transition-all">
              <!-- Professional warehouse/inventory icon -->
              <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7v3h20V7L12 2zm0 2.5l7 3.5H5l7-3.5zM2 10v9a2 2 0 002 2h16a2 2 0 002-2v-9H2zm3 2h3v5H5v-5zm5 0h3v5h-3v-5zm5 0h3v5h-3v-5z"/>
              </svg>
            </div>
            <span class="text-xl font-black bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">StockFlow</span>
          </Link>

          <!-- Desktop Navigation - Only show if authenticated -->
          <div v-if="$page.props.auth?.user" class="hidden md:flex items-center space-x-2">
            <NavLink
              :href="route('dashboard')"
              :active="$page.url.startsWith('/dashboard')"
              label="Dashboard"
            />
            <NavLink
              :href="route('inventory.index')"
              :active="$page.url.startsWith('/inventory')"
              label="Inventory"
            />
            <NavLink
              :href="route('requests.index')"
              :active="$page.url.startsWith('/requests')"
              label="Requests"
            />
            <NavLink
              v-if="$page.props.auth?.user?.role === 'admin'"
              :href="route('inventory.create')"
              label="Add Item"
              class="!bg-gradient-to-r !from-blue-600 !to-indigo-600 !text-white !shadow-lg"
            />
          </div>

          <!-- Right Side - User Menu -->
          <div class="flex items-center space-x-4">
            <template v-if="$page.props.auth?.user">
              <!-- Desktop User Menu -->
              <div class="hidden md:flex items-center gap-4">
                <Link
                  :href="route('profile.edit')"
                  class="inline-flex items-center gap-2 text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-indigo-50"
                >
                  <Icon name="chart" size="sm" />
                  {{ $page.props.auth?.user?.name }}
                </Link>
                <button
                  @click="logout"
                  class="inline-flex items-center gap-2 text-gray-700 hover:text-red-600 hover:bg-red-50 px-4 py-2 rounded-lg text-sm font-semibold transition-all"
                >
                  <Icon name="arrow-right" size="sm" />
                  Logout
                </button>
              </div>

              <!-- Mobile Menu Button -->
              <button
                @click="showMobileMenu = !showMobileMenu"
                class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gradient-to-r hover:from-blue-100 hover:to-indigo-100 focus:outline-none transition-all"
              >
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path v-if="!showMobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                  <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </template>
          </div>
        </div>

        <!-- Mobile Menu - Only show if authenticated -->
        <div v-if="showMobileMenu && $page.props.auth?.user" class="md:hidden pb-4 space-y-2">
          <MobileNavLink
            :href="route('dashboard')"
            :active="$page.url.startsWith('/dashboard')"
            label="Dashboard"
          />
          <MobileNavLink
            :href="route('inventory.index')"
            :active="$page.url.startsWith('/inventory')"
            label="Inventory"
          />
          <MobileNavLink
            :href="route('requests.index')"
            :active="$page.url.startsWith('/requests')"
            label="Requests"
          />
          <MobileNavLink
            v-if="$page.props.auth?.user?.role === 'admin'"
            :href="route('inventory.create')"
            label="Add Item"
          />
          <MobileNavLink
            :href="route('profile.edit')"
            :active="$page.url.startsWith('/profile')"
            label="Profile"
          />
          <button
            @click="logout"
            class="w-full text-left px-4 py-2 rounded-md text-gray-700 hover:bg-red-50 hover:text-red-600 text-sm font-medium transition-colors"
          >
            Logout
          </button>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-gray-300 mt-12 py-12 border-t-4 border-indigo-600" style="box-shadow: inset 0 4px 0 0 rgb(79, 70, 229);">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-8">
          <div class="group hover:transform hover:scale-105 transition-all duration-300">
            <h3 class="text-white font-black text-lg mb-3 flex items-center gap-2">
              <svg class="h-6 w-6 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7v3h20V7L12 2zm0 2.5l7 3.5H5l7-3.5zM2 10v9a2 2 0 002 2h16a2 2 0 002-2v-9H2zm3 2h3v5H5v-5zm5 0h3v5h-3v-5zm5 0h3v5h-3v-5z"/>
              </svg>
              StockFlow
            </h3>
            <p class="text-sm text-gray-400 leading-relaxed">Streamline your inventory operations with intelligent stock management. Built with Laravel, Vue 3, and Tailwind CSS.</p>
          </div>
          <div class="group hover:transform hover:scale-105 transition-all duration-300">
            <h3 class="text-white font-black text-lg mb-3 flex items-center gap-2">
              <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
              </svg>
              Quick Links
            </h3>
            <ul class="text-sm space-y-2">
              <li><Link href="/" class="text-gray-400 hover:text-white transition-colors hover:pl-2 inline-block">→ Home</Link></li>
              <li><Link href="/login" class="text-gray-400 hover:text-white transition-colors hover:pl-2 inline-block">→ Login</Link></li>
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors hover:pl-2 inline-block">→ Documentation</a></li>
            </ul>
          </div>
          <div class="group hover:transform hover:scale-105 transition-all duration-300">
            <h3 class="text-white font-black text-lg mb-3 flex items-center gap-2">
              <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
              Key Features
            </h3>
            <ul class="text-sm space-y-1 text-gray-400">
              <li class="flex items-center gap-2"><span class="text-green-400">✓</span> Complete CRUD Operations</li>
              <li class="flex items-center gap-2"><span class="text-green-400">✓</span> Request Management</li>
              <li class="flex items-center gap-2"><span class="text-green-400">✓</span> Real-time Analytics</li>
            </ul>
          </div>
        </div>
        <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
          <p class="text-gray-400">&copy; 2026 Inventory Request System. All rights reserved.</p>
          <div class="flex gap-4 mt-4 md:mt-0">
            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-xs font-semibold">v1.0.0</span>
            <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-semibold">Production Ready</span>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'
import NavLink from './NavLink.vue'
import MobileNavLink from './MobileNavLink.vue'
import Icon from './Icon.vue'

const showMobileMenu = ref(false)

const logout = () => {
  router.post(route('logout'))
}
</script>

<style scoped>
nav {
  -webkit-backdrop-filter: blur(10px);
  backdrop-filter: blur(10px);
}
</style>
