<? session_start(); 

if($_SESSION["Kumpulan"] !='urusetia' ){
		header("Location: Logout.php");
	};
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
.style10 {
	color: #6699CC;
	font-weight: bold;
}
-->
</style>

<div align="center" class="style3">
  <table width="1022" border="0" cellpadding="0" cellspacing="0" class="PAGECONTAINER">
    <!--DWLayoutTable-->
    <tr>
      <td height="246" colspan="3" valign="top"><img src="images/BANNER_new2.jpg" width="1024" height="246"></td>
    </tr>
    <tr>
      <td width="32" height="394" valign="top" bgcolor="#FFFFFF" class="containerleft"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" width="954"><table width="954" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="204" height="323" valign="top"><?php include 'include/menuadmin.php'; ?></td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="750" height="323" valign="top"><p><span class="style9">TAMBAH PENGUMUMAN</span></p>
                  <form name="form1" method="post" action="">
                    <table width="743"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                      <!--DWLayoutTable-->
                      <tr>
                        <td width="123" bgcolor="#CCCCFE">Tajuk : </td>
                        <td width="610" bgcolor="#FFFFFF"><input name="textfield2" type="text" size="70"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#CCCCFE">Kandungan : </td>
                        <td bgcolor="#FFFFFF"><textarea name="textarea" cols="70"></textarea></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><span class="style10">
                          <input type="submit" name="Submit2" value="Tambah">
                          <input type="submit" name="Submit3" value="Batal">
                        </span></td>
                      </tr>
                    </table>
                  </form>
                  <p>&nbsp;</p></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#CCCCFE"><div align="center" class="style7">| <a href="Utama.php">muka utama</a> | <a href="EmailUrusetia.php">Emel urus setia</a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
          </tr>
                        </table></td>
      <td width="38" valign="top" class="containerright"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="21" valign="top"  class="containerBL"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top"  class="containerbottom"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" class="containerBR"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="1"></td>
      <td width="954"></td>
      <td></td>
    </tr>
  </table>
</div>
