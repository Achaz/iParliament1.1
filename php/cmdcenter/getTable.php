<?php
      include("../db/db_core.php");

      $type = $_POST['ty'];
      $table1 = "parliament_groups";
      $table2 = "parliament_topics";
      $table3 = "parliament_invitations";
      $table4 = "parliament_users";
      $view_table = "";
      $query = "";
      
      switch ($type) {
      	case 'group':
      	$view_table = "<table class=\"table table-striped\" ><thead><tr><th> #id </th><th> Group </th><th>Action</th></tr></thead><tbody style='height: 100px; overflow: auto'>";
      		$query = "SELECT * FROM $table1";
      		$res1 = db_select2_1($query);
                  $i = 1;
      		if(mysqli_num_rows($res1) > 0){
				while($r = mysqli_fetch_array($res1)){		  	    
			    	$view_table .= "<tr><td>$i</td><td>".$r['name']."</td><td><button class = 'btn btn-warning' id = 'gedit' value = '".$r['id']."'>Edit</button> &nbsp; <button class = 'btn btn-danger' id = 'gdel' value = '".$r['id']."'>Delete</button></tr>";
					$i++;
			    }
	             $view_table .= "</tbody></table>";
	        }else{}

      		echo $view_table;
      		break;

      	case 'topic':
      	$view_table = "<table class=\"table table-striped\" ><thead><tr><th> #id </th><th> Topic </th><th>Action</th></tr></thead><tbody style='height: 100px; overflow: auto'>";
      		
      		$query = "SELECT * FROM $table2";
      		$res2 = db_select2_1($query);
                  $i = 1;
      		if(mysqli_num_rows($res2) > 0){
				while($r = mysqli_fetch_array($res2)){		  	    
			    	$view_table .= "<tr><td>$i</td><td>".$r['topic']."</td><td><button class = 'btn btn-warning' id = 'tedit' value = '".$r['id']."'>Edit</button> &nbsp; <button class = 'btn btn-danger' id = 'tdel' value = '".$r['id']."'>Delete</button></tr>";
					$i++;
			    }
	             $view_table .= "</tbody></table>";
	        }else{}

      		echo $view_table;
      		break;

      	case 'inv':
      	$view_table = "<table class=\"table table-striped\" ><thead><tr><th> #id </th><th> Event </th><th>Action</th></tr></thead><tbody style='height: 100px; overflow: auto'>";
      		
      		$query = "SELECT * FROM $table3";
      		$res3 = db_select2_1($query);
                  $i = 1;
      		if(mysqli_num_rows($res3) > 0){
				while($r = mysqli_fetch_array($res3)){		  	    
			    	$view_table .= "<tr><td>$i</td><td>".$r['title']."</td><td><button class = 'btn btn-warning' id = 'inedit' value = '".$r['id']."'>Edit</button> &nbsp; <button class = 'btn btn-danger' id = 'indel' value = '".$r['id']."'>Delete</button> </td></tr>";
				$i++;
			    }
	             $view_table .= "</tbody></table>";
	        }else{}

            echo $view_table;
      		break;

            case 'user':
            $view_table = "<table class=\"table table-striped\" ><thead><tr><th> #id </th><th> Name </th><th> Username </th><th> Email </th><th>Action</th></tr></thead><tbody style='height: 10px  ! important; overflow : scroll'>";
                  
                  $query = "SELECT * FROM $table4";
                  $res3 = db_select2_1($query);
                  $i = 1;
                  if(mysqli_num_rows($res3) > 0){
                        while($r = mysqli_fetch_array($res3)){                    
                        $view_table .= "<tr><td>$i</td><td>".$r['fname']." ".$r['lname']."</td><td>".$r['username']."</td><td>".$r['email']."</td><td><button class = 'btn btn-warning' id = 'uedit' value = '".$r['id']."'>Edit</button> &nbsp; <button class = 'btn btn-danger' id = 'udel' value = '".$r['id']."'>Delete</button> </td></tr>";
                        $i++;
                      }
                   $view_table .= "</tbody></table>";
              }else{}

            echo $view_table;
                  break; 
				  
		   case 'assu':
            $view_table = "<table class=\"table table-striped\" ><thead><tr><th> Name </th><th> Username </th><th> Email </th><th><input id = 'ass_all' type='checkbox' value = '0'/></th></tr></thead><tbody style='height: 10px  ! important; overflow : scroll'>";
                  
                  $query = "SELECT * FROM $table4";
                  $res4 = db_select2_1($query);
                  
                  if(mysqli_num_rows($res4) > 0){
                        while($r = mysqli_fetch_array($res4)){                    
                        $view_table .= "<tr><td>".$r['fname']." ".$r['lname']."</td><td>".$r['username']."</td><td>".$r['email']."</td><td><input type='checkbox' value = '".$r['id']."'/></td></tr>";
                        
                      }
                   $view_table .= "</tbody></table>";
				   
				   $view_table .= "<div style = 'margin-left: 90%;'><button class = 'btn btn-warning' id = 'ass_btn'> Assign </button> <div>";
              }else{}

            echo $view_table;
                  break;     	
      	default:
      		# code...
      		break;
      }

?>