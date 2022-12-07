<?php
/**
* The template for displaying all single location
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#taxonomy location
*
* @package Wordpress
*/

get_header();

$term = get_queried_object();

// For getting custom field values of Term(Taxonomy)
$term_id = 'locations_'.$term->term_id;
 
?>

<main id="primary" class="site-main arLoc">
    
    <?php
        $bannerImg = get_field('banner_image',$term_id);
        $bannerTitle = get_field('banner_heading',$term_id);
        $bannersubTitle = get_field('banner_description',$term_id);
    ?>
    <section class="hasFixed textCenter  hasBg locationBanner" id="loactionBanner">
        <div class="imgWrap fixElem zoomover hasOverlay anim">
            <?php echo wp_get_attachment_image($bannerImg,'full'); ?>
        </div>
        <div class="wrapper">
            <div class="contWrap">
                <h1 class="head anim stop font100"><?php echo $bannerTitle ? $bannerTitle : ''; ?></h1>
                <?php if($bannersubTitle): ?>
                <p class="subTitle anim stop font28"><?php echo $bannersubTitle ? $bannersubTitle : ''; ?></p>
                <?php endif; ?>
            </div>
        </div>
  </section>

<?php
get_footer();
