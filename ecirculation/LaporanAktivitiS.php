<?php require_once('Connections/connspkp.php'); ?>
<? session_start();

		if($_SESSION["kategori"] !='3' ){
		header("Location: Logout.php");
	};
	
	
?>
<?php
include('include/FormatDate.php');
/////////FETCH DATA per Kumpulan//////////////////////////////////////////////////////////////////////////////////
$Search='';
if (isset($_POST['txtCari'])){
	$Search=$_POST['txtCari'];
	$query_RsLog = "SELECT tbllog.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh FROM tbllog
				INNER JOIN tblpengguna
				ON tbllog.idPengguna=tblpengguna.id
				WHERE (tbllog.Aktiviti LIKE '%$Search%' OR tbllog.Masa LIKE '%$Search%' OR tblpengguna.NamaPenuh LIKE '%$Search%')
				AND tbllog.idPengguna='".$_SESSION['idPengguna']."'
				AND tbllog.Aktiviti!='Login' AND tbllog.Aktiviti!='Logout'
				ORDER BY Masa DESC";
}
else if (isset($_GET['txtS'])){
	$Search=$_GET['txtS'];
	$query_RsLog = "SELECT tbllog.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh FROM tbllog
				INNER JOIN tblpengguna
				ON tbllog.idPengguna=tblpengguna.id
				WHERE (tbllog.Aktiviti LIKE '%$Search%' OR tbllog.Masa LIKE '%$Search%' OR tblpengguna.NamaPenuh LIKE '%$Search%')
				AND tbllog.idPengguna='".$_SESSION['idPengguna']."'
				AND tbllog.Aktiviti!='Login' AND tbllog.Aktiviti!='Logout'
				ORDER BY Masa DESC";
}

else {
	$query_RsLog = "SELECT tbllog.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh FROM tbllog
				INNER JOIN tblpengguna
				ON tbllog.idPengguna=tblpengguna.id
				WHERE tbllog.idPengguna='".$_SESSION['idPengguna']."'
				AND tbllog.Aktiviti!='Login' AND tbllog.Aktiviti!='Logout'
				ORDER BY Masa DESC";
};
/////////FETCH DATA per Kumpulan END//////////////////////////////////////////////////////////////////////////////////





$maxRows_RsLog = 50;
$pageNum_RsLog = 0;
if (isset($_GET['pageNum_RsLog'])) {
  $pageNum_RsLog = $_GET['pageNum_RsLog'];
}
$startRow_RsLog = $pageNum_RsLog * $maxRows_RsLog;

mysql_select_db($database_connspkp, $connspkp);
/* $query_RsLog = "SELECT tbllog.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh FROM tbllog
				INNER JOIN tblpengguna
				ON tbllog.idPengguna=tblpengguna.id
				ORDER BY Masa DESC"; */
$query_limit_RsLog = sprintf("%s LIMIT %d, %d", $query_RsLog, $startRow_RsLog, $maxRows_RsLog);
$RsLog = mysql_query($query_limit_RsLog, $connspkp) or die(mysql_error());
$row_RsLog = mysql_fetch_assoc($RsLog);
$all_RsLog = mysql_query($query_RsLog);

if (isset($_GET['totalRows_RsLog'])) {
  $totalRows_RsLog = $_GET['totalRows_RsLog'];
} else {
  $all_RsLog = mysql_query($query_RsLog);
  $totalRows_RsLog = mysql_num_rows($all_RsLog);
}
$totalPages_RsLog = ceil($totalRows_RsLog/$maxRows_RsLog)-1;

$queryString_RsLog = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsLog") == false &&
		stristr($param, "totalRows_RsLog") == false &&
        stristr($param, "txtS") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsLog = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsLog = sprintf("&totalRows_RsLog=%d%s&txtS=%s", $totalRows_RsLog, $queryString_RsLog, $Search);
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
.style12 {color: #FF0000;
	font-weight: bold;
}
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
            <td width="250" height="201" valign="top"><?php include 'include/menupenyelaras.php'; ?>
            <br></td>
            <td valign="top" align="center"><table class="table">
            <!--DWLayoutTable-->
            <tr>
              <td width="750" height="315" valign="top"><p><span class="style9"><font size="3">LIHAT LOG AKTIVITI</span></p></font>
                <p><span class="style7">Kriteria carian = &quot;</span><span class="style9"><span class="style12"><?php echo $Search?></span></span><span class="style7">&quot; || Sejumlah</span><span class="style9"><span class="style12"> <?php echo mysql_num_rows($all_RsLog);?> </span></span><span class="style7">rekod ditemui.</span> </p>
                <form name="form1" method="post" action="LaporanAktivitiU.php">
                  <img src="images/arrow.gif" width="12" height="10"> Cari :
                  <input name="txtCari" type="text" id="txtCari" size="70">
                  <input type="submit" name="Submit" value="Cari">
                </form>
                <table width="100%"  border="1" cellpadding="1" cellspacing="1" class="table table-stripe">
                  <tr bgcolor="#897270">
                    <td width="3%"><span class="style1"><font size="2">No</span></td></font>
                    <td width="24%"><span class="style1"><font size="2">Pengguna</span></td></font>
                    <td width="48%"><span class="style1"><font size="2">Aktiviti</span></td></font>
                    <td width="25%"><span class="style1"><font size="2">Tarikh / Masa </span><span class="style1"></span></td></font>
                    </tr>
                  <?php
				  //2 color rows//////////////////////////////////////////////////////////////////////
						$color1 = "white";
						$color2 = "#f9f7f7";
 			   			$row_count = 0;
						$No=(($pageNum_RsLog)*$maxRows_RsLog);

  				    	//Looping result of RsLog/////////////////////////////////////////////////
						do {
  				    	$No++;
    					$row_color = ($row_count % 2) ? $color1 : $color2;
					  ?>
                  <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                    <td><font size="2"><?php echo $No; ?></td></font>
                    <td><font size="2"><?php echo $row_RsLog['Gelaran']." ".$row_RsLog['NamaPenuh']; ?></td></font>
                    <td><font size="2"><?php echo $row_RsLog['Aktiviti']; ?></td></font>
                    <td><font size="2"><?php echo format_datetime($row_RsLog['Masa']); ?>  </td></font>
                    </tr>
                  <?php
				  $row_count++;
				  } while ($row_RsLog = mysql_fetch_assoc($RsLog));
				  ?>
                </table>
                <p align="center">| <a href="<?php printf("%s?pageNum_RsLog=%d%s", $currentPage, 0, $queryString_RsLog); ?>">Mula</a> | <a href="<?php printf("%s?pageNum_RsLog=%d%s", $currentPage, max(0, $pageNum_RsLog - 1), $queryString_RsLog); ?>">Sebelum</a> | <a href="<?php printf("%s?pageNum_RsLog=%d%s", $currentPage, min($totalPages_RsLog, $pageNum_RsLog + 1), $queryString_RsLog); ?>">Selepas</a> | <a href="<?php printf("%s?pageNum_RsLog=%d%s", $currentPage, $totalPages_RsLog, $queryString_RsLog); ?>">Akhir</a> | <br>
                  <?php

 /////////////////////////////////////PAGING//////////////////////////////////////////////////////////////////////
				//$strUrusan = $row_RsUrusan['subaktiviti'];

				echo "|";
				for ($i=0; $i<=$totalPages_RsLog; $i++) {
							echo " ";
							echo "<a href='LaporanAktivitiU.php?pageNum_RsLog=".$i."&txtS=".$Search."'>".$i."</a> ";
							echo " |";
				};

///////////////////////////////////PAGING END//////////////////////////////////////////////////////////////////////////



		  ?>
                </p></td>
            </tr>
          </table></td>
        </tr>
		<tr>
            <td height="28" colspan="2" valign="top" bgcolor="#7d1935"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
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
mysql_free_result($RsLog);
?>
