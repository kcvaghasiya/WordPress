<?php

/**
** ajax filter
**/ 

add_action('wp_ajax_nopriv_filter','filter_ajax');
add_action('wp_ajax_filter','filter_ajax');

function filter_ajax(){
	$category = $_POST['category'];
	$postsPerPage = 1;
	$args = array(
		'post_type' => 'reviews',
		'posts_per_page' => $postsPerPage,
		'orderby'	=> 'post_date',
		'order'         => 'ASC',
	);
	
	if(isset($category)){
		$args = array(
	            'post_type' => 'reviews',
	           	'post_status' => 'publish',
	           	'posts_per_page' => $postsPerPage,
	            
	       		'tax_query' => array(
		            array(
		                'taxonomy' => 'reviews-category',
		                'field' => 'term_id',
	                	'terms'    => $category,
		            ),
	       		),
	   	);
	}  
	else{
		$args = array(
			'post_type' => 'reviews',
           	'post_status' => 'publish',
           	'posts_per_page' =>$postsPerPage
		);
	} ?><?php$query = new WP_Query($args);
	?>
	<script>
	   var limit = 1,
       page = 1,
       type = 'reviews',
       // category = <?php //echo $category ;?>,
       max_pages_latest = <?php echo $query->max_num_pages ?>

	</script>
	<?phpif($query->have_posts()): ?><?php while($query->have_posts() ):  $query->the_post(); 

			get_template_part( 'template-parts/content', 'reviews' );

		endwhile; ?><?php else: ?>

		<div id="post-404" class="noposts">

			<p><?php _e('No results found for your filter. Please try againfgf.','example'); ?></p>

		</div><!-- /#post-404 -->

	<?php endif; wp_reset_query(); 
	if ( $query->max_num_pages > 1):

   		?>
   		<div class="load_more text-center">
            <a href="#" class="btn btn-circle btn-inverse btn-load-more" >Load More</a> 
        </div>
        <?php
	/*else: ?>

		<div id="post-404" class="noposts">

			<p><?php _e('No more post found...','example'); ?></p>

		</div><!-- /#post-404 -->*/

	endif; wp_reset_query(); 
    die();


}



/**
** ajax search 
**/
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

	$args = array(
		'post_type' => 'reviews',
       	'post_status' => 'publish',
    	's' => esc_attr( $_POST['keyword'] ), 
    );
	$query = new WP_Query($args);
	if($query->have_posts()): ?><?php while($query->have_posts() ):  $query->the_post(); 

			get_template_part( 'template-parts/content', 'reviews' );

		endwhile; ?><?php else: ?>

		<div id="post-404" class="noposts">

			<p><?php _e('No results found for your filter. Please try again.','example'); ?></p>

		</div><!-- /#post-404 -->

	<?php endif; wp_reset_query(); 

    die();
}
/**load more post*/
function loadmore_ajax_handler(){
	
	$category = $_POST['category'];
	if(isset($category)){
		$args = array(
		            'post_type' => 'reviews',
		           	'post_status' => 'publish',
		           	'paged' => $_POST['page'] + 1,
		           	'posts_per_page' => $_POST['limit'],
		            
		       		'tax_query' => array(
			            array(
			                'taxonomy' => 'reviews-category',
			                'field' => 'term_id',
		                	'terms'    => $category,
			            ),
		       		),
		   	);
	}
	else{
		$args = array(
			'post_type' => 'reviews',
           	'post_status' => 'publish',
           	'paged' => $_POST['page'] + 1,
           	'posts_per_page' => $_POST['limit'],
		);
	}  
	$query = new WP_Query($args);
	if($query->have_posts()): ?><?php while($query->have_posts() ):  $query->the_post(); 

			get_template_part( 'template-parts/content', 'reviews' );

		endwhile; ?><?php else: ?>

		<div id="post-404" class="noposts">

			<p><?php _e('No results found for your filter. Please try again.','example'); ?></p>

		</div><!-- /#post-404 -->

	<?php endif; wp_reset_query(); 

    die();
}
add_action('wp_ajax_loadmore','loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore','loadmore_ajax_handler');



?>