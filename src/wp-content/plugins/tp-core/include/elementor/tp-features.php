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
class TP_Features extends Widget_Base {

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
		return 'tp-features';
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
		return __( 'TP :: Features', 'tpcore' );
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

        // feature left group
        $this->start_controls_section(
            'tp_features_left',
            [
                'label' => esc_html__('Left Info List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_left_condition',
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
            'tp_features_left_icon_type',
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
            'tp_features_left_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_left_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_features_left_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'flaticon-shield',
                    'condition' => [
                        'tp_features_left_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_features_left_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'flaticon-shield',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_features_left_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_features_left_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_left_back_title', [
                'label' => esc_html__('Back Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('01', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_features_left_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );         

        $this->add_control(
            'tp_features_left_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_features_left_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_features_left_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_features_left_title' => esc_html__('Develop', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_features_left_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_features_left_align',
            [
                'label' => esc_html__( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tp-fea-content-left ' => 'text-align: {{VALUE}}!important;'
                ]
            ]
        );
        $this->end_controls_section();



        // feature right group
        $this->start_controls_section(
            'tp_features_right',
            [
                'label' => esc_html__('Right Info List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_right_condition',
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
            'tp_features_right_icon_type',
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
            'tp_features_right_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_right_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_features_right_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'flaticon-shield',
                    'condition' => [
                        'tp_features_right_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_features_right_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'flaticon-shield',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_features_right_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_features_right_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_right_back_title', [
                'label' => esc_html__('Back Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('01', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_features_right_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );         

        $this->add_control(
            'tp_features_right_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_features_right_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_features_right_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_features_right_title' => esc_html__('Develop', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_features_right_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_features_right_align',
            [
                'label' => esc_html__( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tp-fea-content-right ' => 'text-align: {{VALUE}}!important;'
                ]
            ]
        );
        $this->end_controls_section();


        // feature hover text
        $this->start_controls_section(
            '_tp_hover_text',
            [
                'label' => esc_html__('Hover Text', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_hover_text_switcher',
            [
                'label' => esc_html__( 'Add Hover Text', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                
            ]
        );

        $this->add_control(
            'tp_hover_text_1',
            [
                'label' => esc_html__('Hover Text 1', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Video analytics systems with ', 'tpcore'),
                'title' => esc_html__('Enter hover text 1', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_hover_text_switcher' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'tp_hover_text_2',
            [
                'label' => esc_html__('Hover Text 2', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Video analytics systems with ', 'tpcore'),
                'title' => esc_html__('Enter hover text 2', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_hover_text_switcher' => 'yes',
                ],
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

        // tp_columns_section
        $this->start_controls_section(
            'tp_columns_section',
            [
                'label' => esc_html__('Features - Columns', 'tpcore'),
                'condition' => ['tp_design_style' => 'layout-2']
            ]
        );

        $this->add_control(
            'tp_col_for_desktop',
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
            'tp_col_for_laptop',
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
            'tp_col_for_tablet',
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
            'tp_col_for_mobile',
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
		?>

		<?php if ( $settings['tp_design_style']  == 'layout-2' ) : ?>

        <div class="research__features-wrapper pt-35">
            <?php foreach ($settings['tp_features_list'] as $item) : ?>    
            <div class="research__features-item d-sm-flex align-items-start mb-40 elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
               <div class="research__features-icon mr-25">
                <?php if($item['tp_features_icon_type'] !== 'image') : ?>
                    <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                        <span><?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
                    <?php endif; ?>   
                <?php else : ?>
                    <span>
                        <?php if (!empty($item['tp_features_image']['url'])): ?>
                        <img class="light" src="<?php echo $item['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        <?php endif; ?>  
                    </span>
                <?php endif; ?>   
               </div>
               <div class="research__features-content">
                    <?php if (!empty($item['tp_features_title' ])): ?>
                    <h4>
                        <?php echo tp_kses($item['tp_features_title' ]); ?>
                    </h4>
                    <?php endif; ?>

                    <?php if (!empty($item['tp_features_description' ])): ?>
                    <p><?php echo tp_kses($item['tp_features_description']); ?></p>
                    <?php endif; ?>
               </div>
            </div>
            <?php endforeach; ?> 
        </div>

		<?php else: 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            } 
        ?>	



        <div class="row  align-items-start justify-content-center">
            <div class="col-xl-3 col-lg-6 col-md-6">

                <?php foreach ($settings['tp_features_left_list'] as $key => $item) : ?>  
                   <div class="tp-fea-item p-relative mb-30">
                      <div class="tp-fea-icon d-flex">

                        <?php if($item['tp_features_left_icon_type'] !== 'image') : ?>
                            <?php if (!empty($item['tp_features_left_icon']) || !empty($item['tp_features_left_selected_icon']['value'])) : ?>
                                <?php tp_render_icon($item, 'tp_features_left_icon', 'tp_features_left_selected_icon'); ?>
                            <?php endif; ?>   
                        <?php else : ?>
                            <span class="keyFeatureBlock__icon">
                                <?php if (!empty($item['tp_features_left_image']['url'])): ?>
                                <img class="light" src="<?php echo $item['tp_features_left_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_left_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>  
                            </span>
                        <?php endif; ?>

                         <div class="fea-big-text">
                            <?php if(!empty($item['tp_features_left_back_title'])) : ?>
                            <span><?php echo tp_kses($item['tp_features_left_back_title']);?></span>
                            <?php endif; ?>
                         </div>
                      </div>
                      <div class="tp-fea-content tp-fea-content-left pt-40">

                        <?php if(!empty($item['tp_features_left_title'])) : ?>
                         <h5><?php echo tp_kses($item['tp_features_left_title']);?></h5>
                        <?php endif; ?>

                        <?php if(!empty($item['tp_features_left_description'])) : ?>
                         <p class="m-0"><?php echo tp_kses($item['tp_features_left_description']);?></p>
                        <?php endif; ?>
                      </div>
                   </div>
                <?php endforeach; ?>

            </div>
            <div class="col-lg-6 justify-content-center p-relative d-none d-xl-flex">
               <div class="tp-fea-big-img p-relative">

                <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                <?php endif; ?>

                  <?php if(!empty($settings['tp_hover_text_switcher'])) : ?>

                  <?php if(!empty($settings['tp_hover_text_1'])) : ?>
                  <div class="tp-fea-plus-icon ">
                     <a href="#"><i class="fal fa-plus"></i></a>
                     <div class="fea-plus-icon-text">
                        <h4 class="m-0"><?php echo tp_kses($settings['tp_hover_text_1']);?></h4>
                     </div>
                  </div>
                  <?php endif; ?>

                  <?php if(!empty($settings['tp_hover_text_2'])) : ?>
                  <div class="tp-fea-plus-icon2">
                     <a href="#"><i class="fal fa-plus"></i></a>
                     <div class="fea-plus-icon-text2">
                        <h4 class="m-0"><?php echo tp_kses($settings['tp_hover_text_2']);?></h4>
                     </div>
                  </div>
                  <?php endif; ?>

                  <?php endif; ?>

               </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">

               <?php foreach ($settings['tp_features_right_list'] as $key => $item) : ?>  
                   <div class="tp-fea-item p-relative mb-30">
                      <div class="tp-fea-icon d-flex">

                        <?php if($item['tp_features_right_icon_type'] !== 'image') : ?>
                            <?php if (!empty($item['tp_features_right_icon']) || !empty($item['tp_features_right_selected_icon']['value'])) : ?>
                                <?php tp_render_icon($item, 'tp_features_right_icon', 'tp_features_right_selected_icon'); ?>
                            <?php endif; ?>   
                        <?php else : ?>
                            <span class="keyFeatureBlock__icon">
                                <?php if (!empty($item['tp_features_right_image']['url'])): ?>
                                <img class="light" src="<?php echo $item['tp_features_right_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_right_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>  
                            </span>
                        <?php endif; ?>

                         <div class="fea-big-text">
                            <?php if(!empty($item['tp_features_right_back_title'])) : ?>
                            <span><?php echo tp_kses($item['tp_features_right_back_title']);?></span>
                            <?php endif; ?>
                         </div>
                      </div>
                      <div class="tp-fea-content tp-fea-content-right pt-40">

                        <?php if(!empty($item['tp_features_right_title'])) : ?>
                         <h5><?php echo tp_kses($item['tp_features_right_title']);?></h5>
                        <?php endif; ?>

                        <?php if(!empty($item['tp_features_right_description'])) : ?>
                         <p class="m-0"><?php echo tp_kses($item['tp_features_right_description']);?></p>
                        <?php endif; ?>
                      </div>
                   </div>
                <?php endforeach; ?>

            </div>
        </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Features() );