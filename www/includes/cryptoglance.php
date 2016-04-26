<?php
require_once('classes/filehandler.php');
class CryptoGlance {

  ///////////////////////////////////////////////////////////////////
    private $_configTypes = array(
        'cryptoglance',
        'miners',
        'panels',
        'pools',
        'wallets',
        'activate',
        'antminerlocal',
    );

    private $_algorithms = array(
        'SHA256'    =>  'SHA-256',
        'BLAKE256'  =>  'Blake-256',
        'FRESH'     =>  'Fresh',
        'FUGUE'     =>  'Fugue-256',
        'GROESTL'   =>  'Groestl',
        'JHA'       =>  'Jackpot',
        'KECCAK'    =>  'Keccak',
        'LYRA2RE'   =>  'Lyra2RE',
        'NEOSBLAKE' =>  'Neos-Blake',
        'NEOSCRYPT' =>  'NeoScrypt',
        'NIST'      =>  'Nist5',
        'QUARK'     =>  'Quark',
        'SCRYPT'    =>  'Scrypt',
        'NSCRYPT'   =>  'Scrypt-N',
        'TWE'       =>  'Twecoin',
        'UNK'       =>  'Unknown',
        'WHIRL'     =>  'WHIRL',
        'X11'       =>  'X11',
        'X13'       =>  'X13',
        'X14'       =>  'X14',
        'X15'       =>  'X15',
        'X17'       =>  'X17',
    );
    
    
    
  ///////////////////////////////////////////////////////////////////
      
  ///////////////////////////////////////////////////////////////////    
    private $_minerType = array(
        'AntminerS7'    =>  'Antminer-S7',
        'AntminerS5'    =>  'Antminer-S5',
        'AntminerS4'    =>  'Antminer-S4',
    );
    public function supportedMiners($reversed = false) {
        if ($reversed) {
            return array_flip($this->_minerType);
        }
        return $this->_minerType;
    }
  ///////////////////////////////////////////////////////////////////
  
  ///////////////////////////////////////////////////////////////////
      
      private $_minerMhz = array(
        '100'     =>    '100.00',
		'125'     =>    '125.00',
		'150'     =>    '150.00',
		'175'     =>    '175.00',
		'200'     =>    '200.00',
		'225'     =>    '225.00',
		'250'     =>    '250.00',
		'275'     =>    '275.00',
		'300'     =>    '300.00',
		'325'     =>    '325.00',
		'350'     =>    '350.00',
		'375'     =>    '375.00',
		'400'     =>    '400.00',
'404'     =>    '404.17',
'406'     =>    '406.25',
'408'     =>    '408.33',
'412'     =>    '412.50',
'416'     =>    '416.67',
'418'     =>    '418.75',
'420'     =>    '420.83',
'425'     =>    '425.00',
'429'     =>    '429.17',
'431'     =>    '431.25',
'433'     =>    '433.33',
'437'     =>    '437.50',
'441'     =>    '441.67',
'443'     =>    '443.75',
'445'     =>    '445.83',
'450'     =>    '450.00',
'454'     =>    '454.17',
'456'     =>    '456.25',
'458'     =>    '458.33',
'462'     =>    '462.50',
'466'     =>    '466.67',
'468'     =>    '468.75',
'470'     =>    '470.83',
'475'     =>    '475.00',
'479'     =>    '479.17',
'481'     =>    '481.25',
'483'     =>    '483.33',
'487'     =>    '487.50',
'491'     =>    '491.67',
'493'     =>    '493.75',
'495'     =>    '495.83',
'500'     =>    '500.00',
'504'     =>    '504.17',
'506'     =>    '506.25',
'508'     =>    '508.33',
'512'     =>    '512.50',
'516'     =>    '516.67',
'518'     =>    '518.75',
'520'     =>    '520.83',
'525'     =>    '525.00',
'529'     =>    '529.17',
'531'     =>    '531.25',
'533'     =>    '533.33',
'537'     =>    '537.50',
'543'     =>    '543.75',
'550'     =>    '550.00',
'556'     =>    '556.25',
'562'     =>    '562.50',
'568'     =>    '568.75',
'575'     =>    '575.00',
'581'     =>    '581.25',
'587'     =>    '587.50',
'593'     =>    '593.75',
'600'     =>    '600.00',
'606'     =>    '606.25',
'612'     =>    '612.50',
'618'     =>    '618.75',
'625'     =>    '625.00',
'631'     =>    '631.25',
'637'     =>    '637.50',
'643'     =>    '643.75',
'650'     =>    '650.00',
'656'     =>    '656.25',
'662'     =>    '662.50',
'668'     =>    '668.75',
'675'     =>    '675.00',
'681'     =>    '681.25',
'687'     =>    '687.50',
'693'     =>    '693.75',
'700'     =>    '700.00',
'706'     =>    '706.25',
'712'     =>    '712.50',
'718'     =>    '718.75',
'725'     =>    '725.00',
'731'     =>    '731.25',
'737'     =>    '737.50',
'743'     =>    '743.75',
'750'     =>    '750.00',
'756'     =>    '756.25',
'762'     =>    '762.50',
'768'     =>    '768.75',
'775'     =>    '775.00',
'781'     =>    '781.25',
'787'     =>    '787.50',
'793'     =>    '793.75',
'800'     =>    '800.00',

);
      public function supportedMHz($reversed = false) {
        if ($reversed) {
            return array_flip($this->_minerMhz);
        }
        return $this->_minerMhz;
    }  
    
  ///////////////////////////////////////////////////////////////////    
    
  ///////////////////////////////////////////////////////////////////
  
  

      private $_minerFanMin = array(
          '20'     =>    '20',
          '21'     =>    '21',
        '22'     =>    '22',
        '23'     =>    '23',
        '24'     =>    '24',
        '25'     =>    '25',
        '26'     =>    '26',
        '27'     =>    '27',
        '28'     =>    '28',
        '29'     =>    '29',
        '30'     =>    '30',
        '31'     =>    '31',
        '32'     =>    '32',
        '33'     =>    '33',
        '34'     =>    '34',
        '35'     =>    '35',
        '36'     =>    '36',
        '37'     =>    '37',
        '38'     =>    '38',
        '39'     =>    '39',
        '40'     =>    '40',
        '41'     =>    '41',
        '42'     =>    '42',
        '43'     =>    '43',
        '44'     =>    '44',
        '45'     =>    '45',
        '46'     =>    '46',
        '47'     =>    '47',
        '48'     =>    '48',
        '49'     =>    '49',
        '50'     =>    '50',
        '51'     =>    '51',
        '52'     =>    '52',
        '53'     =>    '53',
        '54'     =>    '54',
        '55'     =>    '55',
        '56'     =>    '56',
        '57'     =>    '57',
        '58'     =>    '58',
        '59'     =>    '59',
        '60'     =>    '60',
        '61'     =>    '61',
        '62'     =>    '62',
        '63'     =>    '63',
        '64'     =>    '64',
        '65'     =>    '65',
        '66'     =>    '66',
        '67'     =>    '67',
        '68'     =>    '68',
        '69'     =>    '69',
        '70'     =>    '70',
        '71'     =>    '71',
        '72'     =>    '72',
        '73'     =>    '73',
        '74'     =>    '74',
        '75'     =>    '75',
        '76'     =>    '76',
        '77'     =>    '77',
        '78'     =>    '78',
        '79'     =>    '79',
        '80'     =>    '80',
        '81'     =>    '81',
        '82'     =>    '82',
        '83'     =>    '83',
        '84'     =>    '84',
        '85'     =>    '85',
        '86'     =>    '86',
        '87'     =>    '87',
        '88'     =>    '88',
        '89'     =>    '89',
        '90'     =>    '90',
        '91'     =>    '91',
        '92'     =>    '92',
        '93'     =>    '93',
        '94'     =>    '94',
        '95'     =>    '95',
        '96'     =>    '96',
        '97'     =>    '97',
        '98'     =>    '98',
        '99'     =>    '99',
        '100'     =>    '100',
        
        
);
      public function supportedFanMin() {
       
        return $this->_minerFanMin;
    }  

  
  ///////////////////////////////////////////////////////////////////
  
  ///////////////////////////////////////////////////////////////////
   
    
        private $_minerVolt = array(
        '0600'    =>  '0600 min.',
		'0612'    =>  '0612 undervolt',
		'0624'    =>  '0624 undervolt',
		'0636'    =>  '0636 undervolt',
		'0648'    =>  '0648 undervolt',
		'0660'    =>  '0660 undervolt',
		'0672'    =>  '0672 undervolt',
		'0684'    =>  '0684 undervolt',
		'0696'    =>  '0696 undervolt',
		'0706'    =>  '0706 S7 original',
		'0708'    =>  '0708 overvolt',
		'0720'    =>  '0720 overvolt',
		'0732'    =>  '0732 overvolt',
		'0744'    =>  '0744 overvolt',
		'0756'    =>  '0756 overvolt',
		'0768'    =>  '0768 overvolt',
		'0780'    =>  '0780 overvolt',
		'0792'    =>  '0792 overvolt',
		'0804'    =>  '0804 overvolt',
		'0816'    =>  '0816 overvolt',
		'0828'    =>  '0828 overvolt',
		'0840'    =>  '0840 overvolt',
		'0852'    =>  '0852 overvolt',
		'0864'    =>  '0864 overvolt',
		'0876'    =>  '0876 overvolt',
		'0888'    =>  '0888 overvolt',
		'0900'    =>  '0900 max.',
    );
    
    public function supportedVoltage() {
        
        return $this->_minerVolt;
    }
    
  ///////////////////////////////////////////////////////////////////
  
  ///////////////////////////////////////////////////////////////////
  
  
      private $_minerTargetTemp = array(

        '23'     =>    '23  HP-Mode',
        '24'     =>    '24',
        '25'     =>    '25',
        '26'     =>    '26',
        '27'     =>    '27',
        '28'     =>    '28',
        '29'     =>    '29',
        '30'     =>    '30',
        '31'     =>    '31',
        '32'     =>    '32',
        '33'     =>    '33',
        '34'     =>    '34',
        '35'     =>    '35',
        '36'     =>    '36',
        '37'     =>    '37',
        '38'     =>    '38',
        '39'     =>    '39',
        '40'     =>    '40',
        '41'     =>    '41',
        '42'     =>    '42',
        '43'     =>    '43',
        '44'     =>    '44',
        '45'     =>    '45',
        '46'     =>    '46',
        '47'     =>    '47',
        '48'     =>    '48',
        '49'     =>    '49',
        '50'     =>    '50 sweet',
        '51'     =>    '51',
        '52'     =>    '52',
        '53'     =>    '53',
        '54'     =>    '54',
        '55'     =>    '55',
        '56'     =>    '56',
        '57'     =>    '57',
        '58'     =>    '58',
        '59'     =>    '59',
        '60'     =>    '60',
        '61'     =>    '61',
        '62'     =>    '62',
        '63'     =>    '63',
        '64'     =>    '64 awesome',
        '65'     =>    '65',
        '66'     =>    '66',
        '67'     =>    '67',
        '68'     =>    '68',
        '69'     =>    '69',
        '70'     =>    '70',
        '71'     =>    '71 smashing',
        '72'     =>    '72',
        '73'     =>    '73',
        '74'     =>    '74',
        '75'     =>    '75',
        '76'     =>    '76 sickeningly',
        '77'     =>    '77',
        '78'     =>    '78',
        '79'     =>    '79',
        '80'     =>    '80 exitus mode',

        
        
);
      public function supportedTTemp() {
       
        return $this->_minerTargetTemp;
    }  

  
   ///////////////////////////////////////////////////////////////////
   
  ///////////////////////////////////////////////////////////////////

        private $_minerCutoffTemp = array(

        '50'     =>    '50',
        '51'     =>    '51',
        '52'     =>    '52',
        '53'     =>    '53',
        '54'     =>    '54',
        '55'     =>    '55',
        '56'     =>    '56',
        '57'     =>    '57',
        '58'     =>    '58',
        '59'     =>    '59',
        '60'     =>    '60',
        '61'     =>    '61',
        '62'     =>    '62',
        '63'     =>    '63',
        '64'     =>    '64',
        '65'     =>    '65',
        '66'     =>    '66',
        '67'     =>    '67',
        '68'     =>    '68',
        '69'     =>    '69',
        '70'     =>    '70',
        '71'     =>    '71',
        '72'     =>    '72',
        '73'     =>    '73',
        '74'     =>    '74',
        '75'     =>    '75',
        '76'     =>    '76 critical',
        '77'     =>    '77',
        '78'     =>    '78',
        '79'     =>    '79',
        '80'     =>    '80 normal mode S7',

        
        
);
      public function supportedCutOff() {
       
        return $this->_minerCutoffTemp;
    } 

  ///////////////////////////////////////////////////////////////////
  
  ///////////////////////////////////////////////////////////////////

    private $_config;

    public function __construct() {
        foreach ($this->_configTypes as $configType) {
            $fh = $fileHandler = new FileHandler('/config/user_data/configs/' . $configType . '.json');
            $this->_config[$configType] = json_decode($fh->read(), true);
        }
    }

    public function supportedAlgorithms($reversed = false) {
        if ($reversed) {
            return array_flip($this->_algorithms);
        }
        return $this->_algorithms;
    }

    public function isConfigAvailable($panel) {
        return $this->_config[$panel];
    }

    ///////////
    // Panels //
    ///////////
    public function getPanels() {
        $panels = $this->_config;
        unset($panels['cryptoglance']);

        return $panels;
    }
    public function isNoPanels() {
        foreach ($this->getPanels() as $panel) {
            if ($panel) {
                return false;
            }
        }
        return true;
    }

    //////////
    // Rigs //
    //////////
    public function getOverview() {
        return $this->_config['panels']['overview'];
    }
    public function getMiners() {
        return $this->_config['miners'];
    }

    ///////////
    // Pools //
    ///////////
    public function getPools() {
        return $this->_config['pools'];
    }
    
    

    ////////////////
    // Zwilla Mod //
    ////////////////
    public function setgetlicence() {
        $config = array();
        $config['data'] = $this->_config['activate'];
        $config['panel'] = $this->_config['panels']['licencetab'];

        return $config;
    }

    //////////////
    // Wallets //
    /////////////
    public function getWallets() {
        $config = array();
        $config['data'] = $this->_config['wallets'];
        $config['panel'] = $this->_config['panels']['wallets'];

        return $config;
    }


    ///////////////
    // Settings //
    //////////////
    /**
     * @return mixed
     */
    public function getSettings() {
        $settings = $this->_config['cryptoglance'];
        
        
		//if (empty($settings['general']['activate']['miner492FullSpeed'])) {$settings['general']['activate']['miner492FullSpeed'] = 0;}
		
        if (empty($settings['general']['updates']['enabled']) && $settings['general']['updates']['enabled'] != 0) {
            $settings['general']['updates']['enabled'] = 1;
        }
        if (empty($settings['general']['updates']['type'])) {
            $settings['general']['updates']['type'] = 'release';
        }
        if (empty($settings['general']['updateTimes']['rig'])) {
            $settings['general']['updateTimes']['rig'] = 3000;
        }
        if (!empty($settings['general']['updateTimes']['rig_delay'])) {
            define('RIG_UPDATE_DELAY', intval($settings['general']['updateTimes']['rig_delay']));
        } else {define('RIG_UPDATE_DELAY', 2);}
        if (empty($settings['general']['updateTimes']['pool'])) {
            $settings['general']['updateTimes']['pool'] = 120000;
        }
        if (empty($settings['general']['updateTimes']['wallet'])) {
            $settings['general']['updateTimes']['wallet'] = 600000;
        }        
         if (empty($settings['general']['activate']['licenceenabled'])) {
             $settings['general']['activate']['licenceenabled'] = 0;
         }
         if (empty($settings['general']['activate']['enabledok'])) {
             $settings['general']['activate']['enabledok'] = '';
         }
         if (empty($settings['general']['activate']['useremailname'])) {
         $settings['general']['activate']['useremailname'] = '';
         }
         if (empty($settings['general']['activate']['licensekey'])) {
         $settings['general']['activate']['licensekey'] = '';
             // header('Location: logout.php');
         }
         if (empty($settings['general']['activate']['lastchecklic'])) {
         $settings['general']['activate']['lastchecklic'] = '';
         }
         if (empty($settings['general']['activate']['minermac'])) {
         $settings['general']['activate']['minermac'] = '';
         }
         if (empty($settings['general']['activate']['mineractive'])) {
         $settings['general']['activate']['mineractive'] = '';
         }
         if (empty($settings['general']['activate']['oldschool'])) {
         $settings['general']['activate']['oldschool'] = '';
         }
         if (empty($settings['general']['activate']['licserver'])) {
         $settings['general']['activate']['licserver'] = "https://www.zwilla.de";
         }
         if (empty($settings['general']['activate']['licdeacdate'])) {
         $settings['general']['activate']['licdeacdate'] = '';
         }
         if (empty($settings['general']['activate']['lastupdatecheck'])) {
         $settings['general']['activate']['lastupdatecheck'] = '';
         }
         if (empty($settings['general']['activate']['cryptoproxyservice'])) {
         $settings['general']['activate']['cryptoproxyservice'] = '';
         }
         

        return $settings;
    }

    public function saveSettings($data) {
        $fh = $fileHandler = new FileHandler('/config/user_data/configs/cryptoglance.json');
        $settings = json_decode($fh->read(), true);
        
        

        if ($data['general']) {
            $settings['general'] = array(
            
                'updates' => array(
                    'enabled' => $data['general']['update'],
                    'type' => $data['general']['updateType'],
                ),
                
                'updateTimes' => array(
                    'rig' => $data['general']['rigUpdateTime']*1000,
                    'rig_delay' => $data['general']['rigUpdateDelay'],
                    'pool' => $data['general']['poolUpdateTime']*1000,
                    'wallet' => $data['general']['walletUpdateTime']*1000,
                ),
                
                'activate' => array(
                     'licenceenabled' => $data['general']['licenceenabled'],
                     'enabledok' => $data['general']['enabledok'],
                     'useremailname' => $data['general']['useremailname'],
                     'licensekey' => $data['general']['licensekey'],
                     'lastchecklic' => $data['general']['lastchecklic'],
                     'minermac' => $data['general']['minermac'],
                     'mineractive' => $data['general']['mineractive'],
                     'oldschool' => $data['general']['oldschool'],
                     'licserver' => $data['general']['licserver'],
                     'licdeacdate' => $data['general']['licdeacdate'],
                     'lastupdatecheck' => $data['general']['lastupdatecheck'],
                     'cryptoproxyservice' => $data['general']['cryptoproxyservice'],
                    'minerMhz' => $data['general']['minerMhz'],
                    'minerType' => $data['general']['minerType'],
                   	'minerFanAuto' => $data['general']['minerFanAuto'],
      			    'minerFanMin' => $data['general']['minerFanMin'],
    		        'minerFanMax' => $data['general']['minerFanMax'],
		            'minerVilMod' => $data['general']['minerVilMod'],
		            'minerApiNetwork' => $data['general']['minerApiNetwork'],
		            'minerApiPort'    => $data['general']['minerApiPort'],
		            'minerApiOn' => $data['general']['minerApiOn'],
		            'minerPool1' => $data['general']['minerPool1'],
		            'minerPool2' => $data['general']['minerPool2'],
		            'minerPool3' => $data['general']['minerPool3'],
		            'minerPool4' => $data['general']['minerPool4'],
		            'minerWorker1' => $data['general']['minerWorker1'],
		            'minerWorker2' => $data['general']['minerWorker2'],
 		            'minerWorker3' => $data['general']['minerWorker3'],
		            'minerWorker4' => $data['general']['minerWorker4'],
		            'minerOnlyOnePool' => $data['general']['minerOnlyOnePool'],
					'fallback492' => $data['general']['fallback492'],
		            'minerBtmOptions' => $data['general']['minerBtmOptions'],
 		            'minerVolt' => $data['general']['minerVolt'],
 		            'minerTout' => $data['general']['minerTout'],
 		            'minerVoltAuto' => $data['general']['minerVoltAuto'],
 		            'minerTargetTemp' => $data['general']['minerTargetTemp'],
		            'minerMaxError' => $data['general']['minerMaxError'],
		            'miner492FullSpeed' => $data['general']['miner492FullSpeed'],
		            'minerNiceHashMode' => $data['general']['minerNiceHashMode'],
		            'bitmaindev' => $data['general']['bitmaindev'],
		            'minerDetectHwerror' => $data['general']['minerDetectHwerror'],
		            'minerCheckn2diff' => $data['general']['minerCheckn2diff'],
		            'minerNobeeper' => $ $data['general']['minerNobeeper'],
  		            'minerCutoffTemp' => $data['general']['minerCutoffTemp'],
		            'minerBtcAddress' => $data['general']['minerBtcAddress'],
    		        'minerBtcSig' => $data['general']['minerBtcSig'],
    		        'minerLowMem' => $data['general']['minerLowMem'],
   		            'minerNoSubmitStale' => $data['general']['minerNoSubmitStale'],
   		            'minerQueue' => $data['general']['minerQueue'],
  		            'minerRealQuiet' => $data['general']['minerRealQuiet'],
  		            'minerSuggestDiff' => $data['general']['minerSuggestDiff'],
                    'ridonnow' => $data['general']['ridonnow'],
                
                     
                     
                 ),
            );
        }







        $this->_config['cryptoglance'] = $settings;

        if ($fh->write(json_encode($settings)) !== false) {
            if (isset($_COOKIE['zwillamod_version'])) {
                unset($_COOKIE['zwillamod_version']);
                setcookie('zwillamod_version', null, -1, '/');
                $licensekey = $settings['general']['activate']['licensekey'];
                setcookie('licensekey', $licensekey, time() + (86400 * 14), "/");
                
            }

            return true;
        } else {
            return false;
        }
    }
    

}

?>
