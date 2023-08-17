<?php require_once('Connections/connspkp.php'); ?>
<?php
ob_start();
session_start();

if($_SESSION["kategori"] !='3' ){
		header("Location: Logout.php");	};

$idPengguna=$_SESSION["idPengguna"];
?>

<?php
include('include/FusionCharts.php');
include('include/FC_Colors.php');
include('include/FormatDate.php');

$idUrusan=$_GET['I'];

mysql_select_db($database_connspkp, $connspkp);
//$query_RsUrusan = "SELECT * FROM tblurusan WHERE id='$idUrusan'";
/*$query_RsUrusan = "SELECT tblurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh FROM tblurusan
					INNER JOIN tblpengguna
					ON tblurusan.idCipta=tblpengguna.id
					WHERE tblurusan.id='$idUrusan'";*/
 $query_RsUrusan = "SELECT b.desc_jenisurusan,c.id as idM,d.MesyuaratDesc,c.siri,c.tarikhMesyuarat,e.Gelaran as GelNamaCipta,e.NamaPenuh as namaCipta,f.Gelaran as GelNamaKemaskini, f.NamaPenuh as namaKemaskini, a.* FROM tblurusan a
          left JOIN tbljenisurusan b ON a.Jenis=b.id_jenisurusan
          inner JOIN tblmesyuarat c on c.id=a.bilMesyuarat 
          inner join tblreftajukmesyuarat d on d.id=c.TajukMesyuaratID
          left join tblpengguna e on e.id=a.idCipta
          left join tblpengguna f on f.id=a.idkemaskini
          WHERE a.id='$idUrusan'";				
$RsUrusan = mysql_query($query_RsUrusan, $connspkp) or die(mysql_error());
$row_RsUrusan = mysql_fetch_assoc($RsUrusan);
$totalRows_RsUrusan = mysql_num_rows($RsUrusan);
$idM=$row_RsUrusan['idM'];

mysql_select_db($database_connspkp, $connspkp);
//$query_RsUrusan = "SELECT * FROM tblurusan WHERE id='$idUrusan'";
 $query_RsKemaskini = "SELECT a.*, b.id as idUser, b.Gelaran,b.NamaPenuh
            FROM tblstatusurusan a 
            INNER JOIN tblpengguna b  ON a.idPengguna=b.id
            inner join tblurusan c on c.id=a.idUrusan
            WHERE a.idUrusan='$idUrusan'";
$RsStatusUrusan= mysql_query($query_RsKemaskini, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$totalRows_RsStatusUrusan = mysql_num_rows($RsStatusUrusan);


?>
<?php
include 'include/Popup.php';
?>
<SCRIPT LANGUAGE="Javascript" SRC="include/FusionCharts.js"></SCRIPT>
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

<div align="center" >
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
            <td width="250" height="338" valign="top"><?php include 'include/menupenyelaras.php'; ?>
            <p>&nbsp;</p>
            </td>
            <td valign="top" align="center"><table class="table">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><font size="3"><span class="style9">LIHAT URUSAN </span></font></p>
                  <table cellpadding="0" cellspacing="1" bgcolor="#d8c0be" class="table table-striped">
                    <!--DWLayoutTable-->
									<tr>
										<td width="10%" font size="2" bgcolor="#d8c0be">Jenis Urusan : </td>
										<td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsUrusan['desc_jenisurusan']; ?></td>
									</tr>
									<tr>
										<td width="10%" font size="2" bgcolor="#d8c0be">Butiran : </td>
										<td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsUrusan['Ringkasan']; ?></td>
									</tr>
									<tr>
										<td width="10%" font size="2" height="17" bgcolor="#d8c0be">Kertas : </td>
										<td colspan="2" bgcolor="#FFFFFF"><a href="<?php echo $row_RsUrusan['Link']; ?>" target="_blank"><?php echo $row_RsUrusan['Kertas']; ?></a></td>
									</tr>
									<tr>
										<td width="10%" font size="2" height="17" bgcolor="#d8c0be">No. Fail : </td>
										<td colspan="2" bgcolor="#FFFFFF"><strong><?php echo $row_RsUrusan['NoKertas']; ?></strong></td>
									</tr>
								 <tr>
										<td width="10%" font size="2" height="17" bgcolor="#d8c0be">No. Ruj. Bahagian: </td>
										<td colspan="2" bgcolor="#FFFFFF"><strong><?php echo $row_RsUrusan['rujBhg']; ?></strong></td>
									</tr>
								 <tr>
										<td width="10%" font size="2" height="17" bgcolor="#d8c0be">Mesyuarat </td>
										<td colspan="2" bgcolor="#FFFFFF"><strong><?php echo $row_RsUrusan['bilMesyuarat']; ?></strong></td>
									</tr>
			<!--
									<tr>
										<td width="10%" font size="2" height="17" bgcolor="#d8c0be"><!--DWLayoutEmptyCell-->&nbsp;</td>
										<!-- <td bgcolor="#FFFFFF">DWLayoutEmptyCell&nbsp;</td> -->
										<!-- <td width="308" rowspan="9" bgcolor="#FFFFFF"><div align="center"> -->

					<?php
				//	$strXML="";
				//	$strXML = "<graph caption='Carta Keputusan' xAxisName='KEPUTUSAN' yAxisName='JUMLAH' decimalPrecision='0' formatNumberScale='0'>";

				//	do{
				//			$row_RsUrusanL['GrValue']="";

				//			mysql_select_db($database_connspkp, $connspkp);
				//			$query_RsUrusanL = "SELECT COUNT(id) as GrValue FROM tblstatusurusan WHERE Keputusan = '".$row_RsStatusUrusanL['Keputusan']."' AND idUrusan='".$idUrusan."'";
				//			$RsUrusanL = mysql_query($query_RsUrusanL, $connspkp) or die(mysql_error());
				//			$row_RsUrusanL = mysql_fetch_assoc($RsUrusanL);

				//			$strXML .= "<set name='".$row_RsStatusUrusanL['Keputusan']."' value='".$row_RsUrusanL['GrValue']."' color='".getFCColor()."' />";


				//	} while ($row_RsStatusUrusanL = mysql_fetch_assoc($RsStatusUrusanL));

				//	$strXML .=  "</graph>";
				//	echo renderChartHTML('FusionCharts/FCF_Column3D.swf', "", $strXML, "myNext", 300, 200);


				//mysql_free_result($RsStatusUrusanL);
				//mysql_free_result($RsUrusanL);
				?>

					  </div></td>
                    </tr>
                    <tr>
                      <td height="17" bgcolor="#d8c0be">Status Akhir : </td>
                      <td width="290" bgcolor="#FFFFFF"><?php echo $row_RsUrusan['Status']; ?></td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#d8c0be"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#d8c0be">Cipta oleh :</td>
                      <td bgcolor="#FFFFFF"><?php echo $row_RsUrusan['GelNamaCipta']; ?> <?php echo $row_RsUrusan['namaCipta']; ?> </td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#d8c0be">Tarikh Cipta: </td>
                      <td bgcolor="#FFFFFF"><?php echo format_datetime($row_RsUrusan['TrCipta']); ?></td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#d8c0be"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#d8c0be">Kemas kini oleh : </td>
                      <td bgcolor="#FFFFFF"><?php echo $row_RsUrusan['GelNamaKemaskini']; ?> <?php echo $row_RsUrusan['namaKemaskini']; ?> </td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#d8c0be">Tarikh Kemaskini : </td>
                      <td bgcolor="#FFFFFF"><?php echo format_datetime($row_RsUrusan['TrKemaskini']); ?></td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#d8c0be">Cetak :</td>
                      <td bgcolor="#FFFFFF"><a href="CetakSelesai.php?IdU=<?php echo $idUrusan; ?>" target="_blank"><img src="images/printer.gif" alt="" width="21" height="17" /></a></td>
                      </tr>
                  </table>
                  <br>
									<table cellpadding="1" cellspacing="1" class="table">
										<tr bgcolor="#897270">
											<td width="6%"><span class="style1">No</span></td>
											<td width="20%"><span class="style1">Edaran kepada </span></td>
											<td width="10%"><span class="style1">Status </span></td>
											<td width="14%"><span class="style1">Keputusan</span></td>
											<td width="38%"><span class="style1">Ulasan </span></td>
											<td width="16%"><span class="style1">Tarikh Kemas kini </span></td>
											<td width="11%"><span class="style1">Tempoh </span></td>
										</tr>
                    <?php
					  //2 color rows//////////////////////////////////////////////////////////////////////
						$color1 = "white";
						$maxRows_RsStatusUrusan="";
						$pageNum_RsStatusUrusan="";
	          $color2 = "#f9f7f7";
 			   		$row_count = 0;
					$No=(($pageNum_RsStatusUrusan)*$maxRows_RsStatusUrusan);
  if($totalRows_RsStatusUrusan > 0)  
  {   
  				    //Looping result of RsUrusan/////////////////////////////////////////////////
					do {


								if (($row_RsStatusUrusan['Status'])=='Selesai') {

									$strMula=$row_RsStatusUrusan['TrTerima'];
									//$strKini=date("Y-m-j  H:i:s");
									$strKini=$row_RsStatusUrusan['TrSelesai'];

									$date_diff = abs(strtotime($strKini)-strtotime($strMula)) / 86400;

								}

								else if (($row_RsStatusUrusan['Status'])=='BATAL') {

									$strMula=$row_RsStatusUrusan['TrTerima'];
									$strKini=$row_RsStatusUrusan['TrSelesai'];

									$date_diff = abs(strtotime($strKini)-strtotime($strMula)) / 86400;

								}

								else if ((($row_RsStatusUrusan['Status'])=='Baru') || (($row_RsStatusUrusan['Status'])=='Pertimbangan')) {

									$strMula=$row_RsStatusUrusan['TrTerima'];
									$strKini=date("Y-m-j  H:i:s");
									//$strKini=$row_RsStatusUrusan['TrSelesai'];

									$date_diff = abs(strtotime($strKini)-strtotime($strMula)) / 86400;

								}

								else  {

									$date_diff=0;

								};



  				    $No++;
    				$row_color = ($row_count % 2) ? $color1 : $color2;
					?>
                    <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                      <td valign="top"><?php echo $No; ?></td>

						<td><?php echo $row_RsStatusUrusan['Gelaran']; ?><br>
                          <?php echo $row_RsStatusUrusan['NamaPenuh'];?><br />
						  <?php  $idUs=$row_RsStatusUrusan['idUser']; ?><br />
						  <?php
						    $query_RsPeranan = "SELECT b.desc_kategori FROM `tbluruspengguna` a 
												inner join tblkategori b on b.id_kategori=a.kategoriID
												where a.penggunaID='$idUs' and a.MesyuaratID='$idM'";
							$RsPeranan = mysql_query($query_RsPeranan, $connspkp) or die(mysql_error());
							$row_RsPeranan = mysql_fetch_assoc($RsPeranan);

						  ?> 
						 <b> ( <?php echo strtoupper($row_RsPeranan['desc_kategori']);?> ) <br />
						                       </td>
                      <td><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                          <?php if (($row_RsStatusUrusan['Status'])=='Baru') { ?>
                          <tr align="center">
                            <td height="16" bgcolor="#80E474"> <div align="center" class="style1"><?php echo $row_RsStatusUrusan['Status']; ?>
                                <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"></strong></div></div>
                            </td>
                          </tr>
                          <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Pertimbangan') {
						?>
                          <tr align="center"> 
                            <td height="25" bgcolor="#FC9696"><div align="center" class="style1"><?php echo $row_RsStatusUrusan['Status']; ?>
                                <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"></strong></div></div>
                            </td>
                          </tr>
                          <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Selesai') {
						?>
                          <tr>
                            <td bgcolor="#9191FF"><div align="center" class="style1"><?php echo $row_RsStatusUrusan['Status']; ?>
                                <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"></strong></div>
                            </div></td>
                          </tr>
						  <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Cuti') {
						?>
                          <tr>
                            <td bgcolor="#eaafc9"><div align="center" class="style1"><?php echo $row_RsStatusUrusan['Status']; ?>
                                <div align="center"><strong><img src="images/cuti.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"></strong></div>
                            </div></td>
                          </tr>
                          <?php };?>
                      </table></td>
                      <td><strong><?php echo $row_RsStatusUrusan['Keputusan']; ?></strong></td>
                      <td><?php echo $row_RsStatusUrusan['Ulasan']; ?></td>
                      <td><?php echo format_datetime($row_RsStatusUrusan['TrSelesai']); ?></td>
					  <?php 
					        $datt= round($date_diff);
					  if($datt=='18358' || $datt=='0' )
					   {
					   $dattDiff=0;
					   }else
					   {
					   $dattDiff=$datt;
					   }
					  ?>

					 
                      <td><strong><?php echo $dattDiff;?> hari </strong></td>
                    </tr>
                    <?php
					  $row_count++;
					  } while ($row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan));
}//  if($No > 0) 						
						
						?>
									</table>
									<p>&nbsp;</p></td>
							</tr>
						</table></td>
					</tr>
					<tr>
						<td height="28" colspan="2" valign="top" bgcolor="#FF8C00"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
					</tr>
				 </table></td>

	 </tr>

 </table>
</div>
<?php
mysql_free_result($RsUrusan);
mysql_free_result($RsKemaskini);
mysql_free_result($RsStatusUrusan);
?>
