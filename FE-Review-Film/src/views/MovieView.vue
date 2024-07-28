<template>
  <div class="container mx-auto p-4 dark:bg-gray-900 dark:text-white">
    <h1 class="text-3xl font-bold mb-4">Daftar Movie</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
        <img src="https://via.placeholder.com/300x200" alt="Movie Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-xl font-semibold mb-2">Judul Movie</h2>
          <p class="text-gray-600 dark:text-gray-400">berisi tentang sinopsis dari Movie tersebut</p>
        </div>
      </div>
      <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
        <img src="https://via.placeholder.com/300x200" alt="Movie Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-xl font-semibold mb-2">Judul Movie</h2>
          <p class="text-gray-600 dark:text-gray-400">berisi tentang sinopsis dari Movie tersebut</p>
        </div>
      </div>
      <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
        <img src="https://via.placeholder.com/300x200" alt="Movie Image" class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-xl font-semibold mb-2">Judul Movie</h2>
          <p class="text-gray-600 dark:text-gray-400">A berisi tentang sinopsis dari Movie tersebut</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>

<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
}

.Movie-card img {
  transition: transform 0.3s ease;
}

.Movie-card:hover img {
  transform: scale(1.05);
}
</style>
