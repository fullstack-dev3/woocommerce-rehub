<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<!-- Title area -->
<div class="rh_post_layout_fullimage">
    <?php           
        $image_id = get_post_thumbnail_id(get_the_ID());  
        $image_url = wp_get_attachment_image_src($image_id,'full');
        $image_url = $image_url[0];
        if (function_exists('_nelioefi_url')){
            $image_nelio_url = get_post_meta( $post->ID, _nelioefi_url(), true );
            if (!empty($image_nelio_url)){
                $image_url = esc_url($image_nelio_url);
            }           
        } 
    ?>  
    <style scoped>#rh_post_layout_inimage{background-image: url(<?php echo ''.$image_url;?>);}</style>
    <div id="rh_post_layout_inimage">
        <div class="rh-container rh-flex-center-align rh-flex-justify-center">
        <?php echo re_badge_create('starburst'); ?>
        <div class="rh_post_breadcrumb_holder">
            <?php 
                $crumb = '';
                if( function_exists( 'yoast_breadcrumb' ) ) {
                    $crumb = yoast_breadcrumb('<div class="breadcrumb">','</div>', false);
                }
                if( ! is_string( $crumb ) || $crumb === '' ) {
                    if(rehub_option('rehub_disable_breadcrumbs') == '1' || vp_metabox('rehub_post_side.disable_parts') == '1') {echo '';}
                    elseif (function_exists('dimox_breadcrumbs')) {
                        dimox_breadcrumbs(); 
                    }
                }
                echo ''.$crumb;  
            ?>
        </div>
        <div class="rh_post_header_holder text-center">
            <div class="title_single_area"> 
                <?php rh_post_header_cat('post');?>                           
                <h1><?php the_title(); ?></h1>                                
                <div class="meta post-meta">
                    <?php rh_post_header_meta('full', true, true, true, false);?> 
                </div>                           
            </div>                     
        </div>
        </div>
        <span class="rh-post-layout-image-mask"></span>
    </div>
</div>
<?php $nohead = true;?>
<?php include(rh_locate_template('inc/post_layout/single-default-readopt.php')); ?>    