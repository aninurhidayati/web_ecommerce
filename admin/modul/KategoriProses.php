<?php
require_once("../../config/koneksidb.php");
require_once("../../config/general.php");

if(isset($_POST['proses']) && $_POST['proses'] == "add"){
    $namax = $_POST['namakategori']; 
    $createdby = $_POST['createdby'];
    $statement_sql = $cn_mysql->prepare("insert into product_category(category_name, isactive, createdby) values(?, 1, ?)");
    $statement_sql->bind_param("ss", $namax, $createdby);
    if($statement_sql->execute()){
        back("../home.php?modul=kategori");
        notif("Data Kategori Berhasil Tersimpan");
    }
    else {
        back("../home.php?modul=kategori&action=add");
        notif("Data Kategori GAGAL Tersimpan");
    }
    $statement_sql->close();
}

if(isset($_POST['proses']) && $_POST['proses'] == "edit"){
    $namax = $_POST['namakategori'];
    $statement_sql = $cn_mysql->prepare("UPDATE product_category SET category_name=? WHERE categoryid=".$_POST['keyid']."");
    $statement_sql->bind_param("s", $namax);
    if($statement_sql->execute()){
        back("../home.php?modul=kategori");
        notif("Update Data Kategori Berhasil Tersimpan");
    }
    else {
        back("../home.php?modul=kategori&action=add");
        notif("Update Data Kategori GAGAL Tersimpan");
    }
    $statement_sql->close();
}

if(isset($_GET['proses']) && $_GET['proses'] == "delete"){
    $statement_sql = $cn_mysql->prepare("UPDATE product_category SET isactive=0 WHERE categoryid=".$_GET['id']."");
    if($statement_sql->execute()){
        back("../home.php?modul=kategori");
        notif("Hapus Data Berhasil");
    }
    else {
        back("../home.php?modul=kategori");
        notif("Gagal Hapus Data");
    }
    $statement_sql->close();
}
