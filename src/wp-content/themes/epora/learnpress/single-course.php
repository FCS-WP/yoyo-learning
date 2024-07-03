<?php
/**
 * Template for displaying content of single course.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined('ABSPATH') || exit();
if (post_password_required()) {
    echo get_the_password_form();

    return;
}
get_header();
get_template_part( 'template-parts/banner/content', 'banner-course' );
?>
    <div id="main-content" class="main-container course-single pt-100 pb-40"  role="main">
        <div class="container"> 
            <?php
                learn_press_get_template_part( 'content-single', 'course' );
            ?>
        </div> <!-- .container -->
    </div> <!--#main-content -->    
<?php
get_footer();
?>