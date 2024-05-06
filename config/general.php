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