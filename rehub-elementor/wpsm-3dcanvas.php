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
class WPSM_TCanvas_A_Widget extends Widget_Base {

    /* Widget Name */
    public function get_name() {
        return 'rh_t_canvas';
    }

    /* Widget Title */
    public function get_title() {
        return __('3d canvas', 'rehub-theme');
    }

        /**
     * Get widget icon.
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_script_depends() {
        return ['threejs', 'orbitcontrol', 'gltfloader', 'shaderfrog', 'gsap'];
    }

    /**
     * category name in which this widget will be shown
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'helpler-modules' ];
    }

    protected function _register_controls() {
        $this->start_controls_section( 'general', [
            'label' => esc_html__( 'GLTF Model loader', 'rehub-theme' ),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'gltf_url', [
            'label' => esc_html__( 'Url on gltf, glb model', 'rehub-theme' ),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::TEXT,
        ]); 

        $this->add_control(
            'gltf_scale',
            array(
                'label'   => esc_html__( 'Model Resize', 'rehub-theme' ),
                'description' => 'If you don\'t see model, maybe you need to resize it, try 0.0001 value or 10000',
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 10000,
                'step'    => 0.0001,
            )
        ); 
        $this->add_control(
            'modelx',
            [
                'label' => __( 'Model X offset', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
            ]
        );
        $this->add_control(
            'modely',
            [
                'label' => __( 'Model Y offset', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
            ]
        );
        $this->add_control(
            'modelz',
            [
                'label' => __( 'Model z offset', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
            ]
        );

        $this->add_control(
            'gltf_p_light',
            array(
                'label'        => esc_html__( 'Enable point light?', 'rehub-theme' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
                'label_off'    => esc_html__( 'No', 'rehub-theme' ),
                'return_value' => 'true',
                'separator' => 'before',
                'default' => 'true'
            )
        );
        $this->add_control(
            'gltf_p_light_s',
            [
                'label' => __( 'Strength', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_p_light' => 'true',
                ],
            ]
        );
        $this->add_control(
            'gltf_p_light_d',
            [
                'label' => __( 'Diffuse', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_p_light' => 'true',
                ],
            ]
        );
        $this->add_control( 'gltf_p_light_c', [
            'label' => esc_html__( 'Color', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default'     => '#ffffff', 
            'condition' => [
                'gltf_p_light' => 'true',
            ],           
        ]);
        $this->add_control(
            'lightx',
            [
                'label' => __( 'Light X offset', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_p_light' => 'true',
                ],
            ]
        );
        $this->add_control(
            'lighty',
            [
                'label' => __( 'Light Y offset', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_p_light' => 'true',
                ],
            ]
        );
        $this->add_control(
            'lightz',
            [
                'label' => __( 'Light z offset', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_p_light' => 'true',
                ],
            ]
        );

        $this->add_control(
            'gltf_d_light',
            array(
                'label'        => esc_html__( 'Enable directional light?', 'rehub-theme' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
                'label_off'    => esc_html__( 'No', 'rehub-theme' ),
                'separator' => 'before',
                'return_value' => 'true',
            )
        );
        $this->add_control(
            'gltf_d_light_s',
            [
                'label' => __( 'Strength', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_d_light' => 'true',
                ],
            ]
        );

        $this->add_control( 'gltf_d_light_c', [
            'label' => esc_html__( 'Color', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default'     => '#ffffff', 
            'condition' => [
                'gltf_d_light' => 'true',
            ],           
        ]);
        $this->add_control(
            'lightdx',
            [
                'label' => __( 'Light X offset', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_d_light' => 'true',
                ],
            ]
        );
        $this->add_control(
            'lightdy',
            [
                'label' => __( 'Light Y offset', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_d_light' => 'true',
                ],
            ]
        );
        $this->add_control(
            'lightdz',
            [
                'label' => __( 'Light z offset', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_d_light' => 'true',
                ],
            ]
        );

        $this->add_control(
            'gltf_a_light',
            array(
                'label'        => esc_html__( 'Enable Ambient light?', 'rehub-theme' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
                'label_off'    => esc_html__( 'No', 'rehub-theme' ),
                'separator' => 'before',
                'return_value' => 'true',
            )
        );
        $this->add_control(
            'gltf_a_light_s',
            [
                'label' => __( 'Strength', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_a_light' => 'true',
                ],
            ]
        );
        $this->add_control( 'gltf_a_light_c', [
            'label' => esc_html__( 'Color', 'rehub-theme' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default'     => '#ffffff', 
            'condition' => [
                'gltf_a_light' => 'true',
            ],           
        ]);
        $this->add_control(
            'gltf_env',
            array(
                'label'        => esc_html__( 'Enable environment image?', 'rehub-theme' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
                'label_off'    => esc_html__( 'No', 'rehub-theme' ),
                'separator' => 'before',
                'return_value' => 'true',
            )
        );
        $this->add_control(
            'gltf_env_s',
            [
                'label' => __( 'Strength', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'gltf_env' => 'true',
                ],
            ]
        );
        $this->add_control( 'gltf_px', [
            'label' => esc_html__( 'Custom right image (px)', 'rehub-theme' ),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => array(
                'gltf_env' => 'true'
            ),
        ]);
        $this->add_control( 'gltf_nx', [
            'label' => esc_html__( 'Custom left image (nx)', 'rehub-theme' ),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => array(
                'gltf_env' => 'true'
            ),
        ]);
        $this->add_control( 'gltf_py', [
            'label' => esc_html__( 'Custom top image (py)', 'rehub-theme' ),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => array(
                'gltf_env' => 'true'
            ),
        ]);
        $this->add_control( 'gltf_ny', [
            'label' => esc_html__( 'Custom bottom image (ny)', 'rehub-theme' ),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => array(
                'gltf_env' => 'true'
            ),
        ]);
        $this->add_control( 'gltf_pz', [
            'label' => esc_html__( 'Custom front image (pz)', 'rehub-theme' ),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => array(
                'gltf_env' => 'true'
            ),
        ]);
        $this->add_control( 'gltf_nz', [
            'label' => esc_html__( 'Custom back image (nz)', 'rehub-theme' ),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => array(
                'gltf_env' => 'true'
            ),
        ]);

        $this->add_control( 'shader_url', [
            'label' => esc_html__( 'Url on shaderfrog json', 'rehub-theme' ),
            'separator' => 'before',
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::TEXT,
        ]); 
        $this->add_control( 'shader_mesh', [
            'label' => esc_html__( 'Mesh name to apply shader', 'rehub-theme' ),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'mesh_name',
            [
                'label' => __( 'Get by mesh name', 'rehub-theme' ),
                'description'=> 'Leave blank to get by number',
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'model_center',
            array(
                'label'        => esc_html__( 'Center pivot and geo', 'rehub-theme' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
                'label_off'    => esc_html__( 'No', 'rehub-theme' ),
                'return_value' => 'yes',
            )
        );
        $repeater->add_control(
            'model_rx',
            [
                'label' => __( 'Rotation X', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'model_ry',
            [
                'label' => __( 'Rotation Y', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'model_rz',
            [
                'label' => __( 'Rotation Z', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 0.1,
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'model_px',
            [
                'label' => __( 'Position X', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.01,
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'model_py',
            [
                'label' => __( 'Position Y', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.01,
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'model_pz',
            [
                'label' => __( 'Position Z', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.01,
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'model_scale',
            [
                'label' => __( 'Scale', 'rehub-theme' ),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 0.01,
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'model_opacity',
            array(
                'label'   => esc_html__( 'Opacity', 'rehub-theme' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            )
        );
        $repeater->add_control(
            'model_duration',
            array(
                'label'   => esc_html__( 'Duration (s)', 'rehub-theme' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 0.1,
                'max'     => 20,
                'step'    => 0.1,
                'default' => 1,
            )
        ); 
        $repeater->add_control(
            'model_delay',
            array(
                'label'   => esc_html__( 'Delay (s)', 'rehub-theme' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 0.1,
                'max'     => 20,
                'step'    => 0.1,
            )
        );
        $repeater->add_control( 'model_ease', [
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
        ]);
        $repeater->add_control(
            'model_infinite',
            array(
                'label'        => esc_html__( 'Enable infinite', 'rehub-theme' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
                'label_off'    => esc_html__( 'No', 'rehub-theme' ),
                'return_value' => 'yes',
            )
        );
        $repeater->add_control(
            'model_yoyo',
            array(
                'label'        => esc_html__( 'Enable Yoyo style', 'rehub-theme' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
                'label_off'    => esc_html__( 'No', 'rehub-theme' ),
                'return_value' => 'yes',
            )
        );
        $repeater->add_control(
            'model_from',
            array(
                'label'        => esc_html__( 'Set direction as FROM', 'rehub-theme' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
                'label_off'    => esc_html__( 'No', 'rehub-theme' ),
                'return_value' => 'yes',
                'default' => 'yes',
            )
        );                                          
        $this->add_control( 'meshanimations', [
            'label'    => esc_html__( 'Mesh Animations', 'rehub-theme' ),
            'type'     => \Elementor\Controls_Manager::REPEATER,
            'fields'   => $repeater->get_controls(),
            'title_field' => '{{{ mesh_name }}}',
            'separator' => 'before',
            'prevent_empty' => false,
        ]);

        $this->end_controls_section();

        $this->start_controls_section( 'canvassize', [
            'label' => esc_html__( 'Canvas Size', 'rehub-theme' ),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

            $this->add_responsive_control(
                'threecanvwidth', [
                    'label' => __('Area width', 'rehub-theme'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '100',
                        'unit' => '%',
                    ],
                    'size_units' => [ '%', 'px'],
                    'separator' => 'before',
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 200,
                        ],
                        'px' => [
                            'min' => 100,
                            'max' => 2500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rh_and_canvas' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    
                ]
            );
            $this->add_responsive_control(
                'threecanvheight', [
                    'label' => __('Area height', 'rehub-theme'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '100',
                        'unit' => '%',
                    ],
                    'size_units' => [ '%', 'px'],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 200,
                        ],
                        'px' => [
                            'min' => 100,
                            'max' => 2500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rh_and_canvas' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section( 'cameracontrol', [
            'label' => esc_html__( 'Camera and Orbit Controller', 'rehub-theme' ),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);
            $this->add_control(
                'camerax',
                [
                    'label' => __( 'Camera X offset', 'rehub-theme' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0,
                    ],
                    'label_block' => true,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 0.1,
                        ],
                    ],
                ]
            );
            $this->add_control(
                'cameray',
                [
                    'label' => __( 'Camera Y offset', 'rehub-theme' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0,
                    ],
                    'label_block' => true,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 0.1,
                        ],
                    ],
                ]
            );
            $this->add_control(
                'cameraz',
                [
                    'label' => __( 'Camera z offset', 'rehub-theme' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0,
                    ],
                    'label_block' => true,
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 0.1,
                        ],
                    ],
                ]
            );
            $this->add_control(
                'gltf_rotation',
                [
                    'label' => __( 'Rotation type', 'rehub-theme' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'no',
                    'separator' => 'before',
                    'options' => [
                        'no' => 'No',
                        'inf' => __( 'Model Infinite rotation', 'rehub-theme' ),
                        'infscene' => __( 'Full Scene Infinite rotation', 'rehub-theme' ),
                        'mouse' => __( 'Model rotation On Mouse move', 'rehub-theme' ),
                        'mousescene' => __( 'Full scene rotation On Mouse move', 'rehub-theme' ),
                    ],
                ]
            );
            $this->add_control(
                'gltf_rx',
                array(
                    'label'   => esc_html__( 'Rotation X strength', 'rehub-theme' ),
                    'type'    => \Elementor\Controls_Manager::NUMBER,
                    'min'     => 0,
                    'max'     => 100,
                    'step'    => 1,
                    'condition' => array(
                        'gltf_rotation' => ['inf','infscene']
                    ),
                )
            ); 
            $this->add_control(
                'gltf_ry',
                array(
                    'label'   => esc_html__( 'Rotation Y strength', 'rehub-theme' ),
                    'type'    => \Elementor\Controls_Manager::NUMBER,
                    'min'     => 0,
                    'max'     => 100,
                    'step'    => 1,
                    'condition' => array(
                        'gltf_rotation' => ['inf','infscene']
                    ),
                )
            ); 
            $this->add_control(
                'gltf_rz',
                array(
                    'label'   => esc_html__( 'Rotation Z strength', 'rehub-theme' ),
                    'type'    => \Elementor\Controls_Manager::NUMBER,
                    'min'     => 0,
                    'max'     => 100,
                    'step'    => 1,
                    'condition' => array(
                        'gltf_rotation' => ['inf','infscene']
                    ),
                )
            ); 
            $this->add_control(
                'gltf_move',
                array(
                    'label'   => esc_html__( 'Move Strength', 'rehub-theme' ),
                    'type'    => \Elementor\Controls_Manager::NUMBER,
                    'min'     => 0,
                    'max'     => 100,
                    'step'    => 0.1,
                    'default' => 1,
                    'condition' => array(
                        'gltf_rotation' => ['mouse', 'mousescene'],
                    ),
                )
            );
            $this->add_control(
                'gltf_zoom',
                array(
                    'label'        => esc_html__( 'Disable zooming?', 'rehub-theme' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'rehub-theme' ),
                    'label_off'    => esc_html__( 'No', 'rehub-theme' ),
                    'return_value' => 'true',
                    'default' => 'true'
                )
            ); 

        $this->end_controls_section();

        $this->start_controls_section( 'scriptsadd', [
            'label' => esc_html__( 'Three js scripts', 'rehub-theme' ),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

            $this->add_control(
                'scenescript',
                array(
                    'label'   => esc_html__( 'Three JS Scene script', 'rehub-theme' ),
                    'description' => 'available variable is scene',
                    'type'    => \Elementor\Controls_Manager::TEXTAREA,
                )
            );
            $this->add_control(
                'modelscript',
                array(
                    'label'   => esc_html__( 'Three JS gltf model script', 'rehub-theme' ),
                    'description' => 'available variable is model',
                    'type'    => \Elementor\Controls_Manager::TEXTAREA,
                )
            );
            $this->add_control(
                'animationscript',
                array(
                    'label'   => esc_html__( 'Three JS animation script', 'rehub-theme' ),
                    'description' => 'available variables are scene, model',
                    'type'    => \Elementor\Controls_Manager::TEXTAREA,
                )
            );

        $this->end_controls_section();
        
    }

    /* Widget output Rendering */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'rh_gltfdata', 'data-rotationtype', $settings['gltf_rotation'] );
        if ( ! empty( $settings['gltf_url'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-url', urlencode($settings['gltf_url']) );
        }
        if ( ! empty( $settings['shader_url'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-shaderurl', urlencode($settings['shader_url']) );
        }
        if ( ! empty( $settings['shader_mesh'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-shadermesh', $settings['shader_mesh'] );
        }
        if ( ! empty( $settings['gltf_scale'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-scale', $settings['gltf_scale'] );
        }
        if ( ! empty( $settings['gltf_rx'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-rx', $settings['gltf_rx'] );
        }
        if ( ! empty( $settings['gltf_ry'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-ry', $settings['gltf_ry'] );
        }
        if ( ! empty( $settings['gltf_rz'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-rz', $settings['gltf_rz'] );
        }
        if ( ! empty( $settings['camerax'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-camerax', $settings['camerax']['size'] );
        }
        if ( ! empty( $settings['cameray'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-cameray', $settings['cameray']['size'] );
        }
        if ( ! empty( $settings['cameraz'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-cameraz', $settings['cameraz']['size'] );
        }
        if ( ! empty( $settings['modelx'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-modelx', $settings['modelx']['size'] );
        }
        if ( ! empty( $settings['modely'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-modely', $settings['modely']['size'] );
        }
        if ( ! empty( $settings['modelz'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-modelz', $settings['modelz']['size'] );
        }
        if ( ! empty( $settings['lightx'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightx', $settings['lightx']['size'] );
        }
        if ( ! empty( $settings['lighty'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lighty', $settings['lighty']['size'] );
        }
        if ( ! empty( $settings['lightz'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightz', $settings['lightz']['size'] );
        }
        if ( ! empty( $settings['gltf_move'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-mousemove', $settings['gltf_move'] );
        }
        if ( ! empty( $settings['gltf_p_light_s'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightstrength', $settings['gltf_p_light_s']['size'] );
        }
        if ( ! empty( $settings['gltf_p_light_d'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightdiffuse', $settings['gltf_p_light_d']['size'] );
        }
        if ( ! empty( $settings['gltf_p_light_c'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightcolor', $settings['gltf_p_light_c'] );
        }
        if ( ! empty( $settings['gltf_p_light'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lights', $settings['gltf_p_light'] );
        }
        if ( ! empty( $settings['gltf_zoom'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-zoom', $settings['gltf_zoom'] );
        }
        if ( ! empty( $settings['gltf_d_light_s'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightdstrength', $settings['gltf_d_light_s']['size'] );
        }
        if ( ! empty( $settings['gltf_d_light_c'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightdcolor', $settings['gltf_d_light_c'] );
        }
        if ( ! empty( $settings['gltf_d_light'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightds', $settings['gltf_d_light'] );
        }

        if ( ! empty( $settings['lightdx'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightdx', $settings['lightdx']['size'] );
        }
        if ( ! empty( $settings['lightdy'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightdy', $settings['lightdy']['size'] );
        }
        if ( ! empty( $settings['lightdz'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-lightdz', $settings['lightdz']['size'] );
        }

        if ( ! empty( $settings['gltf_a_light_s'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-alightstrength', $settings['gltf_a_light_s']['size'] );
        }
        if ( ! empty( $settings['gltf_a_light_c'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-alightcolor', $settings['gltf_a_light_c'] );
        }
        if ( ! empty( $settings['gltf_a_light'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-alights', $settings['gltf_a_light'] );
        }
        if ( ! empty( $settings['gltf_env'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-env', $settings['gltf_env'] );
        }
        if ( ! empty( $settings['gltf_env_s'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-envstrength', $settings['gltf_env_s']['size'] );
        }
        if ( ! empty( $settings['gltf_px'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-envpx', $settings['gltf_px']['url'] );
        }
        if ( ! empty( $settings['gltf_nx'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-envnx', $settings['gltf_nx']['url']  );
        }
        if ( ! empty( $settings['gltf_py'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-envpy', $settings['gltf_py']['url']  );
        }
        if ( ! empty( $settings['gltf_ny'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-envny', $settings['gltf_ny']['url']  );
        }
        if ( ! empty( $settings['gltf_pz'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-envpz', $settings['gltf_pz']['url']  );
        }
        if ( ! empty( $settings['gltf_nz'] )) {
            $this->add_render_attribute( 'rh_gltfdata', 'data-envnz', $settings['gltf_nz']['url']  );
        }
        $settings['mesh'] = array();
        if ( ! empty( $settings['meshanimations'] )) {
            foreach ($settings['meshanimations'] as $index => $item) {
                foreach ($item as $key => $value) {
                    if(!empty($value)){
                        if(is_array($value)) $value = $value['size'];
                        if($value) $settings['mesh'][$index][$key] = $value;
                    }
                }        
            }
            $this->add_render_attribute( 'rh_gltfdata', 'data-meshanimations', json_encode($settings['mesh']) );
        }
        $widgetId = $this->get_id();
        echo '<div id="rh_three_'.esc_attr($widgetId).'" class="rh-gltf-canvas rh_and_canvas" '.$this->get_render_attribute_string( 'rh_gltfdata' ).'> </div>';
        wp_enqueue_script('threejs');wp_enqueue_script('orbitcontrol');wp_enqueue_script('gltfloader');wp_enqueue_script('gsapthree');
        if ( ! empty( $settings['shader_url'] )) {wp_enqueue_script('shaderfrog');}
        if ( ! empty( $settings['mesh'] )) {wp_enqueue_script('gsap');}
        $scenescript = sanitize_text_field($settings['scenescript']);
        $animationscript = sanitize_text_field($settings['animationscript']);
        $modelscript = sanitize_text_field($settings['modelscript']);
        //wp_enqueue_script('gltfinit'); 
        $javascript = '
        (function() {
           "use strict";
            var container = document.getElementById("rh_three_'.esc_attr($widgetId).'");
            var scene, camera, pointLight, model, envMap, dirLight, shaderurl, shadermaterial, containerwidth, containerheight, modelcenter;
            var renderer, mixer, controls;
            var hasanimation = false;

            var mouseX = 0;
            var mouseY = 0;

            var windowHalfX = window.innerWidth / 2;
            var windowHalfY = window.innerHeight / 2;

            var clock = new THREE.Clock();

            renderer = new THREE.WebGLRenderer( { antialias: true, alpha: true } );
            renderer.setPixelRatio( window.devicePixelRatio );
            renderer.outputEncoding = THREE.sRGBEncoding;
            //renderer.physicallyCorrectLights = true;

            setContainerSize(); //update renderer with container width and height

            container.appendChild( renderer.domElement );

            scene = new THREE.Scene();
            //scene.background = new THREE.Color( 0xbfe3dd );

            var scenecenter = [0, 0, 0];
            var modelcenter = [0,0,0];

            camera = new THREE.PerspectiveCamera( 40, containerwidth / containerheight, 0.1, 10 ); // we take width and height from setCpntainerSize function
            var camerax = parseFloat(container.dataset.camerax);
            var cameray = parseFloat(container.dataset.cameray);
            var cameraz = parseFloat(container.dataset.cameraz);
            //camera.position.set( 5, 2, 8 );

            // rotation types
            var gltf_rotation = container.dataset.rotationtype;
            var gltf_rx = parseFloat(container.dataset.rx);
            var gltf_ry = parseFloat(container.dataset.ry);
            var gltf_rz = parseFloat(container.dataset.rz);
            var gltf_mousemove = container.dataset.mousemove;

            //Orbit controller
            controls = new THREE.OrbitControls( camera, renderer.domElement );
            controls.target.set( 0, 0.5, 0 );
            controls.enablePan = false;
            var disablezoom = container.dataset.zoom;
            if(disablezoom) controls.enableZoom = false;

            // envmap

            var env = container.dataset.env;
            var envpx = container.dataset.envpx;
            var envpy = container.dataset.envpy;
            var envpz = container.dataset.envpz;
            var envnx = container.dataset.envnx;
            var envny = container.dataset.envny;
            var envnz = container.dataset.envnz;

            if(env && envpx && envpy && envpz && envnx && envny && envnz){
                var envMap = new THREE.CubeTextureLoader().load( [envpx, envnx, envpy, envny, envpz, envnz] );               
            }

            //Here we check if we set shaderfrog json

            var shaderurl = container.dataset.shaderurl;
            if(shaderurl){
                shaderurl = decodeURIComponent(shaderurl);
                var runtime = new ShaderRuntime();
                runtime.load(shaderurl, function( shaderData ) {
                    shadermaterial = runtime.get( shaderData.name );
                });
                runtime.registerCamera( camera );
            }    

            //Loader of gltf                

            var loader = new THREE.GLTFLoader();
            var urlgltf = decodeURIComponent(container.dataset.url);
            loader.load( urlgltf, function ( gltf ) {

                model = gltf.scene;
                //model.position.set( 1, 1, 0 );

                //center object in scene

                var modelbox = new THREE.Box3().setFromObject( model );
                modelcenter = modelbox.getCenter( new THREE.Vector3() );
                var modelsize = modelbox.getSize(new THREE.Vector3()).length();
                model.position.x += ( model.position.x - modelcenter.x );
                model.position.y += ( model.position.y - modelcenter.y );
                model.position.z += ( model.position.z - modelcenter.z );

                //update controls and camera according to size

                controls.maxDistance = modelsize * 10;
                camera.near = modelsize / 100;
                camera.far = modelsize * 100;
                camera.position.copy(modelcenter);
                camera.position.x += modelsize / 2.0;
                camera.position.y += modelsize / 5.0;
                camera.position.z += modelsize / 2.0;
                camera.updateProjectionMatrix();

                //offset camera if need

                if(camerax) camera.position.x += camerax;
                if(cameray) camera.position.y += cameray;
                if(cameraz) camera.position.z += cameraz;
                camera.lookAt(modelcenter);

                //offset model if need

                var modelx = parseFloat(container.dataset.modelx);
                var modely = parseFloat(container.dataset.modely);
                var modelz = parseFloat(container.dataset.modelz);

                if(modelx) model.position.x += modelx;
                if(modely) model.position.y += modely;
                if(modelz) model.position.z += modelz;

                //Rescale model if need

                var rescale = parseFloat(container.dataset.scale);
                if(rescale){
                    model.scale.set( rescale, rescale, rescale );
                }


                // Point Light

                var lights = container.dataset.lights;
                if(lights){
                    var color = container.dataset.lightcolor;
                    var intensity = parseFloat(container.dataset.lightstrength);
                    var diffuse = parseFloat(container.dataset.lightdiffuse);
                    if(!diffuse) diffuse = 0;
                    var diffuse = 100 - diffuse; 

                    pointLight = new THREE.PointLight( color, intensity, diffuse);
                    pointLight.position.copy( camera.position );
                    //pointLight.target.position.set(modelcenter); 

                    var lightx = parseFloat(container.dataset.lightx);
                    var lighty = parseFloat(container.dataset.lighty);
                    var lightz = parseFloat(container.dataset.lightz);

                    if(lightx) pointLight.position.x += lightx;
                    if(lighty) pointLight.position.y += lighty;
                    if(lightz) pointLight.position.z += lightz;

                    scene.add( pointLight);

                }

                // Directional Light

                var lightds = container.dataset.lightds;
                if(lightds){
                    var colord = container.dataset.lightdcolor;
                    var intensityd = parseFloat(container.dataset.lightdstrength); 

                    dirLight = new THREE.DirectionalLight( colord, intensityd);
                    dirLight.position.copy( camera.position );
                    dirLight.target.position.set(modelcenter); 

                    var lightdx = parseFloat(container.dataset.lightdx);
                    var lightdy = parseFloat(container.dataset.lightdy);
                    var lightdz = parseFloat(container.dataset.lightdz);

                    if(lightdx) dirLight.position.x += lightdx;
                    if(lightdy) dirLight.position.y += lightdy;
                    if(lightdz) dirLight.position.z += lightdz;

                    scene.add( dirLight);

                }

                // Ambient Light

                var alights = container.dataset.alights;
                if(alights){
                    var acolor = container.dataset.alightcolor;
                    var aintensity = parseFloat(container.dataset.alightstrength); 
                    scene.add( new THREE.AmbientLight(acolor,aintensity) );                  
                }
                
                // Check all inner objects and assign materials

                var meshanimations = container.dataset.meshanimations;
                if(meshanimations) meshanimations = JSON.parse(meshanimations);

                var childmeshes = []; 
                var childmeshesnames = [];

                model.traverse( function ( child ) {
                    if ( child.isMesh ) {
                        if(shaderurl){
                            var shadermesh = container.dataset.shadermesh;
                            if(shadermesh){
                                if(child.name == shadermesh){
                                    child.material = shadermaterial;
                                }
                            }else{
                                child.material = shadermaterial;
                            }
                            
                        }
                        if(envMap){
                            child.material.envMap = envMap;
                            var envintensity = container.dataset.envstrength;
                            if(envintensity) child.material.envMapIntensity = envintensity;
                        }
                        childmeshes.push(child);
                        childmeshesnames.push(child.name);
                    }

                } );
                
                if(meshanimations){
                    for(var curr = 0; curr < meshanimations.length; curr++){

                        var findname = meshanimations[curr].mesh_name;

                        if(findname){
                            var indexbyname = childmeshesnames.indexOf(findname); 
                            var mesh = childmeshes[indexbyname]; 
                        }else{
                            var mesh = childmeshes[curr];
                        }

                        if(mesh.name){

                            var pivotcenter = meshanimations[curr].model_center;
                            if(pivotcenter){
                                var center = new THREE.Vector3();
                                mesh.geometry.computeBoundingBox();
                                mesh.geometry.boundingBox.getCenter(center);
                                mesh.geometry.center();
                                mesh.position.copy(center);
                            }

                            var animatedobj = mesh;

                            let rx = meshanimations[curr].model_rx;
                            let ry = meshanimations[curr].model_ry;
                            let rz = meshanimations[curr].model_rz;
                            let px = meshanimations[curr].model_px;
                            let py = meshanimations[curr].model_py;
                            let pz = meshanimations[curr].model_pz;
                            let sc = meshanimations[curr].model_scale;
                            let du = meshanimations[curr].model_duration;
                            let de = meshanimations[curr].model_delay;
                            let ea = meshanimations[curr].model_ease;
                            let inf = meshanimations[curr].model_infinite;
                            let yoyo = meshanimations[curr].model_yoyo;
                            let from = meshanimations[curr].model_from;
                            let opacity = meshanimations[curr].model_opacity;
                            let anargs = {};
                            anargs.three = {};
                            if(rx) anargs.three.rotationX = parseFloat(rx);
                            if(ry) anargs.three.rotationY = parseFloat(ry);
                            if(rz) anargs.three.rotationZ = parseFloat(rz);
                            if(px) anargs.three.x = parseFloat(px);
                            if(py) anargs.three.y = parseFloat(py);
                            if(pz) anargs.three.z = parseFloat(pz);
                            if(sc) anargs.three.scale = parseFloat(sc);
                            if(opacity) anargs.three.opacity = parseInt(opacity)/100;
                            if(du) anargs.duration = parseFloat(du);
                            if(de) anargs.delay = parseFloat(de);
                            if(ea){
                                var $ease = ea.split("-");
                                anargs.ease = $ease[0]+"."+$ease[1];
                                if(anargs.ease === "power0.none"){           
                                    anargs.ease = "none";
                                }
                            }
                            if(inf=="yes"){
                                if(yoyo=="yes"){
                                    anargs.yoyo = true;
                                }
                                anargs.repeat = -1;
                                if(de){
                                    anargs.repeatDelay = parseFloat(de);
                                }
                                
                            }
                            if(from=="yes"){
                                gsap.from(animatedobj, anargs);
                            }else{
                                gsap.to(animatedobj, anargs);
                            }
                        }
                    }
                }

                //Add something to model if need
                '.$modelscript.'

                // finally add model to scene
                scene.add( model );

                // Check if we have animations and play it

                if(gltf.animations.length > 0){
                    mixer = new THREE.AnimationMixer( model );
                    gltf.animations.forEach((clip) => {
                        mixer.clipAction(clip).reset().play();
                    });
                    hasanimation = true;                   
                }

                

            }, undefined, function ( e ) {

                console.error( e );

            } );

            //offset camera if need in case if no model. If we have model, camera will be repositioned and offset again because loader is async

            if(camerax) camera.position.x += camerax;
            if(cameray) camera.position.y += cameray;
            if(cameraz) camera.position.z += cameraz;
            camera.lookAt(modelcenter);

            //Add something to scene if need
            '.$scenescript.'

            //Start animation here

            animate();

            //On resize function

            window.onresize = function () {

                setContainerSize();
                camera.aspect = containerwidth / containerheight;
                camera.updateProjectionMatrix();

            };

            //Mouse move feature 

            document.addEventListener("mousemove", function(event){

                mouseX = ( event.clientX - windowHalfX );
                mouseY = ( event.clientY - windowHalfY );

            });

            //Basic animation on each frame 

            function animate() {

                requestAnimationFrame( animate );

                var delta = clock.getDelta(); // we get clock time from three js
                if(hasanimation){
                    mixer.update( delta ); //check if scene has animation and update it
                }
                controls.update( delta ); //update orbit control
                if(shaderurl){
                    runtime.updateShaders( clock.getElapsedTime() ); //update shaderfrog
                }
                
                if ( model && gltf_rotation == "mouse" ) { // rotation on mouse move
                    model.rotation.y += 0.05 * ( mouseX * gltf_mousemove/1000 - model.rotation.y );
                    model.rotation.x += 0.05 * ( mouseY * gltf_mousemove/1000 - model.rotation.x );
                    //0.05 is speed, 001 is strength of rotation
                }
                else if ( scene && gltf_rotation == "mousescene" ) { // rotation on mouse move
                    scene.rotation.y += 0.05 * ( mouseX * gltf_mousemove/1000 - scene.rotation.y );
                    scene.rotation.x += 0.05 * ( mouseY * gltf_mousemove/1000 - scene.rotation.x );
                    //0.05 is speed, 001 is strength of rotation
                }
                else if(model && gltf_rotation == "inf"){ //infinite rotation
                    if(gltf_rx) model.rotation.x += gltf_rx/1000;
                    if(gltf_ry) model.rotation.y += gltf_ry/1000;
                    if (gltf_rz) model.rotation.z += gltf_rz/1000;
                }
                else if(scene && gltf_rotation == "infscene"){ //infinite rotation
                    if(gltf_rx) scene.rotation.x += gltf_rx/1000;
                    if(gltf_ry) scene.rotation.y += gltf_ry/1000;
                    if (gltf_rz) scene.rotation.z += gltf_rz/1000;
                }

                //Add something to animation if need
                '.$animationscript.'

                renderer.render( scene, camera );
            }

            //Set container width and height

            function setContainerSize(){

                var positionInfo = container.getBoundingClientRect();
                containerheight = positionInfo.height;
                if(containerheight < 100) containerheight = 100;
                containerwidth = positionInfo.width;

                renderer.setSize( containerwidth, containerheight );
            }


        })();        
        '; 
        
        if ( Plugin::$instance->editor->is_edit_mode() ) {  
            echo '<script>'.$javascript.'</script>';
        }else{
            wp_add_inline_script('gltfloader', $javascript);
        }
    }

  

}

Plugin::instance()->widgets_manager->register_widget_type( new WPSM_TCanvas_A_Widget );
