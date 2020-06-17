<?php session_start();  ob_start();
include_once("include/MysqliDB.php");
include_once("include/conn.php");
include_once("include/functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["email"]) && isset($_REQUEST["password"]))
{
	 $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
     $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg[] = '<p class="error">The email address you  entered is not valid</p>';
    } else {
		$db->where("email",$email);
		$db->where("password", md5($password));
		$data = $db->getOne("admin");
		
		if($db->count > 0)
		{
			if(strcmp($password,$data["password"]))
			{
				
			 
			   $_SESSION['auth'] = $data["id"];
			   
			  
			   header("location:dashboard.php");
			}
			else {
				$error_msg[] = "Invalid Username or Password";
			}
		}
		else{
			$error_msg[] = "Invalid Username or Password";
		}
		
	}
}	
?>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login!!</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>
<style>
a { color:black; }
</style>
  <body class="login" style=" background-image: url('img/login_background.jpg');color:black;">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
	   
        <div class="animate form login_form">
          <section class="login_content">
            <form  method="post">
			  
			
              <h1 style="color:black;">
			  
			  Log in to your dashboard here.
            
			  </h1>
			  <?php
	   
			  if(isset($error_msg) && is_array($error_msg) && sizeof($error_msg) > 0) {
				  
				  foreach($error_msg as $val)
				  {
					 echo "<div  class='alert alert-warning'>$val</div>";
				  }
			  }
					  
	   ?>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="email" required="" />
              </div>
              <div >
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
                <input type="submit" class="btn btn-default submit" value="Login">
                <a class="reset_pass" href="loastpass.php">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                  
              </div>
            </form>
          </section>
        </div>

    
      </div>
    </div>
  </body>
</html>
