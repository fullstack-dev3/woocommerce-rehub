<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php if($btnwoo) :?>
    <?php if ($product->get_type() =='external'):?>
        <?php $afflink = $product->add_to_cart_url(); $afftarget = ' target="_blank" rel="nofollow sponsored"';?>
    <?php else:?>
        <?php $afflink = get_post_permalink($id); $afftarget = '';?>
    <?php endif;?>
<?php else:?>
    <?php $afflink = $offer_url; $afftarget = '';?>
<?php endif;?>

<?php wp_enqueue_style('eggrehub'); $coupon_style = $expired = ''; if(!empty($offer_coupon_date)) : ?>
    <?php
        $timestamp1 = strtotime($offer_coupon_date) + 86399;
        $seconds = $timestamp1 - (int)current_time('timestamp',0);
        $days = floor($seconds / 86400);
        $seconds %= 86400;
        if ($days > 0) {
            $coupon_text = $days.' '.esc_html__('days left', 'rehub-theme');
            $coupon_style = '';
            $expired = 'no';
        }
        elseif ($days == 0){
            $coupon_text = esc_html__('Last day', 'rehub-theme');
            $coupon_style = '';
            $expired = 'no';
        }
        else {
            $coupon_text = esc_html__('Expired', 'rehub-theme');
            $coupon_style = ' expired_coupon';
            $expired = '1';
        }
    ?>
<?php endif ;?> 
<?php
    if ($offer_coupon_mask_text =='') {
        if(rehub_option('rehub_mask_text') !=''){
            $offer_coupon_mask_text = rehub_option('rehub_mask_text');
        }
        else {
            $offer_coupon_mask_text = esc_html__('Reveal', 'rehub-theme');
        }
    }
?>
<?php $coupon_mask_enabled = (!empty($offer_coupon) && ($offer_coupon_mask =='1' || $offer_coupon_mask =='on') && $expired!='1') ? '1' : ''; ?> <?php $reveal_enabled = ($coupon_mask_enabled =='1') ? ' reveal_enabled' : '';?>
<div class="bigofferblock pt20 pl20 pr20 <?php echo ''.$reveal_enabled; echo ''.$coupon_style; ?>">
<div class="col_wrap_two mb0">
    <div class="product_egg">
        <div class="image col_item mobileblockdisplay">
            <a class="re_track_btn" href="<?php echo esc_url($afflink) ;?>"<?php echo ''.$afftarget ;?>>
                <?php WPSM_image_resizer::show_static_resized_image(array('src'=> $offer_thumb, 'width'=> 500, 'title' => $offer_title));?>
                <?php if(!empty($percentageSaved)) : ?>
                    <span class="sale_a_proc">
                        <?php    
                            echo '-'.$percentageSaved.'%';
                        ;?>
                    </span>
                <?php endif ;?>                                   
            </a>                             
        </div>
        <div class="product-summary col_item mobileblockdisplay">         
            <h2 class="product_title entry-title">
                <a class="re_track_btn" href="<?php echo esc_url($afflink) ;?>"<?php echo ''.$afftarget ;?>>
                    <?php echo esc_attr($offer_title); ?> 
                </a>
            </h2>
            <?php  if ((int)$rating > 0 && (int)$rating <= 5): ?>
                <div class="cegg-rating">
                    <?php
                    echo str_repeat("<span>&#x2605;</span>", (int)$rating);
                    echo str_repeat("<span>☆</span>", 5 - (int)$rating);
                    ?>
                </div>   
            <?php endif; ?>            

            <?php if($offer_price) : ?>
                <div class="deal-box-price">
                    <?php echo esc_html($offer_price); ?>
                    <?php if($offer_price_old) : ?>
                    <span class="retail-old">
                      <strike><?php echo esc_html($offer_price_old); ?></strike>
                    </span>
                    <?php endif ;?>                                      
                </div>                
            <?php endif ;?>

            <?php if($disclaimer):?>
                <div class="rev_disclaimer font70 greencolor lineheight15 mb15"><?php echo wp_kses($disclaimer, 'post');?></div>
            <?php endif;?>            
                                              
            <div class="buttons_col">
                <div class="priced_block clearfix">
                    <div>
                        <?php if($btnwoo):?>
                            <?php echo ''.$btnwoo;?>
                        <?php else:?>
                            <a class="re_track_btn btn_offer_block" href="<?php echo esc_url($afflink) ;?>"<?php echo ''.$afftarget ;?>>
                                <?php if($offer_btn_text !='') :?>
                                    <?php echo ''.$offer_btn_text ; ?>
                                <?php elseif(rehub_option('rehub_btn_text') !='') :?>
                                    <?php echo rehub_option('rehub_btn_text') ; ?>
                                <?php else :?>
                                    <?php esc_html_e('Buy this item', 'rehub-theme') ?>
                                <?php endif ;?>
                            </a> 
                        <?php endif;?>                                              
                    </div>
                    <?php if(!empty($offer_coupon)) :
                        wp_enqueue_script('zeroclipboard');
                        if (empty($atts['offer_coupon_mask'])) :
                            echo '<div class="rehub_offer_coupon mt15 not_masked_coupon ';
                                if(!empty($offer_coupon_date)) :
                                    echo ''.$coupon_style;
                                endif;
                            echo '" data-clipboard-text="'.$offer_coupon.'"><i class="fal fa-cut fa-rotate-180"></i><span class="coupon_text">'.$offer_coupon.'</span></div>';
                        else :
                            wp_enqueue_script('affegg_coupons');
                            echo '<div class="rehub_offer_coupon mt15 free_coupon_width masked_coupon ';
                                if(!empty($offer_coupon_date)) :
                                    echo ''.$coupon_style;
                                endif;
                            echo '" data-clipboard-text="'.rawurlencode(esc_html($offer_coupon)).'" data-codetext="'.rawurlencode(esc_html($offer_coupon)).'" data-dest="'.esc_url($offer_url).'">'.$offer_coupon_mask_text.'<i class="far fa-external-link-square"></i></div>';
                        endif;  
                    endif;
                    if(!empty($offer_coupon_date)) :
                        echo '<div class="time_offer">'.$coupon_text.'</div>';
                    endif;
                    ?>                    
                </div>                
            </div>   
              
            <?php if ($offer_desc): ?>
                <div class="bigofferdesc"><?php echo ''.$offer_desc; ?></div>                                                   
            <?php endif; ?>              
        </div>           
    </div> 
</div>
</div>  
<div class="clearfix"></div> 