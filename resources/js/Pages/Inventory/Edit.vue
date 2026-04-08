<template>
  <Head title="Edit Inventory Item">
    <meta name="description" content="Edit an existing inventory item." />
    <meta name="keywords" content="edit, inventory, item, update" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">Edit Inventory Item</h1>
          <p class="text-gray-600 mt-2">Update item details</p>
        </div>

        <!-- Form -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <form @submit.prevent="submitForm">
            <!-- Name -->
            <div class="mb-6">
              <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                Item Name *
              </label>
              <input
                v-model="form.name"
                type="text"
                id="name"
                placeholder="e.g., Printer Paper"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': form.errors.name }"
              />
              <p v-if="form.errors.name" class="text-red-600 text-sm mt-1">
                {{ form.errors.name }}
              </p>
            </div>

            <!-- Category -->
            <div class="mb-6">
              <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                Category *
              </label>
              <input
                v-model="form.category"
                type="text"
                id="category"
                placeholder="e.g., Office Supplies"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': form.errors.category }"
              />
              <p v-if="form.errors.category" class="text-red-600 text-sm mt-1">
                {{ form.errors.category }}
              </p>
            </div>

            <!-- Quantity -->
            <div class="mb-6">
              <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                Quantity *
              </label>
              <input
                v-model="form.quantity"
                type="number"
                id="quantity"
                placeholder="0"
                min="1"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': form.errors.quantity }"
              />
              <p v-if="form.errors.quantity" class="text-red-600 text-sm mt-1">
                {{ form.errors.quantity }}
              </p>
            </div>

            <!-- Unit -->
            <div class="mb-6">
              <label for="unit" class="block text-sm font-medium text-gray-700 mb-2">
                Unit *
              </label>
              <select
                v-model="form.unit"
                id="unit"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="{ 'border-red-500': form.errors.unit }"
              >
                <option value="">Select a unit</option>
                <option value="pcs">Pieces (pcs)</option>
                <option value="box">Box</option>
                <option value="kg">Kilogram (kg)</option>
                <option value="liters">Liters</option>
                <option value="meters">Meters</option>
                <option value="roll">Roll</option>
              </select>
              <p v-if="form.errors.unit" class="text-red-600 text-sm mt-1">
                {{ form.errors.unit }}
              </p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4">
              <button
                type="submit"
                :disabled="form.processing"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors disabled:opacity-50"
              >
                {{ form.processing ? 'Updating...' : 'Update Item' }}
              </button>
              <Link
                href="/inventory"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition-colors"
              >
                Cancel
              </Link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Components/AppLayout.vue'

defineProps({
  item: Object,
})

const form = useForm({
  name: item.name,
  category: item.category,
  quantity: item.quantity,
  unit: item.unit,
})

const submitForm = () => {
  form.put(route('inventory.update', item.id))
}
</script>
