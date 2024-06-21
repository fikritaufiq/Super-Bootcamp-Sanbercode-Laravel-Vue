Tugas Harian 3 - Mysql Database

1. Menambahkan Folder baru dan file baru

Gunakanlah repository tugas (jangan buat repository baru lagi). Lalu buatlah 1 folder baru dalam folder "3-Tugas-mysql"

3-Tugas-mysql/ 
    erd.jpeg
     jawaban.txt

2. Kerjakan Soal di bawah ini

soal 1

membuat ERD/ Skema Database dari Website Review Film

Description: 

Sebuah Website Review Film seperti Metacritic/IMDB/Rotten Tomatoes dimana setiap user dapat memberi rating pada setiap film dan dapat melihat informasi tentang film tersebut

Ketentuan Website Review Film:

Setiap user hanya dapat memiliki satu profil 
Setiap genre memiliki banyak film
Setiap user dapat memberikan kritik beserta rating dalam setiap film, dan setiap film dapat dikritik dan diberi rating oleh banyak user
Setiap cast dapat memiliki peran dalam setiap film, dan film juga dapat memiliki banyak cast beserta peran
Requirement (untuk foreign key dan primary key pada setiap tabel dibawah silahkan isi sesuai ketentuan diatas):

Data di table profile : id, age, biodata, address
Data di table user: id, username, email, password
Data di table cast : id, name, age, biodata
Data di table role(peran): id, name
Data di table review: id, rating, critics
Data di table movie : id, title, summary, year, poster
Data di table genre: id, name
tabel pada skema database bukan wajib 6 tabel, sesuaikan dengan ketentuan, jika memang harus lebih dari 6 tabel silahkan tambahkan tabel baru

soal 2

buat file jawaban.txt yang nanti sintaxnya di copy di jawaban.txt yang disimpan di folder  "3-Tugas-mysql"

contoh file jawaban.txt:

a. Buat Table

table movie
table genre

b, insert data

table movie
table genre

c. Select data

table semua movie bedasarkan genre
join table
 

Soal

a. Buatlah Table movie dan Genre pada ERD yang sudah dibuat masukan sintax jawaban ke jawaban.txt

b. insert data dan masukan sintax yang berhasil pada jawaban.txt

table genre yaitu genre action dan drama
table movie insert 2 data dengan genre action dan 3 data dengan genre drama
c. Select data

tampilan semua movie dengan genre action
lakukan join untuk mengabungkan table movie dan genre 
 

3. Kumpulkan tugas

Lalu update tugasnya ke repository masing-masing. Selanjutnya kumpulkan tugas Anda dengan melakukan copy link commit terakhir yang telah dibuat dari halaman repository project gitlab/github ke akun Anda di https://sanbercode.com/