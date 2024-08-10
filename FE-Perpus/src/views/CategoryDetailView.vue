<template>
  <Navbar />
  <div class="container mx-auto px-4 py-8" v-if="categoryDetail">
    <div class="mb-8 text-3xl font-bold">
      <h1>{{ categoryDetail.name }}</h1>
    </div>
    <!-- Card Untuk List Film -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="book in categoryDetail.books"
        :key="book.id"
        class="bg-base-100 p-6 rounded-lg shadow-md"
      >
        <img
          :src="book.image"
          alt="Film Image"
          class="w-full h-48 object-cover mb-4 rounded-md"
        />
        <h2 class="text-xl font-bold mb-2">{{ book.title }}</h2>
        <p class="text-gray-400 mb-2">{{ book.summary }}</p>
        <p class="text-gray-400 mb-2">Stok: {{ book.stok }}</p>
        <p class="text-gray-400">Genre: {{ categoryDetail.name }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import customApi from "@/api";
import Navbar from "@/components/NavBar.vue";

const route = useRoute();

const categoryDetail = ref("");

const getCategoryDetail = async () => {
  const { data } = await customApi.get(`categories/${route.params.id}`);
  categoryDetail.value = data.data;
  console.log(data.data);
};

onMounted(() => {
  getCategoryDetail();
});
</script>
