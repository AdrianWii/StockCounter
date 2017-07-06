$(document).ready(function() {
	$("#check-login").keyup(function (e) {
	
		//removes spaces from username
		$(this).val($(this).val().replace(/\s/g, ''));
		
		var login = $(this).val();
		if(login.length < 4){$("#user-result").html("<img src='images/wrong.png' align=left />Login musi zawierać<br>co najmniej 5 liter...");return;}
		
		if(login.length >= 4){
			$("#user-result").html("<img src='images/loading.gif'/>");
			$.post('check_username.php', {'login':login}, function(data) {
			  $("#user-result").html(data);
			});
		}
	});	
});