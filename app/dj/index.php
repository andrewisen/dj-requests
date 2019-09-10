<head>
	<title>DJ Request(er)</title>
	<meta name="description" content="DJ requester">
	<meta name="author" content="Arvid & André">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- FAVICONS -->
	<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
	<link rel="manifest" href="../favicon/site.webmanifest">
	<link rel="mask-icon" href="../favicon/safari-pinned-tab.svg" color="#563d7c">
	<link rel="shortcut icon" href="../favicon/favicon.ico">
	<meta name="apple-mobile-web-app-title" content="DJ Requests">
	<meta name="application-name" content="DJ Requests">
	<meta name="msapplication-TileColor" content="#ffc40d">
	<meta name="msapplication-config" content="../favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

	<!-- BOOSTRAP 4 -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- CUSTOM -->
	<link href="../css/sticky-footer-navbar.css" type="text/css"  rel="stylesheet">
	<link href="../css/search.css" type="text/css" rel="stylesheet">
	<link href="../css/dj.css" type="text/css" rel="stylesheet">
</head>
<body class="bg-light">
<main>
<div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Suggestions</h6>
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark">Full Name</strong>
              <a href="#">Follow</a>
            </div>
            <span class="d-block">@username</span>
          </div>
        </div>
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark">Full Name</strong>
              <a href="#">Follow</a>
            </div>
            <span class="d-block">@username</span>
          </div>
        </div>
        <div class="media text-muted pt-3">
          <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="d-flex justify-content-between align-items-center w-100">
              <strong class="text-gray-dark">Full Name</strong>
              <a href="#">Follow</a>
            </div>
            <span class="d-block">@username</span>
          </div>
        </div>
        <small class="d-block text-right mt-3">
          <a href="#">All suggestions</a>
        </small>
      </div>
    </main>




	<div style="text-align: center;">
    <div style="display: inline-block; text-align: left;">
		<header></header>
		<h1 style="font-size:4vw;">Requests</h1>
		<div style="font-size:2vw;">
		<?php
			// Refresh URL
			$url1=$_SERVER['REQUEST_URI'];
			header("Refresh: 5; URL=$url1");

			// No Cache
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");

			$songs = array();
			$output = array();

			// Open request file and store each line (i.e. each song) in an array
			$fh = fopen('requests.txt','r');
			while ($line = fgets($fh)) {
				array_push($songs,$line);
			}

			fclose($fh);

			// Count how many times each song/request appears
			foreach ($songs as &$song) {
				$tempSong = "";
				$tmp = array_count_values($songs);
				$cnt = $tmp[$song]; // cnt count

				$tempSong .= $cnt . ": " .$song;
				array_push($output,$tempSong);
			}
			
			// Remove duplicates
			$output = array_unique($output);

			// Sort decending
			rsort($output);

			// Break the references
			unset($value); 
			unset($song);

			// Print each song
			// Template: 	"[# of requests]: [Artist] - [Title]""
			// Example: 	"3: Avicci - Levels"

			// Each purge request gets formated into a query format
			// IN: 	"3: Avicci - Levels"
			// OUT:	"Avicii%20-%20Levels"
			foreach ( $output as $song ) {
				///// DEBUG /////
				// echo $line . "<br/>";
				#<a href="requests.php?' + serializeOutputTxt + '">' + "Request" +'</a>'

				//echo '<a href="#">' . $line . "</a>" . "<br/>";
				// echo $line . "<br/>";
				///// DEBUG /////

				$pos = strpos($song, ":");
				$songQuery = substr($song, $pos + 2); 

				$songQuery = str_replace(' ', '%20', $songQuery);
				$querySong = "purgeRequest=" . $songQuery;
				echo '<a href="purge.php?' . $querySong . '">'. $song . "</a>" . "<br/>";
			}

			// clearTxt = Purge all
			function clearTxt(){
				$fh = fopen('requests.txt','w');
				fclose($fh);
				header("Refresh:0");
			}

			if(array_key_exists('purgeRequests',$_POST)){
				clearTxt();
			}
		?>
		</div>
		<br><br>
		<div>
			<form method="post">
				<input type="submit" name="purgeRequests" id="purgeRequests" value="Purge" /><br/>
			</form>
			<br>
			<form action="../">
				<input type="submit" value="Back" />
			</form>
		</div>
	</div>
	</div>
	<!-- CDNs -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
