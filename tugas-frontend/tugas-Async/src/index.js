const register = require('./lib/register');
const login = require('./lib/login');
const addSiswa = require('./lib/addSiswa');

const command = process.argv[2];
const input = process.argv.slice(3).join(',');

switch (command) {
  case 'register':
    register(input, (err, result) => {
      if (err) {
        console.error('Error:', err);
      } else {
        console.log(result);
      }
    });
    break;
  case 'login':
    login(input)
      .then((result) => {
        console.log(result);
      })
      .catch((err) => {
        console.error('Error:', err);
      });
    break;
  case 'addSiswa':
    addSiswa(input, (err, result) => {
      if (err) {
        console.error('Error:', err);
      } else {
        console.log(result);
      }
    });
    break;
  default:
    console.log('Command not recognized');
}
