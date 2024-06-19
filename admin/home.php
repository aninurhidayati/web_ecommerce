<?php 
session_start();
if(isset($_SESSION['userlogin'])){
    require_once("../config/koneksidb.php"); 
    require_once("../config/general.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/adminstyle.css">
    <!-- icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body class="bg-info">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-black left-menu">
                <h4 class="pb-3 text-white text-center border-bottom"><?php  echo $company; ?> </h4>
                <!-- dari bootstrap, list group -->
                <ul class="list-group list-group-flush" id="listmenu">
                <?php
                    $statement_sql = $cn_mysql->prepare("select * from mst_menus where isactive=1");
                    $statement_sql->execute();
                    $result = $statement_sql->get_result();
                    while($d = $result->fetch_assoc())
                    {
                        echo '<li class="list-group-item"><a href="'.$d['menu_link'].'">'.$d['menu_name'].'</li>';
                    }
                    $statement_sql->close();
                    ?>
                    
                    <li class="list-group-item">
                        <i class="bi bi-box-arrow-left"></i>
                        <a href="logout.php">LOGOUT</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 p-4">
                <?php if(!isset($_GET['modul'])){ ?>
                <h5 id="title">
                    <?php title(); ?>
                    <span style="float: right;">Welcome: <?php echo $_SESSION['loginname']; ?></span>
                </h5>
                <hr>
                <h6><i id="subtitle"></i></h6>
                <?php
                    echo "
                    <ul>
                        <li>Nama Server-1: ".$_SERVER['SERVER_NAME']."</li>
                        <li>Nama Server-2: ".$_SERVER['HTTP_HOST']."</li>
                        <li>URL Aplikasi (lengkap) : ".$_SERVER['REQUEST_URI']."</li>
                        <li>URL Aplikasi (utama) : ".$_SERVER['PHP_SELF']."</li>
                        <li>Port dari aplikasi web : ".$_SERVER['SERVER_PORT']."</li>
                    </ul>
                    ";
                ?>
                <?php }  
                else { 
                    echo '
                    <h5 id="title">
                        Modul: '.title($_GET['modul']).'
                        <span style="float: right;">Welcome: '.$_SESSION['loginname'].'</span>
                    </h5>
                    <hr>
                    ';
                    include_once("modul/".$_GET['modul'].".php");
                }
                ?>
            </div>
        </div>
    </div>
    
    <!-- bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- file js -->
    <script src="../assets/validasi.js" ></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>
</html>
<?php 
} 
else {
    echo "<script>alert('Silahkan Login Terlebih Dahulu!');</script>";
    echo "<meta http-equiv=\"REFRESH\" content=\"0;url=index.php\">";
}
?>