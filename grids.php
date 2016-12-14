<?php  
require_once('../../../wp-load.php');
global $wpdb;
$typeshort = $_POST['typeshort'];
$categoryshort = $_POST['categoryshort'];
$page = (!isset($_POST['page']))? 1 : $_POST['page']; 
$prev = ($page - 1);
$next = ($page + 1);
$max_results = 12;
$from = (($page * $max_results) - $max_results) +1;
$result_page = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_status = 'publish' and comment_status = 'open';");
$total_results = $wpdb->num_rows;
$total_pages = ceil($total_results / $max_results);
$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_status = 'publish' and comment_status = 'open' LIMIT $from, $max_results;");
foreach($results as $result){
$id= $result->ID;

/*$resultsshort = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." ;");
foreach($resultsshort as $resultshort){
  $short= $result->meta_value;
  if($short == $type || $short == $category){*/

?>
			  <div class="col-md-4 col-sm-6">	
           	<?php echo $typeshort; ?>
				  <figure>
			    <div class="text-lable">
				    <center><span><strong><?php echo $result->post_title ?> </strong></span></center>
				    </div>
				            <?php  
                            $results4 = $wpdb->get_results("SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id = ".$id." and meta_key = 'listing_featured_image' ;");
                            foreach($results4 as $result4){
						        ?>
				                    <a id="detail" data-value="<?php  echo $id;  ?>"><img src="<?php echo $result4->meta_value ?>" alt="<?php echo $result->post_title ?>" class="img-responsive"></a>
				            <?php break;  } ?>
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
                    }//}}
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
	        		
	        	
	        	
			