<?php 
/**
 * Plugin Name: EduGorilla-Portfolio
 * Version: 1.0.0
 * Description: Prtfolio plugin for Edugorilla.
 * Author: EduGorilla Team
 * Author URI: http://www.edugorilla.com
 * Plugin URI: http://www.edugorilla.com
 * Text Domain: EduGorilla-Portfolio
 * Domain Path: /languages/
 * License: EduGorilla Public License v3.0
 * License URI: http://www.edugorilla.com
 *
 * @package EduGorilla-Portfolio
 */
function add_ajax_file(){
	wp_enqueue_script('eg-portfolio',plugins_url('/js/ajax.js',__FILE__),array('jquery'),'1.1.0', true);
	wp_localize_script('eg-portfolio','my_ajax_url',array(
		'ajax_url' => admin_url('admin-ajax.php',__FILE__)
	));
}	
    add_action('wp_enqueue_scripts','add_ajax_file');
    function EduGorilla_assign($atts, $content = null){
    	extract(shortcode_atts(array(
    'type' => '',
    'category' => '',
    'childsite_num' => '',
    'db_prefix' => '',
    
), $atts));
    global $wpdb;
   
?>
<script type="text/javascript">
var plugins_url = "<?php echo plugins_url(); ?>";
var typeshort = "<?php echo $type; ?>";
var categoryshort = "<?php echo $category; ?>";
var num_db = "<?php echo $childsite_num; ?>";
var db_id = "<?php echo $db_prefix; ?>";
</script>
       
    <!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo plugins_url('/css',__FILE__);  ?>/main.css">
	<link href="<?php echo plugins_url('/css',__FILE__);  ?>/bootstrap.css" rel="stylesheet">
    <link href="<?php echo plugins_url('/css',__FILE__);  ?>/custom2.css" rel="stylesheet">
    <script src="<?php echo plugins_url('/js',__FILE__);  ?>/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo plugins_url('/js',__FILE__);  ?>/custom.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('url');?>/wp-includes/css/dashicons.css" />
    
      <div id="portfolio">
       <div class="section">
	    	<div class="container">
				<div class="row">
			<ul class="grid cs-style-2">
		  <div class="work-filter wow fadeInRight animated" data-wow-duration="500ms">
		  <?php //echo esc_url( get_permalink(512) ); ?>
		  <?php /*if (has_post_thumbnail( 512 ) ): 
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( 512 ), 'single-post-thumbnail' ); 
echo $image[0]; 
endif; */
 //echo str_replace( home_url(), '', get_permalink(512) );
 //echo get_current_site(); 
 //echo unserialize($abcd);

                     ?>
                     <?php
                     //echo $img_url= plugins_url('/js',__FILE__);
//$current_site = get_current_site();
//echo 'You are viewing ' . $current_site->site_name;
//function get_all_sites() {
    /*$sites = wp_get_sites();
    foreach ($sites as $site) {
        printf( 'Blog %d: %s%s <br/>', $site['blog_id'], $site['domain'], $site['path'] );
    }   */
//}
   /* echo $db_prefix;
    echo $_SERVER['SERVER_NAME'];*/
     //echo $permalink =  get_permalink(512);
/*$xyz= get_site_url();
    //$permalink = get_permalink();
$find = array( $xyz);
$replace = '';
$output = str_replace( $find, $replace, $permalink );
echo '<p>' . $output . '</p>';*/

?>
<?php //echo get_post_type_archive_link( car ); ?>

                     
						<ul class="text-center">
						<li style="width:50%;"><input type='text' id="keyword" placeholder="Enter a Keyword"/></li>
						<li ><select id="location">
						<option value="">Location</option>
						<?php
						$results11 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."postmeta WHERE  meta_key = 'listing_locations' GROUP BY meta_value;");
                        foreach($results11 as $result11){
                        $location_ser= 	unserialize($result11->meta_value);
                        reset($location_ser);
                        for ($i=0; $i < count(next($location_ser)); $i++){

	                    ?>
						<option style="text-transform: capitalize;"  value="<?php echo current($location_ser) ?>" ><?php echo current($location_ser) ?></option>
						<?php 
						next($location_ser);
                        }
                        reset($location_ser);
						 } ?>
						</select></li>
						
							<li><input type="submit" id="btn_submit" value="Filter"></li>
							</ul>
					</div>

                   <div  id="live-data"></div>
                  </div>

			</div>
		</div>
		</div>
<div class="detail-banner-shadow"></div>


	    <!-- Footer -->
	    <?php 
	    }
add_shortcode('edugorilla-directory','EduGorilla_assign');
	    ?>
	    
        

