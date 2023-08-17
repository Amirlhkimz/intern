<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

if($_SESSION["kategori"] !='3' ){
    header("Location: Logout.php");
  };
   $idPengguna=$_SESSION["idPengguna"];
?>

<?php

//$Kategori=$_GET['Kat'];

mysql_select_db($database_connspkp, $connspkp);
$query_RsJenis = "SELECT * FROM tbljenisurusan";
$RsJenis = mysql_query($query_RsJenis, $connspkp) or die(mysql_error());
$row_RsJenis = mysql_fetch_assoc($RsJenis);


include('include/FusionCharts.php');
include('include/FC_Colors.php');
include('include/FormatDate.php');


$strStartRange='';
$strEndRange='';
if(isset($_POST['txtDari'])){
							$StartRange=$_POST['txtDari'];
							$EndRange=$_POST['txtHingga'];
							$strStartRange=format_date($StartRange);
							$strEndRange=format_date($EndRange);
};
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
            <td width="250" height="338" valign="top"><?php include 'include/menupenyelaras.php'; ?>
            <p>&nbsp;</p>
            </td>
            <td valign="top" align="center"><table class="table">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><font size="3"><span class="style9">LAPORAN  MENGIKUT JENIS URUSAN </span></p></font>
                  <form action="LaporanJenisUrusanS.php" method="post" name="frmLaporan" id="frmLaporan">
                    <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#000000" class="table">
                      <tr bgcolor="#d8c0be">
                        <td width="12%" height="24"><p><img src="images/arrow.gif" width="12" height="10"><font size="2" color="black">Tempoh</p></td></font>
                        <td><font size="2" color="black">Dari :</font>
                          <input name="txtDari" type="text" id="txtDari">
                          <a href="javascript:NewCal('txtDari','yyyymmdd',false,24)"><img src="images/calendar.png" width="16" height="16" align="absmiddle" alt="Klik untuk paparkan kalendar" style="cursor:pointer" border="none"></a><font size="2" color="black">  hingga :</font>
                          <input name="txtHingga" type="text" id="txtHingga">
                          <a href="javascript:NewCal('txtHingga','yyyymmdd',false,24)"><img src="images/calendar.png" width="16" height="16" align="absmiddle" alt="Klik untuk paparkan kalendar" style="cursor:pointer" border="none"></a></td>
                        </tr>
                      <tr bgcolor="#d8c0be">
                        <td height="30">&nbsp;</td>
                        <td><input type="submit" name="Submit" value="Jana Laporan"></td>
                        </tr>
                    </table>
                    </form>
                  <p align="center"><span class="style7">Kriteria carian = &quot;</span><span class="style12"><?php echo $strStartRange;?></span><span class="style7">&quot; hingga &quot;<span class="style12"><?php echo $strEndRange;?></span>&quot;</span>
				  	<br>
				  	<?php
					$strXML="";
					$strXML = "<graph caption='LAPORAN MENGIKUT JENIS URUSAN' xAxisName='JENIS URUSAN' yAxisName='BILANGAN URUSAN' decimalPrecision='0' formatNumberScale='0'>";

					do{
							$row_RsUrusan['GrValue']="";

							mysql_select_db($database_connspkp, $connspkp);
							if ((isset($_POST['txtDari']))AND(isset($_POST['txtHingga']))){
							$StartRange=$_POST['txtDari'];
							$EndRange=$_POST['txtHingga'];

							/* $query_RsUrusan = "SELECT COUNT(id) FROM tblurusan
												WHERE tblurusan.Jenis = '".$row_RsJenis['id_jenisurusan']."'
												AND (tblurusan.TrCipta BETWEEN '$StartRange' AND '$EndRange')";
												*/
							$query_RsUrusan = "SELECT count(a.id) as idU FROM tblurusan a inner join tbluruspengguna b on b.MesyuaratID=a.bilMesyuarat WHERE                                                a.Jenis = '".$row_RsJenis['id_jenisurusan']."' and b.kategoriID='3' and b.penggunaID='$idPengguna'
												AND (a.TrCipta BETWEEN '$StartRange' AND '$EndRange')";
												
												
							}
							else{
							/* $query_RsUrusan = "SELECT COUNT(id) FROM tblurusan
												WHERE tblurusan.Jenis = '".$row_RsJenis['id_jenisurusan']."'";*/
                              $query_RsUrusan = "SELECT count(a.id) as idU FROM tblurusan a inner join tbluruspengguna b on b.MesyuaratID=a.bilMesyuarat WHERE                                                a.Jenis = '".$row_RsJenis['id_jenisurusan']."' and b.kategoriID='3' and b.penggunaID='$idPengguna'";
												
							}
//----------------------------------FETCH Range END-------------------------------------------------------//


							$RsUrusan = mysql_query($query_RsUrusan, $connspkp) or die(mysql_error());
							$row_RsUrusan = mysql_fetch_assoc($RsUrusan);

							$strXML .= "<set name='".$row_RsJenis['acr_jenisurusan']."' value='".$row_RsUrusan['idU']."' color='".getFCColor()."' />";


							}while ($row_RsJenis = mysql_fetch_array($RsJenis));

							$strXML .=  "</graph>";
							echo renderChartHTML('FusionCharts/FCF_Column3D.swf', "", $strXML, "myNext", 600, 300);


						mysql_free_result($RsUrusan);
						mysql_free_result($RsJenis);
					?>
</p>
                  <div align="center">
                    <table width="486" border="0" cellpadding="0" cellspacing="1" bgcolor="#333333" class="table">
                      <!--DWLayoutTable-->
											<tr bgcolor="#FFFFFF">
												<td width="61" rowspan="10" valign="top" bgcolor="#d8c0be"> Petunjuk : </td>
												<td width="196">PTKN = PERTUKARAN </td>
												<td width="225">PMKN = PEMANGKUAN </td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF">PNKS = PENEMPATAN KHAS </td>
												<td bgcolor="#FFFFFF">TCBBP = TAMAT CBBP </td>
											</tr>
											<tr>
												<td bgcolor="#FFFFFF">TCTG = TAMAT CTG/CSG </td>
												<td bgcolor="#FFFFFF">TPJN = TAMAT PEMINJAMAN </td>
											</tr>
											<tr>
												<td height="18" valign="top" bgcolor="#FFFFFF">JNKN = JAWATAN KUMPULAN </td>
												<td bgcolor="#FFFFFF">PMMN = PEMAKLUMAN </td>
											</tr>
											<tr>
											  <td height="18" valign="top" bgcolor="#FFFFFF">URKT= URUSAN KONTRAK </td>
											  <td bgcolor="#FFFFFF">URPS=URUSAN PERTUKARAN SEMENTARA</td>
					    </tr>
											<tr>
											  <td height="18" valign="top" bgcolor="#FFFFFF">URPJ=URUSAN PEMINJAMAN </td>
											  <td bgcolor="#FFFFFF">PKUP=PERMOHONAN KUP </td>
					    </tr>
                                      </table>
                  </div>                  <p align="center">&nbsp;				  </p></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#7d1935"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
<?php

?>
