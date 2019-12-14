
The application is using CodeIgniter 3 as a basic MVC framework. It can be
downloaded here: https://codeigniter.com/en/download

Unzip all of the files into your project directory making sure not to move any of the files.
Add the application and public directories at the top level.

Point your Apache web root at the /public directory.

As is standard with the framework, set the apache config to route all requests through the index.php.

## Apache vhost config
=================
Require all granted

RewriteEngine On

# Handle Front Controller...
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
=================

You will need to create a mysql database and user, (the app uses root user for simplicity)
The creation script is in pig.sql, but for reference:

#################

CREATE DATABASE `pig` CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

###############