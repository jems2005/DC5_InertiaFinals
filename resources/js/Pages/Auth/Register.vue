<template>
  <Head title="Register">
    <meta name="description" content="Create a new account for the Inventory Request System." />
    <meta name="keywords" content="register, signup, account creation" />
  </Head>

  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
      <!-- Logo/Header -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">📦 Inventory System</h1>
        <p class="text-gray-600 mt-2">Create your account</p>
      </div>

      <!-- Form -->
      <form @submit.prevent="submitForm" class="space-y-6">
        <!-- Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
            Full Name *
          </label>
          <input
            v-model="form.name"
            type="text"
            id="name"
            placeholder="John Doe"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            :class="{ 'border-red-500': form.errors.name }"
          />
          <p v-if="form.errors.name" class="text-red-600 text-sm mt-1">
            {{ form.errors.name }}
          </p>
        </div>

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

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
            Confirm Password *
          </label>
          <input
            v-model="form.password_confirmation"
            type="password"
            id="password_confirmation"
            placeholder="••••••••"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            :class="{ 'border-red-500': form.errors.password_confirmation }"
          />
          <p v-if="form.errors.password_confirmation" class="text-red-600 text-sm mt-1">
            {{ form.errors.password_confirmation }}
          </p>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          :disabled="form.processing"
          class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors disabled:opacity-50"
        >
          {{ form.processing ? 'Creating account...' : 'Register' }}
        </button>
      </form>

      <!-- Divider -->
      <div class="mt-6 border-t border-gray-200 pt-6">
        <p class="text-center text-gray-600 text-sm">
          Already have an account?
          <Link href="/login" class="text-indigo-600 hover:text-indigo-800 font-medium">
            Login here
          </Link>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const submitForm = () => {
  form.post(route('register'))
}
</script>
