<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	
	if(getMD5IdStanowiska()==1 and isset($_GET['id']))
		$user=editingUserValue($_GET['id']);
	else if(isset($_GET['id']))
		$user=editingUserValue(getMD5IdUser());
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();
	#zapytanie do wstrzyknięcia w formularz
	$pyt=$mysqlZapytanie->zapytanie("select id_stanowiska, stanowisko from stanowiska");
	$users=$mysqlZapytanie->zapytanie("select id_uzytkownika, imie, nazwisko from uzytkownicy");
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
</head>

<body>
	<div id="big_wrapper">
		
	<?php mainNav(); ?>
		
<!--- duży div bez nawigacji ------------------ -->	
	
		<div id="big_wrapper_wo_nav">
			<section id="sub_section">
			<!-- panel lewy -->
				<div id="sub_section_a">
					<h2>EDYTUJ UŻYTKOWNIKA</h2>
				</div>
				<div id="sub_section_b">
				<form action="controller.php?method=updateUser" onsubmit="document.getElementById('disabled').disabled = false;" method="post">
					
					<span id=error><?php message(); ?></span>
					<table class="formularz_data">	
						<tr class=input_login>
						<td class=label id=label>UŻYTKOWNIK</td><td class=input_decoration>
											
											<?php 
												if(isset($_GET['id']) and getMD5IdStanowiska()==1){
													echo "<select class=data id=disabled name=user onClick=\"getval(this);\" disabled>";
													echo "<option class=users value=".$_GET['id'].">".$user[0]." ".$user[1]."</option></select>";		
													echo "<td><button type=button class=button id=button onclick=\"location='edytuj_uzytkownika.php'\">ZMIEŃ WYBÓR</button></td>";
												}
												else if(getMD5IdStanowiska()==1){
													echo "<select class=data name=user onClick=\"getval(this);\">";
													optionInjectMD5($users);
													echo "</select>";
												}
												else{
													echo "<select class=data id=disabled name=user onClick=\"getval(this);\" disabled>";
													echo "<option class=users value=".getMD5IdUser().">TY</option></select>";		
												}
											?>
											</td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>IMIE</td><td class=input_decoration><input type="text" class="data" name="imie" value='<?php if(isset($_GET['id'])) echo $user[0]; ?>' required autofocus/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>NAZWISKO</td><td class=input_decoration><input type="text" class="data" name="nazwisko" value='<?php if(isset($_GET['id'])) echo $user[1]; ?>' required autofocus/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>TELEFON</td><td class=input_decoration><input type="text" class="data" name="telefon" value='<?php if(isset($_GET['id'])) echo $user[2]; ?>' required/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>EMAIL</td><td class=input_decoration><input type="email" class="data" name="email" value='<?php if(isset($_GET['id'])) echo $user[3]; ?>' required/></td>
						</tr>
						<tr class=input_login>
						<td class=label id=label>LOGIN</td><td class=input_decoration><input type="text" class="data" name="login" value='<?php if(isset($_GET['id'])) echo $user[4]; ?>' id="check-login" required/></td><td><span class="result_message" id="user-result"></span></td>
						</tr>
						<tr class=input_login>
						<?php 
						if(getMD5IdStanowiska()==1){
						echo "<td class=label id=label>STANOWISKO</td><td class=input_decoration><select class=data name=stanowisko>";
						optionInject($pyt);
						echo "</select></td>";
						}
						else{
							echo "<td></td><td><select class=data name=stanowisko style=\"visibility:hidden;\">";
							echo "<option value=".getMD5IdStanowiska()."></option>";
							echo "</select></td>";
						}
						?>
						</tr>
						<table><tr>
						<td><button type=button class="button" id="button" onclick="location='change_password.php'">ZMIEŃ HASŁO</button></td>
						<td id="submit" width=125px><input type="submit" value="EDYTUJ" class="button" id="submit" /></td>
						</tr>
						<tr class=input_login>
						<td colspan=2></td>
						</tr></table>
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
		
		<script type="text/javascript">
		function getval(id) {
			var id = id.value;
			location.href="edytuj_uzytkownika.php?id="+id;
		}
		</script>
	
	</div>
</body>
</html>