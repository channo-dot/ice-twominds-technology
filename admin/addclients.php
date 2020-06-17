<!DOCTYPE html>
<html lang="en">
<?php include_once("include/auth.php");
include_once('include/MysqliDB.php');
include_once("include/conn.php");

if(isset($_REQUEST['fname']) && isset($_REQUEST['fname']) && isset($_REQUEST['email']) && isset($_REQUEST['password']) )
{	

$data =  array(
'fname'=>$fname,
'lname' => $lname,
'email' => $email,
'phone' => $phone,

'status' => 1,
'password' => md5($password),
'role' => 'c'
);
$uid = $db->insert("users",$data);
if($uid)
{
  $data = array(
    'uid' => $uid,
   
    'pnumber' => $number,
    'agent_id' => $agent_id,
  );
  if($db->insert("user_info",$data)) {

	$subject = "Hi, Welcome to Insurance";
	$msg = "Hi <br> We are glad to you inform you that your policy number is generated to view just login";
	$msg .= "Username: " .$email."<br>";
	$msg .= "Password: ". $password. "<br>";
//sendEmail($subject,$msg,$email);
  header("location:allclients.php");
  }
}
}
?>
  <head>
</style>
</script>
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
         <h1>Add New Client</h1>
        
         
        <form class="form-horizontal form-label-left" method="post" action="" novalidate>




<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Policy Number<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
 <?php	 
    $stats = $db->getOne ("user_info", "max(id), count(*) as cnt");	    
    $number = $stats['cnt'] + 1;
 ?>
    <input type="text"  value="<?php echo $number; ?>" name="number" required="required" class="form-control col-md-7 col-xs-12" readonly>
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">First Name <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text"  name="fname" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Last Name <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="email" name="lname"   class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Agents <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <select name="agent_id" class="form-control col-md-7 col-xs-12" required="required">
      <option value="">-Select-</option>
    <?php
    $db->where("status",1);
    $db->where('role','a');
    $drop = $db->get("users");
    foreach($drop as $d) {
      ?>
      <option value="<?php echo $d['id']; ?>"><?php echo $d["fname"]. " ".$d["lname"]; ?></option>
    <?php } ?>
    </select>

  </div>
</div>


<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email(User Name)<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="email"  name="email" required="email required" class="form-control col-md-7 col-xs-12">
  </div>
</div>


<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Phone Number<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="email" name="phone" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<!-- <div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Address <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="hidden" id="address" name="address" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div> -->







<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Temp Password <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="password" id="latitude" name="password" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>




<div class="ln_solid"></div>
<div class="form-group">
  <div class="col-md-6 col-md-offset-3">
    <button type="submit" class="btn btn-primary">Cancel</button>
 
    <button  name="save" type="submit" class="btn btn-success">Submit</button>
  </div>
</div>
</form>
       
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
    <script src="vendors/validator/validator.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>