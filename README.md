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

## Installation
Clone repo.
Upload the content to your FTP or run it locally with [Docker](https://docker.com):
`docker run --name dj-requests -v `pwd`:/var/www/html -p 9000:80 -d php:7.2-apache`

## Contributing
Pull requests are welcome.

## Thanks to
[Arvid Viderberg](https://github.com/Aweponken) for initializing the idea.