<template>
  <section ref="homeSection" class="section bg-gray-100 py-16 px-4">
  <div class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
    <div class="flex flex-col items-center md:items-start">
      <h1 class="text-4xl font-bold mb-1">Halo, Nama Saya</h1>
      <h1 class="text-4xl font-bold mb-6">Fikri Taufiq Rahman</h1>
      <p class="text-lg mb-4 text-justify">
        Saya memulai belajar IT di Binar Academy dengan bahasa pemrograman JavaScript.
      </p>
      <p class="text-lg mb-4 text-justify">
        Saya juga sempat belajar Python di Hashmicro Academy, belajar Manual dan Automation Testing di Digital Skola, dan hingga pada saat ini saya belajar Laravel (Backend) dan Vue (Frontend) di SanberCode, Indonesia.
      </p>
      <a href="https://www.linkedin.com/in/fikri-taufiq-rahman-b456ab160/" target="_blank" rel="noopener noreferrer">
        <img src="../assets/linkedin.png" alt="LinkedIn Logo" class="h-12 cursor-pointer block mb-4">
      </a>
      <a href="https://github.com/fikritaufiq" target="_blank" rel="noopener noreferrer">
        <img src="../assets/github.png" alt="GitHub Logo" class="h-12 cursor-pointer block">
      </a>
    </div>
    <div class="flex flex-col items-center md:items-start justify-center">
      <img src="@/assets/foto.png" alt="Foto Fikri Taufiq Rahman" class="rounded-lg shadow-lg max-w-full w-32 h-auto md:w-48 md:ml-auto md:mr-auto">
    </div> 
  </div>
</section>
</template>



<script setup>
// No need to define a homeSection ref here
</script>

<style scoped>
.section {
  margin-bottom: 2rem;
  color: black; /* Override text color if needed */
}

.max-w-full {
  max-width: 100%;
}
</style>