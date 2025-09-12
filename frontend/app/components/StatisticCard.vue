<script setup lang="ts">

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  value: {
    type: Number,
    required: true
  }
})

</script>

<template>
  <div
    class="block max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-white m-2"
  >
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
      {{ title }}
    </h5>
    <div v-if="value" class="font-normal text-gray-700 dark:text-gray-400 items-center">
      {{ value }}
    </div>
  </div>
</template>
