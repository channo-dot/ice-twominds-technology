<?php session_start();  ob_start();
include_once("include/MysqliDB.php");
include_once("include/conn.php");
include_once("include/functions.php");


?>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>reset password</title>

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
			  
			  code has been sent to your email
			  please enter
            
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
                <input type="text" class="form-control" placeholder="security code" name="email" required="" />
              </div>
              
              <div>
                <input type="submit" class="btn btn-default submit" value="submit">
                
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
