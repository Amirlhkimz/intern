<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

	
if($_SESSION["kategori"] !='2' ){
	if($_SESSION["kategori"] !='1' ){
		header("Location: Logout.php");
		}
	};	
	
?>

<?php
//var_dump($_SESSION["Kumpulan"]);
;?>

<?php
include('include/FusionCharts.php');
include('include/FC_Colors.php');
include('include/FormatDate.php');

$idUrusan= $_GET['s'];
$idStatusUrusan = $_GET['t'];
$idPengguna = $_SESSION["idPengguna"];
$date_diff="";

mysql_select_db($database_connspkp, $connspkp);
						
$query_RsStatusUrusan = " SELECT b.desc_jenisurusan,c.TajukMesyuaratID as idM,d.MesyuaratDesc,g.Keterangan as gred,k.Keterangan as gredJawatann,c.siri,c.tarikhMesyuarat,e.Gelaran as GelNamaCipta,e.NamaPenuh as namaCipta,f.Gelaran as GelNamaKemaskini, f.NamaPenuh as namaKemaskini, a.*,h.TrSelesai,h.Status as StatusUrusan FROM tblurusan a
          left JOIN tbljenisurusan b ON a.Jenis=b.id_jenisurusan
          inner join tblstatusurusan h on h.idUrusan=a.id
          left join tblgred g on g.ID=a.GredUrusan
		  left join tblgred k on k.ID=a.gredJawatan
          inner JOIN tblmesyuarat c on c.id=a.bilMesyuarat 
          inner join tblreftajukmesyuarat d on d.id=c.TajukMesyuaratID
          left join tblpengguna e on e.id=a.idCipta
          left join tblpengguna f on f.id=a.idkemaskini
          WHERE h.id='$idStatusUrusan'";
$RsStatusUrusan = mysql_query($query_RsStatusUrusan, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$totalRows_RsStatusUrusan = mysql_num_rows($RsStatusUrusan);
$idM=$row_RsStatusUrusan['idM'];
$idUrusan=$row_RsStatusUrusan['id'];
mysql_select_db($database_connspkp, $connspkp);


 $query_RsStatusUrusan2 = "SELECT a.*, b.id as idUser, b.Gelaran,b.NamaPenuh,e.desc_kategori
            FROM tblstatusurusan a 
            INNER JOIN tblpengguna b  ON a.idPengguna=b.id
            inner join tblurusan c on c.id=a.idUrusan
            inner join tbluruspengguna d on d.penggunaID=a.idPengguna and d.kategoriID in(1,2) and d.TajukMesyuaratID='$idM' 
            inner join tblkategori e on e.id_kategori=a.kategoriID
            WHERE a.idUrusan='$idUrusan' order by d.susunan asc";
$RsStatusUrusan2 = mysql_query($query_RsStatusUrusan2, $connspkp) or die(mysql_error());
$row_RsStatusUrusan2 = mysql_fetch_assoc($RsStatusUrusan2);
$totalRows_RsStatusUrusan2 = mysql_num_rows($RsStatusUrusan2);


mysql_select_db($database_connspkp, $connspkp);
$query_RsStatusUrusanL = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan' GROUP BY Keputusan ORDER BY Keputusan";
$RsStatusUrusanL = mysql_query($query_RsStatusUrusanL, $connspkp) or die(mysql_error());
$row_RsStatusUrusanL = mysql_fetch_assoc($RsStatusUrusanL);
$totalRows_RsStatusUrusanL = mysql_num_rows($RsStatusUrusanL);

mysql_select_db($database_connspkp, $connspkp);
$query_RsStatusUrusanT = "SELECT * FROM tblurusan WHERE id='$idUrusan'";
$RsStatusUrusanT = mysql_query($query_RsStatusUrusanT, $connspkp) or die(mysql_error());
$row_RsStatusUrusanT = mysql_fetch_assoc($RsStatusUrusanT);
$totalRows_RsStatusUrusanT = mysql_num_rows($RsStatusUrusanT);

 $query_RsStatusUrusanY = "SELECT count(*)as kiraT FROM `tblstatusurusan` where idUrusan='$idUrusan' and kategoriID<>'1' and TrSelesai ='0000-00-00 00:00:00'";
$RsStatusUrusanY = mysql_query($query_RsStatusUrusanY, $connspkp) or die(mysql_error());
$row_RsStatusUrusanY = mysql_fetch_assoc($RsStatusUrusanY);
$kiraT=$row_RsStatusUrusanY['kiraT'];

///////////UPDATE KEPUTUSAN START/////////////////////////////////////////////////////////////////////
include('Logger.php');


/* $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
} */

$strKeputusan='';
$strUlasan='';
$strMaklumbalas='';
$strKini=date("Y-m-j  H:i:s");
$idUrusanP='';

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmKemaskini")) {

$strKeputusan=$_POST['selectKeputusan'];
$strUlasan=$_POST['txtUlasan'];
if ($_SESSION["kategori"] =='1' ) {
	$strMaklumbalas=$_POST['txtMaklumbalas'];
}

$strKini=date("Y-m-j  H:i:s");
$idUrusanP=$_POST['idUrusan'];

if ($_SESSION["kategori"] =='1' ) {
   mysql_select_db($database_connspkp, $connspkp);
  
 echo  $updateSQL = sprintf("UPDATE tblstatusurusan SET Keputusan='$strKeputusan',Ulasan='$strUlasan',Maklumbalas='$strMaklumbalas',Status='Selesai', TrSelesai='$strKini' WHERE id='$idStatusUrusan'");
 $Result1 = mysql_query($updateSQL, $connspkp) or die(mysql_error());
 
// echo  $updateSQLUrusan = sprintf("UPDATE tblurusan SET TrSelesaiU='$strKini',Status='Selesai',idSelesai='".$_SESSION["idPengguna"]."'  WHERE id='$idUrusanP'"); 
 // $Result2 = mysql_query($updateSQLUrusan, $connspkp) or die(mysql_error());
 } else 
 if ($_SESSION["kategori"] =='2' ) {
  echo  $updateSQL = sprintf("UPDATE tblstatusurusan SET Keputusan='$strKeputusan',Ulasan='$strUlasan',Maklumbalas='$strMaklumbalas',Status='Selesai', TrSelesai='$strKini' WHERE id='$idStatusUrusan'");
  $Result1 = mysql_query($updateSQL, $connspkp) or die(mysql_error());
 
 }



			mysql_select_db($database_connspkp, $connspkp);
			$RsStatusAkhirUrusan = mysql_query("SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusanP' AND Status<>'Selesai' AND Status<>'Cuti'");
			$myrowscheck = mysql_num_rows($RsStatusAkhirUrusan);

				if ($myrowscheck == 0){
						$selesaiSQL = sprintf("UPDATE tblurusan SET Status='Selesai',  TrSelesaiU='$strKini',TrKemaskini='$strKini', idkemaskini='".$_SESSION["idPengguna"]."',idSelesai='".$_SESSION["idPengguna"]."' WHERE id='$idUrusanP'");

  						mysql_select_db($database_connspkp, $connspkp);
  						$Result_selesaiSQL = mysql_query($selesaiSQL, $connspkp) or die(mysql_error());
						
			        	logMe("Kemaskini status akhir urusan kepada Selesai");

				//---------------emel kepada pengguna biasa START---------------//
				include('EmailUrusanSelesai.php?s=$idUrusanP&t=$idStatusUrusan');
				//---------------emel kepada pengguna biasa END---------------//

				}


//-------------------START CREATE PDF AND EMAIL------------------------//
include 'email_maklumanUrusetia.php?s=$idUrusanP&t=$idStatusUrusan';
//------------------START CREATE PDF AND EMAIL END---------------------//

		logMe("Membuat keputusan urusan: ".$row_RsStatusUrusan['Ringkasan']);



  //$updateGoTo = "LaporanKeputusan.php";
 // if (isset($_SERVER['QUERY_STRING'])) {
 //   $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
  //  $updateGoTo .= $_SERVER['QUERY_STRING'];
//  }
//  header(sprintf("Location: %s", $updateGoTo)); 
?>
<meta http-equiv="refresh" content="0;URL=LaporanKeputusan.php?s=<?php echo $idUrusanP;?>&t=<?php echo $idStatusUrusan;?>"> 
<?php
}
///////////UPDATE KEPUTUSAN END/////////////////////////////////////////////////////////////////////
?>

<?php include 'include/Popup.php';?>

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
.style12 {color: #000000; font-weight: bold; }
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
      <td valign="top"><table class="table" width="100%">
          <!--DWLayoutTable-->
          <tr>
            <td height="43" width="100%" colspan="2" valign="top"><?php include 'include/profile.php'; ?></td>
          </tr>
          <tr>
            <td width="204" height="201" valign="top"><?php include 'include/menuuser.php'; ?>
            <br></td>
            <td valign="top" align="center"><table class="table">
                <!--DWLayoutTable-->
                <tr>
                  <td width="750" height="315" valign="top"><p><span class="style9">KEMASKINI / BUAT KEPUTUSAN </span></p>
				  <form action="Kemaskini.php?s=<?php echo $idUrusan;?>&t=<?php echo $idStatusUrusan; ?>" method="POST" name="frmKemaskini" id="frmKemaskini">
                      <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">
                        <!--DWLayoutTable-->
                        <tr>
                          <td bgcolor="#d8c0be" width="300">Jenis Urusan : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['desc_jenisurusan']; ?></td>
                        </tr>
						<tr>
                          <td bgcolor="#d8c0be">Gred Jawatan : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['gredJawatann']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Gred Hakiki Pegawai : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['gred']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Butiran : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['Ringkasan']; ?></td>
                        </tr>
						<tr>
                          <td bgcolor="#d8c0be">Keterangan Butiran : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['KeteranganRingkasan']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Kertas : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><span class="style10"><a href="<?php echo $row_RsStatusUrusan['Link']; ?>" target="_blank"><?php echo $row_RsStatusUrusan['Link']; ?></a></span></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">No. Fail : </td>
                          <td colspan="2" bgcolor="#FFFFFF"><span class="style12"><?php echo $row_RsStatusUrusan['NoKertas']; ?></span></td>
                        </tr>
                        <tr>
                          <td width="123" bgcolor="#d8c0be"><br>
                            <br>                            <br></td>
                          <td width="610" bgcolor="#FFFFFF"><br>
                            <br>
                            <br>
                            <br></td>
                          <td width="610" rowspan="4" bgcolor="#FFFFFF"><div align="center">
                     <?php
					$strXML="";
					$strXML = "<graph caption='Carta Keputusan' xAxisName='Keputusan' yAxisName='Jumlah' decimalPrecision='0' formatNumberScale='0'>";

					do{
							$row_RsUrusanL['GrValue']="";

							mysql_select_db($database_connspkp, $connspkp);
							 $query_RsUrusanL = "SELECT COUNT(id) as GrValue FROM tblstatusurusan WHERE Keputusan = '".$row_RsStatusUrusanL['Keputusan']."' AND idUrusan='".$idUrusan."'";
							$RsUrusanL = mysql_query($query_RsUrusanL, $connspkp) or die(mysql_error());
							$row_RsUrusanL = mysql_fetch_assoc($RsUrusanL);

							$strXML .= "<set name='".$row_RsStatusUrusanL['Keputusan']."' value='".$row_RsUrusanL['GrValue']."' color='".getFCColor()."' />";


					} while ($row_RsStatusUrusanL = mysql_fetch_assoc($RsStatusUrusanL));

					$strXML .=  "</graph>";
					echo renderChartHTML('FusionCharts/FCF_Column3D.swf', "", $strXML, "myNext", 300, 200);


				mysql_free_result($RsStatusUrusanL);
				mysql_free_result($RsUrusanL);
				?>
                          </div></td>
                        </tr>

						<tr>
                          <td width="123" bgcolor="#d8c0be">Status : </td>
                          <td width="610" bgcolor="#FFFFFF"><?php echo $row_RsStatusUrusan['StatusUrusan']; ?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d8c0be">Tarikh Terima : </td>
                          <td bgcolor="#FFFFFF"><?php echo format_date($row_RsStatusUrusan['TrCipta'],"%d/%m/%Y"); ?></td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#d8c0be">Tarikh Kemas kini : </td>
						  <?php  $dateS=format_date($row_RsStatusUrusan['TrSelesai'],"%d/%m/%Y");
						  if ($dateS=="01/01/1970")
						  {
						      $dateSelesai='';
						  }else 
						   if($dateS == "30/11/-1")
						  {
						  $dateSelesai='';
						  }else 
						  if($dateS != "01/01/1970")
						  {
						  $dateSelesai=$dateS;
						  }
						  
						   ?>
                          <td bgcolor="#FFFFFF"><?php echo $dateSelesai; ?></td>
                        </tr>
					  </table>
                      <br>
                      <table width="743"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                        <!--DWLayoutTable-->
                      </table>
                      <br>
                      <table width="743"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">
                        <!--DWLayoutTable-->
                  <?php if($kiraT >'0' && $_SESSION['kategori'] =='2'){ ?>	 
						<tr>     
						
                          <td width="123" bgcolor="#d8c0be">Keputusan  : </td>   
                         
                          <td width="610" bgcolor="#FFFFFF">
						
						
						   <select name="selectKeputusan" id="selectKeputusan">
						
                            <?php if($row_RsStatusUrusan['Jenis']=='8'){?>
                            <option>Ambil Maklum</option>        
                            <?php }else ?>
							 <?php if($row_RsStatusUrusan['Jenis']!='8' ){?>
							 <option>Sokong</option>
                            <option>Tidak Sokong</option>
							<?php }?>
                          </select>
					</td>
					</tr>	
				    <?php } 
					if($kiraT >'0' && $_SESSION['kategori'] =='1'){ ?>	
					<tr>     
						
                     <td width="123" bgcolor="#d8c0be">Keputusan  : </td>   
                         
                     <td width="610" bgcolor="#FFFFFF">
		             <?php echo "TIADA KEPUTUSAN. <br><br>KEPUTUSAN OLEH PENGERUSI HANYA BOLEH DIBUAT SETELAH SEMUA AHLI MEMBUAT KEPUTUSAN";?>
					</td>
					</tr>
					<?php }
					else 
						if($kiraT =='0')//semua ahli telah bagi keputusan baru pengerusi boleh buat keputusan
						{?>
                     <tr>
					      <td width="123" bgcolor="#d8c0be">Keputusan wdwd: </td>   
                         
                          <td width="610" bgcolor="#FFFFFF">
						
						  <select name="selectKeputusan" id="selectKeputusan">
						
                            <?php if($row_RsStatusUrusan['Jenis']=='8'){?>
                            <option>Ambil Maklum</option>
                            <?php }else ?>
                            <?php if($row_RsStatusUrusan['Jenis']<>'8' || $_SESSION['kategori'] =='1'){?>
                            <option>Setuju</option>
                            <option>Tidak Setuju</option>
                            <?php }?>
							 
                          </select>
						 
						  </td>
					
                        </tr>
	            <?php }?>
				
                <?php if ($kiraT=='0' || $_SESSION["kategori"] =='1' ) {?>
				
				        <tr>
                          <td valign="top" bgcolor="#d8c0be">Ulasan : </td>
                          <td bgcolor="#FFFFFF"><textarea name="txtUlasan" cols="70" rows="6" id="txtUlasan"></textarea></td>
                        </tr>
                        <tr>
                          <td valign="top" bgcolor="#d8c0be">Maklumbalas : </td>
                          <td bgcolor="#FFFFFF"><textarea name="txtMaklumbalas" cols="70" rows="6" id="txtMaklumbalas"></textarea></td>
                        </tr>
						
						<tr>
                          <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                          <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Hantar" onClick = "if (! confirm(' Adakah <?php echo $_SESSION["Gelaran"];?> pasti dengan keputusan ini?')) return false;"></td>
						
                        </tr>
                   <?php }else 
				   if ($kiraT>'0' && $_SESSION["kategori"] =='2')
				   {
				   ?>      
				        <tr>
                          <td valign="top" bgcolor="#d8c0be">Ulasan : </td>
                          <td bgcolor="#FFFFFF"><textarea name="txtUlasan" cols="70" rows="6" id="txtUlasan"></textarea></td>
                        </tr>
                        <tr>

                          <td colspan="2" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        </tr>
						
                        <tr>
                          <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                          <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="Hantar" onClick = "if (! confirm(' Adakah <?php echo $_SESSION["Gelaran"];?> pasti dengan keputusan ini?')) return false;"></td>
						
                        </tr>
		         <?php } ?>
				
                      </table>
					  <input type="hidden" name="idUrusan" value="<?php echo $idUrusan; ?>">
                      <input type="hidden" name="MM_update" value="frmKemaskini">
                   
                  </form>                    <img src="images/arrow.gif" width="12" height="10"> LAIN-LAIN KEPUTUSAN DAN ULASAN<br>
                    <br>
                    <table width="743" cellspacing="1" cellpadding="1" class="table">
                      <!--DWLayoutTable-->
                      <tr bgcolor="#897270">
                        <td width="15"><span class="style1">No</span></td>
                        <td width="159"><span class="style1">Edaran kepada </span></td>
                        <td width="36"><span class="style1">Status </span></td>
                        <td width="80"><span class="style1">Keputusan</span></td>
                        <td width="240"><span class="style1">Ulasan </span></td>
                        <td width="240"><span class="style1">Maklumbalas </span></td>
                        <td width="161"><span class="style1">Kemas kini</span></td>
                        <td width="47"><span class="style1">Tempoh </span></td>
                      </tr>
                      <?php
					  //2 color rows//////////////////////////////////////////////////////////////////////
					$color1 = "white";
					$color2 = "#f9f7f7";
 			   		$row_count = 0;
					$No=0;

  				    //Looping result of RsUrusan/////////////////////////////////////////////////
					do {


								if (($row_RsStatusUrusan2['Status'])=='Selesai') {

									$strMula=$row_RsStatusUrusan2['TrTerima'];
									//$strKini=date("Y-m-j  H:i:s");
									$strKini=$row_RsStatusUrusan2['TrSelesai'];

									$date_d = abs(strtotime($strKini)-strtotime($strMula)) / 86400;
									
                    								}

								else if (($row_RsStatusUrusan2['Status'])=='BATAL') {

									$strMula=$row_RsStatusUrusan2['TrTerima'];
									$strKini=$row_RsStatusUrusan2['TrSelesai'];

									$date_diff = abs(strtotime($strKini)-strtotime($strMula)) / 86400;

								}

								else if ((($row_RsStatusUrusan2['Status'])=='Baru') || (($row_RsStatusUrusan2['Status'])=='Pertimbangan')) {

									$strMula=$row_RsStatusUrusan2['TrTerima'];
									$strKini=date("Y-m-j  H:i:s");
									//$strKini=$row_RsStatusUrusan['TrSelesai'];

									$date_diff = abs(strtotime($strKini)-strtotime($strMula)) / 86400;

								}

								else  {

									$date_diff=0;

								};



  				    $No++;
    				$row_color = ($row_count % 2) ? $color1 : $color2;

					  ?>
                      <tr bgcolor="<?php echo $row_color; ?>" onMouseOver="this.bgColor='#FFB366'" onMouseOut="this.bgColor='<?php echo $row_color; ?>'">
                        <td valign="top"><?php echo $No; ?></td>
                        <td><?php echo $row_RsStatusUrusan2['Gelaran']; ?><br>
                          <?php echo $row_RsStatusUrusan2['NamaPenuh'];?><br />
						  <?php  $idUs=$row_RsStatusUrusan2['idUser']; ?><br />
						  <?php
						    $query_RsPeranan = "SELECT b.desc_kategori FROM `tbluruspengguna` a 
												inner join tblkategori b on b.id_kategori=a.kategoriID
												where a.penggunaID='$idUs' and a.TajukMesyuaratID='$idM'";
							$RsPeranan = mysql_query($query_RsPeranan, $connspkp) or die(mysql_error());
							$row_RsPeranan = mysql_fetch_assoc($RsPeranan);

						  ?> 
						 <b> ( <?php echo strtoupper($row_RsPeranan['desc_kategori']);?> ) <br /></td>
						                        </td>                   
                        <td><table width="98%"  border="0" cellspacing="0" cellpadding="0" class="table">
                            <?php if (($row_RsStatusUrusan2['Status'])=='Baru') { ?>
                            <tr>
                              <td height="17" bgcolor="#80E474"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan2['Status'])=='Pertimbangan') {
						?>
                            <tr>
                              <td height="26" bgcolor="#FC9696"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="20" height="20" align="absmiddle"></strong></div>
                              </div></td>
                            </tr>
                            <?php
						};
						if (($row_RsStatusUrusan2['Status'])=='Selesai') {
						?>
                            <tr>
                              <td height="26" bgcolor="#9191FF"><div align="left" class="style1">
                                  <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"></strong></div>
                              </div></td>
                            </tr>
							<?php
								};
								if (($row_RsStatusUrusan2['Status'])=='Cuti') {
								?>
                          <tr>
                            <td bgcolor="#eaafc9"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/cuti.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"></strong></div>
                            </div></td>
                          </tr>
                            <?php };?>
                        </table></td>
                        <td><strong><?php echo $row_RsStatusUrusan2['Keputusan']; ?></strong></td>
                        <td><?php echo $row_RsStatusUrusan2['Ulasan']; ?></td>
                         <td><?php echo $row_RsStatusUrusan2['Maklumbalas']; ?></td>
                        <td><?php echo format_datetime($row_RsStatusUrusan2['TrSelesai']); ?></td>
						 <?php 
					   $datt= round($date_diff);
					  if($datt=='18358' || $datt=='0' || $datt=='18366' )
					   {
					   $dattDiff=0;
					   }else
					   {
					   $dattDiff=$datt;
					   }
					  ?>
                        <td><strong><?php echo round($dattDiff) ;?> hari</strong></td>
                      </tr>
                      <?php
					  $row_count++;
					  } while ($row_RsStatusUrusan2 = mysql_fetch_assoc($RsStatusUrusan2));
					  ?>
                    </table>
                    <div align="center"><br>
                    </div>
                    <div align="center"></div>                  </td>
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
mysql_free_result($RsStatusUrusan);
mysql_free_result($RsStatusUrusan2);

?>
