<?php
    header("Pragma: no-cache");
    header("Cache-Control: no-store");
	header("Content-Type: text/html; charset=".$charset);


include('includes/inc.php');

if (!$_SESSION['login_string']) {
    header('Location: login.php');
    exit();
}
session_write_close();
require_once("includes/header.php");




?>
<title>Custom Bitcoinminer Firmware - My Backups</title>


	<!-- Include our stylesheet -->
	<link href="assets/css/styles.css" rel="stylesheet"/>



	<div class="filemanager">

		<div class="search">
			<input type="search" placeholder="Find a backup.." />
			</div>

		

		<div class="breadcrumbs"></div>

		<ul class="data"></ul>

		<div class="nothingfound">
			<div class="nofiles"></div>
			<span>No backupfiles here.</span>
		</div>

	</div>

	<footer>

		<input class="btn btn-primary" type=button onClick="parent.location='index.php'" value="Dashboard"/>
		<input class="btn btn-info" type=button onClick="parent.location='upgrade.php'" value="back to Firmware upgrade" />
		<input class="btn btn-danger" type=button onClick="parent.location='cgi-bin/delete_old_backups.cgi'" value="delete all backups"/>
		<input class="btn btn-success" type=button onClick="parent.location='cgi-bin/create_backup.cgi'" value="create new backup"/>
		<input class="btn btn-success" type=button onClick="parent.location='mybackups.php'" value="refresh"/>



    </footer>

	<!-- Include our script files -->
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<script src="assets/js/script.js"></script>

      <?php require_once("includes/scripts.php"); ?>
</body>
</html>