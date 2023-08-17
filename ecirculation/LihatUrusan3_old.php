<?php require_once('Connections/connspkp.php'); ?>
<?php
ob_start();
session_start(); 

if($_SESSION["Kumpulan"] !='SUB' ){
		header("Location: Logout.php");
	};


?>

<?php
include('include/FusionCharts.php');
include('include/FC_Colors.php');
include('include/FormatDate.php');

$idUrusan=$_GET['I'];

mysql_select_db($database_connspkp, $connspkp);
//$query_RsUrusan = "SELECT * FROM tblurusan WHERE id='$idUrusan'";
$query_RsUrusan = "SELECT tblurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh FROM tblurusan 
					INNER JOIN tblpengguna
					ON tblurusan.idCipta=tblpengguna.id
					WHERE tblurusan.id='$idUrusan'";
$RsUrusan = mysql_query($query_RsUrusan, $connspkp) or die(mysql_error());
$row_RsUrusan = mysql_fetch_assoc($RsUrusan);
$totalRows_RsUrusan = mysql_num_rows($RsUrusan);

mysql_select_db($database_connspkp, $connspkp);
//$query_RsUrusan = "SELECT * FROM tblurusan WHERE id='$idUrusan'";
$query_RsKemaskini = "SELECT  tblurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh FROM tblurusan 
					INNER JOIN tblpengguna
					ON tblurusan.idkemaskini=tblpengguna.id
					WHERE tblurusan.id='$idUrusan'";
$RsKemaskini = mysql_query($query_RsKemaskini, $connspkp) or die(mysql_error());
$row_RsKemaskini = mysql_fetch_assoc($RsKemaskini);
$totalRows_RsKemaskini = mysql_num_rows($RsKemaskini);

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
$query_RsStatusUrusan = "SELECT tblstatusurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh, tblpengguna.Susunan
						FROM tblstatusurusan 
						INNER JOIN tblpengguna
						ON tblstatusurusan.idPengguna=tblpengguna.id
						WHERE tblstatusurusan.idUrusan='$idUrusan'
						ORDER BY tblpengguna.Susunan";
$RsStatusUrusan = mysql_query($query_RsStatusUrusan, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$totalRows_RsStatusUrusan = mysql_num_rows($RsStatusUrusan);

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
$query_RsStatusUrusanL = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan' GROUP BY Keputusan ORDER BY Keputusan";
$RsStatusUrusanL = mysql_query($query_RsStatusUrusanL, $connspkp) or die(mysql_error());
$row_RsStatusUrusanL = mysql_fetch_assoc($RsStatusUrusanL);
$totalRows_RsStatusUrusanL = mysql_num_rows($RsStatusUrusanL);

$idPengguna1=$row_RsUrusan['idCipta'];
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
-->
</style>

<div align="center" class="style3">
  <table width="1022" border="0" cellpadding="0" cellspacing="0" class="PAGECONTAINER">
    <!--DWLayoutTable-->
    <tr>
      <td height="246" colspan="3" valign="top"><img src="images/BANNER_new2.jpg" width="1024" height="246"></td>
    </tr>
    <tr>
      <td width="32" height="409" valign="top" background="images/10241_05.jpg"  class="containerleft"></td>
      <td valign="top"><table width="954" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?>
            <br></td>
          </tr>
          <tr>
            <td width="204" height="338" valign="top"><?php include 'include/menusub.php'; ?> </td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><span class="style9">LIHAT URUSAN </span></p>
                  <table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#999999">
                    <!--DWLayoutTable-->
                    <tr>
                      <td bgcolor="#becdeb">Jenis Urusan : </td>
                      <td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsUrusan['Jenis']; ?></td>
                    </tr>
                    <tr>
                      <td bgcolor="#becdeb">Ringkasan : </td>
                      <td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsUrusan['Ringkasan']; ?></td>
                    </tr>
                    <tr>
                      <td height="17" bgcolor="#becdeb">Kertas : </td>
                      <td colspan="2" bgcolor="#FFFFFF"><a href="<?php echo $row_RsUrusan['Link']; ?>" target="_blank"><?php echo $row_RsUrusan['Kertas']; ?></a></td>
                    </tr>
                    <tr>
                      <td height="17" bgcolor="#becdeb">No. Fail : </td>
                      <td colspan="2" bgcolor="#FFFFFF"><strong><?php echo $row_RsUrusan['NoKertas']; ?></strong></td>
                    </tr>
                    <tr>
                      <td height="17" bgcolor="#becdeb"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      <td width="308" rowspan="9" bgcolor="#FFFFFF"><div align="center">
					      
					  <?php
					$strXML="";
					$strXML = "<graph caption='Carta Keputusan' xAxisName='KEPUTUSAN' yAxisName='JUMLAH' decimalPrecision='0' formatNumberScale='0'>";
 	
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
                      <td height="17" bgcolor="#becdeb">Status Akhir : </td>
                      <td width="290" bgcolor="#FFFFFF"><?php echo $row_RsUrusan['Status']; ?></td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#becdeb"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#becdeb">Cipta oleh :</td>
                      <td bgcolor="#FFFFFF"><?php echo $row_RsUrusan['Gelaran']; ?> <?php echo $row_RsUrusan['NamaPenuh']; ?> </td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#becdeb">Tarikh Cipta: </td>
                      <td bgcolor="#FFFFFF"><?php echo format_datetime($row_RsUrusan['TrCipta']); ?></td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#becdeb"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#becdeb">Kemas kini oleh : </td>
                      <td bgcolor="#FFFFFF"><?php echo $row_RsKemaskini['Gelaran']; ?> <?php echo $row_RsKemaskini['NamaPenuh']; ?> </td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#becdeb">Tarikh Kemaskini : </td>
                      <td bgcolor="#FFFFFF"><?php echo format_datetime($row_RsUrusan['TrKemaskini']); ?></td>
                      </tr>
                    <tr>
                      <td height="17" bgcolor="#becdeb">Cetak :</td>
                      <td bgcolor="#FFFFFF"><a href="CetakSelesai.php?IdU=<?php echo $idUrusan; ?>" target="_blank"><img src="images/printer.gif" alt="" width="21" height="17" /></a></td>
                      </tr>
                  </table>
                  <br>
                  <table width="100%" cellpadding="1"" cellspacing="1" class="blueline"0>
                    <tr bgcolor="#999999">
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
					$color1 = "#CECFFF"; 
					$color2 = "#D9ECFF"; 
 			   		$row_count = 0;
					$No=(($pageNum_RsStatusUrusan)*$maxRows_RsStatusUrusan);
					
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
                          <?php echo $row_RsStatusUrusan['NamaPenuh'];  
							  if($row_RsStatusUrusan['idPengguna']=='42'){?>
                          <br>
                          Anggota SPA (Menunaikan fungsi Pengerusi SPA &amp; SPKP mengikut Perkara <br>
                          142(3A) Perlembagaan Persekutuan)                          <?php };?>
					    </td>
                      <td><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                          <?php if (($row_RsStatusUrusan['Status'])=='Baru') { ?>
                          <tr>
                            <td height="16" bgcolor="#80E474"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Pertimbangan') {
						?>
                          <tr>
                            <td height="25" bgcolor="#FC9696"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Selesai') {
						?>
                          <tr>
                            <td bgcolor="#9191FF"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"></strong></div>
                            </div></td>
                          </tr>
                          <?php };?>
                      </table></td>
                      <td><strong><?php echo $row_RsStatusUrusan['Keputusan']; ?></strong></td>
                      <td><?php echo $row_RsStatusUrusan['Ulasan']; ?></td>
                      <td><?php echo format_datetime($row_RsStatusUrusan['TrSelesai']); ?></td>
                      <td><strong><?php echo round($date_diff) ;?> hari </strong></td>
                    </tr>
                    <?php 
					  $row_count++;
					  } while ($row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan)); 
					  ?>
                  </table>
                  <p>&nbsp;</p></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#becdeb"><div align="center" class="style7">| <a href="Utama3.php">Muka utama</a> | <a  href="#" onClick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
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
mysql_free_result($RsUrusan);
mysql_free_result($RsKemaskini);
mysql_free_result($RsStatusUrusan);
?>
