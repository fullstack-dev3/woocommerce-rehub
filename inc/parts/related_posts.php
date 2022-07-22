<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php 

$base_post = $post;
global $post;

$tag_relative = rehub_option('rehub_enable_tag_relative');
$taxonomy = rh_get_taxonomy_of_post( $post, $tag_relative );
$relatives = get_the_terms( $post->ID, $taxonomy );

if ( !empty($relatives) && !is_wp_error($relatives) ) {
	$relative_ids = array();
	foreach($relatives as $individual_relative) $relative_ids[] = $individual_relative->term_id;	
	$args = array(
		'post_type' => $post->post_type,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => 4,
		'ignore_sticky_posts' => 1,
		'tax_query' => array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => $relative_ids,
			),
		)
	);

	if (rehub_option('rehub_post_exclude_expired') == '1') {
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

	$my_query = new wp_query( $args );
	if( $my_query->have_posts() ) { ?>
		<div class="related_articles pt25 border-top mb0 clearfix">
		<div class="related_title rehub-main-font font120 fontbold mb35">
			<?php if (rehub_option('rehub_related_text') !='' && is_singular('post')) :?>
				<?php echo rehub_option('rehub_related_text');?>
			<?php else :?>
				<?php esc_html_e('Related Articles', 'rehub-theme'); ?>
			<?php endif;?>
		</div>
		<div class="columned_grid_module rh-flex-eq-height col_wrap_fourth mb0" >
		<?php while( $my_query->have_posts() ) {
			$my_query->the_post();?>
			<?php $disablecard = '1'; $disable_meta = '1';?>
			<?php include(rh_locate_template('inc/parts/column_grid.php')); ?>
		<?php
		}
		echo '</div></div>';
	}
}
$post = $base_post;
wp_reset_query();
?>