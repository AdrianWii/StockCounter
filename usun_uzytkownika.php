<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	
	checkPermission2();
	
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();
	#zapytanie do wstrzyknięcia w formularz
	$pyt=$mysqlZapytanie->zapytanie("select id_uzytkownika, imie, nazwisko from uzytkownicy");
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
					<h2>USUŃ UŻYTKOWNIKA</h2>
				</div>
				<div id="sub_section_b">
				<form action="controller.php?method=deleteUser" method="post">
					
					<span id=error><?php message(); ?></span>
					<table class="formularz_data">
						<tr class=input_login>
						<td class=label_delete id=label>WYBIERZ UŻYTKOWNIKA,<br>KTÓREGO CHCESZ USUNĄĆ</td><td class=input_decoration>
											<select class="data" name="user">
											<?php optionInject2($pyt); ?>
											</select></td>
						</tr>
						<tr class=input_login>
						<td id="submit" colspan=2><input type="submit" value="USUŃ" class="button" id="submit" /></td>
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