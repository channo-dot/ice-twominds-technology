 <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>
			 <img src="admin/img/logo.png" style="height:50px;width:100px">
			</h3>
            <p>
              We would be happy to hear from you.
              Let's get connected!! <br><br>
              <strong>Phone:</strong> +011 4019 6231<br>
              <strong>Email:</strong> info@twominds.co.in<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="login.php">Login</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="about.php">About us</a></li>
            
              
            </ul>
          </div>

       <!--   <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div> -->

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Join Our Newsletter to get latest updates</p>
			<?php
			$msg = 1;
			 if(isset($_REQUEST['subs']) && isset($_REQUEST['email'])) {
			   if(!empty($_REQUEST['email'])) {
				   $email = $_REQUEST['email'];
				   $data = array(
				     "email" => $email,
					 "status" => 1
				   );
				   $db->where("email",$email);
				   $count = $db->getValue('subscribers','count(*)');
				   if($count == 0) {
				   if($db->insert('subscribers',$data)) {
				       $msg = "Subscribed successfully!";    
				   } 
				   
				  }
				  else {
					   $msg = "You have already subscribed for this";
				   }
			   } else {
			     $msg = "Please enter email id";
			   }
			 }
			 if($msg!="1")
				 echo "<font color='red'>".$msg."</font>";
			 ?>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe" name="subs">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>ICE</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/ -->
          Designed by <a href="#">twominds.com</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer>