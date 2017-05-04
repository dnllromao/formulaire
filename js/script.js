function validate() {
	/* scripts: 
			nom: text
			prenom: text
			email: email
			pays: select
			sexe: radio
			suject: checkbox
			message : texarea

		1. is_empty
			1.1 it's not => validation
			1.2 it is => show error message above input
	*/

	var fields = { 
		'nom' : null,
		'prenom' : null,
		'email' : null,
		'pays' : null,
		'sexe' : null,
		'suject' : null,
		'message' : null
		};
	/* Ceci avec grep devient plus compliqué ?! Alors quand utilizer serialize() 
	console.log($('form').serializeArray());
	console.log($('form').serialize()); */

	$.each( fields , function (key, value) {
		console.log(key);
		console.log($( "input[name='"+key+"'], select[name='"+key+"'], textarea[name='"+key+"']").val());
		// ?? input radio gets a default value equal to first option
		// $(selector).val().length ??
		console.log($( "input[name='"+key+"'], select[name='"+key+"'], textarea[name='"+key+"']").val() == '' );
		var input = $( "input[name='"+key+"'], select[name='"+key+"'], textarea[name='"+key+"']");

		if(input.val() == '' || input.val() == undefined) {
			console.log(key);
			$('#alert-'+key).removeClass('hide');
		} else {
			fields[key] = input.val()
			$('#alert-'+key).addClass('hide');
		}
	});

	console.log(fields);



}

$(document).ready(function(){

	$('form').submit(function(e) {
		e.preventDefault();
		console.log(e);
		validate();
	});

});    
