<?php require_once('Connections/connspkp.php'); ?>
<?php
session_start(); 

if($_SESSION["Kumpulan"] !='Suruhanjaya' ){
	if($_SESSION["Kumpulan"] !='Pengerusi' ){
			if($_SESSION["Kumpulan"] !='urusetia'){
			header("Location: Logout.php");
			}
		}
	};
?>

<?php
$iduser=$_SESSION["Login"];  
$oldpass=$_POST["txtold"];
$newpass1=$_POST["txtnew1"];
$newpass2=$_POST["txtnew2"];
?>

<?php if($newpass1!=$newpass2 ){ ?>

	<SCRIPT language=JavaScript type=text/JavaScript>
	alert("Kata laluan baru anda tidak sama. Sila pastikan anda taip dengan betul");
	location.href="TukarPass.php";
	</SCRIPT>
<?php	//header("Location: Changepass.php");
	};
?>


<?php
mysql_select_db($database_connspkp, $connspkp);
$query_RsLogin = "SELECT * FROM tblpengguna WHERE Login='$iduser'";
$RsLogin = mysql_query($query_RsLogin, $connspkp) or die(mysql_error());
$row_RsLogin = mysql_fetch_assoc($RsLogin);
$totalRows_RsLogin = mysql_num_rows($RsLogin);

	if ((md5($oldpass))!=$row_RsLogin['Klaluan']){ ?>

	<SCRIPT language=JavaScript type=text/JavaScript>
	alert("Maaf,katalaluan lama anda tidak betul. Anda tidak layak untuk menukar katalaluan");
	location.href="TukarPass.php";

	</SCRIPT>
<?php	//header("Location: Changepass.php");
	};
?>
<meta http-equiv="refresh" content="2;URL=TukarPass.php">

<style type="text/css">
<!--
.style1 {
	font-family: "Arial";
	font-size: 12px;
}
.style2 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<link rel="shortcut icon" href="images/faviconjata.ico">


<?
if ($newpass1==$newpass2 && (md5($oldpass))==$row_RsLogin['Klaluan']){

$mypass=md5($newpass1);

$query="UPDATE tblpengguna SET Klaluan='$mypass' where Login='$iduser'";
@mysql_select_db($database_connspkp) or die( "Unable to select database");
mysql_query($query); 

		include('Logger.php');
		logMe("Menukar kata laluan");

?>

<p class="style1"><?php echo "Katalaluan telah ditukar";?>
		
		
		


<?php
mysql_close();
}
?>


<p class="style1">Kemaskini katalaluan<span class="style2"> berjaya</span>! kembali ke mukasurat sebelum ini, sila <a href="TukarPass.php">klik sini</a> 
  <?php
mysql_free_result($RsLogin);

?>
