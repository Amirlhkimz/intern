<? session_start(); 

if($_SESSION["kategori"] !='4' ){
		header("Location: Logout.php");
	};
?>

<?php require_once('Connections/connspkp.php'); ?>
<?php
$stridPengguna=$_SESSION["idPengguna"];

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
            <td width="204" height="315" valign="top"><?php include 'include/menuadmin.php'; ?></td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="750" height="315" valign="top"><p><span class="style9">LAPORAN SISTEM</span></p>
                  <p><span class="style9"> <img src="images/arrow.gif" width="12" height="10"> Laporan Urusan </span></p>                  
                  </td>
              </tr>
            </table></td>
          </tr>
          <tr bgcolor="#CCCCFE">
            <td height="28" colspan="2" valign="top"><div align="center" class="style7">| <a href="Utama2.php">Muka utama</a> | <a href="EmailUrusetia.php">Emel urus setia</a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
          </tr>
            </table></td>
      <td width="37" valign="top" background="images/10241_08.jpg"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="21" valign="top" background="images/10241_25.jpg"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" background="images/10241_26.jpg" class="containerbottom"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" class="containerBR"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
  </table>
</div>
<?php
?>
