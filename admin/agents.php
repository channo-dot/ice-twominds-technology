<!DOCTYPE html>
<html lang="en">
<?php include_once("include/auth.php");
include_once('include/MysqliDB.php');
include_once("include/conn.php");
if(isset($_REQUEST["mode"]))
 $mode = $_REQUEST["mode"];
else
 $mode = "";

if(isset($_REQUEST['fname']) && isset($_REQUEST['fname']) && isset($_REQUEST['email']))
{	

if(isset($_REQUEST["status"]))
	$status = 1;
else
	$status = 0;
$data =  array(
'fname'=>$fname,
'lname' => $lname,
'email' => $email,
'phone' => $phone,
'status' => $status
);
$db->where("id",$id);

if($db->update("users",$data))
{
	$subject = "Hi, Welcome to Insurance";
	$msg = "Hi <br> We are glad to you inform you that your policy number is generated to view just login";
	$msg .= "Username: " .$email."<br>";
	$msg .= "Password: ". $password. "<br>";
//sendEmail($subject,$msg,$email);
header("location:allagents.php");
}
}
?>
  <head>
 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Agents</title>

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
         <h1>Edit New agent</h1>
        
         <?php
		 if($mode=="edit") { 
		 $db->where("id",$id);
		 $data = $db->getOne("users");
		 ?>
        <form class="form-horizontal form-label-left" method="post" action="" novalidate>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">First Name <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text"  name="fname" value="<?php echo $data["fname"]; ?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Last Name <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="email" value="<?php echo $data["lname"]; ?>" name="lname" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email(User Name)<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="email" value="<?php echo $data["email"]; ?>"  name="email" required="email required" class="form-control col-md-7 col-xs-12">
  </div>
</div>


<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phone Numebr<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" value="<?php echo $data["phone"]; ?>" id="email" name="phone" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>


<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Status<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="checkbox"  name="status"  <?php if($data["status"]=="1") echo "checked='checked'"; ?> class="form-control col-md-7 col-xs-12">
  </div>
</div>










<div class="ln_solid"></div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    <button type="submit" class="btn btn-primary">Cancel</button>
 <input type="submit" name="update" class="btn btn-success" value="Update">
    
  </div>
</div>
</form>
<?php } if($mode=="delete") {
  $db->where("id",$id);
  if($db->delete("users"))
   header("location:allagents.php");

} ?>
       
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
    <script src="vendors/datatables/js/dataTables.buttons.min.js"></script>
    <script src="vendors/validator/validator.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>