	<?php
	include_once('include/MysqliDB.php');
include_once("include/conn.php");
		//require_once('header.php');
		
	?>
	
     <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	
    
	<!-- Address Box -->
	<section id="address">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-sm-9">
					<div class="left_box_view">
						<div class="overlay">
							<div class="search_box">
								<h3>Use Your mouse to select the area</h3>
							</div>
							<div class="search_form">
								<form>
									 <div class="form-group">
										<input type="hidden" value="<?php echo $_GET['address']; ?>" class="form-control" id="solar_address" placeholder="Search here.....">
									  </div>
								</form>
							</div>
							
							<!-- <div class="map_box">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224345.9716191905!2d77.06889754725147!3d28.527519806455196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x52c2b7494e204dce!2sNew+Delhi%2C+Delhi!5e0!3m2!1sen!2sin!4v1561453262932!5m2!1sen!2sin" width="75%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
							</div> -->
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<form action="address2.php" id="myForm" method="get">
		<input type="hidden" name="oldaddress" id="oldaddress">
		<input type="hidden" name="area" id="area">
		<input type="hidden" name="oldLat" id="oldLat">
		<input type="hidden" name="oldLong" id="oldLong">
		<input type="hidden" name="polygonArray" id="polygonArray">
		<input type="hidden"  name="polygon" id="get_polygonarray">
		<input type="hidden" name="uid" value="<?php echo $_GET["uid"]; ?>">
	</form>

	
	
	<section style="height:100%;">
        <div class="map" id="map" style="height:100%;">
        </div>
    </section>
	
	
	<div class="clearfix"></div>
	
	<!-- Working Section -->

	<script>
		var mobileMarker = null;
		var polygonMap = null;
		var mapInfoWindow = null;
		var drawingManager = null;
		var map = null;
		var tmpBgImage = null;
		var form_is_completed = false;
		var oldAddress = "<?php echo $_GET['address'] ?>";
		var userData = {
			area: 0,
			slope: 0,
			energy: 0,
			direction: 'S',
			charger: 0,
			battery: 0,
			paymentType: null,
			panelType: null,
			oldLat: <?php echo $_GET['lat']; ?>,
			oldLong: <?php echo $_GET['lng']; ?>,
			oldAddress: encodeURI(oldAddress),

			daysToInstall: function() {
				return Math.round(this.area / 25);
			},
			totalCost: function() {
				var intCost = this.area/1.7;
				if(this.panelType == "Premium") {
					intCost = Math.round((intCost*3+30-(0.1*(Math.pow(intCost,1.2))))*875);
				} else if(this.panelType == "Standard") {
					intCost = Math.round((intCost*2.6+34-(0.1*(Math.pow(intCost,1.2))))*875);
				} else {
					intCost = Math.round((intCost*5+40-(0.1*(Math.pow(intCost,1.2))))*875);
				}

				if(this.charger == 1) {
					intCost += 7000;
				}

				if(this.battery == 1){
					intCost += 33200;
				}
				
				//ADD 10% ON TOTAL COST (FIX 2019-07-01)
				intCost = Math.round(intCost * 1.1);

				if(this.paymentType == "Loan") { 
					intCost = Math.round(intCost * 0.01);
				}
				

				
				return intCost;
			
			},
			paybackYears: function() {
				var tmp = (this.totalCost() * 0.9);
				if(this.panelType == "Premium") {
					tmp = tmp / ((this.area / 1.7) * 300);
				} else {
					tmp = tmp / ((this.area / 1.7) * 285);
				}

				if(this.slope > 10 && this.slope <= 31) {
					tmp = tmp * 1.05;
				} else if(this.slope < 11) {
					tmp = tmp * 1.08;
				}

				if(this.direction == 'SE' || this.direction == "SW") {
					tmp = tmp / 0.92;
				} else {
					tmp = tmp / 0.88;
				}
				
				if(this.paymentType == "Loan") {
					tmp = tmp * 120;
				}
				let formated = (Math.round(tmp * 10) / 10);
				return formated;
			},
			savingsPerYear: function() {
				var cost = this.totalCost();
				var tmp = cost * 0.9;

				if(this.panelType == "Premium") {
					tmp = tmp / ((this.area / 1.7) * 300);
				} else {
					tmp = tmp / ((this.area / 1.7) * 285);
				}

				if(this.slope > 10 && this.slope <= 31) {
					tmp = tmp * 1.05;
				} else if(this.slope < 11) {
					tmp = tmp * 1.08;
				}
				if(this.direction == 'SE' || this.direction == "SW") {
					tmp = tmp / 0.92;
				} else {
					tmp = tmp / 0.88;
				}
				tmp = cost / tmp;
				return Math.round(tmp);
			},
			bathsOfOil: function() {
				var baths = Math.round((this.kwhSaved() / 600) * 30);
				return baths;
			},
			kwhSaved: function() {
				var savings = Math.round(this.savingsPerYear() * 0.9);
				let formated = (Math.round(savings / 10) * 10);
				return formated;
			}
		};

		function getAllUrlParams(url) {

			// get query string from url (optional) or window
			var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

			// we'll store the parameters here
			var obj = {};

			// if query string exists
			if (queryString) {

			// stuff after # is not part of query string, so get rid of it
			queryString = queryString.split('#')[0];

			// split our query string into its component parts
			var arr = queryString.split('&');

			for (var i = 0; i < arr.length; i++) {
				// separate the keys and the values
				var a = arr[i].split('=');

				// set parameter name and value (use 'true' if empty)
				var paramName = a[0];
				var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

				// (optional) keep case consistent
				paramName = paramName.toLowerCase();
				if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

				// if the paramName ends with square brackets, e.g. colors[] or colors[2]
				if (paramName.match(/\[(\d+)?\]$/)) {

				// create key if it doesn't exist
				var key = paramName.replace(/\[(\d+)?\]/, '');
				if (!obj[key]) obj[key] = [];

				// if it's an indexed array e.g. colors[2]
				if (paramName.match(/\[\d+\]$/)) {
					// get the index value and add the entry at the appropriate position
					var index = /\[(\d+)\]/.exec(paramName)[1];
					obj[key][index] = paramValue;
				} else {
					// otherwise add the value to the end of the array
					obj[key].push(paramValue);
				}
				} else {
				// we're dealing with a string
				if (!obj[paramName]) {
					// if it doesn't exist, create property
					obj[paramName] = paramValue;
				} else if (obj[paramName] && typeof obj[paramName] === 'string'){
					// if property does exist and it's a string, convert it to an array
					obj[paramName] = [obj[paramName]];
					obj[paramName].push(paramValue);
				} else {
					// otherwise add the property
					obj[paramName].push(paramValue);
				}
				}
			}
			}

			return obj;
			}
		function isMobile() {
			let width = Math.max(
			document.body.scrollWidth,
			document.documentElement.scrollWidth,
			document.body.offsetWidth,
			document.documentElement.offsetWidth,
			document.documentElement.clientWidth
		);
			if(width < 992) {
				return true;
			} else {
				return false;
			}
		}

		function initMap() {
			var zoomInt = 19;
			var zoomControl = true;
			if(isMobile() == true) {
				zoomInt = 18;
				zoomControl = false;
			} 
			
			var preLat = getAllUrlParams().lat;
			var preLong = getAllUrlParams().lng;
			var preAddress = getAllUrlParams().address;

			console.log(decodeURI(preLat));


			var lat = 59.3258414;
			var long = 17.70188;
			var isPreFilled = false;
			if (typeof preLat !== "undefined" && preLat !== null && typeof preLong !== "undefined" && preLong !== null) {
				var lat = parseFloat(preLat);
				var long = parseFloat(preLong);
				isPreFilled = true;
			}

			map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: lat, lng: long},
			zoom: zoomInt,
			mapTypeId: 'hybrid',
			disableDefaultUI: true,
			zoomControl: zoomControl,
			tilt: 0
			});

			//Autocomplete input
			var input = document.getElementById('solar_address');
			var autocomplete = new google.maps.places.Autocomplete(input);
			//alert(preAddress);
			if(isPreFilled == true) {
				input.value = decodeURIComponent(preAddress).replace(/\+/g," ");
				if(isMobile() == true) {
					if(mobileMarker !== null) {
						mobileMarker.setMap(null);
					}
					mobileMarker = new google.maps.Marker({
						position: {lat: lat, lng: long},
						map: map
					});
				}
				// showRoofPage();
			}

			autocomplete.addListener('place_changed', function() {
			var place = autocomplete.getPlace();
			console.log(place.formatted_address);
			if (!place.geometry) {
				// User entered the name of a Place that was not suggested and
				// pressed the Enter key, or the Place Details request failed.
				window.alert("No details available for input: '" + place.name + "'");
				return;
			}
			// If the place has a geometry, then present it on a map.

			map.setCenter(place.geometry.location);
			//Set marker if mobile
			if(isMobile() == true) {
				if(mobileMarker !== null) {
					mobileMarker.setMap(null);
				}
				mobileMarker = new google.maps.Marker({
					position: place.geometry.location,
					map: map
				});
				window.scrollTo(0, 0);
			}

			});

			//Autocomplete Splashscreen
			var inputSplash = document.getElementById('solar_address');
			var autocompleteSplash = new google.maps.places.Autocomplete(inputSplash);

			autocompleteSplash.addListener('place_changed', function() {
			var placeSplash = autocompleteSplash.getPlace();
			if (!placeSplash.geometry) {
				// User entered the name of a Place that was not suggested and
				// pressed the Enter key, or the Place Details request failed.
				return;
			}
			document.getElementById('solar_address').style.display = "block";
			// If the place has a geometry, then present it on a map.
			map.setCenter(placeSplash.geometry.location);
			input.value = placeSplash.formatted_address;

			if(isMobile() == true) {
				if(mobileMarker !== null) {
					mobileMarker.setMap(null);
				}
				mobileMarker = new google.maps.Marker({
					position: placeSplash.geometry.location,
					map: map
				});
				window.scrollTo(0, 0);
			}
			});

			if(isMobile() == true) {
				google.maps.event.addListener( map,'click', function (e) {
					if(mobileMarker == null) {
						mobileMarker = new google.maps.Marker({
							position: e.latLng,
							map: map
						});
					} else {
						mobileMarker.setPosition(e.latLng);
						map.setCenter(e.latLng);
					}
				});
			}

			if(isMobile() == false) {
				drawingManager = new google.maps.drawing.DrawingManager({
					drawingMode: google.maps.drawing.OverlayType.POLYGON,
					drawingControl: true,
					drawingControlOptions: {
					position: google.maps.ControlPosition.TOP_LEFT,
					drawingModes: ['polygon']
					},
					polygonOptions: {
						fillColor: '#F19200',
						fillOpacity: 0.5,
						strokeColor: '#F19200',
						strokeWeight: 4,
						clickable: false,
						editable: false,
						zIndex: 1
					}
				});//End drawingmanager
				
				google.maps.event.addListener(drawingManager,'polygoncomplete',function(polygon) {
					//Get Area
					if(polygonMap !== null) {
						polygonMap.setMap(null);
					}
					if(mapInfoWindow !== null) {
						mapInfoWindow.setMap(null);
					}
					polygonMap = polygon;
					var area = google.maps.geometry.spherical.computeArea(polygonMap.getPath());
					// area = area*15;
					area = Math.round(area);
					//Store to app variable later
					//Show a popup
					var contentString = "<p class='roof_size_info_window'><span class='roof_size_info_window-text'>" + area + " kvm </span><span id='set_roof_area'><i class='fa fa-check' id='set_roof_area_i'></i></span> <span id='clear_map'><i class='fa fa-times' id='clear_map_i'></i></span>";
					var vertices = polygonMap.getPath();
					var pos = vertices.getAt(0);
					var lat = pos.lat();
					var lang = pos.lng();

					mapInfoWindow = new google.maps.InfoWindow({
					content: contentString,
					buttons: { 
							close: { visible: false }  
							} 
					});
					mapInfoWindow.setPosition({lat: lat, lng: lang});
					map.setCenter({lat: lat, lng: lang});
					mapInfoWindow.open(map);
					document.addEventListener('click',function(e){
						if(e.target && e.target.id== 'set_roof_area_i'){
							userData.area = area;
							var polygonArray = [];
							for (var i = 0; i < polygon.getPath().getLength(); i++) {
								// polygonArray[] = polygon.getPath().getAt(i).toUrlValue(6);
								polygonArray.push(polygon.getPath().getAt(i).toUrlValue(6));
								polygon.setOptions({strokeWeight: 2.0, fillColor: 'black'});
								polygon.setOptions({strokeWeight: 6.0});
							}
							userData.polygonArray = polygonArray;
							userData.address = $('#solar_address').val();
							// mapInfoWindow.close();
							// drawingManager.setMap(null);
							showRoofPagePart2();
						}
					});
					document.addEventListener('click',function(e){
						if(e.target && e.target.id == 'clear_map_i'){
							console.log("Clear");
							mapInfoWindow.close();
							polygonMap.setMap(null);
						}
					});
				});
				drawingManager.setMap(map);
			}
		}
		function showRoofPagePart2() {
			console.log(userData);
			document.getElementById("oldaddress").value = userData.oldAddress;
			document.getElementById("area").value = userData.area;
			document.getElementById("oldLat").value = userData.oldLat;
			document.getElementById("oldLong").value = userData.oldLong;
			// document.getElementById("polygonArray").value = userData.polygonArray;

			newPolygonArray = JSON.stringify(userData.polygonArray);
			document.getElementById("polygonArray").value = newPolygonArray;



			document.getElementById("myForm").submit();

			// console.log(userData.polygonArray);
			// console.log(JSON.stringify(userData.polygonArray));
			// window.location.replace("address2.php?asd=asdas");
		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4WHOh4I5S3ntT4X5TCymibUiLF8DMIWc&libraries=drawing,geometry,places&callback=initMap" async defer></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
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