<?php
require_once('Connections/connspkp.php');
include('include/FormatDate.php');

ob_start();
session_start();

if($_SESSION["kategori"] !='1' ){
   if($_SESSION["kategori"] !='2' ){
	
		header("Location: Logout.php");
	
		}
	};

?>
<?php

$strKini = date("Y-m-j  H:i:s");

if((isset($_GET['s']))&&($_GET['s']!='')){
$idUrusan = $_GET['s'];
}
else{$idUrusan = '-';};


mysql_select_db($database_connspkp, $connspkp);

  $query_RsUrusan = "SELECT b.desc_jenisurusan,c.TajukMesyuaratID as idM,d.MesyuaratDesc,g.Keterangan,k.Keterangan as gredJawatann,c.siri,c.tarikhMesyuarat,e.Gelaran as GelNamaCipta,e.NamaPenuh as namaCipta,f.Gelaran as GelNamaKemaskini, f.NamaPenuh as namaKemaskini, a.*,h.NamaPenuh as NamaSelesai,h.Gelaran as GelSelesai FROM tblurusan a 
left JOIN tbljenisurusan b ON a.Jenis=b.id_jenisurusan 
inner JOIN tblmesyuarat c on c.id=a.bilMesyuarat 
inner join tblreftajukmesyuarat d on d.id=c.TajukMesyuaratID 
left join tblpengguna e on e.id=a.idCipta 
left join tblpengguna f on f.id=a.idkemaskini 
left join tblgred g on g.ID=a.GredUrusan 
left join tblgred k on k.ID=a.gredJawatan
left join tblpengguna h on h.id=a.idSelesai
WHERE a.id='$idUrusan'";
				
$RsUrusan = mysql_query($query_RsUrusan, $connspkp) or die(mysql_error());
$row_RsUrusan = mysql_fetch_assoc($RsUrusan);
 $totalRows_RsUrusan = mysql_num_rows($RsUrusan);
$idM=$row_RsUrusan['idM'];


mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
  $query_RsStatusUrusan = "SELECT a.*, b.id as idUser, b.Gelaran,b.NamaPenuh,e.desc_kategori
            FROM tblstatusurusan a 
            INNER JOIN tblpengguna b  ON a.idPengguna=b.id
            inner join tblurusan c on c.id=a.idUrusan
            inner join tblkategori e on e.id_kategori=a.kategoriID
            inner join tbluruspengguna d on d.penggunaID=a.idPengguna and d.kategoriID in(1,2) and d.TajukMesyuaratID='$idM' 
            WHERE a.idUrusan='$idUrusan' order by d.susunan asc";
$RsStatusUrusan = mysql_query($query_RsStatusUrusan, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$totalRows_RsStatusUrusan = mysql_num_rows($RsStatusUrusan);




///////////////////////////paging end//////////////////////////////
?>
<?php //include("Header.php");?>
<?php //include("Nav.php");?><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>



<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {
	/* font-family: Arial; */
	font-size: 14px;
}
.style3 {
	font-family: Arial;
	font-size: 13px;
}

.style9 {color: #6699CC}
-->
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>

    <td width="100%" align="center" valign="top"><h3><img src="images/jatanegaramalaysia.png" width="92" height="75" /><br />
      Perincian Urusan di eCirculation JPA
<!--<div>-->
</h3>
 
          <table width="900" border="0" cellspacing="0" cellpadding="1" bgcolor="#999999">
          <tr>
          <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                <tr class="info" >
                  <td colspan="6"><div align="left"><hr> </div></td>
                </tr>
                <tr class="info" >
                  <td colspan="3" rowspan="2"><h4>MAKLUMAT URUSAN&nbsp;</h4> </td>
              <td><div align="right"  ></div></td>
              <td><div align="center" ></div></td>
              <td><div align="right">Pengguna Cetak:<?php echo $_SESSION["Login"];?></div></td>
            </tr>
            <tr class="info" >
              <td valign="top"><div align="right" ></div></td>
              <td valign="top"><div align="center" ></div></td>
              <td valign="top"><div align="right">Tarikh Cetak:<?php echo date("j/m/Y  H:i:s"); ?></div></td>
            </tr>
            <tr class="info" >
              <td colspan="6"><hr></td>
              </tr>
            <tr>
              <td width="17%" valign="top"><div align="right" style="font-weight: bold; text-align: left;">Bil. eCirculation</div></td>
              <td width="1%" valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td colspan="4" valign="top"><div align="left"><strong><?php echo strtoupper($row_RsUrusan['MesyuaratDesc']); ?> BIL <?php echo $row_RsUrusan['siri']; ?>  TAHUN <?php echo date("Y", strtotime($row_RsUrusan['tarikhMesyuarat'])); ?> </strong></div></td>
              </tr>
            <tr>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Tarikh</div></td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td colspan="4" valign="top"><?php echo format_date($row_RsUrusan['tarikhMesyuarat']); ?></td>
            </tr>
            <tr>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">No. Fail</div> </td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td colspan="4" valign="top"><?php echo $row_RsUrusan['NoKertas']; ?></td>
            </tr>
            <tr>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Jenis Urusan</div></td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td colspan="4" valign="top"><div align="left" ><?php echo $row_RsUrusan['desc_jenisurusan']; ?></div></td>
              </tr>
             
             <tr>
               <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Gred Jawatan</div></td>
               <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
               <td colspan="4" valign="top"><?php echo $row_RsUrusan['gredJawatann']; ?></td>
             </tr>
             <tr>
               <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Gred Hakiki Pegawai </div></td>
               <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
               <td colspan="4" valign="top"><?php echo $row_RsUrusan['Keterangan']; ?></td>
             </tr>
             <tr>
               <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Butiran</div></td>
               <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
               <td colspan="4" valign="top"><div align="left"><?php echo $row_RsUrusan['Ringkasan']; ?></div></td>
             </tr>
			 <tr>
               <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Keterangan Butiran</div></td>
               <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
               <td colspan="4" valign="top"><div align="left"><?php echo $row_RsUrusan['KeteranganRingkasan']; ?></div></td>
             </tr>
             <tr>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Kertas</div></td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td colspan="4" valign="top"><div align="left"><?php echo $row_RsUrusan['Link']; ?></div></td>
              </tr>
           <tr class="info"  >
              <td colspan="6"><div align="left">
                <hr>

              </div></td>
           </tr>
            <tr>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Pegawai Cipta</div></td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td width="32%" valign="top"><div align="left"><?php echo $row_RsUrusan['GelNamaCipta']; ?> <?php echo $row_RsUrusan['namaCipta']; ?></div></td>
              <td width="17%" valign="top"><div align="right" style="font-weight: bold; text-align: left;"></div></td>
              <td width="1%" valign="top"><div align="center" style="font-weight: bold"></div></td>
              <td width="32%" valign="top"><div align="left">
			</div></td>
            </tr>
            <tr>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Tarikh cipta</div></td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td valign="top"><div align="left"><?php echo format_date($row_RsUrusan['TrCipta'],"%d/%m/%Y"); ?></div></td>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;"></div></td>
              <td valign="top"><div align="center" style="font-weight: bold"></div></td>
			 
              <td valign="top"><div align="left"></div></td>
              </tr>
            <tr class="info"  >
              <td colspan="6"><div align="left" >
                <hr>
                <h4>
                  SENARAI AHLI </h4>
                <hr>
              </div></td>
              </tr>

            <tr>
              <td colspan="6" valign="top"><div align="center" style="font-weight: bold">
                <table width="900" border="0" cellspacing="0" cellpadding="0" bgcolor="#666666">
                  <tr bgcolor="#999999">
                    <td width="6%"><strong><span class="style1">No</span></strong></td>
                    <td width="20%"><strong><span class="style1">Edaran kepada </span></strong></td>
                    <td width="10%"><strong><span class="style1">Status </span></strong></td>
                    <td width="14%"><strong><span class="style1">Keputusan</span></strong></td>
                    <td width="38%"><strong><span class="style1">Ulasan </span></strong></td>
                    <td width="16%" align="center"><strong><span class="style1">Tarikh Kemas kini </span></strong></td>
                    <td  width="11%"><strong><span class="style1">Tempoh </span></strong></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"><td colspan="7"><hr></td></tr>
                  <?php
					  //2 color rows//////////////////////////////////////////////////////////////////////
					$color1 = "white";
					$color2 = "#D9ECFF";
 			   		$row_count = 0;
				    $pageNum_RsStatusUrusan='';
					$maxRows_RsStatusUrusan='';
					$No=(($pageNum_RsStatusUrusan)*$maxRows_RsStatusUrusan);

  				    //Looping result of RsUrusan/////////////////////////////////////////////////
					do {


								if (($row_RsStatusUrusan['Status'])=='Selesai') {

									$strMula=$row_RsStatusUrusan['TrTerima'];
									//$strKini=date("Y-m-j  H:i:s");
									$strKini=$row_RsStatusUrusan['TrSelesai'];

									$date_diff = abs(strtotime($strKini)-strtotime($strMula)) / 86400;

								}

								else if (($row_RsStatusUrusan['Status'])=='BATAL') {

									$strMula=$row_RsStatusUrusan['TrTerima'];
									$strKini=$row_RsStatusUrusan['TrSelesai'];

									$date_diff = abs(strtotime($strKini)-strtotime($strMula)) / 86400;

								}

								else if ((($row_RsStatusUrusan['Status'])=='Baru') || (($row_RsStatusUrusan['Status'])=='Pertimbangan')) {

									$strMula=$row_RsStatusUrusan['TrTerima'];
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
                    <tr bgcolor="#FFFFFF" class="style2">
                      <td valign="top"><?php echo $No; ?></td>
                                       <td><?php echo $row_RsStatusUrusan['Gelaran']; ?><br>
                          <?php echo $row_RsStatusUrusan['NamaPenuh'];?><br />
						  <?php  $idUs=$row_RsStatusUrusan['id']; ?><br />
						  <?php
						   $query_RsPeranan = "SELECT b.desc_kategori FROM `tbluruspengguna` a 
												inner join tblkategori b on b.id_kategori=a.kategoriID
												where a.penggunaID='$idUs' and a.TajukMesyuaratID='$idM'";
							$RsPeranan = mysql_query($query_RsPeranan, $connspkp) or die(mysql_error());
							$row_RsPeranan = mysql_fetch_assoc($RsPeranan);

						  ?> 
						 <b> ( <?php echo strtoupper($row_RsStatusUrusan['desc_kategori']);?> ) <br />						                        </td>                   
                      <td><table width="98%"  border="0" cellspacing="0" cellpadding="0">
					      <?php echo $row_RsStatusUrusan['Status']; ?>
                          <?php if (($row_RsStatusUrusan['Status'])=='Baru') { ?>
                          <tr>
                            <td height="16" bgcolor="#80E474"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/baru.gif" alt="Urusan Baru" width="19" height="12" align="absmiddle"></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Pertimbangan') {
						?>
                          <tr>
                            <td height="25" bgcolor="#FC9696"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/prtmbg2.gif" alt="Urusan Dalam Pertimbangan" width="21" height="21" align="absmiddle"></strong></div>
                            </div></td>
                          </tr>
                          <?php
						};
						if (($row_RsStatusUrusan['Status'])=='Selesai') {
						?>
                          <tr>
                            <td bgcolor="#9191FF"><div align="left" class="style1">
                                <div align="center"><strong><img src="images/selesai.png" alt="Urusan Telah Selesai" width="20" height="20" align="absmiddle"></strong></div>
                            </div></td>
                          </tr>
                          <?php };?>
                      </table></td>
                      <td><strong><?php echo $row_RsStatusUrusan['Keputusan']; ?></strong></td>
                      <td><?php echo $row_RsStatusUrusan['Ulasan']; ?></td>
                      <td><?php 
					  
					  $Trkem= format_date($row_RsStatusUrusan['TrSelesai'],"%d/%m/%Y"); 
					  if($Trkem=="01/01/1970"){
					     echo $TrkemK="00/00/0000";
					  }
					  else
					  if($Trkem=="30/11/-1"){
					     echo $TrkemK="00/00/0000";
					  } else 
					  {
					   echo  $TrkemK=$Trkem;
					  }
					  
					  ?></td>
                       <?php 
					   $datt= round($date_diff);
					  if($datt >'18358' || $datt=='0' )
					   {
					   $dattDiff=0;
					   }else
					   {
					   $dattDiff=$datt;
					   }
					  ?>
                      <td><strong><?php echo $dattDiff;?> hari </strong></td>
                    </tr>
                    <tr bgcolor="#FFFFFF"><td colspan="7"><hr></td></tr>
                    <?php
					  $row_count++;
					  } while ($row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan));
					  ?>
                </table>
              </div>
                <div align="left"></div>
                <div align="center"></div></td>
              </tr>
            <tr>
              <td colspan="6">
                <div align="center"><br />
                  --TAMAT--</div>
                <hr>                </td>
            </tr>
        </table>

        </td>
        </tr>
        </table>

          </div>
         <script>
		 window.print();
		 </script>

		</td>
  </tr>
</table>


<?php //include("Footer.php");?>
<?php
//mysql_free_result($RsRuling);
?>
