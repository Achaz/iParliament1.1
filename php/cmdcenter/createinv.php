<?php
	include("../db/db_core.php");

	$inv_title = $_POST['it'];
	$inv_venue = $_POST['iv'];
	$inv_date = $_POST['id'];
	$inv_time = $_POST['itme'];
	$inv_message = $_POST['im'];
	$inv_message2 = $_POST['im2'];
	
	$table = "parliament_invitations";
	$query = "INSERT INTO $table VALUES(0, '$inv_title','$inv_date', '$inv_time', '$inv_venue', '$inv_message', '$inv_message2', 'Unanswered')";
	$result = db_query($query);

	if($result){
       $response["success"] = 1;
       $response["message"] = "INVITATION SENT";

    	echo json_encode($response);
		
	}else{
	   $response["success"] = 0;
       $response["message"] = "INVITATION NOT SENT";

    	echo json_encode($response);
	}
?>