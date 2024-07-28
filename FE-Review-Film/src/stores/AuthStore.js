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
    : false); // Inisialisasi dengan false jika tidak ada
  const userRole = ref(null); // Tambahkan state untuk role pengguna

  const registerUser = async (inputData) => {  
    try {  
      console.log('Memulai proses registrasi');
      isError.value = false;
      errorMsg.value = "";

      // Validasi input
      if (!inputData.name || !inputData.email || !inputData.password || (inputData.password !== inputData.password_confirmation)) {
        throw new Error("Pastikan semua field diisi dan password cocok.");
      }

      console.log("Data yang akan dikirim untuk registrasi:", JSON.stringify(inputData));
      
      const { data } = await customAPI.post('/auth/register', inputData);
      console.log('Respons dari server setelah registrasi:', data);
      
      const { token, user } = data;
      setUserData(token, user);
      console.log('Registrasi berhasil:', user);
      router.push({ name: 'verify' }); // Arahkan ke tampilan verifikasi setelah registrasi
    } catch (error) {
      console.error('Kesalahan saat registrasi:', error.response?.data || error.message);
      
      // Tambahkan log untuk melihat detail kesalahan
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

      // Validasi input
      if (!credentials.email || !credentials.password) {
        throw new Error("Email dan password harus diisi.");
      }

      const response = await tokenAPI.post('/auth/login', credentials);
      tokenUser.value = response.data.token; // Simpan token
      // Simpan token di localStorage
      localStorage.setItem('token', tokenUser.value);
      const { data } = response;
      const { user } = data;
      setUserData(tokenUser.value, user);
      console.log('Login berhasil:', user);
      console.log('Token setelah login:', tokenUser.value); // Tambahkan log untuk memeriksa nilai token setelah login
      await getCurrentUser(); // Pastikan ini dipanggil setelah login berhasil
      router.push({ name: 'home' }); // Pastikan ini sesuai dengan nama rute
    } catch (error) {
      console.error('Login gagal:', error.response?.data || error.message);
      handleError(error);
    }
  };

  const logoutUser = async () => {
    try {
      console.log('Memulai proses logout');
      
      // Cek apakah token ada sebelum melakukan logout
      if (!tokenUser.value) {
        console.warn('Tidak ada token, pengguna tidak terautentikasi.');
        clearUserData();
        router.push({ name: "login" });
        return;
      }

      console.log('Token sebelum logout:', tokenUser.value); // Tambahkan log untuk memeriksa nilai token sebelum logout
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
      
      // Pastikan Anda mengatur data.user
      setUserData(tokenUser.value, data.user); 
      userRole.value = data.role; // Simpan role pengguna
      
      // Pastikan ini diatur dengan benar
      isVerified.value = !!data.user.email_verified_at; 
      console.log('Current User:', currentUser.value); 
      console.log('Is Verified:', isVerified.value); // Debugging
    } catch (error) {
      console.error('Gagal mengambil data pengguna:', error.response?.data || error.message);
      if (error.response?.status === 401) {
        await logoutUser();
      }
    }
  };

  const updateUser = async (userData) => {
    try {
      // Mengirim permintaan untuk memperbarui data pengguna
      const { data } = await tokenAPI.post('/auth/update-user', userData);
      
      // Cek apakah respons berisi pesan sukses
      if (data && data.message === 'Update user berhasil') {
        // Jika tidak ada data user baru, Anda bisa mengambil data pengguna terbaru
        await getCurrentUser(); // Ambil data pengguna terbaru
        console.log('Data pengguna berhasil diperbarui.');
      } else {
        console.error('Data yang diterima tidak valid:', data);
      }
    } catch (error) {
      // Menangani kesalahan dengan lebih baik
      console.error('Gagal memperbarui data pengguna:', error.response?.data || error.message);
      handleError(error, 'Gagal memperbarui data pengguna: ');
    }
  };

  const generateOtpCode = async (email) => {
    try {
      isError.value = false;
      errorMsg.value = "";
      // Kirim email sebagai bagian dari permintaan
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
        // Mengirim permintaan POST untuk verifikasi akun
        const { data } = await tokenAPI.post('/auth/verifikasi-akun', { otp });
        console.log('Akun berhasil diverifikasi:', data);
        isVerified.value = true; // Set status verifikasi menjadi true
        localStorage.setItem('isVerified', JSON.stringify(true)); // Simpan status verifikasi
        router.push({ name: 'home' });
    } catch (error) {
        handleError(error, 'Gagal verifikasi akun: ');
    }
  };

  const setUserData = (token, user) => {
    tokenUser.value = token;
    currentUser.value = user; // Pastikan user memiliki email_verified_at
    localStorage.setItem('token', JSON.stringify(token));
    localStorage.setItem('user', JSON.stringify(user));
  };

  const clearUserData = () => {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    localStorage.removeItem('isVerified'); // Hapus status verifikasi
    tokenUser.value = null;
    currentUser.value = null;
    isVerified.value = false; // Reset status verifikasi
  };

  const handleError = (error, prefix = '') => {
    isError.value = true;
    errorMsg.value = prefix + (error.response?.data?.message || error.message);
  };

  const logout = async () => {
    try {
      console.log('Memulai proses logout');
      clearUserData(); // Pastikan ini menghapus data dari localStorage dan state
      router.push({ name: 'login' }); // Arahkan ke halaman login setelah logout
    } catch (error) {
      console.error('Gagal logout:', error);
    }
  };

  return {
    tokenUser,
    currentUser,
    isVerified, // Kembalikan state isVerified
    userRole, // Kembalikan state userRole
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