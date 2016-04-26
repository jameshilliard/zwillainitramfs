<?php
if(isset($_POST['submit'])) { 
    //eintragen();
//redirect
header('Location: netzwerk.php');
exit();
//header("Location: miner-settings.php"); 
} 


if ($_SESSION['login_string']) {
    header('Location: index.php');

}
session_write_close();


$outputmac = shell_exec("/etc/init.d/minermac.sh 2>&1");
$outputmacnow = substr($outputmac, 0, 17);
$var = '';
$cgminerconf = '';
$weitergehts = '';



  function runMyFunction() {
  }

  if (isset($_GET['checklicensenow'])) {
  	
    curllicmod();
  }
  
    if (isset($_GET['checklicensenow2'])) {
    curllicmod2();
  }
  
    if (isset($_GET['checklicensenow3'])) {
    curllicmod3();
  }
  
  if (isset($_GET['checklicensenow4'])) {
    curllicmod4();
  }
  
 /* if (isset($_GET['setcgminerconf'])) {
			$file = fopen("/config/cgminer/cgminer-s7.conf","w+");
			fwrite($file,$cgminerconf);
			fclose($file);


  }
*/
  
include("includes/my-vars.php");


require_once("includes/headar.php");
// Dann kommt der restliche Kram 


?>

<hr>
<div>
 <br>
  <br>
   <br>
<h2>Activate license and setup your Antminer with Zwilla-Mod</h2>
<p>Note: During this setup you miner is running and does what he has to do! Mining coins for you!</p>
<p><span class="error">* required field.</span></p>

</div>


<div> <a class="btn btn-primary active-layout" href='?setcgminerconf=$result'>config machen </a>

<style>
.error {color: #FF0000;}
</style>


 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <input placeholder="Fubly Zwilla" size="50" type="text" name="your_name" value="<?php echo $_COOKIE['username']; ?>" />
   <span class="error"><?php echo $your_nameErr; ?></span>
   

<?php  

$licstr = file_get_contents('/config/user_data/configs/account.json');
$jsonresult_out = json_decode($licstr, true);
$licensekeyjasontop = $jsonresult_out['licensekey'];
$istlicensekey = $_COOKIE['licensekey']; 
$licensekeyhierhash = hash('sha512', $istlicensekey);
$licensekeytest == $jsonresult_out['licensekey'];
echo "licensekeyjasontop:" . $licensekeyjasontop . "<br>";
echo "licensekeyhierhash:" . $licensekeyhierhash . "<br>";

			if ($licensekeyhierhash == $licensekeyjasontop ) {
                echo "JA ist gleich !" . "<br>";
				//curllicmod();
            } 
            else {echo "NO ist falsch" . "<br>";}
?>

   <input placeholder = "xxxx-xxxx-xxxx-xxxx-xxxx-xxxx" size="50" type="text" name="mylicense" value="<?php echo $_COOKIE['licensekey']; ?>" />

   
   <span class="error">* <?php echo $licenseErr;?></span>
   
   <p class="error"> without a valid license the miner will run in old style mode and without cgminer 4.9.2 zwilla mod full-speed mode</p>
   <p> Override this page and goto old menu, just </p>
   <a href="/old-unsecure-style/pages/index.html">click here</a><br>
   <br>
  <div> 
   <a class="btn btn-primary active-layout" href='?checklicensenow=$result'>Activate now my license for services</a>
   <a class="btn btn-primary" href='?checklicensenow2=$result'>buy now!</a> 
   <a class="btn btn-primary" href='?checklicensenow3=$result'>I want to use old style</a>
   <a class="btn btn-primary" href='?checklicensenow4=<?php echo $outputmac; ?>'>2FA activation</a> 

   </div>

 <input type="submit" name="submit" value="Write Config, Backup old Datas and Setup Miner" action="index.php" />

</form>






<?php
function curllicmod(){
include("includes/my-vars.php");
include('includes/inc.php');
   
$licstr = file_get_contents('/config/user_data/configs/account.json');
$jsonresult_out = json_decode($licstr, true);
$licensekeyjasontop = $jsonresult_out['licensekey'];



$istlicensekey = $mylicense;
$licensekeyhierhash = hash('sha512', $istlicensekey);

$licensekeytest == $jsonresult_out['licensekey'];

echo "licensekeyjasontop:" . $licensekeyjasontop . "<br>";

echo "licensekeyhierhash:" . $licensekeyhierhash . "<br>";

if ($licensekeyhierhash == $licensekeyjasontop ) {
                echo "JA ist gleich" . "<br>";
                echo "istlicensekey:" . $istlicensekey . "<br>";
                echo "$mylicense:" . $$mylicense . "<br>";
                                                  } 
            else {echo "NO ist falsch" . "<br>";}
       

}

$your_email = $_COOKIE['username'];
$nowmy_URL = "https://www.zwilla.de/?edd_action=activate_license&item_name=";
$nowmy_item = $item_name;
$nowmy_lic = "&license=" . $_COOKIE['licensekey'];
$nowmy_mac = "&url=" . $outputmacnow;

    $curl = curl_init();
    $fop = fopen($output_active,"w");
    curl_setopt ($curl, CURLOPT_URL, $nowmy_URL . $nowmy_item . $nowmy_lic . $nowmy_mac);
    curl_setopt($curl, CURLOPT_FILE, $fop);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $jsonresult = "{\"data\" : [" . curl_exec ($curl) . "]}";
    
    curl_exec ($curl);
    curl_close ($curl);
    
    fwrite($fop, $jsonresult);
    fclose($fop);
    
    
$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($jsonresult, true)),
    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        echo "$key:</br>" . "-----";
    } else {
        echo "</br> $key => $val" . ".........";
    }
}

$jsonresult_out = json_decode($jsonresult, true);

foreach ($jsonresult_out['data'] as $key => $value){
    $weitergehts = $value['license'];
    $customer_email = $value['customer_email'];
    $site_count = $value['site_count'];
    echo "donottrack: ---" . $weitergehts . "" . $customer_email . "" . $site_count . "" ;
}


function redirect($filename) {
    if (!headers_sent())
        header('Location: '.$filename);
    else 
    {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$filename.'";';
        echo '</script>';
        
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
        echo '</noscript>';
    }
}

if ($weitergehts == 'valid' && $_COOKIE['username'] == $customer_email && $site_count > 0){

//redirect('debug.php');
redirect('index.php');

//redirect('https://www.zwilla.de/de/downloads/custom-firmware-antminer-s7/');

}
else {
unset($_SESSION['login_string']);
        $error = true;
// redirect('/old-unsecure-style/pages/index.html');
}


?>

<?php
function curllicmod2()
{
function redirect($filename) {
    if (!headers_sent())
        header('Location: '.$filename);
    else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$filename.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
        echo '</noscript>';
    }
}
include('includes/inc.php');
unset($_SESSION["login_string"]);
session_unset();
session_destroy();
session_write_close();
redirect('https://www.zwilla.de/de/downloads/custom-firmware-antminer-s7/');
}

?>

<?php
function curllicmod3()
{
function redirect($filename) {
    if (!headers_sent())
        header('Location: '.$filename);
    else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$filename.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
        echo '</noscript>';
    }
    
}
redirect('https://www.bitmaintech.com/support.htm');
include('includes/inc.php');

unset($_SESSION["login_string"]);

session_unset();
session_destroy();
session_write_close();

header('Location: https://www.bitmaintech.com/support.htm');
exit();
}
?>

<?php
function curllicmod4()
{
  
$old_path = getcwd();
chdir('/etc/init.d/');
$outputmac = shell_exec("/etc/init.d/minermac.sh 2>&1");
chdir($old_path);
}
?>





<?php require_once("includes/footer.php"); ?>
   </div>
   
   <!-- /page-container -->

</body>
</html>