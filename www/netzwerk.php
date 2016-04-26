<?php
require_once('includes/inc.php');

if (!$_SESSION['login_string']) {
    header('Location: login.php');
    exit();
}
session_write_close();

require_once("includes/header.php");

$outputmac = shell_exec("/etc/init.d/minermac.sh 2>&1");
$outputmac = substr($outputmac, 0, 17);
?>
<script>
function f_get_network_info() {
	$.ajax({
		url: '../old-unsecure-style/pages/cgi-bin/get_network_info.cgi',
		type: 'GET',
		dataType: 'json',
		timeout: 30000,
		cache: false,
		success: function(data) {
			try
			{
				$("#ant_netdevice").html(data.netdevice);
				$("#ant_macaddr").html(data.macaddr);
				$("#ant_ipaddress").html(data.ipaddress);
				$("#ant_netmask").html(data.netmask);
				
				$("#ant_conf_nettype").val(data.conf_nettype);
				$("#ant_conf_hostname").val(data.conf_hostname);
				$("#ant_conf_ipaddress").val(data.conf_ipaddress);
				$("#ant_conf_netmask").val(data.conf_netmask);
				$("#ant_conf_gateway").val(data.conf_gateway);
				$("#ant_conf_dnsservers").val(data.conf_dnsservers);
			}
			catch(err)
			{
				alert('Invalid Network configuration file. Edit manually or reset to default.');
			}
		},
		error: function() {
			//alert('Ajax Error');
		}
	});
}

function f_submit_network_conf() {
	_ant_conf_nettype = $("#ant_conf_nettype").val();
	_ant_conf_hostname = $("#ant_conf_hostname").val();
	_ant_conf_ipaddress = $("#ant_conf_ipaddress").val();
	_ant_conf_netmask = $("#ant_conf_netmask").val();
	_ant_conf_gateway = $("#ant_conf_gateway").val();
	_ant_conf_dnsservers = $("#ant_conf_dnsservers").val();
	
	$("#cbi_apply_cgminer_fieldset").show();
	
	setTimeout(function(){
		if(_ant_conf_nettype == "Static") {
			window.location.href = "http://"+_ant_conf_ipaddress+"/netzwerk.html";
		} else {
			window.location.reload();
		}
	}, 30000);
	
	$.ajax({
		url: 'old-unsecure-style/pages/cgi-bin/set_network_conf.cgi',
		type: 'POST',
		dataType: 'json',
		timeout: 30000,
		cache: false,
		data: {_ant_conf_nettype:_ant_conf_nettype, _ant_conf_hostname:_ant_conf_hostname, _ant_conf_ipaddress:_ant_conf_ipaddress, _ant_conf_netmask:_ant_conf_netmask,_ant_conf_gateway:_ant_conf_gateway, _ant_conf_dnsservers:_ant_conf_dnsservers},
		success: function(data) {
		},
		error: function() {
		}
	});
}

$(document).ready(function() {
	f_get_network_info();
	setTimeout("DHCPLoad()",1000); 

});
function DHCPLoad()
{
	var obj = document.getElementById("ant_conf_nettype");
	var index = obj.selectedIndex;
	var value = obj.options[index].value;
	if (value == "DHCP"){
	document.getElementById("ant_conf_ipaddress").readOnly=true;
	document.getElementById("ant_conf_ipaddress").style.backgroundColor = "#999999";  
	document.getElementById("ant_conf_netmask").readOnly=true;
	document.getElementById("ant_conf_netmask").style.backgroundColor = "#999999"; 
	document.getElementById("ant_conf_gateway").readOnly=true;
	document.getElementById("ant_conf_gateway").style.backgroundColor = "#999999"; 
	document.getElementById("ant_conf_dnsservers").readOnly=true;
	document.getElementById("ant_conf_dnsservers").style.backgroundColor = "#999999"; 
	}
}

function DHCPChange(val) 
{

	if (val=="DHCP"){
	document.getElementById("ant_conf_ipaddress").readOnly=true;
	document.getElementById("ant_conf_ipaddress").style.backgroundColor = "#999999"; 
	document.getElementById("ant_conf_netmask").readOnly=true;
	document.getElementById("ant_conf_netmask").style.backgroundColor = "#999999"; 
	document.getElementById("ant_conf_gateway").readOnly=true;
	document.getElementById("ant_conf_gateway").style.backgroundColor = "#999999";
	document.getElementById("ant_conf_dnsservers").readOnly=true; 
	document.getElementById("ant_conf_dnsservers").style.backgroundColor = "#999999"; 
	}
	else{
	document.getElementById("ant_conf_ipaddress").readOnly=false;
	document.getElementById("ant_conf_ipaddress").style.backgroundColor = "#f0f0f0"; 
	document.getElementById("ant_conf_netmask").readOnly=false;
	document.getElementById("ant_conf_netmask").style.backgroundColor = "#f0f0f0";
	document.getElementById("ant_conf_gateway").readOnly=false;
	document.getElementById("ant_conf_gateway").style.backgroundColor = "#f0f0f0";
	document.getElementById("ant_conf_dnsservers").readOnly=false; 	
	document.getElementById("ant_conf_dnsservers").style.backgroundColor = "#f0f0f0";
	}
}

</script>

      <div id="settings-wrap" class="container sub-nav full-content">
      
      
        <div id="settings" class="panel panel-default panel-no-grid no-icon">
          <h1>Network Settings</h1>
          <div class="panel-heading">
              <h2 class="panel-title"><i class="icon icon-settingsandroid"></i>Network setup for your local Bitcoin Miner</h2>
          </div>
          <div class="panel-body">
   
			<div class="cbi-map" id="cbi-network">
				
				<fieldset class="cbi-section" id="cbi_apply_cgminer_fieldset" style="display:none">
					<img src="resources/icons/loading.gif" alt="Loading" style="vertical-align:middle" />
					<span id="cbi-apply-cgminer-status">Waiting for changes to be applied.....</span>
				</fieldset>
				<fieldset class="cbi-section" id="cbi-network-wan">
					<div class="cbi-section-node cbi-section-node-tabbed" id="cbi-network-wan">
						<div class="cbi-tabcontainer" id="container.network.wan.general">
							<div class="cbi-value" id="cbi-network-wan-__status">
								<label class="cbi-value-title" for="cbid.network.wan.__status">Status</label>
								<div class="cbi-value-field">
									<table>
										<tr>
											<td></td>
											<td>
												<img src="old-unsecure-style/pages/resources/icons/ethernet.png" style="width: 16px; height: 16px;" /><br>
												<small id="ant_netdevice"></small>
											</td>
											<td>

											    <strong>1:</strong><span><?php echo shell_exec("ifconfig eth0 | grep 'inet '"); ?></span><br>
												<strong>2:</strong><span><?php echo shell_exec("ifconfig eth0 | grep 'inet6 '"); ?></span><br>
												<strong>3:</strong><span><?php echo shell_exec("ifconfig eth0 | grep 'HWaddr '"); ?></span><br>
												<strong>4:</strong><span><?php echo $_SERVER['SERVER_NAME']; ?></span><br>
												</span><br>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="cbi-value" id="cbi-network-wan-ipaddr">
								<label class="cbi-value-title" for="cbid.network.wan.hostname">Hostname</label>
								<div class="cbi-value-field">
									<input type="text" class="cbi-input-text" name="cbid.network.wan.hostname" id="ant_conf_hostname" value="" />
								</div>
							</div>
							<div class="cbi-value" id="cbi-network-wan-proto">
								<label class="cbi-value-title" for="cbid.network.wan.proto">Protocol</label>
								<div class="cbi-value-field">
									<select class="cbi-input-select" id="ant_conf_nettype" name="cbid.network.wan.proto" size="1" onchange="DHCPChange(this.value)">
										<option id="cbi-network-wan-proto-static" value="Static">Static</option>
										<option id="cbi-network-wan-proto-dhcp" value="DHCP">DHCP</option>
									</select>
								</div>
							</div>
							<div class="cbi-value" id="cbi-network-wan-ipaddr">
								<label class="cbi-value-title" for="cbid.network.wan.ipaddr">IP Address</label>
								<div class="cbi-value-field">
									<input type="text" class="cbi-input-text" name="cbid.network.wan.ipaddr" id="ant_conf_ipaddress" value="" />
								</div>
							</div>
							<div class="cbi-value" id="cbi-network-wan-netmask">
								<label class="cbi-value-title" for="cbid.network.wan.netmask">Netmask</label>
								<div class="cbi-value-field">
									<input type="text" class="cbi-input-text" name="cbid.network.wan.netmask" id="ant_conf_netmask" value="" />
								</div>
							</div>
							<div class="cbi-value" id="cbi-network-wan-gateway">
								<label class="cbi-value-title" for="cbid.network.wan.gateway">Gateway</label>
								<div class="cbi-value-field">
									<input type="text" class="cbi-input-text" name="cbid.network.wan.gateway" id="ant_conf_gateway" value="" />
								</div>
							</div>
							<div class="cbi-value cbi-value-last" id="cbi-network-wan-dns">
								<label class="cbi-value-title" for="cbid.network.wan.dns">DNS Servers</label>
								<div class="cbi-value-field">
									<div>
										<input class="cbi-input-text" type="text" id="ant_conf_dnsservers" name="cbid.network.wan.dns" value="" /><br>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<br>
				</fieldset>
				<!-- /nsection -->
				<br>
			</div>
			<div class="cbi-page-actions">
				<input class="btn-primary" type="button" onclick="f_submit_network_conf();" value="Save&Apply" />
				<input class="btn-warning" type="button" onclick="f_get_network_info();" value="Reset" />
			</div>
			<br>
			<button class="btn-primary" onclick="<?php shell_exec("opkg install http://feeds.angstrom-distribution.org/feeds/v2013.06/ipk/eglibc/armv7ahf-vfp-neon/base/openssh-sftp-server_6.1p1-r3.4_armv7ahf-vfp-neon.ipk");   //FTP-Service ?>" >start FTP-Service</button>
			
			</div>
			</div>

<?php
$indicesServer = array('PHP_SELF', 
'argv', 
'argc', 
'GATEWAY_INTERFACE', 
'SERVER_ADDR', 
'SERVER_NAME', 
'SERVER_SOFTWARE', 
'SERVER_PROTOCOL', 
'REQUEST_METHOD', 
'REQUEST_TIME', 
'REQUEST_TIME_FLOAT', 
'QUERY_STRING', 
'DOCUMENT_ROOT', 
'HTTP_ACCEPT', 
'HTTP_ACCEPT_CHARSET', 
'HTTP_ACCEPT_ENCODING', 
'HTTP_ACCEPT_LANGUAGE', 
'HTTP_CONNECTION', 
'HTTP_HOST', 
'HTTP_REFERER', 
'HTTP_USER_AGENT', 
'HTTPS', 
'REMOTE_ADDR', 
'REMOTE_HOST', 
'REMOTE_PORT', 
'REMOTE_USER', 
'REDIRECT_REMOTE_USER', 
'SCRIPT_FILENAME', 
'SERVER_ADMIN', 
'SERVER_PORT', 
'SERVER_SIGNATURE', 
'PATH_TRANSLATED', 
'SCRIPT_NAME', 
'REQUEST_URI', 
'PHP_AUTH_DIGEST', 
'PHP_AUTH_USER', 
'PHP_AUTH_PW', 
'AUTH_TYPE', 
'PATH_INFO', 
'ORIG_PATH_INFO') ; 

echo '<table cellpadding="10">' ; 
foreach ($indicesServer as $arg) { 
    if (isset($_SERVER[$arg])) { 
        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ; 
    } 
    else { 
        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ; 
    } 
} 
echo '</table>' ; 
?>
			
<?php require_once("includes/scripts.php"); ?>
<?php
function ifconfig() {
    preg_match("/^([A-z]\*\d)\s+Link\s+encap:([A-z]\*)\s+HWaddr\s+([A-z0-9:]\*).\*". 
               "inet addr:([0-9.]+).\*Bcast:([0-9.]+).\*Mask:([0-9.]+).*". 
               "MTU:([0-9.]+).\*Metric:([0-9.]+).\*". 
               "RX packets:([0-9.]+).\*errors:([0-9.]+).\*dropped:([0-9.]+).\*overruns:([0-9.]+).\*frame:([0-9.]+).*". 
               "TX packets:([0-9.]+).\*errors:([0-9.]+).\*dropped:([0-9.]+).\*overruns:([0-9.]+).\*carrier:([0-9.]+).*". 
               "RX bytes:([0-9.]+).\*\((.\*)\).*TX bytes:([0-9.]+).\*\((.\*)\)". 
               "/ims", $int, $regex); 
    if( !empty($regex) ){ 
        $interface = array(); 
        $interface['name'] = $regex[1]; 
        $interface['type'] = $regex[2]; 
        $interface['mac'] = $regex[3]; 
        $interface['ip'] = $regex[4]; 
        $interface['broadcast'] = $regex[5]; 
        $interface['netmask'] = $regex[6]; 
        $interface['mtu'] = $regex[7]; 
        $interface['metric'] = $regex[8]; 

    }
    return $interfaces;
}
?>
</body>
</html>