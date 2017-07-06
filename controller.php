<?php
	include_once("functions.php");
	initializeSite();

	if (isset($_GET['method'])){
		if($_GET['method']=='insertUser')
			insertUser();
		else if($_GET['method']=='loginUser')
			loginUser();
		else if($_GET['method']=='logOut')
			logoutUser();
		else if($_GET['method']=='deleteUser')
			deleteUser();
		else if($_GET['method']=='changePassword')
			changePassword();
		else if($_GET['method']=='updateUser')
			updateUser();
		else if($_GET['method']=='insertMagazyn')
			insertMagazyn();
		else if($_GET['method']=='updateMagazyn')
			updateMagazyn();
		else if($_GET['method']=='deleteMagazyn')
			deleteMagazyn();
		else if($_GET['method']=='insertSmak')	
			insertSmak();
		else if($_GET['method']=='updateSmak')	
			updateSmak();
		else if($_GET['method']=='deleteSmak')	
			deleteSmak();
		else if($_GET['method']=='insertJednostka')	
			insertJednostka();
		else if($_GET['method']=='updateJednostka')	
			updateJednostka();
		else if($_GET['method']=='deleteJednostka')	
			deleteJednostka();
		else if($_GET['method']=='insertKategoria')	
			insertKategoria();
		else if($_GET['method']=='updateKategoria')	
			updateKategoria();
		else if($_GET['method']=='deleteKategoria')	
			deleteKategoria();
		else if($_GET['method']=='insertPojemnosc')	
			insertPojemnosc();
		else if($_GET['method']=='updatePojemnosc')	
			updatePojemnosc();
		else if($_GET['method']=='deletePojemnosc')	
			deletePojemnosc();
		else if($_GET['method']=='insertProduct')	
			insertProdukt();
		else if($_GET['method']=='deleteProduct')	
			deleteProdukt();
		else if($_GET['method']=='updateProduct')	
			updateProdukt();
		else if($_GET['method']=='insertSklad')	
			insertSklad();
		else if($_GET['method']=='deleteSklad')	
			deleteSklad();
		else{
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$mysqlConnect->dane();
			echo $_COOKIE['loggedin'];
			$mysqlZapytanie->zapytanie("UPDATE sesja SET sesja.COOKIE='$_COOKIE[loggedin]' WHERE sesja.LOGGED='$_GET[method]'");
			mysqli_close($mysqlConnect->polacz());
			header("location: start.php");
		}
	}
?>