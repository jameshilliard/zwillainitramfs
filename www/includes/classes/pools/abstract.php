<?php

/*
 * @author Stoyvo
 */
class Pools_Abstract {
    
    public $_apiURL;
    public $_fileHandler;
    
    public function __construct($params) {
        $this->_apiURL = $params['apiurl'];
    }
    
}