<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php


//////////////////////////////////////////////////////////////////
// Register sidebar and footer widgets
//////////////////////////////////////////////////////////////////
if( !function_exists('rehub_register_sidebars') ) {
function rehub_register_sidebars() {

	register_sidebar(array(
		'id' => 'rhsidebar',
		'name' => esc_html__('Sidebar Area', 'rehub-theme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'id' => 'footerfirst',
		'name' => esc_html__('Footer 1', 'rehub-theme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'id' => 'footersecond',
		'name' => esc_html__('Footer 2', 'rehub-theme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'id' => 'footerthird',
		'name' => esc_html__('Footer 3', 'rehub-theme'),
		'before_widget' => '<div id="%1$s" class="widget last %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'id' => 'footercustom',
		'name' => esc_html__('Bottom Custom Footer Area', 'rehub-theme'),
		'before_widget' => '<div id="%1$s" class="footerside %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title">',
		'after_title' => '</div>',
	));	
	register_sidebar(array(
		'id' => 'rhcustomsidebar',
		'name' => esc_html__('Custom sidebar area', 'rehub-theme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'id' => 'rhcustomsidebarsec',
		'name' => esc_html__('Custom sidebar area 2', 'rehub-theme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="title">',
		'after_title' => '</div>',
	));
	if(rehub_option('enable_brand_taxonomy') == 1 || REHUB_NAME_ACTIVE_THEME == 'RECASH'){
		register_sidebar(array(
			'id' => 'dealstore-sidebar',
			'name' => esc_html__('Affiliate store archive sidebar', 'rehub-theme'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="title">',
			'after_title' => '</div>',
		));	
	}
	if(function_exists('bp_is_active') ){
		register_sidebar(array(
			'id' => 'bprh-profile-sidebar',
			'name' => esc_html__('Buddypress Profile sidebar', 'rehub-theme'),
			'before_widget' => '<div id="%1$s" class="rh-cartbox widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-inner-title rehub-main-font">',
			'after_title' => '</div>',
		));	
	}	
	if(rehub_option('bp_group_widget_area') == 1 ){
		register_sidebar(array(
			'id' => 'bprh-group-sidebar',
			'name' => esc_html__('Buddypress Group sidebar', 'rehub-theme'),
			'before_widget' => '<div id="%1$s" class="rh-cartbox widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-inner-title rehub-main-font">',
			'after_title' => '</div>',
		));	
	}	
	if (class_exists('Woocommerce')) {
		register_sidebar(array(
			'id' => 'woostore-sidebar',
			'name' => esc_html__('Woo brand archive sidebar', 'rehub-theme'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="title">',
			'after_title' => '</div>',
		));	
		if (defined('wcv_plugin_dir') || class_exists( 'WeDevs_Dokan' ) || class_exists('WCMp')){
			register_sidebar(array(
				'id' => 'wcw-storepage-sidebar',
				'name' => esc_html__('Vendor store page sidebar', 'rehub-theme'),
				'before_widget' => '<div id="%1$s" class="rh-cartbox widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-inner-title rehub-main-font">',
				'after_title' => '</div>',
			));			
		}
		register_sidebar(array(
			'id' => 'wooshopsidebar',
			'name' => esc_html__('Woocommerce shop sidebar', 'rehub-theme'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="title">',
			'after_title' => '</div>',
		));			
		register_sidebar(array(
			'id' => 'sidebarwooinner',
			'name' => esc_html__('Woocommerce product sidebar', 'rehub-theme'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="title">',
			'after_title' => '</div>',
		));		
			
	}				
}
}
add_action( 'widgets_init', 'rehub_register_sidebars' );


//////////////////////////////////////////////////////////////////
// Sidebar widget functions
//////////////////////////////////////////////////////////////////

if( !function_exists('rehub_most_popular_widget_block') ) {
function rehub_most_popular_widget_block($basedby = 'comments') { ?>

	<?php 
	if ($basedby == 'views') {$popular_posts = new WP_Query('showposts=5&meta_key=rehub_views_mon&orderby=meta_value_num&order=DESC&ignore_sticky_posts=1');}
	else {$popular_posts = new WP_Query('showposts=5&orderby=comment_count&order=DESC&ignore_sticky_posts=1');}	
	if($popular_posts->have_posts()): ?>
	
	
		<?php  while ($popular_posts->have_posts()) : $popular_posts->the_post(); 	global $post; ?>
		
			<div class="clearfix">
	            <figure><a href="<?php the_permalink();?>"><?php WPSM_image_resizer::show_static_resized_image(array('thumb'=> true, 'crop'=> false, 'width'=> 100, 'no_thumb_url' => get_template_directory_uri() . '/images/default/noimage_123_90.png'));?></a></figure>
	            <div class="detail">
		            <h5 class="mt0"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
	            	<div class="post-meta">
	              		<?php $category = get_the_category($post->ID); $first_cat = $category[0]->term_id;?>
	                	<?php if ($basedby == 'views') {meta_small( false, $first_cat, false, true );} else {meta_small( false, $first_cat, true, false );}  ?>
	                </div>
	                <?php rehub_format_score('small') ?>
	            </div>
            </div>
		
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
		<?php endif;?>


<?php
}
}

if( !function_exists('rehub_latest_comment_widget_block') ) {
function rehub_latest_comment_widget_block() { ?>
<div class="last_comments_widget">

	<?php
	global $wpdb;
	$comments = $wpdb->get_results("SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,78) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 5");
	foreach ($comments as $comment) { 
	?>
		<div class="lastcomm-item">
			<div class="side-item comment">	
				<div>
					<span><strong><?php echo strip_tags($comment->comment_author); ?></strong></span> 
					<?php echo strip_tags($comment->com_excerpt); ?>...
					<span class="lastcomm-cat">
						<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo (int)$comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> - <?php echo strip_tags($comment->post_title); ?>"><?php echo strip_tags($comment->post_title); ?></a>
					</span>		
				</div>
			</div>
		</div>

	<?php } ?>

</div>
<?php
}
}

if( !function_exists('rehub_category_widget_block') ) {
function rehub_category_widget_block() { ?>

<div class="rh_category_tab">
	<ul class="cat_widget_custom">
	<?php
		$variable = wp_list_categories('echo=0&show_count=1&title_li=');
		$variable = str_replace('</a> (', '</a> <span class="counts">(', $variable);
  		$variable = str_replace(')', ')</span>', $variable);
		echo ''.$variable;
	?>
	</ul>
</div>

<?php
}
}

if( !function_exists('rehub_get_social_links') ) {
function rehub_get_social_links($atts, $content = null){
	extract(shortcode_atts(array(
		'icon_size' => 'big',
	), $atts));	
	ob_start();
?>
	<div class="social_icon <?php echo esc_attr($icon_size); ?>_i">
		

		<?php if ( rehub_option('rehub_facebook') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_facebook'); ?>" class="fb" rel="nofollow" target="_blank"><i class="fab fa-facebook"></i></a>
		<?php endif;?>	

		<?php if ( rehub_option('rehub_twitter') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_twitter'); ?>" class="tw" rel="nofollow" target="_blank"><i class="fab fa-twitter"></i></a>
		<?php endif;?>

		<?php if ( rehub_option('rehub_google') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_google'); ?>" class="gp" rel="nofollow" target="_blank"><i class="fab fa-google-plus"></i></a>
		<?php endif;?>

		<?php if ( rehub_option('rehub_instagram') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_instagram'); ?>" class="ins" rel="nofollow" target="_blank"><i class="fab fa-instagram"></i></a>
		<?php endif;?>

		<?php if ( rehub_option('rehub_wa') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_wa'); ?>" class="wa" rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i></a>
		<?php endif;?>	

		<?php if ( rehub_option('rehub_youtube') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_youtube'); ?>" class="yt" rel="nofollow" target="_blank"><i class="fab fa-youtube"></i></a>
		<?php endif;?>

		<?php if ( rehub_option('rehub_vimeo') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_vimeo'); ?>" class="vim" rel="nofollow" target="_blank"><i class="fab fa-vimeo-square"></i></a>
		<?php endif;?>			
		
		<?php if ( rehub_option('rehub_pinterest') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_pinterest'); ?>" class="pn" rel="nofollow" target="_blank"><i class="fab fa-pinterest"></i></a>
		<?php endif;?>

		<?php if ( rehub_option('rehub_linkedin') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_linkedin'); ?>" class="in" rel="nofollow" target="_blank"><i class="fab fa-linkedin"></i></a>
		<?php endif;?>

		<?php if ( rehub_option('rehub_soundcloud') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_soundcloud'); ?>" class="sc" rel="nofollow" target="_blank"><i class="fab fa-cloud"></i></a>
		<?php endif;?>

		<?php if ( rehub_option('rehub_dribbble') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_dribbble'); ?>" class="db" rel="nofollow" target="_blank"><i class="fab fa-dribbble"></i></a>
		<?php endif;?>

		<?php if ( rehub_option('rehub_vk') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_vk'); ?>" class="vk" rel="nofollow" target="_blank"><i class="fab fa-vk"></i></a>
		<?php endif;?>	
		<?php if ( rehub_option('rehub_telegram') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_telegram'); ?>" class="telegram" rel="nofollow" target="_blank"><i class="fab fa-telegram"></i></a>
		<?php endif;?>
		<?php if ( rehub_option('discord') != '' ) :?>
			<a href="<?php echo rehub_option('discord'); ?>" class="dscord" rel="nofollow" target="_blank"><i class="fab fa-discord"></i></a>
		<?php endif;?>			
		<?php if ( rehub_option('rehub_rss') != '' ) :?>
			<a href="<?php echo rehub_option('rehub_rss'); ?>" class="rss" rel="nofollow" target="_blank"><i class="far fa-rss"></i></a>
		<?php endif;?>																		
	</div>

<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
}


if( !function_exists('rehub_top_offers_widget_block_post') ) {
function rehub_top_offers_widget_block_post($tags = '', $number = '5', $order = '', $random = '', $orderby='', $notexpired = '', $comparebtn = '') { ?>

	<?php $args = array (
			'posts_per_page' => $number,
			'tag' => $tags,
			'ignore_sticky_posts' => '1',
		);
		if (!empty ($random)) {
			$args ['orderby'] = 'rand';
		}	
		if (!empty ($order)) {
			$args ['meta_key'] = $order;
			$args ['orderby'] = 'meta_value_num';
		}
		if (!empty ($orderby)) {
			$args ['order'] = $orderby;
		}
		if($notexpired){
			$args['tax_query'][] = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'offerexpiration',
					'field'    => 'name',
					'terms'    => 'yes',
					'operator' => 'NOT IN',
				)
			);
		} 		
	$offers = new WP_Query($args);
	if($offers->have_posts()): ?>
	
	<div class="rh_deal_block">
		<?php  while ($offers->have_posts()) : $offers->the_post(); global $post; ?>	
			<?php $offer_coupon = get_post_meta( $post->ID, 'rehub_offer_product_coupon', true ) ?>
			<?php $offer_price_old = get_post_meta( $post->ID, 'rehub_offer_product_price_old', true );?>
			<?php $offer_price = get_post_meta( $post->ID, 'rehub_offer_product_price', true );?>
			<?php $offer_post_url = get_post_meta( $post->ID, 'rehub_offer_product_url', true );
				$offer_post_url = apply_filters('rehub_create_btn_url', $offer_post_url);
				$offer_url = apply_filters('rh_post_offer_url_filter', $offer_post_url );
				$offer_btn_text = get_post_meta( $post->ID, 'rehub_offer_btn_text', true );
			?>
			<div class="deal_block_row">
				<div class="deal-pic-wrapper">
					<a href="<?php the_permalink();?>">
						<?php WPSM_image_resizer::show_static_resized_image(array('thumb'=> true, 'crop'=> false, 'width'=> 70, 'height'=> 70, 'no_thumb_url' => get_template_directory_uri() . '/images/default/noimage_70_70.png'));?>
	            	</a>				
				</div>
	            <div class="rh-deal-details">
					<div class="rh-deal-name"><h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5></div>	            					
					<?php if(!empty($offer_coupon)) : ?>
						<div class="redemptionText"><?php esc_html_e('Use Coupon Code:', 'rehub-theme');?><span class="code"><?php echo esc_html($offer_coupon); ?></span></div>	
				  	<?php endif;?>
					<div class="rh-deal-pricetable">
						<div class="rh-deal-left">
							<?php if($offer_price):?>
								<div class="rh-deal-price">
									<span>
										<ins><?php echo esc_html($offer_price) ?></ins>
										<?php if($offer_price_old !='') :?>
											<del><?php echo esc_html($offer_price_old) ; ?></del>
										<?php endif ;?>
									</span>
								</div>
							<?php endif;?>												
							<div class="rh-deal-tag">
								<?php WPSM_Postfilters::re_show_brand_tax('list'); //show brand logo?>					
							</div>
						</div>
						<div class="rh-deal-right">	
							<?php if($comparebtn):?>
							<?php else:?>
								<?php if($offer_post_url):?>
									<div class="rh-deal-btn">
					                    <a href="<?php echo esc_url ($offer_url) ?>" class="re_track_btn rh-deal-compact-btn btn_offer_block" target="_blank" rel="nofollow">
					                        <?php if($offer_btn_text !='') :?>
					                            <?php echo esc_attr($offer_btn_text) ; ?>
					                        <?php elseif(rehub_option('rehub_btn_text') !='') :?>
					                            <?php echo rehub_option('rehub_btn_text') ; ?>
					                        <?php else :?>
					                            <?php esc_html_e('Buy this item', 'rehub-theme') ?>
					                        <?php endif ;?>
					                    </a>		            					
									</div>
								<?php endif;?>
						    <?php endif;?>																	
						</div>					
					</div>
	            </div>
            </div>
		
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
		<?php endif; ?>
	</div>

<?php
}
}


if( !function_exists('rehub_top_offers_widget_block_woo') ) {
function rehub_top_offers_widget_block_woo($tags = '', $number = '5', $order = '', $random = '', $orderby='', $notexpired = '', $comparebtn = '') { ?>

	<?php 
	$args = array (
			'posts_per_page' => $number,
			'ignore_sticky_posts' => '1',
			'post_type' => 'product',
		);
		if (!empty ($random)) {
			$args ['orderby'] = 'rand';
		}	
		if (!empty ($order)) {
			$args ['meta_key'] = $order;
			$args ['orderby'] = 'meta_value_num';
		}
		if (!empty ($orderby)) {
			$args ['order'] = $orderby;
		}
		if (!empty ($tags)) {          
			$tags = array_map( 'trim', explode( ",", $tags) );
	        $args['tax_query'] = array(array('taxonomy' => 'product_tag', 'terms' => $tags, 'field' => 'slug'));	
		}					

	$wp_query = new WP_Query($args);
	if($wp_query->have_posts()): ?>
	
	<div class="rh_deal_block">
		<?php  while ($wp_query->have_posts()) : $wp_query->the_post(); global $post; global $product; ?>	
			<?php $offer_coupon = get_post_meta( $post->ID, 'rehub_woo_coupon_code', true ) ?>
			<?php $offer_post_url = esc_url( $product->add_to_cart_url() );
				$offer_post_url = apply_filters('rehub_create_btn_url', $offer_post_url);
				$offer_url = apply_filters('rh_post_offer_url_filter', $offer_post_url );
				
			?>
			<div class="deal_block_row">
				<div class="deal-pic-wrapper">
					<a href="<?php the_permalink();?>">
						<?php WPSM_image_resizer::show_static_resized_image(array('thumb'=> true, 'crop'=> false, 'width'=> 70, 'height'=> 70, 'no_thumb_url' => get_template_directory_uri() . '/images/default/noimage_70_70.png'));?>
	            	</a>				
				</div>
	            <div class="rh-deal-details">
					<div class="rh-deal-name"><h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5></div>	            					
					<div class="rh-deal-pricetable">
						<div class="rh-deal-left">
								<div class="rh-deal-price">
									<?php if ( $price_html = $product->get_price_html() ) : ?>
										<span class="price"><?php echo ''.$price_html; ?></span>
									<?php endif; ?>
								</div>												
							<div class="rh-deal-tag">
								<?php WPSM_Woohelper::re_show_brand_tax('list'); //show brand taxonomy?>					
							</div>
						</div>
						<div class="rh-deal-right">						
							<?php if(!empty($offer_coupon)) : ?>
								<div class="redemptionText text-right-align">
									<span class="redemptionTextLabel"><?php esc_html_e('Use Coupon:', 'rehub-theme');?></span>
			                        <?php wp_enqueue_script('zeroclipboard'); ?>
			                        <a class="re_track_btn rh-deal-compact-btn btn_offer_block rehub_offer_coupon masked_coupon" data-clipboard-text="<?php echo esc_html($offer_coupon); ?>" data-codeid="<?php echo ''.$product->get_id() ?>" data-dest="<?php echo esc_url($offer_url) ?>"><?php if(rehub_option('rehub_mask_text') !='') :?><?php echo rehub_option('rehub_mask_text') ; ?><?php else :?><?php esc_html_e('Reveal coupon', 'rehub-theme') ?><?php endif ;?>
			                        </a>							
								</div>
							<?php else :?>
								<div class="rh-deal-btn">
									<?php if($comparebtn && (rehub_option('compare_page') || rehub_option('compare_multicats_textarea')) ):?>
                                        <?php 
                                            $cmp_btn_args = array(); 
                                            $cmp_btn_args['class']= 'rhwoosinglecompare mb15 rehub-main-smooth';
                                            $cmp_btn_args['id'] = $product->get_id();
                                            if(rehub_option('compare_woo_cats') != '') {
                                                $cmp_btn_args['woocats'] = esc_html(rehub_option('compare_woo_cats'));
                                            }
                                        ?>                                                  
                                        <?php echo wpsm_comparison_button($cmp_btn_args); ?>
									<?php else:?>
									    <?php $syncitem = '';?>
									    <?php if (defined('\ContentEgg\PLUGIN_PATH')):?>
									        <?php $itemsync = \ContentEgg\application\WooIntegrator::getSyncItem($post->ID);?>
									        <?php if(!empty($itemsync)):?>
									            <?php                            
									                $syncitem = $itemsync;                            
									            ?>
									        <?php endif;?>
									    <?php endif;?>
									    <?php if(!empty($syncitem)):?>

									    <?php else:?> 									
								             <?php  echo apply_filters( 'woocommerce_loop_add_to_cart_link',
							                    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="re_track_btn rh-deal-compact-btn btn_offer_block %s %s product_type_%s"%s>%s</a>',
							                    esc_url( $product->add_to_cart_url() ),
							                    esc_attr( $product->get_id() ),
							                    esc_attr( $product->get_sku() ),
											    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
											    $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
							                    esc_attr( $product->get_type() ),
							                    $product->get_type() =='external' ? ' target="_blank"' : '',
							                    esc_html( $product->add_to_cart_text() )
							                    ),
								            $product );?>
								        <?php endif;?>
								    <?php endif;?>
					            </div>								
						  	<?php endif;?>										            								
						</div>					
					</div>
	            </div>
            </div>
		
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
		<?php endif; ?>
	</div>


<?php
}
}


?>