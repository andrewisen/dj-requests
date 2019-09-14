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
```docker run --name dj-requests -v `pwd`/app:/var/www/html -p 9000:80 -d php:7.2-apache```    
The site is now running at [http://localhost:9000](http://localhost:9000).    

## Developing
Useful [Docker](https://docker.com) commands after running the container:    
* `docker stop dj-requests` to stop the instance.
* `docker start dj-requests` to start the instance (useful if you ever reboot you computer or Docker engine).
* `docker restart dj-requests` to restart the instance.

## Contributing
Pull requests are welcome. See Issues for more info.

## Thanks to
- [Arvid Viderberg](https://github.com/Aweponken) for initializing the idea.
- [Allen Fair](https://gist.github.com/afair/a7c7adc52b7b49bf362935e665a87633) for providing a PHP Function to make a remote HTTP requests.
- [The dev team at Spotify](https://developer.spotify.com/documentation/web-api/reference/search/search/) for providing straightforward docs for their API.