<?php
// *** Logout the current user.
$logoutGoTo = "index.php";
ob_start();
session_start();

if(isset($_SESSION["idPengguna"])){
		
		include('Logger.php');
		logMe("Logout");
		}

unset($_SESSION['Kumpulan']);
unset($_SESSION['NamaPenuh']);
unset($_SESSION['Login']);

if ($logoutGoTo != "") 
	{
	header("Location: $logoutGoTo");
	//session_unregister('Kumpulan');
	//session_unregister('NamaPenuh');
	//session_unregister('Login');

	exit;
	}
?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #CCCCFE;
}
-->
</style>
<link href="myStyle.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/faviconjata.ico">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {
	font-family: Arial;
	font-size: 9px;
}
.style5 {font-size: 12px}
-->
</style>


<?php

?>
