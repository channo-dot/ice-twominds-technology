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
   $db->where("uid",$uid);
   $user_info = $db->getOne('user_info');
   $db->where("uid",$uid);
   $claim_data = $db->getOne('claims');
   $claims = $db->count;
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
            <div class="tab-content" style="hight:600px !important;width:100%;">
			
			<?php
			if($msg!="0")
				echo $msg;
       if($claims == 0) { 
	  ?>
      
        You are claiming for the Policy numebr . <?php echo $user_info["pnumber"];  ?>

		<form action="claimnow.php" method="post" role="form" class="php-email-form">
              <input type="hidden" name="pnumber" value="<?php echo $user_info["pnumber"]; ?>">
			  <input type="hidden" name="agent_id" value="<?php echo $user_info["agent_id"]; ?>">
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:30" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading"></div>
                <div class="error-message"></div>
                <div class="sent-message"></div>
              </div>
              <div class="text-center"><button  class="btn btn-primary" type="submit">Claim Now</button></div>
            </form>


	   <?php } 
			if($claim_data["status"] == "0") 
				echo "Claim waiting to be reviewed";
			else if($claim_data["status"] == "1")
				echo "your claim is accepted";
			else if ($claim_data["status"] == "3")
				echo "sorry, your claim is rejected";
						
	   ?>
			

			
              
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

</html>