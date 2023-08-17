<?php  require_once('Connections/connspkp.php'); ?>
<?php
//session_start();
//////////////////////////////////Get IP//////////////////////////////////////////////////////////////////
function getIP() {
$ip;
if (getenv("HTTP_CLIENT_IP"))
$ip = getenv("HTTP_CLIENT_IP");
else if(getenv("HTTP_X_FORWARDED_FOR"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if(getenv("REMOTE_ADDR"))
$ip = getenv("REMOTE_ADDR");
else
$ip = "UNKNOWN";
return $ip;

} 

//////////////////////////////////Get IP END//////////////////////////////////////////////////////////////////

mysql_select_db($database_connspkp, $connspkp);
function logMe($aktiviti) {
  
  $idpengguna=$_SESSION["idPengguna"];
  $masa = date("Y-m-j  H:i:s");
  $myIP = getIP();
  
  $insertSQLL = sprintf("INSERT INTO tbllog (idPengguna, Aktiviti, Masa, IP) VALUES ('$idpengguna', '$aktiviti', '$masa', '$myIP')");
  
  //$ResultSQLL = mysql_query($insertSQLL, $connecspa) or die(mysql_error());
  $ResultSQLL = mysql_query($insertSQLL)or die(mysql_error());

}

?>
