<?php
    include("../db/db_core.php");
	
    $firstname = $_POST['f'];
    $lastname = $_POST['l'];
	$username = $_POST['u'];
	$password = $_POST['p'];
	$email = $_POST['e'];
	$phone = $_POST['pn'];
	$type = $_POST['tp'];
	
	$table = "parliament_users";
	$query = "INSERT INTO $table VALUES(0, '$firstname', '$lastname', '$email', md5('$password'), '$username', '$phone', '$type')";
	$result = db_query($query);
 	
	if($result){
       $response["success"] = 1;
       $response["message"] = "USER ADDED";

    	echo json_encode($response);
		
	}else{
	   $response["success"] = 0;
       $response["message"] = "USER NOT ADDED";

    	echo json_encode($response);
	}
	
?>
