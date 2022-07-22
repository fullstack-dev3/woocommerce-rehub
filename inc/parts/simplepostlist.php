<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php global $post;?>
<?php $nometa = (isset($nometa)) ? $nometa : '';?>
<?php $image = (isset($image)) ? $image : '';?>
<?php $border = (isset($border)) ? $border : '';?>
<?php $excerpt = (isset($excerpt)) ? $excerpt : '';?>
<?php $priceenable = (isset($priceenable)) ? $priceenable : '';?>
<?php $compareenable = (isset($compareenable)) ? $compareenable : '';?>
<?php $hotenable = (isset($hotenable)) ? $hotenable : '';?>
<?php $cropenable = (isset($cropenable)) ? $cropenable : '';?>
<?php if (REHUB_NAME_ACTIVE_THEME == 'RECASH') {
	$hotenable = $priceenable = true;
}?>
<div class="col_item item-small-news<?php if($image):?> item-small-news-image<?php endif;?><?php if($border):?> border-lightgrey pb10 pl10 pr10 pt10 mb20<?php endif;?>">
	
	<?php if($image):?>
		<figure class="<?php if($border):?>img-centered-flex rh-flex-center-align rh-flex-justify-center<?php else:?>text-center<?php endif;?>"><a href="<?php the_permalink();?>">
			<?php if($cropenable):?>
				<?php WPSM_image_resizer::show_static_resized_image(array('thumb'=> true, 'crop'=> true, 'height'=> 90, 'width'=> 123, 'no_thumb_url' => get_template_directory_uri() . '/images/default/noimage_100_70.png'));?>
			<?php else:?>
				<?php WPSM_image_resizer::show_static_resized_image(array('thumb'=> true, 'crop'=> false, 'height'=> 80, 'no_thumb_url' => get_template_directory_uri() . '/images/default/noimage_100_70.png'));?>
			<?php endif;?>
		</a>
		</figure>
	<?php endif;?>
	<div class="item-small-news-details">
	    <h3><?php do_action('rehub_in_title_post_list');?><?php if($hotenable && rehub_option('hotmeter_disable') !='1') {echo getHotLikeTitle($post->ID);}?><a href="<?php the_permalink();?>"><?php the_title();?></a><?php if ($priceenable) :?><?php rehub_create_price_for_list($post->ID);?><?php endif;?></h3>
	    <?php if($compareenable && 'product' == get_post_type($post->ID) && (rehub_option('compare_page') != '' || rehub_option('compare_multicats_textarea') != '')) {echo'<div class="woo-btn-actions-notext mb10">';echo wpsm_comparison_button(array('class'=>'rhwoosinglecompare', 'id'=>$post->ID)); echo '</div>';} ?>
	    <?php if ($nometa !='1') :?>
	    	<div class="post-meta"> <?php meta_small( true, false, true ); ?> </div> 	    	
	    <?php endif;?>
	    <?php if ($excerpt) :?>
	    	<div class="list_excerpt font90 lineheight20"><?php kama_excerpt('maxchar=160'); ?> </div> 	    	
	    <?php endif;?>	    	    
	    <?php do_action('rehub_after_meta_post_list');?>    
    </div>
    <div class="clearfix"></div>
</div>