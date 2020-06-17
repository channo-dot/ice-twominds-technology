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
extract($_REQUEST);
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["update"]))
{

	$data = array(
	  "fname" => $fname,
	  "lname" => $lname, 
	  "email" => $email,
	  "phone" => $phone 
	  );
	$uid = $_SESSION['uauth'];	
	$db->where("id",$uid);
	if($db->update("users",$data)) {
	  $msg = "Data Updated successfully";
	}
	else {
        $msg = "Please enter valid data";
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
                  <?php include_once("include/sidebar.php"); 
				  $db->where("uid",$uid);
				  $user_details = $db->getOne("user_info");
				  ?>           

          </div>
		  
          <div class="col-lg-7 ml-auto" data-aos="fade-left" data-aos-delay="100" style="float:left;">
			<?php
			 if($msg !="0") { ?>
			 <div class="alert alert-success" role="alert">
			  <?php echo $msg; ?>
			 </div>
			 <?php } ?>
			<form action="editprofile.php" method="post">
		  <table class="table">
				<tr><td>Fname</td><td><input type="text" value="<?php echo $data["fname"]; ?>" class="form-control" name="fname"></td></tr>
				<tr><td>Lname</td><td><input type="text" value="<?php echo $data["lname"]; ?>" class="form-control" name="lname"></td></tr>
				<tr><td>Email</td><td><input type="email" value="<?php echo $data["email"]; ?>" class="form-control" name="email"></td></tr>
				<?php
				if($_SESSION["role"]=="c") { ?>
				<tr><td>Policy Number</td><td><?php echo $user_details["pnumber"]; ?></td></tr>
				<tr><td>My Agent</td><td><a href="myagent.php?id=<?php echo $user_details["agent_id"];?>">View</a></td></tr>
				<?php } ?>
				<tr><td>Phone Number</td><td><input type="text"  value="<?php echo $data["phone"]; ?>" class="form-control" name="phone"></td></tr>
				
				<tr><td>
				<input type="submit" value="Update" name="update" class="btn btn-primary">
				</tr>
            </table>
			</form>
			
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