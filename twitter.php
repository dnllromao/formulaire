<?php
session_start();
// Orginal Twiter API PHP https://github.com/pedroventura/pv-auto-tweets
// Twitter API PHP examples https://github.com/fxstar/auto-tweets-php-api
$consumerKey    = '';
$consumerSecret = '';
$oAuthToken     = '';
$oAuthSecret    = '';
$oauthCallback = 'https://localhost:80/projects/projet-1-formulaire/';
# API OAuth

require "twitteroauth-0.7.3/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//$connection = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
//$content = $connection->get("account/verify_credentials");
//echo '<pre>'.print_r($content, true).'</pre>';
//$statues = $connection->post("statuses/update", ["status" => "is still working"]);
//echo '<pre>'.print_r($statues, true).'</pre>';
echo '<pre>'.print_r($_SESSION['oauth_token'], true).'</pre>';
if(!isset($_SESSION['oauth_token'])) {
	$connection = new TwitterOAuth($consumerKey, $consumerSecret);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $oauthCallback));

	echo '<pre>'.print_r($request_token, true).'</pre>';

	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

	echo '<pre>'.print_r($url, true).'</pre>';
	echo '<a href="'.$url.'">Login with Twitter</a>';

} else {
	var_dump(isset($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] == $_SESSION['oauth_token']);
	echo '<pre>'.print_r($_SESSION['oauth_token'], true).'</pre>';
		$connection = new TwitterOAuth($consumerKey, $consumerSecret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		// getting basic user info
		$user = $connection->get("account/verify_credentials");
		echo '<pre>'.print_r($user, true).'</pre>';

}
