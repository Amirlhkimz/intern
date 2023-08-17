<?php require_once('Connections/connspkp.php'); ?>
<?php
session_start();

if($_SESSION["Kumpulan"] !='Suruhanjaya' ){
	if($_SESSION["Kumpulan"] !='Pengerusi' ){
		header("Location: Logout.php");
		}
	};
?>
<?php
require_once('Mail.php');

if (isset($_POST['txtEmail']))
//if "email" is filled out, send email
  {

$NamaPenuh2=$_SESSION["Gelaran"].' '.$_SESSION["NamaPenuh"];
//$TrKemaskini=date("Y-m-j  H:i:s");
$strTajuk=$_POST['txtTajuk'];
$strMessage=$_POST['txtEmail'];
$strKategori=$_SESSION["Kumpulan"];
//mysql_select_db($database_connspkp, $connspkp);
$idPengguna=$_SESSION["idPengguna"];


mysql_select_db($database_connspkp, $connspkp);
$query_RsEmail = "SELECT Email FROM tblpengguna WHERE Kumpulan='urusetia' AND Status='Aktif'";
$RsEmail = mysql_query($query_RsEmail, $connspkp) or die(mysql_error());

$to=array();
while($row_RsEmail = mysql_fetch_assoc($RsEmail)){
	//$to = $row_RsEmail['Email'].",".$to;
	$to[] = $row_RsEmail['Email'];
}


mysql_select_db($database_connspkp, $connspkp);
$query_RsEmailPengguna = "SELECT Email FROM tblpengguna WHERE id='$idPengguna' AND Status='Aktif'";
$RsEmailPengguna = mysql_query($query_RsEmailPengguna, $connspkp) or die(mysql_error());

while($row_RsEmailPengguna = mysql_fetch_assoc($RsEmailPengguna)){
	$from = $row_RsEmailPengguna['Email'];
}




  ini_set('SMTP','postmaster.1govuc.gov.my');
  $host = "postmaster.1govuc.gov.my";
  //send email
  //$email = $strMessage ;
  $subject = "(Mail dari eCirculation SPA)".$strTajuk;
  //$message = $strMessage;
  $body = $strMessage;
/*   $headers = "From: $from"."\n";
  $headers .= "Message-Id: <" . md5(uniqid(microtime())) . "@" . "spa.gov.my" . ">\n";
  $headers .= "X-Priority: 1 (Higuest)\n";
  $headers .= "X-MSMail-Priority: High\n";
  $headers .= "Importance: High\n"; */
  //mail($to,$subject,$message,$headers);
  $headers = array('From' => $from,
  'Subject' => $subject,
  'X-Priority'=> 1,
  'X-MSMail-Priority' => 'High',
  'Importance' => 'High');

  $smtp = Mail::factory('smtp',
  array ('host' => $host));

  $mail = $smtp->send($to, $headers, $body);

        echo("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Terima kasih kerana menghubungi urusetia')
				</SCRIPT>");

mysql_free_result($RsEmail);
mysql_free_result($RsEmailPengguna);
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
-->
</style>

<div align="center" class="style3">
  <table width="1022" border="0" cellpadding="0" cellspacing="0" class="PAGECONTAINER">
    <!--DWLayoutTable-->
    <tr>
      <td height="246" colspan="3" valign="top"><img src="images/BANNER_new2.jpg" width="1024" height="246"></td>
    </tr>
    <tr>
      <td width="32" height="342" valign="top" background="images/10241_05.jpg" class="containerleft"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" width="955"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="250" height="315" valign="top"><?php include 'include/menuuser.php'; ?></td>
            <td width="750" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainsec">
              <!--DWLayoutTable-->
              <tr>
                <td width="750" height="315" valign="top"><p><span class="style9">EMEL KEPADA URUS SETIA </span></p>
                  <form action="EmailUrusetia.php" method="POST" name="frmMail" id="frmMail">
                    <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                      <!--DWLayoutTable-->
                      <tr>
                        <td width="123" bgcolor="#becdeb">Tajuk : </td>
                        <td width="610" bgcolor="#FFFFFF"><input name="txtTajuk" type="text" id="txtTajuk" size="70"></td>
                      </tr>
                      <tr>
                        <td valign="top" bgcolor="#becdeb">Mesej : </td>
                        <td bgcolor="#FFFFFF"><textarea name="txtEmail" cols="70" rows="10" id="txtEmail"></textarea></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><span class="style10">
                          <input name="Email" type="submit" id="Email" value="Emel">
                          <input name="Reset" type="reset" id="Reset" value="Reset">
                        </span></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="frmInsert">
					</form>
                  <p>Atau hubungi kami di alamat berikut :</p>
                  <p>SETIAUSAHA BAHAGIAN <br>
  URUS SETIA SURUHANJAYA PERKHIDMATAN AWAM MALAYSIA<br>
  ARAS 10, BLOK C7, KOMPLEKS C<br>
  PUSAT PENTADBIRAN KERAJAAN PERSEKUTUAN<br>
  62520 W.P.PUTRAJAYA </p>
                  <p>TEL : 03-88856335<br>
  FAX : 03-88885037 </p>
                  <p>&nbsp;</p></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#becdeb"><div align="center" class="style7">| <a href="Utama2.php">Muka utama</a> | <a href="EmailUrusetia.php">Emel urus setia</a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
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
      <td height="1"></td>
      <td width="954"></td>
      <td></td>
    </tr>
  </table>
</div>
