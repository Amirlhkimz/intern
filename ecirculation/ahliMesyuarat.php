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
  
 $stridKemaskini=$_SESSION["idPengguna"];

?>

<?php

      if($_POST["p"]<>""){
	     $idMes=$_POST["p"];
		$_SESSION["idMes"]=$idMes;
		 }else {
        $idMes=$_GET["p"];
		$_SESSION["idMes"]=$idMes;
         } 


   // $stridCipta=$_GET["idKemaskini"];
    $strTrCipta=date("Y-m-j  H:i:s");
 
 mysql_select_db($database_connspkp, $connspkp);
 $query_RsMesy = "SELECT *
	 FROM tblreftajukmesyuarat a 
	 WHERE a.id='$idMes'";
$RsMesy = mysql_query($query_RsMesy, $connspkp) or die(mysql_error());
$row_RsMesy = mysql_fetch_assoc($RsMesy);
//$totalRows_RsMesy = mysql_num_rows($RsMesy);
/////////FETCH DATA for rsAhliMesy//////////////////////////////////////////////////////////////////////////////////
$Search='';
if (isset($_POST['txtCari'])){
	$Search=$_POST['txtCari'];
	 $query_rsAhliMesy = "SELECT a.id,c.Gelaran,c.NamaPenuh,c.Login,c.Email,c.Jawatan,a.Susunan,d.Bahagian,e.desc_kategori FROM `tbluruspengguna` a
inner join tblreftajukmesyuarat b on a.TajukMesyuaratID=b.id
INNER join tblpengguna c on a.penggunaID=c.id AND c.Status='Aktif'
left join tblbahagian d on d.id=c.Bahagian
left join tblkategori e on e.id_kategori=a.kategoriID
where a.TajukMesyuaratID ='$idMes'  and a.kategoriID in('1','2') and NamaPenuh LIKE '%$Search%' 
 ORDER BY a.susunan,c.NamaPenuh asc";
}
else if (isset($_GET['txtS'])){
	$Search=$_GET['txtS'];
	echo$query_rsAhliMesy = "SELECT a.id,c.Gelaran,c.NamaPenuh,c.Login,c.Email,c.Jawatan,a.Susunan,d.Bahagian,e.desc_kategori,c.Status FROM `tbluruspengguna` a
inner join tblreftajukmesyuarat b on a.TajukMesyuaratID=b.id
INNER join tblpengguna c on a.penggunaID=c.id AND c.Status='Aktif'
left join tblbahagian d on d.id=c.Bahagian
left join tblkategori e on e.id_kategori=a.kategoriID
where a.TajukMesyuaratID ='$idMes'  and a.kategoriID in('1','2')  and NamaPenuh LIKE '%$Search%' ORDER BY a.susunan,c.NamaPenuh asc ";
}
else {
	$query_rsAhliMesy = "SELECT a.id,c.Gelaran,c.NamaPenuh,c.Login,c.Email,c.Jawatan,a.Susunan,d.Bahagian,e.desc_kategori,c.Status FROM `tbluruspengguna` a
inner join tblreftajukmesyuarat b on a.TajukMesyuaratID=b.id
INNER join tblpengguna c on a.penggunaID=c.id AND c.Status='Aktif'
left join tblbahagian d on d.id=c.Bahagian
left join tblkategori e on e.id_kategori=a.kategoriID
where a.TajukMesyuaratID ='$idMes'  and a.kategoriID in('1','2')  order by a.susunan,c.NamaPenuh asc ";
};
/////////FETCH DATA for rsAhliMesy END//////////////////////////////////////////////////////////////////////////////////


/////////////DELETE User/////////////////////////////////////////////////////////////////
if ((isset($_GET['deleteid'])) && ($_GET['deleteid'] != "")) {
  $deleteid = $_GET['deleteid'];
  $deleteSQL = sprintf("DELETE FROM tbluruspengguna WHERE id='$deleteid'");

  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($deleteSQL, $connspkp) or die(mysql_error());

		include('Logger.php');
		logMe("Hapus pengguna: ".$deleteid);


}
/////////////FINISH DELETE User/////////////////////////////////////////////////////////////////




$maxRows_rsAhliMesy = 20;
$pageNum_rsAhliMesy = 0;
if (isset($_GET['pageNum_rsAhliMesy'])) {
  $pageNum_rsAhliMesy = $_GET['pageNum_rsAhliMesy'];
}
$startRow_rsAhliMesy = $pageNum_rsAhliMesy * $maxRows_rsAhliMesy;

mysql_select_db($database_connspkp, $connspkp);
//$query_rsAhliMesy = "SELECT * FROM tblpengguna ORDER BY Kumpulan";
$query_limit_rsAhliMesy = sprintf("%s LIMIT %d, %d", $query_rsAhliMesy, $startRow_rsAhliMesy, $maxRows_rsAhliMesy);
$rsAhliMesy = mysql_query($query_limit_rsAhliMesy, $connspkp) or die(mysql_error());
$row_rsAhliMesy = mysql_fetch_assoc($rsAhliMesy);
$all_rsAhliMesy = mysql_query($query_rsAhliMesy);

if (isset($_GET['totalRows_rsAhliMesy'])) {
  $totalRows_rsAhliMesy = $_GET['totalRows_rsAhliMesy'];
} else {
  $all_rsAhliMesy = mysql_query($query_rsAhliMesy);
  $totalRows_rsAhliMesy = mysql_num_rows($all_rsAhliMesy);
}
$totalPages_rsAhliMesy = ceil($totalRows_rsAhliMesy/$maxRows_rsAhliMesy)-1;

$queryString_rsAhliMesy = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsAhliMesy") == false &&
		stristr($param, "totalRows_rsAhliMesy") == false &&
        stristr($param, "txtS") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsAhliMesy = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsAhliMesy = sprintf("&totalRows_rsAhliMesy=%d%s&txtS=%s", $totalRows_rsAhliMesy, $queryString_rsAhliMesy, $Search);
?>

<?php include 'include/Popup.php';
include('include/FormatDate.php');

?><head>
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
            <p>&nbsp;</p>            </td>
            <td valign="top" align="center"><table class="table">
                <!--DWLayoutTable-->
                <tr>
                  <td width="743" height="295" valign="top"><p><font size="3"><span class="style9">URUS AHLI MESYUARAT </span><span class="style12"><br>
                    </span></span><span class="style9"><span class="style12"><br>
                    </span><span class="style13"><?php echo $row_RsMesy['MesyuaratDesc'];?></span><span><br /><br /><br /></span><span class="style7">Kriteria carian = &quot;<span class="style9"><span class="style12"><?php echo $Search;?></span></span>&quot; || Sejumlah <strong class="style12"><?php echo mysql_num_rows($all_rsAhliMesy);?></strong> rekod ditemui. </span>
                    </p>
                    <form name="form1" method="post" action="ahliMesyuarat.php">
                      <img src="images/arrow.gif" width="12" height="10"> Cari :
                      <input name="txtCari" type="text" id="txtCari" size="70">
                      <input type="submit" name="Submit" value="Cari">
					 <input type="hidden" name="p" value="<?php echo $idMes;?>">
					  <input type="hidden" name="q" value="<?php echo $idTM;?>">
                    </form>
                    <table width="100%"  border="1" cellpadding="1" cellspacing="1" class="table table-stripe">
                      <tr bgcolor="#897270">
                        <td><font size="2" color="white">Bil</font></td>
                        <td><font size="2" color="white">Nama Penuh </font></td>
			            <td><font size="2" color="white"> Email </font></td>
                        <td><font size="2" color="white">Jawatan</font></td>
                        <td><font size="2" color="white">Bahagian</font></td>
                        <td><font size="2" color="white">Peranan</font></td>
                        <td>&nbsp;</td>
                      </tr>
                      <?php
					  //2 color rows//////////////////////////////////////////////////////////////////////
						$color1 = "white";
						$color2 = "#f9f7f7";
 			   			$row_count = 0;
						$No=(($pageNum_rsAhliMesy)*$maxRows_rsAhliMesy);

  				    	//Looping result of rsAhliMesy/////////////////////////////////////////////////
						do {
  				    	$No++;
    					$row_color = ($row_count % 2) ? $color1 : $color2;
					  ?>
                      <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                        <td><font size="2" color="black"><?php echo $No; ?></td></font>
                        <td><font size="2" color="black"><?php echo $row_rsAhliMesy['Gelaran']; ?><br>                          <?php echo $row_rsAhliMesy['NamaPenuh']; ?></td><td><font size="2" color="black"><strong><?php echo $row_rsAhliMesy['Email']; ?></strong></td>
                        <td><p><font size="2" color="black"><?php echo $row_rsAhliMesy['Jawatan']; ?><br>
						</font>
	                    </p>		              </td>
                        <td><strong><?php echo $row_rsAhliMesy['Bahagian']; ?></strong></td>
                        <td><font size="2" color="black"><?php echo $row_rsAhliMesy['desc_kategori']; ?></font></td>
                        </font>
                        <td><a href="ahliMesyuarat.php?deleteid=<?php echo $row_rsAhliMesy['id']; ?>&p=<?php echo $idMes;?>" onClick = "if (! confirm('Anda pasti untuk padam rekod?')) return false;" ><img src="images/delete.gif" width="17" height="17" border="0"></a><!-- <a href="kemaskiniAhliMesyuarat.php?I=<?php echo $row_rsAhliMesy['id'] ?>"> <img src="images/edit.png" width="16" height="16" border="0"></a>--></td>
                      </tr>
                      <?php
					  $row_count++;
					  } while ($row_rsAhliMesy = mysql_fetch_assoc($rsAhliMesy));
					  ?>
                    </table>
					<table width="100%" border="0">
                    <tr>
                     <td width="19%"><form action="TambahAhliMesyuarat.php" method="post" name="tambahahli">
					<table width="17%" border="0">
  					<tr>
    					<td width="17%">  
						<input type="submit" name="Submit" value="TAMBAH AHLI MESYUARAT">						</td>		
  					</tr>
					</table>
					<input type="hidden" name="p" value="<?php echo $idMes; ?>"> 
					</form></td>
                     <td width="81%"><form action="kemaskiniAhliMesyuarat.php" method="post" name="kemaskiniPerananAhli">
					<table width="17%" border="0">
  					<tr>
    					<td width="17%">  
						<input type="submit" name="Submit" value="KEMASKINI PERANAN AHLI MESYUARAT">						</td>		
  					</tr>
					</table>
					
					<input type="hidden" name="p" value="<?php echo $idMes; ?>"> 
					</form></td>
                     </tr>
                    </table>

					
					
					

                    <p align="center">| <a href="<?php printf("%s?pageNum_rsAhliMesy=%d%s", $currentPage, 0, $queryString_rsAhliMesy); ?>">Mula </a>| <a href="<?php printf("%s?pageNum_rsAhliMesy=%d%s", $currentPage, max(0, $pageNum_rsAhliMesy - 1), $queryString_rsAhliMesy); ?>">Sebelum</a> | <a href="<?php printf("%s?pageNum_rsAhliMesy=%d%s", $currentPage, min($totalPages_rsAhliMesy, $pageNum_rsAhliMesy + 1), $queryString_rsAhliMesy); ?>">Selepas</a> | <a href="<?php printf("%s?pageNum_rsAhliMesy=%d%s", $currentPage, $totalPages_rsAhliMesy, $queryString_rsAhliMesy); ?>">Akhir</a> |<br>
                        <?php

 /////////////////////////////////////PAGING//////////////////////////////////////////////////////////////////////
				//$strUrusan = $row_RsUrusan['subaktiviti'];

				echo "|";
				for ($i=0; $i<=$totalPages_rsAhliMesy; $i++) {
							echo " ";
							echo "<a href='Pengguna.php?pageNum_rsAhliMesy=".$i."&txtS=".$Search."'>".$i."</a> ";
							echo " |";
				};

///////////////////////////////////PAGING END//////////////////////////////////////////////////////////////////////////
		  ?>
</p>
                      <p>&nbsp;                </p></td>
                </tr>
                              </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#FF8C00"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
          </tr>
                  </table></td>
    </tr>
  </table>
</div>
<?php
mysql_free_result($rsAhliMesy);
?>
