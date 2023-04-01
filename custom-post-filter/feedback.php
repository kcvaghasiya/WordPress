 <?php
// - Create template named "feedback.php" and paste below code 
// - create new page in admin dashboard and assign page attribute "feedback"
 /* 
 Template Name: Feedback
 */

get_header(); ?>

<div class="categories page-content">
	<div class="search-wrapper"><input type="text" name="keyword" id="keyword" placeholder="Search for names.." title="Type in a name"></input></div>
	<ul class="cat-list row no-wrap">
		<?php 

		$cat_args = array(
			'taxonomy' => 'reviews-category',
					// 'exclude' => array(1) ,
			'option_all' => "All"
		);
		$categories = get_categories($cat_args); ?>
		<li class="js-filter-item active"><a href="<?=home_url()?>" data-slug="">All</a></li>

		<?php foreach($categories as $category) : ?>
			<li class="js-filter-item">
				<a class="tooltip" data-category="<?= $category->term_id; ?>" href="<?= get_category_link($category->term_id);?>" data-slug="<?= $category->slug; ?>">
					<?= $category->name; 
					$cat_count = get_category($category->term_id);?>
					<span class="tooltiptext"><?=$cat_count->count;?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<div id="loading" style="display: none"><img src='//clientdemo2.rentechdigital.com/om-yogpith/wp-content/uploads/2021/06/loading.gif' /></div>	
<div class="page-content js-filter row">
	<?php
	$cate = get_category( get_query_var( 'cat' ) );
	$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
	$postsPerPage = 1;
	$args = array(
		'post_type' => 'reviews',
		'posts_per_page' => $postsPerPage,
		'orderby'	=> 'post_date',
		'order'         => 'DESC',
		'paged' => $paged
		
	);
	?>
		
	<?php
	// get_template_part( 'templates/feedback', 'content' );
	$query = new WP_Query($args);
	while($query->have_posts() ):  $query->the_post(); 

		get_template_part( 'template-parts/content', 'reviews' );

	endwhile; ?>

	<script>
	   var limit = 1,
       page = 1,
       type = 'reviews',
       // category = '',
       max_pages_latest = <?php echo $query->max_num_pages ?>

	</script>	
	<!-- 	<?php //echo "pages--".$query->max_num_pages ;?>
	 -->
	<?php if ( $query->max_num_pages > 1):

   		?>
   		<div class="load_more text-center">
            <a href="#" class="btn btn-circle btn-inverse btn-load-more" >Load More</a> 
        </div>
        <?php
	/*else: ?>

		<div id="post-404" class="noposts">

			<p><?php _e('No more post found...','example'); ?></p>

		</div><!-- /#post-404 -->*/

	endif; wp_reset_query(); ?>


</div><!-- /#page-content -->
<?php get_footer(); ?>
