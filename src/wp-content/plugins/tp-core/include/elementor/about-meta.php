<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_About_meta extends Widget_Base {

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
		return 'tp-about-meta';
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
		return __( 'TP :: About Meta', 'tpcore' );
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
            'about_meta_image',
            [
                'label' => esc_html__( 'Choose Image', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'about_meta_name',
            [
                'label' => esc_html__('Name', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Alonso D. Dowson', 'tpcore'),
                'placeholder' => esc_html__('Type Name', 'tpcore'),
                'label_block' => true,
            ]
        );       

        $this->add_control(
            'about_meta_position',
            [
                'label' => esc_html__('Position', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Head Of Idea', 'tpcore'),
                'placeholder' => esc_html__('Type Meta Positions', 'tpcore'),
                'label_block' => true,
            ]
        );     

        $this->add_control(
            'about_meta_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('In 2014 only 3 countries host 50% of the globally installed bandwidth potential.', 'tpcore'),
                'placeholder' => esc_html__('Type Meta Description', 'tpcore'),
                'condition' => [
                        'tp_design_style' => 'layout-1'
                    ]
            ]
        );

        $this->add_responsive_control(
            'about_meta_txt_align',
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
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .tp-ab-meta-text, .ab-meta-content, .about-signature' => 'text-align: {{VALUE}};'
                ]
            ]
        );


        $this->end_controls_section();

        // style tab here
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'tocore' ),
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
                'condition' => [
                        'tp_design_style' => 'layout-1'
                    ]
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
                'condition' => [
                        'tp_design_style' => 'layout-1'
                    ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'am_description_typ',
                'selector' => '{{WRAPPER}} .tp-ab-meta-text h4',
                'condition' => [
                        'tp_design_style' => 'layout-1'
                    ]
            ]
        );

        $this->add_responsive_control(
            'am_description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'tocore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-ab-meta-text h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                        'tp_design_style' => 'layout-1'
                    ]
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
        $about_meta_image = $settings['about_meta_image']['url'];
        $about_meta_name = $settings['about_meta_name'];
        $about_meta_position = $settings['about_meta_position'];
        $about_meta_description = $settings['about_meta_description'];

		?>

        <?php if( $tp_design_style  == 'layout-3' ) : ?>

            <div class="about-signature mb-10">
                <?php if(!empty($about_meta_image)) : ?>
                <img src="<?php echo esc_url($about_meta_image);?>" alt="">
                <?php endif; ?>
                <?php if( !empty($about_meta_name) || !empty($about_meta_position) ) : ?>
                <h6><?php echo tp_kses($about_meta_name);?><?php echo esc_html__(',', 'tpcore');?> <span><?php echo tp_kses($about_meta_position);?></span></h6>
                <?php endif; ?>
            </div>

		<?php elseif ( $tp_design_style  == 'layout-2' ):  ?>

            <div class="about-signature d-flex align-items-center mb-10">
                <?php if(!empty($about_meta_image)) : ?>
                <img src="<?php echo esc_url($about_meta_image);?>" alt="">
                <?php endif; ?>
                <div class="ab-meta-content ml-15">
                    <?php if(!empty($about_meta_name)) : ?>
                    <h6 class="m-0 ab-meta-title"><?php echo tp_kses($about_meta_name);?></h6>
                    <?php endif; ?>
                    <?php if(!empty($about_meta_position)) : ?>
                    <span class="ab-meta-subtitle"><?php echo tp_kses($about_meta_position);?></span>
                    <?php endif; ?>
                </div>
            </div>

            
		<?php else: ?>	

            <div class="tp-ab-meta">
                <div class="about-meta-img d-flex">
                    <?php if(!empty($about_meta_image)) : ?>
                    <div class="ab-meta-img d-none d-md-block">
                       <img src="<?php echo esc_url($about_meta_image);?>" alt="">
                    </div>
                    <?php endif; ?>
                    <div class="tp-ab-meta-text pl-30">
                        <?php if(!empty($about_meta_description)) : ?>
                        <h4><?php echo tp_kses($about_meta_description);?></h4>
                        <?php endif; ?>
                       <?php if(!empty($about_meta_name)) : ?><span><b><?php echo tp_kses($about_meta_name);?></b><?php endif; ?> <?php if(!empty($about_meta_position)) : ?><i><?php echo esc_html__('-', 'tpcore');?><?php echo tp_kses($about_meta_position);?></i></span><?php endif; ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_About_meta() );