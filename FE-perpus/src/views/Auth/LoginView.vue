<template>
    <AuthForm
      title="Login"
      buttonText="Login"
      :handleSubmit="loginUser"
    />
  </template>
  
  <script setup>
  import AuthForm from '@/components/Auth/AuthForm.vue';
  import { ref } from 'vue';
  
  const loginUser = () => {
    console.log('Logging in with:', email.value, password.value);
  };
  
  const email = ref('');
  const password = ref('');
  </script>
  