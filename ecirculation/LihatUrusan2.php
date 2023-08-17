<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

if($_SESSION["kategori"] !='2' ){
	if($_SESSION["kategori"] !='1' ){
		header("Location: Logout.php");
		}
	};
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
 //require_once('Connections/connspkp.php'); ?>


<?php
$idPengguna=$_SESSION["idPengguna"];
/////////FETCH DATA//////////////////////////////////////////////////////////////////////////////////
$Search='';
$strCari='';
$Status='';
if (isset($_POST['txtCari'])){
	$Search=$_POST['txtCari'];
	$strCari=$Search;
	 $query_RsStatusUrusan = "select h.id as idStatUrusan, c.desc_jenisurusan,d.Keterangan,a.*,h.Tempoh,h.TrTerima,h.TrSelesai,h.Keputusan,h.Ulasan FROM tblstatusurusan h inner join tblurusan a on a.id= h.idUrusan inner join tblmesyuarat b on a.bilMesyuarat=b.id left join tbljenisurusan c on a.jenis=c.id_jenisurusan left join tblgred d on a.GredUrusan=d.ID INNER join tblreftajukmesyuarat g on g.id=b.TajukMesyuaratID and g.actv_Mesyuarat=1 where h.idPengguna = '$idPengguna' AND a.status !='BATAL' and a.Ringkasan like '%$strCari%' ORDER BY a.id desc";

}
else if (isset($_GET['txtS'])){
	$Search=$_GET['txtS'];
	$strCari=$Search;
 	 $query_RsStatusUrusan = "select h.id as idStatUrusan,c.desc_jenisurusan,d.Keterangan,k.Keterangan as gredJawatann,  a.*,h.Tempoh,h.TrTerima,h.TrSelesai,h.Keputusan,h.Ulasan,h.Status FROM tblstatusurusan h inner join tblurusan a on a.id= h.idUrusan inner join tblmesyuarat b on a.bilMesyuarat=b.id left join tbljenisurusan c on a.jenis=c.id_jenisurusan left join tblgred d on a.GredUrusan=d.ID left join tblgred k on a.gredJawatan=k.ID INNER join tblreftajukmesyuarat g on g.id=b.TajukMesyuaratID and g.actv_Mesyuarat=1 where h.idPengguna = '$idPengguna' AND a.status !='BATAL' and a.Ringkasan like '%$strCari%' ORDER BY a.id desc";


}
else if (isset($_GET['stat'])) {
	$Status=$_GET['stat'];

       $query_RsStatusUrusan = "select h.id as idStatUrusan,c.desc_jenisurusan,d.Keterangan,k.Keterangan as gredJawatann,  a.*,h.Tempoh,h.TrTerima,h.TrSelesai,h.Keputusan,h.Ulasan,h.Status FROM tblstatusurusan h inner join tblurusan a on a.id= h.idUrusan inner join tblmesyuarat b on a.bilMesyuarat=b.id left join tbljenisurusan c on a.jenis=c.id_jenisurusan left join tblgred d on a.GredUrusan=d.ID left join tblgred k on a.gredJawatan=k.ID INNER join tblreftajukmesyuarat g on g.id=b.TajukMesyuaratID and g.actv_Mesyuarat=1 where h.idPengguna = '$idPengguna' AND h.Status='$Status' AND a.status !='BATAL' ORDER BY a.id desc";

}
else {
	 // $query_RsStatusUrusan = "SELECT tblurusan.*, tblstatusurusan.* FROM tblurusan, tblstatusurusan WHERE idPengguna = '$idPengguna' AND tblurusan.id = tblstatusurusan.idUrusan AND tblurusan.status !='BATAL' ORDER BY tblurusan.id desc";
	  $query_RsStatusUrusan = "select h.id as idStatUrusan,c.desc_jenisurusan,d.Keterangan,k.Keterangan as gredJawatann,  a.*,h.Tempoh,h.TrTerima,h.TrSelesai,h.Keputusan,h.Ulasan,h.Status FROM tblstatusurusan h inner join tblurusan a on a.id= h.idUrusan inner join tblmesyuarat b on a.bilMesyuarat=b.id left join tbljenisurusan c on a.jenis=c.id_jenisurusan left join tblgred d on a.GredUrusan=d.ID left join tblgred k on a.gredJawatan=k.ID INNER join tblreftajukmesyuarat g on g.id=b.TajukMesyuaratID and g.actv_Mesyuarat=1 where h.idPengguna = '$idPengguna' AND a.status !='BATAL' ORDER BY a.id desc";

};


/////////FETCH DATA END//////////////////////////////////////////////////////////////////////////////////



$maxRows_RsStatusUrusan = 30;
$pageNum_RsStatusUrusan = 0;
if (isset($_GET['pageNum_RsStatusUrusan'])) {
  $pageNum_RsStatusUrusan = $_GET['pageNum_RsStatusUrusan'];
}
$startRow_RsStatusUrusan = $pageNum_RsStatusUrusan * $maxRows_RsStatusUrusan;

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idPengguna = '$idPengguna' ORDER BY TrTerima DESC";
$query_limit_RsStatusUrusan = sprintf("%s LIMIT %d, %d", $query_RsStatusUrusan, $startRow_RsStatusUrusan, $maxRows_RsStatusUrusan);
$RsStatusUrusan = mysql_query($query_limit_RsStatusUrusan, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$all_RsStatusUrusan = mysql_query($query_RsStatusUrusan);


if (isset($_GET['totalRows_RsStatusUrusan'])) {
  $totalRows_RsStatusUrusan = $_GET['totalRows_RsStatusUrusan'];
} else {
  $all_RsStatusUrusan = mysql_query($query_RsStatusUrusan);
  $totalRows_RsStatusUrusan = mysql_num_rows($all_RsStatusUrusan);
}
$totalPages_RsStatusUrusan = ceil($totalRows_RsStatusUrusan/$maxRows_RsStatusUrusan)-1;

$queryString_RsStatusUrusan = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsStatusUrusan") == false &&
		stristr($param, "totalRows_RsStatusUrusan") == false &&
		stristr($param, "stat") == false &&
        stristr($param, "txtS") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsStatusUrusan = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsStatusUrusan = sprintf("&totalRows_RsStatusUrusan=%d%s&stat=%s&txtS=%s", $totalRows_RsStatusUrusan, $queryString_RsStatusUrusan, $Status, $Search);



?>

<?php include 'include/Popup.php';?><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
var text = $('.text-overflow'),
     btn = $('.btn-overflow'),
       h = text[0].scrollHeight; 

if(h > 120) {
	btn.addClass('less');
	btn.css('display', 'block');
}

btn.click(function(e) 
{
  e.stopPropagation();

  if (btn.hasClass('less')) {
      btn.removeClass('less');
      btn.addClass('more');
      btn.text('Show less');

      text.animate({'height': h});
  } else {
      btn.addClass('less');
      btn.removeClass('more');
      btn.text('Show more');
      text.animate({'height': '120px'});
  }  
});
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
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<STYLE>

a.morelink {
	text-decoration:none;
	outline: none;
}
.morecontent span {
	display: none;

}
</STYLE>
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
            <td width="250" height="201" valign="top"><?php include 'include/menuuser.php'; ?>
            <br></td>
            <td valign="top" align="center"><table class="table" border="1" bordercolor=#e5e0da>
              <!--DWLayoutTable-->
              <tr>
                <td width="750" height="201" valign="top"><p><font size="3"><span class="style9">LIHAT URUSAN</span></p>
                  <p><span class="style7">Kriteria carian = &quot;</span><span class="style10"><?php echo $strCari?></span><span class="style7">&quot; || Sejumlah</span><span class="style10"> <?php echo mysql_num_rows($all_RsStatusUrusan);?> </span><span class="style7">rekod ditemui. </span></p>
                  <form name="form1" method="post" action="LihatUrusan2.php">
                    <img src="images/arrow.gif" width="12" height="10"> Cari :
                    <input name="txtCari" type="text" id="txtCari" size="70">
                    <input type="submit" name="Submit" value="Cari">
                  </form>
                  <table width="100%"  border="1" bordercolor=white cellpadding="1" cellspacing="1" class="table table-stripe">
                    <!--DWLayoutTable-->
                    <tr bgcolor="#897270" align="center">
                      <td width="5%"><font size="3" color="white">Bil</font></td>
                      <td width="26%"><font size="3" color="white">Jenis Urusan </font></td>
                      <td width="5%"><font size="3" color="white">Gred Jawatan </font></td>
                     <td width="5%"><font size="3" color="white">Gred Hakiki <br />Pegawai </font></td>
                      
                      <td width="35%"><font size="3" color="white">Ringkasan</font></td>
                      <td width="10%"><font size="3" color="white">Kertas</font></td>
                   <td width="5%"><font size="3" color="white">Status Urusan</font></td>
                        <!--<td width="10%"><font size="3" color="white">Tempoh Buka</span></div></td></font>
                      <td width="5%"><font size="3" color="white"> Tarikh Terima </span></div></td></font>-->
                      <td width="10%"><font size="3" color="white">Tarikh Keputusan</font></td>
                      <td width="10%"><font size="3" color="white">Keputusan </font></td>
                      <td width="10%"><font size="3" color="white">Ulasan </font></td>
                      <!-- <td width="10%"><font size="3" color="white">Maklumbalas</span></div></td></font>
                      <td width="10%"><font size="3" color="white">Tempoh </span></div></td></font>-->
                      <td width="10%"><font size="3" color="white">Status Keseluruhan </font></td>
                      <td width="5%"><font size="3" color="white">Tindakan</span></div></font>   </td>                 </tr>
                    <?php
		    		//2 color rows//////////////////////////////////////////////////////////////////////
					$color1 = "white";
					$color2 = "#f9f7f7";
 			   		$row_count = 0;
					$sNoKertas = "";
					$No=(($pageNum_RsStatusUrusan)*$maxRows_RsStatusUrusan);

  				    //Looping result of RsStatus Urusan/////////////////////////////////////////////////
					do {
  				    $No++;
    				$row_color = ($row_count % 2) ? $color1 : $color2;

							//Get Urusan info from tblurusan///////////////////////////////////////////////////////////////////////
							$idUrusan=$row_RsStatusUrusan['id'];
							$vNoKertas =$row_RsStatusUrusan['bilMesyuarat'];
							mysql_select_db($database_connspkp, $connspkp);
							$querytjk = "SELECT a.id,b.MesyuaratDesc,a.siri,a.sirithn,DATE_FORMAT(a.tarikhMesyuarat, '%d/%m/%Y') as tarikhMesyuarat FROM tblmesyuarat a inner join tblreftajukmesyuarat b on a.TajukMesyuaratID=b.id WHERE a.id='$vNoKertas'";
							$RsCountTjk = mysql_query($querytjk, $connspkp) or die(mysql_error());
							$row_RsCountTjk = mysql_fetch_assoc($RsCountTjk);
							$mesyDesc=$row_RsCountTjk['MesyuaratDesc'];
						    $jumMesy=$row_RsCountTjk['siri'];
							$tkhMesy=$row_RsCountTjk['tarikhMesyuarat'];
							if ($jumMesy<>'') $sirimesy = ' ('. $jumMesy.') '; else $jumMesy = '';
							if ($tkhMesy=='' || $tkhMesy=='00/00/0000' ) $mesy = ''; else $mesy = 'pada '. $tkhMesy;
							$maxRows_RsUrusan = 1;
$pageNum_RsUrusan = 0;
if (isset($_GET['pageNum_RsUrusan'])) {
  $pageNum_RsUrusan = $_GET['pageNum_RsUrusan'];
}
$startRow_RsUrusan = $pageNum_RsUrusan * $maxRows_RsUrusan;

mysql_select_db($database_connspkp, $connspkp);
$query_RsUrusan = "SELECT tblurusan.*, tbljenisurusan.ruj_jenisurusan FROM tblurusan, tbljenisurusan WHERE tblurusan.id='$idUrusan' AND (tblurusan.Jenis=tbljenisurusan.desc_jenisurusan) AND tblurusan.status !='BATAL'";
$query_limit_RsUrusan = sprintf("%s LIMIT %d, %d", $query_RsUrusan, $startRow_RsUrusan, $maxRows_RsUrusan);
$RsUrusan = mysql_query($query_limit_RsUrusan, $connspkp) or die(mysql_error());
$row_RsUrusan = mysql_fetch_assoc($RsUrusan);

if (isset($_GET['totalRows_RsUrusan'])) {
  $totalRows_RsUrusan = $_GET['totalRows_RsUrusan'];
} else {
  $all_RsUrusan = mysql_query($query_RsUrusan);
  $totalRows_RsUrusan = mysql_num_rows($all_RsUrusan);
}
$totalPages_RsUrusan = ceil($totalRows_RsUrusan/$maxRows_RsUrusan)-1;

$queryString_RsUrusan = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RsUrusan") == false &&
        stristr($param, "totalRows_RsUrusan") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsUrusan = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RsUrusan = sprintf("&totalRows_RsUrusan=%d%s", $totalRows_RsUrusan, $queryString_RsUrusan);

							if ($totalRows_RsUrusan>0){
								if (($row_RsStatusUrusan['Status'])!='Selesai') {

									$strMula=$row_RsStatusUrusan['TrTerima'];
									$strKini=date("Y-m-j  H:i:s");
									//$strKini=$row_RsStatusUrusan['TrKemaskini'];

									$date_diff = abs(strtotime($strMula)-strtotime($strKini)) / 86400;

								}

								else if (($row_RsStatusUrusan['Status'])=='BATAL') {

									$strMula=$row_RsStatusUrusan['TrTerima'];
									$strKini=$row_RsStatusUrusan['TrSelesai'];

									$date_diff = abs(strtotime($strMula)-strtotime($strKini)) / 86400;

								}

								else  {

									$strMula=$row_RsStatusUrusan['TrTerima'];
									$strKini=$row_RsStatusUrusan['TrSelesai'];
									//$strKini=date("Y-m-j  H:i:s");

									$date_diff = abs(strtotime($strMula)-strtotime($strKini)) / 86400;

								};
							}
							else {
							$date_diff=0;
							};

							//Get Urusan info from tblurusan END///////////////////////////////////////////////////////////////////////
							//Count Baru from tblStatusUrusan///////////////////////////////////////////////////////////////////////
							mysql_select_db($database_connspkp, $connspkp);
							$query_RsCountBaru = "SELECT COUNT(*) FROM tblstatusurusan WHERE idUrusan='$idUrusan' AND Status='Baru'";
							$RsCountBaru = mysql_query($query_RsCountBaru, $connspkp) or die(mysql_error());
							$row_RsCountBaru = mysql_fetch_assoc($RsCountBaru);
							$totalRows_RsCountBaru = mysql_num_rows($RsCountBaru);

							//Count Baru from tblStatusUrusan END///////////////////////////////////////////////////////////////////////
							//Count Pertimbangan from tblStatusUrusan///////////////////////////////////////////////////////////////////////
							mysql_select_db($database_connspkp, $connspkp);
							$query_RsCountPertimbangan = "SELECT COUNT(*) FROM tblstatusurusan WHERE idUrusan='$idUrusan' AND Status='Pertimbangan'";
							$RsCountPertimbangan = mysql_query($query_RsCountPertimbangan, $connspkp) or die(mysql_error());
							$row_RsCountPertimbangan = mysql_fetch_assoc($RsCountPertimbangan);
							$totalRows_RsCountPertimbangan = mysql_num_rows($RsCountPertimbangan);

							//Count Pertimbangan from tblStatusUrusan END///////////////////////////////////////////////////////////////////////
							//Count Selesai from tblStatusUrusan///////////////////////////////////////////////////////////////////////
							mysql_select_db($database_connspkp, $connspkp);
							$query_RsCountSelesai = "SELECT COUNT(*) FROM tblstatusurusan WHERE idUrusan='$idUrusan' AND Status='Selesai'";
							$RsCountSelesai = mysql_query($query_RsCountSelesai, $connspkp) or die(mysql_error());
							$row_RsCountSelesai = mysql_fetch_assoc($RsCountSelesai);
							$totalRows_RsCountSelesai = mysql_num_rows($RsCountSelesai);

							//Count Selesai from tblStatusUrusan END///////////////////////////////////////////////////////////////////////
							//Count Cuti from tblStatusUrusan///////////////////////////////////////////////////////////////////////
							mysql_select_db($database_connspkp, $connspkp);
							$query_RsCountCuti = "SELECT COUNT(*) FROM tblstatusurusan WHERE idUrusan='$idUrusan' AND Status='Cuti'";
							$RsCountCuti = mysql_query($query_RsCountCuti, $connspkp) or die(mysql_error());
							$row_RsCountCuti = mysql_fetch_assoc($RsCountCuti);
							$totalRows_RsCountCuti = mysql_num_rows($RsCountCuti);

							//Get Data from tblstatusurusan
						//	mysql_select_db($database_connspkp, $connspkp);
					//		$query_RsStatusDetails = "SELECT Tempoh,TrTerima,TrSelesai,Keputusan,Ulasan FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
					//		$RsStatusDetails = mysql_query($query_RsStatusDetails, $connspkp) or die(mysql_error());
						//	$row_RsStatusDetails = mysql_fetch_assoc($RsStatusDetails);
						//	$totalRows_RsStatusDetails = mysql_num_rows($RsStatusDetails);

							//Count Cuti from tblStatusUrusan END///////////////////////////////////////////////////////////////////////

					if ($sNoKertas != $vNoKertas)
						{
 
					?>
                    <tr bgcolor="#d8c0be">
                      <td height="32" colspan="16" align="center"><font size="3" color="black"><strong><?php echo $mesyDesc .$sirimesy .$mesy; ?></font></td>                     
                    </tr>
                    <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                      <td><font size="3" color="black"><?php echo $No; ?></td>
                      <td><font size="3" color="black"><?php echo $row_RsStatusUrusan['desc_jenisurusan']; ?>  </font>                  </td>
                        <td><font size="3" color="black" ><?php echo $row_RsStatusUrusan['gredJawatann']; ?></font>
                        <div align="center"></div></td>
                      <td><font size="3" color="black"><?php echo $row_RsStatusUrusan['Keterangan']; ?></font></td>
                      <td><div class="comment more"><?php echo $row_RsStatusUrusan['Ringkasan']; ?></div></td>
					  <td><font size="3" color="black"><div align="center"><a href="<?php echo $row_RsStatusUrusan['Link']; ?>" target="_blank"><i class=" fa fa-file-pdf-o" title="<?php echo $row_RsStatusUrusan['Link']; ?>"></i></a></div></font></td>
					  <td><font size="3" color="black"><div align="center">
                          <table width="98%"  border="0" cellspacing="0" cellpadding="0">
                            <?php if (($row_RsStatusUrusan['Status'])=='Baru') { ?>
                            <tr><?php echo $row_RsStatusUrusan['Status'];?>
                              <td bgcolor="#80E474"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="top"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Pertimbangan') {
						?>
                            <tr>
                              <td bgcolor="#FC9696"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="top"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Selesai') {
						?>
                            <tr><?php echo $row_RsStatusUrusan['Status'];?>
                              <td bgcolor="#9191FF"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="top"></strong></div>
                              </div></td>
                            </tr>
							<?php
						};
						if (($row_RsStatusUrusan['Status'])=='Cuti') {
						?>
                            <tr>
                              <td bgcolor="#9191FF"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/cuti.png" alt="Sedang Bercuti" width="20" height="20" align="top"></strong></div>
                              </div></td>
						    </tr>
                            <?php };?>
                          </table>
                      </div></td>
                        <?php 
						$tarikhSelesai=$row_RsStatusUrusan['TrSelesai'];
						if($tarikhSelesai=="0000-00-00 00:00:00") 
						{
						   $trkSelesai=" ";
						}else 
						if($tarikhSelesai<>"0000-00-00 00:00:00") 
						
						  $trkSelesai=$tarikhSelesai;
						?>
                        <td><font size="3" color="black"><?php echo $trkSelesai; ?></font></td>
                        <td><font size="3" color="black"><?php echo $row_RsStatusUrusan['Keputusan']; ?></font></td>
                        <td><font size="3" color="black"><?php echo $row_RsStatusUrusan['Ulasan']; ?></font></td>
                    <!--  <td width="10%"><font size="3" color="black"><div align="center"><strong> <?php echo $row_RsStatusUrusan['Keputusan']; ?><br>
                      </strong></div></font></td>
                      <td width="10%"><font size="3" color="black"><div align="center"><?php echo round($date_diff,0); ?> hari </div></font></td> -->
                        <td width="10%"><table width="98%"  border="1" cellspacing="0" cellpadding="0">
                          <?php if (($row_RsCountBaru['COUNT(*)'])!=0) { ?>
                          <tr>
                           <td height="20" bgcolor="#80E474"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"> : <?php echo $row_RsCountBaru['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsCountPertimbangan['COUNT(*)'])!=0) {
						?>
                          <tr>
                            <td height="24" bgcolor="#FC9696"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"> : <?php echo $row_RsCountPertimbangan['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsCountSelesai['COUNT(*)'])!=0) {
						?>
                          <tr>
                            <td bgcolor="#9191FF"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountSelesai['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
						  <?php
						};
						if (($row_RsCountCuti['COUNT(*)'])!=0) {
						?>
                          <tr>
                            <td bgcolor="#eaafc9"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/cuti.png" alt="Sedang Bercuti" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountCuti['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php };?>
                      </table></td>
                      <td width="5%"><div align="center">
                          <?php if (($row_RsUrusan['Status'])=='BATAL') { ?>
                          <span class="style10"><?php echo "BATAL"; ?></span><br>
                          <?php
						}
						else {
								if ((($row_RsStatusUrusan['Status'])!='Selesai') && (($row_RsStatusUrusan['Status'])!='Cuti') && (($row_RsStatusUrusan['Status'])=='Baru') || (($row_RsStatusUrusan['Status'])=='Pertimbangan')) { ?>
                          <a href="Kemaskini.php?s=<?php echo $row_RsStatusUrusan['id']; ?>&t=<?php echo $row_RsStatusUrusan['idStatUrusan'];?>"><img src="images/edit.png" width="16" height="16" border="0"></a><br>
                          <?php
								};

								if ((($row_RsStatusUrusan['Status'])=='Selesai') || (($row_RsStatusUrusan['Status'])=='Cuti')) { ?>
                          <a href="LaporanKeputusan.php?s=<?php echo $row_RsStatusUrusan['id']; ?>&t=<?php echo $row_RsStatusUrusan['idStatUrusan'];?>"><img src="images/printer.gif" width="21" height="17" border="0"></a> <br />

						  </div></td>
                      <?php };
						}; ?>
                    </tr>
                    <?php
						}
						else {
					?>
                    <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                      <td><font size="3" color="black"><?php echo $No; ?></td>
                      <td><font size="3" color="black"><?php echo $row_RsStatusUrusan['desc_jenisurusan']; ?><br>                     </font> </td>
                      <td><font size="3" color="black"><div align="center"><?php echo $row_RsStatusUrusan['gredJawatann']; ?></div></font> </td>
                      <td><font size="3" color="black"><?php echo $row_RsStatusUrusan['Keterangan']; ?></font></td>
                      
                       <td><div class="comment more"><?php echo $row_RsStatusUrusan['Ringkasan']; ?></div></td>
                      <td><font size="3" color="black"><div align="center"><a href="<?php echo $row_RsStatusUrusan['Link']; ?>" target="_blank"><i class=" fa fa-file-pdf-o" title="<?php echo $row_RsStatusUrusan['Link']; ?>"></i></a></div></font></td>
                      <td>
                          <table width="98%"  border="1" cellspacing="0" cellpadding="0">
                            <?php if (($row_RsStatusUrusan['Status'])=='Baru') { ?>
                            <tr><?php echo $row_RsStatusUrusan['Status'];?>
                              <td bgcolor="#80E474"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="top"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Pertimbangan') {
						?>
                            <tr>
                              <td bgcolor="#FC9696"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="top"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Selesai') {
						?>
                            <tr><?php echo $row_RsStatusUrusan['Status'];?>
                              <td bgcolor="#9191FF"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="top"></strong></div>
                              </div></td>
                            </tr>
							 <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Cuti') {
						?>
                            <tr>
                              <td bgcolor="#eaafc9"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/cuti.png" alt="Sedang Bercuti" width="20" height="20" align="top"></strong></div>
                              </div></td>
						    </tr>
                            <?php };?>
                          </table>
                      </div></td>
                    <!--  <td><font size="3" color="black"><?php echo $row_RsStatusDetails['Tempoh']; ?></font></td>
                        <td><font size="3" color="black"><?php echo $row_RsStatusDetails['TrTerima']; ?></font></td>-->
                        <td><font size="3" color="black"><?php echo $trkSelesai; ?></font></td>
                        <td><font size="3" color="black"><?php echo $row_RsStatusUrusan['Keputusan']; ?></font></td>
                        <td><font size="3" color="black"><?php echo $row_RsStatusUrusan['Ulasan']; ?></font></td>
                      <!--  <td width="10%"><font size="3" color="black"><div align="center"><strong> <?php echo $row_RsStatusUrusan['Keputusan']; ?><br>
                      </strong></div></font></td>
                      <td width="10%"><font size="3" color="black"><div align="center"><?php echo round($date_diff,0); ?> hari </div></font></td>-->
                      <td width="10%"><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                          <?php if (($row_RsCountBaru['COUNT(*)'])!=0) { ?>
                          <tr>
                            <td height="20" bgcolor="#80E474"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"> : <?php echo $row_RsCountBaru['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsCountPertimbangan['COUNT(*)'])!=0) {
						?>
                          <tr>
                            <td height="24" bgcolor="#FC9696"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"> : <?php echo $row_RsCountPertimbangan['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsCountSelesai['COUNT(*)'])!=0) {
						?>
                          <tr>
                            <td bgcolor="#9191FF"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountSelesai['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
						  <?php
						};
						if (($row_RsCountCuti['COUNT(*)'])!=0) {
						?>
                          <tr>
                            <td bgcolor="#eaafc9"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/cuti.png" alt="Sedang Bercuti" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountCuti['COUNT(*)']; ?></strong></div>
                            </div></td>
                          </tr>
                          <?php };?>
                      </table></td>
                      <td width="5%"><div align="center">
                          <?php if (($row_RsUrusan['Status'])=='BATAL') { ?>
                          <span class="style10"><?php echo "BATAL"; ?></span><br>
                          <?php
						}
						else {
								if ((($row_RsStatusUrusan['Status'])!='Selesai') && (($row_RsStatusUrusan['Status'])!='Cuti') && (($row_RsStatusUrusan['Status'])=='Baru') || (($row_RsStatusUrusan['Status'])=='Pertimbangan')) { ?>
                          <a href="Kemaskini.php?s=<?php echo $row_RsStatusUrusan['id'];?>&t=<?php echo $row_RsStatusUrusan['idStatUrusan'];?>"><img src="images/edit.png" width="16" height="16" border="0"></a><br>
                          <?php
								};

								if ((($row_RsStatusUrusan['Status'])=='Selesai') || (($row_RsStatusUrusan['Status'])=='Cuti')) { ?>
                          <a href="LaporanKeputusan.php?s=<?php echo $row_RsStatusUrusan['id']; ?>&t=<?php echo $row_RsStatusUrusan['idStatUrusan'];?>"><img src="images/printer.gif" width="21" height="17" border="0"></a><br />
						  </div></td>
                      <?php };
						}; ?>
                    </tr>
                    <?php
					  }
						  $sNoKertas = $vNoKertas;
				  $row_count++;
				  } while ($row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan));
				  //Loop RsStatusUrusan END//////////////////////////////////////////////////////////////
				  ?>
                  </table>
                  <p align="center">| <a href="<?php printf("%s?pageNum_RsStatusUrusan=%d%s", $currentPage, 0, $queryString_RsStatusUrusan); ?>">Mula</a> | <a href="<?php printf("%s?pageNum_RsStatusUrusan=%d%s", $currentPage, max(0, $pageNum_RsStatusUrusan - 1), $queryString_RsStatusUrusan); ?>">Sebelum</a> | <a href="<?php printf("%s?pageNum_RsStatusUrusan=%d%s", $currentPage, min($totalPages_RsStatusUrusan, $pageNum_RsStatusUrusan + 1), $queryString_RsStatusUrusan); ?>">Selepas</a> | <a href="<?php printf("%s?pageNum_RsStatusUrusan=%d%s", $currentPage, $totalPages_RsStatusUrusan, $queryString_RsStatusUrusan); ?>">Akhir</a> |<br>
                    <?php

 /////////////////////////////////////PAGING//////////////////////////////////////////////////////////////////////
				//$strUrusan = $row_RsUrusan['subaktiviti'];

				echo "|";
				for ($i=0; $i<=$totalPages_RsStatusUrusan; $i++) {
							echo " ";
							echo "<a href='LihatUrusan2.php?pageNum_RsStatusUrusan=".$i."&stat=".$Status."&txtS=".$Search."'>".$i."</a> ";
							echo " |";
				};

///////////////////////////////////PAGING END//////////////////////////////////////////////////////////////////////////
		  ?>
                    <br>
                    <br>
                  </p></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#7d1935"><div align="center">| <a href="Utama2.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
          </tr>
            </table></td>
    </tr>

  </table>
</div>

<?php
mysql_free_result($RsStatusUrusan);
mysql_free_result($RsUrusan);
mysql_free_result($RsCountBaru);
mysql_free_result($RsCountPertimbangan);
mysql_free_result($RsCountSelesai);

?>
<SCRIPT>
$(document).ready(function() {
	var showChar = 100;
	var ellipsestext = "...";
	var moretext = "MORE..";
	var lesstext = "LESS..";
	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreelipses">'+ellipsestext+'</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">'+moretext+'</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
});
</SCRIPT>