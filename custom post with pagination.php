<?php
/**
 * Template Name: Past Posts For Events Template
 * Package : marble
 *
 */
get_header();
?>

<div class='container inner'>
<div class='page-content'>
<?php
   while ( have_posts() ) : the_post(); ?>
        <div class="entry-content-page">
            <?php the_content(); ?>
        </div>
    <?php
    endwhile; 
    wp_reset_query();
    ?>
</div>
<div class='tribe-events-list'>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'=>'tribe_events',
    'posts_per_page' => 10,
    'order' => 'DESC',
    'paged' => $paged,
    'start_date'   => 'now',
    'end_date'     => '2010-08-01' 
);
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) { ?>

<div class='tribe-events-loop' id='tribe-events'>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <div class="type-tribe_events tribe-clearfix tribe-events-last">
    <h2 class="tribe-events-list-event-title">
        <a href="<?php the_permalink(); ?>" class="tribe-event-url" target="_blank">
        <?php echo get_the_title(); ?>
        </a>
    </h2>
    
    <div class="tribe-events-event-meta">
    <div class="author  location">
        <div class="tribe-event-schedule-details">
			<span class="tribe-event-date-start"><?php echo tribe_get_start_date( $post, false, 'F j, Y - g:i a'); ?>
		</div>
        <div class="tribe-events-venue-details">
		    <span class="tribe-address"></span>
		</div>
	</div>
	</div>
	
	<div class="tribe-events-event-image">
	    <a href="<?php the_permalink(); ?>" >
	        <?php the_post_thumbnail('large'); ?>    
	    </a>
	</div>
	<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
	<p><?php echo the_excerpt(); ?></p>
	<a href="<?php the_permalink(); ?>" class="tribe-events-read-more pj-btn" rel="bookmark">More Info »</a>
    </div>
    
    </div>

<?php endwhile;
    $total_pages = $loop->max_num_pages;
    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => __('« prev'),
            'next_text'    => __('next »'),
        ));
    }    
}
wp_reset_postdata();
?>
</div>
</div>
</div>

<?php get_footer(); ?>