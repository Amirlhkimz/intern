<?php require_once('Connections/connspkp.php'); ?>
<?
ob_start();
session_start();
	
	if($_SESSION["kategori"] !='4' ){
    header("Location: Logout.php");
  };
 $stridKemaskini=$_SESSION["idPengguna"];


?>
<?php
 $idMes=$_GET["p"];
 $strTrCipta=date("Y-m-j  H:i:s");

mysql_select_db($database_connspkp, $connspkp);
 $query_RsMesy = "SELECT a.tarikhMesyuarat,b.MesyuaratDesc,a.status,a.siri
 FROM tblmesyuarat a 
 inner join tblreftajukmesyuarat b on a.TajukMesyuaratID=b.id WHERE a.id='$idMes'";
$RsMesy = mysql_query($query_RsMesy, $connspkp) or die(mysql_error());
$row_RsMesy = mysql_fetch_assoc($RsMesy);
$totalRows_RsMesy = mysql_num_rows($RsMesy);
// $vaktif = $row_RsMesy['status'];

//if ($vaktif == 'Ya')
//	$vw = "Ya";
//else
 // $vw = "Tidak";
?>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmUpdate")) {
  		$idM=$_POST['txtid'];
        $strTarikh=$_POST['txtTarikh'];
        $Status2=$_POST['selectStatus'];
		$noSiri=$_POST['noSiri'];


  /*$updateSQL = sprintf("UPDATE tblmesyuarat
  						SET mesyuarat='$strMesyuarat', tarikhMesyuarat='$strTarikh', masa='$strMasa', tempat='$strTempat',
						tempat2='$strTempat2',tempat3='$strTempat3',Status='$Status2',
						TrKemaskini='$strTrCipta',idKemaskini='$stridCipta'
  						WHERE
						id='$idM'");*/

 echo $updateSQL = sprintf("UPDATE tblmesyuarat
  						SET status='$Status2',siri='$noSiri',tarikhMesyuarat='$strTarikh',
						TrKemaskini='$strTrCipta',idKemaskini='$stridCipta'
  						WHERE
						id='$idMes'");
						
  mysql_select_db($database_connspkp, $connspkp);
  $Result1 = mysql_query($updateSQL, $connspkp) or die(mysql_error());

		include('Logger.php');
		logMe("Kemas kini mesyuarat: ".$idM."(".$stridCipta.")");


  $insertGoTo = "Mesyuarat.php";
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
function validateForm() {

  
   var x = document.forms["frmInsert"]["noSiri"].value;
  if (x == "") {
    alert("Siri wajib diisi");
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
            <td width="250" height="338" valign="top"><?php if($_SESSION["kategori"] = '4'){include 'include/menuurusetia.php';} else { include 'include/menuadmin.php';}  ?>
            <br></td>
             <td valign="top" align="center"><table class="table">
              <!--DWLayoutTable-->
              <tr>
                <td width="743" height="336" valign="top"><p><span class="style9">KEMASKINI MESYUARAT</span></p>
                  <form action="<?php echo htmlspecialchars($editFormAction);?>" method="POST" name="frmInsert" id="frmInsert" onsubmit="return validateForm()">
                   <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999" class="table">
                      <!--DWLayoutTable-->
                      <tr>
                        <td width="59" height="29" bgcolor="#becdeb">Tajuk Mesyuarat : </td>
                        <td width="677" bgcolor="#FFFFFF"><input name="txtMesyuarat" type="text" disabled="disabled" id="txtMesyuarat" size="70" value="<?php echo $row_RsMesy['MesyuaratDesc'] ?>"  /></td>
                      </tr>
                      <tr>
                        <td bgcolor="#becdeb">Tarikh Mesyuarat : </td>
                        <td bgcolor="#FFFFFF"><input name="txtTarikh" type="text" id="txtTarikh" size="10" value="<?php echo $row_RsMesy['tarikhMesyuarat'] ?>" /> <a href="javascript:NewCal('txtTarikh','yyyymmdd',false,24)"><img src="images/calendar.png" width="16" height="16" align="absmiddle" alt="Klik untuk paparkan kalendar" style="cursor:pointer" border="none"></a></td>                   </tr>
                      <tr>
                        <td bgcolor="#becdeb">Bilangan Mesyuarat : </td>
                        <td bgcolor="#FFFFFF"><input name="noSiri" type="text" id="NoSiri" size="10" value="<?php echo $row_RsMesy['siri'] ?>" /></td>
                      </tr>
                      <tr>
                        <td bgcolor="#becdeb">Aktif </td>
                        <td bgcolor="#FFFFFF">
						<select name="selectStatus" size="1">
                          <option <?php if ($row_RsMesy['status'] == "Ya" ) echo 'selected' ; ?> value="Ya" >Ya</option>
						  <option <?php if ($row_RsMesy['status'] == "Tidak" ) echo 'selected' ; ?> value="Tidak" >Tidak</option>
                        </select>						</td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="17" bgcolor="#FFFFFF"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td bgcolor="#FFFFFF"><span class="style10">
                          <input type="submit" name="Submit3" value="Kemaskini">
                          <input name="Reset" type="reset" id="Reset" value="Reset">
                        </span></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="frmUpdate"><input name="txtid" type="hidden" id="txtid" value="<?php echo $row_RsMesy['id']; ?>">
                  </form>
                  <p>&nbsp;</p></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="28" colspan="2" valign="top" bgcolor="#FF8C00"><div align="center">| <a href="Utama.php"><font color="white">Muka utama</font></a> | <a  href="#" onclick="popUpWindow('<?php printf("TukarPass.php"); ?>',800,200,400,300)"><font color="white">Tukar Katalaluan</font></a> | <a href="Logout.php"><font color="white">Keluar sistem</font></a> | </div></td>
          </tr>
                        </table></td>

    </tr>
    <tr>
      <td height="1"></td>
      <td width="954"></td>
      <td></td>
    </tr>
  </table>
</div>
