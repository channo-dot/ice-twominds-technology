<!DOCTYPE html>
<html lang="en">
<?php  ob_start(); include_once("include/auth.php");

include_once("include/MysqliDB.php");
include_once("include/conn.php");

?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>All Clients</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="vendors/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
         <?php include_once("include/sidebar.php"); ?>

        <!-- top navigation -->
        <?php include_once("include/header.php"); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
         <h1>Select Address</h1>
        <div class="pull-right">
         <form method="get" id="address_form" action="address.php" >
		 <input type="hidden" name="uid" value="<?php echo $_GET["id"]; ?>">
						<div class="banner-content">
							
							<div class="input-group">
							<input id="solar_address" name="address" type="text" class="form-control search-box" placeholder="Enter Your Address..">
							<input type="hidden" name="lat" id="input-lat">
							<input type="hidden" name="lng" id="input-lng">
							<span class="input-group-btn">
								<!-- <input type="submit" class="btn btn-success btn-search" value="Kolla adressen"> -->
								<button class="btn btn-success btn-search" id="submit_button" type="submit">Address<i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
							</span>
							</div>
						</div>
					</form>
        </div>
         
       
       
        <!-- footer content -->
       <?php include_once("include/footer.php"); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables/js/dataTables.buttons.min.js')"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>





































<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4WHOh4I5S3ntT4X5TCymibUiLF8DMIWc&libraries=drawing,geometry,places"></script>
	<script>
	function initAddressField() {
		var adressInput = document.getElementById('solar_address');
		var adressAC = new google.maps.places.Autocomplete(adressInput);
		adressAC.addListener('place_changed', function() {
			var place = adressAC.getPlace();
			if (!place.geometry) {
				// User entered the name of a Place that was not suggested and
				// pressed the Enter key, or the Place Details request failed.
				
				// window.alert("No details available for input: '" + place.name + "'");
				return;
				
			}

			document.getElementById("input-lat").value = place.geometry.location.lat();
			document.getElementById("input-lng").value = place.geometry.location.lng();
			//   document.getElementById("solar_address").value = place.name+' '+place.formatted_address;
			// document.getElementById("submit_address_form").style.display = "inline-block";
		});

		// var adressInputMob = document.getElementById('solar_address_mob');
		// var adressACMob = new google.maps.places.Autocomplete(adressInputMob);
		// adressACMob.addListener('place_changed', function() {
		// 	  var place = adressACMob.getPlace();
		// 	  if (!place.geometry) {
		// 	    // User entered the name of a Place that was not suggested and
		// 	    // pressed the Enter key, or the Place Details request failed.
		// 	    window.alert("No details available for input: '" + place.name + "'");
		// 	    return;
		// 	  }

		// 	  document.getElementById("input-lat-mob").value = place.geometry.location.lat();
		// 	  document.getElementById("input-lng-mob").value = place.geometry.location.lng();
		// 	  document.getElementById("submit_address_form_mob").style.display = "inline-block";
		// });
	}
	google.maps.event.addDomListener(window, "load", initAddressField);
	</script>
					