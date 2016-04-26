<?php
include("includes/inc.php");


if (!$_SESSION['login_string']) {
    header('Location: login.php');
    exit();
}
if (empty($_COOKIE["licensekey"])){header("Location:logout.php");}

session_write_close();
$errors = array();
$generalSaveResult = null;
$emailSaveResult = null;
$outputmac = shell_exec("/etc/init.d/minermac.sh 2>&1");
$outputmacnow = substr($outputmac, 0, 17);
$outputmac = $outputmacnow;



if (isset($_POST) && !empty($_POST)) {

    $updatesEnabled = ($_POST['update'] == 'on') ? 1 : 0;
    $enableMiner492FullSpeed = ($_POST['miner492FullSpeed'] == '1') ? 1 : 0;

    // $_POST['gender'] == "male"  ? "male" : "female";


	$data = array();
    $data = array(
        'minerMhz' => $_POST['minerMhz'],
        'minerType' => $_POST['minerType'],
        'minerFanAuto' => $_POST['minerFanAuto'],
        'minerFanMin' => $_POST['minerFanMin'],
        'minerFanMax' => $_POST['minerFanMax'],
        'minerVilMod' => $_POST['minerVilMod'],
        'minerApiNetwork' => $_POST['minerApiNetwork'],
        'minerApiOn' => $_POST['minerApiOn'],
        'minerApiPort' => $_POST['minerApiPort'],
        'minerPool1' => $_POST['minerPool1'],
        'minerPool2' => $_POST['minerPool2'],
        'minerPool3' => $_POST['minerPool3'],
        'minerPool4' => $_POST['minerPool4'],
        'minerWorker1' => $_POST['minerWorker1'],
        'minerWorker2' => $_POST['minerWorker2'],
        'minerWorker3' => $_POST['minerWorker3'],
        'minerWorker4' => $_POST['minerWorker4'],
        'minerOnlyOnePool' => $_POST['minerOnlyOnePool'],
        'minerBtmOptions' => $_POST['minerBtmOptions'],
        'minerTout' => $_POST['minerTout'],
        'minerVolt' => $_POST['minerVolt'],
        'minerVoltAuto' => $_POST['minerVoltAuto'],
        'minerTargetTemp' => $_POST['minerTargetTemp'],
        'minerMaxError' => $_POST['minerMaxError'],
        'miner492FullSpeed' => $_POST['miner492FullSpeed'],
        'fallback492' => $_POST['fallback492'],
        'minerNiceHashMode' => $_POST['minerNiceHashMode'],
        'bitmaindev' => $_POST['bitmaindev'],
        'minerDetectHwerror' => $_POST['minerDetectHwerror'],
        'minerCheckn2diff' => $_POST['minerCheckn2diff'],
        'minerNobeeper' => $_POST['minerNobeeper'],
        'minerCutoffTemp' => $_POST['minerCutoffTemp'],
        'minerBtcAddress' => $_POST['minerBtcAddress'],
        'minerBtcSig' => $_POST['minerBtcSig'],
        'minerLowMem' => $_POST['minerLowMem'],
        'minerNoSubmitStale' => $_POST['minerNoSubmitStale'],
        'minerQueue' => $_POST['minerQueue'],
        'minerRealQuiet' => $_POST['minerRealQuiet'],
		'minerSuggestDiff' => $_POST['minerSuggestDiff'],
        //'miner492FullSpeed' => $_POST['miner492FullSpeed'],
        'minerMac' => $outputmacnow,
        'licserver' => 'www.zwilla.de',
        'ridonnow' => $_COOKIE['makerunningmode'],
        'update' =>  $settings['general']['updates']['update'],
        'updateType' => $settings['general']['updates']['updateType'],
        'rigUpdateTime' => $settings['general']['updateTimes']['rigUpdateTime'],
        'rigUpdateDelay' => $settings['general']['updateTimes']['rig_delay'],
        'poolUpdateTime' => $settings['general']['updateTimes']['pool'],
        'walletUpdateTime' => $settings['general']['updateTimes']['wallet'],
        'licenceenabled' => $settings['general']['activate']['licenceenabled'],
        'useremailname' => $settings['general']['activate']['useremailname'],
        'licensekey' => $settings['general']['activate']['licensekey'],
);

    
    

}


$cryptoGlance = new CryptoGlance();
$settings = $cryptoGlance->getSettings();
$getsettings = $cryptoGlance->getSettings();

setcookie('makerunningmode', $settings['general']['activate']['ridonnow']);

if (isset($_POST) && !empty($_POST) && $_COOKIE['makerunningmode'] == "Z-Mod492") {

    $generalSaveResult = $cryptoGlance->saveSettings(array('general' => $data));
    $zMode = "Z-Mod492";
    require_once("includes/cgminerset492.php");
    setcookie('makerunningmode', 'Z-Mod492');
    header('Location: cgminer-conf.php');
}

if (isset($_POST) && !empty($_POST) && $_COOKIE['makerunningmode'] == "Z-Mod480") {

    $generalSaveResult = $cryptoGlance->saveSettings(array('general' => $data));
    $zMode = "Z-Mod480";
    require_once("includes/cgminerset480.php");
    setcookie('makerunningmode', 'Z-Mod480');
    header('Location: cgminer-conf.php');
}

if (isset($_POST) && !empty($_POST) && $_COOKIE['makerunningmode'] == "Overkill") {

    $generalSaveResult = $cryptoGlance->saveSettings(array('general' => $data));
    $zMode = "Overkill";
    require_once("includes/cgminerset492fullspeed.php");
    setcookie('makerunningmode', 'Overkill');
    header('Location: cgminer-conf.php');
}



$jsArray = array('settings');


				 	  
require_once("includes/header.php");
require_once('includes/footernav.php');
?>

    
<?php
if (!file_exists("/config/zwilla-mod/notfirsttime.txt")) { ?>
	<li class="nav-item topnav topnav-icon">
	<a type="button" class="btn btn-danger btn-sm" data-toggle="modal" href="<?php setMinerWorksFine(); ?> ">Click here one time if your miner is running perfect with zwilla mod</a>
	</li>
<?php } ?>



    
<?php
function setMinerWorksFine()
{
$allfinehere = fopen("/config/zwilla-mod/notfirsttime.txt", "w+") or die("Unable to open file!");
$yeah = "imupgradingzwillamod\n";
fwrite($allfinehere, $yeah);
fclose($allfinehere);
}
?>





<!-- (mining farm setup = ask, please) --> 
<div id="settings-wrap" class="container sub-nav full-content">
    
<div id="settings" class="panel panel-default panel-no-grid no-icon">
          <h1>Local Miner Settings</h1><br>

<div class="panel-heading">
<h2 class="panel-title"><i class="icon icon-settingsandroid"></i> General</h2>
</div>



          
<div class="col-sm-12" > 
<hr>


</div>

<div class="panel-body">

<form class="form-horizontal" role="form" method="POST" action="my_local_miner.php">


<!-- (c) 2016 zwilla Miner Type-->
<?php if ($_COOKIE['makerunningmode']  != "Old-Mode"){ ?>
<button type="button" class="btn btn-danger btn-lg"  data-toggle="modal" onclick="$.cookie('ReadWarnings', 'yes');" data-target="#myModal0">WARNING READ THIS!</button>
<?php } ?>
    <hr>

    <!-- MinerType -->
 <div class="form-group">

                <label for="minerType" class="col-sm-4 control-label">Miner Type</label>
                <div class="col-sm-5">
                  <select class="form-control" id="selectMinerType" name="minerType">
                    <?php foreach ($cryptoGlance->supportedMiners() as $val => $name) { ?>
                    <option value="<?php echo $val; ?>" <?php echo (strtolower($settings['general']['activate']['minerType']) == strtolower($val)) ? 'selected' : '' ?>><?php echo $name; ?></option>
                    <?php } ?>
                  </select>
                </div>
     </div>           


    <!-- 492FullSpeed ALL -->

<div class="form-group">

    <!-- 492FullSpeed  -->
<div class="checkbox">Zwilla Mod: 4.9.2 (green)

    <input id="enableMiner492FullSpeed" type="checkbox" name="miner492FullSpeed" <?php echo ($settings['general']['activate']['miner492FullSpeed']) ? 'checked' : '' ?> value='1' />

<label for="enableMiner492FullSpeed">  : <-- 4.8.0 (red)</label>
 </div>


<div class="form-group 492FullSpeed" <?php echo ($settings['general']['activate']['miner492FullSpeed'])? 'style="display: none;"' : '' ; ?> >
<p class="alert orange"> Your Miner will run in  <?php echo $settings['general']['activate']['ridonnow'] ; ?>  - Mode after <br>saving and restart mining software!</p>
</div>

<?php
if (!$settings['general']['activate']['miner492FullSpeed']) {$zMode = "Z-Mod480";}
if ($settings['general']['activate']['miner492FullSpeed']) {$zMode = "Z-Mod492";}

?>           
<!-- MHZ -->
 <div class="form-group">
                <label for="minerType" class="col-sm-5 control-label">Miner Mhz</label>
                <div class="col-sm-3">
                  <select class="form-control" id="selectMinerMhz" name="minerMhz">
                    <?php /** @noinspection PhpMethodOrClassCallIsNotCaseSensitiveInspection */
                    /** @noinspection PhpMethodOrClassCallIsNotCaseSensitiveInspection */
                    /** @noinspection PhpMethodOrClassCallIsNotCaseSensitiveInspection */
                    foreach ($cryptoGlance->supportedMhz() as $val => $name) { ?>
                    <option value="<?php echo $val; ?>" <?php echo (strtolower($settings['general']['activate']['minerMhz']) == strtolower($val)) ? 'selected' : '' ?>><?php echo $name; ?></option>
                    <?php } ?>
                  </select>
                </div>
</div>
              

<!-- Zwilla Mod Options minerTout -->
<hr>
<label class="col-sm-6 control-label">Zwilla Mod Special Miner Option - Time Out for Asic:
<input required="true" autocomplete="on" type="text" class="form-control" name="minerTout" placeholder="form 1 to 42 seconds (7)" value="<?php echo $settings['general']['activate']['minerTout']; ?>" />
<br><hr>
</label>

<!-- Zwilla Mod Options  minerTout-->
<label class="col-sm-6 control-label">Zwilla Mod Special Miner Options ALL:
<input required="true" autocomplete="on" type="text" class="form-control" name="minerBtmOptions" placeholder="115200:32:8:7:200:0782:0725" value="<?php echo $settings['general']['activate']['minerBtmOptions']; ?>" />
<br>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal3">You need help!?</button>
<hr>
</label>
<hr>

      
<!-- minerTargetTemp -->
 <div class="form-group">
                <label for="minerTargetTemp" class="col-sm-6 control-label">Miner Target Temp</label>
                <div class="col-sm-4">
                  <select class="form-control" id="selectMinerTargetTemp" name="minerTargetTemp">
                    <?php foreach ($cryptoGlance->supportedTTemp() as $val => $name) { ?>
                    <option value="<?php echo $val; ?>" <?php echo (strtolower($settings['general']['activate']['minerTargetTemp']) == strtolower($val)) ? 'selected' : '' ?>><?php echo $name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              
 <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Temperature and Humidity level</button>
<hr>

<!-- minerCutoffTemp -->
 <div class="form-group">
                <label for="minerCutoffTemp" class="col-sm-6 control-label">Miner Cut Off Temp</label>
                <div class="col-sm-4">
                  <select class="form-control" id="selectMinerCutoffTemp" name="minerCutoffTemp">
                    <?php foreach ($cryptoGlance->supportedCutOff() as $val => $name) { ?>
                    <option value="<?php echo $val; ?>" <?php echo (strtolower($settings['general']['activate']['minerCutoffTemp']) == strtolower($val)) ? 'selected' : '' ?>><?php echo $name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>


<!--Volt or Auto-Volt -->
<div class="form-group">
<div class="checkbox">
<input id="enableMinerVoltauto" type="checkbox" name="minerVoltAuto" <?php echo ($settings['general']['activate']['minerVoltAuto']) ? 'checked' : '' ?> value="1" />
<label for="enableMinerVoltauto">Overvolt under Volt</label>
 </div>
 
<div class="form-group MinerVolt" <?php echo ($settings['general']['activate']['minerVoltAuto'])? 'style="display: none;"' : '' ?>>
                <label for="minerVolt" class="col-sm-4 control-label">Miner Voltage</label>
                <div class="col-sm-5">
                  <select class="form-control" id="selectMinerVolt" name="minerVolt">
                    <?php foreach ($cryptoGlance->supportedVoltage() as $val => $name) { ?>
                     <option value="<?php echo $val; ?>" <?php echo (strtolower($settings['general']['activate']['minerVolt']) == strtolower($val)) ? 'selected' : '' ?>><?php echo $name; ?></option>
                        <?php } ?>
                  </select>
                  

                </div>
              </div>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal2">Best Practices...Power Supplies</button>
              <hr>


<!--Fan Min Max Auto -->
<div class="form-group">
<div class="checkbox">
    <input id="enableMinerFanAuto" type="checkbox" name="minerFanAuto" <?php echo ($settings['general']['activate']['minerFanAuto']) ? 'checked' : '' ?> value="true" />
    <label for="enableMinerFanAuto">Fan Auto Modus</label>
 </div>

<div class="form-group FanAuto" <?php echo ($settings['general']['activate']['minerFanAuto'])? 'style="display: none;"' : '' ?>>
                <label for="minerFanMin" class="col-sm-4 control-label">FAN Min / Max Speed</label>
                <div class="col-sm-5">
                  <select class="form-control" id="selectMinerFanMin" name="minerFanMin">
                    <?php foreach ($cryptoGlance->supportedFanMin() as $val => $name) { ?>
                     <option value="<?php echo $val; ?>" <?php echo (strtolower($settings['general']['activate']['minerFanMin']) == strtolower($val)) ? 'selected' : '' ?>><?php echo $name; ?></option>
                        <?php } ?>
                  </select>
                  
                   <select class="form-control" id="selectMinerFanMax" name="minerFanMax">
                    <?php foreach ($cryptoGlance->supportedFanMin() as $val => $name) { ?>
                     <option value="<?php echo $val; ?>" <?php echo (strtolower($settings['general']['activate']['minerFanMax']) == strtolower($val)) ? 'selected' : '' ?>><?php echo $name; ?></option>
                        <?php } ?>
                  </select>
                  
                </div>
              </div>
              <hr>

<!-- Pool Settings -->
<div class="form-group">
<fieldset>
<legend>Your Pool Settings - (enable AutoWorker = next release)</legend>

<label class="col-sm-10 control-label">Pool 1:
<input required="true" autocomplete="on" type="text" class="form-control" name="minerPool1" placeholder="kano.is:3333" value="<?php echo $settings['general']['activate']['minerPool1']; ?>" />
<input required="true" autocomplete="on" type="text" class="form-control" name="minerWorker1" placeholder="<?php echo "worker_" . $outputmac; ?>" value="<?php echo $settings['general']['activate']['minerWorker1']; ?>" />
<br><p></p><hr>
</label>

<label class="col-sm-10 control-label">Pool 2:
<input required="true" autocomplete="on" type="text" class="form-control" name="minerPool2" placeholder="de.kano.is:3333" value="<?php echo $settings['general']['activate']['minerPool2']; ?>" />
<input required="true" autocomplete="on" type="text" class="form-control" name="minerWorker2" placeholder="<?php echo "worker_" . $outputmac; ?>" value="<?php echo $settings['general']['activate']['minerWorker2']; ?>" />
<br><p></p><hr>
</label>

<label class="col-sm-10 control-label">Pool 3:
<input required="true" autocomplete="on" type="text" class="form-control" name="minerPool3" placeholder="jp.kano.is:3333" value="<?php echo $settings['general']['activate']['minerPool3']; ?>" />
<input autocomplete="on" type="text" class="form-control" name="minerWorker3" placeholder="<?php echo "worker_" . $outputmac; ?>" value="<?php echo $settings['general']['activate']['minerWorker3']; ?>" />
<br><p></p><hr>
</label>

<label class="col-sm-10 control-label">Pool 4:
<input required="true" autocomplete="on" type="text" class="form-control" name="minerPool4" placeholder="as.kano.is:3333" value="<?php echo $settings['general']['activate']['minerPool4']; ?>" />
<input required="true" autocomplete="on" type="text" class="form-control" name="minerWorker4" placeholder="<?php echo "worker_" . $outputmac; ?>" value="<?php echo $settings['general']['activate']['minerWorker4']; ?>" />
<br><p></p><hr>
</label>

<!-- Api Port -->
<label class="col-sm-10 control-label">Your Api Port (please not 4028):
<input required="true" autocomplete="on" type="text" class="form-control" name="minerApiPort" placeholder="from 1.xxx to 64.xxx" value="<?php echo $settings['general']['activate']['minerApiPort']; ?>" />
<br><p></p><hr>
</label>


<!-- Pool fallback492  -->
<label class="col-sm-10 control-label">Pool fallback after x seconds:
<input required="true" autocomplete="on" type="text" class="form-control" name="fallback492" placeholder="120 is default" value="<?php echo $settings['general']['activate']['fallback492']; ?>" />
<br><p></p><hr>
</label>

<!-- minerSuggestDiff -->
<label class="col-sm-10 control-label">Suggest Diff for Pools:
<input required="true" autocomplete="on" type="text" class="form-control" name="minerSuggestDiff" placeholder="2813" value="<?php echo $settings['general']['activate']['minerSuggestDiff']; ?>" />
<br><p></p><hr>
</label>
<!-- minerBtcAddress -->
<label class="col-sm-10 control-label">Your Btc Address:
<input required="true" autocomplete="on" type="text" class="form-control" name="minerBtcAddress" placeholder="16L45ub3SpHZ6dYbqseip7Fv4BEJSj9xEo" value="<?php echo $settings['general']['activate']['minerBtcAddress']; ?>" />
<br><p></p><hr>
</label>
<!-- minerBtcSig -->
<label class="col-sm-10 control-label">Your desired signature if you find a block (solo mining):
<input required="true" autocomplete="on" type="text" class="form-control" name="minerBtcSig" placeholder="we trust in btc - your name" value="<?php echo $settings['general']['activate']['minerBtcSig']; ?>" />
<br><p></p><hr>
</label>

<!-- minerApiNetwork -->
<label class="col-sm-10 control-label">Api Allow Network - to grap Stats and execute commands:
<input required="true" autocomplete="on" type="text" class="form-control" name="minerApiNetwork" placeholder="W:85.214.120.137/2,192.168.178.1/24,127.0.0.1" value="<?php echo $settings['general']['activate']['minerApiNetwork']; ?>" />
<br>
    <hr>
</label>

</fieldset>
<hr>
</div>



/** Max Error 0,0x %  ( = next release! For now, use the api-setting, please.) **/
<div class="form-group">
<label class="col-sm-5 control-label">Maximum Error Rate :</label>
<div class="col-sm-2 refresh-interval">
 <select class="form-control" id="selectminerMaxError" name="minerMaxError">
<?php foreach ($cryptoGlance->supportedFanMin() as $val => $name) { ?>
<option value="<?php echo $val; ?>" <?php echo (strtolower($settings['general']['activate']['minerMaxError']) == strtolower($val)) ? 'selected' : '' ?>><?php echo $name; ?></option>
<?php } ?>
</select>
</div>
</div>
<hr>


<!-- License Key 1 -->

<div class="form-group">
<label class="col-sm-5 control-label">License Key:</label>
<div class="col-sm-4 refresh-interval">
<input required="true" readonly="true" type="text" class="form-control" name="licensekey" placeholder="xxxx-xxxx-xxxx" value="<?php echo $settings['general']['activate']['licensekey']; ?>" />

</div></div><hr>



<div class="form-group">
                  <div class="col-sm-6">
                    <button type="submit" name="general" value="general" class="btn btn-lg btn-warning btn-block"  onclick="$.cookie('makerunningmode', 'Z-Mod492');">
                        <i class="icon icon-save-floppy"> </i> Make Z-Mod 492 (red)</button>
                      <br>
                      <button type="submit" name="general" value="general" class="btn btn-lg btn-danger btn-block"  onclick="$.cookie('makerunningmode', 'Overkill');">
                          <i class="icon icon-save-floppy"> </i> Make Overkill Mod</button>

                      <button type="submit" name="general" value="general" class="btn btn-lg btn-primary btn-block"  onclick="$.cookie('makerunningmode', 'Z-Mod480');">
                          <i class="icon icon-save-floppy"> </i> Make Z-Mod 480</button>

                      <button href="/cgminer-conf.php" type="submit" name="general" value="general" class="btn btn-lg btn-success btn-block disabled"  onclick="$.cookie('makerunningmode', 'Old-Mod');">
                          <i class="icon icon-save-floppy"> </i> Set Old-Mode (not here)</button>

                  </div>
                  <div class="col-sm-6">
                    <a name="cecknow" class="btn btn-lg btn-info" href="cgminer-conf.php"><i class="icon icon-notes"></i> check your config here!</a>
                  </div>
                </div>


</form>

</div>        
 <!--********-->  
 
<!-- Modal WARNING-->
<div id="myModal0" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">WARNING DESTROY MINER</h4>
</div>
<div class="modal-body">
<br>
On entering this Menu here, some changes to the settings are made<br>
<br>
If you not know, how you can setup your miner best, use our website,
bitcointalk or what ever!<br>
<br>
You can damage you mining hardware within seconds! All settings which
we offer here are handpicked from source code (github)<br>
<br>
How many ports does you need? 3, 6, 9. This SD-Card firmware offers you
3! What we need to give you more ports is a little piece of code from
your miner. I was developing on batch 7 with 5,06 Th/s.<br>
<br>
It was hard to figure out, whats the problem on getting more ports. Now
we know, and also we know how to open all the ports for you, but we
need this littel piece of code, from every batch to open them. If you
want to help contact us or simply send us your uboot.bin and MLO file.<br>
<br>
With the next update we will offer an full-flashing firmware, but for
now, we do not want to touch your miner. For this we deliver only this
SD-Card Firmware!<br>
<br>
It was a b..s hard 5 month work to crack into this f.. system. And sorry
again for waiting, but I had one problem after the other. fX: Firsttime
compiling with cgminer 4.9.2 we got 1700 errors and 20.000 other
problems.<br>
<br>
What you see here is the result of 5 month hard work and learning! So
please hack this soft and share it with the community! - no  thx.  Or do
you want to health the world for 20 bucks?<br>
<br>
OK, lets start with the experiment for the miner version 4.9.2:<br>
<br>
There exist a critical option, called --Bitmain-options here and
absolutely starts the experiment! We have to share our results to
figure out the best settings. Please start anyone a bitcointalk
thread to sum all values and find out the best settings. Thx.<br>
<br>
One Question: "Why we have to wait for this firmware?"<br>
<a
href="https://www.zwilla.de/de/loesungen/bitcoin/miner/antminer/making-of-antminer-custom-firmware/"
target="_blank">Because: Just watch our making of video on our HomePage</a>"&nbsp;&nbsp;
<br>
After leaving this settings page you have to check your settings and then 
kill and restart the mining software and then monitor your miner what he is doing!
<br>
If you want to ride the old style, just klick on OLD STYLE, but remember to check your settings!
Do not use the upgrade buttons until we let you know, that they are working fine and perfect
for everyone!
<a href="https://www.zwilla.de/de/loesungen/bitcoin/miner/custom-firmware-zwilla-mod-change-log/" target="_blank">
Check our homepage for news and changelog!</a>
<br>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>

<!-- Modal Humi-->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Humidity level</h4>
</div>
<div class="modal-body">
<br>
Maintaining proper humidity levels in the computer room is essential
for reliable equipment performance. <br>
Humidity levels outside the recommended range of 25% to 45%, especially
if these levels are sustained, lead <br>
to equipment damage and result in equipment malfunction through several
mechanisms.<br>
<br>
High humidity levels enable galvanic activity to occur between
dissimilar metals. Galvanic activity can cause <br>
high resistance to develop between connections and lead to equipment
malfunctions and failures. Extended <br>
periods of humidity levels greater than 60% have also been shown to
adversely affect modern printed circuit <br>
board reliability. High humidity can also adversely affect some
magnetic tapes and paper media.<br>
High humidity levels are often the result of malfunctioning facility
air conditioning systems<br>
<br>
High humidity can&nbsp; also be the result of facility expansion in
excess of air conditioning system capacity.<br>
Humidity levels below the minimum recommended value can also have
undesirable effects. Low humidity <br>
contributes to high ESD voltage potentials. ESD events can cause
component damage during service <br>
operations and equipment malfunction or damage during normal operation.
Low humidity levels can reduce <br>
the effectiveness of static dissipating materials and have also been
shown to cause high speed printer p<br>
aper feed problems.<br>
<br>
Low humidity levels are often the result of the facility heating system
and occur during the cold season. Most <br>
heating systems cause air to have a low humidity level, unless the
system has a built-in humidifier.<br>
IT equipment manufacturers recommend a range of 18C dry bulb with a <br>
5.5C dew point temperature to 27C dry bulb with a 5.5C dew point
temperature. Over this range of dry <br>
bulb temperature with a 5.5C dew point, the relative humidity varies
from approximately 25% to 45%.<br>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>

<!-- Modal PSU-->
<div id="myModal2" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Best Practices for Boosting Reliability in Power Supplies</h4>
</div>
<div class="modal-body">
By Ashok Bindra<br>
<br>
Contributed By Electronic Products<br>
<br>
2014-07-29<br>
<br>
Although at first glance power supplies may not be as glamorous as
microprocessors or DSPs, they are a necessary part of an electronic
system because any supply failure can bring that system to a halt. Its
poor performance can compromise the quality of a given product. As a
result, both outright supply failure and poor performance are of great
concern to system designers. In other words, the reliability of a power
supply in any system is absolutely critical.<br>
<br>
To select or build a reliable power supply requires a full
understanding of factors and stresses impacting the reliability of the
product. This article will explore the meaning of reliability and the
key difference between reliability and failure rate, as put forth in a
white paper by CUI titled Reliability Considerations for Power
Supplies. It will also discuss how a manufacturer like CUI is
improving reliability through design, component selection, and
manufacturing process. A few examples will demonstrate how the supplier
is incorporating and specifying these practices in AC/DC and DC/DC
converter modules manufactured by the company.<br>
<br>
Reliability and failure<br>
<br>
Before investigating the process involved in boosting the reliability
of a power supply, it is important to first understand its definition
and the difference between reliability and the failure rate. Per CUIs
white paper, reliability is the probability that the supply, operating
under specified conditions, works properly for a given period of time.
Failure rate is the percentage of units that fail in a given unit of
time. As shown in Figure 1, it follows a bathtub curve and has been
classified into three key phases by engineers, which include infant
mortality, useful life, and wear-out. While infant mortality is the
result of poor workmanship and inferior quality components, the second
phase, which is useful life, keeps failure rate low and constant to
keep the supply in proper operation for a longer time. In the wear-out
phase, which is third and final, the supply fails when its components
reach the end of their operating life. <br>
<br>
<a
href="http://www.digikey.com/en/articles/techzone/2014/jul/best-practices-for-boosting-reliability-in-power-supplies"
target="_blank">read more</a><br>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>     
        

<!-- Modal BTM-Options-->
<div id="myModal3" class="modal fade" role="dialog ">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Experimental Settings - Share your Results</h4>
</div>
<div class="modal-body">
<br>
Share your results, take a look at our website for more help and best settings atm.
<br>
<a
href="https://www.zwilla.de/faq-items/custom-firmware-antminer-s7/"
target="_blank">read more and share your results</a><br>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>


    <!-- Modal Old-Version-->
    <div id="myModal4" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Running in Old-Mode ?</h4>
                </div>
                <div class="modal-body">
                    <br>
                    on using this menu, your settings are overwrittten! If you restart the mining software or after
                    reboot, your miner will run in one of these settings.
                    <br>
                    Do not reboot until you know, that your miner is running with this settings perfect!
                    <br>
                    thx
                    zwilla
                    <br>
                    <a
                        href="https://www.zwilla.de/faq-items/custom-firmware-antminer-s7/"
                        target="_blank">read more and share your results</a><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK! I understand!</button>
                </div>
            </div>

        </div>
    </div>

</div>
    <script type="text/javascript">


        var today = new Date();
        var expiry = new Date(today.getTime() -1); // plus 30 days

        function setCookie(name, value)
        {
            document.cookie=name + "=" + (value) + "; path=/; expires=" + expiry.getUTCDate();
        }

    </script>
 </div>

<!-- (c) Warning Old-Mode overwritten-->
<?php if ($_COOKIE['makerunningmode'] == "Old-Mod"){ ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal4').modal({
                show: true,
            })
        });
    </script>
<?php } ?>


<!-- (c) Warning Old-Mode overwritten-->
<?php if ($_COOKIE['makerunningmode'] == "check_now"){ ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal3').modal({
                show: true,
            })
        });
    </script>
<?php } ?>


<?php require_once("includes/scripts.php");?>


