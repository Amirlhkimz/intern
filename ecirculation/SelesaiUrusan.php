<?php
			mysql_select_db($database_connspkp, $connspkp);
			//$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan WHERE id='$idStatusUrusan'";
			$RsStatusAkhirUrusan = mysql_query("SELECT * FROM tblstatusurusan WHERE idUrusan='$idUrusanP' AND Status<>'Selesai'");
			$myrowscheck = mysql_num_rows($RsStatusAkhirUrusan);
			
				if ($myrowscheck > 0){
						$selesaiSQL = sprintf("UPDATE tblurusan SET status='Selesai', TrKemaskini='$TrKemaskini', idkemaskini='".$_SESSION["idPengguna"]."' WHERE id='$idUrusanP'");

  						mysql_select_db($database_connspkp, $connspkp);
  						$Result_selesaiSQL = mysql_query($selesaiSQL, $connspkp) or die(mysql_error());
				logMe("Kemaskini status akhir urusan kepada Selesai");
				}

?>