<?php
	
	include_once('include/MysqliDB.php');
   include_once("include/conn.php");
		
	include_once('include/MysqliDB.php');
      //include_once("admin/include/conn.php");
		//require_once('pdf/tcpdf.php');
		$address  = $_GET['address'];
		$area  = $_GET['area']/0.09290304; //converted in feet
		$area  = $_GET['area']; //converted in feet
		$lat  = $_GET['lat'];
		$lng  = $_GET['lng'];
		$polygonArray  = $_GET['polygonArray'];
		
		$polygon=$_GET['polygon'];
		//$uid=$_GET['uid'];
// 		echo $uid.$address.$area.$lat.$lng.$polygonArray;
		
		
	
	
			
			
			
			
         $src = 'http://maps.googleapis.com/maps/api/staticmap?maptype=satellite&path=color:0xff0000ff|weight:5|'.$polygon.'&zoom=20&size=640x400&style=element:labels|visibility:off&style=element:geometry.stroke|visibility:on&style=feature:landscape|element:geometry|saturation:-100&style=feature:water|saturation:-100|invert_lightness:true&key=AIzaSyA4WHOh4I5S3ntT4X5TCymibUiLF8DMIWc';
          
			$time = time();
            $desFolder = 'images/';
            $imageName = 'google-mapdddd_'.$time.'.PNG';
            $imagePath = $desFolder.$imageName;
            file_put_contents($imagePath,file_get_contents($src));
            $image_data = array(
			"lati" => $lat,
			"longi" => $lng,
			"image" => $imagePath,
			"address" => $address,
			'plygonarray' => $polygonArray
			
			);
			$db->where("uid",$uid);
            
       	if ($db->update("user_info",$image_data)) {
            header("location:allclients.php");
		}
           

	      

	?>