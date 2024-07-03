<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Blog_Post extends Widget_Base {

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
		return 'tp-blog-post';
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
		return __( 'TP :: Blog Post', 'tpcore' );
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


        // Blog Query
		$this->start_controls_section(
            'tp_post_query',
            [
                'label' => esc_html__('Blog Query', 'tpcore'),
            ]
        );

        $post_type = 'post';
        $taxonomy = 'category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'tpcore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'tpcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'tpcore'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => tp_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'tpcore'),
                'description' => esc_html__('Select a category to exclude', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => tp_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'tpcore'),
                'type' => Controls_Manager::SELECT2,
                'options' => tp_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'tpcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
			    ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'tpcore' ),
                    'desc' 	=> esc_html__( 'Descending', 'tpcore' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'tpcore'),
                'description' => esc_html__('Set how many word you want to displa!', 'tpcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'tp_post_content',
            [
                'label' => __('Content', 'tpcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tpcore'),
                'label_off' => __('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'tp_post_content_limit',
            [
                'label' => __('Content Limit', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tp_post_content' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_post_time_limit',
            [
                'label' => __('Time Limit', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('2 minute read', 'tpcore'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );

        $this->end_controls_section();


        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tpcore'),
                'condition' => ['tp_design_styles' => 'layout-1']
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
            'select_button_icon',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Button Icon', 'tpcore' ),
                'separator' => 'before'
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_blog_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fi fi-rs-angle-right',
                    'condition' => [
                        'tp_btn_button_show' => 'yes'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_blog_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fi fi-rs-angle-right',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_btn_button_show' => 'yes'
                    ]
                ]
            );
        }
        
        $this->end_controls_section();




        // tp_post__columns_section
        $this->start_controls_section(
            'tp_post__columns_section',
            [
                'label' => esc_html__('Blog - Columns', 'tpcore'),
            ]
        );

        $this->add_control(
            'tp_post___for_desktop',
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
            'tp_post___for_laptop',
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
            'tp_post___for_tablet',
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
            'tp_post___for_mobile',
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

        


        // style control


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

		if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if(!empty($settings['exclude_category'])){
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (! empty( $settings['ignore_sticky_posts'] ) && 'yes' == $settings['ignore_sticky_posts']) ? true : false ;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if ( !empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'	=> 'category',
                    'field'	 	=> 'slug',
                    'terms'		=> $exclude_category_list_value,
                    'operator'	=> 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if ( !empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'	=> 'category',
                    'field'		=> 'slug',
                    'terms'		=> $category_list_value,
                    'operator'	=> 'IN'
                );
            }

        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($args);


        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-3' ): 
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big tp-el-title');
        ?>

        <div class="row">

            <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : 
            $query->the_post();
            global $post;


            $categories = get_the_category($post->ID);
            ?>
            <div class="col-xl-4 col-lg-6 col-md-6">
              <div class="tp-blog tp-blog-parent">
                 <div class="tp-blog__thumb">
                    <div class="fix blog-round">
                       <a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
                    </div>
                 </div>
                 <div class="tp-blog__content blog-edu p-relative">
                    <div class="tp-blog__meta-list mb-10">
                       <span><a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><i class="fi fi-ss-calendar"></i><?php the_time( 'M j, Y' ); ?></a></span>
                       <span><a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><i class="fi fi-sr-apps"></i><?php echo esc_html($categories[0]->name); ?></a></span>
                    </div>
                    <h3 class="tp-blog__title mb-15"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a></h3>
                    <span><a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><i class="fi fi-sr-user"></i><?php print get_the_author();?></a></span>
                 </div>
              </div>
            </div>
            <?php endwhile; endif; wp_reset_query(); ?>

        </div>

        <?php elseif ( $settings['tp_design_style']  == 'layout-2' ): 
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big tp-el-title');
        ?>


        <div class="row">

            <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : 
            $query->the_post();
            global $post;


            $categories = get_the_category($post->ID);
            ?>
            <div class="col-lg-4 col-md-6">
              <div class="tp-blog">
                 <div class="tp-blog__thumb p-relative">
                    <div class="fix blog-round">
                      <a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
                    </div>
                    <div class="tp-blog__meta-ab">
                       <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a> <span><?php echo esc_html__('-', 'tpcore');?></span> 
                       <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php the_time( 'M j, Y' ); ?></a>
                    </div>
                 </div>
                 <div class="tp-blog__content blog-box p-relative">
                    <h3 class="tp-blog__title mb-15 mt-20"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a></h3>
                    <?php if (!empty($settings['tp_post_content'])):
                        $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                            ?>
                        <p class="content"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                    <?php endif; ?>
                    <?php if(!empty($settings['tp_post_time_limit'])) : ?>
                    <span><i class="fi fi-rr-clock"></i> <?php echo tp_kses($settings['tp_post_time_limit']);?></span>
                    <?php endif; ?>
                 </div>
              </div>
            </div>
            <?php endwhile; endif; wp_reset_query(); ?>

        </div>
            

        <?php else: 
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big tp-el-title');
        ?>


        <div class="row">

            <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : 
            $query->the_post();
            global $post;


            $categories = get_the_category($post->ID);
            ?>
           <div class="col-xl-4 col-md-6">
              <div class="tp-blog">
                 <div class="tp-blog__thumb p-relative">
                    <div class="tp-blog__timg fix">
                       <a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
                    </div>
                    <?php if(!empty($settings['tp_btn_button_show'])) : ?>
                    <div class="tp-blog__icon"><a href="<?php the_permalink();?>"><?php tp_render_icon($settings, 'tp_blog_icon', 'tp_blog_selected_icon'); ?></i></a></div>
                    <?php endif; ?>
                 </div>
                 <div class="tp-blog__content">
                    <div class="tp-blog__meta mb-10">
                       <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a> <span><?php echo esc_html__('-', 'tpcore');?></span> 
                       <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php the_time( 'M j, Y' ); ?></a>
                    </div>
                    <h3 class="tp-blog__title mb-15"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a></h3>
                    <?php if (!empty($settings['tp_post_content'])):
                        $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                            ?>
                        <p class="content"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                    <?php endif; ?>
                 </div>
              </div>
           </div>


           <?php endwhile; endif; wp_reset_query(); ?>

        </div>





    	<?php endif;

	}

}

$widgets_manager->register( new TP_Blog_Post() );