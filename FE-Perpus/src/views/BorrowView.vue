<template>
  <NavBar />
  <div class="container mx-auto p-4 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">Daftar Peminjaman Buku</h1>
    <table class="min-w-full bg-gray-800">
      <thead>
        <tr>
          <th class="py-2 text-black">Nama</th>
          <th class="py-2 text-black">Judul Buku</th>
          <th class="py-2 text-black">Tanggal Meminjam</th>
          <th class="py-2 text-black">Tanggal Pengembalian</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="borrow in borrows" :key="borrow.id" class="bg-gray-700">
          <td class="border px-4 py-2 text-white">{{ borrow.user.name }}</td>
          <td class="border px-4 py-2 text-white">{{ borrow.book.title }}</td>
          <td class="border px-4 py-2 text-white">{{ borrow.load_date }}</td>
          <td class="border px-4 py-2 text-white">{{ borrow.borrow_date }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import NavBar from "@/components/NavBar.vue";
import { ref, onMounted } from "vue";
import customApi from "@/api";
import { useAuthStore } from "@/stores/AuthStore";

const authStore = useAuthStore();

const borrows = ref([]);

const fetchBorrows = async () => {
  try {
    const response = await customApi.get("/borrows", {
      headers: { Authorization: `Bearer ${authStore.tokenUser}` },
    });
    borrows.value = response.data.data;
    const userIds = borrows.value.map((borrow) => borrow.user_id);
    console.log(userIds);
    console.log(borrows.value);
  } catch (error) {
    console.error("Error fetching borrow data:", error);
  }
};

onMounted(fetchBorrows);
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}
th,
td {
  text-align: left;
  padding: 8px;
}
th {
  background-color: #f2f2f2;
}
</style>