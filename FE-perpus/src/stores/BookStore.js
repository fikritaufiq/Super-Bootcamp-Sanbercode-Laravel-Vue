import { defineStore } from 'pinia';
import { tokenAPI } from '@/api';

export const useBookStore = defineStore('book', {
  state: () => ({
    books: [],
    categories: [],
    message: '',
    successMessage: '',
    errorMessage: ''
  }),
  actions: {
    async fetchBooks() {
      try {
        const response = await tokenAPI.get('/book');
        this.books = response.data.data;
      } catch (error) {
        this.errorMessage = 'Gagal mengambil buku: ' + (error.response?.data?.message || error.message);
      }
    },
    async fetchCategories() {
      try {
        const response = await tokenAPI.get('/category');
        this.categories = response.data.data;
      } catch (error) {
        this.errorMessage = 'Gagal mengambil kategori: ' + (error.response?.data?.message || error.message);
      }
    },
    async addBook(book) {
      try {
        const response = await tokenAPI.post('/book', book);
        this.successMessage = response.data.message;
        await this.fetchBooks();
      } catch (error) {
        this.errorMessage = 'Gagal menambah buku: ' + (error.response?.data?.message || error.message);
        throw new Error(this.errorMessage);
      }
    },
    async updateBook(id, book) {
      try {
        const response = await tokenAPI.put(`/book/${id}`, book);
        this.successMessage = response.data.message;
        await this.fetchBooks();
      } catch (error) {
        this.errorMessage = 'Gagal memperbarui buku: ' + (error.response?.data?.message || error.message);
        throw new Error(this.errorMessage);
      }
    },
    async deleteBook(id) {
      try {
        const response = await tokenAPI.delete(`/book/${id}`);
        this.successMessage = response.data.message;
        await this.fetchBooks();
      } catch (error) {
        this.errorMessage = 'Gagal menghapus buku: ' + (error.response?.data?.message || error.message);
        throw new Error(this.errorMessage);
      }
    }
  }
});