<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php ob_start(); ?>
<style type="text/css">
<?php if (rehub_option('rehub_logo_pad') !='') :?>
	@media (min-width: 768px){
		header .logo-section{padding: <?php echo (int)rehub_option('rehub_logo_pad') ?>px 0;}		
	}
<?php endif; ?>
<?php if (is_page()) :?>
	<?php 
		global $post; 
		$postID = $post->ID;
		$bg_disable = get_post_meta($postID, "bg_disable", true);
		$menu_disable = get_post_meta($postID, "menu_disable", true);
		$content_type = get_post_meta($postID, "content_type", true);
	?>
	<?php if ($bg_disable == '1') :?>body{ background: none #fff}<?php endif; ?>
	<?php if ($menu_disable == '1') :?>nav.top_menu, .responsive_nav_wrap{display: none !important;}<?php endif; ?>
	<?php if ($content_type == 'full_post_area') :?>.rh-boxed-container .rh-outer-wrap{width:100% !important; overflow:hidden; background: transparent; box-shadow: none}<?php endif;?>
<?php endif; ?>	
<?php if (rehub_option('rehub_review_color')) :?>
	.rate-line .filled, .rate_bar_wrap .review-top .overall-score, .rate-bar-bar, .top_rating_item .score.square_score, .radial-progress .circle .mask .fill{background-color: <?php echo rehub_option('rehub_review_color') ?> ;}
	.meter-wrapper .meter, .rate_bar_wrap_two_reviews .score_val{border-color: <?php echo rehub_option('rehub_review_color') ?>;}
<?php endif; ?>	
<?php if (rehub_option('rehub_review_color_user')) :?>
	.user-review-criteria .rate-bar-bar{background-color: <?php echo rehub_option('rehub_review_color_user') ?> ;}
	.userstar-rating span:before{color: <?php echo rehub_option('rehub_review_color_user') ?>;}
	.rate_bar_wrap_two_reviews .user-review-criteria .score_val{border-color: <?php echo rehub_option('rehub_review_color_user') ?>;}
<?php endif; ?>
<?php if (rehub_option('rehub_enable_menu_shadow') ==1) :?>
	<?php if(rehub_option('rehub_header_style') == 'header_nine' || rehub_option('rehub_header_style') == 'header_five'):?>
		.logo_section_wrap{box-shadow: 0px 15px 30px 0px rgba(119, 123, 146, 0.1)}
	<?php else:?>
		.main-nav{box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(0, 0, 0, 0.03);}
	<?php endif;?>
<?php endif; ?>	
<?php if (rehub_option('header_menuline_type') == 1) :?>
	nav.top_menu > ul > li > a{padding: 6px 12px 10px 12px; font-size: 14px}
<?php elseif (rehub_option('header_menuline_type') == 2) :?>
	nav.top_menu > ul > li > a{padding: 11px 15px 15px 15px; font-size: 17px}
<?php endif; ?>	
<?php if (rehub_option('rehub_nav_font_custom')) :?>
	nav.top_menu > ul > li > a{font-size: <?php echo rehub_option('rehub_nav_font_custom');?>px}
<?php endif; ?>	
<?php if (rehub_option('rehub_nav_font_upper') =='1') :?>
	nav.top_menu > ul > li > a{text-transform: uppercase;}
<?php endif; ?>	
<?php if (rehub_option('rehub_nav_font_light') == '1') :?>
	nav.top_menu > ul > li > a{font-weight: normal; }
<?php endif; ?>
<?php if (rehub_option('rehub_nav_font_border') =='1') :?>
	nav.top_menu > ul > li, .main-nav.dark_style nav.top_menu>ul>li{border:none;}
<?php endif; ?>
<?php if(rehub_option('rehub_nav_font')) : ?>
	.dl-menuwrapper li a, nav.top_menu ul li a, #re_menu_near_logo li, #re_menu_near_logo li {
		font-family:"<?php echo rehub_option('rehub_nav_font'); ?>", trebuchet ms !important;
		font-weight:<?php echo rehub_option('rehub_nav_font_weight'); ?>;
		font-style:<?php echo rehub_option('rehub_nav_font_style');?>;
		<?php if(rehub_option('rehub_nav_font_trans') =='1') : ?>text-transform:none;<?php endif; ?>			
	}
<?php endif; ?>	
<?php if(rehub_option('rehub_headings_font')) : ?>
	.priced_block .btn_offer_block,
	.rh-deal-compact-btn,
	.wpsm-button.rehub_main_btn,
	.woocommerce div.product p.price,
	.rehub_feat_block div.offer_title,
	.rh_wrapper_video_playlist .rh_video_title_and_time .rh_video_title,
	.main_slider .flex-overlay h2,
	.main_slider .flex-overlay a.btn_more,
	.re-line-badge,
	.related_articles ul li > a,
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.tabs-menu li,
	.cats_def a,
	.btn_more,
	.widget.tabs > ul > li,
	.widget .title,
	.title h1,
	.title h5,
	.small_post blockquote p,
	.related_articles .related_title,
	#comments .title_comments,
	.commentlist .comment-author .fn,
	.commentlist .comment-author .fn a,
	#commentform #submit,
	.media_video > p,
	.rate_bar_wrap .review-top .review-text span.review-header,
	input[type="submit"], 
	input[type="button"], 
	input[type="reset"],
	.vc_btn3,
	.wpsm-numbox.wpsm-style6 span.num,
	.wpsm-numbox.wpsm-style5 span.num,
	.woocommerce ul.product_list_widget li a,
	.widget.better_woocat,
	.re-compare-destin.wpsm-button,
	.rehub-main-font,
	.vc_general.vc_btn3,
	.cegg-list-logo-title, 
	.logo .textlogo,
	.woocommerce .summary .masked_coupon,
	.woocommerce a.woo_loop_btn,
	.woocommerce input.button.alt,
	.woocommerce a.add_to_cart_button,
	.woocommerce .single_add_to_cart_button,
	.woocommerce div.product form.cart .button,
	.woocommerce .checkout-button.button,
	.woofiltersbig .prdctfltr_buttons a.prdctfltr_woocommerce_filter_submit,
	#buddypress button.submit,
	.wcv-grid a.button,
	input.gmw-submit,
	#ws-plugin--s2member-profile-submit,
	#rtmedia_create_new_album,
	input[type="submit"].dokan-btn-theme,
	a.dokan-btn-theme,
	.dokan-btn-theme, 
	.woocommerce div.product .single_add_to_cart_button,
	.woocommerce div.product .summary .masked_coupon,
	.woocommerce div.product .summary .price, 
	.wvm_plan,
	.wp-block-quote.is-style-large,
	.wp-block-button .wp-block-button__link,
	.comment-respond h3, 
	.related_articles .related_title,
	.re_title_inmodal,
	.widget_merchant_list .buttons_col a{
		font-family:"<?php echo rehub_option('rehub_headings_font'); ?>", trebuchet ms;
		font-style:<?php echo rehub_option('rehub_headings_font_style'); ?>;			
	}
	.main_slider .flex-overlay h2,
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.title h1,
	.title h5,
	.comment-respond h3,
	.def_btn{
		font-weight:<?php echo rehub_option('rehub_headings_font_weight'); ?>;
		<?php if(rehub_option('rehub_headings_font_upper') =='1') : ?>text-transform:uppercase;<?php endif; ?>
	}
	<?php if(defined( 'WCFMmp_TOKEN' )):?>
		.wcfm_membership_title, #wcfm-main-contentainer input.wcfm_submit_button, #wcfm-main-contentainer button.wcfm_submit_button, #wcfm-main-contentainer a.wcfm_submit_button, #wcfm-main-contentainer .wcfm_add_category_bt, #wcfm-main-contentainer .wcfm_add_attribute, #wcfm-main-contentainer .wcfm_add_attribute_term, #wcfm-main-contentainer input.upload_button, #wcfm-main-contentainer input.remove_button, #wcfm-main-contentainer .dataTables_wrapper .dt-buttons .dt-button, #wcfm_vendor_approval_response_button, #wcfm_bulk_edit_button, #wcfm_enquiry_submit_button{
			font-family:"<?php echo rehub_option('rehub_headings_font'); ?>", trebuchet ms;
			font-weight:<?php echo rehub_option('rehub_headings_font_weight'); ?>;
			font-style:<?php echo rehub_option('rehub_headings_font_style'); ?>;
		<?php if(rehub_option('rehub_headings_font_upper') =='1') : ?>text-transform:uppercase;<?php endif; ?>
	}
	<?php endif; ?>
<?php endif; ?>
<?php if(rehub_option('rehub_body_font')) : ?>
	.related_articles ul li > a, .sidebar, .prosconswidget, .rehub-body-font, body {
		font-family:"<?php echo rehub_option('rehub_body_font'); ?>", arial !important;
		font-weight:<?php echo rehub_option('rehub_body_font_weight'); ?>;
		font-style:<?php echo rehub_option('rehub_body_font_style'); ?>;			
	}
<?php endif; ?>	
<?php if(rehub_option('body_font_size')) : ?>
	<?php 
		$sizearray = array_map( 'trim', explode( ":", rehub_option('body_font_size') ) );
	?>
	article, .post {
		font-size:<?php echo intval($sizearray[0]);?>px;
		line-height: <?php echo (!empty($sizearray[1])) ? intval($sizearray[1]) : intval($sizearray[0])+12;?>px;	
	}
<?php endif; ?>		
<?php if(rehub_option('rehub_custom_color_nav') !='') : ?>
	header .main-nav, .main-nav.dark_style{
		background: none repeat scroll 0 0 <?php echo rehub_option('rehub_custom_color_nav'); ?>!important;
		box-shadow: none;			
	}
	.main-nav{ border-bottom: none;border-top: none;}
	.dl-menuwrapper .dl-menu{margin: 0 !important}
<?php endif; ?>	
<?php if(rehub_option('rehub_custom_color_top') !='') : ?>
	.header_top_wrap{
		background: none repeat scroll 0 0 <?php echo rehub_option('rehub_custom_color_top'); ?>!important;			
	}
	.header-top, .header_top_wrap{ border: none !important}
<?php endif; ?>	
<?php if(rehub_option('rehub_custom_color_top_font') !='') : ?>
	.header_top_wrap .user-ava-intop:after, .header-top .top-nav > ul > li > a, .header-top a.cart-contents, .header_top_wrap .icon-search-onclick:before, .header-top .top-social, .header-top .top-social a{
		color: <?php echo rehub_option('rehub_custom_color_top_font'); ?> !important;			
	}
	.header-top .top-nav li{border: none !important;}
<?php endif; ?>			
<?php if(rehub_option('rehub_custom_color_nav_font') !='') : ?>
	.main-nav .user-ava-intop:after, nav.top_menu > ul > li > a, .dl-menuwrapper button i{
		color: <?php echo rehub_option('rehub_custom_color_nav_font'); ?> !important;			
	}
	.dl-menuwrapper button svg line{stroke:<?php echo rehub_option('rehub_custom_color_nav_font'); ?> !important;}
	nav.top_menu > ul > li > a:hover{box-shadow: none;}
<?php endif; ?>	
<?php if (rehub_option('rehub_header_color_background') !='') :?>
	#main_header, .is-sticky .logo_section_wrap, .sticky-active.logo_section_wrap{background-color: <?php echo rehub_option('rehub_header_color_background'); ?> !important }
	.main-nav.white_style{border-top:none}
	nav.top_menu > ul:not(.off-canvas) > li > a:after{top:auto; bottom:0}
	.header-top{border: none;}
<?php endif; ?>
<?php if (rehub_option('rehub_header_background_image') !='') :?>
	<?php $bg_header_url = rehub_option('rehub_header_background_image'); ?>
	<?php $bg_header_position = (rehub_option('rehub_header_background_position') !='') ? rehub_option('rehub_header_background_position') : 'left'; ?>
	<?php $bg_header_repeat = (rehub_option('rehub_header_background_repeat') !='') ? rehub_option('rehub_header_background_repeat') : 'repeat'; ?>
	#main_header {background-image: url("<?php echo ''.$bg_header_url ?>") ; background-position: <?php echo ''.$bg_header_position ?> top; background-repeat: <?php echo ''.$bg_header_repeat ?>}
<?php endif; ?>			
<?php if(rehub_option('rehub_sidebar_left') =='1') : ?>
	<?php if(is_rtl()):?>
		.main-side {float:left;}
		.sidebar{float: right}
	<?php else:?>
		.main-side {float:right;}
		.sidebar{float: left}		
	<?php endif; ?>
<?php endif; ?>
<?php if(rehub_option('rehub_sidebar_left_shop') =='1') : ?>
	<?php if(is_rtl()):?>
		.left-sidebar-archive .main-side {float:left;}
		.left-sidebar-archive .sidebar{float: right}
	<?php else:?>
		.left-sidebar-archive .main-side {float:right;}
		.left-sidebar-archive .sidebar{float: left}		
	<?php endif; ?>
<?php endif; ?>	
<?php if (rehub_option('footer_color_background') !='') :?>
	.footer-bottom{background-color: <?php echo rehub_option('footer_color_background'); ?> !important }
	.footer-bottom .footer_widget{border: none !important}
<?php endif; ?>	
<?php if (rehub_option('footer_background_image') !='') :?>
	<?php $bg_footer_url = rehub_option('footer_background_image'); ?>
	<?php $bg_footer_position = (rehub_option('footer_background_position') !='') ? rehub_option('footer_background_position') : 'left'; ?>
	<?php $bg_footer_repeat = (rehub_option('footer_background_repeat') !='') ? rehub_option('footer_background_repeat') : 'repeat'; ?>
	.footer-bottom{background-image: url("<?php echo ''.$bg_footer_url ?>") ; background-position: <?php echo ''.$bg_footer_position ?> bottom; background-repeat: <?php echo ''.$bg_footer_repeat ?>}
<?php endif; ?>	

/**********MAIN COLOR SCHEME*************/
<?php 
	if (rehub_option('rehub_custom_color')) {
		$maincolor = rehub_option('rehub_custom_color');
	} 
	else {
		$maincolor = REHUB_MAIN_COLOR;
	}
?>
.widget .title:after{border-bottom: 2px solid <?php echo ''.$maincolor; ?>;}

.rehub-main-color-border, nav.top_menu > ul > li.vertical-menu.border-main-color .sub-menu, .rh-main-bg-hover:hover, .wp-block-quote, ul.def_btn_link_tabs li.active a, .wp-block-pullquote{border-color: <?php echo ''.$maincolor; ?>;}
.wpsm_promobox.rehub_promobox { border-left-color: <?php echo ''.$maincolor; ?>!important; }
.color_link{ color: <?php echo ''.$maincolor; ?> !important;}
.search-header-contents{border-top-color: <?php echo ''.$maincolor; ?>; }

.wpb_content_element.wpsm-tabs.n_b_tab .wpb_tour_tabs_wrapper .wpb_tabs_nav .ui-state-active a{ border-bottom: 3px solid <?php echo ''.$maincolor; ?> !important }
.featured_slider:hover .score, .top_chart_controls .controls:hover, article.post .wpsm_toplist_heading:before{border-color:<?php echo ''.$maincolor; ?>;}
.btn_more:hover, .small_post .overlay .btn_more:hover, .tw-pagination .current { border: 1px solid <?php echo ''.$maincolor; ?>; color: #fff }
.wpsm-tabs ul.ui-tabs-nav .ui-state-active a, .rehub_woo_review .rehub_woo_tabs_menu li.current { border-top: 3px solid <?php echo ''.$maincolor; ?>; }
.wps_promobox { border-left: 3px solid <?php echo ''.$maincolor; ?>; }
.gallery-pics .gp-overlay {  box-shadow: 0 0 0 4px <?php echo ''.$maincolor; ?> inset; }
.post .rehub_woo_tabs_menu li.current, .woocommerce div.product .woocommerce-tabs ul.tabs li.active{ border-top:2px solid <?php echo ''.$maincolor; ?>;}
.rething_item a.cat{border-bottom-color: <?php echo ''.$maincolor; ?>}
nav.top_menu ul li ul.sub-menu { border-bottom: 2px solid <?php echo ''.$maincolor; ?>; }
.widget.deal_daywoo, .elementor-widget-wpsm_woofeatured .deal_daywoo{border: 3px solid <?php echo ''.$maincolor; ?>; padding: 20px; background: #fff; }
.deal_daywoo .wpsm-bar-bar{background-color: <?php echo ''.$maincolor; ?> !important}

/*BGS*/
#buddypress div.item-list-tabs ul li.selected a span,
#buddypress div.item-list-tabs ul li.current a span,
#buddypress div.item-list-tabs ul li a span,
.user-profile-div .user-menu-tab > li.active > a,
.user-profile-div .user-menu-tab > li.active > a:focus,
.user-profile-div .user-menu-tab > li.active > a:hover,
.slide .news_cat a,
.news_in_thumb:hover .news_cat a,
.news_out_thumb:hover .news_cat a,
.col-feat-grid:hover .news_cat a,
.carousel-style-deal .re_carousel .controls,
.re_carousel .controls:hover,
.openedprevnext .postNavigation a,
.postNavigation a:hover,
.top_chart_pagination a.selected,
.flex-control-paging li a.flex-active,
.flex-control-paging li a:hover,
.widget_edd_cart_widget .edd-cart-number-of-items .edd-cart-quantity,
.btn_more:hover,
.tabs-menu li:hover,
.tabs-menu li.current,
.featured_slider:hover .score,
#bbp_user_edit_submit,
.bbp-topic-pagination a,
.bbp-topic-pagination a,
.custom-checkbox label.checked:after,
.slider_post .caption,
ul.postpagination li.active a,
ul.postpagination li:hover a,
ul.postpagination li a:focus,
.top_theme h5 strong,
.re_carousel .text:after,
#topcontrol:hover,
.main_slider .flex-overlay:hover a.read-more,
.rehub_chimp #mc_embed_signup input#mc-embedded-subscribe, 
#rank_1.rank_count, 
#toplistmenu > ul li:before,
.rehub_chimp:before,
.wpsm-members > strong:first-child,
.r_catbox_btn,
.wpcf7 .wpcf7-submit,
.comm_meta_wrap .rh_user_s2_label,
.wpsm_pretty_hover li:hover,
.wpsm_pretty_hover li.current,
.rehub-main-color-bg,
.togglegreedybtn:after,
.rh-bg-hover-color:hover .news_cat a,
.rh-main-bg-hover:hover,
.rh_wrapper_video_playlist .rh_video_currently_playing, 
.rh_wrapper_video_playlist .rh_video_currently_playing.rh_click_video:hover,
.rtmedia-list-item .rtmedia-album-media-count,
.tw-pagination .current,
.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.active,
.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li:hover,
.dokan-dashboard .dokan-dash-sidebar ul.dokan-dashboard-menu li.dokan-common-links a:hover,
#ywqa-submit-question,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.rh-hov-bor-line > a:after, nav.top_menu > ul:not(.off-canvas) > li > a:after, .rh-border-line:after,
.wpsm-table.wpsm-table-main-color table tr th{ background: <?php echo ''.$maincolor;?>;}
@media (max-width: 767px) {
	.postNavigation a{ background: <?php echo ''.$maincolor; ?>; }
}
.rh-main-bg-hover:hover, .rh-main-bg-hover:hover .whitehovered{color: #fff !important}

/*color*/
a, 
.carousel-style-deal .deal-item .priced_block .price_count ins, 
nav.top_menu ul li.menu-item-has-children ul li.menu-item-has-children > a:before, 
.top_chart_controls .controls:hover,
.flexslider .fa-pulse,
.footer-bottom .widget .f_menu li a:hover,
.comment_form h3 a,
.bbp-body li.bbp-forum-info > a:hover,
.bbp-body li.bbp-topic-title > a:hover,
#subscription-toggle a:before,
#favorite-toggle a:before,
.aff_offer_links .aff_name a,
.rh-deal-price,
.commentlist .comment-content small a,
.related_articles .title_cat_related a,
article em.emph,
.campare_table table.one td strong.red,
.sidebar .tabs-item .detail p a,
.footer-bottom .widget .title span,
footer p a,
.welcome-frase strong, 
article.post .wpsm_toplist_heading:before, 
.post a.color_link,
.categoriesbox:hover h3 a:after,
.bbp-body li.bbp-forum-info > a,
.bbp-body li.bbp-topic-title > a,
.widget .title i,
.woocommerce-MyAccount-navigation ul li.is-active a,
.category-vendormenu li.current a,
.deal_daywoo .title,
.rehub-main-color,
.wpsm_pretty_colored ul li.current a,
.wpsm_pretty_colored ul li.current,
.rh-heading-hover-color:hover h2 a,
.rh-heading-hover-color:hover h3 a,
.rh-heading-hover-color:hover h4 a,
.rh-heading-hover-color:hover h5 a,
.rh-heading-hover-color:hover .rh-heading-hover-item a,
.rh-heading-icon:before,
.widget_layered_nav ul li.chosen a:before,
.wp-block-quote.is-style-large p,
ul.page-numbers li span.current, 
ul.page-numbers li a:hover,  
ul.page-numbers li.active a, 
.page-link > span:not(.page-link-title),
blockquote:not(.wp-block-quote) p,
span.re_filtersort_btn:hover, 
span.active.re_filtersort_btn,
.deal_daywoo .price,
div.sortingloading:after { color: <?php echo ''.$maincolor; ?>; }

<?php if (rehub_option('rehub_color_link')) :?>
	a{color: <?php echo rehub_option('rehub_color_link') ?>;}
<?php endif; ?>

/**********SECONDARY COLOR SCHEME*************/
<?php 
	if (rehub_option('rehub_sec_color')) {
		$secondarycolor = rehub_option('rehub_sec_color');
	} 
	else {
		$secondarycolor = REHUB_SECONDARY_COLOR;
	}
?>
 .page-link > span:not(.page-link-title), 
.postimagetrend .title, .widget.widget_affegg_widget .title, 
.widget.top_offers .title, 
.widget.cegg_widget_products .title,
header .header_first_style .search form.search-form [type="submit"], 
header .header_eight_style .search form.search-form [type="submit"],
.more_post a, 
.more_post span, 
.filter_home_pick span.active, 
.filter_home_pick span:hover, 
.filter_product_pick span.active,
.filter_product_pick span:hover,
.rh_tab_links a.active, 
.rh_tab_links a:hover, 
.wcv-navigation ul.menu li.active, 
.wcv-navigation ul.menu li:hover a, 
form.search-form [type="submit"],
.rehub-sec-color-bg,
input#ywqa-submit-question,
input#ywqa-send-answer, 
.woocommerce button.button.alt,
.tabsajax span.active.re_filtersort_btn,
.wpsm-table.wpsm-table-sec-color table tr th{ background: <?php echo ''.$secondarycolor ?> !important; color: #fff !important; outline: 0}
.widget.widget_affegg_widget .title:after, .widget.top_offers .title:after, .vc_tta-tabs.wpsm-tabs .vc_tta-tab.vc_active, .vc_tta-tabs.wpsm-tabs .vc_tta-panel.vc_active .vc_tta-panel-heading, .widget.cegg_widget_products .title:after{border-top-color: <?php echo ''.$secondarycolor ?> !important;}  
.page-link > span:not(.page-link-title){border: 1px solid <?php echo ''.$secondarycolor ?>;}  
.page-link > span:not(.page-link-title), .header_first_style .search form.search-form [type="submit"] i{color:#fff !important;}
.rh_tab_links a.active,
.rh_tab_links a:hover,
.rehub-sec-color-border,
nav.top_menu > ul > li.vertical-menu.border-sec-color > .sub-menu{border-color: <?php echo ''.$secondarycolor ?>}
.rh_wrapper_video_playlist .rh_video_currently_playing, .rh_wrapper_video_playlist .rh_video_currently_playing.rh_click_video:hover {background-color: <?php echo ''.$secondarycolor; ?>;box-shadow: 1200px 0 0 <?php echo ''.$secondarycolor; ?> inset;}	
.rehub-sec-color{color: <?php echo ''.$secondarycolor ?>}	
<?php if (REHUB_NAME_ACTIVE_THEME == 'REPICK'):?>
.rehub_chimp{background-color: <?php echo ''.$secondarycolor; ?>;border-color: <?php echo ''.$secondarycolor; ?>;}
<?php endif;?>

/**********BUTTON COLOR SCHEME*************/
<?php 
	$boxshadow = $boxshadowhover = '';
	if (rehub_option('rehub_btnoffer_color')) {
		$btncolor = rehub_option('rehub_btnoffer_color');
	} 	
	else {
		$btncolor = REHUB_BUTTON_COLOR;
	}
	if (rehub_option('rehub_btnoffer_color_hover')) {
		$btncolorhover = rehub_option('rehub_btnoffer_color_hover');
	}else{
		$btncolorhover = $btncolor;
	}
	if (rehub_option('rehub_btnoffer_color_text')) {
		$btncolortext = rehub_option('rehub_btnoffer_color_text');
	}else{
		$btncolortext = REHUB_BUTTON_COLOR_TEXT;
	}
	if (rehub_option('rehub_btnofferhover_color_text')) {
		$btncolorhovertext = rehub_option('rehub_btnofferhover_color_text');
	}else{
		$btncolorhovertext = $btncolortext;
	}			
?>
<?php if (rehub_option('enable_smooth_btn') == 1):?>
	<?php $boxshadow = hex2rgba($btncolor, 0.25);?>
	<?php $boxshadowhover = hex2rgba($btncolorhover, 0.35);?>
	.price_count, .rehub_offer_coupon, #buddypress .dir-search input[type=text], .gmw-form-wrapper input[type=text], .gmw-form-wrapper select, .rh_post_layout_big_offer .priced_block .btn_offer_block, #buddypress a.button, .btn_more, #main_header .wpsm-button, #rh-header-cover-image .wpsm-button, #wcvendor_image_bg .wpsm-button, .rate-bar-bar, .rate-bar, .rehub-main-smooth, .re_filter_instore span.re_filtersort_btn:hover, .re_filter_instore span.active.re_filtersort_btn, .head_search .search-form, .head_search form.search-form input[type="text"]{border-radius: 100px}
	.news .priced_block .price_count, .blog_string  .priced_block .price_count, .main_slider .price_count{margin-right: 5px}
	.right_aff .priced_block .btn_offer_block, .right_aff .priced_block .price_count{border-radius: 0 !important}
	form.search-form.product-search-form input[type="text"]{border-radius: 4px 0 0 4px;}
	form.search-form [type="submit"]{border-radius: 0 4px 4px 0;}
	.rtl form.search-form.product-search-form input[type="text"]{border-radius: 0 4px 4px 0;}
	.rtl form.search-form [type="submit"]{border-radius: 4px 0 0 4px;}
	.woocommerce .products.grid_woo .product, .rh_offer_list .offer_thumb .deal_img_wrap, .rehub_chimp #mc_embed_signup input.email, #mc_embed_signup input#mc-embedded-subscribe, .grid_onsale, .def_btn, input[type="submit"], input[type="button"], input[type="reset"], .wpsm-button, #buddypress div.item-list-tabs ul li a, #buddypress .standard-form input[type=text], #buddypress .standard-form textarea, .blacklabelprice{border-radius: 5px}
	.news-community, .review-top .overall-score, .rate_bar_wrap, .rh_offer_list, .woo-tax-logo, #buddypress form#whats-new-form, #buddypress div#invite-list, #buddypress #send-reply div.message-box, .rehub-sec-smooth, #wcfm-main-contentainer #wcfm-content, .wcfm_welcomebox_header{border-radius: 8px}
	.review-top .overall-score span.overall-text{border-radius: 0 0 8px 8px}
	.coupon_btn:before{display: none;}
<?php elseif (rehub_option('enable_smooth_btn') == 2):?>
	<?php $boxshadow = hex2rgba($btncolor, 0.2);?>
	<?php $boxshadowhover = hex2rgba($btncolorhover, 0.4);?>
	.news .priced_block .price_count, .blog_string  .priced_block .price_count, .main_slider .price_count{margin-right: 5px}	
	.right_aff .priced_block .btn_offer_block, .right_aff .priced_block .price_count{border-radius: 0 !important}
	form.search-form.product-search-form input[type="text"]{border-radius: 4px 0 0 4px;}
	form.search-form [type="submit"]{border-radius: 0 4px 4px 0;}
	.rtl form.search-form.product-search-form input[type="text"]{border-radius: 0 4px 4px 0;}
	.rtl form.search-form [type="submit"]{border-radius: 4px 0 0 4px;}
	.price_count, .rehub_offer_coupon, #buddypress .dir-search input[type=text], .gmw-form-wrapper input[type=text], .gmw-form-wrapper select, #buddypress a.button, .btn_more, #main_header .wpsm-button, #rh-header-cover-image .wpsm-button, #wcvendor_image_bg .wpsm-button, input[type="text"], textarea, input[type="tel"], input[type="password"], input[type="email"], input[type="url"], input[type="number"], .def_btn, input[type="submit"], input[type="button"], input[type="reset"], .rh_offer_list .offer_thumb .deal_img_wrap, .grid_onsale, .rehub-main-smooth, .re_filter_instore span.re_filtersort_btn:hover, .re_filter_instore span.active.re_filtersort_btn, #buddypress .standard-form input[type=text], #buddypress .standard-form textarea, .blacklabelprice{border-radius: 4px}
	.news-community, .woocommerce .products.grid_woo .product, .rehub_chimp #mc_embed_signup input.email, #mc_embed_signup input#mc-embedded-subscribe, .rh_offer_list, .woo-tax-logo, #buddypress div.item-list-tabs ul li a, #buddypress form#whats-new-form, #buddypress div#invite-list, #buddypress #send-reply div.message-box, .rehub-sec-smooth, .rate-bar-bar, .rate-bar, #wcfm-main-contentainer #wcfm-content, .wcfm_welcomebox_header{border-radius: 5px}
<?php endif;?>
/*woo style btn*/
.woocommerce .summary .masked_coupon,
.woocommerce a.woo_loop_btn,
.woocommerce .button.checkout,
.woocommerce input.button.alt,
.woocommerce a.add_to_cart_button,
.woocommerce-page a.add_to_cart_button,
.woocommerce .single_add_to_cart_button,
.woocommerce div.product form.cart .button,
.woocommerce .checkout-button.button,
.woofiltersbig .prdctfltr_buttons a.prdctfltr_woocommerce_filter_submit,
.priced_block .btn_offer_block,
.priced_block .button, 
.rh-deal-compact-btn, 
input.mdf_button, 
#buddypress input[type="submit"], 
#buddypress input[type="button"], 
#buddypress input[type="reset"], 
#buddypress button.submit,
.wpsm-button.rehub_main_btn,
.wcv-grid a.button,
input.gmw-submit,
#ws-plugin--s2member-profile-submit,
#rtmedia_create_new_album,
input[type="submit"].dokan-btn-theme, a.dokan-btn-theme, .dokan-btn-theme,
#wcfm_membership_container a.wcfm_submit_button,
.woocommerce button.button,
.rehub-main-btn-bg 
{ background: none <?php echo ''.$btncolor ?> !important; 
	color: <?php echo ''.$btncolortext ?> !important; 
	fill: <?php echo ''.$btncolortext ?> !important;
	border:none !important;
	text-decoration: none !important; 
	outline: 0; 
	<?php if($boxshadow) :?>
		box-shadow: -1px 6px 19px <?php echo ''.$boxshadow;?> !important;		
	<?php else:?>
		box-shadow: 0 2px 2px #E7E7E7 !important;
	<?php endif; ?>
	<?php if(rehub_option('enable_smooth_btn') == 1) :?>
		border-radius: 100px !important;
	<?php elseif (rehub_option('enable_smooth_btn') == 2):?>
		border-radius: 4px !important;		
	<?php else:?>
		border-radius: 0 !important;
	<?php endif; ?>
}
.rehub-main-btn-bg > a{color: <?php echo ''.$btncolortext ?> !important;}

.woocommerce a.woo_loop_btn:hover,
.woocommerce .button.checkout:hover,
.woocommerce input.button.alt:hover,
.woocommerce a.add_to_cart_button:hover,
.woocommerce-page a.add_to_cart_button:hover,
.woocommerce a.single_add_to_cart_button:hover,
.woocommerce-page a.single_add_to_cart_button:hover,
.woocommerce div.product form.cart .button:hover,
.woocommerce-page div.product form.cart .button:hover,
.woocommerce .checkout-button.button:hover,
.woofiltersbig .prdctfltr_buttons a.prdctfltr_woocommerce_filter_submit:hover,
.priced_block .btn_offer_block:hover, 
.wpsm-button.rehub_main_btn:hover, 
#buddypress input[type="submit"]:hover, 
#buddypress input[type="button"]:hover, 
#buddypress input[type="reset"]:hover, 
#buddypress button.submit:hover, 
.small_post .btn:hover,
.ap-pro-form-field-wrapper input[type="submit"]:hover,
.wcv-grid a.button:hover,
#ws-plugin--s2member-profile-submit:hover,
input[type="submit"].dokan-btn-theme:hover, a.dokan-btn-theme:hover, .dokan-btn-theme:hover,
.rething_button .btn_more:hover,
#wcfm_membership_container a.wcfm_submit_button:hover,
.woocommerce button.button:hover,
.rehub-main-btn-bg:hover,
.rehub-main-btn-bg:hover > a{ 
	background: none <?php echo ''.$btncolorhover ?> !important;
	color: <?php echo ''.$btncolorhovertext ?> !important; 
	<?php if($boxshadowhover) :?>
		box-shadow: -1px 6px 13px <?php echo ''.$boxshadowhover;?> !important;		
	<?php else:?>
		box-shadow: -1px 6px 13px #d3d3d3 !important;
	<?php endif; ?> 
	border-color: transparent;}
.rehub_offer_coupon:hover{border: 1px dashed <?php echo ''.$btncolorhover ?>; }
.rehub_offer_coupon:hover i.far, .rehub_offer_coupon:hover i.fal, .rehub_offer_coupon:hover i.fas{ color: <?php echo ''.$btncolorhover ?>}
.re_thing_btn .rehub_offer_coupon.not_masked_coupon:hover{color: <?php echo ''.$btncolorhover ?> !important}

.woocommerce a.woo_loop_btn:active,
.woocommerce .button.checkout:active,
.woocommerce .button.alt:active,
.woocommerce a.add_to_cart_button:active,
.woocommerce-page a.add_to_cart_button:active,
.woocommerce a.single_add_to_cart_button:active,
.woocommerce-page a.single_add_to_cart_button:active,
.woocommerce div.product form.cart .button:active,
.woocommerce-page div.product form.cart .button:active, 
.woocommerce .checkout-button.button:active,
.woofiltersbig .prdctfltr_buttons a.prdctfltr_woocommerce_filter_submit:active,
.wpsm-button.rehub_main_btn:active, 
#buddypress input[type="submit"]:active, 
#buddypress input[type="button"]:active, 
#buddypress input[type="reset"]:active, 
#buddypress button.submit:active,
.ap-pro-form-field-wrapper input[type="submit"]:active,
.wcv-grid a.button:active,
#ws-plugin--s2member-profile-submit:active,
input[type="submit"].dokan-btn-theme:active, a.dokan-btn-theme:active, .dokan-btn-theme:active,
.woocommerce button.button:active,
.rehub-main-btn-bg:active{ 
	background: none <?php echo ''.$btncolor ?> !important; 
	box-shadow: 0 1px 0 #999 !important; 
	top:2px;
	color: <?php echo ''.$btncolorhovertext ?> !important;
}

.rehub_btn_color {background-color: <?php echo ''.$btncolor ?>; border: 1px solid <?php echo ''.$btncolor ?>; color: <?php echo ''.$btncolortext ?>; text-shadow: none}
.rehub_btn_color:hover{color: <?php echo ''.$btncolorhovertext ?>;background-color: <?php echo ''.$btncolorhover ?>;border: 1px solid <?php echo ''.$btncolorhover ?>;}
.rething_button .btn_more{border: 1px solid <?php echo ''.$btncolor ?>;color: <?php echo ''.$btncolor ?>;}
.rething_button .priced_block.block_btnblock .price_count{color: <?php echo ''.$btncolor ?>; font-weight: normal;}
.widget_merchant_list .buttons_col{background-color: <?php echo ''.$btncolor ?> !important;}
.widget_merchant_list .buttons_col a{color: <?php echo ''.$btncolortext ?> !important;}
.rehub-svg-btn-fill svg{fill:<?php echo ''.$btncolor ?>;}
.rehub-svg-btn-stroke svg{stroke:<?php echo ''.$btncolor ?>;}
@media (max-width: 767px){
	#float-panel-woo-area{border-top: 1px solid <?php echo ''.$btncolor ?>}
}
<?php if(rehub_option('rehub_btnoffer_color_text')):?>
	.rh_post_layout_big_offer .priced_block .btn_offer_block{text-shadow: none}
<?php endif;?>

<?php if(rehub_option('width_layout') =='compact') : ?>
	@media screen and (min-width: 1140px) {
	.rh-boxed-container .rh-outer-wrap{width: 1120px}
	.rh-container, .content{width: 1080px; }
	.centered-container .vc_col-sm-12 > * > .wpb_wrapper, .vc_section > .vc_row, body .elementor-section.elementor-section-boxed > .elementor-container{max-width: 1080px} 
	.vc_row.vc_rehub_container > .vc_col-sm-8, .main-side:not(.full_width){width: 755px}
	.vc_row.vc_rehub_container>.vc_col-sm-4, .sidebar, .side-twocol{width: 300px}
	.side-twocol .columns {height: 200px}
	.main_slider.flexslider .slides .slide{ height: 418px; line-height: 418px}
	.main_slider.flexslider{height: 418px}	
	.main-side, .gallery-pics{width:728px;}
	.main_slider.flexslider{width: calc(100% - 325px);}
	.main_slider .flex-overlay h2{ font-size: 36px; line-height: 34px}
	.offer_grid .offer_thumb{ height: 130px}
	.offer_grid .offer_thumb img, .offer_grid figure img{max-height: 130px}
	header .logo { max-width: 300px;}	
	.rh_video_playlist_column_full .rh_container_video_playlist{ width: 320px !important}
  	.rh_video_playlist_column_full .rh_wrapper_player {width: calc(100% - 320px) !important;}
  	.rehub_chimp h3{font-size: 20px}
	.outer_mediad_left{margin-left:-670px !important}
	.outer_mediad_right{margin-left:550px  !important}

	}
<?php elseif(rehub_option('width_layout') =='extended') : ?>
	.rh_deal_block .redemptionText .code, .rh_deal_block .not_masked_coupon{display: block; margin: 10px 0 0 0; float: none;}
	.rh_deal_block .rh-deal-left, .rh_deal_block .rh-deal-right{display: block; padding: 0}
	.rh_deal_block .rh-deal-btn, .rh_deal_block .rh-deal-right .rh-deal-price{text-align: inherit;}
	#content-sticky-panel{margin-left: -90px}
	@media (min-width:1400px){ 
		nav.top_menu > ul > li.vertical-menu > ul > li.inner-700 > .sub-menu{min-width: 850px;}
		.postimagetrend.two_column .wrap img{min-height: 120px}.postimagetrend.two_column .wrap{height: 120px}
		.rh-boxed-container .rh-outer-wrap{width: 1380px}
		.rh-container, .content{width:1330px;} 
		.centered-container .vc_col-sm-12 > * > .wpb_wrapper, .vc_section > .vc_row, .wcfm-membership-wrapper, body .elementor-section.elementor-section-boxed > .elementor-container{max-width:1330px;}
		.sidebar, .side-twocol, .vc_row.vc_rehub_container > .vc_col-sm-4{ width: 300px} 
		.vc_row.vc_rehub_container > .vc_col-sm-8, .main-side:not(.full_width), .main_slider.flexslider{width:1000px;} 
	}
	@media (min-width:1600px){
		.rehub_chimp h3{font-size: 20px} 
		.rh-boxed-container .rh-outer-wrap{width: 1580px}
		.rh-container, .content{width:1530px;} 
		.centered-container .vc_col-sm-12 > * > .wpb_wrapper, .vc_section > .vc_row, .wcfm-membership-wrapper, body .elementor-section.elementor-section-boxed > .elementor-container{max-width:1530px;}
		.sidebar, .side-twocol, .vc_row.vc_rehub_container > .vc_col-sm-4{ width: 300px} 
		.vc_row.vc_rehub_container > .vc_col-sm-8, .main-side:not(.full_width), .main_slider.flexslider{width:1200px;} 
	}
<?php endif; ?>	

<?php if(rehub_option('badge_color_1') !='') : ?>
	.re-starburst.badge_1, .re-starburst.badge_1 span, .re-line-badge.badge_1, .re-ribbon-badge.badge_1 span{background: <?php echo rehub_option('badge_color_1')?>;}
	.table_view_charts .top_chart_item.badge_1{border-top: 1px solid <?php echo rehub_option('badge_color_1')?>;}
	.re-line-badge.re-line-table-badge.badge_1:before{border-top-color: <?php echo rehub_option('badge_color_1')?>}
	.re-line-badge.re-line-table-badge.badge_1:after{border-bottom-color: <?php echo rehub_option('badge_color_1')?>}
<?php endif;?>
<?php if(rehub_option('badge_color_2') !='') : ?>
	.re-starburst.badge_2, .re-starburst.badge_2 span, .re-line-badge.badge_2, .re-ribbon-badge.badge_2 span{background: <?php echo rehub_option('badge_color_2')?>;}
	.table_view_charts .top_chart_item.ed_choice_col.badge_2, .table_view_charts .top_chart_item.ed_choice_col.badge_2 li:first-child:before, .table_view_charts .top_chart_item.ed_choice_col.badge_2 > ul > li:last-child:before{border-top: 1px solid <?php echo rehub_option('badge_color_2')?>;}
	.table_view_charts .top_chart_item.ed_choice_col.badge_2 > ul > li:last-child{border-bottom:1px solid <?php echo rehub_option('badge_color_2')?>;}
	.re-line-badge.re-line-table-badge.badge_2:before{border-top-color: <?php echo rehub_option('badge_color_2')?>}
	.re-line-badge.re-line-table-badge.badge_2:after{border-bottom-color: <?php echo rehub_option('badge_color_2')?>}
<?php endif;?>
<?php if(rehub_option('badge_color_3') !='') : ?>
	.re-starburst.badge_3, .re-starburst.badge_3 span, .re-line-badge.badge_3, .re-ribbon-badge.badge_3 span{background: <?php echo rehub_option('badge_color_3')?>;}
	.table_view_charts .top_chart_item.ed_choice_col.badge_3, .table_view_charts .top_chart_item.ed_choice_col.badge_3 li:first-child:before, .table_view_charts .top_chart_item.ed_choice_col.badge_3 > ul > li:last-child:before{border-top: 1px solid <?php echo rehub_option('badge_color_3')?>;}
	.table_view_charts .top_chart_item.ed_choice_col.badge_3 > ul > li:last-child{border-bottom:1px solid <?php echo rehub_option('badge_color_3')?>;}
	.re-line-badge.re-line-table-badge.badge_3:before{border-top-color: <?php echo rehub_option('badge_color_3')?>}
	.re-line-badge.re-line-table-badge.badge_3:after{border-bottom-color: <?php echo rehub_option('badge_color_3')?>}
<?php endif;?>
<?php if(rehub_option('badge_color_4') !='') : ?>
	.re-starburst.badge_4, .re-starburst.badge_4 span, .re-line-badge.badge_4, .re-ribbon-badge.badge_4 span{background: <?php echo rehub_option('badge_color_4')?>;}
	.table_view_charts .top_chart_item.ed_choice_col.badge_4, .table_view_charts .top_chart_item.ed_choice_col.badge_4 li:first-child:before, .table_view_charts .top_chart_item.ed_choice_col.badge_4 > ul > li:last-child:before{border-top: 1px solid <?php echo rehub_option('badge_color_4')?>;}
	.table_view_charts .top_chart_item.ed_choice_col.badge_4 > ul > li:last-child{border-bottom:1px solid <?php echo rehub_option('badge_color_4')?>;}
	.re-line-badge.re-line-table-badge.badge_4:before{border-top-color: <?php echo rehub_option('badge_color_4')?>}
	.re-line-badge.re-line-table-badge.badge_4:after{border-bottom-color: <?php echo rehub_option('badge_color_4')?>}
<?php endif;?>

<?php if (rehub_option('rehub_color_background') ) :?>
	<?php $bg_url = (rehub_option('rehub_background_image') !='') ? 'background-image: url("'.rehub_option('rehub_background_image').'");' : 'background-image:none';?>
	<?php $bg_repeat = (rehub_option('rehub_background_repeat') !='') ? 'background-repeat:'.rehub_option('rehub_background_repeat').';' : '';?>
	<?php $bg_position = (rehub_option('rehub_background_position') !='') ? rehub_option('rehub_background_position') : 'left';?>		
	<?php $bg_fixed = (rehub_option('rehub_background_fixed') !='') ? 'background-attachment:fixed;' : '';?>	
	<?php $bg_color = rehub_option('rehub_color_background') ?>	
	body, body.dark_body{background-color: <?php echo ''.$bg_color ?>; background-position: <?php echo ''.$bg_position ?> top; <?php echo ''.$bg_repeat; ?><?php echo ''.$bg_url; ?><?php echo ''.$bg_fixed; ?>}
<?php endif; ?>	
<?php if (rehub_option('rehub_branded_bg_url') ) :?>
	#branded_bg {height: 100%;left: 0;position: fixed;top: 0;width: 100%;z-index: 0;}
	footer, .top_theme, .content, .footer-bottom, header { position: relative; z-index: 1 }
<?php endif; ?>	
<?php if (REHUB_NAME_ACTIVE_THEME == 'REHUB' || REHUB_NAME_ACTIVE_THEME == 'RECASH') :?>
	@media(min-width: 1224px) {
		.single-post .full_width > article.post, single-product .full_width > article.post{padding: 32px}
		.title_single_area.full_width{margin: 25px 32px 0 32px;}	
		.main-side .title_single_area.full_width{margin: 0;}
		.full_width .wpsm-comptable td img{padding:5px}
	}
<?php endif; ?>	
<?php if(rehub_option('rehub_bpheader_image') !='') : ?>
	#bprh-full-header-image{background-image: url("<?php echo rehub_option('rehub_bpheader_image'); ?>");background-position:center top;background-repeat:no-repeat;background-size:cover;}
<?php endif; ?>
<?php if(defined( 'WCFMmp_TOKEN' )){
	$wcfm_store_color_settings = get_option( 'wcfm_store_color_settings', array() );
	$headerbg = (isset($wcfm_store_color_settings['header_background'])) ? $wcfm_store_color_settings['header_background'] : '#222222';
	$headerbg1 = hex2rgba($headerbg, 0.1);
	$headerbg2 = hex2rgba($headerbg, 0.35);
	$headerbg3 = hex2rgba($headerbg, 0.5);
	echo '#wcfmmp-store #wcfm_store_header{
	background: -webkit-linear-gradient(top,rgba(0,0,0,0), '.$headerbg1.' 30%, '.$headerbg2.' 80%,'.$headerbg3.') !important;
    background: linear-gradient(180deg,rgba(0,0,0,0) 0,'.$headerbg1.' 30%,'.$headerbg2.' 80%,'.$headerbg3.') !important;}';
}?>
<?php if(class_exists('Woocommerce')):?>
	<?php if(rehub_option('wooloop_heading_color') !='') : ?>
		.woocommerce .products h3 a{color: <?php echo rehub_option('wooloop_heading_color');?>}
	<?php endif;?>
	<?php if(rehub_option('wooloop_heading_size') !='') : ?>
		body .woocommerce .products .product h3{font-size: <?php echo rehub_option('wooloop_heading_size');?>px}
	<?php endif;?>
	<?php if(rehub_option('wooloop_price_color') !='') : ?>
		body .woocommerce .products .product .price{color: <?php echo rehub_option('wooloop_price_color');?>}
	<?php endif;?>
	<?php if(rehub_option('wooloop_price_size') !='') : ?>
		body .woocommerce .products .product .price{font-size: <?php echo rehub_option('wooloop_price_size');?>px}
	<?php endif;?>
	<?php if(rehub_option('wooloop_sale_color') !='') : ?>
		.woocommerce .onsale{background-color: <?php echo rehub_option('wooloop_sale_color');?>}
	<?php endif;?>				
<?php endif;?>
<?php if(rehub_option('theme_subset') !='') : ?>
	<?php if(rehub_option('theme_subset') =='redeal') : ?>
		.litesearchstyle form.search-form [type="submit"]{height:40px; line-height:40px; padding: 0 16px}
		.litesearchstyle form.search-form input[type="text"]{padding-left:15px; height:40px}
		header .search{max-width:500px; width:100% !important}
		.header_six_style .head_search{min-width:300px}
		.logo_section_wrap .wpsm-button.medium{padding:12px 16px; font-size:16px}
	<?php endif;?>
<?php endif;?>

</style>
<?php 
	$dynamic_css = ob_get_contents();
	ob_end_clean();
	if (function_exists('rehub_quick_minify')) {
		echo rehub_quick_minify($dynamic_css);
	}
	else {echo ''.$dynamic_css;}
	if(rehub_option('rehub_custom_css')){
		echo '<style>'.rehub_option('rehub_custom_css').'</style>';
	}
	if(rehub_option('rehub_analytics_header')){
		echo rehub_option('rehub_analytics_header');
	}
?>