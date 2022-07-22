<!-- Logo section -->
<div class="<?php if (rehub_option('rehub_sticky_nav') ==true){echo 'rh-stickme ';}?>logo_section_wrap header_one_row header_nine_style">
    <div class="rh-container">
        <div class="logo-section rh-flex-center-align rh-flex-columns tabletblockdisplay"> 

            <div class="main-nav flex-3col-1 rh-flex-right-align<?php echo ''.$header_menuline_style;?>">      
                <?php wp_nav_menu( array( 'container_class' => 'top_menu', 'container' => 'nav', 'theme_location' => 'primary-menu', 'fallback_cb' => 'add_menu_for_blank', 'walker' => new Rehub_Walker ) ); ?>
                <div class="responsive_nav_wrap rh_mobile_menu">
                    <div id="dl-menu" class="dl-menuwrapper rh-flex-center-align">
                        <button id="dl-trigger" class="dl-trigger" aria-label="Menu">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <line stroke-linecap="round" id="rhlinemenu_1" y2="7" x2="29" y1="7" x1="3"/>
                                    <line stroke-linecap="round" id="rhlinemenu_2" y2="16" x2="18" y1="16" x1="3"/>
                                    <line stroke-linecap="round" id="rhlinemenu_3" y2="25" x2="26" y1="25" x1="3"/>
                                </g>
                            </svg>
                        </button>
                        <div id="mobile-menu-icons" class="rh-flex-center-align rh-flex-right-align">
                            <div id="slide-menu-mobile"></div>
                        </div>
                    </div>
                    <?php do_action('rh_mobile_menu_panel'); ?>
                </div>
                <div class="search-header-contents"><?php get_search_form() ?></div>
            </div>

            <div class="logo hideontablet flex-3col-2">
                <?php if(rehub_option('rehub_logo')) : ?>
                    <a href="<?php echo home_url(); ?>" class="logo_image"><img src="<?php echo rehub_option('rehub_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" height="<?php echo rehub_option( 'rehub_logo_retina_height' ); ?>" width="<?php echo rehub_option( 'rehub_logo_retina_width' ); ?>" /></a>
                <?php elseif (rehub_option('rehub_text_logo')) : ?>
                <div class="textlogo fontbold rehub-main-color"><?php echo rehub_option('rehub_text_logo'); ?></div>
                <div class="sloganlogo">
                    <?php if(rehub_option('rehub_text_slogan')) : ?><?php echo rehub_option('rehub_text_slogan'); ?><?php else : ?><?php bloginfo( 'description' ); ?><?php endif; ?>
                </div> 
                <?php else : ?>
                    <div class="textlogo fontbold rehub-main-color"><?php bloginfo( 'name' ); ?></div>
                    <div class="sloganlogo"><?php bloginfo( 'description' ); ?></div>
                <?php endif; ?>       
            </div> 

            <div class="flex-3col-3">
                <div class="header-actions-logo floatright">
                    <div class="tabledisplay">
                        <?php if(rehub_option('header_nine_more_element') != '') : ?>
                            <?php $custom_element = rehub_option('header_nine_more_element'); ?>
                            <div class="celldisplay link-add-cell">
                                <?php echo do_shortcode($custom_element);?>
                            </div>
                        <?php endif; ?>                                    
                        <div class="celldisplay login-btn-cell">
                            <?php $loginurl = (rehub_option('custom_login_url')) ? esc_url(rehub_option('custom_login_url')) : '';?>
                            <?php $classmenu = 'rh-header-icon rh_login_icon_n_btn mobileinmenu floatright ';?>
                            <?php echo wpsm_user_modal_shortcode(array('class' =>$classmenu, 'loginurl'=>$loginurl, 'icon'=> 'fal fa-user-alt'));?>                   
                        </div>
                        <?php if(rehub_option('header_nine_wishlist')):?>
                            <div class="celldisplay text-center">
                                <a href="<?php echo esc_url(rehub_option('header_nine_wishlist'));?>" class="rh-header-icon mobileinmenu rh-wishlistmenu-link">
                                    <?php  
                                        $likedposts = '';       
                                        if ( is_user_logged_in() ) { // user is logged in
                                            global $current_user;
                                            $user_id = $current_user->ID; // current user
                                            $likedposts = get_user_meta( $user_id, "_wished_posts", true);
                                        }
                                        else{
                                            $ip = rehub_get_ip(); // user IP address
                                            $likedposts = get_transient('re_guest_wishes_' . $ip);
                                        } 

                                        $wishnotice = (!empty($likedposts)) ? '<span class="rh-icon-notice rehub-main-color-bg">'.count($likedposts).'</span>' : '<span class="rh-icon-notice rhhidden rehub-main-color-bg"></span>';
                                    ?>
                                    <span class="fal fa-heart position-relative">
                                        <?php echo ''.$wishnotice;?>
                                    </span>
                                </a>                            
                            </div> 
                        <?php endif; ?>                          
                        <?php 
                            echo '<div class="celldisplay mobileinmenu rh-comparemenu-link rh-header-icon">';
                            echo rh_compare_icon(array());
                            echo '</div>';                        
                            global $woocommerce;
                            if ($woocommerce){
                            echo '<div class="celldisplay rh_woocartmenu_cell"><a class="rh-header-icon rh-flex-center-align rh_woocartmenu-link cart-contents cart_count_'.$woocommerce->cart->cart_contents_count.'" href="'.wc_get_cart_url().'"><span class="rh_woocartmenu-icon"><span class="rh-icon-notice rehub-main-color-bg">'.$woocommerce->cart->cart_contents_count.'</span></span><span class="rh_woocartmenu-amount">'.$woocommerce->cart->get_cart_total().'</span></a></div>';
                            }                              
                        ?>
                    </div>                     
                </div>  
            </div>                        
        </div>
    </div>
</div>
<!-- /Logo section -->  