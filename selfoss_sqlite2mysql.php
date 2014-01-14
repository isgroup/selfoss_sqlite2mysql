#!/usr/bin/php
<?php

chdir(__DIR__);

if ($argc != 5) {
	echo 'Usage: '.$argv[0].' hostname database username password'."\n";
	exit;
}

$sqlite_db = 'data/sqlite/selfoss.db';
$mysql_hostname = $argv[1];
$mysql_database = $argv[2];
$mysql_username = $argv[3];
$mysql_password = $argv[4];

$dbs = new SQLite3($sqlite_db);
$dbm = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_database);

if ($dbm->connect_errno) {
	printf("Connect failed: %s\n", $dbm->connect_error);
	exit;
}

$dbs->query('SET NAMES utf8');

$count_items = 0;
$count_sources = 0;
$count_tags = 0;

$dbs_result = $dbs->query('SELECT * FROM items');

while($dbs_row = $dbs_result->fetchArray()) {
	$dbm->query(sprintf(
		"INSERT INTO items SET id = '%s', datetime = '%s', title = '%s', content = '%s', thumbnail = '%s', icon = '%s', unread = '%s', starred = '%s', source = '%s', uid = '%s', link = '%s'",
		$dbm->real_escape_string($dbs_row['id']),
		$dbm->real_escape_string($dbs_row['datetime']),
		$dbm->real_escape_string($dbs_row['title']),
		$dbm->real_escape_string($dbs_row['content']),
		$dbm->real_escape_string($dbs_row['thumbnail']),
		$dbm->real_escape_string($dbs_row['icon']),
		$dbm->real_escape_string($dbs_row['unread']),
		$dbm->real_escape_string($dbs_row['starred']),
		$dbm->real_escape_string($dbs_row['source']),
		$dbm->real_escape_string($dbs_row['uid']),
		$dbm->real_escape_string($dbs_row['link'])
	));
	echo 'Items: '.++$count_items."\n";
}

$dbs_result = $dbs->query('SELECT * FROM sources');

while($dbs_row = $dbs_result->fetchArray()) {
	$dbm->query(sprintf(
		"INSERT INTO sources SET id = '%s', title = '%s', tags = '%s', spout = '%s', params = '%s', error = '%s', lastupdate = '%s'",
		$dbm->real_escape_string($dbs_row['id']),
		$dbm->real_escape_string($dbs_row['title']),
		$dbm->real_escape_string($dbs_row['tags']),
		$dbm->real_escape_string($dbs_row['spout']),
		$dbm->real_escape_string($dbs_row['params']),
		$dbm->real_escape_string($dbs_row['error']),
		$dbm->real_escape_string($dbs_row['lastupdate'])
	));
	echo 'Sources: '.++$count_sources."\n";
}

$dbs_result = $dbs->query('SELECT * FROM tags');

while($dbs_row = $dbs_result->fetchArray()) {
	$dbm->query(sprintf(
		"INSERT INTO tags SET tag = '%s', color = '%s'",
		$dbm->real_escape_string($dbs_row['tag']),
		$dbm->real_escape_string($dbs_row['color'])
	));
	echo 'Tags: '.++$count_tags."\n";
}
