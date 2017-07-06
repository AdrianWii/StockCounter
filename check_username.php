<?php
	include_once("functions.php");
	initializeSite();
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();

	if(isset($_POST["login"]))
	{
		$mysqlConnect->polacz();
		
		$login=secureString($_POST["login"]);
		$username_exist = mysqli_num_rows($mysqlZapytanie->zapytanie("select id_uzytkownika from uzytkownicy where login='$login'")); //total records
		
		if($username_exist) {
			echo "<img src='images/noavailable.png'/> Podany login jest już zajęty. Wymyśl nowy...";
		}else{
			echo "<img src='images/available.png'/>";
		}
		
		mysqli_close($mysqlConnect->polacz());
	}
?>

