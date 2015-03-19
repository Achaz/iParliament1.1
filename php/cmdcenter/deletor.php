<?php
include("../db/db_core.php");

      $type = $_POST['ty'];
      $id = $_POST['id'];

      $table1 = "parliament_groups";
      $table2 = "parliament_topics";
      $table3 = "parliament_invitations";
      $table4 = "parliament_users";
      $query = "";
            
      switch ($type) {
      	case 'group':     	
      	
      		$query =  "DELETE FROM $table1 WHERE id = $id";
      		$res1 = db_query($query);
      		if($res1){
		       $response["success"] = 1;
		       $response["message"] = "GROUP DELETED";

		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "GROUP NOT DELETED";

		    	echo json_encode($response);
			}
      		break;

      	case 'topic':

      		$query =  "DELETE FROM $table2 WHERE id = $id";
      		$res2 = db_query($query);
      		if($res2){
		       $response["success"] = 1;
		       $response["message"] = "TOPIC DELETED";

		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "TOPIC NOT DELETED";

		    	echo json_encode($response);
			}
      		break;

      	case 'inv':      	
      		$query =  "DELETE FROM $table3 WHERE id = $id";
      		$res3 = db_query($query);
      		if($res3){
		       $response["success"] = 1;
		       $response["message"] = "INVITATION DELETED";

		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "INVITATION NOT DELETED";

		    	echo json_encode($response);
			}
      		break;

      	case 'user':      	
      		$query =  "DELETE FROM $table4 WHERE id = $id";
      		$res4 = db_query($query);
      		if($res4){
		       $response["success"] = 1;
		       $response["message"] = "USER DELETED";

		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "USER NOT DELETED";

		    	echo json_encode($response);
			}
      		break;		
      	default:
      		# code...
      		break;
      }
?>