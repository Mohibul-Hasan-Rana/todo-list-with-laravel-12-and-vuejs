import { defineStore } from 'pinia';
import axios from 'axios';
import router from '../router';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || '',
  }),
  getters: {
    isAuthenticated: (state) => !!state.token,
  },
  actions: {
    async login(credentials) {
      const response = await axios.post('/api/login', credentials);
      this.token = response.data.token;
      localStorage.setItem('token', this.token);
      await this.fetchUser();
      router.push('/dashboard');
    },
    async register(credentials) {
      const response = await axios.post('/api/register', credentials);
      this.token = response.data.token;
      localStorage.setItem('token', this.token);
      await this.fetchUser();
      router.push('/dashboard');
    },
    async fetchUser() {
      if (!this.token) return;
      const response = await axios.get('/api/user', {
        headers: { Authorization: `Bearer ${this.token}` },
      });
      this.user = response.data;
    },
    logout() {
      this.token = '';
      this.user = null;
      localStorage.removeItem('token');
      router.push('/login');
    },
  },
});
