![MOTH LOGO](/moth_logo.png)

# Mystagic Offsite Time Hashes (MOTH)
A project to link two remote sites over http/https with a custom HTTP header called MOTH.
This new header contains a time generated hash from a pre-shared key between the sites which changes every 10 seconds.
The PHP class allows for the configuration of the size of the time window which is a default of eight hashes into the past and eight into the future.
Giving 170 seconds for the window in which the hash would be valid for. 
I originally created this project for protecting HTTP interactions from Secondlife.


## class usage

```
// SHA1 Legacy: $moth = new MOTH($secret,0);
// SHA256 Default: $moth = new MOTH($secret,1);

// Default Range of check window, with flux set to 8:
// $moth->check_hash($MHASH);
// Will check eight hashes into the past and eight into the future to mitigate time skew

// $moth->check_hash($MHASH,10);
// Will check ten hashes into the past and ten into the future to mitigate time skew


$secret = "SECRET";
$moth = new MOTH($secret);
if ($moth->check_hash($MHASH)) {
  echo "VALID";
} else {
  echo "INVALID";
}
```
