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
if ((isset($_POST["MM_delete"])) && ($_POST["MM_delete"] == "frmDelete")) {
  $batalid = $_POST["batalid"];
   $batalSQL = sprintf("delete from tbluruspengguna WHERE id='$batalid'");

  mysql_select_db($database_connspkp, $connspkp);
  $Result_batalSQL = mysql_query($batalSQL, $connspkp) or die(mysql_error());
};

$query_RsUrusetia = "SELECT a.id as idUP,b.Gelaran,b.NamaPenuh,c.MesyuaratDesc,d.desc_kategori FROM `tbluruspengguna` a inner join tblpengguna b on a.penggunaID=b.id inner join tblreftajukmesyuarat c on a.TajukMesyuaratID=c.id inner join tblkategori d on a.kategoriID=d.id_kategori where a.kategoriID='4' order by c.MesyuaratDesc asc";
mysql_select_db($database_connspkp, $connspkp);
$RsUrusetia = mysql_query($query_RsUrusetia, $connspkp) or die(mysql_error());
$row_RsUrusetia = mysql_fetch_assoc($RsUrusetia);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInsert")) {

  $strMesyuarat = $_POST['selectJenisMesy'];
  $strPengguna = $_POST['Pengguna'];
  $strTrCipta = date("Y-m-j  H:i:s");
  $strKategori = 4; //4=urusetia

  mysql_select_db($database_connspkp, $connspkp);

  #TODO : check if mesyuaratid AND pengguna exist
   $sqlCheck = "SELECT id FROM tbluruspengguna WHERE penggunaID = $strPengguna AND TajukMesyuaratID = $strMesyuarat and kategoriID=4";
  $RsCheck = mysql_query($sqlCheck, $connspkp);
  $num_rows = mysql_num_rows($RsCheck);

  if ($num_rows == 0) {

    $insertSQL = sprintf("INSERT INTO tbluruspengguna (TajukMesyuaratID, penggunaID, kategoriID, idTrkCipta, trkCipta) VALUES 
			('$strMesyuarat', '$strPengguna','$strKategori','$stridKemaskini', '$strTrCipta')");

    $Result1 = mysql_query($insertSQL, $connspkp) or die(mysql_error());

    include('Logger.php');
    logMe("Tambah Urusetia: " . $strMesyuarat);

    $insertGoTo = "TambahUrusetia.php";
    if (isset($_SERVER['QUERY_STRING'])) {
      $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
      $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
  } else {
    $msg = true;
  }
}

?><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    function validateForm() {

      if (document.frmInsert.selectJenisMesy.selectedIndex == "") {
        alert("Sila pilih Jenis Mesyuarat!");
        return false;
      }

      if (document.frmInsert.Pengguna.selectedIndex == "") {
        alert("Sila pilih urusetia!");
        return false;
      }
      return true;

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

  .style3 {
    font-family: Arial;
    font-size: 12px;
  }

  .style7 {
    font-size: 12px
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
                      <font size="3"><span class="style9">TAMBAH URUSETIA </span>
                    </p>
                    <form action="<?php echo htmlspecialchars($editFormAction); ?>" method="POST" name="frmInsert" id="frmInsert" onsubmit="return validateForm()">
                      <table cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">

                        <tr>
                          <td width="31%" bgcolor="#d8c0be">
                            <font size="2" color="black">Jenis Mesyuarat :</font>
                          </td>
                          <td bgcolor="#FFFFFF" align="left"><select name="selectJenisMesy">
                              <?php
                              mysql_select_db($database_connspkp, $connspkp);
                              $sqlJenisMesy = "SELECT id,MesyuaratDesc FROM tblreftajukmesyuarat ORDER BY MesyuaratDesc ASC";
                              $rsJenisMesy = mysql_query($sqlJenisMesy, $connspkp) or die("Connection Failed!");
                              $itemKategori = "";
                              ?>
                              <option value=" ">Sila Pilih</option>
                              <?php while ($row_rsJenisMesy = mysql_fetch_array($rsJenisMesy)) {
                                if ($itemKategori == $row_rsJenisMesy['id']) { ?>
                                  <option selected value="<?php echo $row_rsJenisMesy['id'] ?>"> <?php echo $row_rsJenisMesy['MesyuaratDesc']  ?> </option>
                                <?php } else { ?>
                                  <option value="<?php echo $row_rsJenisMesy['id'] ?>"> <?php echo $row_rsJenisMesy['MesyuaratDesc']  ?> </option>
                              <?php }
                              }
                              ?>
                            </select></td>
                        </tr>

                        <tr>
                          <td width="31%" bgcolor="#d8c0be">
                            <font size="2" color="black">Nama Urusetia
                          </td>
                          <td bgcolor="#FFFFFF">
                            <select name="Pengguna">
                              <?php
                              mysql_select_db($database_connspkp, $connspkp);
                              $sqlPengguna = "SELECT id, Gelaran, NamaPenuh FROM tblpengguna where Status='Aktif' ORDER BY NamaPenuh ASC";
                              $rsPengguna = mysql_query($sqlPengguna, $connspkp) or die("Connection Failed!");
                              $itemPengguna = "";
                              ?>
                              <option value=" ">Sila Pilih</option>
                              <?php while ($row_rsPengguna = mysql_fetch_array($rsPengguna)) {
                                if ($itemPengguna == $row_rsPengguna['id']) { ?>
                                  <option selected value="<?php echo $row_rsPengguna['id'] ?>"> <?php echo $row_rsPengguna['Gelaran'] . " " . $row_rsPengguna['NamaPenuh']  ?> </option>
                                <?php } else { ?>
                                  <option value="<?php echo $row_rsPengguna['id'] ?>"> <?php echo $row_rsPengguna['Gelaran'] . " " . $row_rsPengguna['NamaPenuh']  ?> </option>
                              <?php }
                              }
                              ?>
                            </select> </td>
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
                        <td width="5%" height="34"><strong><span class="style1">No</span></strong></td>
                        <td width="36%"><strong><span class="style1">Jenis Mesyuarat </span></strong></td>
                        <td width="31%" align="center"><strong><span class="style1">Senarai Urusetia </span></strong></td>
                        <td width="18%"><strong><span class="style1">&nbsp; Peranan </span></strong></td>
                        <td width="10%">&nbsp;</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="5">
                          <hr>
                        </td>
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
                          <td align="left"><?php echo $row_RsUrusetia['MesyuaratDesc']; ?></td>
                          <td align="center"><?php echo $row_RsUrusetia['Gelaran']; ?> <?php echo $row_RsUrusetia['NamaPenuh']; ?></td>


                          <td><strong> &nbsp; <?php echo $row_RsUrusetia['desc_kategori']; ?></strong></td>
                          <td align="center">
                            <form action="<?php echo htmlspecialchars($editFormAction); ?>" method="POST">
                              <input type="hidden" name="MM_delete" value="frmDelete">
                              <input type="hidden" name="batalid" value=" <?php echo $row_RsUrusetia['idUP']; ?>">
                              <input type="submit" name="padam" value="Padam" onClick="if (! confirm('Adakah anda pasti untuk Padam Urusetia ini?'))  return false;"> </form>
                          </td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td colspan="5">
                            <hr>
                          </td>
                        </tr>
                      <?php
                        $row_count++;
                      } while ($row_RsUrusetia = mysql_fetch_assoc($RsUrusetia));
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