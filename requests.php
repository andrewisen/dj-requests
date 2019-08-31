<?php
	$songRequest = $_GET['songRequest'];
	print_r($songRequest);

	$myFile = fopen("requests.txt", "a") or die("Unable to open file!");

	// fwrite($myFile, "\n". $songRequest);
	fwrite($myFile, $songRequest.PHP_EOL);
	fclose($myFile);

	header("Location: ./index.html");
	die();
?>