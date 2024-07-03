<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Btn extends Widget_Base {

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
		return 'tp-btn';
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
		return __( 'TP :: Button', 'tpcore' );
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
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                ],
                'default' => 'layout-1',
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
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
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
                ]
            ]
        );

        $this->add_control(
            'tp_btn_arrow_show',
            [
                'label' => esc_html__( 'Show Prefix', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_btn_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fal fa-long-arrow-right',
                    'condition' => [
                        'tp_btn_arrow_show' => 'yes'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_btn_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fal fa-long-arrow-right',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_btn_arrow_show' => 'yes'
                    ]
                ]
            );
        }

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
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        
        $this->end_controls_section();

		// style tab here
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Button Style', 'tpcore' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );



        // Button
        $this->start_controls_tabs(
            'btn_style'
        );

        $this->start_controls_tab(
            'btn_normal_style',
            [
                'label' => esc_html__( 'Normal', 'tpcore' ),
            ]
        );



        $this->add_control(
            'btn_text_color',
            [
                'label' => __( 'Text Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-btn ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => __( 'Background Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-btn ' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_text_typo',
                'selector' => '{{WRAPPER}} .tp-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'tpcore' ),
                'selector' => '{{WRAPPER}} .tp-btn',
            ]
        );

        $this->add_responsive_control(
            'btn_bradius',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__( 'Border_radius', 'tpcore' ),
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_bshadow',
                'label' => esc_html__( 'Box Shadow', 'tpcore' ),
                'selector' => '{{WRAPPER}} .tp-btn',
            ]
        );

        $this->add_responsive_control(
            'btn_padding',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__( 'Padding', 'tpcore' ),
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_hover_style',
            [
                'label' => esc_html__( 'Hover', 'tpcore' ),
            ]
        );


        $this->add_control(
            'btn_thover_color',
            [
                'label' => __( 'Text Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-btn:hover ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_bg_color',
            [
                'label' => __( 'Background Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-btn:hover ' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border_hover',
                'label' => esc_html__( 'Border', 'tpcore' ),
                'selector' => '{{WRAPPER}} .tp-btn:hover',
            ]
        );


        $this->add_responsive_control(
            'btn_bradius_hover',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__( 'Border_radius', 'tpcore' ),
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_bshadow_hover',
                'label' => esc_html__( 'Box Shadow', 'tpcore' ),
                'selector' => '{{WRAPPER}} .tp-btn:hover',
            ]
        );

        $this->add_responsive_control(
            'btn_hover_padding',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__( 'Padding', 'tpcore' ),
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-btn:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->end_controls_tab();

        $this->end_controls_tabs();
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

		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-btn-border');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                    $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-btn-border');
                }
            }
        ?>

        <?php if (!empty($settings['tp_btn_text'])) : ?>
        <div class="tp-custom-btn">
            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                <?php echo $settings['tp_btn_text']; ?>
            </a>
        </div>
        <?php endif; ?>

		<?php else: 
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
		?>	

        <?php if (!empty($settings['tp_btn_text'])) : ?>
        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?><?php if(!empty($settings['tp_btn_arrow_show'])) : ?> <?php if (!empty($settings['tp_btn_icon']) || !empty($settings['tp_btn_selected_icon']['value'])) : ?>
                    <span><?php tp_render_icon($settings, 'tp_btn_icon', 'tp_btn_selected_icon'); ?></span>
                <?php endif; ?><?php endif; ?></a>
        <?php endif; ?>


        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Btn() );