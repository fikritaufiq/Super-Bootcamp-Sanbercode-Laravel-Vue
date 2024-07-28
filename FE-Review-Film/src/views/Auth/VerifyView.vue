<template>
  <div class="container mx-auto p-4">
    <div v-if="showVerificationBox">
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

      <div v-if="otpSentNotification" class="notification mt-4 p-4 bg-blue-600 text-white rounded-lg">
        {{ otpSentNotification }}
      </div>

      <div v-if="notification" class="notification mt-4 p-4 bg-green-600 text-white rounded-lg">
        {{ notification }}
      </div>

      <div v-if="error" class="notification mt-4 p-4 bg-red-600 text-white rounded-lg">
        {{ error }}
      </div>
    </div>
    <div v-else>
      <h2 class="text-2xl font-bold mb-4">Akun berhasil diverifikasi!</h2>
      <p class="mb-4">Anda sekarang dapat melanjutkan ke halaman utama.</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

const otp = ref('');
const notification = ref('');
const error = ref('');
const showVerificationBox = ref(true); // State untuk mengontrol tampilan
const otpSentNotification = ref(''); // State untuk pemberitahuan OTP

const authStore = useAuthStore();

// Panggil getCurrentUser saat komponen di-mount
onMounted(async () => {
  await authStore.getCurrentUser(); // Ambil data pengguna
});

const submitOTP = async () => {
  try {
    error.value = '';
    await authStore.verifyAccount(otp.value);
    notification.value = 'Akun berhasil diverifikasi!';
    showVerificationBox.value = false; // Sembunyikan kotak verifikasi setelah berhasil
  } catch (err) {
    console.error('Kesalahan pengiriman OTP:', err.message);
    if (err.response?.status === 401) {
      error.value = 'Pengiriman OTP gagal: Tidak terotorisasi. Silakan periksa OTP Anda dan coba lagi.';
    } else {
      error.value = 'Pengiriman OTP gagal';
    }
  }
};

const formatOTP = () => {
  if (otp.value.length > 6) {
    otp.value = otp.value.slice(0, 6);
  }
};

const resendOTP = async () => {
  // Pastikan currentUser dan email tersedia
  if (!authStore.currentUser || !authStore.currentUser.email) {
    console.error('Pengguna tidak terdaftar atau email tidak tersedia.');
    return; // Hentikan eksekusi jika email tidak ada
  }

  const email = authStore.currentUser.email; // Ambil email dari pengguna yang sedang login
  try {
    await authStore.generateOtpCode(email); // Panggil fungsi dengan email
    otpSentNotification.value = 'Kode OTP berhasil dikirim ke: ' + email; // Setel pesan pemberitahuan
    console.log('Kode OTP berhasil dikirim ke:', email);
  } catch (error) {
    console.error('Gagal mengirim OTP:', error);
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