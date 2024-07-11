const fs = require('fs').promises;
const path = require('path');

const login = async (input, callback) => {
  const [name, password] = input.split(',');
  const filePath = path.resolve(__dirname, '../data.json');

  try {
    await fs.writeFile(filePath, '[]', { flag: 'wx' });
  } catch (error) {
    if (error.code !== 'EEXIST') {
      return callback(error);
    }
  }

  try {
    const data = await fs.readFile(filePath, 'utf8');
    const users = JSON.parse(data);

    const user = users.find(u => u.name === name && u.password === password);
    if (user) {
      if (user.isLogin) {
        return callback(null, 'User already logged in');
      }
      user.isLogin = true;
      await fs.writeFile(filePath, JSON.stringify(users, null, 2), 'utf8');

      const updatedData = await fs.readFile(filePath, 'utf8');
      callback(null, updatedData + "\n" + "\n" + 'Berhasil login');
    } else {
      callback(null, 'Login gagal');
    }
  } catch (error) {
    callback(error);
  }
};

module.exports = login;
