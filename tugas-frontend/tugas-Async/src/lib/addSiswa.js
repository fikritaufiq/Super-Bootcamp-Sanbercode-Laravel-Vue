const fs = require('fs').promises;
const path = require('path');

module.exports = async function addSiswa(input, callback) {
  const [nama, trainerName] = input.split(',');
  const filePath = path.resolve(__dirname, '../data.json');

  try {
    let data = await fs.readFile(filePath, 'utf8');
    data = JSON.parse(data);

    let trainer = data.find(user => user.name === trainerName && user.role === 'trainer');

    if (!trainer) {
      trainer = {
        name: trainerName,
        password: '123456',
        role: 'trainer',
        isLogin: false,
        students: []
      };
      data.push(trainer);
    }

    trainer.students = trainer.students || [];
    trainer.students.push({ name: nama });

    await fs.writeFile(filePath, JSON.stringify(data, null, 2), 'utf8');

    const updatedData = await fs.readFile(filePath, 'utf8');
    callback(null, updatedData + "\n" + "\n" + `Berhasil add siswa: ${nama}`);
  } catch (err) {

    callback(err);
  }
};
