<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php
$rehub_theme = wp_get_theme();
if($rehub_theme->parent_theme) {
    $template_dir =  basename(get_template_directory());
    $rehub_theme = wp_get_theme($template_dir);
}
$rehub_version = $rehub_theme->get( 'Version' );
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
?>
<div class="wrap about-wrap rehub-wrap">
	<h1><?php esc_html_e( "Welcome to ReHub Theme!", "rehub-theme" ); ?></h1>
	<div class="updated registration-notice-1" style="display: none;">
		<p><strong><?php esc_html_e( "Thanks for registering your purchase. You have now access to demo stacks, support and additional bonuses. ", "rehub-theme" ); ?> </strong></p>		
		<?php if ( ! function_exists( 'envato_market' ) ) :?>
			<?php esc_html_e( "If you need automatic theme updates, install Envato Market plugin from ", "rehub-theme" ); ?>
			<a href="<?php echo admin_url( 'admin.php?page=rehub-plugins' );?>"><?php esc_html_e( "Plugins Tab", "rehub-theme" ); ?></a>
		<?php endif;?>
	</div>
	<div class="updated error registration-notice-2" style="display: none;"><p><strong><?php esc_html_e( "Please provide all details for registering your copy of ReHub Theme.", "rehub-theme" ); ?>.</strong></p></div>
	<div class="updated error registration-notice-3" style="display: none;"><p><strong><?php esc_html_e( "Something went wrong. Please try again.", "rehub-theme" ); ?></strong></p></div>
	<div class="updated error registration-notice-4" style="display: none;"><p><strong><?php esc_html_e( "You used not correct name. Please, use your official login name on Envato", "rehub-theme" ); ?></strong></p></div>
	
	<?php if( $registeredlicense == true ) :?>
	<div class="about-text">
		<?php esc_html_e( "Theme is registered on your site! ", "rehub-theme" ); ?>
        <?php if ($tf_support_date):?>
	        <?php esc_html_e( "You have support until: ", "rehub-theme" ); ?><?php $date = date_create($tf_support_date); echo date_format($date, 'Y-m-d');?>
	        <a href="http://themeforest.net/item/rehub-directory-shop-coupon-affiliate-theme/7646339" target="_blank"><?php esc_html_e( "(extend support)", "rehub-theme" ); ?></a><br />
        <?php endif;?>
		<div class="rh-admin-note"><?php esc_html_e( "Please, use search in Online docs before you write to our support. Example: ", "rehub-theme" ); ?> <a href="http://rehubdocs.wpsoul.com/?s=How+to+set+Mega+menu&search_param=all" target="_blank">How to set Mega menu</a> </div>    
		<?php if ( ! function_exists( 'envato_market' ) ) :?>
			<?php esc_html_e( "If you need automatic theme updates, install Envato Market plugin from ", "rehub-theme" ); ?>
			<a href="<?php echo admin_url( 'admin.php?page=rehub-plugins' );?>"><?php esc_html_e( "Plugins Tab", "rehub-theme" ); ?></a>
		<?php endif;?>	
	</div>
	<?php else :?>
	<div class="about-text"><?php esc_html_e( "ReHub Theme is now installed and ready to use! Please register your purchase to get support, automatic theme updates, demo stacks, bonuses.", "rehub-theme" ); ?></div>	
	<?php endif;?>
	
    <div class="rehub-logo"><span class="rehub-version"><?php esc_html_e( "Version", "rehub-theme" ); ?> <?php echo esc_html($rehub_version); ?></span></div>
	<h2 class="nav-tab-wrapper">
    	<?php
		printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', esc_html__( "Registration", "rehub-theme" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=rehub-support' ), esc_html__( "Support and tips", "rehub-theme" ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=rehub-plugins' ), esc_html__( "Plugins", "rehub-theme" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=import_demo' ), esc_html__( "Demo import", "rehub-theme" ) );
		?>
	</h2>
    <div class="feature-section">
		<div class="rehub-important-notice registration-form-container">
			<?php
			if( $registeredlicense == true ) {
				echo '<p class="about-description"><span class="dashicons dashicons-yes"></span>'.__("Registration Complete! You have full access to theme data now.", "rehub-theme").'</p>';
			} else {
			?>
			<p class="about-description"><?php esc_html_e( "Enter your credentials below to complete product registration.", "rehub-theme" ); ?></p>
			<div class="rehub-registration-steps">
		    	<div class="feature-section col three-col">
		            <div class="col">
		            	<?php add_thickbox(); ?>
						<h4><?php esc_html_e( "Step 1 - Get your purchase code", "rehub-theme" ); ?></h4>
						<p><?php esc_html_e( 'Please, get your purchase key in download section of theme. View a tutorial&nbsp;', 'rehub-theme' );
						printf( '<a href="%s" class="thickbox" target="_blank">%s</a>.', REHUB_ADMIN_DIR . 'screens/images/api_key.jpg?rel=0&TB_iframe=true&height=792&width=1024',  esc_html__('here', "rehub-theme" ) ); ?></p>
		            </div>
		        	<div class="col">
						<h4><?php esc_html_e( "Step 2 - Purchase Validation", "rehub-theme" ); ?></h4>
						<p><?php esc_html_e( "Enter your ThemeForest username, purchase code into the fields below. This will give you access to automatic theme updates, demo stacks, support, etc.", "rehub-theme" ); ?></p>
		            </div>               	
		            <div class="col last-feature">
						<h4><?php esc_html_e( "Step 3 - Next Steps", "rehub-theme" ); ?></h4>
						<p><?php esc_html_e( "After activating of theme, you can install bundled plugins, get access to demo stacks, tips, support, bonuses", "rehub-theme" ); ?></p>
		            </div>
		        </div>
		    </div>						
			<?php } ?>
			<div class="rehub-registration-form">
				<form id="rehub_product_registration">
					<input type="hidden" name="action" value="rehub_update_registration" />
					<input type="text" name="tf_username" id="tf_username" placeholder="<?php esc_html_e( "Themeforest Username", "rehub-theme" ); ?>" value="<?php echo esc_attr($tf_username); ?>" />
					<input type="text" name="tf_purchase_code" id="tf_purchase_code" placeholder="<?php esc_html_e( "Enter Themeforest Purchase Code", "rehub-theme" ); ?>" value="<?php echo esc_attr($tf_purchase_code); ?>" />
					<button class="button button-large button-primary rehub-large-button rehub-register"><?php esc_html_e( "Submit", "rehub-theme" ); ?></button>					
					<?php wp_nonce_field( 'ajax-tfreg-nonce', 'register-security' ); ?>					
				</form>
			</div>

			<span class="rehub-loader"><i class="dashicons dashicons-update loader-icon"></i><span></span></span>			
		</div>
	</div>
    <div class="feature-section">
        <strong>Some important tutorials to make your site better:</strong>
        <ul>
			<li><a href="https://wpsoul.com/make-smart-profitable-deal-affiliate-comparison-site-woocommerce/" target="_blank" rel="noopener">Step by step guide to create affiliate profitable price comparison site on woocommerce</a></li>        	
 			<li><a href="https://wpsoul.com/guide-creating-profitable/" target="_blank">Step by step guide for affiliate websites</a></li>        
            <li><a href="https://wpsoul.com/how-optimize-speed-of-wordpress/" target="_blank">How to optimize speed of site</a></li>
            <li><a href="https://wpsoul.com/optimize-seo-wordpress/" target="_blank">How to make the best SEO optimization on site</a></li>
            <li><a href="https://wpsoul.com/creating-social-business-advanced-membership-site-buddypress-and-s2member/" target="_blank">Set extended Membership on your site</a></li>
            <li><a href="https://wpsoul.com/directory-review-classified-on-woocommerce/" target="_blank">Creating Directory site with Rehub</a></li>    
            <li><a href="https://wpsoul.com/how-to-create-multi-vendor-shop-on-wordpress/" target="_blank">Creating Multivendor site with Rehub</a></li> 

        </ul>
    </div>	
</div>
