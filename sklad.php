<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	checkPermission();
	
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();
	#zapytanie do wstrzyknięcia w formularz
	$pyt=$mysqlZapytanie->zapytanie("select * from magazyn");
	$pyt2=$mysqlZapytanie->zapytanie("select id_produktu, nazwa, pojemnosc, smak from product_details");
	$pyt3=$mysqlZapytanie->zapytanie("select * from stock_details");
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
	<script type="text/javascript" src="js/jquery.js"> </script>
	<script type="text/javascript" src="js/val.js">	</script>
	
</head>

<body>
	<div id="big_wrapper">
		
		<?php mainNav(); ?>
		
<!--- duży div bez nawigacji ------------------ -->	
	
		<div id="big_wrapper_wo_nav">
			<section id="sub_section">
			<!-- panel lewy -->
				<div id="sub_section_a">
					<h2>MENU</h2>
					
				</div>
				<div id="sub_section_aa">
					<?php message(); ?>
				</div>
				<div id="sub_section_b">
					<!-- IKONY MENU/ BUTTONY -->
					<?php mainMenu(); ?>
				</div>
				

			</section>
			
			<aside id="sub_aside">
			<!-- panel prawy -->
				<div id="sub_aside_a">
					<h2>OPCJE - SKŁAD</h2>
				</div>
				<div id="sub_aside_b">
					
				<form action="controller.php?method=insertSklad" method="post">
					<table class="formularz_option">
						<tr class=input_login>
						<td class=label_option id=label_option>MAGAZYN</td><td class=input_decoration>
											<select class="data" name="magazyn">
											<?php optionInject($pyt); ?>
											</select></td>
						</tr>
						<tr class=input_login>
						<td class=label_option id=label_option>PRODUKT</td><td class=input_decoration>
											<select class="data" name="produkt">
											<?php optionInject3($pyt2); ?>
											</select></td>
						</tr>
						<tr class=input_login>
						<td id="submit" colspan=2><input type="submit" value="PRZYPISZ" class="button" id="submit_option" /></td>
						</tr>
					</table>
				</form>
				<form action="controller.php?method=deleteSklad" method="post">
					<table class="formularz_option">
						<tr class=input_login>
						<td class=label_option id=label_option>WYBÓR</td><td class=input_decoration>
											<select class="data" name="usun">
											<?php optionInject4($pyt3); ?>
											</select></td>
						</tr>
						<tr class=input_login>
						<td id="submit" colspan=2><input type="submit" value="USUŃ" class="button" id="submit_option" /></td>
						</tr>
					</table>
				</form>
				</div>
			</aside>
		</div>
		
<!--- ------------------------------------------ --->
		<footer class="main" id="main_footer">
				<?php mainFooter(); ?>
		</footer>
	
	</div>
</body>
</html>