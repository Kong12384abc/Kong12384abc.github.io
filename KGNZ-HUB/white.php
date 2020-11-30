<?php 

$whitelistedkeys=array(''); //do not change
$handle = fopen("whitelisted.txt", "r");
if ($handle) {
   while (($line = fgets($handle)) !== false) {
       array_push($whitelistedkeys, $line);
   }
   fclose($handle);
}

error_reporting(0);

function base64url_encode($data) {
 return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
 return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}
$adr = $_SERVER['REMOTE_ADDR'];

if ($_GET['c']) {
$crypt=$_GET['c'];
$s = base64url_encode($crypt);
if ($crypt == 'ip') {
$ss = base64url_encode($adr);
echo $ss;
}
else{
echo $s;
}
}
if ($_GET['d']) {
$decrypt=$_GET['d'];
echo base64url_decode($decrypt);
}

if ($_GET['check']) {
$gey = $_GET['check'];
$decodedgey = base64url_decode($gey);
if ($decodedgey == $adr) {
if (in_array($gey, $whitelistedkeys)) {
echo "true";
}
else{
echo "false";
}
}
else{
echo "false";
}
}
else{
   
   
}

?>