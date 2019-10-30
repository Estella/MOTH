<?php
/*******************************************************************************************************/
// MYSTAGIC Offsite-Time-Hashes (MOTH) - Test Client
/*******************************************************************************************************/
require_once (dirname(__FILE__) .'/class_moth.php');
/*******************************************************************************************************/
function http_request() {
  $moth = new MOTH("SECRET");
  $headers = ['MOTH: ' . $moth->get_hash()];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://yourserver_site/moth_server.php");
  curl_setopt($ch, CURLOPT_SSLVERSION, 6); // TLS
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  //print_r($headers); // Debug
  $server_output = curl_exec($ch);
  curl_close($ch);
  if ($server_output) {
    print_r($server_output);
  }
}
/*******************************************************************************************************/
http_request();
/*******************************************************************************************************/
exit;
