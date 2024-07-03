<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

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
class TP_Portfolio_Gallery extends Widget_Base {

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
		return 'tp-portfolio-gallery';
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
		return __( 'TP :: Portfolio Gallery', 'tpcore' );
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

        // Service group
        $this->start_controls_section(
            'tp_portfolio_gallery',
            [
                'label' => esc_html__('Portfolio Gallery List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_portfolio_gallery_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Image Number', 'tpcore'),
                'label_block' => true,
            ]
        );    

        $repeater->add_control(
            'tp_portfolio_gallery_image',
            [
                'label' => esc_html__( 'Choose Image', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_portfolio_gallery_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_portfolio_gallery_title' => esc_html__('Image 01', 'tpcore'),
                    ],
                    [
                        'tp_portfolio_gallery_title' => esc_html__('Image 02', 'tpcore')
                    ],
                    [
                        'tp_portfolio_gallery_title' => esc_html__('Image 03', 'tpcore')
                    ],
                    [
                        'tp_portfolio_gallery_title' => esc_html__('Image 04', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_portfolio_gallery_title }}}',
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


        // style tab here
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'tocore' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'tocore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .tp-el-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'tocore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .tp-el-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        // Subtitle    
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'tocore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .tp-el-subtitle',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'tocore' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'tocore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', 'tocore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .tp-el-content p',
                'scheme' => Typography::TYPOGRAPHY_4,
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

		<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>
            <section class="services__style__two">
                <div class="container">
                    <?php if ( !empty($settings['tp_section_title_show']) ) : ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">
                            <div class="section__title text-center">
                                <?php if ( !empty($settings['tp_sub_title']) ) : ?>
                                <span class="sub-title tp-el-subtitle"><?php echo tp_kses( $settings['tp_sub_title'] ); ?></span>
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
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="services__style__two__wrap">
                        <div class="row gx-0">
                            <?php foreach ($settings['tp_portfolio_gallery_list'] as $item) : 
                                // Link
                                if ('2' == $item['tp_portfolio_gallery_link_type']) {
                                    $link = get_permalink($item['tp_portfolio_gallery_page_link']);
                                    $target = '_self';
                                    $rel = 'nofollow';
                                } else {
                                    $link = !empty($item['tp_portfolio_gallery_link']['url']) ? $item['tp_portfolio_gallery_link']['url'] : '';
                                    $target = !empty($item['tp_portfolio_gallery_link']['is_external']) ? '_blank' : '';
                                    $rel = !empty($item['tp_portfolio_gallery_link']['nofollow']) ? 'nofollow' : '';
                                }

                            ?>
                            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                                <div class="services__style__two__item">
                                    <div class="services__style__two__icon">
                                        <?php if($item['tp_portfolio_gallery_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['tp_portfolio_gallery_icon']) || !empty($item['tp_portfolio_gallery_selected_icon']['value'])) : ?>
                                                <div class="icon">
                                                    <?php tp_render_icon($item, 'tp_portfolio_gallery_icon', 'tp_portfolio_gallery_selected_icon'); ?>
                                                </div>
                                            <?php endif; ?>   
                                        <?php else : ?>
                                            <div class="icon">
                                                <?php if (!empty($item['tp_portfolio_gallery_image']['url'])): ?>
                                                <img src="<?php echo $item['tp_portfolio_gallery_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_portfolio_gallery_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>  
                                            </div>
                                        <?php endif; ?>                                     
                                    </div>
                                    <div class="services__style__two__content">
                                        <?php if (!empty($item['tp_portfolio_gallery_title' ])): ?>
                                        <h3 class="title">
                                            <?php if ($item['tp_portfolio_gallery_link_switcher'] == 'yes') : ?>
                                            <a href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_portfolio_gallery_title' ]); ?></a>
                                            <?php else : ?>
                                                <?php echo tp_kses($item['tp_portfolio_gallery_title' ]); ?>
                                            <?php endif; ?>
                                        </h3>
                                        <?php endif; ?> 

                                        <?php if (!empty($item['tp_portfolio_gallery_description' ])): ?>
                                        <p><?php echo tp_kses($item['tp_portfolio_gallery_description']); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty($link)) : ?>
                                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="services__btn"><i class="far fa-long-arrow-right"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
		<?php else: ?>	


            <div class="project-area">
              <div class="tp-project-active tp-team-space">

                <?php foreach ($settings['tp_portfolio_gallery_list'] as $key => $item) : ?>
                <div class="project-item">
                    <img src="<?php echo esc_url($item['tp_portfolio_gallery_image']['url']);?>" alt="">
                    <a class="popup-image" href="<?php echo esc_url($item['tp_portfolio_gallery_image']['url']);?>"><i class="fal fa-plus"></i></a>
                </div>
                <?php endforeach; ?>

              </div>
            </div>




                <div class="tp-portfolio_gallery-area theme-bg pt-70 pb-40 d-none">
                  <div class="container">
                     <div class="row counter-row">

                        <?php foreach ($settings['tp_portfolio_gallery_list'] as $key => $item) : ?>
                        <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                           <div class="tp-portfolio_gallery mb-10">
                              <div class="num__count"></div>
                              <div class="portfolio_gallery-number">
                                 
                                <?php if (!empty($item['tp_portfolio_gallery_number' ])): ?>
                                  <h2 class="counter"><?php echo tp_kses($item['tp_portfolio_gallery_number' ]); ?></h2>
                                <?php endif; ?>

                                <?php if($item['tp_portfolio_gallery_icon_type'] !== 'image') : ?>
                                    <?php if (!empty($item['tp_portfolio_gallery_icon']) || !empty($item['tp_portfolio_gallery_selected_icon']['value'])) : ?>
                                        <span>
                                            <?php tp_render_icon($item, 'tp_portfolio_gallery_icon', 'tp_portfolio_gallery_selected_icon'); ?>
                                        </span>
                                    <?php endif; ?>   
                                <?php else : ?>
                                    <div class="c-icon">
                                        <?php if (!empty($item['tp_portfolio_gallery_image']['url'])): ?>
                                        <img src="<?php echo $item['tp_portfolio_gallery_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_portfolio_gallery_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                        <?php endif; ?>  
                                    </div>
                                <?php endif; ?>  



                              </div>
                              <div class="portfolio_gallery-content">
                                 

                                <?php if (!empty($item['tp_portfolio_gallery_title' ])): ?>
                                <h4><?php echo tp_kses($item['tp_portfolio_gallery_title' ]); ?></h4>
                                <?php endif; ?>

                                <?php if (!empty($item['tp_portfolio_gallery_description' ])): ?>
                                    <p><?php echo tp_kses($item['tp_portfolio_gallery_description']); ?></p>
                                <?php endif; ?>

                              </div>
                           </div>
                        </div>
                        <?php endforeach; ?>

                     </div>
                  </div>
                </div>



        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_Portfolio_Gallery() );