<?php ob_start();
define("HOST","localhost");
define("USER","root");
define("DATABASE","insurance");
define("PASSWORD","");
$db = new MysqliDb (HOST,USER,PASSWORD,DATABASE);
$siteurlpath = "http://". $_SERVER["SERVER_NAME"]; 
extract($_REQUEST);
$pageLimit = 20;
//print_r($_REQUEST);

?>