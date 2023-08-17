<?php 
require_once('Connections/connspkp.php');
include('include/FormatDate.php');

 	ob_start();
	session_start(); 

if($_SESSION["Kumpulan"] !='Suruhanjaya' ){
	if($_SESSION["Kumpulan"] !='Pengerusi' ){
		if($_SESSION["Kumpulan"] !='SUB' ){
		header("Location: Logout.php");
			}
		}
	};
 
$idUrusan = $_GET['IdU'];
$idPengguna = $_GET['IdP'];
?>


<?php

/////////FETCH DATA for BATAL KEPUTUSAN//////////////////////////////////////////////////////////////////////////////////

	 $TrKemaskini=date("Y-m-j  H:i:s");
	$simpanSQL = sprintf("INSERT INTO tblstatusurusan2 SELECT * FROM tblstatusurusan WHERE idPengguna='$idPengguna' and idUrusan='$idUrusan'");

  	mysql_select_db($database_connspkp, $connspkp);
  	$Result_simpanSQL = mysql_query($simpanSQL, $connspkp) or die(mysql_error()); 
	
	$batalSQL = sprintf("UPDATE tblstatusurusan SET Status='Baru', Keputusan='', TrSelesai='$TrKemaskini' WHERE idPengguna='$idPengguna' and idUrusan='$idUrusan'");

  	mysql_select_db($database_connspkp, $connspkp);
  	$Result_batalSQL = mysql_query($batalSQL, $connspkp) or die(mysql_error());
	
		include('Logger.php');
		logMe("Batal Keputusan: ". $idUrusan);

	

/////////FETCH DATA for BATAL KEPUTUSAN END//////////////////////////////////////////////////////////////////////////////////

	mysql_select_db($database_connspkp, $connspkp);
	$query_SU = ("Select * from tblstatusurusan where idPengguna='$idPengguna' and idUrusan='$idUrusan' ");
  	$Result_query_SU = mysql_query($query_SU, $connspkp) or die(mysql_error());
	$row_query_SU = mysql_fetch_assoc($Result_query_SU);
	
?>

<meta http-equiv="refresh" content="2;URL=Kemaskini.php?s=<?php echo $row_query_SU['id']; ?>&u=<?php echo $idUrusan; ?>">