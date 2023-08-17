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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmTambah")) {

					   $Gelaran=mysql_real_escape_string($_POST['selectGelaran']);
                       $NoKp=$_POST['txtNoKp'];
                       $NamaPenuh=mysql_real_escape_string($_POST['txtNamaPenuh']);
                       $Jawatan=$_POST['txtJawatan'];
                       $Gred=$_POST['selectGred'];
                       $Bahagian=$_POST['selectBahagian'];
                       $NoHp=$_POST['txtNoHp'];
                       $Email=$_POST['txtEmail'];
                       $Login=$_POST['txtLogin'];
                       $KLaluan=(md5($_POST['txtKLaluan']));
                     //  $Kategori=$_POST['selectKategori'];
                       $Status=$_POST['selectStatus'];
                      // $Group_id=$_POST['selectGroup_id'];
					   $Susunan=$_POST['txtSusunan'];



//------------------check user existence & active -----------------------------------------------------------------------------//
		  mysql_select_db($database_connspkp, $connspkp);

			$resultcheck = mysql_query("select * from tblpengguna WHERE Login = '$Login' and Status ='aktif' " );
			$myrowscheck = mysql_num_rows($resultcheck);
			if ($myrowscheck  > 0) {

				echo("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Maaf, Login yang didaftarkan telah wujud dan pengguna tersebut masih aktif. Sila daftar Login yang baru')
				</SCRIPT>");

								}
//------------------check user existence & active -----------------------------------------------------------------------------//
			else{
  				/*	$insertSQL = sprintf("INSERT INTO tblpengguna (Gelaran, NoKp, NamaPenuh, Jawatan, Gred, Bahagian, NoHp, Email, Login, Klaluan, Kumpulan, Status, Susunan, Group_id)
  						VALUES
						('$Gelaran', '$NoKp', '$NamaPenuh', '$Jawatan', '$Gred', '$Bahagian', '$NoHp', '$Email', '$Login', '$KLaluan', '$Kategori', '$Status', '$Susunan', '$Group_id')");*/

                     $insertSQL = sprintf("INSERT INTO tblpengguna (Gelaran, NoKp, NamaPenuh, Jawatan, Gred, Bahagian, NoHp, Email, Login, Klaluan, Status, Susunan)
  						VALUES
						('$Gelaran', '$NoKp', '$NamaPenuh', '$Jawatan', '$Gred', '$Bahagian', '$NoHp', '$Email', '$Login', '$KLaluan', '$Status', '$Susunan')");
  						mysql_select_db($database_connspkp, $connspkp);
  						$Result1 = mysql_query($insertSQL, $connspkp) or die(mysql_error());

						include('Logger.php');
						logMe("Tambah Pengguna: ".$NamaPenuh);


  						$insertGoTo = "Pengguna.php";
  						if (isset($_SERVER['QUERY_STRING'])) {
    					$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    					$insertGoTo .= $_SERVER['QUERY_STRING'];
  						}
  						header(sprintf("Location: %s", $insertGoTo));
				}
}
?>

<?php //include 'include/Popup.php';?><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script>
  
  		function ValidateEmail(inputText)
		{
			var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				if(inputText.value.match(mailformat))
				{
					document.frmTambah.txtEmail.focus();     
					return true;
				}
				else
				{
					alert("You have entered an invalid email address!");
					document.frmTambah.txtEmail.focus();
					return false;
				}
		}
		
		
		function validateForm() 
		{

  			 if(document.frmTambah.selectGelaran.selectedIndex=="")
			{
				alert ( "Sila pilih Gelaran!");
				return false;
	        }
	
  			var x = document.forms["frmTambah"]["txtEmail"].value;
  			if (x == "") {
   				 alert("Emel wajib diisi");
   				 return false;
 			 }
  
 		   var x = document.forms["frmTambah"]["txtNamaPenuh"].value;
  			if (x == "") {
  			   alert("Nama Penuh wajib diisi");
    			return false;
		   }
           var x = document.forms["frmTambah"]["txtLogin"].value;
  			if (x == "") {
  			   alert("Login wajib diisi");
    			return false;
		   }
		   
            var x = document.forms["frmTambah"]["txtKLaluan"].value;
  			if (x == "") {
  			   alert("Kata Laluan wajib diisi");
    			return false;
		   }
		return true;
	
		}
		
		
		
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
	color: #6699CC;
	font-weight: bold;
}
-->
</style>
<script language="javascript" type="text/javascript" src="include/datetimepick/datetimepicker.js">

//Date Time Picker script- by TengYong Ng of http://www.rainforestnet.com
//Script featured on JavaScript Kit (http://www.javascriptkit.com)
//For this script, visit http://www.javascriptkit.com

</script>

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
            <td width="250" height="338" valign="top"><?php include 'include/menuadmin.php'; ?>
            <p>&nbsp;</p>
            </td>
            <td valign="top" align="center"><table class="table">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><font size="3"><span class="style9">TAMBAH PENGGUNA </span></p>
                  <form action="<?php echo $editFormAction; ?>" method="POST" name="frmTambah" id="frmTambah" onsubmit="return validateForm()" >
                    <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="table">
                      <!--DWLayoutTable-->
                      <tr bgcolor="#897270">
                        <td colspan="4"><span class="style1"><font size="2"> MAKLUMAT PENGGUNA </span></td></font>                      </tr>
                      <tr>
                        <td width="80" bgcolor="#d8c0be"><font size="2">Gelaran : </td></font>
                        <td width="247" bgcolor="#FFFFFF">
                        <!--<input name="selectGelaran" type="text" id="selectGelaran" size="35">-->
                        <select name="selectGelaran" id="selectGelaran">
                          <option>Sila Pilih</option>
                          <option value="Encik">Encik</option>
                          <option value="Tuan">Tuan</option>
                          <option value="Puan">Puan</option>
                          <option value="Datuk">Datuk</option>
                          <option value="Dato'">Dato'</option>
                          <option value="Tan Sri">Tan Sri</option>
                        </select>
                        <span style="color:#FF0000" >&nbsp;* </span>                        </td>
                        <td width="79" bgcolor="#d8c0be"><font size="2">Nama Penuh: </td></font>
                        <td width="322" bgcolor="#FFFFFF"><input name="txtNamaPenuh" type="text" id="txtNamaPenuh" size="45">
        <span style="color:#FF0000" >&nbsp;* </span>   </td>
                      </tr>
						<script>
						function numberOnly(input){
							var regex = /[^0-9]/g;
							input.value = input.value.replace(regex,"");

						}
						 </script>
                      <tr>

                        <td bgcolor="#d8c0be"><font size="2">No KP : </td></font>
                        <td bgcolor="#FFFFFF"><input name="txtNoKp" type="text" id="txtNoKp" maxlength="12" size="35" onkeyup="numberOnly(this)"></td>
                        <td bgcolor="#d8c0be"><font size="2">No Hp : </td></font>
                        <td bgcolor="#FFFFFF"><input name="txtNoHp" type="text" id="txtNoHp" placeholder= "01123456789" maxlength="11" size="35" onkeyup="numberOnly(this)"></td>
                      </tr>

                      <tr>
                        <td bgcolor="#d8c0be"><font size="2">Email : </td></font>
                        <td bgcolor="#FFFFFF"><input name="txtEmail" type="text" id="txtEmail" size="35" onclick="ValidateEmail(document.frmTambah.txtEmail)">
                        <span style="color:#FF0000" >&nbsp;* </span>  </td>
                        <td bgcolor="#d8c0be"><font size="2">No. Susunan: </td></font>
                        <td bgcolor="#FFFFFF"><input name="txtSusunan" type="text" id="txtSusunan" size="2" maxlength="3" ></td>
                      </tr>

                      <tr bgcolor="#897270">
                        <td colspan="4"><span class="style1"><font size="2"> MAKLUMAT JAWATAN </span></td></font>                      </tr>

                      <tr>
                        <td height="17" bgcolor="#d8c0be"><font size="2">Jawatan : </td></font>
                        <td bgcolor="#FFFFFF"><input name="txtJawatan" type="text" id="txtJawatan" size="35"></td>

                        <td bgcolor="#d8c0be"><font size="2">Gred : </td></font>
                        <!--<td bgcolor="#FFFFFF"><input name="txtGred" type="text" id="txtGred"></td>-->
                        <td><select name="selectGred" id="select2">
                          <?php
                             mysql_select_db($database_connspkp, $connspkp);
                            $sqlGred = "SELECT ID, Keterangan FROM `tblgred` order by Keterangan asc";

                            $rsGred= mysql_query($sqlGred, $connspkp) or die("Connection Failed!");
							$itemGred=""
                          ?>
                          <option value=" ">Sila Pilih</option>
                          <?php while ($row_rsGred= mysql_fetch_array($rsGred)) {
                              if ($itemGred == $row_rsGred['ID'] ) { ?>
                          <option selected value="<?php echo $row_rsGred['ID']?>"> <?php echo $row_rsGred['Keterangan']  ?> </option>
                          <?php }
                  			  else { ?>
                          <option value="<?php echo $row_rsGred['ID']?>"> <?php echo $row_rsGred['Keterangan']  ?> </option>
                          <?php }
                             }
                           ?>
                        </select></td>
                      </tr>

                      <tr>
                        <td height="17" bgcolor="#d8c0be"><font size="2">Bahagian : </td></font>
                        <td bgcolor="#FFFFFF">
                        <select name="selectBahagian" id="select">
 				
                            <?php
                             mysql_select_db($database_connspkp, $connspkp);
                            $sqlBahagian = "SELECT id, Bahagian FROM tblbahagian order by Bahagian ASC";

                            $rsBahagian= mysql_query($sqlBahagian, $connspkp) or die("Connection Failed!");
							$itemBahagian=""
                          ?>
                            <option value=" ">Sila Pilih</option>
                            <?php while ($row_rsBahagian= mysql_fetch_array($rsBahagian)) {
                              if ($itemMesy == $row_rsBahagian['id'] ) { ?>
                              <option selected value="<?php echo $row_rsBahagian['id']?>"> <?php echo $row_rsBahagian['Bahagian']  ?> </option>
                              <?php }
                  			  else { ?>
                              <option value="<?php echo $row_rsBahagian['id']?>"> <?php echo $row_rsBahagian['Bahagian']  ?> </option>
                              <?php }
                             }
                           ?>
                                </select>						</td>
                      </tr>

                      <tr bgcolor="#897270">
                        <td height="17" colspan="4"><span class="style1"><font size="2">MAKLUMAT BERKAITAN SISTEM (Wajib Isi) </span></td></font>                      </tr>
                      <tr>
                        <td height="17" bgcolor="#d8c0be"><font size="2">Nama Login : </td></font>
                        <td bgcolor="#FFFFFF"><input name="txtLogin" type="text" id="txtLogin">
       <span style="color:#FF0000" >&nbsp;* </span> </td>
                        <td bgcolor="#d8c0be"><font size="2">Kata Laluan : </td></font>
                        <td bgcolor="#FFFFFF"><input name="txtKLaluan" type="text" id="txtKLaluan">
        <span style="color:#FF0000" >&nbsp;* </span></td>
                      </tr>

        <tr>
                  <td height="17" bgcolor="#d8c0be"><font size="2">&nbsp; </td></font>
                  <td bgcolor="#FFFFFF">&nbsp;
                     <!-- <select name="selectKategori" id="select">
 				
                            <?php
                             mysql_select_db($database_connspkp, $connspkp);
                            $sqlKategori = "SELECT id_kategori, desc_kategori FROM tblkategori order by desc_kategori asc";

                            $rsKategori= mysql_query($sqlKategori, $connspkp) or die("Connection Failed!");
							$itemKategori=""
                          ?>
                            <option value=" ">Sila Pilih</option>
                            <?php while ($row_rsKategori= mysql_fetch_array($rsKategori)) {
                              if ($itemKategori== $row_rsKategori['id_kategori'] ) { ?>
                              <option selected value="<?php echo $row_rsKategori['id']?>"> <?php echo $row_rsKategori['desc_kategori']  ?> </option>
                              <?php }
                  			  else { ?>
                              <option value="<?php echo $row_rsKategori['id_kategori']?>"> <?php echo $row_rsKategori['desc_kategori']  ?> </option>
                              <?php }
                             }
                           ?>
                                </select>     -->             </td>

            <td bgcolor="#d8c0be"><font size="2">Status : </td></font>
                        <td bgcolor="#FFFFFF"><select name="selectStatus" id="selectStatus">
                            <option>Aktif</option>
                            <option>Tidak Aktif</option>
                          </select>                        </td>
        </tr>

                      <tr>
                        <td height="17" colspan="4" bgcolor="#ffffff"><span class="style10"> </span></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td colspan="3" bgcolor="#FFFFFF"><span class="style10">
                          <input type="submit" name="Submit2" value="Tambah">
                          <input type="reset" name="Submit3" value="Batal">
                        </span></td>
                      </tr>
                      <tr>
                        <td height="17" colspan="4" bgcolor="#FFFFFF"><span class="style10"> </span></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="frmTambah">
                  </form></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#FF8C00"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
          </tr
                        ></table></td>
    </tr>
  </table>
</div>
