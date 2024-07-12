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
    $lp_subject = isset($_GET['lp_subject']) ? $_GET['lp_subject'] : '';;
    
?>
    <form action=" <?php echo $current_url ?> " method="get" id="filter">
        <div class="fees-filter aos-init aos-animate" data-aos="fade-up">
          <h4>Categories</h4>
          <div class="form-group">
            <label class="control-label">Year</label>
            <div class="NiceSelect">
              <select name="lp_year" id="lp_year" style="display: none;">
                <?php foreach ($yeararr as $obj): ?>
                  <option selected value="<?php echo $lp_year ?>"></option>
                  <option value="<?php echo htmlspecialchars($obj->slug); ?>"><?php echo htmlspecialchars($obj->name); ?></option>
                <?php endforeach; ?>
              </select>
              <?php if(!empty($yeararr)) {?>
              <div class="nice-select" id="select-year" tabindex="0"><span class="current"><?php if(!empty($lp_year)){echo $lp_year;}else{echo 'Please Select';}?></span>
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
                <?php foreach ($levelarr as $obj): ?>
                    <option selected value="<?php echo $lp_level ?>"></option>
                  <option value="<?php echo htmlspecialchars($obj->slug); ?>"><?php echo htmlspecialchars($obj->name); ?></option>
                <?php endforeach; ?>
              </select>
              <?php if(!empty($levelarr)) {?>
              <div class="nice-select" tabindex="0"><span class="current"><?php if(!empty($lp_level)){echo $lp_level;}else{echo 'Please Select';}?></span>
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
                <?php foreach ($subjectarr as $obj): ?>
                    <option selected value="<?php echo $lp_subject ?>"></option>
                  <option value="<?php echo htmlspecialchars($obj->slug); ?>"><?php echo htmlspecialchars($obj->name); ?></option>
                <?php endforeach; ?>
              </select>
              <?php if(!empty($subjectarr)) {?>
              <div class="nice-select" tabindex="0"><span class="current"><?php if(!empty($lp_subject)){echo $lp_subject;}else{echo 'Please Select';}?></span>
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