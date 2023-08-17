<?php 
require_once('Connections/connspkp.php');
require_once('Mail.php');
include('include/FormatDate.php');

 	ob_start();
	session_start(); 

	if($_SESSION["Kumpulan"] !='urusetia' ){
		header("Location: Logout.php");
	}; 
 

?>
<meta http-equiv="refresh" content="2;URL=Utama.php">
<?php
mysql_select_db($database_connspkp, $connspkp);


/////////////////REQUEST DATA START////////////////
         //$strKategori=$_POST['selectKategori'];
         $strNoKertas=mysql_real_escape_string($_POST['txtNoKertas']);
		 $strNoRuj=mysql_real_escape_string($_POST['rujbhg']);
		 $vbilCir=mysql_real_escape_string($_POST['bilCir']);
		 $strJenisUrusan=$_POST['selectJenisUrusan'];
         $strRingkasan=mysql_real_escape_string($_POST['txtRingkasan']);
         $stridCipta=$_SESSION["idPengguna"];
         $strTrCipta=date("Y-m-j H:i:s");
		 $strStatus='Baru';
		 
		 $NamaPenuh = $_SESSION["NamaPenuh"];
		 $Login = $_SESSION["Login"];
		 $Gelaran = $_SESSION["Gelaran"];

		 
/////////////////REQUEST DATA END////////////////


/////////////////UPLOAD START////////////////////////////////////////////////////////////////////////////////////////////////////////
if ((($_FILES["file"]["type"] == "application/pdf"))//rujuk http://www.w3schools.com/media/media_mimeref.asp untuk senarai jenis file
&& ($_FILES["file"]["size"] < 20000000000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Maklumat dari sistem: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    //echo "Jenis: " . $_FILES["file"]["type"] . "<br />";
    //echo "Saiz: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      //echo "Maaf, ".$_FILES["file"]["name"] . " telah wujud. ";
      echo("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Maaf, fail".$_FILES["file"]["name"]."telah wujud"."')
				</SCRIPT>");
	  }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      //echo "Fail anda telah berjaya di simpan dalam: " . "upload/" . $_FILES["file"]["name"];
      echo("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Fail anda telah berjaya di simpan')
				</SCRIPT>");
	  
	  
//-------------------///////////////////SAVE in tblurusan & tblstatusurusan START////////////////////////////////////////////////////	
						$strKertas1 = $_FILES["file"]["name"];
						$strLink1 = "upload/".$_FILES["file"]["name"];
						
						$strKertas = mysql_real_escape_string($strKertas1);
						$strLink = mysql_real_escape_string($strLink1);
						/////////////////////////////////////////////////////////////////////////////////////
						/* $sqlurusan = "Insert into tblurusan 
										(Kategori, Jenis, Ringkasan, Kertas, NoKertas, Link, idCipta, TrCipta, Status, idkemaskini ) 
										values 
										('$strKategori', '$strJenisUrusan', '$strRingkasan', '$strKertas', '$strNoKertas', '$strLink', '$stridCipta', '$strTrCipta', '$strStatus', '$stridCipta')";  */
						$sqlurusan = "Insert into tblurusan 
										(Jenis, Ringkasan, Kertas, NoKertas, rujBhg, bilMesyuarat, Link, idCipta, TrCipta, Status, idkemaskini ) 
										values 
										('$strJenisUrusan', '$strRingkasan', '$strKertas', '$strNoKertas', '$strNoRuj', '$vbilCir','$strLink', '$stridCipta', '$strTrCipta', '$strStatus', '$stridCipta')"; 
                      	$result1 = mysql_query($sqlurusan) or die(mysql_error()); 
                        /////////////////////////////////////////////////////////////////////////////////////
						$sqlurusan2 = "SELECT id FROM tblurusan WHERE Link = '$strLink'";
						$result2 = mysql_query($sqlurusan2) or die(mysql_error());
						$row_result2 = mysql_fetch_assoc($result2);
						$stridUrusan = $row_result2['id'];
                        /////////////////////////////////////////////////////////////////////////////////////
						
						/* $sqlpengguna = "SELECT * FROM tblpengguna WHERE Kumpulan = '$strKategori' AND status = 'Aktif'";  */
						$sqlpengguna = "SELECT * FROM tblpengguna WHERE Kumpulan !='urusetia' && Kumpulan !='SUB' AND status = 'Aktif'"; 
                      	$result3 = mysql_query($sqlpengguna) or die(mysql_error()); 
						
						/* $sqlgelaranpengguna = "SELECT * FROM tblpengguna WHERE Kumpulan = '$strKategori' AND status = 'Aktif' GROUP BY Gelaran ORDER BY Susunan";  */
						$sqlgelaranpengguna = "SELECT * FROM tblpengguna WHERE status = 'Aktif' GROUP BY Gelaran ORDER BY Susunan"; 
                      	$result_sqlgelaranpengguna = mysql_query($sqlgelaranpengguna) or die(mysql_error());
					 		$myGreet = '';
							while ($row_result_sqlgelaranpengguna = mysql_fetch_assoc($result_sqlgelaranpengguna)) {
										$myGelaran = $row_result_sqlgelaranpengguna['Gelaran'];
										if($myGreet <> ''){
										$myGreet = $myGreet."/".$myGelaran;
										}
										else {$myGreet = $myGelaran;}
										
                       				}
							
							while ($row_result3 = mysql_fetch_assoc($result3)) { 
                      				$stridPengguna = $row_result3['id'];
									$emailto = $row_result3['Email'];
					  				
									
									$sqlstatusurusan = sprintf("Insert into tblstatusurusan
																 (idPengguna, idUrusan,TrTerima, Status) 
																 values 
																 ('$stridPengguna', '$stridUrusan','$strTrCipta', '$strStatus')");
					  				$result4 = mysql_query($sqlstatusurusan)or die("Connection Failed daa!");
                      							
  									//_____________________//Send Email to recipients START////////////////////////////////////////////////////////////////////
												//$to = $emailto;
												$greet = $myGreet;
												
												$host = "postmaster.1govuc.gov.my";
												$username = "ecspa";
												$password = "P@ssword.123";
												
												$to = $emailto.",".$to;
												$subject = "Urusan (".$strJenisUrusan.") di eCirculation SPA";
												$message = $greet." mempunyai urusan berikut di eCirculation SPA.\n\nUrusan : ".$strJenisUrusan."\nRingkasan :".$strRingkasan."\nTarikh Hantar: ".format_datetime($strTrCipta)."\n\nhttps://putra5.spa.gov.my/ecirculation_spa/ \n\nIni adalah email automatik dari sistem eCirculation SPA,\nEMEL INI TIDAK PERLU DIJAWAB.\n\nSekian, Terima Kasih\n\nUrusetia,\nSuruhanjaya Perkhidmatan Awam Malaysia\n\n";
												$from = "ecspa@spa.gov.my";
												/* $headers = "From: $from"."\n";
												$headers .= "Message-Id: <" . md5(uniqid(microtime())) . "@" . "spa.gov.my" . ">\n"; 
												$headers .= "X-Priority: 1 (Higuest)\n"; 
												$headers .= "X-MSMail-Priority: High\n"; 
												$headers .= "Importance: High\n"; */
												$body=$message;
												$headers = array('From' => $from, 
												'Subject' => $subject,
												'X-Priority'=> 1, 
												'X-MSMail-Priority' => 'High',
												'Importance' => 'High');
 												
									}//mail($to,$subject,$message,$headers);
									$smtp = Mail::factory('smtp',
									array ('host' => $host));
									/* array ('host' => $host,
									'auth' => true,
									'username' => $username,
									'password' => $password)); */
									$mail = $smtp->send($to, $headers, $body);
									
									
									//_____________________//Send Email to recipients END//////////////////////////////////////////////////////////////////////
									
									
 						$sqlEmail = "SELECT * FROM tblpengguna WHERE Kumpulan='urusetia' AND status='Aktif'"; 
                      	$result_Email = mysql_query($sqlEmail) or die(mysql_error()); 
					 
							while ($row_Email = mysql_fetch_assoc($result_Email)) { 
									$emailto2 = $row_Email['Email'];
											    
 										//_____________________//Send Email to Urusetia START////////////////////////////////////////////////////////////////////
										$to2 = $emailto2.",".$to2;
										
										$host = "postmaster.1govuc.gov.my";
										$username = "ecspa";
										$password = "P@ssword.123";
										
										
										$subject = "Urusan Baru telah dicipta di sistem eCirculation SPA";
										$message = "Satu urusan telah dicipta di eCirculation SPA.\n\nUrusan : ".$strJenisUrusan."\nKertas : ".$strKertas."\n\nTarikh Cipta : ".format_datetime($strTrCipta)."\nCipta oleh: ".$Login."\nNama Penuh: ".$Gelaran." ".$NamaPenuh."\n\nhttps://ecirculation.jpa.gov.my/ \n\nIni adalah email automatik dari sistem eCirculation JPA,\nEMEL INI TIDAK PERLU DIJAWAB.\n\nSekian, Terima Kasih\n\nUrusetia,\nJabatan Perkhidmatan Awam Malaysia\n\n";
										$from = "ecspa@spa.gov.my";
										$headers = "From: $from"."\n";
										//$headers. = "MIME-Version: 1.0\n" ; 
										//$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
/* 										$headers .= "Message-Id: <" . md5(uniqid(microtime())) . "@" . "spa.gov.my" . ">\n"; 
										$headers .= "X-Priority: 1 (Higuest)\n"; 
										$headers .= "X-MSMail-Priority: High\n"; 
										$headers .= "Importance: High\n"; */ 
										$body=$message;
										$headers = array('From' => $from, 
										'Subject' => $subject,
										'X-Priority'=> 1, 
										'X-MSMail-Priority' => 'High',
										'Importance' => 'High');

									}//mail($to2,$subject,$message,$headers);
									$smtp = Mail::factory('smtp',
									array ('host' => $host));
									/* array ('host' => $host,
									'auth' => true,
									'username' => $username,
									'password' => $password)); */
									$mail = $smtp->send($to2, $headers, $body);
									
									
 									//_____________________//Send Email to urusetia END//////////////////////////////////////////////////////////////////////
									include('Logger.php');
									logMe("Upload urusan: ".$strRingkasan);

									
									
									
									mysql_free_result($result3);
									mysql_free_result($result_Email);

//-------------------///////////////////SAVE in tblurusan & tblstatusurusan END////////////////////////////////////////////////////  
	  
	  	
	  }
    }
  }
else
  {
  				echo("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('Maaf, Fail anda tidak sah. Sila upload fail pdf sahaja')
				</SCRIPT>");
  } 
/////////////////UPLOAD END////////////////////////////////////////////////////////////////////////////////////////////////////////



mysql_free_result($result2);
?>
