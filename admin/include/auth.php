<?php session_start();

if(isset($_SESSION["auth"]))
 $uid = $_SESSION["auth"];
else
header("location:index.php");
//print_r($_SESSION);
?> 


