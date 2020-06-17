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

    <title>Adds Management</title>

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
         <h1>Aactive Agents</h1>
        <div class="pull-right">
        <a href="addagents.php">
          <button class="btn btn-primary"> Add New</button>
        </a>  
        </div>
         
        <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Sr No</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                                $i=0;  
                                $db->orderBy("id","desc");
                                $db->where("status",1);
                                $db->where("role","a");
                                $mn=$db->get("users");
                                foreach($mn as $men){
						   ?>
						       <tr>
							   <td><?php echo ++$i; ?></td>
							   <td><?php echo $men["fname"]. " ".$men["lname"]; ?></td>
							   <td>
							        <?php
									  if($men["status"]=="1")
										   echo "Active";
									   else
										   echo "Inactive";
									   ?>
							   </td>
							 
							   <td>
							    <a href="agents.php?id=<?php echo $men["id"]; ?>&mode=edit" class="fa fa-pencil btn btn-info btn-xs ">Edit</a>
							  / <a href="agents.php?id=<?php echo $men["id"]; ?>&mode=delete" class=" fa fa-trash-o btn btn-danger btn-xs">Delete</a>
							   </td>
							   </tr>
								<?php } ?>

								
                      </tbody>
                    </table>
       
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