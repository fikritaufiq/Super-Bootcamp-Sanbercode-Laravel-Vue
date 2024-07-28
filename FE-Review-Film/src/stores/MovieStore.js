import { defineStore } from 'pinia';
import { customAPI } from '@/api';

export const useMovieStore = defineStore('movie', {
  state: () => ({
    movies: [],
    selectedMovie: null,
  }),
  actions: {
    async fetchMovies() {
      try {
        const response = await customAPI.get('/movie');
        this.movies = response.data.data;
      } catch (error) {
        console.error("Error fetching movies:", error.response?.data || error);
      }
    },
    async fetchMovieById(id) {
      try {
        const response = await customAPI.get(`/movie/${id}`);
        this.selectedMovie = response.data.data;
      } catch (error) {
        console.error("Error fetching movie:", error);
      }
    },
    selectMovie(movie) {
      this.selectedMovie = movie;
    },
    clearSelectedMovie() {
      this.selectedMovie = null;
    },
  },
});