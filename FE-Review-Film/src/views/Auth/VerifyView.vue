<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Verifikasi Akun</h1>
    <p class="mb-4">Masukkan OTP yang telah dikirim melalui email anda</p>
    
    <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg max-w-sm mx-auto">
      <form @submit.prevent="submitOTP">
        <div class="mb-4">
          <label for="otp" class="block text-sm font-medium">Kode OTP</label>
          <div class="flex space-x-2 mt-2">
            <input
              type="text"
              id="otp1"
              maxlength="1"
              class="otp-input"
              v-model="otp[0]"
            />
            <input
              type="text"
              id="otp2"
              maxlength="1"
              class="otp-input"
              v-model="otp[1]"
            />
            <input
              type="text"
              id="otp3"
              maxlength="1"
              class="otp-input"
              v-model="otp[2]"
            />
            <input
              type="text"
              id="otp4"
              maxlength="1"
              class="otp-input"
              v-model="otp[3]"
            />
          </div>
        </div>
        
        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Verifikasi
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const otp = ref(['', '', '', '']);

const submitOTP = () => {
  console.log('OTP Submitted:', otp.value.join(''));
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: 0 auto;
}

.otp-input {
  width: 2rem;
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
</style>
