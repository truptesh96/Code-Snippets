<?php $paged = get_query_var('paged') ? get_query_var('paged') : 1; 
		$args = array( 'post_type' => 'products', 'order' => 'DESC', 'post_status' => 'publish', 'posts_per_page' => 10,  
			'tax_query' => array( array( 'taxonomy' => 'product-category' , 'terms' => array( 'grills' )) ) );
		$arr_posts = new WP_Query( $args );
    	if ($arr_posts->have_posts()) : ?>
    		<div class="product-slider">
    			<?php while ($arr_posts->have_posts()) : $arr_posts->the_post();  ?>
    				<div class="slide product text-center">
    					<div class="pro-image">
							<?php the_post_thumbnail(); ?>
							<a href="<?php the_permalink(); ?>" class="visit-link"><img src="<?php echo get_template_directory_uri().'/images/eye-icon.png' ?>" alt="whishlist icon"></a>
						</div>
    					<div class="details">
    						<a class="name" href="<?php the_permalink(); ?>"><h3 class="font25"><?php the_title(); ?></h3></a>
							<?php the_excerpt(); ?>
							<?php if( get_field('msrp' ) ): ?>
								<p class="font18 bold max-price">MSRP : <span>$<?php the_field('msrp'); ?></span></p>
							<?php endif; ?>
						</div>
    				</div>
    			<?php endwhile; ?>
    		</div>
	  	<?php else: ?>
	  		<div class="wrapper">
        		<h3 class="font26">No Products Found</h3>
        	</div>
 <?php endif; wp_reset_postdata(); ?>	
