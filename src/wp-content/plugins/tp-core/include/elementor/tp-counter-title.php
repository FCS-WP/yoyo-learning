<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
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
class TP_Counter_Title extends Widget_Base {

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
		return 'tp-counter-title';
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
		return __( 'TP :: Counter Title', 'tpcore' );
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
            'tp_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('820', 'tpcore'),
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
                'default' => esc_html__('Subtitle Here', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        
        $this->end_controls_section();


        // style tab here
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'ascore' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'ascore' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'ascore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .tp-section-title',
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'ascore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Subtitle    
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'ascore' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Color', 'ascore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-section-subtitle' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .right::before, .pre::before, .pre::after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'subtitle_bg_color',
            [
                'label' => __( 'Background Color', 'ascore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-section-subtitle' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .tp-section-subtitle',
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'ascore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-section-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Description    
        $this->add_control(
            '_heading_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'ascore' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'ascore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-section-box p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .tp-section-box p',
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'ascore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-section-box p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
        $title = $settings['tp_title'];
        $tp_sub_title = $settings['tp_sub_title'];

        if ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-section-title');
        ?>

        <div class="row text-center">
           <div class="col-12">
              <div class="tp-section-box tp-section-box-2 p-relative">
                 <?php if(!empty($tp_sub_title)) : ?>
                 <span class="tp-section-subtitle d-inline-block pre mb-10"><?php echo tp_kses($tp_sub_title);?></span>
                 <?php endif; ?>
                 <?php
                    if ( !empty($title) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $title )
                            );
                    endif;
                 ?>
                 <?php if ( !empty($tp_description) ) : ?>
                    <p><?php echo tp_kses( $tp_description ); ?></p>
                 <?php endif; ?>
              </div>
           </div>
        </div>

		<?php elseif ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-15');
        ?>

            <div class="tp-section-box tp-section-box-2  p-relative">
                <?php if(!empty($tp_sub_title)) : ?>
                <span class="tp-section-subtitle right d-inline-block"><?php echo tp_kses($tp_sub_title);?></span>
                <?php endif; ?>
                <?php
                    if ( !empty($title) ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $title )
                            );
                    endif;
                ?>
                <?php if ( !empty($tp_description) ) : ?>
                    <p><?php echo tp_kses( $tp_description ); ?></p>
                <?php endif; ?>
            </div>

        

		<?php else: ?>	


        <div class="footer-counter-content d-md-flex align-items-center">
            <?php if(!empty($title)) : ?>
            <h2><?php echo tp_kses($title);?></h2>
            <?php endif; ?>
          <div class="counter-text">
            <?php if(!empty($tp_sub_title)) : ?>
            <h3><?php echo tp_kses($tp_sub_title);?></h3>
            <?php endif; ?>
          </div>
        </div>

        <?php endif; 
	}
}

$widgets_manager->register( new TP_Counter_Title() );