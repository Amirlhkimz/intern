<?php require_once('Connections/connspkp.php'); ?>
<?php
ob_start();
session_start();

if($_SESSION["kategori"] !='4'  ){
    if($_SESSION["kategori"] !='5' )
	{
    header("Location: Logout.php");
	}
  };
 $stridKemaskini=$_SESSION["idPengguna"];


?><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
function dahsemak()
{
     if(document.frmUpdateurusan.selectJenisUrusan.selectedIndex=="")
	{
		alert ( "Sila pilih jenis urusan!");
		return false;
	}
	
     if(document.frmUpdateurusan.gredurusan.selectedIndex=="")
	{
		alert ( "Sila pilih gred urusan!");
		return false;
	}
 
    var x = document.forms["frmUpdateurusan"]["txtRingkasan"].value;
        if (x == "") {
         alert("Butiran wajib diisi");
         return false;
     }
  


		return true;
		
}

</script>
<script> 
        function fileValidation() { 
            var fileInput =  
                document.getElementById('file'); 
              
            var filePath = fileInput.value; 
          
            // Allowing file type 
            var allowedExtensions =  
                    /(\.pdf|\.PDF)$/i; 
              
            if (!allowedExtensions.exec(filePath)) { 
                alert('Sila muat naik fail format .PDF sahaja!'); 
                fileInput.value = ''; 
                return false; 
            }  
            else  
            { 
              
                // Image preview 
                if (fileInput.files && fileInput.files[0]) { 
                    var reader = new FileReader(); 
                    reader.onload = function(e) { 
                        document.getElementById( 
                            'imagePreview').innerHTML =  
                            '<img src="' + e.target.result 
                            + '"/>'; 
                    }; 
                      
                    reader.readAsDataURL(fileInput.files[0]); 
                } 
            } 
        } 
</script>

</head>

<?php
include('include/FusionCharts.php');
include('include/FC_Colors.php');
include('include/FormatDate.php');

$idUrusan=$_GET['I'];

mysql_select_db($database_connspkp, $connspkp);
//$query_RsUrusan = "SELECT * FROM tblurusan WHERE id='$idUrusan'";
$query_RsUrusan = "SELECT tblurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh,tblmesyuarat.TajukMesyuaratID FROM tblurusan
          INNER JOIN tblpengguna  ON tblurusan.idCipta=tblpengguna.id
          inner join tblmesyuarat on tblurusan.bilMesyuarat=tblmesyuarat.id
          WHERE tblurusan.id='$idUrusan'";
$RsUrusan = mysql_query($query_RsUrusan, $connspkp) or die(mysql_error());
$row_RsUrusan = mysql_fetch_assoc($RsUrusan);
$totalRows_RsUrusan = mysql_num_rows($RsUrusan);
$BilMesy=$row_RsUrusan['TajukMesyuaratID'];

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


$query_SemakAhliMsy = "SELECT a.penggunaID,b.Gelaran,b.Email from tbluruspengguna a inner join tblpengguna b on a.penggunaID=b.id where a.TajukMesyuaratID='$BilMesy' and a.kategoriID in ('1','2')";
$RsSemakAhliMsy = mysql_query($query_SemakAhliMsy, $connspkp) or die(mysql_error());
$row_RsSemakAhliMsy = mysql_fetch_assoc($RsSemakAhliMsy);
 $totalRows_RsSemakAhliMsy = mysql_num_rows($RsSemakAhliMsy);
?>


<?php include 'include/Popup.php'; ?>
<SCRIPT LANGUAGE="Javascript" SRC="include/FusionCharts.js"></SCRIPT>
<!--
<script>
function dahsemak()
{
   if (document.frmtambahurusan.bilCir.value == "")
  /*if ( document.getElementsByName('bilCir')[0].value == '' )*/
  {
    alert("Sila isi semua ruangan");
    document.frmtambahurusan.bilCir.focus();
    return false;
  }
  /* return true */
}
</script> -->

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

<div align="center" >
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
            <p>&nbsp;</p>
            </td>
            <td valign="top" align="center"><table class="table">
              <!--DWLayoutTable--> 
              <tr>
                <td width="743" height="336" valign="top"><p><font size="3"><span class="style9">KEMASKINI URUSAN </span></p>
		
                  <form method="post" enctype="multipart/form-data" name="frmUpdateurusan"  action="KemaskiniUrusan.php"?>
				  <table cellpadding="0" cellspacing="1" bgcolor="#999999" class="table">
                    <!--DWLayoutTable-->
                    <tr><td width="15%" bgcolor="#d8c0be"><font size="2" color="black">Jenis Urusan : </td></font>
                          <td bgcolor="#FFFFFF">
              <select name="selectJenisUrusan" >
                            <?php
                             mysql_select_db($database_connspkp, $connspkp);
                $sqlJenisUrusan = "SELECT * FROM tbljenisurusan ORDER BY desc_jenisurusan";
                            $rsJenisUrusan = mysql_query($sqlJenisUrusan, $connspkp) or die("Connection Failed!");
                          ?>
                           
                            <?php while ($row_rsJenisUrusan = mysql_fetch_array($rsJenisUrusan)) {
                              if ($row_RsUrusan['Jenis'] == $row_rsJenisUrusan['id_jenisurusan'] ) { ?>
                              <option selected value="<?php echo $row_rsJenisUrusan['id_jenisurusan']?>"> <?php echo $row_rsJenisUrusan['desc_jenisurusan']  ?> </option>
                              <?php }
                  else { ?>
                              <option  value="<?php echo $row_rsJenisUrusan['id_jenisurusan']?>"> <?php echo $row_rsJenisUrusan['desc_jenisurusan']  ?> </option>
                              <?php }
                             }
                ?>
                                </select>
                    </tr>
					<tr>
                          <td width="15%" bgcolor="#d8c0be"><font size="2" color="black">Gred Jawatan : </td></font>
                          <td bgcolor="#FFFFFF">
              <select name="gredJawatan" >
                            <?php
                             mysql_select_db($database_connspkp, $connspkp);
                             $sqlGredUrusan = "SELECT * FROM tblgred ORDER BY Keterangan";
                            $rsGredUrusan = mysql_query($sqlGredUrusan, $connspkp) or die("Connection Failed!");
                          ?>
                  
                            <?php while ($row_rsGredUrusan = mysql_fetch_array($rsGredUrusan)) {
                              if ($row_RsUrusan['gredJawatan'] == $row_rsGredUrusan['ID'] ) { ?>
                              <option selected value="<?php echo $row_rsGredUrusan['ID']?>"> <?php echo $row_rsGredUrusan['Keterangan']  ?> </option>
                              <?php }
                  else { ?>
                              <option value="<?php echo $row_rsGredUrusan['ID']?>"> <?php echo $row_rsGredUrusan['Keterangan']  ?> </option>
                              <?php }
                             }
                ?>
                                </select>

            </td>
                        </tr>
					 <tr>
                          <td width="15%" bgcolor="#d8c0be"><font size="2" color="black">Gred Hakiki Pegawai : </td></font>
                          <td bgcolor="#FFFFFF">
              <select name="gredurusan" >
                            <?php
                             mysql_select_db($database_connspkp, $connspkp);
                $sqlGredUrusan = "SELECT * FROM tblgred ORDER BY Keterangan";
                            $rsGredUrusan = mysql_query($sqlGredUrusan, $connspkp) or die("Connection Failed!");
                          ?>
                  
                            <?php while ($row_rsGredUrusan = mysql_fetch_array($rsGredUrusan)) {
                              if ($row_RsUrusan['GredUrusan'] == $row_rsGredUrusan['ID'] ) { ?>
                              <option selected value="<?php echo $row_rsGredUrusan['ID']?>"> <?php echo $row_rsGredUrusan['Keterangan']  ?> </option>
                              <?php }
                  else { ?>
                              <option value="<?php echo $row_rsGredUrusan['ID']?>"> <?php echo $row_rsGredUrusan['Keterangan']  ?> </option>
                              <?php }
                             }
                ?>
                                </select>

            </td>
                        </tr>
                    <tr>
                      <td width="15%" valign="top" bgcolor="#d8c0be"><font size="2" color="black"><p>Butiran : </p>
                      <td bgcolor="#FFFFFF"><textarea name="txtRingkasan" cols="70" rows="5" id="txtRingkasan" value=""><?php echo $row_RsUrusan['Ringkasan']; ?></textarea></td>
                    </tr>
                      <tr>
                      <td width="15%" valign="top" bgcolor="#d8c0be"><font size="2" color="black"><p>Keterangan Butiran : </p>
                      <td bgcolor="#FFFFFF"><textarea name="txtKeteranganRingkasan" cols="70" rows="10" id="txtKeteranganRingkasan" value=""><?php echo $row_RsUrusan['KeteranganRingkasan']; ?></textarea></td>
                    </tr>
                    <tr>
                      <td width="15%" height="17" bgcolor="#d8c0be"><font size="2" color="black">No Fail : </td></font>
                     <td bgcolor="#FFFFFF"><span class="style10">
                            <input name="txtNoKertas" type="text" id="txtNoKertas" size="74" value="<?php echo $row_RsUrusan['NoKertas']; ?>">
                          </span></td>
                    </tr>
                   <tr>
                    <td width="15%" height="17" bgcolor="#d8c0be"><font size="2" color="black">No. Ruj. Bahagian : </td></font>
					   <td bgcolor="#FFFFFF"><span class="style10">
                       <input name="rujbhg" type="text" id="rujbhg" size="74" value="<?php echo $row_RsUrusan['rujBhg']; ?>"></strong></td>
                    </tr>

						 <tr>
                          <td width="15%" height="17" bgcolor="#d8c0be"><font size="2" color="black">Mesyuarat</td></font>
                          <td bgcolor="#FFFFFF"><select name="bilMesyK" >
                            <?php
                             mysql_select_db($database_connspkp, $connspkp);
							
                $sqlJenisMes = "SELECT DISTINCT a.id,b.id as idMesyuarat, a.MesyuaratDesc,b.tarikhMesyuarat,b.siri FROM tblreftajukmesyuarat  a
								inner join tblmesyuarat b on a.id=b.TajukMesyuaratID
								inner join tbluruspengguna c on a.id=c.TajukMesyuaratID
								where a.actv_Mesyuarat=1 and c.penggunaID='$stridKemaskini' and b.status='Ya' order by a.MesyuaratDesc  asc limit 10";
                            $rsJenisMes = mysql_query($sqlJenisMes, $connspkp) or die("Connection Failed!");
							 
                          ?>
                            <?php while ($row_rsJenisMes = mysql_fetch_array($rsJenisMes)) {
							$timestamp = strtotime($row_rsJenisMes['tarikhMesyuarat']);
                              if ($BilMesy == $row_rsJenisMes['idMesyuarat'] ) { ?>
                            <option selected value="<?php echo $row_rsJenisMes['idMesyuarat']?>"><?php echo $row_rsJenisMes['MesyuaratDesc']?> Bil. <?php echo $row_rsJenisMes['siri'] ?>  Tahun <?php echo date("Y",$timestamp); ?>   pada <?php echo format_date($row_rsJenisMes['tarikhMesyuarat']); ?> </option>
                            <?php }
                  else {   ?>
                            <option value="<?php echo $row_rsJenisMes['idMesyuarat']?>"> <?php echo $row_rsJenisMes['MesyuaratDesc'] ?> Bil. <?php echo $row_rsJenisMes['siri'] ?> Tahun <?php echo date("Y", $timestamp); ?> pada <?php echo format_date($row_rsJenisMes['tarikhMesyuarat']); ?>  </option>


                            <?php }
                             }
                ?>
                          </select></td>
                        </tr>
						  <tr>
                          <td width="15%" height="17" bgcolor="#d8c0be"><font size="2" color="black">Dokumen : </td></font>
                          <td bgcolor="#FFFFFF"><span class="style10">
                          
                          Fail dimuatnaik: <input name="docuploaded" type="text" id="docuploaded" disabled="disabled" size="50" value="<?php echo $row_RsUrusan['Link']; ?>"><input type="file" name="file" id="file" onchange="return fileValidation()">

</span></td>
                        </tr>
					    <tr>
                          <td width="15%" height="17" bgcolor="#d8c0be"><font size="2" color="black"> Ahli Mesyuarat: </td></font>
                          <td bgcolor="#FFFFFF"><span class="style10">
                          <a href="ahliMesyuarat.php?p=<?php echo $BilMesy; ?>" target="_blank">Kemaskini Senarai Ahli Mesyuarat</a>

</span></td>
                        </tr>
						
						<tr>
                          <td width="15%" height="17" bgcolor="#d8c0be"><font size="2" color="black">Cetak </td></font>
                          <td bgcolor="#FFFFFF"><span class="style10">
                         <a href="CetakPaparan.php?I=<?php echo $row_RsUrusan['id']; ?>"  data-toggle="tooltip" title="Paparan Urusan" target="_blank">Paparan Urusan</a>

</span></td>
                       </tr>
<?php
$path =  $row_RsUrusan['Link'];

//Show filename with file extension
$ext = end(explode('.', $path));
//echo $ext;
?>
					<tr>
                          <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                          <td bgcolor="#FFFFFF"><span class="style10">
                            <!--<input type="submit" name="Submit2" value="Tambah">
                            <input type="submit" name="Submit3" value="Batal">-->
                            <input type="submit" name="Submit4" value="Kemaskini Maklumat Urusan"  onclick="return dahsemak()" >
                             <input type="hidden" name="idUrus" value="<?php echo $idUrusan?>">
							<?php if($totalRows_RsSemakAhliMsy ==0)
							{?>
							  <input type="submit" name="Submit2" disabled  title="Sila lantik Pengerusi/Ahli Mesyuarat terlebih dahulu" value="Hantar Urusan Kepada Pengerusi Dan Ahli Mesyuarat" >
							<?php }else
							 if($totalRows_RsSemakAhliMsy >0)
							 {?>
							  <input type="submit" name="Submit2" value="Hantar Urusan Kepada Pengerusi Dan Ahli Mesyuarat" formAction="upload_fileUpdate.php?I=<?php echo $row_RsUrusan['id'];?>" onClick = "if (! confirm('Anda pasti untuk Hantar Urusan Kepada Pengerusi Dan Ahli Mesyuarat?')) return false;">
							
							<?php } ?>
                          

                            <input type="submit" name="Submit3" value="Batal" formAction='utama.php'>

                          </span></td>
                        </tr>
</span></td>

</form>
<!--
                    <tr>
                      <td width="10%"  height="17" bgcolor="#999999"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      <!-- <td bgcolor="#FFFFFF">DWLayoutEmptyCell&nbsp;</td> -->
                      <!-- <td width="308" rowspan="9" bgcolor="#FFFFFF"><div align="center"> -->

            <?php
//echo "string: " . $row_RsUrusan['Jenis'];
            //phpinfo();
    //        if (isset($_POST['selectJenisUrusan']) && (!empty(isset($_POST['selectJenisUrusan'])))) {
    //        	$strJenisUrusan = $_POST['selectJenisUrusan'];
    //        } else {
    //        	$strJenisUrusan = $row_RsUrusan['Jenis'];
    //        }

            if(isset($_POST['selectJenisUrusan'])) { $strJenisUrusan = $_POST['selectJenisUrusan'];}
            if(isset($_POST['gredurusan'])) { $strGredUrusan = $_POST['gredurusan'];}
			if(isset($_POST['gredJawatan'])) { $strGredJawatan = $_POST['gredJawatan'];}
            if(isset($_POST['txtRingkasan'])) { $strRingkasan = $_POST['txtRingkasan'];}
            if(isset($_POST['txtNoKertas'])) { $strNoKertas = $_POST['txtNoKertas'];}
            if(isset($_POST['rujbhg'])) { $strNoRuj = $_POST['rujbhg'];}
            if(isset($_POST['bilMesyK'])) { $bilMesyK = $_POST['bilMesyK'];}
			if(isset($_POST['idUrus'])) { $idUrus = $_POST['idUrus'];}
			if(isset($_POST['txtKeteranganRingkasan'])) { $txtKeteranganRingkasan = $_POST['txtKeteranganRingkasan'];}
            $path =  $row_RsUrusan['Link'];
			$stridCipta=$_SESSION["idPengguna"];
	        $strTrCipta=$row_RsUrusan['TrCipta'];
	        $strTrSelesaiU=$row_RsUrusan['TrSelesaiU'];
             
	       // echo "adafafafa: ".  $row_RsUrusan['TrCipta'];
			$stridkemaskini=date("Y-m-j");
			$strStatus='Deraf';
			$NamaPenuh = $_SESSION["NamaPenuh"];
			$Login = $_SESSION["Login"];
			$Gelaran = $_SESSION["Gelaran"];


		if(isset($_POST['Submit4'])){
			                  //   move_uploaded_file($_FILES["file"]["tmp_name"],
							   // "upload/" . $_FILES["file"]["name"]);
								
								//UPDATED BY ZANA 30032020 BDR COVIC19
								//RENAME UPLOADED FILE NAME
								$newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["file"]["name"]));
							    move_uploaded_file($_FILES["file"]["tmp_name"],
							    "upload/" .$newfilename);
							    //echo "Fail anda telah berjaya di simpan dalam: " . "upload/" . $_FILES["file"]["name"];
							//    echo "$stridPengguna";
							    echo("<SCRIPT LANGUAGE='JavaScript'>
									window.alert('Fail anda telah berjaya di simpan')
									</SCRIPT>");


		//-------------------///////////////////SAVE in tblurusan & tblstatusurusan START////////////////////////////////////////////////////
								//$strKertas1 = $_FILES["file"]["name"];
								//$strLink1 = "upload/".$_FILES["file"]["name"];
								
								$strKertas1 = $newfilename;
								$strLink1 = "upload/".$newfilename;

								if (empty($newfilename)) {
								    $strLink1 = $row_RsUrusan['Link'] ;
								    $strKertas1 = basename($strLink1);
								    //echo $strLink1; die();
								}

								$strKertas = mysql_real_escape_string($strKertas1);
								$strLink = mysql_real_escape_string($strLink1);
								//echo "Dokumen: " .$strLink;die();


		mysql_select_db($database_connspkp, $connspkp);
    //	$allowed =("UPDATE tblurusan SET Jenis = '$strJenisUrusan', Ringkasan = '$strRingkasan', GredUrusan = '$strGredUrusan', NoKertas = '$strNoKertas', Kertas = '$strKertas',rujBhg ='$strNoRuj',  bilMesyuarat = '$vbilCir', idCipta='$stridCipta', TrCipta = '$strTrCipta', Link = '$strLink',idkemaskini ='$stridCipta', TrKemaskini ='$stridkemaskini', TrSelesaiU = '$strTrSelesaiU',Status = '$strStatus'  WHERE id = '$idUrusan' ");
	    //update zana 30032020  BDR COVIC 19 
		if($_FILES["file"]["name"]<>""){
		echo 	$allowed =("UPDATE tblurusan SET Jenis = '$strJenisUrusan', Ringkasan = '$strRingkasan', GredUrusan = '$strGredUrusan', gredJawatan = '$strGredJawatan',NoKertas = '$strNoKertas', Kertas = '$strKertas',rujBhg ='$strNoRuj',  bilMesyuarat = '$bilMesyK', Link = '$strLink',idkemaskini ='$stridCipta', TrKemaskini ='$stridkemaskini',Status = '$strStatus',KeteranganRingkasan='$txtKeteranganRingkasan'  WHERE id = '$idUrus' ");
		}else 
		if($_FILES["file"]["name"]==""){
	echo	$allowed =("UPDATE tblurusan SET Jenis = '$strJenisUrusan', Ringkasan = '$strRingkasan', GredUrusan = '$strGredUrusan', gredJawatan = '$strGredJawatan', NoKertas = '$strNoKertas', Kertas = '$strKertas',rujBhg ='$strNoRuj',  bilMesyuarat = '$bilMesyK',idkemaskini ='$stridCipta', TrKemaskini ='$stridkemaskini',Status = '$strStatus' ,KeteranganRingkasan='$txtKeteranganRingkasan'  WHERE id = '$idUrus' ");
		}
    	//var_dump($allowed);die();
 $s = mysql_query($allowed, $connspkp);
header("location:Utama.php");

		}
        ?>

            </div></td>
                    <!-- </tr> -->


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
mysql_free_result($RsKemaskini);
mysql_free_result($RsStatusUrusan);
?>
