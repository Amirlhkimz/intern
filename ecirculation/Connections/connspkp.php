<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connspkp = "localhost";
$database_connspkp = "testing";
$username_connspkp = "root"/*"superuser"*/;
$password_connspkp = ""/*"c1l1p4d1@jp@"*/;
// $mysqli = new mysqli("localhost", "testing", "root", "");
// Create a connection
$mysqli = new mysqli($hostname_connspkp, $database_connspkp, $username_connspkp, $password_connspkp);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
 

// /*mysql_pconnect($hostname_connspkp, $database_connspkp, $username_connspkp, $password_connspkp) or trigger_error(mysql_error(), E_USER_ERROR);
