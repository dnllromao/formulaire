<?php 
	//phpinfo();
	//echo "<pre>".print_r($_SERVER,true)."</pre>";
	echo "<pre>".print_r($_POST,true)."</pre>";

	function clean_data($data) {
		//sanitization
		$data = trim($data); // Strip whitespace
		$data = stripslashes($data); // Remove the backslash
		$data = htmlspecialchars($data); // Convert special characters to HTML entities
		return $data;
	}

	foreach ($_POST as $key => $value) {

		${$key} = (isset($_POST[$key])) ? clean_data($_POST[$key]) : empty_data($key);

	}

	echo $nom;
	echo $prenom;
	echo $email;

	//validation
	$email  = filter_var($email, FILTER_VALIDATE_EMAIL);

	//send mail
	$suject = "Confirmation de votre demande";
	$message = 'Bonjour ' . $nom . ', nous nous occupons de votre demande au plus vite.  Merci de nous avoir contacté.';
	var_dump(mail($email, $suject, $message));

 	echo '<p class="alert confirm">Bonjour ' . $nom . ', nous nous occupons de votre demande au plus vite. <br/> Merci de nous avoir contacté.</p>';

?>