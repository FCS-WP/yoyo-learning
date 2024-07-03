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
class TP_CTA extends Widget_Base {

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
		return 'tp-cta';
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
		return __( 'TP :: CTA', 'tpcore' );
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

        // layout Panel
        $this->start_controls_section(
            'tp_map',
            [
                'label' => esc_html__('Map', 'tpcore'),
            ]
        );

        $default_address = esc_html__( 'London Eye, London, United Kingdom', 'elementor' );
        $this->add_control(
            'address',
            [
                'label' => esc_html__( 'Location', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => $default_address,
                'default' => $default_address,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'zoom',
            [
                'label' => esc_html__( 'Zoom', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 40,
                        'max' => 1440,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'vh' ],
                'selectors' => [
                    '{{WRAPPER}} iframe' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => esc_html__( 'View', 'elementor' ),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
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
                    '{{WRAPPER}} .tp-cta-text-wapper, .tp-section-box.tp-section-box-2, .tp-section-box.cta-map-section' => 'text-align: {{VALUE}}!important;'
                ]
            ]
        );
        $this->end_controls_section();


        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
                'condition' => ['tp_design_style' => ['layout-1', 'layout-2']]
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
                    'tp_design_style' => 'layout-2'
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


        // Cta group
        $this->start_controls_section(
            'tp_cta',
            [
                'label' => esc_html__('Icon Box', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => ['tp_design_style' => ['layout-2', 'layout-3']]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_cta_icon_type',
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
            'tp_cta_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_cta_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_cta_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fal fa-envelope-open',
                    'condition' => [
                        'tp_cta_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_cta_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fal fa-envelope-open',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_cta_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'tp_cta_sub_title', [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sub Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_cta_title_type',
            [
                'label' => esc_html__('Select Text Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'email',
                'options' => [
                    'email' => esc_html__('Email', 'tpcore'),
                    'phone' => esc_html__('Phone', 'tpcore'),
                ],
            ]
        );


        $repeater->add_control(
            'tp_cta_email',
            [
                'label' => esc_html__('Email', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('info@webmail.com', 'tpcore'),
                'label_block' => true,
                'condition' => ['tp_cta_title_type' => 'email']
            ]
        ); 


        $repeater->add_control(
            'tp_cta_phone',
            [
                'label' => esc_html__('Phone', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('73438023623', 'tpcore'),
                'label_block' => true,
                'condition' => ['tp_cta_title_type' => 'phone']
            ]
        );




        $this->add_control(
            'tp_cta_iconbox_list',
            [
                'label' => esc_html__('Icon Box', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_cta_sub_title' => esc_html__('Info 1', 'tpcore'),
                    ],
                ],
                'title_field' => '{{{ tp_cta_sub_title }}}',
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


        // play button
        $this->start_controls_section(
            '_section_play',
            [
                'label' => __('Play Button', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-2',
                ],
            ]
        );

        $this->add_control(
            'tp_play_button_show',
            [
                'label' => esc_html__( 'Show Play Button', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_play_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fas fa-play',
                ]
            );
        } else {
            $this->add_control(
                'tp_play_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-play',
                        'library' => 'solid',
                    ],
                ]
            );
        }

        $this->add_control(
            'video_link',
            [
                'label' => __('Video URL', 'tpcore'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('https://www.youtube.com/watch?v=HGSR3FDVkkQ', 'tpcore'),
                'placeholder' => __('Type your video url', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        

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
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'tp-section-title');

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

         <div class="tp-support-area pt-120 pb-110 p-relative" data-background="<?php echo esc_url($tp_image); ?>" style="background: url(<?php echo esc_url($tp_image); ?>);">
          <div class="container">
             <div class="row">
                <div class="col-xl-8 col-lg-10  m-auto">
                   <div class="tpsupport__overlay-content text-center">

                    <?php if(!empty($settings['tp_play_button_show'])) : ?>
                      <a class=" popup-video mb-60" href="<?php echo esc_url($settings['video_link']);?>">


                        <?php if (!empty($settings['tp_play_icon']) || !empty($settings['tp_play_selected_icon']['value'])) : ?>
                            <div class="tp-sv-icon">
                                <?php tp_render_icon($settings, 'tp_play_icon', 'tp_play_selected_icon'); ?>
                            </div>
                        <?php endif; ?>   

                    </a>
                    <?php endif; ?>

                      <div class="tp-section-box tp-section-box-2 white-text p-relative mb-45 text-center">

                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
                        <span class="tp-section-subtitle d-inline-block pre mb-10"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
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
                        <p class="m-0"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                        <?php endif; ?>

                      </div>

                      <hr class="mt-50 mb-50">
                   </div>

                   <div class="tpsupport-wrapper d-flex justify-content-center">

                    <?php if (!empty($settings['tp_btn_button_show'])) : ?>
                    <div class="tpsupport-ovr-button mr-30">
                     <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?><i class="fal fa-angle-right"></i></a>
                    </div>
                    <?php endif; ?>
                      


                      <div class="tp-header-contact tp-support-contact z-index">

                        <?php foreach ($settings['tp_cta_iconbox_list'] as $item) : ?>
                         <div class="tp-header-contact-icon tp-header-contact-icon-2  d-flex align-items-center">
                            <div>

                                <?php if($item['tp_cta_icon_type'] !== 'image') : ?>
                                        <?php tp_render_icon($item, 'tp_cta_icon', 'tp_cta_selected_icon'); ?>
                                <?php else : ?>
                                    <div class="cta-icon">
                                        <?php if (!empty($item['tp_cta_image']['url'])): ?>
                                        <img src="<?php echo $item['tp_cta_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_cta_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>  
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="tp-header-icon-info tp-header-icon-info2">
                                <?php if(!empty($item['tp_cta_sub_title'])) : ?>
                                <label><?php echo tp_kses($item['tp_cta_sub_title']);?></label>
                                <?php endif; ?>
                                <?php if(!empty($item['tp_cta_title_type'] == 'phone' && !empty($item['tp_cta_phone']) )) : ?>
                                <a href="tel:<?php echo esc_attr($item['tp_cta_phone']);?>"><?php echo tp_kses($item['tp_cta_phone']);?></a>
                                <?php elseif(!empty($item['tp_cta_title_type'] == 'email' && !empty($item['tp_cta_email']) )) : ?>
                                <a href="mailto:<?php echo esc_attr($item['tp_cta_email']);?>"><?php echo tp_kses($item['tp_cta_email']);?></a>
                                <?php endif; ?>
                            </div>
                         </div>
                        <?php endforeach; ?>

                      </div>
                   </div>
                </div>
             </div>
          </div>
        </div>


        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-50');


            if ( empty( $settings['address'] ) ) {
                return;
            }

            if ( 0 === absint( $settings['zoom']['size'] ) ) {
                $settings['zoom']['size'] = 10;
            }

            $api_key = esc_html( get_option( 'elementor_google_maps_api_key' ) );

            $params = [
                rawurlencode( $settings['address'] ),
                absint( $settings['zoom']['size'] ),
            ];

            if ( $api_key ) {
                $params[] = $api_key;

                $url = 'https://www.google.com/maps/embed/v1/place?key=%3$s&q=%1$s&amp;zoom=%2$d';
            } else {
                $url = 'https://maps.google.com/maps?q=%1$s&amp;t=m&amp;z=%2$d&amp;output=embed&amp;iwloc=near';
            }


        ?>
    <div class="tp-cta-area black-bg cta-bg position-relative" data-background="<?php echo esc_url($tp_image); ?>" style="background: url(<?php echo esc_url($tp_image); ?>);">

        <?php if(!empty($settings['address'])) : ?>
        <div class="cta-map elementor-custom-embed">
            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="<?php echo esc_url( vsprintf( $url, $params ) ); ?>"
                    title="<?php echo esc_attr( $settings['address'] ); ?>"
                    aria-label="<?php echo esc_attr( $settings['address'] ); ?>"
            ></iframe>
        </div>
        <?php endif; ?>

      <div class="container">
         <div class="row justify-content-end">
            <div class="col-xl-6 col-lg-12">
               <div class="tp-quote-box pl-80 pt-120 pb-120">
                  <div class="tp-section-box cta-map-section p-relative">

                    <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
                    <span class="tp-section-subtitle right-white  d-inline-block mb-10"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
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

                  <div class="tp-cta-main d-flex">

                    <?php foreach ($settings['tp_cta_iconbox_list'] as $item) : ?>
                     <div class="tp-cta-box d-flex align-items-center">

                        

                        <?php if($item['tp_cta_icon_type'] !== 'image') : ?>
                            <div class="tp-cta-icon">
                               <?php tp_render_icon($item, 'tp_cta_icon', 'tp_cta_selected_icon'); ?>
                            </div>
                        <?php else : ?>
                            <div class="tp-cta-icon-img">
                                <?php if (!empty($item['tp_cta_image']['url'])): ?>
                                <img src="<?php echo $item['tp_cta_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_cta_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>  
                            </div>
                        <?php endif; ?>

                        <div class="tp-cta-content">
                           <?php if(!empty($item['tp_cta_sub_title'])) : ?>
                            <label><?php echo tp_kses($item['tp_cta_sub_title']);?></label>
                            <?php endif; ?>
                            <?php if(!empty($item['tp_cta_title_type'] == 'phone' && !empty($item['tp_cta_phone']) )) : ?>
                            <a href="tel:<?php echo esc_attr($item['tp_cta_phone']);?>"><?php echo tp_kses($item['tp_cta_phone']);?></a>
                            <?php elseif(!empty($item['tp_cta_title_type'] == 'email' && !empty($item['tp_cta_email']) )) : ?>
                            <a href="mailto:<?php echo esc_attr($item['tp_cta_email']);?>"><?php echo tp_kses($item['tp_cta_email']);?></a>
                            <?php endif; ?>
                        </div>
                     </div>
                     <?php endforeach; ?>

                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>

		<?php else: 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }                     
			$this->add_render_attribute('title_args', 'class', 'cta-title');

            // Link
            if ('2' == $settings['tp_btn_link_type']) {
                $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
                $this->add_render_attribute('tp-button-arg', 'target', '_self');
                $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
            } else {
                if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
                    $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
                }
            }            
		?>	

        <div class="tp-cta p-relative text-center tp-cta-space" data-background="<?php echo esc_url($tp_image); ?>" style="background: url(<?php echo esc_url($tp_image); ?>);">
          <div class="tp-cta-text-wapper">
            <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
            <span><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
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

            <?php if (!empty($settings['tp_btn_button_show'])) : ?>
            <div class="cta-link pt-110">
                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><i class="fal fa-long-arrow-right"></i></a>
             </div>
            <?php endif; ?>

          </div>
        </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_CTA() );