<template>
  <Head :title="`Edit: ${item?.name || 'Item'}`">
    <meta name="description" content="Edit an inventory item." />
    <meta name="keywords" content="edit, update, inventory, item" />
  </Head>

  <AppLayout>
    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header with Breadcrumb -->
        <div class="mb-8">
          <div class="flex items-center gap-2 mb-4 text-sm">
            <Link href="/inventory" class="text-blue-600 hover:text-blue-800 font-medium">Inventory</Link>
            <span class="text-gray-400">/</span>
            <Link :href="`/inventory/${item?.id}`" class="text-blue-600 hover:text-blue-800 font-medium">{{ item?.name || 'Item' }}</Link>
            <span class="text-gray-400">/</span>
            <span class="text-gray-600">Edit</span>
          </div>
          <h1 class="text-4xl font-bold text-gray-900">Edit Item: {{ item?.name || 'Loading...' }}</h1>
          <p class="text-gray-600 mt-2">Update inventory item details</p>
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
                placeholder="Enter item name"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                :class="{ 'border-red-500 focus:ring-red-500': form.errors.name }"
              />
              <p v-if="form.errors.name" class="text-red-600 text-sm mt-2 font-medium">
                {{ form.errors.name }}
              </p>
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
                <option value="Office Supplies">Office Supplies</option>
                <option value="Electronics">Electronics</option>
                <option value="Tools">Tools</option>
                <option value="Equipment">Equipment</option>
                <option value="Other">Other</option>
              </select>
              <p v-if="form.errors.category" class="text-red-600 text-sm mt-2 font-medium">
                {{ form.errors.category }}
              </p>
            </div>

            <!-- Quantity Field -->
            <div>
              <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2">
                Quantity <span class="text-red-500">*</span>
              </label>
              <input
                v-model.number="form.quantity"
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
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 pt-6 border-t border-gray-200">
              <button
                type="submit"
                :disabled="form.processing"
                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed shadow-md hover:shadow-lg"
              >
                <span v-if="form.processing">Saving...</span>
                <span v-else>Save Changes</span>
              </button>
              <Link
                :href="`/inventory/${item?.id}`"
                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition-all text-center"
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
import { computed, watch } from 'vue'

const props = defineProps({
  item: Object,
})

const form = useForm({
  name: props.item?.name || '',
  category: props.item?.category || '',
  quantity: props.item?.quantity || 0,
  unit: props.item?.unit || '',
})

watch(() => props.item, (newItem) => {
  if (newItem) {
    form.name = newItem.name
    form.category = newItem.category
    form.quantity = newItem.quantity
    form.unit = newItem.unit
  }
}, { deep: true })

const submit = () => {
  form.patch(route('inventory.update', props.item.id))
}
</script>

