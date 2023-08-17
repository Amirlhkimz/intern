<?php require_once('Connections/connspkp.php'); ?>
<?
ob_start();
session_start();

if($_SESSION["Kumpulan"] !='urusetia' ){
		header("Location: Logout.php");
	};
?>
<?php
$idMes=$_GET["p"];
 $stridCipta=$_SESSION["idPengguna"];
         $strTrCipta=date("Y-m-j  H:i:s");
			mysql_select_db($database_connspkp, $connspkp);
			$query_RsMesy = "SELECT * FROM tblcuti WHERE id_cuti='$idMes'";
			$RsMesy = mysql_query($query_RsMesy, $connspkp) or die(mysql_error());
			$row_RsMesy = mysql_fetch_assoc($RsMesy);
			$totalRows_RsMesy = mysql_num_rows($RsMesy);
			$idCuti = $row_RsMesy["idAhliC"];

			mysql_select_db($database_connspkp, $connspkp);
			$query_RsCuti = "SELECT * FROM tblpengguna WHERE id='$idCuti'";
			$RsCuti = mysql_query($query_RsCuti, $connspkp) or die(mysql_error());
			$row_RsCuti = mysql_fetch_assoc($RsCuti);
			$idAhli = $row_RsCuti["NamaPenuh"];
?>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmUpdate")) {

		$idM=$_POST['txtid'];
		$NamaAhliCuti=$_POST['NamaAhliCuti'];
		$TarikhMula=$_POST['txtTarikhMula'];
		$TarikhAkhir=$_POST['txtTarikhAkhir'];


  $updateSQL = sprintf("UPDATE tblcuti
  						SET idAhliC='$NamaAhliCuti', tkh_mulaC='$TarikhMula', tkh_akhirC='$TarikhAkhir', idpenggunaC='$stridCipta',
						trkemaskiniC='$strTrCipta'
  						WHERE
						id_cuti='$idM'");


  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($updateSQL, $connspkp) or die(mysql_error());

		include('Logger.php');
		logMe("Kemas kini cuti: ".$idM."(".$stridCipta.")");


  $insertGoTo = "kemasCuti.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
.style11 {color: #FF0000}
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
      <td width="32" height="409" valign="top" bgcolor="#FFFFFF" background="images/10241_05.jpg" class="containerleft"></td>
      <td valign="top"><table width="954" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="250" height="338" valign="top"><?php include 'include/menuadmin.php'; ?>
            <br></td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><span class="style9">KEMASKINI CUTI</span></p>
                  <form action="<?php echo $editFormAction2; ?>" method="POST" name="frmInsert" id="frmInsert">
                    <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                      <!--DWLayoutTable-->
                      <tr>
                        <td width="123" bgcolor="#becdeb">Nama Ahli : </td>
                        <td width="610" bgcolor="#FFFFFF">
						<select name="NamaAhliCuti" >
                        		<?php
                      			 mysql_select_db($database_connspkp, $connspkp);
								$sqlJenisMes = "SELECT * FROM tblpengguna WHERE Kumpulan = 'Pengerusi' OR Kumpulan = 'Suruhanjaya' ORDER BY Susunan";
                      			$rsJenisMes = mysql_query($sqlJenisMes, $connspkp) or die("Connection Failed!");
                     			?>
                            <option value="<?php echo $idCuti?>" selected="selected"><? echo $idAhli ?></option>
                            <?php while ($row_rsJenisMes = mysql_fetch_array($rsJenisMes)) {
                        			if ($bileCir == $row_rsJenisMes['id'] ) { ?>
                            <option selected="selected" value="<?php echo $row_rsJenisMes['id']?>"> <?php echo $row_rsJenisMes['NamaPenuh']  ?></option>
                            <?php }
									else { ?>
                            <option value="<?php echo $row_rsJenisMes['id']?>"> <?php echo $row_rsJenisMes['NamaPenuh']  ?></option>
                            <?php }
                        		 }
								?>
                          </select>
						</td>
                      </tr>
                      <tr>
                        <td bgcolor="#becdeb">Tarikh Mula Cuti : </td>
                        <td bgcolor="#FFFFFF"><input name="txtTarikhMula" type="text" id="txtTarikhMula" size="10" value="<?php echo $row_RsMesy['tkh_mulaC'] ?>" /> <a href="javascript:NewCal('txtTarikhMula','yyyymmdd',false,24)"><img src="images/calendar.png" width="16" height="16" align="absmiddle" alt="Klik untuk paparkan kalendar" style="cursor:pointer" border="none"></a></td>
                      </tr>
					  <tr>
                        <td bgcolor="#becdeb">Tarikh Akhir Cuti : </td>
                        <td bgcolor="#FFFFFF"><input name="txtTarikhAkhir" type="text" id="txtTarikhAkhir" size="10" value="<?php echo $row_RsMesy['tkh_akhirC'] ?>" /> <a href="javascript:NewCal('txtTarikhAkhir','yyyymmdd',false,24)"><img src="images/calendar.png" width="16" height="16" align="absmiddle" alt="Klik untuk paparkan kalendar" style="cursor:pointer" border="none"></a></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><span class="style10">
                          <input type="submit" name="Submit3" value="Kemaskini">
                          <input name="Reset" type="reset" id="Reset" value="Reset">
                        </span></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="frmUpdate"><input name="txtid" type="hidden" id="txtid" value="<?php echo $row_RsMesy['id_cuti']; ?>">
                  </form>
                  <p>&nbsp;</p></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#becdeb"><div align="center" class="style7">| <a href="Utama.php">Muka utama</a> | <a  href="#" onClick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
          </tr>
                        </table></td>
      <td width="38" valign="top" background="images/10241_08.jpg" class="containerright"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="21" valign="top"  background="images/10241_25.jpg" class="containerBL"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top"  background="images/10241_27.jpg" class="containerbottom"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" background="images/10241_29.jpg" class="containerBR"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="1"></td>
      <td width="954"></td>
      <td></td>
    </tr>
  </table>
</div>
