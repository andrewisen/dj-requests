# DJ Requests
Simple site that allows users to request song(s) to a DJ.

## Usage - Users
Enter a search term. Press ```Request```.<br>
The request is sent to the DJ.

## Usage - DJ
Enter ```./dj```.<br>
I.e. [https://github.andrewisen.se/dj-requests/dj](https://github.andrewisen.se/dj-requests/dj)<br><br>

The page updates periodically.

## DEMO
[https://github.andrewisen.se/dj-requests/](https://github.andrewisen.se/dj-requests/)

## Prerequisites
Basic understanding of PHP and how to upload file(s) to a FTP.

## Installation
Clone repo.
* Upload the content to your FTP, or 
* Run it locally with [Docker](https://docker.com):
```docker-compose up -d```      
Wait a few moments for the DB to start. The site is now running at [http://localhost:9000](http://localhost:9000).

#### Developing
Useful [Docker](https://docker.com) commands after running the container:    
* `docker-compose down` to stop the instance.
* `docker-compose rm -s -f && docker-compose up --build -d` to reset DB and rebuild the webserver.

## Usage
To access the DJ-page, it is mandatory to send the `venueid` and `floorid` parameters, ie:    
[http://localhost:9000/dj/index.php?venueid=1&floorid=2](http://localhost:9000/dj/index.php?venueid=1&floorid=2). You can also add the `songlimit` parameter to limit the amount of songs showed, ie:    
[http://localhost:9000/dj/index.php?venueid=1&floorid=2&songlimit=0](http://localhost:9000/dj/index.php?venueid=1&floorid=2&songlimit=0)

There is some dummy-data created at the creation of the docker-compose, it's located in [/db/testdata.sql](/db/testdata.sql).

If you want to look at the DB, you can use a DB browser such as [https://sqlectron.github.io/](Sqlectron) or visit [http://localhost:8000](http://localhost:8000) for PHPMyAdmin.

## Contributing
Pull requests are welcome. See Issues for more info.

## Thanks to
- [Arvid Viderberg](https://github.com/Aweponken) for initializing the idea.
- [Allen Fair](https://gist.github.com/afair/a7c7adc52b7b49bf362935e665a87633) for providing a PHP Function to make a remote HTTP requests.
- [The dev team at Spotify](https://developer.spotify.com/documentation/web-api/reference/search/search/) for providing straightforward docs for their API.