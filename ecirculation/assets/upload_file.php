<?php
require_once('Connections/connspkp.php');
#require_once('Mail.php');
include('include/FormatDate.php');

 	ob_start();
	session_start();

//if($_SESSION["Kumpulan"] !='urusetia' ){
//		header("Location: Logout.php");
//	};
//edited by zana 1032020
	if($_SESSION["kategori"] !='4' ){
    header("Location: Logout.php");
	
  };
?>
<!--<meta http-equiv="refresh" content="2;URL=Utama.php">-->
<?php
mysql_select_db($database_connspkp, $connspkp);


/////////////////REQUEST DATA START////////////////
         
		echo  $strJenisUrusan=$_POST['selectJenisUrusan'];
		 echo $strGredUrusan=$_POST['gredurusan'];
		echo  $bilMesyK=$_POST['bilMesyK'];
		echo$strRingkasan=mysql_real_escape_string($_POST['txtRingkasan']);
		  $strNoKertas=mysql_real_escape_string($_POST['txtNoKertas']);
		 $strNoRuj=mysql_real_escape_string($_POST['rujbhg']);
		 
         
         $stridCipta=$_SESSION["idPengguna"];
         $strTrCipta=date("Y-m-j H:i:s");
		 $strTrCuti=date("Y-m-j");
		 $strStatus='Baru';
		 $NamaPenuh = $_SESSION["NamaPenuh"];
		 $Login = $_SESSION["Login"];
		 $Gelaran = $_SESSION["Gelaran"];


/////////////////REQUEST DATA END////////////////


/////////////////UPLOAD START////////////////////////////////////////////////////////////////////////////////////////////////////////
if ((($_FILES["file"]["type"] == "application/pdf"))//rujuk http://www.w3schools.com/media/media_mimeref.asp untuk senarai jenis file
&& ($_FILES["file"]["size"] < 2000000000000))

  	{
  		if ($_FILES["file"]["error"] > 0)
    		{
    			echo "Maklumat dari sistem: " . $_FILES["file"]["error"] . "<br />";
    		}

  		else
    		{htyhgffg
  

    				/*	if (file_exists("upload/" . $_FILES["file"]["name"]))
      						{
						      //echo "Maaf, ".$_FILES["file"]["name"] . " telah wujud. ";
						      echo("<SCRIPT LANGUAGE='JavaScript'>
										window.alert('Maaf, fail".$_FILES["file"]["name"]."telah wujud"."')
										</SCRIPT>");
	  						}
    					else
      						{   
							*/
							$newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["file"]["name"]));
							    move_uploaded_file($_FILES["file"]["tmp_name"],
							    "upload/" . $_FILES["file"]["name"]);
							    //echo "Fail anda telah berjaya di simpan dalam: " . "upload/" . $_FILES["file"]["name"];
							    echo "$stridPengguna";
							    echo("<SCRIPT LANGUAGE='JavaScript'>
									window.alert('Fail anda telah berjaya di simpan')
									</SCRIPT>");


		//-------------------///////////////////SAVE in tblurusan & tblstatusurusan START////////////////////////////////////////////////////
								$strKertas1 = $_FILES["file"]["name"];
								$strLink1 = "upload/".$_FILES["file"]["name"];

								$strKertas = mysql_real_escape_string($strKertas1);
								$strLink = mysql_real_escape_string($strLink1);
								/////////////////////////////////////////////////////////////////////////////////////
						echo 		$sqlurusan = "Insert into tblurusan
												(Jenis, Ringkasan, Kertas, NoKertas, rujBhg, bilMesyuarat, Link, idCipta, TrCipta, Status, idkemaskini,GredUrusan )
												values
												('$strJenisUrusan', '$strRingkasan', '$strKertas', '$strNoKertas', '$strNoRuj','$bilMesyK','$strLink', '$stridCipta', '$strTrCipta', '$strStatus', '$stridCipta',$strGredUrusan)";
		                      //	$result1 = mysql_query($sqlurusan) or die(mysql_error());
		                        /////////////////////////////////////////////////////////////////////////////////////
	 /*  							$sqlurusan2 = "SELECT id FROM tblurusan WHERE Link = '$strLink'";
								$result2 = mysql_query($sqlurusan2) or die(mysql_error());
								$row_result2 = mysql_fetch_assoc($result2);
								$stridUrusan = $row_result2['id'];
		                        /////////////////////////////////////////////////////////////////////////////////////


								$sqlgelaranpengguna = "SELECT * FROM tblpengguna WHERE status = 'Aktif' GROUP BY Gelaran ORDER BY Susunan";
		                      	$result_sqlgelaranpengguna = mysql_query($sqlgelaranpengguna) or die(mysql_error());
							 		$myGreet = '';

							 		echo "Upload: " . $_FILES["file"]["name"] . "<br />";
									while ($row_result_sqlgelaranpengguna = mysql_fetch_assoc($result_sqlgelaranpengguna))
											{
												$myGelaran = $row_result_sqlgelaranpengguna['Gelaran'];
												if($myGreet <> ''){
												$myGreet = $myGreet."/".$myGelaran;
												}
												else {$myGreet = $myGelaran;}

		                       				}

                          
							//	$sqlpengguna = "SELECT * FROM tblpengguna WHERE Kumpulan !='urusetia' && Kumpulan !='Penyelaras' AND status = 'Aktif'";
							    $sqlpengguna = "SELECT * FROM tblpengguna WHERE Kumpulan !='urusetia' && Kumpulan !='Penyelaras' AND status = 'Aktif'";
		                      	$result3 = mysql_query($sqlpengguna) or die(mysql_error());
									while ($row_result3 = mysql_fetch_assoc($result3))
											{

		                      				$stridPengguna = $row_result3['id'];
											$susunan = $row_result3['Susunan'];
											$gelaran = $row_result3['Gelaran'];
											$emailto = $row_result3['Email'];

											$host = "postmaster.1govuc.gov.my";

											$sqlstatusurusan = sprintf("Insert into tblstatusurusan
																		 (idPengguna, idUrusan,TrTerima, Status, susunan)
																		 values
																		 ('$stridPengguna', '$stridUrusan','$strTrCipta', '$strStatus', '$susunan')");
							  				$result4 = mysql_query($sqlstatusurusan)or die("Connection Failed daa!");



											if(!isset($_POST['submit']))
												{
													//This page should not be accessed directly. Need to submit the form.
													echo "error; you need to submit the form!";
												}


												$subject1 = "Urusan (".$strJenisUrusan.") di eCirculation JPA";
												//$subject1 = "Urusan Baru telah dicipta di sistem eCirculation JPA";
												$message1 = $gelaran." mempunyai urusan berikut di eCirculation JPA.\n\nUrusan : ".$strJenisUrusan."\nRingkasan :".$strRingkasan."\nTarikh Hantar: ".format_datetime($strTrCipta)."\n\n https://ecirculation.jpa.gov.my/ \n\nIni adalah email automatik dari sistem eCirculation JPA,\nEMEL INI TIDAK PERLU DIJAWAB.\n\nSekian, Terima Kasih\n\nUrusetia,\nJabatan Perkhidmatan Awam Malaysia\n\n Satu urusan telah dicipta di eCirculation JPA.\n\nUrusan : ".$strJenisUrusan."\nKertas : ".$strKertas."\n\nTarikh Cipta : ".format_datetime($strTrCipta)."\nCipta oleh: ".$Login."\nNama Penuh: ".$Gelaran." ".$NamaPenuh."\n\n https://ecirculation.jpa.gov.my/ \n\nIni adalah email automatik dari sistem eCirculation JPA,\nEMEL INI TIDAK PERLU DIJAWAB.\n\nSekian, Terima Kasih\n\nUrusetia,\Jabatan Perkhidmatan Awam Malaysia\n\n";

												$email_from = 'eCirculationJPA';//<== update the email address
												$email_subject = $subject1;
												$email_body = $message1;

												$to =  $emailto;//<== update the email address
												$headers = "From: $email_from \r\n";
												$headers .= "Reply-To: $visitor_email \r\n";
												//Send the email!
												mail($to,$email_subject,$email_body,$headers);
												//done. redirect to thank-you page.
												header('Location:Utama.php');
										}

							$sqlEmail = "SELECT * FROM tblpengguna WHERE Kumpulan='urusetia' AND status='Aktif'";
                      		$result_Email = mysql_query($sqlEmail) or die(mysql_error());
                      		while ($row_result_Email = mysql_fetch_assoc($result_Email))
											{

		                      				$emailtoU = $row_result_Email['Email'];
											$host = "postmaster.1govuc.gov.my";
											$emailtoU = $emailtoU;
											if(!isset($_POST['submit']))
												{
													//This page should not be accessed directly. Need to submit the form.
													echo "error; you need to submit the form!";
												}
												//$name = $_POST['name'];
												//$visitor_email = $_POST['email'];

												$subject = "Urusan Baru telah dicipta di sistem eCirculation JPA";
										        $message = "Satu urusan telah dicipta di eCirculation JPA.\n\nUrusan : ".$strJenisUrusan."\nKertas : ".$strKertas."\n\nTarikh Cipta : ".format_datetime($strTrCipta)."\nCipta oleh: ".$Login."\nNama Penuh: ".$Gelaran." ".$NamaPenuh."\n\n https://ecirculation.jpa.gov.my/ \n\nIni adalah email automatik dari sistem eCirculation JPA,\nEMEL INI TIDAK PERLU DIJAWAB.\n\nSekian, Terima Kasih\n\nUrusetia,\nJabatan Perkhidmatan Awam Malaysia\n\n";

												$email_from = 'eCirculationJPA';//<== update the email address
												$email_subject = $subject;
												$email_body = $message;

												$to =  $emailtoU;//<== update the email address
												$headers = "From: $email_from \r\n";
												$headers .= "Reply-To: $visitor_email \r\n";
												//Send the email!
												mail($to,$email_subject,$email_body,$headers);
												//done. redirect to thank-you page.
											//	header('Location:Utama.php');
										}



//mysql_free_result($result2);
?>
