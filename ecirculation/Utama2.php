<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

if($_SESSION["kategori"] !='2' ){
	if($_SESSION["kategori"] !='1' ){
		header("Location: Logout.php");
		}
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
 $query_RsCountPertimbang = "select count(*) as kiraPertimbangan FROM tblstatusurusan h inner join tblurusan a on a.id= h.idUrusan inner join tblmesyuarat b on a.bilMesyuarat=b.id left join tbljenisurusan c on a.jenis=c.id_jenisurusan left join tblgred d on a.GredUrusan=d.ID INNER join tblreftajukmesyuarat g on g.id=b.TajukMesyuaratID and g.actv_Mesyuarat=1 where h.idPengguna = '$stridPengguna' AND a.Status='Pertimbangan' AND a.status !='BATAL' ORDER BY a.id desc";
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
//$query_RsCountBaru = "SELECT COUNT(*) FROM tblstatusurusan, tblurusan WHERE tblstatusurusan.Status = 'baru' AND tblstatusurusan.idPengguna = '$stridPengguna' AND tblstatusurusan.idUrusan = tblurusan.id AND tblurusan.Status<>'BATAL'";
//update zana 842020s
  $query_RsCountBaru = "select count(*) as kiraBaru FROM tblstatusurusan h inner join tblurusan a on a.id= h.idUrusan inner join tblmesyuarat b on a.bilMesyuarat=b.id left join tbljenisurusan c on a.jenis=c.id_jenisurusan left join tblgred d on a.GredUrusan=d.ID INNER join tblreftajukmesyuarat g on g.id=b.TajukMesyuaratID and g.actv_Mesyuarat=1 where h.idPengguna = '$stridPengguna' AND h.Status='Baru' AND a.status !='BATAL' ORDER BY a.id desc";
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
//$query_RsCountSelesai = "SELECT COUNT(*) FROM tblstatusurusan, tblurusan WHERE tblurusan.id = tblstatusurusan.idUrusan AND tblstatusurusan.Status = 'Selesai' AND tblurusan.status !='BATAL' AND tblstatusurusan.idPengguna = '$stridPengguna'";

$query_RsCountSelesai = "select count(*) as kiraSelesai FROM tblstatusurusan h inner join tblurusan a on a.id= h.idUrusan inner join tblmesyuarat b on a.bilMesyuarat=b.id left join tbljenisurusan c on a.jenis=c.id_jenisurusan left join tblgred d on a.GredUrusan=d.ID INNER join tblreftajukmesyuarat g on g.id=b.TajukMesyuaratID and g.actv_Mesyuarat=1 where  h.idPengguna = '$stridPengguna' AND h.Status='Selesai' AND a.status !='BATAL' ORDER BY a.id desc";
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
	/*background-color: DimGray;*/
	background-image: url("././images/bgblur.jpg");
	background-size: cover;
}
-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

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

<div align="center">
  <table class="table"  >
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
            <td width="250" height="315" valign="top"><?php include 'include/menuuser.php'; ?></td>
            <td valign="top" align="center"><table class="table" border="1" bordercolor=#e5e0da>
              <!--DWLayoutTable-->
              <tr>
                <td width="750" height="315" valign="top">
                  <table class="table" border="0">
                    <!--DWLayoutTable-->
									  <tr>
                        <td height="21" colspan="5"><strong><font size="2"> &nbsp;URUSAN </font></strong></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td width="70" rowspan="3"><div align="center"></div>                        <div align="center"></div>                        <div align="center"></div>                        <span class="style39"></span></td>
                      <td width="313" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      <td rowspan="3" valign="top"><div align="center"><p>&nbsp;
						    <?php
						  	$strXML="";
							$strXML = "<graph caption='URUSAN MENGIKUT STATUS' xAxisName='JUMLAH' yAxisName='STATUS' decimalPrecision='0' formatNumberScale='0'>";
							$strXML .= "<set name='Baru' value='".$row_RsCountBaru['kiraBaru']."' color='".getFCColor()."' />";
							$strXML .= "<set name='Pertimbangan' value='".$row_RsCountPertimbang['kiraPertimbangan']."' color='".getFCColor()."' />";
							$strXML .= "<set name='Selesai' value='".$row_RsCountSelesai['kiraSelesai']."' color='".getFCColor()."' />";
							$strXML .=  "</graph>";
							echo renderChartHTML('FusionCharts/FCF_Column3D.swf', "", $strXML, "myNext", 260, 200);
						  ?>
</p>
                        </div></td>
                    </tr>
                    <tr bgcolor="#FFFFFF">
                      <td valign="top"> <p><span class="style31"><span class="style19"><img src="images/bd_nextpage.png" width="8" height="13" align="absmiddle"><a href="LihatUrusan2.php?stat=Baru"> <img src="images/baru.gif" width="25" height="16" border="0" align="absmiddle"></a> </span></span><strong><span class="style49"><font size="3">Baru </font><span class="style39">(</span></span><span class="style52"><span class="style7"><span class="style50"><?php echo $row_RsCountBaru['kiraBaru']; ?></span></span></span><span class="style39">)</span> </strong> </p>
                      <!--  <p><span class="style31"><span class="style19"><img src="images/bd_nextpage.png" width="8" height="13" align="absmiddle"></span></span> <span class="style39"><span class="style18"><span class="style19"><span class="style33"><a href="LihatUrusan2.php?stat=pertimbangan"><img src="images/prtmbg2.gif" width="24" height="24" border="0" align="absmiddle"></a></span></span></span> <span class="style51"><font size="3">Dalam pertimbangan </font>(</span><strong><span class="style7"><font size="3"><?php echo $row_RsCountPertimbang['kiraPertimbangan']; ?></font></span>)</strong></span></p>-->
					  
                        <p> <span class="style31"><span class="style19"><img src="images/bd_nextpage.png" width="8" height="13" align="absmiddle"></span></span> <a href="LihatUrusan2.php?stat=selesai"><img src="images/selesai.png" width="24" height="24" border="0" align="absmiddle"></a> <strong><span class="style49"><font size="3">Selesai</font><span class="style39">(</span></span><span class="style50"><?php echo $row_RsCountSelesai['kiraSelesai']; ?></span><span class="style39">) </span></strong></p></td>
                      </tr>
                    <tr bgcolor="#FFFFFF">
                      <td height="18" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                  </table>
                  <br>
                  <table class="table">
                    <tr bgcolor="#d8c0be">
                      <td height="21" colspan="2"><span class="style49"><font size="2" color="black"><strong>PENGUMUMAN</strong></font></span>
                          <div align="center"></div></td>
                    </tr>
                    <?php do { ?>
                    <tr>
                      <td width="72%" height="28"> <img src="images/arrow.gif" width="17" height="15"> <font size="3"><?php echo $row_rsPengumuman['Kandungan']; ?></font><br></td>
                      <?php  $tarikhP=$row_rsPengumuman['trCipta'];
					  if($tarikhP<>"")
					  {
					   $TarikhUmum=format_datetime($row_rsPengumuman['trCipta']);
					  }else
					  {
					  $TarikhUmum="";
					  }
					   ?>
					  <td width="28%"><div align="center"><font size="3"><?php echo $TarikhUmum; ?></font></div></td>
                    </tr>
                    <?php } while ($row_rsPengumuman = mysql_fetch_assoc($rsPengumuman)); ?>
                  </table>
                  <p></p></td>
              </tr>
            </table></td>
          </tr>
          <tr bgcolor="#7d1935">
            <td height="28" colspan="2" valign="top"><div align="center" class="style7">| <a href="Utama2.php"><font color="white"> Muka utama</font></a> | <!-- <a href="EmailUrusetia.php"><font color="white">Emel urus setia</font></a> | --> <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
          </tr>
            </table></td>
        </tr>

  </table>
</div>
<?php
mysql_free_result($rsPengumuman);
mysql_free_result($RsCountBaru);
mysql_free_result($RsCountPertimbang);
mysql_free_result($RsCountSelesai);
?>
