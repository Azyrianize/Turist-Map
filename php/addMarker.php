<?php
	require_once "database_connection.php";
	session_start();

	if(isset($_POST['name']) && isset($_POST['type']) && isset($_POST['coord_x']) && isset($_POST['coord_y']))
	{
		$user_id = $_SESSION['user_id'];
		$name = $_POST['name'];
		$type = $_POST['type'];
		$coord_x = $_POST['coord_x'];
		$coord_y = $_POST['coord_y'];
		
		if(!empty($name) && !empty($type) && !empty($coord_x) && !empty($coord_y))
		{
			if(isset($_SESSION['error_message_marker']))
			{
				unset($_SESSION['error_message_marker']);
			}

			$sql_insert="INSERT INTO markers 
			(user_id, name, type, xcoord, ycoord) 
			VALUES ('{$user_id}', '{$name}', '{$type}', '{$coord_x}', '{$coord_y}')
			";

			mysqli_query($connection, $sql_insert);
			$connection->close();


		} else if(empty($name) || empty($type) || empty($coord_x) || empty($coord_y)) {
			$_SESSION["error_message_marker"] = '<span class="error" style="color:red">Niepoprawnie wypełniony formularz!</span>';		
			
		}
	}
	
	header('location: ../index.php');
	
?>