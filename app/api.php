<!DOCTYPE html>
<html>
<head>
  <title>DJ Requests</title>
  <meta name="description" content="DJ requester">
  <meta name="author" content="Arvid & André">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <!-- FAVICONS -->
  <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
  <link rel="manifest" href="./favicon/site.webmanifest">
  <link rel="mask-icon" href="./favicon/safari-pinned-tab.svg" color="#563d7c">
  <link rel="shortcut icon" href="./favicon/favicon.ico">
  <meta name="apple-mobile-web-app-title" content="DJ Requests">
  <meta name="application-name" content="DJ Requests">
  <meta name="msapplication-TileColor" content="#ffc40d">
  <meta name="msapplication-config" content="./favicon/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <!-- BOOSTRAP 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- CUSTOM -->
  <link href="css/sticky-footer-navbar.css" type="text/css"  rel="stylesheet">
  <link href="css/search.css" type="text/css" rel="stylesheet">
</head> 
<body class="dj" onload="checkStatus()">
  <main role="main" class="container">
    <div class="djSearch">
      <!-- LOGO & DESCRIPTION -->
      <div class="text-center mb-4">
        <a href="?easterEgg"><img class="mb-4" src="./img/logo-300.png" alt="" width="72" height="72"></a>
        <h1 class="h3 mb-3 font-weight-normal">DJ Requests</h1>
        <p>Use the <a style="font-size:80%;color:#e83e8c;word-break:break-word;text-decoration:none;" href="#searchBarModal" data-toggle="modal" data-target="#searchBarModal">search bar</a> to find and <a style="font-size:80%;color:#e83e8c;word-break:break-word;text-decoration:none;" href="#requestSongModal" data-toggle="modal" data-target="#requestSongModal">request</a> your favorite song.
      </div>

      <!-- SEARCH BAR % BUTTON -->
      <div class="text-left mb-4">
        <form action="api.php" method="post">
          <p class="lead">
            <input class="form-control mr-sm-2" type="search" placeholder="Enter a song (artist or title)" aria-label="Search for a song" name="searchTxt" id="searchTxt" required autofocus>
          </p>
          <p>
            <button class="btn btn-lg btn-primary btn-block" type="submit" id="myBtn">Search</button>
          </p>
        </form>
      </div>

      <!-- MOTD -->
      <!--<div class="alert alert-info" id="motdDIV">
      <strong>Info!</strong> Tonight we only play 80s.<br>
      We might play 90s.
      </div>-->

      <!-- SEARCH RESULTS -->
      <div class="text-left mb-4" id="parseResponse"></div>
      <br>

    </div>
  </main>

<!-- MODAL SEARCH BAR -->
<div class="modal fade" id="searchBarModal" tabindex="-1" role="dialog" aria-labelledby="searchBarModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Search bar</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="text-left modal-body">
We look up songs from a huge database. Your song will hopefully be there. Make sure you spell it correctly.
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
</div>
</div>
</div>
</div>

<!-- MODAL REQUEST SONG -->
<div class="modal fade" id="requestSongModal" tabindex="-1" role="dialog" aria-labelledby="requestSongModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Request a song</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="text-left modal-body">
Once a song has been requested, the DJ will do its best to play it. Keep in mind that the DJ might not have your requested song.<br><br>In addition, now might not be the best time to play your song. The DJ might wait a while before playing it.
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
</div>
</div>
</div>
</div>

<!-- MODAL ABOUT -->
<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">About</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="text-left modal-body">
Made with <span style="color: #e25555;">&hearts;</span> in Stockholm, Sweden.<br><br>
Built with Boostrap 4, PHP, and a bit custom CSS.<br>
You can clone or fork this project on <a href="http://github.com/andrewisen/dj-requests" target="_blank">GitHub</a>.
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
<form action="https://github.com/andrewisen/dj-requests" target="_blank">
  <button type="submit" class="btn btn-primary">GitHub Repo</button>
</form>
</div>
</div>
</div>
</div>

  <footer class="footer">
    <div class="container">
      <span class="text-muted">
      &copy; <script>new Date().getFullYear()>document.write(new Date().getFullYear());</script> <a href="https://awide.se" target="_blank">Arvid</a> & <a href="https://andrewisen.se" target="_blank">André</a> - 
      <a href="#" data-toggle="modal" data-target="#aboutModal">About</a>
      </span>
    </div>
  </footer>

  <!-- CDNs -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<script>

  function checkStatus(){
    var status =  window.location.search.substr(1);
    if (status == "requestSent") {
      document.getElementById("parseResponse").innerHTML = 'Thank you for your <a style="font-size:80%;color:#e83e8c;word-break:break-word;text-decoration:none;" href="#requestSongModal" data-toggle="modal" data-target="#requestSongModal">request</a>.<br><br>The DJ(s) will do his, her, or their best to play your favorite song.';
    }

    if (status == "easterEgg") {
      document.getElementById("parseResponse").innerHTML = "You pressed the logo...<br>Congratz, you found this <code>message</code>!";
    }
  }

</script>

<?php
  /**
    * Make a remote HTTP request to Spotify and return Track data based on query.
    *
    * @author    André Wisén & Arvid Viderberg
    *
    * @see https://girders.org/2018/07/php-guide-to-http-api-requests.html
    * @see https://developer.spotify.com/documentation/general/guides/authorization-guide/#authorization-code-flow
  */

  /* Debug
  *
  * error_reporting(E_ALL);
  * ini_set('display_errors', 'on');
  * echo "The time is: ".time();
  * echo "<br>";
  */

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
    * Reads Spotify Crendials, formatted as one sting.
    * I.e. "client_id:client_secret".
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

    $jsonResponse = spotifyRequest($url,$method,$body,$headers);
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

    $jsonResponse = spotifyRequest($url,$method,null,$headers);
    return $jsonResponse; 
  }

  function getTrackData($tracks){
    /**
    * Get track related data
    *
    * @param array $tracks
    * @return string 
    */

    $output = '';
    foreach ($tracks as $track){
        $artists = $track["artists"];
        $artistArray = array();
        foreach ($artists as $artist){ 
          $artistArray[] = $artist["name"]; 
        }

        $artist = implode(' & ', $artistArray);
        $id = $track["id"];
        $title = $track["name"];
       

        $outputString = $artist . " - " . $title;
        //$outputString = $track . " by " . $artist; // Alternative format

        $requestURL = array(
          "id" => $id,
          "artist" => $artist,
          "title" => $title,
        );



        $requestURL = http_build_query($requestURL);
        $requestURL = "?" . $requestURL;

        $outputString = "<a href='" . $requestURL . "'>" . $outputString . "</a>";
        $output = $output . $outputString . "<br>";
    }
    return $output;
  }

  function searchSong(){
    /**
    * Main search function
    * Echo data to <div>
    */

    $q = $_POST['searchTxt'];

    $spotifyCredentials = getSpotifyCredentials();
    $accessToken = getAccessToken($spotifyCredentials);

    /* Explode Spotify credentials
    * $client_id = explodeSpotifyCredentials($spotifyCredentials,"client_id");
    * $client_secret = explodeSpotifyCredentials($spotifyCredentials,"client_secret");
    */
    
    /* Explode Spotify credentials
    * echo "Your AccessToken: " . $accessToken . "<br>" . "<br>";
    */

    $jsonResponse = getSearchResults($accessToken,$q,"track");
    $tracks = $jsonResponse["tracks"];
    $tracks = $tracks["items"];

    $output = getTrackData($tracks);

    echo '<script type="text/javascript">'.'document.getElementById("searchTxt").value = ""'.'</script>';
    echo '<script type="text/javascript">'.'document.getElementsByName("searchTxt")[0].placeholder="Click on a song to request"'.'</script>';
    echo '<script type="text/javascript">' . 
    'document.getElementById("parseResponse").innerHTML = "' . 
    $output . 
    '";</script>';
  }

  function requestSong($id,$artist,$title){
    /**
    * Connects to DB and prepare SQL
    *
    * @param string $id
    * @param string $artist
    * @param string $title
    */

    $dbPath = ".database";
    $dbStr = file_get_contents($dbPath) or die("Unable to open database file!");
    $db = json_decode($dbStr, true); 
    $db_servername = $db["servername"];
    $db_name = $db["dbname"];
    $db_table = "request_test";
    $db_username = $db['username'];
    $db_password = $db["password"];

    // Create DB connection
    $conn = mysqli_connect($db_servername, $db_username, $db_password,$db_name);
    $conn->set_charset("utf8");

    if (!$conn){
      die("Connection failed: " . mysqli_connect_error());
    } else {
      debugToConsole("MySQL connected successfully");
    }
    
    $sqlCheckIfSongExists = "SELECT * FROM " . $db_table . " WHERE id = '" . $id . "'";
    $result = $conn->query($sqlCheckIfSongExists);
    $data = $result->fetch_assoc();

    if ($data == NULL){
      addRecord($conn,$db_table,$id,$artist,$title);
    } else {
      $requests = $data["requests"];
      $requests = $requests + 1;
      updateRecord($conn,$db_table,$id,$requests);
    }
  }

  function addRecord($conn,$db_table,$id,$artist,$title){
    /**
    * Add song request to table
    *
    * @param object $conn
    * @param string $db_table
    * @param string $id
    * @param string $artist
    * @param string $title
    */


    $artist = str_replace("'","''",$artist);
    $title = str_replace("'","''",$title);

    $sql = "INSERT INTO " . $db_table . " (id, artist, title, requests) VALUES ('" . $id . "', '" . $artist . "', '" . $title . "', 1)";
    // RECORD ADD
    if ($conn->query($sql) === TRUE) {
      debugToConsole("New record created successfully");
    } else {
      debugToConsole("Error: " . $sql . "<br>" . $conn->error);
    }
    echo "<script>window.location = '?requestSent';</script>";
  }

  function updateRecord($conn,$db_table,$id,$requests){
    /**
    * Update requests value (=+ 1)
    *
    * @param object $conn
    * @param string $db_table
    * @param string $id
    * @param int $requests
    */

    $sqlUpdate = "UPDATE " . $db_table ." SET requests=99 WHERE id='123'";
    $sql = "UPDATE " . $db_table . " SET requests=" . $requests . " WHERE id='" . $id . "'";

    if ($conn->query($sql) === TRUE) {
      debugToConsole("New update created successfully");
    } else {
      debugToConsole("Error: " . $sql . "<br>" . $conn->error);
    }
    echo "<script>window.location = '?requestSent';</script>";
  }

  // Main GET & POST functions
  if(!empty($_GET)){
    $id = $_GET['id'];
    $artist = $_GET['artist'];
    $title = $_GET['title'];

    if (($id!=NULL) && ($artist!=NULL) && ($title!=NULL)){
      
      requestSong($id,$artist,$title);

    }
 
  }
  if(!empty($_POST)){
    searchSong();
  }
?>