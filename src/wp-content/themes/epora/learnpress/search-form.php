<?php


/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<form method="get" name="search-course" class="epora-search-course-form"
      action="<?php echo learn_press_get_page_link( 'courses' ); ?>">

    <input type="text" name="s" class="search-course-input" value="<?php echo esc_attr($s); ?>"
        placeholder="<?php echo esc_attr__( 'Search course...', 'epora' ); ?>"/>
    <input type="hidden" name="ref" value="course"/>

      <button type="submit">
         <i class="fal fa-search"></i>
      </button>
</form>