<?php
require_once("../../config/koneksidb.php");
require_once("../../config/general.php");

$tgl =  $_POST["namaproduk"]." ".date("h:i:s");
//proses insert
if(isset($_POST['proses']) && $_POST['proses'] == "add"){
    $kategori = $_POST['kategori'];
    $namaproduk = $_POST['namaproduk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $created_date = $_POST['created_date'];
    $created_by = $_POST['created_by'];
    $update_by = $_POST['update_by'];
    $update_date = $_POST['update_date'];
    //start - proses upload
    //$_FILES['name dari attribut form']
    $file_gb = $_FILES['gambarproduk'];
    // var_dump($file_gb);
    /*tentukan folder lokasi direktori penyimpanan file */
    $targetfolder = "../../assets/img_product/";
    /*tujuan folder penyimpanan file dan nama file di server*/
    $target_file = $targetfolder.$file_gb['name'];
    //validasi ukuran file yang diupload maksimal 5Mb
    $isupload = 0; //variabel untuk membantu proses validasi
    if($file_gb['size'] > 5000000){
        notif("Silahkan Upload Ulang, Maksimal file 5Mb");
        $isupload = 0;
        back("../home.php?modul=DataProduk&action=add");
    }
    else{
        $isupload = 1;
    }
    //validasi format atau tipe file yang diupload, hanya untuk pdf, doc, png, jpg
    //menggunakan fungsi pathinfo(namafile,  PATHINFO_EXTENSION)
    $tipefile = pathinfo($file_gb['name'], PATHINFO_EXTENSION);
    if($tipefile == "pdf" || $tipefile == "doc" || $tipefile == "png" || $tipefile == "jpg"){
        $isupload = 1;
    }
    else{
        notif("Tipe file tidak sesuai, Silahkan upload kembali");
        $isupload = 0;
        back("../home.php?modul=DataProduk&action=add");
    }
    //proses upload
    if($isupload == 1){
        if(move_uploaded_file($file_gb['tmp_name'], $target_file)){
            $nama_file = $file_gb['name'];
            $statement_sql = $cn_mysql->prepare("insert into product
                (idcategory_fk, name_product, price, stok, description, created_date, created_by, update_by, 
                update_date, is_active, productfile) 
                values($kategori, '".$namaproduk."', ".$harga.", ".$stok.",'".$deskripsi."', '".$created_date."', 
                '".$created_by."', '".$update_by."', '".$update_date."', 1, '$nama_file')");
            if($statement_sql->execute()){
                back("../home.php?modul=DataProduk");
                notif("Data Produk Berhasil Tersimpan");
            }
            else {
                back("../home.php?modul=DataProduk&action=add");
                notif("Data Produk GAGAL Tersimpan");
            }
            $statement_sql->close();  
        }
        else{
           notif("file gagal terupload ke server, ulangi kembali"); 
        }
    }
    //end - proses upload
}

else if(isset($_POST['proses']) && $_POST['proses'] == "edit"){
    $kategori = $_POST['kategori'];
    $namaproduk = $_POST['namaproduk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $created_date = $_POST['created_date'];
    $created_by = $_POST['created_by'];
    $update_by = $_POST['update_by'];
    $update_date = $_POST['update_date'];
    $file_gb = $_FILES['gambarproduk'];
    if(empty($file_gb['name'])){
        echo "lama";
        $nama_file = $_POST['gambarlama'];
    }
    else{
        echo "baru";
        /*tentukan folder lokasi direktori penyimpanan file */
        $targetfolder = "../../assets/img_product/";
        /*tujuan folder penyimpanan file dan nama file di server*/
        $target_file = $targetfolder.$file_gb['name'];
        //validasi ukuran file yang diupload maksimal 5Mb
        $isupload = 0; //variabel untuk membantu proses validasi
        if($file_gb['size'] > 5000000){
            notif("Silahkan Upload Ulang, Maksimal file 5Mb");
            $isupload = 0;
            back("../home.php?modul=DataProduk&action=add");
        }
        else{
            $isupload = 1;
        }
        //validasi format atau tipe file yang diupload, hanya untuk pdf, doc, png, jpg
        //menggunakan fungsi pathinfo(namafile,  PATHINFO_EXTENSION)
        $tipefile = pathinfo($file_gb['name'], PATHINFO_EXTENSION);
        if($tipefile == "pdf" || $tipefile == "doc" || $tipefile == "png" || $tipefile == "jpg"){
            $isupload = 1;
        }
        else{
            notif("Tipe file tidak sesuai, Silahkan upload kembali");
            $isupload = 0;
            back("../home.php?modul=DataProduk&action=add");
        }
        if($isupload == 1){
            //upload file baru
            move_uploaded_file($file_gb['tmp_name'], $target_file);
            //hapus file lama
            unlink("".$targetfolder.$_POST['gambarlama']."");
            $nama_file = $file_gb['name'];
        }
        else{
            notif("file gagal terupload ke server, ulangi kembali"); 
        }
    }

    $statement_sql = $cn_mysql->prepare("UPDATE product SET
        idcategory_fk =".$kategori.", name_product ='".$namaproduk."', price =".$harga.", stok =".$stok.", 
        description ='".$deskripsi."', update_by ='".$update_by."', update_date ='".$update_date."', productfile= '".$nama_file."'
         WHERE idproduct = ".$_POST['keyid']."");
    if($statement_sql->execute()){
        back("../home.php?modul=DataProduk");
        notif("Ubah Data Produk Berhasil Tersimpan");
    }
    else {
        back("../home.php?modul=DataProduk");
        notif("Ubah Data Produk GAGAL Tersimpan");
    }
    $statement_sql->close();
}

else if(isset($_GET['proses']) && $_GET['proses'] == "delete"){
    $statement_sql = $cn_mysql->prepare("UPDATE product SET is_active=0 WHERE idproduct=".$_GET['id']."");
    if($statement_sql->execute()){
        back("../home.php?modul=DataProduk");
        notif("Hapus Data Produk Berhasil");
    }
    else {
        back("../home.php?modul=DataProduk");
        notif("Gagal Hapus Data Produk");
    }
    $statement_sql->close();
}

?>