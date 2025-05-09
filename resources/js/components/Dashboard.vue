<template>
    <div class="p-6 max-w-3xl mx-auto">
      <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Dashboard</h2>
  
      <div class="flex justify-between mb-6">
        <button @click="showAddModal = true" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow cursor-pointer">
          Add Task
        </button>
        <button @click="logout" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded shadow cursor-pointer">
          Logout
        </button>
        
      </div>
  
      <div v-if="tasks.length > 0">
        <TaskList
          :tasks="tasks"
          @edit-task="openEditModal"
          @delete-task="openDeleteModal"
          @toggle-completed="toggleCompleted"
        />
      </div>
      <div v-else class="text-gray-500 text-center">No task found.</div>
  
      <TaskModal
        v-if="editModal"
        :task="editTask"
        mode="edit"
        @close="closeModal"
        @update-task="updateTask"
      />
  
      <TaskModal
        v-if="showAddModal"
        mode="add"
        @close="closeModal"
        @add-task="addTask"
      />
  
      <DeleteModal
        v-if="deleteModal"
        @confirm="confirmDelete"
        @cancel="closeModal"
      />
  
      <ToastNotification v-if="toastMessage" :message="toastMessage" />
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, computed } from 'vue';
  import { useRouter } from 'vue-router';
  import { useTaskStore } from '../stores/taskStore';
  import { useAuthStore } from '../stores/authStore';
  import TaskList from './task/TaskList.vue';
  import TaskModal from './task/TaskModal.vue';
  import DeleteModal from './common/DeleteModal.vue';
  import ToastNotification from './common/ToastNotification.vue';
  
  const router = useRouter();
  const taskStore = useTaskStore();
  const authStore = useAuthStore();
  
  const editModal = ref(false);
  const showAddModal = ref(false);
  const deleteModal = ref(false);
  const editTask = ref({});
  const deleteTaskId = ref(null);
  const toastMessage = ref('');
  
  const showToast = (message) => {
    toastMessage.value = message;
    setTimeout(() => {
      toastMessage.value = '';
    }, 3000);
  };
  
  const addTask = async (taskData) => {
    await taskStore.addTask(taskData);
    showAddModal.value = false;
    showToast('Task added successfully!');
  };
  
  const toggleCompleted = async (task) => {
    await taskStore.toggleCompleted(task);
    showToast('Task completion status updated!');
  };
  
  const openEditModal = (task) => {
    editTask.value = { ...task };
    editModal.value = true;
  };
  
  const openDeleteModal = (task) => {
    deleteTaskId.value = task.id;
    deleteModal.value = true;
  };
  
  const closeModal = () => {
    editModal.value = false;
    showAddModal.value = false;
    deleteModal.value = false;
  };
  
  const updateTask = async (updatedTask) => {
    await taskStore.updateTask(updatedTask);
    closeModal();
    showToast('Task updated successfully!');
  };
  
  const confirmDelete = async () => {
    await taskStore.deleteTask(deleteTaskId.value);
    closeModal();
    showToast('Task deleted successfully!');
  };
  
  const logout = () => {
    authStore.logout();
  };
  
  onMounted(() => {
    taskStore.fetchTasks();
  });
  
  const tasks = computed(() => taskStore.tasks);
  </script>
  
  <style scoped>
  </style>
  