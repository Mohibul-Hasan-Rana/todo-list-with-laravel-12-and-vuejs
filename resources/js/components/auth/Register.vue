<template>
    <div class="flex justify-center items-center  bg-gray-100">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Register</h2>
        <div
            v-if="errorMessage"
            class="mb-4 px-4 py-3 rounded relative bg-red-100 border border-red-400 text-red-700 transition-all duration-500 ease-in-out"
            >
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline ml-2">{{ errorMessage }}</span>
        </div>
        <form @submit.prevent="register" class="space-y-4">
          <div>
            <label for="email" class="block text-gray-600">Email</label>
            <input
              id="email"
              v-model="email"
              type="email"
              required
              placeholder="Your email"
              class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
            />
          </div>

          <div>
            <label for="name" class="block text-gray-600">Name</label>
            <input
              id="name"
              v-model="name"
              type="text"
              required
              placeholder="Your name"
              class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
            />
          </div>
  
          <div>
            <label for="password" class="block text-gray-600">Password</label>
            <input
              id="password"
              v-model="password"
              type="password"
              required
              placeholder="Your password"
              class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
            />
          </div>
  
          <div>
            <label for="password_confirmation" class="block text-gray-600">Confirm Password</label>
            <input
              id="password_confirmation"
              v-model="passwordConfirmation"
              type="password"
              required
              placeholder="Confirm your password"
              class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
            />
          </div>
  
          <div>
            <button
              type="submit"
              class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition cursor-pointer"
            >
              Register
            </button>
          </div>
  
          <div class="text-center">
            <span class="text-gray-600">Already have an account?</span>
            <router-link to="/login" class="text-blue-600 hover:text-blue-800"> Login</router-link>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import { useAuthStore } from '../../stores/authStore';
  
  const email = ref('');
  const name = ref('');
  const password = ref('');
  const passwordConfirmation = ref('');
  const errorMessage = ref('');
  const router = useRouter();
  const authStore = useAuthStore();

  const showError = (msg) => {
    errorMessage.value = msg;
    setTimeout(() => {
        errorMessage.value = '';
    }, 3000); 
    };
  
  const register = async () => {
    if (password.value !== passwordConfirmation.value) {
        showError('Passwords do not match.');
      return;
    }
  
    try {
      await authStore.register({
        email: email.value,
        name: name.value,
        password: password.value,
        password_confirmation: passwordConfirmation.value,
      });
      router.push('/login');
    } catch (error) {
        if (error.response?.data?.errors) {
            const firstError = Object.values(error.response.data.errors)[0][0];
            showError(firstError);            
        } else if (error.response?.data?.message) {        
            showError(error.response.data.message);
        } else {
        showError('An error occurred during registration.');
        }
        console.error("Registration error:", error);
    }
  };
  </script>
  
  <style scoped>
  </style>
  