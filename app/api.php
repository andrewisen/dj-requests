<?php
/**
  * Makes a remote HTTP request and returns the response.
  *
  * @author    André Wisén & Arvid Viderberg
  *
  * @see https://girders.org/2018/07/php-guide-to-http-api-requests.html
  * @see https://developer.spotify.com/documentation/general/guides/authorization-guide/#authorization-code-flow
*/

// Debug
error_reporting(E_ALL);
ini_set('display_errors', 'on');
echo "The time is: ".time();
echo "<br>";

function debugToConsole($data) {
  /**
  * Write debug to client's browser
  *
  * @see https://stackoverflow.com/a/20147885
  * @param string|array $data
  * @return string
  */
 
  $output = $data;
  if (is_array($output))
    $output = implode(',', $output);

  echo "<script>console.log('" . $output . "' );</script>";
}

function getSpotifyCredentials($path=null){
  /**
  * Reads Spotify Crendials, formatted as one sting,i.e. "client_id:client_secret".
  *
  * @param string $path
  * @return string client_id:client_secret
  */

  if (null === $path) {
    $path = ".auth";
  }

  debugToConsole("Looking for auth in: " . $path);
  
  $authFile = fopen($path, "r") or die("Unable to open authentication file!");
  $spotifyCredentials = fgets($authFile);
  fclose($authFile);

  return $spotifyCredentials;
}

function explodeSpotifyCredentials($spotifyCredentials,$explodeTarget=null){
  /**
  * Explode Spotify Crendials.
  *
  * @param var $spotifyCredentials
  * @param string $spotifyCredentials
  * @return string client_id or client_secret
  */
  
  if (null === $explodeTarget) {
    $output = null;
    exit("Please provide $spotifyCredentials");
  }

  $spotifyCredentials = explode(":",$spotifyCredentials);
  $client_id = $spotifyCredentials[0];
  $client_secret = $spotifyCredentials[1];

  debugToConsole("Client ID: " . $client_id);
  debugToConsole("Client Secret: " . $client_secret);

  if ($explodeTarget == "client_id") {
    $output = $client_id;
  } elseif ($explodeTarget == "client_secret") {
    $output = $client_secret;
  } else {
    $output = null;
  }

  return $output;
}

function spotifyRequest($url,$method,$headers){
  /**
  * Does a HTTP simple reqeust with authentication.
  *
  * Returns the image resource or false on failure.
  * @param string $url
  * @param string $method
  * @param array $headers
  * @return array JSON Response
  */
    echo "$url . <br>";
}

$spotifyCredentials = getSpotifyCredentials();

$client_id = explodeSpotifyCredentials($spotifyCredentials,"client_id");
$client_secret = explodeSpotifyCredentials($spotifyCredentials,"client_secret");
echo $client_id;
echo $client_secret;

$base = "https://accounts.spotify.com/";
$source = "api/token";
$url = $base . $source;
$method = "POST";
$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";
$headers[] = "Authorization: Basic " . base64_encode($spotifyCredentials);

spotifyRequest($url,$method,$headers);

?>