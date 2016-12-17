<?php  
require_once('../../../wp-load.php');
global $wpdb;
$typeshort = $_POST['typeshort'];
$categoryshort = $_POST['categoryshort'];
$page = (!isset($_POST['page']))? 1 : $_POST['page']; 
$prev = ($page - 1);
$next = ($page + 1);
$max_results = 12;
$from = (($page * $max_results) - $max_results) ;
$result_page = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts a INNER JOIN ".$wpdb->prefix."postmeta b ON a.ID = b.post_id WHERE a.post_status = 'publish' and a.comment_status = 'open' and b.meta_key = 'listing_listing_category' and b.meta_value like '%".$typeshort."%' and b.meta_value like '%".$categoryshort."%' GROUP BY b.post_id;");
$total_results = $wpdb->num_rows;
//echo $total_results;
$total_pages = ceil($total_results / $max_results);
$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts a INNER JOIN ".$wpdb->prefix."postmeta b ON a.ID = b.post_id WHERE a.post_status = 'publish' and a.comment_status = 'open' and b.meta_key = 'listing_listing_category' and b.meta_value like '%".$typeshort."%' and b.meta_value like '%".$categoryshort."%' GROUP BY b.post_id LIMIT $from, $max_results ;");
foreach($results as $result){
$id= $result->ID;
  ?>
			  <div class="col-md-4 col-sm-6">	
           	<figure>
			    <div class="text-lable">
				    <center><span><strong><?php echo $result->post_title ?> </strong></span></center>
				    </div>
				              
                   <?php if (has_post_thumbnail( $id ) ): 
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' ); 

                            /*$results4 = $wpdb->get_results("SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'listing_featured_image' ;");
                            foreach($results4 as $result4){*/
                     ?>
				                    <a id="detail" href="<?php echo esc_url( get_permalink($id) ); ?>"><img src="http://blog.caranddriver.com/wp-content/uploads/2015/11/BMW-2-series.jpg" class="img-responsive"></a>
				            <?php //break;  } 
                 //echo $image[0]; 
                   endif; ?>

						                <figcaption>
						                <center><h3><?php echo $result->post_type ?></h3></center>
						       <?php  
                            $results1 = $wpdb->get_results("SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'listing_locations' ;");
                            foreach($results1 as $result1){
                            $location_array = unserialize($result1->meta_value);
                            for ($i=0; $i < count(next($location_array)); $i++){

  			           ?>
							             <span style="float:left;padding-left:20px;">Location : </span><span style="float:right;padding-right:20px;"><?php echo current($location_array) ?> </span><br>
							     <?php 
                           next($location_array);
						            } 
                           reset($location_array);
                           break;
                        }
							             $results2 = $wpdb->get_results("SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'inventor_reviews_post_total_rating';");
                            foreach($results2 as $result2){
						      ?>
							             <span style="float:left;padding-left:20px;">Rating : </span><span style="float:right;padding-right:20px;"><?php echo $result2->meta_value ?> </span><br>
							    <?php break; 
						            } 
                            $results3 = $wpdb->get_results("SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'inventor_statistics_post_total_views';");
                            foreach($results3 as $result3){
						      ?>
							              <span style="float:left;padding-left:20px;">Views : </span><span style="float:right;padding-right:20px;"><?php echo $result3->meta_value ?> </span>
							    <?php break; } ?>
								
							
						</figcaption>
					</figure>
	        	</div>   
              <?php	        
                   }
?>
                            </ul>
              				<ul class="pager" style="clear: both;">
             <?php  
                  if($page > 1)
                    {
             ?>
                            <li><a id="page" value="<?php echo $prev; ?>">Previous</a></li>
            <?php
                    }
                  for($i = $page + 1; $i <= min($page + 11, $total_pages); $i++)
                    {
                  if(($page) == $i)
                    {
                    }
                  else
                    {
    	   ?>
                            <li><a id="page" data-value="<?php echo $i; ?>"><?php echo $i; ?></a></li>

           <?php
                    }
                    }
                  if($page < $total_pages)
                    {
	       ?>
                            <li><a id="page" value="<?php echo $next; ?>">Next</a></li>

           <?php
                    }

           ?>
			  
				</ul>	
	        		
	        	
	        	
			