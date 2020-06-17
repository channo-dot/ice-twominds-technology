<?php 
session_start();  ob_start();
include_once("admin/include/MysqliDB.php");
include_once("admin/include/conn.php");
include_once("admin/include/functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["email"]) && isset($_REQUEST["password"]))
{
	 $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
     $email = filter_var($email, FILTER_VALIDATE_EMAIL);
     $db->where("email",$email);
	 $db->where("password", md5($password));
	 $data = $db->getOne("users");
		
		if($db->count > 0)
		{
			if(strcmp($password,$data["password"]))
			{
				
			 
			   $_SESSION['uauth'] = $data["id"];
			   $_SESSION["role"] = $data["role"];
			   
			  ?>
			  <script>
                    window.location.href="dashboard.php";
            </script>
            <?php 
			}
			else {
				$error_msg[] = "Invalid Username or Password";
			}
		}
		else{
			$error_msg[] = "Invalid Username or Password";
		}
		
	  if(isset($error_msg) && is_array($error_msg) && sizeof($error_msg) > 0) {
				  
				  foreach($error_msg as $val)
				  {
					 echo "<div  class='alert alert-warning'>$val</div>";
				  }
			  }
}	
?>

