<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_About extends Widget_Base {

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
		return 'tp-about';
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
		return __( 'TP :: About', 'tpcore' );
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

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Style', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Style 1', 'tpcore'),
                    'layout-2' => esc_html__('Style 2', 'tpcore'),
                    'layout-3' => esc_html__('Style 3', 'tpcore'),
                    'layout-4' => esc_html__('Style 4', 'tpcore'),
                    'layout-5' => esc_html__('Style 5', 'tpcore'),
                    'layout-6' => esc_html__('Style 6', 'tpcore'),
                    'layout-7' => esc_html__('Style 7', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // tp_section_title
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tpcore'),
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
                    '{{WRAPPER}} .tp-section-box, .section-title' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();



        // _tp_image
        $this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => ['tp_design_style' => ['layout-1', 'layout-3']]
            ]
        );
        $this->add_control(
            'tp_image_3',
            [
                'label' => esc_html__( 'Choose Image 3', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => ['tp_design_style' => 'layout-1']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        $this->end_controls_section();

        // tp_section_animation
        $this->start_controls_section(
            'tp_section_animation',
            [
                'label' => esc_html__('Animation Badge', 'tpcore'),
                'condition' => ['tp_design_style' => ['layout-2', 'layout-4', 'layout-5', 'layout-7']]
            ]
        );

        $this->add_control(
            'tp_section_animation_show',
            [
                'label' => esc_html__( 'Show Animation', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'tp_at_title1',
            [
                'label' => esc_html__('Text One', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Animation Text', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
                'condition' => ['tp_section_animation_show' => 'yes']
            ]
        );  

        $this->add_control(
            'tp_at_title2',
            [
                'label' => esc_html__('Text Two', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Animation Text 2', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
                'condition' => ['tp_section_animation_show' => 'yes']
            ]
        );  

        $this->add_control(
            'tp_at_title3',
            [
                'label' => esc_html__('Text Three', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Animation Text 3', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_section_animation_show' => 'yes',
                    'tp_design_style' => ['layout-4', 'layout-5']
                ]
            ]
        );  
        $this->end_controls_section();


        // list group
        $this->start_controls_section(
            'tp_list',
            [
                'label' => esc_html__('List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => ['tp_design_style' => ['layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7']] 
            ]
        );

        $repeater = new \Elementor\Repeater();

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_about_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa-light fa-check',
                ]
            );
        } else {
            $repeater->add_control(
                'tp_about_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fa-light fa-check',
                        'library' => 'solid',
                    ],
                ]
            );
        }

        $repeater->add_control(
            'tp_list_text', [
                'label' => esc_html__('Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Easy & Emergency Solutions Anytime', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_list_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_list_text' => esc_html__('Performance Improve', 'tpcore'),
                    ],
                    [
                        'tp_list_text' => esc_html__('Performance Improve', 'tpcore')
                    ],
                    [
                        'tp_list_text' => esc_html__('Performance Improve', 'tpcore')
                    ],
                    [
                        'tp_list_text' => esc_html__('Performance Improve', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_list_text }}}',
            ]
        );
        $this->end_controls_section();

        

        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
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
                    'tp_btn_button_show' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'tpcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        // title / content Style
        $this->start_controls_section(
            '_section_style_tc',
            [
                'label' => __( 'Title / Content', 'tocore' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // title
        $this->add_control(
            '_title_style_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typ',
                'selector' => '{{WRAPPER}} .tp-section-title',
            ]
        );

        // sub title
        $this->add_control(
            '_subtitle_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Sub Title', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-section-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'subtitle_bg_color',
            [
                'label' => __( 'Background Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-section-subtitle' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typ',
                'selector' => '{{WRAPPER}} .tp-section-subtitle',
            ]
        );

        // description
        $this->add_control(
            'description_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'tocore' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-section-box p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typ',
                'selector' => '{{WRAPPER}} .tp-section-box p',
            ]
        );

        $this->end_controls_section();

        // About Meta Style
        $this->start_controls_section(
            '_section_style_meta',
            [
                'label' => __( 'About Meta', 'tocore' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // name
        $this->add_control(
            '_about_meta_name',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Name', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'am_name_color',
            [
                'label' => __( 'Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-ab-meta-text span b, .ab-meta-title, .about-signature h6' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'am_mata_name_typ',
                'selector' => '{{WRAPPER}} .tp-ab-meta-text span b, .ab-meta-title, .about-signature h6',
            ]
        );

        // position
        $this->add_control(
            '_about_meta_position',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Position', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'am_position_color',
            [
                'label' => __( 'Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-ab-meta-text span i, .ab-meta-subtitle, .about-signature h6 span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'am_mata_position_typ',
                'selector' => '{{WRAPPER}} .tp-ab-meta-text span i, .ab-meta-subtitle, .about-signature h6 span',
            ]
        );

        // description
        $this->add_control(
            '_about_meta_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'tocore' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'am_description_color',
            [
                'label' => __( 'Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-ab-meta-text h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'am_description_typ',
                'selector' => '{{WRAPPER}} .tp-ab-meta-text h4',
            ]
        );


        $this->end_controls_section();

        



		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Content Style', 'tpcore' ),
				'tab' => Controls_Manager::TAB_STYLE,'
                condition' => ['tp_design_style' => 'layout-2',]
			]
		);

        // animation
        $this->add_control(
            '_animation',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Animation', 'tocore' ),
                'separator' => 'before',
                'condition' => [
                        'tp_design_style' => ['layout-1', 'layout-4']
                    ]
            ]
        );

        $this->add_control(
            'animation_color',
            [
                'label' => __( 'Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-about-circle h3, .tp-about-circle p, .tp-about-circle span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'animation_bg_color',
            [
                'label' => __( 'Background Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-about-circle ' => 'background-color: {{VALUE}}',
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

        $tp_design_style = $settings['tp_design_style'];

		?>

        <?php if ( $settings['tp_design_style']  == 'layout-7' ): 

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }  

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-25');

        ?> 


        <section class="tp-about-area wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".3s">
             <div class="container">
                <div class="row align-items-center">
                   <div class="col-xxl-7 col-xl-7 col-lg-6 col-md-12 col-12">
                      <div class="tp-about-class p-relative pb-50">

                        <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_section_animation_show'])) : ?>
                         <div class="tp-about-class-info tp-sub-about-info d-none d-md-block">
                            <ul>

                                <?php if(!empty($settings['tp_at_title1'])) : ?>
                                <li>
                                    <?php echo tp_kses($settings['tp_at_title1']);?>
                                </li>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_at_title2'])) : ?>
                                <li>
                                    <?php echo tp_kses($settings['tp_at_title2']);?>
                                </li>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_at_title3'])) : ?>
                                <li>
                                    <?php echo tp_kses($settings['tp_at_title3']);?>
                                </li>
                                <?php endif; ?>

                            </ul>
                         </div>
                        <?php endif; ?>

                      </div>
                   </div>
                   <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-12 col-12">
                      <div class="tp-about-class-content mb-50 ml-75">
                         <div class="section-title mb-35">

                            <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                            <span class="tp-sub-title-box mb-15">
                                <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                            ?>

                            <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                            <?php endif; ?>


                         </div>
                         <div class="tp-about-list mb-65">
                            <ul>

                            <?php foreach ($settings['tp_list_list'] as $key => $item) : ?>
                                <?php if (!empty($item['tp_list_text' ])): ?>
                                <li>

                                    <?php if (!empty($item['tp_about_icon']) || !empty($item['tp_about_selected_icon']['value'])) : ?>
                                        <?php tp_render_icon($item, 'tp_about_icon', 'tp_about_selected_icon'); ?>
                                    <?php echo tp_kses($item['tp_list_text' ]);?>
                                    <?php else : ?>
                                    <?php echo tp_kses($item['tp_list_text' ]);?>
                                    <?php endif; ?>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            </ul>
                         </div>

                        <?php if (!empty($settings['tp_btn_text']) && !empty($settings['tp_btn_button_show'])) : ?>
                         <div class="tp-about-btn-3">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                         </div>
                        <?php endif; ?> 

                      </div>
                   </div>
                </div>
             </div>
        </section>


        <?php elseif ( $settings['tp_design_style']  == 'layout-6' ): 

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }  

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-35');

        ?> 


    <section class="choose-area wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".3s">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xl-5 col-lg-6 col-md-12">
                  <div class="tp-choose-content mb-50">
                     <div class="section-title mb-30">
                        
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                        <span class="tp-bline-stitle mb-15">
                            <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>

                        <?php
                        if ( !empty($settings['tp_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_title' ] )
                                );
                        endif;
                        ?>

                        <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                        <?php endif; ?>

                     </div>
                     <div class="tp-choose-online-list">
                        <ul>


                            <?php foreach ($settings['tp_list_list'] as $key => $item) : ?>
                                <?php if (!empty($item['tp_list_text' ])): ?>
                                <li>
                                    <div class="choose-online-item d-flex">

                                    <?php if (!empty($item['tp_about_icon']) || !empty($item['tp_about_selected_icon']['value'])) : ?>
                                    <div class="choose-online-icon">
                                        <?php tp_render_icon($item, 'tp_about_icon', 'tp_about_selected_icon'); ?>
                                    </div>
                                    <div class="choose-online-content">
                                    <?php echo tp_kses($item['tp_list_text' ]);?>
                                    </div>
                                    <?php else : ?>
                                    <div class="choose-online-content">
                                    <?php echo tp_kses($item['tp_list_text' ]);?>
                                    </div>
                                    <?php endif; ?>
                                    </div>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </ul>
                     </div>

                    <?php if (!empty($settings['tp_btn_text']) && !empty($settings['tp_btn_button_show'])) : ?>
                     <div class="tp-about-btn-3 mt-30">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                     </div>
                    <?php endif; ?> 

                  </div>
               </div>
               <div class="col-xl-7 col-lg-6 col-md-12">
                  
                <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                <div class="tp-choose-img tp-big-bg mb-50">
                    <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                </div>
                <?php endif; ?>
               </div>
            </div>
         </div>
    </section>


        <?php elseif ( $settings['tp_design_style']  == 'layout-5' ): 

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }  

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-25');

        ?> 


        <section class="tp-about-area wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".3s">
             <div class="container">
                <div class="row align-items-center">
                   <div class="col-xxl-7 col-xl-7 col-lg-6 col-md-12 col-12">
                      <div class="tp-about-class p-relative pb-50">
                        <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_section_animation_show'])) : ?>
                         <div class="tp-about-class-info">
                            <ul>

                                <?php if(!empty($settings['tp_at_title1'])) : ?>
                                <li>
                                    <?php echo tp_kses($settings['tp_at_title1']);?>
                                </li>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_at_title2'])) : ?>
                                <li>
                                    <?php echo tp_kses($settings['tp_at_title2']);?>
                                </li>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_at_title3'])) : ?>
                                <li>
                                    <?php echo tp_kses($settings['tp_at_title3']);?>
                                </li>
                                <?php endif; ?>

                            </ul>
                         </div>
                        <?php endif; ?>

                      </div>
                   </div>
                   <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-12 col-12">
                      <div class="tp-about-class-content mb-50 ml-75">
                         <div class="section-title mb-35">

                            <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                            <span class="tp-bline-stitle mb-15">
                                <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                            ?>

                            <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                            <?php endif; ?>

                         </div>
                         <div class="tp-about-list mb-65">
                            <ul>
                               <?php foreach ($settings['tp_list_list'] as $key => $item) : ?>
                                    <?php if (!empty($item['tp_list_text' ])): ?>
                                    <li>
                                        <?php if (!empty($item['tp_about_icon']) || !empty($item['tp_about_selected_icon']['value'])) : ?>
                                        <?php tp_render_icon($item, 'tp_about_icon', 'tp_about_selected_icon'); ?>
                                        <?php echo tp_kses($item['tp_list_text' ]);?>
                                        <?php else : ?>
                                        <?php echo tp_kses($item['tp_list_text' ]);?>
                                        <?php endif; ?>
                                    </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                         </div>

                        <?php if (!empty($settings['tp_btn_text']) && !empty($settings['tp_btn_button_show'])) : ?>
                         <div class="tp-about-btn-3">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                         </div>
                        <?php endif; ?> 

                      </div>
                   </div>
                </div>
             </div>
          </section>






        <?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }  

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-20');

        ?>


        <section class="choose-area bg-bottom wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".4s">
             <div class="container">
                <div class="row align-items-center">
                   <div class="col-xl-5 col-lg-6 col-md-12">
                      <div class="tp-choose-content mb-30">
                         <div class="section-title mb-25">
                            <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                            <span class="tp-sub-title-box mb-15">
                                <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                            ?>

                            <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                            <?php endif; ?>

                         </div>
                         <div class="tp-choose-list tp-choose-bg mb-60">
                            <ul>

                                <?php foreach ($settings['tp_list_list'] as $key => $item) : ?>
                                    <?php if (!empty($item['tp_list_text' ])): ?>
                                    <li>
                                        <?php if (!empty($item['tp_about_icon']) || !empty($item['tp_about_selected_icon']['value'])) : ?>
                                        <div class="tp-list-bg">
                                        <?php tp_render_icon($item, 'tp_about_icon', 'tp_about_selected_icon'); ?>
                                        <?php echo tp_kses($item['tp_list_text' ]);?>
                                        </div>
                                        <?php else : ?>
                                        <?php echo tp_kses($item['tp_list_text' ]);?>
                                        <?php endif; ?>
                                    </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </ul>
                         </div>

                        <?php if (!empty($settings['tp_btn_text']) && !empty($settings['tp_btn_button_show'])) : ?>
                         <div class="choose-btn">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                         </div>
                        <?php endif; ?> 

                      </div>
                   </div>
                   <div class="col-xl-7 col-lg-6 col-md-12">
                      <div class="tp-choose-img tp-choose-img-2 p-relative mb-30 mr-50 text-end">
                        <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_section_animation_show'])) : ?>
                         <div class="tpchoose-img-text tp-chose-shape d-none d-md-block">
                            <ul>

                                <?php if(!empty($settings['tp_at_title1'])) : ?>
                                <li>
                                    <span><?php echo tp_kses($settings['tp_at_title1']);?></span>
                                </li>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_at_title2'])) : ?>
                                <li>
                                    <span><?php echo tp_kses($settings['tp_at_title2']);?></span>
                                </li>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_at_title3'])) : ?>
                                <li>
                                    <span><?php echo tp_kses($settings['tp_at_title3']);?></span>
                                </li>
                                <?php endif; ?>

                            </ul>
                         </div>
                        <?php endif; ?>

                      </div>
                   </div>
                </div>
             </div>
        </section>



        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }  

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-20');

        ?>


        <section class="about--area wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".4s">
             <div class="container">
                <div class="row align-items-center">
                   <div class="col-xl-7 col-lg-6 col-md-12 col-12">
                      <div class="tp-ab-circle-img p-relative mb-60">
                        <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>
                         <div class="ab-circle-shape">                            <?php if ($settings['tp_image_2']['url'] || $settings['tp_image_2']['id']) : ?>
                            <img class="ab-circle-one" src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                            <?php endif; ?>
                            <img src="<?php echo get_template_directory_uri();?>/assets/img/about/shape-2-img.png" alt="about-shape" class="ab-circle-two">
                         </div>
                      </div>
                   </div>
                   <div class="col-xl-5 col-lg-6 col-md-12 col-12">
                      <div class="tp-abcircle-content ml-65 mb-60">
                         <div class="section-title mb-35">

                            <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                            <span class="tp-sub-title-box mb-15">
                                <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                            ?>

                            <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                            <?php endif; ?>

                         </div>
                         <div class="about-circle-list mb-40">
                            <ul>
                               <?php foreach ($settings['tp_list_list'] as $key => $item) : ?>
                                    <?php if (!empty($item['tp_list_text' ])): ?>
                                    <li>
                                        <?php if (!empty($item['tp_about_icon']) || !empty($item['tp_about_selected_icon']['value'])) : ?>
                                        <div class="tp-sv-icon">
                                        <?php tp_render_icon($item, 'tp_about_icon', 'tp_about_selected_icon'); ?>
                                        </div>
                                        <?php endif; ?>
                                        <?php echo tp_kses($item['tp_list_text' ]);?>
                                    </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                         </div>

                        <?php if (!empty($settings['tp_btn_text']) && !empty($settings['tp_btn_button_show'])) : ?>
                         <div class="tp-ab-circle-btn">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                         </div>
                        <?php endif; ?>

                      </div>
                   </div>
                </div>
             </div>
        </section>



		<?php elseif ( $settings['tp_design_style']  == 'layout-2' ): 

            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }  

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-20');

        ?>



        <section class="choose-area wow fadeInUp"  data-wow-duration=".8s" data-wow-delay=".4s">
             <div class="container">
                <div class="row align-items-center">
                   <div class="col-xl-7 col-lg-6 col-md-6">
                      <div class="tp-choose-img p-relative mb-30 ml-25">
                        <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_section_animation_show'])) : ?>
                         <div class="tpchoose-img-text d-none d-md-block">
                            <ul>

                                <?php if(!empty($settings['tp_at_title1'])) : ?>
                                <li>
                                    <span><?php echo tp_kses($settings['tp_at_title1']);?></span>
                                </li>
                                <?php endif; ?>

                                <?php if(!empty($settings['tp_at_title2'])) : ?>
                                <li>
                                    <span><?php echo tp_kses($settings['tp_at_title2']);?></span>
                                </li>
                                <?php endif; ?>

                            </ul>
                         </div>
                        <?php endif; ?>

                      </div>
                   </div>
                   <div class="col-xl-5 col-lg-6 col-md-6">
                      <div class="tp-choose-content mb-30">
                         <div class="section-title mb-25">
                            <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                            <span class="tp-sub-title mb-25">
                                <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>
                            <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                            ?>
                            <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                            <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                            <?php endif; ?>
                         </div>
                         <div class="tp-choose-list mb-35">
                            <ul>
                               <?php foreach ($settings['tp_list_list'] as $key => $item) : ?>
                                    <?php if (!empty($item['tp_list_text' ])): ?>
                                    <li>
                                        <?php if (!empty($item['tp_about_icon']) || !empty($item['tp_about_selected_icon']['value'])) : ?>
                                        <div class="tp-sv-icon">
                                        <?php tp_render_icon($item, 'tp_about_icon', 'tp_about_selected_icon'); ?>
                                        </div>
                                        <?php endif; ?>
                                        <?php echo tp_kses($item['tp_list_text' ]);?>
                                    </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                         </div>

                        <?php if (!empty($settings['tp_btn_text']) && !empty($settings['tp_btn_button_show'])) : ?>
                        <div class="choose-btn">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                         </div>
                        <?php endif; ?>

                      </div>
                   </div>
                </div>
             </div>
        </section>

            
		<?php else: 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }         

            if ( !empty($settings['tp_image_3']['url']) ) {
                $tp_image_3 = !empty($settings['tp_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_image_3']['id'], $settings['tp_image_size_size']) : $settings['tp_image_3']['url'];
                $tp_image_3_alt = get_post_meta($settings["tp_image_3"]["id"], "_wp_attachment_image_alt", true);
            }     

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
                }
            }

            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-15');
		?>	



        <section class="tp-about-area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".4s">
             <div class="container">
                <div class="row align-items-center">
                   <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-6">
                      <div class="tp-about-img p-relative pb-30 ml-10">
                        <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>
                         <div class="tp-about-line-shape d-none d-md-block">
                            <img src="<?php echo get_template_directory_uri();?>/assets/img/about/about-shape-03.png" alt="about-shape" class="tp-aline-one">
                            <img src="<?php echo get_template_directory_uri();?>/assets/img/about/about-shape-04.png" alt="about-shape" class="tp-aline-two">
                            <img src="<?php echo get_template_directory_uri();?>/assets/img/about/about-shape-05.png" alt="about-shape" class="tp-aline-three">
                         </div>
                         <div class="tp-about-shape  d-none d-xl-block">
                            <?php if ($settings['tp_image_2']['url'] || $settings['tp_image_2']['id']) : ?>
                            <img class="a-shape-one" src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                            <?php endif; ?>
                            <?php if ($settings['tp_image_3']['url'] || $settings['tp_image_3']['id']) : ?>
                            <img class="a-shape-two" src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_3_alt); ?>">
                            <?php endif; ?>
                         </div>
                      </div>
                   </div>
                   <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-6">
                      <div class="tp-about-content pb-30 ml-80">
                         <div class="section-title mb-55">

                            <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                            <span class="tp-sub-title mb-20">
                                <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                            if ( !empty($settings['tp_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['tp_title_tag'] ),
                                    $this->get_render_attribute_string( 'title_args' ),
                                    tp_kses( $settings['tp_title' ] )
                                    );
                            endif;
                            ?>

                        <?php if ( !empty($settings['tp_desctiption']) ) : ?>
                        <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                        <?php endif; ?>

                         </div>



                        <?php if (!empty($settings['tp_btn_text']) && !empty($settings['tp_btn_button_show'])) : ?>
                         <div class="about-btn">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                         </div>
                        <?php endif; ?>

                      </div>
                   </div>
                </div>
             </div>
        </section>


        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_About() );