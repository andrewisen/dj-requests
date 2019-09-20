<?php 
/* 
** This class handles connection and queries to the DB.
*/
require_once($_SERVER [ 'DOCUMENT_ROOT' ].'/class/meekrodb.2.3.class.php');
require_once($_SERVER [ 'DOCUMENT_ROOT' ].'/functions.php'); //Debugging

class DBHandler {
	
	protected function connect(){
		/* Connect to DB */
		$dbPath = $_SERVER [ 'DOCUMENT_ROOT' ].'/.database';
		$dbStr = file_get_contents($dbPath) or die("Unable to open database file!");
		$db = json_decode($dbStr, true); 
		DB::$user = $db['username'];
		DB::$password = $db['password'];
		DB::$dbName = $db['dbname'];
		DB::$host = $db['servername'];
		DB::$encoding = 'utf8';
	}	

	protected function getRequests($venueID, $floorID, $songLimit = 3){
		return DB::query("
			SELECT id, artist, title, songid, Count(*) AS requests
			FROM request WHERE venueid=%i AND floorid=%i AND played=FALSE AND deleted=FALSE
			GROUP BY songid
			ORDER BY requests DESC
			LIMIT %i
		", $venueID, $floorID, $songLimit);
	}

    protected function getFloorNameFromId($floorID){
		return DB::query("
			SELECT name
			FROM floor WHERE id=%i 
			LIMIT 1
			", $floorID);
	}

	protected function getAllFloorsFromVenue($venueID){
		return DB::query("
			SELECT id, name
			FROM floor WHERE venueid=%i 
			", $venueID);
	}

	protected function getVenueNameFromId($venueID){
		return DB::query("
			SELECT name
			FROM venue WHERE id=%i 
			LIMIT 1
			", $venueID);
	}

	protected function markSongAsPlayed($venueID, $floorID, $songID){
		return DB::query("
			UPDATE request
			SET played = TRUE
			WHERE venueid=%i AND floorid=%i AND songid=%s AND played=FALSE
		", $venueID, $floorID, $songID);
	}

	protected function markSongAsDeleted($venueID, $floorID, $songID){
		return DB::query("
			UPDATE request
			SET deleted = TRUE
			WHERE venueid=%i AND floorid=%i AND songid=%s AND deleted=FALSE
		", $venueID, $floorID, $songID);
	}
}
?>