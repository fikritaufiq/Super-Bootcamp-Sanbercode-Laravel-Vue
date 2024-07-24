import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { defineStore } from 'pinia';
import { customAPI,tokenAPI } from '@/api';

export const useAuthStore = defineStore('auth', () => {
  const router = useRouter();
  const tokenUser = ref(localStorage.getItem('token') ? JSON.parse(localStorage.getItem('token')) : null);
  const currentUser = ref(localStorage.getItem('user') ? JSON.parse(localStorage.getItem('user')) : null);
  const isError = ref(false);
  const errorMsg = ref("");

  const loginUser = async (inputData) => {
    try {
      isError.value = false;
      errorMsg.value = "input masih kosong";

      const { email, password } = inputData;
      const { data } = await customAPI.post('/auth/login', {
        email: email,
        password: password,
      });
      const { token, user } = data;

      console.log(token, user);

      tokenUser.value = token;
      currentUser.value = user;
      localStorage.setItem('token', JSON.stringify(token));
      localStorage.setItem('user', JSON.stringify(user));

      router.push({ name: 'home' });
    } catch (error) {
      isError.value = true;
      errorMsg.value = error.response.data.message;
    }
  };

  const getMe = async () => {
    try {
      const response = await customAPI.get('/me', {
        headers: { Authorization: `Bearer ${tokenUser.value}` }
      });
      const { user } = response.data;
      currentUser.value = user;
      localStorage.setItem('user', JSON.stringify(user));
      console.log(response);
    } catch (error) {
      console.log(error);
    }
  };

  const logoutUser = async() => {
    localStorage.setItem('token', null);
    localStorage.setItem('user', null);

    tokenUser.value = "";
    currentUser.value = "";

    const res = await customAPI.post('/me', {
      headers: { Authorization: `Bearer ${tokenUser.value}`}
    })

    console.log(res);

    router.push({name: "Home"});
  }

  const verifyAccount = async (otp) => {
    try {
      isError.value = false;
      errorMsg.value = "";

      await customAPI.post('/auth/verifikasi-akun', { otp });
      console.log('Akun berhasil diverifikasi');
    } catch (error) {
      isError.value = true;
      errorMsg.value = error.response?.data?.message || 'Verifikasi gagal';
      throw error;
    }
  };

  const generateOtpCode = async () => {
    try {
      isError.value = false;
      errorMsg.value = "";

      await customAPI.post('/auth/generate-otp');

      console.log('Kode OTP berhasil dihasilkan dan dikirim');
    } catch (error) {
      isError.value = true;
      errorMsg.value = error.response?.data?.message || 'Penghasilan OTP gagal';
      throw error;
    }
  };

  const updateUser = async (inputData) => {
    try {
      isError.value = false;
      errorMsg.value = "";

      await tokenAPI.post('/update-user', inputData);

      currentUser.value = { ...currentUser.value, ...inputData };
      localStorage.setItem('user', JSON.stringify(currentUser.value));

      console.log('Pengguna berhasil diperbarui');
    } catch (error) {
      isError.value = true;
      errorMsg.value = error.response?.data?.message || 'Pembaruan pengguna gagal';
      throw error;
    }
  };

  const verifikasi = async () => {
    try {
      await authStore.verifyAccount(otp.value);
    } catch (err) {
      console.error('Kesalahan verifikasi:', err.message);
    }
  };

  const kirimUlangOTP = async () => {
    try {
      await authStore.generateOtpCode();
    } catch (err) {
      console.error('Kesalahan penghasilan OTP:', err.message);
    }
  };

  const perbaruiPengguna = async () => {
    try {
      await authStore.updateUser({ name: 'namaBaru' });
    } catch (err) {
      console.error('Kesalahan pembaruan pengguna:', err.message);
    }
  };

  return {
    tokenUser,
    currentUser,
    loginUser,
    isError,
    errorMsg,
    getMe,
    logoutUser,
    verifyAccount,
    generateOtpCode,
    updateUser,
    perbaruiPengguna,
    verifikasi,
    kirimUlangOTP
  };
});
