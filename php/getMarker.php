<?php
	session_start();
	require_once "database_connection.php";
		
	$sql_query="SELECT * FROM markers";
	$result = mysqli_query($connection, $sql_query);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	$file = @fopen("../markers.txt", "r+");
	if ($file !== false) {
		ftruncate($file, 0);
		fclose($file);
	}
		
	foreach($rows as $row)
	{			
		$user_id = $row["user_id"];
		$name = $row["name"];
		$type = $row["type"];
		$xcoord = $row["xcoord"];
		$ycoord = $row["ycoord"];
		

		$handle = fopen('../markers.txt', 'a');
		fwrite($handle, $user_id."\n");
		fwrite($handle, $name."\n");
		fwrite($handle, $type."\n");
		fwrite($handle, $xcoord."\n");
		fwrite($handle, $ycoord."\n\n");
		fclose($handle);
	}
	
  
	$readin = file('../markers.txt');
	$counter = 0;	
	$arrays = array();
		
	foreach($readin as $fmarker)
	{
		$arrays[] = $fmarker;
	}		

	echo json_encode($arrays);

?>