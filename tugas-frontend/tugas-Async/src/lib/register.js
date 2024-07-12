// lib/register.js
const fs = require('fs');
const path = require('path');

const register = (input, callback) => {
  const [name, password, role] = input.split(',');
  const filePath = path.resolve(__dirname, '../data.json');

  // Membaca file data.json
  fs.readFile(filePath, 'utf8', (err, data) => {
    if (err) {
      if (err.code === 'ENOENT') {
        // File tidak ditemukan, buat file baru
        data = '[]';
      } else {
        return callback(err);
      }
    }

    let users;
    try {
      users = JSON.parse(data);
    } catch (err) {
      return callback(err);
    }

    // Memeriksa apakah pengguna sudah ada
    if (users.find(user => user.name === name)) {
      return callback(null, 'User already exists');
    }

    // Menambahkan pengguna baru
    const newUser = {
      name,
      password,
      role,
      isLogin: false
    };
    users.push(newUser);

    // Menulis kembali data ke file data.json
    fs.writeFile(filePath, JSON.stringify(users, null, 2), 'utf8', err => {
      if (err) {
        return callback(err);
      }
      callback(null, 'Berhasil register');
    });
  });
};

module.exports = register;
