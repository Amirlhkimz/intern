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

$query_RsMesy = "select * from tblreftajukmesyuarat where actv_Mesyuarat=1 order by MesyuaratDesc asc";
mysql_select_db($database_connspkp, $connspkp);
$RsMesy = mysql_query($query_RsMesy, $connspkp) or die(mysql_error());
$row_RsMesy = mysql_fetch_assoc($RsMesy);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInsert")) {

  $strMesyuarat = $_POST['namamesy'];
  $strGroup= $_POST['Rksnmesy'];
  $strTrCipta = date("Y-m-j  H:i:s");

  mysql_select_db($database_connspkp, $connspkp);

  $insertSQL = sprintf("INSERT INTO tblreftajukmesyuarat (MesyuaratDesc, MesyGroup) VALUES 
			('$strMesyuarat', '$strGroup')");

    $Result1 = mysql_query($insertSQL, $connspkp) or die(mysql_error());

    include('Logger.php');
    logMe("Tambah Nama Mesyuarat: " . $strMesyuarat);

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
                      <font size="3"><span class="style9">TAMBAH NAMA MESYUARAT </span>
                    </p>
                    <form action="<?php echo htmlspecialchars($editFormAction); ?>" method="POST" name="frmInsert" id="frmInsert" onsubmit="return validateForm()">
                      <table cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">

                        <tr>
                          <td width="31%" bgcolor="#d8c0be">
                            <font size="2" color="black">Nama Mesyuarat :</font>                          </td>
                          <td bgcolor="#FFFFFF" align="left"><input type="text" name="namamesy" id="namamesy" size="100" /></td>
                        </tr>
                        <tr>
                          <td width="31%" bgcolor="#d8c0be">
                            <font size="2" color="black">Ringkasan :</font>                          </td>
                          <td bgcolor="#FFFFFF" align="left"><input type="text" name="Rksnmesy" id="Rksnmesy" size="25" /></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">&nbsp;</td>
                          <td bgcolor="#FFFFFF"><input type="submit" name="Simpan" value="Simpan">

                            <input type="hidden" name="MM_insert" value="frmInsert"> </td>
                        </tr>
                        <tr>
                          <td bgcolor="#FFFFFF"></td>
                        </tr>
                      </table>
                    </form>
                  </td>
                </tr>
                <tr>
                  <td height="336" valign="top">
                    <table width="900" border="0" cellspacing="1" cellpadding="0" bgcolor="#666666">
                      <tr bgcolor="#999999">
                        <td width="4%" height="34"><strong><span class="style1">No</span></strong></td>
                        <td width="43%"><strong><span class="style1">Nama Mesyuarat </span></strong></td>
                        <td width="20%"><strong><span class="style1">Ringkasan</span></strong></td>
                        <td width="33%"><strong><span class="style1">Tindakan Urusan</span></strong></td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="4">
                          <hr>                        </td>
                      </tr>
                      <?php
                      //2 color rows//////////////////////////////////////////////////////////////////////
                      $color1 = "white";
                      $color2 = "#D9ECFF";
                      $row_count = 0;
                      $pageNum_RsStatusUrusan = '';
                      $maxRows_RsStatusUrusan = '';
                      $No = (($pageNum_RsStatusUrusan) * $maxRows_RsStatusUrusan);

                      //Looping result of RsUrusan/////////////////////////////////////////////////
                      do {

                        $No++;
                        $row_color = ($row_count % 2) ? $color1 : $color2;
                      ?>
                        <tr bgcolor="#FFFFFF" class="style2">
                          <td valign="top"><?php echo $No; ?></td>
                          <td align="left"><?php echo $row_RsMesy['MesyuaratDesc']; ?></td>
                          <td align="left"><?php echo $row_RsMesy['MesyGroup']; ?></td>
                          <td align="center"><a href="kemaskiniNamaMesyuarat.php?p=<?php echo $row_RsMesy['id'];?>"  data-toggle="tooltip" title="Kemaskini Urusan"><img src='images/edit.png' width=18 height=18 border=0></a>&nbsp;&nbsp;<a href="ahliMesyuarat.php?p=<?php echo $row_RsMesy['id'];?>"; data-toggle="tooltip" title="Ahli Mesyuarat"><img src="images/commetee.png" width="18" height="18" border="0"></a>&nbsp;<a href="Utama.php?batalid=<?php echo $row_RsMesy['id']; ?>" onClick = "if (! confirm('Anda pasti untuk Batal Msyuarat?')) return false;"><img src="images/delete.gif" alt="Perhatian! Batal Urusan" width="17" height="17" border="0" data-toggle="tooltip" title="Batal"></a> 
                                             </td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td colspan="4">
                            <hr>                          </td>
                        </tr>
                      <?php
                        $row_count++;
                      } while ($row_RsMesy = mysql_fetch_assoc($RsMesy));
                      ?>
                    </table>
                  </td>
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