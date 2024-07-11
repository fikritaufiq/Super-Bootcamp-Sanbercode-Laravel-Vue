"use strict";

var register = require('./lib/register');
var login = require('./lib/login');
var addSiswa = require('./lib/addSiswa');
var command = process.argv[2];
var input = process.argv.slice(3).join(',');
switch (command) {
  case 'register':
    register(input, function (err, result) {
      if (err) {
        console.error('Error:', err);
      } else {
        console.log(result);
      }
    });
    break;
  case 'login':
    login(input, function (err, result) {
      if (err) {
        console.error('Error:', err);
      } else {
        console.log(result);
      }
    });
    break;
  case 'addSiswa':
    addSiswa(input, function (err, result) {
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