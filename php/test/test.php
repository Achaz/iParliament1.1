<?php

    include("db_core.php");
	$table = "parliament_users";
		//$date = date('Y-m-d H:i:s');
	$query = "INSERT INTO $table VALUES(0, 'Julian', 'Muheirwe', 'mjm@gmail.com', md5('jlm'), 'badguy', '0712550056', 'Member of Parliament')";
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