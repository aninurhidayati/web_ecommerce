<?php
require_once("../config/koneksidb.php");
//untuk mendapatkan value dari inputan form dengan method POST
$out_user = $_POST['inusername'];
$out_pass = $_POST['inpassword'];
//  echo $out_user." - ".$out_pass;
//cek ke database apakah username yang ditampung variabel outuser ada/tidak?
$statement_sql = $cn_mysql->prepare("select * from mst_user where username=?");
//bagian dari kueri SQL yang menggunakan parameter untuk menghindari serangan SQL Injection
//parameter "s" maksudnya value dari parameter berupa string
$statement_sql->bind_param("s", $out_user);
//perintah untuk mengeksekusi perintah sql
$statement_sql->execute();
//untuk menampung hasil eksekusi perintah sql pada variabel $result
$result = $statement_sql->get_result();
//untuk menampung hasil query berupa jumlah row/data/records
$result_count = $result->num_rows;
if($result_count > 0){
    echo "user ada, lanjut cek password";
    // fetch_assoc(); Metode ini mengambil satu baris hasil dari objek result 
    //dalam bentuk array asosiatif, dimana kunci array adalah nama kolom & nilai array
    $data = $result->fetch_assoc();
    //proses verifikasi atau cek password yang diinput pada form sesuai atau tidak dengan
    //ditabel mst_user 
    if(password_verify($out_pass, $data['password'])){
        echo "password sesuai, login berhasil";
    }
    else{
        echo "password salah, login gagal";
    }
}
else{
    echo "Username Not Found";
}