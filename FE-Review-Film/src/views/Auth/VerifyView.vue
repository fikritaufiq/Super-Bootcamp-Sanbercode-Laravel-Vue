<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Verifikasi Akun</h1>
    <p class="mb-4">Masukkan OTP yang telah dikirim melalui email Anda</p>

    <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg max-w-sm mx-auto">
      <form @submit.prevent="submitOTP">
        <div class="mb-4">
          <label for="otp" class="block text-sm font-medium">Kode OTP</label>
          <input
            type="text"
            id="otp"
            maxlength="6"
            class="otp-input"
            v-model="otp"
            @input="formatOTP"
          />
        </div>

        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Verifikasi
        </button>
        
        <p class="mt-4 text-center text-blue-400 cursor-pointer" @click="resendOTP">
          Kirim ulang OTP
        </p>
      </form>
    </div>

    <div v-if="notification" class="notification mt-4 p-4 bg-green-600 text-white rounded-lg">
      {{ notification }}
    </div>

    <div v-if="error" class="notification mt-4 p-4 bg-red-600 text-white rounded-lg">
      {{ error }}
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

const otp = ref('');
const notification = ref('');
const error = ref('');

const authStore = useAuthStore();

const submitOTP = async () => {
  try {
    error.value = '';
    await authStore.verifyAccount(otp.value);
    notification.value = 'Akun berhasil diverifikasi!';
  } catch (err) {
    console.error('Kesalahan pengiriman OTP:', err.message);
    if (err.response?.status === 401) {
      error.value = 'Pengiriman OTP gagal: Tidak terotorisasi. Silakan periksa OTP Anda dan coba lagi.';
    } else {
      error.value = 'Pengiriman OTP gagal: ' + (err.response?.data?.message || 'Terjadi kesalahan yang tidak terduga.');
    }
  }
};

const formatOTP = () => {
  if (otp.value.length > 6) {
    otp.value = otp.value.slice(0, 6);
  }
};

const resendOTP = async () => {
  try {
    error.value = ''; 
    await authStore.generateOtpCode();
    notification.value = 'Penghasilan kode OTP berhasil, silakan cek email Anda.';
  } catch (err) {
    console.error('Kesalahan pengiriman ulang OTP:', err.message);
    error.value = 'Gagal mengirim ulang OTP: ' + (err.response?.data?.message || 'Terjadi kesalahan yang tidak terduga.');
  }
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: 0 auto;
}

.otp-input {
  width: 100%;
  height: 2rem;
  text-align: center;
  font-size: 1.25rem;
  background-color: #1f2937;
  border: 1px solid #374151;
  color: white;
  border-radius: 0.375rem;
}

.otp-input:focus {
  outline: none;
  border-color: #3b82f6;
  background-color: #374151;
}

.notification {
  text-align: center;
}
</style>
