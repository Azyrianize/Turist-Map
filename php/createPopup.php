<?php
	require_once "database_connection.php";
	session_start();

	$marker_id = $_GET["_marker_id"];
	$result = $_GET["_result"];
	$user_type_value = $_GET["_user_type_value"];
	$content = $_GET["_content1"];
	$feature = $_GET["_feature"];
		
?>