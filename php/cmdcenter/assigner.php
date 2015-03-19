<?php
include("../db/db_core.php");

      $type = $_POST['ty'];
      $as_id = $_POST['asid'];
      $at_id = $_POST['atid'];

      $table1 = "parliament_group_assignments";
      $table2 = "parliament_topic_assignments";
      $table3 = "parliament_invitation_assignments";
      $query = "";
      
      switch ($type) {
      	case 'group':      	
      		$query =  "INSERT INTO $table1 VALUES(0, $as_id, $at_id)";
      		$res1 = db_query($query);
      		if($res1){
		       $response["success"] = 1;
		       $response["message"] = "Assignment Successful";

		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "Assignment Not Successful";

		    	echo json_encode($response);
			}
      		break;

      	case 'topic':

      		$query =  "INSERT INTO $table2 VALUES(0, $as_id, $at_id)";
      		$res2 = db_query($query);
      		if($res2){
		       $response["success"] = 1;
		       $response["message"] = "Assignment Successful";

		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "Assignment Not Successful";

		    	echo json_encode($response);
			}
      		break;

      	case 'inv':

      		$query =  "INSERT INTO $table3 VALUES(0, $as_id, $at_id)";
      		$res3 = db_query($query);
      		if($res3){
		       $response["success"] = 1;
		       $response["message"] = "Assignment Successful";

		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "Assignment Not Successful";

		    	echo json_encode($response);
			}
      		break;	      
      }
?>