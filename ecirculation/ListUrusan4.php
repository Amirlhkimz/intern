<?php require_once('Connections/connspkp.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
?>
<? session_start(); 

if($_SESSION["Kumpulan"] !='Biasa' ){
		header("Location: Logout.php");
	};
?>

<?php
/////////FETCH DATA per Kumpulan//////////////////////////////////////////////////////////////////////////////////
$Search='';
//$Kump='';
if ($_POST['txtCari']!=''){
	$Search=$_POST['txtCari'];
	$query_RsUrusan = "SELECT * FROM tblurusan WHERE Jenis LIKE '%$Search%' OR Ringkasan LIKE '%$Search%' OR Kertas LIKE '%$Search%' ORDER BY TrCipta DESC";
}
else if($_GET['txtS']!=''){
	$Search=$_GET['txtS'];
	$query_RsUrusan = "SELECT * FROM tblurusan WHERE Jenis LIKE '%$Search%' OR Ringkasan LIKE '%$Search%' OR Kertas LIKE '%$Search%' ORDER BY TrCipta DESC";
}
/* else if ($_GET['Kump']!='') {
	$Kump=$_GET['Kump'];
	$query_RsUrusan = "SELECT * FROM tblurusan WHERE Kategori='$Kump' ORDER BY TrCipta DESC";
} */
else {
	$query_RsUrusan = "SELECT * FROM tblurusan WHERE status!='BATAL' ORDER BY TrCipta DESC";
};
/////////FETCH DATA per Kumpulan END//////////////////////////////////////////////////////////////////////////////////

/////////FETCH DATA for BATAL urusan//////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['batalid'])) {
	$batalid=$_GET['batalid'];
  	$TrKemaskini=date("Y-m-j  H:i:s");
	$stridKemaskini=$_SESSION["idPengguna"];
	
	$batalSQL = sprintf("UPDATE tblurusan SET status='BATAL', TrKemaskini='$TrKemaskini', idkemaskini='$stridKemaskini' WHERE id='$batalid'");

  	mysql_select_db($database_connspkp, $connspkp);
  	$Result_batalSQL = mysql_query($batalSQL, $connspkp) or die(mysql_error());
	
		include('Logger.php');
		logMe("Batal urusan: ".$batalid);

	
};
/////////FETCH DATA for BATAL urusan END//////////////////////////////////////////////////////////////////////////////////



$maxRows_RsUrusan = 20;
$pageNum_RsUrusan = 0;
if (isset($_GET['pageNum_RsUrusan'])) {
  $pageNum_RsUrusan = $_GET['pageNum_RsUrusan'];
}
$startRow_RsUrusan = $pageNum_RsUrusan * $maxRows_RsUrusan;

mysql_select_db($database_connspkp, $connspkp);
//$query_RsUrusan = "SELECT * FROM tblurusan WHERE Kategori='$Kumpulan' ORDER BY TrCipta DESC";
$query_limit_RsUrusan = sprintf("%s LIMIT %d, %d", $query_RsUrusan, $startRow_RsUrusan, $maxRows_RsUrusan);
$RsUrusan = mysql_query($query_limit_RsUrusan, $connspkp) or die(mysql_error());
$row_RsUrusan = mysql_fetch_assoc($RsUrusan);
$all_RsUrusan = mysql_query($query_RsUrusan);

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
		stristr($param, "totalRows_RsUrusan") == false &&
		stristr($param, "txtS") == false &&
        stristr($param, "Kump") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsUrusan = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsUrusan = sprintf("&totalRows_RsUrusan=%d%s&txtS=%s&Kump=%s", $totalRows_RsUrusan, $queryString_RsUrusan, $Search, $Kump);
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
.style7 {font-size: 12px;}
body,td,th {
	font-family: Arial;
	font-size: 12px;
	
}
.style9 {color: #6699CC}
.style10 {color: #FF0000}
.style12 {	color: #FF0000;
	font-weight: bold;
}
-->
</style>

<div align="center" class="style3">
  <table width="1022" border="0" cellpadding="0" cellspacing="0" class="PAGECONTAINER">
    <!--DWLayoutTable-->
    <tr>
      <td height="246" colspan="3" valign="top"><img src="images/BANNER_new2.jpg" width="1024" height="246"></td>
    </tr>
    <tr>
      <td width="32" height="409" valign="top"  background="images/10241_05.jpg" class="containerleft"></td>
      <td valign="top"><table width="954" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="204" height="338" valign="top"><?php include 'include/menuBiasa.php'; ?>
            <p>&nbsp;</p>
            </td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><span class="style9">MUKA UTAMA / LIHAT URUSAN</span></p>
                  <p><span class="style7">Kriteria carian = &quot;</span><span class="style12"><?php echo $Search?></span><span class="style7">&quot; || Sejumlah</span><span class="style12"> <?php echo mysql_num_rows($all_RsUrusan);?> </span><span class="style7">rekod ditemui.<br>
                    Petunjuk ikon: <img src="images/delete.gif" width="17" height="17"> = Batal Urusan ; <img src="images/s_info.png" width="16" height="16"> = Lihat Perincian Urusan;  </span></p>
                  <form name="form1" method="post" action="ListUrusan3.php">
                    <img src="images/arrow.gif" width="12" height="10"> Cari :
                    <input name="txtCari" type="text" id="txtCari" size="70">
                    <input type="submit" name="Submit" value="Cari">
                    </form>                  
                  <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="blueline">
                  <!--DWLayoutTable-->
                      <tr bgcolor="#999999">
                        <td width="3%"><span class="style1">Bil</span></td>
                        <td width="17%"><span class="style1">Jenis Urusan </span></td>
                        <td width="27%"><span class="style1">Ringkasan</span></td>
                        <td width="17%" class="style1">Kertas</td>
                        <td width="6%"><span class="style1">Status Akhir </span></td>
                        <td width="4%"><span class="style1">Tindakan Urusan </span></td>
                      </tr>
                      <?php 
				  	//2 color rows//////////////////////////////////////////////////////////////////////
					$color1 = "#CECFFF"; 
					$color2 = "#D9ECFF"; 
 			   		$row_count = 0;
					$No=(($pageNum_RsUrusan)*$maxRows_RsUrusan);
					
  				    //Looping result of RsUrusan///////////////////////////////////////////////// 
					do { 
  				    $No++; 
    				$row_color = ($row_count % 2) ? $color1 : $color2; 
				  
				  
				  
				  			$idUrusan=$row_RsUrusan['id'];
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
				  ?>
                      <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                        <td><?php echo $No; ?></td>
                        <td><?php echo $row_RsUrusan['Jenis']; ?></td>
                        <td><?php echo $row_RsUrusan['Ringkasan']; ?></td>
                        <td><a href="<?php echo $row_RsUrusan['Link']; ?>" target="_blank"><?php echo $row_RsUrusan['Kertas']; ?></a></td>
                        <td>
							<div align="center"><strong><span class="style10">
						    <?php
							 if ($row_RsUrusan['Status']=='BATAL'){
							echo "BATAL";
							}; 
							?>
						    </span></strong>
							    <table width="98%"  border="0" cellspacing="0" cellpadding="0">
                              <?php if (($row_RsCountBaru['COUNT(*)'])!=0) { ?>
			                  <tr>
                                <td height="18" bgcolor="#80E474"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"> : <?php echo $row_RsCountBaru['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
                              <?php
						};
						if (($row_RsCountPertimbangan['COUNT(*)'])!=0) {
						?>
			                  <tr>
                                <td height="23" bgcolor="#FC9696"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"> : <?php echo $row_RsCountPertimbangan['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
                              <?php
						};
						if (($row_RsCountSelesai['COUNT(*)'])!=0) {
						?>                        
			                  <tr>
                                <td bgcolor="#9191FF"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountSelesai['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
			                  <?php };?>
                                </table>
					    </div></td>
                        <td><div align="center"><a href="LihatUrusan4.php?I=<?php echo $row_RsUrusan['id']; ?>"><img src="images/s_info.png" alt="Lihat Perincian Urusan" width="16" height="16" border="0"></a></div></td>
                      </tr>
                      <?php 
				  $row_count++;
				  } while ($row_RsUrusan = mysql_fetch_assoc($RsUrusan)); 
				  ?>
                  </table>                
                                  <p align="center">| <a href="<?php printf("%s?pageNum_RsUrusan=%d%s", $currentPage, 0, $queryString_RsUrusan); ?>">Mula</a> | <a href="<?php printf("%s?pageNum_RsUrusan=%d%s", $currentPage, max(0, $pageNum_RsUrusan - 1), $queryString_RsUrusan); ?>">Sebelum</a> | <a href="<?php printf("%s?pageNum_RsUrusan=%d%s", $currentPage, min($totalPages_RsUrusan, $pageNum_RsUrusan + 1), $queryString_RsUrusan); ?>">Selepas</a> | <a href="<?php printf("%s?pageNum_RsUrusan=%d%s", $currentPage, $totalPages_RsUrusan, $queryString_RsUrusan); ?>">Akhir</a> | <br>
                    <?php
		  
 /////////////////////////////////////PAGING//////////////////////////////////////////////////////////////////////
				//$strUrusan = $row_RsUrusan['subaktiviti'];
				
				echo "|";
				for ($i=0; $i<=$totalPages_RsUrusan; $i++) { 
							echo " ";
							echo "<a href='ListUrusan3.php?pageNum_RsUrusan=".$i."&txtS=".$Search."&Kump=".$Kump."'>".$i."</a>";
							echo " |";
				};

///////////////////////////////////PAGING END//////////////////////////////////////////////////////////////////////////
		  ?>
                  </p>
                  <p>&nbsp;</p></td>
              </tr>
            </table></td>
          </tr>
          <tr bgcolor="#becdeb">
            <td height="28" colspan="2" valign="top"><div align="center" class="style7">| <a href="Utama3.php">Muka utama</a> | <a  href="#" onClick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
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
mysql_free_result($RsUrusan);
mysql_free_result($RsCountBaru);
mysql_free_result($RsCountPertimbangan);
mysql_free_result($RsCountSelesai);
?>
