<!DOCTYPE html>
<?php require_once('Connections/connspkp.php'); ?>
<?php
// *** Validate request to login to this site.
session_start();

$loginFormAction = $_SERVER['PHP_SELF'];

$kambing = array_key_exists('kambing', $_POST) ? $_POST['kambing'] : '';
$rumput = array_key_exists('rumput', $_POST) ? $_POST['rumput'] : '';

// $kambing= mysqli_real_escape_string($kambing);
// $rumput=mysqli_real_escape_string($rumput);

if (isset($_POST['kambing']) && $_POST['kambing'] != '') {

	//$kambing= mysql_real_escape_string($_POST['kambing']);
	//$rumput=mysql_real_escape_string($_POST['rumput']);
	//$kerbau=$_POST['kambing'];
	//$kerbau= mysql_real_escape_string($_POST['kambing']);
	//$rumput=$_POST['rumput'];
	//$rumput=mysql_real_escape_string($_POST['rumput']);
	$lalang = md5($rumput);
	$mysqli = new mysqli("localhost", "root", "", "testing");
	// mysqli_select_db($database_connspkp, $connspkp);

	$result = mysql_query("select * from tblpengguna WHERE Login = '$kambing' and Klaluan = '$lalang' and Status ='aktif' ");
	$myrows = mysql_num_rows($result);
	if ($myrows > 0) {
		while ($data = mysql_fetch_array($result)) {
			$NamaPenuh = $data['NamaPenuh'];
			$Kumpulan = $data['Kumpulan'];
			$Login = $data['Login'];
			$Gelaran = $data['Gelaran'];
			$idPengguna = $data['id'];

			if ($Kumpulan == 5) //Admin
			{
				$kategori = 5;
				echo "<SCRIPT LANGUAGE='JavaScript'>window.location='Utama.php';</script>";
			} else {
				/* $result2 = mysql_query("select DISTINCT(a.kategoriID) from tbluruspengguna a inner join tblmesyuarat b on a.MesyuaratID=b.id inner join tblreftajukmesyuarat c on b.TajukMesyuaratID=c.id inner join tblkategori d on a.kategoriID=d.id_kategori WHERE c.actv_Mesyuarat=1 and a.penggunaID = '$idPengguna' group by a.kategoriID order by d.id_kategori asc limit 1" );*/
				$result2 = mysql_query("select a.kategoriID from tbluruspengguna a where a.penggunaID = '$idPengguna' order by a.id desc  limit 1");
				$myrows2 = mysql_num_rows($result2);
				$data2 = mysql_fetch_array($result2);
				$kategori = $data2['kategoriID'];

				// if ($myrows2 > 0) {
				// while ($data2 = mysql_fetch_array($result2)){

				if ($kategori == 1) {
					echo "<SCRIPT LANGUAGE='JavaScript'>window.location='Utama2.php';</script>";
				} else 
								if ($kategori == 2) {
					echo "<SCRIPT LANGUAGE='JavaScript'>window.location='Utama2.php';</script>";
				} else
								if ($kategori == 3) {
					echo "<SCRIPT LANGUAGE='JavaScript'>window.location='ListUrusan3.php';</script>";
				} else
								if ($kategori == 4) {
					echo "<SCRIPT LANGUAGE='JavaScript'>window.location='Utama.php';</script>";
				} else
								if ($kategori == '') {
					$kategori = '2';
					echo "<SCRIPT LANGUAGE='JavaScript'>window.location='Utama2.php';</script>";
				} //else
				/*	if($kategori=='5')
								{
								    
									echo "<SCRIPT LANGUAGE='JavaScript'>window.location='Utama.php';</script>";
								} */
			}




			//	 }


			// }
			//session_register('user');
			//session_register($dblevel);
			$_SESSION["kategori"] = $kategori;
			// $_SESSION["Kumpulan"] = $kategori;
			$_SESSION["NamaPenuh"] = $NamaPenuh;
			$_SESSION["Login"] = $Login;
			$_SESSION["Gelaran"] = $Gelaran;
			$_SESSION["idPengguna"] = $idPengguna;
		}
		//include('include/Arkib.php');
		include('Logger.php');
		logMe('Login');



		/*
 		if ($Kumpulan=='urusetia'){
			echo "<SCRIPT LANGUAGE='JavaScript'>window.location='Utama.php';</script>";
		} else if ($Kumpulan=='Pengerusi'){
			echo "<SCRIPT LANGUAGE='JavaScript'>window.location='Utama2.php';</script>";
		} else if ($Kumpulan=='Ahli'){
			echo "<SCRIPT LANGUAGE='JavaScript'>window.location='Utama2.php';</script>";
		} else if ($Kumpulan=='Penyelaras'){
			echo "<SCRIPT LANGUAGE='JavaScript'>window.location='ListUrusan3.php';</script>";
		}
*/
	}
}
?>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>eCirculation</title>

	<!-- CSS -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/form-elements.css">
	<link rel="stylesheet" href="assets/css/style.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

	<!-- Favicon and touch icons -->
	<link rel="shortcut icon" href="././images/jatanegaramalaysia.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>

	<!-- Top content -->
	<div class="top-content">

		<div class="inner-bg">
			<div class="container">
				<div class="row">
				</div>
				<?php
				$image_url = "././images/jatanegaramalaysia.png";
				$image_urls = "././images/wq.png";
				?>

				<img src="<?php echo $image_url ?>" height="150" width="180" />
				<img src="<?php echo $image_urls ?>" />
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3 form-box">
						<div class="form-top">
							<div class="form-top-left">
								<h3>Log Masuk ke sistem.</h3>
								<p>Sila masukkan id pengguna dan katalaluan untuk log masuk:</p>
							</div>
							<div class="form-top-right">
								<i class="fa fa-key"></i>
							</div>
						</div>
						<div class="form-bottom">
							<form method="POST" name="frmMsk" id="frmMsk">
								<div class="form-group">
									<label class="sr-only" for="form-username">Username</label>
									<input name="kambing" type="text" id="kambing" size="15" placeholder="ID Pengguna..." class="form-username form-control">
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-password">Password</label>
									<input name="rumput" type="password" id="rumput" size="15" placeholder="Katalaluan..." class="form-password form-control">
								</div>
								<button type="submit" class="btn">Log Masuk</button>
							</form>
						</div>
					</div>
				</div>
				Pembangunan secara Perkongsian Pintar bersama SPA © | Hakcipta Terpelihara JPA 2018
			</div>
		</div>
	</div>


	<!-- Javascript -->
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.backstretch.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

</body>

</html>