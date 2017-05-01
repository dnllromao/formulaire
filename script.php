<?php 
	//phpinfo();
	//echo "<pre>".print_r($_SERVER,true)."</pre>";
	//echo "<pre>".print_r($_GET,true)."</pre>";

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

  $error;

	function sanitization($data) {
		$data = trim($data); // Strip whitespace
		$data = stripslashes($data); // Remove the backslash
		$data = htmlspecialchars($data); // Convert special characters to HTML entities
		return $data;
	}

  function print_error($key) {

    global $error;

    if(in_array($key, REQUIRED_FIELDS)) {
      $error .= '<li><strong>'.$key.'</strong> n\'est pas rempli</li>';
    }
  }

  function send_mail ($to) {
    $suject = 'Confirmation de votre contact';
    $message = 'Votre question nous est bien arrivé. Nous nous occupons au plus vite.Merci de nous avoir contacté';
    return mail($to, $suject, $message);
  }

	foreach ($fields as $key => $value) {

    if (empty($_GET[$key])) {

      print_error($key);

    } else {
      // set fields values (validation & sanitization)
      switch ($key) {
        case 'email':
          if( filter_var(sanitization($_GET[$key]), FILTER_VALIDATE_EMAIL) == false) {
            $error .= '<li><strong>email</strong> n\'est pas valid</li>';
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
  if ( strlen($error) != 0 ) {
    $class = 'alert';
    $msg = 'Ups, votre message n\'a pas pu être envoyé.<ul>';
    $msg .= $error;
    $msg .= '</ul>Corrigé les points ci-dessus et essayez encore.';
  } 
  else {
    // envoyer email
    $is_sent = send_mail($fields['email']);
    if($is_sent) {
      $class = 'success';
      $msg = 'Votre demande a été bien enregistrer et un email de confirmation vous a été envoyé.<br/>Nous nous en occupons au plus vite. Merci de nous avoir contacté.';
    }
    else {
      $class = 'alert';
      $msg = 'Ups, on probléme est survenu. Essayez plus tard. Merci de votre comprehension.';
    }

    
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title> formulaire </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="row">
    <div class="small-4 medium-4 columns">
      <img src="img/hackers-poulette-logo.png" alt="hackers poulette logo">
    </div>
  </header>

  <main class="row medium-11 columns">

      <div class="intro">
        <h1 class="text-center">Vous avez un problème ? On va vous aider ! <br/> Remplissez le formulaire d'Hackers Poulette !</h1>
      </div>

      <div class="content">
        <div class="callout <?= $class; ?>">
          <p><?= $msg; ?></p>
        </div>
        <form method="get" action="script.php">
          <fieldset class="fieldset">
            <legend> Vos coordonnées d'identification </legend>

            <div class="row">
              <div class="medium-6 columns">
                <label>Votre nom de famille :
                  <input type="text"  name="nom" placeholder="Mettez votre nom ici s'il vous plait" required aria-required="true" autofocus/>
                </label>
              </div>
              <div class="medium-6 columns">
                <label>Votre prénom :
                  <input type="text" name="prenom" placeholder="ex: Gertrude, Frénégonde, Hypolite, Jean-Gustave" required aria-required="true"/>
                </label>
              </div>
            </div>

            <div class="row">
              <div class="medium-6 columns">
                <label>Votre email :
                  <input type="email" name="email" placeholder="ex:gertrude@hotmail.com" required aria-required="true" />
                </label>
              </div>
              <div class="medium-6 columns">
                <label>Dans quel pays habitez-vous ?
                  <select name="pays" required aria-required="true">
                    <option value="">---</option>
                    <option value="Belgique" selected>Belgique</option>
                    <option value="espagne">Espagne</option>
                    <option value="italie">Italie</option>
                    <option value="royaume-uni">Royaume-Uni</option>
                    <option value="canada">Canada</option>
                    <option value="etats-unis">États-Unis</option>
                    <option value="chine">Chine</option>
                    <option value="japon">Japon</option>
                  </select>
                </label>
              </div>
            </div>

            <div class="row">
              <fieldset class="medium-6 columns end">
                <legend>A qui ai-je l'honneur? Monsieur? Madame ?</legend>
                <input type="radio" name="sexe" value="feminin" id="feminin" required aria-required="true"><label for="feminin">F</label>
                <input type="radio" name="sexe" value="masculin" id="masculin"><label for="masculin">M</label>
                <input type="radio" name="sexe" value="indefini" id="indefini"><label for="indefini">X</label>
              </fieldset>
            </div>
          </fieldset>

          <fieldset class="fieldset">
            <legend>Objet du problème et donc, de la prise de contact</legend>

            <div class="row">
              <fieldset class="medium-12 columns">
                <legend>A propos de quel sujet(s) vous nous contactez ?</legend>
                <input id="kit" type="checkbox" name="sujet" value="kit"><label for="kit">Kit</label>
                <input id="accessoires" type="checkbox" name="sujet" value="accessoires"><label for="accessoires">Accessoires</label>
                <input id="autres" type="checkbox" name="sujet" value="autres"><label for="autres">Autres</label>
              </fieldset>
              <div class="medium-12 columns">
                <label>
                  Quel est votre problème qu'on prendra en charge avec plaisir :) 
                  <textarea name="message" rows="10" cols="50" placeholder="Bonjour cher Hackers Poulette,&#10;Je rencontre un problème avec..." required aria-required="true"></textarea>
                </label>
              </div>
              
            </div>
          </fieldset>

          <div class="row">
            <div class="medium-9 columns medium-centered">
              <button type="submit" class="button primary large expanded round">C'est bon, tout y est? Avez-vous posé toutes vos questions? Envoyez !</button>
            </div>
          </div>

        </form>
      </div>


  </main>
</body>
</html>