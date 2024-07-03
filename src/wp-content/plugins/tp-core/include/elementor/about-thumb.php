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
class TP_About_Thumbnail extends Widget_Base {

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
		return 'tp-about-thumbnail';
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
		return __( 'TP :: About Thumbnail', 'tpcore' );
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
        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image_3',
            [
                'label' => esc_html__( 'Choose Image 3', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
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

        // tp_section_offer
        $this->start_controls_section(
            'tp_section_offer',
            [
                'label' => esc_html__('Offer Badge', 'tpcore'),
                'condition' => ['tp_design_style' => 'layout-1']
            ]
        );

        $this->add_control(
            'tp_section_offer_show',
            [
                'label' => esc_html__( 'Show Offer', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_at_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Sub Title', 'tpcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_top_txt',
            [
                'label' => esc_html__('Top Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Offer', 'tpcore'),
                'placeholder' => esc_html__('Type Top Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_bottom_txt',
            [
                'label' => esc_html__('Botttom Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('In March', 'tpcore'),
                'placeholder' => esc_html__('Type Bottom Text', 'tpcore'),
                'label_block' => true,
            ]
        );     
        $this->end_controls_section();

        

        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
                'condition' => ['tp_design_style' => 'layout-1']
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

        



		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Offer Style', 'tpcore' ),
				'tab' => Controls_Manager::TAB_STYLE,'
                condition' => ['tp_design_style' => 'layout-2',]
			]
		);

        $this->add_control(
            'offer_color',
            [
                'label' => __( 'Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-about-circle h3, .tp-about-circle p, .tp-about-circle span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'offer_bg_color',
            [
                'label' => __( 'Background Color', 'tp-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-about-circle ' => 'background-color: {{VALUE}}',
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

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['tp_image_3']['url']) ) {
                $tp_image_3 = !empty($settings['tp_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_image_3']['id'], $settings['tp_image_size_size']) : $settings['tp_image_3']['url'];
                $tp_image_3_alt = get_post_meta($settings["tp_image_3"]["id"], "_wp_attachment_image_alt", true);
            }

        ?>



        <div class="tp-about-wapper3 mb-30">
            <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
            <div class="ab-main-img">
                <img class="ab-1st-img" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
            </div>
            <?php endif; ?>
            <?php if ($settings['tp_image_2']['url'] || $settings['tp_image_2']['id']) : ?>
            <div class="ab-sec-img">
                <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
            </div>
            <?php endif; ?>
            <?php if ($settings['tp_image_3']['url'] || $settings['tp_image_3']['id']) : ?>
            <div class="ab-third-img d-none d-md-block">
                <img src="<?php echo esc_url($tp_image_3); ?>" alt="<?php echo esc_attr($tp_image_3_alt); ?>">
            </div>
            <?php endif; ?>
        </div>


		<?php else: 
            if ( !empty($settings['tp_image']['url']) ) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }            

            if ( !empty($settings['tp_image_2']['url']) ) {
                $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
                $tp_image_2_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
            }     

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


        <div class="tp-about-wapper p-relative">
            <div class="tp-about-thumb p-relative pt-60 mb-40">

                <?php if ($settings['tp_image']['url'] || $settings['tp_image']['id']) : ?>
                <img class="ab-sm" src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                <?php endif; ?>

                <?php if ($settings['tp_image_2']['url'] || $settings['tp_image_2']['id']) : ?>
                <img class="ab-lg ml-80" src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_2_alt); ?>">
                <?php endif; ?>

                <?php if(!empty($settings['tp_section_offer_show'])) : ?>
                 <div class="tp-about-circle pt-40 pb-40">

                    <?php if(!empty($settings['tp_top_txt'])) : ?>
                    <span><?php echo tp_kses($settings['tp_top_txt']);?></span>
                    <?php endif; ?>

                    <?php if(!empty($settings['tp_at_title'])) : ?>
                    <h3><?php echo tp_kses($settings['tp_at_title']);?></h3>
                    <?php endif; ?>

                    <?php if(!empty($settings['tp_bottom_txt'])) : ?>
                    <p><?php echo tp_kses($settings['tp_bottom_txt']);?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['tp_btn_button_show'])) : ?>
                    <div class="circle-link">
                       <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                    <?php endif; ?>

                 </div>
                <?php endif; ?>

            </div>
        </div>

        <?php endif; ?>

        <?php 
	}
}

$widgets_manager->register( new TP_About_Thumbnail() );