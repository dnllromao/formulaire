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
			1.1 it's not => sanitize + validation
			1.2 it is => show error message above input
	*/

	$('#nom').log()


}

$(document).ready(function(){
	$('input').focusout(function(event) {
		console.log(!$(this).val());

		// Because in javascript, an empty string, and null, both evaluate to false in a boolean context.
		if ($(this).attr('required') == 'required' && !$(this).val() ) {
			$(this).css('background', 'red');
			$(this).parent('label').after('<p class="help-text">Hey, ne oublier pas de remplir ce champ</p>');
		
		}
	});

});    
