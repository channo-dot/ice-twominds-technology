<?php
<?php 
session_start();  ob_start();
include_once("admin/include/MysqliDB.php");
include_once("admin/include/conn.php");
include_once("admin/include/functions.php");
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["code"]))
{
	if($code==$_SESSION['code']) {
	  $_SESSION['uauth'] = $_SESSION["id"];
	  ?>
	  <script>
	  window.location.href="changepassword.php";
	  </script>
	  <?php
	}
}
?>