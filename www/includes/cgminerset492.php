<?PHP
// Coryright if possible by Migueel Padilla 2016
// Das is eigentlich ok so, doch lädt der Rest der Seite nicht mehr 


include ( 'includes/inc.php' );
require_once ( 'includes/classes/filehandler.php' );
//class cgminer2 {

$outputmac = shell_exec("/etc/init.d/minermac.sh 2>&1");
$outputmacnow = substr($outputmac, 0, 17);


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


//$settings['general']['activate']['miner492FullSpeed']) = 'true';

//	if(isset($_SESSION))
//	{
//		$return .= 'Session Name:             ' . esc_html( ini_get( 'session.name' ) ) . "\n";
//		$return .= 'Cookie Path:              ' . esc_html( ini_get( 'session.cookie_path' ) ) . "\n";
//		$return .= 'Save Path:                ' . esc_html( ini_get( 'session.save_path' ) ) . "\n";
//		$return .= 'Use Cookies:              ' . ( ini_get( 'session.use_cookies' ) ? 'On' : 'Off' ) . "\n";
//		$return .= 'Use Only Cookies:         ' . ( ini_get( 'session.use_only_cookies' ) ? 'On' : 'Off' ) . "\n";
//	}


if (isset($settings['general']['activate']['licenceenabled']) && $settings['general']['activate']['licenceenabled'] == 1) {
     $jsArray[] = 'settings';
     echo "Settings eingebunden <br>";
}

$jsArray[] = 'settings';

//  if(!hex2bin(reg_data, colon2, strlen(colon2)/2)) {
// quit(1, "Invalid bitmain-freq for reg data, hex2bin error now: %s"
// Frequenz must match reg-data and vice versa
//int baud, chain_num, asic_num, timeout, frequency = 0;
/* if (configured) {
info->baud = baud;
		info->chain_num = chain_num;
		info->asic_num = asic_num;
		info->timeout = timeout;
		info->frequency = frequency;
		strcpy(info->frequency_t, frequency_t);
		memcpy(info->reg_data, reg_data, 4);
		memcpy(info->voltage, voltage, 2);
		strcpy(info->voltage_t, voltage_t);
	} else {
    info->baud = BITMAIN_IO_SPEED;
		info->chain_num = BITMAIN_DEFAULT_CHAIN_NUM;
		info->asic_num = BITMAIN_DEFAULT_ASIC_NUM;
		info->timeout = BITMAIN_DEFAULT_TIMEOUT;
		info->frequency = BITMAIN_DEFAULT_FREQUENCY;
		sprintf(info->frequency_t, "%d", BITMAIN_DEFAULT_FREQUENCY);
		memset(info->reg_data, 0, 4);
		info->voltage[0] = BITMAIN_DEFAULT_VOLTAGE0;
		info->voltage[1] = BITMAIN_DEFAULT_VOLTAGE1;
		strcpy(info->voltage_t, BITMAIN_DEFAULT_VOLTAGE_T);,

char opt_bitmain_dev[256] = {0};
bool opt_bitmain_hwerror = false;
bool opt_bitmain_checkall = false;
bool opt_bitmain_checkn2diff = false;
bool opt_bitmain_dev_usb = true;
bool opt_bitmain_nobeeper = false;
bool opt_bitmain_notempoverctrl = false;
int opt_bitmain_temp = BITMAIN_TEMP_TARGET;
int opt_bitmain_overheat = BITMAIN_TEMP_OVERHEAT;
int opt_bitmain_fan_min = BITMAIN_DEFAULT_FAN_MIN_PWM;
int opt_bitmain_fan_max = BITMAIN_DEFAULT_FAN_MAX_PWM;
int opt_bitmain_freq_min = BITMAIN_MIN_FREQUENCY;
int opt_bitmain_freq_max = BITMAIN_MAX_FREQUENCY;
bool opt_bitmain_auto;
*/

/*
 static void get_plldata(int type,int freq,uint8_t * reg_data,uint8_t * reg_data2)
{
	uint32_t i;
	char freq_str[10];
	sprintf(freq_str,"%d", freq);
    char plldivider1[32] = {0};
	char plldivider2[32] = {0};

	if(type == 1385)
	{
		for(i=0; i < sizeof(freq_pll_1385)/sizeof(freq_pll_1385[0]); i++)
		{
			if( memcmp(freq_pll_1385[i].freq, freq_str, sizeof(freq_pll_1385[i].freq)) == 0)
				break;
		}
	}

	sprintf(plldivider1, "%08x", freq_pll_1385[i].fildiv1);
	sprintf(plldivider2, "%04x", freq_pll_1385[i].fildiv2);

	if(!hex2bin(reg_data, plldivider1, strlen(plldivider1)/2))
    {
		 printk(KERN_ERR "Get plldivider1 value error!");
	}

	if(!hex2bin(reg_data2, plldivider2, 2))
    {
        printk(KERN_ERR "Get plldivider2 value error!");
	}
}
static struct freq_pll freq_pll_1385[] = {
	{"100",0x020040, 0x0420, 0x200241},
	{"125",0x028040, 0x0420, 0x280241},
	{"150",0x030040, 0x0420, 0x300241},
	{"175",0x038040, 0x0420, 0x380241},
	{"200",0x040040, 0x0420, 0x400241},
	{"225",0x048040, 0x0420, 0x480241},
	{"250",0x050040, 0x0420, 0x500241},
	{"275",0x058040, 0x0420, 0x580241},
	{"300",0x060040, 0x0420, 0x600241},
	{"325",0x068040, 0x0420, 0x680241},
	{"350",0x070040, 0x0420, 0x700241},
	{"375",0x078040, 0x0420, 0x780241},
	{"400",0x080040, 0x0420, 0x800241},
	{"404",0x061040, 0x0320, 0x610231},
	{"406",0x041040, 0x0220, 0x410221},
	{"408",0x062040, 0x0320, 0x620231},
	{"412",0x042040, 0x0220, 0x420221},
	{"416",0x064040, 0x0320, 0x640231},
	{"418",0x043040, 0x0220, 0x430221},
	{"420",0x065040, 0x0320, 0x650231},
	{"425",0x044040, 0x0220, 0x440221},
	{"429",0x067040, 0x0320, 0x670231},
	{"431",0x045040, 0x0220, 0x450221},
	{"433",0x068040, 0x0320, 0x680231},
	{"437",0x046040, 0x0220, 0x460221},
	{"441",0x06a040, 0x0320, 0x6a0231},
	{"443",0x047040, 0x0220, 0x470221},
	{"445",0x06b040, 0x0320, 0x6b0231},
	{"450",0x048040, 0x0220, 0x480221},
	{"454",0x06d040, 0x0320, 0x6d0231},
	{"456",0x049040, 0x0220, 0x490221},
	{"458",0x06e040, 0x0320, 0x6e0231},
	{"462",0x04a040, 0x0220, 0x4a0221},
	{"466",0x070040, 0x0320, 0x700231},
	{"468",0x04b040, 0x0220, 0x4b0221},
	{"470",0x071040, 0x0320, 0x710231},
	{"475",0x04c040, 0x0220, 0x4c0221},
	{"479",0x073040, 0x0320, 0x730231},
	{"481",0x04d040, 0x0220, 0x4d0221},
	{"483",0x074040, 0x0320, 0x740231},
	{"487",0x04e040, 0x0220, 0x4e0221},
	{"491",0x076040, 0x0320, 0x760231},
	{"493",0x04f040, 0x0220, 0x4f0221},
	{"495",0x077040, 0x0320, 0x770231},
	{"500",0x050040, 0x0220, 0x500221},
	{"504",0x079040, 0x0320, 0x790231},
	{"506",0x051040, 0x0220, 0x510221},
	{"508",0x07a040, 0x0320, 0x7a0231},
	{"512",0x052040, 0x0220, 0x520221},
	{"516",0x07c040, 0x0320, 0x7c0231},
	{"518",0x053040, 0x0220, 0x530221},
	{"520",0x07d040, 0x0320, 0x7d0231},
	{"525",0x054040, 0x0220, 0x540221},
	{"529",0x07f040, 0x0320, 0x7f0231},
	{"531",0x055040, 0x0220, 0x550221},
	{"533",0x080040, 0x0320, 0x800231},
	{"537",0x056040, 0x0220, 0x560221},
	{"543",0x057040, 0x0220, 0x570221},
	{"550",0x058040, 0x0220, 0x580221},
	{"556",0x059040, 0x0220, 0x590221},
	{"562",0x05a040, 0x0220, 0x5a0221},
	{"568",0x05b040, 0x0220, 0x5b0221},
	{"575",0x05c040, 0x0220, 0x5c0221},
	{"581",0x05d040, 0x0220, 0x5d0221},
	{"587",0x05e040, 0x0220, 0x5e0221},
	{"593",0x05f040, 0x0220, 0x5f0221},
	{"600",0x060040, 0x0220, 0x600221},
	{"606",0x061040, 0x0220, 0x610221},
	{"612",0x062040, 0x0220, 0x620221},
	{"618",0x063040, 0x0220, 0x630221},
	{"625",0x064040, 0x0220, 0x640221},
	{"631",0x065040, 0x0220, 0x650221},
	{"637",0x066040, 0x0220, 0x660221},
	{"643",0x067040, 0x0220, 0x670221},
	{"650",0x068040, 0x0220, 0x680221},
	{"656",0x069040, 0x0220, 0x690221},
	{"662",0x06a040, 0x0220, 0x6a0221},
	{"668",0x06b040, 0x0220, 0x6b0221},
	{"675",0x06c040, 0x0220, 0x6c0221},
	{"681",0x06d040, 0x0220, 0x6d0221},
	{"687",0x06e040, 0x0220, 0x6e0221},
	{"693",0x06f040, 0x0220, 0x6f0221},
	{"700",0x070040, 0x0220, 0x700221},
	{"706",0x071040, 0x0220, 0x710221},
	{"712",0x072040, 0x0220, 0x720221},
	{"718",0x073040, 0x0220, 0x730221},
	{"725",0x074040, 0x0220, 0x740221},
	{"731",0x075040, 0x0220, 0x750221},
	{"737",0x076040, 0x0220, 0x760221},
	{"743",0x077040, 0x0220, 0x770221},
	{"750",0x078040, 0x0220, 0x780221},
	{"756",0x079040, 0x0220, 0x790221},
	{"762",0x07a040, 0x0220, 0x7a0221},
	{"768",0x07b040, 0x0220, 0x7b0221},
	{"775",0x07c040, 0x0220, 0x7c0221},
	{"781",0x07d040, 0x0220, 0x7d0221},
	{"787",0x07e040, 0x0220, 0x7e0221},
	{"793",0x07f040, 0x0220, 0x7f0221},
	{"800",0x080040, 0x0220, 0x800221},
	{"825",0x042040, 0x0120, 0x420211},
 */


$cgMinerTimeOut = $settings['general']['activate']['minerTout'];
$cgMinerMhz =  $settings['general']['activate']['minerMhz'];
//$cgMinerMhz = intval($cgMinerMhz);
//$cgMinerMhz = dechex ($cgMinerMhz);
$cgMinerVolt = $settings['general']['activate']['minerVolt'];
$cgMinerRegData = "0782";
$cgMinerSpi = "115200";
$cgMinerAsc = "32";
$cgMinerChp = "8";

//                    SPI			    ASC                  CHP                  Tout                   FREQ                  REGDAT              VOLT
//$zwillaModOpt = "115200"     . ":" . "32" . ":"          . "8" . ":"          . "7" . ":"           . "200" . ":"         . "0782" . ":"      . "0725";
$zwillaModOpt = $cgMinerSpi . ":" . $cgMinerAsc . ":" . $cgMinerChp . ":" . $cgMinerTimeOut . ":" . $cgMinerMhz . ":" . $cgMinerRegData . ":" . $cgMinerVolt;
// "Invalid bitmain-freq for reg data, must be hex now: %s",
// http://us2.php.net/manual/de/function.dechex.php,
//string dechex ( int $number )


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
 $cgApiDesc			=	"\"api-description\": \"cgminer zwilla mod Z-492\",\r\n";
 $cgBitmainDev		=	"\"bitmain-dev\": \"/dev/bitmain-asic\",\r\n";
 $cgBitmainFan 		=	"\"bitmain-fan\": \"" . $settings['general']['activate']['minerFanMax'] . "\",\r\n";
 $cgBitmainTempS5 	=	"\"bitmain-temp\": " . $settings['general']['activate']['minerTargetTemp'] . ",\r\n";
 $cgMinerFanAutoS7	=	"\"bitmain-fan-ctrl\": true,\r\n";
 $cgMinerFanAutoS5	=	"\"bitmain-fan-pwm\": \"" . $settings['general']['activate']['minerFanMax'] . "\",\r\n";
 $cgMinerFanMin 	=	"\"bitmaintemp\": " . $settings['general']['activate']['minerFanMin'] . ",\r\n";
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



    $cgminerconf492 = ( $cgStartconf1 . $cgPoolone . $cgPoolWorker1 . $cgPoolPass13 .
                        $cgPooltwo . $cgPoolWorker2 . $cgPoolPass13 .
                        $cgPoolthree . $cgPoolWorker3 . $cgPoolPass13 .
                        $cgPoolfour . $cgPoolWorker4 . $cgPoolPass4 .
                        $cgApiAllow .
                        $cgApiDesc .
                        $cgMinerVilMod .
                        $cgMinerCutoffTemp .
                        $cgSuggestDiff .
                        $cgMinerBtcAddress .
                        $cgminerBtcSig );

    if ($settings['general']['activate']['minerFanAuto'] == "true") {
        $cgminerconf492 = $cgminerconf492 . $cgMinerVilMod;
    }
    else {

        $cgminerconf492 = $cgminerconf492 . $cgMinerFanAutoS7 . $cgMinerFanMaxS7 . $cgMinerVilMod;
         }


    $cgminerconf492 = "" . $cgminerconf492 . $cgFallback492 . $cgEndConf;

    $file492conf = fopen("/config/cgminer/cgminer-s7.conf","w+");
    fwrite($file492conf, $cgminerconf492);
    fclose($file492conf);


    $cgminerexternalconf492 = "--bitmain-dev /dev/bitmain-asic --bitmain-checkn2diff --bitmain-hwerror --version-file /usr/bin/compile_time --queue 8192 --lowmem ";

    if ($cgApiListen == "true") { $cgminerexternalconf492 = $cgminerexternalconf492 . "--api-listen "; }
    
    if ($cgNoSubmitStale == "true") { $cgminerexternalconf492 = $cgminerexternalconf492 . "--no-submit-stale "; }
    
    if ($cgBitmainOptions) { 
        $cgminerexternalconf492 = $cgminerexternalconf492 . "--bitmain-options " . $zwillaModOpt . " ";
    }




    $file480conf = "/config/cgminer/start480.txt";
    if (file_exists($file480conf)) {
        $file480conf = "/config/cgminer/start480.txt";
        unlink($file480conf);

    }

$file492oconf = "/config/cgminer/start492overkill.txt";
if (file_exists($file492oconf)) {
    $file492oconf = "/config/cgminer/start492overkill.txt";
    unlink($file492oconf);

}

    $filestartexternal492 = fopen("/config/cgminer/start492.txt","w+");
    fwrite($filestartexternal492,$cgminerexternalconf492);
    fclose($filestartexternal492);





$cgminerconf++;

// $cgminerconf = convert_html_to_text($cgminerconf);


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







$test = "";
#echo "" . $cgminerconf;



$testmac = str_replace( ":", "", $outputmacnow );
//$testmac = bin2hex(str_replace( ":", "", $outputmacnow ));
// echo "Real MAC to rpl:    " . $testmac . "<br>";
$testmac = bin2hex ($testmac);
//echo "Real MAC to hex:    " . $testmac . "<br>";

//$onlyconsonants = str_replace( ":", "", $outputmacnow );


//echo "" . $onlyconsonants;
// ntige felder
// enabledok 
// licenceenabled 
// useremailname 
// licensekey 
// lastchecklic 
// licdeacdate 
// licserver 
// oldschool 
// mineractive 
// cryptoproxyservice
// minerApiOn

// /includes/classes/miners/cgminerset.php




//}

