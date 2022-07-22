<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php

/* 
 * Hooks and filters
 */
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
add_filter( 'pt-ocdi/confirmation_dialog_options', 'rehub_modal_window_settings' );
add_filter( 'pt-ocdi/plugin_page_setup', 'rehub_plugin_page_setup' );
add_filter( 'pt-ocdi/plugin_intro_text', 'rehub_plugin_intro_text' );
add_filter( 'pt-ocdi/import_files', 'rehub_import_files' );
add_action( 'pt-ocdi/before_content_import', 'rehub_before_import_setup' );
add_action( 'pt-ocdi/after_import', 'rehub_after_import_setup' );
add_action( 'admin_print_styles', 'rehub_modal_window_styles' );
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

/* 
 * Menu and page settings
 */
function rehub_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'admin.php';
    $default_settings['page_title']  = esc_html__( 'Demo Import' , 'rehub-theme' );
    $default_settings['menu_title']  = esc_html__( 'Import Demo' , 'rehub-theme' );
    $default_settings['capability']  = 'administrator';
    $default_settings['menu_slug']   = 'import_demo';
    return $default_settings;
}
/* 
 * Changes intro text
 */
function rehub_plugin_intro_text( $default_text ) {
	$rehub_options = get_option( 'Rehub_Key' );
	$tf_username = isset( $rehub_options[ 'tf_username' ] ) ? $rehub_options[ 'tf_username' ] : '';
	$tf_support_date = isset( $rehub_options[ 'tf_support_date' ] ) ? $rehub_options[ 'tf_support_date' ] : '';
	$tf_purchase_code = isset( $rehub_options[ 'tf_purchase_code' ] ) ? $rehub_options[ 'tf_purchase_code' ] : '';
	if( $tf_username !== "" && $tf_purchase_code !== "") {
	    $registeredlicense = true;
	}
	else{
		$registeredlicense = false;
	}
	if(!$registeredlicense){
		$default_text = sprintf( '<h3>To get access to ALL demo stacks, you must register your purchase.<br />See the <a href="%s">Product Registration tab</a> for instructions on how to complete registration.</h3>', admin_url( 'admin.php?page=rehub' ) );
	    return $default_text;		
	}else{
	    return '<br/><a href="http://rehubdocs.wpsoul.com/docs/rehub-theme/theme-install-update-translation/importing-demo-data/" target="_blank">'.__('How to use DEMO import and possible issues. Read before import','rehub-theme').'</a><br/><br/>';
	}	

}
/* 
 * Changes modal window settings
 */
function rehub_modal_window_settings( $options ) {
    return array_merge( $options, array( 'width' => 600, 'dialogClass' => 'rh-dialog' ) );
}
/* 
 * Changes modal window styles
 */
function rehub_modal_window_styles(){
	global $current_screen;
	$current_screen_id = ( $current_screen ) ? $current_screen->id : false;
	if( $current_screen_id && 'admin_page_import_demo' === $current_screen_id ){
		echo '<style type="text/css">.rh-dialog .ocdi__modal-image-container{text-align:center}.rh-dialog .ocdi__modal-image-container img{width:auto}</style>';
	}
}
/* 
 * Before Import setup
 */
function rehub_before_import_setup( $current_import ){
	$rehub_options = get_option( 'Rehub_Key' );
	$tf_username = isset( $rehub_options[ 'tf_username' ] ) ? $rehub_options[ 'tf_username' ] : '';
	$tf_support_date = isset( $rehub_options[ 'tf_support_date' ] ) ? $rehub_options[ 'tf_support_date' ] : '';
	$tf_purchase_code = isset( $rehub_options[ 'tf_purchase_code' ] ) ? $rehub_options[ 'tf_purchase_code' ] : '';
	if( $tf_username !== "" && $tf_purchase_code !== "" ) {
	    $registeredlicense = true;
	}
	else{
		$registeredlicense = false;
	}
	$rplugins = admin_url( 'admin.php?page=rehub-plugins' );
	$wpplugins = admin_url( 'plugin-install.php' );
	$childthemeurl = 'http://rehubdocs.wpsoul.com/docs/rehub-theme/child-themes/';	
	if(!$registeredlicense){
		printf( '<h3>To get access to ALL demo stacks, you must register your purchase.<br />See the <a href="%s">Product Registration tab</a> for instructions on how to complete registration.</h3>', admin_url( 'admin.php?page=rehub' ) );	
		exit();		
	}	

	if( 'ReCash' === $current_import['import_file_name'] ) {
		if(REHUB_NAME_ACTIVE_THEME != 'RECASH'){
			echo 'This demo requires <a href="'.$childthemeurl.'" target="_blank">Recash child theme</a> to be installed and activated.';		
			exit();				
		}
		if ( ! did_action( 'elementor/loaded' ) ) {
			echo 'This demo requires <a href="'.$rplugins.'" target="_blank">Elementor</a> plugin to be installed and activated.';		
			exit();	
		}
	}

	if( 'RePick' === $current_import['import_file_name'] ) {
		if(REHUB_NAME_ACTIVE_THEME != 'REPICK'){
			echo 'This demo requires <a href="'.$childthemeurl.'" target="_blank">Repick child theme</a> to be installed and activated.';		
			exit();				
		}
	}

	if( 'ReWise' === $current_import['import_file_name'] || 'ReCompare' === $current_import['import_file_name'] || 'ReTour' === $current_import['import_file_name']) {
		if ( ! did_action( 'elementor/loaded' ) ) {
			echo 'This demo requires <a href="'.$rplugins.'" target="_blank">Elementor</a> plugin to be installed and activated.';		
			exit();	
		}		
	}

	if( 'ReVendor' === $current_import['import_file_name']) {
		if(REHUB_NAME_ACTIVE_THEME != 'REVENDOR'){
			echo 'This demo requires <a href="'.$childthemeurl.'" target="_blank">Revendor child theme</a> to be installed and activated.';		
			exit();				
		}
		if (!class_exists('WPBakeryVisualComposerAbstract')){
			echo 'This demo requires <a href="'.$rplugins.'" target="_blank">WPBakery Visual Composer</a> plugin to be installed and activated.';		
			exit();	
		}		
	}
	if( 'ReDokan' === $current_import['import_file_name']) {
		if(REHUB_NAME_ACTIVE_THEME != 'REDOKAN'){
			echo 'This demo requires <a href="'.$childthemeurl.'" target="_blank">Redokan child theme</a> to be installed and activated.';		
			exit();				
		}
		if (!class_exists('WPBakeryVisualComposerAbstract')){
			echo 'This demo requires <a href="'.$rplugins.'" target="_blank">WPBakery Visual Composer</a> plugin to be installed and activated.';		
			exit();	
		}		
	}
	if( 'ReMarket' === $current_import['import_file_name'] || 'ReDokanNew' === $current_import['import_file_name']) {
		if ( ! did_action( 'elementor/loaded' ) ) {
			echo 'This demo requires <a href="'.$rplugins.'" target="_blank">Elementor</a> plugin to be installed and activated.';		
			exit();	
		}	
	}		
	if( 'ReDirect' === $current_import['import_file_name']) {
		if(REHUB_NAME_ACTIVE_THEME != 'REDIRECT'){
			echo 'This demo requires <a href="'.$childthemeurl.'" target="_blank">Redirect child theme</a> to be installed and activated.';		
			exit();				
		}
		if (!class_exists('WPBakeryVisualComposerAbstract')){
			echo 'This demo requires <a href="'.$rplugins.'" target="_blank">WPBakery Visual Composer</a> plugin to be installed and activated.';		
			exit();	
		}		
	}
	if( 'ReThing' === $current_import['import_file_name']) {
		if(REHUB_NAME_ACTIVE_THEME != 'RETHING'){
			echo 'This demo requires <a href="'.$childthemeurl.'" target="_blank">Rething child theme</a> to be installed and activated.';		
			exit();				
		}
		if (!class_exists('WPBakeryVisualComposerAbstract')){
			echo 'This demo requires <a href="'.$rplugins.'" target="_blank">WPBakery Visual Composer</a> plugin to be installed and activated.';		
			exit();	
		}		
	}

	if( 'ReMag' === $current_import['import_file_name']) {
		if(REHUB_NAME_ACTIVE_THEME != 'REHUB'){
			echo 'This demo requires Rehub theme to be installed and activated without child themes.';		
			exit();				
		}
		if ( ! did_action( 'elementor/loaded' ) ) {
			echo 'This demo requires <a href="'.$rplugins.'" target="_blank">Elementor</a> plugin to be installed and activated.';		
			exit();	
		}		
	}
	if( 'ReCart' === $current_import['import_file_name']) {
		if ( ! did_action( 'elementor/loaded' ) ) {
			echo 'This demo requires <a href="'.$rplugins.'" target="_blank">Elementor</a> plugin to be installed and activated.';		
			exit();	
		}		
	}
	if( 'ReDeal' === $current_import['import_file_name']) {
		if ( ! did_action( 'elementor/loaded' ) ) {
			echo 'This demo requires <a href="'.$rplugins.'" target="_blank">Elementor</a> plugin to be installed and activated.';		
			exit();	
		}		
	}							

}
/* 
 * Demo data array
 */
function rehub_import_files() {
	$rplugins = admin_url( 'admin.php?page=rehub-plugins' );
	$wpplugins = admin_url( 'plugin-install.php' );
	$childthemeurl = 'http://rehubdocs.wpsoul.com/docs/rehub-theme/child-themes/';
	$themeoptions = admin_url( 'admin.php?page=vpt_option#_menu_aff' );
	$requirednotice = esc_html__('Make sure that you have active next required plugins:', 'rehub-theme');
	$optionalnotice = esc_html__('Next plugins are optional. To get full demo functions, make sure that you installed and activated them. However, they are not required for demo and theme, if you think that you will not need them, just ignore them:', 'rehub-theme');
	$themenotice = esc_html__('Make sure that you have active next Theme:', 'rehub-theme');
	$themeoptionnotice = esc_html__('Make sure that you have active next Theme options:', 'rehub-theme');
	$installpnotice = esc_html__('Install plugins', 'rehub-theme');
	$installonotice = esc_html__('Activate option', 'rehub-theme');
	$installtnotice = esc_html__('How to get child theme', 'rehub-theme');

	if (!defined( 'WPFEPP_SLUG' )){
		$rhfrontendnotice = '<li><span style="color:red">RH Frontend Publishing Pro - NOT active</span>. <a href="'.$rplugins.'" target="_blank">Install plugin</a></li>';
	}
	else{
		$rhfrontendnotice = '<li>RH Frontend Publishing Pro - <span style="color:green">active</span>. Attention, demo import will overwrite your existing forms for plugin</li>';
	}
	if (!class_exists('WPBakeryVisualComposerAbstract')){
		$rhvcnotice = '<li><span style="color:red">Visual Composer - NOT active</span>. <a href="'.$rplugins.'" target="_blank">'.$installpnotice.'</a></li>';
	}
	else{
		$rhvcnotice = '<li>WP Bakery Visual Composer - <span style="color:green">active</span></li>';
	}
	if( !defined( 'RHWCT_SLUG' ) ){
		$rhwootoolnotice = '<li><span style="color:red">RH Woo Tools - NOT active</span>. <a href="'.$rplugins.'" target="_blank">'.$installpnotice.'</a></li>';
	}
	else{
		$rhwootoolnotice = '<li>RH Woo Tools - <span style="color:green">active</span></li>';
	}	
	if ( ! did_action( 'elementor/loaded' ) ) {
		$rhelnotice = '<li><span style="color:red">Elementor plugin - NOT active</span>. <a href="'.$rplugins.'" target="_blank">'.$installpnotice.'</a></li>';
	}
	else{
		$rhelnotice = '<li>Elementor - <span style="color:green">active</span></li>';
	}	
	if (!defined('\ContentEgg\PLUGIN_PATH')){
		$rhcenotice = '<li><span style="color:red">Content Egg (Offer module) - NOT active</span>. <a href="'.$rplugins.'" target="_blank">'.$installpnotice.'</a></li>';
	}
	else{
		$rhcenotice = '<li>Content Egg - <span style="color:green">active</span>. Enable Offer module</li>';
	}
	if (!class_exists( 'RevSlider' )){
		$rhrslidernotice = '<li><span style="color:red">Revolution Slider - NOT active</span>. <a href="'.$rplugins.'" target="_blank">'.$installpnotice.'</a></li>';
	}
	else{
		$rhrslidernotice = '<li>Revolution Slider - <span style="color:green">active</span></li>';
	}

	if (!class_exists('MetaDataFilter')){
		$rhmdtfnotice = '<li><span style="color:red">MDTF - NOT active</span>. <a href="'.$rplugins.'" target="_blank">'.$installpnotice.'</a></li>';
	}
	else{
		$rhmdtfnotice = '<li>MDTF - <span style="color:green">active</span></li>';
	}				

	if (!class_exists('Woocommerce')){
		$rhwoonotice = '<li><span style="color:red">Woocommerce - NOT active</span>. <a href="'.$wpplugins.'?s=woocommerce&tab=search&type=term" target="_blank">'.$installpnotice.'</a></li>';
	}
	else{
		$rhwoonotice = '<li>Woocommerce - <span style="color:green">active</span></li>';
	}
	if(!class_exists( 'BuddyPress' ) ) {
		$rhbpnotice = '<li><span style="color:red">Buddypress - NOT active</span>. <a href="'.$wpplugins.'?s=buddypress&tab=search&type=term" target="_blank">'.$installpnotice.'</a></li>';
	}
	else{
		$rhbpnotice = '<li>Buddypress - <span style="color:green">active</span></li>';
	}	

	if (!class_exists('GMW_Posts_Locator_Addon')){
		$rhgmwpostnotice = '<li><span style="color:red">Geo My wordpress - NOT active</span>. <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a>. After installing plugin, go to Geo My Wordpress - extensions and activate Post Addon and Single Location addon, then Geo My Wordpress - settings and add your google map API keys</li>';
	}
	else{
		$rhgmwpostnotice = '<li>Geo My wordpress - <span style="color:green">active</span></li>';
	}	

	if (!class_exists('GMW_Members_locator_Addon') || !class_exists( 'BuddyPress' )){
		$rhgmwnotice = '<li><span style="color:red">Geo My wordpress - NOT active</span>. <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a>. After installing plugin, go to Geo My Wordpress - extensions and activate Member Addon and Single Location addon, then Geo My Wordpress - settings and add your google map API keys</li>';
	}
	else{
		$rhgmwnotice = '<li>Geo My wordpress - <span style="color:green">active</span></li>';
	}	

	if (!class_exists('WeDevs_Dokan')){
		$rhdokannotice = '<li><span style="color:red">Dokan - NOT active</span>. <a href="'.$wpplugins.'?s=dokan&tab=search&type=term" target="_blank">'.$installpnotice.'</a>. After activation - set google API keys in settings of Dokan to have store locator</li>';
	}
	else{
		$rhdokannotice = '<li>Dokan - <span style="color:green">active</span></li>';
	}

	if (!defined( 'wcv_plugin_dir' )){
		$rhvendornotice = '<li><span style="color:red">WC Vendor - NOT active</span>. <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a></li>';
	}
	else{
		$rhvendornotice = '<li>WC Vendor - <span style="color:green">active</span></li>';
	}

	if (!class_exists('WCMp')){
		$rhmarketnotice = '<li><span style="color:red">WC marketplace - NOT active</span>. <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a></li>';
	}
	else{
		$rhmarketnotice = '<li>WC marketplace - <span style="color:green">active</span></li>';
	}			

	if (rehub_option('enable_brand_taxonomy') ){
		$rhstorenotice = '<li><code>Theme options -> Affiliate -> Enable Affiliate Store taxonomy for posts</code> - <span style="color:green">active</span></li>';
	}
	else{
		$rhstorenotice = '<li><code>Theme options -> Affiliate -> Enable Affiliate Store taxonomy for posts</code> <span style="color:red"> - NOT active</span>. <a href="'.$themeoptions.'" target="_blank">'.$installonotice.'</a></li>';		
	}
	if (rehub_option('enable_blog_posttype') ){
		$rhblognotice = '<li><code>Theme options -> Affiliate -> Enable separate blog post type</code> - <span style="color:green">active</span></li>';
	}
	else{
		$rhblognotice = '<li><code>Theme options -> Affiliate -> Enable separate blog post type</code> <span style="color:red"> - NOT active</span>. <a href="'.$themeoptions.'" target="_blank">'.$installonotice.'</a></li>';		
	}

	$remagnotice = $requirednotice.'<ol>';
	$remagnotice .= $rhelnotice;
	$remagnotice .='</ol>';
	$remagnotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$remagnotice .= $rhbpnotice;
	$remagnotice .= $rhfrontendnotice;	
	$remagnotice .= $rhcenotice;
	$remagnotice .= '<li>Mycred</li>';	
	$remagnotice .='</ol>';
	$remagnotice .=$themenotice.'<ol>';
	if (REHUB_NAME_ACTIVE_THEME != 'REHUB'){
		$remagnotice .= '<li><span style="color:red">Child theme is active, disable child theme of Re:hub and enable just Rehub theme</span></li>';
	}
	else{
		$remagnotice .= '<li>Rehub - <span style="color:green">active</span></li>';
	}
	$remagnotice .='</ol>';			

	$recashnotice = $requirednotice.'<ol>';
	$recashnotice .= $rhfrontendnotice;
	$recashnotice .= $rhelnotice;
	$recashnotice .='</ol>';
	$recashnotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$recashnotice .= $rhbpnotice;
	$recashnotice .= '<li>MyCred</li>';	
	$recashnotice .='</ol>';
	$recashnotice .=$themenotice.'<ol>';
	if (REHUB_NAME_ACTIVE_THEME != 'RECASH'){
		$recashnotice .= '<li><span style="color:red">Recash - not active.</span> <a href="'.$childthemeurl.'" target="_blank">'.$installtnotice.'</a></li>';
	}
	else{
		$recashnotice .= '<li>Recash - <span style="color:green">active</span></li>';
	}
	$recashnotice .='</ol>';
	$recashnotice .= $themeoptionnotice.'<ol>';
	$recashnotice .= $rhstorenotice;
	$recashnotice .='</ol>';

	$redealnotice = $requirednotice.'<ol>';
	$redealnotice .= $rhelnotice;
	$redealnotice .='</ol>';
	$redealnotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$redealnotice .= $rhbpnotice;
	$redealnotice .= $rhfrontendnotice;
	$redealnotice .= '<li>MyCred (for cashback points)</li>';	
	$redealnotice .= '<li>Contact form 7 (for payment requests)</li>';
	$redealnotice .= '<li>WP Enable WebP (to enable WebP image format in WP)</li>';		
	$redealnotice .= '<li>CashbackTracker PRO (Paid plugin, for auto cashback tracking)</li>';
	$redealnotice .='</ol>';
	$redealnotice .= $themeoptionnotice.'<ol>';
	$redealnotice .= $rhstorenotice;
	$redealnotice .= $rhblognotice;
	$redealnotice .='</ol>';	


	$redirectnotice = $requirednotice.'<ol>';
	$redirectnotice .= $rhfrontendnotice;
	$redirectnotice .= $rhvcnotice;
	$redirectnotice .= $rhwoonotice;		
	$redirectnotice .='</ol>';
	$redirectnotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$redirectnotice .= $rhgmwnotice;	
	$redirectnotice .='</ol>';
	$redirectnotice .=$themenotice.'<ol>';
	if (REHUB_NAME_ACTIVE_THEME != 'REDIRECT'){
		$redirectnotice .= '<li><span style="color:red">Redirect - not active.</span> <a href="'.$childthemeurl.'" target="_blank">'.$installtnotice.'</a></li>';
	}
	else{
		$redirectnotice .= '<li>Redirect - <span style="color:green">active</span></li>';
	}
	$redirectnotice .= $themeoptionnotice.'<ol>';
	$redirectnotice .= $rhblognotice;
	$redirectnotice .= $rhstorenotice;	
	$redirectnotice .='</ol>';		

	$repicknotice = $requirednotice.'<ol>';
	$repicknotice .= $rhcenotice;
	$repicknotice .='</ol>';
	$repicknotice .=$themenotice.'<ol>';
	if (REHUB_NAME_ACTIVE_THEME != 'REPICK'){
		$repicknotice .= '<li><span style="color:red">Repick - not active.</span> <a href="'.$childthemeurl.'" target="_blank">'.$installtnotice.'</a></li>';
	}
	else{
		$repicknotice .= '<li>Repick - <span style="color:green">active</span></li>';
	}
	$repicknotice .='</ol>';
	$repicknotice .= 'After installation, go to settings of Content Egg and enable Amazon and other modules. <a href="http://www.keywordrush.com/en/docs/content-egg" target="_blank">Check docs of Content Egg</a>. Choose "Shortcode only" for Add Content Option. <a href="https://wpsoul.com/guide-creating-profitable/" target="_blank">How to use plugin with theme in posts.</a>';

	$rewisenotice = $requirednotice.'<ol>';
	$rewisenotice .= $rhcenotice;
	$rewisenotice .= $rhelnotice;
	$rewisenotice .= $rhwoonotice;
	$rewisenotice .='</ol>';
	$rewisenotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$rewisenotice .='</ol>';
	$rewisenotice .= $themeoptionnotice.'<ol>';
	$rewisenotice .= $rhstorenotice;
	$rewisenotice .= $rhblognotice;
	$rewisenotice .='</ol>';
	$rewisenotice .= 'After installation, go to settings of Content Egg and enable Amazon and other modules. <a href="http://www.keywordrush.com/en/docs/content-egg" target="_blank">Check docs of Content Egg</a>. Choose "Shortcode only" for Add Content Option. <br><br><a href="https://wpsoul.com/guide-creating-profitable/" target="_blank">How to use plugin with theme in posts.</a>, <br><br><a href="https://wpsoul.com/make-smart-profitable-deal-affiliate-comparison-site-woocommerce/" target="_blank">How to use plugin with theme for price comparison in products.</a>, <br><br><a href="http://rehubdocs.wpsoul.com/docs/rehub-theme/shop-options-woo-edd/better-product-filtering/" target="_blank">Better Product Filtering.</a>';

	$retournotice = $requirednotice.'<ol>';
	$retournotice .= $rhelnotice;
	$retournotice .= $rhwoonotice;
	$retournotice .='</ol>';
	$retournotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$retournotice .= $rhgmwnotice;	
	$retournotice .='</ol>';
	$retournotice .= '<span style="color:red">If you need Bookable options for product, you must use one of Booking plugins for Woocommerce. Plugins are not bundled with theme.</span> We recommend: <ul><li>Woocommerce Booking</li> <li>Woocommerce Appointment</li> <li>Woocommerce Booking and Rental</li></ul> If you need also to have multivendor option, these are possible combinations: <ul><li>WCFM (free or Ultimate) + any of Booking plugins</li><li>Dokan PRO with Booking addon + Woocommerce Booking</li><li>WC Vendor + Booking addon + Woocommerce Booking</li></ul>';	

	$recomparenotice = $requirednotice.'<ol>';
	$recomparenotice .= $rhcenotice;
	$recomparenotice .= $rhelnotice;
	$recomparenotice .= $rhwoonotice;
	$recomparenotice .='</ol>';
	$recomparenotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$recomparenotice .= $rhrslidernotice;	
	$recomparenotice .='</ol>';
	$recomparenotice .= 'After installation, go to settings of Content Egg and enable Amazon and other modules. <a href="http://www.keywordrush.com/en/docs/content-egg" target="_blank">Check docs of Content Egg</a>. Choose "Shortcode only" for Add Content Option. <br><br><a href="https://wpsoul.com/make-smart-profitable-deal-affiliate-comparison-site-woocommerce/" target="_blank">How to use plugin with theme for price comparison in products.</a><br><br>Revolution slider is not included in demo, but you can download plugin <a href="'.$rplugins.'" target="_blank">from bonus plugins</a> and download separate Sliders from our <a href="http://rehubdocs.wpsoul.com/docs/rehub-theme/page-builder/slider-and-top-area-ready-templates/" target="_blank">Slider import page</a>. <br><br><a href="http://rehubdocs.wpsoul.com/docs/rehub-theme/shop-options-woo-edd/better-product-filtering/" target="_blank">Better Product Filtering.</a>';

	$redokannotice = $requirednotice.'<ol>';
	$redokannotice .= $rhvcnotice;
	$redokannotice .= $rhwoonotice;
	$redokannotice .= $rhdokannotice;
	$redokannotice .= $rhbpnotice;	
	$redokannotice .='</ol>';
	$redokannotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$redokannotice .= '<li>Buddypress Follow</li>';
	$redokannotice .= $rhgmwnotice;	
	$redokannotice .= $rhrslidernotice;
	$redokannotice .='</ol>';
	$redokannotice .=$themenotice.'<ol>';
	if (REHUB_NAME_ACTIVE_THEME != 'REDOKAN'){
		$redokannotice .= '<li><span style="color:red">Redokan - not active.</span> <a href="'.$childthemeurl.'" target="_blank">'.$installtnotice.'</a></li>';
	}
	else{
		$redokannotice .= '<li>Redokan - <span style="color:green">active</span></li>';
	}
	$redokannotice .='</ol>';		
	$redokannotice .= 'After installation, go to settings of vendor plugin for basic configuration. We recommend to read our guide for some additional information about <a href="https://wpsoul.com/how-to-create-multi-vendor-shop-on-wordpress/" target="_blank">Multi vendor sites</a> and also docs for Vendor plugin';

	$redokannewnotice = $requirednotice.'<ol>';
	$redokannewnotice .= $rhelnotice;
	$redokannewnotice .= $rhwoonotice;	
	$redokannewnotice .='</ol>';		
	$redokannewnotice .= 'After installation, go to settings of vendor plugin for basic configuration. We recommend to read our guide for some additional information about <a href="https://wpsoul.com/how-to-create-multi-vendor-shop-on-wordpress/" target="_blank">Multi vendor sites</a> and also docs for Vendor plugin';	

	$revendornotice = $requirednotice.'<ol>';
	$revendornotice .= $rhvcnotice;
	$revendornotice .= $rhwoonotice;
	$revendornotice .= $rhvendornotice;
	$revendornotice .= $rhbpnotice;	
	$revendornotice .='</ol>';
	$revendornotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$revendornotice .= '<li>Buddypress Follow</li>';
	$revendornotice .= $rhgmwnotice;
	$revendornotice .='</ol>';
	$revendornotice .=$themenotice.'<ol>';
	if (REHUB_NAME_ACTIVE_THEME != 'REVENDOR'){
		$revendornotice .= '<li><span style="color:red">Revendor - not active.</span> <a href="'.$childthemeurl.'" target="_blank">'.$installtnotice.'</a></li>';
	}
	else{
		$revendornotice .= '<li>Revendor - <span style="color:green">active</span></li>';
	}
	$revendornotice .='</ol>';		
	$revendornotice .= 'After installation, go to settings of vendor plugin for basic configuration. We recommend to read our guide for some additional information about <a href="https://wpsoul.com/how-to-create-multi-vendor-shop-on-wordpress/" target="_blank">Multi vendor sites</a> and also docs for Vendor plugin. <br><br><a href="http://rehubdocs.wpsoul.com/docs/rehub-theme/shop-options-woo-edd/better-product-filtering/" target="_blank">Better Product Filtering.</a>';	

	$remarketnotice = $requirednotice.'<ol>';
	$remarketnotice .= $rhelnotice;
	$remarketnotice .= $rhwoonotice;	
	$remarketnotice .='</ol>';		
	$remarketnotice .= 'After installation, go to Tutorial link in your menu to get some tutorials. We recommend to read our guide for some additional information about <a href="https://wpsoul.com/how-to-create-multi-vendor-shop-on-wordpress/" target="_blank">Multi vendor sites</a> and also docs for Vendor plugin.';

	$rethingnotice = $requirednotice.'<ol>';
	$rethingnotice .= $rhvcnotice;
	$rethingnotice .='</ol>';
	$rethingnotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$rethingnotice .= $rhcenotice;	
	$rethingnotice .='</ol>';
	$rethingnotice .=$themenotice.'<ol>';
	if (REHUB_NAME_ACTIVE_THEME != 'RETHING'){
		$rethingnotice .= '<li><span style="color:red">Rething child theme - not active.</span> <a href="'.$childthemeurl.'" target="_blank">'.$installtnotice.'</a></li>';
	}
	else{
		$rethingnotice .= '<li>Rething child theme - <span style="color:green">active</span></li>';
	}
	$rethingnotice .='</ol>';
	$rethingnotice .= 'After installation, go to settings of Content Egg and enable Amazon and other modules. <a href="http://www.keywordrush.com/en/docs/content-egg" target="_blank">Check docs of Content Egg</a>. Choose "Shortcode only" for Add Content Option. <br><br><a href="https://wpsoul.com/guide-creating-profitable/" target="_blank">How to use plugin with theme in posts</a>, <br><br><a href="https://wpsoul.com/make-smart-profitable-deal-affiliate-comparison-site-woocommerce/" target="_blank">How to use plugin with theme for price comparison in products.</a>';

	$recartnotice = $requirednotice.'<ol>';
	$recartnotice .= $rhelnotice;
	$recartnotice .= $rhwoonotice;
	$recartnotice .='</ol>';
	$recartnotice .= $optionalnotice.' <a href="'.$wpplugins.'" target="_blank">'.$installpnotice.'</a><ol>';
	$recartnotice .= $rhcenotice;	
	$recartnotice .= $rhwootoolnotice;
	$recartnotice .='</ol>';
	$recartnotice .= '';				


	$demos = array(
		array(
			'import_file_name' => 'ReWise',
			'categories' => array( esc_html__( 'Comparison', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/rewise-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/rewise-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/rewise-theme.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo7_preview.jpg',
			'import_notice' => $rewisenotice,
			'preview_url' => 'http://rewise.wpsoul.net/',
		),
		array(
			'import_file_name' => 'ReCart',
			'categories' => array( esc_html__( 'E-commerce', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/recart-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/recart-widgets.wie',				
			'local_import_theme_file' => get_template_directory() . '/admin/demo/recart-theme.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo11_preview.jpg',
			'import_notice' => $recartnotice,
			'preview_url' => 'https://recart.wpsoul.com/',
		),		
		array(
			'import_file_name' => 'ReCompare',
			'categories' => array( esc_html__( 'Comparison', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/recompare-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/recompare-widgets.wie',				
			'local_import_theme_file' => get_template_directory() . '/admin/demo/recompare-theme.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo10_preview.jpg',
			'import_notice' => $recomparenotice,
			'preview_url' => 'http://recompare.wpsoul.net/',
		),
		array(
			'import_file_name' => 'ReDeal',
			'categories' => array( esc_html__( 'Deal Site', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/redeal-content.xml',
			'rhfrontend' => PLUGIN_REPO . 'demoimport/redeal-frontend.json',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/redeal-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/redeal-theme.json',		
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo14_preview.jpg',
			'import_notice' => $redealnotice,
			'preview_url' => 'https://redeal.wpsoul.com/',
		),		
		array(
			'import_file_name' => 'ReTour',
			'gmwforms' => PLUGIN_REPO . 'demoimport/retour-gmw.json',						
			'categories' => array( esc_html__( 'Multi vendor', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/retour-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/retour-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/retour-theme.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo12_preview.jpg',
			'import_notice' => $retournotice,
			'preview_url' => 'https://retour.wpsoul.com/',
		),		
		array(
			'import_file_name' => 'RePick',
			'categories' => array( esc_html__( 'Deal Site', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/repick-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/repick-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/repick-theme.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo2_preview.jpg',
			'import_notice' => $repicknotice,
			'preview_url' => 'http://repick.wpsoul.net/',
		),
		array(
			'import_file_name' => 'ReCash',
			'categories' => array( esc_html__( 'Deal Site', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/recash-content.xml',
			'rhfrontend' => PLUGIN_REPO . 'demoimport/recash-frontend.json',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/recash-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/recash-theme.json',		
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo4_preview.jpg',
			'import_notice' => $recashnotice,
			'preview_url' => 'http://recash.wpsoul.net/',
		),
		array(
			'import_file_name' => 'ReDokanNew',
			'categories' => array( esc_html__( 'Multi vendor', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/vendor-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/redokannew-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/redokannew-theme.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo13_preview.jpg',
			'import_notice' => $redokannewnotice,
			'preview_url' => 'https://redokan.wpsoul.com/',
		),					
		array(
			'import_file_name' => 'ReMarket',
			'categories' => array( esc_html__( 'Multi vendor', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/vendor-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/remarket-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/remarket-theme.json',			
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo9_preview.jpg',
			'import_notice' => $remarketnotice,
			'preview_url' => 'https://remarket.wpsoul.com/',
		),
		array(
			'import_file_name' => 'ReVendor',
			'categories' => array( esc_html__( 'Multi vendor', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/revendor-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/revendor-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/revendor-theme.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo6_preview.jpg',
			'gmwforms' => PLUGIN_REPO . 'demoimport/revendor-gmw.json',	
			'rhfrontend' => PLUGIN_REPO . 'demoimport/revendor-frontend.json',					
			'import_notice' => $revendornotice,
			'preview_url' => 'http://revendor.wpsoul.net/',
		),
		array(
			'import_file_name' => 'ReDokan',
			'categories' => array( esc_html__( 'Multi vendor', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/redokan-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/redokan-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/redokan-theme.json',
			'sliders' => array('http://rehubdocs.wpsoul.com/wp-content/uploads/2017/10/redokan1.zip'),
			'gmwforms' => PLUGIN_REPO . 'demoimport/redokan-gmw.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo8_preview.jpg',
			'import_notice' => $redokannotice,
			'preview_url' => 'http://redokan.wpsoul.net/',
		),														
		array(
			'import_file_name' => 'ReThing',
			'categories' => array( esc_html__( 'Other', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/rething-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/rething-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/rething-theme.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo3_preview.jpg',
			'import_notice' => $rethingnotice,
			'preview_url' => 'http://rething.wpsoul.net/',
		),
		array(
			'import_file_name' => 'ReDirect',
			'gmwforms' => PLUGIN_REPO . 'demoimport/redirect-gmw.json',				
			'rhfrontend' => PLUGIN_REPO . 'demoimport/redirect-frontend.json',			
			'categories' => array( esc_html__( 'Other', 'rehub-theme' ) ),
			'import_file_url' => PLUGIN_REPO . 'demoimport/redirect-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/redirect-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/redirect-theme.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo5_preview.jpg',
			'import_notice' => $redirectnotice,
			'preview_url' => 'http://redirect.wpsoul.net/',
		),
		array(
			'import_file_name' => 'ReMag',
			'categories' => array( esc_html__( 'Other', 'rehub-theme' ) ),				
			'rhfrontend' => PLUGIN_REPO . 'demoimport/remag-frontend.json',			
			'import_file_url' => PLUGIN_REPO . 'demoimport/remag-content.xml',
			'import_widget_file_url' => PLUGIN_REPO . 'demoimport/remag-widgets.wie',
			'local_import_theme_file' => get_template_directory() . '/admin/demo/remag-theme.json',
			'import_preview_image_url'   => get_template_directory_uri() .'/admin/screens/images/demo1_preview.jpg',
			'import_notice' => $remagnotice,
			'preview_url' => 'https://remag.wpsoul.net/',
		),						
	);	
	return $demos;
	
}
/* 
 * After Import setup
 */
function rehub_after_import_setup( $current_import ) {
	
	$front_page = $blog_page = $main_menu = $top_menu = $user_menu = $stylesheet = '';
	$import_file_name = $current_import['import_file_name'];
	$options_file_path = isset( $current_import['local_import_theme_file'] ) ? $current_import['local_import_theme_file'] : '';
	$gmwforms = isset( $current_import['gmwforms'] ) ? $current_import['gmwforms'] : '';
	$rhfrontend = isset( $current_import['rhfrontend'] ) ? $current_import['rhfrontend'] : '';	
	$sliders = isset( $current_import['sliders'] ) ? $current_import['sliders'] : '';
	
	switch ( $import_file_name ) {
		case 'ReMag' :
			$front_page = get_page_by_title( 'Homepage Rehub' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );			
			break;		
		case 'RePick':
			$front_page = get_page_by_title( 'Home page Repick' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );
			$top_menu = get_term_by( 'slug', 'top-menu', 'nav_menu' );
			break;
		case 'ReThing':
			$front_page = get_page_by_title( 'Home Rething' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );
			break;
		case 'ReCash':
			$front_page = get_page_by_title( 'Homepage Recash' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );
			break;
		case 'ReDeal':
			$front_page = get_page_by_title( 'Homepage Redeal' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );
			$themeoptionmenu = get_term_by('name', 'Menu for logo section', 'nav_menu');
			break;			
		case 'ReDirect':
			$front_page = get_page_by_title( 'Home Redirect' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );		
			break;
		case 'ReVendor':
			$front_page = get_page_by_title( 'Home Revendor' );
			$blog_page = get_page_by_title( 'Reviews' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );
			$userarray = array(
				array (
					'email' => 'revendor@test.com',
					'name' => 'Revendortest',
					'role' => 'vendor',
					'meta' => array(
						'pv_shop_name' => 'Revendortest'
					),
					'location'=> '18 West St, Brooklyn, NY 11222, USA',
					'products' => 5,
				),
			);			
			break;
		case 'ReWise':
			$front_page = get_page_by_title( 'Home page Rewise' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );
			break;		

		case 'ReDokan':
			$front_page = get_page_by_title( 'Home Redokan' );
			$blog_page = get_page_by_title( 'Reviews' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );
			$userarray = array(
				array (
					'email' => 'redokan@test.com',
					'name' => 'Redokanvendor',
					'role' => 'seller',
					'meta' => array(
						'dokan_store_name' => 'Redokanvendor'
					),
					'location'=> '18 West St, Brooklyn, NY 11222, USA',
					'posts' => 3,
					'products' => 5,
				),
			);			
			break;
		case 'ReDokanNew':
			$front_page = get_page_by_title( 'Homepage Redokan' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );
			$top_menu = get_term_by( 'slug', 'top-menu', 'nav_menu' );		
			break;			
		case 'ReMarket':
			$front_page = get_page_by_title( 'Remarket Home' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );	
			$top_menu = get_term_by( 'slug', 'top-menu', 'nav_menu' );		
			break;
		case 'ReCart':
			$front_page = get_page_by_title( 'Homepage Recart' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );			
			break;	
		case 'ReTour':
			$front_page = get_page_by_title( 'Homepage Booking' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );			
			break;							
			
		case 'ReCompare':
			$front_page = get_page_by_title( 'Homepage Recompare' );
			$blog_page = get_page_by_title( 'News and reviews' );
			$main_menu = get_term_by( 'slug', 'main-menu', 'nav_menu' );
			break;
		default:			
	}
	
	if( $options_file_path ) {
		$options_raw_data = OCDI\Helpers::data_from_file( $options_file_path );
		if ( !is_wp_error( $options_raw_data ) ) {
			$theme_options_data = json_decode( $options_raw_data, true );
			update_option( 'rehub_option', $theme_options_data );	
			echo 'Theme Options was updated-------';	
			if(class_exists('REHub_Framework_Customizer')){
				$customizer = new REHub_Framework_Customizer();
        		$customizer->rh_save_customizer_options( $theme_options_data );	
        		echo 'Customizer was updated-------';			
			}
	
		}
	}

	if( $gmwforms && function_exists('gmw_object_to_array')) {
		$gmwforms_data = OCDI\Helpers::data_from_file( $gmwforms );
		if ( !is_wp_error( $gmwforms_data ) ) {
			$gmwforms = json_decode( $gmwforms_data, true );
			$forms = gmw_object_to_array( $gmwforms );
			global $wpdb;	
			foreach ( $forms as $form ) {
		        $wpdb->insert( 
		            $wpdb->prefix . 'gmw_forms', 
		            array( 
		            	'slug'   => $form['slug'], 
		            	'addon'  => $form['addon'],  
		                'name'   => $form['name'],
		                'title'  => $form['title'],
		                'prefix' => $form['prefix'],
		                'data'	 => $form['data']
		            ),
		            array(
		                '%s',
		                '%s',
		                '%s',
		                '%s',
		                '%s',
		                '%s'
		            )
		        );
		    }			
			echo 'GMW forms was added-------';		
		}
	}

	if( $rhfrontend && defined( 'WPFEPP_SLUG' )) {
		rh_import_tables_from_json('wpfepp_forms', $rhfrontend );			
		echo 'RH Frontend forms was added-------';		
	}		
	
	$main_menu_id = ($main_menu ) ? (int) $main_menu->term_id : '';
	$top_menu_id =( $top_menu ) ? (int) $top_menu->term_id : '';
	$user_menu_id = ( $user_menu ) ? (int) $user_menu->term_id : '';
	$themeoptionmenu_id = ($themeoptionmenu) ? (int) $themeoptionmenu->term_id : '';
	set_theme_mod( 'nav_menu_locations', array( 'primary-menu' => $main_menu_id, 'top-menu' => $top_menu_id, 'user_logged_in_menu' => $user_menu_id ) );
	if($themeoptionmenu_id){
		$theme_option = get_option('rehub_option');
		$theme_option['header_six_menu'] = $themeoptionmenu_id;
		update_option( 'rehub_option', $theme_option );
	}
	echo 'Menu was assigned-------';

	if ($import_file_name == 'ReCash'){
		$firstparent = get_page_by_title( 'Layout examples', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'273', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($firstparent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $firstparent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
	}

	if ($import_file_name == 'ReDokan'){
		$firstparent = get_page_by_title( 'Unique product types', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'531', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($firstparent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $firstparent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
	}	

	if ($import_file_name == 'ReVendor'){
		$firstparent = get_page_by_title( 'Unique Functions', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'674', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($firstparent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $firstparent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent2 = get_page_by_title( 'Product Types', OBJECT, 'nav_menu_item');
		$menus2 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'678', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus2) && !empty($parent2)){
			foreach ($menus2 as $menu2) {
				update_post_meta($menu2->ID, '_menu_item_menu_item_parent', $parent2->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent3 = get_page_by_title( 'Simple Product Types', OBJECT, 'nav_menu_item');
		$menus3 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'679', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus3) && !empty($parent3)){
			foreach ($menus3 as $menu3) {
				update_post_meta($menu3->ID, '_menu_item_menu_item_parent', $parent3->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent4 = get_page_by_title( 'Advanced Product Types', OBJECT, 'nav_menu_item');
		$menus4 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'680', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus4) && !empty($parent4)){
			foreach ($menus4 as $menu4) {
				update_post_meta($menu4->ID, '_menu_item_menu_item_parent', $parent4->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}							
	}			

	if ($import_file_name == 'RePick'){
		$firstparent = get_page_by_title( 'Examples of posts', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'131', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($firstparent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $firstparent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
	}	

	if ($import_file_name == 'ReCompare'){
		$parent = get_page_by_title( 'Best conversion pages', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'566', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($parent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $parent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentsec = get_page_by_title( '🔥 Unique Functions', OBJECT, 'nav_menu_item');
		$menussec = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'539', 'post_type'=> 'nav_menu_item'));
		if(!empty($menussec) && !empty($parentsec)){
			foreach ($menussec as $menusec) {
				update_post_meta($menusec->ID, '_menu_item_menu_item_parent', $parentsec->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent3 = get_page_by_title( 'Simple Product Layouts', OBJECT, 'nav_menu_item');
		$menus3 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'541', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus3) && !empty($parent3)){
			foreach ($menus3 as $menu3) {
				update_post_meta($menu3->ID, '_menu_item_menu_item_parent', $parent3->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent4 = get_page_by_title( 'Advanced Product Layout', OBJECT, 'nav_menu_item');
		$menus4 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'546', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus4) && !empty($parent4)){
			foreach ($menus4 as $menu4) {
				update_post_meta($menu4->ID, '_menu_item_menu_item_parent', $parent4->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}						
	}

	if ($import_file_name == 'ReTour'){
		$parent = get_page_by_title( 'Layout Variants', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'201', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($parent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $parent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentsec = get_page_by_title( 'System Pages', OBJECT, 'nav_menu_item');
		$menussec = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'366', 'post_type'=> 'nav_menu_item'));
		if(!empty($menussec) && !empty($parentsec)){
			foreach ($menussec as $menusec) {
				update_post_meta($menusec->ID, '_menu_item_menu_item_parent', $parentsec->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent3 = get_page_by_title( 'Inner Product', OBJECT, 'nav_menu_item');
		$menus3 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'202', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus3) && !empty($parent3)){
			foreach ($menus3 as $menu3) {
				update_post_meta($menu3->ID, '_menu_item_menu_item_parent', $parent3->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent4 = get_page_by_title( 'Inner Blog', OBJECT, 'nav_menu_item');
		$menus4 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'203', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus4) && !empty($parent4)){
			foreach ($menus4 as $menu4) {
				update_post_meta($menu4->ID, '_menu_item_menu_item_parent', $parent4->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}	
		$parent5 = get_page_by_title( 'Archive pages', OBJECT, 'nav_menu_item');
		$menus5 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'204', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus5) && !empty($parent5)){
			foreach ($menus5 as $menu5) {
				update_post_meta($menu5->ID, '_menu_item_menu_item_parent', $parent5->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}									
	}	

	if ($import_file_name == 'ReMag'){
		$parent = get_page_by_title( 'Page layouts', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'4008', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($parent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $parent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentsec = get_page_by_title( 'Basic Post layouts', OBJECT, 'nav_menu_item');
		$menussec = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'4009', 'post_type'=> 'nav_menu_item'));
		if(!empty($menussec) && !empty($parentsec)){
			foreach ($menussec as $menusec) {
				update_post_meta($menusec->ID, '_menu_item_menu_item_parent', $parentsec->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent3 = get_page_by_title( 'Deal Post layouts', OBJECT, 'nav_menu_item');
		$menus3 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'4018', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus3) && !empty($parent3)){
			foreach ($menus3 as $menu3) {
				update_post_meta($menu3->ID, '_menu_item_menu_item_parent', $parent3->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent4 = get_page_by_title( 'Extended layouts', OBJECT, 'nav_menu_item');
		$menus4 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'4022', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus4) && !empty($parent4)){
			foreach ($menus4 as $menu4) {
				update_post_meta($menu4->ID, '_menu_item_menu_item_parent', $parent4->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}	
		$parent5 = get_page_by_title( 'Unique pages', OBJECT, 'nav_menu_item');
		$menus5 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'4027', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus5) && !empty($parent5)){
			foreach ($menus5 as $menu5) {
				update_post_meta($menu5->ID, '_menu_item_menu_item_parent', $parent5->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}														
	}	

	if ($import_file_name == 'ReDirect'){
		$parent = get_page_by_title( 'Listing examples', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'257', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($parent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $parent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentsec = get_page_by_title( 'Home pages', OBJECT, 'nav_menu_item');
		$menussec = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'1307', 'post_type'=> 'nav_menu_item'));
		if(!empty($menussec) && !empty($parentsec)){
			foreach ($menussec as $menusec) {
				update_post_meta($menusec->ID, '_menu_item_menu_item_parent', $parentsec->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentthird = get_page_by_title( 'Listings', OBJECT, 'nav_menu_item');
		$menusthird = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'1308', 'post_type'=> 'nav_menu_item'));
		if(!empty($menusthird) && !empty($parentthird)){
			foreach ($menusthird as $menuthird) {
				update_post_meta($menuthird->ID, '_menu_item_menu_item_parent', $parentthird->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentfour = get_page_by_title( 'Inner Page Layouts', OBJECT, 'nav_menu_item');
		$menusfour = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'438', 'post_type'=> 'nav_menu_item'));
		if(!empty($menusfour) && !empty($parentfour)){
			foreach ($menusfour as $menufour) {
				update_post_meta($menufour->ID, '_menu_item_menu_item_parent', $parentfour->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentfive = get_page_by_title( 'Main Layouts', OBJECT, 'nav_menu_item');
		$menusfive = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'1296', 'post_type'=> 'nav_menu_item'));
		if(!empty($menusfive) && !empty($parentfive)){
			foreach ($menusfive as $menufive) {
				update_post_meta($menufive->ID, '_menu_item_menu_item_parent', $parentfive->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentsix = get_page_by_title( 'With custom elements', OBJECT, 'nav_menu_item');
		$menussix = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'1297', 'post_type'=> 'nav_menu_item'));
		if(!empty($menussix) && !empty($parentsix)){
			foreach ($menussix as $menusix) {
				update_post_meta($menusix->ID, '_menu_item_menu_item_parent', $parentsix->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}											
	}

	if ($import_file_name == 'ReThing'){
		$parent = get_page_by_title( 'Post formats', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'250', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($parent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $parent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentsec = get_page_by_title( 'Custom pages', OBJECT, 'nav_menu_item');
		$menussec = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'270', 'post_type'=> 'nav_menu_item'));
		if(!empty($menussec) && !empty($parentsec)){
			foreach ($menussec as $menusec) {
				update_post_meta($menusec->ID, '_menu_item_menu_item_parent', $parentsec->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}			
	}

	if ($import_file_name == 'ReCart'){
		$parent = get_page_by_title( 'Browse Categories', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'487', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($parent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $parent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentsec = get_page_by_title( 'Woocommerce Layouts', OBJECT, 'nav_menu_item');
		$menussec = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'489', 'post_type'=> 'nav_menu_item'));
		if(!empty($menussec) && !empty($parentsec)){
			foreach ($menussec as $menusec) {
				update_post_meta($menusec->ID, '_menu_item_menu_item_parent', $parentsec->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent3 = get_page_by_title( 'Post & Review Layouts', OBJECT, 'nav_menu_item');
		$menus3 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'1019', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus3) && !empty($parent3)){
			foreach ($menus3 as $menu3) {
				update_post_meta($menu3->ID, '_menu_item_menu_item_parent', $parent3->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent4 = get_page_by_title( 'Promo pages', OBJECT, 'nav_menu_item');
		$menus4 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'490', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus4) && !empty($parent4)){
			foreach ($menus4 as $menu4) {
				update_post_meta($menu4->ID, '_menu_item_menu_item_parent', $parent4->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}	
		$parent5 = get_page_by_title( 'Audio gadgets', OBJECT, 'nav_menu_item');
		$menus5 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'962', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus5) && !empty($parent5)){
			foreach ($menus5 as $menu5) {
				update_post_meta($menu5->ID, '_menu_item_menu_item_parent', $parent5->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent6 = get_page_by_title( 'Television and Systems', OBJECT, 'nav_menu_item');
		$menus6 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'963', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus6) && !empty($parent6)){
			foreach ($menus6 as $menu6) {
				update_post_meta($menu6->ID, '_menu_item_menu_item_parent', $parent6->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}										
	}	

	if ($import_file_name == 'ReDokanNew' || $import_file_name == 'ReMarket'){
		$parent = get_page_by_title( 'Browse Categories', OBJECT, 'nav_menu_item');
		$menus = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'487', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus) && !empty($parent)){
			foreach ($menus as $menu) {
				update_post_meta($menu->ID, '_menu_item_menu_item_parent', $parent->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parentsec = get_page_by_title( 'Woocommerce Layouts', OBJECT, 'nav_menu_item');
		$menussec = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'489', 'post_type'=> 'nav_menu_item'));
		if(!empty($menussec) && !empty($parentsec)){
			foreach ($menussec as $menusec) {
				update_post_meta($menusec->ID, '_menu_item_menu_item_parent', $parentsec->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent3 = get_page_by_title( 'Post & Review Layouts', OBJECT, 'nav_menu_item');
		$menus3 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'1019', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus3) && !empty($parent3)){
			foreach ($menus3 as $menu3) {
				update_post_meta($menu3->ID, '_menu_item_menu_item_parent', $parent3->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent4 = get_page_by_title( 'Promo pages', OBJECT, 'nav_menu_item');
		$menus4 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'490', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus4) && !empty($parent4)){
			foreach ($menus4 as $menu4) {
				update_post_meta($menu4->ID, '_menu_item_menu_item_parent', $parent4->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}	
		$parent5 = get_page_by_title( 'Audio gadgets', OBJECT, 'nav_menu_item');
		$menus5 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'962', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus5) && !empty($parent5)){
			foreach ($menus5 as $menu5) {
				update_post_meta($menu5->ID, '_menu_item_menu_item_parent', $parent5->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent6 = get_page_by_title( 'Television and Systems', OBJECT, 'nav_menu_item');
		$menus6 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'963', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus6) && !empty($parent6)){
			foreach ($menus6 as $menu6) {
				update_post_meta($menu6->ID, '_menu_item_menu_item_parent', $parent6->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}	
		$parent8 = get_page_by_title( 'Currency', OBJECT, 'nav_menu_item');
		$menus8 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'495', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus8) && !empty($parent8)){
			foreach ($menus8 as $menu8) {
				update_post_meta($menu8->ID, '_menu_item_menu_item_parent', $parent8->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}
		$parent9 = get_page_by_title( 'Language', OBJECT, 'nav_menu_item');
		$menus9 = get_posts(array('meta_key'=>'_menu_item_menu_item_parent', 'meta_value'=>'498', 'post_type'=> 'nav_menu_item'));
		if(!empty($menus9) && !empty($parent9)){
			foreach ($menus9 as $menu9) {
				update_post_meta($menu9->ID, '_menu_item_menu_item_parent', $parent9->ID);
			}
			echo 'Menu hierarchy was fixed-------';
		}																
	}			

	
    if( $front_page ){
		$front_page_id = (int) $front_page->ID;
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id );
		echo 'HomePage was assigned-------';
	}
   
	if( $blog_page ){
		$blog_page_id = (int) $blog_page->ID;
		update_option( 'page_for_posts', $blog_page_id );
		echo 'Blog page was assigned-------';
	}

	if(!empty($sliders) && function_exists( 'download_url' ) && function_exists('media_handle_sideload') && class_exists( 'RevSlider' )){
        foreach( $sliders as $slider_url ) {
            $temp = download_url( $slider_url );
            $file_array = array(
                'name'     => basename( $slider_url ),
                'tmp_name' => $temp
            );
            if ( is_wp_error( $temp ) ) {
				echo 'Slider has error-------';
                unlink( $file_array[ 'tmp_name' ] );
                continue;
            }

            $id = media_handle_sideload( $file_array, 0 );
            if ( is_wp_error( $id ) ) {
				echo 'Slider has error-------';
                unlink( $file_array['tmp_name'] );
                continue;
            }

            $attachment_url = get_attached_file( $id );
            $slider = new RevSlider();
            $slider->importSliderFromPost( true, true, $attachment_url );
            echo 'Slider was imported-------';
        }		
	}

	if(!empty($userarray)){
		foreach ($userarray as $userset) {

			if( null == username_exists( $userset['email'] ) ) {
				$password = wp_generate_password( 12, false );
				$user_id = wp_create_user( $userset['email'], $password, $userset['email'] );
				wp_update_user(
					array(
					  	'ID'          =>    $user_id,
					  	'nickname'    =>    $userset['name'],
					  	'first_name'  =>	$userset['name'],
					)
				);
				$user = new WP_User( $user_id );
				$user->set_role( $userset['role'] );
				echo 'User '.$user_id.' was created-------';

				if(!empty($userset['location']) && function_exists('gmw_update_user_location') && class_exists('GMW_Members_locator_Addon')){
					gmw_update_user_location( $user_id, $userset['location'], true );
					echo 'User '.$user_id.' has location now-------';
				}
				if(!empty($userset['meta'])){
					foreach ($userset['meta'] as $key => $value) {
						update_user_meta( $user_id, $key, $value);
						echo 'User '.$user_id.' has meta now for '.$key.'-------';
					}
				}
				if(!empty($userset['posts'])){
					$number = $userset['posts'];
					$changedposts = get_posts(array('numberposts' => $number, 'post_type' => 'post'));
					if(!empty($changedposts)){
						foreach ($changedposts as $changedpost) {
							$arg = array(
							    'ID' => $changedpost->ID,
							    'post_author' => $user_id,
							);
							wp_update_post( $arg );	
						}
						echo 'User '.$user_id.' has posts now-------';						
					}				
				}				
				if(!empty($userset['products'])){
					$number = $userset['products'];
					$changedproducts = get_posts(array('numberposts' => $number, 'post_type' => 'product'));
					if(!empty($changedproducts)){
						foreach ($changedproducts as $changedproduct) {
							$arg = array(
							    'ID' => $changedproduct->ID,
							    'post_author' => $user_id,
							);
							wp_update_post( $arg );	
						}
						echo 'User '.$user_id.' has products now-------';	
					}				
				}
			} 
		}
	}
	
}