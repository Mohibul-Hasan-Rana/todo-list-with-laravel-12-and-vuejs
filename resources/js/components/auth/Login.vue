<template>
    <div class="bg-gray-100 flex justify-center items-center mt-20">
      <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
        <div
            v-if="errorMessage"
            class="mb-4 px-4 py-3 rounded relative bg-red-100 border border-red-400 text-red-700 transition-all duration-500 ease-in-out"
            >
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline ml-2">{{ errorMessage }}</span>
        </div>
        <form @submit.prevent="login" class="space-y-4">
          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input
              type="email"
              id="email"
              v-model="email"
              required
              placeholder="Your email"
              class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
            />
          </div>
  
          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <input
              type="password"
              id="password"
              v-model="password"
              required
              placeholder="Your password"
              class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
            />
          </div>
  
          
  
          <!-- Submit Button -->
          <div class="flex justify-center">
            <button
              type="submit"
              class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md 
              focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 cursor-pointer"
            >
              Login
            </button>
          </div>
        </form>
  
        <div class="mt-4 text-center">
          <p class="text-sm text-gray-600">Don't have an account? 
            <router-link to="/register" class="text-indigo-600 hover:text-indigo-700">Register</router-link>
          </p>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import { useAuthStore } from '../../stores/authStore';
  
  const email = ref('');
  const password = ref('');
  const errorMessage = ref('');
  const router = useRouter();
  const authStore = useAuthStore();
  
  const showError = (msg) => {
    errorMessage.value = msg;
    setTimeout(() => {
        errorMessage.value = '';
    }, 3000); 
};

  const login = async () => {
    try {
      await authStore.login({ email: email.value, password: password.value });
      router.push('/dashboard'); 
    } catch (error) {
      showError('Invalid credentials, please try again.');
    }
  };
  </script>
  

  