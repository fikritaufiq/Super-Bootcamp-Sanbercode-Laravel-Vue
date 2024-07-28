import { defineStore } from 'pinia';
import { customAPI } from '@/api';

export const useGenreStore = defineStore('genre', {
  state: () => ({
    genres: [],
  }),
  actions: {
    // Fetch all genres
    async fetchGenres() {
      try {
        const response = await customAPI.get('/genre'); // Hanya '/genre', sesuai dengan rute API
        this.genres = response.data.data; // Simpan data genre ke state

        // Contoh data dummy jika tidak ada data dari API
        if (this.genres.length === 0) {
          this.genres = [
            { id: '1', name: 'Action' },
            { id: '2', name: 'Comedy' },
            { id: '3', name: 'Drama' },
            { id: '4', name: 'Horror' },
            { id: '5', name: 'Sci-Fi' },
          ];
        }
      } catch (error) {
        console.error('Error fetching genres:', error);
        if (error.response) {
          console.error('Response data:', error.response.data);
          console.error('Response status:', error.response.status);
        }
      }
    },

    // Create a new genre
    async createGenre(genreData) {
      try {
        const response = await customAPI.post('/genre', genreData); // Hanya '/genre'
        this.genres.push(response.data.data); // Tambahkan genre baru ke daftar
      } catch (error) {
        console.error('Error creating genre:', error);
      }
    },

    // Get a single genre by ID
    async getGenreById(id) {
      try {
        const response = await customAPI.get(`/genre/${id}`); // Hanya '/genre/{id}'
        return response.data.data; // Kembalikan data genre
      } catch (error) {
        console.error('Error fetching genre:', error);
      }
    },

    // Update an existing genre
    async updateGenre(id, genreData) {
      try {
        const response = await customAPI.put(`/genre/${id}`, genreData); // Hanya '/genre/{id}'
        const index = this.genres.findIndex(genre => genre.id === id);
        if (index !== -1) {
          this.genres[index] = response.data.data; // Update genre di state
        }
      } catch (error) {
        console.error('Error updating genre:', error);
      }
    },

    // Delete a genre
    async deleteGenre(id) {
      try {
        await customAPI.delete(`/genre/${id}`); // Hanya '/genre/{id}'
        this.genres = this.genres.filter(genre => genre.id !== id); // Hapus genre dari state
      } catch (error) {
        console.error('Error deleting genre:', error);
      }
    },
  },
});