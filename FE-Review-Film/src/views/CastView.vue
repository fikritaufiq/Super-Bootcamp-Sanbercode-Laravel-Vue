<template>
  <div class="container mx-auto p-4 dark:bg-gray-900 dark:text-white">
    <h1 class="text-3xl font-bold mb-6">Cast Page</h1>

    <!-- Dummy data for cast members -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      <!-- Dummy cast member cards -->
      <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
        <img src="https://via.placeholder.com/150" alt="Cast Member" class="w-full h-40 object-cover">
        <div class="p-4">
          <h3 class="text-lg font-semibold">Cast Member Name</h3>
          <p class="text-sm"></p>
        </div>
      </div>

      <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
        <img src="https://via.placeholder.com/150" alt="Cast Member" class="w-full h-40 object-cover">
        <div class="p-4">
          <h3 class="text-lg font-semibold">Cast Member Name</h3>
          <p class="text-sm"></p>
        </div>
      </div>

      <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
        <img src="https://via.placeholder.com/150" alt="Cast Member" class="w-full h-40 object-cover">
        <div class="p-4">
          <h3 class="text-lg font-semibold">Cast Member Name</h3>
          <p class="text-sm"></p>
        </div>
      </div>

      <div class="cast-card bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
        <img src="https://via.placeholder.com/150" alt="Cast Member" class="w-full h-40 object-cover">
        <div class="p-4">
          <h3 class="text-lg font-semibold">Cast Member Name</h3>
          <p class="text-sm"></p>
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

.cast-card img {
  transition: transform 0.3s ease;
}

.cast-card:hover img {
  transform: scale(1.05);
}

.cast-card {
  transition: background-color 0.3s ease;
}

.cast-card:hover {
  background-color: #1f2937; /* Darker shade on hover */
}
</style>
