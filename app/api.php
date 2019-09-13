<?php
/*
  * Makes a remote HTTP request and returns the response.
  *
  * @author    André Wisén & Arvid Viderberg
  *
  * Credit: https://girders.org/2018/07/php-guide-to-http-api-requests.html
  * More info: https://developer.spotify.com/documentation/general/guides/authorization-guide/#authorization-code-flow
*/

// Debug
error_reporting(E_ALL);
ini_set('display_errors', 'on');
echo time();
echo "<br>";

function spotifyRequest($url,$method,$headers){
  /**
  * Does a HTTP simple reqeust with authentication.
  *
  * Returns the image resource or false on failure.
  * @param string $url
  * @param string $method
  * @param array $headers
  * @return string The image resource or false on failure.
  */
    echo "$url . <br>";
}

$base = "https://accounts.spotify.com/";
$source = "api/token";
$url = $base . $source;
$method = "POST";
$headers = array();

spotifyRequest($url,$method,$headers);





?>