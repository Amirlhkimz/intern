<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

//edited by zana 932020
//if($_SESSION["Kumpulan"] !='urusetia' ){
//    header("Location: Logout.php");
//  };
if($_SESSION["kategori"] !='5' ){
    header("Location: Logout.php");
  };
 $stridKemaskini=$_SESSION["idPengguna"];
?>

<?php

/////////FETCH DATA for RsPengguna//////////////////////////////////////////////////////////////////////////////////
$Search='';
if (isset($_POST['txtCari'])){
	$Search=$_POST['txtCari'];
	$query_RsPengguna = "SELECT a.id,a.Gelaran,a.NamaPenuh,a.Login,a.Email,a.Jawatan,a.Susunan,c.Bahagian,a.Status FROM tblpengguna a 
left join tblgred  b on a.Gred=b.ID
left join tblbahagian c on a.Bahagian=c.id  WHERE NamaPenuh LIKE '%$Search%' OR Login LIKE '%$Search%' OR Email LIKE '%$Search%'
OR Status LIKE '%$Search%' ORDER BY a.NamaPenuh asc";
}
else if (isset($_GET['txtS'])){
	$Search=$_GET['txtS'];
	$query_RsPengguna = "SELECT a.id,a.Gelaran,a.NamaPenuh,a.Login,a.Email,a.Jawatan,a.Susunan,c.Bahagian,a.Status FROM tblpengguna a 
left join tblgred  b on a.Gred=b.ID
left join tblbahagian c on a.Bahagian=c.id  WHERE NamaPenuh LIKE '%$Search%' OR Login LIKE '%$Search%' OR Email LIKE '%$Search%'
OR Status LIKE '%$Search%' ORDER BY a.NamaPenuh asc";
}
else {
	$query_RsPengguna = "SELECT a.id,a.Gelaran,a.NamaPenuh,a.Login,a.Email,a.Jawatan,a.Susunan,c.Bahagian,a.Status FROM tblpengguna a 
left join tblgred  b on a.Gred=b.ID
left join tblbahagian c on a.Bahagian=c.id ORDER BY a.NamaPenuh asc";
};
/////////FETCH DATA for RsPengguna END//////////////////////////////////////////////////////////////////////////////////


/////////////DELETE User/////////////////////////////////////////////////////////////////
if ((isset($_GET['deleteid'])) && ($_GET['deleteid'] != "")) {
  $deleteid = $_GET['deleteid'];
  $deleteSQL = sprintf("DELETE FROM tblpengguna WHERE id='$deleteid'");

  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($deleteSQL, $connspkp) or die(mysql_error());

		include('Logger.php');
		logMe("Hapus pengguna: ".$deleteid);


}
/////////////FINISH DELETE User/////////////////////////////////////////////////////////////////




$maxRows_RsPengguna = 20;
$pageNum_RsPengguna = 0;
if (isset($_GET['pageNum_RsPengguna'])) {
  $pageNum_RsPengguna = $_GET['pageNum_RsPengguna'];
}
$startRow_RsPengguna = $pageNum_RsPengguna * $maxRows_RsPengguna;

mysql_select_db($database_connspkp, $connspkp);
//$query_RsPengguna = "SELECT * FROM tblpengguna ORDER BY Kumpulan";
$query_limit_RsPengguna = sprintf("%s LIMIT %d, %d", $query_RsPengguna, $startRow_RsPengguna, $maxRows_RsPengguna);
$RsPengguna = mysql_query($query_limit_RsPengguna, $connspkp) or die(mysql_error());
$row_RsPengguna = mysql_fetch_assoc($RsPengguna);
$all_RsPengguna = mysql_query($query_RsPengguna);

if (isset($_GET['totalRows_RsPengguna'])) {
  $totalRows_RsPengguna = $_GET['totalRows_RsPengguna'];
} else {
  $all_RsPengguna = mysql_query($query_RsPengguna);
  $totalRows_RsPengguna = mysql_num_rows($all_RsPengguna);
}
$totalPages_RsPengguna = ceil($totalRows_RsPengguna/$maxRows_RsPengguna)-1;

$queryString_RsPengguna = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsPengguna") == false &&
		stristr($param, "totalRows_RsPengguna") == false &&
        stristr($param, "txtS") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsPengguna = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsPengguna = sprintf("&totalRows_RsPengguna=%d%s&txtS=%s", $totalRows_RsPengguna, $queryString_RsPengguna, $Search);
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
.style12 {color: #FF0000;
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
                  <td width="743" height="295" valign="top"><p><font size="3"><span class="style9">TADBIR PENGGUNA <span class="style12"><br>
                    </span></span><span class="style9"><span class="style12"><br>
                    </span></span><span class="style7">Kriteria carian = &quot;<span class="style9"><span class="style12"><?php echo $Search;?></span></span>&quot; || Sejumlah <strong class="style12"><?php echo mysql_num_rows($all_RsPengguna);?></strong> rekod ditemui. </span>
                    </p>
                    <form name="form1" method="post" action="Pengguna.php">
                      <img src="images/arrow.gif" width="12" height="10"> Cari :
                      <input name="txtCari" type="text" id="txtCari" size="70">
                      <input type="submit" name="Submit" value="Cari">
                    </form>
                    <table width="100%"  border="1" cellpadding="1" cellspacing="1" class="table table-stripe">
                      <tr bgcolor="#897270">
                        <td><font size="2" color="white">Bil</font></td>
                        <td><font size="2" color="white">Nama Penuh </font></td>
			                  <td><font size="2" color="white">Nama Login / Email </font></td>
                        <td><font size="2" color="white">Jawatan/Susunan</font></td>
                        <td><font size="2" color="white">Bahagian</font></td>
                        <td><font size="2" color="white">Status</font></td>
                        <td><font size="2" color="white"></font></td>
                      </tr>
                      <?php
					  //2 color rows//////////////////////////////////////////////////////////////////////
						$color1 = "white";
						$color2 = "#f9f7f7";
 			   			$row_count = 0;
						$No=(($pageNum_RsPengguna)*$maxRows_RsPengguna);

  				    	//Looping result of RsPengguna/////////////////////////////////////////////////
						do {
  				    	$No++;
    					$row_color = ($row_count % 2) ? $color1 : $color2;
					  ?>
                      <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                        <td><font size="2" color="black"><?php echo $No; ?></td></font>
                        <td><font size="2" color="black"><?php echo $row_RsPengguna['Gelaran']; ?><br>                          <?php echo $row_RsPengguna['NamaPenuh']; ?></td></font>
                        <td><font size="2" color="black"><span class="style12"><?php echo $row_RsPengguna['Login']; ?></span><strong><br>
                          <?php echo $row_RsPengguna['Email']; ?></strong></td><td><p><font size="2" color="black"><?php echo $row_RsPengguna['Jawatan']; ?><br>
						</font></p>		                </td>
                        <td><font size="2" color="black"><?php echo $row_RsPengguna['Bahagian']; ?></td></font>
                        </font>
                        <td><font size="2" color="black"><?php echo $row_RsPengguna['Status']; ?></td></font>
                        <td><a href="Pengguna.php?deleteid=<?php echo $row_RsPengguna['id']; ?>" onClick = "if (! confirm('Anda pasti untuk padam rekod?')) return false;" ><img src="images/delete.gif" width="17" height="17" border="0"></a> <a href="KemaskiniPengguna.php?I=<?php echo $row_RsPengguna['id']; ?>"><img src="images/edit.png" width="16" height="16" border="0"></a></td>
                      </tr>
                      <?php
					  $row_count++;
					  } while ($row_RsPengguna = mysql_fetch_assoc($RsPengguna));
					  ?>
                    </table>
                    <p align="center">| <a href="<?php printf("%s?pageNum_RsPengguna=%d%s", $currentPage, 0, $queryString_RsPengguna); ?>">Mula </a>| <a href="<?php printf("%s?pageNum_RsPengguna=%d%s", $currentPage, max(0, $pageNum_RsPengguna - 1), $queryString_RsPengguna); ?>">Sebelum</a> | <a href="<?php printf("%s?pageNum_RsPengguna=%d%s", $currentPage, min($totalPages_RsPengguna, $pageNum_RsPengguna + 1), $queryString_RsPengguna); ?>">Selepas</a> | <a href="<?php printf("%s?pageNum_RsPengguna=%d%s", $currentPage, $totalPages_RsPengguna, $queryString_RsPengguna); ?>">Akhir</a> |<br>
                        <?php

 /////////////////////////////////////PAGING//////////////////////////////////////////////////////////////////////
				//$strUrusan = $row_RsUrusan['subaktiviti'];

				echo "|";
				for ($i=0; $i<=$totalPages_RsPengguna; $i++) {
							echo " ";
							echo "<a href='Pengguna.php?pageNum_RsPengguna=".$i."&txtS=".$Search."'>".$i."</a> ";
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
mysql_free_result($RsPengguna);
?>
