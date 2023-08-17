<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();
//edited by zana 932020
//if($_SESSION["Kumpulan"] !='urusetia' ){
//    header("Location: Logout.php");
//  };
if($_SESSION["kategori"] !='4'  ){
    if($_SESSION["kategori"] !='5' )
	{
    header("Location: Logout.php");
	}
  };
 // echo $_SESSION["kategori"];
 $stridKemaskini=$_SESSION["idPengguna"];

?>

<?php

$Search='';
//$Kump='';

if (isset($_POST['txtCari'])){
  $Search=$_POST['txtCari'];
  //edited by zana 09032020
   $query_RsMesyuarat = "select a.id,a.tarikhMesyuarat,b.MesyuaratDesc as mesyuarat,a.siri, year(tarikhMesyuarat) as tahun from tblmesyuarat a inner join tblreftajukmesyuarat b on a.TajukMesyuaratID=b.id inner join tbluruspengguna c on b.id=c.TajukMesyuaratID where a.status='Ya' and c.penggunaID='$stridKemaskini' and b.MesyuaratDesc LIKE '%$Search%' order by a.trCipta desc";
}
else if($_GET['txtCari']!=''){
  $Search=$_GET['txtCari'];
  //edited by zana 09032020
  $query_RsMesyuarat = "select a.id,a.tarikhMesyuarat,b.MesyuaratDesc as mesyuarat,a.siri, year(tarikhMesyuarat) as tahun from tblmesyuarat a inner join tblreftajukmesyuarat b on a.TajukMesyuaratID=b.id inner join tbluruspengguna c on b.id=c.TajukMesyuaratID where a.status='Ya' and c.penggunaID='$stridKemaskini' and b.MesyuaratDesc LIKE '%$Search%' order by a.trCipta desc";
}
/* else if ($_GET['Kump']!='') {
  $Kump=$_GET['Kump'];
  $query_RsUrusan = "SELECT * FROM tblurusan WHERE Kategori='$Kump' ORDER BY TrCipta DESC";
} */
else {
//edited by zana 932020
//  $query_RsMesyuarat = "SELECT * FROM tblmesyuarat ORDER BY TrCipta  DESC";
//edited by zana 09032020
  $query_RsMesyuarat = "select distinct a.id,a.tarikhMesyuarat,b.MesyuaratDesc as mesyuarat,a.siri, year(tarikhMesyuarat) as tahun, a.TajukMesyuaratID from tblmesyuarat a inner join tblreftajukmesyuarat b on a.TajukMesyuaratID=b.id inner join tbluruspengguna c on b.id=c.TajukMesyuaratID where a.status='Ya' and c.penggunaID='$stridKemaskini' order by a.trCipta desc";
};


/////////////DELETE Mesyuarat/////////////////////////////////////////////////////////////////
if ((isset($_GET['deleteid'])) && ($_GET['deleteid'] != "")) {
  $deleteid = $_GET['deleteid'];
  
  $deleteSQL = sprintf("DELETE FROM tblmesyuarat WHERE id='$deleteid'");

  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($deleteSQL, $connspkp) or die(mysql_error());

  	include('Logger.php');
	logMe("Hapus Mesyuarat: ".$deleteid);

}
/////////////FINISH DELETE Mesyuarat/////////////////////////////////////////////////////////////////

$maxRows_RsMesyuarat = 30;
$pageNum_RsMesyuarat = 0;
if (isset($_GET['pageNum_RsMesyuarat'])) {
  $pageNum_RsMesyuarat = $_GET['pageNum_RsMesyuarat'];
}
$startRow_RsMesyuarat = $pageNum_RsMesyuarat * $maxRows_RsMesyuarat;

mysql_select_db($database_connspkp, $connspkp);

$query_limit_RsMesyuarat = sprintf("%s LIMIT %d, %d", $query_RsMesyuarat, $startRow_RsMesyuarat, $maxRows_RsMesyuarat);
$RsMesyuarat = mysql_query($query_limit_RsMesyuarat, $connspkp) or die(mysql_error());
$row_RsMesyuarat = mysql_fetch_assoc($RsMesyuarat);
$totalRows_RsMesyuarat= mysql_num_rows($RsMesyuarat);

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

<?php include 'include/Popup.php'; 
include('include/FormatDate.php');

?>
<head>
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
-->
</style>

<div align="center">
  <table class="table" >
    <!--DWLayoutTable-->
    <tr>
      <td  colspan="3" valign="top" align="center"><img src="images/wqs.png" /></td>
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
            <br></td>
         <td valign="top" align="center"><table class="table">
            <!--DWLayoutTable-->
            <tr>
              <td width="721" height="336" valign="top"><p><font size="3"><span class="style9">URUS MESYUARAT </span></p>
                  <form name="form1" method="post" action="Mesyuarat.php">
                    <img src="images/arrow.gif" width="12" height="10"> Cari :
                    <input name="txtCari" type="text" id="txtCari" size="70">
                    <input type="submit" name="Submit" value="Cari">
                  </form>
                <table width="100%"  border="1" cellpadding="1" cellspacing="1"  class="table table-stripe">
                  <tr bgcolor="#897270" align="center">
                     <td><font size="2" color="white">No</font></td>
                     <td><font size="2" color="white">Tarikh Mesyuarat</font></td>
                     <td><font size="2" color="white">Tajuk Mesyuarat </font></td>
					 <td><font size="2" color="white">No. Siri </font></td>
					  <td><font size="2" color="white">Tahun </font></td>
                    <td><font size="2" color="white">Tindakan Urusan </font></td>
                    </tr>
                  <?php
				  //2 color rows//////////////////////////////////////////////////////////////////////
						$color1 = "white";
						$color2 = "#f9f7f7";
 			   			$row_count = 0;
					    $No=(($pageNum_RsMesyuarat)*$maxRows_RsMesyuarat);
                    if($totalRows_RsMesyuarat>0)
					{
  				    	//Looping result of RsMesyuarat/////////////////////////////////////////////////
						do {
  				    	$No++;
    					$row_color = ($row_count % 2) ? $color1 : $color2;
					  ?>
                  <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                    <td align="center"><font size="2" color="black"><?php echo $No; ?></td></font>
                    <td align="center"><font size="2" color="black"><?php echo format_date($row_RsMesyuarat['tarikhMesyuarat']); ?></td></font>
					<td align="center"><font size="2" color="black"><?php echo $row_RsMesyuarat['mesyuarat']; ?></td></font>
					    <td align="center"><font size="2" color="black"><?php echo $row_RsMesyuarat['siri']; ?></td></font>
						<td align="center"><font size="2" color="black"><?php $timestamp = strtotime($row_RsMesyuarat['tarikhMesyuarat']);
									echo date("Y", $timestamp);  ?></td></font>
									
                    <td align="center"><!--<a href="Mesyuarat.php?deleteid=<?php echo $row_RsMesyuarat['id']; ?>" onClick = "if (! confirm('Anda pasti untuk hapus bilangan Mesyuarat ini?')) return false;" data-toggle="tooltip" title="Hapus" ><img src="images/delete.gif" width="17" height="17" border="0"></a> --> <a href="kemasMesyuarat.php?p=<?php echo $row_RsMesyuarat['id'];?>";  data-toggle="tooltip" title="Kemaskini"><img src="images/edit.png" width="18" height="18" border="0"></a> <!-- <a href="ahliMesyuarat.php?p=<?php echo $row_RsMesyuarat['TajukMesyuaratID'];?>"; data-toggle="tooltip" title="Ahli Mesyuarat"><img src="images/commetee.png" width="22" height="15" border="0"></a> --></td>
					<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
                    </tr>
                  <?php
				  $row_count++;
				  } while ($row_RsMesyuarat = mysql_fetch_assoc($RsMesyuarat));
				}//close if($No>0)  
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
        <tr bgcolor="#7d1935">
          <td height="28" colspan="2" valign="top"><div align="center" class="style7">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
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
<?php
mysql_free_result($RsMesyuarat);
?>
