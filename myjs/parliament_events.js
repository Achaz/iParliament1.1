
var currentId;
var currentId2;
var togg = true;
$(document).ready(function(){
     
     // getFullNames()
  $('#dman').live('click', function(){
     $('#cde').css({'display':'hidden'}).fadeIn(1000);
     $('#stat').css({'display':'none'}).fadeOut(500);
     $('#dman').addClass('active');
  	 $('#stats').removeClass('active');
  });
  
  $('#stats').live('click', function(){
      $('#stat').css({'display':'hidden'}).fadeIn(1000);
      $('#cde').css({'display':'none'}).fadeOut(500);
      $('#stats').addClass('active');
  	  $('#dman').removeClass('active');
  	  $('#s_grps').click();
  });
      
  $('#create').live('click', function(){
  	 getFullNames()
  	currentId = $('#dataman_opts').children().filter(function(){
  		return $(this).attr('class') == 'active';
  	}).attr('id');
  	
  	switch(currentId){
  		case 'users':
  	        currentId = $("#pagedata").children().filter(function(){
			   	 return $(this).css('display') != 'none';
			}).attr('id')
			
			$('#'+currentId).fadeOut(600, function(){
		  		$('#'+currentId).css('display','none');
		  		
			    $('#createuser').css({'display':'hidden'}).fadeIn(1000);		
		  	});
  	  	break;
  		
  		case 'grps':
  		     currentId = $("#pagedata").children().filter(function(){
			   	 return $(this).css('display') != 'none';
		     }).attr('id')
			
			 $('#'+currentId).fadeOut(600, function(){
		  		$('#'+currentId).css('display','none');
		  		
			    $('#creategrps').css({'display':'hidden'}).fadeIn(1000);	
		  	 });
  		break;
  		
  		case 'topics':
	  		 currentId = $("#pagedata").children().filter(function(){
			   	 return $(this).css('display') != 'none';
			 }).attr('id')
			
			 $('#'+currentId).fadeOut(600, function(){
		  		$('#'+currentId).css('display','none');
		  		
			    $('#createtopics').css({'display':'hidden'}).fadeIn(1000);	
		     });
  		break;
  		
  		case 'invs':
  		     currentId = $("#pagedata").children().filter(function(){
			   	  return $(this).css('display') != 'none';
			 }).attr('id')
			
			 $('#'+currentId).fadeOut(600, function(){
		  		$('#'+currentId).css('display','none');
		  		
			    $('#createinvs').css({'display':'hidden'}).fadeIn(1000);	
		     });
  	
  		break;

  		case 'ass':
  		     currentId = $("#pagedata").children().filter(function(){
			   	  return $(this).css('display') != 'none';
			 }).attr('id')
			
			 $('#'+currentId).fadeOut(600, function(){
		  		    $('#'+currentId).css('display','none');
		  		    
			        $('#create_assignment').css({'display':'hidden'}).fadeIn(1000);	
		     });
  	
  		break;
  	}
  		
  });
  
  $('#uin').live('click', function(){
  	 $('#stat_criteria_holder').css({'display':'none'}).fadeOut(1000);
  	currentId = $('#stats_opts').children().filter(function(){
  		return $(this).attr('class') == 'active';
  	}).attr('id');
  	
  	switch(currentId){
  		
  		case 'grps':
  		     currentId = $("#pagestat").children().filter(function(){
			   	 return $(this).css('display') != 'none';
		     }).attr('id')
			
			 $('#'+currentId).fadeOut(600, function(){
		  		$('#'+currentId).css('display','none');
		  		
			    $('#group_n').css({'display':'hidden'}).fadeIn(1000);	
		  	 });
  		break;
  		
  		case 'topics':
	  		 currentId = $("#pagestat").children().filter(function(){
			   	 return $(this).css('display') != 'none';
			 }).attr('id')
			
			 $('#'+currentId).fadeOut(600, function(){
		  		$('#'+currentId).css('display','none');
		  		
			    $('#topic_n').css({'display':'hidden'}).fadeIn(1000);	
		     });
  		break;
  		
  		case 'invs':
  		     currentId = $("#pagestat").children().filter(function(){
			   	  return $(this).css('display') != 'none';
			 }).attr('id')
			
			 $('#'+currentId).fadeOut(600, function(){
		  		$('#'+currentId).css('display','none');
		  		
			    $('#invs_n').css({'display':'hidden'}).fadeIn(1000);	
		     });
  	
  		break;
  	}
  		
  });
  
  $('#view').live('click', function(){
  	currentId = $('#dataman_opts').children().filter(function(){
  		return $(this).attr('class') == 'active';
  	}).attr('id');
  	
  	
  	switch(currentId){
  		case 'users':
  		    loadTable("user", "viewusers");
  	        currentId2 = $("#pagedata").children().filter(function(){
			   	 return $(this).css('display') != 'none';
			}).attr('id')
			
			$('#'+currentId2).fadeOut(600, function(){
		  		$('#'+currentId2).css('display','none');
			       $('#viewusers').css({'display':'hidden'}).fadeIn(1000);		
		  	});
  	  	break;
  		
  		case 'grps':
  		     loadTable("group", "viewgrps");
  		     currentId2 = $("#pagedata").children().filter(function(){
			   	 return $(this).css('display') != 'none';
		     }).attr('id')
			
			 $('#'+currentId2).fadeOut(600, function(){
		  		$('#'+currentId2).css('display','none');
			        $('#viewgrps').css({'display':'hidden'}).fadeIn(1000);	
		  	 });
  		break;
  		
  		case 'topics':
  		     loadTable("topic", "viewtopics");
	  		 currentId2 = $("#pagedata").children().filter(function(){
			   	 return $(this).css('display') != 'none';
			 }).attr('id')
			
			 $('#'+currentId2).fadeOut(600, function(){
		  		$('#'+currentId2).css('display','none');
			        $('#viewtopics').css({'display':'hidden'}).fadeIn(1000);	
		     });
  		break;
  		
  		case 'invs':
  		     loadTable("inv", "viewinvs");
  		     currentId2 = $("#pagedata").children().filter(function(){
			   	  return $(this).css('display') != 'none';
			 }).attr('id')
			
			 $('#'+currentId2).fadeOut(600, function(){
		  		$('#'+currentId2).css('display','none');
			        $('#viewinvs').css({'display':'hidden'}).fadeIn(1000);	
		     });
  	
  		break;
  	}
  	
  	});
  	
  	$('#activity').live('click', function(){
  	
  	$('#stat_criteria_holder').css({'display':'hidden'}).fadeIn(1000);
  	
  	loadGraph(type, id, type) 
  	currentId = $('#stats_opts').children().filter(function(){
  		return $(this).attr('class') == 'active';
  	}).attr('id');
  	
  	
  	var id = $('#s_cri_vals').val();
  	var type = "";
  	
  	
  	     if(currentId == 's_grps'){
  	        type = "group_c";  	  
  	        loadGraph(type, id, type)      
  	     }else if(currentId == 's_topics'){
  	        type = "topic_c";  	 
  	        loadGraph(type, id, type)       
  	     }else if(currentId == 's_invs'){
  	        type = "inv_c";  
  	        loadGraph(type, id, type)	        
  	     }else{
  	          alert('Nothing to show')
  	     }
  	switch(currentId){
  		  		
  		case 's_grps':	      
		     
  		     currentId2 = $("#pagestat").children().filter(function(){
			   	 return $(this).css('display') != 'none';
		     }).attr('id')
			
			 $('#'+currentId2).fadeOut(600, function(){
		  		$('#'+currentId2).css('display','none');
			        $('#group_c').css({'display':'hidden'}).fadeIn(1000);	
		  	 });
  		break;
  		
  		case 's_topics':
  		     //loadTable("topic", "viewtopics");
	  		 currentId2 = $("#pagestat").children().filter(function(){
			   	 return $(this).css('display') != 'none';
			 }).attr('id')
			
			 $('#'+currentId2).fadeOut(600, function(){
		  		$('#'+currentId2).css('display','none');
			        $('#topic_c').css({'display':'hidden'}).fadeIn(1000);	
		     });
  		break;
  		
  		case 's_invs':
  		     //loadTable("inv", "viewinvs");
  		     currentId2 = $("#pagestat").children().filter(function(){
			   	  return $(this).css('display') != 'none';
			 }).attr('id')
			
			 $('#'+currentId2).fadeOut(600, function(){
		  		$('#'+currentId2).css('display','none');
			        $('#inv_c').css({'display':'hidden'}).fadeIn(1000);	
		     });
  	
  		break;
  	}
  	
  });
  
  $('#users').live('click', function(){
  	$('#create').click(); 
  	$('#create').addClass('active');
  	$('#view').removeClass('active');
  	$('#view').css('display','block');
  });
  
  $('#topics').live('click', function(){
  	$('#create').click();
  	$('#create').addClass('active');
  	$('#view').removeClass('active');
  	$('#view').css('display','block');
  });
  
  $('#grps').live('click', function(){
  	$('#create').click();
  	$('#create').addClass('active');
    $('#view').removeClass('active');
    $('#view').css('display','block');
  });
  
   $('#invs').live('click', function(){
  	$('#create').click();
  	$('#create').addClass('active');
  	$('#view').removeClass('active');
  	$('#view').css('display','block');
  });
 
  
  $('#ass').live('click', function(){
  	$('#create').click();
  	$('#view').css('display','none');
  });
  
  $("#gedit").live('click', function(){
  	var id = $(this).val();
		  $('#egid').val(id)
		  $('#grpedit').css({'display':'hidden'}).fadeIn(1000);  
		  $('.fancybox').fancybox();
		  $.fancybox.open({
					href : '#grpedit',
					type : 'inline',
					padding : 5,
				    openEffect : 'elastic',
					openSpeed : 150,
			
					closeEffect : 'elastic',
					closeSpeed : 150,
			
					closeClick : false,
				   helpers : {
			        overlay : null
		           }  
		  });  	   
	});
	
	$("#gdel").live('click', function(){
		var id = $(this).val(); 
		  $('#dgid').val(id)
		  $('#grpdel').css({'display':'hidden'}).fadeIn(1000);	  
		  $('.fancybox').fancybox();
		  $.fancybox.open({
					href : '#grpdel',
					type : 'inline',
					padding : 5,
				    openEffect : 'elastic',
					openSpeed : 150,
			
					closeEffect : 'elastic',
					closeSpeed : 150,
			
					closeClick : false,
				   helpers : {
			        overlay : null
		           }  
		  });  	   
	});
	
	$("#tedit").live('click', function(){
		var id = $(this).val(); 
		$('#etpid').val(id)
		
		  $('#tpedit').css({'display':'hidden'}).fadeIn(1000);  
		  $('.fancybox').fancybox();
		  $.fancybox.open({
					href : '#tpedit',
					type : 'inline',
					padding : 5,
				    openEffect : 'elastic',
					openSpeed : 150,
			
					closeEffect : 'elastic',
					closeSpeed : 150,
			
					closeClick : false,
				   helpers : {
			        overlay : null
		           }  
		  });  	   
	});
	
	$("#tdel").live('click', function(){
		var id = $(this).val(); 
		$('#dtpid').val(id)
		
		  $('#tpdel').css({'display':'hidden'}).fadeIn(1000);	  
		  $('.fancybox').fancybox();
		  $.fancybox.open({
					href : '#tpdel',
					type : 'inline',
					padding : 5,
				    openEffect : 'elastic',
					openSpeed : 150,
			
					closeEffect : 'elastic',
					closeSpeed : 150,
			
					closeClick : false,
				   helpers : {
			        overlay : null
		           }  
		  });  	   
	});
	
	$("#inedit").live('click', function(){
		var id = $(this).val(); 
		$('#einvid').val(id)
		
		  $('#invtedit').css({'display':'hidden'}).fadeIn(1000);  
		  $('.fancybox').fancybox();
		  $.fancybox.open({
					href : '#invtedit',
					type : 'inline',
					padding : 5,
				    openEffect : 'elastic',
					openSpeed : 150,
			
					closeEffect : 'elastic',
					closeSpeed : 150,
			
					closeClick : false,
				   helpers : {
			        overlay : null
		           }  
		  });  	   
	});
	
	$("#indel").live('click', function(){
		 var id = $(this).val();
		 $('#dinvid').val(id)
		  
		  $('#invtdel').css({'display':'hidden'}).fadeIn(1000);	  
		  $('.fancybox').fancybox();
		  $.fancybox.open({
					href : '#invtdel',
					type : 'inline',
					padding : 5,
				    openEffect : 'elastic',
					openSpeed : 150,
			
					closeEffect : 'elastic',
					closeSpeed : 150,
			
					closeClick : false,
				   helpers : {
			        overlay : null
		           }  
		  });  	   
	});
	
	$("#uedit").live('click', function(){
		var id = $(this).val(); 
		$('#eusrid').val(id)
		
		  $('#usredit').css({'display':'hidden'}).fadeIn(1000);  
		  $('.fancybox').fancybox();
		  $.fancybox.open({
					href : '#usredit',
					type : 'inline',
					padding : 5,
				    openEffect : 'elastic',
					openSpeed : 150,
			
					closeEffect : 'elastic',
					closeSpeed : 150,
			
					closeClick : false,
				   helpers : {
			        overlay : null
		           }  
		  });  	   
	});
	
	$("#ass_all").live('click', function(){
	   $(this).attr('checked', togg)
	   $(this).parents('table').find('input:checkbox').each(function(){
	   	     $(this).attr('checked', togg);
	   })
	   togg = !togg;
	});
	
	$("#udel").live('click', function(){
		
		var id = $(this).val(); 
		$('#dusrid').val(id)
		
		  $('#usrdel').css({'display':'hidden'}).fadeIn(1000);	  
		  $('.fancybox').fancybox();
		  $.fancybox.open({
					href : '#usrdel',
					type : 'inline',
					padding : 5,
				    openEffect : 'elastic',
					openSpeed : 150,
			
					closeEffect : 'elastic',
					closeSpeed : 150,
			
					closeClick : false,
				   helpers : {
			        overlay : null
		           }  
		  });  	   
	});
  
  	
})

function refresh(){
  getFullNames()	
}

function getFullNames(){
	
	$.get('php/fetchers/getfullnames_suggests.php', null, function(data){
		var res = JSON.stringify(data);
		
		      //alert(res)
		
		$('#add_grp_members').autocomplete({
			source : data
		});
		
		$('#add_topic_members').autocomplete({
			source : data
		});
		
	}, 'json');
	
}


