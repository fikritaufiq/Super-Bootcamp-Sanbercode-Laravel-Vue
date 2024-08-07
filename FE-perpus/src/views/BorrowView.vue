<template>
  <div>
    <h1>Peminjaman Buku</h1>
    <form @submit.prevent="submitBorrow">
      <div>
        <label for="load_date">Tanggal Peminjaman:</label>
        <input type="datetime-local" v-model="loadDate" required />
      </div>
      <div>
        <label for="barrow_date">Tanggal Kembali:</label>
        <input type="datetime-local" v-model="borrowDate" required />
      </div>
      <div>
        <label for="book_id">Pilih Buku:</label>
        <select v-model="selectedBookId" required>
          <option v-for="book in books" :key="book.id" :value="book.id">
            {{ book.title }}
          </option>
        </select>
      </div>
      <button type="submit">Simpan Peminjaman</button>
    </form>

    <h2>Daftar Peminjaman</h2>
    <ul>
      <li v-for="borrow in borrows" :key="borrow.id">
        <div>
          <strong>Buku:</strong> {{ borrow.book.title }} <br />
          <strong>Pengguna:</strong> {{ borrow.user.name }} ({{ borrow.user.email }}) <br />
          <strong>Tanggal Peminjaman:</strong> {{ formatDate(borrow.load_date) }} <br />
          <strong>Tanggal Kembali:</strong> {{ formatDate(borrow.borrow_date) }} <br />
          <strong>Stok Buku:</strong> {{ borrow.book.stok }} <br />
          <img :src="borrow.book.image" alt="Book Image" class="w-32 h-32" />
        </div>
        <hr />
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useBorrowStore } from '@/stores/BorrowStore';

const borrowStore = useBorrowStore();
const loadDate = ref('');
const borrowDate = ref('');
const selectedBookId = ref(''); 
const borrows = ref([]); 
const books = ref([]);

const submitBorrow = async () => {
  try {
    const response = await borrowStore.createOrUpdateBorrow(loadDate.value, borrowDate.value, selectedBookId.value);
    alert(response.message);
    loadDate.value = '';
    borrowDate.value = '';
    selectedBookId.value = ''; 
    await fetchBorrows(); 
  } catch (error) {
    alert(error.message);
  }
};

const fetchBorrows = async () => {
  try {
    await borrowStore.fetchBorrows();
    borrows.value = borrowStore.borrows; 
  } catch (error) {
    alert(error.message);
  }
};

const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toLocaleString(); 
};

onMounted(() => {
  fetchBorrows();
});
</script>

<style scoped>

</style>