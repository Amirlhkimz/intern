<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connspkp = "localhost";
$database_connspkp = "testing";
$username_connspkp = "root";
$password_connspkp = "";
// $connspkp = // Create a connection
$mysqli = new mysqli($hostname_connspkp, $database_connspkp, $username_connspkp, $password_connspkp);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


// /* mysql_connect($hostname_connspkp, $username_connspkp, $password_connspkp) or trigger_error(mysql_error(), E_USER_ERROR); */
