import { defineStore } from 'pinia';
import axios from 'axios';
import { useAuthStore } from './authStore';

export const useTaskStore = defineStore('task', {
  state: () => ({
    tasks: [],
    currentPage: 1,
    lastPage: 1,
    perPage: 10,
    total: 0,
  }),
  actions: {
    async fetchTasks(page = 1) {
      const authStore = useAuthStore();
      console.log('Fetching tasks for page:', page);
      const response = await axios.get(`/api/tasks?page=${page}`, {
        headers: { Authorization: `Bearer ${authStore.token}` },
      });
      this.tasks = response.data.data;
      this.currentPage = response.data.current_page;
      this.lastPage = response.data.last_page;
      this.perPage = response.data.per_page;
      this.total = response.data.total;
    },
    async addTask(task) {
      const authStore = useAuthStore();
      const response = await axios.post('/api/tasks', task, {
        headers: { Authorization: `Bearer ${authStore.token}` },
      });
      this.tasks.push(response.data);
    },
    async updateTask(updatedTask) {
      const authStore = useAuthStore();
      await axios.put(`/api/tasks/${updatedTask.id}`, updatedTask, {
        headers: { Authorization: `Bearer ${authStore.token}` },
      });
      this.fetchTasks(this.currentPage);
    },
    async deleteTask(taskId) {
      const authStore = useAuthStore();
      await axios.delete(`/api/tasks/${taskId}`, {
        headers: { Authorization: `Bearer ${authStore.token}` },
      });
      this.tasks = this.tasks.filter((task) => task.id !== taskId);
    },
    async toggleCompleted(task) {
      const authStore = useAuthStore();
      await axios.patch(`/api/tasks/${task.id}/toggle`, {}, {
        headers: { Authorization: `Bearer ${authStore.token}` },
      });
      this.fetchTasks(this.currentPage);
    },
  },
});
