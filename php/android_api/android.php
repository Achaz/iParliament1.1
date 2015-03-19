<?php
    include("appRequestHandler.php");
	
    $request_type = $_GET['type'];
	
	if(strlen($request_type) > 0){
	  
	   switch ($request_type) {
		  
   		   case 'mytest':

   		    $response["success"] = 0;
		    $response["message"] = findVoterById(6 , 7, "grouppost");
		    echo json_encode($response);
              
		        break;
		   
		   case 'login':

		       $uname = $_GET['username'];
		       $pass = $_GET['password'];
		       auth($uname, $pass);			   
			   break;
			  
		   case 'gtopics':

		       $userid = $_GET['id'];
		       getMyTopics($userid);
			   break;
						 
		   case 'ggroups':

		       $userid = $_GET['id'];
		       getMyGroups($userid);
			   break;
			      
		   case 'ginvs':

		       $userid = $_GET['id'];
		       getMyInvitations($userid);
			   break;

		   case 'gevents':

		       $userid = $_GET['id'];
		       getMyEvents($userid);
			   break; 

		    case 'sevent':

		      $userid = $_GET['user_id'];
		      $invid = $_GET['inv_id'];
		      $status = $_GET['status'];

	              setMyEvent($userid, $invid, $status);
			   break;      
			
		    case 'ginv':
		       $invid = $_GET['id'];
		       echo json_encode(getInvitation($invid));
			   break;

		    case 'gmsg':
		       $userid = $_GET['id'];
		       getMyMessages($userid);
			   break; 

		    case 'gmsgthrd':
		       $from_id = $_GET['from_id'];
		       $to_id = $_GET['to_id'];
		       //echo $to_id;
			   getMyMessageThread($to_id, $from_id);
			   break;      	   
		   
		   case 'gfeed':
			   getActiveFeed();
			   break;  
		   
		   case 'gsettings':
			   
			   break;

		   case 'gcomments':
			 $comment_type = $_GET['ctype'];
			 $id = $_GET['id'];
                         getComments($comment_type, $id);

			   break;   	   
		   
		   case 'ntypes':
			   getFullNames();
			   break;

		   default:
			   
			   break;
	   }	
	   
	}else{

       $request_type2 = $_POST["type"]; 
       $jsonStringRaw = $_POST["data"];
          
       $cleanedString = stripcslashes($jsonStringRaw);
       $master_array = json_decode($cleanedString, TRUE);    

		if(strlen($request_type2) > 0){

                 switch($request_type2){

          	case 'sendmsg':

          	   $to = $master_array['to'];
                   $from_id = $master_array['from_id'];
	           $msg = $master_array['message'];
	            sendmsg($to, $from_id, $msg);
			   break;

	         case 'replymsg':

          	   $to = $master_array['to'];
                   $from_id = $master_array['from_id'];
	           $msg = $master_array['message'];
	           repmsg($to, $from_id, $msg);
			   break;   

		case 'scomment':
	            $user_id = $master_array['user_id'];
                    $post_id = $master_array['post_id'];
	            $comment = $master_array['comment'];
		    comment($post_id , $user_id , $comment);
			   break;  

		case 'uploadimg':
		     $userid = $master_array['user_id'];
		     $image = $_POST["image"];
	             setProfilePic($userid, $image);
			   break; 
			       	   
		   case 'postvote':
                   $user_id = $master_array['user_id'];
                   $post_id = $master_array['post_id'];
	           $vote_num = $master_array['number'];		
	           $post_type = $master_array['post_type'];
	           $vote_type = $master_array['vote_type'];
               
               handleVoting($user_id , $post_id , $vote_type , $post_type);

		       break;

		    case 'postsmth':
	           $user_id = $master_array['user_id'];
                   $other_id = $master_array['other_id'];
	           $post = $master_array['post'];		
	           $post_type = $master_array['type'];
	           $image =  $master_array['image']; 

			    post($post_type, $user_id, $other_id, $post, $image);
			    break; 

			 case 'postimg':
			   $user_id = $master_array['user_id'];
               $other_id = $master_array['other_id'];
	           $post = $master_array['post'];		
	           $post_type = $master_array['type'];
	           $image = $_POST['image'];

			   post($post_type, $user_id, $other_id, $post, $image);
			    break;

			case 'ssettings':

			   $status = $master_array['status'];
			   $pub = $master_array['pub'];
                           $pri = $master_array['pri'];
	                   $mgm = $master_array['mgm'];		
	                   $flwrz = $master_array['flwrz'];	
	                   $user_id = $master_array['user_id'];	

	                   settings($user_id, $status, $pub, $pri, $mgm, $flwrz);

			   break;    
                }

		}else{
			$response["success"] = 0;
		    $response["message"] = "NO TYPE";
		    echo json_encode($response);
	    }
	}	
	
?>
