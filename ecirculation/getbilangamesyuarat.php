<?php
require_once('Connections/connspkp.php');

ob_start();
session_start();

//if($_SESSION["Kumpulan"] !='urusetia' ){
//header("Location: Logout.php");

if ($_SESSION["kategori"] != '4') {
    header("Location: Logout.php");
}

$tahunMesyuarat = '';
$tajukmesyuarat = '';

if (count($_GET) > 0) {

    $paramsObj = (object) $_GET;
    unset($_GET);

    /* Retrieve params if any */
    if (isset($paramsObj->x)) {

        $tahunMesyuarat = date("Y", strtotime($paramsObj->x));
    }

    if (isset($paramsObj->y)) {
        $tajukmesyuarat = $paramsObj->y;
    }

    mysql_select_db($database_connspkp, $connspkp);

    $sql = <<<SQL
SELECT
  count(id) as Siri
FROM tblmesyuarat WHERE YEAR(tarikhMesyuarat) = $tahunMesyuarat
AND TajukMesyuaratID = $tajukmesyuarat
SQL;
    // echo $sql;
    $query = mysql_query($sql, $connspkp) or die(mysql_error());
    $row = mysql_fetch_assoc($query);
    $numrows = mysql_num_rows($query);

    if ($numrows > 0) {

        if ($row['Siri'] == 0) {
            $bilMesyuarat = 1;
        } else {
            $bilMesyuarat = $row['Siri'] + 1;
        }
    } else {
        $bilMesyuarat = 1;
    }

    echo $bilMesyuarat;
}
