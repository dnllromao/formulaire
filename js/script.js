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
	 
	console.log($('form').serialize()); */

	$.each( fields , function (key, value) {
		//console.log(key);
		//console.log($( "input[name='"+key+"'], select[name='"+key+"'], textarea[name='"+key+"']").val());
		// ?? input radio gets a default value equal to first option
		// $(selector).val().length ??
		//console.log($( "input[name='"+key+"'], select[name='"+key+"'], textarea[name='"+key+"']").val() == '' );
		var input = $( "input[name='"+key+"'], select[name='"+key+"'], textarea[name='"+key+"']");

		if(input.val() == '' || input.val() == undefined) {
			//console.log(key);
			$('#alert-'+key).removeClass('hide');
		} else {
			fields[key] = input.val()
			$('#alert-'+key).addClass('hide');
		}
	});

	//console.log(fields);

	if (fields.email) {
		var regex = /^[^A-Z]+@{1}[^A-Z]+\.[a-z]{3}$/;
		console.log(fields.email.match(regex));
		if (fields.email.match(regex)) {
			$('#error-email').addClass('hide');
		}else {
			$('#error-email').removeClass('hide');
		}

	}



}

function validation() {

	var submit = true;
	
	$('[required]').each(function(index, el) {

		var key = $(el).attr('name');

		if ($(el).val().length == 0) {
			$('#alert-'+key).removeClass('hide');
			submit = false; // prevent this var to me set multiple times
		}
		else {
			$('#alert-'+key).addClass('hide');

			if (key == 'email') {
				var regex = /^[^A-Z]+@[^A-Z]+\.[a-z]{3}$/;
				var val = $('input[name="email"]').val();

				if (val.match(regex)) {
					$('#error-email').addClass('hide');
				}else {
					$('#error-email').removeClass('hide');
					submit = false;
				}
			}
		}
	});

	console.log($('form').serializeArray());
	return submit;

}

$(document).ready(function(){

	//$('form').submit(function(e) {
		//e.preventDefault();
		//console.log(e);
		//validate();
		//console.log(validation());
		// if (validation()) {
		// 	$.ajax({
		// 		url: 'script.php',
		// 		//type: 'default GET (Other values: POST)',
		// 		//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
		// 		data: $('form').serialize(),
		// 	})
		// 	.done(function(d) {
		// 		console.log(d);
		// 		console.log("success");
		// 	})
		// 	.fail(function(d) {
		// 		console.log(d);
		// 		console.log("error");
		// 	})
		// 	.always(function(d) {
		// 		console.log(d);
		// 		console.log("complete");
		// 	});
			
		// }
		/// S'il y a des erreus, afficher aussi panel & scrool to top 
	//});

});    


