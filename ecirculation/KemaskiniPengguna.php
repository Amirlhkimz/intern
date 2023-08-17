<?php require_once('Connections/connspkp.php'); ?>
<?php
ob_start();
session_start();

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
$idPengguna3=$_GET["I"];

mysql_select_db($database_connspkp, $connspkp);
$query_RsPengguna = "SELECT * FROM tblpengguna WHERE id='$idPengguna3'";
$RsPengguna = mysql_query($query_RsPengguna, $connspkp) or die(mysql_error());
$row_RsPengguna = mysql_fetch_assoc($RsPengguna);
$totalRows_RsPengguna = mysql_num_rows($RsPengguna);
?>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmUpdate")) {

                       $idPengguna2=$_POST['txtid'];
                       $Gelaran2=mysql_real_escape_string($_POST['selectGelaran']);
                       $NoKp2=$_POST['txtNoKp'];
                        echo"nama".$NamaPenuh2=$_POST['txtNamaPenuh'];
                       $Jawatan2=$_POST['txtJawatan'];
                      echo"gred".$Gred2=$_POST['txtGred'];
                      echo"bahagian".$Bahagian2=$_POST['selectBahagian'];
                       $NoHp2=$_POST['txtNoHp'];
                       $Email2=$_POST['txtEmail'];
                       $Login2=$_POST['txtLogin'];
                       if($_POST['checkboxpass']=='KemaskiniPass'){
                          $KLaluan2=(md5($_POST['txtKLaluan']));
                          $strKemaskiniMyPass = "KLaluan='".$KLaluan2."', ";
                       }
                     //  $Kategori2=$_POST['selectKategori'];
                       $Status2=$_POST['selectStatus'];
                     //  $Group_id2=$_POST['selectGroup_id'];
                       $Susunan=$_POST['txtSusunan'];
  //$Gelaran2


/*  $updateSQL = sprintf("UPDATE tblpengguna
              SET Gelaran='$Gelaran2', Group_Id ='$Group_id2', NoKp='$NoKp2', NamaPenuh='$NamaPenuh2', Jawatan='$Jawatan2', Gred='$Gred2', Bahagian='$Bahagian2', NoHp='$NoHp2', Email='$Email2', Login='$Login2', ".$strKemaskiniMyPass." Kumpulan='$Kategori2' , Status='$Status2', Susunan='$Susunan'
              WHERE
            id='$idPengguna2'");*/
			
			  if($_POST['checkboxpass']=='KemaskiniPass'){
 $updateSQL = sprintf("UPDATE tblpengguna
              SET Gelaran='$Gelaran2', NoKp='$NoKp2', NamaPenuh='$NamaPenuh2', Jawatan='$Jawatan2', Gred='$Gred2', Bahagian='$Bahagian2', NoHp='$NoHp2', Email='$Email2', Login='$Login2', ".$strKemaskiniMyPass." Status='$Status2', Susunan='$Susunan'
              WHERE
            id='$idPengguna2'");
} else
{
 $updateSQL = sprintf("UPDATE tblpengguna
              SET Gelaran='$Gelaran2', NoKp='$NoKp2', NamaPenuh='$NamaPenuh2', Jawatan='$Jawatan2', Gred='$Gred2', Bahagian='$Bahagian2', NoHp='$NoHp2', Email='$Email2', Login='$Login2', Status='$Status2', Susunan='$Susunan'
              WHERE
            id='$idPengguna2'");
}
  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($updateSQL, $connspkp) or die(mysql_error());

		include('Logger.php');
		logMe("Kemas kini pengguna: ".$idPengguna2."(".$NamaPenuh2.")");


 $insertGoTo = "Pengguna.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<?php include 'include/Popup.php';?><head>
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
					document.frmUpdate.txtEmail.focus();     
					return true;
				}
				else
				{
					alert("You have entered an invalid email address!");
					document.frmUpdate.txtEmail.focus();
					return false;
				}
		}
		
		
		function validateForm() 
		{

	
  			var x = document.forms["frmUpdate"]["txtEmail"].value;
  			if (x == "") {
   				 alert("Emel wajib diisi");
   				 return false;
 			 }
  
 		   var x = document.forms["frmUpdate"]["txtNamaPenuh"].value;
  			if (x == "") {
  			   alert("Nama Penuh wajib diisi");
    			return false;
		   }
           var x = document.forms["frmUpdate"]["txtLogin"].value;
  			if (x == "") {
  			   alert("Login wajib diisi");
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
.style11 {color: #FF0000}
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
                <td width="743" height="336" valign="top"><p><span class="style9">KEMAS KINI PENGGUNA </span></p>
                  <form action="<?php echo $editFormAction; ?>" method="POST" name="frmUpdate" id="frmUpdate" onclick="return validateForm()">
                    <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">
                      <!--DWLayoutTable-->
                      <tr bgcolor="#897270">
                        <td colspan="4"><span class="style1"><img src="images/arrow.gif" width="12" height="10"> MAKLUMAT PENGGUNA </span></td>
                      </tr>
                      <tr>
                        <td width="80" bgcolor="#d8c0be">Gelaran : </td>
                        <td width="252" bgcolor="#FFFFFF">
                        <!--<input name="selectGelaran" type="text" id="selectGelaran" value="<?php echo $row_RsPengguna['Gelaran']; ?>" size="35">-->
                          <select name="selectGelaran" size="1" id="selectGelaran">
                          <option <?php if ($row_RsPengguna['Gelaran'] == "Encik" ) echo 'selected' ; ?> value="Encik" >Encik</option>
						  <option <?php if ($row_RsPengguna['Gelaran'] == "Tuan" ) echo 'selected' ; ?> value="Tuan" >Tuan</option>
						  <option <?php if ($row_RsPengguna['Gelaran'] == "Puan" ) echo 'selected' ; ?> value="Puan" >Puan</option>
						  <option <?php if ($row_RsPengguna['Gelaran'] == "Datuk" ) echo 'selected' ; ?> value="Datuk" >Datuk</option>
						  <option <?php if ($row_RsPengguna['Gelaran'] == "Dato'" ) echo 'selected' ; ?> value="Dato'" >Dato'</option>
						  <option <?php if ($row_RsPengguna['Gelaran'] == "Tan Sri" ) echo 'selected' ; ?> value="Tan Sri" >Tan Sri</option>
						  
                          </select>
						
                        *<script>
						function numberOnly(input){
							var regex = /[^0-9]/g;
							input.value = input.value.replace(regex,"");

						}
						 </script>
                        </td>
                        <td width="81" bgcolor="#d8c0be">Nama Penuh: </td>
                        <td width="317" bgcolor="#FFFFFF"><input name="txtNamaPenuh" type="text" id="txtNamaPenuh" value="<?php echo $row_RsPengguna['NamaPenuh']; ?>" size="45">
                        *
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#d8c0be">No KP : </td>
                        <td bgcolor="#FFFFFF"><input name="txtNoKp" type="text" id="txtNoKp" value="<?php echo $row_RsPengguna['NoKp']; ?>" maxlength="12" size="35" onkeyup="numberOnly(this)"></td>
                        <td bgcolor="#d8c0be">No Hp : </td>
                        <td bgcolor="#FFFFFF"><input name="txtNoHp" type="text" id="txtNoHp" value="<?php echo $row_RsPengguna['NoHp']; ?>" maxlength="11" size="35" onkeyup="numberOnly(this)"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#d8c0be">Email : </td>
                        <td bgcolor="#FFFFFF"><input name="txtEmail" type="text" id="txtEmail" value="<?php echo $row_RsPengguna['Email']; ?>" size="35" onclick="ValidateEmail(document.frmUpdate.txtEmail)">
                        *</td>
                        <td bgcolor="#d8c0be"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><input name="txtid" type="hidden" id="txtid" value="<?php echo $row_RsPengguna['id']; ?>"></td>
                      </tr>
                      <tr bgcolor="#897270">
                          <td colspan="4"><span class="style1"><img src="images/arrow.gif" width="12" height="10"><font color="white"> MAKLUMAT JAWATAN</font> </span></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#d8c0be">Jawatan : </td>
                        <td bgcolor="#FFFFFF"><input name="txtJawatan" type="text" id="txtJawatan" value="<?php echo $row_RsPengguna['Jawatan']; ?>" size="35"></td>
                        <td bgcolor="#d8c0be">Gred : </td>
                        <td bgcolor="#FFFFFF">

                        <!--<input name="txtGred" type="text" id="txtGred" value="<?php echo $row_RsPengguna['Gred']; ?>">-->
						<select name="txtGred" id="txtGred">
 	                     <?php
                             mysql_select_db($database_connspkp, $connspkp);
                             $sqlGred = "SELECT ID, Keterangan FROM `tblgred` order by Keterangan asc";
                             $rsGred = mysql_query($sqlGred, $connspkp) or die("Connection Failed!");
							echo "gregedd".$gred=$row_RsPengguna['Gred'];
                            ?>
                         <?php while ($row_rsGred = mysql_fetch_array($rsGred)) {
						$asa= $row_rsGred['ID'];
                            if($gred==$asa){?>
                         <option  selected value="<?php echo $row_rsGred['ID']; ?> "> <?php echo $row_rsGred['Keterangan']?> </option>
                        <?php }else 
						{?>
						
						<option value="<?php echo $row_rsGred['ID']; ?> "> <?php echo $row_rsGred['Keterangan']; ?>  </option>
						<?php }
						
						
						
						
						
						}//close while ?>
                         </select>
                         
                        </td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#d8c0be">Bahagian : </td>
                        <td bgcolor="#FFFFFF">
								
					        <select name="selectBahagian" id="txtGred">
 	                     <?php
                             mysql_select_db($database_connspkp, $connspkp);
                             $sqlBahagian = "SELECT id, Bahagian FROM tblbahagian order by Bahagian ASC";
                            $rsBahagian = mysql_query($sqlBahagian, $connspkp) or die("Connection Failed!");
							 $Bahgn=$row_RsPengguna['Bahagian'];
                            ?>
                         <?php while ($row_rsBahagian = mysql_fetch_array($rsBahagian)) {
						$bah= $row_rsBahagian['id'];
                            if($bah==$Bahgn){?>
                         <option  selected value="<?php echo $row_rsBahagian['id']; ?> "> <?php echo $row_rsBahagian['Bahagian']?> </option>
                        <?php }else 
						{?>
						
						<option value="<?php echo $row_rsBahagian['id']; ?> "> <?php echo $row_rsBahagian['Bahagian']; ?>  </option>
						<?php }
		
						}//close while ?>
                         </select>

                        </td>
                        <td bgcolor="#d8c0be">No Susunan :</td>
                        <td bgcolor="#FFFFFF"><input name="txtSusunan" type="text" id="txtSusunan" value="<?php echo $row_RsPengguna['Susunan']; ?>" size="3" maxlength="3"></td>
                      </tr>
                      <tr bgcolor="#897270">
                        <td height="17" colspan="4"><span class="style1"><img src="images/arrow.gif" width="12" height="10"> MAKLUMAT BERKAITAN SISTEM (Wajib Isi) </span></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#d8c0be">Nama Login : </td>
                        <td bgcolor="#FFFFFF"><input name="txtLogin" type="text" id="txtLogin" value="<?php echo $row_RsPengguna['Login']; ?>">
                        </td>
                        <td bgcolor="#FFCCCC">Kata Laluan : </td>
                        <td bgcolor="#FFCCCC"><input name="txtKLaluan" type="text" id="txtKLaluan">
                          <input type="checkbox" name="checkboxpass" value="KemaskiniPass">
                          <span class="style11">*tanda untuk kemas kini</span></td>
                      </tr>
					  <!--
                      <tr>
                        <td height="17" bgcolor="#d8c0be">Kategori : </td>
                        <td bgcolor="#FFFFFF"><select name="selectKategori" id="select">
                        <option selected><?php echo $row_RsPengguna['Kumpulan']; ?></option>
                        <option>Sila Pilih</option>
                        <option value="Pengerusi">Pengerusi</option>
                        <option value="Ahli">Ahli</option>
												<option value="Penyelaras">Penyelaras</option>
                        <option value="urusetia">Urusetia</option>
                          </select>
                        </td>

                      <td height="17" bgcolor="#d8c0be">Kumpulan Ahli : </td>
                      <td bgcolor="#FFFFFF"><select name="selectGroup_id" id="select">
                      <option selected><?php echo $row_RsPengguna['Group_Id']; ?></option>
                          <option value="MMKSN">MMKSN</option>
                          <option value="MMKPPA">MMKPPA</option>
                          <option value="MMTKPPA(P)">MMTKPPA(P)</option>
                          <option value="Lembaga KPPA">Lembaga KPPA</option>
                        </select></td>
                        </tr>
						-->
                        <tr>
                        <td bgcolor="#d8c0be">Status : </td>
                        <td bgcolor="#FFFFFF"><select name="selectStatus" id="selectStatus">
                          <option selected><?php echo $row_RsPengguna['Status']; ?></option>
                          <option>Aktif</option>
                          <option>Tidak Aktif</option>
                        </select> </td>
                      </tr>
                      <tr>
                        <td height="17" colspan="4" bgcolor="#ffffff"><span class="style10"> </span></td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td colspan="3" bgcolor="#FFFFFF"><span class="style10">
                          <input type="submit" name="Submit" value="Kemaskini" onClick = "if (! confirm('Anda pasti untuk kemaskini pengguna ini?')) return false;">
                        </span></td>
                      </tr>
                      <tr>
                        <td height="17" colspan="4" bgcolor="#FFFFFF"><span class="style10"> </span></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="frmUpdate">
                  </form></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#FF8C00"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
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
<?php
mysql_free_result($RsPengguna);
?>
