<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php
//////////////////////////////////////////////////////////////////
// WooCommerce css
//////////////////////////////////////////////////////////////////
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

//////////////////////////////////////////////////////////////////
// Display number products per page.
//////////////////////////////////////////////////////////////////

if(!function_exists('rh_loop_shop_per_page')){
	function rh_loop_shop_per_page( $cols ) {
		if(rehub_option('woo_number') == '16') {
			$cols = 16;
		}
		elseif(rehub_option('woo_number') == '24') {
			$cols = 24;
		}
		elseif(rehub_option('woo_number') == '30') {
			$cols = 30;
		}	
		else {
			$cols = 12;	
		}	
	  	return $cols;
	}
}
add_filter( 'loop_shop_per_page', 'rh_loop_shop_per_page', 20 );

if(!function_exists('rh_loop_shop_number')){
	function rh_loop_shop_number( ) {
		if(rehub_option('woo_columns') == '4_col'  || rehub_option('woo_columns') == '4_col_side') {
			return 4;
		}
		elseif(rehub_option('woo_columns') == '5_col_side') {
			return 5;
		}	
		else {
			return 3;
		}
	}
}
add_filter( 'loop_shop_columns', 'rh_loop_shop_number', 20 );

//////////////////////////////////////////////////////////////////
// Set 6 related products
//////////////////////////////////////////////////////////////////

add_filter( 'woocommerce_output_related_products_args', 'rh_woo_related_products_args' );
function rh_woo_related_products_args( $args ) {
	$args['posts_per_page'] = 6;
	return $args;
}


//////////////////////////////////////////////////////////////////
// Woo hook customization
/////////////////////////////////////////////////////////////

add_action('woocommerce_before_shop_loop', 'rehub_woocommerce_wrapper_start3', 33);
function rehub_woocommerce_wrapper_start3() {
  echo '<div class="clear"></div>';
}
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );

add_action( 'woocommerce_external_add_to_cart', 'rh_woo_external_add_to_cart', 30 );
add_action( 'woocommerce_checkout_before_customer_details', 'rehub_woo_before_checkout' );
add_action( 'woocommerce_checkout_after_customer_details', 'rehub_woo_average_checkout' );
add_action( 'woocommerce_checkout_after_order_review', 'rehub_woo_after_checkout' );
add_action( 'woocommerce_before_add_to_cart_button', 'rehub_woo_countdown' );
add_action( 'woocommerce_product_query', 'rh_change_product_query', 99 ); //Here we change and extend product loop data
if(!rehub_option('woo_btn_inner_disable')){
	add_action('rhwoo_template_single_add_to_cart', 'woocommerce_template_single_add_to_cart');
}
if ( ! function_exists( 'rh_woo_external_add_to_cart' ) ) {
	function rh_woo_external_add_to_cart() {
		global $product;
		wc_get_template( 'single-product/add-to-cart/external.php', array(
			'product_url' => $product->add_to_cart_url(),
			'button_text' => $product->single_add_to_cart_text(),
		) );
	}
}

add_filter( 'woocommerce_breadcrumb_defaults', 'rh_change_breadcrumb_delimiter' );
function rh_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '<span class="delimiter"><i class="far fa-angle-right"></i></span>';
	return $defaults;
}

//Change position of YITH Buttons
if ( defined( 'YITH_WCWL' )){
	add_filter('yith_wcwl_positions', 'rh_wishlist_change_position');
	function rh_wishlist_change_position($so_array=array()){
        $so_array   =   array(
            "shortcode" => array('hook'=>'shortcode', 'priority'=>0),
            "add-to-cart"=> array('hook'=>'shortcode', 'priority'=>0),
            "thumbnails"=> array('hook'=>'shortcode', 'priority'=>0),
            "summary"=> array('hook'=>'shortcode', 'priority'=>0),
        );
	    return $so_array;
	}	
}

if ( class_exists('YITH_Woocompare_Frontend')){
	//$frontend = new YITH_Woocompare_Frontend();
	global $yith_woocompare;
	remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj , 'add_compare_link' ), 35 );
}

function rehub_woo_before_checkout() {
	echo '<div class="re_woocheckout_details">';
}
function rehub_woo_average_checkout() {
	echo '</div><div class="re_woocheckout_order">';
}
function rehub_woo_after_checkout() {
	echo '</div><div class="clearfix"></div>';
}
function rehub_woo_wcv_before_dash() {
	echo '<div class="rh_wcv_dashboard_page">';
}
function rehub_woo_wcv_after_dash() {
	echo '</div>';
}

if (!function_exists('rh_woo_code_zone')){
function rh_woo_code_zone($zone='button'){
	if($zone == 'button'){
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'woo_btn_code_area' ) ){
			global $post;
	        $code_incart = get_post_meta($post->ID, 'rh_code_incart', true );
	        if ( !empty($code_incart)) {
	            echo '<div class="rh_woo_code_zone_button">';
	            echo do_shortcode($code_incart);
	            echo '</div>';
	        }else{
		    	$code_incart = rehub_option('woo_code_zone_button');
		    	if ( !empty($code_incart)) {
		        	echo '<div class="rh_woo_code_zone_button">';
		        	echo do_shortcode($code_incart);
		        	echo '</div>'; 
		        }
	        } 
		}      		
	}elseif($zone =='content'){
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'woo_content_code_area' ) ){		
			global $post;
			$code_in_content = get_post_meta($post->ID, 'rehub_woodeals_short', true );
		    if(!empty ($code_in_content)){
		    	echo '<div class="rh_woo_code_zone_content">';
		    		echo do_shortcode($code_in_content);
		    	echo '</div>';
		    }else{
		    	$code_in_content = rehub_option('woo_code_zone_content');
		    	if ( !empty($code_in_content)) {
			    	echo '<div class="rh_woo_code_zone_content">';
			    		echo do_shortcode($code_in_content);
			    	echo '</div>';
		    	}	    	
		    }
	    }	    		
	}
	elseif($zone =='bottom'){
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'woo_footer_code_area' ) ){		
			global $post;
			$code_bottom = get_post_meta($post->ID, 'woo_code_zone_footer', true );
		    if(!empty ($code_bottom)){
		    	echo '<div class="rh_woo_code_zone_bottom">';
		    		echo do_shortcode($code_bottom);
		    	echo '</div>';
		    }else{
		    	$code_bottom = rehub_option('woo_code_zone_footer');
		    	if ( !empty($code_bottom)) {
			    	echo '<div class="rh_woo_code_zone_bottom">';
			    		echo do_shortcode($code_bottom);
			    	echo '</div>';
		    	}		    	
		    } 
		}		
	}	
	elseif($zone =='float'){
    	$code_float = rehub_option('woo_code_zone_float');
    	if ( !empty($code_float)) {
	    	echo '<div class="rh_woo_code_zone_float">';
	    		echo do_shortcode($code_float);
	    	echo '</div>';
    	}		    			
	}	
} 
} 

if(!function_exists('rh_woo_code_loop')){
	function rh_wooattr_code_loop($attrelpanel=''){
		if($attrelpanel){
			$attrelpanel = (array) json_decode( urldecode( $attrelpanel ), true );
			echo '<div class="woo_code_zone_loop clearbox">';
				foreach ($attrelpanel as $item) {
					$atts = array();
					if(!empty($item['attrkey'])){
						$atts['type'] = $item['attrtype'];
						$atts['attrfield']=$item['attrkey'];
						$atts['label']=$item['attrlabel'];
						$atts['posttext']=$item['attrposttext'];
						$atts['show_empty']=$item['attrshowempty'];
						$atts['labelclass']='mr5 rtlml5';
				        if(!empty($item['icon']) && is_array($item['icon'])){
				            $atts['icon'] = $item['icon']['value'].' mr5 rtlml5';
				        }						
						echo '<div class="woo_code_loop_item font90">';
						echo wpsm_get_custom_value($atts);
						echo '</div>';
					}
				}
			echo '</div>';
		}else{
			$loop_code_zone = rehub_option('woo_code_zone_loop');        
    		if ($loop_code_zone){
    			echo '<div class="woo_code_zone_loop clearbox">'.do_shortcode($loop_code_zone).'</div>';
    		}
		}
	}
}

//////////////////////////////////////////////////////////////////
// Woo Tab customization
/////////////////////////////////////////////////////////////

if (!function_exists('woo_ce_video_output')){
function woo_ce_video_output(){
	echo do_shortcode('[content-egg module=Youtube template=custom/slider]' );
}}

if (!function_exists('woo_ce_news_output')){
function woo_ce_news_output(){
	echo do_shortcode('[content-egg module=GoogleNews template=custom/grid]' );
}}

if (!function_exists('woo_ce_history_output')){
function woo_ce_history_output(){
	echo do_shortcode('[content-egg-block template=custom/all_pricehistory_full]' );
}}
if (!function_exists('woo_ce_pricelist_output')){
function woo_ce_pricelist_output(){
	echo do_shortcode('[content-egg-block template=custom/all_offers_logo_group]' );
}}

if (!function_exists('woo_photo_booking_out')){
function woo_photo_booking_out(){
	global $product;	
	$attachment_ids = $product->get_gallery_image_ids();
	$galleryids = implode(',', $attachment_ids);
	echo '<div class="rh-woo-section-title"><h2 class="rh-heading-icon">'.__('Photos', 'rehub-theme').': <span class="rh-woo-section-sub">'.get_the_title().'</span></h2></div>';
	echo rh_get_post_thumbnails(array('galleryids' => $galleryids, 'columns' => 4, 'height' => 150));
}}

if (!function_exists('woo_cevideo_booking_out')){
function woo_cevideo_booking_out(){
	echo '<div class="rh-woo-section-title"><h2 class="rh-heading-icon">'.__('Videos', 'rehub-theme').': <span class="rh-woo-section-sub">'.get_the_title().'</span></h2></div>';	
	echo do_shortcode('[content-egg module=Youtube template=custom/slider]' );
}}

add_filter( 'woocommerce_product_tabs', 'woo_custom_video_tab', 98 );
function woo_custom_video_tab( $tabs ) {
	global $post;
	$post_image_videos = get_post_meta( $post->ID, 'rh_product_video', true );
	if(!empty($post_image_videos)){
	    $tabs['woo-custom-videos'] = array(
	        'title' => esc_html__('Videos', 'rehub-theme'),
	        'priority' => '21',
	        'callback' => 'woo_custom_video_output',
	    );		
	}
	return $tabs;
}

if (!function_exists('woo_custom_video_output')){
function woo_custom_video_output($args) {
	$defaults = array(
		'class' => 'mb10 rh_videothumb_link mobileblockdisplay',
		'rel' => 'wooyoutube',
		'wrapper' => 1,	
		'title' => 1				
	);
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );	
	global $post;
	$post_image_videos = get_post_meta( $post->ID, 'rh_product_video', true );
	if(!empty($post_image_videos)){
		if($title == 1){
			echo '<div class="rh-woo-section-title"><h2 class="rh-heading-icon">'.__('Videos', 'rehub-theme').': <span class="rh-woo-section-sub">'.get_the_title().'</span></h2></div>';
		}		
		$post_image_videos = array_map('trim', explode(PHP_EOL, $post_image_videos));
		if($wrapper == 1) {echo '<div class="modulo-lightbox rh-flex-eq-height compare-full-thumbnails mb20">';}
			if ($rel == 'wooyoutube'){
				$random_key = rand(0, 50);
				$rel = 'wooyoutube_gallery_'.(int)$random_key;
			}
		    wp_enqueue_script('modulobox'); wp_enqueue_style('modulobox'); 
		    foreach($post_image_videos as $key=>$video) { 
		    	$video = trim($video);
		        echo '<a href="'.esc_url($video).'" data-rel="'.$rel.'" target="_blank" class="'.$class.'" data-poster="'.parse_video_url(esc_url($video), 'maxthumb').'" data-thumb="'.parse_video_url(esc_url($video), "hqthumb").'">
		        <img src="'.parse_video_url(esc_url($video), "hqthumb").'" alt="video '.get_the_title().'" />';
				echo '</a>';
			}
		if($wrapper == 1) {echo '</div>';}		
	}
}
}

if (!function_exists('rehub_woo_countdown')){
function rehub_woo_countdown($label = true){
	global $post;
	$endshedule = get_post_meta($post->ID, '_sale_price_dates_to', true );	
	if($endshedule){
		$endshedule = date_i18n( 'Y-m-d', $endshedule );
		$countdown = explode('-', $endshedule);
		$year = $countdown[0];
		$month = $countdown[1];
		$day  = $countdown[2];
		$startshedule = get_post_meta($post->ID, '_sale_price_dates_from', true );
		if ($startshedule){			
			$startshedule = strtotime(date_i18n( 'Y-m-d', $startshedule )); 
			$current = time();
			if($startshedule > $current){
				return;
			}
		}
		echo '<div class="clearbox">';
		if($label !='no') {echo '<div class="rehub-main-color mb10"><i class="fas fa-bolt mr5 ml5 orangecolor font120 fastShake" aria-hidden="true"></i> '.__('Flash Sale', 'rehub-theme').'</div>';}
		echo wpsm_countdown(array('year'=> $year, 'month'=>$month, 'day'=>$day));
		echo '</div>';
	}
	else {
		$rehub_woo_expiration = get_post_meta( $post->ID, 'rehub_woo_coupon_date', true );
		if ($rehub_woo_expiration){
			$countdown = explode('-', $rehub_woo_expiration);
			$year = $countdown[0];
			$month = $countdown[1];
			$day  = $countdown[2];
			echo '<div class="clearbox">';
			if($label !='no') {echo '<div class="rehub-main-color mb10"><i class="fas fa-bolt mr5 ml5 orangecolor font120 fastShake" aria-hidden="true"></i> '.__('Flash Sale', 'rehub-theme').'</div>';}				
			echo wpsm_countdown(array('year'=> $year, 'month'=>$month, 'day'=>$day));
			echo '</div>';		
		}
	}	
} 
} 

function rh_show_gmw_form_before_wcvendor(){
	if (function_exists('gmw_member_location_form') ) {
		echo rh_add_map_gmw();
		echo '<div class="mb25"></div>';
	}
}


//////////////////////////////////////////////////////////////////
// Woo default thumbnail
//////////////////////////////////////////////////////////////////
add_filter('woocommerce_placeholder_img_src', 'rehub_woocommerce_placeholder_img_src');
function rehub_woocommerce_placeholder_img_src( $src ) {
	global $post;
	if (is_object($post)) {
		if (get_post_meta($post->ID, 'rehub_woo_coupon_code', true) !=''){
			$src = get_template_directory_uri() . '/images/default/woocouponph.png';
		}
		elseif (get_post_meta($post->ID, '_sale_price', true) !=''){
			$src = get_template_directory_uri() . '/images/default/woodealph.png';
		}
		else {
			$src = get_template_directory_uri() . '/images/default/wooproductph.png';
		} 
	}
	else {
		$src = get_template_directory_uri() . '/images/default/wooproductph.png';
	}	
	return $src;
}
add_filter( 'woocommerce_gallery_image_size', 'rh_custom_image_gallery_size' );
function rh_custom_image_gallery_size($size){
	return 'full';
}

//////////////////////////////////////////////////////////////////
// Woo update cart in header
//////////////////////////////////////////////////////////////////
if (rehub_option('woo_cart_place') =='1' || rehub_option('woo_cart_place') =='2' || (rehub_option('rehub_header_style') =='header_seven' && rehub_option('header_seven_cart') != '')){
	add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	if( !function_exists('woocommerce_header_add_to_cart_fragment') ) { 
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		?>
		<?php if (rehub_option('woo_cart_place') =='1'):?>
			<a class="cart-contents cart_count_<?php echo ''.$woocommerce->cart->cart_contents_count; ?>" href="<?php echo wc_get_cart_url(); ?>"><i class="far fa-shopping-cart"></i> <?php esc_html_e( 'Cart', 'rehub-theme' ); ?> (<?php echo ''.$woocommerce->cart->cart_contents_count; ?>) - <?php echo ''.$woocommerce->cart->get_cart_total(); ?></a>		
		<?php elseif (rehub_option('woo_cart_place') =='2' || rehub_option('rehub_header_style') =='header_nine' || (rehub_option('rehub_header_style') =='header_seven' && rehub_option('header_seven_cart')!= '') ):?>
			<a class="rh-flex-center-align rh-header-icon rh_woocartmenu-link cart-contents cart_count_<?php echo ''.$woocommerce->cart->cart_contents_count; ?>" href="<?php echo wc_get_cart_url(); ?>"><span class="rh_woocartmenu-icon"><span class="rh-icon-notice rehub-main-color-bg"><?php echo ''.$woocommerce->cart->cart_contents_count;?></span></span><span class="rh_woocartmenu-amount"><?php echo ''.$woocommerce->cart->get_cart_total();?></span></a>
		<?php endif;?>
		<?php
		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}
	}	
}

//////////////////////////////////////////////////////////////////
// Custom Editor Review, User ratings, Pros and Cons fields
//////////////////////////////////////////////////////////////////

if(!function_exists('rh_woo_get_editor_rating')){
	function rh_woo_get_editor_rating(){
		global $post;
		$editor_rating = get_post_meta($post->ID, 'rehub_review_overall_score', true);
		if (!$editor_rating) return;
		if($editor_rating > 0){
			$html = '<div class="rh_woo_star" title="'.sprintf( esc_html__( 'Rated %s out of', 'rehub-theme' ), esc_html( (float)$editor_rating )).' 10">';
			$editor_rating = round($editor_rating/2, 0);
			for ($i = 1; $i <= 5; $i++){
		    	if ($i <= $editor_rating){
		    		$active = ' active';
		    	}else{
		    		$active ='';
		    	}
		        $html .= '<span class="rhwoostar rhwoostar'.$i.$active.'">&#9733;</span>';
			}
			$html .= '</div>';
			return $html;
		}		
	}
}

add_filter( 'woocommerce_product_get_rating_html', 'rh_woo_rating_icons_wrapper', 10, 3 );
add_filter( 'woocommerce_get_star_rating_html', 'rh_woo_rating_icons_html', 10, 3);
function rh_woo_rating_icons_wrapper($html, $rating, $count){
	if ( 0 < $rating ) {
		$html  = '<div class="rh_woo_star" title="'.sprintf( esc_html__( 'Rated %s out of', 'rehub-theme' ), esc_html( (float)$rating )).' 5">';
		$html .= wc_get_star_rating_html( $rating, $count );
		$html .= '</div>';
	} else {
		$html = '';
	}
	return $html;	
}
function rh_woo_rating_icons_html($html, $rating, $count){
	$html = '';
	if($rating > 0){
		$rating = round($rating, 0);
		for ($i = 1; $i <= 5; $i++){
	    	if ($i <= $rating){
	    		$active = ' active';
	    	}else{
	    		$active ='';
	    	}
	        $html .= '<span class="rhwoostar rhwoostar'.$i.$active.'">&#9733;</span>';
		}
	}
	return $html;
}

add_filter( 'woocommerce_structured_data_product', 'rh_woo_editor_schema', 10, 2 );
function rh_woo_editor_schema($markup, $product){
	global $post;
	$editor_rating = get_post_meta($product->get_id(), 'rehub_review_overall_score', true);

	if($editor_rating){
		$heading = get_post_meta($product->get_id(), '_review_heading', true);
		$summary = get_post_meta($product->get_id(), '_review_post_summary_text', true);
		$author_data = get_userdata($post->post_author);
		$markup['review'] = array(
			'@type'       => 'Review',
			"reviewRating" => array(
				"@type" => "Rating",
				"worstRating" => "1",
				"bestRating" => "10",
				"ratingValue" => round($editor_rating, 1),
			),
		    "author" => array(
		      "@type" => "Person",
		      "name" => $author_data->display_name,
		    ),								
		);
		if($summary){
			$markup['review']['reviewBody'] = $summary;
		}	
		if($heading){
			$markup['review']['name'] = $heading;
		}
		if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && $product->get_average_rating() > 0){
			$markup['aggregateRating']['ratingValue'] = round($editor_rating/2, 1);
		}else{
			$markup['aggregateRating'] = array(
				'@type'       => 'AggregateRating',
				'ratingValue' => (int)$editor_rating/2,
				'reviewCount' => 1,
			);				
		}			
	}
    $term_ids =  wp_get_post_terms($post->ID, 'store', array("fields" => "ids")); 
	if (!empty($term_ids) && ! is_wp_error($term_ids)) {
		$term_id = $term_ids[0];
    	$tagobj = get_term_by('id', $term_id, 'store');
    	$tagname = $tagobj->name;
		$markup['brand'] = array(
			'@type'       => 'Thing',
			'name' => $tagname,
		);    			
	}

	return $markup;
}



function rehub_wc_comment_badges( $comment ) { ?>
	<div class="wc-comment-author vcard floatleft">
		<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '80' ), '' ); ?>
		<div class="text-center font80 lineheight20">
		<?php if (rehub_option('rh_enable_mycred_comment')): ?>
			<?php 
				$author_id = $comment->user_id;
				if(function_exists('mycred_get_users_rank')){
					if(rehub_option('rh_mycred_custom_points')){
						$custompoint = rehub_option('rh_mycred_custom_points');
						$mycredrank = mycred_get_users_rank($author_id, $custompoint );
					}
					else{
						$mycredrank = mycred_get_users_rank($author_id);		
					}
				}
				if(function_exists('mycred_display_users_total_balance') && function_exists('mycred_render_shortcode_my_balance')){
				    if(rehub_option('rh_mycred_custom_points')){
				        $custompoint = rehub_option('rh_mycred_custom_points');
				        $mycredpoint = mycred_render_shortcode_my_balance(array('type'=>$custompoint, 'user_id'=>$author_id, 'wrapper'=>'', 'balance_el' => '') );
				        $mycredlabel = mycred_get_point_type_name($custompoint, false);
				    }
				    else{
				        $mycredpoint = mycred_render_shortcode_my_balance(array('user_id'=>$author_id, 'wrapper'=>'', 'balance_el' => '') );
				        $mycredlabel = mycred_get_point_type_name('', false);           
				    }
				}
			?>
			<?php if (!empty($mycredrank) && is_object( $mycredrank)) :?>
				<span class="rh-user-rank-mc rh-user-rank-<?php echo (int)$mycredrank->post_id; ?>">
					<?php echo esc_html($mycredrank->title) ;?>
				</span>
			<?php endif;?>
			<?php if (!empty($mycredpoint)) :?><div class="rh_mycred_point_bal"><?php echo esc_html($mycredlabel);?>: <?php echo ''.$mycredpoint;?></div><?php endif;?>
			<?php if ( function_exists( 'mycred_get_users_badges' ) ) : ?>
				<div class="comm_meta_cred">
					<?php rh_mycred_display_users_badges( $author_id ) ?>
				</div> 
			<?php endif; ?>
		<?php else:?>
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
		<?php endif;?>
		</div>
	</div>
<?php 
}
remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
add_action( 'woocommerce_review_before', 'rehub_wc_comment_badges', 10 );

// pros and cons in comment form
add_filter('woocommerce_product_review_comment_form_args', 'rh_add_woo_pros_cons_form_fields');
function rh_add_woo_pros_cons_form_fields($comment_form){
	if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
		/*global $wpdb;
		global $product;
		$user = wp_get_current_user();
 		$count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_author_email = %s", $product->get_id(), $user->user_email ));	*/	
 		global $product;
 		$productid = $product->get_id();
		$userid = get_current_user_id();
		$commented = get_user_meta($userid, '_added_woo_pros_cons', true);
		if(empty($commented) || !is_array($commented)){
			$flagged = false;
		}elseif(in_array($productid, $commented)){
			$flagged = true;
		}else{
			$flagged = false;
		}

		if(!$flagged){
			$comment_form['comment_field'] .= '<div class="woo_pros_cons_form flowhidden"><div class="comment-form-comment wpsm-one-half"><textarea id="pos_comment" name="pos_comment" rows="6" placeholder="'.esc_html__('PROS:', 'rehub-theme').'"></textarea></div><div class="comment-form-comment wpsm-one-half"><textarea id="neg_comment" name="neg_comment" rows="6" placeholder="'.esc_html__('CONS:', 'rehub-theme').'"></textarea></div></div>';
		}
	}
	return $comment_form;
}

// Save Negative, positive
function rh_add_neg_comment( $comment_id ){
	if ( isset($_POST['comment_post_ID']) && (!empty( $_POST['neg_comment']) || !empty($_POST['pos_comment'])) && 'product' === get_post_type( absint( $_POST['comment_post_ID'] ) ) ) {
		if(!empty($_POST['neg_comment'])){
			add_comment_meta( $comment_id, 'neg_comment', sanitize_textarea_field( $_POST['neg_comment'] ), true );
		}
		if(!empty($_POST['pos_comment'])){
			add_comment_meta( $comment_id, 'pos_comment', sanitize_textarea_field( $_POST['pos_comment'] ), true );
		}
		$comment = get_comment( $comment_id );
		$userid = $comment->user_id;
		$postid = $comment->comment_post_ID;
		$commented = get_user_meta($userid, '_added_woo_pros_cons', true);
		if(empty($commented) || !is_array($commented)){
			$commented = array();
		}
		$commented[] = $postid;
		add_user_meta($userid, '_added_woo_pros_cons', $commented, true);	
	}
}
add_action( 'comment_post', 'rh_add_neg_comment' );

// pros and cons in comment text
function rehub_wc_comment_neg( $comment ) {
	$pros_review = get_comment_meta( $comment->comment_ID, 'pos_comment', true );
	$cons_review = get_comment_meta( $comment->comment_ID, 'neg_comment', true );
	if($pros_review || $cons_review){echo '<div class="flowhidden">';}
	$classcol = (!empty($cons_review) && !empty($pros_review)) ? 'wpsm-one-half ' : '';
	if(isset($pros_review) && $pros_review != '') {
		$pros_reviews = explode(PHP_EOL, $pros_review);
		$proscomment = '';
		foreach ($pros_reviews as $pros) {
			$proscomment .='<span class="pros_comment_item blockstyle mb5">'.$pros.'</span>';
		}
		echo '<div class="'.$classcol.'lineheight20 padd20 lightgreenbg woo_comment_text_pros mt15 font90"><span class="mb10 blockstyle fontbold">'.__('+ PROS:', 'rehub-theme').' </span><span> '.$proscomment.'</span></div>';
	};
	if(!empty($cons_review)) {
		$cons_reviews = explode(PHP_EOL, $cons_review);
		$conscomment = '';
		foreach ($cons_reviews as $cons) {
			$conscomment .='<span class="cons_comment_item blockstyle mb5">'.$cons.'</span>';
		}			
		echo '<div class="'.$classcol.'lineheight20 lightredbg padd20 woo_comment_text_cons mt15 font90"><span class="mb10 blockstyle fontbold">'.__('- CONS:', 'rehub-theme').'</span><span> '.$conscomment.'</span></div>';
	};	
	if($pros_review || $cons_review){echo '</div>';}
}
add_action( 'woocommerce_review_comment_text', 'rehub_wc_comment_neg', 12 );

//Render pros, cons in Comment Edit screen
function rh_woo_cm_edit_pros_cons($comment){
	if ( !isset( $comment->comment_ID ) ) return;
 	if ( !isset( $comment->comment_post_ID ) ) return;
	$post_id = $comment->comment_post_ID;
	$post_type = get_post_type( $post_id );
	if($post_type !=='product') return;
	$pos_comment = get_comment_meta( $comment->comment_ID, 'pos_comment', true );
	$neg_comment = get_comment_meta( $comment->comment_ID, 'neg_comment', true );
	$prosconsRow ='';	
	if( !empty($pos_comment) || !empty($neg_comment) ) {
		$prosconsRow .= '<tr><td colspan="2"><label for="pos_comment">';
		$prosconsRow .= esc_html__('+ PROS:', 'rehub-theme');
		$prosconsRow .= '</label><br /><textarea id="pos_comment" name="pos_comment" rows="5" cols="50">';
		$prosconsRow .= esc_attr( $pos_comment );
		$prosconsRow .= '</textarea></td><td colspan="2"><label for="neg_comment">';
		$prosconsRow .= esc_html__('- CONS:', 'rehub-theme');
		$prosconsRow .= '</label><br /><textarea id="neg_comment" name="neg_comment" rows="5" cols="50">';
		$prosconsRow .= esc_attr( $neg_comment );
		$prosconsRow .= '</textarea></td></tr>';
	}	
	if($prosconsRow){
		echo '<fieldset>',
		'<table class="form-table editcomment">',
			'<tbody>',
				$prosconsRow,
			'</tbody></table><br>',
		'</fieldset>';
	}

}

//Save pros cons values from Comment editor
function rehub_wc_neg_comment_save( $data ) {
	if ( ! isset( $_POST['woocommerce_meta_nonce'], $_POST['neg_comment'], $_POST['pos_comment'] ) || ! wp_verify_nonce( wp_unslash( $_POST['woocommerce_meta_nonce'] ), 'woocommerce_save_data' ) )
		return $data;
		
	if(!empty($_POST['neg_comment'])){
		update_comment_meta( $data['comment_ID'], 'neg_comment', sanitize_textarea_field( $_POST['neg_comment'] ) );
	}
	if(!empty($_POST['pos_comment'])){
		update_comment_meta( $data['comment_ID'], 'pos_comment', sanitize_textarea_field( $_POST['pos_comment'] ) );
	}	
	return $data;
}
add_filter( 'wp_update_comment_data', 'rehub_wc_neg_comment_save', 1 );

//Add custom column for Products
function rh_woo_rev_comment_columns( $columns )
{
	$columns['rh_woo_user_review_column'] = esc_html__( 'Product Review', 'rehub-theme' );
	return $columns;
}
add_filter( 'manage_edit-comments_columns', 'rh_woo_rev_comment_columns' );

function rh_woo_rev_comment_column( $column, $comment_ID )
{
	if ( 'rh_woo_user_review_column' == $column ) {
		
	$comment_meta = get_comment_meta($comment_ID);
	//$userCriteria = get_comment_meta($comment_ID, 'user_criteria', true);	
	$pos_comment = get_comment_meta($comment_ID, 'pos_comment', true);
	$neg_comment = get_comment_meta($comment_ID, 'neg_comment', true);
	if(isset($pos_comment) && $pos_comment != '') {
		echo ''.__('+ PROS:', 'rehub-theme').' '.$pos_comment.'<br />';
	};
	if(isset($neg_comment) && $neg_comment != '') {
		echo ''.__('- CONS:', 'rehub-theme').' '.$neg_comment.'<br /><br />';
	};		
	//for($i = 0; $i < count($userCriteria); $i++) {		
		//echo ''.$userCriteria[$i]['name'].': <strong class="rating">'.$userCriteria[$i]['value'].'</strong><br />';
	//};		
	echo '<br /></p>';
	}
}
add_filter( 'manage_comments_custom_column', 'rh_woo_rev_comment_column', 10, 2 );


//////////////////////////////////////////////////////////////////
// Product swatches
//////////////////////////////////////////////////////////////////
function init_wc_attribute_swatches(){
	require_once 'class_wc_attribute_swatches.php';
}
add_action( 'admin_init', 'init_wc_attribute_swatches' );
if(!function_exists('rh_wc_dropdown_variation_attribute_options')){
	function rh_wc_dropdown_variation_attribute_options( $html, $args ){
		$product = $args['product'];
		$options = $args['options'];
		$taxonomy = $args['attribute'];
		$att_id = wc_attribute_taxonomy_id_by_name( $taxonomy );
		$attribute = wc_get_attribute( $att_id );

		if(!is_object($attribute)) return $html;

		$swatch_type = $attribute->type;
		
		if( 'select' == $swatch_type )
			return $html;
		
		if ( false === $args['selected'] && $taxonomy && $product instanceof WC_Product ) {
			$selected_key = 'attribute_' . sanitize_title( $taxonomy );
			$args['selected'] = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $product->get_variation_default_attribute( $taxonomy );
		}
		
		$name = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $taxonomy );
		$output = '';
		
		if ( empty( $options ) && !empty( $product ) && !empty( $taxonomy ) ) {
			$attributes = $product->get_variation_attributes();
			$options = $attributes[$taxonomy];
		}
		if ( !empty( $options ) ){
			
			$terms = wc_get_product_terms( $product->get_id(), $taxonomy, array( 'fields' => 'all' ) );
			$output .= '<div class="rh-var-selector pb10">';
			
			foreach ( $terms as $term ) {
				if ( in_array( $term->slug, $options, true ) ) {
					
					$term_swatch = get_term_meta( $term->term_id, "rh_swatch_{$swatch_type}", true );
					
					switch( $swatch_type ) {
						case 'color':
							$style = 'background-color:'. $term_swatch .';';
							break;
						case 'image':
							$style = 'background-image:url('. esc_url( wp_get_attachment_thumb_url( $term_swatch ) ) .');';
							break;
						default:
						   $style = '';
					}
					
					$id = $taxonomy .'_'. $term->slug;
					if('text' == $swatch_type){
						$label = $term_swatch;
						if(!$label) {
							$label = $term->name;
						}
					}
					else{
						$label = '';
						if(!$term_swatch){
							$style = '';
							$label = $term->name;
							$swatch_type = 'text';
						}
					}
					
					$output .='<input id="'. esc_attr( $id ) .'" type="radio" name="'. esc_attr( $name ) .'" value="'. esc_attr( $term->slug ) .'" '. checked( sanitize_title( $args['selected'] ), $term->slug, false ) .' class="rh-var-input" />';
					$output .='<label for="'. esc_attr( $id ) .'" title="'. $term->name .'" class="rh-var-label '.$swatch_type.'-label-rh" style="'. $style .'" data-value="'. esc_attr( $term->slug ) .'">'. $label .'</label>';
				}
			}
			
			$output .= '</div>';
		    $variationjs = 'jQuery("select[name='. esc_attr( $name ) .']").hide();jQuery("input[name='. esc_attr( $name ) .']").click(function(){if(jQuery(this).prop("checked")){var newValue = jQuery(this).val();jQuery("select[name='. esc_attr( $name ) .']").val(newValue).trigger("change");}});';
	        wp_add_inline_script('rehub', $variationjs);
		}
		return $html . $output;
	}	
}
if(!function_exists('rh_show_swatch_in_attr')){
	function rh_show_swatch_in_attr($wpautop, $attribute, $values){
		if(!isset($attribute['id'])) {
			return $wpautop;
		}
		$attribute_id = $attribute['id'];	
		$att = wc_get_attribute( $attribute_id );
		if(!is_object($att)){
			return $wpautop;
		}
		$swatch_type = $att->type;
		if($swatch_type == 'select'){
			return $wpautop;
		}else{
			global $product;
			if(empty($product)) {
				return $wpautop;
			}		
			$currentslug = $att->slug;
			$has_archive = $att->has_archives;

			$terms = wc_get_product_terms( $product->get_id(), $currentslug, array( 'fields' => 'all' ) );
			$result = '';
			foreach ( $terms as $term ) {
				$term_swatch = get_term_meta( $term->term_id, "rh_swatch_{$swatch_type}", true );
				if($term_swatch){
					switch( $swatch_type ) {
						case 'color':
							$style = 'background-color:'. $term_swatch .';';
							break;
						case 'image':
							$style = 'background-image:url('. esc_url( wp_get_attachment_thumb_url( $term_swatch ) ) .');';
							break;
						default:
						   $style = '';
					}
					if('text' == $swatch_type){
						$label = $term_swatch;
						if(!$label) {
							$label = $term->name;
						}
					}
					else{
						$label = '';
					}
					if ( $has_archive ) {
						$result .= '<a href="' . esc_url( get_term_link( $term->term_id, $currentslug ) ) . '" rel="tag">';
					}
					$nonselect = $has_archive ? '' : ' label-non-selectable';	        				
					$result .='<span class="rh-var-label'.$nonselect.' '.$swatch_type.'-label-rh" style="'. $style .'">'. $label .'</span>';
					if ( $has_archive ) {
						$result .='</a>';
					}	        				
					
				}
				else{
					return $wpautop;
				}
			}
			return $result;		
		}
	}	
}
if(!function_exists('rh_show_swatch_in_filters')){
	function rh_show_swatch_in_filters($term_html, $term, $link, $count){

		$attribute_id = wc_attribute_taxonomy_id_by_name( $term->taxonomy );
		if($attribute_id){
			$attribute = wc_get_attribute( $attribute_id );
			if(!empty($attribute)){
				$swatch_type = $attribute->type;
				if($swatch_type != 'select'){
					$term_swatch = get_term_meta( $term->term_id, "rh_swatch_{$swatch_type}", true );
	    			if($term_swatch){
						switch( $swatch_type ) {
							case 'color':
								$style = 'background-color:'. $term_swatch .';';
								break;
							case 'image':
								$style = 'background-image:url('. esc_url( wp_get_attachment_thumb_url( $term_swatch ) ) .');';
								break;
							default:
							   $style = '';
						}
						$attributelabel = 'text' == $swatch_type ? $term_swatch : '';	        				
						$result = '<span class="rh-var-label label-non-selectable '.$swatch_type.'-label-rh" style="'. $style .'">'. $attributelabel .'</span>';
						$termname = esc_html( $term->name ).'</a>';
						$termwithswatch = $result.'<span class="rh_attr_name">'.$termname.'</span></a>';
						$termrel = 'rel="nofollow"';
						$termlinkclass = 'rel="nofollow" class="rh_swatch_filter rh_swatch_'.$swatch_type.'"';
	    				$term_html = str_replace($termname, $termwithswatch, $term_html);
	    				$term_html = str_replace($termrel, $termlinkclass, $term_html);
	    			}								
				}
			}
		}

		return $term_html;
	}	
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'rh_wc_dropdown_variation_attribute_options', 10, 2 );
add_filter('woocommerce_attribute', 'rh_show_swatch_in_attr', 10,3);
add_filter('woocommerce_layered_nav_term_html', 'rh_show_swatch_in_filters', 10, 4);


if(!function_exists('rh_wc_add_to_cart_params')){
	function rh_wc_add_to_cart_params($params, $handle) {
	    if('wc-add-to-cart' == $handle){
	        $params['i18n_added_to_cart'] = esc_html__( 'Has been added to cart.', 'rehub-theme' );
	    }
	    return $params;
	}
	add_filter('woocommerce_get_script_data', 'rh_wc_add_to_cart_params', 10, 2);
}


//////////////////////////////////////////////////////////////////
//VENDOR FUNCTION
//////////////////////////////////////////////////////////////////

if ( !function_exists('rh_show_vendor_info_single') ) {
	function rh_show_vendor_info_single($wrapperclass='') {
		do_action('rh_woo_single_product_vendor');
		$vendor_verified_label = $vacation_mode = $vacation_msg = '';
		$verified_vendor = $featured_vendor = false;		
		if( class_exists( 'WeDevs_Dokan' ) ) {
			$vendor_id = get_the_author_meta( 'ID' );
			$store_info = dokan_get_store_info( $vendor_id );
			$store_url = dokan_get_store_url( $vendor_id );
			$sold_by_label = apply_filters( 'dokan_sold_by_label', esc_html__( 'Sold by', 'rehub-theme' ) );
			$is_vendor = dokan_is_user_seller( $vendor_id );
			$store_name = esc_html( $store_info['store_name'] );
			$featured_vendor = get_user_meta( $vendor_id, 'dokan_feature_seller', true );
		}elseif (class_exists('WCMp')){
			$vendor_id = get_the_author_meta( 'ID' );
			$is_vendor = is_user_wcmp_vendor( $vendor_id );
			if($is_vendor){
				$vendorobj = get_wcmp_vendor($vendor_id);
				$store_url = $vendorobj->permalink;
				$store_name = $vendorobj->page_title;	
				$verified_vendor = get_user_meta($vendor_id, 'wcmp_vendor_is_verified', true);			
			}
			$wcmp_option = get_option("wcmp_frontend_settings_name");
			$sold_by_label = (!empty($wcmp_option['sold_by_text'])) ? $wcmp_option['sold_by_text'] : esc_html__( 'Sold by', 'rehub-theme' );
		}
		elseif (defined( 'wcv_plugin_dir' )) {
			$vendor_id = get_the_author_meta( 'ID' );
			$store_url = WCV_Vendors::get_vendor_shop_page( $vendor_id );
			$sold_by_label = get_option( 'wcvendors_label_sold_by' );
			$is_vendor = WCV_Vendors::is_vendor( $vendor_id );
			$store_name = WCV_Vendors::get_vendor_sold_by( $vendor_id );
			
			if ( class_exists( 'WCVendors_Pro' ) ) {
				$vendor_meta = array_map( function( $a ){ return $a[0]; }, get_user_meta($vendor_id ) );
				$verified_vendor = ( array_key_exists( '_wcv_verified_vendor', $vendor_meta ) ) ? $vendor_meta[ '_wcv_verified_vendor' ] : false;
				$vacation_mode = get_user_meta( $vendor_id , '_wcv_vacation_mode', true ); 
				$vacation_msg = ( $vacation_mode ) ? get_user_meta( $vendor_id , '_wcv_vacation_mode_msg', true ) : '';		
			}		
		}
		else{
			return false;
		}

		if($is_vendor){
			if ( $verified_vendor || $featured_vendor == 'yes' ) {
				$vendor_verified_label = '';
				if(function_exists('get_wcmp_vendor_verification_badge')){
					$badge_img = get_vendor_verification_settings('badge_img');
					if(!empty($badge_img)){
						$vendor_verified_label = get_wcmp_vendor_verification_badge( $vendor_id, array( 'height' => 20, 'width' => 20, 'class' => 'floatleft mr5 rtlml5' ) );
					}					
				}
				if(!$vendor_verified_label){
					$vendor_verified_label = '<i class="fas fa-shield-check" aria-hidden="true"></i>';
				}
			} 		
			$sold_by = sprintf( '<h5><a href="%s" class="wcvendors_cart_sold_by_meta">%s</a></h5>', $store_url, $store_name );
			
			/* HTML output */
			echo '<div class="vendor_store_details '.esc_attr($wrapperclass).'">';
			echo '<div class="vendor_store_details_image"><a href="'. $store_url  .'"><img src="'. rh_show_vendor_avatar( $vendor_id, 50, 50 ) .'" class="vendor_store_image_single" width=50 height=50 /></a></div>';
			echo '<div class="vendor_store_details_single">';
			echo '<div class="vendor_store_details_nameshop">';
			echo '<span class="vendor_store_details_label">'. $sold_by_label .'</span>';
			echo '<span class="vendor_store_details_title">'. $vendor_verified_label . $sold_by .'</span>';
			echo '</div>';

			if(class_exists( 'WeDevs_Dokan' ) && dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on'){
				echo '<span class="vendor_store_details_contact">';
				if(class_exists( 'BuddyPress' ) ) {
					echo '<a href="'. bp_core_get_user_domain( $vendor_id ) .'" class="vendor_store_owner_name"><span>'. get_the_author_meta('display_name') .'</span></a> ';
				}else{
					echo '<span class="vendor_store_owner_label">@ <span class="vendor_store_owner_name">'.get_the_author_meta('display_name') .'</span></span>';
				}

				$class = ( !is_user_logged_in() && rehub_option( 'userlogin_enable' ) == '1' ) ? ' act-rehub-login-popup' : '';						
				echo ' <a href="'.$store_url.'#dokan-form-contact-seller" class="vendor_store_owner_contactlink'.$class.'"><i class="far fa-envelope" aria-hidden="true"></i> <span>'. esc_html__('Ask owner', 'rehub-theme') .'</span></a>';									
				echo '</span>';					
			}
			elseif(is_active_widget( '', '', 'dc-vendor-quick-info')){
				echo '<span class="vendor_store_details_contact">';
				if(class_exists( 'BuddyPress' ) ) {
					echo '<a href="'. bp_core_get_user_domain( $vendor_id ) .'" class="vendor_store_owner_name"><span>'. get_the_author_meta('display_name') .'</span></a> ';
				}else{
					echo '<span class="vendor_store_owner_label">@ <span class="vendor_store_owner_name">'.get_the_author_meta('display_name') .'</span></span>';
				}
				$class = ( !is_user_logged_in() && rehub_option( 'userlogin_enable' ) == '1' ) ? ' act-rehub-login-popup' : '';						
				echo ' <a href="'.$store_url.'#wcmp-vendor-contact-widget-top" class="vendor_store_owner_contactlink'.$class.'"><i class="far fa-envelope" aria-hidden="true"></i> <span>'. esc_html__('Ask owner', 'rehub-theme') .'</span></a>';									
				echo '</span>';	
			}	
			elseif(class_exists( 'BuddyPress' ) ) {
				echo '<span class="vendor_store_details_contact"><span class="vendor_store_owner_label">@ </span>';
				echo '<a href="'. bp_core_get_user_domain( $vendor_id ) .'" class="vendor_store_owner_name"><span>'. get_the_author_meta('display_name') .'</span></a> ';
				if ( bp_is_active( 'messages' )){
					$link = (is_user_logged_in()) ? wp_nonce_url( bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=' . bp_core_get_username( $vendor_id) .'&ref='. urlencode(get_permalink())) : '#';
					$class = (!is_user_logged_in() && rehub_option('userlogin_enable') == '1') ? ' act-rehub-login-popup' : '';
						echo ' <a href="'.$link.'" class="vendor_store_owner_contactlink'.$class.'"><i class="far fa-envelope" aria-hidden="true"></i> <span>'. esc_html__('Ask owner', 'rehub-theme') .'</span></a>';			
				}
				echo '</span>';		
			}
			
			echo '</div></div>';
			if ($vacation_msg) :
				echo '<div class="wpsm_box green_type nonefloat_box"><div>'. $vacation_msg .'</div></div>';
			endif;
		}
	
	}
}

if ( !function_exists('rh_show_vendor_ministore') ) {
	function rh_show_vendor_ministore( $vendor_id, $label='' ) { 
		$totaldeals = count_user_posts( $vendor_id, $post_type = 'product' );
		$vendor_verified_label = '';
		$verified_vendor = $featured_vendor = false;
		
		if( class_exists( 'WeDevs_Dokan' ) ){
			$store_url = dokan_get_store_url( $vendor_id );
			$is_vendor = dokan_is_user_seller( $vendor_id );
			$store_info = dokan_get_store_info( $vendor_id );
			$store_name = esc_html( $store_info['store_name'] );
			$featured_vendor = get_user_meta( $vendor_id, 'dokan_feature_seller', true );
		}
		else {
			$store_url = WCV_Vendors::get_vendor_shop_page( $vendor_id );
			$is_vendor = WCV_Vendors::is_vendor( $vendor_id );
			$store_name = WCV_Vendors::get_vendor_sold_by( $vendor_id );
			if ( class_exists( 'WCVendors_Pro' ) ) {
				$vendor_meta = array_map( function( $a ){ return $a[0]; }, get_user_meta($vendor_id ) );
				$verified_vendor = ( array_key_exists( '_wcv_verified_vendor', $vendor_meta ) ) ? $vendor_meta[ '_wcv_verified_vendor' ] : false;
			}
		}
		
		if( $totaldeals > 0 ){
			if ( $verified_vendor || $featured_vendor == 'yes' ) {
				$vendor_verified_label = '<i class="far fa-check-square" aria-hidden="true"></i>';
			} 
			$sold_by = ( $is_vendor ) ? sprintf( '<h5><a href="%s" class="wcvendors_cart_sold_by_meta">%s</a></h5>', $store_url, $store_name ) : get_bloginfo( 'name' );
			
			/* HTML output */
			echo '<div class="vendor_store_in_bp">';
			echo '<div class="vendor-list-like">'. getShopLikeButton( $vendor_id ) .'</div>';
			echo '<div class="vendor_store_in_bp_image"><a href="'. $store_url .'"><img src="'. rh_show_vendor_avatar( $vendor_id, 80, 80 ) .'" class="vendor_store_image_single" width=80 height=80 /></a></div>';
			echo '<div class="vendor_store_in_bp_single">';
			echo '<span class="vendor_store_in_bp_label"><span class="vendor_store_owner_label">'. $label .'</span></span>';		
			echo '<span class="vendor_store_in_bp_title">'. $vendor_verified_label . $sold_by.'</span>';
			echo '</div>';
			echo '<div class="vendor_store_in_bp_last_products">';
				$totaldeals = $totaldeals - 4;
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 4,
					'author' => $vendor_id,
					'ignore_sticky_posts'=> true,
					'no_found_rows'=> true
				);
				$looplatest = new WP_Query($args);
				if ( $looplatest->have_posts() ){
					while ( $looplatest->have_posts() ) : $looplatest->the_post();
						echo '<a href="'. get_permalink( $looplatest->ID ) .'">';
							$showimg = new WPSM_image_resizer();
							$showimg->use_thumb = true;
							$showimg->height = 70;
							$showimg->width = 70;
							$showimg->crop = true;
							$showimg->no_thumb = rehub_woocommerce_placeholder_img_src('');
							$img = $showimg->get_resized_url();
							echo '<img src="'. $img .'" width=70 height=70 alt="'. get_the_title( $looplatest->ID ) .'"/>';
						echo '</a>';
					endwhile;
					echo '<a class="vendor_store_in_bp_count_pr" href="'. $store_url .'"><span>+'. $totaldeals .'</span></a>';
				}
				wp_reset_query();
			echo '</div>';
			echo '</div>';		
		}
	}
}

if ( !function_exists('rh_show_vendor_avatar') ) {
	function rh_show_vendor_avatar( $vendor_id, $width=150, $height=150 ) {
		if( !$vendor_id ) 
			return;
		$store_icon_url = '';
		if( class_exists( 'WeDevs_Dokan' ) ) {
			$store_info = dokan_get_store_info( $vendor_id );
			$gravatar_id = (!empty($store_info['gravatar_id'])) ? $store_info['gravatar_id'] : ''; 
			$gravatar_id = (!empty( $store_info['gravatar'])) ? $store_info['gravatar'] : $gravatar_id;

			if( !empty($gravatar_id) ) {
				$store_icon_src 	= wp_get_attachment_image_src($gravatar_id, array( 150, 150 ) );
				if ( is_array( $store_icon_src ) ) { 
					$store_icon_url = $store_icon_src[0]; 
				}			
			}
		}
		elseif (class_exists('WCMp')){
			$vendorobj = get_wcmp_vendor($vendor_id);
			if(!empty($vendorobj)){
				$store_icon_url = $vendorobj->get_image();
			}
						
		}		
		elseif(defined( 'wcv_plugin_dir' )) {
			if( class_exists( 'WCVendors_Pro' ) ) {
				$store_icon_src 	= wp_get_attachment_image_src( get_user_meta( $vendor_id, '_wcv_store_icon_id', true ), array( 150, 150 ) );
				if ( is_array( $store_icon_src ) ) { 
					$store_icon_url= $store_icon_src[0]; 
				}
			}
			else{
				$store_icon_src 	= wp_get_attachment_image_src( get_user_meta( $vendor_id, 'rh_vendor_free_logo', true ), array( 150, 150 ) );
				if ( is_array( $store_icon_src ) ) { 
					$store_icon_url= $store_icon_src[0]; 
				}
			}
		}
		elseif(defined( 'WCFMmp_TOKEN' )) {
			$store_user = wcfmmp_get_store( $vendor_id );
			$store_icon_url = $store_user->get_avatar();
		}
		else{
			return;
		}
		if( !$store_icon_url ) {
			if( rehub_option('wcv_vendor_avatar') !='' ){
				$store_icon_url = esc_url( rehub_option( 'wcv_vendor_avatar' ) );
			}
			else{
				$store_icon_url = get_template_directory_uri() . '/images/default/wcvendoravatar.png';
			}	
		}
		$showimg = new WPSM_image_resizer();
		$showimg->src = $store_icon_url;
		$showimg->use_thumb = false;
		$showimg->height = $height;
		$showimg->width = $width;
		$showimg->crop = true;           
		$img = $showimg->get_resized_url();
		return $img;	
	}
}

if( !function_exists( 'rh_show_vendor_bg' ) ) {
	function rh_show_vendor_bg( $vendor_id ) {
		$store_bg_styles = '';
		if( !$vendor_id )
			return;
		if( class_exists( 'WeDevs_Dokan' ) ) {
			$store_info = dokan_get_store_info( $vendor_id );
			$banner_id = (!empty($store_info['banner_id'])) ? $store_info['banner_id'] : ''; 
			$banner_id = (!empty( $store_info['banner'])) ? $store_info['banner'] : $banner_id;
			$store_bg = wp_get_attachment_url( $banner_id);

			if( $store_bg ) {
				$store_bg_styles = 'background-image: url('. $store_bg .'); background-repeat: no-repeat;background-size: cover;';
			}
		}
		elseif (class_exists('WCMp')){
			$vendorobj = get_wcmp_vendor($vendor_id);
			$store_bg = $vendorobj->get_image('banner');
			if($store_bg){
				$store_bg_styles = 'background-image: url('. $store_bg .'); background-repeat: no-repeat;background-size: cover;';
			}
		}	
		elseif(defined( 'WCFMmp_TOKEN' )) {
			$store_user = wcfmmp_get_store( $vendor_id );
			$store_bg = $store_user->get_banner();
			if( !$store_bg ) {
				global $WCFMmp;
				$store_bg = isset( $WCFMmp->wcfmmp_marketplace_options['store_default_banner'] ) ? $WCFMmp->wcfmmp_marketplace_options['store_default_banner'] : $WCFMmp->plugin_url . 'assets/images/default_banner.jpg';
				$store_bg = apply_filters( 'wcfmmp_store_default_bannar', $store_bg );
			}
			$store_bg_styles = 'background-image: url('. $store_bg .'); background-repeat: no-repeat;background-size: cover;';
		}	
		elseif(defined( 'wcv_plugin_dir' )) {
			if ( class_exists( 'WCVendors_Pro' ) ) {
				$store_banner_src 	= wp_get_attachment_image_src( get_user_meta( $vendor_id, '_wcv_store_banner_id', true ), 'full'); 
				if ( is_array( $store_banner_src ) ) { 
					$store_bg= $store_banner_src[0]; 
				}
				else { 
					//  Getting default banner 
					$default_banner_src = WCVendors_Pro::get_option( 'default_store_banner_src' ); 
					$store_bg= $default_banner_src; 
				}	
				$store_bg_styles = 'background-image: url('.$store_bg.'); background-repeat: no-repeat;background-size: cover;';	
			}
			else {
				$store_banner_src  = wp_get_attachment_image_src( get_user_meta( $vendor_id, 'rh_vendor_free_header', true ), 'full');
				if ( is_array( $store_banner_src ) ) { 
					$store_bg= $store_banner_src[0]; 
					$store_bg_styles = 'background-image: url('.$store_bg.'); background-repeat: no-repeat;background-size: cover;';
				}
			}
		}
		else{
			return;
		}
		if( !$store_bg_styles ) {
			if( rehub_option('wcv_vendor_bg') !='' ){
				$store_bg = esc_url(rehub_option('wcv_vendor_bg'));
				$store_bg_styles = 'background-image: url('.$store_bg.'); background-repeat: no-repeat;background-size: cover;';
			}
			else{
				$store_bg_styles = 'background-image: url('.get_template_directory_uri() . '/images/default/brickwall.png); background-repeat:repeat;';
			}	
		}		
		return $store_bg_styles;	
	}
}

if (!function_exists('rh_change_product_query')){
	function rh_change_product_query($q){
    	if (empty($q->query_vars['wc_query']))
			return;
		
		$search_string = isset($_GET['rh_wcv_search']) ? esc_html($_GET['rh_wcv_search']) : '';
		$cat_string = (isset($_GET['rh_wcv_vendor_cat'])) ? esc_html($_GET['rh_wcv_vendor_cat']) : '';
		
		if($search_string){
			$q->set( 's', $search_string);
		}
		if($cat_string){
			$catarray = array(
				array(
					'taxonomy' => 'product_cat', 
					'terms' => array($cat_string), 
					'field' => 'term_id'				
					)
				);
			$q->set('tax_query', $catarray);
		}
		if (is_tax('store')){ //Here we change number of posts in brand store archives
			$q->set( 'posts_per_page', 30);
		}	
	}
}

if (rehub_option('wooregister_xprofile') == 1){

	//Synchronization with Woocommerce register form and Xprofiles
	add_action('woocommerce_register_form','rh_add_xprofile_to_woocommerce_register');
	add_action('wcvendors_settings_before_paypal','rh_add_xprofile_to_wcvendor');
	add_action('dokan_settings_form_bottom', 'rh_add_xprofile_to_dokan');

	function rh_add_xprofile_to_woocommerce_register() {
	if ( class_exists( 'BuddyPress' ) ) {
		?>
		<?php if ( bp_is_active( 'xprofile' ) ) : ?>
			<div id="xp-woo-profile-details-section">
				<?php if ( bp_has_profile( array( 'profile_group_id' => 1, 'fetch_field_data' => false ) ) ) : while ( bp_profile_groups() ) : bp_the_profile_group(); ?>
					<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
						<div<?php bp_field_css_class( 'editfield form-row' ); ?>>
							<?php
								$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
								$field_type->edit_field_html();
							?>
						</div>
					<?php endwhile; ?>
					<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_field_ids(); ?>" />
				<?php endwhile; endif; ?>
				<?php do_action( 'bp_signup_profile_fields' ); ?>
			</div><!-- #profile-details-section -->
			<?php do_action( 'bp_after_signup_profile_fields' ); ?>
		<?php endif; ?>
		<?php
	}
	}

	function rh_add_xprofile_to_wcvendor() {
	if ( class_exists( 'BuddyPress' ) ) {
		?>
		<?php if ( bp_is_active( 'xprofile' ) ) : ?>
			<div id="xp-wcvendor-profile">
				<?php $user_id = get_current_user_id();?>
				<?php if ( bp_has_profile( array( 'user_id'=> $user_id, 'profile_group_id' => 1, 'fetch_field_data' => true, 'fetch_fields'=>true ) ) ) : while ( bp_profile_groups() ) : bp_the_profile_group(); ?>
					<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
						<div<?php bp_field_css_class( 'editfield form-row' ); ?>>
							<?php
								$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
								$field_type->edit_field_html(array( 'user_id'=> $user_id));
							?>
						</div>
					<?php endwhile; ?>
					<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_field_ids(); ?>" />
				<?php endwhile; endif; ?>
				<?php do_action( 'bp_signup_profile_fields' ); ?>
			</div><!-- #profile-details-section -->
			<?php do_action( 'bp_after_signup_profile_fields' ); ?>
		<?php endif; ?>
		<?php
	}
	}	

	function rh_add_xprofile_to_dokan( $user_id ) {
		if ( class_exists( 'BuddyPress' ) ) {
			?>
			<?php if ( bp_is_active( 'xprofile' ) ) : ?>
			<!-- Xprofile fields -->
			<div class="dokan-form-group xprofile-area">
			<h2><?php esc_html_e( 'Extended Profile', 'rehub-theme' ); ?></h2>
				<?php if ( bp_has_profile( array( 'user_id'=> $user_id, 'profile_group_id' => 1, 'hide_empty_fields' => false, 'fetch_field_data' => true, 'fetch_fields'=>true ) ) ) : ?>
					<?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>
						<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
						<div class="dokan-w6 dokan-text-left">
							<div <?php bp_field_css_class( 'editfield form-row' ); ?>>
								<?php
									$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
									$field_type->edit_field_html( array( 'user_id'=> $user_id ) );
								?>
								<p class="description"><?php bp_the_profile_field_description(); ?></p>
							</div>
						</div>
						<?php endwhile; ?>
						<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_field_ids(); ?>" />
					<?php endwhile; ?>
				<?php endif; ?>
				<?php do_action( 'bp_signup_profile_fields' ); ?>
			</div>
			<?php do_action( 'bp_after_signup_profile_fields' ); ?>
				<script type="text/javascript">
				jQuery('[aria-required]').each(function() {
					jQuery(this).prop('required',true);
				});
				</script>
			<?php endif; ?>
			<?php
		}
	}	

	//Validating required Xprofile fields
	add_action( 'woocommerce_register_post', 'rh_validate_xprofile_to_woocommerce_register', 10, 3 );
	function rh_validate_xprofile_to_woocommerce_register( $username, $email, $validation_errors ) {
		if ( class_exists( 'BuddyPress' ) ) {
			if (!empty($_POST['signup_profile_field_ids'])){
				$user_error_req_fields = array();
				$signup_profile_field_ids = explode(',', $_POST['signup_profile_field_ids']);
				foreach ((array)$signup_profile_field_ids as $field_id) {
					if ( ! isset( $_POST['field_' . $field_id] ) ) {
						if ( ! empty( $_POST['field_' . $field_id . '_day'] ) && ! empty( $_POST['field_' . $field_id . '_month'] ) && ! empty( $_POST['field_' . $field_id . '_year'] ) ) {
							// Concatenate the values.
							$date_value = $_POST['field_' . $field_id . '_day'] . ' ' . $_POST['field_' . $field_id . '_month'] . ' ' . $_POST['field_' . $field_id . '_year'];

							// Turn the concatenated value into a timestamp.
							$_POST['field_' . $field_id] = date( 'Y-m-d H:i:s', strtotime( $date_value ) );
							
						}
					}
					// Create errors for required fields without values.
					if ( xprofile_check_is_required_field( $field_id ) && empty( $_POST[ 'field_' . $field_id ] ) && ! bp_current_user_can( 'bp_moderate' ) ){
						$field_data = xprofile_get_field($field_id );
						if(is_object($field_data)){
							$user_error_req_fields[]= $field_data->name;
						}		
					}
				}
				if(!empty($user_error_req_fields)){
		        	$validation_errors->add( 'billing_first_name_error', esc_html__( ' Next fields are required: ', 'rehub-theme' ).implode(', ',$user_error_req_fields) );									
				}			
			}
		}	 
	    return $validation_errors;
	} 	

	//Updating use meta after registration successful registration
	add_action('woocommerce_created_customer','rh_save_xprofile_to_woocommerce_register');
	add_action( 'wcvendors_shop_settings_saved', 'rh_save_xprofile_to_woocommerce_register' );
	add_action( 'dokan_store_profile_saved', 'rh_save_xprofile_to_woocommerce_register' );
	function rh_save_xprofile_to_woocommerce_register($user_id) {
		if (!empty($_POST['signup_profile_field_ids'])){
			$signup_profile_field_ids = explode(',', $_POST['signup_profile_field_ids']);
			foreach ((array)$signup_profile_field_ids as $field_id) {
				if ( ! isset( $_POST['field_' . $field_id] ) ) {
					if ( ! empty( $_POST['field_' . $field_id . '_day'] ) && ! empty( $_POST['field_' . $field_id . '_month'] ) && ! empty( $_POST['field_' . $field_id . '_year'] ) ) {
						// Concatenate the values.
						$date_value = $_POST['field_' . $field_id . '_day'] . ' ' . $_POST['field_' . $field_id . '_month'] . ' ' . $_POST['field_' . $field_id . '_year'];

						// Turn the concatenated value into a timestamp.
						$_POST['field_' . $field_id] = date( 'Y-m-d H:i:s', strtotime( $date_value ) );
						
					}
				}
				if(!empty($_POST['field_' . $field_id])){
					$field_val = sanitize_text_field($_POST['field_' . $field_id]);
					xprofile_set_field_data($field_id, $user_id, $field_val);
					$visibility_level = ! empty( $_POST['field_' . $field_id . '_visibility'] ) ? $_POST['field_' . $field_id . '_visibility'] : 'public';
					xprofile_set_field_visibility_level( $field_id, $user_id, $visibility_level );					
				}			
			}
		}
	}	
}

//////////////////////////////////////////////////////////////////
//Custom Currency for main product price for Content Egg
//////////////////////////////////////////////////////////////////
if(rehub_option('ce_custom_currency')){
	if(defined('\ContentEgg\PLUGIN_PATH')){

		$currency_code = rehub_option('ce_custom_currency');
		$woocurrency = get_woocommerce_currency();
		if($currency_code != $woocurrency){
			add_filter('woocommerce_get_price_html','rh_ce_multicurrency', 10, 2);
			if(!function_exists('rh_ce_multicurrency')){
				function rh_ce_multicurrency($price, $product){
					//$itemsync = \ContentEgg\application\WooIntegrator::getSyncItem($postid);
					$currency_code = rehub_option('ce_custom_currency');
					$woocurrency = get_woocommerce_currency();					
					$currency_rate = \ContentEgg\application\helpers\CurrencyHelper::getCurrencyRate($woocurrency, $currency_code);
					if (!$currency_rate) $currency_rate = 1;					
					$out = '';
					if ( '' === $product->get_price() ) {
						$out = apply_filters( 'woocommerce_empty_price_html', '', $product);
					}
					elseif($product->is_on_sale()){
						$out = '<del><span class="woocommerce-Price-amount amount">'.ContentEgg\application\helpers\TemplateHelper::formatPriceCurrency($product->get_regular_price()*$currency_rate, $currency_code, '<span class="woocommerce-Price-currencySymbol">', '</span>').'</span></del> <ins><span class="woocommerce-Price-amount amount">'.ContentEgg\application\helpers\TemplateHelper::formatPriceCurrency($product->get_price()*$currency_rate, $currency_code, '<span class="woocommerce-Price-currencySymbol">', '</span>').'</span></ins>';
					}else{
						$out = '<span class="woocommerce-Price-amount amount">'.ContentEgg\application\helpers\TemplateHelper::formatPriceCurrency($product->get_price()*$currency_rate, $currency_code, '<span class="woocommerce-Price-currencySymbol">', '</span>').'</span>';						
					}				
					return $out;
				}
			}			
		}
	}
}

//////////////////////////////////////////////////////////////////
//GMW to VENDOR PLUGINS
//////////////////////////////////////////////////////////////////
function rh_gmw_vendor_location_synch( $vendor_id, $data = '' ){
	if( !function_exists('gmw_update_user_location') )
		return;

	if( empty( $vendor_id ) ){
	    $vendor_id = get_current_user_id();
	}	

 	$google_server_key = gmw_get_option( 'api_providers', 'google_maps_server_side_api_key', '' );
	
	if( empty( $google_server_key ) ) 
		return;
	
	$data = empty( $data ) ? (array)$_POST : $data;

	if( empty( $data ) )
		return;

	foreach( $data as $key => $value ){
		$key = sanitize_key($key);
		$data[$key] = sanitize_text_field($value);
	}	
	
	$addressArray = array();
	$addressString = '';
	
	// WC Vendors
	if( class_exists('WCVendors_Pro') ){
		If( !empty($data['_wcv_store_country']) AND !empty($data['_wcv_store_city']) ){
			$addressArray['street'] = $data['_wcv_store_address1'];
			$addressArray['apt'] = $data['_wcv_store_address2'];
			$addressArray['city'] = $data['_wcv_store_city'];
			$addressArray['state'] = $data['_wcv_store_state'];
			$addressArray['country'] = $data['_wcv_store_country'];
			$addressArray['zipcode'] = $data['_wcv_store_postcode'];
		}
	}
	// WC Marketplace
	elseif( class_exists('WCMp') ){
		if( !empty($data['_store_location']) AND is_string($data['_store_location']) ) {
			$addressString = $data['_store_location'];
		}
		elseif( !empty($data['vendor_country']) && !empty($data['vendor_city']) ){
			$addressArray['street'] = $data['vendor_address_1'];
			$addressArray['city'] = $data['vendor_city'];
			$addressArray['state'] = $data['vendor_state'];
			$addressArray['country'] = $data['vendor_country'];
			$addressArray['zipcode'] = $data['vendor_postcode'];
		}
	}
	// WC lovers MarketPlace OR Dokan
	elseif( defined('WCFMmp_TOKEN') OR class_exists('WeDevs_Dokan') ){
		$data_address = isset($data['dokan_store_address']) ? $data['dokan_store_address'] : $data['address']; // check if the location was updatet by admin in the Dokan plugin
		if( !empty($data['find_address']) AND is_string($data['find_address']) ){
			$addressString = $data['find_address'];
		}
		elseif( !empty($data_address['country']) AND !empty($data_address['city']) ){
			$addressArray['street'] = $data_address['street_1'];
			$addressArray['apt'] = $data_address['street_2'];
			$addressArray['city'] = $data_address['city'];
			$addressArray['state'] = $data_address['state'];
			$addressArray['country'] = $data_address['country'];
			$addressArray['zipcode'] = $data_address['zip'];
		}
	}
	
	if( empty( $addressArray ) AND empty( $addressString ) )
		return;
		
	$address = empty( $addressString ) ? $addressArray : $addressString;

	gmw_update_user_location( $vendor_id, $address, true );
}
add_action( 'wcv_pro_store_settings_saved', 'rh_gmw_vendor_location_synch' );
add_action( 'before_wcmp_vendor_dashboard', 'rh_gmw_vendor_location_synch' );
add_action( 'wcfm_vendor_settings_update', 'rh_gmw_vendor_location_synch', 10, 2 );
add_action( 'dokan_store_profile_saved', 'rh_gmw_vendor_location_synch', 10, 2 );
add_action( 'edit_user_profile_update', 'rh_gmw_vendor_location_synch' );

//////////////////////////////////////////////////////////////////
//WC Vendor FUNCTIONS
//////////////////////////////////////////////////////////////////

if (defined('wcv_plugin_dir')) {	
	if ( class_exists( 'WCVendors_Pro' ) ) {
		remove_action( 'woocommerce_before_single_product', array($wcvendors_pro->wcvendors_pro_vendor_controller, 'store_single_header'));		
		remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9 );
		remove_action( 'woocommerce_product_meta_start', array( 'WCV_Vendor_Cart', 'sold_by_meta' ), 10, 2 );
		add_action( 'rehub_vendor_show_action', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9);
		add_action( 'wcvendors_settings_before_form', 'rh_show_gmw_form_before_wcvendor');
	}
	else{
		add_action('wcvendors_before_dashboard', 'rehub_woo_wcv_before_dash');
		add_action('wcvendors_after_dashboard', 'rehub_woo_wcv_after_dash');
		remove_action( 'woocommerce_before_single_product', array('WCV_Vendor_Shop', 'vendor_mini_header'));
		remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9 );
		remove_action( 'woocommerce_product_meta_start', array( 'WCV_Vendor_Cart', 'sold_by_meta' ), 10, 2 );
		add_action( 'rehub_vendor_show_action', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9);
		add_filter('wcv_dashboard_nav_items', 'wcv_add_custom_submit_links');
		add_filter('wcv_dashboard_nav_item_classes', 'rhwcv_dashboard_nav_item_classes', 10, 2);
	}
	remove_action( 'woocommerce_before_main_content', array('WCV_Vendor_Shop', 'vendor_main_header'), 20 );
	remove_action( 'woocommerce_before_main_content', array('WCV_Vendor_Shop', 'shop_description'), 30 );
	if( !class_exists('WCVendors_Pro') && class_exists('WC_Vendors') ) {
		require_once ( locate_template( 'inc/wcvendor/wc-vendor-free-brand/class-shop-branding.php' ) );
		
		function wcv_add_custom_submit_links($items){
			if (rehub_option('url_for_add_product') && !empty($items['submit_link'])){
				unset($items['submit_link']);
				$items['submit_link'] = array(
					'url'    => esc_url(rehub_option('url_for_add_product')),
					'label'  => esc_html__('Add New Product', 'rehub-theme'),
					'target' => '_top',
				);
			}
			if (rehub_option('url_for_edit_product') && !empty($items['edit_link'])){
				unset($items['edit_link']);
				$items['edit_link']   = array(
					'url'    => esc_url(rehub_option('url_for_edit_product')),
					'label'  => esc_html__('Edit Products', 'rehub-theme'),
					'target' => '_top',
				);				
			}
			return $items;			
		}
		function rhwcv_dashboard_nav_item_classes($classes, $item_id){
			unset ($classes[0]);
			return $classes;
		}
	}			
} 

//////////////////////////////////////////////////////////////////
//DOKAN FUNCTIONS
//////////////////////////////////////////////////////////////////

if( class_exists( 'WeDevs_Dokan' ) ) {

	add_action('dokan_dashboard_wrap_before', 'rh_dokan_edit_page_before', 9);
	add_action('dokan_dashboard_wrap_after', 'rh_dokan_edit_page_after', 9);
	add_action('dokan_edit_product_wrap_before', 'rh_dokan_edit_page_before');
	add_action('dokan_edit_product_wrap_after', 'rh_dokan_edit_page_after');

	
	function rh_dokan_edit_page_before(){
		echo '<div class="rh-container">';
	}
	function rh_dokan_edit_page_after(){
		echo '</div>';
	}	
	
	/* 
	 * Set defailt theme value for banner sizes
	 */
	 function custom_dokan_set_banner_size() {
		$general_settings = get_option( 'dokan_general' );
		
		if( is_array($general_settings) && empty( $general_settings['store_banner_width'] ) ) {
			$general_settings['store_banner_width'] = 1900;
			$theme_width = true;
		} else {
			$theme_width = false;
		}
			
        if( is_array($general_settings) && empty( $general_settings['store_banner_height'] ) ) {
			$general_settings['store_banner_height'] = 300;
			$theme_height = true;
		} else {
			$theme_height = false;
		}
			
		if( $theme_width AND $theme_height )
			update_option( 'dokan_general', $general_settings );
		return false;
	 }
	 add_action( 'init', 'custom_dokan_set_banner_size' );
	 
	/* 
	 * Change store map description in plugin settings
	 */
	function custom_dokan_admin_settings( $settings_fields ){
		$settings_fields['dokan_general']['store_map']['desc']  = esc_html__( 'Enable showing link to Store location map on store', 'rehub-theme' );
			unset($settings_fields['dokan_general']['enable_theme_store_sidebar']);

		return $settings_fields;
	}
	add_filter( 'dokan_settings_fields', 'custom_dokan_admin_settings' );

	/* 
	 * Remove while Appearance tab in plugin settings
	 */
	function custom_dokan_remove_section($settings_fields){
		if(!empty($settings_fields) && is_array($settings_fields)){
			if(isset($settings_fields['dokan_appearance']['store_header_template'] )){
				unset($settings_fields['dokan_appearance']['store_header_template']);
			}
		}
        return $settings_fields;
	}
	add_filter( 'dokan_settings_fields', 'custom_dokan_remove_section' );

	/* 
	 * Change URL and Title of the About store tab 
	 */
	function custom_dokan_toc_url( $tabs ){
		$tabs['terms_and_conditions'] = array(
			'title' => apply_filters( 'dokan_about_store_title', esc_html__( 'Terms and Conditions', 'rehub-theme' ) ),
			'url'   => '#vendor-about'
		);
		return $tabs;
	}
	add_filter( 'dokan_store_tabs', 'custom_dokan_toc_url' );

	/* 
	 * Output Sold by <store_name> label in loop
	 */
	function dokan_loop_sold_by() {
		$vendor_id = get_the_author_meta( 'ID' );
		$store_info = dokan_get_store_info( $vendor_id );
		$sold_by = dokan_is_user_seller( $vendor_id )
			? sprintf( '<a href="%s">%s</a>', dokan_get_store_url( $vendor_id ), esc_html( $store_info['store_name'] ) )
			: get_bloginfo( 'name' );
		?>
		<small class="wcvendors_sold_by_in_loop"><span><?php echo apply_filters( 'dokan_sold_by_label', esc_html__( 'Sold by', 'rehub-theme' ) ); ?></span> <?php echo ''.$sold_by; ?></small><br />
		<?php
	}
	add_action( 'rehub_vendor_show_action', 'dokan_loop_sold_by' );
}

//////////////////////////////////////////////////////////////////
//WC Marketplace Functions
//////////////////////////////////////////////////////////////////

if( class_exists('WCMp')) {

	add_action('init', 'wcmp_remove_rh_hook_vendor', 11);
	add_action('rehub_vendor_show_action', 'wcmprh_loop_sold_by');
	add_filter('settings_vendor_dashboard_tab_options', 'wcmp_remove_rh_vendor_dashboard_template_settings');
	add_filter('is_vendor_add_external_url_field', 'rh_wcmp_add_external_url_field', 10, 2); //filter adds an external URL of vendor store
	add_action('widget_wcmp_quick_info_top', 'rh_anchor_vendor_contact_widget');
	add_action( 'wcmp_frontend_enqueue_scripts', 'rh_add_theme_style_wcmp' );
	add_filter('wcmp_frontend_dash_upload_script_params', 'rh_change_crop_for_wcmp');

	function rh_change_crop_for_wcmp($image_script_params){
		$image_script_params['default_logo_ratio'] = array(150,150);
		return $image_script_params;
	}

	function rh_add_theme_style_wcmp() {
		$theme_css = "#logo_mobile_wrapper, #rhmobpnlcustom{display:none}";
		wp_add_inline_style( 'vandor-dashboard-style', $theme_css );
	}

	function rh_anchor_vendor_contact_widget(){
		echo '<div id="wcmp-vendor-contact-widget-top"></div>';
	}
	function wcmp_remove_rh_hook_vendor(){
   		global $WCMp;
   		remove_action( 'woocommerce_product_meta_start', array( $WCMp->vendor_caps, 'wcmp_after_add_to_cart_form' ), 25);
   		remove_action( 'woocommerce_after_shop_loop_item_title', array( $WCMp->vendor_caps, 'wcmp_after_add_to_cart_form' ), 30);
   		//remove_action( 'woocommerce_after_shop_loop', array( $WCMp->review_rating, 'wcmp_seller_review_rating_form' ), 30);
	}
	function wcmp_remove_rh_vendor_dashboard_template_settings($settings_tab_options){
		if(isset($settings_tab_options['sections']['wcmp_vendor_shop_template']['fields']['wcmp_vendor_shop_template'])){
			unset($settings_tab_options['sections']['wcmp_vendor_shop_template']['fields']['wcmp_vendor_shop_template']);
		}
		return $settings_tab_options;
	}
	function rh_wcmp_add_external_url_field($status, $user_id = ''){
		return true;
	}
	function wcmprh_loop_sold_by(){
		global $WCMp, $post;
		if ('Enable' === get_wcmp_vendor_settings('sold_by_catalog', 'general') && apply_filters('wcmp_sold_by_text_after_products_shop_page', true, $post->ID)){
			$multivendor_product = $WCMp->product->get_multiple_vendors_array_for_single_product($post->ID);
			$vendor_id = get_the_author_meta( 'ID' );
			$is_vendor = is_user_wcmp_vendor( $vendor_id );
			$vendor_verified_label='';
			if($is_vendor && empty($multivendor_product['more_product_array'])){
				$vendor = get_wcmp_vendor($vendor_id);
				$store_url = $vendor->permalink;
				$store_name = $vendor->page_title; 
				$sold_by = sprintf('<a href="%s">%s</a>', $store_url, esc_html($store_name));
				$verified_vendor = get_user_meta($vendor_id, 'wcmp_vendor_is_verified', true);	
				if($verified_vendor){
					$vendor_verified_label = '<i class="fas fa-shield-check greencolor"></i> ';
				}
			}elseif(!empty($multivendor_product['more_product_array'])){
				$sold_by = apply_filters('rh_sold_by_multivendor', esc_html__('Multiple vendor', 'rehub-theme'), $multivendor_product['more_product_array']);
			}else{
				$sold_by = apply_filters('rh_sold_by_site', get_bloginfo('name'));
			}
			$sold_by_text = apply_filters('wcmp_sold_by_text', esc_html__('Sold By', 'rehub-theme'));
			?><small class="wcvendors_sold_by_in_loop"><span><?php echo ''.$sold_by_text ?></span> <?php echo ''.$vendor_verified_label; echo ''.$sold_by; ?></small><br /><?php
		}
	}
	add_filter('wcmp_vendor_dashboard_nav', 'rh_wcmp_vendor_dashboard_nav' );
	if(!function_exists('rh_wcmp_vendor_dashboard_nav')) {
		function rh_wcmp_vendor_dashboard_nav($vendor_nav) {
			if(class_exists('WCFM'))
				return $vendor_nav;		
			if(current_user_can('edit_products')) {
				$userlogin_submit_page = rehub_option('url_for_add_product');
				$userlogin_edit_page = rehub_option('url_for_edit_product');
				if(!empty($userlogin_submit_page)) {
					$vendor_nav['vendor-products']['submenu']['add-new-product'] = array(
						'label' => esc_html__('Add Product', 'rehub-theme'),
						'url' => esc_url($userlogin_submit_page),
						'capability' => apply_filters('wcmp_vendor_dashboard_menu_add_new_product_capability', 'edit_products'), 
						'position' => 10, 
						'link_target' => '_self'
					);
					unset($vendor_nav['vendor-products']['submenu']['add-product']);
				}
				if(!empty($userlogin_edit_page)) {
					$vendor_nav['vendor-products']['submenu']['edit-products'] = array(
						'label' => esc_html__('Products', 'rehub-theme'),
						'url' => esc_url($userlogin_edit_page),
						'capability' => apply_filters('wcmp_vendor_dashboard_menu_vendor_products_capability', 'edit_products'), 
						'position' => 20, 
						'link_target' => '_self'
					);
					unset($vendor_nav['vendor-products']['submenu']['products']);
				}
			} else {
				unset($vendor_nav['vendor-products']);
			}
		return $vendor_nav;
		}
	}
	add_filter( 'wcmp_vendor_dashboard_header_nav', 'rh_wcmp_vendor_dashboard_header_nav', 10, 1 );
	function rh_wcmp_vendor_dashboard_header_nav( $header_nav ) {
		$userlogin_submit_page = rehub_option('url_for_add_product');
		if($userlogin_submit_page){
			unset($header_nav['add-product']); //remove Add Product Link
		}
		return $header_nav;
	}	
	if(class_exists('WCMP_Vendor_Vacation')){
		add_action('rhwoo_template_single_add_to_cart', 'rh_wcmp_vacation_addon_fix', 9);
	    function rh_wcmp_vacation_addon_fix() {
	        global $product;
	        $vendor_product = get_wcmp_product_vendors($product->get_id());
	        if ($vendor_product) {
				remove_action( 'rhwoo_template_single_add_to_cart', 'woocommerce_template_single_add_to_cart' );
	        }
	    }		
	}	
}

//////////////////////////////////////////////////////////////////
//WCFM vendor functions
//////////////////////////////////////////////////////////////////

if(defined( 'WCFMmp_TOKEN' )){
	add_filter('wcfm_is_allow_font_awesome', '__return_false');
	add_filter('wcfmmp_store_sidebar_args', 'rh_wcfm_sidebar_args');
	function rh_wcfm_sidebar_args(){
		return array(
			'id'            => 'sidebar-wcfmmp-store',
			'name'          => esc_html__( 'Vendor store page sidebar', 'rehub-theme' ),
			'before_widget' => '<div class="rh-cartbox widget"><div>',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="widget-inner-title rehub-main-font">',
			'after_title'   => '</div>',
		);
	}
	add_filter('wcfmvm_membership_color_setting_options', 'rh_wcfm_member_color_settings', 11);
	function rh_wcfm_member_color_settings($args){
		$args['wcfmvm_field_table_head_bg_color']['default'] = '#ffffff';
		$args['wcfmvm_field_table_head_price_color']['default'] = '#000000';
		$args['wcfmvm_field_table_border_color']['default'] = '#e0e0e0';
		$args['wcfmvm_field_table_bg_heighlighter_color']['default'] = '#fb7203';
		$args['wcfmvm_field_table_bg_heighlighter_color']['element'] = '#wcfm-main-contentainer .wcfm_featured_membership_box .wcfm_membership_box_head .wcfm_membership_title, #wcfm-main-contentainer .wcfm_membership_box_wrraper .wcfm_membership_box_head .wcfm_membership_featured_top';
		$args['wcfmvm_field_table_bg_heighlighter_color']['style2'] = 'color';
		$args['wcfmvm_field_table_bg_heighlighter_color']['element2'] = '#wcfm-main-contentainer .wcfm_featured_membership_box .wcfm_membership_box_head .wcfm_membership_price .amount';
		$args['wcfmvm_field_table_bg_heighlighter_color']['default2'] = '#fb7203';
		$args['wcfmvm_field_table_head_title_color']['default'] = '#ffffff';
		$args['wcfmvm_field_table_head_title_color']['element'] = '#wcfm-main-contentainer .wcfm_membership_box_wrraper .wcfm_membership_box_head .wcfm_membership_featured_top, #wcfm-main-contentainer .wcfm_membership_box_head .wcfm_membership_title';
		$args['wcfmvm_field_table_head_description_color']['default'] = '#444444';
		$args['wcfmvm_field_table_head_price_desc_color']['default'] = '#888888';
		$args['wcfmvm_field_button_color']['default'] = rehub_option('rehub_btnoffer_color');
		$args['wcfmvm_field_base_highlight_color']['default'] = '#009f0d';
		$args['wcfmvm_field_preview_plan_bg_color']['default'] = '#ffffff';
		unset($args['wcfmvm_field_preview_plan_text_color']['element3']);
		return $args;
	}
	add_filter('wcfm_color_setting_options', 'rh_wcfm_dash_color_settings', 11);
	function rh_wcfm_dash_color_settings($args){
		$activebg = rehub_option('rehub_custom_color') ? rehub_option('rehub_custom_color') : '#fb7203';
		$btncolor = rehub_option('rehub_btnoffer_color') ? rehub_option('rehub_btnoffer_color') : '#00b90f';
		$btncolortext = rehub_option('rehub_btnoffer_color_text') ? rehub_option('rehub_btnoffer_color_text') : '#ffffff';
		$linkcolor = rehub_option('rehub_color_link') ? rehub_option('rehub_color_link') : '#0099cc';
		$args['wcfm_field_menu_icon_active_bg_color']['default'] = $activebg;
		$args['wcfm_field_menu_icon_active_bg_color']['element2'] = '#wcfm_menu .wcfm_menu_items:hover a span.wcfmfas';
		$args['wcfm_field_button_color']['default'] = $btncolor;
		$args['wcfm_field_base_highlight_color']['default'] = $activebg;
		$args['wcfm_field_button_text_color']['default'] = $btncolortext;
		$args['wcfm_field_secondary_font_color']['default'] = $linkcolor;
		return $args;
	}
	add_filter('wcfmmp_store_color_setting_options', 'rh_wcfm_store_color_settings', 11);
	function rh_wcfm_store_color_settings($args){
		$activebg = rehub_option('rehub_custom_color') ? rehub_option('rehub_custom_color') : '#fb7203';
		$btncolor = rehub_option('rehub_btnoffer_color') ? rehub_option('rehub_btnoffer_color') : '#7000f4';
		$linkcolor = rehub_option('rehub_color_link') ? rehub_option('rehub_color_link') : '#0099cc';
		$btncolortext = rehub_option('rehub_btnoffer_color_text') ? rehub_option('rehub_btnoffer_color_text') : '#ffffff';
		$btnhovercolortext = rehub_option('rehub_btnofferhover_color_text') ? rehub_option('rehub_btnofferhover_color_text') : '#ffffff';
		$btnhovercolor = rehub_option('rehub_btnoffer_color_hover') ? rehub_option('rehub_btnoffer_color_hover') : '#7000f4';
		$args['wcfmmp_store_name_color']['default'] = '#ffffff';
		unset($args['wcfmmp_header_social_background_color']);
		unset($args['wcfmmp_star_rating_color']);
		$args['wcfmmp_sidebar_background_color']['element'] = '.wcvcontent .rh-cartbox .widget-inner-title';
		$args['wcfmmp_sidebar_background_color']['default'] = '#f7f7f7';
		$args['wcfmmp_sidebar_heading_color']['element'] = '.wcvcontent .rh-cartbox .widget-inner-title';
		$args['wcfmmp_sidebar_heading_color']['default'] = '#555555';
		$args['wcfmmp_sidebar_text_color']['default'] = '#111111';	
		$args['wcfmmp_tabs_text_color']['element'] = '#wcfmmp-store ul.rh-big-tabs-ul .rh-big-tabs-li a';
		$args['wcfmmp_tabs_active_text_color']['element'] = '#wcfmmp-store .rh-hov-bor-line > a:after';
		$args['wcfmmp_tabs_active_text_color']['default'] = $activebg;
		$args['wcfmmp_tabs_active_text_color']['style'] = 'background';
		$args['wcfmmp_button_bg_color']['default'] = $btncolor;
		$args['wcfmmp_button_text_color']['default'] = $btncolortext;
		$args['wcfmmp_button_active_text_color']['default'] = $btnhovercolortext;
		$args['wcfmmp_button_bg_color']['element'] = '#wcfmmp-store .add_review button, #wcfmmp-store .user_rated, #wcfmmp-stores-wrap a.wcfmmp-visit-store, #wcfmmp-store .bd_icon_box .wcfm_store_enquiry';
		$args['wcfmmp_button_bg_color']['element2'] = '#wcfmmp-store .reviews_heading a, #wcfmmp-store .reviews_count a, .wcfmmp_store_hours .wcfmmp-store-hours-day';
		$args['wcfmmp_button_text_color']['element'] = '#wcfmmp-store .add_review button, #wcfmmp-store .user_rated, #wcfmmp-stores-wrap a.wcfmmp-visit-store, #wcfmmp-store .bd_icon_box .wcfm_store_enquiry, #wcfmmp-store .bd_icon_box .wcfm_store_enquiry span';

		$args['wcfmmp_button_active_bg_color']['default'] = $btnhovercolor;
		$args['wcfmmp_button_active_bg_color']['element'] = '#wcfmmp-store .add_review button:hover, #wcfmmp-stores-wrap a.wcfmmp-visit-store:hover, #wcfmmp-store .bd_icon_box .wcfm_store_enquiry:hover';
		$args['wcfmmp_button_active_text_color']['element'] = '#wcfmmp-store .add_review button:hover, #wcfmmp-stores-wrap a.wcfmmp-visit-store:hover, #wcfmmp-store .bd_icon_box .wcfm_store_enquiry:hover, #wcfmmp-store .bd_icon_box .wcfm_store_enquiry:hover span';

		return $args;
	}
	add_action( 'rehub_vendor_show_action', array('WCFMmp_Frontend', 'wcfmmp_sold_by_product'), 50);

}

//////////////////////////////////////////////////////////////////
//Woo REVIEWS
//////////////////////////////////////////////////////////////////

if(get_option( 'woocommerce_enable_reviews' ) === 'yes'){
	add_action( 'woocommerce_review_after_comment_text', 'getCommentLike_woo' );
}
function getCommentLike_woo( $comment ){
	echo getCommentLike_re('');
}


//////////////////////////////////////////////////////////////////
//Save Review of Editor
//////////////////////////////////////////////////////////////////
add_action('save_post_product', 'rehub_save_post_product', 13);
if( !function_exists('rehub_save_post_product') ) {
function rehub_save_post_product( $post_id ){
	global $post;

	$rehub_meta_id = 'rehub_review_woo';

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// make sure data came from our meta box, verify nonce
	$nonce = isset($_POST[$rehub_meta_id.'_nonce']) ? sanitize_text_field($_POST[$rehub_meta_id.'_nonce']) : NULL ;
	if (!wp_verify_nonce($nonce, $rehub_meta_id)) return $post_id;

	// check user permissions
	if (!current_user_can(apply_filters( 'woocommerce_duplicate_product_capability', 'manage_woocommerce' ))) return $post_id;

	// authentication passed, process data
	$meta_data = isset( $_POST[$rehub_meta_id] ) ? (array)$_POST[$rehub_meta_id] : NULL ;
	if ( !wp_is_post_revision( $post_id ) ) {
		// if is review post, save data
		$thecriteria = $meta_data['_review_post_criteria'];
		array_pop($thecriteria);
		$manual_score = $meta_data['_review_post_score_manual'];

		$score = 0; $total_counter = 0;
		if (!empty($thecriteria))  {
		    foreach ($thecriteria as $criteria) {
		    	$score += (float) $criteria['review_post_score']; $total_counter ++;
		    }
		}
	    if ($manual_score)  {
	    	$total_score = $manual_score;
	    }
	    else {
			if( !empty( $score ) && !empty( $total_counter ) ) $total_score =  $score / $total_counter ;
			if( empty($total_score) ) $total_score = 0;
			$total_score = round($total_score,1);
		}

		if($total_score){
			update_post_meta($post_id, 'rehub_review_overall_score', $total_score); // save total score of review	 
			$firstcriteria = (!empty($thecriteria[0]['review_post_name'])) ? $thecriteria[0]['review_post_name'] : ''; 
			if($firstcriteria) :
				foreach ($thecriteria as $key=>$criteria) { 
					$key = $key + 1;
					$metakey = '_review_score_criteria_'.$key;
					update_post_meta($post_id, $metakey, $criteria['review_post_score']);
				}
			endif;			
		}
		elseif($manual_score==0){
			delete_post_meta($post_id, 'rehub_review_overall_score');
		}

	}
}
}


if (!function_exists('RH_get_quick_view')){
	function RH_get_quick_view( $product_id, $type='icon', $class=''){
		if( rehub_option('woo_quick_view') == '')
			return '';
		if($type=='icon'){
			return '<div class="quick_view_wrap '.esc_attr($class).'"><span class="flowhidden cell_quick_view"><span class="cursorpointer quick_view_button" data-product_id="'.$product_id.'"><i class="fal fa-search-plus"></i></span></div>';
		}
		return '';
	}
}

//////////////////////////////////////////////////////////////////
//Quick View
//////////////////////////////////////////////////////////////////
if(rehub_option('woo_quick_view')){
if( !function_exists('ajax_action_product_quick_view') ) {
	function ajax_action_product_quick_view() {

		$nonce = sanitize_text_field($_GET['nonce']);
		
 		if ( ! wp_verify_nonce( $nonce, 'ajaxed-nonce' ) )
			wp_die ( 'Nope!' ); 
		
		$product_id = intval($_GET['product_id']);
		wp( 'p=' . $product_id . '&post_type=product' );

 		ob_start();
		while ( have_posts() ) : the_post();
			do_action( 'rehub_woo_quick_view', $product_id );
			include(rh_locate_template('inc/product_layout/popup_no_sidebar.php'));
		endwhile;
		echo ''. ob_get_clean();
		exit;
	}
}
add_action( 'wp_ajax_product_quick_view', 'ajax_action_product_quick_view' );
add_action( 'wp_ajax_nopriv_product_quick_view', 'ajax_action_product_quick_view' );


if( !function_exists('rehub_woo_quick_view_action') ){
	function rehub_woo_quick_view_action($product_id){
		$product = wc_get_product( $product_id );
		$has_coupon = get_post_meta($product_id, 'rehub_woo_coupon_code', true);
		$rtl = is_rtl() ? 'true' : 'false';
		?>
		<script type="text/javascript">
			var wc_single_product_params = {"flexslider":{"rtl":<?php echo ''.$rtl; ?>,"animation":"slide","smoothHeight":true,"directionNav":false,"controlNav":"thumbnails","slideshow":false,"animationSpeed":500,"animationLoop":false,"allowOneSlide":false},"flexslider_enabled":"1"};
			jQuery.getScript("<?php echo get_template_directory_uri() . '/js/jquery.flexslider-min.js' ?>");
			jQuery.getScript("<?php echo plugins_url( 'assets/js/frontend/single-product.min.js', WC_PLUGIN_FILE ); ?>");
		</script>
		<?php if( $product->get_type() == 'variable' ): ?>
		<script type="text/javascript">
			var wc_add_to_cart_variation_params = {"wc_ajax_url":"\/?wc-ajax=%%endpoint%%"};
			jQuery.getScript("<?php echo includes_url('js/wp-util.min.js'); ?>");
			jQuery.getScript("<?php echo plugins_url( 'assets/js/frontend/add-to-cart-variation.min.js', WC_PLUGIN_FILE ); ?>");
		</script>
		<script type="text/template" id="tmpl-variation-template">
			<div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
			<div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
			<div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
		</script>
		<?php endif; ?>
		<?php if($has_coupon): ?>
		<script type="text/javascript">
			jQuery(window).ready(function($) {
			   'use strict';
				/* Coupons script & copy function */
			   $.getScript("<?php echo get_template_directory_uri() . '/js/clipboard.min.js' ?>", function(){
				   if($('.rehub_offer_coupon:not(.expired_coupon)').length > 0){
					  var client = new Clipboard( '.rehub_offer_coupon:not(.expired_coupon)' );
					  var OfferCoupon = $('.rehub_offer_coupon:not(.expired_coupon)');
					  client.on( 'success', function(e) {
						 OfferCoupon.find('i').replaceWith( '<i class="far fa-check-square"></i>' );
						 OfferCoupon.find('i').fadeOut( 2500, function() {
							OfferCoupon.find('i').replaceWith( '<i class="fal fa-cut fa-rotate-180"></i>' ).fadeIn('slow');
						 });
					  });
					  client.on( 'error', function(e) {
						 console.log(e);       
					  });      
				   }
			   });
			});  
		</script>
		<?php endif; ?>
		<?php
	}
}
add_action('rehub_woo_quick_view', 'rehub_woo_quick_view_action');
}


//////////////////////////////////////////////////////////////////
//Fake Sold Counter
//////////////////////////////////////////////////////////////////
if(!function_exists('rh_soldout_bar')){
	function rh_soldout_bar( $post_id, $color = '#e33333' ){
		if(!$post_id){
			$post_id = get_the_ID();
		}
	    $manage_stock = get_post_meta( $post_id, '_manage_stock', true );
	    if($manage_stock == 'yes'):
	        $stock_available = ( $stock = get_post_meta( $post_id, '_stock', true ) ) ? round( $stock ) : 0;
	        $stock_sold = ( $total_sales = get_post_meta( $post_id, 'total_sales', true ) ) ? round( $total_sales ) : 0;
	        $soldout = $stock_sold / $stock_available *100;
	    else:
	        $soldout = get_transient('rh-soldout-'. $post_id);
	        if(!$soldout):
	            $soldout = rand(10,100);
	            set_transient( 'rh-soldout-'. $post_id, $soldout, DAY_IN_SECONDS );
	        endif;
	    endif;
	    ?>
	    <div class="soldoutbar mb10">
	        <div class="wpsm-bar minibar wpsm-clearfix mb5" data-percent="<?php echo (float)$soldout;?>%">
	            <div class="wpsm-bar-bar" style="background: <?php echo $color; ?>"></div>
	        </div>
	        <div class="soldoutpercent greycolor font70 lineheight15"><?php esc_html_e( 'Already Sold:', 'rehub-theme' );?> <?php echo (float)$soldout;?>%</div>
	    </div>
	    <?php
	}
}

?>