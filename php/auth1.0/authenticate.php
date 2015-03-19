<?php
	$username = $_POST['u'];
	$password = $_POST['p'];
	
	if($username == null || $password == null){
		$response["success"] = 0;
	    $response["message"] = "incomplete request";

	    return json_encode($response);
	}else{
		include("../db/db_core.php");
		$table = "parliament_users";
		
		$query = "SELECT * FROM $table where username = '$username' AND password = md5('$password') AND user_type = 'Admin'";
		$result = db_select($query, $table);
		//$date = date('Y-m-d H:i:s');
		if(count($result) > 0){
			
			//$query2 = "UPDATE $table SET last_login = '$date' WHERE username= '$username'";
			//db_query($query2);
							
			$response["success"] = 1;
	    	$response["message"] = "VALID USER";
			//$response["auth_id"] = $result[0][0];

	    	echo json_encode($response);
		}else{
		$response["success"] = 0;
	    $response["message"] = "INVALID USER";

	    	echo json_encode($response);
		}		
	}
	
	
	
?>
