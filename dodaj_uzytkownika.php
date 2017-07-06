<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	
	checkPermission2();
	
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();
	#zapytanie do wstrzyknięcia w formularz
	$pyt=$mysqlZapytanie->zapytanie("select id_stanowiska, stanowisko from stanowiska");
	mysqli_close($mysqlConnect->polacz());
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>STOCK COUNTER</title>
	<link rel="icon" type="image/png" href="images/icon.png"/>
	<link rel="stylesheet" href="main.css" />
	
	<!-- JavaScript -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/check_username.js"></script>
	<script type="text/javascript" src="js/check_password.js"></script>
	
</head>

<body>
	<div id="big_wrapper">
		
	<?php mainNav(); ?>
		
<!--- duży div bez nawigacji ------------------ -->	
	
		<div id="big_wrapper_wo_nav">
			<section id="sub_section">
			<!-- panel lewy -->
				<div id="sub_section_a">
					<h2>DODAJ UŻYTKOWNIKA</h2>
				</div>
				<div id="sub_section_b">
				<form action="controller.php?method=insertUser" method="post">
					
					<span id=error><?php message(); ?></span>
					<table class="formularz_data">	
						<tr class=input_login>
						<td class=label id=label>IMIE</td><td class=input_decoration><input type="text" class="data" name="imie" required autofocus/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>NAZWISKO</td><td class=input_decoration><input type="text" class="data" name="nazwisko" required autofocus/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>TELEFON</td><td class=input_decoration><input type="tel" pattern="[0-9]{9}" title="Podaj numer telefonu xxxxxxxxx, gdzie x to cyfry [0-9]" class="data" name="telefon" required/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>EMAIL</td><td class=input_decoration><input type="email" class="data" name="email" required/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>LOGIN</td><td class=input_decoration><input type="text" class="data" name="login" id="check-login" required/></td><td><span class="result_message" id="user-result"></span></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>HASŁO</td><td class=input_decoration><input type="password" class="data" name="haslo" id="haslo" required/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>POWTÓRZ HASŁO</td><td class=input_decoration><input type="password" class="data" name="haslo2" id="check-password" required/></td><td><span class="result_message" id="password-result"></span></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>STANOWISKO</td><td class=input_decoration>
											<select class="data" name="stanowisko">
											<?php optionInject($pyt); ?>
											</select></td>
						</tr>
						<tr class=input_login>
						<td id="submit" colspan=2><input type="submit" value="DODAJ" class="button" id="submit" /></td>
						</tr>
						<tr class=input_login>
						<td colspan=2></td>
						</tr>
					</table>
					
				</form>
				</div>
			</section>
			
			<aside id="sub_aside">
			<!-- panel prawy -->
				<div id="sub_aside_a">
					<h2>OPCJE</h2>
				</div>
				<div id="sub_aside_b">
					<?php userOptions(); ?>
				</div>
			</aside>
		</div>
		
<!--- ------------------------------------------ --->
		<footer class="main" id="main_footer">
				<?php mainFooter(); ?>
		</footer>
		
		<!-- JavaScript -->
		<script type="text/javascript" src="js/jquery.js"> </script>
		<script type="text/javascript" src="js/val.js">	</script>
	
	</div>
</body>
</html>