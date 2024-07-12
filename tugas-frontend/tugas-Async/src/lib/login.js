const fs = require('fs').promises;
const path = require('path');

const login = (input) => {
  const [name, password] = input.split(',');
  const filePath = path.resolve(__dirname, '../data.json');

  // Membaca file data.json
  return fs.readFile(filePath, 'utf8')
    .then((data) => {
      const users = JSON.parse(data);

      // Mencari pengguna berdasarkan nama dan password
      const user = users.find(u => u.name === name && u.password === password);

      if (!user) {
        return Promise.reject('Login gagal: User not found or incorrect password');
      }

      if (user.isLogin) {
        return Promise.reject('Login gagal: User already logged in');
      }

      // Mengatur status login menjadi true
      user.isLogin = true;

      // Menyimpan perubahan kembali ke file
      return fs.writeFile(filePath, JSON.stringify(users, null, 2), 'utf8')
        .then(() => 'Berhasil login');
    })
    .catch((err) => {
      return Promise.reject(err);
    });
};

module.exports = login;
