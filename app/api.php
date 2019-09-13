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

$base = "https://accounts.spotify.com/";
$source = "api/token";
$url = $base . $source;

private function spotifyRequest($url,$method,$headers){
    echo "$fname Refsnes.<br>";
}



?>