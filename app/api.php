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

  if ($explodeTarget == "client_id") {
    $output = $client_id;
  } elseif ($explodeTarget == "client_secret") {
    $output = $client_secret;
  } else {
    $output = null;
  }

  return $output;
}

function spotifyRequest($url,$method,$body=null,$headers){
  /**
  * Does a HTTP simple reqeust with authentication.
  *
  * Returns the image resource or false on failure.
  * @param string $url
  * @param string $method
  * @param array $headers
  * @return array JSON Response
  */

  if (null == $body) {
      $opt = array('http'=>array(
       'method' => $method,
       'header' => implode("\r\n", $headers), // N.B: If error, try PHP_EOL
       ));
  } else {
    $opt = array('http'=>array(
         'method' => $method,
         'header' => implode("\r\n", $headers), // N.B: If error, try PHP_EOL
         'content' => http_build_query($body)
         ));
  }

  $context = stream_context_create($opt);
  $response = file_get_contents($url, false, $context);
  $jsonResponse = json_decode($response,true);

  return $jsonResponse;
}

function getAccessToken($spotifyCredentials){
  $base = "https://accounts.spotify.com/";
  $source = "api/token";
  $url = $base . $source;
  $body = array("grant_type"=>"client_credentials");
  $method = "POST";

  $headers = array();
  $headers[] = "Content-Type: application/x-www-form-urlencoded";
  $headers[] = "Authorization: Basic " . base64_encode($spotifyCredentials);

  $jsonResponse = spotifyRequest($url,$method,$body,$headers);
  $accessToken = $jsonResponse["access_token"];
  return $accessToken;
}

function getSearchResults($accessToken,$searchQuery,$searchType){
  $base = "https://api.spotify.com/";
  $source = "v1/search";
  $url = $base . $source . "?q=" . $searchQuery . "&type=" . $searchType;

  $body = array(""=>"");

  $method = "GET";

  $headers = array();
  $headers[] = "Accept: application/json";
  $headers[] = "Content-Type: application/json";
  $headers[] = "Authorization: Bearer " . $accessToken;

  $jsonResponse = spotifyRequest($url,$method,null,$headers);
  return $jsonResponse; 
}

$spotifyCredentials = getSpotifyCredentials();
// $client_id = explodeSpotifyCredentials($spotifyCredentials,"client_id");
// $client_secret = explodeSpotifyCredentials($spotifyCredentials,"client_secret");

$accessToken = getAccessToken($spotifyCredentials);
echo "DEV, AccessToken: " . $accessToken . "<br>" . "<br>";

$q = $_GET['q'];
$jsonResponse = getSearchResults($accessToken,$q,"track");
$tracks = $jsonResponse["tracks"];
$tracks = $tracks["items"];


foreach ($tracks as $track){
    $artists = $track["artists"];
    $artistArray = array();
    foreach ($artists as $artist){ 
      $artistArray[] = $artist["name"]; 
    }
    $artist = implode(' & ', $artistArray);
    $track = $track["name"];

    echo $artist . " - " . $track . "<br>";
}

?>