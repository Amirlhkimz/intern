<?php
require_once('Connections/connspkp.php');

	mysql_select_db($database_connspkp, $connspkp);
	$query_RsUrusan = "SELECT * FROM tblkategori ORDER BY desc_kategori";
	$RsUrusan = mysql_query($query_RsUrusan, $connspkp) or die(mysql_error());
	$row_RsUrusan = mysql_fetch_assoc($RsUrusan);
	$totalRows_RsUrusan = mysql_num_rows($RsUrusan);

include('include/FusionCharts.php');
include('include/FC_Colors.php');
?>
<SCRIPT LANGUAGE="Javascript" SRC="include/FusionCharts.js"></SCRIPT>
<?php
	$strXML="";
	$strXML = "<graph caption='Urusan mengikut Kategori' xAxisName='Kategori' yAxisName='Urusan' decimalPrecision='0' formatNumberScale='0'>";
 	
	do{
			$row_RsUrusan2['GrValue']="";
			
				mysql_select_db($database_connspkp, $connspkp);
				$query_RsUrusan2 = "SELECT COUNT(id) as GrValue FROM tblurusan WHERE Kategori = '".$row_RsUrusan['desc_kategori']."'";
				$RsUrusan2 = mysql_query($query_RsUrusan2, $connspkp) or die(mysql_error());
				$row_RsUrusan2 = mysql_fetch_assoc($RsUrusan2);

			$strXML .= "<set name='".$row_RsUrusan['desc_kategori']."' value='".$row_RsUrusan2['GrValue']."' color='".getFCColor()."' />";
	

	}while ($row_RsUrusan = mysql_fetch_array($RsUrusan));
	
	$strXML .=  "</graph>";
	echo renderChartHTML('FusionCharts/FCF_Column3D.swf', "", $strXML, "myNext", 400, 200);


mysql_free_result($RsUrusan2);
mysql_free_result($RsUrusan);
?>