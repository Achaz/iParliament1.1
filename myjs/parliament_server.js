
$(document).ready(function(){

  checkSession()
  loadTables()
 $(".btn").live('click', function(e){
	   e.preventDefault();
	   var id = $(this).attr('id');
	   
	   switch(id){
	      	case 'loginbtn':
	      	   var username = $(this).parents('form').find('input[name="username"]').val();
	      	   var userpass = $(this).parents('form').find('input[name="password"]').val();
	      	   
	      	   
	      	   $.post('php/auth1.0/authenticate.php', {u:username, p:userpass}, function(data){
	      	   	var resString = JSON.stringify(data);
	      	   	var resParse = JSON.parse(resString);
	      	   	var check = resParse.success; 
	      	   	
	      	   	
	      	   	if(check == 1){	      	   		
	      	   		
	      	   		$(function() {
						    $.session.set("username", username);
					});
					checkSession()
					//SUCCESS
					$('#login').fadeOut(600, function(){
				  		$('#login').css('display','none');
				  		$('#maindashboard').css('display','hidden');
				  		$('#header').css({'display':'hidden'}).fadeIn(400, function(){
					  		$('#ccenter').css({'display':'hidden'}).fadeIn(700, function(){
					     		$('#cde').css({'display':'hidden'}).fadeIn(1000);	
					  		});	
				  		});	
				  	});
						
	      	   	}else{
	      	   	    alert(resParse.message)	      	   		 
	      	   	}
	      	   	
	      	   }, 'json');
	      	   
	      	break;  
	      	
	      	
	      	case 'createusr_btn':
	      	  // alert("Add user");
	      	   var fname = $(this).parents('form').find('input[name="add_firstname"]').val();
	      	   var lname = $(this).parents('form').find('input[name="add_lastname"]').val();
	      	   var uname = $(this).parents('form').find('input[name="add_username"]').val();
	      	   var pass = $(this).parents('form').find('input[name="add_userpass"]').val();
	      	   var pass2 = $(this).parents('form').find('input[name="add_userpass2"]').val();
	      	   var email = $(this).parents('form').find('input[name="add_useremail"]').val();
	      	   var phone = $(this).parents('form').find('input[name="add_userphone"]').val();
	      	   var utype = $(this).parents('form').find('select[name="add_usertype"]').val();
	      	   
	      	 
	      	   if(pass == pass2){
	      	   	  if(fname == "" || lname == "" || uname == "" || pass == "" || email == "" || phone == "" || utype == ""){
	      	   	  	 alert('fill in all the fields')
	      	   	  	
	      	   	  }else{
	      	   	  	$.post('php/cmdcenter/createuser.php', {f:fname, l:lname, u:uname, p:pass, e:email, pn:phone, tp:utype}, function(data){
				      	    
				      	   	var resString = JSON.stringify(data);
				      	   	var resParse = JSON.parse(resString);
				      	   	var check = resParse.success; 
				      	   					      	   
				      	   	if(check == 1){
				      	   		alert(resParse.message);	      	   	                 						     		
				      	   	}else{
				      	   		 	
	      	   	                 alert(resParse.message);
				      	   	}
				      	   	 				      	   	
				   }, 'json');
	      	   	  }
	      	   }else{
	      	   	 alert('Password Mismatch');
	      	   }
	
	      	break; 
	      	
	      	
	      	case 'creategrp_btn':
	      		var gname = $(this).parents('form').find('input[name="add_grpname"]').val();
	      	    var gmembers = $(this).parents('form').find('input[name="add_grp_members"]').val();
	      	
	      		
	      		$.post('php/cmdcenter/creategroup.php', {gn:gname, gm:gmembers }, function(data){

	      			var resString = JSON.stringify(data);
	      			var resParse = JSON.parse(resString);
	      			var check = resParse.success;

					if(check == 1){
				    	alert(resParse.message);	      	   	                 						     		
				    }else{
				        alert(resParse.message);
				    }

	      		}, 'json' );
				      	   	
	      	break;
	      	
	      	case 'ass_btn':
	      	   var ids = [];
	      	   $('#assignees').find('input:checked').each(function(){
	      	      ids.push($(this).val())	      	      	      	      	
	      	   });
	      	   var id = $('#ass_vals').val();
	      	   var type = $('#ass_type').val();
	      	   //alert(type+"\n"+id)
	      	    for(var i = 0; i<ids.length; i++){
	      	   	   $.post('php/cmdcenter/assigner.php', {ty:type, asid:id, atid:ids[i] }, function(data){
	      	    	 var resString = JSON.stringify(data);
	      			 var resParse = JSON.parse(resString);
	      			 var check = resParse.success;
 
					 if(check == 1){
				    	//alert(resParse.message);	      	   	                 						     		
				     }else{
				         alert(resParse.message);
				     }
	      	      }, 'json' );
	      	    }
	      	break;
	      	
	      	case 'createtopic_btn':
	      		var ttitle = $(this).parents('form').find('input[name="add_topic_title"]').val();
	      	    var tmembers = $(this).parents('form').find('input[name="add_topic_members"]').val();
	      	    
	      	    $.post('php/cmdcenter/createtopic.php', {tt:ttitle, tm:tmembers }, function(data){
	      	    	var resString = JSON.stringify(data);
	      			var resParse = JSON.parse(resString);
	      			var check = resParse.success;

					if(check == 1){
				    	alert(resParse.message);	      	   	                 						     		
				    }else{
				        alert(resParse.message);
				    }
	      	    }, 'json' );
	      	
	      	break;
	      	
	      	case 'createinv_btn':
	      		var inv_title = $(this).parents('form').find('input[name="add_inv_title"]').val();
	      	    var inv_venue = $(this).parents('form').find('input[name="add_inv_venue"]').val();
	      	    var inv_date = $(this).parents('form').find('input[name="add_inv_date"]').val();
	      	    var inv_time = $(this).parents('form').find('input[name="add_inv_time"]').val();
	      	    var inv_message = $(this).parents('form').find('textarea[name="add_inv_message"]').val();
	      	    var inv_message2 = $(this).parents('form').find('textarea[name="add_inv_message2"]').val();
	      	   
	      	    $.post('php/cmdcenter/createinv.php', {it:inv_title, iv:inv_venue, id:inv_date, itme:inv_time, im:inv_message, im2:inv_message2}, function(data){
	      	    	var resString = JSON.stringify(data);
	      			var resParse = JSON.parse(resString);
	      			var check = resParse.success;

					if(check == 1){
				    	alert(resParse.message);	      	   	                 						     		
				    }else{
				        alert(resParse.message);
				    }
	      	    }, 'json' );
	      		
	      	
	      	break;
	      	
	      	//###########################################################################
	      	
	      	case 'editusr_btn':
	      	  // alert("Add user");
	      	   var id = $(this).parents('form').find('input[name="eusrid"]').val();
	      	   var fname = $(this).parents('form').find('input[name="edit_firstname"]').val();
	      	   var lname = $(this).parents('form').find('input[name="edit_lastname"]').val();
	      	   var uname = $(this).parents('form').find('input[name="edit_username"]').val();
	      	   var pass = $(this).parents('form').find('input[name="edit_userpass"]').val();
	      	   var pass2 = $(this).parents('form').find('input[name="edit_userpass2"]').val();
	      	   var email = $(this).parents('form').find('input[name="edit_useremail"]').val();
	      	   var phone = $(this).parents('form').find('input[name="edit_userphone"]').val();
	      	   var utype = $(this).parents('form').find('select[name="edit_usertype"]').val();
	      	   
	      	   if(pass == pass2){
	      	   	  if(fname == "" || lname == "" || uname == "" || pass == "" || email == "" || phone == "" || utype == ""){
	      	   	  	 alert('fill in all the fields')
	      	   	  	
	      	   	  }else{
	      	   	  	$.post('php/cmdcenter/editor.php', {ty:'user', id:id, f:fname, l:lname, u:uname, p:pass, e:email, pn:phone, tp:utype}, function(data){
				      	    
				      	   	var resString = JSON.stringify(data);
				      	   	var resParse = JSON.parse(resString);
				      	   	var check = resParse.success; 
				      	   					      	   
				      	   	if(check == 1){
				      	   		//alert(resParse.message);	      	   	                 						     		
				      	   	}else{
				      	   		 	
	      	   	                 alert(resParse.message);
				      	   	}
				      	   	 				      	   	
				   }, 'json');
	      	   	  }
	      	   }else{
	      	   	 alert('Password Mismatch');
	      	   }
	      	   
	      	   $.fancybox.close();
	           loadTables()
	      	break; 
	      	
	      	
	      	case 'ge_btn':
	      		var gname = $(this).parents('form').find('input[name="egname"]').val();
	      	    var id = $(this).parents('form').find('input[name="egid"]').val();
	      	
	      		
	      		$.post('php/cmdcenter/editor.php', {ty:'group', id:id, gn:gname}, function(data){

	      			var resString = JSON.stringify(data);
	      			var resParse = JSON.parse(resString);
	      			var check = resParse.success;

					if(check == 1){
				    	//alert(resParse.message);	      	   	                 						     		
				    }else{
				        alert(resParse.message);
				    }

	      		}, 'json' );
	      		
	      		$.fancybox.close();
				loadTables()      	   	
	      	break;
	      	
	      	
	      	case 'te_btn':
	      		var ttitle = $(this).parents('form').find('input[name="etpname"]').val();
	      	    var id = $(this).parents('form').find('input[name="etpid"]').val();
	      	    $.post('php/cmdcenter/editor.php', {ty:'topic', id:id, tt:ttitle }, function(data){
	      	    	var resString = JSON.stringify(data);
	      			var resParse = JSON.parse(resString);
	      			var check = resParse.success;

					if(check == 1){
				    	//alert(resParse.message);	      	   	                 						     		
				    }else{
				        alert(resParse.message);
				    }
	      	    }, 'json' );
	      	    
	      	    $.fancybox.close();
	      	    loadTables()
	      	break;
	      	
	      	case 'editinv_btn':
	      	    var id = $(this).parents('form').find('input[name="einvid"]').val();
	      		var inv_title = $(this).parents('form').find('input[name="edit_inv_title"]').val();
	      	    var inv_venue = $(this).parents('form').find('input[name="edit_inv_venue"]').val();
	      	    var inv_date = $(this).parents('form').find('input[name="edit_inv_date"]').val();
	      	    var inv_time = $(this).parents('form').find('input[name="edit_inv_time"]').val();
	      	    var inv_message = $(this).parents('form').find('textarea[name="edit_inv_message"]').val();
	      	    var inv_message2 = $(this).parents('form').find('textarea[name="edit_inv_message2"]').val();
	      	 
	      	    $.post('php/cmdcenter/editor.php', {ty:'inv', id:id, it:inv_title, iv:inv_venue, idt:inv_date, itme:inv_time, im:inv_message, im2:inv_message2}, function(data){
	      	    	var resString = JSON.stringify(data);
	      			var resParse = JSON.parse(resString);
	      			var check = resParse.success;

					if(check == 1){
				    	//alert(resParse.message);	      	   	                 						     		
				    }else{
				        alert(resParse.message);
				    }
	      	    }, 'json' );
	      		
	      		$.fancybox.close();
	      	    loadTables()
	      	break;
	      	
	      	//###########################################################################
	      	
	      	case 'usry_btn':
	      	  // alert("Add user");
	      	   var id = $(this).parents('form').find('input[name="dusrid"]').val();
	      	   
	      	   	  	$.post('php/cmdcenter/deletor.php', {ty:'user', id:id}, function(data){
				      	    
				      	   	var resString = JSON.stringify(data);
				      	   	var resParse = JSON.parse(resString);
				      	   	var check = resParse.success; 
				      	   					      	   
				      	   	if(check == 1){
				      	   		//alert(resParse.message);	      	   	                 						     		
				      	   	}else{
				      	   		 	
	      	   	                 alert(resParse.message);
				      	   	}
				      	   	 				      	   	
				   }, 'json');	      	   
	      	   
	      	   $.fancybox.close();
	           loadTables()
	      	break; 
	      	
	      	case 'usrn_btn':
	      	    $.fancybox.close();
	      	break;
	      	
	      	case 'gdn_btn':
	      	  $.fancybox.close();
	      	break;
	      	
	      	case 'gdy_btn':
	      	    var id = $(this).parents('form').find('input[name="dgid"]').val();	      	
	      		
	      		$.post('php/cmdcenter/deletor.php', {ty:'group', id:id}, function(data){

	      			var resString = JSON.stringify(data);
	      			var resParse = JSON.parse(resString);
	      			var check = resParse.success;

					if(check == 1){
				    	//alert(resParse.message);	      	   	                 						     		
				    }else{
				        alert(resParse.message);
				    }

	      		}, 'json' );
	      		
	      		$.fancybox.close();
				loadTables()      	   	
	      	break;
	      	
	      	case 'tpn_btn':
	      	   $.fancybox.close();
	      	break;
	      	
	      	case 'tpy_btn':
	      		var id = $(this).parents('form').find('input[name="dtpid"]').val();
	      	    $.post('php/cmdcenter/deletor.php', {ty:'topic', id:id }, function(data){
	      	    	var resString = JSON.stringify(data);
	      			var resParse = JSON.parse(resString);
	      			var check = resParse.success;

					if(check == 1){
				    	//alert(resParse.message);	      	   	                 						     		
				    }else{
				        alert(resParse.message);
				    }
	      	    }, 'json' );
	      	    
	      	    $.fancybox.close();
	      	    loadTables()
	      	break;
	      	
	      	case 'inn_btn':
	      	    $.fancybox.close();
	      	    
	      	break;
	      	
	      	case 'iny_btn':
	      	    var id = $(this).parents('form').find('input[name="dinvid"]').val();
	      		
	      	    $.post('php/cmdcenter/deletor.php', {ty:'inv', id:id}, function(data){
	      	    	var resString = JSON.stringify(data);
	      			var resParse = JSON.parse(resString);
	      			var check = resParse.success;

					if(check == 1){
				    	//alert(resParse.message);	      	   	                 						     		
				    }else{
				        alert(resParse.message);
				    }
	      	    }, 'json' );
	      		
	      		$.fancybox.close();
	      	    loadTables()
	      	break;
	   
 			}
 })
 	
 	$("#ass_type").click(function(){
		  var type = $(this).val()
		  loadOption(type, "ass_vals", "ass_vals_holder")
		  var id = $('#ass_vals').val() 
		  loadAssignees(type, id, "assignees")
	});
	
	$("#s_cri_vals").live('click',function(){
		 var id = $(this).val() 
		 var type = "";
		 var id1 = $('#stats_opts').children().filter(function(){
  		   return $(this).attr('class') == 'active';
  	     }).attr('id');
  	
  	     var id2 = $('#stats_opts_x').children().filter(function(){
  		   return $(this).attr('class') == 'active';
  	     }).attr('id');
  	
  	     if(id1 == 's_grps' && id2 == 'uin'){
  	        // type = "group_n";  
  	        // loadGraph(type, id, type)	        
  	     }else if(id1 == 's_grps' && id2 == 'activity'){
  	        type = "group_c";  	  
  	        loadGraph(type, id, type)      
  	     }else if(id1 == 's_topics' && id2 == 'uin'){
  	       // type = "topic_n";  	 
  	       // loadGraph(type, id, type)       
  	     }else if(id1 == 's_topics' && id2 == 'activity'){
  	        type = "topic_c";  	 
  	        loadGraph(type, id, type)       
  	     }else if(id1 == 's_invs' && id2 == 'uin'){
  	       // type = "inv_n";  	
  	        //loadGraph(type, id, type)        
  	     }else if(id1 == 's_invs' && id2 == 'activity'){
  	        type = "inv_c";  
  	        loadGraph(type, id, type)	        
  	     }else{
  	          alert('Nothing to show')
  	     }
  	     
		 
	});	

  $('#s_topics').live('click', function(){
    loadOption("topic", "s_cri_vals", "stat_criteria_holder")
  	$('#uin').click();
  	$('#uin').addClass('active');
  	$('#activity').removeClass('active');
  	
  	$('#group_n').css('display','none');
  	$('#inv_n').css('display','none');
  	$('#inv_c').css('display','none');
  	$('#group_c').css('display','none');
  	$('#topic_c').css('display','none');
  	
  	$('#topic_n').css('display','block');
  	loadGraph('topic_n', 0, 'topic_n')
  });
  
  $('#s_grps').live('click', function(){
   loadOption("group", "s_cri_vals", "stat_criteria_holder")
  	$('#uin').click();
  	$('#uin').addClass('active');
    $('#activity').removeClass('active');
   
    $('#topic_n').css('display','none');
  	$('#inv_n').css('display','none');
  	$('#topic_c').css('display','none');
  	$('#inv_c').css('display','none');
  	$('#group_c').css('display','none');
  	
  	$('#group_n').css('display','block');
  	loadGraph('group_n', 0, 'group_n')
  });
  
  $('#s_invs').live('click', function(){
   loadOption("inv", "s_cri_vals", "stat_criteria_holder")
  	$('#uin').click();
  	$('#uin').addClass('active');
  	$('#activity').removeClass('active');
  	
  	$('#group_n').css('display','none');
  	$('#topic_n').css('display','none');
  	$('#topic_c').css('display','none');
  	$('#inv_c').css('display','none');
  	$('#group_c').css('display','none');
  	
  	$('#inv_n').css('display','block');
  	loadGraph('inv_n', 0, 'inv_n')
  });
	
	$("#ass_vals").live('click', function(){
	      //alert('Hi there')
		  var type = $('#ass_type').val()	 
		  var id = $(this).val() 
		 // alert(type+"\n"+id)
		  loadAssignees(type, id, "assignees")
	});
})

function loadTable(type, div_id){
	$.post('php/cmdcenter/getTable.php', {ty:type}, function(data){
			$("#"+div_id).html(data);	
	}, 'text');
}

function loadAssignees(type, id, div_id){
	$.post('php/cmdcenter/getAssignees.php', {ty:type, id:id}, function(data){
			$("#"+div_id).html(data);	
	}, 'text');
}

function loadOption(type, idn, div_id){
	$.post('php/cmdcenter/getOptions.php', {ty:type, idn:idn}, function(data){
			$("#"+div_id).html(data);	
	}, 'text');
}

function loadGraph(type, id, div_id){	
     //alert(type+"\n"+id+"\n"+div_id)	
	$.get('php/cmdcenter/stats.php', {ty:type, id:id}, function(data){
		
		var chart = new AmCharts.AmSerialChart();
        chart.dataProvider = data;
        chart.categoryField = "title";
        
        var graph = new AmCharts.AmGraph();
		graph.valueField = "num"
		graph.type = "column";
		graph.balloonText = "[[title]]: [[value]]";
		graph.lineAlpha = 0;
        graph.fillAlphas = 0.5;
        
		chart.angle = 60;
        chart.depth3D = 15;
		chart.addGraph(graph);
		chart.write(div_id);
	}, 'json')
}

function loadTables(){
	loadTable("topic", "viewtopics")
	loadTable("group", "viewgrps")
	loadTable("user", "viewusers")
	loadTable("inv", "viewinvs")
	loadAssignees("group", 3, "assignees")
	loadOption('group', 'ass_vals', "ass_vals_holder")
	loadOption("group", "s_cri_vals", "stat_criteria_holder")
}
function checkSession(){
	$(function() {
         var currsess = $.session.get("username");
         if(currsess != null){
         	
         	$('#login').css({ 'display':'none'});
         	$('#login').css('display','none');
	  		$('#header').css({'display':'hidden'}).fadeIn(400, function(){
		  		$('#ccenter').css({'display':'hidden'}).fadeIn(700, function(){
		     		$('#cde').css({'display':'hidden'}).fadeIn(1000);	
		  		});	
	  		});	
		    		    
         }else{
         	
         //	$('#maindashboard').css('display', 'none');	
		    $('#login').css({ 'display':'hidden'}).fadeIn(200);
		    
         }
     });
}


