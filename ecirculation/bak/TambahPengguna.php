<?php require_once('Connections/connspkp.php'); ?>
<?
ob_start();
session_start();

if($_SESSION["Kumpulan"] !='urusetia' ){
		header("Location: Logout.php");
	};
?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmTambah")) {

					   $Gelaran=mysql_real_escape_string($_POST['selectGelaran']);
                       $NoKp=$_POST['txtNoKp'];
                       $NamaPenuh=mysql_real_escape_string($_POST['txtNamaPenuh']);
                       $Jawatan=$_POST['txtJawatan'];
                       $Gred=$_POST['txtGred'];
                       $Bahagian=$_POST['selectBahagian'];
                       $NoHp=$_POST['txtNoHp'];
                       $Email=$_POST['txtEmail'];
                       $Login=$_POST['txtLogin'];
                       $KLaluan=(md5($_POST['txtKLaluan']));
                       $Kategori=$_POST['selectKategori'];
                       $Status=$_POST['selectStatus'];
                       $Group_id=$_POST['selectGroup_id'];
					   $Susunan=$_POST['txtSusunan'];

//------------------check user existence & active -----------------------------------------------------------------------------//
		  mysql_select_db($database_connspkp, $connspkp);

			$resultcheck = mysql_query("select * from tblpengguna WHERE Login = '$Login' and Status ='aktif' " );
			$myrowscheck = mysql_num_rows($resultcheck);
			if ($myrowscheck  > 0) {

				echo("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Maaf, Login yang didaftarkan telah wujud dan pengguna tersebut masih aktif. Sila daftar Login yang baru')
				</SCRIPT>");

								}
//------------------check user existence & active -----------------------------------------------------------------------------//
			else{
  					$insertSQL = sprintf("INSERT INTO tblpengguna (Gelaran, NoKp, NamaPenuh, Jawatan, Gred, Bahagian, NoHp, Email, Login, Klaluan, Kumpulan, Status, Susunan, Group_id)
  						VALUES
						('$Gelaran', '$NoKp', '$NamaPenuh', '$Jawatan', '$Gred', '$Bahagian', '$NoHp', '$Email', '$Login', '$KLaluan', '$Kategori', '$Status', '$Susunan', '$Group_id')");


  						mysql_select_db($database_connspkp, $connspkp);
  						$Result1 = mysql_query($insertSQL, $connspkp) or die(mysql_error());

						include('Logger.php');
						logMe("Tambah Pengguna: ".$NamaPenuh);


  						$insertGoTo = "Pengguna.php";
  						if (isset($_SERVER['QUERY_STRING'])) {
    					$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    					$insertGoTo .= $_SERVER['QUERY_STRING'];
  						}
  						header(sprintf("Location: %s", $insertGoTo));
				}
}
?>

<?php
//include 'include/Popup.php';

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
      <td valign="top"><table width="954" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="220" height="338" valign="top"><?php include 'include/menuadmin.php'; ?>
			<p>&nbsp;</p>
			</td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><span class="style9">TAMBAH PENGGUNA </span></p>
                  <form action="<?php echo $editFormAction; ?>" method="POST" name="frmTambah" id="frmTambah">
                    <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="blueline">
                      <!--DWLayoutTable-->
                      <tr bgcolor="#666666">
                        <td colspan="4"><span class="style1"><img src="images/arrow.gif" width="12" height="10"> MAKLUMAT PENGGUNA </span></td>
                      </tr>
                      <tr>
                        <td width="80" bgcolor="#becdeb">Gelaran : </td>
                        <td width="247" bgcolor="#FFFFFF">        <input name="selectGelaran" type="text" id="selectGelaran" size="35">
                        *
                          </td>
                        <td width="79" bgcolor="#becdeb">Nama Penuh: </td>
                        <td width="322" bgcolor="#FFFFFF"><input name="txtNamaPenuh" type="text" id="txtNamaPenuh" size="45">
        * </td>
                      </tr>

                      <tr>
                        <td bgcolor="#becdeb">No KP : </td>
                        <td bgcolor="#FFFFFF"><input name="txtNoKp" type="text" id="txtNoKp" size="35"></td>
                        <td bgcolor="#becdeb">No Hp : </td>
                        <td bgcolor="#FFFFFF"><input name="txtNoHp" type="text" id="txtNoHp" size="35"></td>
                      </tr>

                      <tr>
                        <td bgcolor="#becdeb">Email : </td>
                        <td bgcolor="#FFFFFF"><input name="txtEmail" type="text" id="txtEmail" size="35">
                        *</td>
                        <td bgcolor="#becdeb">No. Susunan: </td>
                        <td bgcolor="#FFFFFF"><input name="txtSusunan" type="text" id="txtSusunan" size="3" maxlength="3"></td>
                      </tr>

                      <tr bgcolor="#becdeb">
                        <td colspan="4"><span class="style1"> ---- MAKLUMAT JAWATAN </span></td>
                      </tr>

                      <tr>
                        <td height="17" bgcolor="#becdeb">Jawatan : </td>
                        <td bgcolor="#FFFFFF"><input name="txtJawatan" type="text" id="txtJawatan" size="35"></td>
                        <td bgcolor="#becdeb">Gred : </td>
                        <td bgcolor="#FFFFFF"><input name="txtGred" type="text" id="txtGred"></td>
                      </tr>

                      <tr>
                        <td height="17" bgcolor="#becdeb">Bahagian : </td>
                        <td bgcolor="#FFFFFF">
                        <select name="selectBahagian" id="selectBahagian">
                          <option>Sila Pilih</option>
                          <option value="Bahagian Perkhidmatan">Bahagian Perkhidmatan</option>
                        </select></td>\

                      </tr>

                      <tr bgcolor="#becdeb">
                        <td height="17" colspan="4"><span class="style1"> ---- MAKLUMAT LANTIKAN </span></td>
                      </tr>

                      <tr bgcolor="#666666">
                        <td height="17" colspan="4"><span class="style1"><img src="images/arrow.gif" width="12" height="10"> MAKLUMAT BERKAITAN SISTEM (Wajib Isi) </span></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#becdeb">Nama Login : </td>
                        <td bgcolor="#FFFFFF"><input name="txtLogin" type="text" id="txtLogin">
        *</td>
                        <td bgcolor="#becdeb">Kata Laluan : </td>
                        <td bgcolor="#FFFFFF"><input name="txtKLaluan" type="text" id="txtKLaluan">
        *</td>
                      </tr>

        <tr>
                  <td height="17" bgcolor="#becdeb">Kategori : </td>
                  <td bgcolor="#FFFFFF">
                      <select name="selectKategori" id="select">
                        <option>Sila Pilih</option>
                        <option value="Pengerusi">Pengerusi</option>
                        <option value="Ahli">Ahli</option>
                        <option value="urusetia">Urusetia</option>
                      </select>
                  </td>

              <td height="17" bgcolor="#becdeb">Kumpulan Ahli : </td>
              <td bgcolor="#FFFFFF"><select name="selectGroup_id" id="select">
                  <option>Sila Pilih</option>
                  <option value="MMKSN">MMKSN</option>
                  <option value="MMKPPA">MMKPPA</option>
                  <option value="MMTKPPA(P)">MMTKPPA(P)</option>
                  <option value="Lembaga KPPA">Lembaga KPPA</option>
                </select></td>


        </tr>
        <tr>
            <td bgcolor="#becdeb">Status : </td>
                        <td bgcolor="#FFFFFF"><select name="selectStatus" id="selectStatus">
                            <option>Aktif</option>
                            <option>Tidak Aktif</option>
                          </select>
                        </td>
        </tr>

                      <tr>
                        <td height="17" colspan="4" bgcolor="#becdeb"><span class="style10"> </span></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td colspan="3" bgcolor="#FFFFFF"><span class="style10">
                          <input type="submit" name="Submit2" value="Tambah">
                          <input type="reset" name="Submit3" value="Batal">
                        </span></td>
                      </tr>
                      <tr>
                        <td height="17" colspan="4" bgcolor="#FFFFFF"><span class="style10"> </span></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="frmTambah">
                  </form></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#becdeb"><div align="center" class="style7">| <a href="Utama.php">Muka utama</a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
          </tr>
                        </table></td>
      <td width="38" valign="top" background="images/10241_08.jpg" class="containerright"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
     <td height="21" valign="top"  background="images/10241_25.jpg" class="containerBL"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top"  background="images/10241_27.jpg" class="containerbottom"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" background="images/10241_29.jpg" class="containerBR"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>

  </table>
</div>
