selfoss_sqlite2mysql
====================

Convert the Selfoss DB from Sqlite to MySQL

## Installation

Create a new istance of Selfoss by moving the old installation from "feed" to "feed_old".

### Create a new database

```
CREATE DATABASE `feed` CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL ON `feed`.* TO `feed`@localhost IDENTIFIED BY '[CHANGEME]';
FLUSH PRIVILEGES;
```

### Selfoss configuration

In the new installation copy and edit the default configuration.

```
cp defaults.ini config.ini
```

The values to be changed are the following:

```
db_type=mysql
db_host=localhost
db_database=feed
db_username=feed
db_password=[CHANGEME]
db_port=3306
```

And the password protection data:

```
username=feed
password=[CHANGEME]
salt=[CHANGEME]
```

Upload the selfoss_sqlite2mysql.php in the old installation.

```
./selfoss_sqlite2mysql.php 127.0.0.1 feed feed [CHANGEME]
```

See http://selfoss.aditu.de/ for more detailed documentation.

## Fix corrputed tables

```
mysqlcheck -e feed -u root -p
```
