<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>
<?php $catID = get_query_var( 'cat' );?>
<?php $enable_pagination = (rehub_option('enable_pagination')) ? rehub_option('enable_pagination') : '1';?>
<?php if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; } ?>
<?php 
if ($enable_pagination =='2'){
    $infinitescrollwrap = ' re_aj_pag_auto_wrap';
}     
elseif ($enable_pagination =='3') {
    $infinitescrollwrap = ' re_aj_pag_clk_wrap';
} 
else {
    $infinitescrollwrap = '';
} 
$show = get_option('posts_per_page');
if($show == 10){$show = 12;}
$count_ads = rehub_option('rehub_grid_ad_count');
if (!empty ($count_ads)) {
    foreach ($count_ads as $count_ad) {
        $show--;
    }
}

$containerid = 'rh_loop_' . mt_rand();
$ajaxoffset = $show; 
$args = array(
    'posts_per_page' => $show,
    'cat' => $catID,
    'paged' => $paged,
    'post_type' => 'post',
);
$price_meta = rehub_option('price_meta_grid');
$disable_btn = (rehub_option('rehub_enable_btn_recash') == 1) ? 0 : 1;
$disable_act = (rehub_option('disable_grid_actions') == 1) ? 1 : 0;
$aff_link = (rehub_option('disable_inner_links') == 1) ? 1 : 0;
$additional_vars = array('exerpt_count'=> '', 'disable_meta'=>'', 'enable_btn'=>'', 'disable_btn'=>$disable_btn, 'disable_act'=>$disable_act, 'price_meta' => $price_meta, 'aff_link'=>$aff_link);
$jsonargs = json_encode($args);
$json_innerargs = json_encode($additional_vars);
$cat_filter_panel = rehub_option('category_filter_panel');

?>

<!-- CONTENT -->
<div class="rh-container"> 
    <div class="rh-content-wrap clearfix">
        <!-- Main Side -->
        <div class="main-side clearfix<?php if (rehub_option('category_layout') == 'gridfull' || rehub_option('category_layout') == 'dealgridfull' || rehub_option('category_layout') == 'compactgridfull' || rehub_option('category_layout') == 'columngridfull' || rehub_option('category_layout') == 'cardblogfull') : ?> full_width<?php endif ;?>">
            <div class="wpsm-title middle-size-title wpsm-cat-title"><h5><?php single_cat_title(); ?></h5></div>
            <?php if( !is_paged()) : ?><article class='top_rating_text post'><?php echo category_description(); ?></article><?php endif ;?>

            <?php if ($cat_filter_panel): //Adding custom filter panel?>
                <?php $cat_filter_panel = explode(PHP_EOL, $cat_filter_panel);?>
                <?php $prepare_filter = array();?>
                <?php foreach ($cat_filter_panel as $key => $values) {
                    $values = explode(':', $values);
                    if ($values[1]=='hot'){
                        $filtertype = 'hot';
                    }
                    elseif($values[1]=='all'){
                        $filtertype = 'all';
                    }
                    elseif($values[1]=='expiration'){
                        $filtertype = 'expirationdate';
                    }                    
                    else{
                        $filtertype = 'meta';                        
                    }
                    if ($values[1]=='price'){
                        $prepare_filter[] = array (
                            'filtertitle' => trim($values[0]),
                            'filtertype' => 'pricerange',
                            'filterorder'=> trim($values[3]),  
                            'filterpricerange' => trim($values[2]),  
                            'filterorderby' => 'price',                     
                        );                        
                    } 
                    elseif($values[1]=='random'){
                        $prepare_filter[] = array (
                            'filtertitle' => trim($values[0]),
                            'filtertype' => 'all',
                            'filterorderby' => 'rand',
                            'filterorder'=> 'DESC',                       
                        ); 
                    } 
                    else{
                        $prepare_filter[] = array (
                            'filtertitle' => trim($values[0]),
                            'filtertype' => $filtertype,
                            'filterorder'=> trim($values[2]),  
                            'filtermetakey' => trim($values[1]),                        
                        );
                    } 
                }?>
                <?php $prepare_filter = urlencode(json_encode($prepare_filter));?>
                <?php rehub_vc_filterpanel_render($prepare_filter, $containerid);?>
            <?php elseif(REHUB_NAME_ACTIVE_THEME == 'REPICK'):?>
                <?php $prepare_filter = array();?>
                <?php 
                    $prepare_filter[] = array (
                        'filtertitle' => esc_html__('Latest', 'rehub-theme'),
                        'filtertype' => 'all',
                        'filterorderby' => 'date',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    );
                    $prepare_filter[] = array (
                        'filtertitle' => esc_html__('Hottest', 'rehub-theme'),
                        'filtertype' => 'meta',
                        'filterorderby' => 'date',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    );
                    $prepare_filter[] = array (
                        'filtertitle' => esc_html__('Popular', 'rehub-theme'),
                        'filtertype' => 'meta',
                        'filtermetakey' => 'rehub_views_mon',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    );                                        
                    $prepare_filter[] = array (
                        'filtertitle' => esc_html__('Discussed', 'rehub-theme'),
                        'filtertype' => 'comment',
                        'filterorderby' => 'date',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    );
                    $prepare_filter[] = array (
                        'filtertitle' => esc_html__('Favorite', 'rehub-theme'),
                        'filtertype' => 'meta',
                        'filtermetakey' => 'post_wish_count',
                        'filterorderby' => 'date',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    );                      
                    $prepare_filter[] = array (
                        'filtertitle' => esc_html__('Random', 'rehub-theme'),
                        'filtertype' => 'all',
                        'filterorderby' => 'rand',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    );  
                    $prepare_filter = urlencode(json_encode($prepare_filter));             
                ?>
                <div class="filter_home_pick">
                <?php rehub_vc_filterpanel_render($prepare_filter, $containerid);?>
                </div>
            <?php endif;?>

            <?php 
            $args = apply_filters('rh_category_args_query', $args);
            $wp_query = new WP_Query($args);
            do_action('rh_after_category_args_query', $wp_query);           
            if ( $wp_query->have_posts() ) : ?>
                <?php 
                    $count = 0; 
                    $count_ad_descs = explode("\n", rehub_option('rehub_grid_ads_desc'));
                ?>
                <?php if (rehub_option('category_layout') == 'blog') : ?>
                    <div class="<?php echo ''.$infinitescrollwrap;?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="query_type2" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>

                <?php elseif (rehub_option('category_layout') == 'newslist') : ?>
                    <div class="<?php echo ''.$infinitescrollwrap;?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="query_type1" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'> 

                <?php elseif (rehub_option('category_layout') == 'communitylist') : ?>
                    <div class="<?php echo ''.$infinitescrollwrap;?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="query_type1" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>

                <?php elseif (rehub_option('category_layout') == 'deallist') : ?>
                    <div class="woo_offer_list <?php echo ''.$infinitescrollwrap;?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="postlistpart" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'> 

                <?php elseif (rehub_option('category_layout') == 'cardblog') : ?>
                    <div class="coloredgrid rh-flex-eq-height <?php echo (rehub_option('width_layout') =='extended') ? 'col_wrap_fourth' : 'col_wrap_three';?> <?php echo ''.$infinitescrollwrap;?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="color_grid" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>  

                <?php elseif (rehub_option('category_layout') == 'cardblogfull') : ?>
                    <div class="coloredgrid rh-flex-eq-height <?php echo (rehub_option('width_layout') =='extended') ? 'col_wrap_fifth' : 'col_wrap_fourth';?> <?php echo ''.$infinitescrollwrap;?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="color_grid" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>

                <?php elseif (rehub_option('category_layout') == 'grid') : ?>
                    <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init'); ?>                
                    <div class="pb30 <?php echo esc_attr($infinitescrollwrap);?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="query_type3" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>
                        <div class="masonry_grid_fullwidth col_wrap_two">

                <?php elseif (rehub_option('category_layout') == 'gridfull') : ?>
                    <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init'); ?>                
                    <div class="pb30 <?php echo esc_attr($infinitescrollwrap);?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="query_type3" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>
                        <div class="masonry_grid_fullwidth col_wrap_three">

                <?php elseif (rehub_option('category_layout') == 'columngrid') : ?>               
                    <div class="columned_grid_module rh-flex-eq-height col_wrap_three <?php echo esc_attr($infinitescrollwrap);?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="column_grid" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>

                <?php elseif (rehub_option('category_layout') == 'columngridfull') : ?>               
                    <div class="columned_grid_module rh-flex-eq-height col_wrap_fourth <?php echo esc_attr($infinitescrollwrap);?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="column_grid" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>  
                    
                <?php elseif (rehub_option('category_layout') == 'compactgrid') : ?>               
                    <div class="eq_grid post_eq_grid rh-flex-eq-height <?php echo (rehub_option('width_layout') =='extended') ? 'col_wrap_fifth' : 'col_wrap_fourth';?> <?php echo esc_attr($infinitescrollwrap);?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="compact_grid" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>

                <?php elseif (rehub_option('category_layout') == 'compactgridfull') : ?>               
                    <div class="eq_grid post_eq_grid rh-flex-eq-height <?php echo (rehub_option('width_layout') =='extended') ? 'col_wrap_six' : 'col_wrap_fifth';?> <?php echo esc_attr($infinitescrollwrap);?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="compact_grid" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>

                <?php elseif (rehub_option('category_layout') == 'dealgrid') : ?>               
                    <div class="eq_grid post_eq_grid rh-flex-eq-height <?php echo (rehub_option('width_layout') =='extended') ? 'col_wrap_fourth' : 'col_wrap_three';?> <?php echo esc_attr($infinitescrollwrap);?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="compact_grid" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>

                <?php elseif (rehub_option('category_layout') == 'dealgridfull') : ?>               
                    <div class="eq_grid post_eq_grid rh-flex-eq-height <?php echo (rehub_option('width_layout') =='extended') ? 'col_wrap_six' : 'col_wrap_fifth';?> <?php echo esc_attr($infinitescrollwrap);?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="compact_grid" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>                                                                      
                <?php else : ?>
                    <div class="<?php echo ''.$infinitescrollwrap;?>" data-filterargs='<?php echo ''.$jsonargs.'';?>' data-template="query_type1" id="<?php echo esc_attr($containerid);?>" data-innerargs='<?php echo ''.$json_innerargs.'';?>'>   
                <?php endif ;?>                                 
                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <?php 
                            $count++;
                            $count_ad_code = rehub_option('rehub_grid_ads_code');  
                        ?>                    
                        <?php if (rehub_option('category_layout') == 'blog') : ?>
                            <?php include(rh_locate_template('inc/parts/query_type2.php')); ?>

                        <?php elseif (rehub_option('category_layout') == 'newslist') : ?>
                            <?php $type='2'; ?> 
                            <?php include(rh_locate_template('inc/parts/query_type1.php')); ?> 

                        <?php elseif (rehub_option('category_layout') == 'communitylist') : ?>
                            <?php include(rh_locate_template('inc/parts/query_type1.php')); ?>

                        <?php elseif (rehub_option('category_layout') == 'deallist') : ?>
                            <?php include(rh_locate_template('inc/parts/postlistpart.php')); ?>                                                
                        <?php elseif (rehub_option('category_layout') == 'grid' || rehub_option('category_layout') == 'gridfull') : ?>
                            <?php include(rh_locate_template('inc/parts/query_type3.php')); ?>                    

                        <?php elseif (rehub_option('category_layout') == 'cardblog' || rehub_option('category_layout') == 'cardblogfull') : ?>
                            <?php include(rh_locate_template('inc/parts/color_grid.php')); ?>

                        <?php elseif (rehub_option('category_layout') == 'columngrid' || rehub_option('category_layout') == 'columngridfull') : ?>
                            <?php include(rh_locate_template('inc/parts/column_grid.php')); ?>   

                        <?php elseif (rehub_option('category_layout') == 'compactgrid' || rehub_option('category_layout') == 'compactgridfull') : ?>
                            <?php $gridtype = 'compact'; include(rh_locate_template('inc/parts/compact_grid.php')); ?>                                              
                        <?php elseif (rehub_option('category_layout') == 'dealgrid' || rehub_option('category_layout') == 'dealgridfull') : ?>
                            <?php include(rh_locate_template('inc/parts/compact_grid.php')); ?>
                     
                        <?php else : ?>
                            <?php include(rh_locate_template('inc/parts/query_type1.php')); ?>  
                        <?php endif ;?>
                    <?php endwhile; ?>
                    <?php if ($enable_pagination == '2' || $enable_pagination == '3' ) :?> 
                        <div class="re_ajax_pagination"><span data-offset="<?php echo esc_attr($ajaxoffset);?>" data-containerid="<?php echo esc_attr($containerid);?>" class="re_ajax_pagination_btn def_btn"><?php esc_html_e('Show next', 'rehub-theme') ?></span></div>      
                    <?php endif ;?>                
                </div>
                <?php if (rehub_option('category_layout') == 'grid' || rehub_option('category_layout') == 'gridfull' ) : ?></div><?php endif;?> 
                <?php if ($enable_pagination == '1') :?>
                    <div class="pagination"><?php rehub_pagination();?></div>
                <?php endif ;?>                 
            <?php else : ?>     
                <h5><?php esc_html_e('Sorry. No posts in this category yet', 'rehub-theme'); ?></h5>            
            <?php endif; wp_reset_query(); ?>           
            <div class="clearfix"></div>
            <?php  $cat_data = get_option("category_$catID");?> 
            <?php if(!empty($cat_data['cat_second_description'])):?>
                <?php $cat_seo_description = $cat_data['cat_second_description'];?>
                <article class="cat_seo_description post"><?php echo wpautop( wptexturize(do_shortcode($cat_seo_description)));?></article>
            <?php endif;?>                      
        </div>  
        <!-- /Main Side -->
        <?php if (rehub_option('category_layout') == 'gridfull' || rehub_option('category_layout') == 'dealgridfull' || rehub_option('category_layout') == 'compactgridfull' || rehub_option('category_layout') == 'columngridfull' || rehub_option('category_layout') == 'cardblogfull') : ?>
        <?php else:?>
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
            <!-- /Sidebar --> 
        <?php endif ;?>
    </div>
</div>
<!-- /CONTENT -->     
<!-- FOOTER -->
<?php get_footer(); ?>