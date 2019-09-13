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
  * Writes input data to browser's console
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
  * Writes input data to browser's console
  *
  * @see https://stackoverflow.com/a/20147885
  * @param string $data 
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

//$spotifyCredentials = explode(":",$spotifyCredentials);
//$client_id = $spotifyCredentials[0];
//$client_secret = $spotifyCredentials[1];

//debugToConsole("Client ID: " . $client_id);
//debugToConsole("Client Secret: " . $client_secret);

$base = "https://accounts.spotify.com/";
$source = "api/token";
$url = $base . $source;
$method = "POST";
$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";
$headers[] = "Authorization: Basic " . base64_encode($spotifyCredentials);

spotifyRequest($url,$method,$headers);

?>