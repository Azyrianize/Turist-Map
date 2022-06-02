<?php
	require_once "database_connection.php";
	session_start();

	$markername = $_POST['hidName'];	
	
	$sql_query="DELETE FROM markers
	WHERE name = '$markername'
	";	
	mysqli_query($connection, $sql_query);
	
	
	$connection->close();
	
?>