<?
require_once('Connections/connspkp.php');

$itemKategori = $_GET['itemKategori'];

mysql_select_db($database_connspkp, $connspkp);
$strSQL = "SELECT * FROM tbljenisurusan WHERE kat_jenisurusan='$itemKategori'";
$result = mysql_query($strSQL, $connspkp) or die("Connection Failed!");

$ID = '';
$Data = '';

while($row = mysql_fetch_array($result)) {
	if(empty($ID)){
			$ID = $row['desc_jenisurusan'];
			$Data = $row['desc_jenisurusan'];
	} 
	
	else {
			$ID = $ID.','.$row['desc_jenisurusan'];
			$Data = $Data.','.$row['desc_jenisurusan'];
      }
}
?>     
<script type="text/javascript">
	// alert('<?=$ID?>');
  window.parent.handleResponse('<? echo $ID ?>','<? echo $Data ?>','selectJenisUrusan');
</script>