<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<!-- CONTENT -->
<div class="rh-container"> 
    <div class="rh-content-wrap clearfix">
	    <!-- Main Side -->
        <div class="main-side single<?php if(get_post_meta($post->ID, 'post_size', true) == 'full_post' || rehub_option('disable_post_sidebar')) : ?> full_width<?php endif; ?> clearfix">  
            <div class="rh-post-wrapper">          
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php $expiredclass = rh_expired_or_not($post->ID, 'class');?>
                    <?php $postclasses = array('post-inner', 'post', $expiredclass);?>
                    <article <?php post_class($postclasses); ?> id="post-<?php the_ID(); ?>">
                        <!-- Title area -->
                        <div class="rh_post_layout_corner">
                            <?php if(vp_metabox('rehub_post_side.disable_top_offer') != '1')  : ?>
                                <div class="right_aff">
                                    <?php 
                                    $amazon_search_words = vp_metabox('rehub_post_side.amazon_search_words'); 
                                    $ebay_search_words = vp_metabox('rehub_post_side.ebay_search_words');
                                    if (!empty($amazon_search_words)) {
                                        $rehub_amazon_btn = (rehub_option('rehub_amazon_btn') !='') ? rehub_option('rehub_amazon_btn') : esc_html__('Search on Amazon', 'rehub-theme');
                                        $rehub_amazon_surl = (rehub_option('rehub_amazon_surl') !='') ? rehub_option('rehub_amazon_surl') : 'http://www.amazon.com/gp/search?ie=UTF8&camp=1789&creative=9325&index=aps&linkCode=ur2&tag=wpsoul-20';
                                        $amazon_link = '<a href="'.$rehub_amazon_surl.'&keywords='.esc_html($amazon_search_words).'" target="_blank" rel="nofollow sponsored">'.$rehub_amazon_btn.'</a>';
                                    }
                                    else {
                                        $amazon_link ='';
                                    }
                                    if (!empty($ebay_search_words)) {
                                        $rehub_ebay_btn = (rehub_option('rehub_ebay_btn') !='') ? rehub_option('rehub_ebay_btn') : esc_html__('Search on Ebay', 'rehub-theme');
                                        $rehub_ebay_surl = (rehub_option('rehub_ebay_surl') !='') ? rehub_option('rehub_ebay_surl') : 'http://rover.ebay.com/rover/1/711-53200-19255-0/1?icep_ff3=9&pub=5575130199&toolid=10001&campid=5337712872&customid=&icep_sellerId=&icep_ex_kw=&icep_sortBy=12&icep_catId=&icep_minPrice=&icep_maxPrice=&ipn=psmain&icep_vectorid=229466&kwid=902099&mtid=824&kw=lg';
                                        $ebay_link = '<a href="'.$rehub_ebay_surl.'&icep_uq='.esc_html($ebay_search_words).'" target="_blank" rel="nofollow sponsored">'.$rehub_ebay_btn.'</a>';
                                    }   
                                    else {
                                        $ebay_link ='';
                                    }       
                                    ?>
                                    <?php rehub_create_btn('', '', 1);?>
                                    <div class="ameb_search"><?php echo ''.$amazon_link; echo ''.$ebay_link;?></div>
                                </div>
                            <?php endif; //Top offer block with button ?>
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
                                <?php echo re_badge_create('labelsmall'); ?><?php rh_post_header_cat('post', true);?>                            
                                <h1 class="clearbox"><?php the_title(); ?></h1>                                                        
                                <div class="meta post-meta">
                                    <?php rh_post_header_meta(true, true, true, true, false);?>
                                </div>
                            </div>                                                 
                            <?php if(rehub_option('hotmeter_disable') !='1' && function_exists('RHgetHotLike')) :?><?php echo RHgetHotLike(get_the_ID()); ?><?php endif ;?>
                        </div>
                        <?php if(rehub_option('rehub_single_after_title')) : ?><div class="mediad mediad_top"><?php echo do_shortcode(rehub_option('rehub_single_after_title')); ?></div><div class="clearfix"></div><?php endif; ?>     
                        <?php include(rh_locate_template('inc/parts/top_image.php')); ?>
                        <?php echo rh_get_post_thumbnails(array('video'=>1, 'class'=> 'mb30'));?>
                        <?php if(rehub_option('rehub_disable_share_top') !='1' && vp_metabox('rehub_post_side.disable_parts') != '1')  : ?>
                            <div class="top_share">
                                <?php include(rh_locate_template('inc/parts/post_share.php')); ?>
                            </div>
                        <?php endif; ?>                                                           

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