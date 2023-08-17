<?php require_once('Connections/connspkp.php'); ?>
<? session_start(); 

if($_SESSION["Kumpulan"] !='Suruhanjaya' ){
	if($_SESSION["Kumpulan"] !='Pengerusi' ){
		if($_SESSION["Kumpulan"] !='SUB' ){
		header("Location: Logout.php");
			}
		}
	};
?>

<?php
include('include/FusionCharts.php');
include('include/FC_Colors.php');
include('include/FormatDate.php');
$tsemasa = date('Y-m-d');
$idStatusUrusan= $_GET['s'];
$idpengguna=$_SESSION["idPengguna"];

mysql_select_db($database_connspkp, $connspkp);
$query_RsStatusUrusan = "SELECT tblstatusurusan.*,tblurusan.bilMesyuarat ,tblurusan.Jenis, tblurusan.Ringkasan, tblurusan.Kertas, tblurusan.Link  
						FROM tblstatusurusan 
						INNER JOIN tblurusan 
						ON tblstatusurusan.idUrusan = tblurusan.id
						WHERE tblstatusurusan.id='$idStatusUrusan'";
$RsStatusUrusan = mysql_query($query_RsStatusUrusan, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$totalRows_RsStatusUrusan = mysql_num_rows($RsStatusUrusan);

$idUrusan=$row_RsStatusUrusan['idUrusan'];
mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan2 = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
$query_RsStatusUrusan2 = "SELECT tblstatusurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh, tblpengguna.Susunan
						FROM tblstatusurusan 
						INNER JOIN tblpengguna
						ON tblstatusurusan.idPengguna=tblpengguna.id
						WHERE tblstatusurusan.idUrusan='$idUrusan'
						ORDER BY tblpengguna.Susunan";
$RsStatusUrusan2 = mysql_query($query_RsStatusUrusan2, $connspkp) or die(mysql_error());
$row_RsStatusUrusan2 = mysql_fetch_assoc($RsStatusUrusan2);
$totalRows_RsStatusUrusan2 = mysql_num_rows($RsStatusUrusan2);

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
$query_RsStatusUrusanL = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan' GROUP BY Keputusan ORDER BY Keputusan";
$RsStatusUrusanL = mysql_query($query_RsStatusUrusanL, $connspkp) or die(mysql_error());
$row_RsStatusUrusanL = mysql_fetch_assoc($RsStatusUrusanL);
$totalRows_RsStatusUrusanL = mysql_num_rows($RsStatusUrusanL);

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
$query_RsStatusUrusanT = "SELECT * FROM tblurusan WHERE id='$idUrusan'";
$RsStatusUrusanT = mysql_query($query_RsStatusUrusanT, $connspkp) or die(mysql_error());
$row_RsStatusUrusanT = mysql_fetch_assoc($RsStatusUrusanT);
$totalRows_RsStatusUrusanT = mysql_num_rows($RsStatusUrusanT);

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
//$query_RsStatusUrusanT1 = "SELECT max(idUrusan) as bila FROM tblstatusurusan ";
$query_RsStatusUrusanT1 = "SELECT max(idUrusan) as idmesy FROM tblstatusurusan WHERE idPengguna = '$idpengguna' AND STATUS = 'Selesai' ";
$RsStatusUrusanT1 = mysql_query($query_RsStatusUrusanT1, $connspkp) or die(mysql_error());
$row_RsStatusUrusanT1 = mysql_fetch_assoc($RsStatusUrusanT1);
$totalRows_RsStatusUrusanT1 = mysql_num_rows($RsStatusUrusanT1);
$vbilmesy = $row_RsStatusUrusanT1["idmesy"];


$query_RsStatusUrusanM = "SELECT bilMesyuarat FROM tblurusan where id = '$vbilmesy' ";
$RsStatusUrusanM = mysql_query($query_RsStatusUrusanM, $connspkp) or die(mysql_error());
$row_RsStatusUrusanM = mysql_fetch_assoc($RsStatusUrusanM);
$totalRows_RsStatusUrusanM = mysql_num_rows($RsStatusUrusanM);

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
.style12 {font-size: 12px; font-weight: bold; }
.style1 {color: #FFFFFF}
-->
</style>

<div align="center" class="style3">
  <table width="1022" border="0" cellpadding="0" cellspacing="0" class="PAGECONTAINER">
    <!--DWLayoutTable-->
    <tr>
      <td height="246" colspan="3" valign="top"><img src="images/BANNER_new2.jpg" width="1024" height="246" /></td>
    </tr>
    <tr>
      <td width="32" height="342" valign="top" background="images/10241_05.jpg" class="containerleft"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td width="955" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="204" height="315" valign="top"><?php include 'include/menuuser.php'; ?>
            <br></td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
                <!--DWLayoutTable-->
                <tr>
                  <td width="750" height="315" valign="top"><p><span class="style9">LAPORAN KEPUTUSAN </span></p>                    
				  <form action="Cetakpdf.php?s=<?php echo $idStatusUrusan; ?>" method="post" name="form1" target="_blank">
                      <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                        <!--DWLayoutTable-->
                        <tr>
                          <td bgcolor="#becdeb"><div align="center">| Cetak oleh : <span class="style12"><?php echo $_SESSION["Gelaran"].' '.$_SESSION["NamaPenuh"];?></span> | Tarikh cetak : <strong><?php echo date("j/m/Y  H:i:s")?></strong> | </div></td>
                        </tr>
                      </table>
                      <br>
                      <table width="743"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                        <!--DWLayoutTable-->
                        <tr>
                          <td bgcolor="#becdeb">Jenis Urusan : </td>
                          <td bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Jenis']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#becdeb">Ringkasan : </td>
                          <td bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Ringkasan']; ?></td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#becdeb">Kertas : </td>
                          <td bgcolor="#FFFFFF"><a href="<?php echo $row_RsStatusUrusan['Link']; ?>"><?php echo $row_RsStatusUrusan['Kertas']; ?></a></td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#becdeb">No. Fail : </td>
                          <td bgcolor="#FFFFFF"><strong><?php echo $row_RsStatusUrusan['NoKertas']; ?></strong></td>
                        </tr>
                      </table>
                      <br>
                      <table width="743"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="123" bgcolor="#becdeb">Status : </td>
                          <td width="323" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Status']; ?></td>
                          <td width="287" rowspan="7" bgcolor="#FFFFFF"><div align="center">
                            <?php
					$strXML="";
					$strXML = "<graph caption='CARTA KEPUTUSAN' xAxisName='KEPUTUSAN' yAxisName='JUMLAH' decimalPrecision='0' formatNumberScale='0'>";
 	
					do{
							$row_RsUrusanL['GrValue']="";
			
							mysql_select_db($database_connspkp, $connspkp);
							$query_RsUrusanL = "SELECT COUNT(id) as GrValue FROM tblstatusurusan WHERE Keputusan = '".$row_RsStatusUrusanL['Keputusan']."' AND idUrusan='".$idUrusan."'";
							$RsUrusanL = mysql_query($query_RsUrusanL, $connspkp) or die(mysql_error());
							$row_RsUrusanL = mysql_fetch_assoc($RsUrusanL);

							$strXML .= "<set name='".$row_RsStatusUrusanL['Keputusan']."' value='".$row_RsUrusanL['GrValue']."' color='".getFCColor()."' />";
	

					} while ($row_RsStatusUrusanL = mysql_fetch_assoc($RsStatusUrusanL));
	
					$strXML .=  "</graph>";
					echo renderChartHTML('FusionCharts/FCF_Column3D.swf', "", $strXML, "myNext", 300, 200);


				mysql_free_result($RsStatusUrusanL);
				mysql_free_result($RsUrusanL);
				?>
                          </div></td>
                        </tr>
                        <tr>
                          <td bgcolor="#becdeb">Tarikh Terima : </td>
                          <td bgcolor="#FFFFFF"><?php echo format_datetime($row_RsStatusUrusan['TrTerima']); ?></td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#becdeb">Tarikh Kemas kini : </td>
                          <td bgcolor="#FFFFFF"><?php echo format_datetime($row_RsStatusUrusan['TrSelesai']); ?></td>
                        </tr>
				        <tr>
                          <td colspan="2" bgcolor="#FFFFFF"><p>&nbsp;</p>
                          <p>&nbsp;</p></td>
                        </tr>
				        <tr>
					      <td width="123" bgcolor="#becdeb">Keputusan : </td>
                          <td width="323" bgcolor="#FFFFFF"><strong><?php echo $row_RsStatusUrusan['Keputusan']; ?> </strong></td>
                        </tr>
                        <tr>
                          <td bgcolor="#becdeb">Ulasan : </td>
                          <td bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Ulasan']; ?></td>
                        </tr>
                        <tr>
                          <td colspan="2" bgcolor="#FFFFFF"><input type="HIDDEN" name="ext" value=".pdf"></td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                          <td colspan="2" bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Cetak">                          </td>
                      </table>
                      <br>
                    </form>                    <img src="images/arrow.gif" width="12" height="10"> LAIN-LAIN KEPUTUSAN DAN ULASAN
                    </p>                    <table width="743" cellpadding="1" cellspacing="1" class="blueline">
                      <!--DWLayoutTable-->
                      <tr bgcolor="#999999">
                        <td width="4%"><span class="style1">No</span></td>
                        <td width="25%"><span class="style1">Edaran kepada </span></td>
                        <td width="6%"><span class="style1">Status </span></td>
                        <td width="5%"><span class="style1">Keputusan </span></td>
                        <td width="5%"><span class="style1">Ubah </span></td>
                        <td width="31%"><span class="style1">Ulasan </span></td>
                        <td width="10%"><span class="style1">Kemas kini</span></td>
                        <td width="6%"><span class="style1">Tempoh </span></td>
                      </tr>
                      <?php 
					  //2 color rows//////////////////////////////////////////////////////////////////////
					$color1 = "#CECFFF"; 
					$color2 = "#D9ECFF"; 
 			   		$row_count = 0;
					$No=0;
					
  				    //Looping result of RsUrusan///////////////////////////////////////////////// 
					do {
					
					
								if (($row_RsStatusUrusan2['Status'])=='Selesai') {
							
									$strMula=$row_RsStatusUrusan2['TrTerima'];
									//$strKini=date("Y-m-j  H:i:s");
									$strKini=$row_RsStatusUrusan2['TrSelesai'];
									
									$date_diff = abs(strtotime($strKini)-strtotime($strMula)) / 86400;
							
								}
							
								else if (($row_RsStatusUrusan2['Status'])=='BATAL') {
							
									$strMula=$row_RsStatusUrusan2['TrTerima'];
									$strKini=$row_RsStatusUrusan2['TrSelesai'];
							
									$date_diff = abs(strtotime($strKini)-strtotime($strMula)) / 86400;
							
								}
							
								else if ((($row_RsStatusUrusan2['Status'])=='Baru') || (($row_RsStatusUrusan2['Status'])=='Pertimbangan')) {
							
									$strMula=$row_RsStatusUrusan2['TrTerima'];
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
                        <td><?php echo $row_RsStatusUrusan2['Gelaran']; ?><br>
                          <?php echo $row_RsStatusUrusan2['NamaPenuh'];  
							  if($row_RsStatusUrusan2['idPengguna']=='42'){?>
                          <br>
                          Anggota SPA (Menunaikan fungsi Pengerusi SPA &amp; SPKP mengikut Perkara <br>
                          142(3A) Perlembagaan Persekutuan) 
                          <?php };?>
						  
						  <?php if($row_RsStatusUrusan['idPengguna']=='15' 
						  && ($row_RsStatusUrusanT['TrCipta'] >= '2016-09-09 00:00:00')
						  && ($row_RsStatusUrusanT['TrCipta'] <= '2016-09-23 00:00:00') ){?> 
						  
							<br>
							Anggota SPA (Menunaikan fungsi Pengerusi SPA mengikut Perkara 142(3A) Perlembagaan Persekutuan) <?php };?>					    </td>
                        <td><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                            <?php if (($row_RsStatusUrusan2['Status'])=='Baru') { ?>
                            <tr>
                              <td height="19" bgcolor="#80E474"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan2['Status'])=='Pertimbangan') {
						?>
                            <tr>
                              <td height="24" bgcolor="#FC9696"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan2['Status'])=='Selesai') {
						?>
                            <tr>
                              <td height="25" bgcolor="#9191FF"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"></strong></div>
                              </div></td>
                            </tr>
                            <?php };?>
                        </table></td>
                        <td><strong><?php echo $row_RsStatusUrusan2['Keputusan']; ?></strong></td>
                        <td align="center"><?php
						if (($row_RsStatusUrusan2['Keputusan'])!='' && ($row_RsStatusUrusan2['idPengguna'])== $idpengguna && ($row_RsStatusUrusanM["bilMesyuarat"]) == $row_RsStatusUrusan["bilMesyuarat"]) { 
						?>
					  <a href="ResetKeputusan.php?IdU=<?php echo $idUrusan; ?>&IdP=<?php echo $row_RsStatusUrusan2['idPengguna']; ?>"><img src="images/reset.png" alt="Perhatian! Reset Keputusan" width="17" height="17" border="0" onClick = "if (! confirm('Adakah anda pasti untuk reset keputusan ini?')) return false;" align="center"></a>
					  <?php };?>	</td>
                        <td><?php echo $row_RsStatusUrusan2['Ulasan']; ?></td>
                        <td><?php echo format_datetime($row_RsStatusUrusan2['TrSelesai']); ?></td>
                        <td><strong><?php echo round($date_diff) ;?> hari </strong></td>
                      </tr>
                      <?php 
					  $row_count++;
					  } while ($row_RsStatusUrusan2 = mysql_fetch_assoc($RsStatusUrusan2)); 
					  ?>
                    </table></td>
                </tr>
            </table></td>
          </tr>
          <tr bgcolor="#becdeb">
            <td height="28" colspan="3" valign="top"><div align="center" class="style7">| <a href="Utama2.php">Muka utama</a> | <a href="EmailUrusetia.php">Emel urus setia</a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
          </tr>
            </table></td>
       <td width="38" valign="top" bgcolor="#becdeb" background="images/10241_08.jpg" class="containerright"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="21" valign="top" background="images/10241_25.jpg" class="containerBL"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" background="images/10241_27.jpg" class="containerbottom"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" bgcolor="#becdeb" background="images/10241_29.jpg" class="containerBR"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
  </table>
</div>
<?php
mysql_free_result($RsStatusUrusan);
mysql_free_result($RsStatusUrusan2);
?>
