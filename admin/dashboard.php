<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
	      <?php
		  include_once('include/MysqliDB.php');
          include_once("include/conn.php");
          include_once("include/sidebar.php"); ?>

        <!-- top navigation -->
        <?php include_once("include/header.php"); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats"  style="background-color:#eb6709;color:white ">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count">
				  <?php
				  $db->where("status",1);
				  $db->where("role","c");
				  $usres = $db->getValue("users","count('*')");
				  echo $usres;
                  ?>				  
				  </div>
                  <h3>Active Users</h3>
                  <p>Users taking the services.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats"  style="background-color:#eb6709;color:white ">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count">
				  <?php
				  $db->where("status",1);
				  $db->where("role","a");
				  $usres = $db->getValue("users","count('*')");
				  echo $usres;
                  ?>
				  </div>
                  <h3>Active Agents</h3>
                  <p>Currently working with the company.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats" style="background-color:#eb6709;color:white ">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">
				  <?php
				  $db->where("status",0);
				  $usres = $db->getValue("claims","count('*')");
				  echo $usres;
                  ?>
				  </div>
                  <h3>Active Claims</h3>
                  <p>Claims under process.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats" style="background-color:#eb6709;color:white ">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">
				  <?php
				  $db->where("status",1);
				  $usres = $db->getValue("claims","count('*')");
				  echo $usres;
                  ?>
				  </div>
                  <h3>Claims Proccessed</h3>
                  <p>Claim proccessed.</p>
                </div>
              </div>
            </div>

           


            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                   
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-7" style="overflow:hidden;">
                        <span class="sparkline_one" style="height: 160px; padding: 10px 25px;">
                                      <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                  </span>
                        <h4 style="margin:18px">Wel Come to Admin Panel</h4>
                      </div>

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>



          
          </div>
        </div>
        <!-- /page content -->

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
   
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>