
<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    

	<section style="height:80%">
        <div class="map" id="address2_map" style="height:100%;">
        </div>
    </section>

<form action="updateimage.php" id="form" method="get" >
		<input type="hidden" name="address" id="address" value="<?php echo $_GET['oldaddress']; ?>">
		<input type="hidden" name="area" id="area" value="<?php echo $_GET['area']; ?>">
		<input type="hidden" name="lat" id="lat" value="<?php echo $_GET['oldLat']; ?>">
		<input type="hidden" name="lng" id="lng" value="<?php echo $_GET['oldLong']; ?>">
		<input type="hidden" name="polygonArray" id="polygonArray" value="<?php echo urlencode($_GET['polygonArray']); ?>">
		<input type="hidden" id="direction" name="direction">	
		<input type="hidden"  name="polygon" id="get_polygonarray">
			<input type="hidden" name="uid" value="<?php echo $_GET["uid"]; ?>">
		<input type="submit" value="Save" name="save" class="btn btn-primary">
	</form>
	

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4WHOh4I5S3ntT4X5TCymibUiLF8DMIWc&libraries=drawing,geometry,places"></script>
	<script>
		var lat = <?php echo $_GET['oldLat']; ?>;
		var lng = <?php echo $_GET['oldLong']; ?>;

		// var triangleCoords = JSON.parse(<?php //echo json_encode($_GET['polygonArray']); ?>);
		// console.log(triangleCoords);

		// for (var i = 0; i < triangleCoords.length; i++) {
		// 	console.log(triangleCoords[i]);
		// 	console.log (triangleCoords[i].toString().split(",")[0]);
		// 	console.log (triangleCoords[i].toString().split(",")[1]);
		// 	// points.push({
		// 	// lat: triangleCoords[i][0],
		// 	// lng: triangleCoords[i][1]
		// 	// });
		// }

		function initMap() {
		var map = new google.maps.Map(document.getElementById('address2_map'), {
			zoom: 18,
			center: {
			lat: lat,
			lng: lng
			},
			mapTypeId: google.maps.MapTypeId.HYBRID
		});
		
		
		
	
	
		// Define the LatLng coordinates for the polygon's path.
		// var triangleCoords = [
		// 	[25.774, -80.190],
		// 	[18.466, -66.118],
		// 	[32.321, -64.757],
		// 	[25.774, -80.190]
		// ];

			// console.log(<?php //echo $_GET['polygonArray']; ?>);
		// var triangleCoords = JSON.parse(<?php //echo $_GET['polygonArray']; ?>);
		// console.log(triangleCoords);


		var triangleCoords = JSON.parse(<?php echo json_encode($_GET['polygonArray']); ?>);
       
		var points = [];
		var mypolygon = "";
		
	var latlang  =	triangleCoords.join("|");
	
		for (var i = 0; i < triangleCoords.length; i++) {
			// console.log(triangleCoords[i][0]);
			var newLat = parseFloat(triangleCoords[i].toString().split(",")[0]);
			var newLng = parseFloat(triangleCoords[i].toString().split(",")[1]);
            
            
			points.push({
			lat: newLat,
			lng: newLng
			});
			
			if(i==0){
			    var start_point = newLat+','+newLng;
			}
			
		
			
		}
		
		latlang = latlang+'|'+start_point;
		
		$("#get_polygonarray").val(latlang);
		
		// Construct the polygon.
		var bermudaTriangle = new google.maps.Polygon({
			paths: points,
			fillColor: '#F19200',
			fillOpacity: 0.5,
			strokeColor: '#F19200',
			strokeWeight: 4,
			clickable: false,
			editable: false,
			fillColor: '#F19200',
			fillOpacity: 0.35,
			zIndex: 1
		});
		bermudaTriangle.setMap(map);
		}
		google.maps.event.addDomListener(window, "load", initMap);
		
		
	</script>
