<template>
  <div class="container mx-auto p-4 dark:bg-gray-900 dark:text-white">
    <h1 class="text-3xl font-bold mb-6">Daftar Genre</h1>
    
    <!-- Dummy data for genres -->
    <div class="genre-section mb-12">
      <h2 class="text-2xl font-semibold mb-4">Action</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Dummy film cards -->
        <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
          <img src="https://via.placeholder.com/150" alt="Film Poster" class="w-full h-40 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Film Title</h3>
            <p class="text-sm text-gray-600">Description of the film.</p>
          </div>
        </div>
        <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
          <img src="https://via.placeholder.com/150" alt="Film Poster" class="w-full h-40 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Film Title</h3>
            <p class="text-sm text-gray-600">Description of the film.</p>
          </div>
        </div>
        <!-- Add more film cards as needed -->
      </div>
    </div>
    
    <!-- Repeat genre sections as needed -->
    <div class="genre-section mb-12">
      <h2 class="text-2xl font-semibold mb-4">Drama</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
          <img src="https://via.placeholder.com/150" alt="Film Poster" class="w-full h-40 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Film Title</h3>
            <p class="text-sm text-gray-600">Description of the film.</p>
          </div>
        </div>
        <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
          <img src="https://via.placeholder.com/150" alt="Film Poster" class="w-full h-40 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">Film Title</h3>
            <p class="text-sm text-gray-600">Description of the film.</p>
          </div>
        </div>
        <!-- Add more film cards as needed -->
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

.genre-section {
  margin-bottom: 2rem;
}

.film-card img {
  transition: transform 0.3s ease;
}

.film-card:hover img {
  transform: scale(1.05);
}
</style>
