<?php require_once('Connections/connspkp.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
?>
<? session_start();

if($_SESSION["Kumpulan"] !='urusetia' ){
		header("Location: Logout.php");
	};
?>
<?php


/////////////DELETE Mesyuarat/////////////////////////////////////////////////////////////////
if ((isset($_GET['deleteid'])) && ($_GET['deleteid'] != "")) {
  $deleteid = $_GET['deleteid'];
  $deleteSQL = sprintf("DELETE FROM tblmesyuarat WHERE id='$deleteid'");

  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($deleteSQL, $connspkp) or die(mysql_error());

  	logMe("Hapus pengumuman: ".$deleteid);

}
/////////////FINISH DELETE Mesyuarat/////////////////////////////////////////////////////////////////




$maxRows_RsMesyuarat = 30;
$pageNum_RsMesyuarat = 0;
if (isset($_GET['pageNum_RsMesyuarat'])) {
  $pageNum_RsMesyuarat = $_GET['pageNum_RsMesyuarat'];
}
$startRow_RsMesyuarat = $pageNum_RsMesyuarat * $maxRows_RsMesyuarat;

mysql_select_db($database_connspkp, $connspkp);
$query_RsMesyuarat = "SELECT id,mesyuarat, DATE_FORMAT(tarikhMesyuarat, '%d/%m/%Y') AS tarikhMesyuarat, tempat FROM tblmesyuarat ORDER BY trCipta DESC";
$query_limit_RsMesyuarat = sprintf("%s LIMIT %d, %d", $query_RsMesyuarat, $startRow_RsMesyuarat, $maxRows_RsMesyuarat);
$RsMesyuarat = mysql_query($query_limit_RsMesyuarat, $connspkp) or die(mysql_error());
$row_RsMesyuarat = mysql_fetch_assoc($RsMesyuarat);

if (isset($_GET['totlaRows_RsMesyuarat'])) {
  $totlaRows_RsMesyuarat = $_GET['totlaRows_RsMesyuarat'];
} else {
  $all_RsMesyuarat = mysql_query($query_RsMesyuarat);
  $totlaRows_RsMesyuarat = mysql_num_rows($all_RsMesyuarat);
}
$totalPages_RsMesyuarat = ceil($totlaRows_RsMesyuarat/$maxRows_RsMesyuarat)-1;

$queryString_RsMesyuarat = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsMesyuarat") == false &&
        stristr($param, "totlaRows_RsMesyuarat") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsMesyuarat = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsMesyuarat = sprintf("&totlaRows_RsMesyuarat=%d%s", $totlaRows_RsMesyuarat, $queryString_RsMesyuarat);
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
-->
</style>

<div align="center" class="style3">
  <table width="954" border="0" cellpadding="0" cellspacing="0" class="Container">
    <!--DWLayoutTable-->
    <tr>
      <td height="246" colspan="3" valign="top"><img src="images/BANNER_new2.jpg" width="1024" height="246"></td>
    </tr>
    <tr>
      <td width="32" height="409" valign="top" background="images/10241_05.jpg" class="containerleft"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" width="954"><table width="954" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <!--DWLayoutTable-->
        <tr>
          <td height="43" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
        <tr>
          <td width="250" height="338" valign="top"><?php include 'include/menuadmin.php'; ?>
            <br></td>
          <td width="750" valign="top"><table width="723" border="0" cellpadding="0" cellspacing="0" class="mainsec">
            <!--DWLayoutTable-->
            <tr>
              <td width="721" height="336" valign="top"><p><span class="style9">URUS MESYUARAT </span></p>
                <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="blueline">
                  <tr bgcolor="#999999">
                    <td width="6%" align="center"><span class="style1">No</span></td>
                    <td width="29%"><span class="style1">Tarikh Mesyuarat</span></td>
                    <td width="46%"><span class="style1">Tajuk  Mesyuarat</span></td>
                    <td width="19%"><span class="style1">Tindakan</span></td>
                    </tr>
                  <?php
				  //2 color rows//////////////////////////////////////////////////////////////////////
						$color1 = "#CECFFF";
						$color2 = "#D9ECFF";
 			   			$row_count = 0;
						$No=(($pageNum_RsMesyuarat)*$maxRows_RsMesyuarat);

  				    	//Looping result of RsMesyuarat/////////////////////////////////////////////////
						do {
  				    	$No++;
    					$row_color = ($row_count % 2) ? $color1 : $color2;
					  ?>
                  <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                    <td align="center"><?php echo $No; ?></td>
                    <td><?php echo $row_RsMesyuarat['tarikhMesyuarat']; ?></td>
                    <td><?php echo $row_RsMesyuarat['mesyuarat']; ?></td>
                    <td><a href="Mesyuarat.php?deleteid=<?php echo $row_RsMesyuarat['id']; ?>" onClick = "if (! confirm('Anda pasti untuk hapus bilangan Mesyuarat ini?')) return false;" ><img src="images/delete.gif" width="17" height="17" border="0"></a>  <a href="kemasMesyuarat.php?p=<?php echo $row_RsMesyuarat['id']; ?>" ><img src="images/edit.png" width="18" height="18" border="0"></a></td>
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
				for ($i=0; $i<=$totalPages_RsMesyuarat; $i++) {
							echo " ";
							echo "<a href='Mesyuarat.php?pageNum_RsMesyuarat=".$i."'>".$i."</a> ";
							echo " |";
				};

///////////////////////////////////PAGING END//////////////////////////////////////////////////////////////////////////



		  ?>
                </p></td>
            </tr>
          </table></td>
        </tr>
        <tr bgcolor="#becdeb">
          <td height="28" colspan="2" valign="top"><div align="center" class="style7">| <a href="Utama.php">Muka utama</a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)">Tukar Katalaluan</a> | <a href="Logout.php">Keluar sistem</a> | </div></td>
        </tr>
      </table></td>
      <td width="38" valign="top" background="images/10241_08.jpg" class="containerright"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
     <td height="21" valign="top"  background="images/10241_25.jpg" class="containerBL"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top"  background="images/10241_27.jpg" class="containerbottom"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td valign="top" background="images/10241_29.jpg" class="containerBR"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr>
      <td height="1"></td>
      <td width="954"></td>
      <td></td>
    </tr>
  </table>
</div>
<?php
mysql_free_result($RsMesyuarat);
?>
