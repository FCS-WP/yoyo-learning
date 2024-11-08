<?php
/*
Plugin Name: Import Question
Plugin URI: https://floatingcube.com
Description: Allows uploading CSV files to the uploads folder using AJAX.
Version: 1.0
Author: Floating Cube
Author URI: https://floatingcube.com
*/

add_action('admin_menu', 'add_import_question_menu');


function add_import_question_menu() {
    add_menu_page(
        'Import Question',            
        'Import Question',            
        'manage_options',             
        'import-question',            
        'display_import_question_page',
        'dashicons-upload',           
        6                             
    );
    
}
add_action('admin_menu', 'add_map_to_col');
function add_map_to_col(){
    add_submenu_page( 
        'import-question',    
        '',   
        '',   
        'manage_options',         
        'map-to-col',             
        'map_to_col_check'        
    );
}

function map_to_col_check(){

    // Start the session if it's not already started
    if (!session_id()) {
        session_start();
    }

    if (isset($_POST['submit_csv']) && !empty($_FILES['import_file'])) {
        $file = $_FILES['import_file'];

        $file_type = wp_check_filetype($file['name']);
        if ($file_type['ext'] !== 'csv') {
            echo '<div class="notice notice-error"><p>Please upload a CSV file.</p></div>';
        } else {
            $upload_overrides = array('test_form' => false);
            $movefile = wp_handle_upload($file, $upload_overrides);

            if ($movefile && !isset($movefile['error'])) {
                echo '<div class="notice notice-success"><p>CSV file uploaded successfully: ' . esc_html($movefile['url']) . '</p></div>';
                
                $csv_path = $movefile['file'];

                // Store the CSV path in the session
                $_SESSION['csv_path'] = $csv_path;
                // Show CSV data
                show_csv_data($csv_path);
                

            } else {
                echo '<div class="notice notice-error"><p>Error during upload: ' . esc_html($movefile['error']) . '</p></div>';
            }
        }
    }
    ?>
    <script>
    jQuery(document).ready(function($) {
        $('#import-action').on('submit', function(e) {
            e.preventDefault();
            let processBar = document.getElementById("process-bar-import-question");
            let imgProcess = document.getElementById("img-process");
            let imgComplete = document.getElementById("img-complete");
            let actionMapping = document.getElementById("action-map-to-col");
            let previewFile = document.getElementById("preview-file-import");
            processBar.classList.toggle("displayNone");

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'process_import_action',
                    type: $('#type').val(),
                    title: $('#title').val(),
                    description: $('#description').val(),
                    marks: $('#marks').val(),
                    questiontype: $('#questiontype').val(),
                    questionexplanation: $('#questionexplanation').val(),
                    questionhint: $('#questionhint').val(),
                    answer1: $('#answer1').val(),
                    answer2: $('#answer2').val(),
                    answer3: $('#answer3').val(),
                    answer4: $('#answer4').val(),
                    answer5: $('#answer5').val(),
                    correctanswer: $('#correctanswer').val(),
                    csvpath: $('#csvpath').val()
                },
                success: function(response) {
                    let stepImport = response.data.step;
                    let totalImport = response.data.total;
                    if (response.success) {

                        console.log(totalImport);
                        actionMapping.classList.toggle("displayNone");
                        previewFile.classList.toggle("displayNone");
                        while ( stepImport < totalImport) {

                            ajaxImport(stepImport,response.data.arrayImport[stepImport]);
                            document.getElementById("status-process-bar").style.width = (((stepImport+1)/totalImport)*100) + "%";
                            stepImport++;
                            if(stepImport == totalImport){
                            imgComplete.classList.toggle("displayNone");
                            imgProcess.classList.toggle("displayNone");
                            
                        }
                        }

                    } else {
                        
                    }
                },
                error: function(xhr, status, error) {
                    alert('AJAX Error : ' + error);
                }
            });
        });

        function ajaxImport(stepImport, arrayImport){
            $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'import_data_to_DB',
                        step: stepImport,
                        array: arrayImport,
                        
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('success array ' + response.data);
                        } else {
                            // alert('Error: ' + response.data);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('AJAX Error: ' + error);
                    }
                });
        }
    });

    
    </script>
    <?php
    
}

function display_import_question_page() {
    global $wpdb;
    
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    
    <div class="wrap wrap-upload-file">
        <h1>Import Questions</h1>
        <p>Upload a question file</p>

        <form action=" <?php echo get_admin_url() .'admin.php?page=map-to-col' ?> " method="post" enctype="multipart/form-data">
            <input type="file" name="import_file" accept=".csv" required>
            <br><br>
            <input type="submit" name="submit_csv" class="button button-primary" value="Upload CSV">
        </form>
    </div>
    

    <?php    
}

add_action('wp_ajax_process_import_action', 'process_import_action');
add_action('wp_ajax_nopriv_process_import_action', 'process_import_action');

add_action('wp_ajax_import_data_to_DB', 'import_data_to_DB');
add_action('wp_ajax_nopriv_import_data_to_DB', 'import_data_to_DB');


function process_import_action() {
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $marks = isset($_POST['marks']) ? $_POST['marks'] : '';
    $question_type = isset($_POST['questiontype']) ? $_POST['questiontype'] : '';
    $question_explanation = isset($_POST['questionexplanation']) ? $_POST['questionexplanation'] : '';
    $question_hint = isset($_POST['questionhint']) ? $_POST['questionhint'] : '';
    $answer_1 = isset($_POST['answer1']) ? $_POST['answer1'] : '';
    $answer_2 = isset($_POST['answer2']) ? $_POST['answer2'] : '';
    $answer_3 = isset($_POST['answer3']) ? $_POST['answer3'] : '';
    $answer_4 = isset($_POST['answer4']) ? $_POST['answer4'] : '';
    $answer_5 = isset($_POST['answer5']) ? $_POST['answer5'] : '';
    $correct_answer = isset($_POST['correctanswer']) ? $_POST['correctanswer'] : '';
    $csv_path = isset($_POST['csvpath']) ? $_POST['csvpath'] : '';

    $array_mapping = array(
        'type' => $type,
        'title' => $title,
        'description' => $description,
        'marks' => $marks,
        'question_type' => $question_type,
        'question_explanation' => $question_explanation,
        'question_hint' => $question_hint,
        'answer_1' => $answer_1,
        'answer_2' => $answer_2,
        'answer_3' => $answer_3,
        'answer_4' => $answer_4,
        'answer_5' => $answer_5,
        'correct_answer' => $correct_answer,
        'csv_path' => $csv_path
    );
    
    
    if (($handle = fopen($csv_path, 'r')) !== FALSE) {
        
        $header = fgetcsv($handle);
        $data_csv_after_map = array();
        while (($row = fgetcsv($handle, 1000 , ',')) !== FALSE) {
            $data_csv_after_map[] = array(
                'type' => $row[$array_mapping['title']],
                'type' => $row[$array_mapping['type']],
                'title' => $row[$array_mapping['title']],
                'description' => $row[$array_mapping['description']],
                'marks' => $row[$array_mapping['marks']],
                'question_type' => $row[$array_mapping['question_type']],
                'question_explanation' => $row[$array_mapping['question_explanation']],
                'question_hint' => $row[$array_mapping['question_hint']],
                'answer_1' => $row[$array_mapping['answer_1']],
                'answer_2' => $row[$array_mapping['answer_2']],
                'answer_3' => $row[$array_mapping['answer_3']],
                'answer_4' => $row[$array_mapping['answer_4']],
                'answer_5' => $row[$array_mapping['answer_5']],
                'correct_answer' => $row[$array_mapping['correct_answer']],
            );
        }
        fclose($handle);
    }    
    
    $total_offset = ceil(count($data_csv_after_map)/20);
    $subarrays = array_chunk($data_csv_after_map, 20);
    
    $array_send = array(
        'step' => 0,
        'total' => $total_offset,
        'arrayImport' => $subarrays,
    );
    
    wp_send_json_success($array_send);

    
    wp_die();
}

function import_data_to_DB(){
    global $wpdb;
    
    $offset = isset($_POST['step']) ? $_POST['step'] : '';
    $array_import = isset($_POST['array']) ? $_POST['array'] : '';
    // $array_import_step = $array_import[$offset];
    // wp_send_json_success($array_import_step['title']);
    
    foreach($array_import as $key => $items){
        switch ($array_import[$key]['type']) {
            case "quiz":
                $temp_quiz_id = "";
                $new_quiz = array(
                    'post_title' => $array_import[$key]['title'],
                    'post_content' => $array_import[$key]['description'],
                    'post_name' => sanitize_title($array_import[$key]['title']),
                    'post_status' => 'publish',
                    'post_type' => 'lp_quiz',
                );
                $quiz_id = wp_insert_post($new_quiz);
                $temp_quiz_id = $quiz_id;
              break;
            case "question":
                $new_question = array(
                    'post_title' => $array_import[$key]['title'],
                    'post_content' => $array_import[$key]['description'],
                    'post_name' => sanitize_title($array_import[$key]['title']),
                    'post_status' => 'publish',
                    'post_type' => 'lp_question',
                );

                $question_id = wp_insert_post($new_question);
                                
                $array_relationship_quiz_question = array(
                    'quiz_id'       => $temp_quiz_id, 
                    'question_id' => $question_id,
                    'question_order' => $key,
                );
                $array_format_relationship_quiz_question = array(
                    '%s',
                    '%s',
                    '%s',
                );
                
                $wpdb->insert(
                    'fcs_data_learnpress_quiz_questions', 
                    $array_relationship_quiz_question,
                    $array_format_relationship_quiz_question
                );

                update_post_meta($question_id, '_lp_explanation', $array_import[$key]['question_explanation']);
                update_post_meta($question_id, '_lp_mark', $array_import[$key]['marks']);
                update_post_meta($question_id, '_lp_hint', $array_import[$key]['question_hint']);
                update_post_meta($question_id, '_lp_type', $array_import[$key]['question_type']);
                                
                switch ($array_import[$key]['question_type']) {
                    case "fill_in_blanks":
                        
                        $wpdb->insert(
                            'fcs_data_learnpress_question_answers', 
                            $array_answer_sql,
                            $format_array
                        );
                      break;
                    default:
                        $answer = array($array_import[$key]['answer_1'],$array_import[$key]['answer_2'],$array_import[$key]['answer_3'],$array_import[$key]['answer_4'],$array_import[$key]['answer_5']);
                        $correct_answers_array = array_map('trim', explode(',', $array_import[$key]['correct_answer']));
                    
                        foreach($answer as $key=>$items ){
                            $possition_items = $key + 1;
                            $array_answer_sql = array(
                                'question_id' => $question_id, 
                                'title'       => $items,
                                'order'       => $possition_items,
                                'value'       => sanitize_title($items) . '-'.$question_id,
                                'is_true'       => '' 
                            );
    
                            $format_array = array(
                                '%d', 
                                '%s',
                                '%d',
                                '%s',
                                '%s',
                            );
                            if(in_array($possition_items, $correct_answers_array)){
                                $array_answer_sql["is_true"] = "yes";
                                if(!empty($items)){
                                    $wpdb->insert(
                                        'fcs_data_learnpress_question_answers', 
                                        $array_answer_sql,
                                        $format_array
                                    );
                                }
                            }else{
                                if(!empty($items)){
                                    $wpdb->insert(
                                        'fcs_data_learnpress_question_answers', 
                                        $array_answer_sql,
                                        $array_param_answer_sql
                                    );
                                }
                            }
                        }
                    }
                break;
        }
    }
}


function map_to_col($items_col){
    
    ?>
    <style>
        .status-import{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row-reverse;
            margin-top: 50px;
        }
        .process-bar{
            width: 400px;
            background: lightgray;
            border-radius: 5px;
            height: 30px;
        }
        .status-process-bar{
            background: lightgreen;
            width: 0%;
            height: 30px;
            transition: 1s;
            border-radius: 5px;
        }
        .img-process-bar img{
            margin-right: 40px;
        }
        .displayNone{
            display: none;
        }
    </style>
    <div class="status-import displayNone" id="process-bar-import-question">
        <div class="process-bar"><div id="status-process-bar" class="status-process-bar"></div></div>
        <div class="img-process-bar">
            <img id="img-process" src="<?php echo plugin_dir_url(__FILE__); ?>img/ajax-loader.gif">
            <img id="img-complete" class="displayNone" src="<?php echo plugin_dir_url(__FILE__); ?>img/complete.png">
        </div>
        
    </div>
    
    <div id="action-map-to-col">
        <h2>Map To Column:</h2>
        <form action="#" method="POST" id="import-action">
            <div class="maping-section" style="display: flex; flex-wrap:wrap">
                <div class="maping-col">
                    <label for="type">Type:</label>
                    <select name="type" id="type">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="title">Title:</label>
                    <select name="title" id="title">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="description">Description:</label>
                    <select name="description" id="description">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="marks">Marks:</label>
                    <select name="marks" id="marks">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="questiontype">Question Type:</label>
                    <select name="questiontype" id="questiontype">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="questionexplanation">Question Explanation:</label>
                    <select name="questionexplanation" id="questionexplanation">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="questionhint">Question Hint:</label>
                    <select name="questionhint" id="questionhint">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="answer1">Answer 1:</label>
                    <select name="answer1" id="answer1">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="answer2">Answer 2:</label>
                    <select name="answer2" id="answer2">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="answer3">Answer 3:</label>
                    <select name="answer3" id="answer3">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="answer4">Answer 4:</label>
                    <select name="answer4" id="answer4">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="answer5">Answer 5:</label>
                    <select name="answer5" id="answer5">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <label for="correctanswer">Correct Answer:</label>
                    <select name="correctanswer" id="correctanswer">
                        <option value="">Don't Import</option>
                        <?php
                            foreach($items_col as $key=>$items ){
                                echo '<option value="'. $key . '">' . $items . '</option>';
                            }        
                        ?>
                    </select>
                </div>
                <div class="maping-col">
                    <input type="hidden" name="csvpath" id="csvpath" value="<?php echo $_SESSION['csv_path'] ?>">
                </div>
                
            </div>
        
            <input type="submit" value="Import" id="import-action-btn">
        </form>
    </div>
    <style>
        .maping-section .maping-col{
            width: 20%;
            display: flex;
            justify-content: space-between;
            padding-right: 15px;
            margin-bottom: 10px;
        }
    </style>
    <?php
    
}


function show_csv_data($path_file){
    $items_col = read_csv_and_store_first_row($path_file);
    map_to_col($items_col);
    ?>
    <div id="preview-file-import">
    <?php
    if (($handle = fopen($path_file, 'r')) !== FALSE) {
        ?>
        
            <h2>Preview File:</h2>
            <table class="widefat fixed" cellspacing="0">
            <?php
                if (($header = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    ?>
                    <thead><tr>
                    <?php foreach ($header as $col) { ?>
                        <th> <?php  echo esc_html($col) ?></th>
                    <?php } ?>
                    </tr></thead>
                <?php
                }

        $row_count = 0;

        echo '<tbody>';
        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . esc_html($cell) . '</td>';
            }
            echo '</tr>';

            $row_count++;

            if ($row_count >= 10) {
                break;
            }
        }
        echo '</tbody></table>';
        fclose($handle);
    }
    ?>
    </div>
    <?php
}


function read_csv_and_store_first_row($file_path) {
    
    $items_col = [];

    if (file_exists($file_path)) {
        if (($handle = fopen($file_path, 'r')) !== FALSE) {
            if (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $items_col = $data;
            }
            fclose($handle);
        }

    } else {
        error_log('CSV Not Found: ' . $file_path);
    }

    return $items_col;
}


