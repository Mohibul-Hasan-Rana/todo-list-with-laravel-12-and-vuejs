<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 fixed top-0 w-full z-50 shadow-md">
      <div class=" flex justify-between items-center">
        <div class="text-white text-2xl font-bold">Todo App</div>
        <div class="space-x-4">
          <router-link
            v-if="!isAuthenticated"
            to="/login"
            class="text-white hover:text-gray-300"
          >
            Login
          </router-link>
          <router-link
            v-if="!isAuthenticated"
            to="/register"
            class="text-white hover:text-gray-300"
          >
            Register
          </router-link>
          <button
            v-if="isAuthenticated"
            @click="logout"
            class="text-white hover:text-gray-300 cursor-pointer"
          >
            Logout
          </button>
        </div>
      </div>
    </nav>

    <!-- Main Content Area -->
    <main class="py-6 px-4">
      <router-view></router-view>
    </main>
  </div>
</template>

<script setup>
import { useAuthStore } from './stores/authStore';
import { useRouter } from 'vue-router';
import { computed } from 'vue';

const authStore = useAuthStore();
const router = useRouter();

const isAuthenticated = computed(() => authStore.isAuthenticated);

const logout = () => {
  authStore.logout();
  router.push('/login');
};
</script>

<style scoped>
</style>
