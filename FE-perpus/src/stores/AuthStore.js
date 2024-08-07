import { defineStore } from 'pinia';
import { customAPI, tokenAPI } from '@/api';
import { useRouter } from 'vue-router';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: null,
    isError: false,
    errorMsg: '',
    isAuthenticated: false,
    isOwner: false,
  }),
  actions: {
    initializeAuth() {
      const token = localStorage.getItem('token');
      if (token) {
        this.token = token;
        this.isAuthenticated = true;
        this.getUserProfile();
      }
    },
    async registerUser(userData) {
      try {
        const response = await customAPI.post('/auth/register', userData);
        this.user = response.data.user;
        this.token = response.data.token;
        this.isAuthenticated = true;
        this.isError = false;
        localStorage.setItem('token', this.token);
        await this.getUserProfile();
      } catch (error) {
        this.isError = true;
        this.errorMsg = error.response?.data?.message || 'Registration failed';
      }
    },
    async loginUser(credentials) {
      try {
        const response = await customAPI.post('/auth/login', credentials);
        this.user = response.data.user;
        this.token = response.data.token;
        this.isAuthenticated = true;
        this.isError = false;
        localStorage.setItem('token', this.token);
        await this.getUserProfile();
      } catch (error) {
        this.isError = true;
        this.errorMsg = error.response?.data?.message || 'Login failed';
      }
    },
    async getUserProfile() {
      if (!this.token) return;
      try {
        const response = await tokenAPI.get('/me');
        this.user = response.data.user;
        this.isOwner = this.user.role_id === '9cb0ae73-08af-43a1-99e0-1e34455be151';
      } catch (error) {
        console.error('Failed to fetch user profile:', error);
        this.isError = true;
        this.errorMsg = error.response?.data?.message || 'Failed to fetch user profile';
        this.logout();
      }
    },
    logout() {
      this.user = null;
      this.token = null;
      this.isAuthenticated = false;
      this.isOwner = false;
      this.isError = false;
      this.errorMsg = '';
      localStorage.removeItem('token');
    },
  },
});