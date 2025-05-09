<template>
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h3 class="text-xl font-semibold mb-4">{{ mode === 'edit' ? 'Edit Task' : 'Add Task' }}</h3>
        <form @submit.prevent="handleSubmit">
          <input v-model="form.title" type="text" placeholder="Title" class="w-full p-2 border rounded mb-4" />
          <textarea v-model="form.body" placeholder="Description" class="w-full p-2 border rounded mb-4"></textarea>
          <div class="flex justify-end gap-2">
            <button @click="$emit('close')" type="button" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 cursor-pointer">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 cursor-pointer">
              {{ mode === 'edit' ? 'Update' : 'Add' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, watch } from 'vue';
  const props = defineProps({
    task: Object,
    mode: String
  });
  const emit = defineEmits(['close', 'add-task', 'update-task']);
  const form = ref({ title: '', body: '' });
  
  watch(() => props.task, (newTask) => {
    if (props.mode === 'edit' && newTask) {
      form.value = { ...newTask };
    }
  }, { immediate: true });
  
  const handleSubmit = () => {
    if (props.mode === 'edit') emit('update-task', form.value);
    else emit('add-task', form.value);
  };
  </script>