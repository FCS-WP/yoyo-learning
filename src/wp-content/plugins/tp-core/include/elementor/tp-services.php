<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Services extends Widget_Base {

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
        return 'tp-services';
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
        return __( 'TP :: Services', 'tpcore' );
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
            'tp_services',
            [
                'label' => esc_html__('Services List', 'tpcore'),
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
            'tp_service_main_image',
            [
                'label' => esc_html__('Upload Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );

        $repeater->add_control(
            'tp_service_icon_type',
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
            'tp_service_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_service_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_service_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'flaticon-cctv-1',
                    'condition' => [
                        'tp_service_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_service_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'flaticon-cctv-1',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_service_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'tp_service_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_service_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        ); 

        $repeater->add_control(
            'tp_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                
            ]
        );
        $repeater->add_control(
            'tp_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_services_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'tp_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_link',
            [
                'label' => esc_html__( 'Service Link link', 'tpcore' ),
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
                    'tp_services_link_type' => '1',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_services_link_type' => '2',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_service_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_service_align',
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
                    '{{WRAPPER}} .tpservices__content h3, .tpservices__content p, .tpsvbox .tpsvbox__content' => 'text-align: {{VALUE}}!important;'
                ]
            ]
        );
        $this->end_controls_section();

        

        // tp_services_columns_section
        $this->start_controls_section(
            'tp_services_columns_section',
            [
                'label' => esc_html__('Services - Columns', 'tpcore'),
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

        // style tab here
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Services Style', 'tpcore' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // title
        $this->add_control(
            '_style_title_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'tpcore' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'services_title_color',
            [
                'label' => __( 'Text Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpservices__title,.tpsvbox__title ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'services_title_hover_color',
            [
                'label' => __( 'Hover Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpservices__title,.tpsvbox__title:hover ' => 'color: {{VALUE}}',
                ],
                'condition' => ['tp_design_style' => 'layout-2']
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'services_title_typo',
                'selector' => '{{WRAPPER}} .tpservices__title, .tpsvbox__title',
            ]
        );

        // description
        $this->add_control(
            '_style_description_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'tpcore' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'services_description_color',
            [
                'label' => __( 'Text Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpservices__content p, .tpsvbox__content p ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'services_descrip_typo',
                'selector' => '{{WRAPPER}} .tpservices__content p, .tpsvbox__content p',
            ]
        );



        // icon
        $this->add_control(
            '_style_icon_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Icon', 'tpcore' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'services_icon_color',
            [
                'label' => __( 'Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpservices__content i, .tpsvbox__icon_b span i, .tpsvbox__icon a i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'services_icon_bg_color',
            [
                'label' => __( 'Background Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpsvbox__icon a, .tpsvbox__icon_b span ' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['tp_design_style' => 'layout-2']
            ]
        );


        // button title
        $this->add_control(
            '_style_button_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Button', 'tpcore' ),
                'separator' => 'before',
            ]
        );

        // Button
        $this->start_controls_tabs(
            'btn_style',
        );

        $this->start_controls_tab(
            'btn_normal_style',
            [
                'label' => esc_html__( 'Normal', 'tpcore' ),
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => __( 'Background Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpservices__btn .tp-btn, .tp-btn ' => 'background-color: {{VALUE}}',
                ],
            ]
        );



        $this->add_control(
            'btn_text_color',
            [
                'label' => __( 'Text Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpservices__btn .tp-btn, .tpservices__btn .tp-btn i, .tp-btn,.tp-btn i ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_text_typo',
                'selector' => '{{WRAPPER}} .tpservices__btn .tp-btn, .tp-btn',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'btn_hover_style',
            [
                'label' => esc_html__( 'Hover', 'tpcore' ),
            ]
        );


        $this->add_control(
            'btn_thover_color',
            [
                'label' => __( 'Text Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpservices__btn .tp-btn:hover, .tpservices__btn .tp-btn:hover i , .tp-btn:hover, .tp-btn:hover i ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_bg_color',
            [
                'label' => __( 'Background Color', 'tpcore' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tpservices__btn .tp-btn, .tp-btn:hover ' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_tabs();
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

        if ( $settings['tp_design_style']  == 'layout-2' ): 
        ?>


        <div class="row">

            <?php foreach ($settings['tp_service_list'] as $key => $item) : 
                // Link
                if ('2' == $item['tp_services_link_type']) {
                    $link = get_permalink($item['tp_services_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                    $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']);?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']);?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']);?> col-sm-<?php echo esc_attr($settings['tp_col_for_mobile']);?>">
               <div class="tpsvbox mb-30">
                  <div class="tpsvbox__thumb">

                    <?php if (!empty($link) && !empty($item['tp_services_link_switcher']) && !empty($item['tp_service_main_image'])) : ?>
                    <div class="fix">
                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" >
                            <img src="<?php echo esc_url($item['tp_service_main_image']['url']);?>" alt="<?php echo esc_attr__('service_img', 'tpcore');?>">
                        </a>
                    </div>
                    <?php else : ?>
                    <div class="fix">
                        <img src="<?php echo esc_url($item['tp_service_main_image']['url']);?>" alt="<?php echo esc_attr__('service_img', 'tpcore');?>">
                    </div>
                    <?php endif; ?>
                        

                    <?php if (!empty($link) && !empty($item['tp_services_link_switcher'])) : ?>
                        <?php if($item['tp_service_icon_type'] !== 'image') : ?>
                            <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                                <div class="tpsvbox__icon">
                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?></i></a>
                                </div>
                            <?php endif; ?>   
                        <?php else : ?>
                            <div class="tp-sv-img">
                                <?php if (!empty($item['tp_service_image']['url'])): ?>
                                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                    <img src="<?php echo $item['tp_service_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                </a>
                                <?php endif; ?>  
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if($item['tp_service_icon_type'] !== 'image') : ?>
                            <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                                <div class="tpsvbox__icon_b"><span><?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?></i></span>
                                </div>
                            <?php endif; ?>   
                        <?php else : ?>
                            <div class="tp-sv-img">
                                <?php if (!empty($item['tp_service_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_service_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>  
                            </div>
                        <?php endif; ?>
                    <?php endif ; ?>


                  </div>
                  <div class="tpsvbox__content text-center">
                     <div class="tpsvbox__big-text">
                        <h2><?php echo esc_html__('0','tpcore');?><?php echo esc_html($key+1);?></h2>
                     </div>

                    <?php if (!empty($link) && !empty($item['tp_services_link_switcher'])) : ?>
                        <?php if(!empty($item['tp_service_title' ])) : ?>
                            <h3 class="tpsvbox__title"><a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_service_title' ]); ?></a></h3>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if(!empty($item['tp_service_title' ])) : ?>
                            <h3 class="tpsvbox__title"><?php echo tp_kses($item['tp_service_title' ]); ?></h3>
                        <?php endif; ?>
                    <?php endif;?>

                    

                     
                    <?php if (!empty($item['tp_service_description' ])): ?>
                    <p class="m-0"><?php echo tp_kses($item['tp_service_description']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($link) && !empty($item['tp_services_link_switcher']) && !empty($item['tp_services_btn_text']) ) : ?>
                        <a class="tp-btn mt-20" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_services_btn_text']); ?> <i class="fal fa-long-arrow-right"></i></a>
                    <?php endif; ?>


                  </div>
               </div>
            </div>
            <?php endforeach; ?>

         </div>


        <?php else: ?>  


        <div class="row">

            <?php foreach ($settings['tp_service_list'] as $key => $item) : 
                // Link
                if ('2' == $item['tp_services_link_type']) {
                    $link = get_permalink($item['tp_services_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                    $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']);?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']);?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']);?> col-sm-<?php echo esc_attr($settings['tp_col_for_mobile']);?>">
               <div class="tpservices mb-30">

                <?php if (!empty($link) && !empty($item['tp_services_link_switcher']) && !empty($item['tp_service_main_image'])) : ?>
                  <div class="tpservices__thumb">
                     <div class="fix">
                        <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" ><img src="<?php echo esc_url($item['tp_service_main_image']['url']);?>" alt="<?php echo esc_attr__('service_img', 'tpcore');?>"></a>
                     </div>
                  </div>
                <?php else : ?>
                    <div class="tpservices__thumb">
                         <div class="fix"><img src="<?php echo esc_url($item['tp_service_main_image']['url']);?>" alt="<?php echo esc_attr__('service_img', 'tpcore');?>">
                         </div>
                    </div>
                <?php endif; ?>

                  <div class="tpservices__content">

                    <?php if($item['tp_service_icon_type'] !== 'image') : ?>
                        <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                            <div class="tp-sv-icon">
                                <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                            </div>
                        <?php endif; ?>   
                    <?php else : ?>
                        <div class="tp-sv-icon">
                            <?php if (!empty($item['tp_service_image']['url'])): ?>
                            <img src="<?php echo $item['tp_service_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>  
                        </div>
                    <?php endif; ?>    

                    <?php if(!empty($item['tp_service_title' ])) : ?>
                     <h3 class="tpservices__title"><?php echo tp_kses($item['tp_service_title' ]); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($item['tp_service_description' ])): ?>
                    <p><?php echo tp_kses($item['tp_service_description']); ?></p>
                    <?php endif; ?>

                  </div>

                <?php if (!empty($link) && !empty($item['tp_services_link_switcher'])) : ?>
                <div class="tpservices__btn">
                    <a class="tp-btn w-100" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo tp_kses($item['tp_services_btn_text']); ?> <i class="fal fa-long-arrow-right"></i></a>
                </div>
                <?php endif; ?>

               </div>
            </div>
            <?php endforeach; ?>

         </div>


        <?php endif; ?>

        <?php 
    }
}

$widgets_manager->register( new TP_Services() );