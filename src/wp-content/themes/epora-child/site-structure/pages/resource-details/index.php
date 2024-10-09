<?php
if (isset($_GET['id-courses'])) {
    $id_courses = $_GET['id-courses'];
    $item_type = 'lp_course';
        
    $table_name = 'fcs_data_learnpress_files';
    $query = $wpdb->prepare(
        "SELECT file_name, file_type, file_path 
         FROM $table_name 
         WHERE item_id = %d AND item_type = %s",
        $id_courses, $item_type
    );

    $results = $wpdb->get_results($query);
    
    ?>
    <h2 class="heading-resource"><?php echo get_the_title($id_courses);?></h2>
    <div class="course-tab-panel-materials course-tab-panel" id="tab-materials">
  <div class="lp-list-material">   
            <div class="lp-material-skeleton">
    <table class="course-material-table" style="display: table;">
     <tbody id="material-file-list">
                        <?php if(empty($results)){echo '<tr class="lp-material-item">This course currently has no resources. We will update in the future.</tr>';}else{?>
                        <?php foreach ($results as $file) { ?>
                        <tr class="lp-material-item">
                            <td class="lp-material-file-name"> <?php echo $file->file_name; ?></td>
                            <td class="lp-material-file-type" style="text-align: center">Type <?php echo $file->file_type; ?></td>
                            <td class="lp-material-file-link" style="text-align: center">
                                <a href="/wp-content/uploads<?php echo $file->file_path; ?>" target="_blank" rel="">
                                    Download
                                </a>
                            </td>
                        </tr>
                        <?php }}?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php

}