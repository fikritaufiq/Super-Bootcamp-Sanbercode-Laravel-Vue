import { defineStore } from 'pinia';
import { tokenAPI } from '@/api';

export const useBorrowStore = defineStore('borrow', {
  state: () => ({
    borrows: [],
    books: [],
  }),
  actions: {
    async createOrUpdateBorrow(loadDate, borrowDate, bookId) {
      try {
        const response = await tokenAPI.post('/borrow', {
          load_date: loadDate,
          barrow_date: borrowDate,
          book_id: bookId,
        });
        return response.data;
      } catch (error) {
        throw error.response.data;
      }
    },
    async fetchBorrows() {
      try {
        const response = await tokenAPI.get('/borrow');
        this.borrows = response.data.data;
      } catch (error) {
        throw error.response.data;
      }
    },
    async fetchBooks() {
      try {
        const response = await tokenAPI.get('/books');
        this.books = response.data.data;
        return this.books;
      } catch (error) {
        throw error.response.data;
      }
    },
  },
});