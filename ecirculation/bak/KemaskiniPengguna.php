<?php require_once('Connections/connspkp.php'); ?>
<?
ob_start();
session_start();

if($_SESSION["Kumpulan"] !='urusetia' ){
		header("Location: Logout.php");
	};
?>
<?php
$idPengguna3=$_GET["I"];

mysql_select_db($database_connspkp, $connspkp);
$query_RsPengguna = "SELECT * FROM tblpengguna WHERE id='$idPengguna3'";
$RsPengguna = mysql_query($query_RsPengguna, $connspkp) or die(mysql_error());
$row_RsPengguna = mysql_fetch_assoc($RsPengguna);
$totalRows_RsPengguna = mysql_num_rows($RsPengguna);
?>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmUpdate")) {

                       $idPengguna2=$_POST['txtid'];
					             $Gelaran2=mysql_real_escape_string($_POST['selectGelaran']);
                       $NoKp2=$_POST['txtNoKp'];
                       $NamaPenuh2=$_POST['txtNamaPenuh'];
                       $Jawatan2=$_POST['txtJawatan'];
                       $Gred2=$_POST['txtGred'];
                       $Bahagian2=$_POST['selectBahagian'];
                       $NoHp2=$_POST['txtNoHp'];
                       $Email2=$_POST['txtEmail'];
                       $Login2=$_POST['txtLogin'];
                       if($_POST['checkboxpass']=='KemaskiniPass'){
					   		          $KLaluan2=(md5($_POST['txtKLaluan']));
                       		$strKemaskiniMyPass = "KLaluan='".$KLaluan2."', ";
					             }
                       $Kategori2=$_POST['selectKategori'];
                       $Status2=$_POST['selectStatus'];
                       $Group_id2=$_POST['selectGroup_id'];
					   $Susunan=$_POST['txtSusunan'];
  //$Gelaran2


  $updateSQL = sprintf("UPDATE tblpengguna
  						SET Gelaran='$Gelaran2', Group_Id ='$Group_id2', NoKp='$NoKp2', NamaPenuh='$NamaPenuh2', Jawatan='$Jawatan2', Gred='$Gred2', Bahagian='$Bahagian2', NoHp='$NoHp2', Email='$Email2', Login='$Login2', ".$strKemaskiniMyPass." Kumpulan='$Kategori2' , Status='$Status2', Susunan='$Susunan'
  						WHERE
						id='$idPengguna2'");


  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($updateSQL, $connspkp) or die(mysql_error());

		include('Logger.php');
		logMe("Kemas kini pengguna: ".$idPengguna2."(".$NamaPenuh2.")");


  $insertGoTo = "Pengguna.php";
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
      <td width="32" height="409" valign="top" background="images/10241_05.jpg" class="containerleft"></td>
      <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="250" height="338" valign="top"><?php include 'include/menuadmin.php'; ?></td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><span class="style9">KEMAS KINI PENGGUNA </span></p>
                  <form action="<?php echo $editFormAction; ?>" method="POST" name="frmUpdate" id="frmUpdate">
                    <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                      <!--DWLayoutTable-->
                      <tr bgcolor="#666666">
                        <td colspan="4"><span class="style1"><img src="images/arrow.gif" width="12" height="10"> MAKLUMAT PENGGUNA </span></td>
                      </tr>
                      <tr>
                        <td width="80" bgcolor="#becdeb">Gelaran : </td>
                        <td width="252" bgcolor="#FFFFFF"><input name="selectGelaran" type="text" id="selectGelaran" value="<?php echo $row_RsPengguna['Gelaran']; ?>" size="35">
                        *
                        </td>
                        <td width="81" bgcolor="#becdeb">Nama Penuh: </td>
                        <td width="317" bgcolor="#FFFFFF"><input name="txtNamaPenuh" type="text" id="txtNamaPenuh" value="<?php echo $row_RsPengguna['NamaPenuh']; ?>" size="45">
                        *
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#becdeb">No KP : </td>
                        <td bgcolor="#FFFFFF"><input name="txtNoKp" type="text" id="txtNoKp" value="<?php echo $row_RsPengguna['NoKp']; ?>" size="35"></td>
                        <td bgcolor="#becdeb">No Hp : </td>
                        <td bgcolor="#FFFFFF"><input name="txtNoHp" type="text" id="txtNoHp" value="<?php echo $row_RsPengguna['NoHp']; ?>" size="35"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#becdeb">Email : </td>
                        <td bgcolor="#FFFFFF"><input name="txtEmail" type="text" id="txtEmail" value="<?php echo $row_RsPengguna['Email']; ?>" size="35">
                        *</td>
                        <td bgcolor="#becdeb"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><input name="txtid" type="hidden" id="txtid" value="<?php echo $row_RsPengguna['id']; ?>"></td>
                      </tr>
                      <tr bgcolor="#becdeb">
                        <td colspan="4"><span class="style1">---- MAKLUMAT JAWATAN </span></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#becdeb">Jawatan : </td>
                        <td bgcolor="#FFFFFF"><input name="txtJawatan" type="text" id="txtJawatan" value="<?php echo $row_RsPengguna['Jawatan']; ?>" size="35"></td>
                        <td bgcolor="#becdeb">Gred : </td>
                        <td bgcolor="#FFFFFF"><input name="txtGred" type="text" id="txtGred" value="<?php echo $row_RsPengguna['Gred']; ?>"></td>
                      </tr>


                      <tr bgcolor="#666666">
                        <td height="17" colspan="4"><span class="style1"><img src="images/arrow.gif" width="12" height="10"> MAKLUMAT BERKAITAN SISTEM (Wajib Isi) </span></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#becdeb">Nama Login : </td>
                        <td bgcolor="#FFFFFF"><input name="txtLogin" type="text" id="txtLogin" value="<?php echo $row_RsPengguna['Login']; ?>">
                        </td>
                        <td bgcolor="#FFCCCC">Kata Laluan : </td>
                        <td bgcolor="#FFCCCC"><input name="txtKLaluan" type="text" id="txtKLaluan">
                          <input type="checkbox" name="checkboxpass" value="KemaskiniPass">
                          <span class="style11">*tanda untuk kemas kini</span></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#becdeb">Kategori : </td>
                        <td bgcolor="#FFFFFF">
                          <select name="selectKategori" id="select">
                            <option selected><?php echo $row_RsPengguna['Kumpulan']; ?></option>
                        <option value="Pengerusi">Pengerusi</option>
                        <option value="Ahli">Ahli</option>
                        <option value="urusetia">Urusetia</option>
                          </select>
                        </td>

                        <td height="17" bgcolor="#becdeb">Kumpulan Ahli : </td>
                        <td bgcolor="#FFFFFF">
                          <select name="selectGroup_id" id="select">
                            <option selected><?php echo $row_RsPengguna['Group_Id']; ?></option>
                            <option value="MMKSN">MMKSN</option>
                            <option value="MMKPPA">MMKPPA</option>
                            <option value="MMTKPPA(P)">MMTKPPA(P)</option>
                            <option value="Lembaga KPPA">Lembaga KPPA</option>
                          </select></td>

                        <td bgcolor="#becdeb">Status : </td>
                        <td bgcolor="#FFFFFF"><select name="selectStatus" id="selectStatus">
                          <option selected><?php echo $row_RsPengguna['Status']; ?></option>
                          <option>Aktif</option>
                          <option>Tidak Aktif</option>
                        </select> </td>
                      </tr>
                      <tr>
                        <td height="17" colspan="4" bgcolor="#becdeb"><span class="style10"> </span></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td colspan="3" bgcolor="#FFFFFF"><span class="style10">
                          <input type="submit" name="Submit" value="Kemaskini" onClick = "if (! confirm('Anda pasti untuk kemaskini pengguna ini?')) return false;">
                        </span></td>
                      </tr>
                      <tr>
                        <td height="17" colspan="4" bgcolor="#FFFFFF"><span class="style10"> </span></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="frmUpdate">
                  </form></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#becdeb"><div align="center" class="style7">| <a href="Utama.php">Muka utama</a>  | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
          </tr>
                        </table></td>
      <td width="38" valign="top" bgcolor="#becdeb" background="images/10241_08.jpg" class="containerright"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="21" valign="top" background="images/10241_25.jpg" class="containerBL"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" background="images/10241_27.jpg" class="containerbottom"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" bgcolor="#becdeb" background="images/10241_29.jpg" class="containerBR"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="0"></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</div>
<?php
mysql_free_result($RsPengguna);
?>
