<?php 
	//phpinfo();
	//echo "<pre>".print_r($_SERVER,true)."</pre>";
	//echo "<pre>".print_r($_GET,true)."</pre>";
  //var_dump($_SERVER);

  // if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
  //     // this is ajax request, do something
  // }

  /* honeypot tech */
  if ($_GET['touch']) {
    header("Location: index.html");
  }

  const REQUIRED_FIELDS = array('nom', 'prenom', 'email', 'pays', 'sexe', 'message');

  $fields = array(
      'nom' => '',
      'prenom' => '',
      'email' => '',
      'pays' => '',
      'sexe' => '',
      'suject' => 'autres',
      'message' => ''
    );

  $error = false;

	function sanitization($data) {
		$data = trim($data); // Strip whitespace
    $data = strip_tags($data);
		$data = stripslashes($data); // Remove the backslash
		$data = htmlspecialchars($data); // Convert special characters to HTML entities
		return $data;
	}

  function send_mail ($to) {
    global $fields;
    $suject = 'Confirmation de votre contact';
    $message = $fields['message'];
    return true;
    return mail($to, $suject, $message);
  }

	foreach ($fields as $key => $value) {

    if (empty($_GET[$key])) {

      if(in_array($key, REQUIRED_FIELDS)) {
        $error = true;
      }
      
    } else {
      // set fields values (validation & sanitization)
      switch ($key) {
        case 'email':
          if( filter_var(sanitization($_GET[$key]), FILTER_VALIDATE_EMAIL) == false) {
            $error = true;
            $error_email = true; /* try to find another way of do it */
            $fields['email'] = sanitization($_GET['email']);
          }
          else {
            $fields['email'] = filter_var(sanitization($_GET[$key]), FILTER_VALIDATE_EMAIL);
          }
        break;
        
        default:
          $fields[$key] = sanitization($_GET[$key]);
        break;
      }
    }
	}

  // if there is errors
  echo $error;
  if ($error) {
    $class = 'alert';
    $msg = 'Ups, votre message n\'a pas pu être envoyé. Corrigé les points ci-dessous et essayez encore.';
  } 
  else {
    // envoyer email
    $is_sent = send_mail($fields['email']);

    if($is_sent) {
      $class = 'success';
      $msg = 'Votre demande a été bien enregistrer et un email de confirmation vous a été envoyé.<br/>Merci de nous avoir contacté.';
    }
    else {
      $class = 'alert';
      $msg = 'Ups, on probléme est survenu. Essayez plus tard. Merci de votre comprehension.';
    }

    
  }

  $full_msg = '<div class="callout '.$class.'"><p>'.$msg.'</p></div>';

  // this snippet detects if it was a request ajax
  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    //echo $full_msg;
    echo json_encode(['msg' => $full_msg, 'fields' => $fields]);
    //echo 'this was a ajax request';
  }
  else {
    //echo 'du php';
    include 'index.php';
  
  }





