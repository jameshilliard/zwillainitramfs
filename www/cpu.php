<?php
if (isset($_POST) && !empty($_POST)) {
    shell_exec("" . $killingtits . "2>&1");
    header('Location: cpu.php');
}
require_once("includes/header.php");
// Dann kommt der restliche Kram
$killingtits ="";

?>
<script>
function f_monitor() {
	$.ajax({
		url: "old-unsecure-style/pages/cgi-bin/monitor.cgi",
		type: 'GET',
		dataType: 'text',
		timeout: 30000,
		cache: false,
		success: function(data) {
			$("#syslog").val(data);
		},
		error: function() {
			//alert('Ajax Error');
		}
	});
}

$(document).ready(function() {
	f_monitor();
});
</script>

<script>
function f_get_kernel_log() {
	$.ajax({
		url: 'old-unsecure-style/pages/cgi-bin/get_kernel_log.cgi',
		type: 'GET',
		dataType: 'text',
		timeout: 30000,
		cache: false,
		success: function(data) {
			$("#syslog2").val(data);
		},
		error: function() {
			//alert('Ajax Error');
		}
	});
}

$(document).ready(function() {
	f_get_kernel_log();
});
</script>

<div id="settings-wrap" class="container sub-nav full-content">
<h2><a id="content" name="content">Board CPU usage and Kernel Log</a></h2>


			<div id="content_syslog">
				<textarea readonly="readonly" wrap="off" cols="90" rows="5" id="syslog"></textarea>
				<br><br>
				<textarea readonly="readonly" wrap="off" cols="90" rows="5" id="syslog2"></textarea>
			</div>
			<div class="clear"></div>
			
	</div>
	<br><br>
	<br><br><br>

<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

	<input title="kill" name="killingtits" type="text" placeholder="kill -9 7777">
<button class="btn btn-danger" type="submit" about="kill" title="kill">kill now! (no feedback!)</button>
</form>


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