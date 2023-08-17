<?php require_once('Connections/connspkp.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
?>
<? session_start();

if($_SESSION["kategori"] !='4' ){
		header("Location: Logout.php");
	};
?>

<?php
/////////FETCH DATA per Kumpulan//////////////////////////////////////////////////////////////////////////////////
$Search='';
if (isset($_POST['txtCari'])){
	$Search=$_POST['txtCari'];
	$query_RsUrusan = "SELECT * FROM tblurusan WHERE Jenis LIKE '%$Search%' OR Ringkasan LIKE '%$Search%' OR Kertas LIKE '%$Search%' ORDER BY TrCipta DESC";
}
else if (isset($_GET['txtS'])){
	$Search=$_GET['txtS'];
	$query_RsUrusan = "SELECT * FROM tblurusan WHERE Jenis LIKE '%$Search%' OR Ringkasan LIKE '%$Search%' OR Kertas LIKE '%$Search%' ORDER BY TrCipta DESC";
}
else if (isset($_GET['Kump'])) {
	$Kumpulan=$_GET['Kump'];
	$query_RsUrusan = "SELECT * FROM tblurusan WHERE Kategori='$Kumpulan' ORDER BY TrCipta DESC";
}
else {
	$query_RsUrusan = "SELECT * FROM tblurusan ORDER BY TrCipta DESC";
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
        stristr($param, "txtS") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsUrusan = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsUrusan = sprintf("&totalRows_RsUrusan=%d%s&txtS=%s", $totalRows_RsUrusan, $queryString_RsUrusan, $Search);
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
	background-color: #CCCCFE;
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
      <td width="32" height="409" valign="top"  class="containerleft"></td>
      <td valign="top"><table width="954" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="250" height="338" valign="top"><?php include 'include/menuadmin.php'; ?>
            <p>&nbsp;</p>
            </td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><span class="style9">LAPORAN  URUSAN</span></p>
                  <p><span class="style7">Kriteria carian = &quot;</span><span class="style12"><?php echo $Search?></span><span class="style7">&quot; </span></p>
                  <form action="Utama.php" method="post" name="frmLaporan" id="frmLaporan">
                    <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
                      <tr bgcolor="#CCCCCC">
                        <td width="12%" height="26"><img src="images/arrow.gif" width="12" height="10"> Kategori : </td>
                        <td><select name="select">
                          <option>Sila Pilih</option>
                          <option value="Ahli">Ahli</option>
                          <option value="Jemaah">Jemaah</option>
                                                                        </select></td>
                        </tr>
                      <tr bgcolor="#CCCCCC">
                        <td height="24"><p><img src="images/arrow.gif" width="12" height="10"> Dari : </p>                          </td>
                        <td><input name="txtDari" type="text" id="txtDari">
                          <a href="javascript:NewCal('txtMulaDari','yyyymmdd',false,24)"><img src="images/calendar.png" width="16" height="16" align="absmiddle" alt="Klik untuk paparkan kalendar" style="cursor:pointer" border="none"></a>  hingga :
                          <input name="txtHingga" type="text" id="txtHingga">
                          <a href="javascript:NewCal('txtHingga','yyyymmdd',false,24)"><img src="images/calendar.png" width="16" height="16" align="absmiddle" alt="Klik untuk paparkan kalendar" style="cursor:pointer" border="none"></a></td>
                        </tr>
                      <tr bgcolor="#CCCCCC">
                        <td height="30">&nbsp;</td>
                        <td><input type="submit" name="Submit" value="Jana Laporan"></td>
                        </tr>
                    </table>
                    </form>
                  <p align="center">&nbsp;</p>
                  </td>
              </tr>
            </table></td>
          </tr>
          <tr bgcolor="#CECFFF">
            <td height="28" colspan="2" valign="top"><div align="center" class="style7">| <a href="Utama.php">Muka utama</a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
          </tr>
      </table></td>
      <td width="38" valign="top" bgcolor="#CCCCFE" class="containerright"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="21" valign="top" class="containerBL"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top"  class="containerbottom"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" bgcolor="#CCCCFE" class="containerBR"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
  </table>
</div>
<?php

?>
