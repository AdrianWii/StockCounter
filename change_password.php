<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();
	#zapytanie do wstrzyknięcia w formularz
	$users=$mysqlZapytanie->zapytanie("select id_uzytkownika, imie, nazwisko from uzytkownicy");
	$id=getMD5IdStanowiska();
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
					<h2>ZMIEŃ HASŁO</h2>
				</div>
				<div id="sub_section_b">
				<form action="controller.php?method=changePassword" method="post">
					
					<span id=error><?php message(); ?></span>
					<table class="formularz_data">	
						<?php
							if($id==1){
								echo 	"<tr class=input_login>
										<td class=label id=label>UŻYTKOWNIK</td><td class=input_decoration>
										<select class=data name=user>";
										optionInject2($users);
								echo	"</select></td></tr>";
							}
						?>
						<tr class=input_login>
						<td class=label id=label>HASŁO</td><td class=input_decoration><input type="password" class="data" name="haslo" id="haslo" required/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>POWTÓRZ HASŁO</td><td class=input_decoration><input type="password" class="data" name="haslo2" id="check-password" required/></td><td><span class="result_message" id="password-result"></span></td>
						</tr>
						<tr class=input_login>
						<td id="submit" colspan=2><input type="submit" value="ZMIEŃ" class="button" id="submit" /></td>
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
	
	</div>
</body>
</html>