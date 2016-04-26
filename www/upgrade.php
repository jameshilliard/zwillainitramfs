<?php
include('includes/inc.php');

if (!$_SESSION['login_string']) {
    header('Location: login.php');
    exit();
} 
else if (!$_COOKIE['zwillamod_version']) {
//    header('Location: index.php');
//    exit();
}


session_write_close();

$jsArray = array();
require_once("includes/header.php");


$hrefipminer = "http://" . $_SERVER['SERVER_NAME'] . "/index.php";

?>
<script>
function f_submit_reset() {
	if(confirm('Really reset all changes?')) {
		$("#cbi_body_cgminer_fieldset").hide();
		$("#cbi_reset_cgminer_fieldset").show();
		
		setTimeout(function(){
			window.location.href = InetAddress.getLocalHost();
		}, 90000);
		
		$.ajax({
			url: 'cgi-bin/reset_conf.cgi',
			type: 'GET',
			dataType: 'json',
			timeout: 30000,
			cache: false,
			data: {},
			success: function(data) {
			},
			error: function() {
			}
		});
	}
}

function f_submit_restore_exec() {
	$.ajax({
		url: 'cgi-bin/kill_cgminer.cgi',
		type: 'GET',
		dataType: 'text',
		timeout: 30000,
		cache: false,
		data: {},
		success: function(data) {
		},
		error: function() {
		}
	});
	ant_restore_config_form.submit();
}

function f_submit_restore() {
	if(confirm('Really restore configuration files?')) {
		$("#cbi_body_cgminer_fieldset").hide();
		$("#cbi_restore_cgminer_fieldset").show();
		
		setTimeout(function(){
			f_submit_restore_exec();
		}, 1000);
	}
}

function f_submit_upgrade_exec() {
	$.ajax({
		url: 'cgi-bin/kill_cgminer.cgi',
		type: 'GET',
		dataType: 'text',
		timeout: 30000,
		cache: false,
		data: {},
		success: function(data) {
		},
		error: function() {
		}
	});
	if(document.getElementById("ant_keep").checked) {
		$("#ant_replace_firmware_form").attr("action", "cgi-bin/upgrade.cgi");
	} else {
		$("#ant_replace_firmware_form").attr("action", "cgi-bin/upgrade_clear.cgi");
	}
	ant_replace_firmware_form.submit();
}

function f_submit_upgrade() {
	if(confirm('Really replace the running firmware?')) {
		$("#cbi_body_cgminer_fieldset").hide();
		$("#cbi_upgrade_cgminer_fieldset").show();
		
		setTimeout(function(){
			f_submit_upgrade_exec();
		}, 1000);
	}
}

function f_submit_upgrade_exec_zwilla() {
	$.ajax({
		url: 'cgi-bin/kill_cgminer.cgi',
		type: 'GET',
		dataType: 'text',
		timeout: 30000,
		cache: false,
		data: {},
		success: function(data) {
		},
		error: function() {
		}
	});
	
		$("#ant_replace_firmware_form").attr("action", "cgi-bin/upgrade-zwilla-image.cgi");
	
	ant_replace_firmware_form.submit();
}

function f_submit_upgrade_zwilla() {
	if(confirm('Really replace the running zwilla firmware?')) {
		$("#cbi_body_cgminer_fieldset").hide();
		$("#cbi_upgrade_cgminer_fieldset").show();
		
		setTimeout(function(){
			f_submit_upgrade_exec_zwilla();
		}, 1000);
	}
}
</script>

<div id="maincontent" id="dashboard-wrap" class="container sub-nav">

			<h2><a id="content" name="content">Upgrade Custom Firmware Zwilla Mod (U R riding version V-0.19.0.0)</a></h2>
			
			<hr>
				<fieldset class="cbi-section">
					<legend>Upgrade Zwilla Mod</legend>
					<div class="cbi-section-descr">
						<p>Upload only software made by zwilla here, others will not work</p>
					    <p>Works only for customers who run this firmware from SD-card</p>
					</div>
					<div class="cbi-section-node">
					
						
						
						<div class="cbi-value cbi-value-last">
							<label class="cbi-value-title" for="image">Zwilla-Image:</label>
							<div class="cbi-value-field">
								<form id="ant_replace_firmware_form" name="ant_replace_firmware_form" action="cgi-bin/upgrade-zwilla-image.cgi" enctype="multipart/form-data" method="post">
									<input type="file" name="datafile" />
									<input class="cbi-button cbi-input-apply btn btn-warning" type="button" onclick="f_submit_upgrade_zwilla();" value="upgrade image..." />
								</form>
							</div>
						</div>
					</div>
				</fieldset>
				<br/><p></p><hr>
			
			
			
			<fieldset class="cbi-section" id="cbi_reset_cgminer_fieldset" style="display:none">
				<img src="old-unsecure-style/pages/resources/icons/loading.gif" alt="Loading" style="vertical-align:middle" />
				<span id="cbi-apply-cgminer-status">Reset to defaults ...loading and loading and bs happens, just click where you want. Warning do not use this function at old menu! There is only an bs recovery!<br>&nbsp;<br>(please wait for 90 seconds)</span>
			</fieldset>
			
			
			<fieldset class="cbi-section" id="cbi_restore_cgminer_fieldset" style="display:none">
				<img src="old-unsecure-style/pages/resources/icons/loading.gif" alt="Loading" style="vertical-align:middle" />
				<span id="cbi-apply-cgminer-status">Upload restore file ...<br>&nbsp;<br>(please wait a minute)</span>
			</fieldset>
			
			
			<fieldset class="cbi-section" id="cbi_upgrade_cgminer_fieldset" style="display:none">
				<img src="old-unsecure-style/pages/resources/icons/loading.gif" alt="Loading" style="vertical-align:middle" />
				<span id="cbi-apply-cgminer-status">Upload firmware image ...<br>&nbsp;<br>(please wait a minute)</span>
			</fieldset>
			
			
			<fieldset class="cbi-section" id="cbi_body_cgminer_fieldset" style="display:block">
				
				<fieldset class="cbi-section">
					<legend>Backup / Restore your configuration</legend>
					<div class="cbi-section-descr">
						Click &#34;Generate archive&#34; to download a tar archive of the current configuration files. To reset the firmware to its initial state, click &#34;Perform reset&#34; (only possible with squashfs images).
					</div>
					<div class="cbi-section-node">
						<div class="cbi-value">
							<label class="cbi-value-title" for="image">Download backup:</label>
						
							<div class="cbi-value-field">
                                    <form action="cgi-bin/create_backup.cgi">
									<input class="cbi-button cbi-button-apply btn btn-success" type="submit" name="backup" value="Generate archive" />
								</form>
							</div>
						</div>
						
						<p></p>
						
						<div class="cbi-value cbi-value-last">
							<label class="cbi-value-title">Reset to defaults:</label>
							<div class="cbi-value-field">
								<input onclick="f_submit_reset();" class="cbi-button cbi-button-reset btn btn-info" type="button" name="reset" value="Perform reset.." />
							</div>
						</div>
					</div>
					<br/><p></p><hr>
					
					<div class="cbi-section-descr">To restore configuration files, you can upload a previously generated backup archive here.</div>
					<div class="cbi-section-node">
						<div class="cbi-value cbi-value-last">
							<label class="cbi-value-title" for="archive">Restore backup:</label>
							<div class="cbi-value-field">
								<form id="ant_restore_config_form" name="ant_restore_config_form" action="cgi-bin/upload_conf.cgi" enctype="multipart/form-data" method="post">
									<input type="file" name="datafile" />
									<input class="cbi-button cbi-input-apply btn btn-success" type="button" onclick="f_submit_restore();" value="Upload archive..." />
								</form>
							</div>
						</div>
					</div>
				</fieldset>
				
				<br/><p></p><hr>
				
				<fieldset class="cbi-section">
					<legend>Flash new firmware image</legend>
					<div class="cbi-section-descr">
						<p>Upload a sysupgrade-compatible image here to replace the running firmware. Check &#34;Keep settings&#34; to retain the current configuration.</p>
					    <p>Works only, if you upgraded before via old Upgrade Menu! If you are running this Firmware from SD-Card it will not work! Try please the update button at the</p>
					</div>
					<div class="cbi-section-node">
					
						<div class="cbi-value">
							<label class="cbi-value-title" for="keep">Keep settings:</label>
							<div class="cbi-value-field"><input type="checkbox" name="ant_keep" id="ant_keep" checked="checked"/></div>
						</div>
						
						<div class="cbi-value cbi-value-last">
							<label class="cbi-value-title" for="image">Image:</label>
							<div class="cbi-value-field">
								<form id="ant_replace_firmware_form" name="ant_replace_firmware_form" action="cgi-bin/upgrade.cgi" enctype="multipart/form-data" method="post">
									<input type="file" name="datafile" />
									<input class="cbi-button cbi-input-apply btn btn-danger" type="button" onclick="f_submit_upgrade();" value="Flash image..." />
								</form>
							</div>
						</div>
					</div>
				</fieldset>
				
				
				
				
				<br/><p></p><hr>
				

				
				
				
			</fieldset>
			<div class="clear"></div>
			<hr>
		</div>
		
		
		

      <?php require_once("includes/footer.php");?>
      </div>
      <!-- /page-container -->

      <?php require_once("includes/scripts.php"); ?>
   </body>
</html>