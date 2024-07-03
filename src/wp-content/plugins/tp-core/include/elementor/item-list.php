<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_List extends Widget_Base {

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
		return 'tp-item-list';
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
		return __( 'TP :: Item List', 'tpcore' );
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
                ],
                'default' => 'layout-1',
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
            ]
        );

        $repeater = new \Elementor\Repeater();

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

        



        // style tab here
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Content Style', 'tp-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // title
        $this->add_control(
            '_content_list_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'tp-core' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'list_title_color',
            [
                'label' => __( 'Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-about-fea-item ul li, .tp-about-fea-item ul li i, .tp-sv-feature-list ul li, .tp-sv-feature-list ul li i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tp-about-fea-item ul li i ' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_title_typo',
                'selector' => '{{WRAPPER}} .tp-about-fea-item ul li, .tp-sv-feature-list ul li ',
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

		if ( $settings['tp_design_style']  == 'layout-2' ) : ?>


			<div class="tp-sv-feature-list mb-40">
			   <ul>

			      	<?php foreach ($settings['tp_list_list'] as $key => $item) : ?>
                        <?php if (!empty($item['tp_list_text' ])): ?>
                            <li><i class="fal fa-check"></i> <?php echo esc_html($item['tp_list_text' ]);?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>

			   </ul>
			</div>

        <?php else: ?>	 


            <div class="tp-about-fea-item">
                <ul>
                    <?php foreach ($settings['tp_list_list'] as $key => $item) : ?>
                        <?php if (!empty($item['tp_list_text' ])): ?>
                            <li><i class="fal fa-check"></i> <?php echo esc_html($item['tp_list_text' ]);?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php endif; 
	}
}

$widgets_manager->register( new TP_List () );




