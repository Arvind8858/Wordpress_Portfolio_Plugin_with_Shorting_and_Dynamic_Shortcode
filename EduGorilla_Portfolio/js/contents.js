jQuery(document).ready(function(){
alert("Im arvind");
function fetch_data(){
		jQuery.ajax({
			url:"<?php echo plugins_url(__FILE__);  ?>/select_grid.php",
			method:"POST",
			success:function(data){
				$('#live-grid').html(data);
			}

		});
			}
			fetch_data();


function show_data(text){

	$.ajax({
		url:"<?php echo plugins_url(__FILE__);  ?>/search_keywords.php",
		method:"POST",				
		data:{text:text},
		
		success:function(data){
			//alert(data);
			$('#live-grid').html(data);
		}

	}
	);

}


jQuery(document).on('keyup','#keyword', function(){
	var keyword=$(this).text();
	show_data(keyword);
	

}
);



});
