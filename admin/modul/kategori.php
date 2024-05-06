<?php
 if(!isset($_GET['action'])){
 ?>
    <div class="row">
        <div class="col-md-12">
            <a href="?modul=<?php echo $_GET['modul']; ?>&action=add" class="btn btn-primary btn-sm mb-1">Tambah Data</a>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="6%">No.</th>
                        <th>Nama Kategori</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $statement_sql = $cn_mysql->prepare("select * from product_category where isactive=1");
                    $statement_sql->execute();
                    $result = $statement_sql->get_result();
                    while($data = $result->fetch_assoc())
                    {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data['category_name']; ?></td>
                        <td>
                            <a href="?modul=<?php echo $_GET['modul']; ?>&action=edit&id=<?php echo $data['categoryid']; ?>" class="btn btn-primary btn-sm" title="Ubah Data"><i class="bi bi-pencil-square"></i></a>
                            <a href="?modul=<?php echo $_GET['modul']; ?>&action=delete&id=<?php echo $data['categoryid']; ?>" class="btn btn-danger btn-sm" title="Hapus Data"><i class="bi bi-trash3-fill"></i></a>

                            <!-- <a href="modul/KategoriProses.php?action=delete&id=<?php echo $data['categoryid']; ?>" class="btn btn-danger btn-sm" title="Hapus Data"><i class="bi bi-trash3-fill"></i></a> -->
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
    if($_GET['action']=="add"){
        //buat variabel untuk value form disini
        $proses = "add"; //variabel ini digunakan untuk membedakan ketika memproses simpan data
        $nama = "";
        $keyid = 0; 
        
    }
    else if($_GET['action']=="edit" || $_GET['action']=="delete"){
        //buat variabel untuk value form disini
       $proses = $_GET['action'];//variabel ini digunakan untuk membedakan ketika memproses ubah data
       $keyid = $_GET['id']; //menampung value dari variabel id yg di url
       //proses mengambill data
        $statement_sql = $cn_mysql->prepare("select * from product_category where categoryid=".$_GET['id']."");
        $statement_sql->execute();
        $result = $statement_sql->get_result();
        $data = $result->fetch_assoc();
        $nama = $data['category_name'];
    }
    else if($_GET['action']=="delete"){
        header("Location: modul/KategoriProses.php?action=delete&id=".$_GET['id']."");
        exit();
    }
?>
<form action="modul/KategoriProses.php" method="POST">
    <input type="hidden" name="proses" value="<?php echo $proses; ?>">
    <input type="hidden" name="keyid" value="<?php echo $keyid; ?>">
    <div class="row">        
        <label class="col-md-2">Nama Kategori</label>
        <div class="col-md-5">
            <input type="text" name="namakategori" class="form-control input-sm" value="<?php echo $nama; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-5">
            <hr>
            <button type="reset" class="btn btn-sm btn-secondary"><i class="bi bi-x-circle-fill"></i> Batal</button>
            <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-save-fill"></i> Simpan Data</button>
            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus Data</button>
        </div>
    </div>
</form>

<?php } ?>
