<?php require_once('Connections/connspkp.php'); ?>
<?php session_start();

//edited by zana 932020
//if($_SESSION["Kumpulan"] !='urusetia' ){
//    header("Location: Logout.php");
//  };
if($_SESSION["kategori"] !='5' ){
    if($_SESSION["kategori"] !='4' )
	{
    header("Location: Logout.php");
	}
  };
  $stridKemaskini=$_SESSION["idPengguna"];
?>
<?php
include 'include/Popup.php';
include('include/FormatDate.php');


?><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<Script Language='JavaScript' src='RemoteScriptServer.js'> //ini untuk </Script>
<script>
/****************************************************************************
 *** Function untuk send variable ke page yang akan query untuk sub list START***
 setiap sub perlu ada page php sendiri. Cth sub1.php, sub2.php, etc.
 setiap page akan query sub list nya sendiri.
 ***************************************************************************/

var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()+1
if (month<10)
month="0"+month
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym

function SelectJenisUrusan(strFileName,strTy){
  var URL = "";
  if(strTy=='A'){
    itemKategori = document.frmtambahurusan.selectKategori.value;
    URL = strFileName + '?itemKategori=' + itemKategori;

  } else
    if(strTy=='B'){
    //'B' sekiranya ada sub kedua daripada selection sub yang pertama
    //ClearListBox('lstkepakaran');
    //itemsubcategory = document.frm.itemsubcategory.value;
    //URL = strFileName + '?itemsubcategory=' + itemsubcategory;

  }else if(strTy=='C'){
    //'C' sekiranya ada sub ketiga daripada selection sub yang ketiga
    //ClearListBox('lstkepakaran');
    //itemjenis = document.frm.itemjenis.value;
    //URL = strFileName + '?itemjenis=' + itemjenis;
  }
  callToServer(URL);
}
/****************************************************************************
 *** Function untuk send variable ke page yang akan query untuk sub list END***
 ***************************************************************************/

/****************************************************************************
 *** Function untuk retrieve variable dari page yang query untuk sub list tadi START***
 ***************************************************************************/
function handleResponse(ID,Data,lst){
  strID = new String(ID);
  strData = new String(Data);

  if(strID == ''){
    document.frmtambahurusan.elements[lst].length = 0;
    document.frmtambahurusan.elements[lst].options[0]= new Option('Sila Pilih','00');
  }else{
    splitID = strID.split(",");
    splitData = strData.split(",");
    document.frmtambahurusan.elements[lst].options[0]= new Option('Sila Pilih','00');
    for(i=1;i<=splitID.length;i++){
      document.frmtambahurusan.elements[lst].options[i]= new Option(splitData[i-1],splitID[i-1]);
    }
    document.frmtambahurusan.elements[lst].length = splitID.length + 1;
  }
}
/****************************************************************************
 *** Function untuk retrieve variable dari page yang query untuk sub list tadi END***
 ***************************************************************************/

//-->
</Script>

<script>
function dahsemak()
{
     if(document.frmtambahurusan.selectJenisUrusan.selectedIndex=="")
	{
		alert ( "Sila pilih jenis urusan!");
		return false;
	}
	
     if(document.frmtambahurusan.gredurusan.selectedIndex=="")
	{
		alert ( "Sila pilih gred urusan!");
		return false;
	}
 
    var x = document.forms["frmInsert"]["txtRingkasan"].value;
        if (x == "") {
         alert("Butiran wajib diisi");
         return false;
     }
  
   if(document.frmtambahurusan.bilMesyK.selectedIndex=="")
	{
		alert ( "Sila pilih Mesyuarat!");
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
<style type="text/css">
<!--
body {
  margin-left: 0px;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
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
            <p>&nbsp;</p>            </td>
            <td valign="top" align="center"><table class="table">
              <!--DWLayoutTable-->
              <tr>
                  <td width="743" height="336" valign="top"><p><font size="3"><span class="style9">TAMBAH URUSAN </span></p>
				  <form action="upload_draf.php" method="post" enctype="multipart/form-data" name="frmtambahurusan"  onsubmit="return dahsemak()">
                      <table  cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">
                        <!--DWLayoutTable-->
                        <!--<tr>
                          <td width="123" height="36" bgcolor="#999999">Kategori : </td>
                          <td width="610" bgcolor="#FFFFFF">
                  <?php
                $itemKategori="";
                ?>
                              <select name="selectKategori" onchange="SelectJenisUrusan('JenisUrusan.php','A')">
                            <?php
                            mysql_select_db($database_connspkp, $connspkp);
                $sqlKategori = "SELECT * FROM tblkategori ORDER BY desc_kategori";
                            $rsKategori = mysql_query($sqlKategori, $connspkp) or die("Connection Failed!");
                          ?>
                            <option value=" ">Sila Pilih</option>
                            <?php while ($row_rsKategori = mysql_fetch_array($rsKategori)) {
                              if ($itemKategori == $row_rsKategori['desc_kategori'] ) { ?>
                              <option selected value="<?php echo $row_rsKategori['desc_kategori']?>"> <?php echo $row_rsKategori['desc_kategori']  ?> </option>
                              <?php }
                  else { ?>
                              <option value="<?php echo $row_rsKategori['desc_kategori']?>"> <?php echo $row_rsKategori['desc_kategori']  ?> </option>
                              <?php }
                             }
                ?>
                                </select>
              </td>
                        </tr> -->
                        <tr>
                          <td width="15%" bgcolor="#d8c0be"><font size="2" color="#FF0000">* </font>Jenis Urusan : </td>
                          <td bgcolor="#FFFFFF">
              <select name="selectJenisUrusan" >
                            <?php
                             mysql_select_db($database_connspkp, $connspkp);
                $sqlJenisUrusan = "SELECT id_jenisurusan,desc_jenisurusan FROM tbljenisurusan where actv_jenisurusan=1 ORDER BY desc_jenisurusan";
                            $rsJenisUrusan = mysql_query($sqlJenisUrusan, $connspkp) or die("Connection Failed!");
							$itemKategori="";
                          ?>
                            <option value=" ">Sila Pilih</option>
                            <?php while ($row_rsJenisUrusan = mysql_fetch_array($rsJenisUrusan)) {
                              if ($itemKategori == $row_rsJenisUrusan['id_jenisurusan'] ) { ?>
                              <option selected value="<?php echo $row_rsJenisUrusan['id_jenisurusan']?>"> <?php echo $row_rsJenisUrusan['desc_jenisurusan']  ?> </option>
                              <?php }
                  else { ?>
                              <option value="<?php echo $row_rsJenisUrusan['id_jenisurusan']?>"> <?php echo $row_rsJenisUrusan['desc_jenisurusan']  ?> </option>
                              <?php }
                             }
                ?>
                                </select>            </td>
                        </tr>
                        <tr>
                          <td width="15%" bgcolor="#d8c0be"><font size="2" color="#FF0000">* </font>Gred Jawatan: </td>
                          <td bgcolor="#FFFFFF"><select name="gredJawatan" >
                            <?php
                             mysql_select_db($database_connspkp, $connspkp);
               				 $sqlGredUrusan = "SELECT ID, Keterangan FROM tblgred ORDER BY Keterangan";
                            $rsGredUrusan = mysql_query($sqlGredUrusan, $connspkp) or die("Connection Failed!");
							$itemKategori="";
                          	?>
                            <option value=" ">Sila Pilih</option>
                            <?php while ($row_rsGredUrusan = mysql_fetch_array($rsGredUrusan)) {
                              if ($itemKategori == $row_rsGredUrusan['ID'] ) { ?>
                            <option selected="selected" value="<?php echo $row_rsGredUrusan['ID']?>"> <?php echo $row_rsGredUrusan['Keterangan']  ?> </option>
                            <?php }
                  				else { ?>
                            <option value="<?php echo $row_rsGredUrusan['ID']?>"> <?php echo $row_rsGredUrusan['Keterangan']  ?> </option>
                            <?php }
                             	}
                			?>
                          </select></td>
                        </tr>
                        <tr>
                          <td width="15%" bgcolor="#d8c0be"><font size="2" color="#FF0000">* </font>Gred Hakiki Pegawai: </td>
                          <td bgcolor="#FFFFFF">
              		       <select name="gredurusan" >
                            <?php
                             mysql_select_db($database_connspkp, $connspkp);
               				 $sqlGredUrusan = "SELECT ID, Keterangan FROM tblgred ORDER BY Keterangan";
                            $rsGredUrusan = mysql_query($sqlGredUrusan, $connspkp) or die("Connection Failed!");
							$itemKategori="";
                          	?>
                            <option value=" ">Sila Pilih</option>
                            <?php while ($row_rsGredUrusan = mysql_fetch_array($rsGredUrusan)) {
                              if ($itemKategori == $row_rsGredUrusan['ID'] ) { ?>
                              <option selected value="<?php echo $row_rsGredUrusan['ID']?>"> <?php echo $row_rsGredUrusan['Keterangan']  ?> </option>
                              <?php }
                  				else { ?>
                              <option value="<?php echo $row_rsGredUrusan['ID']?>"> <?php echo $row_rsGredUrusan['Keterangan']  ?> </option>
                              <?php }
                             	}
                			?>
                    </select>            </td>
                        </tr>
                        <tr>
                          <td width="15%" valign="top" bgcolor="#d8c0be"><font size="2" color="#FF0000">* </font>Butiran :                          </td></font>
                          <td bgcolor="#FFFFFF"><textarea name="txtRingkasan" cols="70" rows="5" id="txtRingkasan"></textarea></td>
                        </tr>
						 <tr>
                          <td width="15%" valign="top" bgcolor="#d8c0be"><font size="2" color="#FF0000">* </font>Keterangan Butiran:                          </td></font>
                          <td bgcolor="#FFFFFF"><textarea name="txtKeteranganRingkasan" cols="70" rows="10" id="txtKeteranganRingkasan"></textarea></td>
                        </tr>
                        <tr>
                          <td width="15%" height="17" bgcolor="#d8c0be"><font size="2" color="black">No Fail : </td></font>
                          <td bgcolor="#FFFFFF"><span class="style10">
                            <input name="txtNoKertas" type="text" id="txtNoKertas" size="74">
                          </span></td>
                        </tr>
                        <tr>
                          <td width="15%" height="17" bgcolor="#d8c0be"><font size="2" color="black">No. Ruj. Bahagian : </td></font>
                          <td bgcolor="#FFFFFF"><span class="style10">
                            <input name="rujbhg" type="text" id="rujbhg" size="74" />
                          </span></td>
                        </tr>
                         <tr>
                          <td width="15%" height="17" bgcolor="#d8c0be"><font size="2" color="#FF0000">* </font>Mesyuarat</td>
                          <td bgcolor="#FFFFFF"><select name="bilMesyK" >
                            <?php
                             mysql_select_db($database_connspkp, $connspkp);
                 $sqlJenisMes = "SELECT DISTINCT a.id,b.id as idMesyuarat, a.MesyuaratDesc,b.tarikhMesyuarat,b.siri FROM tblreftajukmesyuarat  a
								inner join tblmesyuarat b on a.id=b.TajukMesyuaratID
								inner join tbluruspengguna c on a.id=c.TajukMesyuaratID
								where a.actv_Mesyuarat=1 and c.penggunaID='$stridKemaskini' and b.status='Ya' order by b.trCipta  asc limit 10";
                            $rsJenisMes = mysql_query($sqlJenisMes, $connspkp) or die("Connection Failed!");
							$bileCir=""
                          ?>
                            <option value="">Sila Pilih</option>
                            <?php while ($row_rsJenisMes = mysql_fetch_array($rsJenisMes)) {
                              if ($bileCir == $row_rsJenisMes['idMesyuarat'] ) { ?>
                            <option selected="selected" value="<?php echo $row_rsJenisMesy['idMesyuarat']?>"><?php echo $sqlJenisMes['MesyuaratDesc']?> </option>
                            <?php }
                  else {  $timestamp = strtotime($row_rsJenisMes['tarikhMesyuarat']);?>
                            <option value="<?php echo $row_rsJenisMes['idMesyuarat']?>"> <?php echo $row_rsJenisMes['MesyuaratDesc'] ?> Bil. <?php echo $row_rsJenisMes['siri'] ?> Tahun <?php echo date("Y", $timestamp); ?> pada <?php echo format_date($row_rsJenisMes['tarikhMesyuarat']); ?>  </option>


                            <?php }
                             }
                ?>
                          </select></td>
                        </tr>
            <tr>
                          <td width="15%" height="17" bgcolor="#d8c0be"><font size="2" color="#FF0000">* </font>Dokumen : </td>
                          <td bgcolor="#FFFFFF"><span class="style10">
                          <input type="file" name="file" id="file" onchange="return fileValidation()">
</span>(* Sila muat naik fail format .PDF sahaja)</td>
                        </tr>

                        <tr>
                          <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                          <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                          <td bgcolor="#FFFFFF"><span class="style10">
                          <input type="submit" name="Submit4" value="Deraf" formAction='upload_draf.php'>
                          <!--<input type="submit" name="Submit2" value="Hantar" formAction='upload_file.php'>-->
                          <input type="submit" name="Submit3" value="Batal" formAction='Utama.php'>
                          </span></td>
                        </tr>
                      </table>
                  </form>                    <p>&nbsp;                </p>                    <p>&nbsp;                </p></td>
                </tr>
                                </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#7d1935"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
          </tr>
      </table></td>
    </tr>

    <tr>
      <td height="0"></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</div>
