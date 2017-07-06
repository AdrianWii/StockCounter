<?php
class mysqlConnect {
	public static $root, $login, $haslo, $nazwa_bazy;
	function dane($root="localhost", $login="awidlak", $haslo="wii93ad!", $nazwa_bazy="awidlak_stock"){
		self::$root=$root;
		self::$login=$login;
		self::$haslo=$haslo;
		self::$nazwa_bazy=$nazwa_bazy;
	}
	function polacz(){
		$polaczenie=mysqli_connect(self::$root, self::$login, self::$haslo, self::$nazwa_bazy) or die ("błąd połączenia: ".mysqli_connect_error());
		return $polaczenie;
	}
}

class mysqlZapytanie extends mysqlConnect {
	function zapytanie($zapytanie=""){
		return $wynik = mysqli_query(parent::polacz(), $zapytanie);
	}
}
?>