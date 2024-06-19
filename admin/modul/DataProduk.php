<?php
 if(!isset($_GET['action'])){
?>
<!-- tampil data berupa tabel -->
<div class="row">
        <div class="col-md-12">
            <a href="?modul=<?php echo $_GET['modul']; ?>&action=add" class="btn btn-primary btn-sm mb-1">Tambah Data</a>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="6%">No.</th>
                        <th>Nama Produk</th>
                        <th width="10%">Harga</th>
                        <th width="6%">Stok</th>
                        <th width="15%">Kategori</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $statement_sql = $cn_mysql->prepare("select a.*, b.category_name from product a, product_category b WHERE a.idcategory_fk=b.categoryid");
                    $statement_sql->execute();
                    $result = $statement_sql->get_result();
                    while($data = $result->fetch_assoc())
                    {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['name_product'];  ?></td>
                        <td><?= $data['price']?></td>
                        <td><?= $data['stok']?></td>
                        <td><?= $data['category_name']; ?></td>
                        <td>
                            <a href="?modul=<?php echo $_GET['modul']; ?>&action=edit&id=<?php echo $data['idproduct']; ?>" class="btn btn-primary btn-sm" title="Ubah Data"><i class="bi bi-pencil-square"></i></a>
                            <a href="modul/DataProdukProses.php?action=delete&id=<?= $data['idproduct']; ?>&stok=<?= $data['stok'];?>" class="btn btn-danger btn-sm" title="Hapus Data"><i class="bi bi-trash3-fill"></i></a>
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
        $keyid = 0; 
        //set value form
        $kategori = "";
        $namaproduk = "";
        $harga = "";
        $stok = "";
        $deskripsi = "";
        $created_date = date("Y-m-d h:i:s");
        $created_by = $_SESSION['userlogin'];
        $update_by = "";
        $update_date = date("Y-m-d h:i:s");     
        $fotolama = "";   
    }
    else if($_GET['action']=="edit"){
        //buat variabel untuk value form disini
       $proses = $_GET['action'];//variabel ini digunakan untuk membedakan ketika memproses ubah data
       $keyid = $_GET['id']; //menampung value dari variabel id yg di url
       //proses mengambill data
       $statement_sql = $cn_mysql->prepare("select * from product where idproduct=".$keyid."");
       $statement_sql->execute();
       $result = $statement_sql->get_result();
       $data = $result->fetch_assoc();
       //set value form
       $kategori = $data['idcategory_fk'];
       $namaproduk = $data['name_product'];
       $harga = $data['price'];
       $stok = $data['stok'];
       $deskripsi = $data['description'];
       $created_date = $data['created_date'];
       $created_by =$data['created_by'];
       $update_by = $_SESSION['userlogin'];
       $update_date = date("Y-m-d h:i:s");  
       $fotolama = $data['productfile'];
    }
    else if($_GET['action']=="delete"){
        header("Location: modul/DataProdukProses.php?action=delete&id=".$_GET['id']."");
        exit();
    }
?>
<!-- tampil form  -->
<form action="modul/DataProdukProses.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="proses" value="<?php echo $proses; ?>">
    <input type="hidden" name="keyid" value="<?php echo $keyid; ?>">
    <div class="row">
        <div class="col-md-9">
            <div class="row pb-1">        
                <label class="col-md-3">Kategori Produk</label>
                <div class="col-md-5">
                    <select class="form-control" name="kategori" required oninvalid="">
                        <option value="">-Pilih Kategori-</option>
                        <?php
                        //mendapatkan data kategori
                        $sql_category = $cn_mysql->prepare("select * from product_category where isactive=1");
                        $sql_category->execute();
                        $result_category = $sql_category->get_result();
                        while($d = $result_category->fetch_assoc())
                        {
                            if($kategori == $d['categoryid']) $sel= "Selected"; else $sel="";
                            echo "<option value='".$d['categoryid']."' ".$sel.">".$d['category_name']."</option>";
                        }	
                        ?>
                        
                    </select>
                </div>
            </div>
            <div class="row pb-1">        
                <label class="col-md-3">Nama Produk</label>
                <div class="col-md-7">
                    <input type="text" name="namaproduk" onchange="konversitext(this.value)" value="<?php echo $namaproduk; ?>" required  class="form-control input-sm" >
                </div>
            </div>
            <div class="row pb-1">        
                <label class="col-md-3">Harga</label>
                <div class="col-md-4">
                    <input type="number" name="harga" value="<?php echo $harga; ?>" required  class="form-control input-sm" >
                </div>
                <label class="col-md-1 pt-1">Stok</label>
                <div class="col-md-2">
                    <input type="number" name="stok" value="<?php echo $stok; ?>" required  class="form-control input-sm" >
                </div>
            </div>
            <div class="row pb-1">        
                <label class="col-md-3">Deskripsi</label>
                <div class="col-md-7">
                    <textarea name="deskripsi" class="form-control input-sm" rows="7" required><?php echo $deskripsi; ?> </textarea>
                </div>
            </div>  
            <div class="row pb-1">        
                <label class="col-md-3">Upload Gambar Produk</label>
                <div class="col-md-7">
                    <input type="file" name="gambarproduk"  value="<?php echo $namaproduk; ?>"   class="form-control input-sm" >
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <input type="hidden" name="created_date" value="<?php echo $created_date; ?>">
                    <input type="hidden" name="created_by" value="<?php echo $created_by; ?>">
                    <input type="hidden" name="update_by" value="<?php echo $update_by; ?>">
                    <input type="hidden" name="update_date" value="<?php echo $update_date; ?>">
                </div>
                <div class="col-md-5">
                    <hr>
                    <button type="reset" class="btn btn-sm btn-secondary"><i class="bi bi-x-circle-fill"></i> Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-save-fill"></i> Simpan Data</button>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <input type="hidden" name="gambarlama" value="<?= $fotolama; ?>">
            <img src="../assets/img_product/<?= $fotolama; ?>" alt="" srcset="" width="200">
        </div>
    </div>
</form>
<?php 
} ?>