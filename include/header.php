<?php session_start(); 

?>
<section id="topbar" class="d-none d-lg-block">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i><a href="mailto:contact@example.com">info@twominds.co.in</a>
        <i class="icofont-phone"></i> +011 4019 6231
      </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </section>
  <header id="header">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.php">ICE</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
       <a href="index.php">
	   <img src="admin/img/logo.png" alt="" class="img-fluid">
	   </a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
         
          
            <?php 
			if(isset($_SESSION["uauth"])) { ?>

			<li class="drop-down"><a href="dashboard.php">Dashboard</a>
            <ul>
              <li><a href="profile.php">Profile</a></li>
			   <li><a href="logout.php">logout</a></li>
              
              
            </ul>
          </li>
			<?php } ?>
			


	




		   
           <li style="backgroud-color:red"> 
		  <?php 
			if(isset($_SESSION["uauth"])) { ?>
               <a href="logout.php">Logout</a>
			  <?php } else {?>
			  <a href="login.php">Login</a>
			<?php } ?>
			</li>
      <li><a href="contact.php">Contact Us</a></li>
        </ul>
         
      </nav><!-- .nav-menu -->

    </div>
  </header>