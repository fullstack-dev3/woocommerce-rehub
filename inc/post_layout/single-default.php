<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<!-- CONTENT -->
<div class="rh-container">
    <div class="rh-content-wrap clearfix">
        <!-- Main Side -->
        <div class="main-side single<?php if(get_post_meta($post->ID, 'post_size', true) == 'full_post' || rehub_option('disable_post_sidebar')) : ?> full_width<?php endif; ?> clearfix"> 
            <div class="rh-post-wrapper">           
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php $postclasses = array('post-inner', 'post');?>
                    <article <?php post_class($postclasses); ?> id="post-<?php the_ID(); ?>">
                        <!-- Title area -->
                        <div class="rh_post_layout_metabig">
                            <div class="title_single_area">
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
                                <?php echo re_badge_create('labelsmall'); ?><?php rh_post_header_cat('post', true);?>                        
                                <h1><?php the_title(); ?></h1>                                                           
                                <div class="meta post-meta-big">
                                    <?php rh_post_header_meta_big();?> 
                                </div>
                                <div class="clearfix"></div> 
                                <?php if(rehub_option('rehub_disable_share_top') =='1' || vp_metabox('rehub_post_side.disable_parts') == '1')  : ?>
                                <?php else :?>
                                    <div class="top_share">
                                        <?php include(rh_locate_template('inc/parts/post_share.php')); ?>
                                    </div>
                                    <div class="clearfix"></div> 
                                <?php endif; ?>   
                                                           
                            </div>
                        </div>
                        <?php if(rehub_option('rehub_single_after_title')) : ?><div class="mediad mediad_top"><?php echo do_shortcode(rehub_option('rehub_single_after_title')); ?></div><div class="clearfix"></div><?php endif; ?>                         
                        <?php include(rh_locate_template('inc/parts/top_image.php')); ?>                                
                        <?php if(rehub_option('rehub_single_before_post') && vp_metabox('rehub_post_side.show_banner_ads') != '1') : ?><div class="mediad mediad_before_content"><?php echo do_shortcode(rehub_option('rehub_single_before_post')); ?></div><?php endif; ?>

                        <?php the_content(); ?>

                    </article>
                    <div class="clearfix"></div>
                    <?php include(rh_locate_template('inc/post_layout/single-common-footer.php')); ?>                    
                <?php endwhile; endif; ?>
                <?php comments_template(); ?>
            </div>
        </div>  
        <!-- /Main Side -->  
        <!-- Sidebar -->
        <?php if(get_post_meta($post->ID, 'post_size', true) == 'full_post' || rehub_option('disable_post_sidebar')) : ?><?php else : ?><?php get_sidebar(); ?><?php endif; ?>
        <!-- /Sidebar -->
    </div>
</div>
<!-- /CONTENT -->     