<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();
	#zapytanie do wstrzyknięcia w formularz
	$pyt=$mysqlZapytanie->zapytanie("select * from kategorie");
	$pyt2=$mysqlZapytanie->zapytanie("select * from smaki");
	$pyt3=$mysqlZapytanie->zapytanie("select * from pojemnosci");
	$pyt4=$mysqlZapytanie->zapytanie("select * from jednostki");
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
					<h2>DODAJ PRODUKT</h2>
				</div>
				<div id="sub_section_b">
				<form action="controller.php?method=insertProduct" method="post">
					
					<span id=error><?php message(); ?></span>
					<table class="formularz_data">	
						<tr class=input_login>
						<td class=label id=label>NAZWA</td><td class=input_decoration><input type="text" class="data" name="nazwa" required autofocus/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>KATEGORIA</td><td class=input_decoration>
											<select class="data" name="kategoria">
											<?php optionInject($pyt); ?>
											</select></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>SMAK</td><td class=input_decoration>
											<select class="data" name="smak">
											<?php optionInject($pyt2); ?>
											</select></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>POJEMNOŚĆ</td><td class=input_decoration>
											<select class="data" name="pojemnosc">
											<?php optionInject($pyt3); ?>
											</select></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>JEDNOSTKA</td><td class=input_decoration>
											<select class="data" name="jednostka">
											<?php optionInject($pyt4); ?>
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
					<?php productOptions(); ?>
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