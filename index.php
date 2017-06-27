<?php 
  require('twitter.php');
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
<!-- On a oublié de afficher quelles sont les champs required -->
      <div class="content">
        <?= (isset($full_msg))?$full_msg:''; ?>
        <form method="get" action="script.php" novalidate>
          <fieldset class="fieldset">
            <legend> Vos coordonnées d'identification </legend>

            <div class="row">
              <div class="medium-6 columns">
                <label>Votre nom de famille :
                  <input type="text"  name="nom" value="<?= (isset($fields['nom']))?$fields['nom']:''; ?>" placeholder="Mettez votre nom ici s'il vous plait" required aria-required="true" autofocus">
                </label>
                <p class="help-text <?= ( isset($fields['nom']) && empty($fields['nom']))?'':'hide'; ?>" id="alert-nom">Hey, ne oubliez pas de remplir ce champ</p>
              </div>
              <div class="medium-6 columns">
                <label>Votre prénom :
                  <input type="text" name="prenom" value="<?= (isset($fields['prenom']))?$fields['prenom']:''; ?>" placeholder="ex: Gertrude, Frénégonde, Hypolite, Jean-Gustave" required aria-required="true">
                </label>
                <p class="help-text <?= (isset($fields['prenom']) && empty($fields['prenom']))?'':'hide'; ?>" id="alert-prenom">Hey, ne oubliez pas de remplir ce champ</p>
              </div>
            </div>

            <div class="row">
              <div class="medium-6 columns">
                <label>Votre email :
                  <input type="email" name="email" value="<?= (isset($fields['email']))?$fields['email']:''; ?>" placeholder="ex:gertrude@hotmail.com" required aria-required="true">
                </label>
                <p class="help-text <?=(isset($fields['email']) && empty($fields['email']))?'':'hide'; ?>" id="alert-email" >Hey, ne oubliez pas de remplir ce champ</p>
                <p class="help-text <?= (isset($fields['email']) && isset($error_email))?'':'hide'; ?>" id="error-email">Humm, il semble que cet email est invalid</p>
              </div>
              <div class="medium-6 columns">
                <label>Dans quel pays habitez-vous ?
                  <select name="pays" required aria-required="true">
                    <option value="">---</option>
                    <option value="belgique" <?= (!isset($fields['pays']) || $fields['pays'] == 'belgique')?'selected':''; ?>>Belgique</option>
                    <option value="espagne" <?= (isset($fields['pays']) && $fields['pays'] == 'espagne')?'selected':''; ?>>Espagne</option>
                    <option value="italie" <?= (isset($fields['pays']) && $fields['pays'] == 'italie')?'selected':''; ?>>Italie</option>
                    <option value="royaume-uni" <?= (isset($fields['pays']) && $fields['pays'] == 'royaume-uni')?'selected':''; ?>>Royaume-Uni</option>
                    <option value="canada" <?= (isset($fields['pays']) && $fields['pays'] == 'canada')?'selected':''; ?>>Canada</option>
                    <option value="etats-unis" <?= (isset($fields['pays']) && $fields['pays'] == 'etats-unis')?'selected':''; ?>>États-Unis</option>
                    <option value="chine" <?= (isset($fields['pays']) && $fields['pays'] == 'chine')?'selected':''; ?>>Chine</option>
                    <option value="japon" <?= (isset($fields['pays']) && $fields['pays'] == 'japon')?'selected':''; ?>>Japon</option>
                  </select>
                  <p class="help-text <?= (isset($fields['pays']) && empty($fields['pays']))?'':'hide'; ?>" id="alert-pays">Hey, ne oubliez pas de remplir ce champ</p>
                </label>
              </div>
            </div>

            <div class="row">
              <fieldset class="medium-6 columns end">
                <legend>A qui ai-je l'honneur? Monsieur? Madame ?</legend>
                <input type="radio" name="sexe" value="feminin" id="feminin" required aria-required="true" <?= (isset($fields['sexe']) && $fields['sexe'] == 'feminin')?'checked':''; ?>><label for="feminin">F</label>
                <input type="radio" name="sexe" value="masculin" id="masculin" <?= (isset($fields['sexe']) && $fields['sexe'] == 'masculin')?'checked':''; ?>><label for="masculin">M</label>
                <input type="radio" name="sexe" value="indefini" id="indefini" <?= (isset($fields['sexe']) && $fields['sexe'] == 'indefini')?'checked':''; ?>><label for="indefini">X</label>
                <p class="help-text <?= (isset($fields['sexe']) && empty($fields['sexe']))?'':'hide'; ?>" id="alert-sexe">Hey, ne oubliez pas de remplir ce champ</p>
              </fieldset>
            </div>
          </fieldset>

          <fieldset class="fieldset">
            <legend>Objet du problème et donc, de la prise de contact</legend>

            <div class="row">
              <fieldset class="medium-12 columns">
                <legend>A propos de quel sujet(s) vous nous contactez ?</legend>
                <input id="kit" type="checkbox" name="sujet" value="kit" <?= (isset($fields['suject']) && $fields['suject'] == 'kit')?'checked':''; ?>><label for="kit">Kit</label>
                <input id="accessoires" type="checkbox" name="sujet" value="accessoires" <?= (isset($fields['suject']) && $fields['suject'] == 'accessoires')?'checked':''; ?>><label for="accessoires">Accessoires</label>
                <input id="autres" type="checkbox" name="sujet" value="autres" <?= (isset($fields['suject']) && $fields['suject'] == 'autres')?'checked':''; ?>><label for="autres">Autres</label>
              </fieldset>
              <div class="medium-12 columns">
                <label>
                  Quel est votre problème qu'on prendra en charge avec plaisir :) 
                  <textarea name="message" rows="10" cols="50" value="<?= (isset($fields['message']))?$fields['message']:''; ?>" placeholder="Bonjour cher Hackers Poulette,&#10;Je rencontre un problème avec..." required aria-required="true"></textarea>
                </label>
                <p class="help-text <?= (isset($fields['message']) && empty($fields['message']))?'':'hide'; ?>" id="alert-message">Hey, ne oubliez pas de remplir ce champ</p>
                <input type="text" id="touch" name="touch">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/script.js"></script>
</body>

</html>