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
class TP_Live extends Widget_Base {

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
		return 'tp-live';
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
		return __( 'TP :: Live', 'tpcore' );
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
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Sub Title', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
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
                    '{{WRAPPER}} .section-title' => 'text-align: {{VALUE}}!important;'
                ]
            ]
        );


        $this->add_control(
            'tp_live_title',
            [
                'label' => esc_html__('Live Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('LIVE : 01:30:08', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
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
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image2',
            [
                'label' => esc_html__( 'Choose Image 2', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => ['tp_design_style' => 'layout-2']
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

		<?php if ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>
        <section class="review position-relative overflow-hidden">
          <div class="container">
            <div class="row">
              <?php if ( !empty($settings['tp_section_title_show']) ) : ?>  
              <div class="col-lg-6">
                <!-- Section Heading/Title -->
                <div class="sectionTitle mb-65">
                    <?php if ( !empty($settings['tp_sub_title']) ) : ?>  
                    <span class="sectionTitle__small">
                    <i class="fa-solid fa-heart btn__icon"></i>
                    Live
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
                <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                <div class="reviewMap mb-50">
                  <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                </div>
                <?php endif; ?>
              </div>
              <?php endif; ?>
              <div class="col-lg-6">
                <div class="row">
                    <?php foreach ($settings['reviews_list'] as $index => $item) : 
                        if ( !empty($item['reviewer_image']['url']) ) {
                            $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                            $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                  <div class="col-lg-6 col-md-6">
                    <div class="reviewblock reviewblock--style2">
                      <div class="reviewblock__content">
                        <div class="reviewblock__author">
                          <?php if ( !empty($tp_reviewer_image) ) : ?>   
                          <div class="reviewblock__authorImage">
                            <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                          </div>
                          <?php endif; ?>

                          <?php if ( !empty($item['reviewer_name']) ) : ?> 
                          <h3 class="reviewblock__authorName"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                          <?php endif; ?>
                          <?php if ( !empty($item['review_content']) ) : ?>
                          <p class="reviewblock__authorSpeech"><?php echo tp_kses($item['review_content']); ?></p>
                          <?php endif; ?>
                          <?php if ( !empty($item['reviewer_title']) ) : ?>
                          <span class="reviewblock__authorDes"><?php echo tp_kses($item['reviewer_title']); ?></span>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </section>

        <?php elseif ( $settings['tp_design_style']  == 'layout-2' ): 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }



            if ( !empty($settings['tp_image2']['url']) ) {
                $tp_image2 = !empty($settings['tp_image2']['id']) ? wp_get_attachment_image_url( $settings['tp_image2']['id'], $settings['tp_image_size_size']) : $settings['tp_image2']['url'];
                $tp_image_alt2 = get_post_meta($settings["tp_image2"]["id"], "_wp_attachment_image_alt", true);
            }


            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-20');

        ?>

        <section class="video-area pb-120 wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".3s">
             <div class="container">

                <div class="row text-center">
                   <div class="col-lg-12 col-md-12">
                      <div class="section-title mb-65">

                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>
                         <span class="tp-bline-stitle mb-15"><?php echo tp_kses($settings['tp_sub_title']);?></span>
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
                   </div>
                </div>

                <div class="row">
                   <div class="col-md-12">
                      <div class="video-bg p-relative text-center">
                        <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>

                        <?php if(!empty($settings['tp_live_title'])) : ?>
                         <div class="video-text video-run-time">
                            <i><?php echo tp_kses($settings['tp_live_title']);?></i>
                         </div>
                        <?php endif; ?>
                         <div class="video-shape-area">
                            <img class="video-shape" src="<?php echo get_template_directory_uri();?>/assets/img/about/shape-2-img-2.png" alt="video-shape">
                            <img class="video-shape-2 d-none d-md-block" src="<?php echo get_template_directory_uri();?>/assets/img/about/video-2-shape-2.png" alt="video-shape">
                            <?php if (!empty($settings['tp_image2']['url']) || !empty($settings['tp_image2']['id'])) : ?>
                                <img src="<?php echo esc_url($tp_image2); ?>" alt="<?php echo esc_attr($tp_image_alt2); ?>" class="video-shape-3 d-none d-md-block">
                            <?php endif; ?>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
        </section>

		<?php else: 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }


			$this->add_render_attribute('title_args', 'class', 'tp-section-title mb-20');
		?>



        <section class="video-area wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".4s">
             <div class="container">
                <div class="row text-center">
                   <div class="col-lg-12 col-md-12">
                      <div class="section-title mb-65">

                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>
                         <span class="tp-sub-title-box mb-15"><?php echo tp_kses($settings['tp_sub_title']);?></span>
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
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                      <div class="video-bg p-relative text-center">
                        <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                            <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>
                        <?php if(!empty($settings['tp_live_title'])) : ?>
                         <div class="video-text">
                            <i><?php echo tp_kses($settings['tp_live_title']);?></i>
                         </div>
                        <?php endif; ?>
                         <div class="video-shape">
                            <img src="<?php echo get_template_directory_uri();?>/assets/img/about/shape-2-img-2.png" alt="video-shape">
                         </div>
                      </div>
                   </div>
                </div>
             </div>
        </section>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Live() );