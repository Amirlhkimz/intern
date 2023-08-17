<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

//if($_SESSION["Kumpulan"] !='urusetia' ){
//    header("Location: Logout.php");
//  };

if($_SESSION["kategori"] !='5' ){
    header("Location: Logout.php");
  };
 // $stridKemaskini=$_SESSION["idPengguna"];
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


         $stridCipta=$_SESSION["idPengguna"];
         $strTrCipta=date("Y-m-j  H:i:s");


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInsert")) {

           $strTajuk=$_POST['txtTajuk'];
         $strKandungan=$_POST['txtKandungan'];
  $insertSQL = sprintf("INSERT INTO tblpengumuman (Tajuk, Kandungan, idCipta, trCipta, status) VALUES ('$strTajuk', '$strKandungan', '$stridCipta', '$strTrCipta', 'papar')");






  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($insertSQL, $connspkp) or die(mysql_error());

  		include('Logger.php');
		logMe("Tambah pengumuman: ".$strTajuk);


  $insertGoTo = "Pengumuman.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
.style10 {
	color: #6699CC;
	font-weight: bold;
}
-->
</style>

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
            <td width="250" height="338" valign="top"><?php if($_SESSION["kategori"] == '4'){include 'include/menuurusetia.php';} else { if($_SESSION["kategori"] == '5')include 'include/menuadmin.php';}  ?>
            <p>&nbsp;</p>
            </td>
            <td valign="top" align="center"><table class="table">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><font size="3"><span class="style9">TAMBAH PENGUMUMAN</span></p>
                  <form action="<?php echo $editFormAction; ?>" method="POST" name="frmInsert" id="frmInsert">
                    <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">
                      <!--DWLayoutTable-->
                      <tr>
                        <td width="123" bgcolor="#d8c0be"><font size="2" color="black">Tajuk : </td></font>
                        <td width="610" bgcolor="#FFFFFF"><input name="txtTajuk" type="text" id="txtTajuk" size="70"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#d8c0be"><font size="2" color="black">Kandungan : </td></font>
                        <td bgcolor="#FFFFFF"><textarea name="txtKandungan" cols="72" id="txtKandungan"></textarea></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><span class="style10">
                          <input type="submit" name="Submit2" value="Tambah">
                          <input name="Reset" type="reset" id="Reset" value="Reset">
                        </span></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="frmInsert">
                  </form>
                  <p>&nbsp;</p></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#FF8C00"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
          </tr>
                        </table></td>
    </tr>
    <tr>
      <td height="1"></td>
      <td width="954"></td>
      <td></td>
    </tr>
  </table>
</div>
