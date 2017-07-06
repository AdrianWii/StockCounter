$(document).ready(function() {
	$("#check-password").keyup(function (e) {
		var haslo = document.getElementById("haslo").value;
		var haslo2 = $(this).val();
		if(haslo!=haslo2){$("#password-result").html("<img src='images/noavailable.png'/> Podane hasła są różne...");return;}
		else {$("#password-result").html("<img src='images/available.png'/>");return;}
		
	});	
});