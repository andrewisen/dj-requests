<?php
	// GET Request
	// Example: requests.php?songRequest=Swedish%20House%20Mafia%20-%20Save%20The%20World
	$songRequest = $_GET['songRequest'];
	$myFile = fopen("requests.txt", "a") or die("Unable to open file!");

	// PHP_EOL = End Of Line
	fwrite($myFile, $songRequest.PHP_EOL);
	fclose($myFile);
	header("Location: ./index.html");
	die();
?>