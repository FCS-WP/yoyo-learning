<?php


add_shortcode('filter_course', 'shortcode_filter');

function shortcode_filter(){
    $yeararr = get_taxonomy_terms_via_db('lp_year');
    $levelarr = get_taxonomy_terms_via_db('lp_level');
    $subjectarr = get_taxonomy_terms_via_db('lp_subject'); 
    $current_url = get_permalink();
    $current_url = substr($current_url, 0, -1);
    $lp_year = isset($_GET['lp_year']) ? $_GET['lp_year'] : '';
    $lp_level = isset($_GET['lp_level']) ? $_GET['lp_level'] : '';
    $lp_subject = isset($_GET['lp_subject']) ? $_GET['lp_subject'] : '';
    $lp_year_name = str_replace('-', ' ', $lp_year);
    $lp_level_name = str_replace('-', ' ', $lp_level);
    $lp_subject_name = str_replace('-', ' ', $lp_subject);
    $selectAllYear = "all";
    $selectAllLevel = "all";
    $selectAllSubject = "all";
    if(!empty($lp_year)){
      if($lp_year != "all"){
        $selectAllYear = $lp_year;
      }
    }
    if(!empty($lp_level)){
      if($lp_level != "all"){
        $selectAllLevel = $lp_level;
      }
    }
    if(!empty($lp_subject)){
      if($lp_subject != "all"){
        $selectAllSubject = $lp_subject;
      }
    }
    
?>
    <form action=" <?php echo $current_url ?> " method="get" id="filter">
        <div class="fees-filter aos-init aos-animate" data-aos="fade-up">
          <h4>Categories</h4>
          <div class="form-group">
            <label class="control-label">Year</label>
            <div class="NiceSelect">
              <select name="lp_year" id="lp_year" style="display: none;">
                <option selected value="<?php echo $selectAllYear ?>"></option>
                <?php foreach ($yeararr as $obj): ?>
                  <option value="<?php echo htmlspecialchars($obj->slug); ?>"><?php echo htmlspecialchars($obj->name); ?></option>
                <?php endforeach; ?>
              </select>
              <?php if(!empty($yeararr)) {?>
              <div class="nice-select" id="select-year" tabindex="0"><span class="current"><?php if(!empty($lp_year)){echo ucwords($lp_year_name);}else{echo 'Please Select';}?></span>
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
            <label class="control-label">Level</label>
            <div class="NiceSelect">
              <select name="lp_level" id="lp_level" style="display: none;">
                <option selected value="<?php echo $selectAllLevel ?>"></option>
                <?php foreach ($levelarr as $obj): ?>
                  <option value="<?php echo htmlspecialchars($obj->slug); ?>"><?php echo htmlspecialchars($obj->name); ?></option>
                <?php endforeach; ?>
              </select>
              <?php if(!empty($levelarr)) {?>
              <div class="nice-select" tabindex="0"><span class="current"><?php if(!empty($lp_level)){echo ucwords($lp_level_name);}else{echo 'Please Select';}?></span>
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
            <label class="control-label">Subject</label>
            <div class="NiceSelect">
              <select name="lp_subject" id="lp_subject" style="display: none;">
              <option selected value="<?php echo $selectAllSubject ?>"></option>  
              <?php foreach ($subjectarr as $obj): ?>
                  <option value="<?php echo htmlspecialchars($obj->slug); ?>"><?php echo htmlspecialchars($obj->name); ?></option>
                <?php endforeach; ?>
              </select>
              <?php if(!empty($subjectarr)) {?>
              <div class="nice-select" tabindex="0"><span class="current"><?php if(!empty($lp_subject)){echo ucwords($lp_subject_name);}else{echo 'Please Select';}?></span>
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
            <button type="submit" class="btn btn-primary" id="submit">Apply Filter</button>
          </div>
          <div class="rest-password"><a href=" <?php echo $current_url ?>" id="reset">RESET FILTER</a></div>
        </div>
    </form>
     
<?php } ?>