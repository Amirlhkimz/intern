<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();


if($_SESSION["kategori"] !='5' ){
    if($_SESSION["kategori"] !='4' )
	{
    header("Location: Logout.php");
	}
  };
$stridKemaskini = $_SESSION["idPengguna"];

?>
<?php
/////////FETCH DATA for BATAL urusan//////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['batalid']))  {
  $batalid = $_POST["batalid"];
   $batalSQL = sprintf("update tblreftajukmesyuarat set actv_Mesyuarat =0 WHERE id='$batalid'");

  mysql_select_db($database_connspkp, $connspkp);
  $Result_batalSQL = mysql_query($batalSQL, $connspkp) or die(mysql_error());
};

echo $query_RsMesy = "select * from tblreftajukmesyuarat where id=$_GET[p]";
mysql_select_db($database_connspkp, $connspkp);
$RsMesy = mysql_query($query_RsMesy, $connspkp) or die(mysql_error());
$row_RsMesy = mysql_fetch_assoc($RsMesy);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmUpdate")) {

  $strMesyuarat = $_POST['namamesy'];
  $strGroup= $_POST['Rksnmesy'];
   $id= $_POST['id'];
  $strTrCipta = date("Y-m-j  H:i:s");

  mysql_select_db($database_connspkp, $connspkp);

  $insertSQL = sprintf("update tblreftajukmesyuarat set MesyuaratDesc='$strMesyuarat', MesyGroup='$strGroup' where id='$id'");

    $Result1 = mysql_query($insertSQL, $connspkp) or die(mysql_error());

    include('Logger.php');
    logMe("Kemaskini Nama Mesyuarat: " . $strMesyuarat);

    $insertGoTo = "TambahNamaMesyuarat.php";
    if (isset($_SERVER['QUERY_STRING'])) {
      $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
      $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));

}

?><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    function validateForm() {

 		   var x = document.forms["frmInsert"]["NamaMesy"].value;
  			if (x == "") {
  			   alert("Nama Mesyuarat wajib diisi");
    			return false;
		   }
  </script>

</head>



<style type="text/css">
  <!--
  body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    background-image: url("././images/bgblur.jpg");
    background-size: cover;
  }
  -->
</style>
<link href="myStyle.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/faviconjata.ico">
<style type="text/css">
  <!--
  .style1 {
    color: #FFFFFF
  }

  body,
  td,
  th {
    font-family: Arial;
    font-size: 12px;
  }

  .style9 {
    color: #6699CC
  }
  -->
</style>

<div align="center">
  <table class="table">
    <!--DWLayoutTable-->
    <tr>
      <td colspan="3" valign="top" align="center"><img src="images/wqs.png" /></td>
    </tr>
    <tr>
      <td width="32" height="409" valign="top"></td>
      <td valign="top">
        <table class="table">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="250" height="338" valign="top"><?php if($_SESSION["kategori"] == '4'){include 'include/menuurusetia.php';} else { if($_SESSION["kategori"] == '5')include 'include/menuadmin.php';}  ?>
              <p>&nbsp;</p>
            </td>
            <td valign="top" align="center">
              <table class="table">
                <!--DWLayoutTable-->
                <tr>
                  <td width="743" height="141" valign="top">
                    <p>
                      <font size="3"><span class="style9">KEMASKINI NAMA MESYUARAT </span>                    </p>
                    <form action="<?php echo htmlspecialchars($editFormAction); ?>" method="POST" name="frmUpdate" id="frmUpdate" onsubmit="return validateForm()">
                      <table cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">

                        <tr>
                          <td width="31%" bgcolor="#d8c0be">
                            <font size="2" color="black">Nama Mesyuarat :</font>                          </td>
                          <td bgcolor="#FFFFFF" align="left"><input type="text" name="namamesy" id="namamesy" size="100" value="<?php echo $row_RsMesy['MesyuaratDesc'];?>" /></td>
                        </tr>
                        <tr>
                          <td width="31%" bgcolor="#d8c0be">
                            <font size="2" color="black">Ringkasan :</font>                          </td>
                          <td bgcolor="#FFFFFF" align="left"><input type="text" name="Rksnmesy" id="Rksnmesy" size="25" value="<?php echo $row_RsMesy['MesyGroup'];?>" /></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">&nbsp;</td>
                          <td bgcolor="#FFFFFF"><input type="submit" name="kemaskini" value="kemaskini">

                            <input type="hidden" name="MM_update" value="frmUpdate"> 
							<input type="hidden" name="id" value="<?php echo $row_RsMesy['id'];?>"></td>
                        </tr>
                        <tr>
                          <td bgcolor="#FFFFFF"></td>
                        </tr>
                      </table>
                    </form>
                  </td>
                </tr>
                <tr>
                  <td height="336" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#7d1935">
              <div align="center">| <a href="Utama.php">
                  <font color="white">Muka utama</font>
                </a> | <a href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">
                  <font color="white">Tukar Katalaluan</font>
                </a> | <a href="Logout.php">
                  <font color="white">Keluar sistem</font>
                </a> | </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td height="0"></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</div>

<?php
if (isset($msg) && $msg == true) {
  echo '<script language="javascript">';
  echo 'alert("Rekod telah wujud")';
  echo '</script>';
} ?>