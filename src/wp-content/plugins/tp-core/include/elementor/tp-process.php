<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
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
class TP_Process extends Widget_Base {

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
		return 'tp-process';
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
		return __( 'TP :: Process', 'tpcore' );
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

        // Process group
        $this->start_controls_section(
            'tp_process',
            [
                'label' => esc_html__('Process List', 'tpcore'),
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
            'tp_process_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_process_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_process_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_process_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fi fi-rr-paper-plane',
                    'condition' => [
                        'tp_process_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_process_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fi fi-rr-paper-plane',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_process_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'tp_process_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Process Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_process_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        ); 

        $this->add_control(
            'tp_process_list',
            [
                'label' => esc_html__('Process - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_process_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_process_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_process_title' => esc_html__('Develop', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_process_title }}}',
            ]
        );
        
        $this->end_controls_section();

        // tp_process_columns_section
        $this->start_controls_section(
            'tp_process_columns_section',
            [
                'label' => esc_html__('Process - Columns', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_col_for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'tpcore' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1200px', 'tpcore' ),
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
            'tp_col_for_laptop',
            [
                'label' => esc_html__( 'Columns for Laptop', 'tpcore' ),
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
            'tp_col_for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'tpcore' ),
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
                'default' => '6',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tp_col_for_mobile',
            [
                'label' => esc_html__( 'Columns for Mobile', 'tpcore' ),
                'description' => esc_html__( 'Screen width less than 768px', 'tpcore' ),
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

        // TAB_STYLE
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
        
            if ( $settings['tp_design_style']  == 'layout-3' ):?>



            <section class="location-area wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".2s">
             <div class="container">
                <div class="row">

                    <?php foreach ($settings['tp_process_list'] as $key => $item) : ?>
                   <div class="col-xl-4 col-md-6">
                      <div class="location-item text-center mb-30 wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".6s">

                        <?php if($item['tp_process_icon_type'] !== 'image') : ?>
                            <div class="location-icon mb-25">
                                <?php tp_render_icon($item, 'tp_process_icon', 'tp_process_selected_icon'); ?>
                            </div>  
                        <?php else : ?>
                            <div class="location-icon mb-25">
                                <?php if (!empty($item['tp_process_image']['url'])): ?>
                                <img src="<?php echo $item['tp_process_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_process_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>  
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($item['tp_process_title' ])): ?>
                         <div class="location-content">
                            <h5 class="location-title"><?php echo tp_kses($item['tp_process_title' ]); ?></h5>
                         </div>
                        <?php endif; ?>

                        <?php if (!empty($item['tp_process_description' ])): ?>
                        <p class="mt-10"><?php echo tp_kses($item['tp_process_description']); ?></p>
                        <?php endif; ?>

                      </div>
                   </div>
                    <?php endforeach; ?>

                </div>
             </div>
            </section>
        
            <?php elseif ( $settings['tp_design_style']  == 'layout-2' ): 

            $this->add_render_attribute('title_args', 'class', 'tp-section-title');

            ?>



            <div class="tp-feature-cn">
               <div class="row">

                <?php foreach ($settings['tp_process_list'] as $key => $item) : ?>
                  <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']);?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']);?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']);?> col-sm-<?php echo esc_attr($settings['tp_col_for_mobile']);?>">
                     <div class="tpfea tp-feature-item text-center mb-30 wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".4s">
                    <?php if($item['tp_process_icon_type'] !== 'image') : ?>
                        <div class="tpfea__icon mb-25">
                            <?php tp_render_icon($item, 'tp_process_icon', 'tp_process_selected_icon'); ?>
                        </div>  
                    <?php else : ?>
                        <div class="tpfea__icon mb-25">
                            <?php if (!empty($item['tp_process_image']['url'])): ?>
                            <img src="<?php echo $item['tp_process_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_process_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>  
                        </div>
                    <?php endif; ?>
                        
                    <?php if (!empty($item['tp_process_title' ])): ?>
                    <div class="tpfea__text">
                       <h5 class="tpfea__title mb-5"><?php echo tp_kses($item['tp_process_title' ]); ?></h5>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($item['tp_process_description' ])): ?>
                    <p><?php echo tp_kses($item['tp_process_description']); ?></p>
                    <?php endif; ?>

                     </div>
                  </div>
                <?php endforeach; ?>

               </div>
            </div>



		<?php else: ?>	



        <div class="tp-feature-cn">
           <div class="row">

            <?php foreach ($settings['tp_process_list'] as $key => $item) : ?>
              <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']);?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']);?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']);?> col-sm-<?php echo esc_attr($settings['tp_col_for_mobile']);?>">
                 <div class="tpfea mb-30 wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".3s">

                    <?php if($item['tp_process_icon_type'] !== 'image') : ?>
                        <div class="tpfea__icon mb-25">
                            <?php tp_render_icon($item, 'tp_process_icon', 'tp_process_selected_icon'); ?>
                        </div>  
                    <?php else : ?>
                        <div class="tpfea__icon mb-25">
                            <?php if (!empty($item['tp_process_image']['url'])): ?>
                            <img src="<?php echo $item['tp_process_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_process_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>  
                        </div>
                    <?php endif; ?>

                    <div class="tpfea__text">
                        <?php if (!empty($item['tp_process_title' ])): ?>
                        <h5 class="tpfea__title mb-20">
                           <?php echo tp_kses($item['tp_process_title' ]); ?>
                        </h5>
                        <?php endif; ?>
                        <?php if (!empty($item['tp_process_description' ])): ?>
                        <p><?php echo tp_kses($item['tp_process_description']); ?></p>
                        <?php endif; ?>
                    </div>
                 </div>
              </div>
            <?php endforeach; ?>

           </div>
        </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Process() );