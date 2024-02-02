# eCom

Create and clone the repository.

## Running the Docker container to host the web application

Start Docker Desktop, then run.

Alter this with the proper file location of the clones.
docker run --name myXampp -p 22:22 -p 80:80 -d -v C:\Users\2283429\Documents\eCom:/opt/lampp/htdocs tomsik68/xampp:8	

## Accessing the project

Open a browser and point it to localhost.

## Bootstrap the project

Create a file called '.htaccess'.
Match a series of characters that arent empty and place it into a group = ^(.+)$


Options -Multiviews
Options -Indexes

RewriteEngine On

RewriteBase /

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
RewriteRule ^()$ index.php?url=$1 [QSA,L]

Copy this file exactly.

## Core folder