<template>
  <Head title="Create New Item">
    <meta name="description" content="Add a new item to inventory." />
    <meta name="keywords" content="add, create, inventory, item" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header with Breadcrumb -->
        <div class="mb-8">
          <div class="flex items-center gap-2 mb-4 text-sm">
            <Link href="/inventory" class="text-blue-600 hover:text-blue-800 font-medium">Inventory</Link>
            <span class="text-gray-400">/</span>
            <span class="text-gray-600">Add New Item</span>
          </div>
          <h1 class="text-4xl font-bold text-gray-900">Add New Item</h1>
          <p class="text-gray-600 mt-2">Create a new inventory item to manage stock</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
          <form @submit.prevent="submit" class="p-8 space-y-6">
            <!-- Name Field -->
            <div>
              <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                Item Name <span class="text-red-500">*</span>
              </label>
              <input
                v-model="form.name"
                type="text"
                id="name"
                placeholder="e.g., Office Desk"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                :class="{ 'border-red-500 focus:ring-red-500': form.errors.name }"
              />
              <p v-if="form.errors.name" class="text-red-600 text-sm mt-2 font-medium">
                {{ form.errors.name }}
              </p>
              <p class="text-gray-500 text-sm mt-1">The name of the item in your inventory</p>
            </div>

            <!-- Category Field -->
            <div>
              <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                Category <span class="text-red-500">*</span>
              </label>
              <select
                v-model="form.category"
                id="category"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                :class="{ 'border-red-500 focus:ring-red-500': form.errors.category }"
              >
                <option value="">Select a category...</option>
                <option value="Office Supplies">Office Supplies</option>
                <option value="Electronics">Electronics</option>
                <option value="Tools">Tools</option>
                <option value="Equipment">Equipment</option>
                <option value="Other">Other</option>
              </select>
              <p v-if="form.errors.category" class="text-red-600 text-sm mt-2 font-medium">
                {{ form.errors.category }}
              </p>
              <p class="text-gray-500 text-sm mt-1">Categorize this item for better organization</p>
            </div>

            <!-- Quantity Field -->
            <div>
              <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2">
                Initial Quantity <span class="text-red-500">*</span>
              </label>
              <input
                v-model="form.quantity"
                type="number"
                id="quantity"
                min="0"
                placeholder="0"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                :class="{ 'border-red-500 focus:ring-red-500': form.errors.quantity }"
              />
              <p v-if="form.errors.quantity" class="text-red-600 text-sm mt-2 font-medium">
                {{ form.errors.quantity }}
              </p>
              <p class="text-gray-500 text-sm mt-1">Starting quantity for this item</p>
            </div>

            <!-- Unit Field -->
            <div>
              <label for="unit" class="block text-sm font-semibold text-gray-700 mb-2">
                Unit <span class="text-red-500">*</span>
              </label>
              <select
                v-model="form.unit"
                id="unit"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                :class="{ 'border-red-500 focus:ring-red-500': form.errors.unit }"
              >
                <option value="">Select a unit...</option>
                <option value="pcs">Pieces (pcs)</option>
                <option value="box">Box</option>
                <option value="kg">Kilogram (kg)</option>
                <option value="liter">Liter</option>
                <option value="meter">Meter</option>
                <option value="roll">Roll</option>
              </select>
              <p v-if="form.errors.unit" class="text-red-600 text-sm mt-2 font-medium">
                {{ form.errors.unit }}
              </p>
              <p class="text-gray-500 text-sm mt-1">Measurement unit for this item</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 pt-6 border-t border-gray-200">
              <button
                type="submit"
                :disabled="form.processing"
                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed shadow-md hover:shadow-lg"
              >
                <span v-if="form.processing" class="inline-flex items-center gap-2">
                  <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                  Creating...
                </span>
                <span v-else>Create Item</span>
              </button>
              <Link
                href="/inventory"
                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition-all text-center"
              >
                Cancel
              </Link>
            </div>
          </form>
        </div>

        <!-- Info Card -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
          <h3 class="font-semibold text-blue-900 mb-2">📝 Tips:</h3>
          <ul class="text-sm text-blue-800 space-y-1">
            <li>✓ Use clear, descriptive names for items</li>
            <li>✓ Select appropriate categories for organization</li>
            <li>✓ Set the starting quantity accurately</li>
            <li>✓ Choose the correct unit for measurement</li>
          </ul>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Components/AppLayout.vue'

const form = useForm({
  name: '',
  category: '',
  quantity: 0,
  unit: 'pcs',
})

const submit = () => {
  form.post(route('inventory.store'))
}
</script>
