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
class WPSM_Column_News_Block_Widget extends Widget_Base {

    public function __construct( array $data = [], array $args = null ) {
        parent::__construct( $data, $args );
        // ajax callback
        add_action( 'wp_ajax_get_categories_list', [ &$this, 'get_categories_list'] );
        add_action( 'wp_ajax_get_categories_exclude_list', [ &$this, 'get_categories_list'] );
        add_action( 'wp_ajax_get_tags_list', [ &$this, 'get_tags_list'] );
        add_action( 'wp_ajax_get_tags_exclude_list', [ &$this, 'get_tags_list'] );
        add_action( 'wp_ajax_get_second_categories_list', [ &$this, 'get_categories_list'] );
        add_action( 'wp_ajax_get_second_categories_exclude_list', [ &$this, 'get_categories_list'] );
        add_action( 'wp_ajax_get_second_tags_list', [ &$this, 'get_tags_list'] );
        add_action( 'wp_ajax_get_second_tags_exclude_list', [ &$this, 'get_tags_list'] );
    }

    /* Widget Name */
    public function get_name() {
        return 'two_col_news';
    }

    /* Widget Title */
    public function get_title() {
        return esc_html__('Column news block', 'rehub-theme');
    }

        /**
     * Get widget icon.
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-image-box';
    }

    /**
     * category name in which this widget will be shown
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'content-modules' ];
    }

    protected function normalize_arrays( &$settings, $fields = ['module_cats', 'cat_exclude', 'module_tags', 'tag_exclude'] ) {
        foreach( $fields as $field ) {
            if ( ! isset( $settings[ $field ] ) || ! is_array( $settings[ $field ] ) ) {
                continue;
            }

            $settings[ $field ] = implode(',', $settings[ $field ]);
        }
    }

    protected function _register_controls() {
        $this->start_controls_section( 'general_section', [
            'label' => esc_html__( 'General', 'rehub-theme' ),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control( 'module_offset_second', [
            'type'        => \Elementor\Controls_Manager::TEXT,
            'label'       => esc_html__( 'Offset for 2 column', 'rehub-theme' ),
            'description' => esc_html__('Number of posts to offset for second column  or leave blank', 'rehub-theme'),
        ]);
        $this->add_control( 'module_fetch', [
            'type'        => \Elementor\Controls_Manager::TEXT,
            'label'       => esc_html__( 'Fetch Count', 'rehub-theme' ),
            'description' => esc_html__('How much posts you\'d like to display?', 'rehub-theme'),
        ]);
        $this->add_control( 'compact', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Show first post as compact?', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'return_value'      => 'true',
        ]);
        $this->add_control( 'only_one', [
            'type'        => \Elementor\Controls_Manager::SWITCHER,
            'label'       => esc_html__( 'Disable second column?', 'rehub-theme' ),
            'label_on'    => esc_html__('Yes', 'rehub-theme'),
            'label_off'   => esc_html__('No', 'rehub-theme'),
            'return_value'      => 'true',
        ]);
        $this->end_controls_section();

        $this->wpsm_first_columns_fields();
        $this->wpsm_second_columns_fields();
    }

    protected function wpsm_first_columns_fields() {
        $this->start_controls_section( 'first_column', [
            'label'     => esc_html__( 'First column', 'rehub-theme' ),
            'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control( 'module_cats_first', [
            'type'        => 'select2ajax',
            'label'       => esc_html__( 'Category first', 'rehub-theme' ),
            'options'       => [],
            'description'   => esc_html__( 'Enter names of categories. Or leave blank to show all', 'rehub-theme' ),
            'label_block'  => true,
            'multiple'     => false,
            'callback'    => 'get_categories_list'
        ]);
        $this->add_control( 'cat_exclude_first', [
            'type'        => 'select2ajax',
            'label'       => esc_html__( 'Category exclude first', 'rehub-theme' ),
            'options'       => [],
            'description'   => esc_html__( 'Enter names of categories to exclude', 'rehub-theme' ),
            'label_block'  => true,
            'multiple'     => false,
            'callback'    => 'get_categories_exclude_list'
        ]);
        $this->add_control( 'module_tags_first', [
            'type'        => 'select2ajax',
            'label'       => esc_html__( 'Tags first', 'rehub-theme' ),
            'options'       => [],
            'description'   => esc_html__( 'Enter names of tags. Or leave blank to show all', 'rehub-theme' ),
            'label_block'  => true,
            'multiple'     => false,
            'callback'    => 'get_tags_list'
        ]);
        $this->add_control( 'tag_exclude_first', [
            'type'        => 'select2ajax',
            'label'       => esc_html__( 'Tags exclude first', 'rehub-theme' ),
            'options'       => [],
            'description'   => esc_html__( 'Enter names of tags to exclude.', 'rehub-theme' ),
            'label_block'  => true,
            'multiple'     => false,
            'callback'    => 'get_tags_exclude_list'
        ]);

        $this->add_control( 'post_formats_first', [
            'type'        => \Elementor\Controls_Manager::SELECT,
            'label'       => esc_html__( 'Choose post formats first', 'rehub-theme' ),
            'description' => esc_html__('Choose post formats to display or leave blank to display all', 'rehub-theme'),
            'options'     => array(
                'all'       => esc_html__('all', 'rehub-theme'),
                'regular'   => esc_html__('regular', 'rehub-theme'),
                'video'     => esc_html__('video', 'rehub-theme'),
                'gallery'   => esc_html__('gallery', 'rehub-theme'),
                'review'    => esc_html__('review', 'rehub-theme'),
                'music'     => esc_html__('music', 'rehub-theme'),
            )
        ]);
        $this->add_control( 'color_cat_first', [
            'type'        => \Elementor\Controls_Manager::COLOR,
            'label'       => esc_html__( 'Color for category label', 'rehub-theme' ),
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
        ]);
        $this->end_controls_section();
    }

    protected function wpsm_second_columns_fields() {
        $this->start_controls_section( 'second_column', [
            'label'     => esc_html__( 'Second Column', 'rehub-theme' ),
            'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control( 'module_cats_second', [
            'type'        => 'select2ajax',
            'label'       => esc_html__( 'Category second', 'rehub-theme' ),
            'options'       => [],
            'description'   => esc_html__( 'Enter names of categories. Or leave blank to show all', 'rehub-theme' ),
            'label_block'  => true,
            'multiple'     => false,
            'callback'    => 'get_second_categories_list',
            'conditions'  => [
                'terms'   => [
                    [
                        'name'     => 'only_one',
                        'operator' => '!=',
                        'value'    => '1',
                    ],
                ],
            ],
        ]);
        $this->add_control( 'cat_exclude_second', [
            'type'        => 'select2ajax',
            'label'       => esc_html__( 'Category exclude second', 'rehub-theme' ),
            'options'       => [],
            'description'   => esc_html__( 'Enter names of categories to exclude', 'rehub-theme' ),
            'label_block'  => true,
            'multiple'     => false,
            'callback'    => 'get_second_categories_exclude_list',
            'conditions'  => [
                'terms'   => [
                    [
                        'name'     => 'only_one',
                        'operator' => '!=',
                        'value'    => '1',
                    ],
                ],
            ],
        ]);
        $this->add_control( 'module_tags_second', [
            'type'        => 'select2ajax',
            'label'       => esc_html__( 'Tags second', 'rehub-theme' ),
            'options'       => [],
            'description'   => esc_html__( 'Enter names of tags. Or leave blank to show all', 'rehub-theme' ),
            'label_block'  => true,
            'multiple'     => false,
            'callback'    => 'get_second_tags_list',
            'conditions'  => [
                'terms'   => [
                    [
                        'name'     => 'only_one',
                        'operator' => '!=',
                        'value'    => '1',
                    ],
                ],
            ],
        ]);
        $this->add_control( 'tag_exclude_second', [
            'type'        => 'select2ajax',
            'label'       => esc_html__( 'Second column', 'rehub-theme' ),
            'options'       => [],
            'description'   => esc_html__( 'Enter names of tags to exclude.', 'rehub-theme' ),
            'label_block'  => true,
            'multiple'     => false,
            'callback'    => 'get_second_tags_exclude_list',
            'conditions'  => [
                'terms'   => [
                    [
                        'name'     => 'only_one',
                        'operator' => '!=',
                        'value'    => '1',
                    ],
                ],
            ],
        ]);

        $this->add_control( 'post_formats_second', [
            'type'        => \Elementor\Controls_Manager::SELECT,
            'label'       => esc_html__( 'Choose post formats first', 'rehub-theme' ),
            'description' => esc_html__('Choose post formats to display or leave blank to display all', 'rehub-theme'),
            'options'     => array(
                'all'       => esc_html__('all', 'rehub-theme'),
                'regular'   => esc_html__('regular', 'rehub-theme'),
                'video'     => esc_html__('video', 'rehub-theme'),
                'gallery'   => esc_html__('gallery', 'rehub-theme'),
                'review'    => esc_html__('review', 'rehub-theme'),
                'music'     => esc_html__('music', 'rehub-theme'),
            ),
            'conditions'  => [
                'terms'   => [
                    [
                        'name'     => 'only_one',
                        'operator' => '!=',
                        'value'    => '1',
                    ],
                ],
            ],
        ]);
        $this->add_control( 'color_cat_second', [
            'type'        => \Elementor\Controls_Manager::COLOR,
            'label'       => esc_html__( 'Color for category label', 'rehub-theme' ),
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'conditions'  => [
                'terms'   => [
                    [
                        'name'     => 'only_one',
                        'operator' => '!=',
                        'value'    => '1',
                    ],
                ],
            ],
        ]);

        $this->end_controls_section();
    }

    /* Widget output Rendering */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->normalize_arrays( $settings );
        echo two_col_news_shortcode( $settings );
    }


    public function get_categories_list() {
        global $wpdb;

        $query = [
            "select" => "SELECT SQL_CALC_FOUND_ROWS a.term_id AS id, b.name as name, b.slug AS slug
                        FROM {$wpdb->term_taxonomy} AS a
                        INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id",
            "where"  => "WHERE a.taxonomy = 'category'",
            "like"   => "AND NOT (a.term_id = '%d' OR b.slug LIKE '%s' OR b.name LIKE '%s' )",
            "offset" => "LIMIT %d, %d"
        ];

        $search_term = '';
        $cat_id     = '';
        if ( ! empty( $_POST['search'] ) ) {

            $cat_id = (int) $search_term;
            $cat_id = $cat_id > 0 ? $cat_id : - 1;

            $search_term = '%' . $wpdb->esc_like( $_POST['search'] ) . '%';
            $query["like"] = "AND (a.term_id = '%d' OR b.slug LIKE '%s' OR b.name LIKE '%s' )";
        }
        // $search_term = trim( $search_term );

        $offset = 0;
        $search_limit = 100;
        if ( isset( $_POST['page'] ) && intval( $_POST['page'] ) && $_POST['page'] > 1 ) {
            $offset = $search_limit * absint( $_POST['page'] );
        }

        $final_query = $wpdb->prepare( implode(' ', $query ), $cat_id, $search_term, $search_term, $offset, $search_limit );
        // Return saved values

        if ( ! empty( $_POST['saved'] ) && is_array( $_POST['saved'] ) ) {
            $saved_ids = array_map('intval', $_POST['saved']);
            $placeholders = array_fill(0, count( $saved_ids ), '%d');
            $format = implode(', ', $placeholders);

            $new_query = [
                "select" => $query['select'],
                "where"  => $query['where'],
                "id"     => "AND b.term_id IN( $format )",
                "order"  => "ORDER BY field(b.term_id, " . implode(",", $saved_ids) . ")"
            ];

            $final_query = $wpdb->prepare( implode( " ", $new_query), $saved_ids );
        }

        $results = $wpdb->get_results( $final_query );

        $total_results = $wpdb->get_row("SELECT FOUND_ROWS() as total_rows;");
        $response_data = [
            'results'       => [],
            'total_count'   => $total_results->total_rows
        ];

        if ( $results ) {
            foreach ( $results as $result ) {
                $response_data['results'][] = [
                    'id'    => $result->id,
                    'text'  => esc_html( $result->name ),
                    'slug'  => esc_html( $result->slug )
                ];
            }
        }

        wp_send_json_success( $response_data );
    }

    public function get_tags_list() {
        global $wpdb;

        $query = [
            "select" => "SELECT SQL_CALC_FOUND_ROWS a.term_id AS id, b.name as name, b.slug AS slug
                        FROM {$wpdb->term_taxonomy} AS a
                        INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id",
            "where"  => "WHERE a.taxonomy = 'post_tag'",
            "like"   => "AND NOT (a.term_id = '%d' OR b.slug LIKE '%s' OR b.name LIKE '%s' )",
            "offset" => "LIMIT %d, %d"
        ];

        $search_term = '';
        $cat_id     = '';
        if ( ! empty( $_POST['search'] ) ) {

            $cat_id = (int) $search_term;
            $cat_id = $cat_id > 0 ? $cat_id : - 1;

            $search_term = '%' . $wpdb->esc_like( $_POST['search'] ) . '%';
            $query["like"] = "AND (a.term_id = '%d' OR b.slug LIKE '%s' OR b.name LIKE '%s' )";
        }
        // $search_term = trim( $search_term );

        $offset = 0;
        $search_limit = 100;
        if ( isset( $_POST['page'] ) && intval( $_POST['page'] ) && $_POST['page'] > 1 ) {
            $offset = $search_limit * absint( $_POST['page'] );
        }

        $final_query = $wpdb->prepare( implode(' ', $query ), $cat_id, $search_term, $search_term, $offset, $search_limit );
        // Return saved values

        if ( ! empty( $_POST['saved'] ) && is_array( $_POST['saved'] ) ) {
            $saved_ids = array_map('intval', $_POST['saved']);
            $placeholders = array_fill(0, count( $saved_ids ), '%d');
            $format = implode(', ', $placeholders);

            $new_query = [
                "select" => $query['select'],
                "where"  => $query['where'],
                "id"     => "AND b.term_id IN( $format )",
                "order"  => "ORDER BY field(b.term_id, " . implode(",", $saved_ids) . ")"
            ];

            $final_query = $wpdb->prepare( implode( " ", $new_query), $saved_ids );
        }

        $results = $wpdb->get_results( $final_query );

        $total_results = $wpdb->get_row("SELECT FOUND_ROWS() as total_rows;");
        $response_data = [
            'results'       => [],
            'total_count'   => $total_results->total_rows
        ];

        if ( $results ) {
            foreach ( $results as $result ) {
                $response_data['results'][] = [
                    'id'    => $result->id,
                    'text'  => esc_html( $result->name ),
                    'slug'  => esc_html( $result->slug )
                ];
            }
        }

        wp_send_json_success( $response_data );
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new WPSM_Column_News_Block_Widget );
