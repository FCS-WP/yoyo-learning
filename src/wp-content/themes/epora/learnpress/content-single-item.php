<?php
/**
 * Template for displaying content of single course with curriculum and
 * item's content inside it
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit();

/**
 * @since 4.0.0
 *
 * @see LP_Template_General::template_header()
 */
do_action( 'learn-press/template-header' );

/**
 * LP Hook
 */
do_action( 'learn-press/before-main-content' );

/**
 * LP Hook
 */
do_action( 'learn-press/before-single-item' );
?>
	<div id="popup-course" class="course-summary">
 		<?php
		/**
		 * @since 4.0.6
		 * @see single-button-toggle-sidebar - 5
		 */

		do_action('learn-press/single-button-toggle-sidebar');

		/**
		 * Get content item's course
		 *
		 * @since 3.0.0
		 *
		 * @see LP_Template_Course::popup_content() - 30
		 */
		do_action( 'learn-press/single-item-summary' );
		?>
	</div>
<?php

/**
 * LP Hook
 *
 * @since 3.0.0
 */
do_action( 'learn-press/after-main-content' );

/**
 * LP Hook
 *
 * @since 3.0.0
 */
do_action( 'learn-press/after-single-course' );

/**
 * LP Hook
 *
 * @since 4.0.0
 *
 * @see LP_Template_General::template_footer()
 */
do_action( 'learn-press/template-footer' );
