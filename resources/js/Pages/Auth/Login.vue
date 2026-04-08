<template>
  <Head title="Login">
    <meta name="description" content="Login to your Inventory Request System account." />
    <meta name="keywords" content="login, authentication, account" />
  </Head>

  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
      <!-- Logo/Header -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">📦 Inventory System</h1>
        <p class="text-gray-600 mt-2">Login to your account</p>
      </div>

      <!-- Form -->
      <form @submit.prevent="submitForm" class="space-y-6">
        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
            Email Address *
          </label>
          <input
            v-model="form.email"
            type="email"
            id="email"
            placeholder="your@example.com"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            :class="{ 'border-red-500': form.errors.email }"
          />
          <p v-if="form.errors.email" class="text-red-600 text-sm mt-1">
            {{ form.errors.email }}
          </p>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
            Password *
          </label>
          <input
            v-model="form.password"
            type="password"
            id="password"
            placeholder="••••••••"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            :class="{ 'border-red-500': form.errors.password }"
          />
          <p v-if="form.errors.password" class="text-red-600 text-sm mt-1">
            {{ form.errors.password }}
          </p>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
          <input
            v-model="form.remember"
            type="checkbox"
            id="remember"
            class="h-4 w-4 border-gray-300 rounded focus:ring-indigo-500"
          />
          <label for="remember" class="ml-2 block text-sm text-gray-700">
            Remember me
          </label>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          :disabled="form.processing"
          class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors disabled:opacity-50"
        >
          {{ form.processing ? 'Logging in...' : 'Login' }}
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
      <div class="mt-6 p-4 bg-blue-50 rounded-lg">
        <p class="text-xs text-gray-600 font-medium mb-2">Demo Credentials:</p>
        <p class="text-xs text-gray-600">Admin: admin@example.com / password</p>
        <p class="text-xs text-gray-600">Employee: employee@example.com / password</p>
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
