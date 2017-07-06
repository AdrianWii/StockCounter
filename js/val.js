$(document).ready(function(){
 
        $(".popcorn_input").each(function() {
		//bind-attach a handler to an event for the elements.
            $(this).bind('input', function(){
                sumuj();
            });
        });
 
});

function sumuj() {
 
        var suma = 0;

        $(".popcorn_input").each(function() {
 
            if(!isNaN(this.value) && this.value.length!=0) {
                suma += parseFloat(this.value);
            }
        });
        $("#small_popcorn_stock2").text(suma);
}