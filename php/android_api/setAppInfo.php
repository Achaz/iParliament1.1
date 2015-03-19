<?php
    include("../db/db_core.php");
	
	function post($post_type, $user_id, $post ){
		
		switch($post_type){
			
			case 'feedpost':
				$table = "parliament_posts";
				$query = "INSERT INTO $table VALUES(0, $user_id,'$post', 0, 0, 'now' )";
				$result = db_query($query);
				
				if($result){
			       $response["success"] = 1;
			       $response["message"] = "F POST ADDED";
			
			    	echo json_encode($response);
					
				}else{
				   $response["success"] = 0;
			       $response["message"] = "F POST NOT ADDED";
			
			    	echo json_encode($response);
				}
	
				break;
				
				
			case 'grouppost':
				$group_id = $_GET['id'];				
				$table = "parliment_group_posts";
				$query = "INSERT INTO $table VALUES(0, $group_id, $user_id,'$post', 0, 0, 'now' )";
				$result = db_query($query);
				
				if($result){
			       $response["success"] = 1;
			       $response["message"] = "G POST ADDED";
			
			    	echo json_encode($response);
					
				}else{
				   $response["success"] = 0;
			       $response["message"] = "G POST NOT ADDED";
			
			    	echo json_encode($response);
				}
				
				break;
				
				
			case 'topicpost':
				$topic_id = $_GET['id'];				
				$table = "parliment_topic_posts";
				$query = "INSERT INTO $table VALUES(0, $topic_id, $user_id,'$post', 0, 0, 'now' )";
				$result = db_query($query);
				
				if($result){
			       $response["success"] = 1;
			       $response["message"] = "T POST ADDED";
			
			    	echo json_encode($response);
					
				}else{
				   $response["success"] = 0;
			       $response["message"] = "T POST NOT ADDED";
			
			    	echo json_encode($response);
				}
				
				break;
		}
		
	}
	
	function sendmsg($to, $from, $msg){
		$to_id = getNameID($to);
		$from_id = getNameID($from);
		
		$table = "parliament_messages";
		$query = "INSERT INTO $table VALUES(0, $to_id, $from_id,'$msg', 'now', 'u' )";
		
		$result = db_query($query);
				
				if($result){
			       $response["success"] = 1;
			       $response["message"] = "MESSAGE SENT";
			
			    	echo json_encode($response);
					
				}else{
				   $response["success"] = 0;
			       $response["message"] = "MESSAGE NOT SENT";
			
			    	echo json_encode($response);
				}
		
	}
	
	function thumbsup($id){
		
	}
	
	function thumbsdown($id){
		
	}
	
	function getNameID($name){
		$id = "";
		$names = explode(' ', $name);
		$fname = $names[0];
		$lname = $names[1];
		
		$table = "Parliment_users";
		$query = "SELECT id FROM $table WHERE fname = '$fname' AND lname = '$lname' ";
		$result = db_query($query);
		
		if(mysqli_num_rows($result) > 0){
			while($r = mysqli_fetch_array($result)){	  	    
		    	$id = $r['id'];		
		    }
			return $id;
		 }else{
			return "User does not exist";
		 }
		
				
		
	}
	
?>