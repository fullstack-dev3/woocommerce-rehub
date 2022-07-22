<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$columns           = (!isset($columns_thumbnails)) ? apply_filters( 'woocommerce_product_thumbnails_columns', 5 ) : $columns_thumbnails;
$post_thumbnail_id = $product->get_image_id();
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$thumbsize = 'full';
$img_srcset = wp_get_attachment_image_srcset($post_thumbnail_id, $thumbsize);
$img_sizes = wp_get_attachment_image_sizes($post_thumbnail_id, $thumbsize);
$responsive_image_html = ' srcset="' . esc_attr( $img_srcset ) . '" sizes="' . esc_attr( $img_sizes ) . '"';
$placeholder       = $post_thumbnail_id ? 'with-images' : 'without-images';
$props         = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
$attachment_ids = $product->get_gallery_image_ids();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
	(empty ($attachment_ids)) ? 'no-gallery-thumbnails' : 'gallery-thumbnails-enabled'
) );
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
			<?php
			/*$attributes = array(
				'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
				'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),				
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);*/

            $showimg = new WPSM_image_resizer();
            $showimg->use_thumb = true;
            $height_figure_single = (!isset($height_woo_main)) ? 356 : $height_woo_main;
            $height_resize = (!isset($noresize)) ? true : false;
            if(isset($width_woo_main)) { 
            	$width_figure_single = $width_woo_main;
            } else{
            	$width_figure_single = $height_figure_single;
            }
            if(isset($height_woo_main) && $height_resize){
            	$cssheight = ".attachment-shop_single, .attachment-full{max-height:".(int)$height_woo_main."px; width: auto !important;}";
 				wp_register_style( 'wooim-inline-style', false );
    			wp_enqueue_style( 'wooim-inline-style' );
    			wp_add_inline_style( 'wooim-inline-style', $cssheight );            	
            }       
            $image_url = $showimg->get_not_resized_url();			

			if ( $post_thumbnail_id ) {
				$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
				$html .= sprintf( '<img src="%s" class="attachment-shop_single size-shop_single wp-post-image" height="%s" width="%s" alt="%s" title="%s" data-caption="%s" data-src="%s" data-large_image="%s" data-large_image_width="%s" data-large_image_height="%s" data-o_src="%s" %s />', $image_url, $height_figure_single, $width_figure_single, $props['alt'], $props['title'], $props['caption'], $full_size_image[0], $full_size_image[0], $full_size_image[1], $full_size_image[2], $image_url, $responsive_image_html );
				$html .= '</a></div>';
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src('woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'rehub-theme' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );


			?>
		<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	</figure>

</div>