<?php 
session_start();  ob_start();
include_once("admin/include/MysqliDB.php");
include_once("admin/include/conn.php");
include_once("admin/include/functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["email"]) )
{
	 $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
     $email = filter_var($email, FILTER_VALIDATE_EMAIL);
     $db->where("email",$email);
	 $count = $db->getOne("clients");
     if($db->count > 0)
		{ 
		   $_SESSION['code'] = rand(1000,9999);
		   $_SESSION["id"] = $count["id"];
		   echo "Password reset code has been sent to your email";
		   ?>
		   <script>
		    window.location.href="code.php";
		   </script>
		   <?php
					
		}
		else{
			echo "Email Id Not found!";
		}
		
	  
}	
?>

