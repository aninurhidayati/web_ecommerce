<?php 
$hostname  = "localhost";
$database = "db_ecomm";
$user_db = "root";
$password_db = "";
//untuk koneksi ke database mysql
$cn_mysql= new mysqli($hostname, $user_db, $password_db, $database);

if ($cn_mysql->connect_errno) {
    die("Gagal konek db". $cn_mysql->connect_error);
}
// else{
//     echo"koneksi berhasil";
// }