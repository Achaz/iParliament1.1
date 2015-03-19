<?php
    include_once("../db/db_core.php");
	
	$type = $_POST['ty'];
	$data = array();
	$table1 = "parliament_group_assignments";
    $table2 = "parliament_topic_assignments";
    $table3 = "parliament_invitation_assignments";
    $table4 = "parliament_users";
	
	$query = "SELECT * FROM $table4";
	$result = db_select2_1($query);
	

	switch ($type) {
      	case 'group':
      	    $i = 0;
			if(mysqli_num_rows($result) > 0){
				while($r = mysqli_fetch_array($result)){
			  	    if(!findID($table1, $r['id'])){
                      $data[$i] = $r['fname']. " ". $r['lname'];
					  $i++;
			  	    }			    	
			    }
				echo json_encode($data);
			}else{}
      		break;

      	case 'topic':
      	    $i = 0;
			if(mysqli_num_rows($result) > 0){
				while($r = mysqli_fetch_array($result)){			  	    
			    	if(!findID($table2, $r['id'])){
                      $data[$i] = $r['fname']. " ". $r['lname'];
					  $i++;
			  	    }
			    }
				echo json_encode($data);
			}else{}
      		break;

      	case 'inv':
      	    $i = 0;
			if(mysqli_num_rows($result) > 0){
				while($r = mysqli_fetch_array($result)){			  	    
			    	if(!findID($table3, $r['id'])){
                      $data[$i] = $r['fname']. " ". $r['lname'];
					  $i++;
			  	    }
			    }
				echo json_encode($data);
			}else{}
      		break;	
      	default:      		
			$i = 0;
			if(mysqli_num_rows($result) > 0){
				while($r = mysqli_fetch_array($result)){
			  	    
			    	$data[$i] = $r['fname']. " ". $r['lname'];
					$i++;
			    }
				echo json_encode($data);
			}else{}
      		break;
      }



      function findID($table, $id){
         $query = "SELECT * FROM $table WHERE user_id = $id";
         $result = db_select2_1($query);
         if(mysqli_num_rows($result) > 0){
				return true;
		 }else{
				return false;
		 }

      }

	
?>