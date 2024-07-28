import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { defineStore } from 'pinia';
import { customAPI, tokenAPI } from '@/api';

export const useAuthStore = defineStore('auth', () => {
  const router = useRouter();
  const tokenUser = ref(localStorage.getItem('token') 
    ? JSON.parse(localStorage.getItem('token')) 
    : null);
  const currentUser = ref(localStorage.getItem('user') 
    ? JSON.parse(localStorage.getItem('user')) 
    : null);
  const isError = ref(false);
  const errorMsg = ref("");
  const isVerified = ref(localStorage.getItem('isVerified') 
    ? JSON.parse(localStorage.getItem('isVerified')) 
    : false);
  const userRole = ref(null); 

  const registerUser = async (inputData) => {  
    try {  
      console.log('Memulai proses registrasi');
      isError.value = false;
      errorMsg.value = "";

      if (!inputData.name || !inputData.email || !inputData.password || (inputData.password !== inputData.password_confirmation)) {
        throw new Error("Pastikan semua field diisi dan password cocok.");
      }

      console.log("Data yang akan dikirim untuk registrasi:", JSON.stringify(inputData));
      
      const { data } = await customAPI.post('/auth/register', inputData);
      console.log('Respons dari server setelah registrasi:', data);
      
      const { token, user } = data;
      setUserData(token, user);
      console.log('Registrasi berhasil:', user);
      router.push({ name: 'verify' }); 
    } catch (error) {
      console.error('Kesalahan saat registrasi:', error.response?.data || error.message);
      

      if (error.response) {
        console.error('Detail kesalahan:', JSON.stringify(error.response.data, null, 2));
      }
      
      handleError(error);
    }
  };

  const loginUser = async (credentials) => {
    try {
      console.log('Memulai proses login');
      isError.value = false;
      errorMsg.value = "";


      if (!credentials.email || !credentials.password) {
        throw new Error("Email dan password harus diisi.");
      }

      const response = await tokenAPI.post('/auth/login', credentials);
      tokenUser.value = response.data.token; 
 
      localStorage.setItem('token', tokenUser.value);
      const { data } = response;
      const { user } = data;
      setUserData(tokenUser.value, user);
      console.log('Login berhasil:', user);
      console.log('Token setelah login:', tokenUser.value); 
      await getCurrentUser(); 
      router.push({ name: 'home' }); 
    } catch (error) {
      console.error('Login gagal:', error.response?.data || error.message);
      handleError(error);
    }
  };

  const logoutUser = async () => {
    try {
      console.log('Memulai proses logout');
      

      if (!tokenUser.value) {
        console.warn('Tidak ada token, pengguna tidak terautentikasi.');
        clearUserData();
        router.push({ name: "login" });
        return;
      }

      console.log('Token sebelum logout:', tokenUser.value); 
      await tokenAPI.post('/auth/logout');
      clearUserData();
      router.push({ name: "home" });
    } catch (error) {
      console.error('Gagal logout:', error.response?.data || error.message);
      if (error.response?.status === 401 || error.response?.status === 404) {
        console.warn('Sesi mungkin sudah berakhir. Membersihkan data lokal.');
        clearUserData();
        router.push({ name: "home" });
      } else {
        handleError(error, 'Gagal logout: ');
      }
    }
  };

  const getCurrentUser = async () => {
    try {
      console.log('Memulai pengambilan data pengguna');
      const { data } = await tokenAPI.get('/me');
      console.log('Respons dari server untuk data pengguna:', data);
      
    
      setUserData(tokenUser.value, data.user); 
      userRole.value = data.role; 
      

      isVerified.value = !!data.user.email_verified_at; 
      console.log('Current User:', currentUser.value); 
      console.log('Is Verified:', isVerified.value); 
    } catch (error) {
      console.error('Gagal mengambil data pengguna:', error.response?.data || error.message);
      if (error.response?.status === 401) {
        await logoutUser();
      }
    }
  };

  const updateUser = async (userData) => {
    try {
      const response = await customAPI.put('/auth/update-user', userData);
      if (response.data && response.data.message === 'Update user berhasil') {
        await getCurrentUser();
        console.log('Data pengguna berhasil diperbarui.');
      } else {
        console.error('Data yang diterima tidak valid:', response.data);
      }
    } catch (error) {
      console.error("Gagal memperbarui data pengguna:", error.message);
      throw error; // Lempar error untuk ditangani di tempat lain
    }
  };

  const generateOtpCode = async (email) => {
    try {
      isError.value = false;
      errorMsg.value = "";
      await tokenAPI.post('/auth/generate-otp-code', { email });
      console.log('Kode OTP berhasil dibuat dan dikirim ke pengguna.');
    } catch (error) {
      console.error('Gagal mengirim kode OTP:', error.response?.data || error.message);
      handleError(error, 'Gagal mengirim kode OTP: ');
    }
  };

  const verifyAccount = async (otp) => {
    try {
        isError.value = false;
        errorMsg.value = "";

        const { data } = await tokenAPI.post('/auth/verifikasi-akun', { otp });
        console.log('Akun berhasil diverifikasi:', data);
        isVerified.value = true; 
        localStorage.setItem('isVerified', JSON.stringify(true));
        router.push({ name: 'home' });
    } catch (error) {
        handleError(error, 'Gagal verifikasi akun: ');
    }
  };

  const setUserData = (token, user) => {
    tokenUser.value = token;
    currentUser.value = user; 
    localStorage.setItem('token', JSON.stringify(token));
    localStorage.setItem('user', JSON.stringify(user));
  };

  const clearUserData = () => {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    localStorage.removeItem('isVerified'); 
    tokenUser.value = null;
    currentUser.value = null;
    isVerified.value = false; 
  };

  const handleError = (error, prefix = '') => {
    isError.value = true;
    errorMsg.value = prefix + (error.response?.data?.message || error.message);
  };

  const logout = async () => {
    try {
      console.log('Memulai proses logout');
      clearUserData(); 
      router.push({ name: 'login' }); 
    } catch (error) {
      console.error('Gagal logout:', error);
    }
  };

  return {
    tokenUser,
    currentUser,
    isVerified, 
    userRole, 
    registerUser,
    loginUser,
    logoutUser,
    getCurrentUser,
    updateUser,
    generateOtpCode,
    verifyAccount,
    isError,
    errorMsg,
    logout,
  };
});