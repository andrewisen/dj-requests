<?php
/* 
** This class delivers content to the different webpages.
** It utilizes the DBHandler class to fetch data from the DB.
** So basically everytime their is code like $this->functionName, it calls
** the functionName in the DBHandler class.
** It's main function is to take raw DB data, process it, deliver it.
*/
require_once($_SERVER [ 'DOCUMENT_ROOT' ].'/class/dbhandler.class.php');

class ContentCreator extends DBHandler{

	public function __construct(){	
		$this->connect();
	}

	public function getAndFormatRequests($venueID, $floorID, $songLimit){
		
		$result = $this->getRequests($venueID, $floorID, $songLimit);
	    $output = "";

		foreach ($result as $row) { // Maybe move this code to the db/index.php file instead? Cleaner code? 
		
			$songID = $row['songid'];
			$artist = str_replace("'","%27",$row["artist"]);
			$title = str_replace("'","%27",$row["title"]);
			$requests = $row['requests'];

			$output = $output . "
				<div class='media text-muted pt-3'>
					<div class='media-body pb-3 mb-0 small lh-125 border-bottom border-gray'>
						<div class='d-flex justify-content-between align-items-center w-100'>
							<strong class='text-gray-dark'>
								$artist - $title ($requests)
							</strong>
							<div>
								<b> 
									<a href='?venueID=$venueID&floorId=$floorID&songLimit=$songLimit&play=$songID'>PLAY</a>
								</b><br>
								(<a href='?venueID=$venueID&floorId=$floorID&songLimit=$songLimit&remove=$songID'>REMOVE</a>)
							</div>
						</div>
					</div>
				</div><br>
			";
		}
		if($output === ""){ $output = "0 results"; }
		return $output;
	}

	public function addRequest($venueID, $floorID, $songID, $artist, $title){

		$this->addRequestToDB($venueID, $floorID, $songID, $artist, $title);
		return True;
	}

	public function getFloorName($floorID){
		$result = $this->getFloorNameFromId($floorID);
		return $result[0]['name'];
	}

	public function getVenueName($venueID){
		$result = $this->getVenueNameFromId($venueID);
		return $result[0]['name'];
	}

	public function markSongAsPlayed($venueID, $floorID, $songID){
		$result = $this->markSongAsPlayedDB($venueID, $floorID, $songID);
		return True;
	}

	public function markSongAsDeleted($venueID, $floorID, $songID){
		$result = $this->markSongAsDeletedDB($venueID, $floorID, $songID);
		return True; 
	}

	public function getFloorMenuItems($venueID, $songLimit){
		$output = "";
		$menuItems = $this->getAllFloorsFromVenue($venueID);

		foreach ($menuItems as $item) {
			$name = $item['name'];
			$floorID = $item['id'];
			$output = $output . 
				"<a class='dropdown-item' 
					href='?venueid=$venueID&floorid=$floorID&songlimit=$songLimit'>
					$name
				</a>";
		}
		return $output;
	}
}
?>