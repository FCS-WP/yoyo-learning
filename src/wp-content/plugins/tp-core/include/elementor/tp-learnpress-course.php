<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_LearnPress_Course extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-learnpress';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Learnpress Course', 'tpcore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tp-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tpcore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'tpcore' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

        // tp_section_title
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_section_title_show',
            [
                'label' => esc_html__( 'Section Title & Content', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'tp_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Sub Title', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Title Here', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );       

        $this->add_control(
            'tp_desctiption',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('TP section description here', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .tp-sec-box' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();



		$this->start_controls_section(
            'tp_course_query',
            [
                'label' => esc_html__('LearnPress Query', 'tpcore'),
            ]
        );

        $post_type = 'lp_course';
        $taxonomy = 'course_category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'tpcore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'tpcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'tpcore'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => tp_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'tpcore'),
                'description' => esc_html__('Select a category to exclude', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => tp_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'options' => tp_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'tpcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
			    ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'tpcore' ),
                    'desc' 	=> esc_html__( 'Descending', 'tpcore' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __('Content', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'content_limit',
            [
                'label' => __('Content Limit', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'content' => 'yes'
                ]
            ]
        );


        $this->end_controls_section();


        // layout Panel
        $this->start_controls_section(
            'tp_campaign',
            [
                'label' => esc_html__('LearnPress - Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Grid Style 1', 'tpcore'),
                    'layout-2' => esc_html__('Grid Style 2', 'tpcore'),
                    'layout-3' => esc_html__('Grid Style 3', 'tpcore'),
                    'layout-4' => esc_html__('Grid Style 4', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->add_control(
            'tp_course_height',
            [
                'label' => esc_html__( 'Height', 'tpcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-project-img img' => 'height: {{SIZE}}{{UNIT}};object-fit: cover;',
                ],
            ]
        );
        $this->add_control(
            'tp_course_dots',
            [
                'label' => esc_html__('Dots?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'tp_course_arrow',
            [
                'label' => esc_html__('Arrow Icons?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tpcore'),
                'label_off' => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'tp_course_infinite',
            [
                'label' => esc_html__('Infinite?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'tp_course_autoplay',
            [
                'label' => esc_html__('Autoplay?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-2',
                ),
            ]
        );        
        $this->add_control(
            'tp_course_autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => '2500',
                'title' => esc_html__('Enter autoplay speed', 'tpcore'),
                'label_block' => true,
                'condition' => array(
                    'tp_course_autoplay' => 'yes',
                    'tp_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'tp_course_filter',
            [
                'label' => esc_html__('Filter?', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tpcore'),
                'label_off' => esc_html__('No', 'tpcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-3',
                ),
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-campaign-thumb',
            ]
        );
        $this->add_control(
            'tp_course_pagination',
            [
                'label' => esc_html__( 'Pagination', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
                // 'condition' => array(
                //     'tp_design_style' => 'layout-1',
                // ),
            ]
        );
        
        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tp_design_style' => 'layout-3',
                ),
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );


        $this->add_control(
            'tp_image_show',
            [
                'label' => esc_html__( 'Show Image', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );        

        $this->add_control(
            'tp_prcie_show',
            [
                'label' => esc_html__( 'Show Price', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_cat_show',
            [
                'label' => esc_html__( 'Show Category', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );        

        $this->add_control(
            'tp_author_show',
            [
                'label' => esc_html__( 'Show Author', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_lessons_show',
            [
                'label' => esc_html__( 'Show Lessons', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );            

        $this->add_control(
            'tp_duration_show',
            [
                'label' => esc_html__( 'Show Duration', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );        

        $this->add_control(
            'tp_rating_show',
            [
                'label' => esc_html__( 'Show Rating', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );               

        $this->add_control(
            'tp_students_show',
            [
                'label' => esc_html__( 'Show Students', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );        

        $this->end_controls_section();

        // tp_course_columns_section
        $this->start_controls_section(
            'tp_course_columns_section',
            [
                'label' => esc_html__('LearnPress - Columns', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_course__for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'tpcore' ),
                    6 => esc_html__( '2 Columns', 'tpcore' ),
                    4 => esc_html__( '3 Columns', 'tpcore' ),
                    3 => esc_html__( '4 Columns', 'tpcore' ),
                    2 => esc_html__( '6 Columns', 'tpcore' ),
                    1 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_course__for_laptop',
            [
                'label' => esc_html__( 'Columns for Laptop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'tpcore' ),
                    6 => esc_html__( '2 Columns', 'tpcore' ),
                    4 => esc_html__( '3 Columns', 'tpcore' ),
                    3 => esc_html__( '4 Columns', 'tpcore' ),
                    2 => esc_html__( '6 Columns', 'tpcore' ),
                    1 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_course__for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 576px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'tpcore' ),
                    6 => esc_html__( '2 Columns', 'tpcore' ),
                    4 => esc_html__( '3 Columns', 'tpcore' ),
                    3 => esc_html__( '4 Columns', 'tpcore' ),
                    2 => esc_html__( '6 Columns', 'tpcore' ),
                    1 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '6',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            '
            ',
            [
                'label' => esc_html__( 'Columns for Mobile', 'tpcore' ),
                'description' => esc_html__( 'Screen width less than 576px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'tpcore' ),
                    6 => esc_html__( '2 Columns', 'tpcore' ),
                    4 => esc_html__( '3 Columns', 'tpcore' ),
                    3 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'tpcore' ),
                    2 => esc_html__( '6 Columns', 'tpcore' ),
                    1 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '12',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // tp_course_slider_columns_section
		$this->start_controls_section(
            'tp_course_slider_columns_section',
            [
                'label' => esc_html__('LearnPress - Columns for Carousel', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_course_slider_for_xl_desktop',
            [
                'label' => esc_html__( 'Columns for Extra Large Desktop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1920px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_course_slider_for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1200px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_course_slider_for_laptop',
            [
                'label' => esc_html__( 'Columns for Laptop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_course_slider_for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '2',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_course_slider_for_mobile',
            [
                'label' => esc_html__( 'Columns for Mobile', 'tpcore' ),
                'description' => esc_html__( 'Screen width less than 767', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '1',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_course_slider_for_xs_mobile',
            [
                'label' => esc_html__( 'Columns for Extra Small Mobile', 'tpcore' ),
                'description' => esc_html__( 'Screen width less than 575px', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 Columns', 'tpcore' ),
                    2 => esc_html__( '2 Columns', 'tpcore' ),
                    3 => esc_html__( '3 Columns', 'tpcore' ),
                    4 => esc_html__( '4 Columns', 'tpcore' ),
                    5 => esc_html__( '5 Columns', 'tpcore' ),
                    6 => esc_html__( '6 Columns', 'tpcore' ),
                    7 => esc_html__( '7 Columns', 'tpcore' ),
                    8 => esc_html__( '8 Columns', 'tpcore' ),
                    9 => esc_html__( '9 Columns', 'tpcore' ),
                    10 => esc_html__( '10 Columns', 'tpcore' ),
                    11 => esc_html__( '10 Columns', 'tpcore' ),
                    12 => esc_html__( '12 Columns', 'tpcore' ),
                ],
                'separator' => 'before',
                'default' => '1',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();


        // style control


		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'tpcore' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'tpcore' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'tpcore' ),
					'uppercase' => __( 'UPPERCASE', 'tpcore' ),
					'lowercase' => __( 'lowercase', 'tpcore' ),
					'capitalize' => __( 'Capitalize', 'tpcore' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if(!empty($settings['exclude_category'])){
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (! empty( $settings['ignore_sticky_posts'] ) && 'yes' == $settings['ignore_sticky_posts']) ? true : false ;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => 'lp_course',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if ( !empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'	=> 'course_category',
                    'field'	 	=> 'slug',
                    'terms'		=> $exclude_category_list_value,
                    'operator'	=> 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if ( !empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'	=> 'course_category',
                    'field'		=> 'slug',
                    'terms'		=> $category_list_value,
                    'operator'	=> 'IN'
                );
            }

        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => 'course_category',
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($args);

        // var_dump($query);

        $carousel_args = [
            'arrows' => ('yes' === $settings['tp_course_arrow']),
            'dots' => ('yes' === $settings['tp_course_dots']),
            'autoplay' => ('yes' === $settings['tp_course_autoplay']),
            'autoplay_speed' => absint($settings['tp_course_autoplay_speed']),
            'infinite' => ('yes' === $settings['tp_course_infinite']),
            'for_xl_desktop' => absint($settings['tp_course_slider_for_xl_desktop']),
            'slidesToShow' => absint($settings['tp_course_slider_for_desktop']),
            'for_laptop' => absint($settings['tp_course_slider_for_laptop']),
            'for_tablet' => absint($settings['tp_course_slider_for_tablet']),
            'for_mobile' => absint($settings['tp_course_slider_for_mobile']),
            'for_xs_mobile' => absint($settings['tp_course_slider_for_xs_mobile']),
        ];
        $this->add_render_attribute('tp-carousel-campaign-data', 'data-settings', wp_json_encode($carousel_args));

        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

       <section class="course-wrap-area">
          <div class="container">
             <div class="row">
                <?php                       
                if ($query->have_posts()):
                    while ($query->have_posts()) : $query->the_post();

                        $terms = get_the_terms(get_the_ID(), 'course_category');
                        $course = learn_press_get_course();
                        $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0;
                        $instructor = $course->get_instructor();
                        $instructor_link = $course->get_instructor_html();
                        $instructor_id = $course->get_id(); 
                ?>
                <div class="col-lg-6 col-md-12">
                   <div class="tpcourse tp-wrap-course mb-40">
                      <div class="row">
                         <?php if(!empty($settings['tp_image_show'])) : ?>
                         <div class="col-xl-4 tpcourse-thumb-w">
                            <div class="tpcourse__thumb p-relative w-img fix">
                                <a href="<?php print get_the_permalink() ?>">
                                  <?php echo get_the_post_thumbnail(get_the_ID(), $settings['thumbnail_size']); ?>
                               </a>
                            </div>
                         </div>
                         <?php endif; ?>

                         <div class="col-xl-8 tpcourse-thumb-text">
                            <div class="tp-wrap-course__content ml-5">
                               <div class="tp-wrap-course__heading">
                                  <h4 class="tp-wrap-course__title mb-20"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                               </div>
                               <div class="tpcourse__meta tp-course-line pb-20 mb-25">
                                  <ul class="d-flex align-items-center">
                                        <?php if(!empty($settings['tp_lessons_show'])) : ?>
                                       <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-01.png" alt="meta-icon"> <span><?php echo esc_html($lessons); ?><?php echo esc_html__(' Lessons', 'tpcore'); ?></span></li>
                                       <?php endif; ?> 
                                       <?php if(!empty($settings['tp_students_show'])) : ?>
                                       <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-02.png" alt="meta-icon"> <span><?php $student = _n('%s  Student', '%s students', $course->get_users_enrolled(), 'epora');
                                             echo sprintf($student, $course->get_users_enrolled());
                                        ?></span></li>
                                        <?php endif; ?> 

                                     <?php if(!empty($settings['tp_rating_show'])) : ?>   
                                     <?php 
                                     if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
                                         $total_rating = 5;
                                         $reviews = leanr_press_get_ratings_result( get_the_ID() ); 
                                         $taken_rating = !empty($reviews['rated']) ? $reviews['rated'] : 0;
                                         $blank_rating = $total_rating - $taken_rating;
                                     ?> 
                                       <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-03.png" alt="meta-icon"> <span><?php echo esc_html($taken_rating); ?></span></li>
                                     <?php endif; ?> 
                                     <?php endif; ?> 
                                  </ul>
                               </div>
                               <div class="tpcourse__category c-price-list d-flex align-items-center justify-content-between">
                                  <?php if(!empty($settings['tp_prcie_show'])) : ?>  
                                      <?php if($course->is_free()): ?>
                                      <h5 class="tpcourse__course-price c-price-pac"> <?php echo esc_html__('Free','tpcore'); ?> </h5>
                                      <?php else: ?>

                                        <h5 class="tpcourse__course-price c-price-pac"><?php echo $course->get_price_html(); ?> </h5>
                                        <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
                                        <h5 class="tpcourse__course-price c-price-pac old-price"><?php echo $course->get_origin_price_html(); ?></h5>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                  <?php endif; ?>

                                    <?php if(!empty($settings['tp_cat_show'])) : ?>
                                        <?php if(!empty($terms)) : ?>
                                        <ul class="tpcourse__price-list  d-flex align-items-center">
                                            <?php foreach ($terms as $key => $term) : ?>
                                                <?php if($key == 0) : ?>  
                                                <li><a class="c-color-red" href="<?php echo get_term_link($term->slug, 'course_category'); ?>"><?php echo $term->name; ?></a></li>
                                                <?php elseif(!empty($key == 1)) : ?>
                                                    <li><a class="c-color-red" href="<?php echo get_term_link($term->slug, 'course_category'); ?>"><?php echo $term->name; ?></a></li>
                                                <?php endif; ?>
                                           <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                    <?php endif; ?>                              
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <?php endwhile; ?>

                <?php if($settings['tp_course_pagination'] == 'yes' && '-1' != $settings['posts_per_page']) : ?>
                <div class="col-lg-12">
                    <div class="basic-pagination mt-20">
                        <?php
                        $big = 999999999; // need an unlikely integer

                        if (get_query_var('paged')) {
                            $paged = get_query_var('paged');
                        } else if (get_query_var('page')) {
                            $paged = get_query_var('page');
                        } else {
                            $paged = 1;
                        }
                        echo paginate_links( array(
                            'base'       => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                            'format'     => '?paged=%#%',
                            'current'    => $paged,
                            'total'      => $query->max_num_pages,
                            'type'       =>'list',
                            'prev_text'  =>'<i class="fas fa-angle-left"></i>',
                            'next_text'  =>'<i class="fas fa-angle-right"></i>',
                            'show_all'   => false,
                            'end_size'   => 1,
                            'mid_size'   => 4,
                        ) );
                        ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php wp_reset_query(); endif; ?>    
             </div>
          </div>
       </section>

        <?php elseif ($settings['tp_design_style'] === 'layout-3'): ?>
       <section class="course-area">
          <div class="container">
             <!-- course-nav-tab-start -->
             <div class="tp-course-nav-tabs">
                <?php if( $filter_list > 0 ) { ?>
                <nav>
                   <div class="nav d-flex justify-content-center mb-50" id="nav-tab" role="tablist">
                    <?php foreach ( $filter_list as $key => $list ): 
                        $active = ($key == 0) ? 'active' : '';
                    ?>
                   <button class="tp-course-tab <?php echo esc_attr($active); ?>" id="nav-all-tab-<?php echo esc_attr( $key ); ?>" data-bs-toggle="tab" data-bs-target="#nav-all-<?php echo esc_attr( $key ); ?>" type="button" role="tab" aria-controls="nav-all-tab-<?php echo esc_attr( $key ); ?>" aria-selected="true"><?php echo esc_html( $list ); ?></button>
                   <?php endforeach; ?>
                   </div>
                </nav>
                <?php }?>

                <?php if( $filter_list > 0 ) { ?>
                <div class="tab-content" id="nav-tabContent">
                    <?php
                        global $post;
                        foreach ($filter_list as $key => $list):
                        $active_tab = ($key == 0) ? 'active show' : '';
                    ?>
                   <div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="nav-all-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="nav-all-tab-<?php echo esc_attr( $key ); ?>">
                      <div class="row">
                        <?php
                            $post_args = [
                                'post_status' => 'publish',
                                'post_type' => 'lp_course',
                                'posts_per_page' => $posts_per_page,
                                'course_category' => $list,
                            ];
                            $posts = get_posts($post_args);
                            foreach ($posts as $post):
                            $terms = get_the_terms(get_the_ID(), 'course_category');
                            $course = learn_press_get_course();
                            $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0;
                            $instructor = $course->get_instructor();
                            $instructor_link = $course->get_instructor_html();
                            $instructor_id = $course->get_id();     
                        ?>
                         <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="tpcourse mb-40">
                               <div class="tpcourse__thumb p-relative w-img fix">
                                    <a href="<?php print get_the_permalink() ?>">
                                      <?php echo get_the_post_thumbnail(get_the_ID(), $settings['thumbnail_size']); ?>
                                   </a>
                                  <div class="tpcourse__img-icon">
                                        <?php if(!empty($settings['tp_author_show'])) : ?>
                                        <?php 
                                            $dir = learn_press_user_profile_picture_upload_dir();
                                            $user = get_user_by( 'id', $instructor->get_id());
                                            $pro_link = get_user_meta($user->ID,'_lp_profile_picture',true); 
                                            $base_url = isset($dir['baseurl'])?$dir['baseurl']:'';
                                            $profile_link =  $base_url.'/'.$pro_link;
                                        ?>
                                       <?php if($pro_link !='') : ?> 
                                        <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                                        <?php else: ?>
                                        <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                                        <?php endif; ?>

                                        <?php endif; ?>
                                  </div>
                               </div>
                               <div class="tpcourse__content-2">
                                    <?php if(!empty($settings['tp_cat_show'])) : ?>
                                      <div class="tpcourse__category mb-10">
                                            <?php if(!empty($terms)) : ?>
                                            <ul class="tpcourse__price-list d-flex align-items-center">
                                                <?php foreach ($terms as $key => $term) : ?>
                                                    <?php if($key == 0) : ?>  
                                                    <li><a class="c-color-red" href="<?php echo get_term_link($term->slug, 'course_category'); ?>"><?php echo $term->name; ?></a></li>
                                                    <?php elseif(!empty($key == 1)) : ?>
                                                        <li><a class="c-color-red" href="<?php echo get_term_link($term->slug, 'course_category'); ?>"><?php echo $term->name; ?></a></li>
                                                    <?php endif; ?>
                                               <?php endforeach; ?>
                                            </ul>
                                            <?php endif; ?>
                                      </div>
                                    <?php endif; ?>
                                  <div class="tpcourse__ava-title mb-15">
                                     <h4 class="tpcourse__title tp-cours-title-color"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                  </div>
                                  <div class="tpcourse__meta tpcourse__meta-gap pb-15 mb-15">
                                     <ul class="d-flex align-items-center">
                                        <?php if(!empty($settings['tp_lessons_show'])) : ?>
                                       <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-01.png" alt="meta-icon"> <span><?php echo esc_html($lessons); ?><?php echo esc_html__(' Lessons', 'tpcore'); ?></span></li>
                                       <?php endif; ?> 
                                       <?php if(!empty($settings['tp_students_show'])) : ?>
                                       <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-02.png" alt="meta-icon"> <span><?php $student = _n('%s  Student', '%s students', $course->get_users_enrolled(), 'epora');
                                             echo sprintf($student, $course->get_users_enrolled());
                                        ?></span></li>
                                        <?php endif; ?> 
                                     </ul>
                                  </div>
                                  <div class="tpcourse__rating d-flex align-items-center justify-content-between">
                                    <?php 
                                     if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
                                     $total_rating = 5;
                                     $reviews = leanr_press_get_ratings_result( get_the_ID() ); 
                                     $taken_rating = !empty($reviews['rated']) ? $reviews['rated'] : 0;
                                     $blank_rating = $total_rating - $taken_rating;
                                    ?>
                                     <div class="tpcourse__rating-icon">
                                        <span><?php echo esc_html($taken_rating); ?></span>
                                        <?php 
                                       for ($i=0; $i < intval($taken_rating); $i++) { ?>
                                           <i class="fi fi-ss-star"></i>
                                       <?php } ?>
                                       <?php for ($j=0; $j < intval($blank_rating); $j++) { ?>
                                           <i class="fi fi-rs-star"></i>
                                       <?php } ?>
                                        <p>(<?php echo !empty($reviews['total']) ? $reviews['total'] : 0; ?>)</p>
                                     </div>
                                     <?php endif; ?>
                                    <?php if(!empty($settings['tp_prcie_show'])) : ?>  
                                         <div class="tpcourse__pricing">
                                          <?php if($course->is_free()): ?>
                                          <h5 class="price-title"> <?php echo esc_html__('Free','tpcore'); ?> </h5>
                                          <?php else: ?>

                                            <h5 class="price-title"><?php echo $course->get_price_html(); ?> </h5>
                                            <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
                                            <h5 class="price-title old-price"><?php echo $course->get_origin_price_html(); ?></h5>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                         </div>
                                    <?php endif; ?>
                                  </div>
                               </div>
                            </div>
                         </div>
                        <?php endforeach; 
                            wp_reset_query(); 
                        ?>
                      </div>
                   </div>
                   <?php endforeach; ?>
                </div>
                <?php } else { ?>
                  <div class="row">
                    <?php
                       global $post;
                        $post_args = [
                            'post_status' => 'publish',
                            'post_type' => 'lp_course',
                            'posts_per_page' => $posts_per_page,
                        ];
                        $posts = get_posts($post_args);
                        foreach ($posts as $post):
                        $terms = get_the_terms(get_the_ID(), 'course_category');
                        $course = learn_press_get_course();
                        $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0;
                        $instructor = $course->get_instructor();
                        $instructor_link = $course->get_instructor_html();
                        $instructor_id = $course->get_id();     
                    ?>
                     <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tpcourse mb-40">
                           <div class="tpcourse__thumb p-relative w-img fix">
                                <a href="<?php print get_the_permalink() ?>">
                                  <?php echo get_the_post_thumbnail(get_the_ID(), $settings['thumbnail_size']); ?>
                               </a>
                              <div class="tpcourse__img-icon">
                                    <?php if(!empty($settings['tp_author_show'])) : ?>
                                    <?php 
                                        $dir = learn_press_user_profile_picture_upload_dir();
                                        $user = get_user_by( 'id', $instructor->get_id());
                                        $pro_link = get_user_meta($user->ID,'_lp_profile_picture',true); 
                                        $base_url = isset($dir['baseurl'])?$dir['baseurl']:'';
                                        $profile_link =  $base_url.'/'.$pro_link;
                                    ?>
                                   <?php if($pro_link !='') : ?> 
                                    <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                                    <?php else: ?>
                                    <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                                    <?php endif; ?>

                                    <?php endif; ?>
                              </div>
                           </div>
                           <div class="tpcourse__content-2">
                                <?php if(!empty($settings['tp_cat_show'])) : ?>
                                  <div class="tpcourse__category mb-10">
                                        <?php if(!empty($terms)) : ?>
                                        <ul class="tpcourse__price-list d-flex align-items-center">
                                            <?php foreach ($terms as $key => $term) : ?>
                                                <?php if($key == 0) : ?>  
                                                <li><a class="c-color-red" href="<?php echo get_term_link($term->slug, 'course_category'); ?>"><?php echo $term->name; ?></a></li>
                                                <?php elseif(!empty($key == 1)) : ?>
                                                    <li><a class="c-color-red" href="<?php echo get_term_link($term->slug, 'course_category'); ?>"><?php echo $term->name; ?></a></li>
                                            <?php endif; ?>
                                           <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                  </div>
                                <?php endif; ?>
                              <div class="tpcourse__ava-title mb-15">
                                 <h4 class="tpcourse__title tp-cours-title-color"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                              </div>
                              <div class="tpcourse__meta tpcourse__meta-gap pb-15 mb-15">
                                 <ul class="d-flex align-items-center">
                                    <?php if(!empty($settings['tp_lessons_show'])) : ?>
                                   <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-01.png" alt="meta-icon"> <span><?php echo esc_html($lessons); ?><?php echo esc_html__(' Lessons', 'tpcore'); ?></span></li>
                                   <?php endif; ?> 
                                   <?php if(!empty($settings['tp_students_show'])) : ?>
                                   <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-02.png" alt="meta-icon"> <span><?php $student = _n('%s  Student', '%s students', $course->get_users_enrolled(), 'epora');
                                         echo sprintf($student, $course->get_users_enrolled());
                                    ?></span></li>
                                    <?php endif; ?> 
                                 </ul>
                              </div>
                              <div class="tpcourse__rating d-flex align-items-center justify-content-between">
                                <?php 
                                 if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
                                 $total_rating = 5;
                                 $reviews = leanr_press_get_ratings_result( get_the_ID() ); 
                                 $taken_rating = !empty($reviews['rated']) ? $reviews['rated'] : 0;
                                 $blank_rating = $total_rating - $taken_rating;
                                ?>
                                 <div class="tpcourse__rating-icon">
                                    <span><?php echo esc_html($taken_rating); ?></span>
                                    <?php 
                                   for ($i=0; $i < intval($taken_rating); $i++) { ?>
                                       <i class="fi fi-ss-star"></i>
                                   <?php } ?>
                                   <?php for ($j=0; $j < intval($blank_rating); $j++) { ?>
                                       <i class="fi fi-rs-star"></i>
                                   <?php } ?>
                                    <p>(<?php echo !empty($reviews['total']) ? $reviews['total'] : 0; ?>)</p>
                                 </div>
                                 <?php endif; ?>
                                <?php if(!empty($settings['tp_prcie_show'])) : ?>  
                                     <div class="tpcourse__pricing">
                                      <?php if($course->is_free()): ?>
                                      <h5 class="price-title"> <?php echo esc_html__('Free','tpcore'); ?> </h5>
                                      <?php else: ?>

                                        <h5 class="price-title"><?php echo $course->get_price_html(); ?> </h5>
                                        <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
                                        <h5 class="price-title old-price"><?php echo $course->get_origin_price_html(); ?></h5>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                     </div>
                                <?php endif; ?>
                              </div>
                           </div>
                        </div>
                     </div>
                    <?php endforeach; 
                        wp_reset_query(); 
                    ?>
                  </div>
                 <?php }?>   

             </div>
          </div>
       </section>


        <?php else: ?>
       <section class="course-area">
          <div class="container">
             <div class="row">
                <?php                       
                if ($query->have_posts()):
                    while ($query->have_posts()) : $query->the_post();

                        $terms = get_the_terms(get_the_ID(), 'course_category');
                        $course = learn_press_get_course();
                        $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0;
                        $instructor = $course->get_instructor();
                        $instructor_link = $course->get_instructor_html();
                        $instructor_id = $course->get_id(); 
                ?>
                <div class="col-xl-4 col-lg-6 col-md-6">
                   <div class="tpcourse mb-40">
                      <?php if(!empty($settings['tp_image_show'])) : ?>
                      <div class="tpcourse__thumb p-relative w-img fix">
                           <a href="<?php print get_the_permalink() ?>">
                              <?php echo get_the_post_thumbnail(get_the_ID(), $settings['thumbnail_size']); ?>
                           </a>
                      </div>
                      <?php endif; ?>

                      <div class="tpcourse__content">
                         <div class="tpcourse__avatar d-flex align-items-center mb-20">
                            <?php if(!empty($settings['tp_author_show'])) : ?>
                            <?php 
                                $dir = learn_press_user_profile_picture_upload_dir();
                                $user = get_user_by( 'id', $instructor->get_id());
                                $pro_link = get_user_meta($user->ID,'_lp_profile_picture',true); 
                                $base_url = isset($dir['baseurl'])?$dir['baseurl']:'';
                                $profile_link =  $base_url.'/'.$pro_link;
                            ?>
                           <?php if($pro_link !='') : ?> 
                            <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                            <?php else: ?>
                            <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                            <?php endif; ?>

                            <?php endif; ?>
                                
                            <h4 class="tpcourse__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                         </div>
                         <div class="tpcourse__meta pb-15 mb-20">
                            <ul class="d-flex align-items-center">
                                <?php if(!empty($settings['tp_lessons_show'])) : ?>
                               <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-01.png" alt="meta-icon"> <span><?php echo esc_html($lessons); ?><?php echo esc_html__(' Lessons', 'tpcore'); ?></span></li>
                               <?php endif; ?> 
                               <?php if(!empty($settings['tp_students_show'])) : ?>
                               <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-02.png" alt="meta-icon"> <span><?php $student = _n('%s  Student', '%s students', $course->get_users_enrolled(), 'epora');
                                     echo sprintf($student, $course->get_users_enrolled());
                                ?></span></li>
                                <?php endif; ?> 

                             <?php if(!empty($settings['tp_rating_show'])) : ?>   
                             <?php 
                             if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
                                 $total_rating = 5;
                                 $reviews = leanr_press_get_ratings_result( get_the_ID() ); 
                                 $taken_rating = !empty($reviews['rated']) ? $reviews['rated'] : 0;
                                 $blank_rating = $total_rating - $taken_rating;
                             ?> 
                               <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-03.png" alt="meta-icon"> <span><?php echo esc_html($taken_rating); ?></span></li>
                             <?php endif; ?> 
                             <?php endif; ?>  
                            </ul>
                         </div>
                         <div class="tpcourse__category d-flex align-items-center justify-content-between">
                            <?php if(!empty($settings['tp_cat_show'])) : ?>
                                <?php if(!empty($terms)) : ?>
                                <ul class="tpcourse__price-list d-flex align-items-center">
                                    <?php foreach ($terms as $key => $term) : ?>
                                        <?php if($key == 0) : ?>  
                                        <li><a class="c-color-red" href="<?php echo get_term_link($term->slug, 'course_category'); ?>"><?php echo $term->name; ?></a></li>
                                        <?php elseif(!empty($key == 1)) : ?>
                                            <li><a class="c-color-red" href="<?php echo get_term_link($term->slug, 'course_category'); ?>"><?php echo $term->name; ?></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            <?php endif; ?>

                          <?php if(!empty($settings['tp_prcie_show'])) : ?>  
                              <?php if($course->is_free()): ?>
                              <h5 class="tpcourse__course-price"> <?php echo esc_html__('Free','tpcore'); ?> </h5>
                              <?php else: ?>

                                <h5 class="tpcourse__course-price"><?php echo $course->get_price_html(); ?> </h5>
                                <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
                                <h5 class="tpcourse__course-price old-price"><?php echo $course->get_origin_price_html(); ?></h5>
                                <?php endif; ?>
                                <?php endif; ?>
                          <?php endif; ?>
                         </div>
                      </div>
                   </div>
                </div>

                <?php endwhile; ?>

                <?php if($settings['tp_course_pagination'] == 'yes' && '-1' != $settings['posts_per_page']) : ?>
                <div class="col-lg-12">
                    <div class="basic-pagination mt-20">
                        <?php
                        $big = 999999999; // need an unlikely integer

                        if (get_query_var('paged')) {
                            $paged = get_query_var('paged');
                        } else if (get_query_var('page')) {
                            $paged = get_query_var('page');
                        } else {
                            $paged = 1;
                        }
                        echo paginate_links( array(
                            'base'       => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                            'format'     => '?paged=%#%',
                            'current'    => $paged,
                            'total'      => $query->max_num_pages,
                            'type'       =>'list',
                            'prev_text'  =>'<i class="fas fa-angle-left"></i>',
                            'next_text'  =>'<i class="fas fa-angle-right"></i>',
                            'show_all'   => false,
                            'end_size'   => 1,
                            'mid_size'   => 4,
                        ) );
                        ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php wp_reset_query(); endif; ?>            

             </div>
          </div>
       </section>

    	<?php endif; ?>

       <?php
	}

}

$widgets_manager->register( new TP_LearnPress_Course() );