<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();
	#zapytanie do wstrzyknięcia w formularz
	$getdata=$mysqlZapytanie->zapytanie("SELECT produkty.nazwa, smaki.smak, sklad.ID_SKLADU, pojemnosci.pojemnosc, magazyn.nazwa AS 'kategoria' from pojemnosci, sklad, produkty, magazyn, smaki WHERE produkty.id_pojemnosci=pojemnosci.id_pojemnosci and produkty.ID_SMAKU=smaki.ID_SMAKU and sklad.ID_MAGAZYNU=magazyn.id_magazynu and sklad.ID_PRODUKTU=produkty.ID_PRODUKTU ORDER BY magazyn.id_magazynu");
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
					<h2>LISTA SKŁADU</h2>
				</div>
				<div id="sub_section_b">
				<table>
				
					<?php
					$tem_kategoria = '';
					while($row = mysqli_fetch_array($getdata)){
						$nazwa = $row['nazwa'];
						$smak = $row['smak'];
						$pojemnosc = $row['pojemnosc'];
						$kategoria = $row['kategoria'];
						$sklad = $row['ID_SKLADU'];
						
						if($kategoria!=$tem_kategoria){
							echo "<tr><td><h1><br>MAGAZYN \"".$kategoria."\"</h1></td></tr>";
							$tem_kategoria = $kategoria;
						}
					?>
						<tr>
							<td class="show_list"><center><?php if($pojemnosc=='-')$pojemnosc=''; echo $nazwa." ".$pojemnosc; ?></center></td>
							<td class="show_list2"><center><?php echo $smak ?></center></td>
						</tr>
					<?php
					} // end while ?>
					</table>
					<br><br><br><br><br>
				</div>
				

			</section>
			
			<aside id="sub_aside">
			<!-- panel prawy -->
				<div id="sub_aside_a">
					<h2>OPCJE</h2>
				</div>
				<div id="sub_aside_b">
					<?php stockOptions(); ?>
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