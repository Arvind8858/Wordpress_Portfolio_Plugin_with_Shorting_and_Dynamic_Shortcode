jQuery(document).ready(function($){
 
function fetch_data(){
  //alert(typeshort);
   jQuery.ajax({
			type:"POST",
  url: plugins_url+"/EduGorilla_Portfolio/grids.php",
  data:{typeshort:typeshort,categoryshort:categoryshort},
  success:function(data){
  $('#live-data').html(data);
  },
  error: function(errorThrown){
   alert("this is error" +errorThrown);
  }   
 });
 }
			fetch_data();
function show_data(text){
	jQuery.ajax({
		url:plugins_url+"/EduGorilla_Portfolio/filter_keyword.php",
		method:"POST",				
		data:{text:text,typeshort:typeshort,categoryshort:categoryshort},
		
		success:function(data){
			$('#live-data').html(data);
		}

});

}

jQuery(document).on('keyup','#keyword', function(){
	var keyword= $('#keyword').val();
	var location= $('#location').val();
	var category= $('#category').val();
	if(keyword != "" && location == "" && category == ""){
	show_data(keyword);
    }
    else{
      fetch_data();
    }
});
/*
jQuery(document).on('keydown','#keyword', function(){
  var keyword= $('#keyword').val();
  var location= $('#location').val();
  var category= $('#category').val();
  if(keyword != "" && location == "" && category == ""){
  show_data(keyword);
    }
    else{
      fetch_data();
    }
});
*/
jQuery(document).on('click', '#btn_submit', function(){  
	var keyword= $('#keyword').val();
	var location= $('#location').val();
	if(keyword != "" || location != "" ){
      jQuery.ajax({  
                 url:plugins_url+"/EduGorilla_Portfolio/filter.php", 
                 method:"POST",  
                 data:{keyword:keyword,location:location,typeshort:typeshort,categoryshort:categoryshort},  
                 dataType:"text",  
                 success:function(data){  
                     $('#live-data').html(data); 
                 }  
            });  
            } 

            if(keyword == "" && location == "" ){
              fetch_data();
    }
       
  }); 
  
  jQuery(document).on('click', 'a#page', function(){  
	var page= $(this).data("value");
	jQuery.ajax({
			type:"POST",
  url: plugins_url+"/EduGorilla_Portfolio/grids.php",
  data:{page:page,typeshort:typeshort,categoryshort:categoryshort},
  success:function(data){
  $('#live-data').html(data);
  },
  error: function(errorThrown){
   alert("this is error" +errorThrown);
  }   
 });
       
  });  

  jQuery(document).on('click', 'a#page1', function(){  
	var page= $(this).data("value");
	var text= $('#text').val();
	jQuery.ajax({
			type:"POST",
  url: plugins_url+"/EduGorilla_Portfolio/filter_keyword.php",
  data:{page:page,text:text,typeshort:typeshort,categoryshort:categoryshort},
  success:function(data){
  $('#live-data').html(data);
  },
  error: function(errorThrown){
   alert("this is error" +errorThrown);
  }   
 });
       
  });  

  jQuery(document).on('click', 'a#page2', function(){  
	var page= $(this).data("value");
	var keyword= $('#keyword').val();
	var location= $('#location').val();
	var catagory= $('#catagory').val();
	jQuery.ajax({
			type:"POST",
  url: plugins_url+"/EduGorilla_Portfolio/filter.php",
  data:{page:page,keyword:keyword,location:location,catagory:catagory,typeshort:typeshort,categoryshort:categoryshort},
  success:function(data){
  $('#live-data').html(data);
  },
  error: function(errorThrown){
   alert("this is error" +errorThrown);
  }   
 });
       
  });  

  /*jQuery(document).on('click', 'a#detail', function(){  
  var id= $(this).data("value");
   jQuery.ajax({
      type:"POST",
  url: plugins_url+"/EduGorilla_Portfolio/single.php",
  data:{id:id,typeshort:typeshort,categoryshort:categoryshort},
  success:function(data){
  $('#live-data').html(data);
  },
  error: function(errorThrown){
   alert("this is error" +errorThrown);
  }   
 });
      
  }); */

  jQuery(document).on('click', 'a#back', function(){  
  
fetch_data();
       
  }); 
   



});
