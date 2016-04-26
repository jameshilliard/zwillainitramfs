<?php
include('includes/inc.php');

if (!$_SESSION['login_string']) {
    header('Location: login.php');
    exit();
}

session_write_close();

$errors = array();
$generalSaveResult = null;
$emailSaveResult = null;
$outputmac = shell_exec("/etc/init.d/minermac.sh 2>&1");
$outputmac = substr($outputmac, 0, 17);

if (isset($_POST) && !empty($_POST)) {
    $updatesEnabled = ($_POST['update'] == 'on') ? 1 : 0;
    $enableZwillaLicMod = ($_POST['ZwillaLicMod'] == 'on') ? 1 : 0;

    $data = array();
    $data = array(
        'update' => intval($updatesEnabled),
        'updateType' => $_POST['updateType'],
        'rigUpdateTime' => intval($_POST['rigUpdateTime']),
        'rigUpdateDelay' => ($_POST['rigUpdateDelay'] == 'on' ? 10 : 2),
        'poolUpdateTime' => intval($_POST['poolUpdateTime']),
        'walletUpdateTime' => intval($_POST['walletUpdateTime']),
        'licenceenabled' => intval($_POST['licenceenabled'] ? true : false),
        'useremailname' => $_POST['useremailname'],
        'licensekey' => $_POST['licensekey'],
        'minermac' => $outputmac,
        'licserver' => 'www.zwilla.de',
        'ridonnow' => $settings['general']['activate']['ridonnow'],
        'minerMhz' => $settings['general']['activate']['minerMhz'],
        'minerType' => $settings['general']['activate']['minerType'],
        'minerFanAuto' => $settings['general']['activate']['minerFanAuto'],
        'minerFanMin' => $settings['general']['activate']['minerFanMin'],
        'minerFanMax' => $settings['general']['activate']['minerFanMax'],
        'minerVilMod' => $settings['general']['activate']['minerVilMod'],
        'minerApiNetwork' => $settings['general']['activate']['minerApiNetwork'],
        'minerApiOn' => $settings['general']['activate']['minerApiOn'],
        'minerPool1' => $settings['general']['activate']['minerPool1'],
        'minerPool2' => $settings['general']['activate']['minerPool2'],
        'minerPool3' => $settings['general']['activate']['minerPool3'],
        'minerPool4' => $settings['general']['activate']['minerPool4'],
        'minerWorker1' => $settings['general']['activate']['minerWorker1'],
        'minerWorker2' => $settings['general']['activate']['minerWorker2'],
        'minerWorker3' => $settings['general']['activate']['minerWorker3'],
        'minerWorker4' => $settings['general']['activate']['minerWorker4'],
        'minerOnlyOnePool' => $settings['general']['activate']['minerOnlyOnePool'],
        'minerBtmOptions' => $settings['general']['activate']['minerBtmOptions'],
        'minerVolt' => $settings['general']['activate']['minerVolt'],
        'minerVoltAuto' => $settings['general']['activate']['minerVoltAuto'],
        'minerTargetTemp' => $settings['general']['activate']['minerTargetTemp'],
        'minerMaxError' => $settings['general']['activate']['minerMaxError'],
        'miner492FullSpeed' => $settings['general']['activate']['miner492FullSpeed'],
        'minerNiceHashMode' => $settings['general']['activate']['minerNiceHashMode'],
        'bitmain-dev' => $settings['general']['activate']['bitmain-dev'],
        'minerDetectHwerror' => $settings['general']['activate']['minerDetectHwerror'],
        'minerCheckn2diff' => $settings['general']['activate']['minerCheckn2diff'],
        'minerNobeeper' => $settings['general']['activate']['minerNobeeper'],
        'minerCutoffTemp' => $settings['general']['activate']['minerNiceHashMode'],
        'minerBtcAddress' => $settings['general']['activate']['minerBtcAddress'],
        'minerTout' => $settings['general']['activate']['minerTout'],
        'minerApiPort' => $settings['general']['activate']['minerApiPort'],
        'fallback492' => $settings['general']['activate']['fallback492'],
        'minerBtcSig' => $settings['general']['activate']['minerBtcSig'],
        'minerLowMem' => $settings['general']['activate']['minerLowMem'],
        'minerNoSubmitStale' => $settings['general']['activate']['minerNoSubmitStale'],
        'minerQueue' => $settings['general']['activate']['minerQueue'],
        'minerRealQuiet' => $settings['general']['activate']['minerBtcSig'],
        'minerSuggestDiff' => $settings['general']['activate']['minerSuggestDiff'],

               

    );

    $generalSaveResult = $cryptoGlance->saveSettings(array('general' => $data));
    $cryptoGlance = new CryptoGlance();
    $settings = $cryptoGlance->getSettings();
}

$jsArray = array('settings');

require_once("includes/header.php");
?>

<div id="settings-wrap" class="container sub-nav full-content">
      
      
        <div id="settings" class="panel panel-default panel-no-grid no-icon">
          <h1>CryptoGlance Settings</h1>
<div class="panel-heading">
              <h2 class="panel-title"><i class="icon icon-settingsandroid"></i> General</h2>
          </div>
<div class="panel-body">
<form class="form-horizontal" role="form" method="POST">
<fieldset>
               
                <div id="updateIntervals">
                    <h3>Update Intervals:</h3>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">Rigs:</label>
                      <div class="col-sm-3 refresh-interval">
                        <select class="form-control" name="rigUpdateTime">
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 1000) ? 'selected="selected"' : '' ?> value="1">1 second</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 2000) ? 'selected="selected"' : '' ?> value="2">2 seconds</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 3000) ? 'selected="selected"' : '' ?> value="3">3 seconds</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 5000) ? 'selected="selected"' : '' ?> value="5">5 seconds</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 7000) ? 'selected="selected"' : '' ?> value="3">7 seconds</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 10000) ? 'selected="selected"' : '' ?> value="10">10 seconds</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 15000) ? 'selected="selected"' : '' ?> value="15">15 seconds</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 30000) ? 'selected="selected"' : '' ?> value="30">30 seconds</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 60000) ? 'selected="selected"' : '' ?> value="60">1 minute</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 120000) ? 'selected="selected"' : '' ?> value="120">2 minutes</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 300000) ? 'selected="selected"' : '' ?> value="300">5 minutes</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 420000) ? 'selected="selected"' : '' ?> value="420">7 minutes</option>
                          <option <?php echo ($settings['general']['updateTimes']['rig'] == 600000) ? 'selected="selected"' : '' ?> value="600">10 minutes</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <input id="enableRigDelay" type="checkbox" name="rigUpdateDelay" <?php echo ($settings['general']['updateTimes']['rig_delay'] == 10) ? 'checked' : '' ?> />
                            <label for="enableRigDelay">Enable Rig Update Delay</label>
                        </div>
                        <span class="help-block"><i class="icon icon-info-sign"></i> Enable this setting if CryptoGlance cannot keep a steady connection with your rigs.</span>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">Pools:</label>
                      <div class="col-sm-3 refresh-interval">
                        <select class="form-control" name="poolUpdateTime">
                          <option <?php echo ($settings['general']['updateTimes']['pool'] == 60000) ? 'selected="selected"' : '' ?> value="60">1 minute</option>
                          <option <?php echo ($settings['general']['updateTimes']['pool'] == 120000) ? 'selected="selected"' : '' ?> value="120">2 minutes</option>
                          <option <?php echo ($settings['general']['updateTimes']['pool'] == 300000) ? 'selected="selected"' : '' ?> value="300">5 minutes</option>
                          <option <?php echo ($settings['general']['updateTimes']['pool'] == 600000) ? 'selected="selected"' : '' ?> value="600">10 minutes</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">Wallets:</label>
                      <div class="col-sm-3 refresh-interval">
                        <select class="form-control" name="walletUpdateTime">
                          <option <?php echo ($settings['general']['updateTimes']['wallet'] == 300000) ? 'selected="selected"' : '' ?> value="300">5 minutes</option>
                          <option <?php echo ($settings['general']['updateTimes']['wallet'] == 600000) ? 'selected="selected"' : '' ?> value="600">10 minutes</option>
                          <option <?php echo ($settings['general']['updateTimes']['wallet'] == 1800000) ? 'selected="selected"' : '' ?> value="1800">30 minutes</option>
                          <option <?php echo ($settings['general']['updateTimes']['wallet'] == 2700000) ? 'selected="selected"' : '' ?> value="2700">45 minutes</option>
                          <option <?php echo ($settings['general']['updateTimes']['wallet'] == 3600000) ? 'selected="selected"' : '' ?> value="3600">1 hour</option>
                          <option <?php echo ($settings['general']['updateTimes']['wallet'] == 7200000) ? 'selected="selected"' : '' ?> value="7200">2 hours</option>
                        </select>
                      </div>
                    </div>
                </div>
               
<hr>
<div id="ZwillaLicMod">
                    <h3>Activate your license:</h3>
                    <?php if ( $settings['general']['activate']['licserver'] == 'null') {$licserver = 'www.zwilla.de';} ?>
                    
                    <div class="form-group">
                      <div class="checkbox">
                        <input id="enableZwillaLicMod" type="checkbox" name="licenceenabled" <?php echo ($settings['general']['activate']['licenceenabled']) ? 'checked' : '' ?> value="2" />
                        
                        <label for="enableZwillaLicMod">Enable Zwilla Mod Service license</label>
                      </div>
                     
                 
<div class="form-group ZwillaLicMod-settings" <?php echo ($settings['general']['activate']['licenceenabled'])? 'style="display: none;"' : '' ?>>
                        <div class="form-group">
                          <label class="col-sm-5 control-label">Customer Email Address:</label>
                          <div class="col-sm-4 refresh-interval">
                            <input type="text" class="form-control" name="useremailname" placeholder="your_customer@email.com" value="<?php echo $_COOKIE['username']; ?>" />
                          </div>
                        </div>

                        
                    <div class="form-group">
                          <label class="col-sm-5 control-label">License Key:</label>
                          <div class="col-sm-4 refresh-interval">
                            <input type="text" class="form-control" name="licensekey" placeholder="xxxx-xxxx-xxxx" value="<?php echo $_COOKIE['licensekey']; ?>" />
                          </div>
                        </div>
                        
                    <div class="form-group">
                          <label class="col-sm-5 control-label">Miner Mac Address:</label>
                          <div class="col-sm-4 refresh-interval">
                            <input type="text" class="form-control" name="minermac" placeholder="<?php echo $outputmac; ?>" value="<?php echo $settings['general']['activate']['minermac']; ?>" disabled />
                            </div>
                        </div>
                        
</div>
</div>                
               
                <hr>
<div class="form-group">
                  <div class="col-sm-12">
                    <button type="submit" name="general" value="general" class="btn btn-lg btn-success"><i class="icon icon-save-floppy"></i> Save General Settings</button>
                  </div>
                </div>
</fieldset>
</form>


          </div>
</div>
</div>
        
        
        
<div id="cookie-wrap" class="container sub-nav full-content">
<div id="cookies" class="panel panel-default panel-no-grid no-icon">
<h1>Browser Settings</h1>
<div class="panel-heading">
                <h2 class="panel-title"><i class="icon icon-settingsandroid"></i> Cookies</h2>
            </div>
            
<div class="panel-body">
            <form class="form-horizontal" role="form">
              <fieldset>
                <div class="form-group">
                  <div class="col-sm-12">
                    <span class="help-block"><i class="icon icon-info-sign"></i> cryptoGlance cookies save preferences like panel width/positioning, and are safe to clear. Your important settings are always within the /config/configs/user_data/ folder.<br><br><b>* YOU WILL BE LOGGED OUT AFTER CLEARING COOKIES!</b></span>
                    <button name="clearCookies" class="btn btn-lg btn-danger"><i class="icon icon-programclose"></i> Clear Cookies</button>
                  </div>
                </div>
              </fieldset>
            </form>
            <br><hr>
          </div>
</div>
</div>
 


      <?php require_once("includes/scripts.php"); ?>
   </body>
</html>
