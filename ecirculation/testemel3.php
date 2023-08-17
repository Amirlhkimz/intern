<?php include('Connections/connspkp.php'); ?>
<?php
	
ini_set('SMTP','postmaster.1govuc.gov.my');
ini_set('sendmail_from','ecspa@spa.gov.my');
ini_set('smtp_port', '25');


require_once('Mail.php');
require_once('Mail/mime.php');


$myDate = date("Y-m-d");


///////////////////SELECT BHG START////////////////////////////////////////
mysql_select_db($database_connspkp, $connspkp);
//$query_RsCalon = "SELECT * FROM tblcalon where StatusHantar<>'Y' GROUP BY NoPengenalan";
$query_RsCalon = "SELECT * FROM tblspkp where StatusHantar<>'Y'";
$RsCalon = mysql_query($query_RsCalon, $connspkp) or die(mysql_error());
$row_RsCalon = mysql_fetch_assoc($RsCalon);
$totalRows_RsCalon = mysql_num_rows($RsCalon);
///////////////////SELECT BHG END////////////////////////////////////////

       	
do {
		//$Nama = $row_RsCalon['NamaPenuh'];
		//$NoKP = $row_RsCalon['NoKP'];
		$recipient = $row_RsCalon['emel'];
		$ID = $row_RsCalon['id'];
		//$Alamat = $row_RsCalon['Alamat'];
		//$Jaw = $row_RsCalon['Kod'];
		//echo $recipient,"--".$NoPengenalan."<BR>";
		
		
		//echo "<BR>Links = ".$myHtmlLinks;
		//echo "<BR>Total Record = ".$totalRows_RsLinkCalon; 
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$fp = fsockopen("postmaster.1govuc.gov.my", 25, $errno, $errstr, 30);
		if (!$fp) {
			/*echo "$errstr ($errno)<br />\n";*/      ///original
			$emelerror1 =  "</BR></BR>Maaf, sistem emel SPA TIDAK DAPAT dihubungi buat sementara waktu.<br/>\n";
			$emelerror = $emelerror1;
		} else {
			//echo "Server mail.spa.gov.my berjaya dihubungi!<br />\n"."Emel telah dihantar kepada pengadu.";
			fclose($fp);
		

        // Constructing the email
		$sender = "ecspa@spa.gov.my"; 
		$subject = "Makluman Pembatalan Emel Terdahulu";    // Subject for the email
		
		////////////////////////////////////////
		$host = "postmaster.1govuc.gov.my";
		$body = $strMessage;
		$from = "ecspa@spa.gov.my";
		//////////////////////////////////////

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
        
		///////////////test////////////
		//echo $recipient;
		//echo $html;
		//////////////test end////////
		
		
		$crlf = "\n";
        $headers = array(
                        'From'          	=> $sender,
                        'Return-Path'   	=> $sender,
                        'Subject'       	=> $subject,
  						'X-Priority'		=> 1, 
  						'X-MSMail-Priority' => 'High',
  						'Importance' 		=> 'High'
                        );

        // Creating the Mime message
        // $mime = new Mail_mime($crlf);
		$mime =  new Mail_mime(array('eol' => $crlf));
		

        // Setting the body of the email
        $mime->setTXTBody($text);
        $mime->setHTMLBody($html);

        $body = $mime->get();
        $headers = $mime->headers($headers);
		

		if($totalRows_RsCalon>0){
        // Sending the email
        //$mail = Mail::factory('mail');
		$mail = &Mail::factory('smtp',array('host' => $host));
        $mail->send($recipient, $headers, $body);
				
		
		////////////////Update StatusHantar --> Y   Start////////////////////
		 mysql_select_db($database_connspkp, $connspkp);
		$SQLupdate = sprintf("update dbecirculation_spa.tblspkp
						set
						StatusHantar = 'Y'
						
						where
						id = '$ID'
						AND
						StatusHantar <> 'Y';
						");
	
		$ResultSQL = mysql_query($SQLupdate)or die(mysql_error());
		
		//echo "<BR>".$html;
		////////////////Update StatusHantar --> Y   End////////////////////			
		
		
		}//if($totalRows_RsStatCalon>0){
		
		$recipient='';
		
		if (PEAR::isError($mail)) {
						  echo("<p>" . $mail->getMessage() . "</p>");
						 } 
		}///////////else $fp


		
} while ($row_RsCalon = mysql_fetch_assoc($RsCalon));
echo "<BR>Hantar Emel Selesai";
?>