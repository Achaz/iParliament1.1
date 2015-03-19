<?php
    include_once("../db/db_core.php");

    $type = $_POST['ty'];
	$table1 = "parliament_groups";
    $table2 = "parliament_topics";
    $table3 = "parliament_invitations";
	$data = array();
	
	switch ($type) {
      	case 'group':
      	$query = "SELECT * FROM $table1";
	    $result = db_select2_1($query);
	    $i = 0;
	    if(mysqli_num_rows($result) > 0){
			while($r = mysqli_fetch_array($result)){
		  	    
		    	$data[$i] = $r['name'];
				$i++;
		    }
			echo json_encode($data);
	    }else{}
      		break;

      	case 'topic':
      	$query = "SELECT * FROM $table2";
	    $result = db_select2_1($query);
	    $i = 0;
	    if(mysqli_num_rows($result) > 0){
			while($r = mysqli_fetch_array($result)){
		  	    
		    	$data[$i] = $r['topic'];
				$i++;
		    }
			echo json_encode($data);
	    }else{}
      		break;

      	case 'inv':
      	$query = "SELECT * FROM $table3";
	    $result = db_select2_1($query);
	    $i = 0;
	    if(mysqli_num_rows($result) > 0){
			while($r = mysqli_fetch_array($result)){
		  	    
		    	$data[$i] = $r['title'];
				$i++;
		    }
			echo json_encode($data);
	    }else{}
      		break;	
      	default:
      		# code...
      		break;
      }

	
?>