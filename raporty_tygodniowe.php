<?php
	include_once("functions.php");
	initializeSite();
	isCoookieSet();
	
	$mysqlConnect = new mysqlConnect();
	$mysqlZapytanie = new mysqlZapytanie();
	
	$mysqlConnect->dane();
	#zapytanie do wstrzyknięcia w formularz
	if(isset($_POST['data'])){
		$data=$_POST['data'];
		$getdata=$mysqlZapytanie->zapytanie("CALL previewWeeklyReportFrom('$data')");
                               /* $getdata=$mysqlZapytanie->zapytanie("select i.data_inwentaryzacji, CONCAT(p.nazwa,' ', q.pojemnosc), t.smak, SUM(i.ilosc) from inwentaryzacja i inner join sklad s on i.id_skladu=s.id_skladu inner join produkty p on s.id_produktu=p.id_produktu 
inner join  smaki t on p.id_smaku=t.id_smaku inner join pojemnosci q on p.id_pojemnosci = q.id_pojemnosci where data_inwentaryzacji = '$data' GROUP BY p.nazwa, p.id_smaku");
         */       
        }
	mysqli_close($mysqlConnect->polacz());
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>STOCK COUNTER</title>
	<link rel="icon" type="image/png" href="images/icon.png"/>
	<link rel="stylesheet" href="main.css" />
	<link rel="Stylesheet" media="print" type="text/css" href="report_print.css" />
	
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
					<h2>RAPORT TYGODNIOWY</h2>
				</div>
				<div id="print_header" >
					<?php printHeader(); ?>
				</div>
				<div id="sub_section_b">
				<br><br>
			
				<?php 
					$print = False;
					if(isset($_POST['data'])){?>
						<table>
						<tr>
									<td class="show_list"><center>DATA</center></td>
									<td class="show_list"><center>NAZWA PRODUKTU</center></td>
									<td class="show_list"><center>SMAK</center></td>
									<td class="show_list"><center>ILOŚĆ</center></td>
						</tr>
							<?php
							$rowspan=mysqli_num_rows($getdata); ?>
							<tr>
									<td rowspan=<?php echo $rowspan;?> class="show_list"><center><?php echo $data; ?></center></td>
							<?php 
							while($row = mysqli_fetch_array($getdata)){
								$data = $row[0];
								$produkt = $row[1];
								$smak = $row[2];
								$ilosc = $row[3];
							?>
									<td class="show_list2"><center><?php echo $produkt ?></center></td>
									<td class="show_list2"><center><?php echo $smak ?></center></td>
									<td class="show_list"><center><?php echo $ilosc; ?></center></td>
								</tr>
							<?php
							} // end while 
							$print = True;
							?>
							</table>
							<br><br><br><br><br>
				<?php
				}
				else echo "<p id=inwen_message>Z panelu opcji po prawej stronie wybierz datę i wygeneruj raport (domyślnie ustawiony jest raport dzienny).</p>";
				?>
				</div>
				

			</section>
			
			<aside id="sub_aside">
			<!-- panel prawy -->
				<div id="sub_aside_a">
					<h2>OPCJE</h2>
				</div>
				<div id="sub_aside_b">
					<?php reportOptions(2, $print); ?>
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