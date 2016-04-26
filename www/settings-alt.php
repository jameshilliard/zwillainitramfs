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

if (isset($_POST) && !empty($_POST)) {
    $updatesEnabled = ($_POST['update'] == 'on') ? 1 : 0;
    $mobileminerEnabled = ($_POST['mobileminer'] == 'on') ? 1 : 0;

    $data = array();
    
    $data = array(
        'update' => intval($updatesEnabled),
        'updateType' => $_POST['updateType'],
        'rigUpdateTime' => intval($_POST['rigUpdateTime']),
        'rigUpdateDelay' => ($_POST['rigUpdateDelay'] == 'on' ? 10 : 2),
        'poolUpdateTime' => intval($_POST['poolUpdateTime']),
        'walletUpdateTime' => intval($_POST['walletUpdateTime']),
        'licencetab' => intval($enablelicence),
        'useremailname' => $_POST['useremailname'],
        'licensekey' => $_POST['licensekey'],
        'minermhz' => intval($_POST['minermhz']),

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
                
                <hr />
                <div id="licencetab">
                    <h3>Activate Zwilla Mod Service license:</h3>
                    <div class="form-group">
                      <div class="checkbox">
                        <input id="licence" type="checkbox" name="licence" <?php echo ($settings['general']['activate']['enabled']) ? 'checked' : '' ?> />
                        <label for="enablelicence">Enable my license</label>
                      </div>
                    </div>
                    <div class="form-group mobileminer-settings" style="display: <?php echo ($settings['general']['activate']['enabled']) ? 'block' : 'none' ?>;">
                        <div class="form-group">
                          <label class="col-sm-5 control-label">Customer Email Address:</label>
                          <div class="col-sm-4 refresh-interval">
                            <input size="35" type="text" class="form-control" name="useremailname" placeholder="your-customer@email.address.com" value="<?php echo $settings['general']['activate']['useremailname']; ?>" />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-5 control-label">License Key:</label>
                          <div class="col-sm-4 refresh-interval">
                            <input size="35" type="text" class="form-control" name="licensekey" placeholder="xxxx-xxxx-xxxx-xxxx-xxxx-xxx" value="<?php echo $settings['general']['activate']['licensekey']; ?>" />
                          </div>
                        </div>
                    </div>
                </div>
                
                <hr />
                <div class="form-group">
                  <div class="col-sm-12">
                    <button type="submit" name="general" value="general" class="btn btn-lg btn-success"><i class="icon icon-save-floppy"></i> Save General Settings</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>

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
                    <span class="help-block"><i class="icon icon-info-sign"></i> cryptoGlance cookies save preferences like panel width/positioning, and are safe to clear. Your important settings are always within the /config/user_data/ folder.<br><br><b>* YOU WILL BE LOGGED OUT AFTER CLEARING COOKIES!</b></span>
                    <button name="clearCookies" class="btn btn-lg btn-danger"><i class="icon icon-programclose"></i> Clear Cookies</button>
                  </div>
                </div>
              </fieldset>
            </form>
            <br>
          </div>
        </div>
        
        
        
        
        
        <div id="minersettings" class="panel panel-default panel-no-grid no-icon">
            <h1>Miner Settings - Not working try this</h1>
            
           
            
            <div class="panel-heading">
                <h2 class="panel-title"><i class="icon icon-settingsandroid"></i> Settings</h2>
            </div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" METHOD="POST" action="miner-settings.php">
             <button type="submit"  class="btn btn-lg btn-success"><i class="icon"></i> goto Miner Settings</button>
            
            <div class="form-group">
                      <label class="col-sm-5 control-label">MHZ:</label>
                      <div class="col-sm-3 refresh-interval">
                        <select class="form-control" name="minermhz">
                          <option <?php echo ($settings['general']['updateMHZ']['thisminer'] == 400) ? 'selected="selected"' : '' ?> value="400">400 MHZ</option>
                          <option <?php echo ($settings['general']['updateMHZ']['thisminer'] == 500) ? 'selected="selected"' : '' ?> value="500">500 MHZ</option>
                          <option <?php echo ($settings['general']['updateMHZ']['thisminer'] == 550) ? 'selected="selected"' : '' ?> value="550">550 MHZ</option>
                          <option <?php echo ($settings['general']['updateMHZ']['thisminer'] == 600) ? 'selected="selected"' : '' ?> value="600">600 MHZ</option>
                          <option <?php echo ($settings['general']['updateMHZ']['thisminer'] == 625) ? 'selected="selected"' : '' ?> value="625">625 MHZ</option>
                          <option <?php echo ($settings['general']['updateMHZ']['thisminer'] == 650) ? 'selected="selected"' : '' ?> value="650">650 MHZ</option>
                        </select>
                      </div>
                    </div>
            
            
            
              <fieldset>
                <div class="form-group">
                  <div class="col-sm-12">
                    <span class="help-block"><i class="icon icon-info-sign"></i> Datas will be stored permanent<br><br><b>* ok!</b></span>
                    
                    <button type="submit" name="general" value="general" class="btn btn-lg btn-success"><i class="icon icon-save-floppy"></i> Save Miner Settings</button>
                  </div>
                </div>
              </fieldset>
            </form>
            <br>
          </div>
        </div>
        
        
        
        
      </div>
      <!-- /container -->

      <?php require_once("includes/footer.php"); ?>
   </div>
      <!-- /page-container -->

      <?php require_once("includes/scripts.php"); ?>
   </body>
</html>
