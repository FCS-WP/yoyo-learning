<?php

function add_time_course_field() {
    add_meta_box(
        'custom_meta_box_id', 
        'Course Time', 
        'show_input_time_course_meta_box', 
        'lp_course', 
        'normal', 
        'high' 
    );
}
add_action('add_meta_boxes', 'add_time_course_field');
function show_input_time_course_meta_box($post) {
    $start_time = get_post_meta($post->ID, 'lp_time_start_field_key', true);
    $end_time = get_post_meta($post->ID, 'lp_time_end_field_key', true);
    $day_course = get_post_meta($post->ID, 'lp_day_course_field_key', true);

    $times = array();
    for ($i = 0; $i < 24; $i++) {
        for ($j = 0; $j < 60; $j += 30) {
            $times[] = sprintf('%02d:%02d', $i, $j);
        }
    }
    ?>
    <p>
        <label for="day-course">Day: </label>
        <select id="day-course" name="day-course">
            <option value="">Select Day Course</option>
            <option value="Monday" <?php selected($day_course, 'Monday'); ?>>Monday</option>
            <option value="Tuesday" <?php selected($day_course, 'Tuesday'); ?>>Tuesday</option>
            <option value="Wednesday" <?php selected($day_course, 'Wednesday'); ?>>Wednesday</option>
            <option value="Thursday" <?php selected($day_course, 'Thursday'); ?>>Thursday</option>
            <option value="Friday" <?php selected($day_course, 'Friday'); ?>>Friday</option>
            <option value="Saturday" <?php selected($day_course, 'Saturday'); ?>>Saturday</option>
            <option value="Sunday" <?php selected($day_course, 'Sunday'); ?>>Sunday</option>
        </select>
        <label for="time-start">Start:</label>
        <select id="time-start" name="time-start" required>
            <option value="">Select Start Time</option>
            <?php foreach ($times as $time) : ?>
                <option value="<?php echo esc_attr($time); ?>" <?php selected($start_time, $time); ?>>
                    <?php echo esc_html($time); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="time-end">End:</label>
        <select id="time-end" name="time-end" required>
            <option value="">Select End Time</option>
            <?php foreach ($times as $time) : ?>
                <option value="<?php echo esc_attr($time); ?>" <?php selected($end_time, $time); ?>>
                    <?php echo esc_html($time); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <?php wp_nonce_field('time_course_nonce_action', 'time_course_nonce'); ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var timeStart = document.getElementById('time-start');
            var timeEnd = document.getElementById('time-end');

            function updateEndTimeOptions() {
                var startTime = timeStart.value;
                var endTimeOptions = timeEnd.querySelectorAll('option');
                endTimeOptions.forEach(function(option) {
                    option.disabled = option.value <= startTime;
                });
                // Ensure end time is valid
                if (timeEnd.value <= startTime) {
                    timeEnd.value = '';
                }
            }

            timeStart.addEventListener('change', updateEndTimeOptions);

            // Trigger a change event to initialize the state of the end time options
            updateEndTimeOptions();
        });
    </script>
    <?php
}

function save_time_course_meta_box_data($post_id) {
    if (!isset($_POST['time_course_nonce']) || !wp_verify_nonce($_POST['time_course_nonce'], 'time_course_nonce_action')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['time-start'])) {
        $start_time = sanitize_text_field($_POST['time-start']);
        update_post_meta($post_id, 'lp_time_start_field_key', $start_time);
    }

    if (isset($_POST['time-end'])) {
        $end_time = sanitize_text_field($_POST['time-end']);
        update_post_meta($post_id, 'lp_time_end_field_key', $end_time);
    }

    if (isset($_POST['day-course'])) {
        $day_course = sanitize_text_field($_POST['day-course']);
        update_post_meta($post_id, 'lp_day_course_field_key', $day_course);
    }
}
add_action('save_post', 'save_time_course_meta_box_data');



