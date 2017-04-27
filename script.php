<?php 
	//phpinfo();
	//echo "<pre>".print_r($_SERVER,true)."</pre>";
	echo "<pre>".print_r($_POST,true)."</pre>";

	function test_input($data) {
		$data = trim($data); // Strip whitespace
		$data = stripslashes($data); // Remove the backslash
		$data = htmlspecialchars($data); // Convert special characters to HTML entities
		return $data;
	}

	foreach ($_POST as $key => $value) {

		//var_dump(input_test($_POST[$key]));
		$key = (isset($_POST[$key])) ? test_input($_POST[$key]) : '';
		echo $key;
		
	}



	//sanitization
?>