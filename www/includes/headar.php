<!DOCTYPE html>
<html lang="en">
<?php
require_once('includes/head.php'); 

//  user file
?>
<body>

      <div class="page-container">
      <div class="dark-overlay"></div>
      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <i class="icon icon-dropmenu"></i>
               </button>
               <a class="navbar-brand" href="index.php"><img src="images/logo-landscape.png" alt="cryptoGlance" /></a>
            </div>
            <div class="navbar-collapse collapse">
            
               <ul class="nav nav-pills navbar-nav<?php echo ($currentPage != 'index') ? ' no-dash' : '' ?>">
               
                  <li class="<?php echo ($currentPage == 'miner-settings') ? 'active ' : '' ?>topnav topnav-icon">
                  <a id="dash-link" href="miner-settings.php">
                  <i class="icon icon-speed"></i> Activate</a>
                  
                  
                   <li class="<?php echo ($currentPage == 'miner-settings') ? 'active ' : '' ?>topnav topnav-icon">
                  <a id="dash-link" href="/old-unsecure-style/pages/index.html">
                  <i class="icon icon-speed"></i> Old-Menu</a>
                  
                  
                  <li id="nav-login-button" class="topnav topnav-icon"><a href="logout.php"><i class="icon icon-exitalt"></i> Logout</a></li>
               </ul>
            </div>
            <!--/.nav-collapse -->
         </div>
      </div>

