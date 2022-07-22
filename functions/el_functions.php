<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php
// Enqueue Scripts
add_action( 'elementor/preview/enqueue_scripts', function () {
    //wp_enqueue_script('modulobox');
    wp_enqueue_script('gsap');
    wp_enqueue_script('gsapsplittext');
    wp_enqueue_script('gsapsvgdraw');
    wp_enqueue_script('gsapsvgpath');
    wp_enqueue_script('scrollmagic');
    wp_enqueue_script('tipsy');
    wp_enqueue_script('zeroclipboard');
    wp_enqueue_script('rehub-elementor', get_template_directory_uri() . '/rehub-elementor/js/custom-elementor.js', array('jquery'), false, true);
}); 
add_action( 'elementor/preview/enqueue_styles', function() {
    wp_enqueue_style( 'video-pl' );
    //wp_enqueue_style('modulobox');
} );    

add_action( 'elementor/elements/categories_registered', function( $elements_manager ) {
     $elements_manager->add_category( 'rehub-category', [ 'title' => esc_html__( 'Rehub Woocommerce Modules', 'rehub-theme' ), 'icon' => 'eicon-woocommerce' ] );
     $elements_manager->add_category( 'content-modules', [ 'title' => esc_html__( 'Rehub Post Modules', 'rehub-theme' ) ] );
     $elements_manager->add_category( 'deal-helper', [ 'title' => esc_html__( 'Rehub Deal/Coupon Modules', 'rehub-theme' ) ] );
     $elements_manager->add_category( 'helpler-modules', [ 'title' => esc_html__( 'Rehub Helper Modules', 'rehub-theme' ) ] );       
});

add_action( 'init', function () {
    // Ajax general callback methods  and control
    require_once (locate_template('rehub-elementor/controls/ajax-callbacks.php'));
    require_once (locate_template('rehub-elementor/controls/select2ajax-control.php'));
    // Abstracts
    require_once (rh_locate_template('rehub-elementor/abstracts/content-base-widget.php'));

    // Widgets
    if(class_exists('Woocommerce')){
        // Abstracts
        require_once (rh_locate_template('rehub-elementor/abstracts/woo-base-widget.php')); 

        require_once (rh_locate_template('rehub-elementor/wpsm-woogrid.php'));
        require_once (rh_locate_template('rehub-elementor/wpsm-woocolumns.php'));       
        require_once (rh_locate_template('rehub-elementor/wpsm-woorows.php'));
        require_once (rh_locate_template('rehub-elementor/wpsm-woolist.php'));
        require_once (rh_locate_template('rehub-elementor/wpsm-woofeatured.php'));
        require_once (rh_locate_template('rehub-elementor/wpsm-woocarousel.php'));
        require_once (rh_locate_template('rehub-elementor/wpsm-woocomparebars.php'));
         require_once (rh_locate_template('rehub-elementor/wpsm-wooday.php'));
    }

    require_once (rh_locate_template('rehub-elementor/wpsm_columngrid.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-newslist.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-regularblog.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-masonrygrid.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-simplelist.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-postfeatured.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-news-with-thumbs.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-news-ticker.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm_coloredgrid.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-3col-grid.php'));        
    
    require_once (rh_locate_template('rehub-elementor/wpsm-deallist.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-dealgrid.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-dealcarousel.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-reviewlist.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-offerbox.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-CEbox.php'));

    require_once (rh_locate_template('rehub-elementor/wpsm-hover-banner.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-theme.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-taxarchive.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-videolist.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-catbox.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-proscons.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-searchbox.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-cardbox.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-getter.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-buttonpopup.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-versustable.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-countdown.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-itinerary.php'));    
    require_once (rh_locate_template('rehub-elementor/wpsm-reviewbox.php')); 
    require_once (rh_locate_template('rehub-elementor/wpsm-tabevery.php'));
    require_once (rh_locate_template('rehub-elementor/wpsm-canvas.php'));  
    require_once (rh_locate_template('rehub-elementor/wpsm-3dcanvas.php'));

    //require_once (rh_locate_template('rehub-elementor/wpsm-twocolnews.php'));
    //require_once (rh_locate_template('rehub-elementor/wpsm-numhead.php')); 
    //require_once (rh_locate_template('rehub-elementor/wpsm-box.php'));
});

if(!function_exists('rh_add_el_page_settings_controls')){
    function rh_add_el_page_settings_controls( $page ) {
        if(isset($page)) {
            $page->add_control( 'content_type', [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Type of content area', 'rehub-theme' ),
                'default'    => 'def',
                'options'     => [
                    'def'   =>  esc_html__('Content with sidebar', 'rehub-theme'),
                    'full_width'   =>  esc_html__('Full Width Content Box', 'rehub-theme'),
                    'full_post_area'   =>  esc_html__('Full width of browser window', 'rehub-theme')
                ],
                'condition'  => [ 'template' => [ 'default' ] ],
                'label_block'  => true,
            ]);
            $page->add_control( '_header_disable', [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'How to show header?', 'rehub-theme' ),
                'default'    => '0',
                'options'     => [
                    '0'   =>  esc_html__('Default', 'rehub-theme'),
                    '1'   =>  esc_html__('Disable header', 'rehub-theme'),
                    '2'   =>  esc_html__('Transparent', 'rehub-theme')
                ],
                'condition'  => [ 'template' => [ 'default' ] ],
                'label_block'  => true,
            ]); 
            $page->add_control( '_enable_preloader', [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Enable page preloader', 'rehub-theme' ),
                'label_on'    => esc_html__('Yes', 'rehub-theme'),
                'label_off'   => esc_html__('No', 'rehub-theme'),
                'return_value' => '1',
                'condition'  => [ 'template' => [ 'default' ] ],
            ]);                         
            $page->add_control( 'menu_disable', [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Disable menu', 'rehub-theme' ),
                'label_on'    => esc_html__('Yes', 'rehub-theme'),
                'label_off'   => esc_html__('No', 'rehub-theme'),
                'selectors' => [
                     'nav.top_menu, .responsive_nav_wrap' => 'display: none !important',
                ],
                'condition'  => [ 'template' => [ 'default' ] ],                
            ]); 
            $page->add_control( '_footer_disable', [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Disable footer', 'rehub-theme' ),
                'label_on'    => esc_html__('Yes', 'rehub-theme'),
                'label_off'   => esc_html__('No', 'rehub-theme'),
                'return_value' => '1',
                'condition'  => [ 'template' => [ 'default' ] ],
            ]);                                     
        }
    }       
}
add_action( 'elementor/element/wp-page/document_settings/before_section_end', 'rh_add_el_page_settings_controls', 10, 2 ); 

if(!function_exists('rh_register_elementor_locations')){
function rh_register_elementor_locations( $elementor_theme_manager ) {
    $elementor_theme_manager->register_location(
        'woo_btn_code_area',
        [
            'label' => esc_html__( 'Woo Code area near Button', 'rehub-theme' ),
            'multiple' => true,
            'edit_in_content' => true,
        ]
    );
    $elementor_theme_manager->register_location(
        'woo_btn_content_area',
        [
            'label' => esc_html__( 'Woo Code area near Short Description', 'rehub-theme' ),
            'multiple' => true,
            'edit_in_content' => true,
        ]
    );
    $elementor_theme_manager->register_location(
        'woo_btn_footer_area',
        [
            'label' => esc_html__( 'Woo Code area after content', 'rehub-theme' ),
            'multiple' => true,
            'edit_in_content' => true,
        ]
    );                      
}
}
add_action( 'elementor/theme/register_locations', 'rh_register_elementor_locations' );  

/*add_action('elementor/widgets/widgets_registered', function($widgets_manager){
    $elementor_widget_blacklist = array('star-rating');
    foreach($elementor_widget_blacklist as $widget_name){
        $widgets_manager->unregister_widget_type($widget_name);
    }
}, 15);*/

// Font-awesome pro support
add_action( 'elementor/editor/before_enqueue_scripts', function() {
    if ( ! defined( 'ELEMENTOR_PRO_VERSION' ) ) {
        wp_enqueue_style('elprostyle', get_template_directory_uri() . '/css/elpro.css', array(), '1.1');
    }
    wp_enqueue_style( 'rehubfontawesome', get_template_directory_uri() . '/admin/fonts/fontawesome/font-awesome.min.css', array(), '5.3.1' );
} );   
add_action( 'elementor/frontend/after_enqueue_styles', function () { 
    wp_dequeue_style( 'font-awesome' );
    wp_dequeue_style( 'font-awesome-5-all' );
    wp_dequeue_style('font-awesome-4-shim');
    wp_dequeue_script('font-awesome-4-shim');  
}, 15 );
add_action( 'elementor/editor/after_enqueue_styles', function () { 
    wp_dequeue_style( 'font-awesome' );
    wp_dequeue_style( 'font-awesome-5-all' );
    wp_dequeue_style('font-awesome-4-shim');
    wp_dequeue_script('font-awesome-4-shim');  
}, 15 );

add_filter('elementor/icons_manager/native', 'rh_change_native_fa', 99);
function rh_change_native_fa($tabs){
    return [
            'rh-regular' => [
                'name' => 'fa-regular',
                'label' => esc_html__( 'Font Awesome - Regular', 'rehub-theme' ),
                'url' => '',
                'enqueue' => '',
                'prefix' => 'fa-',
                'displayPrefix' => 'far',
                'labelIcon' => 'fab fa-font-awesome-alt',
                'ver' => '5.9.0',
                'fetchJson' => get_template_directory_uri() . '/rehub-elementor/solid.json',
                'native' => true,
            ],
            'rh-solid' => [
                'name' => 'fa-solid',
                'label' => esc_html__( 'Font Awesome - Solid', 'rehub-theme' ),
                'url' => '',
                'enqueue' => '',
                'prefix' => 'fa-',
                'displayPrefix' => 'fas',
                'labelIcon' => 'fab fa-font-awesome',
                'ver' => '5.9.0',
                'fetchJson' => get_template_directory_uri() . '/rehub-elementor/solid.json',
                'native' => true,
            ],
            'rh-light' => [
                'name' => 'fa-light',
                'label' => esc_html__( 'Font Awesome - Light', 'rehub-theme' ),
                'url' => '',
                'enqueue' => '',
                'prefix' => 'fa-',
                'displayPrefix' => 'fal',
                'labelIcon' => 'fab fa-font-awesome',
                'ver' => '5.9.0',
                'fetchJson' => get_template_directory_uri() . '/rehub-elementor/solid.json',
                'native' => true,
            ],            
            'rh-brands' => [
                'name' => 'fa-brands',
                'label' => esc_html__( 'Font Awesome - Brands', 'rehub-theme' ),
                'url' => '',
                'enqueue' => '',
                'prefix' => 'fa-',
                'displayPrefix' => 'fab',
                'labelIcon' => 'fab fa-font-awesome-flag',
                'ver' => '5.9.0',
                'fetchJson' => get_template_directory_uri() . '/rehub-elementor/brands.json',
                'native' => true,
            ],
        ];
}

add_action( 'elementor/frontend/widget/before_render', 'RH_el_elementor_frontend' );
add_action( 'elementor/frontend/section/before_render', 'RH_el_elementor_frontend_section' );
add_action( 'elementor/element/section/section_advanced/after_section_end', 'RH_custom_section_elementor', 10, 2 );
add_action( 'elementor/element/common/_section_responsive/after_section_end', 'RH_parallax_el_elementor', 10, 2 );
add_action( 'elementor/element/html/section_title/after_section_end', 'RH_el_html_add_custom', 10, 2 );
add_action( 'elementor/widget/render_content', 'RH_el_custom_widget_render', 10, 2 );
add_filter('elementor/controls/animations/additional_animations', 'RH_additional_el_annimation');
add_filter( 'elementor/widget/print_template', 'rh_el_custom_print_template', 10, 2 );
add_action( 'elementor/element/image-carousel/section_image_carousel/before_section_end', 'RH_el_imagegal_add_custom', 10, 2 );
add_filter('elementor/image_size/get_attachment_image_html', 'rh_el_add_lazy_load_images',10,4);


function RH_custom_section_elementor( $obj, $args ) {

    $obj->start_controls_section(
        'section_rh_stickyel',
        array(
            'label' => esc_html__( 'RH Smart Sticky Scroll and Parallax', 'rehub-theme' ),
            'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
        )
    );

    $obj->add_control(
        'rh_stickyel_section_sticky',
        array(
            'label'        => esc_html__( 'Enable smart scroll', 'rehub-theme' ),
            'description' => esc_html__( 'You must have minimum two columns. Smart scroll is visible only on frontend site and not visible in Editor mode of Elementor', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'true',
            'prefix_class' => 'rh-elementor-sticky-',
        )
    );

    $obj->add_control(
        'rh_stickyel_top_spacing',
        array(
            'label'   => esc_html__( 'Top Spacing', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 500,
            'step'    => 1,
            'condition' => array(
                'rh_stickyel_section_sticky' => 'true',
            ),
        )
    );

    $obj->add_control(
        'rh_stickyel_bottom_spacing',
        array(
            'label'   => esc_html__( 'Bottom Spacing', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 500,
            'step'    => 1,
            'condition' => array(
                'rh_stickyel_section_sticky' => 'true',
            ),
        )
    );

    $obj->add_control(
        'rh_parallax_bg',
        array(
            'label'        => esc_html__( 'Enable parallax for background image', 'rehub-theme' ),
            'description' => esc_html__( 'Add background in Style section', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'true',
            'prefix_class' => 'rh-parallax-bg-',
        )
    );

    $obj->add_control(
        'rh_parallax_bg_speed',
        array(
            'label'   => esc_html__( 'Parallax speed', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 1,
            'max'     => 200,
            'step'    => 1,
            'default' => 10,
            'condition' => array(
                'rh_parallax_bg' => 'true',
            ),
            'prefix_class' => 'rh-parallax-bg-speed-',
        )
    );      

    $obj->end_controls_section();
} 
function RH_parallax_el_elementor( $obj, $args ) {

    $obj->start_controls_section(
        'rh_parallax_el_section',
        array(
            'label' => esc_html__( 'Re:Hub Quick Effects', 'rehub-theme' ),
            'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
        )
    );

    $obj->add_control(
        'rh_infinite_rotate',
        array(
            'label'        => esc_html__( 'Enable Infinite rotating', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'infinite',               
            'prefix_class' => 'rotate',
        )
    ); 
    $obj->add_control(
        'rh_infinite_leftright',
        array(
            'label'        => esc_html__( 'Enable Infinite Left to right', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'infinite',               
            'prefix_class' => 'leftright',
        )
    ); 
    $obj->add_control(
        'rh_infinite_updownright',
        array(
            'label'        => esc_html__( 'Enable Infinite Up and Down', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'infinite',               
            'prefix_class' => 'upanddown',
        )
    );
    $obj->add_control(
        'rh_infinite_fastshake',
        array(
            'label'        => esc_html__( 'Enable Infinite Shake', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'Shake',               
            'prefix_class' => 'fast',
        )
    );
    
    $obj->add_control( 'rh_infinite_speed', [
        'type'        => \Elementor\Controls_Manager::SELECT,
        'label'       => esc_html__( 'Animation Speed', 'rehub-theme' ),
        'options'     => [
            '5'   => '5s',
            '10'   =>  '10s',
            '15'   =>  '15s',
            '20'   =>  '20s',
            '25'   =>  '25s',
            '50'   =>  '50s',
            '100'   =>  '100s',                        
            '0'   =>  '0s',
        ],               
        'prefix_class' => 'animationspeed',
    ]); 
    $obj->add_control(
        'rh_perspective_boxshadow',
        array(
            'label'        => esc_html__( 'Enable Perspective Box shadow', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => '1',
            'selectors' => [
                '{{WRAPPER}} > .elementor-widget-container' => 'box-shadow: 0 1px 0 #ccc, 0 2px 0 #ccc, 0 3px 0 #ccc, 0 4px 0 #ccc, 0 5px 0 #ccc, 0 6px 0 #ccc, 0 7px 0 #ccc, 0 8px 0 #ccc, 0 9px 0 #ccc, 0 50px 30px rgba(0,0,0,.25)',
            ],                
        )
    ); 
    $obj->add_control(
        'rh_perspective_textshadow',
        array(
            'label'        => esc_html__( 'Enable Perspective Text shadow', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => '1',
            'selectors' => [
                '{{WRAPPER}} > .elementor-widget-container' => 'text-shadow: 0 1px 0 #ccc, 0 2px 0 #ccc, 0 3px 0 #ccc, 0 4px 0 #ccc, 0 5px 0 #ccc, 0 6px 0 #ccc, 0 7px 0 #ccc, 0 8px 0 #ccc, 0 9px 0 #ccc, 0 50px 30px rgba(0,0,0,.25)',
            ],                
        )
    );                
    $obj->add_control(
        'rh_parallax_circle',
        array(
            'label'   => esc_html__( 'Make shape', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 1,
            'max'     => 3000,
            'step'    => 1,
            'selectors' => [
                '{{WRAPPER}} > .elementor-widget-container' => 'width: {{VALUE}}px;height: {{VALUE}}px;display: flex; align-items: center;justify-content: center;',
            ],
        )
    );  
    $obj->add_control(
        'rh_make_rotate',
        array(
            'label'   => esc_html__( 'Rotation (deg)', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 1,
            'max'     => 360,
            'step'    => 1,
            'selectors' => [
                '{{WRAPPER}} > .elementor-widget-container' => 'transform: rotate({{VALUE}}deg);',
            ],
        )
    ); 

    $obj->end_controls_section(); 

    $obj->start_controls_section(
        'rh_gsap_section',
        array(
            'label' => esc_html__( 'Re:Hub WOW Animations', 'rehub-theme' ),
            'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
        )
    ); 

    $obj->add_control(
        'rh_gsap',
        array(
            'label'        => esc_html__( 'Enable Advanced animations', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'true',
        )
    );
    $obj->add_control(
        'rhhr1',
        [
            'label' => __( 'Transform Options', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        ]
    );
    $obj->add_control(
        'rh_gsap_x',
        array(
            'label'   => esc_html__( 'Translate X', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => -5000,
            'max'     => 5000,
            'step'    => 1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
            
        )
    ); 

    $obj->add_control(
        'rh_gsap_y',
        array(
            'label'   => esc_html__( 'Translate Y', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => -5000,
            'max'     => 5000,
            'step'    => 1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    );  

    $obj->add_control(
        'rh_gsap_xo',
        array(
            'label'   => esc_html__( 'Translate X (%)', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => -1000,
            'max'     => 1000,
            'step'    => 1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 

    $obj->add_control(
        'rh_gsap_yo',
        array(
            'label'   => esc_html__( 'Translate Y (%)', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => -1000,
            'max'     => 1000,
            'step'    => 1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 

    $obj->add_control(
        'rh_gsap_r',
        array(
            'label'   => esc_html__( 'Rotation', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => -3600,
            'max'     => 3600,
            'step'    => 1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 

    $obj->add_control(
        'rh_gsap_rx',
        array(
            'label'   => esc_html__( 'Rotation X', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => -3600,
            'max'     => 3600,
            'step'    => 1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 

    $obj->add_control(
        'rh_gsap_ry',
        array(
            'label'   => esc_html__( 'Rotation Y', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => -3600,
            'max'     => 3600,
            'step'    => 1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 
 

    $obj->add_control(
        'rh_gsap_scale',
        array(
            'label'   => esc_html__( 'Scale', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 30,
            'step'    => 0.1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 

    $obj->add_control(
        'rh_gsap_scale_x',
        array(
            'label'   => esc_html__( 'Scale X', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 30,
            'step'    => 0.1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 

    $obj->add_control(
        'rh_gsap_width',
        array(
            'label'   => esc_html__( 'Width', 'rehub-theme' ),
            'description' => 'set with px, %, em',
            'type'    => Elementor\Controls_Manager::TEXT,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 

    $obj->add_control(
        'rh_gsap_height',
        array(
            'label'   => esc_html__( 'Height', 'rehub-theme' ),
            'description' => 'set with px, %, em',
            'type'    => Elementor\Controls_Manager::TEXT,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    );

    $obj->add_control(
        'rh_gsap_scale_y',
        array(
            'label'   => esc_html__( 'Scale Y', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 30,
            'step'    => 0.1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 

    $obj->add_control(
        'rh_gsap_opacity',
        array(
            'label'   => esc_html__( 'Opacity', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 1,
            'max'     => 100,
            'step'    => 1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    );
    $obj->add_control(
        'rh_gsap_bg', [
            'label' => __('Background Color', 'rehub-theme'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'condition' => [
                'rh_gsap' => 'true'
            ]
        ]
    );
    $obj->add_control( 'rh_gsap_origin', [
        'label' => esc_html__( 'Transform Origin', 'rehub-theme' ),
        'label_block'  => true,
        'description' => 'left, right, top, bottom...',
        'type' => \Elementor\Controls_Manager::TEXT,
        'condition' => [
            'rh_gsap' => 'true'
        ],
    ]);

    $obj->add_control(
        'svgpath',
        [
            'label' => __( 'Animation SVG Path', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        ]
    );
    $obj->add_control( 'rh_gsap_path', [
        'label' => esc_html__( 'Set path', 'rehub-theme' ),
        'description' => esc_html__('can be ID (place with #), svg path coordinates', 'rehub-theme'),
        'label_block'  => true,
        'type' => \Elementor\Controls_Manager::TEXT,
        'condition'=> ['rh_gsap' => 'true' ],
    ]); 
    $obj->add_control( 'rh_gsap_path_align', [
        'label' => esc_html__( 'Align ID', 'rehub-theme' ),
        'description' => esc_html__('By default, element is alighned by itself, but you can set id of path or another element', 'rehub-theme'),
        'label_block'  => true,
        'type' => \Elementor\Controls_Manager::TEXT,
        'condition'=> ['rh_gsap' => 'true', 'rh_gsap_path!' => '' ],
    ]); 
    $obj->add_control(
        'rh_gsap_path_orient',
        array(
            'label'        => esc_html__( 'Orient along path', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'yes',
            'condition'=> ['rh_gsap' => 'true', 'rh_gsap_path!' => '' ],
        )
    );

    $obj->add_control(
        'rhhr2',
        [
            'label' => __( 'Text, SVG, Multi Animations', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        ]
    );

    $obj->add_control( 'rh_gsap_st_type', [
        'type'        => \Elementor\Controls_Manager::SELECT,
        'label'       => esc_html__( 'Enable Advanced Animation', 'rehub-theme' ),
        'options'     => [
            'no'   =>  esc_html__('No', 'rehub-theme'),
            'text'   =>  esc_html__('On Text', 'rehub-theme'),
            'class'   =>  esc_html__('On Multiple objects', 'rehub-theme'),
            'svg'   =>  esc_html__('SVG lines', 'rehub-theme'),
        ],
        'condition' => array(
            'rh_gsap' => 'true',
        ),
    ]);

    $obj->add_control( 'rh_gsap_text', [
        'type'        => \Elementor\Controls_Manager::SELECT,
        'label'       => esc_html__( 'Break type for text', 'rehub-theme' ),
        'options'     => [
            'lines'   =>  esc_html__('Lines', 'rehub-theme'),
            'chars'   =>  esc_html__('Chars', 'rehub-theme'),
            'words'   =>  esc_html__('Words', 'rehub-theme'),
        ],
        'condition'=> [ 'rh_gsap_st_type' => 'text', 'rh_gsap' => 'true' ],
    ]);

    $obj->add_control( 'rh_gsap_stagger', [
        'label' => esc_html__( 'Set stagger class', 'rehub-theme' ),
        'description' => esc_html__('this will trigger animation on all elements with this class with some delay between each item', 'rehub-theme'),
        'label_block'  => true,
        'type' => \Elementor\Controls_Manager::TEXT,
        'condition'=> [ 'rh_gsap_st_type' => 'class', 'rh_gsap' => 'true' ],
    ]); 

    $obj->add_control(
        'rh_gsap_stdelay',
        array(
            'label'   => esc_html__( 'Stagger delay', 'rehub-theme' ),
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 10,
            'step'    => 0.1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    );

    $obj->add_control(
        'rhhr3',
        [
            'label' => __( 'Animation Options', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        ]
    );

    $obj->add_control(
        'rh_gsap_duration',
        array(
            'label'   => esc_html__( 'Duration (s)', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 0.1,
            'max'     => 20,
            'step'    => 0.1,
            'default' => 1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 

    $obj->add_control(
        'rh_gsap_delay',
        array(
            'label'   => esc_html__( 'Delay (s)', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 0.1,
            'max'     => 20,
            'step'    => 0.1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    );

    $obj->add_control( 'rh_gsap_ease', [
        'type'        => \Elementor\Controls_Manager::SELECT,
        'label'       => esc_html__( 'Ease type', 'rehub-theme' ),
        'options'     => [
            'power0-none'   =>  esc_html__('Linear', 'rehub-theme'),
            'power1-in'   =>  esc_html__('Power 1 in', 'rehub-theme'),
            'power1-out'   =>  esc_html__('Power 1 out', 'rehub-theme'),
            'power1-inOut'   =>  esc_html__('Power 1 inOut', 'rehub-theme'),
            'power2-in'   =>  esc_html__('Power 2 in', 'rehub-theme'),
            'power2-out'   =>  esc_html__('Power 2 out', 'rehub-theme'),
            'power2-inOut'   =>  esc_html__('Power 2 inOut', 'rehub-theme'),
            'power3-in'   =>  esc_html__('Power 3 in', 'rehub-theme'),
            'power3-out'   =>  esc_html__('Power 3 out', 'rehub-theme'),
            'power3-inOut'   =>  esc_html__('Power 3 inOut', 'rehub-theme'),
            'power4-in'   =>  esc_html__('Power 4 in', 'rehub-theme'),
            'power4-out'   =>  esc_html__('Power 4 out', 'rehub-theme'),
            'power4-inOut'   =>  esc_html__('Power 4 inOut', 'rehub-theme'),
            'back-in'   =>  esc_html__('Back in', 'rehub-theme'),
            'back-out'   =>  esc_html__('Back out', 'rehub-theme'),
            'back-inOut'   =>  esc_html__('Back inOut', 'rehub-theme'),
            'elastic-in'   =>  esc_html__('elastic in', 'rehub-theme'),
            'elastic-out'   =>  esc_html__('elastic out', 'rehub-theme'),
            'elastic-inOut'   =>  esc_html__('elastic inOut', 'rehub-theme'),
            'circ-in'   =>  esc_html__('circ in', 'rehub-theme'),
            'circ-out'   =>  esc_html__('circ out', 'rehub-theme'),
            'circ-inOut'   =>  esc_html__('circ inOut', 'rehub-theme'),
            'expo-in'   =>  esc_html__('expo in', 'rehub-theme'),
            'expo-out'   =>  esc_html__('expo out', 'rehub-theme'),
            'expo-inOut'   =>  esc_html__('expo inOut', 'rehub-theme'),
            'cine-in'   =>  esc_html__('cine in', 'rehub-theme'),
            'cine-out'   =>  esc_html__('cine out', 'rehub-theme'),
            'cine-inOut'   =>  esc_html__('cine inOut', 'rehub-theme'),
        ],
        'condition' => array(
            'rh_gsap' => 'true',
        ),
    ]);

    $obj->add_control(
        'rh_gsap_infinite',
        array(
            'label'        => esc_html__( 'Enable infinite', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'yes',
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    );
    $obj->add_control(
        'rh_gsap_yoyo',
        array(
            'label'        => esc_html__( 'Enable Yoyo style', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'condition'=> [ 'rh_gsap_infinite' => 'yes', 'rh_gsap' => 'true' ],
        )
    );

    $obj->add_control(
        'rh_gsap_from',
        array(
            'label'        => esc_html__( 'Set direction as FROM', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    ); 

    $obj->add_control(
        'rhhr4',
        [
            'label' => __( 'Trigger Options', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        ]
    );

    $obj->add_control( 'rh_gsap_trigger_field', [
        'label' => esc_html__( 'Css ID of custom trigger.', 'rehub-theme' ),
        'description' => esc_html__('By default, animation will start when you scroll to element. You can place here custom ID for trigger', 'rehub-theme'),
        'label_block'  => true,
        'type' => \Elementor\Controls_Manager::TEXT,
        'condition' => array(
            'rh_gsap' => 'true',
        ),
    ]); 

    $obj->add_control(
    'rh_gsap_sc_dur',
    array(
        'label'   => esc_html__( 'Interpolate animation by Scroll', 'rehub-theme' ),
        'description' => esc_html__('By default, scroll will trigger full animation. If you want to play animation by scrolling, place here number of pixels which will be interpolated with animation. Or place 100% to set object height.', 'rehub-theme'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'condition' => array(
            'rh_gsap' => 'true',
        ),
    )
    ); 

    $obj->add_control(
    'rh_gsap_sc_tr',
    array(
        'label'   => esc_html__( 'Trigger Hook Height', 'rehub-theme' ),
        'description' => esc_html__('By default, trigger is set to top point of element, but you can change this', 'rehub-theme'),
        'type'    => Elementor\Controls_Manager::NUMBER,
        'min'     => 0,
        'max'     => 100,
        'step'    => 1,
        'condition' => array(
            'rh_gsap' => 'true',
        ),
    )
    ); 

    $obj->add_control( 'rh_gsap_pin', [
        'label' => esc_html__( 'Css ID of pin item while scroll', 'rehub-theme' ),
        'description' => esc_html__('We recommend to add also 100% of duration and custom trigger Id to make this working', 'rehub-theme'),
        'label_block'  => true,
        'type' => \Elementor\Controls_Manager::TEXT,
        'condition'=> [ 'rh_gsap' => 'true' ],
    ]); 

    $obj->add_control(
        'rh_gsap_rev', [
            'label' => __('Disable reverse on scroll', 'rehub-theme'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => '',
            'label_on' => __('Yes', 'rehub-theme'),
            'label_off' => __('No', 'rehub-theme'),
            'return_value' => 'yes',
            'condition'=> [ 'rh_gsap' => 'true' ],
        //            
        ]
    );
    $obj->add_control(
        'videoobj',
        [
            'label' => __( 'Video Object', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        ]
    );

    $obj->add_control(
        'rh_gsap_video',
        array(
            'label'   => esc_html__( 'Time for video(s)', 'rehub-theme' ),
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 1000,
            'step'    => 0.1,
            'condition' => array(
                'rh_gsap' => 'true',
            ),
        )
    );

    $obj->add_control(
        'rhhr5',
        [
            'type' => \Elementor\Controls_Manager::DIVIDER,
            'condition'=> [ 'rh_gsap' => 'true' ],
        ]
    );   

    $obj->add_control(
        'rh_reveal', [
            'label' => __('Enabled Reveal', 'rehub-theme'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => '',
            'label_on' => __('Yes', 'rehub-theme'),
            'label_off' => __('No', 'rehub-theme'),
            'return_value' => 'yes',
        //            
        ]
    );
    $obj->add_control(
        'rh_reveal_dir',
        [
            'label' => __( 'Direction', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'lr',
            'options' => [
                'lr' => __( 'Left to Right', 'rehub-theme' ),
                'rl' => __( 'Right to Left', 'rehub-theme' ),
                'tb' => __( 'Top to Bottom', 'rehub-theme' ),
                'bt' => __( 'Bottom to top', 'rehub-theme' ),
            ],
            'condition' => [
                'rh_reveal' => 'yes'
            ]
        ]
    );
    $obj->add_control(
        'rh_reveal_speed', [
            'label' => __('Speed', 'rehub-theme'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 10,
            'step'    => 0.1,
            'default' => 1,
            'condition' => [
                'rh_reveal' => 'yes'
            ]
        ]
    );
    $obj->add_control(
        'rh_reveal_delay', [
            'label' => __('Delay', 'rehub-theme'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min'     => 0,
            'max'     => 10,
            'step'    => 0.1,
            'condition' => [
                'rh_reveal' => 'yes'
            ]
        ]
    );
    $obj->add_control(
        'rh_reveal_bgcolor', [
            'label' => __('Color', 'rehub-theme'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#ccc',
            'selectors' => [
                '{{WRAPPER}} .rh-reveal-block' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'rh_reveal' => 'yes'
            ]
        ]
    );
    $obj->add_control(
        'rhhrrev',
        [
            'type' => \Elementor\Controls_Manager::DIVIDER,
            'condition'=> [ 'rh_reveal' => 'yes' ],
        ]
    ); 

    $obj->add_control(
        'rh_parallax_el',
        array(
            'label'        => esc_html__( 'Enable scroll parallax effect', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'true',
        )
    );

    $obj->add_control(
        'rh_parallax_el_speed',
        array(
            'label'   => esc_html__( 'Speed', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 1,
            'max'     => 200,
            'step'    => 1,
            'default' => 10,
            'condition' => array(
                'rh_parallax_el' => 'true',
            ),
        )
    );
    $obj->add_control(
        'rh_parallax_el_dir',
        array(
            'label'        => esc_html__( 'Enable reverse direction', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'rev',
            'condition' => array(
                'rh_parallax_el' => 'true',
            ),                
        )
    ); 
    $obj->add_control(
        'rhhrelpar',
        [
            'type' => \Elementor\Controls_Manager::DIVIDER,
            'condition'=> [ 'rh_parallax_el' => 'true' ],
        ]
    ); 

    $obj->add_control(
        'rh_parlx_m_el',
        array(
            'label'        => esc_html__( 'Enable mouse move effect', 'rehub-theme' ),
            'type'         => Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
            'label_off'    => esc_html__( 'No', 'rehub-theme' ),
            'return_value' => 'true',
        )
    );

    $obj->add_control(
        'rh_parlx_m_el_speed',
        array(
            'label'   => esc_html__( 'Strength for x and y', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 1,
            'max'     => 200,
            'step'    => 1,
            'default' => 20,
            'condition' => array(
                'rh_parlx_m_el' => 'true',
            ),
        )
    );
    $obj->add_control(
        'rh_parlx_m_el_tilt',
        array(
            'label'   => esc_html__( 'Strength for tilt', 'rehub-theme' ),
            'type'    => Elementor\Controls_Manager::NUMBER,
            'min'     => 1,
            'max'     => 200,
            'step'    => 1,
            'condition' => array(
                'rh_parlx_m_el' => 'true',
            ),
        )
    );                                       

    $obj->end_controls_section();
}
function RH_el_elementor_frontend( $element) {
    if ( $element->get_settings( 'rh_parallax_el' ) == 'true' ) {
        wp_enqueue_script('rh_elparallax');
    } 
    if ( $element->get_settings( 'rh_gsap' ) == 'true' ) {
        wp_enqueue_script('gsap');wp_enqueue_script('scrollmagic');wp_enqueue_script('gsapinit');
    } 
    if ( $element->get_settings( 'rh_gsap' ) == 'true' && $element->get_settings( 'rh_gsap_st_type' ) == 'text' ) {
        wp_enqueue_script('gsapsplittext');
    } 
    if ( $element->get_settings( 'rh_gsap' ) == 'true' && $element->get_settings( 'rh_gsap_st_type' ) == 'svg') {
        wp_enqueue_script('gsapsvgdraw');
    } 
    if ( $element->get_settings( 'rh_gsap' ) == 'true' && $element->get_settings( 'rh_gsap_path' ) !='') {
        wp_enqueue_script('gsapsvgpath');
    } 
    if ( $element->get_settings( 'rh_reveal' ) == 'true' || $element->get_settings( 'rh_parlx_m_el' ) == 'true') {
        wp_enqueue_script('gsap');wp_enqueue_script('gsapinit');
    }            
    return;        
}
function RH_el_elementor_frontend_section( $element) {
    if('section' === $element->get_name()){
        if ( $element->get_settings( 'rh_stickyel_section_sticky' ) == 'true' ) {
            wp_enqueue_script('stickysidebar');
            $element->add_render_attribute( '_wrapper', array(
                'data-sticky-top-offset' => ($element->get_settings('rh_stickyel_top_spacing')  != '') ? $element->get_settings('rh_stickyel_top_spacing') : '',
                'data-sticky-bottom-offset' => ($element->get_settings('rh_stickyel_bottom_spacing')  != '') ? $element->get_settings('rh_stickyel_bottom_spacing') : '',            
            ) );
        }
        if ( $element->get_settings( 'rh_parallax_bg' ) == 'true' ) {
            wp_enqueue_script('rh_elparallax');
        }  
    }       
    return;        
}
function RH_el_html_add_custom( $obj, $args ) {
    $obj->start_controls_section(
        'section_rh_custom_html',
        array(
            'label' => esc_html__( 'Custom JS, CSS', 'rehub-theme' ),
            'tab'   => Elementor\Controls_Manager::TAB_CONTENT,
        )
    );    
    $obj->add_control(
        'rh_js',
        [
            'label' => __( 'Enter your JS code', 'rehub-theme' ),
            'type' => Elementor\Controls_Manager::CODE,
            'default' => '',
            'language' => 'javascript',           
        ]
    );
    $obj->add_control(
        'rh_css',
        [
            'label' => __( 'Enter your CSS code', 'rehub-theme' ),
            'type' => Elementor\Controls_Manager::CODE,
            'default' => '',
            'language' => 'css',          
        ]
    );
    $obj->end_controls_section();    
} 
function RH_el_imagegal_add_custom( $obj, $args ) {
   
    $obj->add_control(
        'rh_image_gal_links',
        [
            'raw' => '<div style="background-color: #dcf0f3; padding:10px; line-height:16px">Divide links with ";" if you want to have separate link for each slide</div>',
            'type'      => \Elementor\Controls_Manager::RAW_HTML,
            'label_block' => true,           
        ]
    );   
} 
function RH_el_custom_widget_render( $content, $widget ) {
    $settings = $widget->get_settings_for_display();
    if ( 'html' === $widget->get_name() ) {  
        if ( ! empty( $settings['rh_js'] ) ) {
            $customjs = $settings['rh_js'];
            wp_add_inline_script('elementor-frontend', $customjs);
        }
        if ( ! empty( $settings['rh_css'] ) ) {
            $customcss = $settings['rh_css'];
            $cssid = 'el_rh_css_html'.uniqid();
            wp_register_style( $cssid, false );
            wp_enqueue_style( $cssid );
            wp_add_inline_style($cssid, $customcss);            
        }  
    }
    if (!empty($settings['rh_gsap'])) {
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            
        }
        $hideclass = '';
        if ( ! empty( $settings['rh_gsap_from'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-from', $settings['rh_gsap_from'] );
        }
        if ( ! empty( $settings['rh_gsap_trigger_field'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-customtrigger', $settings['rh_gsap_trigger_field'] );
        }
        if ( ! empty( $settings['rh_gsap_sc_tr'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-triggerheight', $settings['rh_gsap_sc_tr'] );
        }
        if ( ! empty( $settings['rh_gsap_sc_dur'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-scrollduration', $settings['rh_gsap_sc_dur'] );
        }
        if ( ! empty( $settings['rh_gsap_x'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-x', $settings['rh_gsap_x'] );
        }
        if ( ! empty( $settings['rh_gsap_y'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-y', $settings['rh_gsap_y'] );
        }
        if ( ! empty( $settings['rh_gsap_xo'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-xo', $settings['rh_gsap_xo'] );
        }
        if ( ! empty( $settings['rh_gsap_yo'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-yo', $settings['rh_gsap_yo'] );
        }
        if ( ! empty( $settings['rh_gsap_r'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-r', $settings['rh_gsap_r'] );
        }
        if ( ! empty( $settings['rh_gsap_rx'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-rx', $settings['rh_gsap_rx'] );
        }
        if ( ! empty( $settings['rh_gsap_ry'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-ry', $settings['rh_gsap_ry'] );
        }
        if ( ! empty( $settings['rh_gsap_scale'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-s', $settings['rh_gsap_scale'] );
        }
        if ( ! empty( $settings['rh_gsap_scale_x'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-sx', $settings['rh_gsap_scale_x'] );
        }
        if ( ! empty( $settings['rh_gsap_scale_y'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-sy', $settings['rh_gsap_scale_y'] );
        }
        if ( ! empty( $settings['rh_gsap_width'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-width', $settings['rh_gsap_width'] );
        }
        if ( ! empty( $settings['rh_gsap_height'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-height', $settings['rh_gsap_height'] );
        }
        if ( ! empty( $settings['rh_gsap_opacity'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-o', $settings['rh_gsap_opacity'] );
            if( ! empty( $settings['rh_gsap_from'] ) && $settings['rh_gsap_from'] == 'yes' ){
                if($settings['rh_gsap_opacity'] == 0 || $settings['rh_gsap_opacity'] == 1){
                    $hideclass = ' prehidden';
                }
            }
        }
        if ( ! empty( $settings['rh_gsap_infinite'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-loop', $settings['rh_gsap_infinite'] );
        }
        if ( ! empty( $settings['rh_gsap_yoyo'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-yoyo', $settings['rh_gsap_yoyo'] );
        }
        if ( ! empty( $settings['rh_gsap_delay'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-delay', $settings['rh_gsap_delay'] );
        }
        if ( ! empty( $settings['rh_gsap_ease'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-ease', $settings['rh_gsap_ease'] );
        }
        if ( ! empty( $settings['rh_gsap_pin'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-pin', $settings['rh_gsap_pin'] );
        }
        if ( ! empty( $settings['rh_gsap_stdelay'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-stdelay', $settings['rh_gsap_stdelay'] );
        }
        if ( ! empty( $settings['rh_gsap_bg'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-bg', $settings['rh_gsap_bg'] );
        }
        if ( ! empty( $settings['rh_gsap_stagger'] ) && $settings['rh_gsap_st_type'] == 'class' ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-stagger', $settings['rh_gsap_stagger'] );
        }
        if ( ! empty( $settings['rh_gsap_text'] ) && $settings['rh_gsap_st_type'] == 'text' ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-text', $settings['rh_gsap_text'] );
        }
        if ($settings['rh_gsap_st_type'] == 'svg' ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-svgdraw', 'yes' );
        }
        if ( ! empty( $settings['rh_gsap_origin'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-origin', $settings['rh_gsap_origin'] );
        }
        if ( ! empty( $settings['rh_gsap_rev'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-rev', $settings['rh_gsap_rev'] );
        }
        if ( ! empty( $settings['rh_gsap_path'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-path', $settings['rh_gsap_path'] );
        }
        if ( ! empty( $settings['rh_gsap_path_align'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-path-align', $settings['rh_gsap_path_align'] );
        }
        if ( ! empty( $settings['rh_gsap_path_orient'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-path-orient', $settings['rh_gsap_path_orient'] );
        }
        if ( ! empty( $settings['rh_gsap_video'] ) ) {
            $widget->add_render_attribute( 'ann-wrapper', 'data-video', $settings['rh_gsap_video'] );
        }
        $content = '<div '.$widget->get_render_attribute_string( 'ann-wrapper' ).' data-duration="'.$settings['rh_gsap_duration'].'" class="rh-gsap-wrap'.$hideclass.'">'.$content. '</div>';
    }
    if ( ! empty( $settings['rh_reveal'] )) {
        if ( ! empty( $settings['rh_reveal_dir'] )) {
            $widget->add_render_attribute( 'reveal-wrapper', 'data-reveal-dir', $settings['rh_reveal_dir'] );
        }
        if ( ! empty( $settings['rh_reveal_speed'] )) {
            $widget->add_render_attribute( 'reveal-wrapper', 'data-reveal-speed', $settings['rh_reveal_speed'] );
        }
        if ( ! empty( $settings['rh_reveal_delay'] )) {
            $widget->add_render_attribute( 'reveal-wrapper', 'data-reveal-delay', $settings['rh_reveal_delay'] );
        }
        if ( ! empty( $settings['rh_reveal_bgcolor'] )) {
            $widget->add_render_attribute( 'reveal-wrapper', 'data-reveal-bg', $settings['rh_reveal_bgcolor'] );
        }
        $content = '<div class="rh-reveal-wrap rhhidden position-relative"><div class="rh-reveal-cont">'.$content. '</div><div '.$widget->get_render_attribute_string( 'reveal-wrapper' ).' class="rh-reveal-block abdfullwidth pointernone"></div></div>';
    }
    if ( ! empty( $settings['rh_parallax_el'] )) {
        if ( ! empty( $settings['rh_parallax_el_dir'] )) {
            $widget->add_render_attribute( 'rhpar-wrapper', 'data-parallax-dir', $settings['rh_parallax_el_dir'] );
        }
        if ( ! empty( $settings['rh_parallax_el_speed'] )) {
            $widget->add_render_attribute( 'rhpar-wrapper', 'data-parallax-speed', $settings['rh_parallax_el_speed'] );
        }
        $content = '<div class="rh-parallaxel-true" '.$widget->get_render_attribute_string( 'rhpar-wrapper' ).'>'.$content. '</div>';
    }
    if ( ! empty( $settings['rh_parlx_m_el'] )) {
        if ( ! empty( $settings['rh_parlx_m_el_speed'] )) {
            $widget->add_render_attribute( 'rhmprlx-wrapper', 'data-prlx-xy', $settings['rh_parlx_m_el_speed'] );
        }
        if ( ! empty( $settings['rh_parlx_m_el_tilt'] )) {
            $widget->add_render_attribute( 'rhmprlx-wrapper', 'data-prlx-tilt', $settings['rh_parlx_m_el_tilt'] );
        }
        $content = '<div class="rh-prlx-mouse" '.$widget->get_render_attribute_string( 'rhmprlx-wrapper' ).'>'.$content. '</div>';
    }
    return $content;
}
function rh_el_custom_print_template($content, $widget){
    if (!$content) return '';
    if ( 'html' === $widget->get_name() ) {
        ob_start();
        ?>
        {{{ settings.html }}}
        <# if (settings.rh_css ) { #>
        <style>{{{ settings.rh_css }}}</style>
        <# } #>       
        <?php
        $content = ob_get_clean();
    }
    //check gsap
    $content = "<# if ( settings.rh_gsap ) { 
        if ( settings.rh_gsap_from ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-from', settings.rh_gsap_from );
        }
        if ( settings.rh_gsap_trigger_field ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-customtrigger', settings.rh_gsap_trigger_field );
        }
        if ( settings.rh_gsap_sc_tr ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-triggerheight', settings.rh_gsap_sc_tr );
        }
        if ( settings.rh_gsap_sc_dur ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-scrollduration', settings.rh_gsap_sc_dur );
        }
        if ( settings.rh_gsap_x ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-x', settings.rh_gsap_x );
        }
        if ( settings.rh_gsap_y ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-y', settings.rh_gsap_y );
        }
        if ( settings.rh_gsap_xo ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-xo', settings.rh_gsap_xo );
        }
        if ( settings.rh_gsap_yo ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-yo', settings.rh_gsap_yo );
        }
        if ( settings.rh_gsap_r ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-r', settings.rh_gsap_r );
        }
        if ( settings.rh_gsap_rx ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-rx', settings.rh_gsap_rx );
        }
        if ( settings.rh_gsap_ry ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-ry', settings.rh_gsap_ry );
        }
        if ( settings.rh_gsap_scale ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-s', settings.rh_gsap_scale );
        }
        if ( settings.rh_gsap_scale_x ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-sx', settings.rh_gsap_scale_x );
        }
        if ( settings.rh_gsap_scale_y ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-sy', settings.rh_gsap_scale_y );
        }
        if ( settings.rh_gsap_width ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-width', settings.rh_gsap_width );
        }
        if ( settings.rh_gsap_height ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-height', settings.rh_gsap_height );
        }
        if ( settings.rh_gsap_opacity ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-o', settings.rh_gsap_opacity );
        }
        if ( settings.rh_gsap_infinite ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-loop', settings.rh_gsap_infinite );
        }
        if ( settings.rh_gsap_yoyo ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-yoyo', settings.rh_gsap_yoyo );
        }
        if ( settings.rh_gsap_delay ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-delay', settings.rh_gsap_delay );
        }
        if ( settings.rh_gsap_ease ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-ease', settings.rh_gsap_ease );
        }
        if ( settings.rh_gsap_pin ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-pin', settings.rh_gsap_pin );
        }
        if ( settings.rh_gsap_stdelay ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-stdelay', settings.rh_gsap_stdelay );
        }
        if ( settings.rh_gsap_stagger && settings.rh_gsap_st_type == 'class') {
            view.addRenderAttribute( 'ann-wrapper', 'data-stagger', settings.rh_gsap_stagger );
        }
        if (settings.rh_gsap_st_type == 'svg') {
            view.addRenderAttribute( 'ann-wrapper', 'data-svgdraw', 'yes' );
        }
        if ( settings.rh_gsap_text && settings.rh_gsap_st_type == 'text' ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-text', settings.rh_gsap_text );
        }
        if ( settings.rh_gsap_bg ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-bg', settings.rh_gsap_bg );
        }
        if ( settings.rh_gsap_origin ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-origin', settings.rh_gsap_origin );
        }
        if ( settings.rh_gsap_rev ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-rev', settings.rh_gsap_rev );
        }
        if ( settings.rh_gsap_path ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-path', settings.rh_gsap_path );
        }
        if ( settings.rh_gsap_path_align ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-path-align', settings.rh_gsap_path_align );
        }
        if ( settings.rh_gsap_path_orient ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-path-orient', settings.rh_gsap_path_orient );
        }
        if ( settings.rh_gsap_video ) {
            view.addRenderAttribute( 'ann-wrapper', 'data-video', settings.rh_gsap_video );
        }
        #>
        <div {{{ view.getRenderAttributeString( 'ann-wrapper' ) }}} class=\"rh-gsap-wrap\" data-duration=\"{{{settings.rh_gsap_duration}}}\">" . $content . "</div>
        <# 
    }
    else {
        #>" . $content . "<# 
    } #>";

    //Check reveal
    $content = "<# if ( settings.rh_reveal ) {
        if ( settings.rh_reveal_dir ) {
            view.addRenderAttribute( 'reveal-wrapper', 'data-reveal-dir', settings.rh_reveal_dir );
        }
        if ( settings.rh_reveal_speed ) {
            view.addRenderAttribute( 'reveal-wrapper', 'data-reveal-speed', settings.rh_reveal_speed );
        }
        if ( settings.rh_reveal_delay ) {
            view.addRenderAttribute( 'reveal-wrapper', 'data-reveal-delay', settings.rh_reveal_delay );
        }
        if ( settings.rh_reveal_bgcolor ) {
            view.addRenderAttribute( 'reveal-wrapper', 'data-reveal-bg', settings.rh_reveal_bgcolor );
        }
        #>
        <div class=\"rh-reveal-wrap rhhidden position-relative\"><div class=\"rh-reveal-cont\">" . $content . "</div><div {{{ view.getRenderAttributeString( 'reveal-wrapper' ) }}} class=\"rh-reveal-block abdfullwidth pointernone\"></div></div></div>
        <# 
    }
    else {
        #>" . $content . "<# 
    } #>";

    //Check parallax
    $content = "<# if ( settings.rh_parallax_el ) {
        if ( settings.rh_parallax_el_dir ) {
            view.addRenderAttribute( 'rhpar-wrapper', 'data-parallax-dir', settings.rh_parallax_el_dir );
        }
        if ( settings.rh_parallax_el_speed ) {
            view.addRenderAttribute( 'rhpar-wrapper', 'data-parallax-speed', settings.rh_parallax_el_speed );
        }
        #>
        <div class=\"rh-parallaxel-true\" {{{ view.getRenderAttributeString( 'rhpar-wrapper' ) }}}>" . $content . "</div>
        <# 
    }
    else {
        #>" . $content . "<# 
    } #>";

    //Check parallax mouse
    $content = "<# if ( settings.rh_parlx_m_el ) {
        if ( settings.rh_parlx_m_el_speed ) {
            view.addRenderAttribute( 'rhmprlx-wrapper', 'data-prlx-xy', settings.rh_parlx_m_el_speed );
        }
        if ( settings.rh_parlx_m_el_tilt ) {
            view.addRenderAttribute( 'rhmprlx-wrapper', 'data-prlx-tilt', settings.rh_parlx_m_el_tilt );
        }
        #>
        <div class=\"rh-prlx-mouse\" {{{ view.getRenderAttributeString( 'rhmprlx-wrapper' ) }}}>" . $content . "</div>
        <# 
    }
    else {
        #>" . $content . "<# 
    } #>";

    return $content;
}
function RH_additional_el_annimation($array){
    $array['Rehub Effects'] = [
        'stuckMoveUpOpacity' => 'Stuck Up with Fade',
        'slide-in-blurred-top' => 'Blurred Slide From Top',
        'rotate-in-2-fwd' => 'Rotate In Forward',
        'rotate-in-2-bck' => 'Rotate In Backward',
        'flip-in-hor-top' => 'Flip in from Top',
        'flip-in-ver-right' => 'Flip In to Right',       
        'swing-in-top-fwd' => 'Swing from Top',
        'swing-in-left-fwd' => 'Swing from Left',
        'fade-in-fwd' => 'Fade in Forward',
        'fade-in-bck' => 'Fade in Backward',
        'stuckFlipUpOpacity' => 'Stuck Up with Flip and Fade',
        'flip-l-r-s' => 'Flip with Scale to left',
        'flip-r-r-s' => 'Flip with Scale to right',
        'tracking-in-expand' => 'Text tracking and expand',

    ];
    return $array; 
}
function rh_el_add_lazy_load_images($html, $settings, $image_size_key, $image_key){

    if (rehub_option('enable_lazy_images') == '1'){
        if($html){
            if(stripos($html, 'class=') !== false){
                $html = str_replace('class="', 'class="lazyimages ', $html);                
            }else{
                $html = str_replace('img', 'img class="lazyimages"', $html);
            }

            $new_src_url = get_template_directory_uri() . '/images/default/blank.gif';
            $html = preg_replace('(src="(.*?)")', 'src="'.$new_src_url.'" data-src="$1"', $html);
        }
    }
    return $html;

}
//add_action( 'elementor/element/parse_css', 'rh_add_post_css', 10, 2 );
/*function rh_add_post_css( $post_css, $element ) {
    if ( $post_css instanceof Dynamic_CSS ) {
        return;
    }
    $element_settings = $element->get_settings();
    if ( empty( $element_settings['rh_css'] ) ) {
        return;
    }
    $css = trim( $element_settings['rh_css'] );
    if ( empty( $css ) ) {
        return;
    }
    $post_css->get_stylesheet()->add_raw_css( $css );
}*/