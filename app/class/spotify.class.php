<?php

/**
    * Make a remote HTTP request to Spotify and return Track data based on query.
    *
    * @author    André Wisén & Arvid Viderberg
    *
    * @see https://girders.org/2018/07/php-guide-to-http-api-requests.html
    * @see https://developer.spotify.com/documentation/general/guides/authorization-guide/#authorization-code-flow
  */

require_once($_SERVER [ 'DOCUMENT_ROOT' ].'/functions.php'); //Debugging

class Spotify
{
  function getSpotifyCredentials($path=null){
    /**
    * Reads Spotify Crendials, formatted as one sting.
    * I.e. "client_id:client_secret".
    *
    * @param string $path
    * @return string client_id:client_secret
    */

    if (null === $path) {
      $path = $_SERVER [ 'DOCUMENT_ROOT' ].'/.auth';
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
    * Make a simple HTTP reqeust with authentication.
    * Built for connecting to Spotify's WEB API.
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
    /**
    * The Client Credentials flow is used in server-to-server authentication.
    * Only endpoints that do not access user information can be accessed.
    * 
    * See: Client Credentials Flow
    * @see https://developer.spotify.com/documentation/general/guides/authorization-guide/
    */

    $base = "https://accounts.spotify.com/";
    $source = "api/token";
    $url = $base . $source;
    $body = array("grant_type"=>"client_credentials");
    $method = "POST";

    $headers = array();
    $headers[] = "Content-Type: application/x-www-form-urlencoded";
    $headers[] = "Authorization: Basic " . base64_encode($spotifyCredentials);

    $jsonResponse = $this->spotifyRequest($url,$method,$body,$headers);
    $accessToken = $jsonResponse["access_token"];
    return $accessToken;
  }

  function getSearchResults($accessToken,$searchQuery,$searchType){
    /**
    * Get Spotify Catalog information about artists, albums, tracks or playlists that match a keyword string.
    *
    * Returns the image resource or false on failure.
    * @see https://developer.spotify.com/documentation/web-api/reference/search/search/
    */

    $base = "https://api.spotify.com/";
    $source = "v1/search";
    $searchLimit = "4"; // Move to parameter

    $url = array(
      "q" => $searchQuery,
      "type" => $searchType,
      "limit" => $searchLimit
    ); 

    $url = http_build_query($url);
    $url = $base . $source . "?" . $url;

    $method = "GET";
    $headers = array();
    $headers[] = "Accept: application/json";
    $headers[] = "Content-Type: application/json";
    $headers[] = "Authorization: Bearer " . $accessToken;

    $jsonResponse = $this->spotifyRequest($url,$method,null,$headers);
    return $jsonResponse; 
  }
}
?>