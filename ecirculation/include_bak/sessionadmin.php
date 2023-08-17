<? 
ob_start();
session_start(); 

if($_SESSION["Kumpulan"] !='urusetia' ){
		header("Location: Logout.php");
	};
?>