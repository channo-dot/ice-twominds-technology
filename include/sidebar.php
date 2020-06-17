<div class="sidenav">
<ul>
<li class="fa fa-tachometer" aria-hidden="true"><a href="dashboard.php">Dashboard</a></li>
<li><a href="profile.php">Profile</a></li>
<li><a href="changeemail.php">Change Email</a></li>
<li><a href="changepassword.php">Change Password</a></li>
  <?php
  if($_SESSION["role"]=="c") { ?>
	 <li> <a href="claim.php">Claim</a></li>
  <?php } else { ?>
	  <li><a href="allclaims.php">All Claims</a></li>
  <?php } ?> 
<li><a href="logout.php">Logout</a></li>
</ul>
</div>