<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php
	/* Template Name: Page for visual layout builder (deprecated) */
?>
<?php 
    $header_disable = vp_metabox('vcr.header_disable');
    $footer_disable = vp_metabox('vcr.footer_disable');
    $content_type = vp_metabox('vcr.content_type');
    if ($content_type =='def') {$content_type = '';}     
?>
<?php if ($header_disable =='1') :?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)] <?php language_attributes(); ?>><![endif]-->
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width" />
<!-- feeds & pingback -->
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />	
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="rh-outer-wrap">
<div id="top_ankor"></div>
<?php $branded_bg_url = rehub_option('rehub_branded_bg_url');?>
<?php if ($branded_bg_url ) :?>
  <a id="branded_bg" href="<?php echo esc_url($branded_bg_url); ?>" target="_blank" rel="nofollow"></a>
<?php endif; ?>
<?php include(rh_locate_template('inc/parts/branded_banner.php')); ?>	
<!-- HEADER -->	
<?php elseif($header_disable =='2') :?>
<?php get_header(); ?> 
<?php $addstyles = '#main_header{position: absolute;}  
#main_header, .main-nav{background:none transparent !important;}  
nav.top_menu > ul > li > a, .user-ava-intop:after, .dl-menuwrapper button i, .dl-menuwrapper .re-compare-icon-toggle, nav.top_menu > ul > li > a{color: #fff !important} 
.is-sticky .logo_section_wrap{background: #000 !important}';
wp_register_style( 'rhheader-inline-style', false );
wp_enqueue_style( 'rhheader-inline-style' );
wp_add_inline_style('rhheader-inline-style', $addstyles);
?>  
<?php else :?>
<?php get_header(); ?>
<?php endif ;?>

<!-- CONTENT -->
<div class="rh-container <?php echo ''.$content_type ?>"> 
    <div class="rh-content-wrap clearfix">    
	    <!-- Main Side -->
        <div class="main-side visual_page_builder page_builder clearfix full_width" id="content">			
			<?php while (have_posts()) : the_post(); ?>
				<?php the_content();?>
			<?php endwhile; ?>
		</div>	
        <!-- /Main Side -->   
    </div>
</div>
<!-- /CONTENT -->     
<!-- FOOTER -->
<?php if ($footer_disable =='1') :?>
</div>
<span class="rehub_scroll" id="topcontrol" data-scrollto="#top_ankor"><i class="far fa-chevron-up"></i></span>
<?php wp_footer(); ?>
</body>
</html>
<?php else :?>
<?php get_footer(); ?>
<?php endif ;?>