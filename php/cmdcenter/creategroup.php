<?php

	include("../db/db_core.php");

	$groupname = $_POST['gn'];
	//$groupmembers = $_POST['gm'];
	
	
	
	$table = "parliament_groups";
	
	$query = "INSERT INTO $table VALUES(0, '$groupname')";
	$result = db_query($query);

	if($result){
       $response["success"] = 1;
       $response["message"] = "GROUP ADDED";

    	echo json_encode($response);
		
	}else{
	   $response["success"] = 0;
       $response["message"] = "GROUP NOT ADDED";

    	echo json_encode($response);
	}
	
	
	


?>