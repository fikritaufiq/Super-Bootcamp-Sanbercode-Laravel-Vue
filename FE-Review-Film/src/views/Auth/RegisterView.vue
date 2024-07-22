<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold">Register</h1>
    <form>
      <div class="mb-4">
        <label for="email" class="block">Email</label>
        <input type="email" id="email" placeholder="Enter your email" class="w-full p-2 border border-gray-300 rounded" />
      </div>
      <div class="mb-4">
        <label for="password" class="block">Password</label>
        <input type="password" id="password" placeholder="Enter your password" class="w-full p-2 border border-gray-300 rounded" />
      </div>
      <button type="submit" class="bg-blue-500 text-white p-2 rounded">Register</button>
    </form>
  </div>
</template>

<script setup>
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: 0 auto;
}
</style>
