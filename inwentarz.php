<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();
	#zapytanie do wstrzyknięcia w formularz
	$pyt=$mysqlZapytanie->zapytanie("select * from magazyn");
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
					<h2>INWENTARZ</h2>
				</div>
				<div id="sub_section_aa">
					<?php 
						if(isset($_POST['data']))
							echo $_POST['data']." MAGAZYN \"".getMagazynName($_POST['magazyn'])."\"";
						else message(); ?>
				</div>
				<div id="sub_section_b">
				
				<?php
					 
				$mysqlConnect = new mysqlConnect();
				$mysqlZapytanie = new mysqlZapytanie();
				
				$mysqlConnect->dane();
				#zapytanie do wstrzyknięcia w formularz
				if(isset($_POST['magazyn']))
					$magazyn=$_POST['magazyn'];
				else if(isset($_POST['magazyn2']))
					$magazyn=$_POST['magazyn2'];
				else $magazyn=0;
				
				if(isset($_POST['data']))
					$data=$_POST['data'];
				else if(isset($_POST['data2']))
					$data=$_POST['data2'];
				else $data=0;
					
				$getdata=$mysqlZapytanie->zapytanie("SELECT produkty.nazwa, smaki.smak, kategorie.kategoria, sklad.ID_SKLADU, pojemnosci.pojemnosc from pojemnosci, sklad, kategorie, produkty, magazyn, smaki WHERE produkty.id_jednostki!=3 and produkty.id_pojemnosci=pojemnosci.id_pojemnosci and produkty.id_kategorii!=4 and produkty.id_kategorii=kategorie.id_kategorii and produkty.ID_SMAKU=smaki.ID_SMAKU and sklad.ID_MAGAZYNU='$magazyn' and sklad.ID_PRODUKTU=produkty.ID_PRODUKTU GROUP BY sklad.ID_PRODUKTU");
				if (isset($_POST['submit'])){
				$mysqlZapytanie->zapytanie("BEGIN");
				$mysqlZapytanie->zapytanie("SET TRANSACTION ISOLATION LEVEL READ COMMITTED");
				while($row = mysqli_fetch_array($getdata)){
					//set the id equal to the primary key
					$id = $row["ID_SKLADU"];
					if(isset($_POST[$id])) {
						$status = $_POST[$id];      
						if(!empty($status)){
							$inventor=getMD5IdUser();
							$query = $mysqlZapytanie->zapytanie("INSERT INTO inwentaryzacja(id_uzytkownika, id_skladu, ilosc, data_inwentaryzacji) 
							VALUES ((select uzytkownicy.id_uzytkownika FROM uzytkownicy WHERE md5(uzytkownicy.id_uzytkownika)='$inventor'),$id,$status,'$data')");
							if ($query) {
								$MagazynName = getMagazynName($magazyn);
								$str="Inwentaryzacja z dnia ".$data." dla magazynu \"".$MagazynName."\" zapisana!";
								$str = urlencode($str);  
								header("location: inwentarz.php?message={$str}");
							} 
							else {
								$mysqlZapytanie->zapytanie("ROLLBACK");
								$str="ROLLBACK - inwentaryzacja nie została zapisana.";
								$str = urlencode($str);  
								header("location: inwentarz.php?message={$str}");
							}      
						}
						else{
							$str="Nie wypełniłeś wszystkich pól!";
							$str = urlencode($str);  
							header("location: inwentarz.php?message={$str}");
						}
					}
				}
				$mysqlZapytanie->zapytanie("COMMIT");
				}
				else {
				?>   
				<form action="inwentarz.php" method = "POST">
				<table>
				<input type="hidden" name=data2 id=logi value="<?php if(isset($_POST['data']))echo $_POST['data']; ?>" hide />
				<input type="hidden" name=magazyn2 id=logi value="<?php if(isset($_POST['magazyn']))echo $_POST['magazyn']; ?>" hide />
				
				<?php
				$tem_kategoria = '';
				while($row = mysqli_fetch_array($getdata)){
					$nazwa = $row['nazwa'];
					$smak = $row['smak'];
					$pojemnosc = $row['pojemnosc'];
					$kategoria = $row['kategoria'];
					$sklad = $row['ID_SKLADU'];
					
					if($kategoria!=$tem_kategoria){
						echo "<tr><td><h1><br>".$kategoria."</h1></td></tr>";
						$tem_kategoria = $kategoria;
					}
				?>
					<tr>
						<td class="produkt"><center><?php if($pojemnosc=='-')$pojemnosc=''; echo $nazwa." ".$pojemnosc; ?></center></td>
						<td class="smak"><center><?php echo $smak ?></center></td>
						
						<td class="ilosc">
							<input class="popcorn_input" type="number" min="0" name="<?php echo $sklad; ?>" id="small_popcorn_loss">
						</td>
					</tr>
				<?php
				} // end while
				?>
				<tr><td height="80px" colspan=3>
				<?php 	if(isset($_POST['data']))
							echo "<input type=submit name=submit value=UPDATE class=button id=submit>";
						else
							echo "<p id=inwen_message>Z panelu opcji po prawej stronie wybierz datę inwentaryzacji oraz magazyn, w którym liczysz ilość produktów.</p>";
				?>
				</td></tr></table>
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
				<form action="inwentarz.php" method="post">
					<table class="formularz_option">
						<tr class=input_login>
						<td class=label_option id=label_option>DATA</td><td class=input_decoration><input type="date" name=data id=logi value="<?php echo date('Y-m-d'); ?>"/></td>
						</tr>
						<tr class=input_login>
						<td class=label_option id=label_option>STOCK</td><td class=input_decoration>
											<select class="data" name="magazyn">
											<?php optionInject($pyt); ?>
											</select></td>
						</tr>
						<tr class=input_login>
						<td id="submit" colspan=2><input type="submit" value="START" class="button" id="submit" /></td>
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