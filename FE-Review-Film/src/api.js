import axios from "axios";

export const customAPI = axios.create({
    baseURL: '/api/v1',
  });

  export const tokenAPI = axios.create({
    baseURL: '/api/v1',
    headers: {'Authorization': `Bearer ${localStorage.getItem('token')}`}
  });
