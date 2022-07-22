<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit('Restricted Access');
} // Exit if accessed directly

/**
 * Info box Widget class.
 *
 * 'wpsm_box' shortcode
 *
 * @since 1.0.0
 */
class Widget_Wpsm_Woo_Products_Carousel extends WPSM_Widget_Base {

    /* Widget Name */
    public function get_name() {
        return 'woo_mod';
    }

    /* Widget Title */
    public function get_title() {
        return esc_html__('Woo commerce product carousel', 'rehub-theme');
    }

    public function get_script_depends() {
        return [ 'owlcarousel' ];
    }

    protected function _register_controls() {
        parent::_register_controls();
        Controls_Stack::remove_control( 'enable_pagination' );
    }
    protected function get_sections() {
        return [
            'general'   => esc_html__('Data query', 'rehub-theme'),
            'data'      => esc_html__('Data Settings', 'rehub-theme'),
            'taxonomy'  => esc_html__('Additional Taxonomy Query', 'rehub-theme'),
            'control'   => esc_html__('Design Control', 'rehub-theme')
        ];
    }
    public function get_icon() {
        return 'eicon-posts-carousel';
    }      
    protected function control_fields() {
        $this->add_control( 'aff_link', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Make link as affiliate?', 'rehub-theme' ),
            'description' => esc_html__( 'This will change all inner post links to affiliate link of post offer', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'default'     => 'no',
        ]);

        $this->add_control( 'autorotate', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Make autorotate?', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'default'     => 'yes',
        ]);

        $this->add_control( 'carouseltype', [
            'type'        => \Elementor\Controls_Manager::SELECT,
            'label'       => esc_html__( 'Type', 'rehub-theme' ),
            'default'     => 'columned',
            'options'     => [
                'columned'             => esc_html__( 'Columned grid', 'rehub-theme' ),
                'simple'             => esc_html__( 'Simple grid', 'rehub-theme' ),
                'review'             => esc_html__( 'Review grid', 'rehub-theme' ),
            ],
            'label_block' => true,
        ]);

        $this->add_control( 'soldout', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Add fake sold counter', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'default'     => '',
        ]);

        $this->add_control( 'showrow', [
            'type'        => \Elementor\Controls_Manager::SELECT,
            'label'       => esc_html__( 'Number of items in row', 'rehub-theme' ),
            'options'     => [
                '5'             => esc_html__( '5', 'rehub-theme' ),
                '4'             => esc_html__( '4', 'rehub-theme' ),
                '3'             => esc_html__( '3', 'rehub-theme' ),
                '6'             => esc_html__( '6', 'rehub-theme' ),
            ],
            'label_block' => true,
            'default' => '5'
        ]);
    }

    /* Widget output Rendering */
    protected function render() {
        $settings = $this->get_settings_for_display();
        // Convert arrays to strings
        $this->normalize_arrays( $settings );
        echo woo_mod_shortcode( $settings );
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Wpsm_Woo_Products_Carousel );
