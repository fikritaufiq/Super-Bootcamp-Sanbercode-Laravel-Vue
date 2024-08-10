<template>
  <div class="flex flex-col min-h-screen bg-gray-800">
    <NavBar />
    
    <main class="flex-1 container mx-auto p-6">
      <h1 class="text-4xl font-bold mb-4 text-center text-white">Pinjam Buku</h1>

      <form
        @submit.prevent="createBorrow"
        class="bg-gray-900 p-6 rounded-lg shadow-md max-w-lg mx-auto"
      >
        <div class="mb-4">
          <label class="block text-gray-900">Judul Buku</label>
          <select
            v-model="formData.book_id"
            class="select select-bordered w-full bg-gray-800 text-white"
            required
          >
            <option :value="data.id" v-for="data in books" :key="data.id">
              {{ data.title }}
            </option>
          </select>
        </div>
        <div class="form-control mb-4">
          <label class="label">
            <span class="block text-gray-300">Tanggal Meminjam</span>
          </label>
          <input
            v-model="formData.load_date"
            type="date"
            class="input input-bordered bg-gray-800 text-white"
            required
          />
        </div>
        <div class="form-control mb-4">
          <label class="label">
            <span class="block text-gray-300">Tanggal Pengembalian</span>
          </label>
          <input
            v-model="formData.borrow_date"
            type="date"
            class="input input-bordered bg-gray-800 text-white"
            required
          />
        </div>

        <div class="flex justify-end">
          <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white">Pinjam Buku</button>
        </div>
      </form>
    </main>
  </div>
</template>

<script setup>
import NavBar from "@/components/NavBar.vue";
import { ref, onMounted } from "vue";
import customApi from "@/api";
import { useAuthStore } from "@/stores/AuthStore";
import { useRouter } from "vue-router";

const router = useRouter();
const authStore = useAuthStore();

const formData = ref({
  book_id: "",
  load_date: "",
  borrow_date: "",
});

const books = ref([]);
const borrows = ref([]); // Menyimpan daftar peminjaman

const fetchBooks = async () => {
  try {
    const response = await customApi.get("/books");
    books.value = response.data.data;
  } catch (error) {
    console.error("Failed to fetch books:", error);
  }
};

const fetchBorrows = async () => {
  try {
    const response = await customApi.get("/borrows", {
      headers: { Authorization: `Bearer ${authStore.tokenUser}` },
    });
    borrows.value = response.data.data; // Mengambil data peminjaman
  } catch (error) {
    console.error("Failed to fetch borrows:", error);
  }
};

onMounted(() => {
  fetchBooks();
  fetchBorrows(); // Memanggil fungsi untuk mengambil data peminjaman
});

const createBorrow = async () => {
  try {
    const response = await customApi.post(
      "/borrows",
      {
        book_id: formData.value.book_id,
        load_date: formData.value.load_date,
        borrow_date: formData.value.borrow_date,
        user_id: authStore.currentUser.id,
      },
      {
        headers: {
          Authorization: `Bearer ${authStore.tokenUser}`,
        },
      }
    );
    alert("Buku berhasil dipinjam");
    borrows.value.push(response.data.data); // Menambahkan peminjaman baru ke daftar
    router.push("/borrowlist");
  } catch (error) {
    console.error("Failed to create borrow:", error);
    alert("Gagal meminjam buku. Pastikan anda sudah login");
  }
};
</script>

<style scoped>
.input, .select {
  border: 1px solid #4B5563; /* Warna border gelap */
}
</style>