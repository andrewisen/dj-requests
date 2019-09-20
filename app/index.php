<?php
  require_once($_SERVER [ 'DOCUMENT_ROOT' ].'/class/contentcreator.class.php');
  require_once($_SERVER [ 'DOCUMENT_ROOT' ].'/class/spotify.class.php');
  $cc = new ContentCreator();
  $spotify = new Spotify();
  $search = False;

  // Main GET & POST functions, need to implement error handling here.
  $venueID = isset($_GET['venueid']) ? $_GET['venueid'] : NULL; 
  $floorID = isset($_GET['floorid']) ? $_GET['floorid'] : NULL;

  // New request add
  if($venueID != NULL && $floorID != NULL && 
      isset($_GET['id']) && isset($_GET['artist']) && isset($_GET['title']) ){
    $venueID =$_GET['venueid'];
    $floorID = $_GET['floorid'];
    $songID = $_GET['id'];
    $artist = $_GET['artist'];
    $title = $_GET['title'];
    $cc->addRequest($venueID, $venueID, $songID, $artist, $title);
  }
  
  // Song search
  if(!empty($_POST) && $venueID != NULL && $floorID != NULL){
    $search = True;
    $output = "";
    $q = $_POST['searchTxt'];

    $spotifyCredentials = $spotify->getSpotifyCredentials();
    $accessToken = $spotify->getAccessToken($spotifyCredentials);  

    $jsonResponse = $spotify->getSearchResults($accessToken, $q, "track");
    $tracks = $jsonResponse["tracks"];
    $tracks = $tracks["items"];

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
        "venueid" => $venueID,
        "floorid" => $floorID
      );

      $requestURL = http_build_query($requestURL);
      $requestURL = "?" . $requestURL;
    
      $outputString = "<a href='" . $requestURL . "'>" . $outputString . "</a>";
      $output = $output . $outputString . "<br>";
    }
  }
?>

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
        <form <?php echo "action=index.php?venueid=$venueID&floorid=$floorID" ?> method="post">
          <p class="lead">
            <input class="form-control mr-sm-2" type="search" 
               <?php echo $search ? "placeholder='Click on a song to request'" : "placeholder='Enter a song (artist or title)'";?>
              aria-label="Search for a song" name="searchTxt" id="searchTxt" required autofocus>
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
      <div class="text-left mb-4" id="parseResponse">
        <?php echo $search ? $output : "" ?>
      </div>
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