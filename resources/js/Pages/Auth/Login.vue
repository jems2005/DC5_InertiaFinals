<template>
  <Head title="Login - StockFlow">
    <meta name="description" content="Login to StockFlow - Professional inventory management system with real-time stock control." />
    <meta name="keywords" content="inventory, stock management, stockflow, login, authentication" />
  </Head>

  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl p-8 border-t-4 border-indigo-600">
      <!-- Logo/Header -->
      <div class="text-center mb-8">
        <div class="flex justify-center mb-4">
          <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-3 rounded-lg transform hover:scale-110 transition-transform">
            <!-- Professional warehouse icon -->
            <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2L2 7v3h20V7L12 2zm0 2.5l7 3.5H5l7-3.5zM2 10v9a2 2 0 002 2h16a2 2 0 002-2v-9H2zm3 2h3v5H5v-5zm5 0h3v5h-3v-5zm5 0h3v5h-3v-5z"/>
            </svg>
          </div>
        </div>
        <h1 class="text-4xl font-black bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">StockFlow</h1>
        <p class="text-gray-600 mt-2 font-semibold">Intelligent Inventory Management</p>
      </div>

      <!-- Form -->
      <form @submit.prevent="submitForm" class="space-y-6">
        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
            Email Address
          </label>
          <input
            v-model="form.email"
            type="email"
            id="email"
            placeholder="you@company.com"
            required
            class="w-full px-4 py-2.5 text-gray-900 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 transition-all"
            :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-200': form.errors.email }"
          />
          <p v-if="form.errors.email" class="text-red-600 text-sm mt-1 font-medium">
            {{ form.errors.email }}
          </p>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
            Password
          </label>
          <input
            v-model="form.password"
            type="password"
            id="password"
            placeholder="••••••••"
            required
            class="w-full px-4 py-2.5 text-gray-900 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 transition-all"
            :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-200': form.errors.password }"
          />
          <p v-if="form.errors.password" class="text-red-600 text-sm mt-1 font-medium">
            {{ form.errors.password }}
          </p>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
          <input
            v-model="form.remember"
            type="checkbox"
            id="remember"
            class="h-4 w-4 border-gray-300 rounded focus:ring-indigo-500 accent-indigo-600 cursor-pointer"
          />
          <label for="remember" class="ml-2 block text-sm text-gray-700 cursor-pointer">
            Remember me
          </label>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          :disabled="form.processing"
          class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold py-2.5 px-4 rounded-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed shadow-md hover:shadow-lg"
        >
          <span v-if="!form.processing">Sign In</span>
          <span v-else class="flex items-center justify-center">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Signing in...
          </span>
        </button>
      </form>

      <!-- Divider -->
      <div class="mt-6 border-t border-gray-200 pt-6">
        <p class="text-center text-gray-600 text-sm">
          Don't have an account?
          <Link href="/register" class="text-indigo-600 hover:text-indigo-800 font-medium">
            Register here
          </Link>
        </p>
      </div>

      <!-- Demo Credentials -->
      <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border border-indigo-200">
        <p class="text-xs text-gray-700 font-bold mb-2 flex items-center gap-1">
          <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z" clip-rule="evenodd"></path></svg>
          Demo Credentials
        </p>
        <ul class="text-xs text-gray-700 space-y-1">
          <li><strong>Admin:</strong> admin@example.com / password</li>
          <li><strong>Employee:</strong> employee@example.com / password</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submitForm = () => {
  form.post(route('login'))
}
</script>
