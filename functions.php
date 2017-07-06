<?php
	function initializeSite(){
		include_once("class.php");
		$str="Włącz obsługę JavaScript, jeśli chcesz przeglądać stronę.";
		echo "<script type=\"text/javascript\"></script><noscript><div id=\"noscript-warning\">Włącz JavaScript, aby aplikacja była w pełni dostępna!</div></noscript>";
	}
	function isCoookieSet(){ #inicjowanie sesji
		//session_start();
		if(!isset($_COOKIE['loggedin']))
			{
				$mysqlConnect = new mysqlConnect();
				$mysqlZapytanie = new mysqlZapytanie();
				$mysqlConnect->dane();
				if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
				$mysqlZapytanie->zapytanie("DROP TABLE sesja");
				mysqli_close($mysqlConnect->polacz());
				header("location:index.php");
			};
	}
	function optionInject($zapytanie){
		while($tabl=mysqli_fetch_array($zapytanie)){
		#tabl[0] - NUMER ID
		#tabl[1] - NAZWA
		echo "<option value=".$tabl[0].">".$tabl[1]."</option>";
		}
	}
	function optionInject2($zapytanie){
		while($tabl=mysqli_fetch_array($zapytanie)){
		echo "<option class=users value=".$tabl[0].">".$tabl[1]." ".$tabl[2]."</option>";
		}
	}
	function optionInject3($zapytanie){
		while($tabl=mysqli_fetch_array($zapytanie)){
		echo "<option class=users value=".$tabl[0].">".$tabl[1]." ".$tabl[2]." ".$tabl[3]."</option>";
		}
	}
	function optionInject4($zapytanie){
		while($tabl=mysqli_fetch_array($zapytanie)){
		echo "<option class=users value=".$tabl[0].">".$tabl[1]." ".$tabl[2]." ".$tabl[3]." &rarr; ".$tabl[4]."</option>";
		}
	}
	function optionInjectMD5($zapytanie){
		while($tabl=mysqli_fetch_array($zapytanie)){
		echo "<option class=users value=".md5($tabl[0]).">".$tabl[1]." ".$tabl[2]."</option>";
		}
	}
	function mainNav(){
		$start="start.php";
		$inwentarz="inwentarz.php";
		$produkty="lista_produktow.php";
		$magazyn="magazyn.php";
		$sklad="lista_skladu.php";
		$wagi="#";
		$liczniki="#";
		$raporty="raporty.php";
		$wyloguj="controller.php?method=logOut";
		
		echo	"<nav id=main_nav class=visibleDivNav>
					<ul id=menu_list>
						<li><a id=a href=".$start.">START</a></li>
						<li><a id=b href=".$inwentarz.">INWENTARZ</a></li>
						<li><a id=c href=".$produkty.">PRODUKTY</a></li>
						<li><a id=d href=".$magazyn.">MAGAZYNY</a></li>
						<li><a id=e href=".$sklad.">SKŁAD</a></li>
						<li><a id=f href=".$wagi.">WAGI</a></li>
						<li><a id=g href=".$liczniki.">LICZNIKI</a></li>
						<li><a id=h href=".$raporty.">RAPORTY</a></li>
						<li><a id=i href=".$wyloguj.">WYLOGUJ</a></li>
					</ul>
				</nav>";
	}
	function mainMenu(){
		$dodaj_produkt='dodaj_produkt.php';
		$usun_produkt='usun_produkt.php';
		$edytuj_produkt='edytuj_produkt.php';
		
		$dodaj_dostawce='';
		$usun_dostawce='';
		$edytu_dostawce='';
		
		$dodaj_osobe='dodaj_uzytkownika.php';
		$usun_osobe='usun_uzytkownika.php';
		$edytuj_osobe='edytuj_uzytkownika.php';
		
		$edytuj_sklad='sklad.php';
		$historia='';
		$logowania='logi.php';
		
		$smak='smak.php';
		$kategoria='kategoria.php';
		$jednostka='jednostka.php';
		$magazyn='magazyn.php';
		$pojemnosc='pojemnosc.php';
		
		?>
		<!-- IKONY MENU/ BUTTONY -->
		<table class=menu>
			<tr>
			<td><button type=button onclick="location='<?php echo $dodaj_produkt;?>'" class="menu">DODAJ PRODUKT</button></td> <td><button type=button onclick="location='<?php echo $usun_produkt;?>'" class="menu">USUŃ PRODUKT</button></td>
			<td id=column_space> </td>
			<td><button type=button onclick="location='<?php echo $dodaj_osobe; ?>'" class="menu" id=admin_access>DODAJ OSOBĘ</button></td> <td><button type=button onclick="location='<?php echo $usun_osobe; ?>'" class="menu" id=admin_access>USUŃ OSOBĘ</button></td>
			<td id=column_space> </td>
			<td></td> <td></td>
			</tr><tr>
			<td><button type=button onclick="location='<?php echo $edytuj_produkt;?>'" class="menu">EDYTUJ PRODUKT</button></td> <td><button type=button onclick="location='<?php echo $edytuj_sklad;?>'" class="menu2">EDYTUJ SKŁAD</button></td>
			<td id=column_space> </td>
			<td><button type=button onclick="location='<?php echo $edytuj_osobe;?>'" class="menu" id=admin_access>EDYTUJ OSOBĘ</button></td> <td><button type=button onclick="location='<?php echo $logowania; ?>'" class="menu2" id=admin_access>LOGOWANIA</button></td>
			<td id=column_space> </td>
			<td></td> <td></td>
			</tr><tr>
			<td><button type=button class="menu2" id=mng_access onclick="location='<?php echo $smak;?>'">DODAJ SMAK</button></td> <td><button type=button onclick="location='<?php echo $kategoria;?>'" class="menu2" id=mng_access>DODAJ KATEGORIĘ</button></td>
			<td id=column_space> </td>
			<td><button type=button onclick="location='<?php echo $jednostka;?>'" class="menu2" id=admin_access>DODAJ JEDNOSTKE</button></td> <td><button type=button class="menu" id=mng_access onclick="location='<?php echo $magazyn;?>'">ZARZĄDZAJ MAGAZYNEM</button></td>
			<td id=column_space> </td>
			<td><button type=button onclick="location='<?php echo $pojemnosc;?>'" class="menu2" id=admin_access>POJEMNOŚĆ PRODUKTU</button></td> <td></td>
			</tr>
		</table>
	<?php
	}
	function userOptions(){
		$dodaj="dodaj_uzytkownika.php";
		$usun="usun_uzytkownika.php";
		$lista="lista_uzytkownikow.php";
		$edytuj="edytuj_uzytkownika.php";
		$haslo="change_password.php";
		
		echo	"<table class=option>";
		
		if(getMD5IdStanowiska()==1){
		echo	"
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$dodaj.">DODAJ</a></td>
				</tr>
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$usun.">USUŃ</a></td>
				</tr>
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$lista.">WYŚWIETL</a></td>
				</tr>
				";
		}
		echo	"
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$edytuj.">EDYTUJ</a></td>
				</tr>
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$haslo.">ZMIEŃ HASŁO</a></td>
				</tr>
				</table>
				";
	}
	function stockOptions(){
		$dodaj="sklad.php";
		$usun="sklad.php";
		$lista="lista_skladu.php";
		
		echo	"<table class=option>";
		echo	"
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$dodaj.">DODAJ</a></td>
				</tr>
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$usun.">USUŃ</a></td>
				</tr>
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$lista.">WYŚWIETL</a></td>
				</tr></table>
				";
	}
	function reportOptions($nr, $print){
		$daily="raporty.php";
		$weekly="raporty_tygodniowe.php";
		?>
		
		<form action="<?php if($nr==1)echo "raporty.php"; else echo "raporty_tygodniowe.php";?>" method="post">
					<table class="formularz_option">
						<tr class=input_login>
						<td class=label_option id=label_option>DATA</td><td class=input_decoration><input type="date" name=data id=logi value="<?php echo date('Y-m-d'); ?>"/></td>
						</tr>
						<tr class=input_login>
						<td id="submit" colspan=2><input type="submit" value="GENERUJ" class="button" id="submit" /></td>
						</tr>
						<?php if($print == True){?>
						<tr class=input_login>
						<td id="submit" colspan=2>
						<button onclick="window.print()" id=print>DRUKUJ</button></td>
						</tr>
						<?php } //end if ?>
					</table>
		</form>
		<?php
		echo	"<table class=option>
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$daily.">RAPORT DZIENNY</a></td>
				</tr>
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$weekly.">RAPORT TYGODNIOWY</a></td>
				</tr>
				</table>
				";	
	}
	function productOptions(){
		$dodaj="dodaj_produkt.php";
		$usun="usun_produkt.php";
		$lista="lista_produktow.php";
		$edytuj="edytuj_produkt.php";
		
		echo	"<table class=option>";
		echo	"
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$dodaj.">DODAJ</a></td>
				</tr>
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$usun.">USUŃ</a></td>
				</tr>
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$lista.">WYŚWIETL</a></td>
				</tr>
				";
		echo	"
				<tr class=option>
				<td class=option><img src='images/icons/arrow.png' /></td><td><a href=".$edytuj.">EDYTUJ</a></td>
				</tr>
				</table>
				";
	}
	function mainFooter(){
		echo "STOCK COUNTER 2014-2015 &copy; COPYRIGHT BY ADRIAN WIDŁAK";
	}
	function insertUser(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$temp_imie=secureString($_POST['imie']);
			$temp_nazwisko=secureString($_POST['nazwisko']);
			$temp_telefon=$_POST['telefon'];
			$temp_email=$_POST['email'];
			$temp_login=secureString($_POST['login']);
			$temp_haslo=$_POST['haslo'];
			$temp_haslo2=$_POST['haslo2'];
			$selectOption = $_POST['stanowisko'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($temp_haslo==$temp_haslo2 and $mysqlZapytanie->zapytanie("INSERT INTO kontakt (telefon, email) VALUES ('$temp_telefon', '$temp_email')")) {
				$tabl=mysqli_fetch_array($mysqlZapytanie->zapytanie("select id_kontakt from kontakt where telefon='$temp_telefon' and email='$temp_email'"));
				if ($mysqlZapytanie->zapytanie("INSERT INTO uzytkownicy (imie, nazwisko, id_kontakt, login, haslo, id_stanowiska) VALUES ('$temp_imie', '$temp_nazwisko', '$tabl[0]', '$temp_login', md5('$temp_haslo'), '$selectOption')")) {
					$str="Użytkownik dodany.";
					$str = urlencode($str);  
					header("location: dodaj_uzytkownika.php?message={$str}");
				} 
				else {
					$str="Błąd - użytkownik nie został dodany.";
					$str = urlencode($str);  
					header("location: dodaj_uzytkownika.php?message={$str}");
				}
			}
			else {
					$str="Podane hasła są różne. Błąd wstawiania danych kontaktowych.";
					$str = urlencode($str);  
					header("location: dodaj_uzytkownika.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function deleteUser(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();

			$selectOption = $_POST['user'];
			echo $selectOption;
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("DELETE FROM uzytkownicy WHERE ID_UZYTKOWNIKA='$_POST[user]'")){
				$str="Użytkownik usunięty!";
				$str = urlencode($str);  
				header("location: usun_uzytkownika.php?message={$str}");
			}
			else {
				$str="Użytkownik nie został usunięty!";
				$str = urlencode($str);  
				header("location: usun_uzytkownika.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function updateUser(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$temp_imie=secureString($_POST['imie']);
			$temp_nazwisko=secureString($_POST['nazwisko']);
			$temp_telefon=$_POST['telefon'];
			$temp_email=$_POST['email'];
			$temp_login=secureString($_POST['login']);
			$selectOption = $_POST['stanowisko'];
			$selectOption2 = $_POST['user'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("UPDATE uzytkownicy, kontakt SET uzytkownicy.imie=('$temp_imie'), uzytkownicy.nazwisko=('$temp_nazwisko'), kontakt.telefon=('$temp_telefon'), kontakt.email=('$temp_email'), uzytkownicy.login=('$temp_login'), uzytkownicy.id_stanowiska=('$selectOption') WHERE md5(uzytkownicy.id_uzytkownika)=('$selectOption2') and kontakt.id_kontakt=uzytkownicy.id_kontakt")) {
				$str="Dane zaktualizowane.";
				$str = urlencode($str);  
				header("location: edytuj_uzytkownika.php?message={$str}");
			} 
			else {
				$str="Błąd - dane użytkownika nie zostały zaktualizowane.";
				$str = urlencode($str);  
				header("location: edytuj_uzytkownika.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function message(){
			if (isset($_GET['message']))
				echo secureString($_GET['message']);
	}
	function loginUser(){
			initializeSite();
			include_once("browser.php");
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			$_POST['login'] = mysqli_real_escape_string($mysqlConnect->polacz(), $_POST['login']);
			$_POST['haslo'] = mysqli_real_escape_string($mysqlConnect->polacz(), $_POST['haslo']);
			$logged=md5($_POST[login]);

			$pyt=$mysqlZapytanie->zapytanie("select count(*) cnt from uzytkownicy where login='{$_POST['login']}' and md5(concat('{$_POST['los']}', haslo))='{$_POST['haslo']}'");
			$mysqlZapytanie->zapytanie("UPDATE uzytkownicy SET LOGGED='$logged' WHERE login='{$_POST['login']}'");
			
			$id=mysqli_fetch_array($mysqlZapytanie->zapytanie("select md5(id_uzytkownika) from uzytkownicy where login='{$_POST['login']}'"));
			//$_SESSION['id'] = $id[0];
			
			if (! $pyt) {echo mysqli_error($mysqlConnect->polacz()); exit;}
			$browser = Browser::detect(); 
			
			$mysqlZapytanie->zapytanie("insert into logi (IPhost, login, data, PRZEGLADARKA) values ('{$_SERVER['REMOTE_ADDR']} ({$_SERVER['REMOTE_HOST']})', '{$_POST['login']}', NOW(), '{$browser['name']}')");
			$tabl= mysqli_fetch_assoc($pyt);
			
			$count=mysqli_num_rows($pyt);
	
			mysqli_close($mysqlConnect->polacz());

			if ($tabl['cnt']) {
				$seconds=3600+time();
				$temp = hash('sha256',microtime() + rand(-1000,1000));
				setcookie("loggedin", $temp, $seconds); 
				$mysqlZapytanie->zapytanie("CREATE TABLE `sesja` (`ID_SESJI`  int(255) UNSIGNED NOT NULL AUTO_INCREMENT ,`ID_UZYTKOWNIKA`  varchar(60) NOT NULL ,`LOGGED`  varchar(50) NOT NULL ,`COOKIE`  varchar(150) NOT NULL ,PRIMARY KEY (`ID_SESJI`))");
				$readerStatus = isset($_COOKIE['loggedin']) ? (string)$_COOKIE['loggedin'] : '';
				
				$mysqlZapytanie->zapytanie("insert into sesja (ID_UZYTKOWNIKA, LOGGED, COOKIE) values ('$id[0]', '$logged', '{$readerStatus}')");
				mysqli_close($mysqlConnect->polacz());
				header("location: controller.php?method=".$logged);
			} 
			else{
				$str="Błędny login lub hasło!";
				$str = urlencode($str);  
				header("location: index.php?message=".$str);
			}
	}
	function logoutUser(){
				$mysqlConnect = new mysqlConnect();
				$mysqlZapytanie = new mysqlZapytanie();
				$mysqlConnect->dane();
				if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
				$seconds=-20+time();
				setcookie("loggedin", true, $seconds);
				$str="Wylogowano pomyślnie!";
				$str = urlencode($str);  
				header("location:index.php?message={$str}");
				$md5id=getMD5IdUser();
				$mysqlZapytanie->zapytanie("UPDATE uzytkownicy SET LOGGED=1 WHERE md5(id_uzytkownika)='$md5id'");
				$mysqlZapytanie->zapytanie("DELETE FROM sesja WHERE COOKIE='$_COOKIE[loggedin]'");
				mysqli_close($mysqlConnect->polacz());
	}
	function visitingCard(){
		$mysqlConnect = new mysqlConnect();
		$mysqlZapytanie = new mysqlZapytanie();
		$mysqlConnect->dane();
		if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
		$id=getMD5IdUser();
		$zapytanie=$mysqlZapytanie->zapytanie("SELECT imie, nazwisko, login, kontakt.telefon, kontakt.email, stanowiska.stanowisko FROM uzytkownicy, kontakt, stanowiska WHERE uzytkownicy.id_kontakt=kontakt.id_kontakt and uzytkownicy.id_stanowiska=stanowiska.id_stanowiska and md5(uzytkownicy.id_uzytkownika)='$id'");
		$user=mysqli_fetch_array($zapytanie);
		return $user; 
	}
	function getUsers(){
		$i=1;
		$mysqlConnect = new mysqlConnect();
		$mysqlZapytanie = new mysqlZapytanie();
		$mysqlConnect->dane();
		if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
		$zapytanie=$mysqlZapytanie->zapytanie("SELECT * FROM Users_details");
		
		
		echo "<tr class=table_header><td>IMIE</td><td>NAZWISKO</td><td>LOGIN</td><td>TELEFON</td><td>EMAIL</td><td>STANOWISKO</td></tr>";
		while($user=mysqli_fetch_array($zapytanie)){
			$i=$i%2;
			echo "<tr class=".$i."><td>".$user[0]."</td><td>".$user[1]."</td><td>".$user[2]."</td><td>".$user[3]."</td><td>".$user[4]."</td><td>".$user[5]."</td></tr>";
			$i=$i+1;
		}
	}
	function getProducts(){
		$i=1;
		$mysqlConnect = new mysqlConnect();
		$mysqlZapytanie = new mysqlZapytanie();
		$mysqlConnect->dane();
		if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
		$zapytanie=$mysqlZapytanie->zapytanie("SELECT * FROM product_details");
		
		
		echo "<tr class=table_header><td>PRODUKT</td><td>KATEGORIA</td><td>SMAK</td><td>POJEMNOŚC</td><td>JEDNOSTKA</td></tr>";
		while($user=mysqli_fetch_array($zapytanie)){
			$i=$i%2;
			echo "<tr class=".$i."><td>".$user[0]."</td><td>".$user[1]."</td><td>".$user[2]."</td><td>".$user[3]."</td><td>".$user[4]."</td></tr>";
			$i=$i+1;
		}
	}
	function editingUserValue($id){
		$mysqlConnect = new mysqlConnect();
		$mysqlZapytanie = new mysqlZapytanie();
		$mysqlConnect->dane();
		if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
		$zapytanie=$mysqlZapytanie->zapytanie("SELECT imie, nazwisko, kontakt.telefon, kontakt.email, login, stanowiska.id_stanowiska FROM uzytkownicy, kontakt, stanowiska WHERE md5(uzytkownicy.id_uzytkownika)=('$id') and uzytkownicy.id_kontakt=kontakt.id_kontakt and uzytkownicy.id_stanowiska=stanowiska.id_stanowiska");
		$user=mysqli_fetch_array($zapytanie);
		return $user; 
	}
	function editingProductValue($id){
		$mysqlConnect = new mysqlConnect();
		$mysqlZapytanie = new mysqlZapytanie();
		$mysqlConnect->dane();
		if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
		$zapytanie=$mysqlZapytanie->zapytanie("SELECT id_produktu, nazwa, smak, pojemnosc from Product_details WHERE id_produktu=$id");
		$product=mysqli_fetch_array($zapytanie);
		return $product; 
	}
	function getLogi($zapytanie){
	$i=1;
		echo "<tr class=0><td>#</td><td>IPhost</td><td>LOGIN</td><td>DATA I GODZINA</td><td>PRZEGLĄDARKA</td></tr>";
		while($tabl=mysqli_fetch_array($zapytanie)){
			$i=$i%2;
			echo "<tr class=".$i."><td>".$tabl[0]."</td><td>".$tabl[1]."</td><td>".$tabl[2]."</td><td>".$tabl[3]."</td><td><center>".$tabl[4]."</center></td></tr>";
			$i=$i+1;
		}
	}
	/* SESSION SECURITY FUNCTION
	function sessionSecurity(){
		session_start();
		if (!isset($_SESSION['inicjuj']))
		{
			session_regenerate_id();
			$_SESSION['id'] = true;
			$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		}
		if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR'])
		{
			$str="Próba włamania!!!";
			$str = urlencode($str);  
			header("location: index.php?message={$str}");
		}
	}
	*/
	function secureString($string){
        $string = htmlspecialchars($string);
	$string = stripslashes($string);
        //$string = mysqli_real_escape_string($string);
        return $string;
    }
	function checkPermission(){
		$user=visitingCard();
		
		if($user['stanowisko']=='SUPERVISOR')
			echo "<style>button#mng_access{visibility: hidden;}button#admin_access{visibility: hidden;}</style>";
		else if($user['stanowisko']=='MANAGER')
			echo "<style>button#admin_access{visibility: hidden;}</style>";	
	}
	function checkPermission2(){
		if(getMD5IdStanowiska()!=1){
				$str="Nie masz uprawnień do przeglądania wybranej strony.";
				$str = urlencode($str);  
				header("location: start.php?message={$str}");
		}	
	}
	function checkPermission3(){
		if(getMD5IdStanowiska()!=1 and getMD5IdStanowiska()!=2){
				$str="Nie masz uprawnień do przeglądania wybranej strony.";
				$str = urlencode($str);  
				header("location: start.php?message={$str}");
		}	
	}
	function getMD5IdStanowiska(){
		$mysqlConnect = new mysqlConnect();
		$mysqlZapytanie = new mysqlZapytanie();
		$mysqlConnect->dane();
		if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
		$key=getMD5IdUser();
		$id=mysqli_fetch_array($mysqlZapytanie->zapytanie("select id_stanowiska FROM uzytkownicy, sesja WHERE md5(uzytkownicy.id_uzytkownika)='$key'"));
		return $id[0];
	}
	function getMD5IdUser(){
		if(isset($_COOKIE['loggedin'])){
		$mysqlConnect = new mysqlConnect();
		$mysqlZapytanie = new mysqlZapytanie();
		$mysqlConnect->dane();
		if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
		if(isset($_COOKIE['loggedin']))
			$id=mysqli_fetch_array($mysqlZapytanie->zapytanie("select sesja.id_uzytkownika FROM sesja, uzytkownicy WHERE uzytkownicy.LOGGED=sesja.LOGGED and sesja.COOKIE='$_COOKIE[loggedin]'"));
		return $id[0];
		}
	}
	function changePassword(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$temp_haslo=$_POST['haslo'];
			$temp_haslo2=$_POST['haslo2'];
			$selectOption = $_POST['user'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($temp_haslo==$temp_haslo2 and isset($_POST['user'])) {
				if ($mysqlZapytanie->zapytanie("UPDATE uzytkownicy SET haslo=md5('$temp_haslo') WHERE id_uzytkownika=('$selectOption')")) {
					$str="Hasło zmienione.";
					$str = urlencode($str);  
					header("location: change_password.php?message={$str}");
				} 
			}
			else if($temp_haslo==$temp_haslo2 and !isset($_POST['user'])){
				$id_looged_user = getMD5IdUser();
				if ($mysqlZapytanie->zapytanie("UPDATE uzytkownicy SET haslo=md5('$temp_haslo') WHERE md5(id_uzytkownika)=('$id_looged_user')")) {
					$str="Twoje hasło zostało zmienione.";
					$str = urlencode($str);  
					header("location: change_password.php?message={$str}");
				} 
			}
			else {
					$str="Podane hasła są różne. Błąd aktualizacji danych kontaktowych.";
					$str = urlencode($str);  
					header("location: change_password.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function insertMagazyn(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$temp_nazwa=secureString($_POST['dodaj']);
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("INSERT INTO magazyn (nazwa) VALUES ('$temp_nazwa')")) {
				$str="Magazyn dodany.";
				$str = urlencode($str);  
				header("location: magazyn.php?message={$str}");
			} 
			else {
				$str="Błąd - magazyn nie został dodany.";
				$str = urlencode($str);  
				header("location: magazyn.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function updateMagazyn(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$temp_nazwa=secureString($_POST['edytuj_nazwa']);
			$selectOption=$_POST['edytuj'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("UPDATE magazyn SET magazyn.nazwa=('$temp_nazwa') WHERE magazyn.id_magazynu=('$selectOption')")) {
				$str="Magazyn zaktualizowany.";
				$str = urlencode($str);  
				header("location: magazyn.php?message={$str}");
			} 
			else {
				$str="Błąd - magazyn nie został zaktualizowany.";
				$str = urlencode($str);  
				header("location: magazyn.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function deleteMagazyn(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$selectOption=$_POST['usun'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("DELETE FROM magazyn WHERE ID_MAGAZYNU='$selectOption'")) {
				$str="Magazyn usunięty.";
				$str = urlencode($str);  
				header("location: magazyn.php?message={$str}");
			} 
			else {
				$str="Błąd - magazyn nie został usunięty.";
				$str = urlencode($str);  
				header("location: magazyn.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function insertSmak(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			$temp_nazwa=secureString($_POST['dodaj']);
			
			if ($mysqlZapytanie->zapytanie("INSERT INTO smaki (smak) VALUES ('$temp_nazwa')")) {
				$str="Smak dodany.";
				$str = urlencode($str);  
				header("location: smak.php?message={$str}");
			} 
			else {
				$str="Błąd - smak nie został dodany.";
				$str = urlencode($str);  
				header("location: smak.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function updateSmak(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$temp_nazwa=secureString($_POST['edytuj_nazwa']);
			$selectOption=$_POST['edytuj'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("UPDATE smaki SET smak=('$temp_nazwa') WHERE id_smaku=('$selectOption')")) {
				$str="Smak zaktualizowany.";
				$str = urlencode($str);  
				header("location: smak.php?message={$str}");
			} 
			else {
				$str="Błąd - smak nie został zaktualizowany.";
				$str = urlencode($str);  
				header("location: smak.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function deleteSmak(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$selectOption=$_POST['usun'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("DELETE FROM smaki WHERE ID_SMAKU='$selectOption'")) {
				$str="Smak usunięty.";
				$str = urlencode($str);  
				header("location: smak.php?message={$str}");
			} 
			else {
				$str="Błąd - smak nie został usunięty.";
				$str = urlencode($str);  
				header("location: smak.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function insertJednostka(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			$temp_nazwa=secureString($_POST['dodaj']);
			
			if ($mysqlZapytanie->zapytanie("INSERT INTO jednostki (jednostka) VALUES ('$temp_nazwa')")) {
				$str="Jednostka dodana.";
				$str = urlencode($str);  
				header("location: jednostka.php?message={$str}");
			} 
			else {
				$str="Błąd - jednostka nie została dodany.";
				$str = urlencode($str);  
				header("location: jednostka.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function updateJednostka(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$temp_nazwa=secureString($_POST['edytuj_nazwa']);
			$selectOption=$_POST['edytuj'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("UPDATE jednostki SET jednostka=('$temp_nazwa') WHERE id_jednostki=('$selectOption')")) {
				$str="Jednostka zaktualizowana.";
				$str = urlencode($str);  
				header("location: jednostka.php?message={$str}");
			} 
			else {
				$str="Błąd - jednostka nie została zaktualizowany.";
				$str = urlencode($str);  
				header("location: jednostka.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function deleteJednostka(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$selectOption=$_POST['usun'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("DELETE FROM jednostki WHERE ID_JEDNOSTKI='$selectOption'")) {
				$str="Jednostka usunięta.";
				$str = urlencode($str);  
				header("location: jednostka.php?message={$str}");
			} 
			else {
				$str="Błąd - jednostka nie została usunięty.";
				$str = urlencode($str);  
				header("location: jednostka.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function insertKategoria(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			$temp_nazwa=secureString($_POST['dodaj']);
			
			if ($mysqlZapytanie->zapytanie("INSERT INTO kategorie (kategoria) VALUES ('$temp_nazwa')")) {
				$str="Kategoria dodana.";
				$str = urlencode($str);  
				header("location: kategoria.php?message={$str}");
			} 
			else {
				$str="Błąd - kategoria nie została dodana.";
				$str = urlencode($str);  
				header("location: kategoria.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function updateKategoria(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$temp_nazwa=secureString($_POST['edytuj_nazwa']);
			$selectOption=$_POST['edytuj'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("UPDATE kategorie SET kategoria=('$temp_nazwa') WHERE ID_KATEGORII=('$selectOption')")) {
				$str="Kategoria zaktualizowana.";
				$str = urlencode($str);  
				header("location: kategoria.php?message={$str}");
			} 
			else {
				$str="Błąd - kategoria nie została zaktualizowany.";
				$str = urlencode($str);  
				header("location: kategoria.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function deleteKategoria(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$selectOption=$_POST['usun'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("DELETE FROM kategorie WHERE ID_KATEGORII='$selectOption'")) {
				$str="Kategoria usunięta.";
				$str = urlencode($str);  
				header("location: kategoria.php?message={$str}");
			} 
			else {
				$str="Błąd - kategoria nie została usunięty.";
				$str = urlencode($str);  
				header("location: kategoria.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function insertPojemnosc(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			$temp_nazwa=secureString($_POST['dodaj']);
			
			if ($mysqlZapytanie->zapytanie("INSERT INTO pojemnosci (pojemnosc) VALUES ('$temp_nazwa')")) {
				$str="Pojemność dodana.";
				$str = urlencode($str);  
				header("location: pojemnosc.php?message={$str}");
			} 
			else {
				$str="Błąd - pojemność nie została dodana.";
				$str = urlencode($str);  
				header("location: pojemnosc.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function updatePojemnosc(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$temp_nazwa=secureString($_POST['edytuj_nazwa']);
			$selectOption=$_POST['edytuj'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("UPDATE pojemnosci SET pojemnosci.pojemnosc=('$temp_nazwa') WHERE ID_POJEMNOSCI=('$selectOption')")) {
				$str="Pojemność zaktualizowana.";
				$str = urlencode($str);  
				header("location: pojemnosc.php?message={$str}");
			} 
			else {
				$str="Błąd - pojemność nie została zaktualizowana.";
				$str = urlencode($str);  
				header("location: pojemnosc.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function deletePojemnosc(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$selectOption=$_POST['usun'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("DELETE FROM pojemnosci WHERE ID_POJEMNOSCI='$selectOption'")) {
				$str="Pojemność usunięta.";
				$str = urlencode($str);  
				header("location: pojemnosc.php?message={$str}");
			} 
			else {
				$str="Błąd - pojemność nie została usunięta.";
				$str = urlencode($str);  
				header("location: pojemnosc.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function insertProdukt(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			$temp_nazwa=secureString($_POST['nazwa']);
			$selectKategoria=$_POST['kategoria'];
			$selectSmak=$_POST['smak'];
			$selectPojemnosc=$_POST['pojemnosc'];
			$selectJenostka=$_POST['jednostka'];
			
			if ($mysqlZapytanie->zapytanie("INSERT INTO produkty (nazwa, id_kategorii, id_smaku, id_pojemnosci, ID_JEDNOSTKI) VALUES ('$temp_nazwa', $selectKategoria, $selectSmak, $selectPojemnosc, $selectJenostka);")) {
				$str="Produkt dodany.";
				$str = urlencode($str);  
				header("location: dodaj_produkt.php?message={$str}");
			} 
			else {
				$str="Błąd - produkt ".$temp_nazwa." nie został dodany.";
				$str = urlencode($str);  
				header("location: dodaj_produkt.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function updateProdukt(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$temp_nazwa=secureString($_POST['nazwa']);
			$selectKategoria=$_POST['kategoria'];
			$selectSmak=$_POST['smak'];
			$selectPojemnosc=$_POST['pojemnosc'];
			$selectJenostka=$_POST['jednostka'];
			$selectOption = $_POST['produkt'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("UPDATE produkty SET produkty.nazwa=('$temp_nazwa'), produkty.id_kategorii=('$selectKategoria'), produkty.id_smaku=('$selectSmak'), produkty.id_pojemnosci=('$selectPojemnosc'), produkty.id_jednostki=('$selectJenostka') WHERE ID_PRODUKTU=('$selectOption')")) {
				$str="Dane produktu zaktualizowane.";
				$str = urlencode($str);  
				header("location: edytuj_produkt.php?message={$str}");
			} 
			else {
				$str="Błąd - dane produktu nie zostały zmienione.";
				$str = urlencode($str);  
				header("location: edytuj_produkt.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function deleteProdukt(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$selectOption=$_POST['usun'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("DELETE FROM produkty WHERE ID_PRODUKTU='$selectOption'")) {
				$str="Produkt usunięty.";
				$str = urlencode($str);  
				header("location: usun_produkt.php?message={$str}");
			} 
			else {
				$str="Błąd - produkt nie został usunięty z bazy.";
				$str = urlencode($str);  
				header("location: usun_produkt.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function getMagazynName($id){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			$magazyn = mysqli_fetch_array($mysqlZapytanie->zapytanie("SELECT nazwa FROM magazyn WHERE id_magazynu=$id"));
			mysqli_close($mysqlConnect->polacz());
			return $magazyn[0];
	}
	function insertSklad(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			$selectMagazyn=$_POST['magazyn'];
			$selectProdukt=$_POST['produkt'];
			
			if ($mysqlZapytanie->zapytanie("INSERT INTO sklad (ID_MAGAZYNU, ID_PRODUKTU) VALUES ($selectMagazyn, $selectProdukt);")) {
				$str="Produkt dodany do magazynu.";
				$str = urlencode($str);  
				header("location: sklad.php?message={$str}");
			} 
			else {
				$str="Błąd - produkt nie został przypisany do magazynu.";
				$str = urlencode($str);  
				header("location: sklad.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function deleteSklad(){
			initializeSite();
			$mysqlConnect = new mysqlConnect();
			$mysqlZapytanie = new mysqlZapytanie();
			
			$selectOption=$_POST['usun'];
			
			$mysqlConnect->dane();
			if ($mysqlConnect->polacz()) {} else {echo "błąd polaczenia";}
			
			if ($mysqlZapytanie->zapytanie("DELETE FROM sklad WHERE ID_skladu='$selectOption'")) {
				$str="Przypisanie usunięte!";
				$str = urlencode($str);  
				header("location:sklad.php?message={$str}");
			} 
			else {
				$str="Błąd - nie usunięto przypisania!";
				$str = urlencode($str);  
				header("location: sklad.php?message={$str}");
			}
			mysqli_close($mysqlConnect->polacz());
	}
	function printHeader(){
			$user=visitingCard();
			?><br><br>
			<table class=header>
			<tr><td>WYGENEROWANY PRZEZ: </td><td><?php echo $user['imie']." ".$user['nazwisko']; ?></td></tr>
			<tr><td>STANOWISKO: </td><td><?php echo $user['stanowisko']; ?></td></tr>
			<tr><td>LOGIN: </td><td><?php echo $user['login']; ?></td></tr>
			<tr><td>DATA: </td><td><?php echo date('d-m-Y'); ?></td><td>GODZINA: </td><td><?php echo date('H:i:s'); ?></td></tr>
			</table>
			<?php 
	}
?>