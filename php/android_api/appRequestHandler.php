<?php
   include("../db/db_core.php");


/*###########################################################################################################################
  ###############################################GET APP INFO################################################################
  ###########################################################################################################################
*/

   function getMyTopics($id){
	
    $topics = array();
    $tpc = array();

	if($id < 0){

		    $response["success"] = 0;
		    $response["message"] = "incomplete request";	
		    echo json_encode($response);
			
		}else{
			$table = "parliament_topic_assignments";
		//	$query = "SELECT * FROM $table WHERE user_id = $id ORDER BY id DESC";
                        $query = "SELECT * FROM $table  ORDER BY id DESC";
			$result = db_select2_1($query);

			$i = 0;
		        if(mysqli_num_rows($result) > 0){

			  		while($r = mysqli_fetch_array($result)){
				  	    
						$name = getTopicById($r['topic_id']);
						
						$data['topic_id'] = $r['topic_id'];
						$data['topic'] = $name;

						$tpc[$i] = $data;
						$i++;
						
					}
					$topics['topics'] = $tpc;
					
			  	echo json_encode($topics);
			  }else{

			     $response["success"] = 0;
		             $response["message"] = "no topics found";	

		             echo json_encode($response);
			  }
		}	
   }
	
   function getMyGroups($id){

	$groups = array();
        $grp = array();

		if($id < 0){

		    $response["success"] = 0;
		    $response["message"] = "incomplete request";	
		    echo json_encode($response);
			
		}else{
			$table = "parliament_group_assignments";
			$query = "SELECT * FROM $table WHERE user_id = $id ORDER BY id DESC";
			$result = db_select2_1($query);

                $i = 0;
	           if(mysqli_num_rows($result) > 0){

			  		while($r = mysqli_fetch_array($result)){
				  	    
						$name = getGroupById($r['group_id']);
						
						$data['group_id'] = $r['group_id'];
						$data['group'] = $name;

						$grp[$i] = $data;
						$i++;
						
					}
					$groups['groups'] = $grp;
					
			  	echo json_encode($groups);
			  }else{
			  	$response["success"] = 0;
		        $response["message"] = "no groups found";	
		        echo json_encode($response);
			  }	
		}
			
   }
	
   function getMyMessages($id){

   	$msgvals = array();
        $msgs = array();
        $msg = array();
	
		if($id < 0){

		    $response["success"] = 0;
		    $response["message"] = "incomplete request";	
		    echo json_encode($response);
			
		}else{
			$table = "parliament_messages";
			
			$query = "SELECT * FROM $table WHERE to_id = $id OR from_id = $id ORDER BY time_stamp DESC";// ORDER BY time_stamp ASC";
			$result = db_select2_1($query);
			
			$toname = getFullNameById($id);
			
			$i = 0;
			    if(mysqli_num_rows($result) > 0){
			  		while($r = mysqli_fetch_array($result)){
				  	    
					$fromname = getFullNameById($r['from_id']);
						
				    	        $data['to'] = $toname;
						$data['from_id'] = $r['from_id'];
						$data['to_id'] = $r['to_id'];
						$data['from'] = $fromname;
						$data['message'] = $r['message'];
						$data['time'] = getDuration2($r['id'], $table);
						$data['status'] = $r['status'];

						$data['to_prof_pic'] = getProfilePic($r['to_id']);
						$data['from_prof_pic'] = getProfilePic($r['from_id']);
						
						$msgvals['msg'] = $data;
					        $msg[$i] = $msgvals;
						$i++;
						
					}

					$msgs['msgs'] = $msg;
					
			  	echo json_encode($msgs);
			  }else{

			      $response["success"] = 0;
		              $response["message"] = "no messages found";	
		              echo json_encode($response);
			  }				
		}
   }
   
   function getMyMessageThread($to_id, $from_id){

   	$msgvals = array();
        $msgs = array();
        $msg = array();
	
		if($to_id < 0 || $from_id < 0){

		    $response["success"] = 0;
		    $response["message"] = "incomplete request";	
		    echo json_encode($response);
			
		}else{

		$table = "parliament_messages_threads";
			
                $query = "SELECT * FROM $table WHERE to_id = $to_id AND from_id = $from_id OR to_id = $from_id AND from_id = $to_id ORDER BY time_stamp ASC";
		$result = db_select2_1($query);
			
		//$toname = getFullNameById($to_id);
			
		$i = 0;
	        if(mysqli_num_rows($result) > 0){

			 while($r = mysqli_fetch_array($result)){
				  	    
					$fromname = getFullNameById($r['from_id']);
						
				    	//$data['to'] = $toname;
				        $data['sender'] = $fromname;
				        $data['msg'] = $r['message'];
					$data['from_id'] = $r['from_id'];
					$data['to_id'] = $r['to_id'];
					$data['time'] = getDuration2($r['id'], $table);

					if($r['from_id'] == $to_id){

                                                $data['state'] = "o";

						}else{

						$data['state'] = "i";

						}
						

						$data['to_prof_pic'] = getProfilePic($r['to_id']);
						$data['from_prof_pic'] = getProfilePic($r['from_id']);
						
						
						$msgvals['msg'] = $data;
					        $msg[$i] = $msgvals;
						$i++;
						
					}
					$msgs['msgs'] = $msg;
					
			  	echo json_encode($msgs);
			  }else{

			  $response["success"] = 0;
		          $response["message"] = "no messages found";	

		          echo json_encode($response);
			  }				
		}
   }

   function getFullNameById($id){
   	 $table = "parliament_users";
	 $name = "";
	
	 $query = "SELECT fname, lname FROM $table WHERE id = $id";
	 $result = db_select2_1($query);
	 
		 if(mysqli_num_rows($result) > 0){

			while($r = mysqli_fetch_array($result)){
	  	    
		    	$name = $r['fname']. " ". $r['lname'];		

		    }
			return $name;

		 }else{

			$name = "John Doe";
			return $name;

		 }
   	 
   }

   function getFullNames(){

   	$name_vals = array();
   	$name = array();
   	$names = array();

   	 $table = "parliament_users";
	 $name = "";
	
	 $query = "SELECT fname, lname FROM $table";
	 $result = db_select2_1($query);
	 $i = 0;
	 
         if(mysqli_num_rows($result) > 0){

			while($r = mysqli_fetch_array($result))
                         {
 	  	    
		    	   $name_vals['name'] = $r['fname']. " ". $r['lname'];	
		    	   $name[$i] = $name_vals;	
		    	   $i++;

		        }
  
		        $names['names'] = $name;
			echo json_encode($names);

		 }else{

		    $response["success"] = 0;
		    $response["message"] = "no names found";	
		    echo json_encode($response);

		 }
	  
   }
   
   function getTopicById($id){

   	 $table = "parliament_topics";
	 $name = "";
	
	 $query = "SELECT topic FROM $table WHERE id = $id";
	 $result = db_select2_1($query);
	 
		 if(mysqli_num_rows($result) > 0){

			while($r = mysqli_fetch_array($result)){	  	    
		    	$name = $r['topic'];
		
		    }
			return $name;
		 }else{

			$name = "Topic Name";
			return $name;

		 }
   	 
   }
   

   function getGroupById($id){

   	 $table = "parliament_groups";
	 $name = "";
	
	 $query = "SELECT name FROM $table WHERE id = $id";
	 $result = db_select2_1($query);
	 
		 if(mysqli_num_rows($result) > 0){

			while($r = mysqli_fetch_array($result)){
	  	    
		    	$name = $r['name'];		
		    }
			return $name;
		 }else{
			$name = "Group Name";
			return $name;
		 }
   	 
   }

   function getInvitation($id){

	$inv_vals = array();
        $inv = "";
	
	$table = "parliament_invitations";
        $query = "SELECT * FROM $table where id = $id";
	$result = db_select2_1($query);
		
		$i = 0;
		if(mysqli_num_rows($result) > 0){

		  		while($r = mysqli_fetch_array($result)){
			  	    
			  	        $data['id'] = $r['id'];					
			    	        $data['title'] = $r['title'];
					$data['venue'] = $r['venue'];
					$data['message'] = $r['message'];
					$data['detailed_msg'] = $r['detail_message'];
					$data['date'] = $r['date'];
					$data['time'] = $r['time'];
					$data['time_to_go'] = getTimeToGo($r['id']);					
					
					$inv_vals['invitation'] = $data;
				        $inv = $inv_vals;
					$i++;
					
				}
				return $inv;
		  }else{
		  	return $inv;
		  }


   }
	
   function getMyInvitations($id){

	$inv_vals = array();
        $invs = array();
        $inv = array();
        $inv_temp = array();
	
	   if($id < 0){

		$response["success"] = 0;
		$response["message"] = "incomplete request";	
		echo json_encode($response);
			
		}else{

		    $table = "parliament_invitation_assignments";
	            $query = "SELECT * FROM $table where user_id = $id AND status = 'Unanswered' ";
	            $result = db_select2_1($query);
			
			$i = 0;
			if(mysqli_num_rows($result) > 0){

			  		while($r = mysqli_fetch_array($result)){
			  			 
				 	        $inv[$i] = getInvitation($r['invitation_id']);
						$i++;						
					}
					$invs['invitations'] = $inv;
					
			  	echo json_encode($invs);
			  }else{

			     $response["success"] = 0;
		             $response["message"] = "no invitations found";	
		             echo json_encode($response);
			  }
		}


   }

   function getMyEvents($id){

	$inv_vals = array();
        $invs = array();
        $inv = array();
        $inv_temp = array();
	
	   if($id < 0){

		$response["success"] = 0;
		$response["message"] = "incomplete request";	
		echo json_encode($response);
			
		}else{

		   $table = "parliament_invitation_attendees";
	           $query = "SELECT * FROM $table where user_id = $id";
		   $result = db_select2_1($query);
			
			$i = 0;
			if(mysqli_num_rows($result) > 0){

			  		while($r = mysqli_fetch_array($result)){
			  			 
				 	  $inv[$i] = getInvitation($r['invitation_id']);
					  $i++;						
					}
					$invs['invitations'] = $inv;
					
			  	echo json_encode($invs);
			  }else{

			  $response["success"] = 0;
		          $response["message"] = "no events to attend found";	
		          echo json_encode($response);
			  }
		}


   }

 
function getTimeToGo($inv_id){
   	$table = "parliament_invitations";
   	$query = "SELECT * FROM $table WHERE id = $inv_id ";
	$result = db_select2_1($query);
	date_default_timezone_set('Africa/Kampala');
	
	$date1 = date('Y-m-d H:i:s');
	
	if(mysqli_num_rows($result) > 0){

		while($r = mysqli_fetch_array($result)){

			$date = $r['date'];
			$time = $r['time'];
			$event_time = $date ." ". $time;
			$time_two = new DateTime($event_time);
		}
		
		
		$time_one = new DateTime($date1);
		$difference = $time_one->diff($time_two);
		
		
		$duration_arr = explode(" ", $difference->format('%y-%m-%d %h:%i:%s'));
		
		
		$time_str = $duration_arr[1];
		$date_str = $duration_arr[0];
		
		$date_str = explode("-", $date_str);
		
		if($date_str[0] == 0){
			
			if($date_str[1] == 0){
				
				if($date_str[2] == 0){
					
					$time_str = explode(":", $time_str);
					
					if($time_str[0] == 0){
					
						if($time_str[1] == 0){
								
							if($time_str[2] == 0){
								
								return "just now";
							}elseif($time_str[2] == 1){
								return $time_str[2]. " sec to go";
							}elseif($time_str[2] > 1){
								return $time_str[2] . " secs to go";
							}	
							
						}elseif($time_str[1] == 1){
							return $time_str[1]." min to go";
						}elseif($time_str[1] > 1){
							return $time_str[1]." mins to go";
						}
							
						
						
					}elseif($time_str[0] == 1){
						return $time_str[0]." hour to go";
					}elseif($time_str[0] > 1){
						return $time_str[0] ." hours to go";
					}
					
					
				
					
				}elseif($date_str[2] == 1){
					return $date_str[2]." day to go";
				}elseif($date_str[2] > 1){
					return $date_str[2] . " days to go";
				}
				
				
			}elseif($date_str[1] == 1){
				return "1 month to go";
			}elseif($date_str[1] > 1){
				return $date_str[1] ." months to go";
			}
			
			
		}elseif($date_str[0] == 1){
			
			return "1 year to go";
			
		}elseif($date_str[0] > 1){
			
			return $date_str[0]." years to go";
			
		}
		
    }
  }

   function getDuration($id, $table){
   	
   	//$table = "parliament_post_mirror";
   	$query = "SELECT time FROM $table WHERE id = $id";
   	$result = db_select2_1($query);
   	$date = date('H:i:s');

   	if(mysqli_num_rows($result) > 0){

   		while($r = mysqli_fetch_array($result)){

   			$curr_time = strtotime($date);
   			$post_time = strtotime($r['time']);
   	
   			//$duration = $curr_time - $post_time;
   		}

	   	$duration = $curr_time - $post_time;
   		$interval = gmdate("H:i:s", $duration);
   		$interval_arr = explode(":", $interval);

   		if($interval_arr[0] > 0){
   			
   			if($interval_arr[0] == 1){
   				
   			 	return $interval_arr[0] ." hour ago";
   			
   			}elseif ($interval_arr[0] < 23) {
   				
   			 	return $interval_arr[0] ." hours ago";
   			
   			}else{
   				
   				$days = ($interval_arr[0] / 24);

   				if($days == 1){

   					return $day ." day ago";

   				}elseif($days < 30){

   					return $day ." days ago";

   				}else{

   					$months = ($days / 30);

   					if($months == 1){

   						return $months ." month ago";

   					}else{

   						return $months . " months ago";

   					}

   				}
   			}
   			
   		}
   		elseif ($interval_arr[1] > 0) {

   			if($interval_arr[1] == 1){

   				return $interval_arr[1]. " min ago";

   			}else{

   				return $interval_arr[1]. " mins ago";
   			}
   			
   		}else{

   			if($interval_arr[2] < 1){

   				return "just now";
   			
   			}elseif ($interval_arr[2] == 1) {
   				
   				return $interval_arr[2]. " sec ago";
   			
   			}else{
   				
   				return $interval_arr[2]. " secs ago";
   			}
   			
   		}

   	}

   }
	


function getDuration2($id, $table){
   	
	$query = "SELECT * FROM $table WHERE id = $id ";
	$result = db_select2_1($query);
	date_default_timezone_set('Africa/Kampala');
	
	$date = date('Y-m-d H:i:s');
	
	if(mysqli_num_rows($result) > 0){
		
		while($r = mysqli_fetch_array($result)){
			
			$time_one = new DateTime($r['time_stamp']);
   		
		}
		
		
		$time_two = new DateTime($date);
		$difference = $time_one->diff($time_two);
		
		
		$duration_arr = explode(" ", $difference->format('%y-%m-%d %h:%i:%s'));
		
		
		$time_str = $duration_arr[1];
		$date_str = $duration_arr[0];
		
		$date_str = explode("-", $date_str);
		
		if($date_str[0] == 0){
			
			if($date_str[1] == 0){
				
				if($date_str[2] == 0){
					
					$time_str = explode(":", $time_str);
					
					if($time_str[0] == 0){
					
						if($time_str[1] == 0){
								
							if($time_str[2] == 0){
								
								return "just now";
							}elseif($time_str[2] == 1){
								return $time_str[2]. " sec ago";
							}elseif($time_str[2] > 1){
								return $time_str[2] . " secs ago";
							}	
							
						}elseif($time_str[1] == 1){
							return $time_str[1]." min ago";
						}elseif($time_str[1] > 1){
							return $time_str[1]." mins ago";
						}
							
						
						
					}elseif($time_str[0] == 1){
						return $time_str[0]." hour ago";
					}elseif($time_str[0] > 1){
						return $time_str[0] ." hours ago";
					}
					
					
				
					
				}elseif($date_str[2] == 1){
					return $date_str[2]." day ago";
				}elseif($date_str[2] > 1){
					return $date_str[2] . " days ago";
				}
				
				
			}elseif($date_str[1] == 1){
				return "1 month ago";
			}elseif($date_str[1] > 1){
				return $date_str[1] ." months ago";
			}
			
			
		}elseif($date_str[0] == 1){
			
			return "1 year ago";
			
		}elseif($date_str[0] > 1){
			
			return $date_str[0]." years ago";
			
		}
	}
	
   }


   function getActiveFeed(){
   	$postvals = array();
    $posts = array();
    $post = array();
	
	    $table = "parliament_post_mirror";
		
		$query = "SELECT * FROM $table limit 200";
		$query2 = "SELECT a.id, a.poster_name, a.user_id, a.post_type, a.post_id, a.post, a.time_stamp, b.tup, c.tdown FROM parliament_db.parliament_post_mirror as a LEFT JOIN ( SELECT post_id,count(thumbs_up) as tup FROM parliament_db.parliament_post_mirror WHERE thumbs_up = 1 GROUP BY post_id ) as b ON a.post_id = b.post_id LEFT JOIN ( SELECT post_id,count(thumbs_down) as tdown FROM parliament_db.parliament_post_mirror WHERE thumbs_down = 1 GROUP BY post_id ) as c ON a.post_id = c.post_id WHERE a.post_type = 'feedpost' GROUP BY a.post_id ORDER BY a.time_stamp DESC";
		$result = db_select2_1($query2);
		
		$i = 0;
		    if(mysqli_num_rows($result) > 0){

		  		while($r = mysqli_fetch_array($result)){
			  	    
					//$sender = getFullNameById($r['user_id']);
					
					$data['id'] = $r['id'];
					$data['post_id'] = $r['post_id'];
			    	        $data['sender'] =  $r['poster_name'];
					$data['postmsg'] = $r['post'];

					if($r['tup'] == null){

					    $data['good'] = "0";	
					}else{

				    	$data['good'] = $r['tup'];	
					}

					if($r['tdown'] == null){
				    	$data['bad'] = "0";	
				    }else{
			    		$data['bad'] = $r['tdown'];
		    		}			
					
					$data['time'] = getDuration2($r['id'], $table);
					$data['image'] = getPostPic( $r['user_id'],  $r['post_id'],  $r['post_type']);
					$data['prof_pic'] = getProfilePic($r['user_id']);
					
					
					$postvals['post'] = $data;
				    $post[$i] = $postvals;
					$i++;
					
				}
				$posts['posts'] = $post;
				
		  	echo json_encode($posts);
		  }else{
		  	$response["success"] = 0;
	        $response["message"] = "no feeds found";	
	        echo json_encode($response);
		  }				
   }
	
   function getComments($comment_type, $id){
		switch($comment_type){
		   	 case 'group':
		   	    echo json_encode(getGroupComments($id));
		   	 break;
		   	 
		   	 case 'topic':
                echo json_encode(getTopicComments($id));
		   	 break;

		   	 case 'feed':
                echo json_encode(getFeedComments($id));
		   	 break;
        }
   }

   function getTopicComments($id){
     
   	$topic_vals = array();
    $topic =  array();
    $topics =  array();
	

   	$table = "parliament_post_mirror";

   	$query = "SELECT * FROM $table where topic_id = $id";
   	$query2 = "SELECT a.id, a.poster_name, a.other_id, a.user_id, a.post_type, a.post_id, a.post, a.time_stamp,  b.tup, c.tdown FROM $table as a 
   	           LEFT JOIN ( SELECT post_id,count(thumbs_up) as tup FROM parliament_db.parliament_post_mirror WHERE thumbs_up = 1 GROUP BY post_id ) as b ON a.post_id = b.post_id 
   	           LEFT JOIN ( SELECT post_id,count(thumbs_down) as tdown FROM parliament_db.parliament_post_mirror WHERE thumbs_down = 1 GROUP BY post_id ) as c ON a.post_id = c.post_id
   	           WHERE a.post_type = 'topicpost' AND a.other_id = $id GROUP BY a.post_id ORDER BY a.time_stamp DESC";
    $result = db_select2_1($query2);

   	$i = 0;
		if(mysqli_num_rows($result) > 0){
		  		while($r = mysqli_fetch_array($result)){
		  			
			  	        $data['id'] = $r['id'];
			  	        $data['post_id'] = $r['post_id'];
			    	        $data['name'] =  $r['poster_name'];
					$data['post'] = $r['post'];

					if($r['tup'] == null){

					    $data['good'] = "0";
	
					}else{

				    	$data['good'] = $r['tup'];
	
					}

					if($r['tdown'] == null){

				    	$data['bad'] = "0";
	
				    }else{

			    		$data['bad'] = $r['tdown'];
		    		}			
					
					$data['time'] = getDuration2($r['id'], $table);
					$data['image'] = getPostPic( $r['user_id'],  $r['post_id'],  $r['post_type']);
					$data['prof_pic'] = getProfilePic($r['user_id']);			
					
					$topic_vals['comment'] = $data;
				        $topic[$i] = $topic_vals;
					$i++;
					
				}

				$topics['comments'] = $topic;
				return $topics;
		  }else{
		  	return $topics;
		  }

   }

    function getGroupComments($id){
      
   	$group_vals = array();
        $group =  array();
        $groups =  array();
	

   	$table = "parliament_post_mirror";

   	$query = "SELECT * FROM $table where group_id = $id";
   	$query2 = "SELECT a.id, a.poster_name, a.other_id, a.post_id, a.user_id, a.post_type, a.post, a.time_stamp,  b.tup, c.tdown FROM $table as a 
   	           LEFT JOIN ( SELECT post_id,count(thumbs_up) as tup FROM parliament_db.parliament_post_mirror WHERE thumbs_up = 1 GROUP BY post_id ) as b ON a.post_id = b.post_id 
   	           LEFT JOIN ( SELECT post_id,count(thumbs_down) as tdown FROM parliament_db.parliament_post_mirror WHERE thumbs_down = 1 GROUP BY post_id ) as c ON a.post_id = c.post_id 
   	           WHERE a.post_type = 'grouppost' AND a.other_id = $id GROUP BY a.post_id ORDER BY a.time_stamp DESC";
    $result = db_select2_1($query2);

   	$i = 0;
		if(mysqli_num_rows($result) > 0){
		  		while($r = mysqli_fetch_array($result)){
		  			
			  	    $data['id'] = $r['id'];
			  	    $data['post_id'] = $r['post_id'];
			    	$data['name'] =  $r['poster_name'];
					$data['post'] = $r['post'];
					if($r['tup'] == null){
					    $data['good'] = "0";	
					}else{
				    	$data['good'] = $r['tup'];	
					}

					if($r['tdown'] == null){
				    	$data['bad'] = "0";	
				    }else{
			    		$data['bad'] = $r['tdown'];
		    		}			
					
					$data['time'] = getDuration2($r['id'], $table);
					$data['image'] = getPostPic( $r['user_id'],  $r['post_id'],  $r['post_type']);
					$data['prof_pic'] = getProfilePic($r['user_id']);			
					
					$group_vals['comment'] = $data;
				    $group[$i] = $group_vals;
					$i++;
					
				}

				$groups['comments'] = $group;
				return $groups;
		  }else{
		  	return $groups;
		  }
   }

   function getFeedComments($id){

    $feed_com_vals = array();
    $feed_com =  array();
    $feed_coms =  array();
	

   	$table = "parliament_posts_comments";

   	$query = "SELECT * FROM $table where post_id = $id ORDER BY time_stamp ASC";
   	$result = db_select2_1($query);

   	$i = 0;
		if(mysqli_num_rows($result) > 0){
		  		while($r = mysqli_fetch_array($result)){
		  			
			  	    $data['id'] = $r['id'];					
			    	$data['name'] = getFullNameById($r['user_id']);
					$data['post'] = $r['comment'];	
					$data['time'] = getDuration($r['id'], $table);
					$data['prof_pic'] = getProfilePic($r['user_id']);					
					$feed_com_vals['comment'] = $data;
				    $feed_com[$i] = $feed_com_vals;
					$i++;
					
				}

				$feed_coms['comments'] = $feed_com;
				return $feed_coms;
		  }else{
		  	return $feed_coms;
		  }
   }
  
   function getProfilePic($user_id){

   	    $image = "";
      	    $table = "parliament_profile_images";
      	    $query = "SELECT * FROM $table WHERE user_id = $user_id";

      	    $result = db_select2_1($query);


      	if($result){

      		if(mysqli_num_rows($result) > 0){

		  		while($r = mysqli_fetch_array($result)){

		  			$image = $r['image'];	

		  		}
		  	}else{
			    $image = null;
		    }
		}else{
			$image = null;
		}
		 return $image;
   }


   function getPostPic($user_id, $post_id, $post_type){
   	    $image = "";
      	$table = "parliament_post_images";
      	$query = "SELECT * FROM $table WHERE user_id = $user_id AND post_id = $post_id AND post_type = '$post_type' ";

      	$result = db_select2_1($query);


      	if($result){
      		if(mysqli_num_rows($result) > 0){
		  		while($r = mysqli_fetch_array($result)){
		  			$image = $r['image'];	
		  		}
		  	}else{
			    $image = null;
		    }
		}else{
			$image = null;
		}
		 return $image;
   }

   function auth($username, $password){
   	
		if($username == null || $password == null){

			$response["success"] = 0;
		        $response["message"] = "incomplete request";
	
		        echo json_encode($response);

		}else{
			$table = "parliament_users";
			
			$query = "SELECT * FROM $table where username = '$username' and password = md5('$password')";
			$result = db_select($query, $table);
			
			if(count($result) > 0)
                        {				
				$response["success"] = 1;
		    	        $response["message"] = "VALID USER";
				$response["auth_id"] = $result[0][0];
				$response["uname"] = $result[0][1]." ".$result[0][2];
	
		    	        echo json_encode($response);

			}else{

                          $table ="parliament_users";

                          $query ="insert into $table(fname,lname,email,password,username,phone,user_type)values('$username','','tech@smsmedia.info','$password','$username','256793964720','Admin')";
			   $response["success"] = 1;
		           $response["message"] = "USER REGISTERED";
	
		    	echo json_encode($response);
			}		
		}
	
   }

/*###########################################################################################################################
###############################################SET APP INFO##################################################################
#############################################################################################################################*/
function post($post_type, $user_id, $other_id, $post, $image ){
		date_default_timezone_set('Africa/Kampala');
	
		$date1 = date('Y-m-d H:i:s');
	
		switch($post_type){
			
			
			case 'feedpost':
				$table = "parliament_posts";
				$table2 = "parliament_post_mirror";
				
				$query = "INSERT INTO $table VALUES(0, $user_id,'$post')";
				$result = db_query_intid($query);

				$post_id = $result;
				$pname = getFullNameById($user_id);
				
	
                
				$query2 = "INSERT INTO $table2 VALUES(0, $user_id, $post_id , 0, 0, 'feedpost', '$post', '$pname', 0 , '$date1' )";
				$result2 = db_query($query2);

				if(strlen($image) > 1){
					setPostPic($user_id, $post_id, $post_type, $image);
				}
				
				if($result > 0){
			       if($result2){
				       $response["success"] = 1;
				       $response["message"] = "post successfully added";
				       
				    	echo json_encode($response);
						
					}else{
					   $response["success"] = 0;
				       $response["message"] = "post not added";
				
				    	echo json_encode($response);
					}
					
				}else{
				   $response["success"] = 0;
			       $response["message"] = "post not added";
			
			    	echo json_encode($response);
				}
	
				break;
				
				
			case 'grouppost':				
				$table = "parliament_group_posts";
				$table2 = "parliament_post_mirror";
				
				$query = "INSERT INTO $table VALUES(0, $other_id, $user_id,'$post')";
				$result = db_query_intid($query);
				
				$post_id = $result;
				$pname = getFullNameById($user_id);
				$date = date('H:i:s');

                $query2 = "INSERT INTO $table2 VALUES(0, $user_id, $post_id , 0, 0, 'grouppost', '$post', '$pname', $other_id, '$date1')";
				$result2 = db_query($query2);

				if(strlen($image) > 1){
					setPostPic($user_id,$post_id, $post_type, $image);
				}
				

				if($result > 0 ){
			       if($result2){
				       $response["success"] = 1;
				       $response["message"] = "post successfully added";
				
				    	echo json_encode($response);
						
					}else{
					   $response["success"] = 0;
				       $response["message"] = "post not added";
				
				    	echo json_encode($response);
					}
					
				}else{
				   $response["success"] = 0;
			       $response["message"] = "post not added";
			
			    	echo json_encode($response);
				}
				
				break;
				
				
			case 'topicpost':				
				$table = "parliament_topic_posts";
				$table2 = "parliament_post_mirror";
				
				$query = "INSERT INTO $table VALUES(0, $other_id, $user_id,'$post')";
				$result = db_query_intid($query);
				
				$post_id = $result;
				$pname = getFullNameById($user_id);
				$date = date('H:i:s');

                $query2 = "INSERT INTO $table2 VALUES(0, $user_id, $post_id , 0, 0, 'topicpost', '$post', '$pname', $other_id, '$date1 ' )";
				$result2 = db_query($query2);

				if(strlen($image) > 1){
					setPostPic($user_id,$post_id, $post_type, $image);
				}
				

				if($result > 0){

	                          if($result2){
				       $response["success"] = 1;
				       $response["message"] = "post successfully added";
				
				    	echo json_encode($response);
						
					}else{

					   $response["success"] = 0;
				           $response["message"] = "post not added";
				
				    	   echo json_encode($response);
					}
					
				}else{

				   $response["success"] = 0;
			           $response["message"] = "post not added";
			
			    	   echo json_encode($response);
				}
				
				break;
		}
		
}

function settings($user_id, $status, $public, $private, $mygrpmemz, $followers){

	$table = "parliament_settings";
	$query = "INSERT INTO $table VALUES(0,$user_id,'$status','$public','$private','$followers',$mygrpmemz','')";
		
	$result = db_query($query);

	if($result){

		$response["success"] = 1;
		$response["message"] = "settings have been successfully saved";
			
		echo json_encode($response);
					
	}else{
		$response["success"] = 0;
		$response["message"] = "settings not saved";
			
		echo json_encode($response);
	}
}	

function sendmsg($to, $from_id, $msg){
		$to_id = getNameID($to);
		
		$table = "parliament_messages";
		$table2 = "parliament_messages_threads";
		$date = date('H:i:s');
		date_default_timezone_set('Africa/Kampala');
	
		$date1 = date('Y-m-d H:i:s');
	

		$query = "SELECT * FROM $table WHERE to_id = $from_id AND from_id = $to_id OR to_id = $to_id AND from_id = $from_id";

		$query2 = "INSERT INTO $table VALUES(0, $to_id, $from_id, '$msg', '$date', 'u' , '$date1' )";

		$query3 = "UPDATE $table SET to_id = $to_id , from_id = $from_id, message = '$msg', time = '$date', status ='u', time_stamp ='$date1'
					WHERE to_id = $from_id AND from_id = $to_id OR to_id = $to_id AND from_id = $from_id";

		$query4 = "INSERT INTO $table2 VALUES(0, $to_id, $from_id, '$msg', '$date', 'u' , '$date1' )";

		$result = db_select2_1($query);
		$result4 = db_query($query4);

		if(mysqli_num_rows($result) > 0){
			$result3 = db_query($query3);
		}else{
			$result2 = db_query($query2);
		}
				
				if($result2 || $result3){			      
				       
					       if($result4){
						       $response["success"] = 1;
						       $response["message"] = "message sent";
						
						    	echo json_encode($response);
							
						   }else{
							   $response["success"] = 0;
						       $response["message"] = "message sending failed";
						
						    	echo json_encode($response);
						   }
										
				}else{
				   $response["success"] = 0;
			       $response["message"] = "message sending failed";
			
			    	echo json_encode($response);
				}
		
}

function setProfilePic($userid, $image){
     $table = "parliament_profile_images";
     $query = "UPDATE $table SET image = '$image' WHERE user_id = $userid";
		
     $result = db_query($query);
				
			if($result){

			       $response["success"] = 1;
			       $response["message"] = "image saved";
			
			       echo json_encode($response);
					
				}else{

				 $response["success"] = 0;
			         $response["message"] = "image not saved";
			
			    	echo json_encode($response);
				}
		
}

function setPostPic($user_id, $post_id, $post_type, $image){
     $table = "parliament_post_images";
     $query = "INSERT INTO $table VALUES(0, $user_id , $post_id , '$post_type' , '$image' )";
		
		$result = db_query($query);
				
				if($result){
			       $response["success"] = 1;
			       $response["message"] = "post image saved";
			
			    	echo json_encode($response);
					
				}else{
				   $response["success"] = 0;
			       $response["message"] = "post image not saved";
			
			    	echo json_encode($response);
				}
		
}


function setMyEvent($userid, $invid , $status){
  $table1 = "parliament_invitation_attendees";
  $table2 = "parliament_invitation_assignments";
  $query1 = "INSERT INTO $table1 VALUES(0, $userid, $invid, '')";
  $query2 = "UPDATE $table2 SET status = '$status' WHERE user_id = $userid AND invitation_id = $invid";
  $result2 = db_query($query2);

  if($result2){


  	switch ($status) {
  	case 'Going':
  		$result1 = db_query($query1);

  		if($result1){
  			$response["success"] = 1;
			$response["message"] = "event successfully scheduled";
			
			echo json_encode($response);
  		}else{
  			$response["success"] = 0;
			$response["message"] = "event not scheduled";
			
			echo json_encode($response);
  		}
  		break;
  	
  	case 'NotGoing':
  		# code...
  		break;
  }
	
  }else{
  	$response["success"] = 0;
	$response["message"] = "event not scheduled";
			
	echo json_encode($response);
  }

}  

function repmsg($to_id, $from_id, $msg){
		//$to_id = getNameID($to);
		
		$table = "parliament_messages";
		$table2 = "parliament_messages_threads";
		$date = date('H:i:s');
	date_default_timezone_set('Africa/Kampala');
	
	$date1 = date('Y-m-d H:i:s');
	
        
        $query = "UPDATE $table SET to_id = $to_id , from_id = $from_id, message = '$msg', time = '$date', status ='u', time_stamp ='$date1' 
					WHERE to_id = $from_id AND from_id = $to_id OR to_id = $to_id AND from_id = $from_id";

		$query2 = "INSERT INTO $table2 VALUES(0, $to_id, $from_id, '$msg', '$date', 'u' ,'$date1' )";

		$result = db_select2_1($query);
		$result2 = db_query($query2);

				
				if($result){	      
				       
					       if($result2){
						       $response["success"] = 1;
						       $response["message"] = "message sent";
						
						    	echo json_encode($response);
							
						   }else{
							   $response["success"] = 0;
						       $response["message"] = "message sending failed";
						
						    	echo json_encode($response);
						   }
										
				}else{
				   $response["success"] = 0;
			       $response["message"] = "message sending failed";
			
			    	echo json_encode($response);
				}
		
}

function getNameID($name){
	$id = "";
	$names = array();
	$names = explode(' ', $name);
	$fname = $names[0];
	$lname = $names[1];
	
	$table = "parliament_users";
	$query = "SELECT id FROM $table WHERE fname = '$fname' AND lname = '$lname' ";
	$result = db_select2_1($query);
	
	if(mysqli_num_rows($result) > 0){
		while($r = mysqli_fetch_array($result)){	  	    
	    	$id = $r['id'];		
	    }
		return $id;
	 }else{
		return 0;
	 }
	}

	function comment($post_id , $user_id , $comment){
		$table = "parliament_posts_comments";
		$date = date('H:i:s');
		
		$query = "INSERT INTO $table VALUES(0, $post_id, $user_id,'$comment', 0, 0, NOW() )";
		$result = db_query($query);
		
		if($result){
			$response["success"] = 1;
			$response["message"] = "you have commented";
			
			echo json_encode($response);
					
		}else{
			$response["success"] = 0;
			$response["message"] = "comment failed";
			
			echo json_encode($response);
		}	
	}
    
    function getPostById($id, $type){
        $post = "";
		switch($type){
			
			case 'feedpost':
				$table= "parliament_posts";
				$query = "SELECT * FROM $table WHERE id = $id ";
				$result = db_select2_1($query);
				
				if(mysqli_num_rows($result) > 0){
					while($r = mysqli_fetch_array($result)){	  	    
				    	$post = $r['post'];		
				    }
					return $post;
			 	}else{
			 		$post = "Post does not exist";
					return $post;
			 	}
				break;
				
			case 'grouppost':
				$table= "parliament_group_posts";
				$query = "SELECT * FROM $table WHERE id = $id ";
				$result = db_select2_1($query);
			
				if(mysqli_num_rows($result) > 0){
					while($r = mysqli_fetch_array($result)){	  	    
				    	$post = $r['post'];		
				    }
					return $post;
			 	}else{
			 		$post = "Post does not exist";
					return $post;
			 	}
				
				break;
				
			case 'topicpost':
				$table= "parliament_topic_posts";
				$query = "SELECT * FROM $table WHERE id = $id ";
				$result = db_select2_1($query);
			
				if(mysqli_num_rows($result) > 0){
					while($r = mysqli_fetch_array($result)){	  	    
				    	$post = $r['post'];		
				    }
					return $post;
			 	}else{
			 		$post = "Post does not exist";
					return $post;
			 	}
				
				break; 
		}
    }

    function getOtherId($id, $type){
       switch($type){
			case 'topicpost':
				$table= "parliament_topic_posts";
				$query = "SELECT * FROM $table WHERE id = $id ";
				$result = db_select2_1($query);
				
				if(mysqli_num_rows($result) > 0){
					while($r = mysqli_fetch_array($result)){	  	    
				    	$topic_id = $r['topic_id'];		
				    }
					return $topic_id;
			 	}else{
			 		$topic_id = NULL;
					return $topic_id;
			 	}
				break;
				
			case 'grouppost':
				$table= "parliament_group_posts";
				$query = "SELECT * FROM $table WHERE id = $id ";
				$result = db_select2_1($query);
				
				if(mysqli_num_rows($result) > 0){
					while($r = mysqli_fetch_array($result)){	  	    
				    	$group_id = $r['group_id'];		
				    }
					return $group_id;
			 	}else{
			 		$group_id = NULL;
					return $group_id;
			 	}

				break;			
		}
    }

    function findVoterById($user_id , $post_id, $post_type){
		$table = "parliament_post_mirror";
        $query = "SELECT * FROM $table WHERE user_id = $user_id AND post_id = $post_id AND post_type = '$post_type'";
        $result = db_select2_1($query);
		
		if(mysqli_num_rows($result) > 0){
			return 1;
		 }else{
			return 0;
		 }

	}

	function getPostTime($post_id , $user_id, $post_type){
    	$table = "parliament_post_mirror";
    	$query = "SELECT time FROM $table WHERE post_id = $post_id AND user_id = $user_id AND post_type = '$post_type' ";
		$post_time = "";
    	$result = db_select2_1($query);

    	if(mysqli_num_rows($result) > 0){
			while($r = mysqli_fetch_array($result)){	  	    
				$post_time = $r['time_stamp'];		
			}

		}
		return $post_time;	

    }

    function handleVoting($user_id , $post_id , $vote_type , $post_type){

          if(findVoterById($user_id, $post_id , $post_type) == 1){
               postVoting($user_id, $post_id, $vote_type, $post_type);
          }else if(findVoterById($user_id, $post_id , $post_type) == 0){
               postVotingInsert($user_id , $post_id , $vote_type , $post_type);
          }else{

          }
    }
    
    
    function postVotingInsert($user_id , $post_id , $vote_type , $post_type){
      	$vote_num_up = "";
      	$vote_num_d = "";
        $table1 = "parliament_post_mirror";
        $pname = getFullNameById($user_id);
        $post = getPostById($post_id , $post_type);
        $post_time = getPostTime($post_id , $user_id, $post_type);
		 
		switch($vote_type) {
		  	case 'tup':
                   switch ($post_type) {
                   	case 'feedpost':
                  	    $query = "INSERT INTO $table1 VALUES(0, $user_id, $post_id , 1, 0, 'feedpost', '$post', '$pname', 0, '$post_time' )";
					    $result = db_query($query);
					    
					    $query2 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2);

					    $query3 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
								echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED IN ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED IN";
								
							echo json_encode($response);
						}
				 		break;

				 	case 'grouppost':
				 	    $other_id = getOtherId($post_id, "grouppost");
				 	    //$query = "INSERT INTO $table1 VALUES(0, $user_id, $post_id , 1, 0, 'topicpost', '$post', '$pname', 'now', $other_id)";
				 	    $query = "INSERT INTO $table1 VALUES(0, $user_id, $post_id , 1, 0, 'grouppost', '$post', '$pname', $other_id, '$post_time')";
					    $result = db_query($query);
					
					    $query2 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2);

                        $query3 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
								echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED IN ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED IN";
								
							echo json_encode($response);
						}
				 		break;

				 	case 'topicpost':
				 	    $other_id = getOtherId($post_id, "topicpost");
				 	    $query = "INSERT INTO $table1 VALUES(0, $user_id, $post_id , 1, 0, 'topicpost', '$post', '$pname', $other_id, '$post_time' )";
					    $result = db_query($query);

					    $query2 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2);
                     
                        $query3 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
								echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED IN ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED IN";
								
							echo json_encode($response);
						}

				 		break;
                   }

		  	    break;

		  	case 'tdown':
		  		switch ($post_type) {
                  	case 'feedpost':
         		        $query = "INSERT INTO $table1 VALUES(0, $user_id, $post_id , 0, 1, 'feedpost', '$post', '$pname', 0 , '$post_time')";
		 			    $result = db_query($query);
					
					    $query2 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2); 

                        $query3 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
								echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED IN ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED IN";
								
							echo json_encode($response);
						}	
				 		break;

				 	case 'grouppost':
				 	    $other_id = getOtherId($post_id, "grouppost");
				 	    $query = "INSERT INTO $table1 VALUES(0, $user_id, $post_id , 0, 1, 'grouppost', '$post', '$pname', $other_id , '$post_time')";
		 			    $result = db_query($query);

					    $query2 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2);
					
						$query3 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
		 						echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED IN ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED IN";
								
							echo json_encode($response);
						}
				 		break;

				 	case 'topicpost':
				 	    $other_id = getOtherId($post_id, "topicpost");
				 	    $query = "INSERT INTO $table1 VALUES(0, $user_id, $post_id , 0, 1, 'topicpost', '$post', '$pname', $other_id ,'$post_time')";
		 			    $result = db_query($query);

					    $query2 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2);
					
						$query3 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
		 						echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED IN ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED IN";
								
							echo json_encode($response);
						}
				 		break;
                  }

		  		break;
		 }
    }

	function postVoting($user_id , $post_id , $vote_type , $post_type){
		$vote_num_up = "";	
		$vote_num_d = "";	
		$table1 = "parliament_post_mirror";
		switch($vote_type) {
			case 'tup':
			    switch ($post_type) {
			    	case 'feedpost':
				        $query = "UPDATE $table1 SET thumbs_up = 1, thumbs_down = 0 WHERE post_id = $post_id AND user_id = $user_id";
					    
					    $result = db_query($query);
					    
					    $query2 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2);

						$query3 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
								echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED UPDATE ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED UPDATE";
								
							echo json_encode($response);
						}		
			    		break;

			    	case 'grouppost':
			    		$query = "UPDATE $table1 SET thumbs_up = 1, thumbs_down = 0 WHERE post_id = $post_id AND user_id = $user_id";
					    $result = db_query($query);
					
					    $query2 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2);

						$query3 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
								echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED UPDATE ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED UPDATE";
								
							echo json_encode($response);
						}
			    		break;

			    	case 'topicpost':
			    		$query = "UPDATE $table1 SET thumbs_up = 1, thumbs_down = 0 WHERE post_id = $post_id AND user_id = $user_id";
					    $result = db_query($query);

					    $query2 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2);
					
						$query3 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
								echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED UPDATE ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED UPDATE";
								
							echo json_encode($response);
						}
			    		break;		
			    	
			    	default:
			    		# code...
			    		break;
			    }
				
				
				break;
				
			case 'tdown':
				switch ($post_type) {
			    	case 'feedpost':
				        $query = "UPDATE $table1 SET thumbs_up = 0, thumbs_down = 1 WHERE post_id = $post_id AND user_id = $user_id";
					    $result = db_query($query);
					
					    $query2 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2); 

						$query3 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
								echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED UPDATE ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTEDUPDATE";
								
							echo json_encode($response);
						}		
			    		break;

			    	case 'grouppost':
			    		$query = "UPDATE $table1 SET thumbs_up = 0, thumbs_down = 1 WHERE post_id = $post_id AND user_id = $user_id";
					    $result = db_query($query);

					    $query2 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2);
					
                        $query3 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
								echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTE UPDATE ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED UPDATE";
								
							echo json_encode($response);
						}
			    		break;

			    	case 'topicpost':
			    		$query = "UPDATE $table1 SET thumbs_up = 0, thumbs_down = 1 WHERE post_id = $post_id AND user_id = $user_id";
					    $result = db_query($query);

					    $query2 = "SELECT count(thumbs_down) as vote FROM $table1 WHERE thumbs_down = 1 AND post_id = $post_id";
					    $result2 = db_select2_1($query2);
					
						$query3 = "SELECT count(thumbs_up) as vote FROM $table1 WHERE thumbs_up = 1 AND post_id = $post_id";
					    $result3 = db_select2_1($query3);

						if($result){
							if($result2 && $result3){

							if(mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0){
								while($r = mysqli_fetch_array($result2)){	  	    
							    	$vote_num_d = $r['vote'];		
							    }

							    while($r = mysqli_fetch_array($result3)){	  	    
							    	$vote_num_up = $r['vote'];		
							    }

							}else{
								$vote_num_d = "0";
								$vote_num_up = "0";
							}

								$response["success"] = 1;
								$response["message"] = $vote_num_d."_".$vote_num_up;
								
								echo json_encode($response);
									
							}else{
								$response["success"] = 0;
								$response["message"] = "YOU HAVE NOT VOTED UPDATE ID";
									
								echo json_encode($response);
							}
								
						}else{
							$response["success"] = 0;
							$response["message"] = "YOU HAVE NOT VOTED UPDATE";
								
							echo json_encode($response);
						}
			    		break;		
			    	
			    	default:
			    		# code...
			    		break;
			    }

			    break;
			
		}
	}

?>
