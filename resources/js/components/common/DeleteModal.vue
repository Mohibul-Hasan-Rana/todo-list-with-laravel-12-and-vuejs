<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
      <div class="bg-white p-6 rounded shadow-md text-center">
        <h3 class="text-lg font-semibold mb-4">Are you sure you want to delete this task?</h3>
        <div class="flex justify-center gap-4">
          <button @click="$emit('cancel')" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded cursor-pointer">Cancel</button>
          <button @click="$emit('confirm')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded cursor-pointer">Delete</button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  defineEmits(['cancel', 'confirm']);
  </script>