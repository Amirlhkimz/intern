<?php require_once('Connections/connspkp.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
?>
<? session_start(); 

		if($_SESSION["Kumpulan"] !='SUB' ){
		header("Location: Logout.php");
	};
?>

<?php

mysql_select_db($database_connspkp, $connspkp);
$query_RsJenis = "SELECT * FROM tbljenisurusan";
$RsJenis = mysql_query($query_RsJenis, $connspkp) or die(mysql_error());
$row_RsJenis = mysql_fetch_assoc($RsJenis);


include('include/FusionCharts.php');
include('include/FC_Colors.php');
include('include/FormatDate.php');


							$StartRange=$_POST['txtDari'];
							$EndRange=$_POST['txtHingga'];
							$strStartRange=format_date($StartRange);
							$strEndRange=format_date($EndRange);
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
.style10 {color: #FF0000}
.style12 {	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<script language="javascript" type="text/javascript" src="include/datetimepick/datetimepicker.js">

//Date Time Picker script- by TengYong Ng of http://www.rainforestnet.com
//Script featured on JavaScript Kit (http://www.javascriptkit.com)
//For this script, visit http://www.javascriptkit.com 

</script>

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
            <td width="204" height="338" valign="top"><?php include 'include/menusub.php'; ?>
            <p>&nbsp;</p>
            </td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><span class="style9">LAPORAN  MENGIKUT JENIS URUSAN </span></p>
                  <form action="LaporanKeputusanUrusanS.php" method="post" name="frmLaporan" id="frmLaporan">
                    <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
                      <tr bgcolor="#CCCCCC">
                        <td width="12%" height="24"><p><img src="images/arrow.gif" width="12" height="10">Tempoh</p>                          </td>
                        <td>Dari : 
                          <input name="txtDari" type="text" id="txtDari">
                          <a href="javascript:NewCal('txtDari','yyyymmdd',false,24)"><img src="images/calendar.png" width="16" height="16" align="absmiddle" alt="Klik untuk paparkan kalendar" style="cursor:pointer" border="none"></a>  hingga : 
                          <input name="txtHingga" type="text" id="txtHingga">
                          <a href="javascript:NewCal('txtHingga','yyyymmdd',false,24)"><img src="images/calendar.png" width="16" height="16" align="absmiddle" alt="Klik untuk paparkan kalendar" style="cursor:pointer" border="none"></a></td>
                        </tr>
                      <tr bgcolor="#CCCCCC">
                        <td height="30">&nbsp;</td>
                        <td><input type="submit" name="Submit" value="Jana Laporan"></td>
                        </tr>
                    </table>
                    </form>                  
                  <p align="center"><span class="style7">Kriteria carian = &quot;</span><span class="style12"><?php echo $strStartRange;?></span><span class="style7">&quot; hingga &quot;<span class="style12"><?php echo $strEndRange;?></span>&quot;</span> 
				  	<br>
				  	<?php
 					
					$i=0;
					do{
							$row_RsUrusanSetuju['GrValue']="";
			
							mysql_select_db($database_connspkp, $connspkp);
											
							//----------------------------------FETCH Range START-------------------------------------------------------//
							if (($_POST['txtDari']!="")AND($_POST['txtHingga']!="")){
							$StartRange=$_POST['txtDari'];
							$EndRange=$_POST['txtHingga'];

						/* 	$query_RsUrusanSetuju = "SELECT COUNT(tblstatusurusan.id) FROM tblstatusurusan 
												INNER JOIN tblurusan
												ON tblstatusurusan.idUrusan = tblurusan.id
												WHERE tblurusan.Jenis = '".$row_RsJenis['desc_jenisurusan']."'
												AND tblstatusurusan.idPengguna='".$_SESSION["idPengguna"]."'
												AND tblstatusurusan.Keputusan='Setuju'
												AND (tblstatusurusan.TrTerima BETWEEN '$StartRange' AND '$EndRange')";
												
							$query_RsUrusanTSetuju = "SELECT COUNT(tblstatusurusan.id) FROM tblstatusurusan 
												INNER JOIN tblurusan
												ON tblstatusurusan.idUrusan = tblurusan.id
												WHERE tblurusan.Jenis = '".$row_RsJenis['desc_jenisurusan']."'
												AND tblstatusurusan.idPengguna='".$_SESSION["idPengguna"]."'
												AND tblstatusurusan.Keputusan='Tidak Setuju'
												AND (tblstatusurusan.TrTerima BETWEEN '$StartRange' AND '$EndRange')"; */
							
							$query_RsUrusanSetuju = "SELECT COUNT(tblstatusurusan.id) FROM tblstatusurusan 
												INNER JOIN tblurusan
												ON tblstatusurusan.idUrusan = tblurusan.id
												WHERE tblurusan.Jenis = '".$row_RsJenis['desc_jenisurusan']."'
												AND tblstatusurusan.Keputusan='Setuju'
												AND tblurusan.status != 'BATAL'
												AND (tblstatusurusan.TrTerima BETWEEN '$StartRange' AND '$EndRange')";
												
							$query_RsUrusanTSetuju = "SELECT COUNT(tblstatusurusan.id) FROM tblstatusurusan 
												INNER JOIN tblurusan
												ON tblstatusurusan.idUrusan = tblurusan.id
												WHERE tblurusan.Jenis = '".$row_RsJenis['desc_jenisurusan']."'
												AND tblstatusurusan.Keputusan='Tidak Setuju'
												AND tblurusan.status != 'BATAL'
												AND (tblstatusurusan.TrTerima BETWEEN '$StartRange' AND '$EndRange')";

					
							}
							else{
						/* 	$query_RsUrusanSetuju = "SELECT COUNT(tblstatusurusan.id) FROM tblstatusurusan 
												INNER JOIN tblurusan
												ON tblstatusurusan.idUrusan = tblurusan.id
												WHERE tblurusan.Jenis = '".$row_RsJenis['desc_jenisurusan']."'
												AND tblstatusurusan.idPengguna='".$_SESSION["idPengguna"]."'
												AND tblstatusurusan.Keputusan='Setuju'";
												
							$query_RsUrusanTSetuju = "SELECT COUNT(tblstatusurusan.id) FROM tblstatusurusan 
												INNER JOIN tblurusan
												ON tblstatusurusan.idUrusan = tblurusan.id
												WHERE tblurusan.Jenis = '".$row_RsJenis['desc_jenisurusan']."'
												AND tblstatusurusan.idPengguna='".$_SESSION["idPengguna"]."'
												AND tblstatusurusan.Keputusan='Tidak Setuju'"; */
							
								$query_RsUrusanSetuju = "SELECT COUNT(tblstatusurusan.id) FROM tblstatusurusan 
												INNER JOIN tblurusan
												ON tblstatusurusan.idUrusan = tblurusan.id
												WHERE tblurusan.Jenis = '".$row_RsJenis['desc_jenisurusan']."'
												AND tblurusan.status != 'BATAL'
												AND tblstatusurusan.Keputusan='Setuju'";
												
							$query_RsUrusanTSetuju = "SELECT COUNT(tblstatusurusan.id) FROM tblstatusurusan 
												INNER JOIN tblurusan
												ON tblstatusurusan.idUrusan = tblurusan.id
												WHERE tblurusan.Jenis = '".$row_RsJenis['desc_jenisurusan']."'
												AND tblurusan.status != 'BATAL'
												AND tblstatusurusan.Keputusan='Tidak Setuju'";



							}
							//----------------------------------FETCH Range END-------------------------------------------------------//
							
							
							$RsUrusanSetuju = mysql_query($query_RsUrusanSetuju, $connspkp) or die(mysql_error());
							$row_RsUrusanSetuju = mysql_fetch_assoc($RsUrusanSetuju);

							$RsUrusanTSetuju = mysql_query($query_RsUrusanTSetuju, $connspkp) or die(mysql_error());
							$row_RsUrusanTSetuju = mysql_fetch_assoc($RsUrusanTSetuju);

							

							$arrData[$i][1]=$row_RsJenis['acr_jenisurusan'];
							$arrData[$i][2]=$row_RsUrusanSetuju['COUNT(tblstatusurusan.id)'];
							$arrData[$i][3]=$row_RsUrusanTSetuju['COUNT(tblstatusurusan.id)'];

							$i++;
							}while ($row_RsJenis = mysql_fetch_array($RsJenis));

							$strXML = "<graph caption='KEPUTUSAN MENGIKUT JENIS URUSAN' numberPrefix='' formatNumberScale='1' rotateValues='1' decimalPrecision='0' >";
							$strCategories = "<categories>";
							
							$strDataCurr = "<dataset seriesName='SETUJU' color='AFD8F8'>";
							$strDataPrev = "<dataset seriesName='TIDAK SETUJU' color='F6BD0F'>";
							
							foreach ($arrData as $arSubData) {
        					//Append <category name='...' /> to strCategories
        					$strCategories .= "<category name='" . $arSubData[1] . "' />";
        					//Add <set value='...' /> to both the datasets
        					$strDataCurr .= "<set value='" . $arSubData[2] . "' />";
        					$strDataPrev .= "<set value='" . $arSubData[3] . "' />";
							}
							
							$strCategories .= "</categories>";
							
							$strDataCurr .= "</dataset>";
							$strDataPrev .= "</dataset>";
							
							$strXML .= $strCategories . $strDataCurr . $strDataPrev . "</graph>";
							
							echo renderChart('FusionCharts/FCF_MSColumn3D.swf', "", $strXML, "productSales", 600, 300);


						mysql_free_result($RsUrusanSetuju);
						mysql_free_result($RsUrusanTSetuju);
						mysql_free_result($RsJenis);
					?>
</p>
                  <div align="center">
                    <table width="486" border="0" cellpadding="0" cellspacing="1" bgcolor="#333333">
                      <!--DWLayoutTable-->
                        <tr bgcolor="#FFFFFF">
                          <td width="61" rowspan="8" valign="top" bgcolor="#CCCCCC"> Petunjuk : </td>
                          <td width="196">PDP = PENGESAHAN DALAM PERKHIDMATAN </td>
                          <td width="225">PE = PEMANGKUAN </td>
                        </tr>
                        <tr>
                          <td bgcolor="#FFFFFF">PTB = PEMBERIAN TARAF BERPENCEN </td>
                          <td bgcolor="#FFFFFF">PP = PEMINJAMAN </td>
                        </tr>
                        <tr>
                          <td bgcolor="#FFFFFF">OSP = OPSYEN SEMULA BERPENCEN </td>
                          <td bgcolor="#FFFFFF">TS = TUKAR SEMENTARA </td>
                        </tr>
                        <tr>
                          <td height="18" valign="top" bgcolor="#FFFFFF">PGP = PENETAPAN GAJI PERMULAAN </td>
                          <td bgcolor="#FFFFFF">KK = KERTAS KHAS </td>
                        </tr>
						<tr>
                          <td bgcolor="#FFFFFF">MN = PENGESAHAN MINIT MESYUARAT SPA </td>
                          <td bgcolor="#FFFFFF">KM = KERTAS MAKLUMAN </td>
                        </tr>
                        <tr>
                          <td bgcolor="#FFFFFF">NP = NAIK PANGKAT </td>
                          <td bgcolor="#FFFFFF">PL = PELANTIKAN </td>
                        </tr>
						<tr>
                          <td bgcolor="#FFFFFF">PST = PENENTUAN STATUS TAWARAN  </td>
                          <td bgcolor="#FFFFFF">PT = PENAMATAN</td>
                        </tr>
						<tr>
                          <td bgcolor="#FFFFFF">TK = PERTUKARAN PERKHIDMATAN  </td>
                          <td bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                                      </table>
                  </div>                  <p align="center">&nbsp;</p></td>
              </tr>
            </table></td>
          </tr>
          <tr bgcolor="#becdeb">
            <td height="28" colspan="2" valign="top"><div align="center" class="style7">| <a href="Utama3.php">Muka utama</a>  | <a href="EmailUrusetia.php">Emel urus setia</a> | <a  href="#" onClick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
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

?>

