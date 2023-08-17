<?php
require_once('Connections/connspkp.php');


$idUrusan= $_GET['s'];
$idStatusUrusan = $_GET['t'];
$idPengguna = $_SESSION["idPengguna"];
?>
<?php

mysql_select_db($database_connspkp, $connspkp);
		$query_RsUrusanS = "SELECT a.id,a.Ringkasan, a.Kertas,
						a.Link,b.desc_jenisurusan 
                        FROM tblurusan a
                        left join tbljenisurusan b on b.id_jenisurusan=a.Jenis
						WHERE a.id='$idUrusan'";
						
		$RsUrusanS = mysql_query($query_RsUrusanS, $connspkp) or die(mysql_error());
		$totalRows_RsUrusanS = mysql_num_rows($RsUrusanS);

		while($row_RsUrusanS = mysql_fetch_assoc($RsUrusanS)){
			$idUrusan=$row_RsUrusanS['id'];
			$JenisUrusan = $row_RsUrusanS['desc_jenisurusan'];
			$Ringkasan = $row_RsUrusanS['Ringkasan'];
			$Kertas = $row_RsUrusanS['Kertas'];
			$TkSelesai = $strKini;
		}

		mysql_select_db($database_connspkp, $connspkp);
		//get senarai pengerusi dan  ahli untuk mesyuarat
		$query_PenggunaBiasa = "SELECT tblstatusurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh, tblpengguna.Susunan,tblpengguna.Email
						FROM tblstatusurusan
						INNER JOIN tblpengguna ON tblstatusurusan.idPengguna=tblpengguna.id
						WHERE tblstatusurusan.idUrusan='$idUrusan'  and idPengguna='$idPengguna'
						ORDER BY tblpengguna.Susunan";
		$PenggunaBiasa = mysql_query($query_PenggunaBiasa, $connspkp) or die(mysql_error());

		while($row_RsPenggunaBiasa = mysql_fetch_assoc($PenggunaBiasa)){
			$Emel = $row_RsPenggunaBiasa['Email'];
			$mail_to = $Emel;
			$subject = 'Emel Makluman Selesai Urusan';
			$field_email = "";
			$body_message = "Salam sejahtera,\n\n Ini adalah emel makluman urusan selesai.\n\n\n Urusan berikut telah selesai di dalam sistem eCirculation JPA.\n\n Jenis Urusan : ".$JenisUrusan."\nRingkasan :".$Ringkasan."\nTarikh Selesai: ".$TkSelesai."\nKertas: ".$Kertas.".\n\nIni adalah email automatik dari sistem eCirculation JPA,\nEMEL INI TIDAK PERLU DIJAWAB.\n\nSekian, Terima Kasih\n\nUrusetia, Jabatan Perkhidmatan Awam Malaysia\n\n";

			$headers = 'From: '.$field_email."\r\n";
			$headers .= 'Reply-To: '.$field_email."\r\n";

			$mail_status = mail($mail_to, $subject, $body_message, $headers);
}
//die();
if ($mail_status) { ?>
    <script language="javascript" type="text/javascript">
        alert('Terima kasih diatas maklumbalas anda. Emel selesai akan dihantar secara automatik kepada semua ahli mesyuarat.');
        window.location = 'LaporanKeputusan.php?s=<?php echo $idUrusan;?>&t=<?php echo $idStatusUrusan;?>';
    </script>
<?php
}
else { ;?>
    <script language="javascript" type="text/javascript">
        alert('Terdapat masalah dengan sistem. Emel maklumbalas secara automatik gagal dihantar. Sila hubungi admin Sistem eCirculation JPA.');
        window.location = 'LaporanKeputusan.php?s=<?php echo $idUrusan;?>&t=<?php echo $idStatusUrusan;?>';
    </script>
<?php
};?>
