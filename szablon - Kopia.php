<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
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
					<h2>INWENTARZ</h2>
				</div>
				<div id="sub_section_b">
				<h1>POPCORN</h1>
				<table>
				<!-- POPCORN -->
				<form action="" method="POST" name="popcorn_counter" >
				<tr>
				<td id="small popcorn" class="popcorn"></td>
				<td class="popcorn"><input class="popcorn_input" type="number" name="small_popcorn_loss" id="small_popcorn_loss" value="0"></td>
				<td class="popcorn"><input class="popcorn_input" type="number" name="small_popcorn_starters" id="small_popcorn_starters" value="0"></td>
				<td class="popcorn" name="small_popcorn_stock" id="small_popcorn_stock"></td>
				</tr>
				<tr>
				<td id="small popcorn" class="popcorn"></td>
				<td class="popcorn"><input class="popcorn_input" type="number" name="small_popcorn_loss" id="small_popcorn_loss" value="0"></td>
				<td class="popcorn"><input class="popcorn_input" type="number" name="small_popcorn_starters" id="small_popcorn_starters" value="0"></td>
				<td class="popcorn" name="small_popcorn_stock2" id="small_popcorn_stock2"></td>
				</tr>
				</form>
				</table>
				
				
				<?php
					 
				$mysqlConnect = new mysqlConnect();
				$mysqlZapytanie = new mysqlZapytanie();
				
				$mysqlConnect->dane();
				#zapytanie do wstrzyknięcia w formularz
				$getdata=$mysqlZapytanie->zapytanie("SELECT produkty.nazwa, smaki.smak, kategorie.kategoria, sklad.ID_SKLADU from sklad, kategorie, produkty, magazyn, smaki WHERE produkty.id_kategorii=kategorie.id_kategorii and produkty.ID_SMAKU=smaki.ID_SMAKU and sklad.ID_MAGAZYNU=magazyn.id_magazynu and sklad.ID_PRODUKTU=produkty.ID_PRODUKTU GROUP BY sklad.ID_PRODUKTU");
				if (isset($_POST['submit'])){
				while($row = mysqli_fetch_array($getdata)){
					//set the id equal to the primary key
					$id = $row["ID_SKLADU"];
					$date = date("Y-m-d");
					if(isset($_POST[$id])) {
						$status = $_POST[$id];      
						if(!empty($status)){
							echo $status."<br>";
						/*
							$query = "INSERT INTO attendance(birth_no, date, status, attend) 
							VALUES ('$id','$date','$status','$attend')";
							if($query_run = mysql_query($query)){
								echo 'Insert attendance done';
							}
							else{
								echo'Attendance not inserted.';
							}        */           
						}
						else{
							echo 'Please enter all fields';
						}
					}
				}
				}
				else {
				?>   
				<form action="szablon.php" method = "POST">
				<table>
				<?php
				$tem_kategoria = '';
				while($row = mysqli_fetch_array($getdata)){
					$nazwa = $row['nazwa'];
					$smak = $row['smak'];
					$kategoria = $row['kategoria'];
					$sklad = $row['ID_SKLADU'];
					
					if($kategoria!=$tem_kategoria){
						echo "<tr><td><h1><br>".$kategoria."</h1></td></tr>";
						$tem_kategoria = $kategoria;
					}
				?>
					<tr>
						<td class="produkt"><center><?php echo $nazwa ?></center></td>
						<td class="smak"><center><?php echo $smak ?></center></td>
						
						<td class="ilosc">
							<input class="popcorn_input" type="number" name="<?php echo $sklad; ?>" id="small_popcorn_loss">
						</td>
					</tr>
				<?php
				} // end while
				?>
				</table>
				<input type="submit" name="submit" value="Submit">
				</form> <!-- end the form here -->
				<?php    
				} // end else
				?>
				<br><br>
				<br><br>
				</div>
				

			</section>
			
			<aside id="sub_aside">
			<!-- panel prawy -->
				<div id="sub_aside_a">
					<h2>OPCJE</h2>
				</div>
				<div id="sub_aside_b">
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