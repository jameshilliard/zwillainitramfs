<?php

require_once('filehandler.php');

class Login {

    protected $_fh = null;
    
    public function __construct() {
        $this->_fh = new FileHandler('/config/user_data/configs/account.json');
    }
    
    public function login($username, $password, $licensekey) {
        $password = hash('sha512', $password);
        $licensekey = hash('sha512', $licensekey);
        
        $login = json_decode($this->_fh->read(), true);
        
        if (!empty($login)) {
            if (strtolower($username) == strtolower($login['username']) && $password == $login['password'] && $licensekey == $login['licensekey'] ) {
                return true;
            } else {
                return false;
            }
        } 
        else {
            return $this->register($username, $password, $licensekey);
        }
    }
    
    private function register($username, $password, $licensekey) {
        if (!empty($username) && !empty($password) && !empty($licensekey) ) {
            $data = array(
                'username' => $username,
                'password' => $password,
                'licensekey' => $licensekey
            );
            
            $this->_fh->write(json_encode($data));
            return true;
        }
        
        return false;
    }
    
    public function firstLogin() {
        return $this->_fh->fileExists();
    } 

}