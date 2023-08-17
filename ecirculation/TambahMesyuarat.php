<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

//if($_SESSION["Kumpulan"] !='urusetia' ){
//		header("Location: Logout.php");
//	};
//edited by zana 1032020
if($_SESSION["kategori"] !='4'  ){
    if($_SESSION["kategori"] !='5' )
	{
    header("Location: Logout.php");
	}
  };
 //  echo $_SESSION["kategori"];
?>
<?php
$editFormAction2 = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction2 .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


echo $stridCipta = $_SESSION["idPengguna"];
$strTrCipta = date("Y-m-j  H:i:s");
$strThn = date("Y");
//  mysql_select_db($database_connspkp, $connspkp);
// $RsSiri = "SELECT max(sirithn+1) as turutan FROM tblmesyuarat";
// $RsUrusanSiri = mysql_query($RsSiri, $connspkp) or die(mysql_error());
// $RsUrusanSiri = mysql_fetch_assoc($RsUrusanSiri);
// $strJum = $RsUrusanSiri["turutan"];

//  mysql_select_db($database_connspkp, $connspkp);
// $RsSiri2 = "select max(siri+1) as resiri  from tblmesyuarat where year(tarikhMesyuarat) = '$strThn'
//             group by year(tarikhMesyuarat)";
// $RsUrusanSiri2 = mysql_query($RsSiri2, $connspkp) or die(mysql_error());
// $RsUrusanSiri2 = mysql_fetch_assoc($RsUrusanSiri2);
//  $siris = $RsUrusanSiri2["resiri"];

//	 $adaSiri2 = mysql_num_rows($RsUrusanSiri2);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInsert")) {

  $strMesyuarat = $_POST['txtMesyuarat'];
  $strTarikh = $_POST['txtTarikh'];
  //  $strMasa=$_POST['txtMasa'];
  // $strTempat=$_POST['txtTempat'];
  //  $strTempat2=$_POST['txtTempat2'];
  // $strTempat3=$_POST['txtTempat3'];
  $strTurutan = $_POST['turutan'];

  //edited zana 10032020
  // $insertSQL = sprintf("INSERT INTO tblmesyuarat (mesyuarat, siri, sirithn,tarikhMesyuarat, masa, tempat, tempat2, tempat3, idCipta, trCipta, status) VALUES ('$strMesyuarat', '$siris','$strJum','$strTarikh','$strMasa', '$strTempat', '$strTempat2','$strTempat3','$stridCipta', '$strTrCipta', 'Ya')");

  echo $insertSQL = sprintf("INSERT INTO tblmesyuarat (TajukMesyuaratID, siri, tarikhMesyuarat, idCipta, trCipta, status) VALUES ('$strMesyuarat', '$strTurutan','$strTarikh','$stridCipta', '$strTrCipta', 'Ya')");
  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($insertSQL, $connspkp) or die(mysql_error());

  include('Logger.php');
  logMe("Tambah mesyuarat: " . $strMesyuarat);

  $insertGoTo = "Mesyuarat.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php include 'include/Popup.php'; ?><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
    function validateForm() {

      if (document.frmInsert.txtMesyuarat.selectedIndex == "") {
        alert("Sila pilih tajuk mesyuarat!");
        return false;
      }

      var x = document.forms["frmInsert"]["txtTarikh"].value;
      if (x == "") {
        alert("Tarikh mesyuarat wajib diisi");
        return false;
      }

      var x = document.forms["frmInsert"]["turutan"].value;
      if (x == "") {
        alert("Bilangan mesyuarat wajib diisi");
        return false;
      }



      return true;

    }

    function getBilanganMesyuarat() {
      var x = document.getElementById("txtTarikh").value;
      var y = document.getElementById("select").value;
      if (x == "") {
        alert("Tarikh mesyuarat wajib diisi");
        return false;
      } else if (y == "") {
        alert("Tajuk mesyuarat wajib diisi");
        return false;
      } else {
        loadXMLDoc(x, y);
      }
    }

    function loadXMLDoc(x, y) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Typical action to be performed when the document is ready:
          document.getElementById("turutan").value = xhttp.responseText;
        }
      };
      xhttp.open("GET", "getbilangamesyuarat.php?x=" + x + "&y=" + y, true);
      xhttp.send();
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
<div align="center">
  <table class="table">
    <!--DWLayoutTable-->
    <tr>
      <td colspan="3" valign="top" align="center"><img src="images/wqs.png"></td>
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
                  <td width="743" height="251" valign="top">
                    <p>
                      <font size="3"><span class="style9">TAMBAH MESYUARAT</span>
                    </p>
                    <form action="<?php echo htmlspecialchars($editFormAction2); ?>" method="POST" name="frmInsert" id="frmInsert" onsubmit="return validateForm()">
                      <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">
                        <!--DWLayoutTable-->
                        <tr>
                          <td width="157" bgcolor="#d8c0be">
                            <font size="2" color="black">Tajuk Mesyuarat :
                          </td>
                          </font>
                          <td bgcolor="#FFFFFF">
                            <select name="txtMesyuarat" id="select">

                              <?php
                              mysql_select_db($database_connspkp, $connspkp);

                             echo $sqlJenisMesy = "SELECT DISTINCT a.id,a.MesyuaratDesc FROM tblreftajukmesyuarat  a
								left join tblmesyuarat b on a.id=b.TajukMesyuaratID
								inner join tbluruspengguna c on a.id=c.TajukMesyuaratID
								where a.actv_Mesyuarat=1 and c.penggunaID='$stridCipta' order by a.MesyuaratDesc  asc";
                              $rsJenisMesy = mysql_query($sqlJenisMesy, $connspkp) or die("Connection Failed!");
                              $itemMesy = ""
                              ?>
                              <option value=" ">Sila Pilih</option>
                              <?php while ($row_rsJenisMesy = mysql_fetch_array($rsJenisMesy)) {
                                if ($itemMesy == $row_rsJenisMesy['id']) { ?>
                                  <option selected value="<?php echo $row_rsJenisMesy['id'] ?>"> <?php echo $row_rsJenisMesy['MesyuaratDesc']  ?> </option>
                                <?php } else { ?>
                                  <option value="<?php echo $row_rsJenisMesy['id'] ?>"> <?php echo $row_rsJenisMesy['MesyuaratDesc']  ?> </option>
                              <?php }
                              }
                              ?>
                            </select>
                            <span style="color:#FF0000">&nbsp;* </span>
                            <!--<td width="584" bgcolor="#FFFFFF"><input name="txtMesyuarat" type="text" id="txtMesyuarat" size="70" readonly="readonly"
                         value="<?php echo "E-Circulation Bil. " . $RsUrusanSiri2["resiri"] . "/" . $strThn; ?>"></td>-->
                          </td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">
                            <font size="2" color="black">Tarikh Mesyuarat :
                          </td>
                          </font>
                          <td bgcolor="#FFFFFF"><input name="txtTarikh" type="text" id="txtTarikh" size="10" /> <a href="javascript:NewCal('txtTarikh','yyyymmdd',false,24)"><img src="images/calendar.png" width="16" height="16" align="absmiddle" alt="Klik untuk paparkan kalendar" style="cursor:pointer" border="none"></a><span style="color:#FF0000">&nbsp;* </span></td>
                        </tr>
                        <!--<tr>
                        <td width="157" bgcolor="#d8c0be">Bilangan Mesyuarat : </td>
                        <td width="584" bgcolor="#FFFFFF"><input name="turutan1" type="text" id="turutan1" size="5" readonly="readonly"
                         value="<?php echo $strJum; ?>"></td>
                      </tr>-->
                        <tr>
                          <td width="157" bgcolor="#d8c0be">
                            <font size="2" color="black">Bilangan Mesyuarat :
                          </td>
                          </font>
                          <td width="584" bgcolor="#FFFFFF"><input name="turutan" type="text" id="turutan" size="5" readonly /><span style="color:#FF0000">&nbsp;* </span>
                            <a href="javascript:void(0)" onclick="getBilanganMesyuarat()">Semak Bil. Mesyuarat</a></td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;
                            </td>
                          <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;
                            </td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;
                            </td>
                          <td bgcolor="#FFFFFF"><span class="style10">
                              <input type="submit" name="Submit" value="Tambah">
                              <input name="Reset" type="reset" id="Reset" value="Reset">
                            </span></td>
                        </tr>
                      </table>
                      <input type="hidden" name="MM_insert" value="frmInsert">
                    </form>
                  </td>
                </tr>
              </table>
              <?php

              if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmInsert")) {

                $strTarikh = $_POST['txtTarikh'];

                $maxRows_RsMesyuarat = 30;
                $pageNum_RsMesyuarat = 0;
                if (isset($_GET['pageNum_RsMesyuarat'])) {
                  $pageNum_RsMesyuarat = $_GET['pageNum_RsMesyuarat'];
                }
                $startRow_RsMesyuarat = $pageNum_RsMesyuarat * $maxRows_RsMesyuarat;

                mysql_select_db($database_connspkp, $connspkp);
                //$query_RsMesyuarat = "SELECT id_cuti,mesyuarat, DATE_FORMAT(tarikhMesyuarat, '%d/%m/%Y') AS tarikhMesyuarat, tempat FROM tblmesyuarat ORDER BY trCipta DESC";
                //$query_RsMesyuarat = "select tblcuti.tkh_mulaC, tblcuti.tkh_akhirC, tblpengguna.NamaPenuh from tblcuti inner join tblpengguna on tblcuti.idAhliC = tblpengguna.id where tblcuti.tkh_mulaC = '$strTarikh' or tblcuti.tkh_akhirC ='$strTarikh'";
                $query_RsMesyuarat = "select tblcuti.tkh_mulaC, tblcuti.tkh_akhirC, tblpengguna.NamaPenuh from tblcuti inner join tblpengguna on tblcuti.idAhliC = tblpengguna.id where '$strTarikh' between tblcuti.tkh_mulaC and tblcuti.tkh_akhirC";
                $query_limit_RsMesyuarat = sprintf("%s LIMIT %d, %d", $query_RsMesyuarat, $startRow_RsMesyuarat, $maxRows_RsMesyuarat);
                $RsMesyuarat = mysql_query($query_limit_RsMesyuarat, $connspkp) or die(mysql_error());
                $row_RsMesyuarat = mysql_fetch_assoc($RsMesyuarat);


                if (isset($_GET['totlaRows_RsMesyuarat'])) {
                  $totlaRows_RsMesyuarat = $_GET['totlaRows_RsMesyuarat'];
                } else {
                  $all_RsMesyuarat = mysql_query($query_RsMesyuarat);
                  $totlaRows_RsMesyuarat = mysql_num_rows($all_RsMesyuarat);
                }
                $totalPages_RsMesyuarat = ceil($totlaRows_RsMesyuarat / $maxRows_RsMesyuarat) - 1;

                $queryString_RsMesyuarat = "";
                if (!empty($_SERVER['QUERY_STRING'])) {
                  $params = explode("&", $_SERVER['QUERY_STRING']);
                  $newParams = array();
                  foreach ($params as $param) {
                    if (
                      stristr($param, "pageNum_RsMesyuarat") == false &&
                      stristr($param, "totlaRows_RsMesyuarat") == false
                    ) {
                      array_push($newParams, $param);
                    }
                  }
                  if (count($newParams) != 0) {
                    $queryString_RsMesyuarat = "&" . htmlentities(implode("&", $newParams));
                  }
                }
                $queryString_RsMesyuarat = sprintf("&totlaRows_RsMesyuarat=%d%s", $totlaRows_RsMesyuarat, $queryString_RsMesyuarat);

              ?>
                <table width="723" border="0" cellpadding="0" cellspacing="0" class="table">
                  <!--DWLayoutTable-->
                  <!--       <tr>
              <td width="721" height="336" valign="top"><p><span class="style9">URUS CUTI </span></p>
               <!--    <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="blueline">
                  <tr bgcolor="#999999">
                    <td width="6%" align="center"><span class="style1">No</span></td>
					<td width="29%"><span class="style1">Nama Ahli</span></td>
                    <td width="29%"><span class="style1">Tarikh Mula Cuti</span></td>
                    <td width="29%"><span class="style1">Tarikh Akhir Cuti</span></td>
                    <!--<td width="19%"><span class="style1">Tindakan</span></td>
                    </tr> -->
                  <?php
                  //2 color rows//////////////////////////////////////////////////////////////////////
                  $color1 = "#CECFFF";
                  $color2 = "#D9ECFF";
                  $row_count = 0;
                  $No = (($pageNum_RsMesyuarat) * $maxRows_RsMesyuarat);

                  //Looping result of RsMesyuarat/////////////////////////////////////////////////
                  do {
                    $No++;
                    $row_color = ($row_count % 2) ? $color1 : $color2;
                  ?>
                    <!--    <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                    <td align="center"><?php echo $No; ?></td>
                    <td><?php echo $row_RsMesyuarat['NamaPenuh']; ?></td>
                    <td><?php echo $row_RsMesyuarat['tkh_mulaC']; ?></td>
					<td><?php echo $row_RsMesyuarat['tkh_akhirC']; ?></td> -->
                    <!-- <td><a href="Cuti.php?deleteid=<?php echo $row_RsMesyuarat['id_cuti']; ?>" onClick = "if (! confirm('Anda pasti untuk hapus Cuti ini?')) return false;" ><img src="images/delete.gif" width="17" height="17" border="0"></a>  <a href="kemasCuti.php?p=<?php echo $row_RsMesyuarat['id_cuti']; ?>" ><img src="images/edit.png" width="18" height="18" border="0"></a></td> -->
          </tr>
        <?php
                    $row_count++;
                  } while ($row_RsMesyuarat = mysql_fetch_assoc($RsMesyuarat));
        ?>
        </table>
        <p align="center">| <a href="<?php printf("%s?pageNum_RsMesyuarat=%d%s", $currentPage, 0, $queryString_RsMesyuarat); ?>">Mula</a> | <a href="<?php printf("%s?pageNum_RsMesyuarat=%d%s", $currentPage, max(0, $pageNum_RsMesyuarat - 1), $queryString_RsMesyuarat); ?>">Sebelum</a> | <a href="<?php printf("%s?pageNum_RsMesyuarat=%d%s", $currentPage, min($totalPages_RsMesyuarat, $pageNum_RsMesyuarat + 1), $queryString_RsMesyuarat); ?>">Selepas</a> | <a href="<?php printf("%s?pageNum_RsMesyuarat=%d%s", $currentPage, $totalPages_RsMesyuarat, $queryString_RsMesyuarat); ?>">Akhir</a> | <br>
          <?php

                /////////////////////////////////////PAGING//////////////////////////////////////////////////////////////////////
                //$strUrusan = $row_RsUrusan['subaktiviti'];

                echo "|";
                for ($i = 0; $i <= $totalPages_RsMesyuarat; $i++) {
                  echo " ";
                  echo "<a href='TambahMesyuarat.php?pageNum_RsMesyuarat=" . $i . "'>" . $i . "</a> ";
                  echo " |";
                };

                ///////////////////////////////////PAGING END//////////////////////////////////////////////////////////////////////////



          ?>
        </p>
      </td>
    </tr>
  </table>
<?php  } ?>
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
  <td height="1"></td>
  <td width="954"></td>
  <td></td>
</tr>
</table>
</div>