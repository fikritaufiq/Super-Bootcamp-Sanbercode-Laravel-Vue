import { defineStore } from 'pinia';
import { tokenAPI } from '@/api';
import { useAuthStore } from '@/stores/AuthStore';

export const useCategoryStore = defineStore('category', {
  state: () => ({
    categories: [],
    message: '',
    successMessage: '',
    errorMessage: ''
  }),
  actions: {
    async fetchCategories() {
      try {
        const response = await tokenAPI.get('/category');
        this.categories = response.data.data;
        console.log('Berhasil menampilkan semua kategori'); 
      } catch (error) {
        this.errorMessage = 'Gagal mengambil kategori: ' + (error.response?.data?.message || error.message);
      }
    },
    async addCategory(name) {
      const authStore = useAuthStore(); 
      if (!authStore.isAuthenticated || !authStore.isOwner) {
        throw new Error('Unauthorized: Only owners can add categories.');
      }

      if (!name) {
        throw new Error('Nama kategori tidak boleh kosong.'); 
      }

      try {
        const response = await tokenAPI.post('/category', { name }); 
        this.successMessage = response.data.message; 
        await this.fetchCategories();
      } catch (error) {
        this.errorMessage = 'Gagal menambah kategori: ' + (error.response?.data?.message || error.message); 
        throw new Error(this.errorMessage);
      }
    },
    async deleteCategory(id) {
      const authStore = useAuthStore(); 
      if (!authStore.isAuthenticated || !authStore.isOwner) {
        throw new Error('Unauthorized: Only owners can delete categories.');
      }

      try {
        const response = await tokenAPI.delete(`/category/${id}`); 
        this.successMessage = response.data.message; 
        await this.fetchCategories(); 
      } catch (error) {
        this.errorMessage = 'Gagal menghapus kategori: ' + (error.response?.data?.message || error.message); 
        throw new Error(this.errorMessage);
      }
    },
    async fetchCategoryDetails(id) {
      try {
        const response = await tokenAPI.get(`/category/${id}`); 
        return response.data.data; 
      } catch (error) {
        throw new Error('Gagal mengambil detail kategori: ' + (error.response?.data?.message || error.message)); 
      }
    },
    async updateCategory(id, name) {
      const authStore = useAuthStore(); 
      if (!authStore.isAuthenticated || !authStore.isOwner) {
        throw new Error('Unauthorized: Only owners can update categories.');
      }

      if (!name) {
        throw new Error('Nama kategori tidak boleh kosong.'); 
      }

      try {
        const response = await tokenAPI.put(`/category/${id}`, { name }); 
        this.successMessage = response.data.message; 
        await this.fetchCategories(); 
      } catch (error) {
        this.errorMessage = 'Gagal memperbarui kategori: ' + (error.response?.data?.message || error.message); 
        throw new Error(this.errorMessage);
      }
    }
  }
});