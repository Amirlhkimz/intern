<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

//if($_SESSION["Kumpulan"] !='Ahli' ){
//  if($_SESSION["Kumpulan"] !='Pengerusi' ){
//    header("Location: Logout.php");
//    }
//  };

if($_SESSION["kategori"] !='2' ){
   if($_SESSION["kategori"] !='1' ){
    header("Location: Logout.php");
	}
  };




?>

<?php
include('include/FusionCharts.php');
include('include/FC_Colors.php');
include('include/FormatDate.php');
$tsemasa = date('Y-m-d');
$idUrusan= $_GET['s'];
$idStatusUrusan= $_GET['t'];
$idpengguna=$_SESSION["idPengguna"];

mysql_select_db($database_connspkp, $connspkp);
/*$query_RsStatusUrusan = "SELECT tblstatusurusan.*,tblurusan.bilMesyuarat ,tblurusan.Jenis, tblurusan.Ringkasan, tblurusan.Kertas,tblurusan.NoKertas, tblurusan.Link
						FROM tblstatusurusan
						INNER JOIN tblurusan
						ON tblstatusurusan.idUrusan = tblurusan.id
						WHERE tblstatusurusan.id='$idStatusUrusan'";*/
 $query_RsStatusUrusan = "SELECT b.desc_jenisurusan,c.TajukMesyuaratID as idM,d.MesyuaratDesc,g.Keterangan as gred,k.Keterangan as gredJawatann,c.siri,c.tarikhMesyuarat,e.Gelaran as GelNamaCipta,e.NamaPenuh as namaCipta,f.Gelaran as GelNamaKemaskini, f.NamaPenuh as namaKemaskini, a.*,h.TrSelesai,h.Status as StatusUrusan,h.TrTerima,h.Keputusan,h.Ulasan,h.Maklumbalas FROM tblurusan a
          left JOIN tbljenisurusan b ON a.Jenis=b.id_jenisurusan
          inner join tblstatusurusan h on h.idUrusan=a.id
          left join tblgred g on g.ID=a.GredUrusan
		  left join tblgred k on k.ID=a.gredJawatan
          inner JOIN tblmesyuarat c on c.id=a.bilMesyuarat 
          inner join tblreftajukmesyuarat d on d.id=c.TajukMesyuaratID
          left join tblpengguna e on e.id=a.idCipta
          left join tblpengguna f on f.id=a.idkemaskini
          WHERE h.id='$idStatusUrusan'";						
						
$RsStatusUrusan = mysql_query($query_RsStatusUrusan, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$totalRows_RsStatusUrusan = mysql_num_rows($RsStatusUrusan);
$idM=$row_RsStatusUrusan['idM'];
$idUrusan=$row_RsStatusUrusan['id'];
mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan2 = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
$query_RsStatusUrusan2 = "SELECT a.*, b.id as idUser, b.Gelaran,b.NamaPenuh,e.desc_kategori
            FROM tblstatusurusan a 
            INNER JOIN tblpengguna b  ON a.idPengguna=b.id
            inner join tblurusan c on c.id=a.idUrusan
            inner join tbluruspengguna d on d.penggunaID=a.idPengguna and d.kategoriID in(1,2) and d.TajukMesyuaratID='$idM' 
            inner join tblkategori e on e.id_kategori=a.kategoriID
            WHERE a.idUrusan='$idUrusan' order by d.susunan asc";
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
.style13 {font-size: 12px; font-weight: bold; color: #FFFFFF; }
.style1 {color: #FFFFFF}
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
            <td width="250" height="201" valign="top"><?php include 'include/menuuser.php'; ?>
            <br></td>
            <td valign="top" align="center"><table class="table">
                <!--DWLayoutTable-->
                <tr>
                  <td width="750" height="315" valign="top"><p><span class="style9">LAPORAN KEPUTUSAN </span></p>
				  <form action="CetakPaparanSelesai.php?s=<?php echo $idUrusan; ?>" method="post" name="form1" target="_blank">
                      <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">
                        <!--DWLayoutTable-->
                        <tr>
                          <td bgcolor="#897270" class="style13"><div align="center">| Cetak oleh : <span class="style13"><?php echo $_SESSION["Gelaran"].' '.$_SESSION["NamaPenuh"];?></span> | Tarikh cetak : <strong><?php echo date("j/m/Y  H:i:s")?></strong> | </div></td>
                        </tr>
                      </table>
                      <br>
                      <table width="743"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width=190 bgcolor="#d8c0be">Jenis Urusan : </td>
                          <td bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['desc_jenisurusan']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Gred Jawatan </td>
                          <td bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['gredJawatann']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Gred Hakiki Pegawai </td>
                          <td bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['gred']; ?></td>
                        </tr>
                        <tr>
                          <td width=190 bgcolor="#d8c0be">Ringkasan : </td>
                          <td bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Ringkasan']; ?></td>
                        </tr>
						<tr>
                          <td width=190 bgcolor="#d8c0be">Keterangan Ringkasan : </td>
                          <td bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['KeteranganRingkasan']; ?></td>
                        </tr>
                        <tr>
                          <td  width=190 height="17" bgcolor="#d8c0be">Kertas : </td>
                          <td bgcolor="#FFFFFF"><a href="<?php echo $row_RsStatusUrusan['Link']; ?>" target="_blank"><?php echo $row_RsStatusUrusan['Link']; ?></a></td>
                        </tr>
                        <tr>
                          <td width=190 height="17" bgcolor="#d8c0be">No. Fail : </td>
                          <td bgcolor="#FFFFFF"><strong><?php echo $row_RsStatusUrusan['NoKertas']; ?></strong></td>
                        </tr>
                      </table>
                      <br>
                      <table width="743"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="123" bgcolor="#d8c0be">Status : </td>
                          <td width="323" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Status']; ?></td>
                          <td width="287" rowspan="8" bgcolor="#FFFFFF"><div align="center">
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
                          <td bgcolor="#d8c0be">Tarikh Terima : </td>
                          <td bgcolor="#FFFFFF"><?php echo format_datetime($row_RsStatusUrusan['TrTerima']); ?></td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#d8c0be">Tarikh Kemas kini : </td>
                          <td bgcolor="#FFFFFF"><?php echo format_datetime($row_RsStatusUrusan['TrSelesai']); ?></td>
                        </tr>
				        <tr>
                          <td colspan="2" bgcolor="#FFFFFF"><p>&nbsp;</p>
                          <p>&nbsp;</p></td>
                        </tr>
				        <tr>
					      <td width="123" bgcolor="#d8c0be">Keputusan : </td>
                          <td width="323" bgcolor="#FFFFFF"><strong><?php echo $row_RsStatusUrusan['Keputusan']; ?> </strong></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Ulasan : </td>
                          <td bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Ulasan']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Maklumbalas</td>
                          <td bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Maklumbalas']; ?></td>
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
                    </p>                    <table width="743" cellspacing="1" cellpadding="1" class="table">
                      <!--DWLayoutTable-->
                      <tr bgcolor="#897270">
                        <td width="15"><span class="style1">No</span></td>
                        <td width="159"><span class="style1">Edaran kepada </span></td>
                        <td width="36"><span class="style1">Status </span></td>
                        <td width="80"><span class="style1">Keputusan</span></td>
                        <td width="240"><span class="style1">Ulasan </span></td>
                        <td width="240"><span class="style1">Maklumbalas </span></td>
                        <td width="161"><span class="style1">Kemas kini</span></td>
                        <td width="47"><span class="style1">Tempoh </span></td>
                      </tr>
                      <?php
					  //2 color rows//////////////////////////////////////////////////////////////////////
					$color1 = "white";
					$color2 = "#f9f7f7";
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
                          <?php echo $row_RsStatusUrusan2['NamaPenuh'];?><br />
						  <?php  $idUs=$row_RsStatusUrusan2['idUser']; ?><br />
						  <?php
						   $query_RsPeranan = "SELECT b.desc_kategori FROM `tbluruspengguna` a 
												inner join tblkategori b on b.id_kategori=a.kategoriID
												where a.penggunaID='$idUs' and a.TajukMesyuaratID='$idM'";
							$RsPeranan = mysql_query($query_RsPeranan, $connspkp) or die(mysql_error());
							$row_RsPeranan = mysql_fetch_assoc($RsPeranan);

						  ?> 
						 <b> ( <?php echo strtoupper($row_RsPeranan['desc_kategori']);?> ) <br />
						                        </td>     
                        <td><table width="98%"  border="0" cellspacing="0" cellpadding="0" class="table">
                            <?php if (($row_RsStatusUrusan2['Status'])=='Baru') { ?>
                            <tr>
                              <td height="17" bgcolor="#80E474"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan2['Status'])=='Pertimbangan') {
						?>
                            <tr>
                              <td height="26" bgcolor="#FC9696"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="20" height="20" align="absmiddle"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan2['Status'])=='Selesai') {
						?>
                            <tr>
                              <td height="26" bgcolor="#9191FF"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"></strong></div>
                              </div></td>
                            </tr>
							<?php
								};
								if (($row_RsStatusUrusan2['Status'])=='Cuti') {
								?>
                          <tr>
                            <td bgcolor="#eaafc9"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/cuti.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"></strong></div>
                            </div></td>
                          </tr>
                            <?php };?>
                        </table></td>
                        <td><strong><?php echo $row_RsStatusUrusan2['Keputusan']; ?></strong></td>
                        <td><?php echo $row_RsStatusUrusan2['Ulasan']; ?></td>
                         <td><?php echo $row_RsStatusUrusan2['Maklumbalas']; ?></td>
                        <td><?php echo format_datetime($row_RsStatusUrusan2['TrSelesai']); ?></td>
						 <?php 
					   $datt= round($date_diff);
					  if($datt >'18358' || $datt=='0' || $datt=='18366' )
					   {
					   $dattDiff=0;
					   }else
					   {
					   $dattDiff=$datt;
					   }
					  ?>
                        <td><strong><?php echo round($dattDiff) ;?> hari</strong></td>
                      </tr>
                      <?php
					  $row_count++;
					  } while ($row_RsStatusUrusan2 = mysql_fetch_assoc($RsStatusUrusan2));
					  ?>
                    </table></td>
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
mysql_free_result($RsStatusUrusan);
mysql_free_result($RsStatusUrusan2);
?>
