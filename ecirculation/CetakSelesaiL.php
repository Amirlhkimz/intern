<?php
require_once('Connections/connspkp.php');
include('include/FormatDate.php');
//include("include/Session.php");
//include("include/Security.php");

ob_start();
session_start();

if($_SESSION["Kumpulan"] !='urusetia' && $_SESSION["Kumpulan"] !='SUB' && $_SESSION["Kumpulan"] !='Biasa' ){
    header("Location: Logout.php");
  };

?>
<?php

$strKini = date("Y-m-j  H:i:s");

if((isset($_GET['IdU']))&&($_GET['IdU']!='')){
$idUrusan = $_GET['IdU'];
}
else{$idUrusan = '-';};


mysql_select_db($database_connspkp, $connspkp);
//$query_RsUrusan = "SELECT * FROM tblurusan WHERE id='$idUrusan'";
$query_RsUrusan = "SELECT tblurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh FROM tblurusan
          INNER JOIN tblpengguna
          ON tblurusan.idCipta=tblpengguna.id
          WHERE tblurusan.id='$idUrusan'";
$RsUrusan = mysql_query($query_RsUrusan, $connspkp) or die(mysql_error());
$row_RsUrusan = mysql_fetch_assoc($RsUrusan);
$totalRows_RsUrusan = mysql_num_rows($RsUrusan);

mysql_select_db($database_connspkp, $connspkp);
//$query_RsUrusan = "SELECT * FROM tblurusan WHERE id='$idUrusan'";
$query_RsKemaskini = "SELECT  tblurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh FROM tblurusan
          INNER JOIN tblpengguna
          ON tblurusan.idkemaskini=tblpengguna.id
          WHERE tblurusan.id='$idUrusan'";
$RsKemaskini = mysql_query($query_RsKemaskini, $connspkp) or die(mysql_error());
$row_RsKemaskini = mysql_fetch_assoc($RsKemaskini);
$totalRows_RsKemaskini = mysql_num_rows($RsKemaskini);

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
$query_RsStatusUrusan = "SELECT tblstatusurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh, tblpengguna.Susunan
            FROM tblstatusurusan
            INNER JOIN tblpengguna
            ON tblstatusurusan.idPengguna=tblpengguna.id
            WHERE tblstatusurusan.idUrusan='$idUrusan'
            ORDER BY tblstatusurusan.susunan";
$RsStatusUrusan = mysql_query($query_RsStatusUrusan, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$totalRows_RsStatusUrusan = mysql_num_rows($RsStatusUrusan);

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
$query_RsStatusUrusanL = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan' GROUP BY Keputusan ORDER BY Keputusan";
$RsStatusUrusanL = mysql_query($query_RsStatusUrusanL, $connspkp) or die(mysql_error());
$row_RsStatusUrusanL = mysql_fetch_assoc($RsStatusUrusanL);
$totalRows_RsStatusUrusanL = mysql_num_rows($RsStatusUrusanL);

mysql_select_db($database_connspkp, $connspkp);
//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusan'";
$query_RsStatusUrusanT = "SELECT * FROM tblurusan WHERE id='$idUrusan'";
$RsStatusUrusanT = mysql_query($query_RsStatusUrusanT, $connspkp) or die(mysql_error());
$row_RsStatusUrusanT = mysql_fetch_assoc($RsStatusUrusanT);
$totalRows_RsStatusUrusanT = mysql_num_rows($RsStatusUrusanT);

$idPengguna1=$row_RsUrusan['idCipta'];


///////////////////////////paging end//////////////////////////////
?>
<?php //include("Header.php");?>
<?php //include("Nav.php");?>

<head>
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
      Perincian Keputusan di eCirculation JPA
<!--<div>-->
</h3>
      <?php if ($totalRows_RsUrusan > 0) { // Show if recordset not empty ?>




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
              <td colspan="4" valign="top"><div align="left"><?php echo $row_RsUrusan['bilMesyuarat']; ?></div></td>
              </tr>
            <tr>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Jenis Urusan</div></td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td colspan="4" valign="top"><div align="left" ><?php echo $row_RsUrusan['Jenis']; ?></div></td>
              </tr>
             <tr>
               <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Ringkasan</div></td>
               <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
               <td colspan="4" valign="top"><div align="left"><?php echo $row_RsUrusan['Ringkasan']; ?></div></td>
             </tr>
             <tr>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Kertas</div></td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td colspan="4" valign="top"><div align="left"><?php echo $row_RsUrusan['Kertas']; ?></div></td>
              </tr>
           <tr class="info"  >
              <td colspan="6"><div align="left">
                <hr>

              </div></td>
           </tr>
            <tr>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Pegawai Cipta</div></td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td width="32%" valign="top"><div align="left"><?php echo $row_RsUrusan['Gelaran']; ?> <?php echo $row_RsUrusan['NamaPenuh']; ?></div></td>
              <td width="17%" valign="top"><div align="right" style="font-weight: bold; text-align: left;">Pengguna Selesai</div></td>
              <td width="1%" valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td width="32%" valign="top"><div align="left">
        <?php

        if($row_RsUrusan['Status']=='Selesai'){
        echo $row_RsKemaskini['Gelaran'];
        echo $row_RsKemaskini['NamaPenuh'];
        }
        else
        {echo "  --";}
        ?></div></td>
            </tr>
            <tr>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Tarikh cipta</div></td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td valign="top"><div align="left"><?php echo format_date($row_RsUrusan['TrCipta'],"%d/%m/%Y"); ?></div></td>
              <td valign="top"><div align="right" style="font-weight: bold; text-align: left;">Tarikh Selesai</div></td>
              <td valign="top"><div align="center" style="font-weight: bold">:</div></td>
              <td valign="top"><div align="left"><?php echo format_date($row_RsUrusan['TrKemaskini'],"%d/%m/%Y"); ?></div></td>
              </tr>
            <tr class="info"  >
              <td colspan="6"><div align="left" >
                <hr>
                <h4>
                  PERINCIAN KEPUTUSAN</h4><hr>
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
                    <td width="16%"><strong><span class="style1">Tarikh Kemas kini </span></strong></td>
                    <td  width="11%"><strong><span class="style1">Tempoh </span></strong></td>
                  </tr>
                  <tr bgcolor="#FFFFFF"><td colspan="7"><hr></td></tr>
                  <?php
            //2 color rows//////////////////////////////////////////////////////////////////////
          $color1 = "white";
          $color2 = "#D9ECFF";
            $row_count = 0;
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
                          <?php echo $row_RsStatusUrusan['NamaPenuh'];
                if($row_RsStatusUrusan['idPengguna']=='42'){?>
                          <br>
                          Anggota SPA (Menunaikan fungsi Pengerusi SPA &amp; SPKP mengikut Perkara <br>
                          142(3A) Perlembagaan Persekutuan)                          <?php };?>

             <?php if($row_RsStatusUrusan['idPengguna']=='15'
              && ($row_RsStatusUrusanT['TrCipta'] >= '2016-09-09 00:00:00')
              && ($row_RsStatusUrusanT['TrCipta'] <= '2016-09-23 00:00:00') ){?>

              <br>
              Anggota SPA (Menunaikan fungsi Pengerusi SPA mengikut Perkara 142(3A) Perlembagaan Persekutuan) <?php };?>
              </td>
                      <td><table width="98%"  border="0" cellspacing="0" cellpadding="0">
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
                      <td><?php echo format_datet($row_RsStatusUrusan['TrSelesai'],"%d/%m/%Y"); ?></td>
                      <td><strong><?php echo round($date_diff) ;?> hari </strong></td>
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
                <hr>
                </td>
            </tr>
        </table>

        </td>
        </tr>
        </table>

          </div>
         <script>
     window.print();
     </script>
        <?php
    } // Show if recordset not empty
    else{ ?>
    <div class="alert alert-danger">
         <p>Maaf, tiada urusan ditemui.<br />
    </div>

    <?php }
    ?></td>
  </tr>
</table>


<?php //include("Footer.php");?>
<?php
mysql_free_result($RsRuling);
?>
