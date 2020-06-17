<?php 
session_start();  ob_start();
include_once("admin/include/MysqliDB.php");
include_once("admin/include/conn.php");
include_once("admin/include/functions.php");
extract($_REQUEST);
if(isset($_SESSION["uauth"]))
	$uid = $_SESSION["uauth"];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST["agent_id"]) && isset($_REQUEST["pnumber"]))
{
	$data = array(
	  "uid" =>  $uid,
	  "pnumber" => $pnumber,
	  "agent_id" => $agent_id,
	  "subject" => $subject,
	  "message" => $message,
	  "date" => date('y-m-d'),
	  "status" => 0
	);
	if($db->insert("claims",$data)) {
	  echo "Claim sent successfully!";
	  ?>
	  <script> location.reload(); </script>
	  <?php 
	}
}
