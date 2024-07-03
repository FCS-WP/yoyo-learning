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
class TP_Team extends Widget_Base {

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
		return 'tp-team';
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
		return __( 'TP :: Team', 'tpcore' );
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
                'condition' => [
                    'tp_design_style' => ['layout-1','layout-2']
                ]
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

		// member list
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __( 'Members', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

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
 
        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                      

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'tpcore' ),
                'default' => __( 'TP Member Title', 'tpcore' ),
                'placeholder' => __( 'Type title here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'tpcore' ),
                'default' => __( 'TP Officer', 'tpcore' ),
                'placeholder' => __( 'Type designation here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );   

        $repeater->add_control(
            'item_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Link', 'tpcore' ),
                'placeholder' => __( 'Type link here', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'total_classes',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Total Classes', 'tpcore' ),
                'default' => __( '35 Classes', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => ['repeater_condition' => 'style_2']
            ]
        );

        $repeater->add_control(
            'total_students',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Total Students', 'tpcore' ),
                'default' => __( '291+ Students', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => ['repeater_condition' => 'style_2']
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'tpcore' ),
                'label_off' => __( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'tpcore' ),
                'placeholder' => __( 'Add your profile link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'tpcore' ),
                'placeholder' => __( 'Add your email link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'tpcore' ),
                'placeholder' => __( 'Add your phone link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your facebook link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your twitter link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your instagram link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'tpcore' ),
                'placeholder' => __( 'Add your linkedin link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'tpcore' ),
                'placeholder' => __( 'Add your youtube link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'tpcore' ),
                'placeholder' => __( 'Add your Google Plus link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'tpcore' ),
                'placeholder' => __( 'Add your flickr link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'tpcore' ),
                'placeholder' => __( 'Add your vimeo link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'tpcore' ),
                'placeholder' => __( 'Add your hehance link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'tpcore' ),
                'placeholder' => __( 'Add your dribbble link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'tpcore' ),
                'placeholder' => __( 'Add your pinterest link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'tpcore' ),
                'placeholder' => __( 'Add your github link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'tpcore' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'tpcore' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'tpcore' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'tpcore' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'tpcore' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'tpcore' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-instructor__content' => 'text-align: {{VALUE}}!important;'
                ]
            ]
        );

        $this->add_control(
            'tp_team_arrow_switcher',
            [
                'label' => esc_html__( 'Active Arrow', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => ['tp_design_style' => 'layout-1']
                
            ]
        );

        $this->add_control(
            'tp_team_btn_switcher',
            [
                'label' => esc_html__( 'Active btn', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => ['tp_design_style' => 'layout-3']
                
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

	    <!-- style 3 -->
	    <?php if ( $settings['tp_design_style'] === 'layout-3' ): 
            $this->add_render_attribute( 'title_args', 'class', 'tp-section-title mb-20' );
            $this->add_render_attribute( 'title', 'class', 'tp-instructor__title tp-instructor__title-info p-relative mb-35 mt-5' );
        ?>

        <section class="instructor-area wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".3s">
             <div class="container">
                <div class="row">

                    <?php foreach ( $settings['teams'] as $item ) :
                    $title = tp_kses( $item['title' ] );
                    $item_url = esc_url($item['item_url']);

                    if ( !empty($item['image']['url']) ) {
                        $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                        $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                    }            
                    ?>
                   <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".5s">
                      <div class="tp-instruc-item">
                          <div class="tp-instructor text-center p-relative mb-30">

                            <?php if( !empty($tp_team_image_url) ) : ?>
                            <div class="tp-instructor__thumb mb-25">
                                <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                            </div>
                            <?php endif; ?>

                             <div class="tp-instructor__content">

                                <?php if( !empty($item['designation']) ) : ?>
                                <span><?php echo tp_kses( $item['designation'] ); ?></span>
                                <?php endif; ?>

                                <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                $title,
                                $item_url,
                                ); ?>

                                <div class="tp-instructor__stu-info">
                                   <ul class="d-flex align-items-center justify-content-center">

                                    <?php if(!empty($item['total_classes'])) : ?>
                                      <li class="d-flex align-items-center"><img src="<?php echo get_template_directory_uri();?>/assets/img/icon/c-meta-01.png" alt="meta-icon"> <i><?php echo tp_kses($item['total_classes']);?></i></li>
                                    <?php endif; ?>

                                    <?php if(!empty($item['total_students'])) : ?>
                                      <li class="d-flex align-items-center"><img src="<?php echo get_template_directory_uri();?>/assets/img/icon/c-meta-02.png" alt="meta-icon"> <i><?php echo tp_kses($item['total_students']);?></i></li>
                                    <?php endif; ?>

                                   </ul>
                                </div>
                                <div class="tp-instructor__social">
                                   <ul>
                                        <?php if( !empty($item['web_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fas fa-globe"></i></a></li>
                                        <?php endif; ?>  

                                        <?php if( !empty($item['email_title'] ) ) : ?>
                                        <li><a href="mailto:<?php echo esc_url( $item['email_title'] ); ?>"><i class="fas fa-envelope"></i></a></li>
                                        <?php endif; ?>  

                                        <?php if( !empty($item['phone_title'] ) ) : ?>
                                        <li><a href="tell:<?php echo esc_url( $item['phone_title'] ); ?>"><i class="fas fa-phone"></i></a></li>
                                        <?php endif; ?>  

                                        <?php if( !empty($item['facebook_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['twitter_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['instagram_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['youtube_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['flickr_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['behance_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fab fa-behance"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['dribble_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['gitub_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fab fa-github"></i></a></li>
                                        <?php endif; ?>

                                   </ul>
                                </div>
                             </div>
                          </div>
                       </div>
                   </div>
                    <?php endforeach; ?>

                </div>
             </div>
        </section>



        <!-- style 2 -->
        <?php elseif ( $settings['tp_design_style'] === 'layout-2' ): 
            $this->add_render_attribute( 'title_args', 'class', 'tp-section-title' );
            $this->add_render_attribute( 'title', 'class', 'tp-instructor__title tp-instructor__title-info p-relative mb-35 mt-5' );
        ?>


            <section class="instructor-area wow fadeInUp" data-wow-duration=".8s" data-wow-delay=".4s">
                 <div class="container">
                    <div class="row">
                       <div class="col-lg-12">
                          <div class="section-title mb-35 text-center">

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
                    </div>
                    <div class="intruc-active-two mb-15 tp-slide-space">

                        <?php foreach ( $settings['teams'] as $item ) :
                        $title = tp_kses( $item['title' ] );
                        $item_url = esc_url($item['item_url']);

                        if ( !empty($item['image']['url']) ) {
                            $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                            $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                        }            
                        ?>
                       <div class="tp-instruc-item">
                          <div class="tp-instructor text-center p-relative mb-30">

                            <?php if( !empty($tp_team_image_url) ) : ?>
                            <div class="tp-instructor__thumb mb-25">
                                <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                            </div>
                            <?php endif; ?>

                             <div class="tp-instructor__content">

                                <?php if( !empty($item['designation']) ) : ?>
                                <span><?php echo tp_kses( $item['designation'] ); ?></span>
                                <?php endif; ?>

                                <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                $title,
                                $item_url,
                                ); ?>

                                <div class="tp-instructor__stu-info">
                                   <ul class="d-flex align-items-center justify-content-center">

                                    <?php if(!empty($item['total_classes'])) : ?>
                                      <li class="d-flex align-items-center"><img src="<?php echo get_template_directory_uri();?>/assets/img/icon/c-meta-01.png" alt="meta-icon"> <i><?php echo tp_kses($item['total_classes']);?></i></li>
                                    <?php endif; ?>

                                    <?php if(!empty($item['total_students'])) : ?>
                                      <li class="d-flex align-items-center"><img src="<?php echo get_template_directory_uri();?>/assets/img/icon/c-meta-02.png" alt="meta-icon"> <i><?php echo tp_kses($item['total_students']);?></i></li>
                                    <?php endif; ?>

                                   </ul>
                                </div>
                                <div class="tp-instructor__social">
                                   <ul>
                                        <?php if( !empty($item['web_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fas fa-globe"></i></a></li>
                                        <?php endif; ?>  

                                        <?php if( !empty($item['email_title'] ) ) : ?>
                                        <li><a href="mailto:<?php echo esc_url( $item['email_title'] ); ?>"><i class="fas fa-envelope"></i></a></li>
                                        <?php endif; ?>  

                                        <?php if( !empty($item['phone_title'] ) ) : ?>
                                        <li><a href="tell:<?php echo esc_url( $item['phone_title'] ); ?>"><i class="fas fa-phone"></i></a></li>
                                        <?php endif; ?>  

                                        <?php if( !empty($item['facebook_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['twitter_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['instagram_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['youtube_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['flickr_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['behance_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fab fa-behance"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['dribble_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                                        <?php endif; ?>

                                        <?php if( !empty($item['gitub_title'] ) ) : ?>
                                        <li><a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fab fa-github"></i></a></li>
                                        <?php endif; ?>

                                   </ul>
                                </div>
                             </div>
                          </div>
                       </div>
                        <?php endforeach; ?>

                    </div>
                 </div>
            </section>


	    <!-- style default -->
	    <?php else : 
	        $this->add_render_attribute( 'title_args', 'class', 'tp-section-title mb-20' );
            $this->add_render_attribute( 'title', 'class', 'tp-instructor__title mb-20' );
	    ?>




        <section class="instructor-area wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".4s">
             <div class="container">
                <div class="row">
                   <div class="col-xl-6 col-lg-8 col-md-7 col-12">
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

                   <?php if(!empty($settings['tp_team_arrow_switcher'])) : ?>
                   <div class="col-xl-6 col-lg-4 col-md-5 col-6">
                      <div class="tp-instruc-arrow d-flex justify-content-md-end"></div>
                   </div>
                    <?php endif; ?>

                </div>
                <div class="intruc-active mb-15 tp-slide-space">

                    <?php foreach ( $settings['teams'] as $item ) :
                        $title = tp_kses( $item['title' ] );
                        $item_url = esc_url($item['item_url']);

                        if ( !empty($item['image']['url']) ) {
                            $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                            $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                        }            
                    ?>
                   <div class="tp-instruc-item">
                      <div class="tp-instructor text-center p-relative mb-30">

                        <?php if( !empty($tp_team_image_url) ) : ?>
                        <div class="tp-instructor__thumb mb-25">
                            <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                        </div>
                        <?php endif; ?>

                         <div class="tp-instructor__content">

                            <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                $title,
                                $item_url,
                            ); ?>

                            <?php if( !empty($item['designation']) ) : ?>
                            <span><?php echo tp_kses( $item['designation'] ); ?></span>
                            <?php endif; ?>

                            <div class="tp-instructor__social">
                               <ul>

                                <?php if( !empty($item['web_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['web_title'] ); ?>"><i class="fas fa-globe"></i></a></li>
                                    <?php endif; ?>  

                                    <?php if( !empty($item['email_title'] ) ) : ?>
                                    <li><a href="mailto:<?php echo esc_url( $item['email_title'] ); ?>"><i class="fas fa-envelope"></i></a></li>
                                    <?php endif; ?>  

                                    <?php if( !empty($item['phone_title'] ) ) : ?>
                                    <li><a href="tell:<?php echo esc_url( $item['phone_title'] ); ?>"><i class="fas fa-phone"></i></a></li>
                                    <?php endif; ?>  

                                    <?php if( !empty($item['facebook_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['twitter_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['instagram_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['linkedin_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['youtube_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['googleplus_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['flickr_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['vimeo_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['behance_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['behance_title'] ); ?>"><i class="fab fa-behance"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['dribble_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['pinterest_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                                    <?php endif; ?>

                                    <?php if( !empty($item['gitub_title'] ) ) : ?>
                                    <li><a href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i class="fab fa-github"></i></a></li>
                                <?php endif; ?>
                               </ul>
                            </div>
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

$widgets_manager->register( new TP_Team() );