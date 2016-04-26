<?PHP
// Coryright if possible by Migueel Padilla 2016
// Das is eigentlich ok so, doch lädt der Rest der Seite nicht mehr 
//if ($_COOKIE['fullspeedmode492a'] = 2) {$zMode = "Old-Mode"; exit(0); };

include ( 'includes/inc.php' );
require_once ( 'includes/classes/filehandler.php' );
//class cgminer2 {

$outputmac = shell_exec("/etc/init.d/minermac.sh 2>&1");
$outputmacnow = substr($outputmac, 0, 17);

$testmac = str_replace( ":", "", $outputmacnow );

$testmac = bin2hex ($testmac);

$workerid = bin2hex(str_replace( ":", "", $outputmacnow));


$thissettings = array(
        'Pool1' => 'SHA256',
        'hwErrors' => array(
            'enabled' => 1,
            'type' => 'percent',
            'danger' => array(
                'percent' => '10',
                'int' => '10',
            ),
            'warning' => array
            (
                'percent' => '5',
                'int' => '5',
            ),
        ),
        'temps' => array(
            'enabled' => 1,
            'danger' => '80',
            'warning' => '75',
        )
    );

//$settings['general']['activate']['miner492FullSpeed']) = '';


if (isset($settings['general']['activate']['licenceenabled']) && $settings['general']['activate']['licenceenabled'] == 1) {
     $jsArray[] = 'settings';
     echo "Settings eingebunden <br>";
}
$jsArray[] = 'settings';

$cgMinerTimeOut = $settings['general']['activate']['minerTout'];
$cgMinerMhz =  $settings['general']['activate']['minerMhz'];
$cgMinerVolt = $settings['general']['activate']['minerVolt'];
$cgMinerRegData = "0782";
$cgMinerSpi = "115200";
$cgMinerAsc = "32";
$cgMinerChp = "8";

//                    SPI			ASC         CHP         Tout         FREQ          REGDAT         VOLT  
//$zwillaModOpt = "115200" . ":" . "32" . ":" . "8" . ":" . "7" . ":" . "200" . ":" . "0782" . ":" . "0725";
$zwillaModOpt = $cgMinerSpi . ":" . $cgMinerAsc . ":" . $cgMinerChp . ":" . $cgMinerTimeOut . ":" . $cgMinerMhz . ":" . $cgMinerRegData . ":" . $cgMinerVolt;


$cgStartconf1 			= 	"{\r\n \"pools\":\r\n [\r\n {\r\n";
$cgPoolone             =   "\"url\": \"" . $settings['general']['activate']['minerPool1'] . "\",\r\n";
$cgPooltwo 			= 	"\"url\": \"" . $settings['general']['activate']['minerPool2'] . "\",\r\n";
$cgPoolthree 			= 	"\"url\": \"" . $settings['general']['activate']['minerPool3'] . "\",\r\n";
$cgPoolfour 			= 	"\"url\": \"" . $settings['general']['activate']['minerPool4'] . "\",\r\n";
$cgPoolWorker1 		= 	"\"user\": \"" .$settings['general']['activate']['minerWorker1'] . $workerid . "-1" .  "\",\r\n";
$cgPoolWorker2 		= 	"\"user\": \"" .$settings['general']['activate']['minerWorker2'] . $workerid . "-2" .  "\",\r\n";
$cgPoolWorker3 		= 	"\"user\": \"" .$settings['general']['activate']['minerWorker3'] . $workerid . "-3" .  "\",\r\n";
$cgPoolWorker4 		= 	"\"user\": \"" .$settings['general']['activate']['minerWorker4'] . $workerid . "-4" .  "\",\r\n";
$cgPoolPass13 			= 	"\"pass\": \"x\" \r\n }, \r\n { \r\n";
$cgPoolPass4 			= 	"\"pass\": \"x\" \r\n }\r\n ],\r\n \r\n";
$cgApiListen 		=	"\"api-listen\": true,\r\n";
$cgApiAllow 		=	"\"api-allow\": \"" . $settings['general']['activate']['minerApiNetwork'] . "\",\r\n";
$cgApiDesc			=	"\"api-description\": \"cgminer zwilla mod Z-480\",\r\n";
$cgBitmainDev		=	"\"bitmain-dev\": \"/dev/bitmain-asic\",\r\n";
$cgBitmainFan 		=	"\"bitmain-fan\": \"" . $settings['general']['activate']['minerFanMax'] . "\",\r\n";
$cgBitmainTempS5 	=	"\"bitmain-temp\": " . $settings['general']['activate']['minerTargetTemp'] . ",\r\n";
$cgMinerFanAutoS7	=	"\"bitmain-fan-ctrl\": true,\r\n";
$cgMinerFanAutoS5	=	"\"bitmain-fan-pwm\": \"" . $settings['general']['activate']['minerFanMax'] . "\",\r\n";
$cgMinerFanMin 	   =	"\"bitmaintemp\": " . $settings['general']['activate']['minerFanMin'] . ",\r\n";
$cgMinerFanMaxS7 	=	"\"bitmain-fan-pwm\": \"" . $settings['general']['activate']['minerFanMax'] . "\",\r\n";
$cgMinerVilMod		=	"\"bitmain-use-vil\": true,\r\n";
$cgMinerCutoffTemp 	=	"\"bitmain-cutoff\": \"" . $settings['general']['activate']['minerCutoffTemp'] . "\",\r\n";
$cgNoSubmitStale	=	"\"no-submit-stale\": true,\r\n";
$cgTextOnly		=	"\"text-only\": true, \r\n";
// $cgBitmainOptions	=	"\"bitmain-options\": \"" . $settings['general']['activate']['minerBtmOptions'] . "\",\r\n";
$cgBitmainOptions	=	"\"bitmain-options\": \"" . $zwillaModOpt . "\",\r\n";
$cgMinerVolt		=	"\"bitmain-voltage\": \"" . $settings['general']['activate']['minerVolt'] . "\",\r\n";
$cgMinerCheckn2Diff	=	"\"bitmain-checkn2diff\": true,\r\n";
$cgBitmainMhz		=	"\"bitmain-freq\": \"" . $settings['general']['activate']['minerMhz'] . "\",\r\n";
$cgMinerDetectHwerror =	"\"bitmain-hwerror\": true,\r\n";
$cgMinerLowMem		=	"\"lowmem\": true,\r\n"; //set to external
$cgminerRealQuiet	=	"\"real-quiet\": true,\r\n";
$cgSuggestDiff		=	"\"suggest-diff\": \"" . $settings['general']['activate']['minerSuggestDiff'] . "\",\r\n";
$cgMinerBtcAddress	=	"\"btc-address\": \"" . $settings['general']['activate']['minerBtcAddress'] . "\",\r\n";
$cgminerBtcSig		=	"\"btc-sig\": \"" . $settings['general']['activate']['minerBtcSig'] . "\",\r\n";
$cgLoadBalance		=	"\"load-balance\": true,\r\n";
$cgVersionFile		=	"\"version-file\": \"/usr/bin/compile_time\",\r\n";
$cgMinerQueue      =   "\"queue\": 8192, \r\n";
$cgFallback492		=	"\"fallback-time\": \"" . $settings['general']['activate']['fallback492'] . "\"\r\n";
$cgEndConf			=	"}";
$cgApiListen = "true"; // without that the frontend is without any function!

// "\r\n"

// echo "pool eins: " . $cgPoolone;
// $cgTextOnly . $cgminerRealQuiet $cgLoadBalance



    $cgminerconf480 = ( $cgStartconf1 .
                        $cgPoolone . $cgPoolWorker1 . $cgPoolPass13 .
                        $cgPooltwo . $cgPoolWorker2 . $cgPoolPass13 .
                        $cgPoolthree . $cgPoolWorker3 . $cgPoolPass13 .
                        $cgPoolfour . $cgPoolWorker4 . $cgPoolPass4 .
                        $cgApiAllow .
                        $cgApiDesc .
                        $cgMinerVolt .
                        $cgNoSubmitStale .
                        $cgBitmainMhz .
                        $cgSuggestDiff .
                        $cgMinerBtcAddress .
                        $cgminerBtcSig );

$cgminerconf480 = $settings[ 'general' ][ 'activate' ][ 'minerFanAuto' ] == "true" ? $cgminerconf480 . $cgMinerVilMod : $cgminerconf480 . $cgMinerFanAutoS7 . $cgMinerFanMaxS7 . $cgMinerVilMod;

    $cgminerconf480 = $cgminerconf480 . $cgFallback492 . $cgEndConf;

    $file480conf = fopen("/config/cgminer/cgminer-s7.conf","w+");
    fwrite($file480conf, $cgminerconf480);
    fclose($file480conf);


    $cgminerexternalconf480 = "--bitmain-dev /dev/bitmain-asic --bitmain-checkn2diff --bitmain-hwerror --version-file /usr/bin/compile_time --queue 8192 --lowmem ";

    if ($cgApiListen == "true") {$cgminerexternalconf480 = " " . $cgminerexternalconf480 . "--api-listen"; }
    if ($cgNoSubmitStale == "true") {$cgminerexternalconf480 = " " . $cgminerexternalconf480 . "--no-submit-stale"; }
    // if ($cgBitmainOptions) {$cgminerexternalconf480 = " " . $cgminerexternalconf480 . "--bitmain-options" . $zwillaModOpt . " "; }

    $filestartexternal480 = fopen("/config/cgminer/start480.txt","w+");
    fwrite($filestartexternal480, $cgminerexternalconf480);
    fclose($filestartexternal480);

    $filestartexternal492="/config/cgminer/start492.txt";
    if (file_exists($filestartexternal492)) {
        $filestartexternal492="/config/cgminer/start492.txt";
        unlink($filestartexternal492);

    }

    $file492oconf = "/config/cgminer/start492overkill.txt";
    if (file_exists($file492oconf)) {
    $file492oconf = "/config/cgminer/start492overkill.txt";
    unlink($file492oconf);
    }

// start cgminer -T to what is wrong with start


// Fullspeed is off but running with zwilla mod options!
//goto makingoffan; //  shure why not also here an goto if do not understand fully such logic!


$cgminerconf++;


$FAN_MIN = $settings['general']['activate']['minerFanMin'];
$FAN_LOW = $settings['general']['activate']['minerFanMax'];
$FAN_MAX = 100;
$CELSIUS_LOW = $settings['general']['activate']['minerTargetTemp'];
$CELSIUS_MAX = $settings['general']['activate']['minerTargetTemp'];
$CELSIUS_DIE = 79;
$DELAY = 121; //seconds

$FanTempChecker = ( intval($FAN_MIN) . "");
$FanTempChecker = ( $FanTempChecker . "\n" . $FAN_LOW);
$FanTempChecker = ( $FanTempChecker . "\n" . $FAN_MAX);
$FanTempChecker = ( $FanTempChecker . "\n" . $CELSIUS_LOW);
$FanTempChecker = ( $FanTempChecker . "\n" . $CELSIUS_MAX);
$FanTempChecker = ( $FanTempChecker . "\n" . $CELSIUS_DIE);
$FanTempChecker = ( $FanTempChecker . "\n" . $DELAY);

$fanfile = fopen("/config/cgminer/FanTempChecker.conf","w+");
fwrite($fanfile, $FanTempChecker);
fclose($fanfile);















