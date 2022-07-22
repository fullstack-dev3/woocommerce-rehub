<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

//////////////////////////////////////////////////////////////////
// Fallbacks
//////////////////////////////////////////////////////////////////
if(!function_exists('rehub_option')){
	function rehub_option( $key ) {
	    if( is_customize_preview() ) {
	    	$fontarray = array('rehub_nav_font', 'rehub_nav_font_style', 'rehub_nav_font_weight', 'rehub_nav_font_subset', 'rehub_headings_font', 'rehub_headings_font_style', 'rehub_headings_font_weight', 'rehub_headings_font_subset', 'rehub_headings_font_upper', 'rehub_body_font', 'rehub_body_font_style', 'rehub_body_font_weight', 'rehub_body_font_subset', 'body_font_size');
	    	if(in_array( $key, $fontarray)){
				$options = get_option( 'rehub_option' );
				$value = (!empty($options[$key])) ? $options[$key] : '';	    		
	    	}else{
	    		$value = get_theme_mod( $key );
	    	}

		} 
		else {
			if( class_exists( 'REHub_Framework' ) ){
				$localizationarray = array('rehub_logo', 'header_six_btn_txt', 'header_six_btn_url', 'header_seven_login_label', 'header_seven_compare_btn_label', 'header_seven_wishlist_label', 'rehub_text_logo', 'rehub_text_slogan', 'rehub_newstick_label', 'rehub_footer_text', 'rehub_homecarousel_label_text', 'rehub_btn_text', 'rehub_btn_text_aff_links', 'rehub_mask_text', 'rehub_review_text', 'rehub_readmore_text', 'rehub_search_text', 'rehub_btn_text_best', 'rehub_choosedeal_text', 'rehub_related_text', 'rehub_commenttitle_text', 'ce_custom_currency', 'buy_best_text', 'amp_custom_in_header', 'rh_bp_user_post_name', 'rh_bp_user_product_name', 'rh_bp_custom_message_profile', 'badge_label_1', 'badge_label_2', 'badge_label_3', 'badge_label_4', 'header_seven_more_element', 'rehub_user_rev_criterias', 'compare_multicats_textarea', 'compare_page', 'rehub_single_before_post', 'rehub_single_code');
				if ((defined( 'POLYLANG_BASENAME' ) || defined( 'WPML_PLUGIN_BASENAME' )) && in_array( $key, $localizationarray) ){
					$options = get_option( 'rehub_option' );
					$value = (!empty($options[$key])) ? $options[$key] : '';
				}else{
					$value = REHub_Framework::get_option( $key );					
				}

			}
			else {
				$value = get_theme_mod( $key );
			}
		}
		return $value;
	}
}
if( !class_exists( 'REHub_Framework' ) ){
	function vp_metabox(){
		return;
	}
}

//////////////////////////////////////////////////////////////////
// Constants
//////////////////////////////////////////////////////////////////
if ( ! defined( 'REHUB_ADMIN_DIR' ) ) {
	define( 'REHUB_ADMIN_DIR', get_template_directory_uri() . '/admin/' );
}
if(!defined('PLUGIN_REPO')){
	define('PLUGIN_REPO', 'http://wpsoul.net/plugins/');
}

//Set default colors
if (REHUB_NAME_ACTIVE_THEME == 'REDOKAN') {
	define( 'REHUB_MAIN_COLOR', '#54ae3f');
	define( 'REHUB_SECONDARY_COLOR', '#000000');
	define( 'REHUB_BUTTON_COLOR', '#ff4e0c');
	define( 'REHUB_BUTTON_COLOR_TEXT', '#ffffff');
	define( 'REHUB_DEFAULT_LAYOUT', 'communitylist');
	define( 'REHUB_BOX_DISABLE', '1');
}
elseif (REHUB_NAME_ACTIVE_THEME == 'REVENDOR') {
	define( 'REHUB_MAIN_COLOR', '#22bdb1');
	define( 'REHUB_SECONDARY_COLOR', '#ff4e0c');
	define( 'REHUB_BUTTON_COLOR', '#ff4e0c');
	define( 'REHUB_BUTTON_COLOR_TEXT', '#ffffff');				
	define( 'REHUB_DEFAULT_LAYOUT', 'communitylist');
	define( 'REHUB_BOX_DISABLE', '1');
}
elseif (REHUB_NAME_ACTIVE_THEME == 'RECASH') {
	define( 'REHUB_MAIN_COLOR', '#fa9e19');
	define( 'REHUB_SECONDARY_COLOR', '#000000');
	define( 'REHUB_BUTTON_COLOR', '#2caa17');
	define( 'REHUB_DEFAULT_LAYOUT', 'dealgrid');
	define( 'REHUB_BOX_DISABLE', '0');
	define( 'REHUB_BUTTON_COLOR_TEXT', '#ffffff');				
}elseif (REHUB_NAME_ACTIVE_THEME == 'REPICK') {
	define( 'REHUB_MAIN_COLOR', '#D7541A');
	define( 'REHUB_SECONDARY_COLOR', '#44aeff');
	define( 'REHUB_BUTTON_COLOR', '#D7541A');
	define( 'REHUB_DEFAULT_LAYOUT', 'gridfull');
	define( 'REHUB_BOX_DISABLE', '0');
	define( 'REHUB_BUTTON_COLOR_TEXT', '#ffffff');				
}elseif (REHUB_NAME_ACTIVE_THEME == 'RETHING') {
	define( 'REHUB_MAIN_COLOR', '#B07C01');
	define( 'REHUB_SECONDARY_COLOR', '#B07C01');
	define( 'REHUB_BUTTON_COLOR', '#B07C01');
	define( 'REHUB_DEFAULT_LAYOUT', 'gridfull');
	define( 'REHUB_BOX_DISABLE', '0');
	define( 'REHUB_BUTTON_COLOR_TEXT', '#ffffff');				
}elseif (REHUB_NAME_ACTIVE_THEME == 'REWISE') {
	define( 'REHUB_MAIN_COLOR', '#ff823a');
	define( 'REHUB_SECONDARY_COLOR', '#111111');
	define( 'REHUB_BUTTON_COLOR', '#43c801');
	define( 'REHUB_DEFAULT_LAYOUT', 'communitylist');
	define( 'REHUB_BOX_DISABLE', '1');
	define( 'REHUB_BUTTON_COLOR_TEXT', '#ffffff');				
}elseif (REHUB_NAME_ACTIVE_THEME == 'REDIRECT') {
	define( 'REHUB_MAIN_COLOR', '#ff8a00');
	define( 'REHUB_SECONDARY_COLOR', '#111111');
	define( 'REHUB_BUTTON_COLOR', '#ff8a00');
	define( 'REHUB_DEFAULT_LAYOUT', 'communitylist');
	define( 'REHUB_BOX_DISABLE', '1');
	define( 'REHUB_BUTTON_COLOR_TEXT', '#ffffff');				
}elseif (REHUB_NAME_ACTIVE_THEME == 'RECART') {
	define( 'REHUB_MAIN_COLOR', '#7000f4');
	define( 'REHUB_SECONDARY_COLOR', '#111111');
	define( 'REHUB_BUTTON_COLOR', '#de1414');
	define( 'REHUB_DEFAULT_LAYOUT', 'communitylist');
	define( 'REHUB_BOX_DISABLE', '1');
	define( 'REHUB_BUTTON_COLOR_TEXT', '#ffffff');				
}else{
	define( 'REHUB_MAIN_COLOR', '#8035be');
	define( 'REHUB_SECONDARY_COLOR', '#000000');
	define( 'REHUB_BUTTON_COLOR', '#de1414');
	define( 'REHUB_DEFAULT_LAYOUT', 'communitylist');
	define( 'REHUB_BOX_DISABLE', '0');
	define( 'REHUB_BUTTON_COLOR_TEXT', '#ffffff');				
}

//////////////////////////////////////////////////////////////////
// Demo import
//////////////////////////////////////////////////////////////////
require_once( 'demo/import-demo.php' );


//////////////////////////////////////////////////////////////////
// Admin class
//////////////////////////////////////////////////////////////////
if ( ! class_exists( 'Rehub_Admin' ) ) {

	class Rehub_Admin{

		function __construct(){

			add_action( 'admin_init', array( $this, 'rehub_admin_init' ) );
			add_action( 'admin_menu', array( $this, 'rehub_admin_menu' ) );
			add_action( 'admin_head', array( $this, 'rehub_admin_scripts' ) );
			add_action( 'admin_menu', array( $this, 'edit_admin_menus' ) );
			add_action( 'after_switch_theme', array( $this, 'rehub_activation_redirect' ) );
			add_action( 'wp_ajax_rehub_update_registration', array( $this, 'rehub_update_registration' ) );
			add_action( 'admin_notices', array( $this, 'rehub_framework_required' ) );			
		}

		/**
		 * Add the top-level menu item to the adminbar.
		 */
		function rehub_add_wp_toolbar_menu_item( $title, $parent = FALSE, $href = '', $custom_meta = array(), $custom_id = '' ) {

			global $wp_admin_bar;

			if ( current_user_can( 'edit_theme_options' ) ) {
				if ( ! is_super_admin() || ! is_admin_bar_showing() ) {
					return;
				}

				// Set custom ID
				if ( $custom_id ) {
					$id = $custom_id;
				// Generate ID based on $title
				} else {
					$id = strtolower( str_replace( ' ', '-', $title ) );
				}

				// links from the current host will open in the current window
				$meta = strpos( $href, site_url() ) !== false ? array() : array( 'target' => '_blank' ); // external links open in new tab/window
				$meta = array_merge( $meta, $custom_meta );

				$wp_admin_bar->add_node( array(
					'parent' => $parent,
					'id'     => $id,
					'title'  => $title,
					'href'   => $href,
					'meta'   => $meta,
				) );
			}

		}

		function rehub_framework_required() {
			if( !class_exists( 'REHub_Framework' ) ){
				?>
			    <div class="error" style="display:block !important"><p><?php esc_html_e( 'Rehub theme requires Rehub framework plugin to be installed. Please install and activate it', 'rehub-theme'); ?> <a href="<?php echo admin_url( 'admin.php?page=rehub-plugins' );?>"><?php esc_html_e( 'on this page', 'rehub-theme'); ?></a>
			    	</p></div>
			    <?php
			}
		}		

		/**
		 * Modify the menu
		 */
		function edit_admin_menus() {
			global $submenu;

			if ( current_user_can( 'edit_theme_options' ) ) {
				$submenu['rehub'][0][0] = 'Registration'; // Change Rehub to Product Registration
			}
		}

		/**
		 * Redirect to admin page on theme activation
		 */
		function rehub_activation_redirect() {
		    $elementor_disable_typography_schemes = get_option('elementor_disable_typography_schemes');
		    if (empty($elementor_disable_typography_schemes)) {
		        update_option('elementor_disable_typography_schemes', 'yes');
		    }
	        $elementor_disable_color_schemes = get_option('elementor_disable_color_schemes');
	        if (empty($elementor_disable_color_schemes)) {
	            update_option('elementor_disable_color_schemes', 'yes');
	        }
	        if(function_exists('wc_get_page_id')){
	        	$myaccountid = wc_get_page_id('myaccount');
	        	if($myaccountid > 0){
	        		$myaccounttemplate = get_post_meta($myaccountid, '_wp_page_template', true);
	        		$contenttype = get_post_meta($myaccountid, 'content_type', true);
				    if ( ! $myaccounttemplate || 'default' == $myaccounttemplate ) {
				    	if(!$contenttype || $contenttype == 'def'){
				    		update_post_meta($myaccountid, '_wp_page_template', 'template-systempages.php');
				    	}
				    }	        		
	        	}
	        	$cartid = wc_get_page_id('cart');
	        	if($cartid > 0){
	        		$carttemplate = get_post_meta($cartid, '_wp_page_template', true);
	        		$contenttype = get_post_meta($cartid, 'content_type', true);
				    if ( ! $carttemplate || 'default' == $carttemplate ) {
				    	if(!$contenttype || $contenttype == 'def'){
				        	update_post_meta($cartid, '_wp_page_template', 'template-systempages.php');
				    	}
				    }	        		
	        	}
	        	$checkoutid = wc_get_page_id('checkout');
	        	if($checkoutid > 0){
	        		$checkouttemplate = get_post_meta($checkoutid, '_wp_page_template', true);
	        		$contenttype = get_post_meta($checkoutid, 'content_type', true);
				    if ( ! $checkouttemplate || 'default' == $checkouttemplate ) {
				    	if(!$contenttype || $contenttype == 'def'){
				        	update_post_meta($checkoutid, '_wp_page_template', 'template-systempages.php');
				    	}
				    }	        		
	        	}	        		        	
	        }	    
			if ( current_user_can( 'edit_theme_options' ) ) {
				header( 'Location:' . admin_url() . 'admin.php?page=rehub' );
			}
		}

		/**
		 * Actions to run on initial theme activation
		 */
		function rehub_admin_init() {			

			if ( current_user_can( 'edit_theme_options' ) ) {

				if ( isset( $_GET['rehub-deactivate'] ) && $_GET['rehub-deactivate'] == 'deactivate-plugin' ) {
					check_admin_referer( 'rehub-deactivate', 'rehub-deactivate-nonce' );

					$plugins = TGM_Plugin_Activation::$instance->plugins;

					foreach( $plugins as $plugin ) {
						if ( $plugin['slug'] == $_GET['plugin'] ) {
							deactivate_plugins( $plugin['file_path'] );
						}
					}
				} if ( isset( $_GET['rehub-activate'] ) && $_GET['rehub-activate'] == 'activate-plugin' ) {
					check_admin_referer( 'rehub-activate', 'rehub-activate-nonce' );

					$plugins = TGM_Plugin_Activation::$instance->plugins;

					foreach( $plugins as $plugin ) {
						if ( $plugin['slug'] == $_GET['plugin'] ) {
							activate_plugin( $plugin['file_path'] );

							wp_redirect( admin_url( 'admin.php?page=rehub-plugins' ) );
							exit;
						}
					}
				}

		        if (REHUB_NAME_ACTIVE_THEME == 'RECASH') {
		            if(!defined('THEMESHILD_SLUG')){
						define('THEMESHILD_SLUG', 'recash');
					} 
					require_once ( locate_template( 'admin/update-checker.php' ) );					
		        }
		        elseif (REHUB_NAME_ACTIVE_THEME == 'REPICK') {
		            if(!defined('THEMESHILD_SLUG')){
						define('THEMESHILD_SLUG', 'repick');
					} 
					require_once ( locate_template( 'admin/update-checker.php' ) );					
		        }
		        elseif (REHUB_NAME_ACTIVE_THEME == 'RETHING') {
		            if(!defined('THEMESHILD_SLUG')){
						define('THEMESHILD_SLUG', 'rething');
					}
					require_once ( locate_template( 'admin/update-checker.php' ) );					
		        }
		        elseif (REHUB_NAME_ACTIVE_THEME == 'REVENDOR') {
		            if(!defined('THEMESHILD_SLUG')){
						define('THEMESHILD_SLUG', 'revendor');
					} 
					require_once ( locate_template( 'admin/update-checker.php' ) );					
		        }  
		        elseif (REHUB_NAME_ACTIVE_THEME == 'REDOKAN') {
		            if(!defined('THEMESHILD_SLUG')){
						define('THEMESHILD_SLUG', 'redokan');
					} 
					require_once ( locate_template( 'admin/update-checker.php' ) );					
		        } 		         
		        elseif (REHUB_NAME_ACTIVE_THEME == 'REDIRECT') {
		            if(!defined('THEMESHILD_SLUG')){
						define('THEMESHILD_SLUG', 'redirect');
					} 
					require_once ( locate_template( 'admin/update-checker.php' ) );					
		        }           
		        elseif (REHUB_NAME_ACTIVE_THEME == 'REWISE') {
		            if(!defined('THEMESHILD_SLUG')){
						define('THEMESHILD_SLUG', 'rewise');
					}
					require_once ( locate_template( 'admin/update-checker.php' ) );					 
		        }

			}
		}

		function rehub_admin_menu(){

			if ( current_user_can( 'edit_theme_options' ) ) {
				// Work around for theme check
				//$rehub_menu_page_creation_method    = 'add_menu_page';
				//$rehub_submenu_page_creation_method = 'add_submenu_page';

				$welcome_screen = add_menu_page( 'ReHub', 'ReHub', 'administrator', 'rehub', array( $this, 'rehub_welcome_screen' ), 'dashicons-rehub-logo', 3 );
				$support = add_submenu_page( 'rehub', esc_html__( 'ReHub Theme Support', 'rehub-theme' ), esc_html__( 'Support and tips', 'rehub-theme' ), 'administrator', 'rehub-support', array( $this, 'rehub_support_tab' ) );
				$plugins = add_submenu_page( 'rehub', esc_html__( 'Plugins', 'rehub-theme' ), esc_html__( 'Plugins', 'rehub-theme' ), 'administrator', 'rehub-plugins', array( $this, 'rehub_plugins_tab' ) );
				//$required_plugins = add_submenu_page( 'rehub', esc_html__( 'Required plugins', 'rehub-theme' ), esc_html__( 'Required plugins', 'rehub-theme' ), 'administrator', 'rehub-install-plugins', array( $this, 'rehub_plugins_sub' ) );
				$demo_content = add_submenu_page( 'rehub', esc_html__( 'Demo content', 'rehub-theme' ), esc_html__( 'Demo Import', 'rehub-theme' ), 'administrator', 'import_demo', array( $this, 'demo_content_sub' ));
				$demos = add_submenu_page( 'rehub', esc_html__( 'Alternative Import', 'rehub-theme' ), esc_html__( 'Alternative Import', 'rehub-theme' ), 'administrator', 'rehub-demos', array( $this, 'rehub_demos_tab' ) );	
				if ( class_exists( 'REHub_Framework' ) ) {			
					$theme_options  = add_submenu_page( 'rehub', esc_html__( 'Theme Options', 'rehub-theme' ), esc_html__( 'Theme Options', 'rehub-theme' ), 'administrator', 'vpt_option');
				}

				add_action( 'admin_print_scripts-'.$welcome_screen, array( $this, 'welcome_screen_scripts' ) );
				add_action( 'admin_print_scripts-'.$support, array( $this, 'support_screen_scripts' ) );
				add_action( 'admin_print_scripts-'.$demos, array( $this, 'demos_screen_scripts' ) );
				add_action( 'admin_print_scripts-'.$plugins, array( $this, 'plugins_screen_scripts' ) );
			}
		}

		function rehub_welcome_screen() {
			require_once( 'screens/welcome.php' );
		}

		function rehub_support_tab() {
			require_once( 'screens/support.php' );
		}

		function rehub_demos_tab() {
			require_once( 'screens/democlones.php' );
		}

		function rehub_plugins_tab() {
			require_once( 'screens/plugins.php' );
		}
		
		function demo_content_sub(){
			if ( !rh_check_plugin_active( 'one-click-demo-import/one-click-demo-import.php' ) ) { ?>
			<h2></h2>
		   <div class="notice notice-info"><p><?php esc_html_e('Please, install and activate One Click Demo Import plugin', 'rehub-theme');?> <a href="<?php echo admin_url( 'admin.php?page=rehub-plugins' );?>"><?php esc_html_e('on page', 'rehub-theme');?></a></p></div>
			<?php
			} 
		}
		
		function rehub_plugins_sub(){
			
		}

		function rehub_update_registration() {
			check_ajax_referer( 'ajax-tfreg-nonce', 'register-security' );
			global $wp_version;

			$rehub_options    = get_option( 'Rehub_Key' );
			$data             = $_POST;
			$tf_username      = isset( $data['tf_username'] ) ? sanitize_text_field($data['tf_username']) : '';
			$tf_purchase_code = isset( $data['tf_purchase_code'] ) ? sanitize_text_field($data['tf_purchase_code']) : '';

			if ( '' !== $tf_username && '' !== $tf_purchase_code ) {

				$rehub_options['tf_username'] = $tf_username;
				$tf_purchase_code = strtolower(preg_replace('#([a-z0-9]{8})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{12})#','$1-$2-$3-$4-$5',$tf_purchase_code));
				$rehub_options['tf_purchase_code'] = $tf_purchase_code;

				$prepare_request = array(
					'user-agent' => 'WordPress/'. $wp_version .'; '. home_url(),
					'sslverify'    => false,
					'timeout'     => 10,
					'headers' => array(
						'Authorization' => 'Bearer saqMlpb8QSyFGYNjNxgmWzdwqkTUMbFl',
					)
				);

				$raw_response = wp_remote_get( 'https://api.envato.com/v3/market/author/sale?code=' . $tf_purchase_code, $prepare_request );

				if ( ! is_wp_error( $raw_response ) ) {
					$response = wp_remote_retrieve_body( $raw_response );
					$response = json_decode( $response, true );
				}

				if ( ! empty( $response ) ) {
					if ( ( isset( $response['error'] ) ) || ( isset( $response['buyer'] ) && empty( $response['buyer'] ) ) ) {
						echo 'Error';
					} elseif ( isset( $response['buyer'] ) && ! empty( $response['buyer'] ) ) {
						if ($response['buyer'] == $tf_username) {
							if (!empty ($response['supported_until'])) {
								$rehub_options['tf_support_date'] = $response['supported_until'];
							}
							$result = update_option( 'Rehub_Key', $rehub_options );
							echo 'Updated';							
						}
						else {
							echo 'Errorbuyer';
						}
					}
				} else {
					echo 'Error';
				}
			} else {
				echo 'Empty';
			}
			wp_die();
		}

		function rehub_admin_scripts() {
			if ( is_admin() ) {

			?>
			<?php 
				if (rehub_option('rehub_custom_color')) {
					$maincolor = rehub_option('rehub_custom_color');
				} 
				else {
					if (REHUB_NAME_ACTIVE_THEME == 'REPICK') {
						$maincolor = '#D7541A';	
					}
					elseif (REHUB_NAME_ACTIVE_THEME == 'RETHING') {
						$maincolor = '#B07C01';	
					}
					elseif (REHUB_NAME_ACTIVE_THEME == 'REVENDOR') {
						$maincolor = '#17baae';	
					}
					elseif (REHUB_NAME_ACTIVE_THEME == 'REDOKAN') {
						$maincolor = '#54ae3f';	
					}	
					elseif (REHUB_NAME_ACTIVE_THEME == 'RECART') {
						$maincolor = '#7000f4';	
					}												
					else{
						$maincolor = '#43c801';			
					}
				}
			?>			
			<style type="text/css">
			<?php if(rehub_option('rehub_headings_font')) : ?>
				.editor-post-title__block .editor-post-title__input, .wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3, .wp-block-heading h4, .wp-block-heading h5, .wp-block-heading h6, .wp-block-quote.is-style-large, .wp-block-button .wp-block-button__link{
					font-family:"<?php echo rehub_option('rehub_headings_font'); ?>", trebuchet ms !important;
					font-weight:<?php echo rehub_option('rehub_headings_font_weight'); ?> !important;
					font-style:<?php echo rehub_option('rehub_headings_font_style'); ?> !important;
					<?php if(rehub_option('rehub_headings_font_upper') =='1') : ?>text-transform:uppercase !important;<?php endif; ?>			
				}
			<?php elseif(REHUB_NAME_ACTIVE_THEME == 'RECART') : ?>
				.editor-post-title__block .editor-post-title__input, .wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3, .wp-block-heading h4, .wp-block-heading h5, .wp-block-heading h6, .wp-block-quote.is-style-large, .wp-block-button .wp-block-button__link{
					font-family:"Poppins", trebuchet ms !important;
					font-weight:700 !important;
					font-style: normal !important;
					<?php if(rehub_option('rehub_headings_font_upper') =='1') : ?>text-transform:uppercase !important;<?php endif; ?>			
				}				
			<?php endif;?>
			<?php if(rehub_option('rehub_body_font')) : ?>
				.editor-styles-wrapper {
					font-family:"<?php echo rehub_option('rehub_body_font'); ?>", arial !important;
					font-weight:<?php echo rehub_option('rehub_body_font_weight'); ?>!important;
					font-style:<?php echo rehub_option('rehub_body_font_style'); ?> !important;			
				}
			<?php else:?>
				.editor-styles-wrapper{font-family: 'Arial', trebuchet ms !important}
			<?php endif; ?>				
			.wp-block-quote:not(.is-large):not(.is-style-large), .wp-block-pullquote{border-color: <?php echo ''.$maincolor; ?>;}
			.wp-block-pullquote cite, .wp-block-pullquote footer, .wp-block-pullquote__citation{color: #111 !important}	
			.wp-block-freeform.block-library-rich-text__tinymce a, .wp-block-quote.is-style-large p, article a, .wp-block-pullquote{color: <?php echo ''.$maincolor; ?> !important; text-decoration: none !important;}
			.rh-admin-note{background: lightblue; padding: 15px;margin: 15px 0;border-radius: 5px;border: 1px solid #65b2c7; font-size: 15px}
			@media (min-width:600px){.editor-post-title__block:not(.is-focus-mode).is-selected .editor-post-title__input{box-shadow:-3px 0 0 0 <?php echo ''.$maincolor; ?>}}
			@media screen and (max-width: 782px) {
				#wp-toolbar > ul > .rehub-menu {
					display: block;
				}

				#wpadminbar .rehub-menu > .ab-item .ab-icon {
					padding-top: 6px !important;
					height: 40px !important;
					font-size: 30px !important;
				}
			}
			#wpadminbar .rehub-menu > .ab-item .ab-icon:before,
            .dashicons-rehub-logo:before{
                content: "\f115";
                speak: none;
                font-style: normal;
                font-weight: normal;
                font-variant: normal;
                text-transform: none;
                line-height: 1;

                /* Better Font Rendering =========== */
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
            .mce-i-footer-columns{background: url(<?php echo get_template_directory_uri();?>/shortcodes/tinyMCE/images/column.png) #eee !important;}
            .mce-i-footer-contact{background: url(<?php echo get_template_directory_uri();?>/shortcodes/tinyMCE/images/bullhorn.png) #eee !important;}  
            .prdctfltr-menu li.pink{display: none;}    

            .column-elementor_library_type a:nth-child(2), .menu-icon-elementor_library .wp-first-item, .svx-license{display: none;}
             /*Elementor fix*/

            .ocdi{max-width: 1050px !important} /*fix for demo import */
  
            </style>
            <script type="text/javascript">
            	jQuery(function() {
            		if (jQuery('#footerfirst').length > 0) { 
						jQuery( document ).on( 'tinymce-editor-setup', function( event, editor ) {
						    editor.settings.toolbar1 += ',footercolumns,footercontact';
						    editor.addButton( 'footercolumns', {
						        text: '',
						        icon: 'footer-columns',
						        onclick: function () {
						            editor.insertContent( '[wpsm_column size="one-half"]<div class="widget_recent_entries"><div class="title">For customers</div><ul><li><a href="#">First link</a></li><li><a href="#">Second Link</a></li><li><a href="#">Third link</a></li><li><a href="#">Fourth link</a></li></ul></div>[/wpsm_column][wpsm_column size="one-half" position="last"]<div class="widget_recent_entries"><div class="title">For vendors</div><ul><li><a href="#">First link</a></li><li><a href="#">Second Link</a></li><li><a href="#">Third link</a></li><li><a href="#">Fourth link</a></li></ul></div>[/wpsm_column]' );
						        }
						    });
						    editor.addButton( 'footercontact', {
						        text: '',
						        icon: 'footer-contact',
						        onclick: function () {
						            editor.insertContent( '<div class="tabledisplay footer-contact mb30"><div class="left-ficon-contact celldisplay"></div><div class="fcontact-body celldisplay"><span class="call-us-text">Got Questions? Call us 24/7!</span> <span class="call-us-number">(800) 5000-8888</span> <span class="other-fcontact"><a href="mailto:#">test@gmail.com</a></span></div></div>' );
						        }
						    });						    
						});
					}
					if(jQuery('.post-type-elementor_library .nav-tab-wrapper').length > 1){ //Fix Elementor library
						jQuery('.post-type-elementor_library .nav-tab-wrapper').first().hide();
					}

					if(jQuery('.elementor-template_library-blank_state').length > 1){ //Fix Elementor library
						jQuery('.elementor-template_library-blank_state').first().hide();
					}					
				});
            </script>
            <?php
			}
		}

		function welcome_screen_scripts(){
			wp_enqueue_style( 'rehub_admin_css', REHUB_ADMIN_DIR . 'screens/css/rehub-admin.css' );
			wp_enqueue_script( 'rehub_welcome_screen', REHUB_ADMIN_DIR . 'screens/js/rehub-welcome-screen.js' );
		}

		function support_screen_scripts(){
			wp_enqueue_style( 'rehub_admin_css', REHUB_ADMIN_DIR . 'screens/css/rehub-admin.css' );
		}

		function demos_screen_scripts(){
			wp_enqueue_style( 'rehub_admin_css', REHUB_ADMIN_DIR . 'screens/css/rehub-admin.css' );
			wp_enqueue_script( 'rehub_admin_js', REHUB_ADMIN_DIR . 'screens/js/rehub-demo.js' );
		}

		function plugins_screen_scripts(){
			wp_enqueue_style( 'rehub_admin_css', REHUB_ADMIN_DIR . 'screens/css/rehub-admin.css' );
		}

		function plugin_link( $item ) {
			$installed_plugins = get_plugins();
			$item['sanitized_plugin'] = $item['name'];

			// We have a repo plugin
			if ( ! $item['version'] ) {
				$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
			}

			/** We need to display the 'Install' hover link */
			if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
				$actions = array(
					'install' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Install %2$s">Install</a>',
						esc_url( wp_nonce_url(
							add_query_arg(
								array(
									'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'        => urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-install' => 'install-plugin',
									'return_url'    => 'rehub-plugins'
								),
								TGM_Plugin_Activation::$instance->get_tgmpa_url()
							),
							'tgmpa-install',
							'tgmpa-nonce'
						) ),
						$item['sanitized_plugin']
					),
				);
			}
			/** We need to display the 'Activate' hover link */
			elseif ( is_plugin_inactive( $item['file_path'] ) ) {
				$actions = array(
					'activate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
						esc_url( add_query_arg(
							array(
								'plugin'               => urlencode( $item['slug'] ),
								'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
								'plugin_source'        => urlencode( $item['source'] ),
								'rehub-activate'       => 'activate-plugin',
								'rehub-activate-nonce' => wp_create_nonce( 'rehub-activate' ),
							),
							admin_url( 'admin.php?page=rehub-plugins' )
						) ),
						$item['sanitized_plugin']
					),
				);
			}
			/** We need to display the 'Update' hover link */
			elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
				$actions = array(
					'update' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Install %2$s">Update</a>',
						wp_nonce_url(
							add_query_arg(
								array(
									'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'        => urlencode( $item['slug'] ),
									
									'tgmpa-update'  => 'update-plugin',
									'plugin_source' => urlencode( $item['source'] ),
									'version'       => urlencode( $item['version'] ),
									'return_url'    => 'rehub-plugins'
								),
								TGM_Plugin_Activation::$instance->get_tgmpa_url()
							),
							'tgmpa-update',
							'tgmpa-nonce'
						),
						$item['sanitized_plugin']
					),
				);
			} elseif ( rh_check_plugin_active( $item['file_path'] ) ) {
				$actions = array(
					'deactivate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Deactivate %2$s">Deactivate</a>',
						esc_url( add_query_arg(
							array(
								'plugin'                 => urlencode( $item['slug'] ),
								'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
								'plugin_source'          => urlencode( $item['source'] ),
								'rehub-deactivate'       => 'deactivate-plugin',
								'rehub-deactivate-nonce' => wp_create_nonce( 'rehub-deactivate' ),
							),
							admin_url( 'admin.php?page=rehub-plugins' )
						) ),
						$item['sanitized_plugin']
					),
				);
			}

			return $actions;
		}
	}

	new Rehub_Admin;
}

// Omit closing PHP tag to avoid "Headers already sent" issues.