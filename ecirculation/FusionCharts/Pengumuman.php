<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

if($_SESSION["kategori"] !='4' ){
    header("Location: Logout.php");
  };
  $stridKemaskini=$_SESSION["idPengguna"];
  
?>
<?php

/////////FETCH DATA for papar/tutup pengumuman//////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['p'])) {
	$statusid=$_GET['p'];

	if($_GET['s']=='papar'){
		$newstatus='tutup';
		}
	else {
		$newstatus='papar';
		};


	$paparSQL = sprintf("UPDATE tblpengumuman SET status='$newstatus' WHERE id='$statusid'");

  	mysql_select_db($database_connspkp, $connspkp);
  	$Result_paparSQL = mysql_query($paparSQL, $connspkp) or die(mysql_error());

		include('Logger.php');
		logMe($newstatus.": ".$statusid);


};
/////////FETCH DATA for papar/tutup pengumuman END//////////////////////////////////////////////////////////////////////////////////
/////////////DELETE Pengumuman/////////////////////////////////////////////////////////////////
if ((isset($_GET['deleteid'])) && ($_GET['deleteid'] != "")) {
  $deleteid = $_GET['deleteid'];
  $deleteSQL = sprintf("DELETE FROM tblpengumuman WHERE id='$deleteid'");

  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($deleteSQL, $connspkp) or die(mysql_error());

  	logMe("Hapus pengumuman: ".$deleteid);

}
/////////////FINISH DELETE Pengumuman/////////////////////////////////////////////////////////////////




$maxRows_RsPengumuman = 30;
$pageNum_RsPengumuman = 0;
if (isset($_GET['pageNum_RsPengumuman'])) {
  $pageNum_RsPengumuman = $_GET['pageNum_RsPengumuman'];
}
$startRow_RsPengumuman = $pageNum_RsPengumuman * $maxRows_RsPengumuman;

mysql_select_db($database_connspkp, $connspkp);
$query_RsPengumuman = "SELECT * FROM tblpengumuman ORDER BY trCipta DESC";
$query_limit_RsPengumuman = sprintf("%s LIMIT %d, %d", $query_RsPengumuman, $startRow_RsPengumuman, $maxRows_RsPengumuman);
$RsPengumuman = mysql_query($query_limit_RsPengumuman, $connspkp) or die(mysql_error());
$row_RsPengumuman = mysql_fetch_assoc($RsPengumuman);

if (isset($_GET['totalRows_RsPengumuman'])) {
  $totalRows_RsPengumuman = $_GET['totalRows_RsPengumuman'];
} else {
  $all_RsPengumuman = mysql_query($query_RsPengumuman);
  $totalRows_RsPengumuman = mysql_num_rows($all_RsPengumuman);
}
$totalPages_RsPengumuman = ceil($totalRows_RsPengumuman/$maxRows_RsPengumuman)-1;

$queryString_RsPengumuman = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsPengumuman") == false &&
        stristr($param, "totalRows_RsPengumuman") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsPengumuman = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsPengumuman = sprintf("&totalRows_RsPengumuman=%d%s", $totalRows_RsPengumuman, $queryString_RsPengumuman);
?>

<?php include 'include/Popup.php';?><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>



<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	/*background-color: DimGray;*/
	background-image: url("././images/bgblur.jpg");
	background-size: cover;
}
-->
</style>
<link href="myStyle.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/faviconjata.ico">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {
	font-family: Arial;
	font-size: 12px;
}
.style7 {font-size: 12px}
body,td,th {
	font-family: Arial;
	font-size: 12px;
}
.style9 {color: #6699CC}
-->
</style>

<div align="center">
  <table class="table" >
    <!--DWLayoutTable-->
    <tr>
      <td  colspan="3" valign="top" align="center"><img src="images/wqs.png"></td>
    </tr>
    <tr>
      <td width="32" height="409" valign="top"></td>
      <td valign="top"><table class="table">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="250" height="338" valign="top"><?php include 'include/menuadmin.php'; ?>
            <p>&nbsp;</p>
            </td>
            <td valign="top" align="center"><table class="table">
            <!--DWLayoutTable-->
            <tr>
              <td width="743" height="336" valign="top"><p><font size="3"><span class="style9">URUS PENGUMUMAN </span></p>
                <table width="100%"  border="1" cellpadding="1" cellspacing="1" class="table table-stripe">
                  <tr bgcolor="#897270" align="center">
                    <td><font size="2" color="white">No</td></font>
                    <td><font size="2" color="white">Tajuk</td></font>
                    <td><font size="2" color="white">Kandungan</td></font>
                    <td><font size="2" color="white">Status</td></font>
                    <td><font size="2" color="white">Tindakan Urusan</td></font>
                  </tr>
                  <?php
				  //2 color rows//////////////////////////////////////////////////////////////////////
						$color1 = "white";
						$color2 = "#f9f7f7";
 			   			$row_count = 0;
						$No=(($pageNum_RsPengumuman)*$maxRows_RsPengumuman);

  				    	//Looping result of RsPengumuman/////////////////////////////////////////////////
						do {
  				    	$No++;
    					$row_color = ($row_count % 2) ? $color1 : $color2;
					  ?>
                  <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                    <td><font size="2" color="black"><?php echo $No; ?></td></font>
                    <td><font size="2" color="black"><?php echo $row_RsPengumuman['Tajuk']; ?></td></font>
                    <td><font size="2" color="black"><?php echo $row_RsPengumuman['Kandungan']; ?></td></font>
                    <td><font size="2" color="black"><?php echo $row_RsPengumuman['status']; ?></td></font>
                    <td><a href="Pengumuman.php?deleteid=<?php echo $row_RsPengumuman['id']; ?>" onClick = "if (! confirm('Anda pasti untuk hapus pengumuman ini?')) return false;" ><img src="images/delete.gif" width="17" height="17" border="0"></a>  <a href="Pengumuman.php?p=<?php echo $row_RsPengumuman['id']; ?>&s=<?php echo $row_RsPengumuman['status']; ?>" onClick = "if (! confirm('Anda pasti untuk papar/tutup pengumuman ini?')) return false;" ><img src="images/fullscreen_maximize.gif" width="18" height="18" border="0"></a></td></font>
                  </tr>
                  <?php
				  $row_count++;
				  } while ($row_RsPengumuman = mysql_fetch_assoc($RsPengumuman));
				  ?>
                </table>
                <p align="center">| <a href="<?php printf("%s?pageNum_RsPengumuman=%d%s", $currentPage, 0, $queryString_RsPengumuman); ?>">Mula</a> | <a href="<?php printf("%s?pageNum_RsPengumuman=%d%s", $currentPage, max(0, $pageNum_RsPengumuman - 1), $queryString_RsPengumuman); ?>">Sebelum</a> | <a href="<?php printf("%s?pageNum_RsPengumuman=%d%s", $currentPage, min($totalPages_RsPengumuman, $pageNum_RsPengumuman + 1), $queryString_RsPengumuman); ?>">Selepas</a> | <a href="<?php printf("%s?pageNum_RsPengumuman=%d%s", $currentPage, $totalPages_RsPengumuman, $queryString_RsPengumuman); ?>">Akhir</a> | <br>
                  <?php

 /////////////////////////////////////PAGING//////////////////////////////////////////////////////////////////////
				//$strUrusan = $row_RsUrusan['subaktiviti'];

				echo "|";
				for ($i=0; $i<=$totalPages_RsPengumuman; $i++) {
							echo " ";
							echo "<a href='Pengumuman.php?pageNum_RsPengumuman=".$i."'>".$i."</a> ";
							echo " |";
				};

///////////////////////////////////PAGING END//////////////////////////////////////////////////////////////////////////



		  ?>
                </p></td>
            </tr>
          </table></td>
        </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#FF8C00"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="1"></td>
      <td width="954"></td>
      <td></td>
    </tr>
  </table>
</div>
<?php
mysql_free_result($RsPengumuman);
?>
