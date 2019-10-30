<?php
/*******************************************************************************************************/
// MYSTAGIC Offsite-Time-Hashes (MOTH) - CLASS
/*******************************************************************************************************/
class MOTH {
  private $secret;
  private $mode;
  public function __construct($s,$m=1) {
    $this->secret = $s;
    $this->mode = $m;
  }
  protected function xor_cmp($a, $b) {
    $diff = strlen($a) ^ strlen($b);
    for($i = 0; $i < strlen($a) && $i < strlen($b); $i++) {
      $diff |= ord($a[$i]) ^ ord($b[$i]);
    }
    return $diff === 0;
  }
  protected function gen_hash($utime) {
    if ($this->mode === 1) {
      return hash_hmac('sha256',hash('sha512',$utime . $this->secret . ":" . $utime,1),hash('sha512',$this->secret,1));
    } else {
      return sha1(md5($utime . $this->secret . ":" . $utime) . $this->secret); // Legacy for Secondlife
    }
  }
  public function check_hash($MHASH,$flux = 8) {
    $utime = (integer)substr((string)gmdate('U', time()),0,-1);
    $hash_matrix = array();
    $c = 1;
    for ($i = $flux; $i > 0; $i--) { $hash_matrix[] = $this->gen_hash(($utime + $i)); }
    $hash_matrix[] = $this->gen_hash($utime);
    for ($i = 1; $i < ($flux + 1); $i++) { $hash_matrix[] = $this->gen_hash(($utime - $i)); }
    $MOTH_PASS = FALSE;
    foreach($hash_matrix as $PHASH) {
      if ($this->xor_cmp($MHASH, $PHASH)) { $MOTH_PASS = TRUE; }
    }
    unset($PHASH);
    return $MOTH_PASS;
  }
  public function get_hash() { return $this->gen_hash(substr((string)gmdate('U', time()),0,-1)); }
}
/*******************************************************************************************************/
