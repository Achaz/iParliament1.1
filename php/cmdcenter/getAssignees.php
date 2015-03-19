<?php
      include("../db/db_core.php");

      $type = $_POST['ty'];
	  $id = $_POST['id'];
      $table1 = "parliament_group_assignments";
      $table2 = "parliament_topic_assignments";
      $table3 = "parliament_invitation_assignments";
	  $table4 = "parliament_users";
      $view_table = "<table class=\"table table-striped\" ><thead><tr><th> Name </th><th> Username </th><th> Email </th><th><input id = 'ass_all' type='checkbox' value = '0'/></th></tr></thead><tbody style='height: 10px  ! important; overflow : scroll'>";
      	             
      $query = "";
      $query2 = "";
	  $res1 = "";
	  $res2 = "";
	  
      switch ($type) {
      	case 'group':			
		          $query = "SELECT
							 * 
							FROM 
							 parliament_db.parliament_users
							WHERE 
							 parliament_db.parliament_users.id 
							NOT IN (
								SELECT
								 parliament_db.parliament_users.id 
								FROM 
								 parliament_db.parliament_users, parliament_db.parliament_group_assignments
								WHERE
								 parliament_db.parliament_users.id = parliament_db.parliament_group_assignments.user_id
								 
								AND parliament_db.parliament_group_assignments.group_id = $id                                                    
							) GROUP BY parliament_db.parliament_users.id";                  
              	  $res1 = db_select2_1($query);
              	  if(mysqli_num_rows($res1) > 0){
                      while($r = mysqli_fetch_array($res1)){                    
                       $view_table .= "<tr><td>".$r['fname']." ".$r['lname']."</td><td>".$r['username']."</td><td>".$r['email']."</td><td><input type='checkbox' value = '".$r['id']."'/></td></tr>";
                    
                      }
                   $view_table .= "</tbody></table>";
				   
				   $view_table .= "<div style = 'margin-left: 90%;'><button class = 'btn btn-success' id = 'ass_btn'> Assign </button> <div>";
                  }else{
                  	
                  }
                  

            echo $view_table;
      		break;

      	case 'topic':
      	          $query = "SELECT
							 * 
							FROM 
							 parliament_db.parliament_users
							WHERE 
							 parliament_db.parliament_users.id 
							NOT IN (
								SELECT
								 parliament_db.parliament_users.id 
								FROM 
								 parliament_db.parliament_users, parliament_db.parliament_topic_assignments
								WHERE
								 parliament_db.parliament_users.id = parliament_db.parliament_topic_assignments.user_id
								 
								AND parliament_db.parliament_topic_assignments.topic_id = $id                                                    
							) GROUP BY parliament_db.parliament_users.id";	
									      
                  $res1 = db_select2_1($query);
              	  if(mysqli_num_rows($res1) > 0){
                      while($r = mysqli_fetch_array($res1)){                    
                       $view_table .= "<tr><td>".$r['fname']." ".$r['lname']."</td><td>".$r['username']."</td><td>".$r['email']."</td><td><input type='checkbox' value = '".$r['id']."'/></td></tr>";
                    
                      }
                   $view_table .= "</tbody></table>";
				   
				   $view_table .= "<div style = 'margin-left: 90%;'><button class = 'btn btn-success' id = 'ass_btn'> Assign </button> <div>";
                  }else{
                  	
                  }
                
            echo $view_table;
      		break;

      	case 'inv':      	
      		      $query = "SELECT
							 * 
							FROM 
							 parliament_db.parliament_users
							WHERE 
							 parliament_db.parliament_users.id 
							NOT IN (
								SELECT
								 parliament_db.parliament_users.id 
								FROM 
								 parliament_db.parliament_users, parliament_db.parliament_invitation_assignments
								WHERE
								 parliament_db.parliament_users.id = parliament_db.parliament_invitation_assignments.user_id
								 
								AND parliament_db.parliament_invitation_assignments.invitation_id = $id                                                    
							) GROUP BY parliament_db.parliament_users.id";
			      
                  $res1 = db_select2_1($query);
                  	  $res1 = db_select2_1($query);
                  	  if(mysqli_num_rows($res1) > 0){
                          while($r = mysqli_fetch_array($res1)){                    
                           $view_table .= "<tr><td>".$r['fname']." ".$r['lname']."</td><td>".$r['username']."</td><td>".$r['email']."</td><td><input type='checkbox' value = '".$r['id']."'/></td></tr>";
                        
                          }
	                   $view_table .= "</tbody></table>";
					   
					   $view_table .= "<div style = 'margin-left: 90%;'><button class = 'btn btn-success' id = 'ass_btn'> Invite </button> <div>";
	                  }else{
	                  	
	                  }
                 

            echo $view_table;
      		break;
				  
		   
      }

?>