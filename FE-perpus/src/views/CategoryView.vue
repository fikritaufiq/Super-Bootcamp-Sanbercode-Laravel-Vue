<template>
  <div class="container mt-4">
    <h1 class="text-center">Kategori</h1>
    
    <div v-if="categoryStore.successMessage" class="alert alert-success">{{ categoryStore.successMessage }}</div>
    <div v-if="categoryStore.errorMessage" class="alert alert-danger">{{ categoryStore.errorMessage }}</div>
    <div v-if="message" class="alert alert-danger">{{ message }}</div> <!-- Menampilkan pesan kesalahan -->

    <div class="row">
      <div class="col-md-4" v-for="category in categoryStore.categories" :key="category.id">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">{{ category.name }}</h5>
            <div class="d-flex justify-content-between">
              <button v-if="!isCategoryOpen(category.id)" @click="toggleCategoryDetails(category.id)" class="btn btn-info">
                Detail
              </button>
              <button v-if="isCategoryOpen(category.id)" @click="toggleCategoryDetails(category.id)" class="btn btn-danger">
                Tutup Detail
              </button>
            </div>

            <div v-if="authStore.isOwner">
              <button @click="startEdit(category.name, category.id)" class="btn btn-warning edit-button">Edit Kategori</button>
              <button @click="deleteCategory(category.id)" class="btn btn-danger delete-button">Hapus Kategori</button>
            </div>
            <div v-if="isCategoryOpen(category.id)" class="mt-3">
              <h6>Daftar Buku:</h6>
              <ul>
                <li v-for="book in category.list_books" :key="book.id">
                  <strong>{{ book.title }}</strong> - {{ book.summary }} (ID: {{ book.book_id }})
                  <img :src="book.image" alt="Book Image" style="width: 50px; height: auto;" />
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="authStore.isOwner" class="mt-4">
      <h4>Tambah Kategori</h4>
      <input v-model="newCategory" placeholder="Nama Kategori" class="form-control mb-2 input-black" />
      <button @click="addCategory" class="btn btn-primary"> Simpan</button>
    </div>

    <div v-if="editingCategoryId" class="mt-4">
      <h4>Edit Kategori</h4>
      <input v-model="updatedCategoryName" placeholder="Nama Kategori" class="form-control mb-2" />
      <button @click="updateCategory(editingCategoryId)" class="btn btn-success">Simpan Perubahan</button>
      <button @click="cancelEdit" class="btn btn-secondary">Batal</button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useCategoryStore } from '@/stores/CategoryStore';
import { useAuthStore } from '@/stores/AuthStore';

const categoryStore = useCategoryStore();
const authStore = useAuthStore();
const newCategory = ref('');
const updatedCategoryName = ref('');
const editingCategoryId = ref(null);
const openCategoryDetails = ref(null); 
const message = ref(''); 


const fetchCategories = async () => {
  await categoryStore.fetchCategories();
};

const fetchCategoryDetails = async (id) => {
  try {
    const category = await categoryStore.fetchCategoryDetails(id);
    const foundCategory = categoryStore.categories.find(cat => cat.id === category.id);
    if (foundCategory) {
      foundCategory.list_books = category.list_books; 
    }
    openCategoryDetails.value = id; 
  } catch (error) {
    console.error("Kesalahan saat mengambil detail kategori:", error);
  }
};

const toggleCategoryDetails = (id) => {
  if (isCategoryOpen(id)) {
    openCategoryDetails.value = null; 
  } else {
    fetchCategoryDetails(id); 
    openCategoryDetails.value = id;
  }
};

const isCategoryOpen = (id) => {
  return openCategoryDetails.value === id;
};

const startEdit = (name, id) => {
  updatedCategoryName.value = name;
  editingCategoryId.value = id;
};

const updateCategory = async (id) => {
  try {
    const messageResponse = await categoryStore.updateCategory(id, updatedCategoryName.value);
    message.value = messageResponse;
    updatedCategoryName.value = '';
    editingCategoryId.value = null;
    await fetchCategories();
  } catch (error) {
    message.value = error.message;
    console.error("Kesalahan saat memperbarui kategori:", error);
  }
};

const deleteCategory = async (id) => {
  if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
    try {
      const messageResponse = await categoryStore.deleteCategory(id);
      message.value = messageResponse;
      await fetchCategories();
    } catch (error) {
      message.value = error.message; 
      console.error("Kesalahan saat menghapus kategori:", error);
    }
  }
};


const cancelEdit = () => {
  updatedCategoryName.value = '';
  editingCategoryId.value = null;
};


const addCategory = async () => {
  if (!newCategory.value) {
    message.value = 'Nama kategori tidak boleh kosong.'; 
    return;
  }
  try {
    await categoryStore.addCategory(newCategory.value); 
    newCategory.value = ''; 
    await fetchCategories();
  } catch (error) {
    message.value = error.message; 
    console.error("Kesalahan saat menambah kategori:", error);
  }
};

// Fetch categories on component mount
onMounted(() => {
  fetchCategories();
});

// Watch for changes in authStore.isOwner to update the view reactively
watch(() => authStore.isOwner, (newValue) => {
  console.log("Owner status changed:", newValue); // Debug log
  fetchCategories(); // Memperbarui kategori jika status owner berubah
});

// Watch for changes in authStore.isAuthenticated to fetch categories on login
watch(() => authStore.isAuthenticated, (newValue) => {
  console.log("Authenticated status changed:", newValue); // Debug log
  if (newValue) {
    fetchCategories(); // Fetch categories when the user logs in
  }
});
</script>

<style scoped>
.alert {
  color: green;
  margin-bottom: 10px;
}

.input-black {
  color: black;
  background-color: white;
  border: 1px solid #ccc;
  padding: 8px;
  border-radius: 4px;
}

.edit-button {
  margin-left: 10px;
}

.delete-button {
  margin-left: 10px;
}
</style>