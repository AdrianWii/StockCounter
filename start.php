<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	checkPermission();
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
					<h2>TWOJA WIZYTÓWKA</h2>
				</div>
				<div id="sub_aside_b">
					<?php $user=visitingCard(); ?>
							<table class=visiting_card>
								<tr class=card_label>
								<td id=user_avatar></td><td id=username_surname><?php echo $user['imie']."<br>".$user['nazwisko']."<br><br>".$user['stanowisko']; ?></td>
								</tr><tr class=card_label>
								<td></td>
								</tr>
							</table>
							<table class=visiting_card>
								<tr class=card_label>							
								<td>LOGIN:</td><td><?php echo $user['login']; ?></td>
								</tr><tr class=card_label>
								<td>TELEFON:</td><td><?php echo $user['telefon']; ?></td>
								</tr><tr class=card_label>
								<td>EMAIL:</td><td><?php echo $user['email']; ?></td>
								</tr><tr class=card_label>
								<td></td>
								</tr><tr class=card_label>
								<td colspan=2><button type=button class="button" id="button" onclick="location='edytuj_uzytkownika.php'">EDYTUJ DANE</button></td>
								</tr><tr class=card_label>
								<td colspan=2><button type=button class="button" id="button" onclick="location='change_password.php'">ZMIEŃ HASŁO</button></td>
								</tr>
							</table>
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