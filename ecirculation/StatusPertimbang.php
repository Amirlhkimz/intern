<?php //require_once('Connections/connspkp.php'); ?>
<?php 
ob_start();
require_once('Connections/connspkp.php'); 
?>
<? 
session_start(); 

if($_SESSION["Kumpulan"] !='Suruhanjaya' ){
	if($_SESSION["Kumpulan"] !='Pengerusi' ){
		header("Location: Logout.php");
		}
	};
?>

<?php
$Link = $_GET['L'];
$idUrusan = $_GET['U'];
$idPengguna = $_SESSION["idPengguna"];
$strTrKemaskini=date("Y-m-j  H:i:s");

mysql_select_db($database_connspkp, $connspkp);
$sqlurusan = "UPDATE tblstatusurusan SET status='Pertimbangan',trSelesai='$strTrKemaskini' WHERE idPengguna='$idPengguna' AND idUrusan='$idUrusan' AND status='Baru'"; 
$result = mysql_query($sqlurusan) or die(mysql_error());
?>

<meta http-equiv="refresh" content="0;URL=<?php echo $Link;?>">