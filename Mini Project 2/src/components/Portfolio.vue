<template>
  <section ref="portfolioSection" class="section bg-gray-100 py-16 px-4">
    <div class="max-w-3xl mx-auto">
      <h1 class="text-4xl font-bold mb-8">Portfolio</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Project 1: GameApp -->
        <div class="bg-white p-4 rounded shadow flex flex-col items-center text-center">
        <h2 class="text-xl font-semibold mb-2">GameApp</h2>
        <img src="../assets/game.jpg" alt="GameApp Screenshot" class="mb-4 rounded-lg shadow-lg">
        <p class="text-gray-700 text-justify min-h-[100px]">
          GameApp adalah aplikasi web untuk memainkan dan mengelola game favorit Anda. Aplikasi ini Dibangun menggunakan teknologi React.js untuk frontend dan Node.js untuk backend.
        </p>
        <div class="mt-auto">
          <a href="https://github.com/fikritaufiq/Technical-Test-Game-Project" target="_blank" rel="noopener noreferrer" class="bg-gray-800 hover:bg-gray-900 text-white py-2 px-4 rounded inline-flex items-center">
            GitHub
          </a>
        </div>
      </div>

      <!-- Project 2: BengkelApp -->
      <div class="bg-white p-4 rounded shadow flex flex-col items-center text-center">
        <h2 class="text-xl font-semibold mb-2">BengkelApp</h2>
        <img src="../assets/odoo.webp" alt="BengkelApp Screenshot" class="mb-4 rounded-lg shadow-lg">
        <p class="text-gray-700 text-justify min-h-[100px]">
          BengkelApp adalah platform e-commerce untuk produk-produk perkakas dan part dari motor. Menggunakan Odoo untuk tampilan pengguna dan Python untuk manajemen data backend.
        </p>
        <div class="mt-auto">
          <a href="https://github.com/fikritaufiq/Project-Akhir-Odoo14-Servis-Motor" target="_blank" rel="noopener noreferrer" class="bg-gray-800 hover:bg-gray-900 text-white py-2 px-4 rounded inline-flex items-center">
            GitHub
          </a>
        </div>
      </div>

      <div class="bg-white p-4 rounded shadow flex flex-col items-center text-center">
          <h2 class="text-xl font-semibold mb-2">BE Review Film</h2>
          <img src="../assets/be.jpg" alt="SeleniumTest Screenshot" class="mb-4 rounded-lg shadow-lg">
          <p class="text-gray-700 text-justify min-h-[100px]">
          BE Review Film adalah sebuah Mini Project yang diberikan pada saat Bootcamp di Sanbercode yang berisi dokumentasi untuk me-review film.
          </p>
          <div class="mt-auto">
            <a href="https://documenter.getpostman.com/view/17808968/2sA3dvmDXD" target="_blank" rel="noopener noreferrer" class="bg-gray-800 hover:bg-gray-900 text-white py-2 px-4 rounded inline-flex items-center">
              Documentation
            </a>
          </div>
        </div>

        <div class="bg-white p-4 rounded shadow flex flex-col items-center text-center">
          <h2 class="text-xl font-semibold mb-2">SeleniumTest</h2>
          <img src="../assets/selenium.jpg" alt="SeleniumTest Screenshot" class="mb-4 rounded-lg shadow-lg">
          <p class="text-gray-700 text-justify min-h-[100px]">Membuat Web Automation Katalon dengan skenario Sign Up, Sign In, dan purchase item sampai ke payment.</p>
          <div class="mt-auto">
            <a href="https://github.com/fikritaufiq/Web-Automation-Fundamental_Homework8" target="_blank" rel="noopener noreferrer" class="bg-gray-800 hover:bg-gray-900 text-white py-2 px-4 rounded inline-flex items-center">
              GitHub
            </a>
          </div>
        </div>

        <div class="bg-white p-4 rounded shadow flex flex-col items-center text-center">
          <h2 class="text-xl font-semibold mb-2">KatalonTest</h2>
          <img src="../assets/katalon.jpg" alt="KatalonTest Screenshot" class="mb-4 rounded-lg shadow-lg">
          <p class="text-gray-700 text-justify min-h-[100px]">Membuat Web Automation Selenium dengan skenario buka makemytrip.com, Search any trip, dan Extract the value of top price.</p>
          <div class="mt-auto">
            <a href="https://github.com/fikritaufiq/Web-Automation-Katalon-Homework11" target="_blank" rel="noopener noreferrer" class="bg-gray-800 hover:bg-gray-900 text-white py-2 px-4 rounded inline-flex items-center">
              GitHub
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

</template>

<script setup>
import { ref } from 'vue';

const portfolioSection = ref(null);


</script>

<style scoped>

.section {
  margin-bottom: 2rem;
  color: black; 
}

.grid-cols-3 {
  grid-template-columns: repeat(3, minmax(0, 1fr));
}

</style>
