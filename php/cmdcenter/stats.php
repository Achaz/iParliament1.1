<?php
include("../db/db_core.php");

      $type = $_GET['ty'];
      $id = $_GET['id'];
	  $data = array();
	  $arr = array();
      $table1 = "parliament_group_assignments";
      $table2 = "parliament_topic_assignments";
      $table3 = "parliament_invitation_assignments";	  
	  $table4 = "parliament_post_mirror";
	  $res;
      $query = "";
      
      switch ($type) {
      	case 'group_n':      	
      		$query =  "SELECT group_id, (SELECT name from parliament_db.parliament_groups where id = group_id) as name, count(user_id) as num FROM $table1 GROUP BY group_id";
      		$res = db_select2_1($query);
      		if(mysqli_num_rows($res) > 0){
      			$i = 0;
				while($r = mysqli_fetch_array($res)){
				    $data['num']	= $r['num'];
					$data['title'] = $r['name']; 
					
					$arr[$i] = $data; 	    
			    	$i++;
			    }
	             echo json_encode($arr);
	        }else{
	        	echo json_encode($arr);
	        }
			
      		break;
			
		case 'group_c':      	
      		$query =  "SELECT other_id, (SELECT name from parliament_db.parliament_groups where id = other_id) as name, count(user_id) as num FROM  $table4 WHERE other_id = $id AND post_type = 'grouppost' GROUP BY other_id";
      		$res = db_select2_1($query);
      		if(mysqli_num_rows($res) > 0){
      			$i = 0;
				while($r = mysqli_fetch_array($res)){
				    $data['num']	= $r['num'];
					$data['title'] = $r['name']; 
					
					$arr[$i] = $data; 	    
			    	$i++;
			    }
	             echo json_encode($arr);
	        }else{
	        	echo json_encode($arr);
	        }
      		break;

      	case 'topic_n':

      		$query =  "SELECT topic_id, (SELECT topic from parliament_db.parliament_topics where id = topic_id) as title, count(user_id) as num FROM   $table2 GROUP BY topic_id";
      		$res = db_select2_1($query);
      		if(mysqli_num_rows($res) > 0){
      			$i = 0;
				while($r = mysqli_fetch_array($res)){
				    $data['num']	= $r['num'];
					$data['title'] = $r['title']; 
					
					$arr[$i] = $data; 	    
			    	$i++;
			    }
	             echo json_encode($arr);
	        }else{
	        	echo json_encode($arr);
	        }
      		break;
      	
      	case 'topic_c':
      		$query =  "SELECT other_id, (SELECT topic from parliament_db.parliament_topics where id = other_id) as title, count(user_id) as num  FROM $table4 WHERE other_id = $id AND post_type = 'topicpost' GROUP BY other_id";
      		$res = db_select2_1($query);
      		if(mysqli_num_rows($res) > 0){
      			$i = 0;
				while($r = mysqli_fetch_array($res)){
				    $data['num']	= $r['num'];
					$data['title'] = $r['title'];
					
					$arr[$i] = $data; 	    
			    	$i++;
			    }
	             echo json_encode($arr);
	        }else{
	        	echo json_encode($arr);
	        }
      		break;	

      	case 'inv_n':

      		$query =  "SELECT invitation_id, (SELECT title from parliament_db.parliament_invitations where id = invitation_id) as title, count(user_id) as num   FROM $table3 WHERE status = 'Unanswered' OR status = 'NotGoing' GROUP BY invitation_id";
      		$res = db_select2_1($query);
      		if(mysqli_num_rows($res) > 0){
      			$i = 0;
				while($r = mysqli_fetch_array($res)){
				    $data['num']	= $r['num'];
					$data['title'] = $r['title']; 
					
					$arr[$i] = $data; 	    
			    	$i++;
			    }
	             echo json_encode($arr);
	        }else{
	        	echo json_encode($arr);
	        }
      		break;
      		
      	case 'inv_c':

      		$query =  "SELECT invitation_id, (SELECT title from parliament_db.parliament_invitations where id = invitation_id) as title, count(user_id) as num  FROM  $table3 WHERE status = 'Going' AND invitation_id = $id GROUP BY invitation_id";
      		$res = db_select2_1($query);
      		if(mysqli_num_rows($res) > 0){
      			$i = 0;
				while($r = mysqli_fetch_array($res)){
				    $data['num']	= $r['num'];
					$data['title'] = $r['title']; 
					
					$arr[$i] = $data; 	    
			    	$i++;
			    }
	             echo json_encode($arr);
	        }else{
	        	echo json_encode($arr);
	        }
      		break;		      
      }
?>