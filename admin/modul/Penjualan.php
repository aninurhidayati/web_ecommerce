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
                        <th width="3%">No.</th>
                        <th width="10%">Tanggal</th>
                        <th width="10%">No.Invoice</th>
                        <th width="14%">Pelanggan</th>
                        <th width="10%">Total</th>
                        <th width="10%">Pembayaran</th>
                        <th width="3%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $statement_sql = $cn_mysql->prepare("select * from penjualan_head");
                    $statement_sql->execute();
                    $result = $statement_sql->get_result();
                    while($data = $result->fetch_assoc())
                    {
                    ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['date_trans'];  ?></td>
                        <td><?= $data['no_invoice']?></td>
                        <td><?= $data['cust_name']?></td>
                        <td><?= $data['total_trans']; ?></td>
                        <td><?= $data['payment_status']; ?></td>
                        <td>
                            <a href="?modul=<?php echo $_GET['modul']; ?>&action=edit&id=<?php echo $data['no_invoice']; ?>" class="btn btn-primary btn-sm" title="Ubah Data"><i class="bi bi-pencil-square"></i></a>
                            <a href="modul/DataProdukProses.php?action=delete&id=<?= $data['no_invoice']; ?>" class="btn btn-danger btn-sm" title="Hapus Data"><i class="bi bi-trash3-fill"></i></a>
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
        //
    }
    else if($_GET['action']=="edit"){
        //buat variabel untuk value form disini
       $proses = $_GET['action'];//variabel ini digunakan untuk membedakan ketika memproses ubah data
       $keyid = $_GET['id']; //menampung value dari variabel id yg di url

    }
    else if($_GET['action']=="delete"){
        header("Location: modul/PenjualanProses.php?action=delete&id=".$_GET['id']."");
        exit();
    }

 ?>
<!-- tampil form  -->
<form action="modul/DataProdukProses.php" method="POST">
    <input type="hidden" name="proses" value="<?php echo $proses; ?>">
    <input type="hidden" name="keyid" value="<?php echo $keyid; ?>">
    <div class="row pb-1">        
        <label class="col-md-2">No. Invoice</label>
        <div class="col-md-3">
            <input type="text" name="no_invoice" value="<?= generate_no_invoice(); ?>" class="form-control input-sm" readonly >
        </div>
        <label class="col-md-1">Tanggal</label>
        <div class="col-md-2">
            <input type="date" name="tgl_trans" class="form-control input-sm" >
        </div>
    </div>
    <div class="row pb-1">        
        <label class="col-md-2">Nama Pelanggan</label>
        <div class="col-md-6">
            <select name="nama_pel" required  class="form-control input-sm" >
                <option value="">--Pilih Pelanggan--</option>
            </select>
        </div>
    </div>
    <div class="row pb-1">        
        <label class="col-md-2">No. Telepon</label>
        <div class="col-md-6">
            <input type="text" name="telp_cust" value="<?= $proses; ?>" required  class="form-control input-sm" >
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped table-hover">
                <tr>
                    <th colspan="5">Data Barang</th>
                </tr>
                <tr>
                    <th width="3%">No</th>
                    <th>Nama Barang</th>
                    <th width="20%">Harga</th>
                    <th width="5%">Jumlah</th>
                    <th width="20%">Subtotal</th>
                </tr>
                <tr>
                    <td>
                       #
                    </td>
                    <td> 
                        <select class="form-control input-sm">
                            <?php
                            $statement_sql = $cn_mysql->prepare("select a.* from product a where is_active=1");
                            $statement_sql->execute();
                            $result = $statement_sql->get_result();
                            while($data = $result->fetch_assoc())
                            {
                                echo "<option value='".$data['idproduct']."'>".$data['name_product']."</option>";
                            }   
                            ?>
                        </select> 
                    </td>
                    <td> <input type="text" class="form-control input-sm" readonly>  </td>
                    <td> <input type="text" class="form-control input-sm">  </td>
                    <td> <input type="text" class="form-control input-sm" readonly>  </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row pb-1">        
        <label class="col-md-2">Bukti Pembayaran</label>
        <div class="col-md-6">
            <input type="file" name="buktibayar" value="<?= $proses; ?>" required  class="form-control input-sm" >
        </div>
    </div>
    <div class="row pb-1">        
        <label class="col-md-2">Status Pembayaran</label>
        <div class="col-md-3">
            <select name="status_bayar" class="form-control input-sm" >
                <option>--Pilih Status--</option>
                <option value="Belum Lunas">Belum Lunas</option>
                <option value="Lunas">Lunas</option>
            </select>
        </div>
        <label class="col-md-1 pt-1">Nominal</label>
        <div class="col-md-2">
            <input type="number" name="nominalbayar" value="<?php echo $proses; ?>" disabled class="form-control input-sm" >
        </div>
    </div>
    <div class="row pb-1">        
        <label class="col-md-2">Status Pengiriman</label>
        <div class="col-md-6">
            <select name="status_bayar" class="form-control input-sm" >
                <option>--Pilih Status Pengiriman--</option>
                <option value="Belum Lunas">Belum Lunas</option>
                <option value="Lunas">Lunas</option>
            </select>        
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
</form>


 <?php
 }
 ?>