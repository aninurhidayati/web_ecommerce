<?php
session_start();
unset($_SESSION['email_mblogin'], $_SESSION['name_mblogin']);
// session_destroy();
echo "<meta http-equiv=\"REFRESH\" content=\"0;url=../index.php\">";
?>