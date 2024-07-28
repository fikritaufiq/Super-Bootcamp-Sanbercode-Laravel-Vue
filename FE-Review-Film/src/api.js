import axios from "axios";

const baseURL = 'http://localhost:8000/api/v1'; // Sesuaikan dengan URL backend Anda

export const customAPI = axios.create({ baseURL });

export const tokenAPI = axios.create({ baseURL });

// Menambahkan interceptor untuk menambahkan token ke setiap permintaan
tokenAPI.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers['Authorization'] = `Bearer ${JSON.parse(token)}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

// Menambahkan interceptor untuk menangani kesalahan global
customAPI.interceptors.response.use(
  (response) => response,
  (error) => {
    // Tangani kesalahan di sini
    console.error('Kesalahan dalam permintaan API:', error.response?.data || error.message);
    return Promise.reject(error);
  }
);

// Menambahkan log untuk melihat data yang dikirim dalam permintaan
customAPI.interceptors.request.use(
  (config) => {
    console.log("Mengirim permintaan ke:", config.url);
    console.log("Data yang dikirim:", JSON.stringify(config.data));
    return config;
  },
  (error) => Promise.reject(error)
);