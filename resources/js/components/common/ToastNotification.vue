<template>
    <div class="fixed top-20 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg">
      {{ message }}
    </div>
  </template>
  
  <script setup>
  defineProps(['message']);
  </script>