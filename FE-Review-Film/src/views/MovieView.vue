<template>
  <div>
    <h1>Daftar Film</h1>
    <ul>
      <li v-for="movie in movies" :key="movie.id" @click="selectMovie(movie)">
        {{ movie.title }}
      </li>
    </ul>

    <div v-if="selectedMovie">
      <h2>Detail Film</h2>
      <h3>{{ selectedMovie.title }}</h3>
      <p>{{ selectedMovie.summary }}</p>
      <p>Tahun: {{ selectedMovie.year }}</p>
      <p>Rating: {{ selectedMovie.rating }}</p>
      <img v-if="selectedMovie.poster" :src="selectedMovie.poster" :alt="selectedMovie.title" />
    </div>
  </div>
</template>

<script>
import { useMovieStore } from '@/stores/MovieStore';

export default {
  setup() {
    const movieStore = useMovieStore();
    const { movies, selectedMovie, fetchMovies, selectMovie } = movieStore;

    fetchMovies(); // Mengambil daftar film saat komponen dimuat

    return {
      movies,
      selectedMovie,
      selectMovie,
    };
  },
};
</script>

<style scoped>
ul {
  list-style-type: none;
  padding: 0;
}

li {
  cursor: pointer;
  margin: 5px 0;
}

li:hover {
  text-decoration: underline;
}
</style>