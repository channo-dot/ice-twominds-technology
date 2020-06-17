<?php
$uri = explode('/',$_SERVER['REQUEST_URI']);
$c_page =  end($uri);
?>
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
           <div class="profile clearfix">
              <div class="profile_pic">
                <img src="img/logo.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>
                Admin admin
				</h2>
              </div>
            </div>
			<br>
			 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a>
                    
                  </li>		
                  
                  
                  <li><a><i class="fa fa-sitemap"></i>Agents<span class="fa fa-chevron-down"></span></a>
				   <ul class="nav child_menu">           				   	
                       <li><a href="addagents.php">Add Agent</a>
                      <li><a href="allagents.php">All Agents</a>					                     			   
                      <li><a href="activeagents.php">Active Agents</a>
                      <li><a href="inactiveagents.php">Inactive Agents</a>
                      
                    </li>
                    </ul>
                  </li>   

 



				  <li><a><i class="fa fa-sitemap"></i>Clients<span class="fa fa-chevron-down"></span></a>
				   <ul class="nav child_menu">  
                      <li><a href="addclients.php">Add Client</a>                				   	
                      <li><a href="allclients.php">All Clients</a>					      			   
                      <li><a href="activeclients.php">Active Clients</a>
                      <li><a href="inactiveclients.php">Inactive Clients</a>                      
                    </li>
                    </ul>
                  </li>   



                  
                  

				  
                  
				  
				  
				  
				  
				    
				  
				   
            
				  
   


                 
				  
				  
				  
				  
				  
				  
                 
				  
			
				  
				 
                </ul>
              </div>
              
            </div>
			<div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
           
          </div>
        </div>