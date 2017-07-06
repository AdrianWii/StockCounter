<?php
	include_once("functions.php");
	initializeSite();
	if(getMD5IdUser())
		header("location: start.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>STOCK COUNTER</title>
	<link rel="icon" type="image/png" href="images/icon.png"/>
	<link rel="stylesheet" href="main.css" />
	<script type="text/javascript" src="js/md5.js"></script>
</head>

<body>
	<div id="login">
		<div id="title"><p>LOGOWANIE<p></div>
		<div id="form">
			<form action="controller.php?method=loginUser" method="post">
			
			<table class="formularz">
				<tr class=input_login>
				<td id=error_login colspan=2><?php sleep(1); message(); ?>
				</tr>
				<tr class=input_login>
				<td class=login_icon id="login_name"></td><td class=input_decoration><input type="login" class="login" name="login" required /></td>
				</tr>
				<tr class=input_login>
				<td class=login_icon id=login_password></td><td class=input_decoration>
												<input type="password" class="password" id="haslo" required/>
												<input type=hidden name=haslo id=haslo_id>
												<input type=hidden name=los id=los value="<?echo rand(-10000,10000); ?>">
												</td>
				</tr>
				<tr class=input_login>
				<td id="submit" colspan=2><input type="submit" onClick="document.getElementById('haslo').disabled='disabled'; document.getElementById('haslo_id').value=hex_md5(document.getElementById('los').value + '' + hex_md5(document.getElementById('haslo').value));"
																		value="ZALOGUJ" class="button" id="zaloguj" /></td>
				</tr>
				<tr class=input_login>
				<td colspan=2></td>
				</tr>
			</table>
			
		</form>
		</div>
	</div>
</body>
</html>