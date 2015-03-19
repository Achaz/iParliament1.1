<?php

	include("../db/db_core.php");
    $type = $_POST['ty'];
	$table1 = "parliament_groups";
    $table2 = "parliament_invitations";
    $table3 = "parliament_topics";
	$table4 = "parliament_users";
    $query = "";
	$result;
	
	switch($type){
		case 'group':
			$groupname = $_POST['gn'];
			$id = $_POST['id'];	
						
			$query = "UPDATE $table1 SET name = '$groupname' WHERE id = $id";
			$result = db_query($query);
		
			if($result){
		       $response["success"] = 1;
		       $response["message"] = "GROUP EDITTED";
		
		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "GROUP NOT EDITTED";
		
		    	echo json_encode($response);
			}
			break;
		case 'inv':
			$inv_title = $_POST['it'];
			$inv_venue = $_POST['iv'];
			$inv_date = $_POST['idt'];
			$inv_time = $_POST['itme'];
			$inv_message = $_POST['im'];
			$inv_message2 = $_POST['im2'];
			$id = $_POST['id'];	
			
			$query = "UPDATE $table2 SET title = '$inv_title', date = '$inv_date', time = '$inv_time', venue = '$inv_venue', message = '$inv_message', detail_message = '$inv_message2' WHERE id = $id";
			$result = db_query($query);
		
			if($result){
		       $response["success"] = 1;
		       $response["message"] = "INVITATION EDITTED";
		
		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "INVITATION NOT EDITTED";
		
		    	echo json_encode($response);
			}
			break;
		case 'topic':
			$topictitle = $_POST['tt'];
			$id = $_POST['id'];	
						
			$query = "UPDATE $table3 SET topic = '$topictitle' WHERE id = $id";
			$result = db_query($query);
		
			if($result){
		       $response["success"] = 1;
		       $response["message"] = "TOPIC EDITTED";
		
		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "TOPIC NOT EDITTED";
		
		    	echo json_encode($response);
			}
			break;	
		case 'user':
			$firstname = $_POST['f'];
		    $lastname = $_POST['l'];
			$username = $_POST['u'];
			$password = $_POST['p'];
			$email = $_POST['e'];
			$phone = $_POST['pn'];
			$utype = $_POST['tp'];
			$id = $_POST['id'];	
		 
			$query = "UPDATE $table4 SET fname = '$firstname', lname = '$lastname', email = '$email', password = md5('$password'), username = '$username', phone = '$phone', user_type = '$utype' WHERE id = $id";
			$result = db_query($query);
		 	
			if($result){
		       $response["success"] = 1;
		       $response["message"] = "USER EDITTED";
		
		    	echo json_encode($response);
				
			}else{
			   $response["success"] = 0;
		       $response["message"] = "USER NOT EDITTED";
		
		    	echo json_encode($response);
			}
			break;			
		
	}
	
?>