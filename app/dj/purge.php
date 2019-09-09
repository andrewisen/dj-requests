<?php
	// GET Request
	// Example: purge.php?purgeRequest=Swedish%20House%20Mafia%20-%20Save%20The%20World
	$songRequest = $_GET['purgeRequest'];
	$songRequest = str_replace('%20',' ', $songRequest);
	
	$path = "requests.txt";
	$lines = file($path);
	$remove = $songRequest;
	foreach($lines as $key => $line){
		if(stristr($line, $remove)){
			unset($lines[$key]);
		}
	}

	// Might cause #6
	$data = implode('\n', array_values($lines));

	$file = fopen($path, "w") or die("Unable to open file!");
	fwrite($file, $data);
	fclose($file);

	header("Location: ./index.php");
	die();
?>