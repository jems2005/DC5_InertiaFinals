<template>
  <Head title="Edit Profile">
    <meta name="description" content="Edit your profile and account settings." />
    <meta name="keywords" content="profile, settings, account, edit" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">Edit Profile</h1>
          <p class="text-gray-600 mt-2">Update your account information</p>
        </div>

        <!-- Profile Form -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
          <form @submit.prevent="updateProfile" class="space-y-6">
            <!-- Name -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                Full Name *
              </label>
              <input
                v-model="profileForm.name"
                type="text"
                id="name"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': profileForm.errors.name }"
              />
              <p v-if="profileForm.errors.name" class="text-red-600 text-sm mt-1">
                {{ profileForm.errors.name }}
              </p>
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Email Address *
              </label>
              <input
                v-model="profileForm.email"
                type="email"
                id="email"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': profileForm.errors.email }"
              />
              <p v-if="profileForm.errors.email" class="text-red-600 text-sm mt-1">
                {{ profileForm.errors.email }}
              </p>
            </div>

            <!-- Submit Button -->
            <div class="flex gap-4">
              <button
                type="submit"
                :disabled="profileForm.processing"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors disabled:opacity-50"
              >
                {{ profileForm.processing ? 'Saving...' : 'Save Changes' }}
              </button>
            </div>
          </form>
        </div>

        <!-- Password Form -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <h2 class="text-2xl font-bold text-gray-900 mb-6">Change Password</h2>
          <form @submit.prevent="updatePassword" class="space-y-6">
            <!-- Current Password -->
            <div>
              <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                Current Password *
              </label>
              <input
                v-model="passwordForm.current_password"
                type="password"
                id="current_password"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': passwordForm.errors.current_password }"
              />
              <p v-if="passwordForm.errors.current_password" class="text-red-600 text-sm mt-1">
                {{ passwordForm.errors.current_password }}
              </p>
            </div>

            <!-- New Password -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                New Password *
              </label>
              <input
                v-model="passwordForm.password"
                type="password"
                id="password"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': passwordForm.errors.password }"
              />
              <p v-if="passwordForm.errors.password" class="text-red-600 text-sm mt-1">
                {{ passwordForm.errors.password }}
              </p>
            </div>

            <!-- Confirm Password -->
            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                Confirm Password *
              </label>
              <input
                v-model="passwordForm.password_confirmation"
                type="password"
                id="password_confirmation"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': passwordForm.errors.password_confirmation }"
              />
              <p v-if="passwordForm.errors.password_confirmation" class="text-red-600 text-sm mt-1">
                {{ passwordForm.errors.password_confirmation }}
              </p>
            </div>

            <!-- Submit Button -->
            <div class="flex gap-4 pt-4">
              <button
                type="submit"
                :disabled="passwordForm.processing"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors disabled:opacity-50"
              >
                {{ passwordForm.processing ? 'Updating...' : 'Update Password' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Components/AppLayout.vue'

const props = defineProps({
  auth: Object,
  mustVerifyEmail: Boolean,
  status: String,
})

const profileForm = useForm({
  name: props.auth.user.name,
  email: props.auth.user.email,
})

const passwordForm = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

const updateProfile = () => {
  profileForm.patch(route('profile.update'))
}

const updatePassword = () => {
  passwordForm.put(route('password.update'))
}
</script>
