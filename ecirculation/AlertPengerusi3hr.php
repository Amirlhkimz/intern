<?php
include('Connections/connspkp.php');
//include("include/Security.php");
include("include/FormatDate.php");
?>
<?php

ini_set('SMTP','postmaster.1govuc.gov.my');
ini_set('sendmail_from','ecspa@spa.gov.my');
ini_set('smtp_port', '25'); 
//ini_set('error_reporting', '~E_NOTICE & ~E_WARNING');

include('Mail.php');
include('Mail/mime.php');

$myDate = date("Y-m-d");


////////////////////CHECK URUSAN PENGERUSI  3 hari START////////////////////////////////////////////////////
mysql_select_db($database_connspkp, $connspkp);
$query_RsStatusUrusan = "select COUNT(*) from tblstatusurusan where idPengguna = '43'
						AND status <> 'Selesai' 
						AND  DATE(TrTerima) = DATE_SUB(DATE(NOW()) , INTERVAL 3 DAY); ";
						
/*$query_RsStatusUrusan = "select COUNT(*) from tblstatusurusan where idPengguna = '43'
						AND status = 'Selesai' 
						AND  DATE(TrTerima) = DATE_SUB(DATE(NOW()) , INTERVAL 3 DAY); ";*/

$RsStatusUrusan = mysql_query($query_RsStatusUrusan, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$totalRows_RsStatusUrusan = mysql_num_rows($RsStatusUrusan);

if($row_RsStatusUrusan['COUNT(*)']>0){

////////////////////////START EMEL//////////////////////////////////////////////////////////////////////////

$fp = fsockopen("postmaster.1govuc.gov.my", 25, $errno, $errstr, 30);
		if (!$fp) {
			/*echo "$errstr ($errno)<br />\n";*/      ///original
			$emelerror1 =  "</BR></BR>Maaf, sistem emel SPA TIDAK DAPAT dihubungi buat sementara waktu.<br/>\n";
			$emelerror2 =  "</BR><br/>\n";
			$emelerror = $emelerror1.$emelerror2;
		} else {
			fclose($fp);

        // Constructing the email
		$sender = "ecspa@spa.gov.my"; 
		$subject = "PERHATIAN!: Urusan belum selesai di ecirculation SPA";// Subject for the email
		/* $recipient = 'mahmood@spa.gov.my, anuar@spa.gov.my, ammar@spa.gov.my, ct_aiasah@spa.gov.my, noorazli@spa.gov.my, zaman@spa.gov.my, kamal@spa.gov.my, melim@spa.gov.my, karriffin@spa.gov.my, mnazuan@spa.gov.my'; */
		//$recipient = 'kamal@spa.gov.my';
		$recipient = 'adilia@spa.gov.my';
		
		////////////////////////////////////////
		$host = "postmaster.1govuc.gov.my";
		$body = $strMessage;
		$from = "ecspa@spa.gov.my";
		//////////////////////////////////////

		$html = '<html>
				<style type="text/css">
				<!--
				.style3 {
					font-family: Verdana, Arial, Helvetica, sans-serif;
					font-size: 12px;
				}
				-->
				</style>
<body>
					<p class="style3">Salam  sejahtera.</p>
					<p class="style3">Tuan,</p>
<p class="style3">Tan Sri Pengerusi mempunyai <strong>'.$row_RsStatusUrusan['COUNT(*)'].'</strong> urusan dalam sistem ecirculation SPA yang masih <strong>BELUM SELESAI</strong> dan  telah melebihi <strong>3 hari </strong>yang lalu.</p>
<p class="style3">Sistem ecirculation SPA boleh diakses melalui pautan berikut:</p>
<p class="style3">https://putra5.spa.gov.my/ecirculation_spa/</p>
<p class="style3"><br />
</p>
<p class="style3">Emel ini dijana oleh Sistem eCirculation SPA<br />
</p>
</body></html>';  // HTML version of the email
        
		
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
		

        // Sending the email
        //$mail = Mail::factory('mail');
		$mail = &Mail::factory('smtp',array('host' => $host));
        $mail->send($recipient, $headers, $body);
				
					
		
		$recipient='';
		
		if (PEAR::isError($mail)) {
						  echo("<p>" . $mail->getMessage() . "</p>");
						 } 
		}///////////else $fp

///////////////////////EMEL END////////////////////////////////////////////////////////////////////////////
}
////////////////////CHECK URUSAN PENGERUSI 30 hari END////////////////////////////////////////////////////
?>