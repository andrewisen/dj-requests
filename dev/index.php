<!DOCTYPE html>
<html>
<head>
	<title>DJ Request(er)</title>
	<meta name="description" content="DJ requester">
	<meta name="author" content="André Wisén">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head> 
<body>
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
			$fh = fopen('../requests.txt','r');
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
				$fh = fopen('../requests.txt','w');
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
</body>
</html>
