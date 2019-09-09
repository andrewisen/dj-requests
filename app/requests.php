<?php
	// No Cache
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	// GET Request
	// Example: requests.php?songRequest=Swedish%20House%20Mafia%20-%20Save%20The%20World
	$songRequest = $_GET['songRequest'];
	$myFile = fopen("dj/requests.txt", "a") or die("Unable to open file!");

	// PHP_EOL = End Of Line
	fwrite($myFile, $songRequest.PHP_EOL);
	fclose($myFile);
	header("Location: ./index.html?requestSent");
	die();
?>