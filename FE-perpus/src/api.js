import axios from "axios";
import router from '@/router'; 

const baseURL = 'http://localhost:8000/api/v1'; 

export const customAPI = axios.create({ baseURL });
export const tokenAPI = axios.create({ baseURL });

tokenAPI.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token'); 
    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`; 
    }
    console.log("Mengirim permintaan ke:", config.url);
    return config;
  },
  (error) => {
    console.error('Request error:', error);
    return Promise.reject(error);
  }
);

tokenAPI.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 401) {
      console.error('Unauthorized! Redirecting to login...');
      localStorage.removeItem('token'); 
      router.push('/login'); 
    } else {
      console.error('Kesalahan dalam permintaan API:', error.response.data);
    }
    return Promise.reject(error);
  }
);