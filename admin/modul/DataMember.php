<?php
 if(!isset($_GET['action'])){
?>
<!-- tampil data berupa tabel -->
<div class="row">
        <div class="col-md-12">
            <!-- <a href="?modul=<?php echo $_GET['modul']; ?>&action=add" class="btn btn-primary btn-sm mb-1">Tambah Data</a> -->
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="6%">No.</th>
                        <th width="10%">Kode Member</th>
                        <th>Nama Member</th>                        
                        <th width="16%">Email</th>
                        <th width="15%">No.Telepon</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $statement_sql = $cn_mysql->prepare("select * from mst_member");
                    $statement_sql->execute();
                    $result = $statement_sql->get_result();
                    while($data = $result->fetch_assoc())
                    {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['membercode'];  ?></td>
                        <td><?= $data['name_mb']?></td>
                        <td><?= $data['email_mb']?></td>
                        <td><?= $data['telp_mb']; ?></td>
                        <td>
                            <a href="?modul=<?php echo $_GET['modul']; ?>&action=edit&id=<?php echo $data['membercode']; ?>" class="btn btn-primary btn-sm" title="Detail Data"><i class="bi bi-file-text-fill"></i></a>
                            <a href="modul/DataMember.php?action=delete&id=<?= $data['membercode']; ?>" class="btn btn-danger btn-sm" title="Hapus Data"><i class="bi bi-trash3-fill"></i></a>
                        </td>
                    </tr>
                    <?php $no++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
 } 
 else{ 
    if($_GET['action']=="edit"){
        //buat variabel untuk value form disini
       $proses = $_GET['action'];//variabel ini digunakan untuk membedakan ketika memproses ubah data
       $keyid = $_GET['id']; //menampung value dari variabel id yg di url
       //proses mengambill data
        $statement_sql = $cn_mysql->prepare("select * from mst_member where membercode='".$_GET['id']."'");
        $statement_sql->execute();
        $result = $statement_sql->get_result();
        $data = $result->fetch_assoc();
    }
    else if($_GET['action']=="delete"){
        header("Location: modul/KategoriProses.php?proses=delete&id=".$_GET['id']."");
        exit();
    }
 ?>
 <div class="row pb-2">
    <div class="col-md-3"><b>Kode Member </b></div>
    <div class="col-md-6">: <?= $data['membercode']; ?></div>
 </div>
 <div class="row pb-2">
    <div class="col-md-3"><b>Nama</b></div>
    <div class="col-md-6">: <?= $data['name_mb']; ?></div>
 </div>
 <div class="row pb-2">
    <div class="col-md-3"><b>Tanggal Lahir</b></div>
    <div class="col-md-6">: <?= $data['datebirth_mb']; ?></div>
 </div>
 <div class="row pb-2">
    <div class="col-md-3"><b>Email (<i>Username</i>)</b></div>
    <div class="col-md-6">: <?= $data['email_mb']; ?></div>
 </div>
 <div class="row pb-2">
    <div class="col-md-3"><b>No. Telepon </b></div>
    <div class="col-md-6">: <?= $data['telp_mb']; ?></div>
 </div>
 <div class="row pb-2">
    <div class="col-md-3"><b>Alamat</b></div>
    <div class="col-md-6">: <?= $data['address_mb']; ?></div>
 </div>
 <div class="row pb-2">
    <div class="col-md-3"><b>Tanggal Daftar</b></div>
    <div class="col-md-6">: <?= $data['date_reg']; ?></div>
 </div>
 <br>
 <a href="?modul=DataMember" class="btn btn-sm btn-dark"> Kembali</a>

 <?php }