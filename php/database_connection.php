<?php
	$DB_HOST = "localhost:3307";
	$DB_USERNAME = "root";
	$DB_PASSWORD = '';
	$DB_DATABASE = "turistmap";
		
	$connection = @new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);	

	$sql = "CREATE TABLE IF NOT EXISTS login (
		user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
		username text NOT NULL,
		password text NOT NULL,
		email text NOT NULL,
		)";
	
	$connection->query($sql);
	
	$sql = "CREATE TABLE IF NOT EXISTS markers (
		marker_id INT(11) AUTO_INCREMENT PRIMARY KEY,
		user_id INT(11) NOT NULL,
		name text NOT NULL,
		type text NOT NULL,
		xcoord double NOT NULL,
		ycoord double NOT NULL,
		)";
	
	$connection->query($sql);

?>