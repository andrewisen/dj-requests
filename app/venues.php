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
  <link href="css/offcanvas.css" type="text/css" rel="stylesheet">
</head> 
<body class="dj">
  <main role="main" class="container">
    <div class="djSearch">
      <!-- LOGO & DESCRIPTION -->
      <div class="text-center mb-4">
        <a href="?easterEgg"><img class="mb-4" src="./img/logo-300.png" alt="" width="72" height="72"></a>
        <h1 class="h3 mb-3 font-weight-normal"><div id="venueName"></div></h1>
        <p>Select a <a style="font-size:80%;color:#e83e8c;word-break:break-word;text-decoration:none;" href="#dancefloorModal" data-toggle="modal" data-target="#dancefloorModal">dancefloor</a> to request your favorite song.
      </div>

      <!-- SEARCH BAR % BUTTON -->
      <div class="text-left mb-4" id="echoDancefloors2">
        <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Dancefloors</h6>
          <div id="echoDancefloors">
          </div>
 


        <small class="d-block text-left mt-3">
          <a data-target="#venueModal" data-toggle="modal" href="#venueModal">Venue Info</a>
        </small>
      </div>


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

<!-- VENUE SEARCH BAR -->
<div class="modal fade" id="venueModal" tabindex="-1" role="dialog" aria-labelledby="venueModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><div id="venueName"></div></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="text-left modal-body" id="venueDescription">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
</div>
</div>
</div>
</div>

<!-- DANCEFLOOR REQUEST SONG -->
<div class="modal fade" id="dancefloorModal" tabindex="-1" role="dialog" aria-labelledby="dancefloorModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Dancefloor(s)</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="text-left modal-body">
Each dancefloor has a unique favlour. Be sure to select the right one.
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
  $venuePath = ".venue";
  $venueStr = file_get_contents($venuePath) or die("Unable to open database file!");
  $venue = json_decode($venueStr, true);

  $venueName = $venue["name"];
  echo "<script>" . 'document.getElementById("venueName").innerHTML = "' . $venueName . '";' . "</script>";

  $venueDescription= $venue["description"];
  echo "<script>" . 'document.getElementById("venueDescription").innerHTML = "' . $venueDescription . '";' . "</script>";


  $dancefloors = $venue["dancefloors"];
  //print_r($dancefloors);

  $output = "<ul class='list-group'>";


  foreach ($dancefloors as $dancefloor) {
      $name = $dancefloor["name"];
      $genre = $dancefloor["genre"];
      $img = $dancefloor["img"];
      $id = $dancefloor["id"];
      // echo $name . "<br>";

      $imgSize = "32";
      $imgURL = "<img src='" . $img . "' alt='Dancefloor' width='" . $imgSize . "' height='". $imgSize ."' class='mr-2 rounded'>";

      $output = $output . "<a href='?dancefloorID=" . $id . "'>" . "<div class='media text-muted pt-3'>".
      $imgURL .
"<div class='media-body pb-3 mb-0 small lh-125 border-bottom border-gray'>".
"<div class='d-flex justify-content-between align-items-center w-100'>".
  "<strong class='text-gray-dark'>" . $name . "</strong>".
"</div>".
"<span class='d-block'>" . $genre . "</span>".
"</div>".
"</div>"."</a>";

  }


  echo "<script>" . 'document.getElementById("echoDancefloors").innerHTML = "' . $output . '";' . "</script>";
?>