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
class Widget_Wpsm_Recent_Posts_List extends WPSM_Content_Widget_Base {

    /* Widget Name */
    public function get_name() {
        return 'wpsm_recent_posts_list';
    }

    /* Widget Title */
    public function get_title() {
        return esc_html__('Simple list', 'rehub-theme');
    }

    /**
     * Get widget icon.
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
   public function get_icon() {
        return 'eicon-bullet-list';
    }    
    protected function general_fields() {
        parent::general_fields();

        $this->add_control( 'searchtitle', [
            'type'        => \Elementor\Controls_Manager::TEXT,
            'label'       => esc_html__( 'Search by Title', 'rehub-theme' ),
            'description' => esc_html__('Set name CURRENTPAGE to show posts with similar title to current page', 'rehub-theme'),
            'label_block'  => true,
        ]);
    }

    protected function control_fields() {
        $this->add_control( 'center', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Make center alignment?', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'return_value'      => '1',
        ]);

        $this->add_control( 'image', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Add image?', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'return_value'      => '1',
        ]);

        $this->add_control( 'nometa', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Disable meta', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'return_value'      => '1',
        ]);

        $this->add_control( 'priceenable', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Enable Price', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'return_value'      => '1',
        ]); 

        $this->add_control( 'compareenable', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Enable Compare button', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'return_value'      => '1',
        ]);  

        $this->add_control( 'hotenable', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Enable Hot counter', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'return_value'      => '1',
        ]);                      

        $this->add_control( 'excerpt', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Enable excerpt?', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'return_value'      => '1',
        ]);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'listtypography',
                'label' => esc_html__( 'Heading Typography', 'rehub-theme' ),
                'selector' => '{{WRAPPER}} .wpsm_recent_posts_list h3',
            ]
        );
        $this->add_control(
            'mborder',
            [
                'label' => esc_html__( 'Margin in bottom', 'rehub-theme' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpsm_recent_posts_list .col_item' => 'margin-bottom: {{VALUE}}px !important',
                ],
            ]
        ); 
        $this->add_control(
            'maximage',
            [
                'label' => esc_html__( 'Maximum image height (default is 80px)', 'rehub-theme' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-small-news figure' => 'height: {{VALUE}}px',
                    '{{WRAPPER}} .item-small-news figure img' => 'max-height: {{VALUE}}px',
                ],
            ]
        );                       

        $this->add_control( 'border', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Add border to list items', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'return_value'      => '1',
        ]);
        $this->add_control( 'bgcolor', [
            'label' => esc_html__( 'Background color', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .item-small-news' => 'background-color: {{VALUE}};',
            ],
        ]);        

        $this->add_control( 'columns', [
            'type'        => \Elementor\Controls_Manager::SELECT,
            'label'       => esc_html__( 'Show as columns', 'rehub-theme' ),
            'options'     => [
                '1'             => esc_html__( '1', 'rehub-theme' ),
                '2'             => esc_html__( '2', 'rehub-theme' ),
                '3'             => esc_html__( '3', 'rehub-theme' ),
                '4'             => esc_html__( '4', 'rehub-theme' ),
                '5'             => esc_html__( '5', 'rehub-theme' ),
                '6'             => esc_html__( '6', 'rehub-theme' ),
            ],
            'label_block' => true,
        ]);
    }

    protected function rehub_filter_values( $haystack ) {
        foreach ( $haystack as $key => $value ) {
            if ( is_array( $value ) ) {
                $haystack[ $key ] = $this->rehub_filter_values( $haystack[ $key ]);
            }

            if ( empty( $haystack[ $key ] ) ) {
                unset( $haystack[ $key ] );
            }
        }

        return $haystack;
    }

    /* Widget output Rendering */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( is_array( $settings['filterpanel'] ) ) {
            $settings['filterpanel'] = $this->rehub_filter_values( $settings['filterpanel'] );
            $settings['filterpanel'] = rawurlencode( json_encode( $settings['filterpanel'] ) );
        }
        // print_r($settings);
        $this->normalize_arrays( $settings );
        $this->render_custom_js();
        echo recent_posts_function( $settings );
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Wpsm_Recent_Posts_List );
