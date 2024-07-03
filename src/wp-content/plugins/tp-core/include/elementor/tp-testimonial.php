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
class TP_Testimonial extends Widget_Base {

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
		return 'tp-testimonial';
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
		return __( 'TP :: Testimonial', 'tpcore' );
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
                    '{{WRAPPER}} .section-title' => 'text-align: {{VALUE}}!important;'
                ]
            ]
        );
        $this->end_controls_section();


        

        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'tpcore' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'tpcore' ),
                'label_block' => true,
            ]
        );     

        $repeater->add_control(
            'reviewer_title', [
                'label' => esc_html__( 'Reviewer Title', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '- CEO at YES Germany' , 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'The circuit television, also
                     known as video surveillance
                     is the use of video CCTV',
                'placeholder' => esc_html__( 'Type your review content here', 'tpcore' ),
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( '- CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'The circuit television, also
                     known as video surveillance
                     is the use of video CCTV', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( '- CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'The circuit television, also
                     known as video surveillance
                     is the use of video CCTV', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( '- CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'The circuit television, also
                     known as video surveillance
                     is the use of video CCTV', 'tpcore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'thumbnail',
                'exclude' => ['custom'],
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'tp_testimonial_arrow_switcher',
            [
                'label' => esc_html__( 'Active Arrow', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => ['tp_design_style' => ['layout-1', 'layout-2']]
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
            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-20');
        ?>
        <section class="testimonial-white-area wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".4s">
             <div class="container">
                <div class="row justify-content-between">
                   <div class="col-lg-6 col-md-8">
                      <div class="section-title mb-35">

                            <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                            <span class="tp-sub-title-box mb-15">
                                <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
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
                            <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                            <?php endif; ?>

                      </div>
                   </div>
                    <?php if(!empty($settings['tp_testimonial_arrow_switcher'])) : ?>
                   <div class="col-6 col-md-4">
                      <div class="tp-section-arrow d-flex justify-content-md-end"></div>
                   </div>
                    <?php endif; ?>
                </div>
                <div class="testimonial--active tp-slide-space">

                    <?php foreach ($settings['reviews_list'] as $index => $item) : 
                    if ( !empty($item['reviewer_image']['url']) ) {
                        $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                        $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    ?>
                   <div class="tp-test-s-item">
                      <div class="tp-testi">
                         <div class="tp-testi__ava d-flex align-items-center mb-15">
                            <?php if(!empty($tp_reviewer_image)) : ?>
                            <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                            <?php endif; ?>
                            <div class="tp-testi__avainfo ml-20">
                               
                                <?php if ( !empty($item['reviewer_name']) ) : ?>
                                <h3 class="tp-testi__title mt-5"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                                <?php endif; ?>

                                <?php if ( !empty($item['reviewer_title']) ) : ?>
                                <i><?php echo tp_kses($item['reviewer_title']); ?></i>
                                <?php endif; ?>

                            </div>
                         </div>
                        <?php if ( !empty($item['review_content']) ) : ?>
                        <p><?php echo tp_kses($item['review_content']); ?></p>
                        <?php endif; ?>
                         <div class="tp-testi__rating mb-5">
                            <ul class="d-flex align-items-center">
                               <li><i class="fi fi-ss-star"></i></li>
                               <li><i class="fi fi-ss-star"></i></li>
                               <li><i class="fi fi-ss-star"></i></li>
                               <li><i class="fi fi-ss-star"></i></li>
                               <li><i class="fi fi-rs-star"></i></li>
                            </ul>
                         </div>
                      </div>
                   </div>
                    <?php endforeach; ?>

                </div>
             </div>
        </section>

        <?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'tp-section-title mb-20g');
        ?>

        <section class="testimonial-area testimonial-bg-none bg-bottom wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".3s" >
             <div class="container">
                <div class="row">
                   <div class="col-lg-12">
                      <div class="section-title text-center mb-65">

                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                        <span class="tp-bline-stitle mb-15">
                            <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
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
                        <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                        <?php endif; ?>


                      </div>
                   </div>
                </div>
                <div class="testimonial-active-box tp-slide-space-white">

                    <?php foreach ($settings['reviews_list'] as $index => $item) : 
                    if ( !empty($item['reviewer_image']['url']) ) {
                        $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                        $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    ?>
                   <div class="tp-test-s-item">
                      <div class="tp-testi tp-testi-round p-relative">
                         <div class="tp-testi__ava testi-ava-border d-flex align-items-center mb-20 pb-20">
                            <?php if(!empty($tp_reviewer_image)) : ?>
                            <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                            <?php endif; ?>
                            <div class="tp-testi__avainfo ml-20">
                            <?php if ( !empty($item['reviewer_name']) ) : ?>
                            <h3 class="tp-testi__title tp-title-meta mt-5"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                            <?php endif; ?> 
                            <?php if ( !empty($item['reviewer_title']) ) : ?>
                            <i><?php echo tp_kses($item['reviewer_title']); ?></i>
                            <?php endif; ?>
                            </div>
                         </div>
                        <?php if ( !empty($item['review_content']) ) : ?>
                        <p><?php echo tp_kses($item['review_content']); ?></p>
                        <?php endif; ?>
                         <div class="tp-testi__rating mb-5">
                            <i class="fi fi-ss-star"></i>
                            <i class="fi fi-ss-star"></i>
                            <i class="fi fi-ss-star"></i>
                            <i class="fi fi-ss-star"></i>
                            <i class="fi fi-rs-star"></i>
                         </div>
                         <div class="testi-quote">
                            <i class="fa-solid fa-quote-right"></i>
                         </div>
                      </div>
                   </div>
                   <?php endforeach; ?>

                </div>
             </div>
        </section>

		<?php else: 
			$this->add_render_attribute('title_args', 'class', 'tp-section-title mb-20');
		?>

        <section class="testimonial-area testimonial-bg-none bg-bottom  wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".4s" >
         <div class="container">
            <div class="row justify-content-between">
               <div class="col-xl-6 col-lg-8 col-md-8 col-12">
                  <div class="section-title mb-65">
                        <?php if ( !empty($settings['tp_sub_title']) ) : ?>    
                            <span class="tp-sub-title mb-20">
                                <?php echo tp_kses( $settings['tp_sub_title'] ); ?>
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
                        <p><?php echo tp_kses( $settings['tp_desctiption'] ); ?></p>
                        <?php endif; ?>
                  </div>
               </div>

               <?php if(!empty($settings['tp_testimonial_arrow_switcher'])) : ?>
               <div class="col-xl-6 col-lg-4 col-md-4 col-6">
                  <div class="tp-section-arrow d-flex justify-content-md-end mb-40"></div>
               </div>
               <?php endif; ?>

            </div>
            <div class="testimonial-active tp-slide-space">

                <?php foreach ($settings['reviews_list'] as $index => $item) : 
                if ( !empty($item['reviewer_image']['url']) ) {
                    $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                    $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                }
                ?>
               <div class="tp-test-slide-item">
                  <div class="tp-testi p-relative mt-65">

                    <?php if(!empty($tp_reviewer_image)) : ?>
                     <div class="tp-testi__avatar">
                        <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                     </div>
                    <?php endif; ?>

                    <?php if ( !empty($tp_reviewer_image) ) : ?>
                     <div class="tp-testi__avatar">
                        <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_url($tp_reviewer_image_alt); ?>">
                     </div>
                    <?php endif; ?>

                     <div class="tp-testi__rating pb-5">
                        <ul class="d-flex align-items-center justify-content-end mr-5 mb-25">
                           <li><i class="fi fi-ss-star"></i></li>
                           <li><i class="fi fi-ss-star"></i></li>
                           <li><i class="fi fi-ss-star"></i></li>
                           <li><i class="fi fi-ss-star"></i></li>
                           <li><i class="fi fi-rs-star"></i></li>
                        </ul>
                     </div>

                     <div class="tp-testi__avainfo">
                        

                    <?php if ( !empty($item['review_content']) ) : ?>
                    <p><?php echo tp_kses($item['review_content']); ?></p>
                    <?php endif; ?>

                    <?php if ( !empty($item['reviewer_name']) ) : ?>
                    <h3 class="tp-testi__title"><?php echo tp_kses($item['reviewer_name']); ?></h3>
                    <?php endif; ?>    

                        

                    <?php if ( !empty($item['reviewer_title']) ) : ?>
                    <i><?php echo tp_kses($item['reviewer_title']); ?></i>
                    <?php endif; ?>

                     </div>
                  </div>
               </div>
                <?php endforeach; ?>

            </div>
         </div>
      </section>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Testimonial() );