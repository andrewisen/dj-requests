<?php
	$songRequest = $_GET['purgeRequest'];
	$songRequest = str_replace('%20',' ', $songRequest);
	// print_r($songRequest);

	
	$path = "../requests.txt";
	$lines = file($path);
	$remove = $songRequest;
	foreach($lines as $key => $line){
		if(stristr($line, $remove)){
			unset($lines[$key]);
			// print_r("Deleted");
		}
	}
	$data = implode('\n', array_values($lines));

	$file = fopen($path, "w") or die("Unable to open file!");
	print_r($data);
	fwrite($file, $data);
	fclose($file);

	header("Location: ./index.php");
	die();
?>