const fs = require('fs').promises;
const path = require('path');

const register = async (input, callback) => {
  const [name, password, role] = input.split(',');
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

    if (users.find(u => u.name === name)) {
      return callback(null, 'User already exists');
    }

    const newUser = {
      name,
      password,
      role,
      isLogin: false
    };

    users.push(newUser);

    await fs.writeFile(filePath, JSON.stringify(users, null, 2), 'utf8');
    
    const updatedData = await fs.readFile(filePath, 'utf8');
    callback(null, updatedData + "\n" + "\n" + 'Berhasil register' );
  } catch (error) {
    callback(error);
  }
};

module.exports = register;
