<template>
    <AuthForm
      title="Register"
      buttonText="Register"
      :handleSubmit="registerUser"
      :showUsername="true"
      :showPasswordConfirmation="true"
    />
  </template>
  
  <script setup>
  import AuthForm from '@/components/Auth/AuthForm.vue';
  import { ref } from 'vue';
  import { useAuthStore } from '@/stores/AuthStore';
  
  const authStore = useAuthStore();
  
  const registerUser = async (inputData) => {
    if (inputData.password !== inputData.password_confirmation) {
      console.log('Passwords do not match');
      return;
    }
  
    try {
      await authStore.registerUser(inputData);
      console.log('Registration successful:', authStore.currentUser);
    } catch (error) {
      console.log('Registration error:', authStore.errorMsg);
    }
  };
  </script>
  