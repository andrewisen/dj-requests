<?php
	// Refresh URL
	$url1=$_SERVER['REQUEST_URI'];
	header("Refresh: 30; URL=$url1");
	
	require_once($_SERVER [ 'DOCUMENT_ROOT' ].'/class/contentcreator.class.php');

	// TODO: Error handling if venueID and floorId is not set
	$_GET = array_change_key_case($_GET, CASE_LOWER);
	$venueID = isset($_GET['venueid']) ? $_GET['venueid'] : NULL; 
	$floorID = isset($_GET['floorid']) ? $_GET['floorid'] : NULL;
	$playURI = isset($_GET['play']) ? $_GET['play'] : NULL;
	$removeURI = isset($_GET['remove']) ? $_GET['remove'] : NULL; 
	$songLimit = isset($_GET['songlimit']) ? $_GET['songlimit'] : 3;
	
	$cc = new ContentCreator();

	if ($playURI != NULL){
		$cc->markSongAsPlayed($venueID, $floorID, $playURI);
	} elseif ($removeURI != NULL) {
		$cc->markSongAsDeleted($venueID, $floorID, $removeURI);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>DJ Requests - Admin Page</title>
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
		<header>
			<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
				<!--<a class="navbar-brand" href="#">Admin Page</a>-->
				<a class="navbar-brand" href="/dj">
					Admin Page
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsExampleDefault">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Remove all songs</a>
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" href="#">Settings</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dancefloor</a>
							<div class="dropdown-menu" aria-labelledby="dropdown01">
								<?php echo $cc->getFloorMenuItems($venueID, $songLimit); ?>
							</div>
						</li>
					</ul>
					<form class="form-inline my-2 my-lg-0" action="../">
						<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Back</button>
					</form>
				</div>
			</nav>
		</header>
		<main role="main" class="container" style="padding-top: 0px;">
		<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
		<img class="mr-3" src="../img/logo-white-300.png" alt="" width="48" height="48">
		<div class="lh-100">
		<h6 class="mb-0 text-white lh-100"><?php echo $cc->getFloorName($floorID); ?></h6>
		<small><?php echo $cc->getVenueName($venueID); ?></small>
		</div>
		</div>

			<div class="my-3 p-3 bg-white rounded box-shadow">
				<h6 class="border-bottom border-gray pb-2 mb-0">Requests</h6>
				<!-- REQUESTS -->
				<div id="echoRequests">
					<?php echo $cc->getAndFormatRequests($venueID, $floorID, $songLimit); 
					?>
				</div>
				<div class='media text-muted pt-3'>
					<small class="d-block text-right mt-3">
						<?php echo "
							<a href='?venueid=$venueID&floorid=$floorID&songLimit=100'>
								<b>All Requests</b>
							</a>" 
						?>
						(<a href="#">Update Now</a>)
					</small>
				</div>
			</div>
		</main>
		<footer class="footer">
			<div class="container">
				<span class="text-muted">
					&copy; <script>new Date().getFullYear()>document.write(new Date().getFullYear());</script> <a href="https://awide.se" target="_blank">Arvid</a> & <a href="https://andrewisen.se" target="_blank">André</a> - 
					<a href="#" data-toggle="modal" data-target="#aboutModal">About</a>
				</span>
			</div>
		</footer>

		<!-- MODAL ABOUT -->
		<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">About</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="text-left modal-body">
						Made with <span style="color: #e25555;">&hearts;</span> in Stockholm, Sweden.<br><br>
						Built with Boostrap 4, PHP, and a bit custom CSS.<br>
						You can clone or fork this project on <a href="http://github.com/andrewisen/dj-requests" target="_blank">GitHub</a>.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
					</div>
				</div>
			</div>
		</div>
		
		<!-- CDNs -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.6/holder.js"></script>
	</body>
</html>