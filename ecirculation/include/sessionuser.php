<?  
session_start(); 

if($_SESSION["level"] !=root ){
	if($_SESSION["level"] !=norm ){
		header("Location: logout.php");
		}
	};
?>