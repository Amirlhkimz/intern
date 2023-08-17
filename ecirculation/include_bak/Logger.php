<?php require_once('Connections/connspkp.php'); ?>
<?php
ob_start();
session_start(); 

/* if(($_SESSION["Kumpulan"] !=urusetia ) AND ($_SESSION["Kumpulan"] !=Jemaah) AND ($_SESSION["Kumpulan"] !=Ahli)){
			header("Location: logout.php");
	}
else{ */
function logMe($aktiviti) {
  $idpengguna=$_SESSION["idPengguna"];
  $masa = date("Y-m-j  H:i:s");
  $insertSQL = sprintf("INSERT INTO tbllog (idPengguna, Aktiviti, Masa) VALUES ('$idpengguna', '$aktiviti', '$masa')");
  //mysql_select_db($database_connspkp, $connspkp);
  //$Result1 = mysql_query($insertSQL, $connspkp) or die(mysql_error());
  $Result1 = mysql_query($insertSQL)or die("Connection Failed!");

}
/* }; */

?>
