<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if ( !defined( 'RH_MAIN_THEME_VERSION' ) ) {
	define('RH_MAIN_THEME_VERSION', '9.9.6');
}
if(!defined('REHUB_NAME_ACTIVE_THEME')){
	define('REHUB_NAME_ACTIVE_THEME', 'REHUB');
}

if(!is_admin()) add_action('init', 'rehub_framework_register_scripts');
if( !function_exists('rehub_framework_register_scripts') ) {
function rehub_framework_register_scripts() {

	// Stylesheets
	wp_register_style('rhstyle', get_stylesheet_directory_uri() . '/style.css', array(), RH_MAIN_THEME_VERSION);
	wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css', array(), RH_MAIN_THEME_VERSION);
	wp_register_style('rehub_shortcode', get_template_directory_uri() . '/shortcodes/css/css.css', array(), RH_MAIN_THEME_VERSION);
	wp_register_style('rehubfontawesome', get_template_directory_uri() . '/admin/fonts/fontawesome/font-awesome.min.css', array(), '5.3.1');
	wp_register_style( 'rehub-woocommerce', get_template_directory_uri().'/css/woocommerce.css', array(), RH_MAIN_THEME_VERSION, 'all' );
	wp_register_style('bbpress_css', get_template_directory_uri() . '/css/bbpresscustom.css', array(), RH_MAIN_THEME_VERSION);	
	wp_register_style('jquery.nouislider', get_template_directory_uri() . '/css/jquery.nouislider.css');
	wp_register_style('tabletoggle', get_template_directory_uri() . '/css/tabletoggle.css', array(), '5.0.9');
	wp_register_style('eggrehub', get_template_directory_uri() . '/css/eggrehub.css', array(), RH_MAIN_THEME_VERSION);
	wp_register_style('video-pl', get_template_directory_uri() . '/css/video-playlist.css');
	wp_register_style('eddrehub', get_template_directory_uri() . '/css/edd.css');
	wp_register_style('rhwcvendor', get_template_directory_uri() . '/css/wcvendor.css', array(), RH_MAIN_THEME_VERSION);
	wp_register_style('rhwcfmdash', get_template_directory_uri() . '/css/rhwcfmdash.css', array(), RH_MAIN_THEME_VERSION);
	wp_register_style('rhwcfmstore', get_template_directory_uri() . '/css/rhwcfmstore.css', array(), RH_MAIN_THEME_VERSION);
	wp_register_style('rhcomparesearch', get_template_directory_uri() . '/css/comparesearch.css', array(), RH_MAIN_THEME_VERSION);
	wp_register_style('modulobox', get_template_directory_uri() . '/css/modulobox.min.css', array(), '1.4.4');
	
	//Scripts
	wp_register_script('rhinview', get_template_directory_uri() . '/js/inview.js', array('jquery'), '1.0', true);
	wp_register_script('rhpgwmodal', get_template_directory_uri() . '/js/pgwmodal.js', array('jquery'), '2.0', true);
	wp_register_script('rhunveil', get_template_directory_uri() . '/js/unveil.js', array('jquery'), '1.0', true);
	wp_register_script('rhcuttab', get_template_directory_uri() . '/js/cuttabs.js', array('jquery'), '3.3.6', true);
	wp_register_script('rhhoverintent', get_template_directory_uri() . '/js/hoverintent.js', array('jquery'), '1.9', true);
	wp_register_script('rhniceselect', get_template_directory_uri() . '/js/niceselect.js', array('jquery'), '1.0', true);
	wp_register_script('rhcountdown', get_template_directory_uri() . '/js/countdown.js', array('jquery'), '1.0', true);
	wp_register_script('rehub', get_template_directory_uri() . '/js/custom.js', array('jquery', 'rhinview', 'rhunveil', 'rhhoverintent', 'rhcountdown'), RH_MAIN_THEME_VERSION, true);
	wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '2.2.2', true);
	wp_register_script('totemticker', get_template_directory_uri() . '/js/jquery.totemticker.js', array('jquery'), '', true);
	wp_register_script('carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), '6.2.1', true);
	wp_register_script('sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '1.0.5', true);
	wp_register_script('custom_scroll', get_template_directory_uri() . '/js/custom_scroll.js', array('jquery', 'rehub'), '1.1', true);
	wp_register_script('masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array('jquery'), '3.1.5', true);
	wp_register_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), '3.1.8', true);
	wp_register_script('masonry_init', get_template_directory_uri() . '/js/masonry_init.js', array('jquery', 'masonry'), '3.1.5', true);
	wp_register_script('rh_elparallax', get_template_directory_uri() . '/js/elparallax.js', array('jquery'), '1.0', true);	
	wp_register_script('jquery.nouislider', get_template_directory_uri() . '/js/jquery.nouislider.full.min.js', array('jquery'), '7.0.0', true);
	wp_register_script( 'zeroclipboard', get_template_directory_uri() . '/js/clipboard.min.js', array('jquery'), '1.5.16' );
	wp_register_script('wpsm_googlemap',  get_template_directory_uri() . '/shortcodes/js/wpsm_googlemap.js', array('jquery'), '', true);
	wp_register_script('tipsy', get_template_directory_uri() . '/shortcodes/js/jquery.tipsy.js', array('jquery'), '1.1.0'); // tipsy 		
	wp_register_script('tablesorter', get_template_directory_uri() . '/js/jquery.tablesorter.min.js', array('jquery'), '2.0.2'); // table sorter
	wp_register_script('touchswipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), '2.0.5'); // swiper
	wp_register_script('affegg_coupons', get_template_directory_uri() . '/js/affegg_coupons.js', array('jquery'), '1.1.0', true); // affiliate coupons
	wp_register_script('owlcarousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '1.9.9', true);
	wp_register_script('video_playlist', get_template_directory_uri() . '/js/video_playlist.js', array('jquery'), '1.0.0', true);
	wp_register_script('stickysidebar', get_template_directory_uri() . '/js/stickysidebar.js', array('jquery'), '1.3.1', true);
	wp_register_script('printcoupon', get_template_directory_uri() . '/js/printcoupon.js', array('jquery'), '1.0.1', true);
	wp_register_script('typehead', get_template_directory_uri() . '/js/typehead.js', array('jquery'), '0.10.5', true);
	wp_register_script( 'rehubcompare', get_template_directory_uri() . '/js/comparechart.js', array('jquery', 'rehub'), '1.2', true );
	wp_register_script( 'rehubwaypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery'), '4.0.1', true );	
	wp_register_script( 'justifygallery', get_template_directory_uri() . '/js/jquery.justifiedGallery.min.js', array('jquery'), '3.6.3', true );
	wp_register_script( 'customfloatpanel', get_template_directory_uri() . '/js/custom_floatpanel.js', array('jquery', 'rehub'), '1.0', true );	
	wp_register_script( 'modulobox', get_template_directory_uri() . '/js/modulobox.min.js', array('jquery'), '1.0.5', true );	
	wp_register_script( 'rh_elparticle', get_template_directory_uri() . '/js/particles.min.js', array('jquery'), '2.2', true );	

	wp_register_script( 'gsap', get_template_directory_uri() . '/js/gsap.min.js', array('jquery'), '3.0.5', true );
	wp_register_script( 'scrollmagic', get_template_directory_uri() . '/js/ScrollMagic.min.js', array('jquery'), '2.0.7', true );	
	wp_register_script( 'gsapinit', get_template_directory_uri() . '/js/gsap-init.js', array('jquery','gsap'), '1.1', true );
	wp_register_script( 'gsapsplittext', get_template_directory_uri() . '/js/SplitText.min.js', array('jquery','gsap'), '3.0.5', true );
	wp_register_script( 'gsapsvgdraw', get_template_directory_uri() . '/js/DrawSVGPlugin.min.js', array('jquery','gsap'), '3.0.5', true );	
	wp_register_script( 'gsapsvgpath', get_template_directory_uri() . '/js/MotionPathPlugin.min.js', array('jquery','gsap'), '3.0.5', true );
	wp_register_script( 'rh_elcanvas', get_template_directory_uri() . '/js/elcanvas.js', array('jquery'), '1.0.0', true );
	
	wp_register_script( 'threejs', get_template_directory_uri() . '/js/three.min.js', array(), '0.112', true );
	wp_register_script( 'orbitcontrol', get_template_directory_uri() . '/js/OrbitControls.js', array('threejs'), '1.0', true );
	wp_register_script( 'gltfloader', get_template_directory_uri() . '/js/GLTFLoader.js', array('threejs'), '1.0', true );
	wp_register_script( 'shaderfrog', get_template_directory_uri() . '/js/shaderfrog.js', array('threejs'), '1.0', true );
	wp_register_script( 'gsapthree', get_template_directory_uri() . '/js/gsapthree.js', array('threejs'), '1.0', true );

	wp_register_script( 'rhreadingprogress', get_template_directory_uri() . '/js/readingprogress.js', array('jquery', 'rehub'), '1.0.0', true );
}
}
if(!is_admin()) add_action('wp_enqueue_scripts', 'rehub_enqueue_scripts',11);
if( !function_exists('rehub_enqueue_scripts') ) {
function rehub_enqueue_scripts() {
	if (rh_check_plugin_active('affiliate-egg/affiliate-egg.php') || defined('\ContentEgg\PLUGIN_PATH')) {wp_enqueue_style('eggrehub');}
	wp_enqueue_style('rhstyle');
	wp_enqueue_style('responsive');
	wp_enqueue_style('rehub_shortcode');	
	wp_enqueue_style('rehubfontawesome');
	wp_enqueue_script('rhinview');
	wp_enqueue_script('rhpgwmodal');
	wp_enqueue_script('rhunveil');
	wp_enqueue_script('rhcuttab');
	wp_enqueue_script('rhhoverintent');
	wp_enqueue_script('rhniceselect');
	wp_enqueue_script('rhcountdown');
	wp_enqueue_script('rehub');
	if (class_exists('Woocommerce')) {wp_enqueue_style( 'rehub-woocommerce');}
	if (defined('wcv_plugin_dir') OR class_exists('WeDevs_Dokan') OR class_exists('WCMp')) {wp_enqueue_style('rhwcvendor');}
	if (class_exists('Easy_Digital_Downloads')) {wp_enqueue_style( 'eddrehub');}
    if (class_exists('bbPress' )) {wp_enqueue_style('bbpress_css');}	
	if (rehub_option('rehub_sticky_nav')) {wp_enqueue_script( 'sticky' );}

	$translation_array = array( 
		'back' => esc_html__( 'back', 'rehub-theme' ), 
		'ajax_url' => admin_url( 'admin-ajax.php', 'relative' ),
		'templateurl' => get_template_directory_uri(),
		'fin' => esc_html__( 'That\'s all', 'rehub-theme' ),
		'noresults' => esc_html__( 'No results found', 'rehub-theme' ),
		'your_rating' => esc_html__( 'Your Rating:', 'rehub-theme' ),
		'nonce' => wp_create_nonce('ajaxed-nonce'),
		'hotnonce' => wp_create_nonce('hotnonce'),
		'wishnonce' => wp_create_nonce('wishnonce'),
		'searchnonce' => wp_create_nonce('search-nonce'),
		'filternonce' => wp_create_nonce('filter-nonce'),
		'rating_tabs_id'   => wp_create_nonce('rating_tabs_nonce'),	  
		'max_temp' => REHUB_MAX_TEMP,
		'min_temp' => REHUB_MIN_TEMP,
		'helpnotnonce' => wp_create_nonce('commre-nonce'),		
	);
	wp_localize_script( 'rehub', 'translation', $translation_array );

	$affcoupons_array = array( 
		'coupontextready' => esc_html__( 'Here is your coupon code', 'rehub-theme' ), 
		'coupontextcopied' => esc_html__( 'Code is copied', 'rehub-theme' ),
		'coupongotowebsite' => esc_html__( 'Go to Website', 'rehub-theme' ),	
		'couponorcheck' => esc_html__( 'Or check your new window for opened website', 'rehub-theme' ),						  
	);		
	wp_localize_script( 'affegg_coupons', 'coupvars', $affcoupons_array );

	if (is_singular() && get_option('thread_comments'))	wp_enqueue_script('comment-reply');	
}
}

if(defined( 'WCFMmp_TOKEN' )){
	add_action('after_wcfm_load_styles', 'rh_custom_styles_wcfm_dash');
	function rh_custom_styles_wcfm_dash($end_point){
		wp_enqueue_style('rhwcfmdash');
	}
	if(!is_admin()) add_action('wp_enqueue_scripts', 'rh_custom_styles_wcfm_store',99);
	function rh_custom_styles_wcfm_store(){
		wp_enqueue_style('rhwcfmstore');
	}	
}

if(!is_admin()) add_action( 'wp_enqueue_scripts', 'rh_optimized_media_styles', 99 ); 
function rh_optimized_media_styles() {
	wp_dequeue_style( 'font-awesome' );
	wp_dequeue_style( 'dokan-fontawesome' );
	wp_dequeue_style( 'yith-wcwl-font-awesome' );
	wp_dequeue_script( 'vc_woocommerce-add-to-cart-js' );

	if (rehub_option('disable_woo_scripts')) {
		if ( function_exists( 'is_woocommerce' ) ) {
			if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
				# Scripts
				wp_dequeue_script( 'wc-add-to-cart' );
				wp_dequeue_script( 'wc-cart-fragments' );;
				wp_dequeue_script( 'wc-add-to-cart-variation' );
				wp_dequeue_script( 'wc-cart' );
				wp_dequeue_script( 'woocommerce' );
			}
		}
	}

	//wp_dequeue_script( 'jqueryui' );
}

//add helper functions
include (get_template_directory() . '/functions/helper_functions.php');

//Css customizations
if( !function_exists('rehub_custom_css') ) {
function rehub_custom_css() {
    return get_template_part('inc/customization');
}
}
add_action( 'wp_head', 'rehub_custom_css' );
function rehub_generate_critical_css(){
	if(rehub_option('criticalcss')){
		include(rh_locate_template('inc/criticalcss.php'));		
	}
}
add_action('theme_critical_css', 'rehub_generate_critical_css');

// Add specific CSS class by filter
add_filter('body_class','rehub_body_classes');
function rehub_body_classes($classes) {
if (rehub_option('rehub_body_block')) $classes[] = 'rh-boxed-container';	
if (rehub_option('enable_adsense_opt')) $classes[] = 'mediad_layout_enabled';
if (rehub_option('rehub_content_shadow') !='' ){ 
	$classes[] = 'noinnerpadding';
}
	// return the $classes array
	return $classes;
}

/*** Other essensials ***/
if ( ! isset( $content_width ) ){
	$content_width = 840;
}
	
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'woocommerce');
add_theme_support( 'html5', array( 'search-form' ) ); 
function rehub_theme_support_add() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'align-wide' );
	add_editor_style( 'css/style-editor.css' );
}
add_action( 'after_setup_theme', 'rehub_theme_support_add' );

// This theme uses its own gallery styles.
add_filter( 'use_default_gallery_style', '__return_false' );

//remove some unuseful filter
add_filter( 'term_description', 'shortcode_unautop');
add_filter( 'term_description', 'do_shortcode' );
add_filter('widget_text', 'do_shortcode');

//We disable photon extension as theme has own resizer
if ( class_exists( 'Jetpack_Photon' ) && Jetpack::is_module_active( 'photon' ) ) { 
	Jetpack::deactivate_module( 'photon' ); 
}
add_filter( 'lazyload_is_enabled', '__return_false', 99 );


//////////////////////////////////////////////////////////////////
// Translation
//////////////////////////////////////////////////////////////////
add_action('after_setup_theme', 'rehub_theme_setup');
if( !function_exists('rehub_theme_setup') ) {
function rehub_theme_setup(){
    load_theme_textdomain('rehub-theme', get_template_directory() . '/lang');
}
}

//////////////////////////////////////////////////////////////////
// REHub Class for admin and Constants
//////////////////////////////////////////////////////////////////
require_once ( get_template_directory().'/admin/rehub.php');

// Here we populate the font face
$font_face_nav      = rehub_option('rehub_nav_font');
if ($font_face_nav){
	$font_face_nav_weight = rehub_option('rehub_nav_font_weight');
	$font_face_nav_style  = rehub_option('rehub_nav_font_style');
	$font_face_nav_subset  = rehub_option('rehub_nav_font_subset');
	if(rehub_option('disable_google_fonts') != true){
		VP_Site_GoogleWebFont::instance()->add($font_face_nav, $font_face_nav_weight, $font_face_nav_style, $font_face_nav_subset);	
	}
}

$font_face_headings = rehub_option('rehub_headings_font');
if($font_face_headings){
	$font_face_headings_weight = rehub_option('rehub_headings_font_weight');
	$font_face_headings_style  = rehub_option('rehub_headings_font_style');
	$font_face_headings_subset  = rehub_option('rehub_headings_font_subset');
	if(rehub_option('disable_google_fonts') != true){
		VP_Site_GoogleWebFont::instance()->add($font_face_headings, $font_face_headings_weight, $font_face_headings_style, $font_face_headings_subset);		
	}	
}

$font_face_body   = rehub_option('rehub_body_font');
if($font_face_body){
	$font_face_body_weight = rehub_option('rehub_body_font_weight');
	$font_face_body_style  = rehub_option('rehub_body_font_style');
	$font_face_body_subset  = rehub_option('rehub_body_font_subset');
	if(rehub_option('disable_google_fonts') != true){
		VP_Site_GoogleWebFont::instance()->add($font_face_body, $font_face_body_weight, $font_face_body_style, $font_face_body_subset);		
	}		
}

// embed font function
function rehub_embed_fonts()
{
	if(rehub_option('disable_google_fonts') == true){
		if (REHUB_NAME_ACTIVE_THEME == 'REPICK') {
			wp_enqueue_style('default_font', get_stylesheet_directory_uri() . '/css/opensans.css');
		}elseif(REHUB_NAME_ACTIVE_THEME == 'RETHING'){
			wp_enqueue_style('default_font', get_stylesheet_directory_uri() . '/css/localfont.css');
		}elseif(REHUB_NAME_ACTIVE_THEME == 'RECART'){
			wp_enqueue_style('default_font', get_stylesheet_directory_uri() . '/css/localfont.css');
		}		
		else{
			wp_enqueue_style('default_font', get_template_directory_uri() . '/css/roboto.css');
		}
		
	}else{
		if(rehub_option('disable_default_fonts') != true){
			if (REHUB_NAME_ACTIVE_THEME == 'REPICK') {
				wp_enqueue_style('default_font', '//fonts.googleapis.com/css?family=Open+Sans:400,700');
			}elseif(REHUB_NAME_ACTIVE_THEME == 'RETHING'){
	    		wp_enqueue_style('default_font', '//fonts.googleapis.com/css?family=Noto+Serif:400,700');
	    		wp_enqueue_style('head_nav', '//fonts.googleapis.com/css?family=Montserrat:700');
			}elseif(REHUB_NAME_ACTIVE_THEME == 'RECART'){
	    		wp_enqueue_style('default_font', '//fonts.googleapis.com/css?family=Poppins:400,700');
			}else{
				wp_enqueue_style('default_font', '//fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic');
			}
		}				
	}	
}
add_action('wp_enqueue_scripts', 'rehub_embed_fonts');
add_action('admin_enqueue_scripts', 'rehub_embed_fonts');
function rehub_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'default_font', 'queue' ) && 'preconnect' === $relation_type && rehub_option('disable_google_fonts') != true) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'rehub_resource_hints', 10, 2 );

//////////////////////////////////////////////////////////////////
// Register WordPress menus
//////////////////////////////////////////////////////////////////
add_action( 'after_setup_theme', 'rehub_register_my_menus' );

if( !function_exists('rehub_register_my_menus') ) {
function rehub_register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => esc_html__( 'Primary Menu', 'rehub-theme' ),
			'top-menu' => esc_html__( 'Top Menu', 'rehub-theme' ),
			'user_logged_in_menu' => esc_html__( 'User Logged In Menu', 'rehub-theme' ),
		)
	);
}
}

class Rehub_Walker extends Walker_Nav_Menu
{	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $args->link_after . '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}	
}
//Add search and login to the main navigation
add_filter( 'wp_nav_menu_items', 'rehub_add_search_to_main_nav', 20, 4 );
if( ! function_exists( 'rehub_add_search_to_main_nav' ) ) {
	function rehub_add_search_to_main_nav( $items, $args ) {
		$ubermenu = false;

		if( function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) && ubermenu_get_menu_instance_by_theme_location( $args->theme_location ) ) {
			// disable on ubermenu navigations
			$ubermenu = true;
		}

		if( $ubermenu == false ) {
			if( $args->theme_location == 'primary-menu' && rehub_option('woo_cart_place') == '2' && rehub_option('rehub_header_style') != 'header_seven') {
				global $woocommerce;
				if ($woocommerce){
				$items .= '<li class="menu-item rehub-custom-menu-item rh_woocartmenu">';
					$items .= '<a class="rh-header-icon rh-flex-center-align rh_woocartmenu-link cart-contents cart_count_'.$woocommerce->cart->cart_contents_count.'" href="'.wc_get_cart_url().'"><span class="rh_woocartmenu-icon"><span class="rh-icon-notice rehub-main-color-bg">'.$woocommerce->cart->cart_contents_count.'</span></span><span class="rh_woocartmenu-amount">'.$woocommerce->cart->get_cart_total().'</span></a>';
				$items .= '</li>';					
				}

			}			
			if($args->theme_location == 'primary-menu' && rehub_option('rehub_login_icon') == 'menu' && rehub_option('userlogin_enable') == '1') {
                $loginurl = (rehub_option('custom_login_url')) ? esc_url(rehub_option('custom_login_url')) : '';		
				$items .= '<li class="menu-item rehub-custom-menu-item rehub-top-login-onclick">';
					$items .= wpsm_user_modal_shortcode(array('wrap'=> 'a', 'loginurl'=>$loginurl));
				$items .= '</li>';				
			}												
		}

		return $items;
	}
}
//Add elements to Sliding Mobile Panel
if( ! function_exists( 'rh_custom_sliding_elements' ) ) {
	function rh_custom_sliding_elements(){
    	$slidinglogo = rehub_option('logo_mobilesliding');
		$slidingtext = rehub_option('text_mobilesliding');
		$output = '';
		if($slidingtext || $slidinglogo){
			$slidingbg = rehub_option('bg_mobilesliding');
			$slidingcolor = rehub_option('color_mobilesliding');			
			$bgimage = ($slidingbg) ? 'background-image: url('.esc_url($slidingbg).'); background-repeat: repeat; background-position: left top;' : '';
			if($slidingcolor){
				$bgcolor = 'background-color: '.$slidingcolor.';';
			}
			elseif(rehub_option("rehub_custom_color") != ''){
				$bgcolor = 'background-color: '.rehub_option("rehub_custom_color").';';
			}
			else{
				$bgcolor = 'background-color: #f1f1f1;';
			}		
			$output.= '<div id="rhmobpnlcustom" class="rhhidden"><div id="rhmobtoppnl" style="'.$bgimage.$bgcolor.'" class="pr15 pl15 pb15 pt15">';
			if($slidinglogo){
				$output.= '<div class="text-center"><a href="'.get_home_url().'"><img id="mobpanelimg" src="'.esc_url($slidinglogo).'" alt="Logo" /></a></div>';
			}
			if($slidingtext){
				$output.= '<div id="mobpaneltext" class="mt15">'.do_shortcode($slidingtext).'</div>';
			}
			$output.= '</div></div>';		
		}
		return $output;
	}
}

//Add elements to footer
function rehub_add_elem_to_footer(){
	?>
    <?php 
        if (rehub_option('rehub_logo_inmenu') !='') {
            $logoimageurl = '';
            if(rehub_option('rehub_logo_inmenu_url') !=''){
                $logoimageurl = rehub_option("rehub_logo_inmenu_url");
            } 
            elseif (rehub_option('rehub_logo') !='') {
                $logoimageurl = rehub_option('rehub_logo');
            }
            if ($logoimageurl) {
                echo '<div id="logo_mobile_wrapper"><a href="'.get_home_url().'" class="logo_image_mobile"><img src="'.$logoimageurl.'" alt="'.get_bloginfo( "name" ).'" /></a></div>'; 
            }                
        }             
    ?>   

    <?php if( rehub_option( 'rehub_logo_retina' ) != '' && rehub_option( 'rehub_logo_retina_width' ) != '' && rehub_option( 'rehub_logo_retina_height' ) !=''): ?>
        <?php 
        	$menuscript = '
            jQuery(document).ready(function($) {
            	var retina = window.devicePixelRatio > 1 ? true : false;
            	if(retina) {
                	jQuery(".logo_image img").attr("src", "'.rehub_option( "rehub_logo_retina" ).'");
            	}
            });';
            wp_add_inline_script('rehub', $menuscript);
        ?>
    <?php endif; ?> 

    <?php echo rh_custom_sliding_elements();?>
    <?php echo coupon_get_code();?>

    <?php 
        if (rehub_option('rehub_analytics')) {
            echo rehub_option('rehub_analytics');   
        }             
    ?>          

	<?php
}
add_action('wp_footer', 'rehub_add_elem_to_footer');

function add_menu_for_blank(){
	echo '<nav class="top_menu"><ul class="menu"><li><a href="/wp-admin/nav-menus.php" target="_blank">Click to Add your menu</a></li></ul></nav>';
}
function add_top_menu_for_blank(){
	echo '<div class="top-nav"><ul class="menu"><li></li></ul></div>';
}

add_filter( 'walker_nav_menu_start_el', 'rh_shortcode_in_menu', 20, 2 );
function rh_shortcode_in_menu( $item_output, $item ) {
	// Rare case when $item is not an object, usually with custom themes.
	if ( ! is_object( $item ) || ! isset( $item->object ) ) {
		return $item_output;
	}
	if ( isset( $item->url ) && ('http://SHORTCODE' === $item->url || 'SHORTCODE' === $item->url || 'https://SHORTCODE' === $item->url) ) {
		if(!empty( $item->description)){
			$item_output = do_shortcode( $item->description );
		}
	}  
	return $item_output;
}


//////////////////////////////////////////////////////////////////
// Resizer
//////////////////////////////////////////////////////////////////
@define('BFITHUMB_UPLOAD_FOLDER', 'thumbs_dir');
require_once('inc/BFI_Thumb.php');

//////////////////////////////////////////////////////////////////
// Post thumbnails
//////////////////////////////////////////////////////////////////

add_action( 'after_setup_theme', 'rehub_image_sizes' );
if ( !function_exists( 'rehub_image_sizes' ) ) {
	function rehub_image_sizes() {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 788, 0, true );
	}
}

//////////////////////////////////////////////////////////////////
// Resizer function
//////////////////////////////////////////////////////////////////

if( !class_exists('WPSM_image_resizer') ) {
class WPSM_image_resizer{

	public $src = '';
	public $width = '';
	public $height = '';
	public $size = 'full';
	public $crop = false;
	public $lazy = false;
	public $title = '';
	public $use_thumb = false;
	public $no_thumb = '';
	public $quality = '100';

	function __construct(){ //Enable lazy load when we need
		if (rehub_option('enable_lazy_images') == '1'){
			$this->lazy = true;
		}
	}

	public function get_resized_url() { //Show resized url with bfi_thumb function
		$params = array( 'width' => $this->width, 'height' => $this->height, 'quality' => $this->quality, 'crop' => $this->crop);
		$image_url = esc_url($this->src);
		if (empty ($this->src) && $this->use_thumb == true) {
			$image_url = $this->get_mypost_thumb_url();
			if(!rehub_option('rh_image_resize')){
				$image_url = bfi_thumb( $image_url, $params );
			}
			$image_url = apply_filters('rh_thumb_resized_url', $image_url );			
		}
		else {
			if(!rehub_option('rh_image_resize')){
				$image_url = bfi_thumb( $image_url, $params );
			}			
			$image_url = apply_filters('rh_src_resized_url', $image_url );
		}
		if (empty($image_url)) {
			$image_url = $this->no_thumb();			
		}
		return $image_url;		
	}

	public function get_not_resized_url(){ //Show not resized url of image
		$image_url = esc_url($this->src);

		if (empty ($this->src) && $this->use_thumb == true) {
			$image_url = $this->get_mypost_thumb_url();
		}
		if (empty($image_url)) {
			$image_url = $this->no_thumb();			
		}
		return apply_filters('rh_thumb_notresized_url', $image_url );
	}

	public function get_mypost_thumb_url() {
		global $post ;
		$image_url = '';
		if (function_exists('_nelioefi_url')){
			$image_nelio_url = get_post_meta( $post->ID, _nelioefi_url(), true );
			if (!empty($image_nelio_url)){
				return apply_filters('rh_thumb_url', $image_nelio_url );
			}			
		}
		if ( has_post_thumbnail($post->ID) ){
			$image_id = get_post_thumbnail_id($post->ID);  
			$image_url = wp_get_attachment_image_src($image_id, $this->size);  
			$image_url = $image_url[0];
			return apply_filters('rh_thumb_url', $image_url );
		}	
		return apply_filters('rh_thumb_url', $image_url );	
	}

	public static function get_post_thumb_static($size = 'full'){
		global $post ;
		$image_url = '';
		if (function_exists('_nelioefi_url')){
			$image_nelio_url = get_post_meta( $post->ID, _nelioefi_url(), true );
			if (!empty($image_nelio_url)){
				return apply_filters('rh_thumb_url', $image_nelio_url );
			}			
		}		
		if ( has_post_thumbnail($post->ID) ){
			$image_id = get_post_thumbnail_id($post->ID);  
			$image_url = wp_get_attachment_image_src($image_id,$size);  
			$image_url = $image_url[0];
			return apply_filters('rh_thumb_url', $image_url );
		}
		return apply_filters('rh_thumb_url', $image_url );	
	}	

	public function no_thumb(){ //Set blank image when no image url found
		if(rehub_option('featured_fallback_img')){$image_url = esc_url(rehub_option('featured_fallback_img'));}
		else if(!empty($this->no_thumb)){$image_url = $this->no_thumb;}
		else {$image_url = get_template_directory_uri() . '/images/default/blank.gif';}
		return apply_filters('rh_no_thumb_url', $image_url);
	}	

	public function show_resized_image() {
		$width_param = (!empty($this->width)) ? ' width="'.$this->width.'"': '';
		$height_param = (!empty($this->height)) ? ' height="'.$this->height.'"': '';
		$alt = (!empty($this->title)) ? $this->title : the_title_attribute (array('echo' => 0) );
		if ($this->lazy == true){
			if(function_exists('is_amp_endpoint') && is_amp_endpoint()){
				echo '<img class="lazyimages" data-src="'.$this->get_resized_url().'"'.$width_param.$height_param.' alt="'.the_title_attribute (array('echo' => 0) ).'" src="'.$this->get_resized_url().'" />';
			}else{			
				echo '<img class="lazyimages" data-src="'.$this->get_resized_url().'"'.$width_param.$height_param.' alt="'.the_title_attribute (array('echo' => 0) ).'" src="'.$this->no_thumb().'" />';
			}
		}
		else {
			echo '<img src="'.$this->get_resized_url().'"'.$width_param.$height_param.' alt="'.$alt.'" />';
		}
	}

	public function show_not_resized_image() {
		$width_param = (!empty($this->width)) ? ' width="'.$this->width.'"': '';
		$height_param = (!empty($this->height)) ? ' height="'.$this->height.'"': '';
		$alt = (!empty($this->title)) ? $this->title : the_title_attribute (array('echo' => 0) );		
		if ($this->lazy == true){
			if(function_exists('is_amp_endpoint') && is_amp_endpoint()){
				echo '<img class="lazyimages" data-src="'.$this->get_not_resized_url().'"'.$width_param.$height_param.' alt="'.the_title_attribute (array('echo' => 0) ).'" src="'.$this->get_not_resized_url().'" />';
			}else{
				echo '<img class="lazyimages" data-src="'.$this->get_not_resized_url().'"'.$width_param.$height_param.' alt="'.the_title_attribute (array('echo' => 0) ).'" src="'.$this->no_thumb().'" />';				
			}

		}
		else {
			echo '<img src="'.$this->get_not_resized_url().'"'.$width_param.$height_param.' alt="'.$alt.'" />';
		}
	}

	public static function show_static_resized_image($params = array()) {
		
		$src = $width = $height = $title = $no_thumb_url = $no_thumb_fallback = '';
		$crop = $lazy = $thumb = false;
		if (rehub_option('enable_lazy_images') == '1'){
			$lazy = true;
		}		
		@extract ($params);

		$params = array( 'width' => $width, 'height' => $height, 'crop' => $crop);
		$no_thumb = (!empty($no_thumb_url)) ? apply_filters('rh_no_thumb_url', $no_thumb_url) : get_template_directory_uri() . '/images/default/blank.gif';
		$image_url = esc_url($src);
		if (empty($title)) {
			$title = the_title_attribute (array('echo' => 0) );
		}
		if (!empty($image_url)) {
			$image_url = bfi_thumb( $image_url, $params );
			$image_url = apply_filters('rh_static_resized_url', $image_url);		
		}	
		elseif (empty($image_url) && $thumb == true) {
			$image_url = self::get_post_thumb_static();
			if(!rehub_option('rh_image_resize')){
				$image_url = bfi_thumb( $image_url, $params );
			}
			$image_url = apply_filters('rh_thumb_resized_url', $image_url );
		}	
		if (empty($image_url)) {
			if (!empty($no_thumb_fallback)) return $no_thumb_fallback;
			$image_url = $no_thumb;	
			$image_url = apply_filters('rh_no_thumb_url', $image_url);	
		}
		$width_param = (!empty($width)) ? ' width="'.$width.'"': '';
		$height_param = (!empty($height)) ? ' height="'.$height.'"': '';
		if ($lazy == true){
			if(function_exists('is_amp_endpoint') && is_amp_endpoint()){
				echo '<img class="lazyimages" data-src="'.$image_url.'"'.$width_param.$height_param.' alt="'.$title.'" src="'.$image_url.'" />';
			}else{
				echo '<img class="lazyimages" data-src="'.$image_url.'"'.$width_param.$height_param.' alt="'.$title.'" src="'.$no_thumb.'" />';
			}
		}
		else {
			echo '<img class="nolazyftheme" src="'.$image_url.'"'.$width_param.$height_param.' alt="'.$title.'" />';
		}
	}

	public static function show_wp_image($image_size='full', $attachment_id = '', $attributes = array()) {
		global $post;
		$lazy = true;
		$lazy = apply_filters('rh_lazy_load', $lazy, $attachment_id);
		if (!rehub_option('enable_lazy_images')){
			$lazy = false;
		}	
		if(rehub_option('rh_image_resize')){
			$image_size='full';
		}		
		$transparent = get_template_directory_uri() . '/images/default/blank.gif';
		$image_id = ($attachment_id) ? (int)$attachment_id : get_post_thumbnail_id($post->ID);  
		$image = wp_get_attachment_image_src($image_id,$image_size); 
		if(!empty($image)) {
			$image_url = $image[0];
		}else{
			$image_url = '';
		}
		$image_url = apply_filters('rh_thumb_url', $image_url );
		$css_class = (!empty($attributes['css_class'])) ? $attributes['css_class'] : '';
		$output = '';
		if ($lazy == true){
			$alt   = trim( strip_tags( get_post_meta($image_id, '_wp_attachment_image_alt', true ) ) );
			$alt = apply_filters('wp_get_attachment_alt_attribute', $alt);
			if (empty($alt)) {
				$alt = the_title_attribute (array('echo' => 0) );
			}			
			if ( has_post_thumbnail($post->ID) ){
				$transparent = get_template_directory_uri() . '/images/default/blank.gif';
				if ( $attributes ) {
					$full_size_image = wp_get_attachment_image_src($image_id, 'full' );
					$output = sprintf(
						'<img src="%s" data-src="%s" alt="%s" class="lazyimages %s" data-large_image="%s" data-large_image_width="%s" data-large_image_height="%s">',
						esc_url( $transparent ),
						esc_url( $image_url ),
						esc_attr( $alt ),
						esc_attr( $css_class ),
						esc_attr( $full_size_image[0] ),
						esc_attr( $attributes['data-large_image_width'] ),
						esc_attr( $attributes['data-large_image_height'] )
					);
				} else {
					$output = sprintf(
						'<img src="%s" data-src="%s" alt="%s" class="lazyimages %s" width="%s" height="%s">',
						esc_url( $transparent ),
						esc_url( $image[0] ),
						esc_attr( $alt ),
						esc_attr( $css_class ),
						esc_attr( $image[1] ),
						esc_attr( $image[2] )
					);
				}
			}else{
				if(rehub_option('featured_fallback_img')){
					$nothumb_url = esc_url(rehub_option('featured_fallback_img'));
				}
				else if(!empty($attributes['no_thumb'])){
					$nothumb_url = esc_url($attributes['no_thumb']);
				}
				else {
					$nothumb_url = get_template_directory_uri() . '/images/default/wooproductph.png';
				}
				$nothumb_url = apply_filters('rh_no_thumb_url', $nothumb_url);				
				$output = sprintf(
					'<img src="%s" data-src="%s" alt="%s" class="lazyimages %s" width="%s" height="%s">',
					esc_url( $transparent ),
					esc_url( $nothumb_url),
					esc_attr( $alt ),
					esc_attr( $css_class ),
					esc_attr( $image[1] ),
					esc_attr( $image[2] )
				);
			}
		} else {
			$attributes['class'] = $css_class;
			$output = wp_get_attachment_image( $image_id, $image_size, false, $attributes );
		}
		
		$output = apply_filters('rh_thumb_output', $output);
		return $output;		
	}		

}}

//////////////////////////////////////////////////////////////////
// Thumbnail function
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_thumb') ) {
function wpsm_thumb( $size = 'small', $lazy = true ){
	if( $size == 'medium_news' ){$width = 444; $height = 250; $nothumb = get_template_directory_uri() . '/images/default/noimage_432_250.png' ;}
	elseif( $size == 'medium_news_s' ){$width = 350; $height = 200; $nothumb = get_template_directory_uri() . '/images/default/noimage_432_250.png' ;}
	elseif( $size == 'med_thumbs' ){$width = 123; $height = 90; $nothumb = get_template_directory_uri() . '/images/default/noimage_123_90.png' ;}	
	elseif( $size == 'news_big' ){$width = 378; $height = 310; $nothumb = get_template_directory_uri() . '/images/default/noimage_378_310.png' ;}
	elseif( $size == 'grid_thumb' ){$width = 250; $height = 180; $nothumb = get_template_directory_uri() . '/images/default/noimage_250_180.png' ;}
	elseif( $size == 'grid_news' ){$width = 336; $height = 220; $nothumb = get_template_directory_uri() . '/images/default/noimage_336_220.png' ;}	
	else{ $width = 123; $height = 90; $nothumb = get_template_directory_uri() . '/images/default/noimage_123_90.png' ;}	
	
	$showimg = new WPSM_image_resizer();
	$showimg->use_thumb = true;
	$showimg->no_thumb = $nothumb;
	if ($lazy == false) {
		$showimg->lazy = false;
	}

	if( rehub_option( 'rh_image_resize')){
		$showimg->size = $size;
		$showimg->width = $width;
		$showimg->height = $height;		
 		$showimg->show_not_resized_image(); 		
	}else{
		$showimg->width = $width;
		$showimg->height = $height;
		$showimg->crop = true;
		$showimg->show_resized_image();
	}
}	
}

//////////////////////////////////////////////////////////////////
// Labels, badges, metas
//////////////////////////////////////////////////////////////////

if( !function_exists('rehub_price_clean') ) {
function rehub_price_clean($price) {
	$cur_clean = array('8377', 'Rs.', 'руб.', 'RS.' );
	$price = str_replace($cur_clean, '', $price);
	if (rehub_option('price_pattern') == 'us') {
		$price = (float) preg_replace("/[^0-9\.]/","", $price);			
	}
	elseif (rehub_option('price_pattern') == 'eu') {
		$price = preg_replace("/[^0-9,]/","", $price);
		$price = (float) str_replace(',', '.', $price);			
	}
	elseif (rehub_option('price_pattern') == 'in') {
		$price = (float) preg_replace("/[^0-9\.]/","", $price);			
	}
	else {
		$price = (float) preg_replace("/[^0-9\.]/","", $price);
	}	
	if (!is_numeric($price) || $price =='0')	{
		return;
	}
	return $price;

}
}

if( !function_exists('rehub_formats_icons') ) {
function rehub_formats_icons($editor='no')
{
	global $post;
	$offer_price_old = get_post_meta($post->ID, 'rehub_offer_product_price_old', true );
	$offer_price_old = apply_filters('rehub_create_btn_price_old', $offer_price_old);	
	if(!empty($offer_price_old)) {
		$offer_price = get_post_meta( $post->ID, 'rehub_offer_product_price', true );
		$offer_price = apply_filters('rehub_create_btn_price', $offer_price);		
		if ( !empty($offer_price)) {
			$offer_pricesale = rehub_price_clean($offer_price); //Clean price from currence symbols
			$offer_priceold = rehub_price_clean($offer_price_old); //Clean price from currence symbols
			if (is_numeric($offer_priceold) && is_numeric($offer_pricesale) && $offer_priceold !=0 && (int)$offer_priceold > (int)$offer_pricesale) {
				$off_proc = 0 -(100 - ((int)$offer_pricesale / (int)$offer_priceold) * 100);
				$off_proc = round($off_proc);
				echo '<span class="overlay_post_formats sale_format"><i class="far fa-tag"></i> <span>'.$off_proc.'%</span></span>';
			}
		}			
	}	
}
}

if( !function_exists('rehub_format_score') ) {
function rehub_format_score($size = 'small', $type = 'star' )
{
	if(vp_metabox('rehub_post.rehub_framework_post_type') == 'review') {
		$overall_score_icon = rehub_get_overall_score();
		$total = $overall_score_icon * 10;
		if ($overall_score_icon !='0' && $overall_score_icon !='') {
			if ($type == 'star') {
				echo '<div class="star-'.$size.'"><span class="stars-rate"><span style="width: '.$total.'%;"></span></span></div>';
			}
			elseif ($type == 'square') {
				echo '<span class="overlay_post_formats review_formats_score">'.$overall_score_icon.'</span>';
			}
			elseif ($type == 'line') { ?>
	            <div class="rate-line rate-line-inner<?php if (rehub_option('color_type_review') == 'multicolor') {echo ' colored_rate_bar';} ?>">
                    <div class="line" data-percent="<?php echo (int)$total;?>%"> 
                        <span class="filled r_score_<?php echo round($overall_score_icon); ?>"><?php echo ''.$overall_score_icon ?></span>
                    </div>
                </div>
			<?php
			}			
		}	
	}
}
}

if( !function_exists('meta_all') ) { //post meta
function meta_all ($time_exist, $cats_exist, $admin_exist, $cats_post = false ){
	global $post;
	if(rehub_option('exclude_author_meta') != 1 && ($admin_exist != false)){ ?>
		<?php $author_id=$post->post_author; ?>
		<span class="admin_meta">
			<a class="admin" href="<?php echo get_author_posts_url( $author_id ) ?>">
				<?php if ($admin_exist === 'full') :?><?php echo get_avatar( $author_id, '22' ); ?><?php endif;?>
				<?php the_author_meta( 'display_name', $author_id ); ?>
			</a>
		</span>
	<?php }   
	if(rehub_option('exclude_date_meta') != 1 && ($time_exist != false)){ ?>
 		<span class="date_meta"><?php the_modified_time(get_option( 'date_format' )); ?></span>	
	<?php }
	if(rehub_option('exclude_cat_meta') != 1 && ($cats_exist != false) && (!empty($cats_exis))){ ?>
		<?php $cat_name = get_cat_name($cats_exist); ?>
		<span class="cat_link_meta"><a class="cat" href="<?php echo get_category_link( $cats_exist); ?>"><?php echo ''.$cat_name ?></a></span>
	<?php }   
	if(rehub_option('exclude_cat_meta') != 1 && ($cats_post != false)){ 
		$postidforcat = $post->ID;
		if ('post' == $post->post_type) {
			$categories = get_the_category($postidforcat);
			$separator = ', ';
			$output = '';
			if ( ! empty( $categories ) ) {
				echo '<span class="cat_link_meta">';
			    foreach( $categories as $category ) {
			        $output .= '<a class="cat" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'rehub-theme' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
			    }
			    echo trim( $output, $separator );
			    echo '</span>';
			}
		}
		elseif ('blog' == $post->post_type) {
	    	$term_list = get_the_term_list( $post->ID, 'blog_category', '<span class="date_meta">', ', ', '</span>' );
            if(!is_wp_error($term_list)){
                echo ''.$term_list;
            }
		}
	}		 	
}
}

if( !function_exists('rh_post_header_meta') ) { //post meta
function rh_post_header_meta ($admin_exist = true, $time_exist = true, $view_exist = true, $comment_exist = true, $cats_post = true ){
	global $post;
	if(rehub_option('exclude_author_meta') != 1 && ($admin_exist != false)){ ?>
		<?php $author_id=$post->post_author; ?>
		<span class="admin_meta">
			<a class="admin" href="<?php echo get_author_posts_url( $author_id ) ?>">
				<?php if ($admin_exist === 'full') :?><?php echo get_avatar( $author_id, '22' ); ?><?php endif;?>
				<?php if ($admin_exist === 'fullbig') :?><?php echo get_avatar( $author_id, '40' ); ?><?php endif;?>				
				<?php the_author_meta( 'display_name', $author_id ); ?>			
			</a>
		</span>
	<?php }   
	if(rehub_option('exclude_date_meta') != 1 && ($time_exist != false)){ ?>
 		<span class="date_meta"><?php the_modified_time(get_option( 'date_format' )); ?></span>	
	<?php }   
	if(rehub_option('post_view_disable') != 1 && ($view_exist != false) && function_exists('RH_get_post_views')){ ?>
		<?php $rehub_views = RH_get_post_views($post->ID); if ($rehub_views !='') :?>
			<span class="postview_meta"><?php echo (int)$rehub_views; ?> </span>
		<?php endif ;?>	
	<?php }	
	if(rehub_option('exclude_comments_meta') != 1 && ($comment_exist != false)){ ?>
		<?php if($comment_exist=='compact'):?>
			<span class="comm_count_meta"><?php comments_popup_link( esc_html__('0','rehub-theme'), esc_html__('1','rehub-theme'), esc_html__('%','rehub-theme'), 'comm_meta', ''); ?></span>
		<?php elseif ($comment_exist == 'compactnoempty'):?>
			<?php if($post->comment_count > 0):?>
			<span class="comm_count_meta"><?php comments_popup_link( esc_html__('0','rehub-theme'), esc_html__('1','rehub-theme'), esc_html__('%','rehub-theme'), 'comm_meta', ''); ?></span>
			<?php endif;?>
		<?php else:?>
			<span class="comm_count_meta"><?php comments_popup_link( esc_html__('no comments','rehub-theme'), esc_html__('1 comment','rehub-theme'), esc_html__('% comments','rehub-theme'), 'comm_meta', ''); ?></span>
		<?php endif;?>
	<?php }	
	if(rehub_option('exclude_cat_meta') != 1 && ($cats_post != false)){ 
		$postidforcat = $post->ID;
		if ('post' == $post->post_type) {
			$categories = get_the_category($postidforcat);
			$separator = ', ';
			$output = '';
			if ( ! empty( $categories ) ) {
				echo '<span class="cat_link_meta">';
			    foreach( $categories as $category ) {
			        $output .= '<a class="cat" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'rehub-theme' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
			    }
			    echo trim( $output, $separator );
			    echo '</span>';
			}
		}
		elseif ('blog' == $post->post_type) {
	    	$term_list = get_the_term_list( $post->ID, 'blog_category', '<span class="date_meta">', ', ', '</span>' );
            if(!is_wp_error($term_list)){
                echo ''.$term_list;
            }
		}
		elseif ('product' == $post->post_type) {
	    	$term_list = get_the_term_list( $post->ID, 'product_cat', '<span class="date_meta">', ', ', '</span>' );
            if(!is_wp_error($term_list)){
                echo ''.$term_list;
            }
		}		
	}			 	
}
}

if( !function_exists('rh_post_header_meta_big') ) { //post meta_big
function rh_post_header_meta_big (){
	global $post;
	?>
		<div class="floatleft mr15 rtlml15">
			<?php if(rehub_option('exclude_author_meta') != 1):?>
				<?php $author_id=$post->post_author; ?>
				<a href="<?php echo get_author_posts_url( $author_id ) ?>" class="floatleft mr10">
					<?php echo get_avatar( $author_id, '40' ); ?>					
				</a>	
			<?php endif;?>
			<span class="floatleft authortimemeta">
				<?php if(rehub_option('exclude_author_meta') != 1):?>
					<a href="<?php echo get_author_posts_url( $author_id ) ?>">				
						<?php the_author_meta( 'display_name', $author_id ); ?>			
					</a>
				<?php endif;?>
				<?php if(rehub_option('exclude_date_meta') != 1):?>
					<div class="date_time_post"><?php the_modified_time(get_option( 'date_format' )); ?></div>
				<?php endif;?>
			</span>	

		</div>
		<div class="floatright ml15 postviewcomm mt5">
			<?php if(rehub_option('post_view_disable') != 1 && function_exists('RH_get_post_views')):?>
				<?php $rehub_views = RH_get_post_views($post->ID);?>
				<span class="postview_meta mr15 ml15"><strong><?php echo (int)$rehub_views; ?></strong> <?php esc_html_e('Views', 'rehub-theme');?></span>
			<?php endif;?>	
			<?php if(rehub_option('exclude_comments_meta') != 1):?>			
				<span class="comm_count_meta"><strong><?php comments_popup_link( esc_html__('0','rehub-theme'), esc_html__('1 comment','rehub-theme'), esc_html__('% comments','rehub-theme'), 'comm_meta', ''); ?></strong></span>	
			<?php endif;?>			
		</div>	
	<?php				 	
}
}

if( !function_exists('rh_post_header_cat') ) { //post meta
function rh_post_header_cat($post_type='post', $dealstore = false, $postid = ''){
	if($postid){
		$post_id = $postid;
	} 
	else{
		global $post;
		$post_id = $post->ID;
	}
	if(rehub_option('exclude_cat_meta') != 1){ 
		echo '<div class="rh-cat-list-title">';
		if ($post_type=='post' && 'post' == get_post_type($post_id)) {
			$categories = get_the_category($post_id);
			$separator = '';
			$output = '';
			if ( ! empty( $categories ) ) {
			    foreach( $categories as $category ) {
			    	$cat_data = get_option("category_$category->term_id");
			    	if (!empty($cat_data['cat_color'])) :
			    		echo '<style scoped>.rh-cat-label-title.rh-cat-'.$category->term_id.'{background-color:'.$cat_data['cat_color'].'; color:#fff}</style>';
			    	endif;
			        $output .= '<a class="rh-cat-label-title rh-cat-'.$category->term_id.'" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'rehub-theme' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
			    }
			    echo trim( $output, $separator );
			}
			if(rehub_option('enable_brand_taxonomy') == 1 && $dealstore == true){ 
				$dealcats = wp_get_post_terms($post_id, 'dealstore', array("fields" => "all"));	
				if( ! empty( $dealcats ) && ! is_wp_error( $dealcats ) ) {
					foreach( $dealcats as $dealcat ) {
				        echo '<a class="rh-cat-label-title rh-dealstore-cat rh-cat-'.$dealcat->term_id.'" href="' . esc_url( get_term_link( $dealcat->term_id ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'rehub-theme' ), $dealcat->name ) ) . '">' . esc_html( $dealcat->name ) . '</a>' . $separator;						
					}
				}								
			}		
		}
		elseif ('blog' == get_post_type($post_id)) {
	    	$term_list = get_the_term_list( $post_id, 'blog_category', '<span class="rh-cat-label-title">', '', '</span>' );
            if(!is_wp_error($term_list)){
                echo ''.$term_list;
            }
		}
		echo '</div>';
	}			 	
}
}

if( !function_exists('meta_small') ) { //another post meta function
function meta_small ($time_exist, $cats_exist, $comment_exist, $post_views = false ){
	global $post;     
	if(rehub_option('exclude_date_meta') != 1 && ($time_exist != false)){ ?>
 		<span class="date_meta"><?php the_modified_time(get_option( 'date_format' )); ?></span> 	
	<?php }
	if(rehub_option('exclude_cat_meta') != 1 && ($cats_exist != false)){ ?>
		<?php $cat_name = get_cat_name($cats_exist); ?>
		<span class="cat_link_meta"><a href="<?php echo get_category_link( $cats_exist); ?>" class="cat"><?php echo esc_attr($cat_name) ?></a></span>
	<?php }
	if(rehub_option('exclude_comments_meta') != 1 && ($comment_exist != false)){ ?>
		<?php if($comment_exist=='compact'):?>
			<span class="comm_count_meta"><?php comments_popup_link( esc_html__('0','rehub-theme'), esc_html__('1','rehub-theme'), esc_html__('%','rehub-theme'), 'comm_meta', ''); ?></span>
		<?php elseif ($comment_exist == 'compactnoempty'):?>
			<?php if($post->comment_count > 0):?>
			<span class="comm_count_meta"><?php comments_popup_link( esc_html__('0','rehub-theme'), esc_html__('1','rehub-theme'), esc_html__('%','rehub-theme'), 'comm_meta', ''); ?></span>
			<?php endif;?>
		<?php else:?>
			<span class="comm_count_meta"><?php comments_popup_link( esc_html__('no comments','rehub-theme'), esc_html__('1 comment','rehub-theme'), esc_html__('% comments','rehub-theme'), 'comm_meta', ''); ?></span>
		<?php endif;?>
	<?php } 
	if($post_views != false && rehub_option('post_view_disable') != 1 && function_exists('RH_get_post_views')){ ?>
		<?php $rehub_views = RH_get_post_views($post->ID); if ($rehub_views !='') :?>
			<span class="postview_meta"><?php echo (int)$rehub_views; ?> </span>
		<?php endif ;?>
	<?php }     	   	
}
}

if( !function_exists('re_badge_create') ) { //CREATING BADGES
function re_badge_create ($type = 'label', $postid = '' ){ 
	if($postid){
		$post_id = $postid;
	} 
	else{
		global $post;
		$post_id = $post->ID;
	}
	$badge = get_post_meta($post_id, 'is_editor_choice', true);
	if ($badge !='' && $badge !='0' && $badge !='no') {
		$output = '';
		$label = rehub_option('badge_label_'.$badge.'');   
		if($type =='tablelabel'){ 
			$output .= '<span class="re-line-badge re-line-table-badge badge_'.$badge.'"><span>'.$label.'</span></span>';
		}
		elseif($type =='ribbon'){ 
			$output .= '<span class="re-ribbon-badge badge_'.$badge.'"><span>'.$label.'</span></span>';
		}
		elseif($type =='ribbonleft'){ 
			$output .= '<span class="re-ribbon-badge left-badge badge_'.$badge.'"><span>'.$label.'</span></span>';
		}				
		elseif($type =='starburst'){ 
			$output .= '<span class="re-starburst badge_'.$badge.'"><span><span><span><span><span><span><span><span><strong>'.$label.'</strong></span></span></span></span></span></span></span></span></span></span>';
		}
		elseif($type =='class'){ 
			$output .= 'ed_choice_col badge_'.$badge.'';
		}
		elseif($type =='labelbig'){ 
			$output .= '<div class="text-center"><span class="re-line-badge re-line-big-label badge_'.$badge.'"><span>'.$label.'</span></span></div>';
		}
		elseif($type =='labelsmall'){ 
			$output .= '<span class="re-line-badge re-line-small-label badge_'.$badge.'"><span>'.$label.'</span></span>';
		}
		else{ 
			$output .= '<span class="re-line-badge badge_'.$badge.'"><span>'.$label.'</span></span>';
		}  
		return $output;		
	}
	else {
		return;
	}
   	   	
}
}

//////////////////////////////////////////////////////////////////
// ADD FUNCTIONS
//////////////////////////////////////////////////////////////////

//Review and user reviews
if (rehub_option('type_user_review') == 'user') {include (get_template_directory() . '/functions/user_review_no_editor.php');}
include (get_template_directory() . '/functions/review_functions.php');
if (rehub_option('type_user_review') == 'full_review' || rehub_option('type_user_review') == 'user') {
	include (get_template_directory() . '/functions/user_review_functions.php');
}

//Affiliate for posts
include (get_template_directory() . '/functions/affiliate_functions.php');

//add video class
include (get_template_directory() . '/functions/video_class.php');

//add widget sidebar functions
include (get_template_directory() . '/functions/sidebar_functions.php');

//add woocommerce functions
if (class_exists('Woocommerce')) {
include (get_template_directory() . '/functions/woo_functions.php');
}

//add EDD functions
if (class_exists('Easy_Digital_Downloads')) {
	include (get_template_directory() . '/functions/edd_functions.php');
}

//add ajax functions
include (get_template_directory() . '/functions/ajax_helper_functions.php');

//add member helper functions
include (get_template_directory() . '/functions/member_helper_functions.php');

//add shortcode functions
include (get_template_directory() . '/shortcodes/shortcodes.php');

// Login / Register Modal
if (rehub_option('userlogin_enable') == '1') {
require_once ( rh_locate_template( 'inc/user-login.php' ) );
}

// Compare functions
if (rehub_option('compare_page') != '' || rehub_option('compare_multicats_textarea') != '') {
require_once ( 'inc/compare.php');
}

// Hot, thumb functions
require_once ( locate_template( 'functions/thumbandhot.php' ) );

//support buddypress functions
if ( class_exists( 'BuddyPress' ) ) {
	require_once ( rh_locate_template( 'buddypress/bp_custom.php' ) );
}


//////////////////////////////////////////////////////////////////
// COMMENTS LAYOUT
//////////////////////////////////////////////////////////////////

if( !function_exists('rehub_framework_comments') ) {
function rehub_framework_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;		
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div class="commbox">
			<div class="comment-author vcard clearfix">
            	<?php edit_comment_link(__('Edit', 'rehub-theme')); ?>
				<?php comment_reply_link(array_merge( $args, array('reply_text' => esc_html__(' Reply', 'rehub-theme'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>                    
				<?php echo get_avatar($comment,$args['avatar_size']); ?>
				<div class="comm_meta_wrap">
					<?php if (rehub_option('rh_enable_mycred_comment') == 1):?>
						<?php 
							$author_id = $comment->user_id;
							if(function_exists('mycred_get_users_rank') && $author_id !=0){
								if(rehub_option('rh_mycred_custom_points')){
									$custompoint = rehub_option('rh_mycred_custom_points');
									$mycredrank = mycred_get_users_rank($author_id, $custompoint );
								}
								else{
									$mycredrank = mycred_get_users_rank($author_id);		
								}
							}
							if(function_exists('mycred_render_shortcode_my_balance')){
							    if(rehub_option('rh_mycred_custom_points')){
							        $custompoint = rehub_option('rh_mycred_custom_points');
							        $mycredpoint = mycred_render_shortcode_my_balance(array('type'=>$custompoint, 'user_id'=>$author_id, 'wrapper'=>'', 'balance_el' => '') );
							    }
							    else{
							        $mycredpoint = mycred_render_shortcode_my_balance(array('user_id'=>$author_id, 'wrapper'=>'', 'balance_el' => '') );           
							    }
							}							

							?>

						<span class="fn"><?php echo get_comment_author_link(); ?><?php if (!empty($mycredrank) && is_object( $mycredrank)) :?><span class="rh-user-rank-mc rh-user-rank-<?php echo (int)$mycredrank->post_id; ?>"><?php echo esc_html($mycredrank->title) ;?></span><?php endif;?></span>
						<div class="comm_meta_cred">
					        <?php if ( function_exists( 'mycred_get_users_badges' ) && $author_id !=0 ) : ?>
								<?php rh_mycred_display_users_badges( $author_id ) ?>
							<?php endif; ?>
					    	<?php if (!empty($mycredpoint)) :?><div><i class="far fa-star"></i> <?php echo ''.$mycredpoint; ?></div><?php endif;?>
					    </div> 
					<?php else:?>
						<span class="fn"><?php echo get_comment_author_link(); ?>
						<?php 	
							if (function_exists('bp_get_member_type')){	
								$author_id = $comment->user_id;		
								$membertype = bp_get_member_type($author_id);
								$membertype_object = bp_get_member_type_object($membertype);
								$membertype_label = (!empty($membertype_object) && is_object($membertype_object)) ? $membertype_object->labels['singular_name'] : '';
								if($membertype_label){
									echo '<span class="rh-user-rank-mc rh-user-rank-'.$membertype.'">'.$membertype_label.'</span>';
								}
							}
						?>		
						</span>
					<?php endif;?>				
					<span class="time"><a href="#comment-<?php comment_ID() ?>"><?php printf(__('%1$s at %2$s', 'rehub-theme'), get_comment_date(),  get_comment_time()) ?></a></span>
	                <?php if ($comment->comment_approved == '0') : ?><div class="ap_waiting"><em><?php esc_html_e('Comment awaiting for approval', 'rehub-theme'); ?></em></div><?php endif; ?>	
                </div>				
			</div>
			<?php if (rehub_option('type_user_review') == 'full_review' || rehub_option('type_user_review') == 'user') :?>               
	          	<?php $userCriteria = get_comment_meta(get_comment_ID(), 'user_criteria', true);
				if(is_array($userCriteria) && !empty($userCriteria)) :?> 
	              <div class="comment-content-withreview">
	                   <?php attach_comment_criteria_raitings () ;?>
	              </div>   
	     		<?php else :?>
	               <div class="comment-content"><?php comment_text(); ?></div>
				<?php endif; ?>
	     	<?php else :?>
	            <div class="comment-content"><?php comment_text(); ?></div>
			<?php endif; ?>			 
		</div>
	<?php 
}
}

if(!function_exists('rh_comment_author_profile_link')){
function rh_comment_author_profile_link(){
global $comment;
if (empty($comment)) return;
$commentauthor_ID = $comment->user_id;

if ($commentauthor_ID ==0) {
	$author = get_comment_author( $comment->comment_ID);
	$url = get_comment_author_url( $comment->comment_ID);
    if ( empty( $url ) || 'http://' == $url )
        $return = $author;
    else
        $return = '<span class="ext-source" data-dest="'.$url.'">'.$author.'</span>';
}
else {
	$author = get_userdata($commentauthor_ID);
    /* Registered Commenter */ 
    if ( !empty($author) ){
		$authorid = $author->ID;
		$authorName = $author->display_name; 
		if (class_exists( 'BuddyPress' )) {
			return '<span class="int-source" data-dest="'.bp_core_get_user_domain($authorid).'">'.$authorName.'</span>'; 
		}
	    elseif (count_user_posts($authorid) > 0 && !empty($author)) {  	
			return '<span class="int-source" data-dest="'.get_author_posts_url($authorid).'">'.$authorName.'</span>';
	    } 	
	    else {
			$author = get_comment_author($comment->comment_ID);
		    $return = $author;
	    }			
    }
 	else {
		$author = get_comment_author($comment->comment_ID);
	    $return = $author;
    }
}
return $return;
}
}
if (rehub_option('enable_comment_link') == 1){
	add_filter('get_comment_author_link', 'rh_comment_author_profile_link');
}



/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
if( !function_exists('my_theme_register_required_plugins') ) {
function my_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
		array(
			'name' => 'One Click Demo Import',
			'slug' => 'one-click-demo-import',
			'required' => false,
			'image_url' => get_template_directory_uri() . '/admin/screens/images/ocdi.jpg',
			'description' => 'Import demo content and settings',
		),    	
		array(
			'name'     				=> 'Envato Market', // The plugin name
			'slug'     				=> 'envato-market', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins/envato-market.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			'image_url'          	=> get_template_directory_uri() . '/admin/screens/images/envato.jpg',			
			'description'			=> 'Auto update of theme',
		),		
		array(
			'name'      => 'Content EGG',
			'slug'      => 'content-egg',
			'required'  => false,
			'image_url'          => get_template_directory_uri() . '/admin/screens/images/contentegg.png',
			'description'			=> 'All in one for moneymaking',			
		),	
		array(
			'name'     				=> 'Rehub Framework', // The plugin name
			'slug'     				=> 'rehub-framework', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins/rehub-framework.zip', 
			'required' 				=> true,
			'version' 				=> '4.1',
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false, 
			'external_url' 			=> '',
			'image_url'          	=> get_template_directory_uri() . '/admin/screens/images/framework.png',
			'description'			=> 'Rehub Theme framework',
		),										

    );
   

    if (REHUB_NAME_ACTIVE_THEME == 'REDOKAN'){
    	$plugins[] = array(
			'name'      => 'Dokan Multivendor Marketplace',
			'slug'      => 'dokan-lite',
			'required'  => true,
			'image_url'          => get_template_directory_uri() . '/admin/screens/images/redokan.jpg',
			'description'			=> 'Vendor Functions for Site',			
		);
    }  

    if (REHUB_NAME_ACTIVE_THEME == 'REHUB' || REHUB_NAME_ACTIVE_THEME == 'REWISE' || REHUB_NAME_ACTIVE_THEME == 'RECASH'){
    	$plugins[] = array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
			'required'  => false,
			'image_url'          => get_template_directory_uri() . '/admin/screens/images/elementor.jpg',
			'description'			=> 'Elementor Page Builder',			
		);
    }        

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'rehub-theme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'rehub-theme' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'rehub-theme' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'rehub-theme' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'rehub-theme' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'rehub-theme' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s. Please, activate only those plug-ins which are necessary to you', 'rehub-theme' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'rehub-theme' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'rehub-theme' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'rehub-theme' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'rehub-theme' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'rehub-theme' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'rehub-theme' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'rehub-theme' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'rehub-theme' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer and Activate plugins', 'rehub-theme' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'rehub-theme' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'rehub-theme' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
}


// Open Graph + JSON-LD
function re_add_openschema() {

	$jsonload = $jsonloadsale = array();
	if (is_single() && !is_singular('product')) {
		global $post;		

		if(vp_metabox('rehub_post.rehub_framework_post_type') == 'review'){

			if(rehub_option('type_schema_review') == 'user' && rehub_option('type_user_review') == 'full_review'){
				$jsonload["@context"] = "http://schema.org/";					
				$usercount = '';
				$user_rates = get_post_meta($post->ID, 'post_user_raitings', true);
				$user_average = get_post_meta($post->ID, 'post_user_average', true);
				if (!empty($user_rates)) {
					$usercount = (!empty($user_rates['criteria'][0]['count'])) ? $user_rates['criteria'][0]['count'] : '';
				}
				if($usercount !=''){
					$jsonload["@type"] = "Book";
					$jsonload["name"] = $post->post_title;
					$jsonload["description"] = $post->post_excerpt;					
					$jsonload["aggregateRating"] = array(
						"@type" => "AggregateRating",
	      				"worstRating" => "1",
	      				"bestRating" => "10",					
						"ratingValue" => round($user_average, 1),
						"reviewCount" => $usercount,
					);
				}
			}
			elseif(rehub_option('type_schema_review') == 'user' && rehub_option('type_user_review') == 'simple'){
				$jsonload["@context"] = "http://schema.org/";					
				$jsonload["@type"] = "Book";
				$jsonload["name"] = $post->post_title;
				$jsonload["description"] = $post->post_excerpt;						
				$rate = get_post_meta($post->ID, 'rehub_user_rate', true );
				$count = get_post_meta($post->ID, 'rehub_users_num', true );
				$userAverage = (!empty($rate) && !empty($count)) ? (($rate/$count)/5)*10 : 9;
				$jsonload["aggregateRating"] = array(
					"@type" => "AggregateRating",
      				"worstRating" => "1",
      				"bestRating" => "10",					
					"ratingValue" => round($userAverage, 1),
					"reviewCount" => $count,
				);
			}				
			elseif(rehub_option('type_schema_review') != 'none'){
				
				$author_data = get_userdata($post->post_author);
				$jsonload["@context"] = "http://schema.org/";

				$overal_score = rehub_get_overall_score();
				$review_body = (vp_metabox('rehub_post.review_post.0.review_post_summary_text') != '') ? vp_metabox('rehub_post.review_post.0.review_post_summary_text') : $post->post_excerpt;
				$review_name = (vp_metabox('rehub_post.review_post.0.review_post_heading') != '') ? vp_metabox('rehub_post.review_post.0.review_post_heading') : $post->post_title;
				$jsonload["@type"] = "Review";
				$jsonload["name"] = $review_name;
				$jsonload["datePublished"] = $post->post_date;
				$jsonload["dateModified"] = $post->post_modified;					
				$jsonload["reviewBody"] = $review_body;
				$jsonload["reviewRating"] = array(
					"@type" => "Rating",
					"worstRating" => "1",
					"bestRating" => "10",
					"ratingValue" => round($overal_score, 1),
				);
			    $jsonload["author"] = array(
			      "@type" => "Person",
			      "name" => $author_data->display_name,
			    ); 	
			    $jsonload["itemReviewed"] = array(
			      	"@type" => "Product",
			      	"name" => $post->post_title,
					"aggregateRating" => array(
						"@type" => "AggregateRating",
      					"worstRating" => "1",
      					"bestRating" => "10",					
						"ratingValue" => round($overal_score, 1),
						"reviewCount" => "1",
					)			      
			    ); 

				$organization = rehub_option('rehub_org_name_review');
				$logo = rehub_option('rehub_logo');
				$logo_width = rehub_option('rehub_logo_retina_width');
				$logo_height = rehub_option('rehub_logo_retina_height');
				if ($organization ){
					$jsonload["publisher"] = array(
						"@type" => "Organization",
						"name" => esc_html($organization),
					);
				
					if ($logo_width && $logo_height && $logo){
						$jsonload["publisher"]["logo"] = array(
							"@type" => "ImageObject",
							"url" => esc_url($logo),
							"height" => esc_html($logo_height),
							"width" => esc_html($logo_width),			
						);
					}
				}					

			}
		}			
	}

	$using_jetpack_publicize = ( class_exists( 'Jetpack' ) && in_array( 'publicize', Jetpack::get_active_modules()) ) ? true : false;
	if ( !defined('WPSEO_VERSION') && !class_exists('NY_OG_Admin') && $using_jetpack_publicize == false && !defined('SEOPRESS_VERSION')) {
		echo '<meta property="og:site_name" content="'. get_bloginfo('name') .'"/>'; // Sets the site name to the one in your WordPress settings
		echo '<meta property="og:url" content="' . get_permalink() . '"/>'; // Gets the permalink to the post/page

		if (is_singular()) { // If we are on a blog post/page
			global $post;
	        echo '<meta property="og:title" content="' . esc_html(get_the_title()) . '"/>'; // Gets the page title
	        echo '<meta property="og:type" content="article"/>'; // Sets the content type to be article.
			if(has_post_thumbnail( get_the_ID() )) { // If the post has a featured image.
				$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
				if (!empty($thumbnail[1])){
					echo '<meta property="og:image" content="' . $thumbnail[0] . '"/>'; 
					echo '<meta property="og:image:width" content="'.$thumbnail[1].'" />';
					echo '<meta property="og:image:height" content="'.$thumbnail[2].'" />';
				}
			} 	        
	    } elseif(is_front_page() or is_home()) { // If it is the front page or home page
	    	echo '<meta property="og:title" content="' . get_bloginfo('name') . '"/>'; // Get the site title
	    	echo '<meta property="og:type" content="website"/>'; // Sets the content type to be website.
	    }
	}
	if(function_exists('bp_get_profile_field_data')){
		if(bp_is_user()){
			global $bp;
			$bpuserid = $bp->displayed_user->id;
			$seo_user_description = '';
			$profile_description = rehub_option('rh_bp_seo_description');
			$profile_phone = rehub_option('rh_bp_phone');			
			$bpuserrating = get_user_meta( $bpuserid, 'rh_bp_user_rating', true);
			$bpuserratingcount = get_user_meta( $bpuserid, 'rh_total_bp_user_rating_num', true);
			$image = bp_attachments_get_attachment('url', array('object_dir' => 'members','item_id' => $bpuserid) );			
			if ($profile_description){
				$seo_user_description = bp_get_profile_field_data('field='.$profile_description.'&user_id='.$bpuserid);
			}
			if ($profile_phone){
				$phone = bp_get_profile_field_data('field='.$profile_phone.'&user_id='.$bpuserid);
			}			
			if(!$seo_user_description){
				$seo_user_description = get_bloginfo('description');
			}
			$seo_user_description = apply_filters('rh_bp_user_seo_description', $seo_user_description);
			echo '<meta name="description" content="'.kama_excerpt('maxchar=220&echo=false&text='.$seo_user_description).'" />';
			$thumbnail = bp_get_displayed_user_avatar('type=full&html=false');
			if (!empty($thumbnail)){
				echo '<meta property="og:image" content="' . $thumbnail . '"/>'; 
				echo '<meta property="og:image:width" content="300" />';
				echo '<meta property="og:image:height" content="300" />';
			}			
		}
	}	

	if(!empty($jsonload)){
		echo '<script type="application/ld+json">'.json_encode($jsonload).'</script>';
	}
}

add_action( 'wp_head', 're_add_openschema', 5 );

//VC init
if (class_exists('WPBakeryVisualComposerAbstract')) {
	if(!function_exists('add_rehub_to_vc')) {
		function add_rehub_to_vc(){
			require_once ( 'functions/vc_functions.php');
		}
	}
	if(!function_exists('rehub_vc_styles')) {
		function rehub_vc_styles() {
			wp_enqueue_style('rehub_vc', get_template_directory_uri() .'/functions/vc/vc.css', array(), time(), 'all');
		}
	}
	function rhVCSetAsTheme() {
	    vc_set_as_theme();
	}

	add_action( 'vc_before_init', 'rhVCSetAsTheme' );		
	add_action('init','add_rehub_to_vc', 5);
	add_action('admin_enqueue_scripts', 'rehub_vc_styles'); 
}

//Elementor Init

if ( did_action( 'elementor/loaded' ) ) {
require_once ('functions/el_functions.php');
require_once ('rehub-elementor/templates/remote.php');
}

/*function rehub_admin_error_notice() {
	$page = (isset($_GET['page'])) ? $_GET['page'] : '';
	global $current_user ;
    $user_id = $current_user->ID;	
    if ( ! get_user_meta($user_id, 'ignore_notices_rehub90') ) {
		if ($page=='rehub' || $page=='rehub-support' || $page=='rehub-plugins' || $page=='rehub-demos' || $page=='vpt_option' ) {
			$class = "error";
			$message = 'This is major update of theme. All sites will be affected by changed code. Please read important information <a href="http://rehubdocs.wpsoul.com/docs/rehub-theme/for-developers/critical-9-0-update/" target="_blank">Rehub 9.0 version</a> which can affect your site.' ;
	    	echo"<div class=\"$class\" style=\"display:block !important\"> <p>$message <a href=\"?rehub_nag_ignore=0\">Hide Notice</a></p></div>";
	    } 
	}
}
add_action( 'admin_notices', 'rehub_admin_error_notice' );	

add_action('admin_init', 'rehub_nag_ignore');
function rehub_nag_ignore() {
	global $current_user;
    $user_id = $current_user->ID;
    if ( isset($_GET['rehub_nag_ignore']) && '0' == $_GET['rehub_nag_ignore'] ) {
        add_user_meta($user_id, 'ignore_notices_rehub90', 'true', true);           
	}
}*/