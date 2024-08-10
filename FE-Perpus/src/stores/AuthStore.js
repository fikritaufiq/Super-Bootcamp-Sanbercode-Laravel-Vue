import { ref } from "vue";
import { useRouter } from "vue-router";
import { defineStore } from "pinia";
import customApi from "@/api";

export const useAuthStore = defineStore("auth", () => {
  const router = useRouter();

  const tokenUser = ref(
    localStorage.getItem("token")
      ? JSON.parse(localStorage.getItem("token"))
      : null
  );

  const currentUser = ref(
    localStorage.getItem("user")
      ? JSON.parse(localStorage.getItem("user"))
      : null
  );

  const isError = ref(false);
  const errorMsg = ref("");
  const userName = ref("");
  const userEmail = ref("");
  const successMsg = ref("");

  const loginUser = async (inputan) => {
    try {
      isError.value = false;
      errorMsg.value = "";

      const { email, password } = inputan;
      const response = await customApi.post("/auth/login", {
        email,
        password,
      });

      // Pastikan response dan response.data ada sebelum mengaksesnya
      if (response && response.data) {
        const { token, user } = response.data;
        // simpan ke pinia
        tokenUser.value = token;
        currentUser.value = user;
        // simpan ke localStorage
        localStorage.setItem("token", JSON.stringify(token));
        localStorage.setItem("user", JSON.stringify(user));
        // Panggil getMe untuk memperbarui informasi pengguna
        await getMe();
        router.push("/");
      } else {
        throw new Error('Response data is undefined');
      }
    } catch (error) {
      isError.value = true;
      // Periksa apakah error.response ada sebelum mengakses data
      errorMsg.value = error.response ? error.response.data.message || 'An error occurred' : 'Network error or server did not respond';
      console.log(errorMsg.value);
    }
  };

  const registerUser = async (inputData) => {
    try {
      isError.value = false;
      errorMsg.value = "";
      successMsg.value = "";

      const { data } = await customApi.post("/auth/register", inputData);

      // Kirim alert
      successMsg.value = data.message; // Pesan dari server
      console.log(successMsg.value);
      
      // Tampilkan alert untuk registrasi berhasil
      alert("Registrasi berhasil! Silakan login."); // Alert sederhana

      // Alihkan ke halaman login setelah registrasi
      router.push("/login"); // Ganti dengan rute login yang sesuai
    } catch (error) {
      isError.value = true;
      // Periksa apakah error.response ada sebelum mengakses data
      errorMsg.value = error.response ? error.response.data : 'An error occurred';
      console.log(errorMsg.value);
    }
  };

  const getMe = async () => {
    try {
      const response = await customApi.get("/me", {
        headers: {
          Authorization: `Bearer ${tokenUser.value}`,
        },
      });

      if (response && response.data) {
        console.log(response.data);
        const { name, email } = response.data.user;

        // menyimpan nama dan email user ke state pinia
        userName.value = name;
        userEmail.value = email;
      } else {
        throw new Error('Response data is undefined');
      }
    } catch (error) {
      console.log(error);
    }
  };

  const logoutUser = async () => {
    // Simpan token sebelum dihapus
    const token = tokenUser.value;

    // Local Storage
    localStorage.removeItem("token");
    localStorage.removeItem("user");

    // Storage Pinia
    tokenUser.value = null;
    currentUser.value = null;

    console.log(tokenUser.value);
    try {
      // Hanya kirim permintaan logout jika token ada
      if (token) {
        await customApi.post("/auth/logout", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
      }
    } catch (error) {
      console.log('Logout error:', error);
    }
    router.push("/");
  };

  return {
    loginUser,
    tokenUser,
    currentUser,
    isError,
    errorMsg,
    logoutUser,
    getMe,
    userEmail,
    userName,
    registerUser,
    successMsg,
  };
});