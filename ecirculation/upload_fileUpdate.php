<?php
require_once('Connections/connspkp.php');
#require_once('Mail.php');
include('include/FormatDate.php');
//$idUrusan=$_GET['I'];
 	ob_start();
	session_start();

//	if($_SESSION["Kumpulan"] !='urusetia' ){
//		header("Location: Logout.php");
//	};


if($_SESSION["kategori"] !='4'  ){
    if($_SESSION["kategori"] !='5' )
	{
    header("Location: Logout.php");
	}
  };
 $stridKemaskini=$_SESSION["idPengguna"];
echo  $idUrusan=$_GET['I'];
?>
<!--<meta http-equiv="refresh" content="2;URL=Utama.php">-->
<?php
mysql_select_db($database_connspkp, $connspkp);
            $strTrCipta=date("Y-m-j  H:i:s");
			$strTrTkemaskini=date("Y-m-j");
			format_datetime($strTrTkemaskini);
			$strStatus='Baru';
			$NamaPenuh = $_SESSION["NamaPenuh"];
			$Login = $_SESSION["Login"];
			$Gelaran = $_SESSION["Gelaran"];
			
	   echo 	$sqlBilMesy= "SELECT a.bilMesyuarat,b.desc_jenisurusan, a.Ringkasan,d.desc_jenisurusan,a.Kertas,e.NamaPenuh,e.Gelaran,c.TajukMesyuaratID FROM `tblurusan` a
        inner join tbljenisurusan b on a.Jenis=b.id_jenisurusan 
        inner JOIN tblmesyuarat c on c.id=a.bilMesyuarat
        inner join tbljenisurusan d on d.id_jenisurusan=a.Jenis
        inner join tblpengguna e on a.idCipta=e.id
        where a.id='$idUrusan'";
	    $resultMesy = mysql_query($sqlBilMesy, $connspkp) or die(mysql_error());
		$row_RsMesy = mysql_fetch_assoc($resultMesy);
		$BilMesy=$row_RsMesy['TajukMesyuaratID'];
		$jenisurusan=$row_RsMesy['desc_jenisurusan'];
		$GelaranUS=$row_RsMesy['Gelaran'];
		$NamaPenuhUS=$row_RsMesy['NamaPenuh'];
		$strRingkasan=$row_RsMesy['Ringkasan'];
		

		
		//Semak Pengerusi dan ahli telah dilantik atau belum                	 					
       echo $sqlpengguna = "SELECT count(*) from tbluruspengguna a  where TajukMesyuaratID='$BilMesy' and kategoriID in ('1','2')";	
	   $resultP = mysql_query($sqlpengguna, $connspkp) or die(mysql_error());
	   $rowcountP=mysql_num_rows($resultP);
	
		//Pengerusi dan ahli sahaja                	 					
       echo $sqlgelaranpengguna = "SELECT a.penggunaID,a.susunan,b.Gelaran,b.Email,a.kategoriID from tbluruspengguna a 
inner join tblpengguna b on a.penggunaID=b.id where TajukMesyuaratID='$BilMesy' and kategoriID in ('1','2')
and a.penggunaID not in(SELECT idPengguna FROM `tblstatusurusan` where idUrusan='$idUrusan') order by a.susunan asc";	
	   $result2 = mysql_query($sqlgelaranpengguna, $connspkp) or die(mysql_error());
	   $rowcount=mysql_num_rows($result2);
	  // $row_RsPengguna= mysql_fetch_assoc($result2);  
	  
	  
	  //Urusetia               	 					
       echo $sqlUrusetia = "SELECT a.penggunaID,b.Gelaran,b.Email from tbluruspengguna a inner join tblpengguna b on a.penggunaID=b.id where a.TajukMesyuaratID='$BilMesy' and a.kategoriID in ('4')";	
	   $resultUS = mysql_query($sqlUrusetia, $connspkp) or die(mysql_error());
	   $rowUS=mysql_num_rows($resultUS); 

	  if($rowcountP==0)
		{
			 echo("<SCRIPT LANGUAGE='JavaScript'>
			if (window.alert('Tiada Ahli dan Pengerusi dilantik dalam urusan mesyuarat. Sila lantik terlebih dahulu')){
			window.open('Utama.php', 'Thanks for Visiting!');}
				</SCRIPT>");
			
	    }
		else
	if($rowcountP>0)
	   {

      
	 if($rowcount>0)
	 {
		while ($row_result3 = mysql_fetch_assoc($result2))
			{
				$stridPengguna = $row_result3['penggunaID'];
				$susunan = $row_result3['susunan'];
				$gelaran = $row_result3['Gelaran'];
				$emailto = $row_result3['Email'];
				$kategoriID = $row_result3['kategoriID'];

				$setTomorrow = strtotime("24 hours");
				$expiredDate= date('Y-m-j h:i:s', $setTomorrow);

				mysql_select_db($database_connspkp, $connspkp);
				$query_uuid = "SELECT  uuid() as UUID";
				$RsUUID = mysql_query($query_uuid, $connspkp) or die(mysql_error());
				$row_UUID = mysql_fetch_assoc($RsUUID);
				$uuid=$row_UUID['UUID'];
				$stat="Baru";
				
				
			    if($gelaran=="Dato'"||$gelaran=="Datuk"||$gelaran=="Tan Sri")
					{
		  				$gelaransebenar="YBhg ".$gelaran;
					}else 
					{
					$gelaransebenar=$gelaran;
					}
		
		
		        echo $sqlstatusurusan = sprintf("Insert into tblstatusurusan
																		 (idPengguna, idUrusan,TrTerima, Status,kategoriID)
																		 values
																		 ('$stridPengguna', '$idUrusan','$strTrCipta', '$strStatus','$kategoriID')");
				 $result4 = mysql_query($sqlstatusurusan)or die("Connection Failed daa!");
				 
				 echo $sqlsession = sprintf("Insert into tblsession
																		 (uuid,penggunaID, expiredDate)
																		 values
																		 ('$uuid', '$stridPengguna','$expiredDate')");
				 $result5 = mysql_query($sqlsession)or die("Connection Failed daa!");
				 //Hantar emel kepada ahli sahaja. Pengerusi hanya akan terima emel setelah semua ahli buat keputusan .
			     if($kategoriID==2)
				 {
				 
				 
				 $host = "postmaster.1govuc.gov.my";

				 $subject1 = "Urusan (".$jenisurusan.") di eCirculation JPA";
												//$subject1 = "Urusan Baru telah dicipta di sistem eCirculation JPA";
                        $message1 = $gelaransebenar." mempunyai urusan berikut di eCirculation JPA.\n\nUrusan : ".$jenisurusan."\nRingkasan :".$strRingkasan."\nTarikh Hantar: ".format_datetime($strTrTkemaskini)."\n\n https://ecirculation.jpa.gov.my/Pengerusi/LihatUrusan2.php?kategori=".$kategoriID."&idPengguna=".$stridPengguna."&uuid=".$uuid."&stat=".$stat." \n\nIni adalah email automatik dari sistem eCirculation JPA,\nEMEL INI TIDAK PERLU DIJAWAB.\n\nSekian, Terima Kasih\n\nUrusetia,\nJabatan Perkhidmatan Awam Malaysia\n\n";

												$email_from = 'eCirculationJPA';//<== update the email address
												$email_subject = $subject1;
												$email_body = $message1;

												$to =  $emailto;//<== update the email address
												$headers = "From: $email_from \r\n";
												$headers .= "Reply-To: $emailto \r\n";
												//Send the email!
												mail($to,$email_subject,$email_body,$headers);
												//done. redirect to thank-you page.
												header('Location:Utama.php');
		
		
			}//close while ($row_result3 = mysql_fetch_assoc($result2))
			
			}// if($kategoriID==2)
         while ($row_result_Email = mysql_fetch_assoc($resultUS))
											{

		                      				$emailtoU = $row_result_Email['Email'];
											$host = "postmaster.1govuc.gov.my";
											$emailtoU = $emailtoU;


                        $subject = "Urusan Baru telah dicipta di sistem eCirculation JPA";
                        $message = "Satu urusan telah dicipta di eCirculation JPA.\n\nUrusan : ".$jenisurusan."\nRingkasan: ".$strRingkasan."\n\nTarikh Cipta : ".format_datetime($strTrTkemaskini)."\nCipta oleh: \nNama Penuh: ".$GelaranUS." ".$NamaPenuhUS."\n\n https://ecirculation.jpa.gov.my/ \n\nIni adalah email automatik dari sistem eCirculation JPA,\nEMEL INI TIDAK PERLU DIJAWAB.\n\nSekian, Terima Kasih\n\nUrusetia,\nJabatan Perkhidmatan Awam Malaysia\n\n";

												$email_from = 'eCirculationJPA';//<== update the email address
												$email_subject = $subject;
												$email_body = $message;

												$to =  $emailtoU;//<== update the email address
												$headers = "From: $email_from \r\n";
												$headers .= "Reply-To: $emailtoU \r\n";
												//Send the email!
												mail($to,$email_subject,$email_body,$headers);
												//done. redirect to thank-you page.
												header('Location:Utama.php');
										}//close ($row_result_Email = mysql_fetch_assoc($resultUS))
										
        echo  $sqlurusan =("UPDATE tblurusan SET idkemaskini ='$stridKemaskini', TrKemaskini ='$strTrCipta',Status = '$strStatus'  WHERE id = '$idUrusan' ");
		                      	$result1 = mysql_query($sqlurusan, $connspkp) or die(mysql_error());
 
    }// close if($rowcount>0)
//header('Location:Utama.php');
}

?>
