<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

if($_SESSION["kategori"] !='5' ){
    if($_SESSION["kategori"] !='4' )
	{
    header("Location: Logout.php");
	}
  };
  $stridKemaskini=$_SESSION["idPengguna"];


?>

<?php
/////////FETCH DATA per Kumpulan//////////////////////////////////////////////////////////////////////////////////
$Search='';
//$Kump='';

if (isset($_POST['txtCari'])){
	$Search=$_POST['txtCari'];
 	$query_RsUrusan = "sselect c.desc_jenisurusan,d.Keterangan,a.*,f.Keterangan as gredjawatann  FROM tblurusan a 
inner join tblmesyuarat b on a.bilMesyuarat=b.id
left join tbljenisurusan c on a.jenis=c.id_jenisurusan 
left join tblgred d on a.GredUrusan=d.ID
left join tblgred f on f.ID=a.gredJawatan
INNER join tblreftajukmesyuarat g on g.id=b.TajukMesyuaratID
and g.actv_Mesyuarat=1 where a.Status != 'BATAL'
and b.TajukMesyuaratID in(SELECT distinct e.TajukMesyuaratID FROM tbluruspengguna e where e.penggunaID='$stridKemaskini' and f.Status='Aktif' group by e.MesyuaratID)
and a.Ringkasan LIKE '%$Search%' 
ORDER BY a.TrCipta DESC";
}
else if($_GET['txtS']!=''){
	$Search=$_GET['txtS'];
	 $query_RsUrusan = "select c.desc_jenisurusan,d.Keterangan,a.*,f.Keterangan as gredjawatann  FROM tblurusan a 
inner join tblmesyuarat b on a.bilMesyuarat=b.id
left join tbljenisurusan c on a.jenis=c.id_jenisurusan 
left join tblgred d on a.GredUrusan=d.ID
left join tblgred f on f.ID=a.gredJawatan
INNER join tblreftajukmesyuarat g on g.id=b.TajukMesyuaratID
and g.actv_Mesyuarat=1 where a.Status != 'BATAL'
and b.TajukMesyuaratID in(SELECT distinct e.TajukMesyuaratID FROM tbluruspengguna e where e.penggunaID='$stridKemaskini' and f.Status='Aktif' group by e.MesyuaratID)
and a.Ringkasan LIKE '%$Search%'
ORDER BY a.TrCipta DESC";
}
/* else if ($_GET['Kump']!='') {
	$Kump=$_GET['Kump'];
	$query_RsUrusan = "SELECT * FROM tblurusan WHERE Kategori='$Kump' ORDER BY TrCipta DESC";
} */
else {
    $query_RsUrusan = "select c.desc_jenisurusan,d.Keterangan,a.*,f.Keterangan as gredjawatann  FROM tblurusan a 
inner join tblmesyuarat b on a.bilMesyuarat=b.id
left join tbljenisurusan c on a.jenis=c.id_jenisurusan 
left join tblgred d on a.GredUrusan=d.ID
left join tblgred f on f.ID=a.gredJawatan
INNER join tblreftajukmesyuarat g on g.id=b.TajukMesyuaratID
and g.actv_Mesyuarat=1 where a.Status != 'BATAL'
and b.TajukMesyuaratID in(SELECT distinct e.TajukMesyuaratID FROM tbluruspengguna e where e.penggunaID='$stridKemaskini' group by e.TajukMesyuaratID) ORDER BY a.TrCipta DESC";
};
/////////FETCH DATA per Kumpulan END//////////////////////////////////////////////////////////////////////////////////

/////////FETCH DATA for BATAL urusan//////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['batalid'])) {
	$batalid=$_GET['batalid'];
  	$TrKemaskini=date("Y-m-j  H:i:s");

	$batalSQL = sprintf("UPDATE tblurusan SET status='BATAL', TrKemaskini='$TrKemaskini', idkemaskini='$stridKemaskini' WHERE id='$batalid'");

  	mysql_select_db($database_connspkp, $connspkp);
  	$Result_batalSQL = mysql_query($batalSQL, $connspkp) or die(mysql_error());


		include('Logger.php');
		logMe("Batal urusan: ".$batalid);


};
/////////FETCH DATA for BATAL urusan END//////////////////////////////////////////////////////////////////////////////////



$maxRows_RsUrusan = 20;
$pageNum_RsUrusan = 0;
if (isset($_GET['pageNum_RsUrusan'])) {
  $pageNum_RsUrusan = $_GET['pageNum_RsUrusan'];
}
$startRow_RsUrusan = $pageNum_RsUrusan * $maxRows_RsUrusan;

mysql_select_db($database_connspkp, $connspkp);
//$query_RsUrusan = "SELECT * FROM tblurusan WHERE Kategori='$Kumpulan' ORDER BY TrCipta DESC";
$query_limit_RsUrusan = sprintf("%s LIMIT %d, %d", $query_RsUrusan, $startRow_RsUrusan, $maxRows_RsUrusan);
$RsUrusan = mysql_query($query_limit_RsUrusan, $connspkp) or die(mysql_error());
$row_RsUrusan = mysql_fetch_assoc($RsUrusan);
$all_RsUrusan = mysql_query($query_RsUrusan);

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
		stristr($param, "totalRows_RsUrusan") == false &&
		stristr($param, "txtS") == false )//&&
     //   stristr($param, "Kump") == false) {
	{//tambah by zana
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RsUrusan = "&" . htmlentities(implode("&", $newParams));
  }
}
//$queryString_RsUrusan = sprintf("&totalRows_RsUrusan=%d%s&txtS=%s&Kump=%s", $totalRows_RsUrusan, $queryString_RsUrusan, $Search, $Kump);
$queryString_RsUrusan = sprintf("&totalRows_RsUrusan=%d%s&txtS=%s", $totalRows_RsUrusan, $queryString_RsUrusan, $Search);//edited by zana 932020
?>

<?php include 'include/Popup.php';
include('include/FormatDate.php');
?><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
</head>

<style>
   #more {display: none;}
</style>


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
<STYLE>

a.morelink {
	text-decoration:none;
	outline: none;
}
.morecontent span {
	display: none;

}
</STYLE>
<link href="myStyle.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/faviconjata.ico">

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {
	font-family: Arial;
	font-size: 12px;
}
.style7 {font-size: 12px;}
body,td,th {
	font-family: Arial;
	font-size: 12px;

}
.style9 {color: #6699CC}
.style10 {color: #FF0000}
.style12 {	color: #FF0000;
	font-weight: bold;
}
-->
</style>


<div align="center">
  <table class="table">
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
            <td valign="top" align="center"><table class="table" border="1" bordercolor=#e5e0da>
              <!--DWLayoutTable-->
              <tr>
                <td  valign="top"><p><font size="2"><span class="style9">MUKA UTAMA / LIHAT URUSAN</span></p>
                  <p><span class="style7">Kriteria carian = &quot;</span><span class="style7"><?php echo $Search?></span><span class="style7">&quot; || Sejumlah</span><span class="style7"> <?php echo mysql_num_rows($all_RsUrusan);?> </span><span class="style7">rekod ditemui.<br>
                   Petunjuk ikon: <img src="images/delete.gif" width="17" height="17"> = Batal Urusan ; <img src="images/s_info.png" width="16" height="16"> = Lihat Perincian Urusan;  </span></p>
                  <form name="form1" method="post" action="Utama.php" >
                    <img src="images/arrow.gif" width="18" height="15"><font size="2"> Cari :</font>
                    <input name="txtCari" type="text" id="txtCari" size="70">
                    <input type="submit" name="Submit" value="Cari">
                    </form>
                  <table width="100%"  border="1" bordercolor=white cellpadding="1" cellspacing="1" class="table table-stripe">
                  <!--DWLayoutTable-->
                      <tr bgcolor="#897270" align="center">
                        <td width="3%"><font size="2" color="white">Bil</font></td>
                        <td width="17%"><font size="2" color="white">Jenis Urusan</font></td>
                        <td width="5%"><font size="2" color="white">Gred Jawatan</font></td>
                        <td width="5%"><font size="2" color="white">Gred Hakiki Pegawai</font></td>
                        <td width="20%"><font size="2" color="white">Ringkasan</font></td>
                        <td width="6%"><font size="2" color="white">Kertas</font></td>
                        <td width="6%"><font size="2" color="white">Status Akhir </font></td>
                        <!--<td width="6%"><font size="2" color="white">Tempoh Buka </font></td>-->
                        <td width="10%"><font size="2" color="white">Tarikh Hantar Urusan <br />Kepada Pengerusi/Ahli</font></td>
                        <td width="10%"><font size="2" color="white">Tarikh Keputusan <br />Pengerusi</font></td>
                        <td width="5%"><font size="2" color="white">Keputusan <br />Pengerusi</font></td>
                        <td width="10%"><font size="2" color="white">Ulasan</font></td>
                        <td width="10%"><font size="2" color="white">Tindakan Urusan </font></td>
                      </tr>
                      <?php
				  	//2 color rows//////////////////////////////////////////////////////////////////////
					$color1 = "white";
					$color2 = "#f9f7f7";
 			   		$row_count = 0;
					$sNoKertas = "";
					$No=(($pageNum_RsUrusan)*$maxRows_RsUrusan);

  				    //Looping result of RsUrusan/////////////////////////////////////////////////
					do {
  				    $No++;
    				$row_color = ($row_count % 2) ? $color1 : $color2;



				  			$idUrusan=$row_RsUrusan['id'];
							$vNoKertas =$row_RsUrusan['bilMesyuarat'];
							mysql_select_db($database_connspkp, $connspkp);
							$querytjk = "SELECT a.id,b.MesyuaratDesc,a.siri,a.sirithn,DATE_FORMAT(a.tarikhMesyuarat, '%d/%m/%Y') as tarikhMesyuarat FROM tblmesyuarat a inner join tblreftajukmesyuarat b on a.TajukMesyuaratID=b.id WHERE a.id='$vNoKertas'";
							$RsCountTjk = mysql_query($querytjk, $connspkp) or die(mysql_error());
							$row_RsCountTjk = mysql_fetch_assoc($RsCountTjk);
						   // $jumMesy=$row_RsCountTjk['sirithn'];
							 $jumMesy=$row_RsCountTjk['siri'];
							 $tkhMesy=$row_RsCountTjk['tarikhMesyuarat'];
							 $mesyDesc=$row_RsCountTjk['MesyuaratDesc'];
							if ($jumMesy<>'') $sirimesy = ' ('. $jumMesy.') '; else $jumMesy = '';
							if ($tkhMesy=='' || $tkhMesy=='00/00/0000' ) $mesy = ''; else $mesy = 'pada '. $tkhMesy;
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
							mysql_select_db($database_connspkp, $connspkp);
							//$query_RsStatusDetails = "SELECT Tempoh,TrTerima,TrSelesai,Keputusan,Ulasan FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
               $query_RsStatusDetails = "SELECT z.TrTerima,z.TrSelesai,z.Keputusan,z.Ulasan,x.kategoriID FROM `tblstatusurusan` z inner join tblurusan y on z.idUrusan=y.id inner join tbluruspengguna x on x.penggunaID=z.idPengguna where z.idUrusan='$idUrusan' and x.kategoriID=1 order by z.id desc";
              $RsStatusDetails = mysql_query($query_RsStatusDetails, $connspkp) or die(mysql_error());
							$row_RsStatusDetails = mysql_fetch_assoc($RsStatusDetails);
							$totalRows_RsStatusDetails = mysql_num_rows($RsStatusDetails);
 // echo "sN: ".$sNoKertas ."vN: ".$vNoKertas;
	// 						$sNoKertas = "mmmm" ;
	// 						$vNoKertas = "sdasfas";
							//Count Cuti from tblStatusUrusan END///////////////////////////////////////////////////////////////////////
							if ($sNoKertas != $vNoKertas)
						{
				  ?>
                   <tr bgcolor="#d8c0be">
                        <td height="33" colspan="13" align="center"><font size="3" color="black"><strong><?php echo $mesyDesc .$sirimesy .$mesy; ?></strong>&nbsp;</font></td>
                      </tr>
                      <tr  align="center" bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                        <td><font size="2" color="black"><?php echo $No; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsUrusan['desc_jenisurusan']; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsUrusan['gredjawatann']; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsUrusan['Keterangan']; ?></font></td>
                        <td><div class="comment more"><?php echo $row_RsUrusan['Ringkasan']; ?></div></td>
                        <td><div align="center"><font size="3" color="black"><a href="<?php echo $row_RsUrusan['Link']; ?>" target="_blank"><i class=" fa fa-file-pdf-o" title=<?php echo $row_RsUrusan['Kertas']; ?>></i></a></font></div></td>
                        <td>
							<div align="center"><strong><span class="style10">
						    <?php
							if ($row_RsUrusan['Status']=='BATAL'){
							echo "BATAL";
							};
							?>
						    </span></strong>
							    <table width="98%"  border="0" cellspacing="0" cellpadding="0">
                              <?php if (($row_RsCountBaru['COUNT(*)'])!=0) { ?>
			                  <tr>
                                <td height="18" bgcolor="#80E474"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"> : <?php echo $row_RsCountBaru['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
                              <?php
						};
						if (($row_RsCountPertimbangan['COUNT(*)'])!=0) {
						?>
			                  <tr>
                                <td height="23" bgcolor="#FC9696"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"> : <?php echo $row_RsCountPertimbangan['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
                              <?php
						};
						if (($row_RsCountSelesai['COUNT(*)'])!=0) {
						?>
			                  <tr>
                                <td bgcolor="#9191FF"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountSelesai['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
			                  <?php };
							  if (($row_RsCountCuti['COUNT(*)'])!=0) {
							  ?>
							  <tr>
                                <td bgcolor="#eaafc9"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/cuti.png" alt="Cuti" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountCuti['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
			                  <?php }; ?>
                                </table>
					    </div></td>
						<?php 
						$trTerima=$row_RsStatusDetails['TrTerima'];
						if($trTerima=="")
							{
								 $tarikhTerima="Belum Hantar";
							}else
						if($trTerima<>"")
						    {
							    $tarikhTerima=format_datetime($trTerima);
							}
						
						$trSelesai=$row_RsStatusDetails['TrSelesai'];
						if($trSelesai=="")
							{
								$tarikhSelesai="Tiada Keputusan";
							}else
						if($trSelesai <>"")
						    {
							    $tarikhSelesai=format_datetime($trSelesai);
							}
						?>
					    <!--<td><font size="2" color="black"><?php echo $row_RsStatusDetails['Tempoh']; ?></font></td>-->
                        <td><font size="2" color="black"><?php echo  $tarikhTerima; ?></font></td>
                        <td><font size="2" color="black"><?php echo  $tarikhSelesai; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsStatusDetails['Keputusan']; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsStatusDetails['Ulasan']; ?></font></td>
                        <td><div align="center"><a href="Utama.php?batalid=<?php echo $row_RsUrusan['id']; ?>" onClick = "if (! confirm('Anda pasti untuk padam rekod?')) return false;"><img src="images/delete.gif" alt="Perhatian! Batal Urusan" width="17" height="17" border="0" data-toggle="tooltip" title="Padam"></a> 
                        <?php
							if ($row_RsUrusan['Status']=='Deraf'){;?>
							<a href="KemaskiniUrusan.php?I=<?php echo $row_RsUrusan['id']; ?>"  data-toggle="tooltip" title="Kemaskini Urusan"><img src='images/edit.png' width=18 height=18 border=0></a>
							<?php }else
							if($row_RsUrusan['Status'] !=='Deraf'){ ?>
							<a href="LihatUrusan.php?I=<?php echo $row_RsUrusan['id']; ?>" target="_blank"><img src="images/s_info.png" alt="Lihat Perincian Urusan" width="16" height="16" border="0" data-toggle="tooltip" title="Papar Urusan"></a>
							<?php
							}
							?>
                      </div></td></tr>
                      <?php  }
					  	  else { ?>
						  <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                        <td><font size="2" color="black"><?php echo $No; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsUrusan['desc_jenisurusan']; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsUrusan['gredjawatann']; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsUrusan['Keterangan']; ?></font></td>
                        <td><div class="comment more"><?php echo $row_RsUrusan['Ringkasan']; ?></div></td>
                        <td><div align="center"><font size="3" color="black"><a href="<?php echo $row_RsUrusan['Link']; ?>" target="_blank"><i class=" fa fa-file-pdf-o" title=<?php echo $row_RsUrusan['Kertas']; ?>></i></a></font></div></td>
                        <td>
							<div align="center"><strong><span class="style10">
						    <?php
							if ($row_RsUrusan['Status']=='BATAL'){
							echo "BATAL";
							};
							?>
						    </span></strong>
							    <table width="98%"  border="0" cellspacing="0" cellpadding="0">
                              <?php if (($row_RsCountBaru['COUNT(*)'])!=0) { ?>
			                  <tr>
                                <td height="18" bgcolor="#80E474"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"> : <?php echo $row_RsCountBaru['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
                              <?php
						};
						if (($row_RsCountPertimbangan['COUNT(*)'])!=0) {
						?>
			                  <tr>
                                <td height="23" bgcolor="#FC9696"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"> : <?php echo $row_RsCountPertimbangan['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
                              <?php
						};
						if (($row_RsCountSelesai['COUNT(*)'])!=0) {
						?>
			                  <tr>
                                <td bgcolor="#9191FF"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountSelesai['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
			                  <?php };
							  if (($row_RsCountCuti['COUNT(*)'])!=0) {
							  ?>
							  <tr>
                                <td bgcolor="#eaafc9"><div align="left" class="style1">
                                    <div align="center"><strong><img src="images/cuti.png" alt="Cuti" width="20" height="20" align="absmiddle"> : <?php echo $row_RsCountCuti['COUNT(*)']; ?></strong></div>
                                </div>                            </td>
                              </tr>
			                  <?php }; ?>
                                </table>
					    </div></td>
					    <!--<td><?php echo $row_RsStatusDetails['Tempoh']; ?></td>-->
                        <td><font size="2" color="black"><?php echo $row_RsStatusDetails['TrTerima']; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsStatusDetails['TrSelesai']; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsStatusDetails['Keputusan']; ?></font></td>
                        <td><font size="2" color="black"><?php echo $row_RsStatusDetails['Ulasan']; ?></font></td>
                        <td><font size="2" color="black"><div align="center"><a href="Utama.php?batalid=<?php echo $row_RsUrusan['id']; ?>" onClick = "if (! confirm('Anda pasti untuk padam rekod?')) return false;" ><img src="images/delete.gif" alt="Perhatian! Batal Urusan" width="17" height="17" border="0" onClick = "if (! confirm('Anda pasti untuk padam rekod?')) return false;" ></a> <a href="LihatUrusan.php?I=<?php echo $row_RsUrusan['id']; ?>" target="_blank"><img src="images/s_info.png" alt="Lihat Perincian Urusan" width="16" height="16" border="0">
                        <?php
							if ($row_RsUrusan['Status']=='Deraf'){;?>
							<a href="KemaskiniUrusan.php?I=<?php echo $row_RsUrusan['id']; ?>"><img src='images/edit.png' width=18 height=18 border=0></a>
							<?php };
							?>
                      </div></td>
                      </tr>
                      <?php
						  }
						  $sNoKertas = $vNoKertas;
				  $row_count++;
				  } while ($row_RsUrusan = mysql_fetch_assoc($RsUrusan));
				  ?>
                  </table>
                                  <p align="center">| <a href="<?php printf("%s?pageNum_RsUrusan=%d%s", $currentPage, 0, $queryString_RsUrusan); ?>">Mula</a> | <a href="<?php printf("%s?pageNum_RsUrusan=%d%s", $currentPage, max(0, $pageNum_RsUrusan - 1), $queryString_RsUrusan); ?>">Sebelum</a> | <a href="<?php printf("%s?pageNum_RsUrusan=%d%s", $currentPage, min($totalPages_RsUrusan, $pageNum_RsUrusan + 1), $queryString_RsUrusan); ?>">Selepas</a> | <a href="<?php printf("%s?pageNum_RsUrusan=%d%s", $currentPage, $totalPages_RsUrusan, $queryString_RsUrusan); ?>">Akhir</a> | <br>
                    <?php

 /////////////////////////////////////PAGING//////////////////////////////////////////////////////////////////////
				//$strUrusan = $row_RsUrusan['subaktiviti'];

				echo "|";
				for ($i=0; $i<=$totalPages_RsUrusan; $i++) {
							echo " ";
							echo "<a href='Utama.php?pageNum_RsUrusan=".$i."&txtS=".$Search."'>".$i."</a>";
							echo " |";
				};

///////////////////////////////////PAGING END//////////////////////////////////////////////////////////////////////////
		  ?>
                  </p>
                  <p>&nbsp;</p></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#7d1935"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
          </tr>
      </table></td>
    </tr>

  </table>
</div>
<?php
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