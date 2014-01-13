selfoss_sqlite2mysql
====================

Convert the Selfoss DB from Sqlite to MySQL

## Create a new database

CREATE DATABASE `feed` CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL ON `feed`.* TO `feed`@localhost IDENTIFIED BY 'CHANGEME';
FLUSH PRIVILEGES;
