<?PHP
date_default_timezone_set('America/Los_Angeles');
// define variables and set to empty values
$outputmac = shell_exec("/etc/init.d/minermac.sh 2>&1");
$outputmacnow = substr($outputmac, 0, 17);
$your_nameErr = "";
$your_name = "Zwilla";
$your_nameErr = "";
$your_email = "info@zwilla.de";
$licenseErr = "";
$licensedemo = "";
$licserverreff = "https://www.zwilla.de/?edd_action=";
$cgminerconflocalErr = "";
$cgminerconflocal = "no_cgminerconflocal";
$cgminerconfremoteErr = "";
$cgminerconfremote = "https://www.zwilla.de/user/xxx-xxx-xxx-xxx";
$minertypeErr = "";
$minertype = "minertype-s7";
$mhzErr = "";
$mhz = "600";
$voltErr = "";
$volt = "0704";
$apiallowErr = "";
$apiallow = "\"api-allow\": \"W:85.214.120.137/2,192.168.178.1/24,127.0.0.1\" , ";
//$apiallow = ;
$clactimeoutErr = "";
$clactimeout = "7";
$crglhoErr = "";
$crglho = "crglho_yes";
$shareresultsErr = "";
$shareresults = "shareresults_yes";
$conf_date = date("d.m.y");
$conf_time = date("H:i:s");
$templecense = "";
//$item_name = "Custom Firmware Antminer S7 Zwilla Mod with cgminer 4.9.2 and crypto glance";
$item_name = "Custom%20Firmware%20Antminer%20S7%20Zwilla%20Mod%20with%20cgminer%204.9.2%20and%20crypto%20glance";
$delete_old_session = true;
$USER_SETTINGS_PATH="/config/user_data/configs";
$USER_SETTINGS_ACCOUNT="/config/user_data/configs/account.json";
$USER_SETTINGS_CGL="/config/user_data/configs/cryptoglance.json";
$USER_SETTINGS_MINERS="/config/user_data/configs/miners.json";
$USER_SETTINGS_LIC="/config/user_data/configs/license.json";
$USER_SETTINGS_INFO="/config/user_data/configs/license-info.conf";

$output_check="/config/user_data/configs/license-check.json";
$edd_action_cl="check_license";
 
$output_active="/config/user_data/configs/license-active.json";
$edd_action_ac="activate_license";
 
$output_deactive="/config/user_data/configs/license-deactive.json";
$edd_action_deac="deactivate_license";
 
$output_getversion="/config/user_data/configs/license-getversion.json";
$edd_action_get="get_version";

$user_agent="antminer-S7-zwilla-mod/1.0";
$referer="https://www.zwilla.de/";
//$result ="";
?>