<template>
  <div class="flex flex-col items-center">
    <h2 class="text-2xl font-bold mb-4">Daftar Buku</h2>
    <div class="flex flex-wrap justify-center gap-4">
      <div
        v-for="book in books"
        :key="book.id"
        class="card bg-base-100 shadow-xl w-60"
      >
        <div class="card-body">
          <h3 class="card-title">{{ book.title }}</h3>
          <p>Penulis: {{ book.author }}</p>
          <p>Tahun: {{ book.year }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const books = ref([
  { id: 1, title: "Buku A", author: "Penulis A", year: 2020 },
  { id: 2, title: "Buku B", author: "Penulis B", year: 2021 },
  { id: 3, title: "Buku C", author: "Penulis C", year: 2022 },
  // Tambahkan data buku lainnya di sini
]);
</script>
