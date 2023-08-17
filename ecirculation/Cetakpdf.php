<?php require_once('Connections/connspkp.php'); ?>
<?php
session_start();

/*if($_SESSION["Kumpulan"] !='Suruhanjaya' ){
	if($_SESSION["Kumpulan"] !='Pengerusi' ){
		if($_SESSION["Kumpulan"] !='Ahli' ){
		header("Location: Logout.php");
			}
		}
	};
	*/

if ($_SESSION["kategori"] != '1') {
	if ($_SESSION["kategori"] != '2') {
		header("Location: Logout.php");
	}
};
?>
<?php

include('include/FormatDate.php');

$NamaPenuh2 = $_SESSION["Gelaran"] . ' ' . $_SESSION["NamaPenuh"];
$TrCetak = date("j/m/Y  H:i:s");
//$strKeputusan=$_POST['selectKeputusan'];
//$strUlasan=$_POST['txtUlasan'];
//$strKategori=$_SESSION["Kumpulan"];


//$idStatusUrusan= $_GET['s'];
$idStatusUrusan = $_GET['s'];

mysql_select_db($database_connspkp, $connspkp);
/*$query_RsStatusUrusan = "SELECT * FROM tblstatusurusan
						INNER JOIN tblurusan
						ON tblstatusurusan.idUrusan = tblurusan.id
						WHERE tblstatusurusan.id='$idStatusUrusan'";
						*/

echo $query_RsStatusUrusan = "SELECT b.desc_jenisurusan,d.MesyuaratDesc,c.siri,g.Keterangan as gred,k.Keterangan as gredJawatann,c.tarikhMesyuarat,e.Gelaran as GelNamaCipta,e.NamaPenuh as namaCipta,f.Gelaran as GelNamaKemaskini, f.NamaPenuh as namaKemaskini, a.*,h.* FROM tblurusan a
          left JOIN tbljenisurusan b ON a.Jenis=b.id_jenisurusan
          inner join tblstatusurusan h on h.idUrusan=a.id
          left join tblgred g on g.ID=a.GredUrusan
		  left join tblgred k on k.ID=a.gredJawatan
          inner JOIN tblmesyuarat c on c.id=a.bilMesyuarat 
          inner join tblreftajukmesyuarat d on d.id=c.TajukMesyuaratID
          left join tblpengguna e on e.id=a.idCipta
          left join tblpengguna f on f.id=a.idkemaskini
          WHERE h.id='$idStatusUrusan'";

$RsStatusUrusan = mysql_query($query_RsStatusUrusan, $connspkp) or die(mysql_error());
$row_RsStatusUrusan = mysql_fetch_assoc($RsStatusUrusan);
$totalRows_RsStatusUrusan = mysql_num_rows($RsStatusUrusan);



$strMula = $row_RsStatusUrusan['TrTerima'];
$strKini = $row_RsStatusUrusan['TrSelesai'];
$date_diff = round(abs(strtotime($strKini) - strtotime($strMula)) / 86400);

//---------------------------------------------START PDF------------------------------------------------//

require('include/fpdf/fpdf.php');


$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 11);

$pdf->Ln(2);
$pdf->Cell(190, 6, '[ SULIT ]', 0, 0, 'L');

$pdf->SetFont('Arial', 'BI', 9);
$pdf->SetFillColor(255);
$pdf->SetX(120);
$pdf->Cell(190, 6, 'No. Fail : ' . $row_RsStatusUrusan['NoKertas'], 0, 0, 'L');

$pdf->SetDrawColor(0);
$pdf->SetLineWidth(0.4);
$pdf->Line(0, 12, 210, 12);

$pdf->Image('images/jata.gif', 93, 17, 25);
$pdf->SetFont('Arial', '', 11);
$pdf->Ln(25);
$pdf->Cell(190, 6, 'JABATAN', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(190, 6, 'PERKHIDMATAN AWAM', 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(190, 6, 'MALAYSIA', 0, 0, 'C');
$pdf->SetLineWidth(0.4);
$pdf->Line(0, 60, 210, 60);


$title = "| " . "Keputusan oleh : " . $NamaPenuh2 . " |" . " Tarikh keputusan : " . format_datetime($strKini) . " |";
//Calculate width of title and position
$pdf->Ln(12);
$w = $pdf->GetStringWidth($title) + 20;
//$pdf->SetX((210-$w)/2);
$pdf->SetX(0);

//Colors of frame, background and text
$pdf->SetDrawColor(128);
$pdf->SetFillColor(200, 200, 255);
$pdf->SetTextColor(0);
//Thickness of frame (1 mm)
$pdf->SetLineWidth(0.3);
//Title
$pdf->Cell(210, 6, $title, 1, 1, 'C', true);
//Line break
$pdf->Ln(12);

//------------------------BODY START----------------------------------------------------//
$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor(0);

$pdf->SetX(20);
$pdf->Cell(190, 6, 'Jenis urusan : ', 0, 0, 'L');
$pdf->SetX(60);


$pdf->Cell(130, 6, $row_RsStatusUrusan['desc_jenisurusan'], 1, 0, 'L');
$pdf->Ln(8);
$pdf->SetX(20);

$pdf->SetX(20);
$pdf->Cell(190, 6, 'Gred Jawatan : ', 0, 0, 'L');
$pdf->SetX(60);


$pdf->Cell(130, 6, $row_RsStatusUrusan['gredJawatann'], 1, 0, 'L');
$pdf->Ln(8);
$pdf->SetX(20);

$pdf->SetX(20);
$pdf->Cell(190, 6, 'Gred Hakiki Pegawai : ', 0, 0, 'L');
$pdf->SetX(60);


$pdf->Cell(130, 6, $row_RsStatusUrusan['gred'], 1, 0, 'L');
$pdf->Ln(8);
$pdf->SetX(20);

$pdf->Cell(190, 6, 'Butiran : ', 0, 0, 'L');
$pdf->SetFillColor(210);
$pdf->SetX(60);
$pdf->MultiCell(130, 6, $row_RsStatusUrusan['Ringkasan'], 1, 2, 'L', 0);
$pdf->Ln(8);
$pdf->SetFillColor(255);


$pdf->Cell(190, 6, 'Keterangan Butiran : ', 0, 0, 'L');
$pdf->SetFillColor(210);
$pdf->SetX(60);
$pdf->MultiCell(130, 6, $row_RsStatusUrusan['KeteranganRingkasan'], 1, 2, 'L', 0);
$pdf->Ln(8);
$pdf->SetFillColor(255);


$pdf->SetX(20);
$pdf->Cell(190, 6, 'Kertas : ', 0, 0, 'L');
$pdf->SetX(60);
$pdf->MultiCell(130, 6, $row_RsStatusUrusan['Kertas'], 1, 2, 'L', 0);
/* 	$pdf->Ln(8);
	$pdf->SetFillColor(255);
	$pdf->SetX(20);
	$pdf->Cell(190,6,'No. Kertas : ',0,0,'L');
	$pdf->SetX(60);
	$pdf->MultiCell(130,6,$row_RsStatusUrusan['NoKertas'],1,2,'L',0); */

$pdf->Ln(15);
$pdf->SetX(20);
$pdf->Cell(190, 6, 'Status : ', 0, 0, 'L');
$pdf->SetX(60);
$pdf->Cell(130, 6, 'Selesai', 1, 0, 'L');
$pdf->Ln(8);
$pdf->SetX(20);
$pdf->Cell(190, 6, 'Tempoh buka : ', 0, 0, 'L');
$pdf->SetX(60);
$pdf->Cell(130, 6, $date_diff . " hari", 1, 0, 'L');
$pdf->Ln(8);
$pdf->SetX(20);
$pdf->Cell(190, 6, 'Tarikh terima :', 0, 0, 'L');
$pdf->SetX(60);
$pdf->Cell(130, 6, format_datetime($row_RsStatusUrusan['TrTerima']), 1, 0, 'L');
$pdf->Ln(8);
$pdf->SetX(20);
$pdf->Cell(190, 6, 'Tarikh Keputusan :', 0, 0, 'L');
$pdf->SetX(60);
$pdf->Cell(130, 6, format_datetime($row_RsStatusUrusan['TrSelesai']), 1, 0, 'L');

$pdf->Ln(15);
$pdf->SetX(20);
$pdf->Cell(190, 6, 'Keputusan : ', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFillColor(210);
$pdf->SetX(60);
$pdf->Cell(130, 6, $row_RsStatusUrusan['Keputusan'], 1, 0, 'L', 1);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 11);
$pdf->SetX(20);
$pdf->Cell(190, 6, 'Ulasan : ', 0, 0, 'L');
$pdf->SetX(60);
$pdf->MultiCell(130, 6, $row_RsStatusUrusan['Ulasan'], 1, 2, 'L', 0);
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 11);
$pdf->SetX(20);
$pdf->Cell(190, 6, 'Maklumbalas : ', 0, 0, 'L');
$pdf->SetX(60);
$pdf->MultiCell(130, 6, $row_RsStatusUrusan['Maklumbalas'], 1, 2, 'L', 0);




//------------------------BODY START----------------------------------------------------//
///////////////////FOOTER////////////////////////

//Calculate width of title and position
$TrCetak = date("j/m/Y  H:i:s");
$footer = "| Hak cipta terpelihara : eCirculation JPA @ 2020 |  Tarikh Cetak : " . $TrCetak . " |";
$pdf->SetY(-60);
$w = $pdf->GetStringWidth($footer) + 24;
//$pdf->SetX((210-$w)/2);
$pdf->SetX(0);

//Colors of frame, background and text
$pdf->SetDrawColor(128);
$pdf->SetFillColor(200, 200, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', '', 11);
//Thickness of frame (1 mm)
$pdf->SetLineWidth(0.3);
//Title
$pdf->Cell(210, 6, $footer, 1, 1, 'C', true);
$pdf->SetDrawColor(0);
$pdf->SetLineWidth(0.4);
$pdf->Line(0, 247, 210, 247);
$pdf->SetFont('Arial', '', 11);
$pdf->Ln(5);
$pdf->Cell(190, 6, '[ SULIT ]', 0, 0, 'R');

///////////////////FOOTER END///////////////////
//    $pdf->Ln(10);
//	$pdf->Cell(10,60,'SURUHANJAYA');


$pdf->SetDisplayMode('fullpage', 'single');
//$pdf->Output();
$myPdfname = sprintf($NamaPenuh2 . "_" . date("jmY") . " (" . $row_RsStatusUrusan['Jenis'] . ").pdf");
$pdfcontent = $pdf->Output($myPdfname, "S");


$pdf->Output();
//---------------------------------------------START PDF END---------------------------------------------//
exit();

//mysql_free_result($RsEmail);
?>
