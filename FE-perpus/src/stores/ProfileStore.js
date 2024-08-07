
import { defineStore } from 'pinia';
import { tokenAPI } from '@/api'; 

export const useProfileStore = defineStore('profile', {
  state: () => ({
    profile: null,
    message: '',
    errorMessage: ''
  }),
  actions: {
    async updateProfile(bio, age) {
      try {
        const formData = new FormData();
        formData.append('bio', bio);
        formData.append('age', age);

        const response = await tokenAPI.post('/profile', formData, {
          headers: {
            'Accept': 'application/json',
          }
        }); 
        this.message = response.data.message; 
        this.profile = response.data.data; 
      } catch (error) {
        this.errorMessage = 'Gagal memperbarui profil: ' + (error.response?.data?.message || error.message);
        throw new Error(this.errorMessage);
      }
    },
    fetchProfile() {
    }
  }
});