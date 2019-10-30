<?php
/*******************************************************************************************************/
// MYSTAGIC Offsite-Time-Hashes (MOTH) - Test Server
/*******************************************************************************************************/
require_once (dirname(__FILE__) .'/class_moth.php');
/*******************************************************************************************************/
$secret = "SECRET";
/*******************************************************************************************************/
// Prevent Caching
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

header("Content-Type: text/plain");
$MHASH = (string) (isset($_SERVER['HTTP_MOTH']) ? trim($_SERVER['HTTP_MOTH']) : "X");
/*******************************************************************************************************/
// $utime = time(); echo "$MHASH $utime\n"; // Debug
if ($MHASH == "X") { echo "INVALID"; exit; }
if (!preg_match('/[0-9a-f]{64}/s', $MHASH)) { echo "INVALID"; exit; }
// if (!preg_match('/[0-9a-f]{40}/s', $MHASH)) { echo "INVALID"; exit; } // SHA1 version
/*******************************************************************************************************/
$moth = new MOTH($secret);
if ($moth->check_hash($MHASH)) {
  echo "VALID"; // Needs code/backend to prevent replay attacks within the valid time window
} else {
  echo "INVALID";
}
/*******************************************************************************************************/
exit;
