--------------------------------------------------------------------------------------------------------
                                         archive-postType.php Code
--------------------------------------------------------------------------------------------------------

<?php
/**
 * The template for displaying the Team Posts
 *
 * @package Eveal
 */

get_header();
?>
<?php 
   $post_type = wp_count_posts('team');
    $total_posts = $post_type->publish;
   $args = array( 'post_type' => 'team', 'paged' => 1, 'post_status' => 'publish', 'posts_per_page' =>1, );
    $blog_posts = new WP_Query( $args ); 
?>
<?php if ( $blog_posts->have_posts() ) : ?>
<div class="events-list">
 <div class="list_part">
<?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
<article class="post-card anim" id="<?php echo $post->ID; ?>">
    <a href="<?php echo get_the_permalink($post->ID); ?>" class='event'>
        <figure class="post-card-fig bg-overlay">
            <?php the_post_thumbnail('large'); ?>
        </figure>
        <div class="post-content">
            <h3 class='post-card-title'><?php echo get_the_title(); ?></h3>
            <div class="post-card-info">
                <span class="calender"><?php the_time( 'F d, Y' ); ?></span>
                
                <span class="location"><?php the_field('event_location'); ?></span>
            </div>
        </div>
    </a>
</article>
<?php  endwhile; ?>
<?php endif; wp_reset_query(); ?>
</div>
</div>
<div class="load-more" id="<?php echo $total_posts; ?>" data-post-type="team">
    <button class="button orange">Load more +</button>
</div>

<script defer type="text/javascript" >
/*-------Event List Page Load More Start----- */
        var total_count = jQuery('.load-more').attr('id');       
        var counter= 0;
        jQuery('.events-list .list_part .card').each(function(){
            counter++;         
        })
        setTimeout(function(){
        if(total_count <= counter){
           jQuery('.load-more').hide();
        }   
        },100);
        jQuery('.load-more button').click(function(){
        var counter_=1;
        var post_id = new Array();
        var cat_id = jQuery('.load-more').attr('data-cat-id');        
        var post_type = jQuery('.load-more').attr('data-post-type');        
        jQuery('.events-list .list_part .card').each(function(){
            post_id.push(jQuery(this).attr('id')); 
            counter_++; 
        })           
        var button = jQuery(this),
            data = {
            'action': 'event_post_load_more',
            postids : post_id,
            post_types : post_type,
        };
        jQuery.ajax({ 
            url : '/elevated/wp-admin/admin-ajax.php',
            data : data,
            type : 'POST',
            beforeSend : function ( xhr ) {
                button.text('Loading...'); // change the button text, you can also add a preloader image
            },
            success : function( data ){
                if( data ) { 
                    button.text('Load more  +');
                    jQuery('.events-list .list_part').append(data);
                    if(total_count <= counter_){
                        jQuery('.load-more').hide();
                    }
                } else {

                }
            }
        });

    });
</script>

<?php
 
get_footer();

--------------------------------------------------------------------------------------------------------
                                         archive-postType.php Code Ends
--------------------------------------------------------------------------------------------------------


--------------------------------------------------------------------------------------------------------
                                         function file Code
--------------------------------------------------------------------------------------------------------

/* Posts Load More ajax*/
add_action('wp_ajax_nopriv_event_post_load_more', 'event_post_load_more');
add_action('wp_ajax_event_post_load_more', 'event_post_load_more');
function event_post_load_more(){
    $post_ids =$_POST['postids'];
     
    $post_types = $_POST['post_types'];
    if($post_types == 'team'){
        $args = array( 'post_type' => 'team', 'post_status' => 'publish', 'posts_per_page' => 1,'post__not_in' => $post_ids);
    }
    else{
        $args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 1,'post__not_in' => $post_ids);
    }
        $blog_posts = new WP_Query( $args );
        ?>
        <?php if ( $blog_posts->have_posts() ) : ?>
        <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
            ?>
            <article class="card anim" id="<?php echo get_the_ID(); ?>" data-id="<?php echo $post->ID; ?>">
                <a href="<?php echo get_the_permalink($post->ID); ?>" class='event'>
                    <figure class="card-fig bg-overlay">
                        <?php the_post_thumbnail('large'); ?>    
                    </figure>
                    <div class="content">
                        <h3 class='font24 font-aachen title'><?php echo get_the_title(); ?></h3>
                        <div class="info">
                            <span class="font14 upcase font-industry calender"><?php the_time( 'F d, Y' ); ?></span>
                            <span class="font14 upcase font-industry location"><?php the_field('event_location'); ?></span>
                        </div>
                    </div>
                </a>
            </article>
        <?php endwhile; ?>
        <?php endif; wp_reset_query(); 
    //print_r($post_ids);
    exit;
}


--------------------------------------------------------------------------------------------------------
                                         function file Code Ends
--------------------------------------------------------------------------------------------------------
