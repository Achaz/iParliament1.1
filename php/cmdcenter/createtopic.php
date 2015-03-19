<?php

	$topictitle = $_POST['tt'];
	//$topicmembers = $_POST['gt'];
	
	include("../db/db_core.php");
	
	$table = "parliament_topics";
	
	$query = "INSERT INTO $table VALUES(0, '$topictitle')";
	$result = db_query($query);
	

	if($result){
       $response["success"] = 1;
       $response["message"] = "TOPIC ADDED";

    	echo json_encode($response);
		
	}else{
	   $response["success"] = 0;
       $response["message"] = "TOPIC NOT ADDED";

    	echo json_encode($response);
	}
	
	

	

?>