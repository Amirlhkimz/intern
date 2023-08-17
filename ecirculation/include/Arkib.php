#!/opt/lampp/bin/php-5.2.9
<?php
include("../Connections/connspkp.php");

//$tarikh_arkib = date("Y-m-")."01";
$tarikh_arkib = date("Y-m-d", strtotime("-2 months"));

mysql_select_db($database_connspkp, $connspkp);
$sqlArkibLog=mysql_query("	INSERT INTO tbllog_arkib 
							SELECT * from tbllog 
							WHERE Masa < '$tarikh_arkib'" );

$sqlDeleteArchived=mysql_query("	DELETE from tbllog 
									WHERE Masa < '$tarikh_arkib'" );


?>
