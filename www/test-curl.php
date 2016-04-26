<?php
$ch = curl_init();
curl_setopt($ch,CURLOPT_HTTPHEADER,array("Expect:"));
//Other setopt, execute etc...
?>