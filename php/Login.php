<?php
	session_start();
	require_once "database_connection.php";
	
	$readin = file('../login.txt');
	$counter = 0;	
	
	$post_username = $_POST['username'];
	$post_password = $_POST['password'];
	
	if(!empty($post_username) && !empty($post_password))
	{
		if($connection->connect_errno!=0)
		{
			echo "Error: ".$connection->connect_errno;
		}
		else
		{
			$sql = "SELECT * FROM login WHERE username='$post_username' AND password='$post_password'";	
			if($result = @$connection->query($sql))
			{
				$how_much = $result->num_rows;
				if($how_much>0)
				{
					$row = $result->fetch_assoc();
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['password'] = $row['password'];
					$_SESSION['type'] = $row['type'];
					
					unset($_SESSION['error_message_login']);
					$result->close();
					
					$_SESSION['logged'] = true;
				} 	
			}
			$connection->close();
		}
	}
	else if(empty($username) || empty($password))
	{
			$_SESSION["error_message_login"] = '<span class="error" style="color:red">Niepoprawnie wypełniony formularz!</span>';		
	}
			
	header('location: ../index.php');
	
?>