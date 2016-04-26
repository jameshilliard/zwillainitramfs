<?php

require_once("includes/header.php");
// Dann kommt der restliche Kram 

?>
<div id="settings-wrap" class="container sub-nav full-content">
<h2><a id="content" name="content">Password (for Old-Menu login)</a></h2>

			<form action="old-unsecure-style/pages/cgi-bin/passwd.cgi">
				
					<div>Changes the administrator password for SSHd and sFTP accessing the device</div>
					
						
						<fieldset>
							
								<label>Current Password</label><p></p>
								
									<input type="password" name="current_pw" placeholder="Current Password" /><p></p>
							
								<label>New Password</label><p></p>
								
									<input type="password" name="new_pw" placeholder="New Password" /><p></p>
							
								<label >Confirmation</label><p></p>
								
									<input type="password" name="new_pw_ctrl" placeholder="Confirm Password" /><p></p>
							
							
						</fieldset>
						
					
					<hr>
				
				
					<input class="btn btn-lg btn-success" type="submit" value="Save&Apply" />
					<input class="btn btn-lg" type="reset" value="Reset" />
				
			</form>
	</div>
			
<?php require_once("includes/footer.php"); ?>
   </div>
   <!-- /page-container -->
   
<?php
    // Load Last
    $jsArray[] = 'dashboard/script';
    require_once("includes/scripts.php");
?>

</body>
</html>