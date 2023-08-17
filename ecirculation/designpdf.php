<? //session_start();

if($_SESSION["kategori"] !='2' ){
	if($_SESSION["kategori"] !='1' ){
		header("Location: Logout.php");
		}
	};
?>
<?php
//include('include/FormatDate.php');
$idUrusan= $_GET['s'];
$idStatusUrusan = $_GET['t'];
$idPengguna = $_SESSION["idPengguna"];

mysql_select_db($database_connspkp, $connspkp);
$query_SenaraiUrusetia = "SELECT tblstatusurusan.*, tblpengguna.Gelaran, tblpengguna.NamaPenuh, tblpengguna.Susunan,tblurusan.*,tblpengguna.Email,tblmesyuarat.TajukMesyuaratID,tbljenisurusan.desc_jenisurusan
						FROM tblstatusurusan
						INNER JOIN tblpengguna ON tblstatusurusan.idPengguna=tblpengguna.id
                        inner join tblurusan on tblurusan.id=tblstatusurusan.idUrusan
                        inner join tblmesyuarat on tblmesyuarat.id=tblurusan.bilMesyuarat
                        inner join tbljenisurusan on tbljenisurusan.id_jenisurusan=tblurusan.Jenis
						WHERE tblstatusurusan.idUrusan='$idUrusan'  and idPengguna='$idPengguna'
						ORDER BY tblpengguna.Susunan";
$RsSenaraiUrusetia  = mysql_query($query_SenaraiUrusetia, $connspkp) or die(mysql_error());
$row_RsSenaraiUrusetia = mysql_fetch_assoc($RsSenaraiUrusetia);

$strMula=$row_RsSenaraiUrusetia['TrTerima'];
$NamaPenuh2=$row_RsSenaraiUrusetia["Gelaran"].' '.$row_RsSenaraiUrusetia["NamaPenuh"];
$TrKemaskini=date("Y-m-j H:i:s");
$strKeputusan=$row_RsSenaraiUrusetia['Keputusan'];
$strUlasan=$row_RsSenaraiUrusetia['Ulasan'];
$TajukMesyuaratID=$row_RsSenaraiUrusetia['TajukMesyuaratID'];

if ($_SESSION["kategori"] =='1' ) {
	$strMaklumbalas=$row_RsSenaraiUrusetia['txtMaklumbalas'];
}
$strKategori=$_SESSION["kategori"];

$titles02="FW: YBhg.Datuk/Dato/Tuan/Puan";
mysql_select_db($database_connspkp, $connspkp);
$query_RsEmail = "select * from tbluruspengguna a
inner join tblpengguna b on a.penggunaID=b.id
where a.TajukMesyuaratID='$TajukMesyuaratID' and a.kategoriID=4";//kategoriID 4= urusetia
$RsEmail = mysql_query($query_RsEmail, $connspkp) or die(mysql_error());


$date_diff = round(abs(strtotime($TrKemaskini)-strtotime($strMula)) / 86400);
//---------------------------------------------START PDF------------------------------------------------//

require('include/fpdf/fpdf.php');


$pdf=new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',11);

$pdf->Ln(2);
$pdf->Cell(190,6,'[ SULIT ]',0,0,'L');

	$pdf->SetFont('Arial','BI',9);
	$pdf->SetFillColor(255);
	$pdf->SetX(120);
	$pdf->Cell(190,6,'No. Fail : '.$row_RsSenaraiUrusetia['NoKertas'],0,0,'L');

	$pdf->SetDrawColor(0);
	$pdf->SetLineWidth(0.4);
	$pdf->Line(0, 12, 210, 12);

$pdf->Image('images/jata.gif',93,17,25);
$pdf->SetFont('Arial','',11);
$pdf->Ln(25);
$pdf->Cell(190,6,'JABATAN',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(190,6,'PERKHIDMATAN AWAM',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(190,6,'MALAYSIA',0,0,'C');
$pdf->SetLineWidth(0.4);
$pdf->Line(0, 60, 210, 60);
$title="| "."Keputusan oleh : ".$NamaPenuh2." |"." Tarikh keputusan : ".format_datetime($TrKemaskini)." |";
	//Calculate width of title and position
	$pdf->Ln(12);
    $w=$pdf->GetStringWidth($title)+20;
    //$pdf->SetX((210-$w)/2);
	$pdf->SetX(0);

    //Colors of frame, background and text
    $pdf->SetDrawColor(128);
    $pdf->SetFillColor(200,200,255);
    $pdf->SetTextColor(0);
    //Thickness of frame (1 mm)
    $pdf->SetLineWidth(0.3);
    //Title
    $pdf->Cell(210,6,$title,1,1,'C',true);
    //Line break
	$pdf->Ln(12);

//------------------------BODY START----------------------------------------------------//
	$pdf->SetFont('Arial','',11);
	$pdf->SetTextColor(0);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'Jenis urusan : ',0,0,'L');
	$pdf->SetX(60);
	$pdf->Cell(130,6,$row_RsStatusUrusan['Jenis'],1,0,'L');
	$pdf->Ln(8);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'Butiran : ',0,0,'L');
	$pdf->SetFillColor(210);
	$pdf->SetX(60);
	$pdf->MultiCell(130,6,$row_RsSenaraiUrusetia['Ringkasan'],1,2,'L',0);
	$pdf->Ln(8);
	$pdf->SetFillColor(255);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'Kertas : ',0,0,'L');
	$pdf->SetX(60);
	$pdf->MultiCell(130,6,$row_RsSenaraiUrusetia['Kertas'],1,2,'L',0);
/* 	$pdf->Ln(8);
	$pdf->SetFillColor(255);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'No. Kertas : ',0,0,'L');
	$pdf->SetX(60);
	$pdf->MultiCell(130,6,$row_RsStatusUrusan['NoKertas'],1,2,'L',0); */

	$pdf->Ln(15);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'Status : ',0,0,'L');
	$pdf->SetX(60);
	$pdf->Cell(130,6,'Selesai',1,0,'L');
	$pdf->Ln(8);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'Tempoh buka : ',0,0,'L');
	$pdf->SetX(60);
	$pdf->Cell(130,6,$date_diff." hari",1,0,'L');
	$pdf->Ln(8);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'Tarikh terima :',0,0,'L');
	$pdf->SetX(60);
	$pdf->Cell(130,6,format_datetime($row_RsSenaraiUrusetia['TrTerima']),1,0,'L');
	$pdf->Ln(8);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'Tarikh Keputusan :',0,0,'L');
	$pdf->SetX(60);
	$pdf->Cell(130,6,format_datetime($TrKemaskini),1,0,'L');

	$pdf->Ln(15);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'Keputusan : ',0,0,'L');
	$pdf->SetFont('Arial','B',11);
	$pdf->SetFillColor(210);
	$pdf->SetX(60);
	$pdf->Cell(130,6,$strKeputusan,1,0,'L',1);
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',11);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'Ulasan : ',0,0,'L');
	$pdf->SetX(60);
	$pdf->MultiCell(130,6,$strUlasan,1,2,'L',0);
	$pdf->Cell(190,6,'Maklumbalas : ',0,0,'L');
	$pdf->SetX(60);
	$pdf->MultiCell(130,6,$strMaklumbalas,1,2,'L',0);


//------------------------BODY START----------------------------------------------------//
///////////////////FOOTER////////////////////////

	//Calculate width of title and position
	$TrCetak=date("j/m/Y  H:i:s");
	$footer="| Hak cipta terpelihara : eCirculation JPA @ 2020 |  Tarikh Cetak : ".$TrCetak." |";
	$pdf->SetY(-60);
    $w=$pdf->GetStringWidth($footer)+24;
    //$pdf->SetX((210-$w)/2);
	$pdf->SetX(0);

    //Colors of frame, background and text
    $pdf->SetDrawColor(128);
    $pdf->SetFillColor(200,200,255);
    $pdf->SetTextColor(0);
	$pdf->SetFont('Arial','',11);
    //Thickness of frame (1 mm)
    $pdf->SetLineWidth(0.3);
    //Title
    $pdf->Cell(210,6,$footer,1,1,'C',true);
	$pdf->SetDrawColor(0);
	$pdf->SetLineWidth(0.4);
	$pdf->Line(0, 247, 210, 247);
	$pdf->SetFont('Arial','',11);
	$pdf->Ln(5);
	$pdf->Cell(190,6,'[ SULIT ]',0,0,'R');

///////////////////FOOTER END///////////////////
//    $pdf->Ln(10);
//	$pdf->Cell(10,60,'SURUHANJAYA');


$pdf->SetDisplayMode('fullpage','single');
//$pdf->Output();
$myPdfname=sprintf($NamaPenuh2."_".date("jmY")." (".$row_RsStatusUrusan['Jenis'].").pdf");
$pdfcontent = $pdf->Output($myPdfname, "S");
//---------------------------------------------START PDF END---------------------------------------------//

ini_set('SMTP','postmaster.1govuc.gov.my');
ini_set('sendmail_from','eCirculationJPA@ecirculation.jpa.gov.my');

//-------------------------------START EMAIL AND ATTACHMENT-----------------------------------------//

require_once('Mail.php');
require_once('Mail/mime.php');

// email address of the recipient

//$to=array();
while($row_RsEmail = mysql_fetch_assoc($RsEmail)){
$emailto = $row_RsEmail['Email'];
$to = $emailto;
//$to[] = $row_RsEmail['Email'];

}
// email address of the sender
$from = "eCirculationJPA@ecirculation.jpa.gov.my";
$host = "postmaster.1govuc.gov.my";
// $username = "ecspa";
// $password = "P@ssword.123";
// subject of the email
$subject = "eCirculation: Keputusan ".$row_RsSenaraiUrusetia['desc_jenisurusan']." di Ecirculation JPA";

// email header format complies the PEAR's Mail class
// this header includes sender's email and subject
$headers = array('From' => $from,
'Subject' => $subject,
'X-Priority'=> 1,
'X-MSMail-Priority' => 'High',
'Importance' => 'High');

// We will send this email as HTML format
// which is well presented and nicer than plain text
// using the heredoc syntax
// REMEMBER: there should not be any space after PDFMAIL keyword
$htmlMessage = <<<PDFMAIL
<html>
<body bgcolor="#ffffff">
<p align="center">
Please find the pdf attached in the email.<br>
This is generated by <b style="font-size:18pt;">FPDF</b>
</p>
</body>
</html>
PDFMAIL;

$textMessage = "Urusan : ".$row_RsSenaraiUrusetia['desc_jenisurusan']."\Butiran :".$row_RsSenaraiUrusetia['Ringkasan']."\n\nhttps://eCirculation.jpa.gov.my/ \n\nIni adalah email automatik dari sistem eCirculation JPA yang tidak perlu dibalas.\n\nSekian, Terima Kasih\n\nUrusetia, Jabatan Perkhidmatan Awam Malaysia";

// create a new instance of the Mail_Mime class
$mime = new Mail_Mime();

// set HTML content
//$mime->setHtmlBody($htmlMessage);
$mime->setTxtBody($textMessage);

// IMPORTANT: add pdf content as attachment
$mime->addAttachment($pdfcontent, 'application/pdf', $myPdfname, false, 'base64');

// build email message and save it in $body
$body = $mime->get();
//$body.="Anda mempunyai urusan baru di eCirculation.\n\nMAKLUMAT URUSAN\nTajuk : ".$strKategori."\nRingkasan :".$row_RsStatusUrusan['Ringkasan']."\n\nhttp://localhost/ecirculation/ \n\nIni adalah email automatik dari sistem eCirculation SPKP yang tidak perlu dibalas.\n\nSekian, Terima Kasih\n\n";


// build header
$hdrs = $mime->headers($headers);

// create Mail instance that will be used to send email later
//$smtp = &Mail::factory('smtp',array('host' => $host));
/* 											$smtp = Mail::factory('smtp',
											  array ('host' => $host,
												'auth' => true,
												'username' => $username,
												'password' => $password));
 */
// Sending the email, according to the address in $to,
// the email headers in $hdrs,
// and the message body in $body.
//$to2="su@spa.gov.my, tsus@spa.gov.my, ".$to;
//$mail->send($to, $hdrs, $body);
//$mail = $smtp->send($to, $hdrs, $body);
mail($to, $hdrs, $body);
//$to2= 'suspa@spa.gov.my,tsus@spa.gov.my';
//$to2= 'suspa@spa.gov.my';
//$to2= 'adilia@spa.gov.my';
//$to2= 'amy@spa.gov.my,nurulhafiza@spa.gov.my';
//$mail = $smtp->send($to2, $hdrs, $body);


//-------------------------------START EMAIL AND ATTACHMENT END-----------------------------------------//
mysql_free_result($RsEmail);
?>
