<?php require_once('Connections/connspkp.php'); ?>
<? 
ob_start();
session_start(); 

if($_SESSION["Kumpulan"] !='Suruhanjaya' ){
	if($_SESSION["Kumpulan"] !='Pengerusi' ){
		header("Location: Logout.php");
		}
	};
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
 //require_once('Connections/connspkp.php'); ?>


<?php
$idPengguna=$_SESSION["idPengguna"];
/////////FETCH DATA//////////////////////////////////////////////////////////////////////////////////
$Search='';
$strCari='';
$Status='';
if (isset($_POST['txtCari'])){
	$Search=$_POST['txtCari'];
	$strCari=$Search; 
	 $query_RsStatusUrusan = "SELECT tblstatusurusan.id, tblstatusurusan.idUrusan, tblstatusurusan.idPengguna, tblstatusurusan.Keputusan, tblstatusurusan.Kategori, tblstatusurusan.Ulasan,
							tblstatusurusan.TrTerima, tblstatusurusan.TrBuka, tblstatusurusan.TrSelesai, tblstatusurusan.Tempoh, tblstatusurusan.Status,
							tblurusan.Jenis, tblurusan.Ringkasan, tblurusan.Kertas, tbljenisurusan.ruj_jenisurusan, tblurusan.bilMesyuarat 
							FROM tblstatusurusan, tblurusan, tbljenisurusan
							WHERE (tblstatusurusan.idUrusan = tblurusan.id) 
							AND (Jenis LIKE '%$Search%' OR Ringkasan LIKE '%$Search%' OR Kertas LIKE '%$Search%' OR Keputusan LIKE '%$Search%' )
							AND (tblurusan.Jenis = tbljenisurusan.desc_jenisurusan) 
							AND idPengguna = '$idPengguna' ORDER BY tblurusan.id desc"; 
							
/* 	$query_RsStatusUrusan = "SELECT tblstatusurusan.id, tblstatusurusan.idUrusan, tblstatusurusan.idPengguna, tblstatusurusan.Keputusan, tblstatusurusan.Kategori, tblstatusurusan.Ulasan,
							tblstatusurusan.TrTerima, tblstatusurusan.TrBuka, tblstatusurusan.TrSelesai, tblstatusurusan.Tempoh, tblstatusurusan.Status,
							tblurusan.Jenis, tblurusan.Ringkasan, tblurusan.Kertas, tbljenisurusan.ruj_jenisurusan  
							FROM tblstatusurusan, tblurusan, tbljenisurusan
							WHERE (tblstatusurusan.idUrusan = tblurusan.id) 
							AND (Jenis LIKE '%$Search%' OR Ringkasan LIKE '%$Search%' OR Kertas LIKE '%$Search%' OR Keputusan LIKE '%$Search%' )
							AND (tblurusan.Jenis = tbljenisurusan.desc_jenisurusan) 
							ORDER BY TrTerima DESC"; */
}
else if (isset($_GET['txtS'])){
	$Search=$_GET['txtS'];
	$strCari=$Search; 
 	$query_RsStatusUrusan = "SELECT tblstatusurusan.id, tblstatusurusan.idUrusan, tblstatusurusan.idPengguna, tblstatusurusan.Keputusan, tblstatusurusan.Kategori, tblstatusurusan.Ulasan,
							tblstatusurusan.TrTerima, tblstatusurusan.TrBuka, tblstatusurusan.TrSelesai, tblstatusurusan.Tempoh, tblstatusurusan.Status,
							tblurusan.Jenis, tblurusan.Ringkasan, tblurusan.Kertas, tbljenisurusan.ruj_jenisurusan  , tblurusan.bilMesyuarat 
							FROM tblstatusurusan, tblurusan, tbljenisurusan
							WHERE (tblstatusurusan.idUrusan = tblurusan.id) 
							AND (Jenis LIKE '%$Search%' OR Ringkasan LIKE '%$Search%' OR Kertas LIKE '%$Search%' OR Keputusan LIKE '%$Search%' )
							AND (tblurusan.Jenis = tbljenisurusan.desc_jenisurusan) 
							AND idPengguna = '$idPengguna' ORDER BY tblurusan.id desc"; 
							
	/* $query_RsStatusUrusan = "SELECT tblstatusurusan.id, tblstatusurusan.idUrusan, tblstatusurusan.idPengguna, tblstatusurusan.Keputusan, tblstatusurusan.Kategori, tblstatusurusan.Ulasan,
							tblstatusurusan.TrTerima, tblstatusurusan.TrBuka, tblstatusurusan.TrSelesai, tblstatusurusan.Tempoh, tblstatusurusan.Status,
							tblurusan.Jenis, tblurusan.Ringkasan, tblurusan.Kertas, tbljenisurusan.ruj_jenisurusan  
							FROM tblstatusurusan, tblurusan, tbljenisurusan
							WHERE (tblstatusurusan.idUrusan = tblurusan.id) 
							AND (Jenis LIKE '%$Search%' OR Ringkasan LIKE '%$Search%' OR Kertas LIKE '%$Search%' OR Keputusan LIKE '%$Search%' )
							AND (tblurusan.Jenis = tbljenisurusan.desc_jenisurusan) 
							ORDER BY TrTerima DESC"; */
}
else if (isset($_GET['stat'])) {
	$Status=$_GET['stat'];
	 $query_RsStatusUrusan = " SELECT tblurusan.*, tblstatusurusan.* FROM tblurusan, tblstatusurusan WHERE idPengguna = '$idPengguna' AND tblstatusurusan.Status='$Status' AND tblurusan.id = tblstatusurusan.idUrusan AND tblurusan.status !='BATAL' ORDER BY tblurusan.id desc";
	 //$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idPengguna = '$idPengguna' AND Status='$Status' ORDER BY TrTerima DESC";
	
	/* $query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE Status='$Status' ORDER BY TrTerima DESC" */;
}
else {
	  $query_RsStatusUrusan = "SELECT tblurusan.*, tblstatusurusan.* FROM tblurusan, tblstatusurusan WHERE idPengguna = '$idPengguna' AND tblurusan.id = tblstatusurusan.idUrusan AND tblurusan.status !='BATAL' ORDER BY tblurusan.id desc";
	 //$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idPengguna = '$idPengguna' ORDER BY TrTerima DESC"; 
	/* $query_RsStatusUrusan = "SELECT * FROM tblstatusurusan ORDER BY TrTerima DESC"; */
};


/////////FETCH DATA END//////////////////////////////////////////////////////////////////////////////////



$maxRows_RsStatusUrusan = 30;
$pageNum_RsStatusUrusan = 0;
if (isset($_GET['pageNum_RsStatusUrusan'])) {
  $pageNum_RsStatusUrusan = $_GET['pageNum_RsStatusUrusan'];
}
$startRow_RsStatusUrusan = $pageNum_RsStatusUrusan * $maxRows_RsStatusUrusan;

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idPengguna = '$idPengguna' ORDER BY TrTerima DESC";
$query_limit_RsStatusUrusan = sprintf("%s LIMIT %d, %d", $query_RsStatusUrusan, $startRow_RsStatusUrusan, $maxRows_RsStatusUrusan);
$RsStatusUrusan = mysql_query($query_limit_RsStatusUrusan, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$all_RsStatusUrusan = mysql_query($query_RsStatusUrusan);

if (isset($_GET['totalRows_RsStatusUrusan'])) {
  $totalRows_RsStatusUrusan = $_GET['totalRows_RsStatusUrusan'];
} else {
  $all_RsStatusUrusan = mysql_query($query_RsStatusUrusan);
  $totalRows_RsStatusUrusan = mysql_num_rows($all_RsStatusUrusan);
}
$totalPages_RsStatusUrusan = ceil($totalRows_RsStatusUrusan/$maxRows_RsStatusUrusan)-1;

$queryString_RsStatusUrusan = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsStatusUrusan") == false &&
		stristr($param, "totalRows_RsStatusUrusan") == false &&
		stristr($param, "stat") == false && 
        stristr($param, "txtS") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsStatusUrusan = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsStatusUrusan = sprintf("&totalRows_RsStatusUrusan=%d%s&stat=%s&txtS=%s", $totalRows_RsStatusUrusan, $queryString_RsStatusUrusan, $Status, $Search);



?>

<?php 
include 'include/Popup.php'; 

?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #577dc9;
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
.style10 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>

<div align="center" class="style3">
  <table width="1024" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCFE" class="PAGECONTAINER">
    <!--DWLayoutTable-->
    <tr bgcolor="#CCCCFE">
      <td height="246" colspan="3" valign="top"><img src="images/BANNER_new2.jpg" width="1024" height="246"></td>
    </tr>
    <tr>
      <td width="32" height="272" valign="top" background="images/10241_05.jpg" class="containerleft"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td width="954" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="204" height="201" valign="top"><?php include 'include/menuuser.php'; ?>
            <br></td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="750" height="201" valign="top"><p><span class="style9">LIHAT URUSAN</span></p>
                  <p><span class="style7">Kriteria carian = &quot;</span><span class="style10"><?php echo $strCari?></span><span class="style7">&quot; || Sejumlah</span><span class="style10"> <?php echo mysql_num_rows($all_RsStatusUrusan);?> </span><span class="style7">rekod ditemui. </span></p>
                  <form name="form1" method="post" action="LihatUrusan2.php">
                    <img src="images/arrow.gif" width="12" height="10"> Cari : 
                    <input name="txtCari" type="text" id="txtCari" size="70">
                    <input type="submit" name="Submit" value="Cari">
                  </form>                  
                  <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="blueline">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#999999">
                      <td width="5%"><div align="center"><span class="style1">Bil</span></div></td>
                      <td width="26%"><div align="center"><span class="style1">Jenis Urusan </span></div></td>
                      <td width="27%"><div align="center"><span class="style1">Ringkasan</span></div></td>
                      <td width="10%"><div align="center"><span class="style1">Kertas</span></div></td>
                      <td width="5%"><div align="center"><span class="style1">Status Urusan </span></div></td>
                      <td width="10%"><div align="center"><span class="style1">Keputusan</span></div></td>
                      <td width="10%"><div align="center"><span class="style1">Tempoh </span></div></td>
                      <td width="10%"><div align="center"><span class="style1">Status Keseluruhan </span></div></td>
                      <td width="5%"><div align="center"><span class="style1">Tindakan</span></div></td>
                    </tr>
                    <?php      
		    		//2 color rows//////////////////////////////////////////////////////////////////////
					$color1 = "#CECFFF"; 
					$color2 = "#D9ECFF"; 
 			   		$row_count = 0;
					$sNoKertas = "";
					$No=(($pageNum_RsStatusUrusan)*$maxRows_RsStatusUrusan);
					
  				    //Looping result of RsStatus Urusan///////////////////////////////////////////////// 
					do { 
  				    $No++; 
    				$row_color = ($row_count % 2) ? $color1 : $color2; 
					
							//Get Urusan info from tblurusan///////////////////////////////////////////////////////////////////////
							$idUrusan=$row_RsStatusUrusan['idUrusan'];
							$vNoKertas =$row_RsStatusUrusan['bilMesyuarat'];
							mysql_select_db($database_connspkp, $connspkp);
							$querytjk = "SELECT sirithn,DATE_FORMAT(tarikhMesyuarat, '%d/%m/%Y') as tarikhMesyuarat  
							FROM tblmesyuarat WHERE mesyuarat='$vNoKertas'";
							$RsCountTjk = mysql_query($querytjk, $connspkp) or die(mysql_error());
							$row_RsCountTjk = mysql_fetch_assoc($RsCountTjk);
						    $jumMesy=$row_RsCountTjk['sirithn'];
							$tkhMesy=$row_RsCountTjk['tarikhMesyuarat'];
							if ($jumMesy<>'') $sirimesy = ' ('. $jumMesy.') '; else $sirimesy = '';
							if ($tkhMesy=='' || $tkhMesy=='00/00/0000' ) $mesy = ''; else $mesy = 'pada '. $tkhMesy; 
							$maxRows_RsUrusan = 1;
$pageNum_RsUrusan = 0;
if (isset($_GET['pageNum_RsUrusan'])) {
  $pageNum_RsUrusan = $_GET['pageNum_RsUrusan'];
}
$startRow_RsUrusan = $pageNum_RsUrusan * $maxRows_RsUrusan;

mysql_select_db($database_connspkp, $connspkp);
$query_RsUrusan = "SELECT tblurusan.*, tbljenisurusan.ruj_jenisurusan FROM tblurusan, tbljenisurusan WHERE tblurusan.id='$idUrusan' AND (tblurusan.Jenis=tbljenisurusan.desc_jenisurusan)";
$query_limit_RsUrusan = sprintf("%s LIMIT %d, %d", $query_RsUrusan, $startRow_RsUrusan, $maxRows_RsUrusan);
$RsUrusan = mysql_query($query_limit_RsUrusan, $connspkp) or die(mysql_error());
$row_RsUrusan = mysql_fetch_assoc($RsUrusan);

if (isset($_GET['totalRows_RsUrusan'])) {
  $totalRows_RsUrusan = $_GET['totalRows_RsUrusan'];
} else {
  $all_RsUrusan = mysql_query($query_RsUrusan);
  $totalRows_RsUrusan = mysql_num_rows($all_RsUrusan);
}
$totalPages_RsUrusan = ceil($totalRows_RsUrusan/$maxRows_RsUrusan)-1;

$queryString_RsUrusan = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsUrusan") == false && 
        stristr($param, "totalRows_RsUrusan") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsUrusan = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsUrusan = sprintf("&totalRows_RsUrusan=%d%s", $totalRows_RsUrusan, $queryString_RsUrusan);
							
							if ($totalRows_RsUrusan>0){
								if (($row_RsStatusUrusan['Status'])!='Selesai') {
							
									$strMula=$row_RsStatusUrusan['TrTerima'];
									$strKini=date("Y-m-j  H:i:s");
									//$strKini=$row_RsStatusUrusan['TrKemaskini'];
									
									$date_diff = abs(strtotime($strMula)-strtotime($strKini)) / 86400;
							
								}
							
								else if (($row_RsStatusUrusan['Status'])=='BATAL') {
							
									$strMula=$row_RsStatusUrusan['TrTerima'];
									$strKini=$row_RsStatusUrusan['TrSelesai'];
							
									$date_diff = abs(strtotime($strMula)-strtotime($strKini)) / 86400;
							
								}
							
								else  {
							
									$strMula=$row_RsStatusUrusan['TrTerima'];
									$strKini=$row_RsStatusUrusan['TrSelesai'];
									//$strKini=date("Y-m-j  H:i:s");
							
									$date_diff = abs(strtotime($strMula)-strtotime($strKini)) / 86400;
							
								};
							}
							else {
							$date_diff=0;
							};
				
							//Get Urusan info from tblurusan END///////////////////////////////////////////////////////////////////////
							//Count Baru from tblStatusUrusan///////////////////////////////////////////////////////////////////////
							mysql_select_db($database_connspkp, $connspkp);
							$query_RsCountBaru = "SELECT COUNT(*) FROM tblstatusurusan WHERE idUrusan='$idUrusan' AND Status='Baru'";
							$RsCountBaru = mysql_query($query_RsCountBaru, $connspkp) or die(mysql_error());
							$row_RsCountBaru = mysql_fetch_assoc($RsCountBaru);
							$totalRows_RsCountBaru = mysql_num_rows($RsCountBaru);

							//Count Baru from tblStatusUrusan END///////////////////////////////////////////////////////////////////////
							//Count Pertimbangan from tblStatusUrusan///////////////////////////////////////////////////////////////////////
							mysql_select_db($database_connspkp, $connspkp);
							$query_RsCountPertimbangan = "SELECT COUNT(*) FROM tblstatusurusan WHERE idUrusan='$idUrusan' AND Status='Pertimbangan'";
							$RsCountPertimbangan = mysql_query($query_RsCountPertimbangan, $connspkp) or die(mysql_error());
							$row_RsCountPertimbangan = mysql_fetch_assoc($RsCountPertimbangan);
							$totalRows_RsCountPertimbangan = mysql_num_rows($RsCountPertimbangan);

							//Count Pertimbangan from tblStatusUrusan END///////////////////////////////////////////////////////////////////////
							//Count Selesai from tblStatusUrusan///////////////////////////////////////////////////////////////////////
							mysql_select_db($database_connspkp, $connspkp);
							$query_RsCountSelesai = "SELECT COUNT(*) FROM tblstatusurusan WHERE idUrusan='$idUrusan' AND Status='Selesai'";
							$RsCountSelesai = mysql_query($query_RsCountSelesai, $connspkp) or die(mysql_error());
							$row_RsCountSelesai = mysql_fetch_assoc($RsCountSelesai);
							$totalRows_RsCountSelesai = mysql_num_rows($RsCountSelesai);

							//Count Selesai from tblStatusUrusan END///////////////////////////////////////////////////////////////////////

					if ($sNoKertas != $vNoKertas)
						{
							
					?>
                    <tr bgcolor="#999999">
                      <td height="32" colspan="9" align="center"><strong><?php echo $vNoKertas .$sirimesy .$mesy; ?></strong></strong></td>
                     </tr>
                    <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                      <td width="5%" height="56"><?php echo $No; ?></td>
                      <td width="26%"><?php echo $row_RsUrusan['Jenis']; ?><br>
                        <?php echo $row_RsUrusan['ruj_jenisurusan']; ?></td>
                      <td width="27%"><?php echo $row_RsUrusan['Ringkasan']; ?> </td>
                      <td width="10%"><div align="center"><a href="StatusPertimbang.php?L=<?php echo $row_RsUrusan['Link']; ?>&U=<?php echo $row_RsUrusan['id']; ?>" target="_blank"><?php echo $row_RsUrusan['Kertas']; ?></a></div></td>
                      <td width="5%"><div align="center">
                          <table width="98%"  border="0" cellspacing="0" cellpadding="0">
                            <?php if (($row_RsStatusUrusan['Status'])=='Baru') { ?>
                            <tr>
                              <td bgcolor="#80E474"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="top"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Pertimbangan') {
						?>
                            <tr>
                              <td bgcolor="#FC9696"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="top"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Selesai') {
						?>
                            <tr>
                              <td bgcolor="#9191FF"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="top"></strong></div>
                              </div></td>
                            </tr>
                            <?php };?>
                          </table>
                      </div></td>
                      <td width="10%"><div align="center"><strong> <?php echo $row_RsStatusUrusan['Keputusan']; ?><br>
                      </strong></div></td>
                      <td width="10%"><div align="center"><strong><?php echo round($date_diff,0); ?> </strong>hari </div></td>
                      <td width="10%"><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                          <?php if (($row_RsCountBaru['COUNT(*)'])!=0) { ?>
                          <tr>
                            <td height="20" bgcolor="#80E474"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"> : <?php echo $row_RsCountBaru['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsCountPertimbangan['COUNT(*)'])!=0) {
						?>
                          <tr>
                            <td height="24" bgcolor="#FC9696"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"> : <?php echo $row_RsCountPertimbangan['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsCountSelesai['COUNT(*)'])!=0) {
						?>
                          <tr>
                            <td bgcolor="#9191FF"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountSelesai['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php };?>
                      </table></td>
                      <td width="5%"><div align="center">
                          <?php if (($row_RsUrusan['Status'])=='BATAL') { ?>
                          <span class="style10"><?php echo "BATAL"; ?></span><br>
                          <?php 
						}
						else {
								if (($row_RsStatusUrusan['Status'])!='Selesai') { ?>
                          <a href="Kemaskini.php?s=<?php echo $row_RsStatusUrusan['id']; ?>&u=<?php echo $row_RsStatusUrusan['idUrusan']; ?>"><img src="images/edit.png" width="16" height="16" border="0"></a><br>
                          <?php 
								};
								
								if (($row_RsStatusUrusan['Status'])=='Selesai') { ?>
                          <a href="LaporanKeputusan.php?s=<?php echo $row_RsStatusUrusan['id']; ?>"><img src="images/printer.gif" width="21" height="17" border="0"></a> </div></td>
                      <?php };
						}; ?>
                    </tr>
                    <?php
						}
						else {
					?>
                    <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                      <td width="5%" height="56"><?php echo $No; ?></td>
                      <td width="26%"><?php echo $row_RsUrusan['Jenis']; ?><br>
                        <?php echo $row_RsUrusan['ruj_jenisurusan']; ?></td>
                      <td width="27%"><?php echo $row_RsUrusan['Ringkasan']; ?> </td>
                      <td width="10%"><div align="center"><a href="StatusPertimbang.php?L=<?php echo $row_RsUrusan['Link']; ?>&U=<?php echo $row_RsUrusan['id']; ?>" target="_blank"><?php echo $row_RsUrusan['Kertas']; ?></a></div></td>
                      <td width="5%"><div align="center">
                          <table width="98%"  border="0" cellspacing="0" cellpadding="0">
                            <?php if (($row_RsStatusUrusan['Status'])=='Baru') { ?>
                            <tr>
                              <td bgcolor="#80E474"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="top"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Pertimbangan') {
						?>
                            <tr>
                              <td bgcolor="#FC9696"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="top"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Selesai') {
						?>
                            <tr>
                              <td bgcolor="#9191FF"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="top"></strong></div>
                              </div></td>
                            </tr>
                            <?php };?>
                          </table>
                      </div></td>
                      <td width="10%"><div align="center"><strong> <?php echo $row_RsStatusUrusan['Keputusan']; ?><br>
                      </strong></div></td>
                      <td width="10%"><div align="center"><strong><?php echo round($date_diff,0); ?> </strong>hari </div></td>
                      <td width="10%"><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                          <?php if (($row_RsCountBaru['COUNT(*)'])!=0) { ?>
                          <tr>
                            <td height="20" bgcolor="#80E474"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"> : <?php echo $row_RsCountBaru['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsCountPertimbangan['COUNT(*)'])!=0) {
						?>
                          <tr>
                            <td height="24" bgcolor="#FC9696"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"> : <?php echo $row_RsCountPertimbangan['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsCountSelesai['COUNT(*)'])!=0) {
						?>
                          <tr>
                            <td bgcolor="#9191FF"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountSelesai['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php };?>
                      </table></td>
                      <td width="5%"><div align="center">
                          <?php if (($row_RsUrusan['Status'])=='BATAL') { ?>
                          <span class="style10"><?php echo "BATAL"; ?></span><br>
                          <?php 
						}
						else {
								if (($row_RsStatusUrusan['Status'])!='Selesai') { ?>
                          <a href="Kemaskini.php?s=<?php echo $row_RsStatusUrusan['id']; ?>&u=<?php echo $row_RsStatusUrusan['idUrusan']; ?>"><img src="images/edit.png" width="16" height="16" border="0"></a><br>
                          <?php 
								};
								
								if (($row_RsStatusUrusan['Status'])=='Selesai') { ?>
                          <a href="LaporanKeputusan.php?s=<?php echo $row_RsStatusUrusan['id']; ?>"><img src="images/printer.gif" width="21" height="17" border="0"></a> </div></td>
                      <?php };
						}; ?>
                    </tr>
                    <?php
					  }
						  $sNoKertas = $vNoKertas;
				  $row_count++;
				  } while ($row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan)); 
				  //Loop RsStatusUrusan END//////////////////////////////////////////////////////////////
				  ?>
                  </table>
                  <p align="center">| <a href="<?php printf("%s?pageNum_RsStatusUrusan=%d%s", $currentPage, 0, $queryString_RsStatusUrusan); ?>">Mula</a> | <a href="<?php printf("%s?pageNum_RsStatusUrusan=%d%s", $currentPage, max(0, $pageNum_RsStatusUrusan - 1), $queryString_RsStatusUrusan); ?>">Sebelum</a> | <a href="<?php printf("%s?pageNum_RsStatusUrusan=%d%s", $currentPage, min($totalPages_RsStatusUrusan, $pageNum_RsStatusUrusan + 1), $queryString_RsStatusUrusan); ?>">Selepas</a> | <a href="<?php printf("%s?pageNum_RsStatusUrusan=%d%s", $currentPage, $totalPages_RsStatusUrusan, $queryString_RsStatusUrusan); ?>">Akhir</a> |<br>
                    <?php
		  
 /////////////////////////////////////PAGING//////////////////////////////////////////////////////////////////////
				//$strUrusan = $row_RsUrusan['subaktiviti'];
				
				echo "|";
				for ($i=0; $i<=$totalPages_RsStatusUrusan; $i++) { 
							echo " ";
							echo "<a href='LihatUrusan2.php?pageNum_RsStatusUrusan=".$i."&stat=".$Status."&txtS=".$Search."'>".$i."</a> ";
							echo " |";
				};

///////////////////////////////////PAGING END//////////////////////////////////////////////////////////////////////////
		  ?>
                    <br>
                    <br>
                  </p></td>
              </tr>
            </table></td>
          </tr>
          <tr bgcolor="#becdeb">
            <td height="28" colspan="2" valign="top"><div align="center" class="style7">| <a href="Utama2.php">muka utama</a> | <a href="EmailUrusetia.php">Emel urus setia</a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
          </tr>
            </table></td>
      <td width="38" valign="top" bgcolor="#CCCCFE" background="images/10241_08.jpg" class="containerright"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="21" valign="top" background="images/10241_25.jpg" class="containerBL"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" background="images/10241_27.jpg" class="containerbottom"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" bgcolor="#CCCCFE" background="images/10241_29.jpg" class="containerBR"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
  </table>
</div>
 
<?php
mysql_free_result($RsStatusUrusan);
mysql_free_result($RsUrusan);
mysql_free_result($RsCountBaru);
mysql_free_result($RsCountPertimbangan);
mysql_free_result($RsCountSelesai);

?>
