<?php
	session_start();
	require_once "database_connection.php";	
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeatpassword']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$repeatpassword = $_POST['repeatpassword'];
		
		if(!empty($username) && !empty($password) && !empty($repeatpassword))
		{
			if($password == $repeatpassword)
			{
				if(isset($_SESSION['error_message_register']))
				{
					unset($_SESSION['error_message_register']);
				}
			
				$handle = fopen('../login.txt', 'a');
				fwrite($handle, $username."\n");
				fwrite($handle, $password."\n\n");
				fclose($handle);
			}			
		} else if(empty($username) || empty($password) || empty($repeatpassword)){
			$_SESSION["error_message_register"] = '<span class="error" style="color:red">Niepoprawnie wypełniony formularz!</span>';		
			
		}
	}
	
	header('location: ../index.php');
	
?>