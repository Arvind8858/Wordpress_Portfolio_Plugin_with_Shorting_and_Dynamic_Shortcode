<?php  
require_once('../../../wp-load.php');
$id=$_POST["id"];
global $wpdb;



 ?>

<!-- Bootstrap Core CSS -->
    
        <div class="section">
	    	<div class="container">
	    		<div class="row">

	    			<!-- Product Image & Available Colors -->
	    			<div class="col-sm-6">
	    			<div class="product-image-large">
	    				<?php  
$resultsimg = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'listing_featured_image' ;");
foreach($resultsimg as $resultimg){
?>
	    					<img src="<?php echo $resultimg->meta_value ?>" alt="<?php echo $resultimg->meta_value ?>">
	    					<?php  
break; 
	    				} ?>
	    				</div>
	    				
	    			</div>
	    			<!-- End Product Image & Available Colors -->
	    			<!-- Product Summary & Options -->
	    			<div class="col-sm-6 product-details">
<?php  
$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'listing_title' ;");
foreach($results as $result){
?>
	    				<h2><?php echo $result->meta_value ?></h2>
	    				<?php  
break; 
	    				} ?>
						<h3>Description</h3>
						<?php 
$results1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'listing_description' ;");
foreach($results1 as $result1){
						?>
	    				<p style="text-align:justify;">
						  <?php echo $result1->meta_value ?>	    				
						</p>
						<?php 
break; 
						} ?>						
						<h3>Details</h3>
						<?php 
$results2 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'inventor_reviews_post_total_rating' ;");
foreach($results2 as $result2){
						?>
						<p><strong>Ratings: </strong><?php echo $result2->meta_value ?></p>
						<?php 
break; 
						} ?>
						<?php 
$results3 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'inventor_statistics_post_total_views' ;");
foreach($results3 as $result3){
						?>	
						<p><strong>Views: </strong><?php echo $result3->meta_value ?></p>
						<?php 
break; 
						} ?>
						<?php 
$results4 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'listing_phone' ;");
foreach($results4 as $result4){
						?>
						<p><strong>Phone: </strong><?php echo $result4->meta_value ?></p>
						<?php 
break; 
						} ?>
						<?php 
$results7 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'listing_email' ;");
foreach($results7 as $result7){
						?>
						<p><strong>Email: </strong><?php echo $result7->meta_value ?></p>
						<?php 
break; 
						} ?>
						<?php 
$results5 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'listing_listing_category' ;");
foreach($results5 as $result5){
						?>
						<p><strong>Ctegory: </strong><?php echo $result5->meta_value ?></p>
						<?php 
break; 
						} ?>
						<?php 
$results6 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'listing_locations' ;");
foreach($results6 as $result6){
						?>
						<p><strong>Location: </strong><?php echo $result6->meta_value ?></p>
						<?php 
break; 
						} ?>
	    			</div>
	    			<!-- End Product Summary & Options -->

	    			
	    		</div>
			</div>
		</div>
		<ul class="pager" style="clear: both;">
		<li><a id="back">Back</a></li>
		</ul>	

