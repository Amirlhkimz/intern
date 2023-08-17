<?php require_once('Connections/connspkp.php'); ?>
<? session_start();

if($_SESSION["Kumpulan"] !='Suruhanjaya' ){
	if($_SESSION["Kumpulan"] !='Pengerusi' ){
		header("Location: Logout.php");
		}
	};
?>

<?php
include('include/FusionCharts.php');
include('include/FC_Colors.php');
include('include/FormatDate.php');

$idStatusUrusan= $_GET['s'];
$idUrusan = $_GET['u'];
$idPengguna = $_SESSION["idPengguna"];

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE id='$idStatusUrusan'";
$query_RsStatusUrusan = "SELECT tblstatusurusan.*, tblurusan.Jenis, tblurusan.Ringkasan, tblurusan.Kertas, tblurusan.Link FROM tblstatusurusan
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

///////////UPDATE KEPUTUSAN START/////////////////////////////////////////////////////////////////////
include('Logger.php');


/* $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
} */

$strKeputusan='';
$strUlasan='';
$strKini=date("Y-m-j  H:i:s");
$idUrusanP='';

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmKemaskini")) {

$strKeputusan=$_POST['selectKeputusan'];
$strUlasan=$_POST['txtUlasan'];
$strKini=date("Y-m-j  H:i:s");
$idUrusanP=$_POST['txtidUrusan'];

  $updateSQL = sprintf("UPDATE tblstatusurusan SET Keputusan='$strKeputusan',Ulasan='$strUlasan',Status='Selesai', TrSelesai='$strKini' WHERE id='$idStatusUrusan'");



  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($updateSQL, $connspkp) or die(mysql_error());

			mysql_select_db($database_connspkp, $connspkp);
			//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE id='$idStatusUrusan'";
			$RsStatusAkhirUrusan = mysql_query("SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusanP' AND Status<>'Selesai'");
			$myrowscheck = mysql_num_rows($RsStatusAkhirUrusan);

				if ($myrowscheck == 0){
						$selesaiSQL = sprintf("UPDATE tblurusan SET Status='Selesai', TrKemaskini='$strKini', idkemaskini='".$_SESSION["idPengguna"]."' WHERE id='$idUrusanP'");

  						mysql_select_db($database_connspkp, $connspkp);
  						$Result_selesaiSQL = mysql_query($selesaiSQL, $connspkp) or die(mysql_error());
				logMe("Kemaskini status akhir urusan kepada Selesai");

				//---------------emel kepada pengguna biasa START---------------//
				include('EmailUrusanSelesai.php');
				//---------------emel kepada pengguna biasa END---------------//

				}


//-------------------START CREATE PDF AND EMAIL------------------------//
    include 'designpdf.php';
//------------------START CREATE PDF AND EMAIL END---------------------//

		logMe("Membuat keputusan urusan: ".$row_RsStatusUrusan['Ringkasan']);



/*   $updateGoTo = "LaporanKeputusan.php?s=".$idStatusUrusan;
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo)); */
?>
<meta http-equiv="refresh" content="0;URL=LaporanKeputusan.php?s=<?php echo $idStatusUrusan;?>">
<?php
}
///////////UPDATE KEPUTUSAN END/////////////////////////////////////////////////////////////////////



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
	color: #6699CC;
	font-weight: bold;
}
.style12 {color: #000000; font-weight: bold; }
-->
</style>

<div align="center" class="style3">
  <table width="1022" border="0" cellpadding="0" cellspacing="0" class="PAGECONTAINER">
    <!--DWLayoutTable-->
    <tr>
      <td height="246" colspan="3" valign="top"><img src="images/BANNER_new2.jpg" width="1024" height="246"></td>
    </tr>
    <tr>
      <td width="32" height="342"  valign="top" background="images/10241_05.jpg"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td width="955"  valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="250" height="315" valign="top"><?php include 'include/menuuser.php'; ?></td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
                <!--DWLayoutTable-->
                <tr>
                  <td width="750" height="315" valign="top"><p><span class="style9">KEMASKINI / BUAT KEPUTUSAN </span></p>
				  <form action="Kemaskini.php?s=<?php echo $idStatusUrusan; ?>&u=<?php echo $idUrusan; ?>" method="POST" name="frmKemaskini" id="frmKemaskini">
                      <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                        <!--DWLayoutTable-->
                        <tr>
                          <td bgcolor="#d8c0be">Jenis Urusan : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Jenis']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Ringkasan : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Ringkasan']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Kertas : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><span class="style10"><a href="StatusPertimbang.php?L=<?php echo $row_RsStatusUrusan['Link']; ?>&U=<?php echo $row_RsStatusUrusan['idUrusan']; ?>" target="_blank"><?php echo $row_RsStatusUrusan['Kertas']; ?></a></span></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">No. Fail : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><span class="style12"><?php echo $row_RsStatusUrusan['NoKertas']; ?></span></td>
                        </tr>
                        <tr>
                          <td width="123" bgcolor="#d8c0be"><br>
                            <br>                            <br></td>
                          <td width="610" bgcolor="#FFFFFF"><br>
                            <br>
                            <br>
                            <br></td>
                          <td width="610" rowspan="4" bgcolor="#FFFFFF"><div align="center">
                     <?php
					$strXML="";
					$strXML = "<graph caption='Carta Keputusan' xAxisName='Keputusan' yAxisName='Jumlah' decimalPrecision='0' formatNumberScale='0'>";

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
                          <td width="123" bgcolor="#d8c0be">Status : </td>
                          <td width="610" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Status']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Tarikh Terima : </td>
                          <td bgcolor="#FFFFFF"><?php echo format_datetime($row_RsStatusUrusan['TrTerima']); ?></td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#d8c0be">Tarikh Kemas kini : </td>
                          <td bgcolor="#FFFFFF"><?php echo format_datetime($row_RsStatusUrusan['TrSelesai']); ?></td>
                        </tr>


					  </table>
                      <br>
                      <table width="743"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                        <!--DWLayoutTable-->
                      </table>
                      <br>
                      <table width="743"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="123" bgcolor="#d8c0be">Keputusan  : </td>
                          <td width="610" bgcolor="#FFFFFF"> <select name="selectKeputusan" id="selectKeputusan">
                            <?php if($row_RsStatusUrusan['Jenis']=="KERTAS MAKLUMAN"){?>
                            <option>Ambil Maklum</option>
							<?php };?>
                            <?php if(($row_RsStatusUrusan['Jenis']<>"KERTAS MAKLUMAN")
									AND ($row_RsStatusUrusan['Kertas']<>"50-2014-19.8.2014.pdf")){?>
                            <option>Setuju</option>
                            <option>Tidak Setuju</option>
                            <option>Berkecuali</option>
                            <?php };?>

                          </select></td>
                        </tr>
                        <tr>
                          <td valign="top" bgcolor="#d8c0be">Ulasan : </td>
                          <td bgcolor="#FFFFFF"><textarea name="txtUlasan" cols="70" rows="6" id="txtUlasan"></textarea></td>
                        </tr>
                        <tr>
                          <td colspan="2" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                          <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Hantar" onClick = "if (! confirm(' Adakah <?php echo $_SESSION["Gelaran"];?> pasti dengan keputusan ini?')) return false;"></td>
                        </tr>
                      </table>
                      <input type="hidden" name="MM_update" value="frmKemaskini">
                      <input name="txtidUrusan" type="hidden" id="txtidUrusan" value="<?php echo $row_RsStatusUrusan['idUrusan']; ?>">
                  </form>                    <img src="images/arrow.gif" width="12" height="10"> LAIN-LAIN KEPUTUSAN DAN ULASAN<br>
                    <br>
                    <table width="743" cellspacing="1" cellpadding="1">
                      <!--DWLayoutTable-->
                      <tr bgcolor="#999999">
                        <td width="15"><span class="style1">No</span></td>
                        <td width="159"><span class="style1">Edaran kepada </span></td>
                        <td width="36"><span class="style1">Status </span></td>
                        <td width="80"><span class="style1">Keputusan</span></td>
                        <td width="240"><span class="style1">Ulasan </span></td>
                        <td width="161"><span class="style1">Kemas kini</span></td>
                        <td width="47"><span class="style1">Tempoh </span></td>
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
                        <td><p><?php echo $row_RsStatusUrusan2['Gelaran']; ?><br>
                              <?php echo $row_RsStatusUrusan2['NamaPenuh'];
							  if($row_RsStatusUrusan2['idPengguna']=='42'){?><br>
                              Anggota SPA (Menunaikan fungsi Pengerusi SPA &amp; SPKP mengikut Perkara <br>
                            142(3A) Perlembagaan Persekutuan)<?php };?>

							<?php if($row_RsStatusUrusan['idPengguna']=='15'
						  && ($row_RsStatusUrusanT['TrCipta'] >= '2016-09-09 00:00:00')
						  && ($row_RsStatusUrusanT['TrCipta'] <= '2016-09-23 00:00:00') ){?>
							<br>
							Anggota SPA (Menunaikan fungsi Pengerusi SPA mengikut Perkara 142(3A) Perlembagaan Persekutuan) <?php };?>
					    </p>                        </td>
                        <td><table width="98%"  border="0" cellspacing="0" cellpadding="0">
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
                            <?php };?>
                        </table></td>
                        <td><strong><?php echo $row_RsStatusUrusan2['Keputusan']; ?></strong></td>
                        <td><?php echo $row_RsStatusUrusan2['Ulasan']; ?></td>
                        <td><?php echo format_datetime($row_RsStatusUrusan2['TrSelesai']); ?></td>
                        <td><strong><?php echo round($date_diff) ;?> hari</strong></td>
                      </tr>
                      <?php
					  $row_count++;
					  } while ($row_RsStatusUrusan2 = mysql_fetch_assoc($RsStatusUrusan2));
					  ?>
                    </table>
                    <div align="center"><br>
                    </div>
                    <div align="center"></div>
                  </td>
                </tr>
                                    </table></td>
          </tr>
          <tr bgcolor="#d8c0be">
            <td height="28" colspan="2" valign="top"><div align="center" class="style7">| <a href="Utama2.php">Muka utama</a> | <a href="EmailUrusetia.php">Emel urus setia</a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
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
mysql_free_result($RsStatusUrusan2);

?>
