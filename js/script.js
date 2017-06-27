function is_empty(el) {

	if ( $(el).val().length != 0 ) {
		// workout for default value of input-radio without checked selector
		return ($(el).is('input:radio') && !$(el).is(':checked'))? true : false;
	} else {
		return true;
	}
}

function validation() {

	if ($('input[name="touch"]').val().length != 0) {
		return false;
	}

	var submit = true;
	
	$('[required]').each(function(index, el) {

		var key = $(el).attr('name');
		// console.log(key);
		// console.log(is_empty(el));
		if(is_empty(el)) {
			$('#alert-'+key).removeClass('hide');
			submit = false; // prevent this var to me set multiple times
		}else {

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

	//console.log($('form').serializeArray());
	return submit;

}


$(document).ready(function(){

	$('form').submit(function(e) {
		e.preventDefault();
		$('.callout').remove();

		if (validation()) {
			console.log($('form').serialize());
			$.ajax({
				url: 'script.php',
				//type: 'default GET (Other values: POST)',
				dataType: 'json',
				data: $('form').serialize(),
			})
			.done(function(d) {
				console.log(d);
				console.log("success");
				$('.content').prepend(d.msg);

				// snnipet to clear all inputs after submit
				$('form').each(function() {
					this.reset();
				});

				$('html, body').animate({
					scrollTop : 0 
				}, 500, 'swing');
				
			})
			.fail(function(d) {
				//console.log(d);
				console.log("error");
			})
			.always(function(d) {
				//console.log(d);
				console.log("complete");
			});
			
		}
		// S'il y a des erreus, afficher aussi panel & scrool to top 
	});

});    


