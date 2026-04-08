<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <Link href="/" class="flex-shrink-0 flex items-center">
              <span class="text-xl font-bold text-gray-900">📦 Inventory System</span>
            </Link>
          </div>

          <div class="flex items-center space-x-4">
            <Link
              v-if="$page.props.auth.user"
              :href="route('dashboard')"
              class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors"
            >
              Dashboard
            </Link>

            <Link
              v-if="$page.props.auth.user"
              :href="route('inventory.index')"
              class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors"
            >
              Inventory
            </Link>

            <Link
              v-if="$page.props.auth.user"
              :href="route('requests.index')"
              class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors"
            >
              My Requests
            </Link>

            <Link
              v-if="$page.props.auth?.user?.role === 'admin'"
              :href="route('inventory.create')"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
            >
              Add Item
            </Link>

            <Link
              v-if="$page.props.auth.user"
              :href="route('profile.edit')"
              class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors"
            >
              {{ $page.props.auth.user.name }}
            </Link>

            <Link
              v-if="$page.props.auth.user"
              href="/logout"
              method="post"
              class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors"
            >
              Logout
            </Link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
