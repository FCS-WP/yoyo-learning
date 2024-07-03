<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Main_Slider extends Widget_Base {

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
		return 'tp-slider';
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
		return __( 'TP :: Slider', 'tpcore' );
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

		
		$this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Main Slider', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

	        $repeater->add_control(
	            'repeater_condition',
	            [
	                'label' => __( 'Field condition', 'tpcore' ),
	                'type' => Controls_Manager::SELECT,
	                'options' => [
	                    'style_1' => __( 'Style 1', 'tpcore' ),
	                    'style_2' => __( 'Style 2', 'tpcore' ),
	                ],
	                'default' => 'style_1',
	                'frontend_available' => true,
	                'style_transfer' => true,
	            ]
	        );

	        $repeater->add_control(
	            'tp_slider_image',
	            [
	                'label' => esc_html__('Upload Image', 'tpcore'),
	                'type' => Controls_Manager::MEDIA,
	                'default' => [
	                    'url' => Utils::get_placeholder_image_src(),
	                ]
	            ]
	        );

            $repeater->add_control(
                'tp_slider_sub_title',
                [
                    'label' => esc_html__('Sub Title', 'tpcore'),
                    'description' => tp_get_allowed_html_desc( 'basic' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('Solid solution for your home & office', 'tpcore'),
                    'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                    'label_block' => true,
                ]
            );
            $repeater->add_control(
                'tp_slider_title',
                [
                    'label' => esc_html__('Title', 'tpcore'),
                    'description' => tp_get_allowed_html_desc( 'intermediate' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('Grow business.', 'tpcore'),
                    'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                    'label_block' => true,
                ]
            );
            $repeater->add_control(
                'tp_slider_title_tag',
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

            $repeater->add_control(
                'tp_slider_description',
                [
                    'label' => esc_html__('Description', 'tpcore'),
                    'description' => tp_get_allowed_html_desc( 'intermediate' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'tpcore'),
                    'placeholder' => esc_html__('Type section description here', 'tpcore'),
                ]
            );

			$repeater->add_control(
	            'tp_btn_link_switcher',
	            [
	                'label' => esc_html__( 'Add Button link', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SWITCHER,
	                'label_on' => esc_html__( 'Yes', 'tpcore' ),
	                'label_off' => esc_html__( 'No', 'tpcore' ),
	                'return_value' => 'yes',
	                'default' => 'yes',
	                'separator' => 'before',
	            ]
	        );

	        // button 1
	        $repeater->add_control(
	            '_heading_button',
	            [
	                'type' => Controls_Manager::HEADING,
	                'label' => __( 'Button', 'tpcore' ),
	                'separator' => 'before',
	                'condition' => [
	                    'tp_btn_link_switcher' => 'yes'
	                ],
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_btn_text',
	            [
	                'label' => esc_html__('Button Text', 'tpcore'),
	                'type' => Controls_Manager::TEXT,
	                'default' => esc_html__('Button Text', 'tpcore'),
	                'title' => esc_html__('Enter button text', 'tpcore'),
	                'label_block' => true,
	                'condition' => [
	                    'tp_btn_link_switcher' => 'yes'
	                ],
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_link_type',
	            [
	                'label' => esc_html__( 'Button Link Type', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SELECT,
	                'options' => [
	                    '1' => 'Custom Link',
	                    '2' => 'Internal Page',
	                ],
	                'default' => '1',
	                'condition' => [
	                    'tp_btn_link_switcher' => 'yes'
	                ]
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_link',
	            [
	                'label' => esc_html__( 'Button Link link', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::URL,
	                'dynamic' => [
	                    'active' => true,
	                ],
	                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
	                'show_external' => true,
	                'default' => [
	                    'url' => '#',
	                    'is_external' => false,
	                    'nofollow' => false,
	                ],
	                'condition' => [
	                    'tp_btn_link_type' => '1',
	                    'tp_btn_link_switcher' => 'yes',
	                ]
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_page_link',
	            [
	                'label' => esc_html__( 'Select Button Link Page', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SELECT2,
	                'label_block' => true,
	                'options' => tp_get_all_pages(),
	                'condition' => [
	                    'tp_btn_link_type' => '2',
	                    'tp_btn_link_switcher' => 'yes',
	                ]
	            ]
	        );


	        // button 2
	        $repeater->add_control(
	            '_heading_button2',
	            [
	                'type' => Controls_Manager::HEADING,
	                'label' => __( 'Button 2', 'tpcore' ),
	                'separator' => 'before',
	                'condition' => ['repeater_condition' => 'style_2', 'tp_btn_link_switcher' => 'yes']
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_btn_text2',
	            [
	                'label' => esc_html__('Button Text2', 'tpcore'),
	                'type' => Controls_Manager::TEXT,
	                'default' => esc_html__('Button Text2', 'tpcore'),
	                'title' => esc_html__('Enter button 2 text', 'tpcore'),
	                'label_block' => true,
	                'condition' => [
	                    'tp_btn_link_switcher' => 'yes',
	                ],
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_link_type2',
	            [
	                'label' => esc_html__( 'Button Link Type 2', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SELECT,
	                'options' => [
	                    '1' => 'Custom Link',
	                    '2' => 'Internal Page',
	                ],
	                'default' => '1',
	                'condition' => [
	                    'tp_btn_link_switcher' => 'yes',
	                ]
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_link2',
	            [
	                'label' => esc_html__( 'Button Link link 2', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::URL,
	                'dynamic' => [
	                    'active' => true,
	                ],
	                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
	                'show_external' => true,
	                'default' => [
	                    'url' => '#',
	                    'is_external' => false,
	                    'nofollow' => false,
	                ],
	                'condition' => [
	                    'tp_btn_link_type2' => '1',
	                    'tp_btn_link_switcher' => 'yes',
	                ]
	            ]
	        );
	        $repeater->add_control(
	            'tp_btn_page_link2',
	            [
	                'label' => esc_html__( 'Select Button Link Page 2', 'tpcore' ),
	                'type' => \Elementor\Controls_Manager::SELECT2,
	                'label_block' => true,
	                'options' => tp_get_all_pages(),
	                'condition' => [
	                    'tp_btn_link_type2' => '2',
	                    'tp_btn_link_switcher' => 'yes',
	                ]
	            ]
	        );


        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Grow business.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Development.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Marketing.', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_slider_title }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );
        $this->end_controls_section();


        // tp_section_badge
        $this->start_controls_section(
            'tp_section_badge',
            [
                'label' => esc_html__('Badge', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_section_badge_show',
            [
                'label' => esc_html__( 'Show Badge', 'tpcore' ),
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
                'default' => esc_html__('Badge Text', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
                'condition' => ['tp_section_badge_show' => 'yes']
            ]
        );  

        $this->add_control(
            'tp_at_title2',
            [
                'label' => esc_html__('Text Two', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Badge Text 2', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
                'condition' => ['tp_section_badge_show' => 'yes']
            ]
        );  

        $this->add_control(
            'tp_at_title3',
            [
                'label' => esc_html__('Text Three', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Badge Text 3', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_section_badge_show' => 'yes',
                ]
            ]
        );  
        $this->end_controls_section();


        // Style
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
		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
			$this->add_render_attribute('title_args', 'class', 'tp-slider-title');
		?>

         <div class="tp-slider-area">
	      <div class="slider-active slider-arrow-style">

	      	<?php foreach ($settings['slider_list'] as $item) :
    			$this->add_render_attribute('title_args', 'class', 'slider__title');
				$this->add_render_attribute('title_args', 'data-badge', 'fadeInUp');
				$this->add_render_attribute('title_args', 'data-delay', '.6s');

					if ( !empty($item['tp_slider_image']['url']) ) {
                    $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                    $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                }
				// btn Link
                if ('2' == $item['tp_btn_link_type']) {
                    $link = get_permalink($item['tp_btn_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                    $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                }
				// btn2 Link
                if ('2' == $item['tp_btn_link_type2']) {
                    $link2 = get_permalink($item['tp_btn_page_link2']);
                    $target2 = '_self';
                    $rel2 = 'nofollow';
                } else {
                    $link2 = !empty($item['tp_btn_link2']['url']) ? $item['tp_btn_link2']['url'] : '';
                    $target2 = !empty($item['tp_btn_link2']['is_external']) ? '_blank' : '';
                    $rel2 = !empty($item['tp_btn_link2']['nofollow']) ? 'nofollow' : '';
                }

            ?>
	         <div class="tp-slider-item tp-slider-height tp-slider-overlay-2 d-flex align-items-center"
	            style="background: url(<?php echo esc_url($tp_slider_image_url); ?>);">
	            <div class="container">
	               <div class="row justify-content-xxl-end">
	                  <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-12">
	                     <div class="tp-slider-content tp-slider-content-two ">

	                        <?php if (!empty($item['tp_slider_sub_title'])) : ?>
                             <span class="tp-slider-sub-title p-0"><?php echo tp_kses( $item['tp_slider_sub_title'] ); ?></span>
                         	<?php endif; ?>

                         	<?php
                            if ($item['tp_slider_title_tag']) :
                                printf('<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape($item['tp_slider_title_tag']),
                                    $this->get_render_attribute_string('title_args'),
                                    tp_kses($item['tp_slider_title'])
                                );
                            endif;
	                        ?>

	                        <?php if (!empty($item['tp_slider_description'])) : ?>
                             	<p><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                           	<?php endif; ?>


                         	<?php if (!empty($link) && !empty($item['tp_btn_link_switcher'])) : ?>
	                        <div class="tp-slide-btn-box mt-45">

	                        	<?php if(!empty($item['tp_btn_btn_text'])) : ?>
	                           	<div class="slider-btn mr-30">
	                              	<a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="tp-btn-white"><?php echo tp_kses($item['tp_btn_btn_text']); ?></a>
	                           	</div>
                         		<?php endif; ?>

                         		<?php if(!empty($item['tp_btn_btn_text2'])) : ?>
	                           	<div class="slider-btn">
	                              	<a target="<?php echo esc_attr($target2); ?>" rel="<?php echo esc_attr($rel2); ?>" href="<?php echo esc_url($link2); ?>" class="tp-btn"><?php echo tp_kses($item['tp_btn_btn_text2']); ?></a>
	                           	</div>
                         		<?php endif; ?>

	                        </div>
	                        <?php endif; ?>

	                     </div>
	                  </div>
	               </div>
	            </div>
	         </div>
	         <?php endforeach; ?>

	      </div>
	   	</div>

		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'tp-slider-title');
		?>




		<section class="slider-area">
	         <div class="slider-active slider-arrow">

	         	<?php foreach ($settings['slider_list'] as $item) :
    			$this->add_render_attribute('title_args', 'class', 'slider-title mb-65');
				$this->add_render_attribute('title_args', 'data-badge', 'fadeInUp');
				$this->add_render_attribute('title_args', 'data-delay', '.6s');

					if ( !empty($item['tp_slider_image']['url']) ) {
                    $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                    $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                }
				// btn Link
                if ('2' == $item['tp_btn_link_type']) {
                    $link = get_permalink($item['tp_btn_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                    $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                }
				// btn2 Link
                if ('2' == $item['tp_btn_link_type2']) {
                    $link2 = get_permalink($item['tp_btn_page_link2']);
                    $target2 = '_self';
                    $rel2 = 'nofollow';
                } else {
                    $link2 = !empty($item['tp_btn_link2']['url']) ? $item['tp_btn_link2']['url'] : '';
                    $target2 = !empty($item['tp_btn_link2']['is_external']) ? '_blank' : '';
                    $rel2 = !empty($item['tp_btn_link2']['nofollow']) ? 'nofollow' : '';
                }

            	?>
	            <div class="slider-item slider-bg-height d-flex align-items-center p-relative" style="background: url(<?php echo esc_url($tp_slider_image_url); ?>);">
	               <div class="container">
	                  <div class="row">
	                     <div class="col-xl-7 col-lg-7 col-12">
	                        <div class="slider-content">
	                           
	                           	<?php if (!empty($item['tp_slider_sub_title'])) : ?>
	                             <span class="slider-text mb-15"><?php echo tp_kses( $item['tp_slider_sub_title'] ); ?></span>
	                         	<?php endif; ?>

	                           	<?php
	                            if ($item['tp_slider_title_tag']) :
	                                printf('<%1$s %2$s>%3$s</%1$s>',
	                                    tag_escape($item['tp_slider_title_tag']),
	                                    $this->get_render_attribute_string('title_args'),
	                                    tp_kses($item['tp_slider_title'])
	                                );
	                            endif;
		                        ?>

		                        <?php if (!empty($item['tp_slider_description'])) : ?>
                             		<p><?php echo tp_kses( $item['tp_slider_description'] ); ?></p>
                           		<?php endif; ?>

	                           	<?php if (!empty($link) && !empty($item['tp_btn_link_switcher'])) : ?>
		                        <div class="slider-btn">

		                        	<?php if(!empty($item['tp_btn_btn_text'])) : ?>
		                           	<a class="tp-btn mr-5" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_btn_btn_text']); ?></a>
	                         		<?php endif; ?>

	                         		<?php if(!empty($item['tp_btn_btn_text2'])) : ?>
		                           	<a class="tp-s-border-btn" target="<?php echo esc_attr($target2); ?>" rel="<?php echo esc_attr($rel2); ?>" href="<?php echo esc_url($link2); ?>"><?php echo tp_kses($item['tp_btn_btn_text2']); ?></a>
	                         		<?php endif; ?>

		                        </div>
		                        <?php endif; ?>

	                        </div>
	                     </div>
	                     <div class="col-xl-5 col-lg-5 d-none d-lg-block">


	                     	<?php if(!empty($settings['tp_section_badge_show'])) : ?>
	                         <div class="slider-info-list">
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
	               </div>
	            </div>
	        	<?php endforeach; ?>

	         </div>
	  	</section>
		

         <?php endif;
	}
}

$widgets_manager->register( new TP_Main_Slider() );