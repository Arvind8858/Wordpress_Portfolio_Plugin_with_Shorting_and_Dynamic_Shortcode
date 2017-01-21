<?php  
require_once('../../../wp-load.php');
require_once( ABSPATH . 'wp-admin/includes/template.php' );
$keyword=$_POST["keyword"];
$location=$_POST["location"];
$typeshort = $_POST['typeshort'];
$categoryshort = $_POST['categoryshort'];
$num_db = $_POST['num_db'];
$db_id = $_POST['db_id'];
$db_prefix= explode( ',', $db_id );
global $wpdb;
$page = (!isset($_POST['page']))? 1 : $_POST['page']; 
$prev = ($page - 1);
$next = ($page + 1);
$max_results = 12;
$from = (($page * $max_results) - $max_results) ;

for($i=0;$i<$num_db;$i++){
$result_page = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$db_prefix[$i]."_posts a INNER JOIN ".$wpdb->base_prefix.$db_prefix[$i]."_postmeta b ON a.ID = b.post_id WHERE a.post_status = 'publish' and a.comment_status = 'open' and ( a.post_title like '%".$keyword."%' or a.post_content like '%".$keyword."%' or a.post_type like '%".$keyword."%') and b.meta_value like '%".$location."%' and b.meta_value like '%".$typeshort."%' and b.meta_value like '%".$categoryshort."%' GROUP BY b.post_id;");
$total_results = $wpdb->num_rows;
$resultcount= $resultcount + $total_results;
}
//echo $resultcount;
$total_pages = ceil($resultcount / $max_results);

for($h=0;$h<$num_db;$h++){

$from = $from - $resultcount1;
$results = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$db_prefix[$h]."_posts a INNER JOIN ".$wpdb->base_prefix.$db_prefix[$h]."_postmeta b ON a.ID = b.post_id WHERE a.post_status = 'publish' and a.comment_status = 'open' and ( a.post_title like '%".$keyword."%' or a.post_content like '%".$keyword."%' or a.post_type like '%".$keyword."%') and b.meta_value like '%".$location."%' and b.meta_value like '%".$typeshort."%' and b.meta_value like '%".$categoryshort."%' GROUP BY b.post_id LIMIT $from, $max_results ;");

$result_page1 = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$db_prefix[$h]."_posts a INNER JOIN ".$wpdb->base_prefix.$db_prefix[$h]."_postmeta b ON a.ID = b.post_id WHERE a.post_status = 'publish' and a.comment_status = 'open' and ( a.post_title like '%".$keyword."%' or a.post_content like '%".$keyword."%' or a.post_type like '%".$keyword."%') and b.meta_value like '%".$location."%' and b.meta_value like '%".$typeshort."%' and b.meta_value like '%".$categoryshort."%' GROUP BY b.post_id;");
$total_results1 = $wpdb->num_rows;
$resultcount1= $resultcount1 + $total_results1;

foreach($results as $result){
$id= $result->post_id;
?>
			  <div class="col-md-4 col-sm-6">	        	
				  <figure>
			    <div class="text-lable">

				    <center><span><strong><?php echo $result->post_title ?> </strong></span></center>
				    </div>

				           <?php //echo $db_prefix[$h];
                   //echo $h;
                   //echo $id;
                   //echo get_post_type_archive_link( $result->post_type );
                   $xyz= get_site_url();
                   $permalink =  get_post_type_archive_link( $result->post_type );
                   //if (has_post_thumbnail( $id ) ): 
                           // $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' );
                           
                             $perma1 = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix."blogs WHERE blog_id=".$db_prefix[$h]."; ");
                             foreach($perma1 as $perma){
                             $path1= $perma->path;
                             break;
                           }
                           $path1= "http://".$_SERVER['SERVER_NAME'].$path1;
                           
                          /*echo $img= $image[0];
                          $find1 = array( $xyz."/");
                          $replace1 = '';
                          $output1 = str_replace( $find1, $replace1, $img );
                          $img= $path1.$output1; */
                          //endif;             
                          $find = array( $xyz."/","blog/");
                          $replace = '';
                          $output = str_replace( $find, $replace, $permalink );
                          $permalink= $path1.$output.$result->post_name;
                          $img_url= plugins_url('/img',__FILE__)."/gorilla.jpg"; 

                          $results1 = $wpdb->get_results("SELECT meta_value FROM ".$wpdb->base_prefix.$db_prefix[$h]."_postmeta WHERE post_id = ".$id." and meta_key = 'listing_featured_image' ;");
                            foreach($results1 as $result1){
                          if(isset($result1->meta_value)) {
                          $img_url=$result1->meta_value;
                          }

  
                          break;  }
                          ?>
                            <a id="detail" href="<?php echo $permalink; ?>"><img style="height:220px;width:100%;" src="<?php echo $img_url; ?>" class="img-responsive"></a>
                    <?php 
                                       
                  
                    ?> 
						    <figcaption>
						    <center><h3><?php echo $result->post_type ?></h3></center>
						    <?php  
                            $results1 = $wpdb->get_results("SELECT meta_value FROM ".$wpdb->base_prefix.$db_prefix[$h]."_postmeta WHERE post_id = ".$id." and meta_key = 'listing_locations' ;");
                            foreach($results1 as $result1){
                              $location_array = unserialize($result1->meta_value);
                              if (is_array($location_array)){
                            for ($i=0; $i < count(next($location_array)); $i++){

                   ?>
                           <span style="float:left;padding-left:20px;">Location : </span><span style="float:right;padding-right:20px;text-transform: capitalize;"><?php echo current($location_array) ?> </span><br>
                   <?php 
                           } 
                           }
                        else{ ?>
                           <span style="float:left;padding-left:20px;">Location : </span><span style="float:right;padding-right:20px;text-transform: capitalize;"><?php echo $result1->meta_value; ?> </span><br>

                       <?php }
                           break;
                        }
                           $results2 = $wpdb->get_results("SELECT meta_value FROM ".$wpdb->base_prefix.$db_prefix[$h]."_postmeta WHERE post_id = ".$id." and meta_key = 'inventor_reviews_post_total_rating';");
                            foreach($results2 as $result2){
                  ?>
							            <span style="float:left;padding-left:20px;">Rating : </span><span style="float:right;padding-right:20px;"><?php 
                          $args = array(
                          'rating' => $result2->meta_value,
                          'type' => 'rating',
                          'number' => 1234,
                           );
                           wp_star_rating( $args ); 


                            ?> </span><br>
							<?php break; 
						    } 
                            $results3 = $wpdb->get_results("SELECT meta_value FROM ".$wpdb->base_prefix.$db_prefix[$h]."_postmeta WHERE post_id = ".$id." and meta_key = 'inventor_statistics_post_total_views';");
                            foreach($results3 as $result3){
						    ?>
							<span style="float:left;padding-left:20px;">Views : </span><span style="float:right;padding-right:20px;"><?php echo $result3->meta_value ?> </span>
							<?php break; } ?>
								
							
						</figcaption>
					</figure>
	        	</div>
              <?php	        
                    }
                    }
                    //}}
              ?>	
	        		</ul>
              				<ul class="pager" style="clear: both;">
              				<input type="hidden" id="keyword" value="<?php echo $keyword; ?>">
              				<input type="hidden" id="location" value="<?php echo $location; ?>">
              				<input type="hidden" id="category" value="<?php echo $category; ?>">
             <?php  
                  if($page > 1)
                    {
             ?>
                            <li><a id="page2" data-value="<?php echo $prev; ?>">Previous</a></li>
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
                            <li><a id="page2" data-value="<?php echo $i; ?>"><?php echo $i; ?></a></li>

           <?php
                    }
                    }
                  if($page < $total_pages)
                    {
	       ?>
                            <li><a id="page2" data-value="<?php echo $next; ?>">Next</a></li>

           <?php
                    }

           ?>
		  
				</ul>	
	        	
	        	
			