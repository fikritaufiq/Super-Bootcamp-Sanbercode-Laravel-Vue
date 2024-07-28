<template>
  <div>
    <h1>Daftar Genre</h1>
    
    <h2>Buat Genre Baru</h2>
    <form @submit.prevent="createGenre">
      <div>
        <label for="name">Nama Genre:</label>
        <input type="text" id="name" v-model="newGenreName" required />
      </div>
      <button type="submit" class="btn btn-create">Buat Genre</button>
    </form>

    <table>
      <thead>
        <tr>
          <th style="color: black;">ID</th>
          <th style="color: black;">Nama Genre</th>
          <th style="color: black;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="genre in genres" :key="genre.id">
          <td>{{ genre.id }}</td>
          <td>{{ genre.name }}</td>
          <td>
            <router-link :to="{ name: 'edit-genre', params: { id: genre.id } }" class="btn btn-edit">Edit</router-link>
            <button @click="deleteGenre(genre.id)" class="btn btn-delete">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { useGenreStore } from '@/stores/GenreStore';
import { onMounted, ref } from 'vue';

export default {
  setup() {
    const genreStore = useGenreStore();
    const newGenreName = ref('');

    // Fetch genres when the component is mounted
    onMounted(() => {
      genreStore.fetchGenres();
    });

    // Method to delete a genre
    const deleteGenre = async (id) => {
      if (confirm('Apakah Anda yakin ingin menghapus genre ini?')) {
        await genreStore.deleteGenre(id);
        await genreStore.fetchGenres(); // Refresh daftar genre setelah penghapusan
      }
    };

    // Method to create a new genre
    const createGenre = async () => {
      try {
        await genreStore.createGenre({ name: newGenreName.value });
        newGenreName.value = ''; // Reset input setelah berhasil
        await genreStore.fetchGenres(); // Refresh daftar genre setelah penambahan
      } catch (error) {
        console.error('Error creating genre:', error);
      }
    };

    return {
      genres: genreStore.genres,
      deleteGenre,
      newGenreName,
      createGenre,
    };
  },
};
</script>

<style scoped>
.btn {
  margin-bottom: 1rem;
}
.btn-create {
  padding: 10px 15px; /* Menambahkan padding untuk tombol */
  background-color: #007bff; /* Warna latar belakang tombol */
  color: white; /* Warna teks tombol */
  border: none;
  border-radius: 5px; /* Membuat sudut tombol melengkung */
  cursor: pointer;
  font-size: 16px; /* Ukuran font yang lebih besar */
  transition: background-color 0.3s; /* Efek transisi saat hover */
}

.btn-create:hover {
  background-color: #0056b3; /* Warna latar belakang saat hover */
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px; /* Menambahkan margin atas untuk tabel */
}
th, td {
  border: 1px solid #ddd;
  padding: 8px;
}
th {
  background-color: #f2f2f2;
}
form {
  display: flex;
  flex-direction: column;
  max-width: 400px;
  margin: 20px 0; /* Menambahkan margin untuk pemisah */
}
label {
  margin-bottom: 5px;
}
input {
  margin-bottom: 15px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  color: black; /* Mengatur warna teks input menjadi hitam */
  background-color: white; /* Warna latar belakang input */
}
</style>