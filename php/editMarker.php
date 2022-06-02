<?php
	
	session_start();
	include('database_connection.php');
		
	$markername = $_POST['hidName'];
	$name = $_POST['name'];
	$type = $_POST['type'];
	$coord_x = $_POST['coord_x'];
	$coord_y = $_POST['coord_y'];
		
	$sql_query="UPDATE markers 
	SET name = '".$name."'
	WHERE name = '".$markername."'
	";
	

	mysqli_query($connection, $sql_query);
	
	$connection->close();
	
		header('location: ../index.php');
?>