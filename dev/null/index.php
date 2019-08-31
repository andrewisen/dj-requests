<?php

	$url1=$_SERVER['REQUEST_URI'];
	header("Refresh: 5; URL=$url1");

	$songs= array();
	$output= array();
	

	$fh = fopen('../requests.txt','r');
	while ($line = fgets($fh)) {
		array_push($songs,$line);
	}

	fclose($fh);
	//print_r($songs);

	foreach ($songs as &$song) {
		$tempSong = "";
		// print_r($song);
		$tmp = array_count_values($songs);
		$cnt = $tmp[$song];
		// print_r($cnt);
		$tempSong .= $cnt . ". " .$song;
		array_push($output,$tempSong);
	}
	$output = array_unique($output);
	rsort($output);

	unset($value); // break the reference 
	unset($song);


	foreach ( $output as $line ) {
		echo $line . "<br/>";
	}

?>