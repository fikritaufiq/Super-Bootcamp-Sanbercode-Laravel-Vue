<template>
    <div class="container mt-4">
        <h1 class="text-center">Daftar Buku</h1>

        <div v-if="bookStore.successMessage" class="alert alert-success">{{ bookStore.successMessage }}</div>
        <div v-if="bookStore.errorMessage" class="alert alert-danger">{{ bookStore.errorMessage }}</div>

        <div class="row">
            <div class="col-md-4" v-for="book in bookStore.books" :key="book.id">
                <div class="card mb-4 shadow-sm">
                    <img :src="book.image" alt="Book Image" class="card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title">{{ book.title }}</h5>
                        <p class="card-text">{{ book.summary }}</p>
                        <button @click="viewDetails(book.id)" class="btn btn-info">Detail</button>
                        <button @click="startEdit(book)" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#bookModal">Edit</button>
                        <button @click="deleteBook(book.id)" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookModalLabel">{{ editingBook ? 'Edit Buku' : 'Tambah Buku' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input v-model="currentBook.title" placeholder="Judul Buku" class="form-control mb-2 input-black" />
                        <textarea v-model="currentBook.summary" placeholder="Ringkasan" class="form-control mb-2 input-black"></textarea>
                        <input v-model="currentBook.image" placeholder="URL Gambar" class="form-control mb-2 input-black" />
                        <input v-model="currentBook.stok" type="number" placeholder="Stok" class="form-control mb-2 input-black" />
                        <select v-model="currentBook.category_id" class="form-control mb-2 input-black">
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button @click="editingBook ? updateBook(editingBook.id) : addBook" class="btn btn-success">{{ editingBook ? 'Simpan Perubahan' : 'Simpan' }}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="cancelEdit">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button @click="openAddBookModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookModal">Tambah Buku</button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useBookStore } from '@/stores/BookStore';
import { useCategoryStore } from '@/stores/CategoryStore';

const bookStore = useBookStore();
const categoryStore = useCategoryStore();
const newBook = ref({ title: '', summary: '', image: '', stok: '', category_id: '' });
const editingBook = ref(null);
const categories = ref([]);


const fetchBooks = async () => {
    await bookStore.fetchBooks();
};

const fetchCategories = async () => {
    await categoryStore.fetchCategories();
    categories.value = categoryStore.categories; 
};

const addBook = async () => {
    try {
        await bookStore.addBook(newBook.value);
        newBook.value = { title: '', summary: '', image: '', stok: '', category_id: '' }; 
        await fetchBooks();
    } catch (error) {
        console.error("Kesalahan saat menambah buku:", error);
    }
};

const startEdit = (book) => {
    editingBook.value = { ...book }; 
};

const updateBook = async (id) => {
    try {
        console.log("Data yang akan dikirim:", editingBook.value);
        await bookStore.updateBook(id, editingBook.value);
        editingBook.value = null; 
        await fetchBooks();
    } catch (error) {
        if (error.response) {
            console.error("Kesalahan saat memperbarui buku:", error.response.data); 
        } else {
            console.error("Kesalahan saat memperbarui buku:", error);
        }
    }
};

const deleteBook = async (id) => {
    if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
        try {
            await bookStore.deleteBook(id);
            await fetchBooks();
        } catch (error) {
            console.error("Kesalahan saat menghapus buku:", error);
        }
    }
};

const cancelEdit = () => {
    editingBook.value = null; 
};


const viewDetails = (id) => {
    console.log("Menampilkan detail untuk buku dengan ID:", id);
};


const currentBook = computed(() => {
    return editingBook.value || newBook.value;
});


const openAddBookModal = () => {
    newBook.value = { title: '', summary: '', image: '', stok: '', category_id: '' }; 
    editingBook.value = null; 
};

onMounted(() => {
    fetchBooks();
    fetchCategories();
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
</style>