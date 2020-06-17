<?php 
include_once("admin/include/MysqliDB.php");
include_once("admin/include/conn.php");
include_once("admin/include/functions.php");

?>

<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/css/sidebar.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Flattern - v2.0.0
  * Template URL: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<?php include_once("include/header.php");

if(isset($_SESSION["uauth"]))
	$uid = $_SESSION["uauth"];
else
	header("location:index.php");
$msg = 0;
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["new_pass"]) && isset($_REQUEST["current_pass"]))
{
	extract($_REQUEST);
	$new_pass = md5($new_pass);
	$db->where("id",$uid);
	$db->where("password",$new_pass);
	$db->getOne("users");
	if($db->count >=1){
	     $data = array("password"=>md5($new_pass));
	     $db->where("id",$uid);
	   if($db->update("users",$data))
		   $msg = "Password updated successfully!";
	} else {
		 $msg = "Invalid current password";
		
	}
}
?> 
<!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Dashboard</h2>
          <ol>
            <li><a href="index.html">Login</a></li>
            <li>Dashboard</li>
          </ol>
        </div>
<?php
   $db->where("id",$uid);
   $data = $db->getOne("users");
   
?>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
	
      <div class="container">
	   Welcome! <b><?php echo  $data["fname"]. " ".$data["lname"]; ?><b>

        <div class="row">
          
          
        
          
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

      

        <div class="row" style="margin-right: 281px;">
          <div class="sidebar" data-aos="fade-right" style="height:300px;float:left">
                  <?php include_once("include/sidebar.php"); ?>           

          </div>
          <div class="col-lg-7 ml-auto" data-aos="fade-left" data-aos-delay="100" style="float:left;">
            <div class="tab-content" style="hight:600px !important">
			
			<?php
			if($msg!="0")
				echo $msg;
      ?>
   
		<form action="" method="post" role="form"  id="form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="password" name="new_pass" class="form-control" id="new_pass" placeholder="New Password" data-rule="required" data-msg="Please enter new password" />
                  <div class="validate" id="new_passe"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="password" class="form-control" name="confirm_pass" id="confirm_pass" placeholder="Confirm Password" data-rule="required" data-msg="Please enter a valid email" />
                  <div class="validate" id="confirm_passe"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="current_pass" id="current_pass" placeholder="Current Password" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate" id="current_passe"></div>
              </div>
              
              
              <div class="text-center"><button name="change" id="update" class="btn btn-primary" type="submit">Change Password</button></div>
            </form>
			
			

			
              
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 <?php include_once("include/footer.php"); ?>
 <!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
 <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
<script>
$(document).ready(function(){
	$("#update").click(function(){
		var chk,new_pass,confirm_pass,current_pass;
		chk = 1;
		new_pass = $("#new_pass").val();
		confirm_pass = $("#confirm_pass").val();
		current_pass = $("#current_pass").val();
		if(new_pass=="") {
		  $("#new_passe").html("Please enter value").css('color','red');
		  chk = 0;
		}
		if(confirm_pass=="") {
		  $("#confirm_passe").html("Please enter value").css('color','red');
		  chk = 0;
		}
		if(current_pass=="") {
		  $("#current_passe").html("Please enter value").css('color','red');
		  chk = 0;
		}
		if(new_pass!=confirm_pass){
		  $("#current_passe").html("Password must match").css('color','red');
		  chk = 0;
		}
		if(chk==0)
			return false;
		else 
			$("#form").submit();
	});
});
</script>
</html>