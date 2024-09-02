<?php 

setcookie("userLogedin",null,time()-60*60*24*7);
header("location:login.php");

?>