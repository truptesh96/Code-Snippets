<!--------------------------- Dynamic / Recent Blogs Option ---------------------------->

{{{ Create Below Fields }}}

A.) Field (Radio) - Blogs Type Option
default : Default Latest Blogs
custom : Select Custom Blogs

B.) Custom Selected Blogs (Post Object)

{{{ /Create Below Fields }}}

{{{ function file code

function recent_posts_shortcode($atts, $content = null) {
	global $post;
	extract(shortcode_atts(array( 'cat' => '', 'num' => '3', 'order'   => 'DESC', 'orderby' => 'post_date',	), $atts));
	$args = array( 'cat' => $cat, 'posts_per_page' => $num, 'order' => $order, 'orderby' => $orderby, );
	$output = '';
	$posts = get_posts($args);
	foreach($posts as $post) {
	setup_postdata($post);
		$output .= '<div class="blog-card"><a class="figure" href="'. get_the_permalink() .'"><figure><img src="'.get_the_post_thumbnail_url().'" alt="'. get_the_title() .'"><figcaption class="date">'.get_the_time( 'j F Y' ).'</figcaption></figure></a><a href="'. get_the_permalink() .'"><h3 class="font30 title">'. get_the_title() .'</h3></a><p class="desc font18">'.get_the_excerpt().'</p></div>';
	}			
	wp_reset_postdata();
	return '<div class="blogs-list dflex wrap">'. $output .'</div>';
}
add_shortcode('recent_posts', 'recent_posts_shortcode');


}}}



<section class="blogs-section">
	<div class="wrapper">
		<h2 class="text-center font60 head"><?php the_field('blog_section_title'); ?></h2>
		<?php if( get_field('blogs_type_option') == 'default' ): ?>
			<?php echo do_shortcode('[recent_posts num="3"]'); ?>
		<?php else: ?>
		<div class="blogs-list dflex wrap">
			<?php $posts = get_field('custom_selected_blogs');
				$output = '';
				foreach($posts as $post) {
				setup_postdata($post);
					$output .= '<div class="blog-card"><a class="figure" href="'. get_the_permalink() .'"><figure><img src="'.get_the_post_thumbnail_url().'" alt="'. get_the_title() .'"><figcaption class="date">'.get_the_time( 'j F Y' ).'</figcaption></figure></a><a href="'. get_the_permalink() .'"><h3 class="font30 title">'. get_the_title() .'</h3></a><p class="desc font18">'.get_the_excerpt().'</p></div>';
				}			
				wp_reset_postdata();
				echo $output;
		 	?>
			</div>
		<?php endif; ?>
	</div>
</section>

<!--------------------------- Dynamic Blogs Ends ---------------------------->
