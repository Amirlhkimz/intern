<?php include('Connections/connspkp.php'); ?>
<?php
ini_set('SMTP','postmaster.1govuc.gov.my');
ini_set('sendmail_from','ecspa@spa.gov.my');
ini_set('smtp_port', '25');


require_once('Mail.php');
require_once('Mail/mime.php');

mysql_select_db($database_connspkp, $connspkp);
					//$query_RsCalon = "SELECT * FROM tblcalon where StatusHantar<>'Y' GROUP BY NoPengenalan";
					$query_RsCalon = "SELECT * FROM tblspkp where StatusHantar<>'Y'";
					$RsCalon = mysql_query($query_RsCalon, $connspkp) or die(mysql_error());
					$row_RsCalon = mysql_fetch_assoc($RsCalon);
					$totalRows_RsCalon = mysql_num_rows($RsCalon);

				   $ID = $row_RsCalon['id'];
				   
				do {
						if($recipient==''){
						$recipient = $row_RsCalon['emel']; // The Recipients email address
						}
						else{
						$recipient = $recipient.','.$row_RsCalon['emel']; // The Recipients email address
						}
					
					} while ($row_RsCalon = mysql_fetch_assoc($RsCalon));	

 
$NamaPenuh2="kamal";
//$TrKemaskini=date("Y-m-j  H:i:s");
$strTajuk="Makluman Pembatalan Emel Terdahulu";
//$strMessage="Urusan :  Cuba Emel \nRingkasan : Cuba Emel \n\nhttps://putra5.spa.gov.my/ecirculation/ \n\nIni adalah email automatik dari sistem eCirculation SPKP yang tidak perlu dibalas.\n\nSekian, Terima Kasih\n\nUrusetia,\nSuruhanjaya Perkhidmatan Kehakiman dan Perundangan Malaysia";


	//$to = "kamal@spa.gov.my";
 	$host = "postmaster.1govuc.gov.my";
    $subject = "(Mail dari eCirculation SPA)".$strTajuk;
	$body = $strMessage;
	$from = "ecspa@spa.gov.my";
	
	$html = '<html><body>
					 <style type="text/css">
						<!--
						.style3 {
							color: #FF0000;
							font-weight: bold;
						}
						-->
							 </style>
					<table width="652" border="0" cellspacing="0" cellpadding="0">
					<tr><td>YBhg. Datuk/ Tuan / Puan,</td></tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
					<td>Dipohon YBhg. Datuk/ Tuan / Puan mengabaikan emel sebelum ini pada 4 Mac 2015 jam 12.49 pm berhubung dengan <strong>Urusan Baru Telah Dicipta Di Sistem eCirculation SPA</strong> yang merupakan emel percubaan dari Bahagian Pengurusan Maklumat SPA.</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
					<td>Untuk makluman terdapat gangguan pada aplikasi eCirculation SPA dan masalah tersebut telah diatasi.</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
					<td>Pihak urus setia ini memohon maaf berhubung perkara tersebut dan segala kesulitan amat dikesali.</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
					<td>Ini adalah email automatik dari sistem eCirculation SPA,<br>
					EMEL INI TIDAK PERLU DIJAWAB.</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<tr>
					<td>Sekian, terima kasih.</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
					<td>Urusetia,<br>
					Suruhanjaya Perkhidmatan Awam Malaysia</td>
					<tr><td>&nbsp;</td></tr>
            </table></body></html>';  // HTML version of the email

  $headers = array('From' => $from, 
  'Subject' => $subject,
  'X-Priority'=> 1, 
  'X-MSMail-Priority' => 'High',
  'Importance' => 'High');
  
  	$smtp = &Mail::factory('smtp',array('host' => $host));
	$mail = $smtp->send($recipient, $headers, $body);
	
  
  echo "Done";
?>