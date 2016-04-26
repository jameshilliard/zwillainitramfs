<!DOCTYPE html>
<html lang="en">
<?php
require_once("includes/head.php");

//  user file
?>
<body>
<?php require_once("templates/modals/add_panel.php"); ?>
<?php require_once("templates/modals/qrcode-donate-btc.php"); ?>

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
               <a class="navbar-brand" href="/index.php"><img src="images/logo-landscape.png" alt="cryptoGlance" /></a>
            </div>
            <div class="navbar-collapse collapse">

               <ul class="nav nav-pills navbar-nav<?php echo ($currentPage != 'index') ? ' no-dash' : '' ?>">


                   <?php if (!$_COOKIE['licensekey']){ ?>
                   <li class="<?php echo ($currentPage == 'miner-settings') ? 'active ' : '' ?>topnav topnav-icon">
                       <a id="dash-link" href="miner-settings.php">
                           <i class="icon icon-speed"></i> Activate</a>
                   </li>
                   <?php } ?>






                   <li class="<?php echo ($currentPage == 'miner-settings') ? 'active ' : '' ?>topnav topnav-icon">
                  <a id="dash-link" href="/old-unsecure-style/pages/index.html">
                  <i class="icon icon-speed"></i> Old-Menu</a>



                  <li class="<?php echo ($currentPage == 'index') ? 'active ' : '' ?>topnav topnav-icon">
                  <a id="dash-link" href="index.php"><i class="icon icon-speed"></i> Dashboard</a>

                    <?php if ($currentPage == 'index') { ?>
                    <a id="dash-add-panel" class="grad-green" title="Add Panel" data-toggle="modal" data-target="#addPanel">
                    <i class="icon icon-newtab"></i>
                    </a>
                    <?php } ?>
                  </li>

                  <li class="<?php echo ($currentPage == 'settings') ? 'active ' : '' ?>dropdown">

                     <a href="#" class="dropdown-toggle"><i class="icon icon-settingsthree-gears mobile-icon">
                     </i> Tools <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li class="dropdown-header site-layout">Site Layout</li>
                        <li class="site-layout-btns">
                          <div class="btn-group">
                            <button type="button" id="layout-list" class="btn btn-primary"><i class="icon icon-menu"></i></button>
                            <button type="button" id="layout-grid" class="btn btn-primary"><i class="icon icon-th"></i></button>
                          </div>
                        </li>
                        <li class="dropdown-header site-width-slider">Panel Width</li>
                        <li class="site-width-slider">
                           <span class="width-reading">85%</span> <!-- width-reading -->
                           <div id="slider"></div> <!-- the Slider -->
                        </li>


                        <?php if ($currentPage == 'index') { ?>
                        <li class="dropdown-header chk-hashrate">
                            <label for="show-total-hashrate">Show Total Hashrate(s)</label>
                            <input title="pow" type="checkbox" id="showTotalHashrate" name="show-total-hashrate" <?php echo ($_COOKIE['show_total_hashrate'] === 'true') ? '' : 'checked="checked"'; ?> />
                        </li>
                        <?php } ?>

                        <li><a href="settings.php"><i class="icon icon-settingsandroid"></i> My Settings</a></li>
                        <!-- <div class="divider"></div> -->

                     </ul>
                  </li>


                  <li class="<?php echo ($currentPage == 'help') ? 'active ' : '' ?>dropdown topnav">
                     <a href="#" class="dropdown-toggle"><i class="icon icon-question-sign mobile-icon"></i> Help <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li class="dropdown-header">Learn more</li>
                        <li><a href="help.php"><i class="icon icon-preview"></i> View the README</a></li>
                        <li><a href="changelog.php"><i class="icon icon-notes"></i> View the CHANGELOG</a></li>
                         <li><a href="updates/update.php"><i class="icon icon-notes"></i>Update Packages</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Official Links</li>
                        <li><a href="https://www.zwilla.de/de/faq-items/custom-firmware-antminer-s7/" rel="external"><i class="icon icon-post"></i> FAQ</a></li>
                        <li><a href="https://www.zwilla.de/de/downloads/custom-firmware-antminer-s7/" rel="external"><i class="icon icon-playstore"></i> Buy more</a></li>
                        <li><a href="https://github.com/Zwilla/cryptoGlance-web-app/tree/Zwilla-patch-1/" rel="external"><i class="icon icon-github"></i> Source on Github</a></li>
                        <li><a href="http://cryptoglance.info" rel="external"><i class="icon icon-glasses"></i>original cryptoGlance Homepage</a></li>
                     </ul>
                  </li>


                   <li class="<?php echo ($currentPage == 'Miner') ? 'active ' : '' ?>dropdown topnav">
                     <a href="#" class="dropdown-toggle"><i class="icon icon-question-sign mobile-icon"></i> Miner <b class="caret"></b></a>
                     <ul class="dropdown-menu">

                        <li class="dropdown-header">Basics</li>

                        <li><a href="upgrade.php"><i class="icon icon-preview"></i> Firmware upgrade</a></li>
                        <li><a href="changelog.php"><i class="icon icon-notes"></i> View the CHANGELOG</a></li>
                        <li><a href="my_local_miner.php"><i class="icon icon-cpu-processor"></i> my local Miner</a></li>

                        <li class="divider"></li>

                        <li class="dropdown-header">Advanced</li>
                        <li><a href="cgminer-conf.php"><i class="icon icon-file"></i> Cgminer.conf direct</a></li>
                        <li><a href="mybackups.php"><i class="icon icon-cloud"></i> My backups</a></li>



                        <li class="divider"></li>

                        <li class="dropdown-header">Intern</li>
                        <li><a href="netzwerk.php"><i class="icon icon-notes"></i> Network</a></li>
                        <li><a href="debug.php"><i class="icon icon-notes"></i> Debug</a></li>
                        <li><a href="miner_root_password.php"><i class="icon icon-preview"></i> Miner Password </a></li>
                        <li><a href="cpu.php">	<i class="icon icon-post"></i> Board-CPU and Kernel Log</a></li>
                        <li><a data-toggle="tooltip" title="This starts the hole system. Warning!!!" href="old-unsecure-style/pages/cgi-bin/reboot.cgi"><i class="icon icon-notes"></i> Reboot NOW!</a></li>
                        <li><a href="boulder/index.html"><i class="icon icon-notes"></i> don't klick here!</a></li>

                     </ul>
                  </li>



                  <li id="nav-login-button" class="topnav topnav-icon"><a href="logout.php"><i class="icon icon-exitalt"></i> Logout</a></li>
               </ul>
            </div>
            <!--/.nav-collapse -->
         </div>
      </div>

          <?php if ($currentPage == 'index') { ?>
              <li class="dropdown-header chk-hashrate">
                  <label for="show-total-hashrate">Show Total Hashrate(s)</label><input type="checkbox" id="showTotalHashrate" name="show-total-hashrate" <?php echo ($_COOKIE['show_total_hashrate'] === 'false') ? '' : 'checked="checked"'; ?> />
              </li>
          <?php } ?>
