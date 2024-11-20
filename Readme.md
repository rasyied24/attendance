# Cara Menjalankan Web Aplikasi Attendance

 1. Clone repository into device. `https://github.com/rasyied24/attendance.git`
 2. `cd` ke dalam repository
 3.  buatlah .env file di root folder copy local.env ke .env
 4. Ubah environtment Mail (untuk developer menggunakan [Mailtrap: Email Delivery Platform](https://mailtrap.io/))
 5. Jalankan perintah composer install
 6. Jalankan php artisan migrate untuk migrate database
 7. Jalankan php artisan migrate:seed untuk membuat User dengan role admin atau import data sql di folder database/attendance.sql ke sebuah database dengan nama attendance di postgreSQL
 8. jalankan perintah php artisan serve.


### Menggunakan Docker
1. Clone repository into device. `https://github.com/rasyied24/attendance.git`
2. `cd` into the repository
3. Install image yang di perlukan (php:8.2-fpm , nginx , postgres)
4. Jalankan perintah `docker compose up -d`


# Fitur Web Aplikasi Attendance

1. Login Multiple User (Admin, User), Logout
2. Untuk transaksi email menggunakan mailtrap sanbox
3. Lihat data user, Create Employee, Update Employee
4. Checking login antara user dan admin
note: saat register employee oleh admin authentication (password) akan dikirimkan ke email employee yang akan digunakan oleh employee untuk melakukan absensi (attendance).