
<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>

<title>5.04 TH/s :: Dashboard (cryptoGlance)</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/jquery.toastmessage.css">
<link rel="stylesheet" href="../css/slider.css">
<link rel="stylesheet" href="../css/whhg.css">
<link rel="stylesheet" href="../css/bootstrap-switch.min.css">
<link rel="stylesheet" href="../css/cryptoglance-base.css">
<script src="/js/packages/jquery-1.12.3.min.js" type="text/javascript">

<script type="text/javascript">
        var documentTitle = document.title;
        var DATA_FOLDER = '/config/user_data';
        var CURRENT_VERSION = 'v2.2.1-beta-zwilla-mod';
        var rigUpdateTime = 600000;
        var poolUpdateTime = 600000;
        var walletUpdateTime = 7200000;

            </script>
            
 <?php if ($settings['general']['updates']['enabled'] == '1') {
            echo var updateType = $updateFeed[$settings['general']['updates']['type']]['feed'];
        }; ?>

</head>
<body> 

<?php
require_once('includes/inc.php');

if (!$_SESSION['login_string']) {
    header('Location: login.php');
    exit();
}
session_write_close();

// define variables and set to empty values
$your_nameErr = "";
$your_name = "";
$licenseErr = "";
$license = "";
$cgminerconflocalErr = "";
$cgminerconflocal = "";
$cgminerconfremoteErr = "";
$cgminerconfremote = "";
$minertypeErr = "";
$minertype = "Antminer S7";
$mhzErr = "";
$mhz = "";
$voltErr = "";
$volt = "";
$apiallowErr = "";
$apiallow = "";
$clactimeoutErr = "";
$clactimeout = "";
$crglhoErr = "";
$crglho = "";
$shareresultsErr = "";
$shareresults = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
   if (empty($_POST["your_name"])) {
     $nameErr = "Name is required";
   } else {
     $name = check_input($_POST["your_name"]);
     // check if name only contains letters and whitespace
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = check_input($_POST["email"]);
     // check if e-mail address is well-formed
     
   }
     
   if (empty($_POST["website"])) {
     $website = "";
   } else {
     $website = check_input($_POST["website"]);
     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
     
   }

}

function check_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>



<h2>Activate license and setup your Antminer with Zwilla-Mod</h2>
<p>Note: During this setup you miner is running and does what he has to do! Mining coins for you!</p>
<p><span class="error">* required field.</span></p>
<hr>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   Name: 
   <input placeholder="Zwilla" size="50" type="text" name="your_name2" value="Toni"/>
   <input size="50" type="text" name="your_name" value="<?php echo $your_name; ?>" />
   <span class="error">* <?php echo $your_nameErr;?></span>
   <br>
   
   <br>
   License-Key: <input placeholder = "3b5b45b7d796937f91e7b34d5f6a087fcd2382" size="50" type="text" name="license" value="<?php echo $license;?>"/>
   <span class="error">* <?php echo $licenseErr;?></span>
   <p class="error" >without a valid license the miner will run in old style mode and without cgminer 4.9.2 zwilla mod full-speed mode</p>
   Override this page and goto old menu, just <a href="/bullshit/index.php">click here</a><br>
   <br>

   <hr>
   
   <br>
   Your local Cgminer.conf (read our FAQ - start mining problem!!!): <p></p>
   <textarea name="cgminerconflocal" rows="5" cols="80"><?php echo $cgminerconflocal;?></textarea>
   <span class="error">* empty is also ok (we backup your old one) <?php echo $cgminerconflocalErr;?></span>
   <br>
   
   <br>
   Your REMOTE Cgminer.conf 'https://' !!! (will append automatic mac address to your worker! ex: zwilla.S7_34:34:34:34:34 ! : <p></p>
   <input placeholder = "https://'www.zwilla.de" size="100" type="text" name="cgminerconfremote" value="<?php echo $cgminerconfremote;?>"/>
    <span class="error">* WE DO NOT CALLING HOME !!! <?php echo $cgminerconfremoteErr;?></span>
   <br>
   
   <hr>
   
   <br>
   Antminer Typ S7 or S5 or S4 (S5 and S4 not tested ):
   <input type="radio" name="minertype" <?php if (isset($minertype) && $minertype=="minertype-s7") echo "checked";?>  value="minertype-s7">Antminer S7
   <input type="radio" name="minertype" <?php if (isset($minertype) && $minertype=="minertype-s5") echo "checked";?>  value="minertype-s5">Antminer S5
   <input type="radio" name="minertype" <?php if (isset($minertype) && $minertype=="minertype-s4") echo "checked";?>  value="minertype-s4">Antminer 4
   <span class="error">* (S5 and S4 not tested ) <?php echo $minertypeErr;?></span>
   <br>
   
   <br>
   
    <br>
   MHZ 500 525 550 575 600.. and so on: 
   <input cols="100" type="text" name="mhz" value="<?php echo $mhz;?>">
   <span class="error"><?php echo $mhzErr;?></span>
   <br>
   
   <br>
   Volt: +- 0704 to 0725 
   <input cols="100" type="text" name="volt" value="<?php echo $volt;?>">
   <span class="error">* find the best settings and share it!<?php echo $voltErr;?></span>
   <br>
   
   <br>
   Api-Allow - Example '"api-allow": "W:85.214.120.137/2, W:192.168.178.1/24",': <p></p>
   <input size="100" type="text" name="apiallow" value="<?php echo $apiallow;?>">
   <span class="error">* bullshit Bitmain allows to all an every one<?php echo $apiallowErr;?></span>
   <br>
   
    <br>
   TimeOut: +- 5 (testing your self) 
   <input size="10" type="text" name="clactimeout" value="<?php echo $clactimeout;?>">
   <span class="error"><?php echo $clactimeoutErr;?></span>
   <br>
   
   <hr>

    <br>
   Did you bought Crypto Glance Hosting form Zwilla.de: WARNING YOU HAVE TO READ OUR FAQ - SET Api-Allow !!!
    <input type="radio" name="crglho" <?php if (isset($crglho) && $crglho=="crglho_yes") echo "checked";?>  value="crglho_yes">YES
   <input type="radio" name="crglho" <?php if (isset($crglho) && $crglho=="crglho_yes") echo "checked";?>  value="crglho_no">NO
   <span class="error"><?php echo $crglhoErr;?></span>
   <br>
   
  <br>
   Do you want to share your settings and results with others (now we have to call home! only once a day to our https server):
   <input type="radio" name="shareresults" <?php if (isset($minertype) && $shareresults=="shareresults_yes") echo "checked";?>  value="shareresults_yes">YES
   <input type="radio" name="shareresults" <?php if (isset($minertype) && $shareresults=="shareresults_no") echo "checked";?>  value="shareresults_no">NO
   <span class="error">* (if yes, we have to call home! ) <?php echo $shareresultsErr;?></span>
   <br>
   
    <br>
     <br>
      <br>
       <br>
   
   
   
   
   <input type="submit" name="submit" value="Write Config, Backup old Datas and Setup Miner"> 
</form>

<?php
echo "<h2>Your License and Settings:</h2>";
echo $your_name;
echo "<br>";
echo $license;
echo "<br>";
echo $cgminerconflocal;
echo "<br>";
echo $cgminerconfremote;
echo "<br>";
echo $minertype;
echo "<br>";
echo $mhz;
echo "<br>";
echo $volt;
echo "<br>";
echo $apiallow;
echo "<br>";
echo $clactimeout;
echo "<br>";
echo $crglho;
echo "<br>";
echo $shareresults;
?>


<?php
//Get the email from POST
$your_name = $_REQUEST['your_name'];
$license = $_REQUEST['license'];
$cgminerconflocal = $_REQUEST['cgminerconflocal'];
$cgminerconfremote = $_REQUEST['cgminerconfremote'];
$minertype = $_REQUEST['minertype'];
$mhz = $_REQUEST['mhz'];
$volt = $_REQUEST['volt'];
$apiallow = $_REQUEST['apiallow'];
$clactimeout = $_REQUEST['clactimeout'];
$crglho = $_REQUEST['crglho'];
$shareresults = $_REQUEST['shareresults'];

$file = fopen("/config/user_data/configs/license-info.conf","w+");
fwrite($file,$your_name);
fwrite($file,$license);
fwrite($file,$cgminerconflocal);
fwrite($file,$cgminerconfremote);
fwrite($file,$minertype);
fwrite($file,$mhz);
fwrite($file,$volt);
fwrite($file,$apiallow);
fwrite($file,$clactimeout);
fwrite($file,$crglho);
fwrite($file,$shareresults);
print_r(error_last());

//redirect
//header("Location: info.php");
?>





</body>
</html>