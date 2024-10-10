<?php
global $wpdb;

$yeararr = get_taxonomy_terms_via_db('lp_year');
    $levelarr = get_taxonomy_terms_via_db('lp_grade');
    $subjectarr = get_taxonomy_terms_via_db('lp_subject'); 
    $current_url = get_permalink();
    $current_url = substr($current_url, 0, -1);
    $lp_year = isset($_GET['lp_year']) ? $_GET['lp_year'] : '';
    $lp_grade = isset($_GET['lp_grade']) ? $_GET['lp_grade'] : '';
    $lp_subject = isset($_GET['lp_subject']) ? $_GET['lp_subject'] : '';
    $lp_year_name = str_replace('-', ' ', $lp_year);
    $lp_grade_name = str_replace('-', ' ', $lp_grade);
    $lp_subject_name = str_replace('-', ' ', $lp_subject);
    $selectAllYear = "all";
    $selectAllLevel = "all";
    $selectAllSubject = "all";
    $array_filter = array(
        'relation' => 'AND',
        
    );
    
    if(!empty($lp_year)){
        if($lp_year != "all"){
          $selectAllYear = $lp_year;
          $array_filter[] = array(
            'taxonomy' => 'lp_year', 
            'field'    => 'slug',
            'terms'    =>  $lp_year,
          );
        }
      }
      if(!empty($lp_grade)){
        if($lp_grade != "all"){
          $selectAllLevel = $lp_grade;
          $array_filter[] = array(
            'taxonomy' => 'lp_grade', 
            'field'    => 'slug',
            'terms'    =>  $lp_grade,
        );
        }
      }
      if(!empty($lp_subject)){
        if($lp_subject != "all"){
          $selectAllSubject = $lp_subject;
          $array_filter[] = array(
            'taxonomy' => 'lp_subject', 
            'field'    => 'slug',
            'terms'    =>  $lp_subject,
        );
        }
      }
    $post_per_page = 12;

    
    $query = "
    SELECT DISTINCT file.item_id 
    FROM fcs_data_learnpress_files AS file 
    LEFT JOIN fcs_data_learnpress_courses AS course 
    ON course.ID = file.item_id
    ";

    $results = $wpdb->get_results($query);
    
    $item_ids = array();

    foreach ($results as $item) {
        $item_ids[] = intval($item->item_id);
    }
    
    $args = array(
        'post_type'      => 'lp_course',
        'orderby'        => isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'title',
        'order'          => isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'asc',
        'posts_per_page' => $post_per_page,
        'paged'          => (get_query_var('paged') ? get_query_var('paged') : 1),
        'post__in' => $item_ids,
        'orderby' => 'post__in',
        'tax_query'      => $array_filter,
        
    );

    $courses = new WP_Query($args);
    $max_num_pages = $courses->max_num_pages;

    $count = $courses->found_posts;

    
?>
    
<div class="page-body">
    <div class="row-items">
        <div  class="filter">
        <form action=" <?php echo $current_url ?> " method="get" id="filter">
            <div class="fees-filter aos-init aos-animate" data-aos="fade-up">
            <div class="form-group">
                <div class="NiceSelect">
                <select name="lp_year" id="lp_year" style="display: none;">
                    <option selected value="<?php echo $selectAllYear ?>"></option>
                    <?php foreach ($yeararr as $obj): ?>
                    <option value="<?php echo htmlspecialchars($obj->slug); ?>"><?php echo htmlspecialchars($obj->name); ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if(!empty($yeararr)) {?>
                <div class="nice-select" id="select-year" tabindex="0"><span class="current"><?php if(!empty($lp_year)){echo ucwords($lp_year_name);}else{echo 'Year';}?></span>
                    <ul class="list">
                        <?php foreach ($yeararr as $obj): ?>
                        <li data-value="<?php echo htmlspecialchars($obj->slug); ?>" class="option"><?php echo htmlspecialchars($obj->name); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php }else{?>
                    <div class="nice-select" id="select-year" tabindex="0"><span class="current">N/A</span></div>
                <?php }?>
                </div>
            </div>
            <div class="form-group">
                <div class="NiceSelect">
                <select name="lp_grade" id="lp_grade" style="display: none;">
                    <option selected value="<?php echo $selectAllLevel ?>"></option>
                    <?php foreach ($levelarr as $obj): ?>
                    <option value="<?php echo htmlspecialchars($obj->slug); ?>"><?php echo htmlspecialchars($obj->name); ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if(!empty($levelarr)) {?>
                <div class="nice-select" tabindex="0"><span class="current"><?php if(!empty($lp_grade)){echo ucwords($lp_grade_name);}else{echo 'Grade';}?></span>
                    <ul class="list">
                    <?php foreach ($levelarr as $obj): ?>
                        <li data-value="<?php echo htmlspecialchars($obj->slug); ?>" class="option"><?php echo htmlspecialchars($obj->name); ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <?php }else{?>
                    <div class="nice-select" tabindex="0"><span class="current">N/A</span></div>
                <?php }?>
                </div>
            </div>
            <div class="form-group">
                <div class="NiceSelect">
                <select name="lp_subject" id="lp_subject" style="display: none;">
                <option selected value="<?php echo $selectAllSubject ?>"></option>  
                <?php foreach ($subjectarr as $obj): ?>
                    <option value="<?php echo htmlspecialchars($obj->slug); ?>"><?php echo htmlspecialchars($obj->name); ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if(!empty($subjectarr)) {?>
                <div class="nice-select" tabindex="0"><span class="current"><?php if(!empty($lp_subject)){echo ucwords($lp_subject_name);}else{echo 'Subject';}?></span>
                    <ul class="list">
                    <?php foreach ($subjectarr as $obj): ?>
                        <li data-value="<?php echo htmlspecialchars($obj->slug); ?>" class="option"><?php echo htmlspecialchars($obj->name); ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <?php }else{?>
                    <div class="nice-select" tabindex="0"><span class="current">N/A</span></div>
                <?php }?>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="submit">Search</button>
            </div>
            <div class="rest-password"><a href=" <?php echo $current_url ?>" id="reset">Clear</a></div>
            </div>
        </form>
        </div>
        <div class="grid-course row">

        <?php if (isset($courses) && !empty($courses)) : ?>
            <?php while ($courses->have_posts()) : $courses->the_post(); 
                $id_course = get_the_id();
                ?>
                <div class="paper-item col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <a href="<?php echo '/resource-details?id-courses=' . $id_course; ?>" class="box-paper">
                        <div class="paper-header">
                            <div class="title"> <?php echo get_the_title($id_course); ?> </div>
                            
                        </div>
                        <div class="paper-progress">
                            <p style="text-align: center;margin-bottom: 0px;font-weight:bolder">View Resources</p>
                        </div>
                        </a>
                    </div>
                
                
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
    <?php pagination_post_author($max_num_pages, $count, $post_per_page); ?>
    </div>
</div>
<?php
