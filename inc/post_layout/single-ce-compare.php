<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php global $post;?>
<?php if (defined('\ContentEgg\PLUGIN_PATH')):?>
    <?php $module_id = get_post_meta($post->ID, '_rehub_module_ce_id', true);?>
    <?php $unique_id =  get_post_meta($post->ID, '_rehub_product_unique_id', true);?>
    <?php if($unique_id && $module_id):?>
        <?php $itemsync = \ContentEgg\application\components\ContentManager::getProductbyUniqueId($unique_id, $module_id, $post->ID);?>
    <?php endif;?>
<?php endif;?>
<?php if (defined('\ContentEgg\PLUGIN_PATH') && !empty($itemsync)) :?>
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
                            <div class="rh_post_layout_compare_ce">
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
                                <div class="title_single_area">
                                    <h1 class="<?php if(rehub_option('hotmeter_disable') !='1') :?><?php echo getHotIconclass($post->ID); ?><?php endif ;?>"><?php the_title(); ?></h1> <?php if(rehub_option('hotmeter_disable') !='1' && function_exists('RHgetHotLike')) :?><?php echo RHgetHotLike(get_the_ID()); ?><?php endif ;?>
                                    <div class="rh_post_layout_compare_holder">
                                        <?php if(vp_metabox('rehub_post_side.show_featured_image') != '1' && has_post_thumbnail())  : ?>
                                            <div class="featured_compare_left compare-full-images modulo-lightbox">
                                                <?php wp_enqueue_script('modulobox');wp_enqueue_style('modulobox');?>             
                                                <figure><?php echo re_badge_create('tablelabel'); ?>
                                                    <div class="favorrightside wishonimage"><?php echo RH_get_wishlist($post->ID);?></div>
                                                    <?php           
                                                        $image_id = get_post_thumbnail_id($post->ID);  
                                                        $image_url = wp_get_attachment_image_src($image_id,'full');
                                                        $image_url = $image_url[0]; 
                                                    ?> 
                                                    <a data-rel="rh_top_gallery" href="<?php echo ''.$image_url;?>" target="_blank" data-thumb="<?php echo ''.$image_url;?>">            
                                                        <?php WPSM_image_resizer::show_static_resized_image(array('lazy'=>true, 'thumb'=> true, 'crop'=> false, 'width'=> 350, 'no_thumb_url' => get_template_directory_uri() . '/images/default/noimage_500_500.png'));?>
                                                    </a>
                                                </figure>
                                                <?php $post_image_gallery = get_post_meta( $post->ID, 'rh_post_image_gallery', true );?>
                                                <?php if(!empty($post_image_gallery)) :?>
                                                    <?php echo rh_get_post_thumbnails(array('video'=>1, 'columns'=>4, 'height'=>60));?>
                                                <?php else :?>         
                                                    <?php if (!empty($itemsync['extra']['imageSet'])){
                                                        $ceimages = $itemsync['extra']['imageSet'];
                                                    }elseif (!empty($itemsync['extra']['images'])){
                                                        $ceimages = $itemsync['extra']['images'];
                                                    }
                                                    else {
                                                        $ceimages = '';
                                                    } ?> 
                                                    <?php if(!empty($ceimages)):?>
                                                        <div class="compare-full-thumbnails rh_mini_thumbs limited-thumb-number mt15 mb15">
                                                            <?php foreach ((array)$ceimages as $gallery_img) :?>
                                                                <?php if (isset($gallery_img['LargeImage'])){
                                                                    $image = $gallery_img['LargeImage'];
                                                                }else{
                                                                    $image = $gallery_img;
                                                                }?>                                               
                                                                <a data-thumb="<?php echo esc_url($image)?>" data-rel="rh_top_gallery" href="<?php echo esc_url($image); ?>" data-title="<?php echo esc_attr($itemsync['title']);?>"> 
                                                                    <?php WPSM_image_resizer::show_static_resized_image(array('src'=> $image, 'height'=> 65, 'title' => $itemsync['title'], 'no_thumb_url' => get_template_directory_uri().'/images/default/noimage_100_70.png'));?>  
                                                                </a>
                                                            <?php endforeach;?>     
                                                        </div>
                                                    <?php endif;?>                
                                                <?php endif;?>                                                
                                            </div>
                                        <?php endif;?>
                                        <div class="single_compare_right">   
                                            <div class="review_compare_score">
                                                <?php $overall_review = rehub_get_overall_score();?>
                                                <?php if($overall_review):?>
                                                    <div class="mb15 flowhidden">
                                                    <span class="floatleft"><strong><?php esc_html_e('Overall score: ', 'rehub-theme');?></strong></span>
                                                    <?php $starscoreadmin = $overall_review*10 ;?>
                                                    <div class="star-big floatright">
                                                        <span class="stars-rate unix-star">
                                                            <span style="width: <?php echo (int)$starscoreadmin;?>%;"></span>
                                                        </span>
                                                    </div>
                                                    </div>                       
                                                <?php endif;?>
                                            </div>                                                 
                              
                                            <?php echo do_shortcode('[content-egg-block template=custom/all_merchant_widget_group]');?>
                                            <?php if(rehub_option('rehub_disable_share_top') =='1' || vp_metabox('rehub_post_side.disable_parts') == '1')  : ?>
                                            <?php else :?>
                                                <?php if(function_exists('rehub_social_share')):?>
                                                    <div class="top_share">
                                                        <div class="post_share">
                                                            <?php echo rehub_social_share('row', false, false);?>
                                                        </div>                                                
                                                    </div>
                                                    <div class="clearfix"></div>
                                                <?php endif; ?> 
                                            <?php endif; ?>                                                                                                      
                                        </div> 
                                    </div>
                                </div>                                                 
                                <?php if(rehub_option('rehub_single_after_title')) : ?><div class="mediad mediad_top"><?php echo do_shortcode(rehub_option('rehub_single_after_title')); ?></div><div class="clearfix"></div><?php endif; ?> 
                            </div>
                            <?php $no_featured_image_layout = 1;?>
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
<?php else:?>
    <div class="rh-container mt30 mb30"><?php echo 'This product layout requires Content Egg Plugin to be active and Product must have Content Egg offers. For details, check Rehub docs - Affiliate Settings - Content Egg';?></div>
<?php endif;?>        