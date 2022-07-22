<!-- Logo section -->
<div class="<?php if (rehub_option('rehub_sticky_nav') ==true){echo 'rh-stickme ';}?>header_five_style logo_section_wrap header_one_row">
    <div class="rh-container">
        <div class="logo-section rh-flex-center-align tabletblockdisplay">
            <div class="logo hideontablet">
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
            <!-- Main Navigation -->
            <?php if(rehub_option('header_six_src') == 1) : ?>
              <div class="rh-flex-grow1 mr20 ml20 hideontablet">
                <div class="head_search"><?php get_search_form(); ?></div>
              </div>
            <?php endif; ?>            
            <div class="main-nav header_icons_menu rh-flex-right-align<?php if (rehub_option('rehub_logo_inmenu') !='') {echo ' mob-logo-enabled';}?><?php echo ''.$header_menuline_style;?>">      
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
            <?php if(rehub_option('header_six_btn') == 1) : ?>
                <?php $rtlclass = (is_rtl()) ? 'mr15' : 'ml15'; ?>
                <?php $btnlink = rehub_option('header_six_btn_url'); ?>
                <?php $btnlabel = rehub_option('header_six_btn_txt'); ?>
                <?php $btn_color = (rehub_option('header_six_btn_color') != '') ? rehub_option('header_six_btn_color') : 'btncolor'; ?>
                <?php $header_six_btn_login = (rehub_option('header_six_btn_login') == 1) ? ' act-rehub-login-popup' : ''; ?>
                <?php $btnclass = 'rh-flex-right-align addsomebtn mobileinmenu '.$rtlclass.$header_six_btn_login;?>
                <?php echo wpsm_shortcode_button(array('icon'=>'plus', 'link'=>$btnlink, 'class'=>$btnclass, 'color'=>$btn_color), $btnlabel);?>  
            <?php endif; ?>
            <?php if(rehub_option('header_six_login') == 1) : ?>
                <?php $rtlclass = (is_rtl()) ? 'mr15' : 'ml15'; ?>
                <?php $loginurl = (rehub_option('custom_login_url')) ? esc_url(rehub_option('custom_login_url')) : '';?>
                <?php $classmenu = 'rh-flex-right-align mobileinmenu '.$rtlclass;?>
                <?php echo wpsm_user_modal_shortcode(array('as_btn'=> 1, 'class' =>$classmenu, 'loginurl'=>$loginurl));?> 
            <?php endif; ?>                         
            <!-- /Main Navigation -->                                                        
        </div>
    </div>
</div>
<!-- /Logo section -->  
