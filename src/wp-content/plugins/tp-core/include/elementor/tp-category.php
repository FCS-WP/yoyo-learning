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
class TP_Category extends Widget_Base {

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
		return 'tp-category';
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
		return __( 'TP :: Category', 'tpcore' );
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

        // Category group
        $this->start_controls_section(
            'tp_category',
            [
                'label' => esc_html__('Category List', 'tpcore'),
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
            'tp_category_icon_type',
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
            'tp_category_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_category_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_category_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fi fi-rr-star',
                    'condition' => [
                        'tp_category_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_category_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fi fi-rr-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_category_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'tp_category_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Category Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_category_subtitle', [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sub Title', 'tpcore'),
                'label_block' => true,
                'condition' => ['repeater_condition' => 'style_2']
            ]
        );
        $repeater->add_control(
            'tp_category_link',
            [
                'label' => esc_html__('Link', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        ); 

        $this->add_control(
            'tp_category_list',
            [
                'label' => esc_html__('Category - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_category_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_category_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_category_title' => esc_html__('Develop', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_category_title }}}',
            ]
        );
        
        $this->end_controls_section();

        // tp_category_columns_section
        $this->start_controls_section(
            'tp_category_columns_section',
            [
                'label' => esc_html__('Category - Columns', 'tpcore'),
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
                'default' => '3',
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
        
            if ( $settings['tp_design_style']  == 'layout-3' ): 

            $this->add_render_attribute('title_args', 'class', 'tp-category-title tp-r-cat-title');

            ?>


            <div class="row">

                <?php foreach ($settings['tp_category_list'] as $key => $item) : ?>
                <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']);?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']);?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']);?> col-sm-<?php echo esc_attr($settings['tp_col_for_mobile']);?>">
                  <div class="tp-cat-item mb-40 d-flex align-items-center">
                     <div class="tp-category-icon tp-cat-color  mr-15">
                        

                        <?php if($item['tp_category_icon_type'] !== 'image') : ?>
                            <span class="cat-design">
                                <?php tp_render_icon($item, 'tp_category_icon', 'tp_category_selected_icon'); ?>
                            </span>  
                        <?php else : ?>
                            <span class="cat-design">
                               <?php if (!empty($item['tp_category_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_category_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_category_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>  
                            </span>
                        <?php endif; ?> 

                     </div>
                     <div class="tp-cat-content">

                        <?php if (!empty($item['tp_category_title' ]) && !empty($item['tp_category_link'])): ?>
                        <h4 class="tp-category-title tp-title-small">
                            <a href="<?php echo esc_url($item['tp_category_link']);?>">
                                <?php echo tp_kses($item['tp_category_title' ]); ?>
                            </a>
                        </h4>
                        <?php elseif(!empty($item['tp_category_title' ])) : ?>
                        <h4 class="tp-category-title tp-title-small">
                            <?php echo tp_kses($item['tp_category_title' ]); ?>
                        </h4>
                        <?php endif; ?> 

                        <?php if(!empty($item['tp_category_subtitle'])) : ?>
                         <p><?php echo tp_kses($item['tp_category_subtitle']);?></p>
                        <?php endif; ?>

                     </div>
                  </div>
                </div>
                <?php endforeach; ?>

            </div>


            <?php elseif ( $settings['tp_design_style']  == 'layout-2' ): 

            $this->add_render_attribute('title_args', 'class', 'tp-category-title tp-r-cat-title');

            ?>


            <div class="row">

            <?php foreach ($settings['tp_category_list'] as $key => $item) : ?>
                <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']);?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']);?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']);?> col-sm-<?php echo esc_attr($settings['tp_col_for_mobile']);?>">
                  <div class="tp-cat-item tp-rec-item mb-35">

                    <?php if($item['tp_category_icon_type'] !== 'image') : ?>
                        <div class="tp-category-icon mb-30">
                            <?php tp_render_icon($item, 'tp_category_icon', 'tp_category_selected_icon'); ?>
                        </div>  
                    <?php else : ?>
                        <div class="tp-category-icon mb-30">
                            <?php if (!empty($item['tp_category_image']['url'])): ?>
                            <img src="<?php echo $item['tp_category_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_category_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>  
                        </div>
                    <?php endif; ?> 
                    <?php if (!empty($item['tp_category_title' ]) && !empty($item['tp_category_link'])): ?>
                    <h4 class="tp-category-title tp-r-cat-title">
                        <a href="<?php echo esc_url($item['tp_category_link']);?>">
                            <?php echo tp_kses($item['tp_category_title' ]); ?>
                        </a>
                    </h4>
                    <?php elseif(!empty($item['tp_category_title' ])) : ?>
                    <h4 class="tp-category-title tp-r-cat-title">
                        <?php echo tp_kses($item['tp_category_title' ]); ?>
                    </h4>
                    <?php endif; ?> 
                    <?php if(!empty($item['tp_category_subtitle'])) : ?>
                     <p><?php echo tp_kses($item['tp_category_subtitle']);?></p>
                    <?php endif; ?>
                  </div>
               </div>
            <?php endforeach; ?>

            </div>


		<?php else: ?>	


            <div class="row">

                <?php foreach ($settings['tp_category_list'] as $key => $item) : ?>
                <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']);?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']);?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']);?> col-sm-<?php echo esc_attr($settings['tp_col_for_mobile']);?>">
                  <div class="tp-cat-item mb-40 d-flex align-items-center">

                     <?php if($item['tp_category_icon_type'] !== 'image') : ?>
                        <div class="tp-category-icon mr-15">
                            <?php tp_render_icon($item, 'tp_category_icon', 'tp_category_selected_icon'); ?>
                        </div>  
                    <?php else : ?>
                        <div class="tp-category-icon mr-15">
                            <?php if (!empty($item['tp_category_image']['url'])): ?>
                            <img src="<?php echo $item['tp_category_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_category_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>  
                        </div>
                    <?php endif; ?>

                        <?php if (!empty($item['tp_category_title' ]) && !empty($item['tp_category_link'])): ?>
                        <h4 class="tp-category-title">
                            <a href="<?php echo esc_url($item['tp_category_link']);?>">
                                <?php echo tp_kses($item['tp_category_title' ]); ?>
                            </a>
                        </h4>
                        <?php elseif(!empty($item['tp_category_title' ])) : ?>
                        <h4 class="tp-category-title">
                            <?php echo tp_kses($item['tp_category_title' ]); ?>
                        </h4>
                        <?php endif; ?>

                  </div>
                </div>
                <?php endforeach; ?>

            </div>


        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Category() );