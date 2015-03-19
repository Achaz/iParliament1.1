<?php
      include("../db/db_core.php");

      $type = $_POST['ty'];
	  $idname = $_POST['idn'];
      $table1 = "parliament_groups";
      $table2 = "parliament_topics";
      $table3 = "parliament_invitations";
      $view_opts = "";
      $query = "";
      
      switch ($type) {
      	case 'group':
			$view_opts = "Choose Group<br/><select name = '$idname' id = '$idname'>";
      	    $query = "SELECT * FROM $table1";
      		$res1 = db_select2_1($query);
                  
      		if(mysqli_num_rows($res1) > 0){
				while($r = mysqli_fetch_array($res1)){		  	    
			    	$view_opts .= "<option value = '".$r['id']."'>".$r['name']."</option>";					
			    }
	             $view_opts .= "</select>";
	        }else{}

      		echo $view_opts;
      		break;

      	case 'topic':
			$view_opts = "Choose Topic<br/><select name = '$idname' id = '$idname'>";
            $query = "SELECT * FROM $table2";
      		$res2 = db_select2_1($query);
                  
      		if(mysqli_num_rows($res2) > 0){
				while($r = mysqli_fetch_array($res2)){		  	    
			    	$view_opts .= "<option value = '".$r['id']."'>".$r['topic']."</option>";
					
			    }
	             $view_opts .= "</select>";
	        }else{}

      		echo $view_opts;
      		break;

      	case 'inv': 
			$view_opts = "Choose Invitation<br/><select name = '$idname' id = '$idname'>";     		
      		$query = "SELECT * FROM $table3";
      		$res3 = db_select2_1($query);
                  
      		if(mysqli_num_rows($res3) > 0){
				while($r = mysqli_fetch_array($res3)){		  	    
			    	$view_opts .= "<option value = '".$r['id']."'>".$r['title']."</option>";
				
			    }
	             $view_opts .= "</select>";
	        }else{}

            echo $view_opts;
      		break;
      }

?>