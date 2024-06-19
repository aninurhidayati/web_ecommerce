<form action="?page=registrasi&action=simpan" method="post">
    <h3>Form Pendaftaran</h3>
    <hr>
    <div class="row mb-1">
        <label for="kodemb" class="col-md-2">Kode Member</label>
        <div class="col-md-3">
            <input type="text" name="kodemb" id="kodemb" class="form-control input-sm" value="<?= generate_no_member(); ?>" readonly>
        </div>
    </div>
    <div class="row mb-1">
        <label for="namamb" class="col-md-2">Nama Member</label>
        <div class="col-md-8">
            <input type="text" name="namamb" id="namamb" class="form-control input-sm" required onchange="lockbutton('btn-reg')" >
        </div>
    </div>
    <div class="row mb-1">
        <label for="" class="col-md-2">Email Member</label>
        <div class="col-md-8">
            <input type="email" name="emailmb" id="emailmb" class="form-control input-sm" required>
        </div>
    </div>
    <div class="row mb-1">
        <label for="" class="col-md-2">Password</label>
        <div class="col-md-3">
            <input type="password" name="pass1" id="pass1" class="form-control input-sm" required>
        </div>
        <label for="" class="col-md-2">Ulangi Password</label>
        <div class="col-md-3">
            <input type="password" name="pass2" id="pass2" class="form-control input-sm" onchange="cekpassword()" required>
        </div>
    </div>
    <div class="row mb-1">
        <label for="" class="col-md-2">No. Telepon</label>
        <div class="col-md-3">
            <input type="text" name="telponmb" id="telponmb" class="form-control input-sm" required>
        </div>
        <label for="" class="col-md-2 mb-1">Tanggal Lahir</label>
        <div class="col-md-3">
            <input type="date" name="tgllahir" id="tgllahir" class="form-control input-sm">
        </div>
    </div>
    <div class="row mb-1">
        <label for="" class="col-md-2">Alamat</label>
        <div class="col-md-8">
            <textarea name="alamatmb" id="alamatmb" class="form-control input-sm"></textarea>
        </div>
    </div>
    <div class="row mb-1" >
        <label for="" class="col-md-2"></label>
        <div class="col-md-7">
            <button type="reset" class="btn btn-sm btn-secondary"><i class="bi bi-save-fill"></i> Batal</button>
            <button type="submit" id="btn-reg" name="btn-daftar" class="btn btn-sm btn-primary"><i class="bi bi-save-fill"></i> Daftar Member</button>
        </div>
    </div>
</form>
<?php
if(isset($_GET['action']) && $_GET['action'] == "simpan" && $_GET['page'] == "registrasi"){
    $membercode = $_POST['kodemb'];
    $name = $_POST['namamb'];
    $email = $_POST['emailmb'];
    $pass = password_hash($_POST['pass2'], PASSWORD_DEFAULT);
    $datebirth = $_POST['tgllahir'];
    $address = $_POST['alamatmb'];
    $telp = $_POST['telponmb'];

    //cek email sudah terdaftar?
    $qcekemail = $cn_mysql->prepare("select email_mb from mst_member where email_mb='$email'");
    $qcekemail->execute(); $result_email = $qcekemail->get_result();
    if(($result_email->num_rows) > 0){
        back("?page=registrasi");
        notif("Email Sudah Terdaftar!!");
    } else{
        
        $statement_sql = $cn_mysql->prepare("insert into mst_member
            (membercode, name_mb, email_mb, password, datebirth_mb, address_mb, telp_mb, date_reg, isactive) 
            values('$membercode', '$name', '$email', '$pass', '$datebirth', '$address', '$telp', '".date("Y-m-d h:i:s")."',1)");
        if($statement_sql->execute()){
            back("?page=registrasi");
            notif("Data Registrasi Berhasil Tersimpan");
        }
        else {
            back("?page=registrasi");
            notif("Data Registrasi GAGAL Tersimpan");
        }
        
    }

    $statement_sql->close();  
}
else{
    echo "";
}
?>