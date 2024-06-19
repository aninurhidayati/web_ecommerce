<?php
$date_today = date("d-m-Y");
$date_day = date("D");
$company = "PT. ASE Software House";

//fungsi dgn parameter yg mempunyai nilai default/nilai awal
function title($tl = NULL){
    if($tl == NULL){
        echo "Tanggal hari ini: ".$GLOBALS["date_day"].", ".$GLOBALS["date_today"];
    }
    else{
        return  $tl;
    }   
}
function back($url){
    echo "<meta http-equiv=\"REFRESH\" content=\"0;url=".$url."\">";
}

function notif($pesan){
    echo "<script>alert('$pesan');</script>";
}

function generate_no_invoice(){
    $statement_sql = $GLOBALS['cn_mysql']->prepare("select no_invoice from penjualan_head");
    $statement_sql->execute();
    $result = $statement_sql->get_result();
    $result_count = $result->num_rows;
    $now = date("my");
    if($result_count < 1){
        $code_inv = "INV".$now."0001";
    }else{
        $data = $result->fetch_assoc();
        $th_lastcode = substr($data['no_invoice'], 5,2);
        $no_lastcode = substr($data['no_invoice'], 7,4);
        $no_urut = "0001";
        if($th_lastcode == date("y")){
            $no_new = $no_lastcode+1;
            if($no_new < 10){
                $no_urut = "000".$no_new;
            }
            else if($no_new < 100){
                $no_urut = "00".$no_new;
            }
            else if($no_new < 1000){
                $no_urut = "0".$no_new;
            }
            else if($no_new < 10000){
                $no_urut = $no_new;
            } 
            $code_inv = "INV".date("m").$th_lastcode.$no_urut;
        }
        else{
            $code_inv = "INV".date("my").$no_urut;
        }        
    }

    return $code_inv;
}

function generate_no_member(){
    //ambil data kode member yang paling terakhir
    //$GLOBAL['namavariabel tanpa tanda $'] , fungsinya agar suatu variabel dapat diakses secara global
    //termasuk dalam sebuah fungsi, tanpa harus membuat ulang variabel yg sama
    $statement_sql = $GLOBALS['cn_mysql']->prepare("select membercode from mst_member 
            order by membercode DESC LIMIT 1");
    $statement_sql->execute();
    $paket = $statement_sql->get_result();
    $cekpaket = $paket->num_rows; /*untuk pengecekkan ada data atau tidak di tabel, hasilnya berupa angka */
    if($cekpaket > 0){
        //jika sudah ada data ditabel mst_member
        $bukapaket = $paket->fetch_assoc();    
        $isipaket = $bukapaket['membercode'];
        $tahun_sekarang = date("y");
        $tahun_ditabel = substr($isipaket,4,2);
        if($tahun_ditabel == $tahun_sekarang){
            $nourut = substr($isipaket, 6,3) + 1;
            if($nourut < 10){
                $nourut_baru = "00".$nourut;
            }
            else if($nourut < 100){
                $nourut_baru = "0".$nourut;
            }
            else if($nourut < 1000){
                $nourut_baru = $nourut;
            }
            //generate kode dg tahun sama
            $kodemember = "MB".date("m").$tahun_ditabel.$nourut_baru;
        }
        else{
            //genearate kode tahun berubah, reset ke 001
            $kodemember = "MB".date("my")."001";
        }

        
    }else{
        //jika belum ada data ditabel mst_member
        $kodemember = "MB".date("my")."001";
    }  
    return $kodemember;
}