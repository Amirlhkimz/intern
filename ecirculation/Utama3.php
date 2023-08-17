<? session_start(); 

if($_SESSION["Kumpulan"] !='SUB' ){
		header("Location: Logout.php");
	};
?>

<?php 
require_once('Connections/connspkp.php'); 
include('include/FusionCharts.php');
include('include/FC_Colors.php');
include('include/FormatDate.php');
?>
<SCRIPT LANGUAGE="Javascript" SRC="include/FusionCharts.js"></SCRIPT>
<?php
$stridPengguna=$_SESSION["idPengguna"];

mysql_select_db($database_connspkp, $connspkp);
$query_rsPengumuman = "SELECT * FROM tblpengumuman WHERE status = 'papar' ORDER BY trCipta DESC";
$rsPengumuman = mysql_query($query_rsPengumuman, $connspkp) or die(mysql_error());
$row_rsPengumuman = mysql_fetch_assoc($rsPengumuman);
$totalRows_rsPengumuman = mysql_num_rows($rsPengumuman);

 mysql_select_db($database_connspkp, $connspkp);
//$query_RsCountPertimbang = "SELECT COUNT(*) FROM tblstatusurusan WHERE tblstatusurusan.Status = 'Pertimbangan' AND tblstatusurusan.idPengguna = '$stridPengguna'";
$query_RsCountPertimbang = "SELECT COUNT(*) FROM tblstatusurusan WHERE tblstatusurusan.Status = 'Pertimbangan'";
$RsCountPertimbang = mysql_query($query_RsCountPertimbang, $connspkp) or die(mysql_error());
$row_RsCountPertimbang = mysql_fetch_assoc($RsCountPertimbang);
$totalRows_RsCountPertimbang = mysql_num_rows($RsCountPertimbang); 

/* mysql_select_db($database_connspkp, $connspkp);
$query_RsCountPertimbang = "SELECT COUNT(*) FROM tblstatusurusan WHERE tblstatusurusan.Status = 'Pertimbangan'";
$RsCountPertimbang = mysql_query($query_RsCountPertimbang, $connspkp) or die(mysql_error());
$row_RsCountPertimbang = mysql_fetch_assoc($RsCountPertimbang);
$totalRows_RsCountPertimbang = mysql_num_rows($RsCountPertimbang); */

 mysql_select_db($database_connspkp, $connspkp);
//$query_RsCountBaru = "SELECT COUNT(*) FROM tblstatusurusan WHERE tblstatusurusan.Status = 'baru' AND tblstatusurusan.idPengguna = '$stridPengguna'";
$query_RsCountBaru = "SELECT COUNT(*) FROM tblstatusurusan WHERE tblstatusurusan.Status = 'baru'";
$RsCountBaru = mysql_query($query_RsCountBaru, $connspkp) or die(mysql_error());
$row_RsCountBaru = mysql_fetch_assoc($RsCountBaru);
$totalRows_RsCountBaru = mysql_num_rows($RsCountBaru); 

/* mysql_select_db($database_connspkp, $connspkp);
$query_RsCountBaru = "SELECT COUNT(*) FROM tblstatusurusan WHERE tblstatusurusan.Status = 'baru'";
$RsCountBaru = mysql_query($query_RsCountBaru, $connspkp) or die(mysql_error());
$row_RsCountBaru = mysql_fetch_assoc($RsCountBaru);
$totalRows_RsCountBaru = mysql_num_rows($RsCountBaru); */

 mysql_select_db($database_connspkp, $connspkp);
//$query_RsCountSelesai = "SELECT COUNT(*) FROM tblstatusurusan WHERE tblstatusurusan.Status = 'Selesai' AND tblstatusurusan.idPengguna = '$stridPengguna'";
$query_RsCountSelesai = "SELECT COUNT(*) FROM tblstatusurusan WHERE tblstatusurusan.Status = 'Selesai'";
$RsCountSelesai = mysql_query($query_RsCountSelesai, $connspkp) or die(mysql_error());
$row_RsCountSelesai = mysql_fetch_assoc($RsCountSelesai);
$totalRows_RsCountSelesai = mysql_num_rows($RsCountSelesai); 

/* mysql_select_db($database_connspkp, $connspkp);
$query_RsCountSelesai = "SELECT COUNT(*) FROM tblstatusurusan WHERE tblstatusurusan.Status = 'Selesai'";
$RsCountSelesai = mysql_query($query_RsCountSelesai, $connspkp) or die(mysql_error());
$row_RsCountSelesai = mysql_fetch_assoc($RsCountSelesai);
$totalRows_RsCountSelesai = mysql_num_rows($RsCountSelesai); */
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
.style18 {font-size: 24px; color: #FFFFFF; }
.style19 {color: #FFFFFF; font-size: 12px; }
.style31 {font-size: 36px; color: #009900; }
.style33 {font-size: 36px; color: #CC3300; }
.style39 {color: #000000}
.style49 {color: #666666}
.style50 {color: #000000; font-size: 12px; }
.style51 {
	color: #666666;
	font-weight: bold;
}
.style52 {font-size: 36px; color: #000000; }
-->
</style>

<div align="center" class="style3">
  <table width="1022" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr>
      <td height="246" colspan="3" valign="top"><img src="images/BANNER_new2.jpg" width="1024" height="246"></td>
    </tr>
    <tr>
      <td width="32" height="342" valign="top" background="images/10241_05.jpg"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td width="955" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="204" height="315" valign="top"><?php include 'include/menusub.php'; ?></td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="750" height="315" valign="top"><p><span class="style9">SELAMAT DATANG <?php echo $_SESSION["Gelaran"]; ?></span></p>
                  <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="blueline">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#FFFFFF" class="personalinfo">
                      <td height="21" colspan="5"><span class="style49"> &nbsp;URUSAN</span></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td width="11" rowspan="3"><div align="center"></div>                        <div align="center"></div>                        <div align="center"></div>                        <span class="style39"></span></td>
                      <td width="313" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      <td rowspan="3" valign="top"><div align="center"><p>&nbsp;
						    <?php
						  	$strXML="";
							$strXML = "<graph caption='URUSAN MENGIKUT STATUS' xAxisName='JUMLAH' yAxisName='STATUS' decimalPrecision='0' formatNumberScale='0'>";
							$strXML .= "<set name='Baru' value='".$row_RsCountBaru['COUNT(*)']."' color='".getFCColor()."' />";
							$strXML .= "<set name='Pertimbangan' value='".$row_RsCountPertimbang['COUNT(*)']."' color='".getFCColor()."' />";
							$strXML .= "<set name='Selesai' value='".$row_RsCountSelesai['COUNT(*)']."' color='".getFCColor()."' />";
							$strXML .=  "</graph>";
							echo renderChartHTML('FusionCharts/FCF_Column3D.swf', "", $strXML, "myNext", 260, 200);
						  ?>
</p>
                        </div></td>
                      <td width="124" rowspan="3"><div align="center">&quot; Satu Malaysia <br>
  Rakyat didahulukan,<br>
  Pencapaian diutamakan &quot; </div></td>
                      <td width="156" rowspan="3"><img src="images/gambarz_1333.jpg" width="153" height="153"></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td valign="top"> <p><span class="style31"><span class="style19"><img src="images/bd_nextpage.png" width="8" height="13" align="absmiddle"><a href="ListUrusan2.php?stat=baru"> <img src="images/baru.gif" width="25" height="16" border="0" align="absmiddle"></a> </span></span><strong><span class="style49">Baru <span class="style39">(</span></span><span class="style52"><span class="style7"><span class="style50"><?php echo $row_RsCountBaru['COUNT(*)']; ?></span></span></span><span class="style39">)</span> </strong> </p>
                        <p><span class="style31"><span class="style19"><img src="images/bd_nextpage.png" width="8" height="13" align="absmiddle"></span></span> <span class="style39"><span class="style18"><span class="style19"><span class="style33"><a href="ListUrusan2.php?stat=pertimbangan"><img src="images/prtmbg2.gif" width="24" height="24" border="0" align="absmiddle"></a></span></span></span> <span class="style51">Dalam pertimbangan (</span><strong><span class="style7"><?php echo $row_RsCountPertimbang['COUNT(*)']; ?></span>)</strong></span></p>
                        <p> <span class="style31"><span class="style19"><img src="images/bd_nextpage.png" width="8" height="13" align="absmiddle"></span></span> <a href="ListUrusan2.php?stat=selesai"><img src="images/selesai.png" width="24" height="24" border="0" align="absmiddle"></a> <strong><span class="style49">Selesai <span class="style39">(</span></span><span class="style50"><?php echo $row_RsCountSelesai['COUNT(*)']; ?></span><span class="style39">) </span></strong></p></td>
                      </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="18" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                  </table>
                  <br>
                  <table width="100%" height="54"  border="0" cellpadding="1" cellspacing="1" class="blueline">
                    <tr bgcolor="#999999" class="personalinfo">
                      <td height="21" colspan="2"><span class="style49">PENGUMUMAN</span>
                          <div align="center"></div></td>
                    </tr>
                    <?php do { ?>
                    <tr>
                      <td width="72%" height="28"> <img src="images/arrow.gif" width="12" height="10"> <?php echo $row_rsPengumuman['Kandungan']; ?><br></td>
                      <td width="28%"><div align="center"><?php echo format_datetime($row_rsPengumuman['trCipta']); ?></div></td>
                    </tr>
                    <?php } while ($row_rsPengumuman = mysql_fetch_assoc($rsPengumuman)); ?>
                  </table>
                  <p></p></td>
              </tr>
            </table></td>
          </tr>
          <tr bgcolor="#becdeb">
            <td height="28" colspan="2" valign="top"><div align="center" class="style7">| <a href="Utama2.php"> Muka utama</a> | <a href="EmailUrusetia.php">Emel urus setia</a> | <a  href="#" onClick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
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
mysql_free_result($rsPengumuman);
mysql_free_result($RsCountBaru);
mysql_free_result($RsCountPertimbang);
mysql_free_result($RsCountSelesai);
?>
