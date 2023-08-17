<?php require_once('Connections/connspkp.php'); ?>
<?php
session_start();

if($_SESSION["kategori"] !='2' ){
	if($_SESSION["kategori"] !='1' ){
			if($_SESSION["kategori"] !='5'){
				if($_SESSION["kategori"] !='4'){
			    header("Location: Logout.php");
				}
			}
		}
	};

	$iduser=$_SESSION["Login"];
?>


<html>
<head>
<title>Tukar Katalaluan</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "required";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "required";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "required";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "Tidak sepadan.";
	output = false;
}
<?php
mysql_select_db($database_connspkp, $connspkp);
if(count($_POST)>0) {
$result = mysql_query("SELECT * from tblpengguna WHERE Login='$iduser'");
$row=mysql_fetch_array($result);
if(md5($_POST["currentPassword"]) == $row["Klaluan"]) {
mysql_query("UPDATE tblpengguna set Klaluan='" .md5($_POST["newPassword"] ). "' WHERE Login='" . $iduser . "'");
$message = "Katalaluan telah ditukar.";
} else $message = "Katalaluan Asal tidak tepat!";
}
?>
return output;
}
</script>
</head>
<body>
<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
<div style="width:400px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<table border="0" cellpadding="10" cellspacing="0" width="400" align="center" class="tblSaveForm">
<tr class="tableheader">
<td colspan="2" bgcolor="#FF8C00"><font color="white">Tukar Katalaluan</font></td>
</tr>
<tr>
<td width="40%"><label>Katalaluan Asal:</label></td>
<td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
</tr>
<tr>
<td><label>Katalaluan Baru:</label></td>
<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
</tr>
<td><label>Pengesahan Katalaluan Baru:</label></td>
<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body></html>