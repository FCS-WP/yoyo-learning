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
class TP_Hero extends Widget_Base {

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
		return 'tp-hero';
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
		return __( 'TP :: Hero', 'tpcore' );
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
                    '{{WRAPPER}}' => 'text-align: {{VALUE}}!important;'
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): 

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


            $this->add_render_attribute('title_args', 'class', 'hero-title-black mb-45');
        ?>

        <section class="banner-area fix p-relative">
             <div class="banner-bg banner-bg-rainbow" data-background="assets/img/banner/banner-bg-2.jpg">
                <div class="container">
                   <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-8">
                         <div class="hero-content hero-content-black">

                            <?php if(!empty($settings['tp_sub_title'])) : ?>
                            <span><?php echo tp_kses($settings['tp_sub_title']);?></span>
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


                            <?php if (!empty($settings['tp_btn_text']) && !empty($settings['tp_btn_button_show'])) : ?>
                             <div class="hero-btn">
                                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                             </div>
                            <?php endif; ?>

                         </div>
                      </div>
                      <div class="col-xl-6 col-lg-6">
                        <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                        <div class="banner-shape d-none d-md-block">
                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>" class="b-shape-3">
                        </div>
                        <?php endif; ?>
                      </div>
                   </div>
                </div>
             </div>
        </section>

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
        ?>
        <section class="review review--layout2 position-relative overflow-hidden">
          <div class="container-fluid p-0">
            <div class="row justify-content-center">
              <?php if ( !empty($settings['tp_section_title_show']) ) : ?>  
              <div class="col-lg-6">
                <!-- Section Heading/Title -->
                <div class="sectionTitle mb-65">
                    <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
                    <span class="sectionTitle__small">
                    <i class="fa-solid fa-heart btn__icon"></i>
                    Hero
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
                    <p class="desc"><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                    <?php endif; ?>
                </div>
                <!-- Section Heading/Title End -->
                <div class="reviewMap mb-50">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/image/map/map-thumb.png" alt="Gainioz Map">
                </div>
              </div>
              <?php endif; ?>
            </div>

            <div class="testi-slider-active2 swiper-container row g-0">
              <div class="swiper-wrapper">
                <?php foreach ($settings['reviews_list'] as $index => $item) : 
                    if ( !empty($item['reviewer_image']['url']) ) {
                        $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                        $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                ?>
                <div class="swiper-slide col-6">
                  <div class="review__box mb-30">
                    <div class="reviewblock reviewblock--style3 text-center">
                      <div class="reviewblock__content">
                        <div class="reviewblock__author">
                          <?php if ( !empty($tp_reviewer_image) ) : ?>    
                          <img class="reviewblock__author__image" src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                          <?php endif; ?>

                          <?php if ( !empty($item['reviewer_name']) ) : ?>
                          <span class="reviewblock__author__name d-block mb-25"><?php echo tp_kses($item['reviewer_name']); ?></span>
                          <?php endif; ?>
                          <br>
                          <?php if ( !empty($item['reviewer_title']) ) : ?>
                          <span class="reviewblock__authorDes"><?php echo tp_kses($item['reviewer_title']); ?></span>
                          <?php endif; ?>
                        </div>
                        <span class="reviewblock__quoteIcon__one">
                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M21.75 10.9951H18V7.99512C18 6.35449 19.3125 4.99512 21 4.99512H21.375C21.9844 4.99512 22.5 4.52637 22.5 3.87012V1.62012C22.5 1.01074 21.9844 0.495117 21.375 0.495117H21C16.8281 0.495117 13.5 3.87012 13.5 7.99512V19.2451C13.5 20.5107 14.4844 21.4951 15.75 21.4951H21.75C22.9688 21.4951 24 20.5107 24 19.2451V13.2451C24 12.0264 22.9688 10.9951 21.75 10.9951ZM8.25 10.9951H4.5V7.99512C4.5 6.35449 5.8125 4.99512 7.5 4.99512H7.875C8.48438 4.99512 9 4.52637 9 3.87012V1.62012C9 1.01074 8.48438 0.495117 7.875 0.495117H7.5C3.32812 0.495117 0 3.87012 0 7.99512V19.2451C0 20.5107 0.984375 21.4951 2.25 21.4951H8.25C9.46875 21.4951 10.5 20.5107 10.5 19.2451V13.2451C10.5 12.0264 9.46875 10.9951 8.25 10.9951Z"
                            fill="#EB9309" />
                        </svg>
                      </span>
                        <?php if ( !empty($item['review_content']) ) : ?>
                        <h4 class="reviewblock__qotes">“ <?php echo tp_kses($item['review_content']); ?> “</h4>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
              <div class="it-pagination"></div>
            </div>
          </div>
        </section>

		<?php else: 
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


			$this->add_render_attribute('title_args', 'class', 'hero-title mb-35');
		?>



        <section class="banner-area fix p-relative">
             <div class="banner-bg" >
                <div class="container">
                   <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-8">
                         <div class="hero-content">

                            <?php if(!empty($settings['tp_sub_title'])) : ?>
                            <span><?php echo tp_kses($settings['tp_sub_title']);?></span>
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

                            <?php if (!empty($settings['tp_btn_text']) && !empty($settings['tp_btn_button_show'])) : ?>
                             <div class="tp-banner-btn">
                                <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo $settings['tp_btn_text']; ?></a>
                             </div>
                            <?php endif; ?>

                         </div>
                      </div>

                    <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                    <div class="banner-shape d-none d-lg-block">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>" class="b-shape">
                    </div>
                    <?php endif; ?>

                   </div>
                </div>
             </div>
        </section>


        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Hero() );