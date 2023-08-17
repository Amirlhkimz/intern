<?php
require_once('Connections/connspkp.php');
#require_once('Mail.php');
include('include/FormatDate.php');

 	ob_start();
	session_start();

if($_SESSION["kategori"] !='2' ){
	if($_SESSION["kategori"] !='1' ){
		header("Location: Logout.php");
		}
	};
	
$idUrusan= $_GET['s'];
$idStatusUrusan = $_GET['t'];
$idPengguna = $_SESSION["idPengguna"];
?>
<!--<meta http-equiv="refresh" content="2;URL=Utama.php">-->
<?php
		mysql_select_db($database_connspkp, $connspkp);
		$query_keputusan = "SELECT tblstatusurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh, tblpengguna.Susunan,tblurusan.*,tblpengguna.Email,tblmesyuarat.TajukMesyuaratID,tbljenisurusan.desc_jenisurusan,tblkategori.desc_kategori,tblreftajukmesyuarat.MesyuaratDesc,tblmesyuarat.siri,tblmesyuarat.tarikhMesyuarat
						FROM tblstatusurusan
						INNER JOIN tblpengguna ON tblstatusurusan.idPengguna=tblpengguna.id
                        inner join tblurusan on tblurusan.id=tblstatusurusan.idUrusan
                        inner join tblmesyuarat on tblmesyuarat.id=tblurusan.bilMesyuarat
                        inner join tbljenisurusan on tbljenisurusan.id_jenisurusan=tblurusan.Jenis
                        inner join tblkategori on tblkategori.id_kategori=tblstatusurusan.kategoriID
                        inner join tblreftajukmesyuarat on tblreftajukmesyuarat.id=tblmesyuarat.TajukMesyuaratID
						WHERE tblstatusurusan.idUrusan='$idUrusan'  and idPengguna='$idPengguna'
						ORDER BY tblpengguna.Susunan";
		$Rskeputusan  = mysql_query($query_keputusan, $connspkp) or die(mysql_error());
		$row_Rskeputusan = mysql_fetch_assoc($Rskeputusan);

		$strMula=$row_Rskeputusan['TrTerima'];
		$NamaPenuh2=$row_Rskeputusan["Gelaran"].' '.$row_Rskeputusan["NamaPenuh"];
		$TrKemaskini=date("Y-m-j H:i:s");
		$strTrTkemaskini=date("Y-m-j");
		$strKeputusan=$row_Rskeputusan['Keputusan'];
		$strUlasan=$row_Rskeputusan['Ulasan'];
		$strMaklumbalas=$row_Rskeputusan['Maklumbalas'];
		$TajukMesyuaratID=$row_Rskeputusan['TajukMesyuaratID'];
		$jenisurusan=$row_Rskeputusan['desc_jenisurusan'];
		$MesyuaratDesc=$row_Rskeputusan['MesyuaratDesc'];
		
		//Senarai urusetia mesyuarat            	 					
		mysql_select_db($database_connspkp, $connspkp);
   		$query_RsEmail = "select * from tbluruspengguna a
   			 inner join tblpengguna b on a.penggunaID=b.id
    		 where a.TajukMesyuaratID='$TajukMesyuaratID' and a.kategoriID=4";//kategoriID 4= urusetia
    	$RsEmail = mysql_query($query_RsEmail, $connspkp) or die(mysql_error());
        
	
         while ($row_result_Email = mysql_fetch_assoc($RsEmail))
			{

		    $emailtoU = $row_result_Email['Email'];
			$host = "postmaster.1govuc.gov.my";
			$emailtoU = $emailtoU;


            $subject = "Keputusan Urusan di sistem eCirculation JPA";
            $message = "Satu keputusan telah dibuat oleh".$desc_kategori. " Mesyuarat di eCirculation JPA.\n\nNama Mesyuarat: ".$MesyuaratDesc."\n\nUrusan : ".$jenisurusan."\nRingkasan: ".$strRingkasan."\n\nTarikh Keputusan : ".format_datetime($strTrTkemaskini)."\nKeputusan oleh: \nNama Penuh: ".$NamaPenuh2."\n\nKeputusan : ".$strKeputusan."\n\nUlasan".$strUlasan."\nMaklumbalas : ".$strMaklumbalas."\n\nhttps://ecirculation.jpa.gov.my/ \n\nIni adalah email automatik dari sistem eCirculation JPA,\nEMEL INI TIDAK PERLU DIJAWAB.\n\nSekian, Terima Kasih\n\nUrusetia,\nJabatan Perkhidmatan Awam Malaysia\n\n";

												$email_from = 'eCirculationJPA';//<== update the email address
												$email_subject = $subject;
												$email_body = $message;

												$to =  $emailtoU;//<== update the email address
												$headers = "From: $email_from \r\n";
												$headers .= "Reply-To: $emailtoU \r\n";
												//Send the email!
												mail($to,$email_subject,$email_body,$headers);
												//done. redirect to thank-you page.
												
			}// close while ($row_result_Email = mysql_fetch_assoc($RsEmail))
										
       

//header('Location:Utama.php');
//header('LaporanKeputusan.php?s=<?php echo $idUrusan;?>&t=<?php echo $idStatusUrusan;?>');

?>
