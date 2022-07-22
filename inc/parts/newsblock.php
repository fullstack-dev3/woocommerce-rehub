<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php global $post;?>
<?php $small = (isset($small)) ? $small : '';?>
<?php $secondtype = (isset($secondtype)) ? $secondtype : '';?>
<div class="news_out_thumb">
	<figure>
        <?php if(!$small):?>
            <?php $category_echo = '';	
            if ('post' == get_post_type($post->ID) && rehub_option('exclude_cat_meta') != 1) {
                $category = get_the_category();
                if ( class_exists( 'WPSEO_Primary_Term' ) ) {
                    $wpseo_primary_term = new WPSEO_Primary_Term( 'category', $post->ID );
                    $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                    //$termyoast               = get_term( $wpseo_primary_term );
                    if (!is_numeric($wpseo_primary_term )) {
                        $category_id = $category[0]->term_id;
                    }else{
                        $category_id = $wpseo_primary_term; 
                    }
                }else{
                    $category_id = $category[0]->term_id; 
                }
				$category_link = get_category_link($category_id);
				$category_name = get_cat_name($category_id);
				$category_echo = '<span class="news_cat"><a href="'.esc_url( $category_link ).'">'.$category_name.'</a></span>';
				if($secondtype != '3'){echo ''.$category_echo;}                   	
            }
            ?>	
        <?php endif;?>    	
        <?php echo re_badge_create('ribbon'); ?>
	    <a href="<?php the_permalink();?>"><?php wpsm_thumb ('medium_news') ?></a>
    </figure>
    <div class="text_out_thumb">
    	<?php echo (!empty($small)) ? '<h3>' : '<h2>' ;?><a href="<?php the_permalink();?>"><?php the_title();?></a><?php echo (!empty($small))  ? '</h3>' : '</h2>' ;?>
    	<div class="post-meta mb20"> <?php meta_small( true, false, true ); ?> </div> 
    	<?php if(!$small):?>
            <p><?php kama_excerpt('maxchar=150'); ?></p> 
            <?php if($secondtype == '3'){
                echo '<a class="blockstyle mt20" href="'.esc_url( $category_link ).'">'.$category_name.' <i class="fa-arrow-right far ml5"></i></a>';
            }
            ?>
        <?php endif;?>            
    </div> 
</div> 