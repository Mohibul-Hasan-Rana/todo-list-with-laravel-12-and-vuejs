<template>
    <div class="space-y-4">
      <div
        v-for="task in tasks"
        :key="task.id"
        class="bg-white shadow rounded p-4 flex justify-between items-center"
      >
        <div>
          <p :class="{ 'line-through text-green-400': task.completed }" class="text-lg font-medium">
            {{ task.title }}
          </p>
          <p class="text-sm text-gray-500">{{ task.body }}</p>
        </div>
        <div class="flex gap-2">
          <button @click="$emit('toggle-completed', task)" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 cursor-pointer">
            {{ task.completed ? 'Undo' : 'Done' }}
          </button>
          <button @click="$emit('edit-task', task)" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 cursor-pointer">Edit</button>
          <button @click="$emit('delete-task', task)" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 cursor-pointer">Delete</button>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps(['tasks']);
  </script>