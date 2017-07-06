<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	
        checkPermission2();
        
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();
	if (isset($_POST['data']))
		$pyt=$mysqlZapytanie->zapytanie("select * from logi where DATE(data)='$_POST[data]'");
	else
		$pyt=$mysqlZapytanie->zapytanie("select * from logi where DATE(data)=CURDATE()");
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
					<h2>LOGI</h2>
				</div>
				<div id="sub_section_b">
				<?php
				if (!isset($_POST['data']))
					echo "<h1>WPISY LOGOWANIA Z DNIA DZISIEJSZEGO</h1>";
				else echo "<h1>WPISY LOGOWANIA Z DNIA ".$_POST['data']."</h1>";
				?>
				<table class=logi>
					<?php getLogi($pyt); ?>
				</table><br><br><br><br>
				</div>
				

			</section>
			
			<aside id="sub_aside">
			<!-- panel prawy -->
				<div id="sub_aside_a">
					<h2>OPCJE</h2>
				</div>
				<div id="sub_aside_b">
				<form action="logi.php" method="post">
					<h1 id=logi>WYBIERZ DATĘ I PRZESZUKAJ LOGOWANIA</h1>
					<input type="date" name=data id=logi value="<?php 	if(!isset($_POST['data']))
																			echo date('Y-m-d');
																		else echo $_POST['data']; ?>"/><br><br>
					<input type="submit" value="SZUKAJ" class="button" id="szukaj" />
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