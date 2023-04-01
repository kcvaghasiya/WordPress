<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="white-box">
		<div class="post-featured-image">
			<a href="javascript:void(0);" class="openpopup"><?php the_post_thumbnail(); ?></a>
			<div class="img-overlay openpopup"></div>
			<input type="hidden" name="video_url" value="<?php the_ID(); ?>" />
			<div class="post-featured-date-wrapper">
				<?php
				$cpost=get_post($_GET['p_id']);
				echo '<span>'.date("d", strtotime($cpost->post_date)).'</span>';
				echo '<span>'.date("M", strtotime($cpost->post_date)).'</span>';
				?>
			</div>

		</div>
		<div class="post-content-wrapper text">
			<div class="post-header">
				<div class="post-detail single-post">
					<span class="post-info-cat">
						<?php
						$category_detail=get_the_category($post->ID);
						foreach($category_detail as $cd){
							echo $cd->cat_name;
						}	
						?>
					</span>
				</div>
				<div class="post-header-title">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div>
			</div>
			<div class="post-header-wrapper">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>

</div>